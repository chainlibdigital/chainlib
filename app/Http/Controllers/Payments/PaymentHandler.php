<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Notifications\MailHandler;
use App\Http\Controllers\Notifications\LogsHandler;
use App\Http\Controllers\Warehouses\Frisbo;
use App\Http\Controllers\Payments\Paynet\Paynet;
use App\Http\Controllers\Payments\Methods\Cash;
use App\Http\Controllers\Payments\Methods\Paydo;
use App\Http\Controllers\Payments\Methods\Payop;
use App\Http\Controllers\Payments\Methods\Paypal;
use App\Models\PromocodeType;
use App\Models\Promocode;
use App\Models\Cart;
use App\Models\CRMOrders;
use App\Base as Model;
use PDF;
use Session;

class PaymentHandler extends Controller
{
    public static $amount;
    public static $order;
    public static $payment;
    public static $promocode;

    public function __construct($amount = null, $order = null, $payment = null)
    {
        if (Session::has('disableForward')) abort(404);

        parent::__construct();

        if (!is_null($amount)) {
            self::$amount = $amount;
            self::$order = $order;
            self::$payment = $payment;
        }
    }

    /**
     *  Initial handle order and redirect to payment method
     */
    public function handle()
    {
        if (self::$payment == 'cash'){              // done
            $payment = new Cash();
            return $payment->pay();
        }elseif(self::$payment == 'paypal'){        // done
            $payment = new Paypal();
            return $payment->pay();
        }elseif(self::$payment == 'paydo'){         // done
            $payment = new Paydo();
            return $payment->pay();
        }elseif(self::$payment == 'payop'){
            $payment = new Payop();
            return $payment->pay();
        }elseif(self::$payment == 'paynet'){
            $paynet = new Paynet();
            return $paynet->index($order);
        }
    }

    /**
     *  Finish order process with success
     */
    public function success()
    {
        ini_set('memory_limit', '-1');

        Cart::where('user_id', @$_COOKIE['user_id'])->delete();

        $this->generateInvoice();

        $this->generatePromocode();

        $data['order']      = self::$order;
        $data['promocode']  = self::$promocode;
        $data['currency']   = $this->currency;
        $data['currencyRate'] = $this->currency->rate;

        $email = "iovitatudor@gmail.com";  //to change
        $emailUser =  self::$order->details->email; //to change
        $emailAdmin = "itmalles@gmail.com";
        $subject = trans('vars.Email-templates.subjectOrderEmail').' soledy.com';
        $template = 'mails.order.guest';
        $path = public_path('pdf/');
        $filename = self::$order->invoice_file;

        $mail = new MailHandler();
        $mail->sendEmailAttach($data, $email, $subject, $template, $path, $filename);
        $mail->sendEmailAttach($data, $emailUser, $subject, $template, $path, $filename);
        $mail->sendEmailAttach($data, $emailAdmin, $subject, $template, $path, $filename);

        $frisbo = new Frisbo();
        $frisbo->setOrderInvocedStatus(self::$order->order_reference);

        self::$order->update([
            'step' => 2,
            'main_status' => 'ordered',
            'label' => 'FB: invoce created, PSP:'. self::$payment,
            'change_status_at' => date('d-m-Y h:i:s'),
        ]);

        $frisbo = new Frisbo();
        $frisbo->synchronizeStocks();
    }

    /**
     * Finish order process with fail
     */
    public function fail($step = null, $label = null, $mainStatus= null)
    {
        if ($step == null) $step = 0;
        if ($label == null) $label = 'FB: canceled, PSP: No success '. self::$payment;
        if ($mainStatus == null) $mainStatus = 'canceled';

        self::$order->update([
            'step' => $step,
            'label' => $label,
            'main_status' => $mainStatus,
            'change_status_at' => date('d-m-Y h:i:s'),
        ]);

        foreach (self::$order->products as $key => $item) {
            $item->delete();
        }

        $frisbo = new Frisbo();
        $frisbo->setOrderCanceledStatus(self::$order->order_reference);

        Session::flash('payment-error', trans('vars.Notifications.paymentErorTryCatch'));
        return redirect('/ro/order/payment/'. self::$order->id);
    }

