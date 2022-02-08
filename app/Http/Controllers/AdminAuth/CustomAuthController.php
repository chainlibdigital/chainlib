<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Cookie;

class CustomAuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post'))
            return $this->checkLogin();

        if (Auth::user()) {
            return redirect()->route('back');
        }

        return view('admin::auth.login', get_defined_vars());
    }

    public function checkLogin(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'login' => 'required|min:3',
            'password' => 'required|min:4',
        ]);

        if (Auth::attempt(array('login' => $request->get('login'), 'password' => $request->get('password')))){
            return redirect()->route('back');
        }
        return redirect()->back();
    }

    public function register() { }

    public function checkRegister() { }

    public function logout()
    {
        Auth::logout();
        return redirect('/back');
    }
}

Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
        \RenatoMarinho\LaravelPageSpeed\Middleware\InlineCss::class,
        \RenatoMarinho\LaravelPageSpeed\Middleware\ElideAttributes::class,
        \RenatoMarinho\LaravelPageSpeed\Middleware\InsertDNSPrefetch::class,
        \RenatoMarinho\LaravelPageSpeed\Middleware\RemoveComments::class,
        // \RenatoMarinho\LaravelPageSpeed\Middleware\TrimUrls::class,
        \RenatoMarinho\LaravelPageSpeed\Middleware\RemoveQuotes::class,
        \RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'auth_front' => \App\Http\Middleware\FrontAuthenticate::class,
        'sitemap' => \App\Http\Middleware\Sitemap::class
    ];
}


aynet" => "Paynet",
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
