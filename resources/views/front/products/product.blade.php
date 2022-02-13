@extends('front.app')
@section('content')
@include('front.partials.header')

<main class="home-content">
        @include('front.partials.search')

        <section class="book-one">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 col-md-5">
                <div class="image-container">
                    @if($product->hoverImage)
                        <img src="{{ asset('/images/products/og/'. $product->hoverImage->src) }}"
                             alt=""/>
                    @else
                        <img src="/cover.png" alt=""/>
                    @endif
                </div>
                <div class="sharing_block">
                    <div class="addthis_toolbox addthis_default_style ">
                    <a class="addthis_button_preferred_1"></a>
                    <a class="addthis_button_preferred_2"></a>
                    <a class="addthis_button_preferred_3"></a>
                    <a class="addthis_button_preferred_4"></a>
                    <a class="addthis_button_compact"></a>
                    <a class="addthis_counter addthis_bubble_style"></a>
                    </div>
                    <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-507bec157716424a"></script>
                </div>
              </div>
              <div class="col-lg-7 col-md-7">
                <div class="title">{{ $product->translation->name }}</div>
                <div class="book-descr">
                    @if ($product->translation->author)
                        <div class="item">
                          <span>Author:</span>
                          <span>{{ $product->translation->author }}</span>
                        </div>
                    @endif
                    @if ($product->translation->co_author)
                        <div class="item">
                          <span>Second Author:</span>
                          <span>{{ $product->translation->co_author }}</span>
                        </div>
                    @endif
                    @if ($product->translation->subject)
                        <div class="item">
                          <span>Subject:</span>
                          <span>{{ $product->translation->subject }}</span>
                        </div>
                    @endif
                    @if ($product->translation->publication)
                        <div class="item">
                          <span>Publication:</span>
                          <span>{{ $product->translation->publication }}</span>
                        </div>
                    @endif
                    @if ($product->translation->language)
                        <div class="item">
                          <span>Language:</span>
                          <span>{{ $product->translation->language }}</span>
                        </div>
                    @endif
                    @if ($product->translation->country)
                        <div class="item">
                          <span>Country:</span>
                          <span>{{ $product->translation->country }}</span>
                        </div>
                    @endif
                    @if ($product->issn)
                        <div class="item">
                          <span>ISBN:</span>
                          <span>{{ $product->translation->issn }}</span>
                        </div>
                    @endif
                </div>
              </div>
              @if ($product->translation->description)
                  <div class="col-12 book-one-description">
                    <h3>Description</h3>
                        {!! $product->translation->description !!}
                  </div>
              @endif
            </div>
          </div>
        </section>
        <section class="slider-section">
          <div class="container">
            @if ($similarProducts->count() > 0)

                <div class="row justify-content-center">
                <div class="col-12">
                <h3>Relevants Books</h3>
                <div class="slider-standard slider-fixed-width">
                    @foreach ($similarProducts as $key => $similarProduct)
                        <div class="item-slider-standard book-item ">
                            <a href="{{ url('/'.$lang->lang.'/catalog/'.$similarProduct->category->alias.'/'.$similarProduct->alias) }}" class="image-container">
                                @if($product->hoverImage)
                                    <img src="{{ asset('/images/products/og/'. $similarProduct->hoverImage->src) }}"
                                         alt=""/>
                                @else
                                    <img src="/cover.png" alt=""/>
                                @endif
                            </a>
                            <a href="{{ url('/'.$lang->lang.'/catalog/'.$similarProduct->category->alias.'/'.$similarProduct->alias) }}" class="product-name">{{ $similarProduct->translation->name }}</a>
                        </div>
                    @endforeach
                </div>
                </div>
                </div>
            @endif

          </div>
        </section>
      </main>

@include('front.partials.footer')
@stop

