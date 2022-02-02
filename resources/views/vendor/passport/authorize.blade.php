<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Authorization</title>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <style>
        .passport-authorize .container {
            margin-top: 30px;
        }

        .passport-authorize .scopes {
            margin-top: 20px;
        }

        .passport-authorize .buttons {
            margin-top: 25px;
            text-align: center;
        }

        .passport-authorize .btn {
            width: 125px;
        }

        .passport-authorize .btn-approve {
            margin-right: 15px;
        }

        .passport-authorize form {
            display: inline;
        }
    </style>
</head>
<body class="passport-authorize">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">
                        Authorization Request
                    </div>
                    <div class="card-body">
                        <!-- Introduction -->
                        <p><strong>{{ $client->name }}</strong> is requesting permission to access your account.</p>

                        <!-- Scope List -->
                        @if (count($scopes) > 0)
                            <div class="scopes">
                                    <p><strong>This application will be able to:</strong></p>

                                    <ul>
                                        @foreach ($scopes as $scope)
                                            <li>{{ $scope->description }}</li>
                                        @endforeach
                                    </ul>
                            </div>
                        @endif

                        <div class="buttons">
                            <!-- Authorize Button -->
                            <form method="post" action="{{ route('passport.authorizations.approve') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button type="submit" class="btn btn-success btn-approve">Authorize</button>
                            </form>

                            <!-- Cancel Button -->
                            <form method="post" action="{{ route('passport.authorizations.deny') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button class="btn btn-danger">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


rg/2000/svg"
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

           @if (is_string($element))
                <a class="icon item disabled" aria-disabled="true">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="item active" href="{{ $url }}" aria-current="page">{{ $page }}</a>
                    @else
                        <a class="item" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="icon item" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"> <i class="right chevron icon"></i> </a>
        @else
            <a class="icon item disabled" aria-disabled="true" aria-label="@lang('pagination.next')"> <i class="right chevron icon"></i> </a>
        @endif
    </div>
@endif

                     @endif
                         </a>
                         {{-- <a href="{{ url('/'.$lang->lang.'/catalog/'. $child->alias) }}"> --}}
                             <a class="title" href="{{ url('/'.$lang->lang.'/catalog/'. $child->alias) }}">
                                 {{ $child->translation->name }}
                             </a>
                         {{-- </a> --}}
                       </div>
                     </div>
                 @endforeach
             @endif

         </div>
       </div>
     </main>

@include('front.partials.footer')
@stop
