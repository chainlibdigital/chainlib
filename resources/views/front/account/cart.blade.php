@extends('front.app')
@section('content')
@include('front.partials.header')
<main class="clientArea">
    <div class="container">
    <div class="row">

        <div class="col-12">
            <div class="user">
                <p>{{ trans('vars.General.hello') }}, {{ $userdata->name }}</p>
                <p>{{ trans('vars.Cabinet.welcomeTo') }} {{ trans('vars.Cabinet.yourCart') }}</p>
            </div>
        </div>
        <div class="col-12">
            <div class="navArea" id="navArea">
                <div id="pageSelected">
                    {{ trans('vars.Cabinet.yourCart') }}
                    <svg
                        width="12px"
                        height="6px"
                        viewBox="0 0 12 6"
                        version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        >
                        <g id="AnaPopova-Site" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g
                                id="Cabinet_Mob._375-cos"
                                transform="translate(-325.000000, -156.000000)"
                                fill="#B22D00"
                                fill-rule="nonzero"
                                >
                                <polygon
                                    id="Shape"
                                    transform="translate(331.000000, 159.000000) scale(1, -1) translate(-331.000000, -159.000000) "
                                    points="331 156 325 162 330.716323 162 337 162"
                                    ></polygon>
                            </g>
                        </g>
                    </svg>
                </div>
                @include('front.account.accountMenu')
            </div>
        </div>
        <div class="col-12">
            <div class="myCart">
                <div class="row productsList">
                    <div class="col-12">
                        @if ($carts['products'])
                        @foreach ($carts['products'] as $key => $cartProd)
                        <div class="cartItem">
                            <a class="img" href="{{ url('/'.$lang->lang.'/catalog/'.$cartProd->product->category->alias.'/'.$cartProd->product->alias) }}">
                            @if ($cartProd->product->mainImage)
                            <img src="/images/products/sm/{{ $cartProd->product->mainImage->src }}" alt="" />
                            @else
                            <img src="/fronts/img/prod/oneProduct.jpg" alt="" />
                            @endif
                            </a>
                            <div class="description">
                                <a href="{{ url('/'.$lang->lang.'/catalog/'.$cartProd->product->category->alias.'/'.$cartProd->product->alias) }}">
                                {{ $cartProd->product->translation->name }}
                                </a>
                                <div class="price">
                                    @if ($cartProd->from_set)
                                        <span>{{ $cartProd->product->personalPrice->set_price }} {{ $currency->abbr }}</span>
                                        <br> <span>{{ $cartProd->product->personalPrice->old_price }} {{ $currency->abbr }}</span>
                                    @else
                                        <span>{{ $cartProd->product->personalPrice->price }} {{ $currency->abbr }}</span>
                                        @if ($cartProd->product->personalPrice->price !== $cartProd->product->personalPrice->old_price)
                                            <br> <span>{{ $cartProd->product->personalPrice->old_price }} {{ $currency->abbr }}</span>
                                        @endif
                                    @endif
                                </div>
                                <div class="params">
                                    <span>{{ trans('vars.Cabinet.qty') }}: <span class="qtyBox">{{ $cartProd->qty }}</span></span>
                                </div>
                                <div class="methods">
                                    <div class="addToWish">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @if ($carts['subproducts'])
                        @foreach ($carts['subproducts'] as $key => $cart)
                        <div class="cartItem">
                            <a class="img" href="{{ url('/'.$lang->lang.'/catalog/'.$cart->subproduct->product->category->alias.'/'.$cart->subproduct->product->alias) }}">
                            @if ($cart->subproduct->product->mainImage)
                            <img src="/images/products/sm/{{ $cart->subproduct->product->mainImage->src }}" alt="" />
                            @else
                            <img src="/fronts/img/prod/oneProduct.jpg" alt="" />
                            @endif
                            </a>
                            <div class="description">
                                <a href="{{ url('/'.$lang->lang.'/catalog/'.$cart->subproduct->product->category->alias.'/'.$cart->subproduct->product->alias) }}">
                                {{ $cart->subproduct->product->translation->name }}
                                </a>
                                <div class="price">
                                    <span>{{ $cart->subproduct->product->personalPrice->price }} {{ $currency->abbr }}</span>
                                    @if ($cart->subproduct->product->personalPrice->price !== $cart->subproduct->product->personalPrice->old_price)
                                        <br> <span>{{ $cart->subproduct->product->personalPrice->old_price }} {{ $currency->abbr }}</span>
                                    @endif
                                </div>
                                <div class="params">
                                    <span>{{ trans('vars.Cabinet.size') }}: {{ $cart->subproduct->parameterValue->translation->name }}</span>
                                    <span>{{ trans('vars.Cabinet.qty') }}: <span class="qtyBox">{{ $cart->qty }}</span></span>
                                </div>
                                <div class="methods">
                                    <div class="addToWish"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    @if ((count($carts['subproducts']) == 0) && (count($carts['products']) == 0))
                    <div class="col-12 orderHistory">
                        <div class="text-center">{{ trans('vars.Cabinet.cartEmpty') }}</div>
                    </div>
                    @else
                    <div class="col">
                        <a href="{{ url('/'.$lang->lang.'/cart') }}"><button>{{ trans('vars.TehButtons.btnViewAllCarts') }}</button></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@include('front.partials.footer')
@stop

