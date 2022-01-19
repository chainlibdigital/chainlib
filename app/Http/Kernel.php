<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
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


() + 10000000, '/');
        }
    }

    /**
     * Render Cart Page
     */
    public function index()
    {
        $pageItem = new PageItem;
        $seoData = $pageItem->getPageByAlias('cart');

        return view('front.dynamic.cart', compact('seoData'));
    }

    /**
     * Get Items List Products
     */
     public function getCartItems()
     {
         $this->validateStocks($this->userId);
         $data['products'] = Cart::with(['product.mainPrice', 'product.personalPrice', 'product.translation', 'product.mainImage', 'product.category'])
                                       ->where('user_id', $this->userId)
                                       ->where('product_id', '!=', null)
                                       ->where('subproduct_id',  0)
                                       ->orderBy('id', 'desc')
                                       ->where('active', 1)
                                       ->get();

         $data['subproducts'] = Cart::with(['subproduct.price', 'subproduct.product.mainPrice', 'subproduct.product.personalPrice', 'subproduct.product.translation', 'subproduct.product.mainImage', 'subproduct.product.category', 'subproduct.parameterValue.translation'])
                                     ->where('user_id', $this->userId)
                                     ->where('subproduct_id', '!=', 0)
                                     ->orderBy('id', 'desc')
                                     ->where('active', 1)
                                     ->get();
         return $data;
     }

     /**
      * Get Items List Products
      */
      public function getInactiveCartItems()
      {
          $data['products'] = Cart::with(['product.mainPrice', 'product.personalPrice', 'product.translation', 'product.mainImage', 'product.category'])
                                        ->where('user_id', $this->userId)
                                        ->where('product_id', '!=', null)
                                        ->where('subproduct_id',  0)
                                        ->orderBy('id', 'desc')
                                        ->where('active', 0)
                                        ->get();

          $data['subproducts'] = Cart::with(['subproduct.price', 'subproduct.product.mainPrice', 'subproduct.product.personalPrice', 'subproduct.product.translation', 'subproduct.product.mainImage', 'subproduct.product.category', 'subproduct.parameterValue.translation'])
                                      ->where('user_id', $this->userId)
                                      ->where('subproduct_id', '!=', 0)
                                      ->orderBy('id', 'desc')
                                      ->where('active', 0)
                                      ->get();
          return $data;
      }

      /**
       * Get Items List Products
       */
       public function getChangedQtyCartItems()
       {
           $data['products'] = Cart::with(['product.mainPrice', 'product.personalPrice', 'product.translation', 'product.mainImage', 'product.category'])
                                         ->where('user_id', $this->userId)
                                         ->where('product_id', '!=', null)
                                         ->where('subproduct_id',  0)
                                         ->orderBy('id', 'desc')
                                         ->where('qty_changed', 1)
                                         ->get();

           $data['subproducts'] = Cart::with(['subproduct.price', 'subproduct.product.mainPrice', 'subproduct.product.personalPrice', 'subproduct.product.translation', 'subproduct.product.mainImage', 'subproduct.product.category', 'subproduct.parameterValue.translation'])
                                       ->where('user_id', $this->userId)
                                       ->where('subproduct_id', '!=', 0)
                                       ->orderBy('id', 'desc')
                                       ->where('active', 1)
                                       ->where('qty_changed', 1)
                                       ->get();
           return $data;
       }

    /********************************** AJAX METHODS ***************************
     *
     * Add to cart action
     */
    public function addProductToCart(Request $request)
    {
        $product = Product::findOrFail($request->get('productId'));

        if ($product->subproducts->count() > 0) {
            $subproduct = SubProduct::findOrFail($request->get('subproductId'));
            $cart = Cart::where('user_id', $this->userId)
                        ->where('subproduct_id', $request->get('subproductId'))
                        ->first();

            if (is_null($cart)) {
                Cart::create([
                    'product_id' => $product->id,
                    'subproduct_id' => $subproduct->id,
                    'user_id' => $this->userId,
                    'qty' => 1,
                ]);
            }else{
                if ($subproduct->warehouse->stock > $cart->qty) {
                    Cart::where('id', $cart->id)->update([ 'qty' =>  $cart->qty + 1 ]);
                }
            }
        }else{
            $cart = Cart::where('user_id', $this->userId)->where('from_set', 0)->where('subproduct_id', 0)->where('product_id', $product->id)->first();

            if (is_null($cart)) {
                Cart::create([
                    'product_id' => $product->id,
                    'subproduct_id' => 0,
                    'user_id' => $this->userId,
                    'qty' => $request->get('qty') ?? 1,
                ]);
            }else{
                if ($product->warehouse) {
                    if ($product->warehouse->stock > $cart->qty) {
                        Cart::where('id', $cart->id)->update([ 'qty' =>  $cart->qty + 1 ]);
                    }
                }
            }
        }
        return $this->getCartItems();
    }

    public function addSetToCart(Request $request)
    {
        $set = Set::findOrFail($request->get('setId'));

        if ($set->bijoux) {
            foreach ($set->products as $key => $product) {
                $cart = Cart::where('user_id', $this->userId)
                            ->where('from_set', $set->id)
                            ->where('subproduct_id', 0)
                            ->where('product_id', $product->id)
                            ->first();

                if (is_null($cart)) {
                    if (is_null($cart)) {
                        if ($product->warehouse->stock > 0) {
                            Cart::create([
                                'product_id' => $product->id,
                                'subproduct_id' => 0,
                                'from_set' => $set->id,
                                'user_id' => $this->userId,
                                'qty' => 1,
                            ]);
                        }
                    }else{
                        if ($product->warehouse) {
                            if ($product->warehouse->stock > $cart->qty) {
                                Cart::where('id', $cart->id)->update([ 'qty' =>  $cart->qty + 1 ]);
                            }
                        }
                    }
                }
            }
        }

        return $this->getCartItems();
    }

    public function addMixSetToCart(Request $request)
    {
        $set = Set::findOrFail($request->get('setId'));
        $data = array_filter($request->get('data'), function($var){return !is_null($var);} );

        foreach ($data as $key => $value) {
            $findProduct = Product::where('id', $key)->first();
            if (!is_null($findProduct)) {
                if ($value) {
                    $findSubProduct = SubProduct::where('id', $value)->first();
                    $cart = Cart::where('user_id', $this->userId)
                                        ->where('from_set', $set->id)
                                        ->where('subproduct_id', 0)
                                        ->where('product_id', $findProduct->id)
                                        ->where('subproduct_id', $findSubProduct->id)
                                        ->first();

                    if (is_null($cart)) {
                        if ($findSubProduct->warehouse->stock > 0) {
                            Cart::create([
                                'product_id' => $findProduct->id,
                                'subproduct_id' => $findSubProduct->id,
                                'from_set' => $set->id,
                                'user_id' => $this->userId,
                                'qty' => 1,
                            ]);
                        }
                    }else{
                        if ($findSubProduct->warehouse) {
                            if ($findSubProduct->warehouse->stock > $cart->qty) {
                                Cart::where('id', $cart->id)->update([ 'qty' =>  $cart->qty + 1 ]);
                            }
                        }
                    }
                }else{
                    $cart = Cart::where('user_id', $this->userId)
                                        ->where('from_set', $set->id)
                                        ->where('subproduct_id', 0)
                                        ->where('product_id', $findProduct->id)
                                        ->first();
                    if (is_null($cart)) {
                        if ($findProduct->warehouse->stock > 0) {
                            Cart::create([
                                'product_id' => $findProduct->id,
                                'subproduct_id' => 0,
                                'from_set' => $set->id,
                                'user_id' => $this->userId,
                                'qty' => 1,
                            ]);
                        }
                    }else{
                        if ($findProduct->warehouse) {
                            if ($findProduct->warehouse->stock > $cart->qty) {
                                Cart::where('id', $cart->id)->update([ 'qty' =>  $cart->qty + 1 ]);
                            }
                        }
                    }
                }
            }
        }

        return $this->getCartItems();
    }

    /**
     * Change product qty action
     */
    public function changeProductQty(Request $request)
    {
        Cart::where('id', $request->get('cartId'))->update([
            'qty' => $request->get('qty'),
        ]);

        return $this->getCartItems();
    }

    /**
     *  Delete product action
     */
    public function deleteProductFromCart(Request $request)
    {
        Cart::where('id', $request->get('cartId'))->delete();

        return $this->getCartItems();
    }

    /**
     * Delete all products action
     */
    public function removeAllCart()
    {
        Cart::where('user_id', $this->userId)->delete();

        return $this->getCartItems();
    }

    /**
     *  Disable set discount
     */
    public function diableSetDiscount(Request $request)
    {
        $cart = Cart::findOrFail($request->get('cartId'));
        $cart->delete();

        $setCarts = Cart::where('user_id', $this->userId)
                    ->where('from_set', $cart->from_set)
                    ->get();

        foreach ($setCarts as $key => $setCart) {
            $checkCart = Cart::where('user_id', $this->userId)
                            ->where('from_set', 0)
                            ->where('product_id', $setCart->product->id)
                            ->first();

            if (!is_null($checkCart)) {
                $checkCart->update(['qty' => $checkCart->qty + 1]);
                $setCart->delete();
            }
            $setCart->update(['from_set' => 0]);
        }

        return $this->getCartItems();
    }

    /**
     * Move product to favorites
     */
    public function moveProductToWish(Request $request)
    {
        $cartProduct = Cart::findOrFail($request->get('cartId'));
        $checkWish = WishList::where('user_id', $this->userId)->where('product_id', $cartProduct->product_id)->first();

        if (is_null($checkWish)) {
            WishList::create([
                'product_id' => $cartProduct->product_id,
                'subproduct_id' => $cartProduct->subproduct ? $cartProduct->subproduct_id : null,
                'user_id' => $this->userId,
            ]);
        }

        $cartProduct->delete();

        $wishList = new WishListController;
        $data['cartProducts'] = $this->getCartItems();
        $data['wishProducts'] = $wishList->getwishItems();

        return $data;
    }

    /************************************ PROMOCODE ****************************
     *
     *  Check promocode action
     */
     public function checkPromocode(Request $request)
     {
         if (@$_COOKIE['promocode']) {
             $promocode = Promocode::where('name', @$_COOKIE['promocode'])
                                     ->where(function($query){
                                         $query->where('status', 'valid');
                                         $query->orWhere('status', 'partially');
                                     })
                                     ->first();

             return $this->validatePromoCode($promocode, $request->get('amount'));
         }
         return 'false';
     }

     /**
      * Apply promocode action
      */
     public function applyPromocode(Request $request)
     {
         $promocode = Promocode::where('name', $request->get('promocode'))
                                 ->where(function($query){
                                     $query->where('status', 'valid');
                                     $query->orWhere('status', 'partially');
                                 })
                                 ->first();

         if (!is_null($promocode)) {
             $promocodeName = $promocode->name;
             setcookie('promocode', $promocodeName, time() + 10000000, '/');
         }

         return $this->validatePromoCode($promocode, $request->get('amount'));
     }

     /**
      * Validate promocode action
      */
     public function validatePromoCode($promocode, $amount)
     {
         $message = [];
         if (is_null($promocode)) {
             setcookie('promocode', '', time() + 10000000, '/');
             return $message = [
                 "name" => "",
                 "body" => trans('vars.Promocode.promoCodeNotValid'),
                 "status" => "false",
                 "discount" => "0",
             ];
         }
         if ($promocode->treshold > $amount) {
             setcookie('promocode', '', time() + 10000000, '/');
             return $message = [
                 "name" => $promocode->name,
                 "body" => trans('vars.Promocode.promoCommand') .' '. $promocode->treshold .' EUR',
                 "status" => "false",
                 "discount" => "0",
             ];
         }
         if ($promocode->user_id > 0 && $promocode->user_id !== $this->userId) {
             setcookie('promocode', '', time() + 10000000, '/');
             return $message = [
                 "name" => $promocode->name,
                 "body" => trans('vars.Notifications.promocodeWrongUser'),
                 "status" => "false",
                 "discount" => "0",
             ];
         }
         return $message = [
             "name" => $promocode->name,
             "body" => "Success",
             "status" => "true",
             "discount" => $promocode->discount,
         ];
     }

     /************************************ COUNTRY/SHIPPING ********************
      *
      * Get active countries list action
      */
     public function getCountries()
     {
         $userCountryId = @$_COOKIE['country_id'];
         $userDelivery  = @$_COOKIE['delivery_id'];

         $countryRelationships = ['translation', 'deliveries.delivery.translation', 'mainDelivery', 'payments', 'payments.payment.translation'];

         $data['countries'] = Country::with($countryRelationships)->where('active', 1)->get();
         $currentCountry = Country::with($countryRelationships)->where('id', $userCountryId)->first();

         if (is_null($currentCountry) || is_null($currentCountry->mainDelivery)){
             $data['currentCountry'] = Country::with($countryRelationships)->where('main', 1)->first();
             $data['mainDelivery'] = $data['currentCountry']->mainDelivery->id;
         }else{
             $data['currentCountry'] = $currentCountry;
             $data['mainDelivery'] = $currentCountry->mainDelivery->id;
         }
         $data['currencies'] = Currency::where('active', 1)->get();
         $data['currency'] = $this->currency;

         return $data;
     }

     /**
      * Set user country and delivery action
      */
     public function setCountryDelivery(Request $request)
     {
         setcookie('country_id', $request->get('country'), time() + 10000000, '/');
         setcookie('delivery_id', $request->get('delivery'), time() + 10000000, '/');
         setcookie('redirect_status', 1, time() + 10000000, '/');
     }

     /**
      * Change user country
      */
     public function changeCountry(Request $request)
     {
         $country = Country::findOrFail($request->get('countryId'));

         if (!is_null($country->mainDelivery)) {
             setcookie('warehouse_id', $country->warehouse_id, time() + 10000000, '/');
             setcookie('country_id', $country->id, time() + 10000000, '/');
             setcookie('delivery_id', $country->mainDelivery->id, time() + 10000000, '/');
             // setcookie('currency_id', $country->currency->id, time() + 10000000, '/');
         }

         Model::$warehouse = $country->warehouse_id;
         // Model::$currency = $country->currency_id;

         $data['carts'] = $this->getCartItems();
         // $data['currency'] = $country->currency->abbr;
         return $data;
     }

     public function changeCurrency(Request $request)
     {
         $currency = Currency::findOrFail($request->get('currencyId'));

         if (!is_null($currency)) {
             setcookie('currency_id', $currency->id, time() + 10000000, '/');
         }

         Model::$currency = $currency->id;
         $this->currency = $currency;

         $data['carts'] = $this->getCartItems();
         $data['currency'] = $currency->abbr;

         return $data;
     }

    /************************************ STOCK VALIDATION *********************
     *
     *  Check products/subproducts stocks
     */
    public function validateStocks($userId)
    {
        $data['products'] = Cart::where('user_id', $userId)->where('subproduct_id',  0)->get();
        $data['subproducts'] = Cart::where('user_id', $userId)->where('subproduct_id', '!=', 0)->get();

        if (count($data['products']) > 0) {
            foreach ($data['products'] as $key => $product) {
                $this->validateProductStock($product);
            }
        }
        if (count($data['subproducts']) > 0) {
            foreach ($data['subproducts'] as $key => $subproduct) {
                $this->validateSubproductStock($subproduct);
            }
        }

        foreach ($data['products'] as $key => $product) {
            if ($product->qty == 0) $product->update(['active' > 0]);
        }

        foreach ($data['subproducts'] as $key => $subproduct) {
            if ($subproduct->qty == 0) $subproduct->update(['active' > 0]);
        }
    }

     /**
      * Validate product stocks
      */
     private function validateProductStock($productCart)
     {
         $productStock = $productCart->qty;

         $prodStock = Product::find($productCart->product_id)->warehouse->stock;
         $stock_qty = $prodStock;
         $qty  = $productStock;
         $qtyChanged = 0;

         if ($prodStock < $productStock) {
             $qty = $prodStock;
             $qtyChanged = 1;
         }

         $productCart->update(['stock_qty' => $stock_qty, 'qty' => $qty, 'qty_changed' => $qtyChanged]);
     }

     /**
      * Valiadate subproducts stocks
      */
     private function validateSubproductStock($subproductCart)
     {
         $productStock = $subproductCart->qty;

         $subprodStock = SubProduct::find($subproductCart->subproduct_id)->warehouse->stock;

         $stock_qty = $subprodStock;
         $qty = $productStock;
         $qtyChanged = 0;

         if ($subprodStock < $productStock) {
             $qty = $prodStock;
             $qtyChanged = 1;
         }

         $subproductCart->update(['stock_qty' => $stock_qty, 'qty' => $qty, 'qty_changed' => $qtyChanged]);
     }

     /**
      * Exchange shipping price
      */
     public function exchangeShippingPrice(Request $request)
     {
         $price = $request->get('price');
         $currencyAbbr =  $request->get('currency');

         $currencyAbbr =  $this->currency->abbr;
         $exchangedPrice = $price;

         if ($request->get('currencyId')) {
             $currency = Currency::where('id', $request->get('currencyId'))->first();
         }else{
             $currency = Currency::where('abbr', $currencyAbbr)->first();
         }

         if (!is_null($currency)) {
             $exchangedPrice = $price * $currency->rate;
         }

        return $exchangedPrice;
     }
}

   ]);

        if ($validator->fails()) {
            $data['status'] = 'false';
            $data['errors'] = $validator->errors()->all();
            return $data;
        }

        if (Auth::guard('persons')->attempt($request->all())) {
            $data['status'] = 'true';
        }else {
            $data['status'] = 'false';
            $data['errors'] = [trans('front.login.error')];
        }

        return $data;
    }

    /**
     * Register User
     */
    public function register(Request $request)
    {
        $code = $request->get('code');
        $data['redirect'] = url('/'.$this->lang->lang.'/account/cart');

        if (@$_COOKIE['redirect_status']) {
            $data['redirect'] = url('/'.$this->lang->lang.'/order');
            setcookie('redirect_status', 0, time() + 10000000, '/');
        }

        $validator = validator($request->all(), [
            'email' => 'required|unique:front_users',
            'name'  => 'required|min:3',
            'phone' => 'required|min:3',
            'password' => 'required|min:4',
            'agree' => 'required'
        ]);

        if ($validator->fails()) {
            $data['status'] = 'false';
            $data['errors'] = $validator->errors()->all();
            return $data;
        }

        $user = FrontUser::create([
            'lang_id'       => $this->lang->id,
            'country_id'    => $this->country->id,
            'currency_id'   => $this->currency->id,
            'name'          => $request->get('name'),
            'phone'         => '+'.@$code['phone_code'].' '.$request->get('phone'),
            'email'         => $request->get('email'),
            'customer_type' => $request->get('consumerType'),
            'company'       => $request->get('company'),
            'password'      => bcrypt($request->get('password')),
            'remember_token'=> $request->get('_token')
        ]);

        Auth::guard('persons')->login($user);

        $data['name'] = $user->name;
        $subject = trans('vars.Email-templates.emailRegistrationSubject').'info@soledy.com';
        $template = "mails.auth.register";

        $mail = new MailHandler();
        $mail->sendEmail($data, $request->get('email'), $subject, $template);

        return $data;
        // return response()->json(['user'=> Auth::guard('persons')->user()], 200);
    }

    /**
     * Login as Guest
     */
    public function loginAsGuest(Request $request)
    {
        $frontUser = FrontUserUnlogged::where('user_id', @$_COOKIE['user_id'])->first();

        if (is_null($frontUser)) {
            $frontUser = FrontUserUnlogged::create([
                'user_id' => @$_COOKIE['user_id'],
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'lang_id'       => $this->lang->id,
                'country_id'    => $this->country->id,
                'currency_id'   => $this->currency->id,
            ]);
        }

        $data['status'] = 'true';
        return $data;
    }

    /**
    *  Authorization with google and facebook
    */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
    *  Callback authorization with google and facebook
    */
    public function handleProviderCallback($provider)
    {
        $redirect = 'false';

        if (@$_COOKIE['redirect_status']) {
            $redirect = url('/'.$this->lang->lang.'/order');
            setcookie('redirect_status', 0, time() + 10000000, '/');
        }

        $user = Socialite::driver($provider)->user();
        $checkUser = FrontUser::where('email', $user->getEmail())->first();

        if (is_null($checkUser)) {
            $authUser = FrontUser::where($provider, $user->getId())->first();
            if (is_null($authUser)) {
                $authUser = FrontUser::create([
                    'lang_id'       => $this->lang->id,
                    'country_id'    => $this->country->id,
                    'currency_id'   => $this->currency->id,
                    'email'         => $user->getEmail(),
                    'name'          => $user->getName(),
                     $provider      => $user->getId(),
                    'remember_token' => $user->token,
                ]);
            }
        }else{
            $checkUser->update([ $provider => $user->getId() ]);
            $authUser = FrontUser::where('email', $user->getEmail())->first();
        }

        Auth::guard('persons')->login($authUser);

        if (@$_COOKIE['redirect_status']) {
            setcookie('redirect_status', 0, time() + 10000000, '/');
            return redirect('/' . @$_COOKIE['lang_id'] . '/order');
        }

        return redirect('/' . @$_COOKIE['lang_id'] . '/account/cart');
    }

    /**
     * Logout User
     */
    public function logout()
    {
        Auth::guard('persons')->logout();

        setcookie('promocode', '', time() + 10000000, '/');

        return redirect('/'.$this->lang->lang);
    }


    /*******************************   Forget Password   ***********************
     * Send code to mail
     */
    public function sendEmailCode(Request $request)
    {
        $user = FrontUser::where('email', $request->get('email'))->first();

        if (!is_null($user)) {
            session()->put(['code' => str_random(4), 'user_id' => $user->id]);
            $data["code"] = session('code');
            $subject = "Reset Password";
            $template = "mails.auth.forgetPassword";

            $mail = new MailHandler();
            $mail->sendEmail($data, $request->get('email'), $subject, $template);
            $data['status'] = "true";
        }else{
            $data['status'] = "false";
            $data['error'] = trans('front.forgotPass.error');
        }

        return $data;
    }

    /**
     * Confirm code
     */
    public function confirmEmailCode(Request $request)
    {
        $validator = validator($request->all(), [
            'code' => 'required|in:'.session('code')
        ]);

        if ($validator->fails()) {
            $data['status'] = 'false';
            $data['error'] = $validator->errors()->all();
            return $data;
        }

        $data['status'] = 'true';
        return $data;
    }

    /**
     * Change password
     */
    public function changePassword(Request $request)
    {
        $validator = validator($request->all(), [
            'password' => 'required|min:3',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()], 400);
        }

        $user = FrontUser::find(session('user_id'));

        if(!is_null($user)){
            $user->password = bcrypt($request->get('password'));
            $user->remember_token = $request->get('_token');
            $user->save();

            session()->forget('code');
            session()->forget('user_id');

            $data['status'] = "true";
            Auth::guard('persons')->login($user);
        }else{
            $data['status'] = "false";
        }

        return $data;
    }

    public function checkAuth()
    {
        $userdata = FrontUser::find(Auth::guard('persons')->id());
        return response()->json(['userdata' => $userdata]);
    }

    public function getPhoneCodesList()
    {
        $data['countries'] = Country::where('active', 1)->get();

        $currentCountry = Country::where('id', @$_COOKIE['country_id'])->first();
        if (is_null($currentCountry)) {
            $currentCountry = Country::where('main', 1)->first();
        }

        $data['currentCountry'] = $currentCountry;

        return $data;
    }
}

nt::__construct();

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



, 401);
            } else {
                return redirect()->guest(Request::segment(1).'/login');
            }
        }

        return $next($request);
    }
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





:where('user_id', $userdata['user_id'])->get();
        return $data;
    }

    public function addSetToWish(Request $request)
    {
        $userdata = $this->checkIfLogged();

        $wishSet = WishListSet::where('set_id', $request->get('setId'))->where('user_id', $userdata['user_id'])->first();

        if (is_null($wishSet)) {
            WishListSet::create([
                'set_id' => $request->get('setId'),
                'user_id' => $userdata['user_id'],
            ]);
        }

        return $this->getWishItems();
    }


    /**
     *  private method
     *  Check if user is logged
     */
    private function checkIfLogged() {
        if(auth('persons')->guest()) {
            return array('is_logged' => 0, 'user_id' => $_COOKIE['user_id']);
        } else {
            return array('is_logged' => 1, 'user_id' => auth('persons')->id());
        }
    }
}