rtant;height:100%!important;width:100%!important;background:#f1f1f1}*{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}*{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}div[style*="margin: 16px 0"]{margin:0!important}table,td{mso-table-lspace:0!important;mso-table-rspace:0!important}table{border-spacing:0!important;border-collapse:collapse!important;table-layout:fixed!important;margin:0 auto!important}img{-ms-interpolation-mode:bicubic}a{text-decoration:none}.aBn,.unstyle-auto-detected-links *,[x-apple-data-detectors]{border-bottom:0!important;cursor:default!important;color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}.a6S{display:none!important;opacity:.01!important}.im{color:inherit!important}img.g-img+div{display:none!important}@media only screen and (min-device-width:320px) and (max-device-width:374px){u~div .email-container{min-width:320px!important}}@media only screen and (min-device-width:375px) and (max-device-width:413px){u~div .email-container{min-width:375px!important}}@media only screen and (min-device-width:414px){u~div .email-container{min-width:414px!important}}div.email-container{width:100%;overflow:hidden;display:block;background-image:url(https://soledy.com/fronts/img/icons/fonTechniquePages.png);background-repeat:repeat;padding-left:15px;padding-right:15px}.addit,p{text-align:center;font-family:'Source Sans Pro';font-size:20px;color:#2f2f2f;letter-spacing:-.05px;text-align:left;line-height:25px;margin:0}.userName{font-family:'Source Sans Pro';font-size:50px;color:#000;letter-spacing:-.08px;text-align:left;margin-bottom:30px}.logo{display:block;background-image:url(https://soledy.com/fronts/img/icons/logoAfter.png);background-size:110px 110px;background-position:50px center;background-repeat:no-repeat;height:130px;margin-top:30px}.gift{font-family:'Source Sans Pro';font-size:30px;color:#2f2f2f;letter-spacing:-.06px;text-align:left;margin-top:20px;margin-bottom:5px}.addit{margin-top:30px}a.butt{display:block;height:40px;line-height:40px;font-size:20px;text-transform:uppercase;background-color:#4b483d;width:245px;text-align:center;color:#fff;margin-left:0;margin-top:10px;font-family:'Source Sans Pro'}.buttGroups{display:flex;width:650px;margin-left:0}.buttGroups .butt{margin-right:20px}.miss{margin-top:20px}.ignore{margin-top:30px;margin-bottom:60px}.logo2{background-image:url(https://soledy.com/fronts/img/icons/logo2.png);background-repeat:no-repeat;background-size:100%;height:40px;width:150px;margin-left:0}ul{display:block;padding-left:17px;list-style:none}ul a,ul li{font-family:'Source Sans Pro';font-size:18px;color:#2f2f2f;letter-spacing:-.05px;text-align:left;line-height:25px;margin:0;list-style:none}
    </style>
</head>

<body>
    <div class="email-container">
        <div class="userName">Hello, Admin</div>
        <p>
              New order details:
        </p>
        <ul class="info">
            <li>Date        : {{ date('Y-m-d h:i:s') }}</li>
            <li>Order Id    : {{ $order->id }}</li>
            <li>Order Hash  : {{ $order->order_hash }}</li>
            <li>Order Amount: {{ $order->amount }}</li>
            <li>Name        : {{ $order->details->contact_name }}</li>
            <li>Email       : {{ $order->details->email }}</li>
            <li>Phone       : {{ $order->details->phone }}</li>
        </ul>
        <p class="ignore">
             In case You didn't do actions mentioned above or this mail doesn't refer to You, please ignore the message.
        </p>
        <p style="text-align: left">{{ trans('vars.Email-templates.emailBodySignature') }}</p>
        <ul class="info">
            <li>{{ trans('vars.General.brandName') }}</li>
            <li>{{ trans('vars.FormFields.fieldEmail') }}: {{ trans('vars.Contacts.queriesPaymentShippingReturnsEmail') }}</li>
            <li>{{ trans('vars.FormFields.fieldphone') }}: {{ trans('vars.Contacts.queriesPaymentShippingReturnsPhone') }}</li>
            <li>Facebook: {{ trans('vars.Contacts.facebook') }}</li>
        </ul>
    </div>
</body>
</html>
