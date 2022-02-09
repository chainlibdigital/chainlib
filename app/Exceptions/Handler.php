<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}

RING);
        $dataSet = array_values($orderHash);
        $dataSet[] = $secretKey;

        $signature = hash('sha256', implode(':', $dataSet));

        $client = new \GuzzleHttp\Client();
        $url = "https://payop.com/v1/invoices/create";

        $tokenPayop = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjE2MTExIiwiYWNjZXNzVG9rZW4iOiJmYmE5ZTJkNTZhOWQwNGU5MDA2ODhiYmIiLCJ0b2tlbklkIjoiMjA4Iiwid2FsbGV0SWQiOiI4MjY0IiwidGltZSI6MTU3Nzc4NjkxNSwiZXhwaXJlZEF0IjoxNTg1Njg4NDAwLCJyb2xlcyI6W119.toEBTY107EeiAAnXz1KEYiMf-q7RcBUS0LiwDPYOcNM";

        $order = CRMOrders::find(self::$order->id);

        $request = $client->post($url, [
            'headers' => [
                    'Authorization' =>  "Bearer {$tokenPayop}",
                    'Content-Type' => 'application/json',
                ],
            'json' => [
                "publicKey" => 'application-1a421d0a-3ecc-42b5-9429-650b7fae882a',
                "order" => [
                        "id" => self::$order->id,
                        "amount" => $amount,
                        "currency" =>  "EUR",
                        "items" => [
                            [
                               "id" => "1",
                               "name" => "ds",
                               "price" => $amount
                           ],
                        ],
                        "description" => ""
                    ],
                    "signature" => $signature,
                    "payer" => [
                        "email" => self::$order->details->email,
                        "phone" => '+'. self::$order->details->code .' '. self::$order->details->phone,
                        "name" => self::$order->details->contact_name,
                        "extraFields" => []
                    ],
                    "paymentMethod" => $methodId,
                    "language" => "en",
                    "resultUrl" => url($this->lang->lang.'/order/payment/success/'.self::$order->id),
                    "failPath" =>  url($this->lang->lang.'/order/payment/fail/'.self::$order->id),
                ],
        ]);

        $invoceId = json_decode($request->getBody()->getContents());
        return redirect('https://payop.com/en/payment/invoice-preprocessing/'.$invoceId->data);
    }
}

      $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function pay()
    {
        try {
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item = new Item();
            $item->setName(self::$order->order_hash)
                 ->setCurrency('EUR')
                 ->setQuantity(1)
                 ->setPrice(self::$amount['main']['total']);

            $itemList = new ItemList();
            $itemList->setItems(array($item));

            $amount = new Amount();
            $amount->setCurrency('EUR')->setTotal(self::$amount['main']['total']);

            $transaction = new Transaction();

            $transaction->setAmount($amount)
                        ->setItemList($itemList)
                        ->setDescription('Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('status', ['orderId' => self::$order->id, 'payment' => self::$payment]))
                          ->setCancelUrl(URL::route('cancel-status', ['orderId' => self::$order->id, 'payment' => self::$payment]));

            $payment = new Payment();
            $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));

            try {
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                if (\Config::get('app.debug')) {
                    \Session::put('error', 'Connection timeout');
                    return redirect()->route('paywithpaypal');
                } else {
                    \Session::put('error', 'Some error occur, sorry for inconvenient');
                    return redirect()->route('paywithpaypal');
                }
            }

            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }

            Session::put('paypal_payment_id', $payment->getId());
            if (isset($redirect_url)) {
                return redirect()->away($redirect_url);
            }

            \Session::put('error', 'Unknown error occurred');
            return redirect()->route('paywithpaypal');
        } catch (\Exception $e) {
            $problem = "Payment Paypal error.";
            LogsHandler::save(debug_backtrace(), $problem, \Auth::guard('persons')->user());
            // Session::flash('payment-error', 'Payment error!');
            Session::flash('payment-error', trans('vars.Notifications.paymentErorTryCatch'));
            return redirect('/ro/order/payment/'. self::$order->id);
        }
    }

    /**
     * Paypal Callback Function
     */
    public function getPaymentStatus(Request $request, $orderId = null, $payment = null)
    {
        self::$order = CRMOrders::find($orderId);
        self::$payment = 'paypal';

        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            return $this->fail();
        }

        $payment = Payment::get($request->get('paymentId'), $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved')
        {
            $this->success();
            return redirect()->route('thanks', ['redirs' => 'success', 'checkout' => self::$order->id, 'promocode' => self::$promocode->id]);
        }

        return $this->fail();
    }

    public function getPaymentCancelStatus(Request $request, $orderId = null, $payment = null)
    {
        self::$order = CRMOrders::find($orderId);
        self::$payment = 'paypal';

        $this->fail(1, 'FB: canceled, PSP: Redirect back from Paypal', 'preorders');

        return redirect('/ro/order/payment/'. $orderId);
    }

    public function callBack(){}

}

          // "payop"  => "PayOp",
            // "paynet" => "Paynet",
        ];
    }

    /*********************************  Render Methods *************************
     *
     * Render checkout shipping page
     */
    public function renderCheckoutShipping()
    {
        $cart = new CartController();
        $carts = $cart->getCartItems();
        setcookie('redirect_status', 0, time() + 10000000, '/');

        return view('front.dynamic.order-shipping', compact('carts'));
    }

    /**
     * Render checkout payment page
     */
    public function renderCheckoutPayment($orderId)
    {
        $cart  = new CartController();
        $carts = $cart->getCartItems();
        $order = CRMOrders::where('id', $orderId)->where('step', 1)->first();

        if (is_null($order)) abort(404);

        return view('front.dynamic.order-payment', compact('order', 'carts'));
    }

    /**
     * Render thankyou page
     */
    public function renderThankyouPage(Request $request)
    {
        if (!$request->get('redirs'))   return abort(404);
        if (!$request->get('checkout')) return abort(404);

        $order = CRMOrders::where('id', $request->get('checkout'))->first();
        $promocode = Promocode::where('user_id', $request->get('promocode'))->first();

        return view('front.dynamic.thanks', compact('promocode', 'order'));
    }

    /**
     *  Handle preorder before click Pay button
     */
    public function handlePreorder($methodId, $amount, $orderId, $payment)
    {
        if (!array_key_exists($payment, $this->paymentMethods)) abort(404);

        if ($payment == "paypal") {
            $this->currency = $this->mainCurrency;
            Model::$currency = $this->currency->id;
            setcookie('currency_id', $this->currency->id, time() + 10000000, '/');
        }

        $order = CRMOrders::findOrFail($orderId);

        $this->checkOrderDiscount($order);
        $this->reserveProducts($order, $payment); //reserve products

        $order->update([
            'amount'        =>  $this->amount['personal']['total'],
            'payment_id'    =>  $this->paymentMethods[$payment],
            'label'         => 'FB: reserved, PSP: Redirect to ' . $this->paymentMethods[$payment],
            'main_status'   => 'preorders',
            'change_status_at' => date('d-m-Y h:i:s'),
        ]);

        $paymentHandler = new PaymentHandler($this->amount, $order, $payment);
        return $paymentHandler->handle(); //go to payment
    }

    /**
     * Check Order Discount
     */
    public function checkOrderDiscount($order)
    {
        $promocode = Promocode::where('name', @$_COOKIE['promocode'])->first();
        if (!is_null($promocode)) {
            $order->update([
                'discount' => $promocode->discount,
            ]);
            setcookie('promocode', '', time() + 10000000, '/');
            $promocode->update(['status' => 'expired']);
        }
    }

    /**
     * Count Amount
     */
     public function countAmount($order)
     {
         $amount['main'] = ['amount' => 0,'currency' => 0,'shipping' => 0,'discount' => 0, 'total' => 0];
         $amount['personal'] = ['amount' => 0,'currency' => 0,'shipping' => 0,'discount' => 0, 'total' => 0];

         foreach ($order->orderSubproducts as $key => $subproductItem) {
             $amount['main']['amount'] += $subproductItem->set_id ? $subproductItem->subproduct->product->mainPrice->set_price : $subproductItem->subproduct->product->mainPrice->price;
             $amount['personal']['amount'] += $subproductItem->set_id ? $subproductItem->subproduct->product->personalPrice->set_price : $subproductItem->subproduct->product->personalPrice->price;
         }
         foreach ($order->orderProducts as $key => $productItem) {
             $amount['main']['amount'] += $productItem->set_id ? $productItem->product->mainPrice->set_price : $productItem->product->mainPrice->price;
             $amount['personal']['amount'] += $productItem->set_id ? $productItem->product->personalPrice->set_price : $productItem->product->personalPrice->price;
         }

         $amount['main']['currency'] = $this->mainCurrency->abbr;
         $amount['main']['shipping'] = $order->shipping_price;
         $amount['main']['discount'] = $amount['main']['amount'] - ($amount['main']['amount'] - ($amount['main']['amount'] * $order->discount / 100));
         $amount['main']['total'] = $amount['main']['amount'] - $amount['main']['discount'] + $amount['main']['shipping'];
         $amount['personal']['currency'] = $this->currency->abbr;
         $amount['personal']['shipping'] = $order->shipping_price * $this->currency->rate;
         $amount['personal']['discount'] = $amount['personal']['amount'] - ($amount['personal']['amount'] - ($amount['personal']['amount'] * $order->discount / 100));
         $amount['personal']['total'] = $amount['personal']['amount'] - $amount['personal']['discount'] + $amount['personal']['shipping'];

         if ($order->details->email == 'emailMinPirce@email.com') {
             $amount['personal']['total'] = 0.3;
             $amount['main']['total'] = 0.3;
         }

         return $amount;
     }

    /**
     * Reserve Products
     */
    public function reserveProducts($order, $payment)
    {
        if ($order->products->count() == 0) {
            $cart = new CartController();
            $carts = $cart->getCartItems();

            foreach ($carts['products'] as $key => $product) {
                $order->products()->create([
                    'subproduct_id' => 0,
                    'product_id'    => $product->product_id,
                    'set_id'        => $product->from_set,
                    'qty'           => $product->qty,
                    'discount'      => $product->product->discount,
                    'code'          => $product->code,
                    'old_price'     => $product->product->personalPrice->old_price,
                    'price'         => !$product->from_set ? $product->product->personalPrice->price : $product->product->personalPrice->set_price,
                    'currency'      => $this->currency->abbr,
                ]);
            }

            foreach ($carts['subproducts'] as $key => $subproduct) {
                $order->products()->create([
                    'subproduct_id' => $subproduct->subproduct_id,
                    'product_id'    => $subproduct->product_id,
                    'set_id'        => $subproduct->from_set,
                    'qty'           => $subproduct->qty,
                    'discount'      => $subproduct->product->discount,
                    'code'          => $subproduct->subproduct->code,
                    'old_price'     => $subproduct->product->personalPrice->old_price,
                    'price'         => $subproduct->product->personalPrice->price,
                    'price'         => !$subproduct->from_set ? $subproduct->product->personalPrice->price : $subproduct->product->personalPrice->set_price,
                    'currency'      => $this->currency->abbr,
                ]);
            }

            $this->amount = $this->countAmount($order);
            $frisbo = new Frisbo();
            return $frisbo->reserveProducts($order, $payment, $this->amount);
        }else{
            $this->amount = $this->countAmount($order);
        }

        return false;
    }

    /*********************************  AJAX Methods *************************
     *
     * Render checkout shipping page
     */
    public function storeShippingDetails(Request $request)
    {
        $user       = $this->checkIfLogged();
        $country    = Country::find($request->get('country'));
        $currency   = Currency::where('abbr', $request->get('cartData')['currency'])->first();
        $delivery   = Delivery::find($request->get('cartData')['delivery']);
        $payment    = Payment::find($request->get('payment'));
        $promocode  = Promocode::where('name', @$request->get('cartData')['promocode'])->first();
        $shippingPrice = 0;

        if (!is_null($delivery)) {
            $shippingPrice = $delivery->price * $this->currency->rate;
            $shippingPrice = $delivery->price;
        }

        if ($user['status'] == 'auth') {
            $frontUser = FrontUser::find($user['user_id']);
            FrontUser::where('id', $frontUser->id)->update([
                'name' => $frontUser->name ? $frontUser->name : $request->get('name'),
                'email' => $frontUser->email ? $frontUser->email : $request->get('email'),
                'phone' => $frontUser->phone ? $frontUser->phone : $request->get('phone'),
                'code' => $frontUser->code ? $frontUser->code : $request->get('code'),
            ]);
        }else{
            $frontGuest = FrontUserUnlogged::where('user_id', $user['user_id'])->first();
            FrontUserUnlogged::where('id', $frontGuest->id)->update([
                'name' => $frontGuest->name ? $frontGuest->name : $request->get('name'),
                'email' => $frontGuest->email ? $frontGuest->email : $request->get('email'),
                'phone' => $frontGuest->phone ? $frontGuest->phone : $request->get('phone'),
                'code' => $frontGuest->code ? $frontGuest->code : $request->get('code'),
            ]);
        }

        $order = CRMOrders::create([
            'order_hash'        => 2000 + CRMOrders::count(),
            'user_id'           => $user['status'] == 'auth' ? $user['user_id'] : 0,
            'guest_user_id'     => $user['status'] == 'guest' ? $user['guest_id'] : 0,
            'promocode_id'      => !is_null($promocode) ? $promocode->id : null,
            'currency_id'       => !is_null($currency) ? $currency->id : null,
            'delivery_id'       => $request->get('cartData')['delivery'],
            'country_id'        => $request->get('country'),
            'amount'            => $request->get('cartData')['amount'],
            'shipping_price'    => $shippingPrice,
            'main_status'       => 'preorders',
            'change_status_at'  => date('Y-m-d'),
            'step'              => 1,
            'label'             => 'With shipping details',
        ]);

        $order->details()->create([
            'contact_name'      => $request->get('name'),
            'email'             => $request->get('email'),
            'promocode'         => !is_null($promocode) ? $promocode->name : null,
            'code'              => $request->get('phone_code'),
            'phone'             => $request->get('phone'),
            'currency'          => @$currency->abbr,
            'payment'           => @$payment->translation->name,
            'delivery'          => @$delivery->translation->name,
            'country'           => @$country->translation->name,
            'region'            => $request->get('region'),
            'city'              => $request->get('city'),
            'address'           => $request->get('address'),
            'apartment'         => $request->get('apartment'),
            'zip'               => $request->get('zip'),
            'delivery_price'    => @$delivery->price,
            'tax_price'         => $request->get('cartData')['tax'],
        ]);

        return $order->id;
    }

    /**
     *   Get user data action
     */
    public function getUser(Request $request)
    {
        $country = Country::find(@$_COOKIE['country_id']);
        $data['country'] = $country->id;

        if (\Auth::guard('persons')->user()){
            $data['mode'] = "auth";
            $data['frontUser'] = \Auth::guard('persons')->user();
            $data['phone_code'] = $country->phone_code;
            $data['phone'] = $data['frontUser']->phone;
            $data['payment_id'] = $data['frontUser']->payment_id;
        }else{
            $data['mode'] = "guest";
            $data['frontUser'] = FrontUserUnlogged::where('user_id', @$_COOKIE['user_id'])->first();
            $data['phone_code'] = $country->phone_code;
            $data['phone'] = $data['frontUser']->phone;
            $data['payment_id'] = 0;
        }

        return $data;
    }

    /**
     *  Change country action
     */
    public function changeCountry(Request $request)
    {
        $data['country'] = Country::with([
                        'translation',
                        'deliveries.delivery.translation',
                        'mainDelivery',
                        'payments.payment.translation'
                    ])
                    ->where('id', $request->get('countryId'))
                    ->where('active', 1)
                    ->first();

        if (!is_null($data['country']->mainDelivery)) {
            setcookie('warehouse_id', $data['country']->warehouse_id, time() + 10000000, '/');
            setcookie('country_id', $data['country']->id, time() + 10000000, '/');
            setcookie('delivery_id', $data['country']->mainDelivery->id, time() + 10000000, '/');
            // setcookie('currency_id', $data['country']->currency->id, time() + 10000000, '/');
        }

        Model::$warehouse = $data['country']->warehouse_id;
        // Model::$currency = $data['country']->currency_id;

        // $data['currency'] = $data['country']->currency->abbr;
        // $cart = new CartController();
        // $data['carts'] = $cart->getCartItems();
        return $data;
    }

    /**
     * Valiadate Stocks
     */
    public function validateStocks(Request $request)
    {
        $frisbo = new Frisbo();
        $cart = new CartController();

        try {
            $frisbo->synchronizeStocks();
        } catch (\Exception $e) {
            $problem = "Frisbo Synchronize Stocks on validate error.";
            LogsHandler::save(debug_backtrace(), $problem, \Auth::guard('persons')->user());
        }

        $data['carts'] = $cart->getCartItems();
        $data['inactiveCarts'] = $cart->getInactiveCartItems();

        // $cart->validateStocks($this->userId);
        // $data['changedCarts'] =  $cart->getChangedQtyCartItems();

        return $data;
    }

    /**
     * Check if user is logged
     */
    public function checkIfLogged()
    {
        if(auth('persons')->guest()) {
            $guest = FrontUserUnlogged::where('user_id', @$_COOKIE['user_id'])->first();
            if (!is_null($guest)) {
                return array('is_logged' => 1, 'user_id' => @$_COOKIE['user_id'], 'status' => 'guest', 'guest_id' => $guest->id);
            }else{
                return array('is_logged' => 0, 'user_id' => @$_COOKIE['user_id'], 'status' => 'user');
            }
        }

        return array('is_logged' => 1, 'user_id' => auth('persons')->id(), 'status' => 'auth');
    }
}