    /**
     *  Generate invoice file
     */
    public function generateInvoice()
    {
        $data['order']      = self::$order;
        $data['currency']   = $this->currency;
        $data['promocode']  = '';
        $data['currencyRate'] = $this->currency->rate;

        $lastInvoicedOrder = CRMOrders::where('currency_id', $this->currency->id)
                                        ->where('order_invoice_code', '!=', '')
                                        ->orderBy('id', 'desc')
                                        ->first();

        self::$order->update([
            'order_invoice_code' => $lastInvoicedOrder->order_invoice_code,
            'order_invoice_id' => $lastInvoicedOrder->order_invoice_id + 1,
        ]);

        $pdf        = PDF::loadView('invoices.invoice', $data)->setPaper('a4', 'portrait');
        $path       = public_path('pdf/');
        $fileNameRo = 'ro_invoice_'.uniqid().'.' . 'pdf' ;
        $pdf->save($path . '/' . $fileNameRo);

        $pdf        = PDF::loadView('invoices.invoice_en', $data)->setPaper('a4', 'portrait');
        $path       = public_path('pdf/');
        $fileNameEn = 'en_invoice_'.uniqid().'.' . 'pdf' ;
        $pdf->save($path . '/' . $fileNameEn);

        self::$order->update([
            'invoice_file_en' => $fileNameEn,
            'invoice_file'    => $fileNameRo,
        ]);
    }

    /**
     * Generate new promocode for user
     */
    public function generatePromocode()
    {
        $promocodeTypeName = 'Repeated';
        $userId = 0;

        if (\Auth::guard('persons')->user()){
            $promocodeTypeName = 'User';
            $userId = \Auth::guard('persons')->id();
        }

        $promoType = PromocodeType::where('name', $promocodeTypeName)->first();

        if (!is_null($promoType)) {
            $promocode = Promocode::create([
                'user_id' => $userId,
                'name' => $promoType->name.''.str_random(5),
                'type_id' => $promoType->id,
                'discount' => $promoType->discount,
                'valid_from' => date('Y-m-d'),
                'valid_to' => date('Y-m-d', strtotime(' + '.$promoType->period.' days')),
                'period' => $promoType->period,
                'treshold' => $promoType->treshold,
                'to_use' => 0,
                'times' => $promoType->times,
                'status' => 'valid',
                'user_id' => $userId
            ]);

            return self::$promocode = $promocode;
        }

        return self::$promocode = null;
    }
}

    foreach (Lang::all() as $lang) {
                foreach ($staticPages as $staticPage) {
                    $aSiteMap[$url.'/'.$lang->lang.'/'. $siteType . '/' .$staticPage] = [
                        'added' => time(),
                        'lastmod' => Carbon::now()->toIso8601String(),
                        'priority' => 1 - substr_count($url.'/'.$lang->lang.'/'.$staticPage, '/') / 10,
                        'changefreq' => 'always'
                    ];
                }
            }
        }

        foreach (Lang::all() as $lang) {
            if(count($pages) > 0) {
                foreach ($pages as $page) {
                    $aSiteMap[$url.'/'.$lang->lang.'/'. $siteType . '/'. $page->alias] = [
                        'added' => time(),
                        'lastmod' => Carbon::now()->toIso8601String(),
                        'priority' => 1 - substr_count($url.'/'.$page->alias, '/') / 10,
                        'changefreq' => 'always'
                    ];
                }
            }
        }

        foreach ($siteTypes as $key => $siteType) {
            foreach (Lang::all() as $lang) {
                if(count($categories) > 0) {
                    foreach ($categories as $category) {
                        if ($category->{$siteType} == 1) {
                            $aSiteMap[$url.'/'.$lang->lang.'/'. $siteType . '/catalog/'.$category->alias] = [
                                'added' => time(),
                                'lastmod' => Carbon::now()->toIso8601String(),
                                'priority' => 1 - substr_count($url.'/catalog/'.$category->alias, '/') / 10,
                                'changefreq' => 'always'
                            ];
                        }
                    }
                }
            }
        }

        foreach ($siteTypes as $key => $siteType) {
            foreach (Lang::all() as $lang) {
                if(count($products) > 0) {
                    foreach ($products as $product) {
                        if ($product->{$siteType} == 1 && $product->active == 1) {
                            $aSiteMap[$url.'/'.$lang->lang.'/'. $siteType .'/catalog/'.$product->category->alias.'/'.$product->alias] = [
                                'added' => time(),
                                'lastmod' => Carbon::now()->toIso8601String(),
                                'priority' => 1 - substr_count($url.'/catalog/'.$product->category->alias.'/'.$product->alias, '/') / 10,
                                'changefreq' => 'always'
                            ];
                        }
                    }
                }
            }
        }

        foreach ($siteTypes as $key => $siteType) {
            foreach (Lang::all() as $lang) {
                if(count($sets) > 0) {
                    foreach ($sets as $set) {
                        if ($set->{$siteType} == 1) {
                            if ($set->collection) {
                                $aSiteMap[$url.'/'.$lang->lang. '/' . $siteType. '/collection/'.$set->collection->alias] = [
                                    'added' => time(),
                                    'lastmod' => Carbon::now()->toIso8601String(),
                                    'priority' => 1 - substr_count($url.'/collection/'.$set->collection->alias, '/') / 10,
                                    'changefreq' => 'always'
                                ];
                            }
                        }

                    }
                }
            }
        }

        \Cache::put('sitemap', $aSiteMap, 2880);

        return Response::view('front.sitemap')->header('Content-Type', 'application/xml');
    }
}

