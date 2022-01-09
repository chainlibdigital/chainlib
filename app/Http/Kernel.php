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