rder = null, $payment = null)
    {
        if (Session::has('disableForward')) abort(404);

        parent::__construct();

        if (!is_null($amount)) {
            self::$amount = $amount;
            self::$order = $order;
            self::$payment = $payment;
        }
    }

    /**
     *  Initial handle order and redirect to payment method
     */
    public function handle()
    {
        if (self::$payment == 'cash'){              // done
            $payment = new Cash();
            return $payment->pay();
        }elseif(self::$payment == 'paypal'){        // done
            $payment = new Paypal();
            return $payment->pay();
        }elseif(self::$payment == 'paydo'){         // done
            $payment = new Paydo();
            return $payment->pay();
        }elseif(self::$payment == 'payop'){
            $payment = new Payop();
            return $payment->pay();
        }elseif(self::$payment == 'paynet'){
            $paynet = new Paynet();
            return $paynet->index($order);
        }
    }

    /**
     *  Finish order process with success
     */
    public function success()
    {
        ini_set('memory_limit', '-1');

        Cart::where('user_id', @$_COOKIE['user_id'])->delete();

        $this->generateInvoice();

        $this->generatePromocode();

        $data['order']      = self::$order;
        $data['promocode']  = self::$promocode;
        $data['currency']   = $this->currency;
        $data['currencyRate'] = $this->currency->rate;

        $email = "iovitatudor@gmail.com";  //to change
        $emailUser =  self::$order->details->email; //to change
        $emailAdmin = "itmalles@gmail.com";
        $subject = trans('vars.Email-templates.subjectOrderEmail').' soledy.com';
        $template = 'mails.order.guest';
        $path = public_path('pdf/');
        $filename = self::$order->invoice_file;

        $mail = new MailHandler();
        $mail->sendEmailAttach($data, $email, $subject, $template, $path, $filename);
        $mail->sendEmailAttach($data, $emailUser, $subject, $template, $path, $filename);
        $mail->sendEmailAttach($data, $emailAdmin, $subject, $template, $path, $filename);

        $frisbo = new Frisbo();
        $frisbo->setOrderInvocedStatus(self::$order->order_reference);

        self::$order->update([
            'step' => 2,
            'main_status' => 'ordered',
            'label' => 'FB: invoce created, PSP:'. self::$payment,
            'change_status_at' => date('d-m-Y h:i:s'),
        ]);

        $frisbo = new Frisbo();
        $frisbo->synchronizeStocks();
    }

    /**
     * Finish order process with fail
     */
    public function fail($step = null, $label = null, $mainStatus= null)
    {
        if ($step == null) $step = 0;
        if ($label == null) $label = 'FB: canceled, PSP: No success '. self::$payment;
        if ($mainStatus == null) $mainStatus = 'canceled';

        self::$order->update([
            'step' => $step,
            'label' => $label,
            'main_status' => $mainStatus,
            'change_status_at' => date('d-m-Y h:i:s'),
        ]);

        foreach (self::$order->products as $key => $item) {
            $item->delete();
        }

        $frisbo = new Frisbo();
        $frisbo->setOrderCanceledStatus(self::$order->order_reference);

        Session::flash('payment-error', trans('vars.Notifications.paymentErorTryCatch'));
        return redirect('/ro/order/payment/'. self::$order->id);
    }

    /**
     *  Generate invoice file
     */
    public function generateInvoice()
    {
        $data['order']      = self::$order;
        $data['currency']   = $this->currency;
        $data['promocode']  = '';
        $data['currencyRate'] = $this->currency->rate;

        $lastInvoicedOrder = CRMOrders::where('currency_id', $this->currency->id)
                                        ->where('order_invoice_code', '!=', '')
                                        ->orderBy('id', 'desc')
                                        ->first();

        self::$order->update([
            'order_invoice_code' => $lastInvoicedOrder->order_invoice_code,
            'order_invoice_id' => $lastInvoicedOrder->order_invoice_id + 1,
        ]);

        $pdf        = PDF::loadView('invoices.invoice', $data)->setPaper('a4', 'portrait');
        $path       = public_path('pdf/');
        $fileNameRo = 'ro_invoice_'.uniqid().'.' . 'pdf' ;
        $pdf->save($path . '/' . $fileNameRo);

        $pdf        = PDF::loadView('invoices.invoice_en', $data)->setPaper('a4', 'portrait');
        $path       = public_path('pdf/');
        $fileNameEn = 'en_invoice_'.uniqid().'.' . 'pdf' ;
        $pdf->save($path . '/' . $fileNameEn);

        self::$order->update([
            'invoice_file_en' => $fileNameEn,
            'invoice_file'    => $fileNameRo,
        ]);
    }

    /**
     * Generate new promocode for user
     */
    public function generatePromocode()
    {
        $promocodeTypeName = 'Repeated';
        $userId = 0;

        if (\Auth::guard('persons')->user()){
            $promocodeTypeName = 'User';
            $userId = \Auth::guard('persons')->id();
        }

        $promoType = PromocodeType::where('name', $promocodeTypeName)->first();

        if (!is_null($promoType)) {
            $promocode = Promocode::create([
                'user_id' => $userId,
                'name' => $promoType->name.''.str_random(5),
                'type_id' => $promoType->id,
                'discount' => $promoType->discount,
                'valid_from' => date('Y-m-d'),
                'valid_to' => date('Y-m-d', strtotime(' + '.$promoType->period.' days')),
                'period' => $promoType->period,
                'treshold' => $promoType->treshold,
                'to_use' => 0,
                'times' => $promoType->times,
                'status' => 'valid',
                'user_id' => $userId
            ]);

            return self::$promocode = $promocode;
        }

        return self::$promocode = null;
    }
}

    foreach (Lang::all() as $lang) {
                foreach ($staticPages as $staticPage) {
                    $aSiteMap[$url.'/'.$lang->lang.'/'. $siteType . '/' .$staticPage] = [
                        'added' => time(),
                        'lastmod' => Carbon::now()->toIso8601String(),
                        'priority' => 1 - substr_count($url.'/'.$lang->lang.'/'.$staticPage, '/') / 10,
                        'changefreq' => 'always'
                    ];
                }
            }
        }

        foreach (Lang::all() as $lang) {
            if(count($pages) > 0) {
                foreach ($pages as $page) {
                    $aSiteMap[$url.'/'.$lang->lang.'/'. $siteType . '/'. $page->alias] = [
                        'added' => time(),
                        'lastmod' => Carbon::now()->toIso8601String(),
                        'priority' => 1 - substr_count($url.'/'.$page->alias, '/') / 10,
                        'changefreq' => 'always'
                    ];
                }
            }
        }

        foreach ($siteTypes as $key => $siteType) {
            foreach (Lang::all() as $lang) {
                if(count($categories) > 0) {
                    foreach ($categories as $category) {
                        if ($category->{$siteType} == 1) {
                            $aSiteMap[$url.'/'.$lang->lang.'/'. $siteType . '/catalog/'.$category->alias] = [
                                'added' => time(),
                                'lastmod' => Carbon::now()->toIso8601String(),
                                'priority' => 1 - substr_count($url.'/catalog/'.$category->alias, '/') / 10,
                                'changefreq' => 'always'
                            ];
                        }
                    }
                }
            }
        }

        foreach ($siteTypes as $key => $siteType) {
            foreach (Lang::all() as $lang) {
                if(count($products) > 0) {
                    foreach ($products as $product) {
                        if ($product->{$siteType} == 1 && $product->active == 1) {
                            $aSiteMap[$url.'/'.$lang->lang.'/'. $siteType .'/catalog/'.$product->category->alias.'/'.$product->alias] = [
                                'added' => time(),
                                'lastmod' => Carbon::now()->toIso8601String(),
                                'priority' => 1 - substr_count($url.'/catalog/'.$product->category->alias.'/'.$product->alias, '/') / 10,
                                'changefreq' => 'always'
                            ];
                        }
                    }
                }
            }
        }

        foreach ($siteTypes as $key => $siteType) {
            foreach (Lang::all() as $lang) {
                if(count($sets) > 0) {
                    foreach ($sets as $set) {
                        if ($set->{$siteType} == 1) {
                            if ($set->collection) {
                                $aSiteMap[$url.'/'.$lang->lang. '/' . $siteType. '/collection/'.$set->collection->alias] = [
                                    'added' => time(),
                                    'lastmod' => Carbon::now()->toIso8601String(),
                                    'priority' => 1 - substr_count($url.'/collection/'.$set->collection->alias, '/') / 10,
                                    'changefreq' => 'always'
                                ];
                            }
                        }

                    }
                }
            }
        }

        \Cache::put('sitemap', $aSiteMap, 2880);

        return Response::view('front.sitemap')->header('Content-Type', 'application/xml');
    }
}
