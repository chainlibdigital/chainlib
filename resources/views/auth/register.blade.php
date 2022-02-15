@extends('admin.app')

<!-- @section('nav-bar')
	<ul>
		<li class="language-list">
			@foreach($lang_list as $one_lang)
				@if(!empty(Request::segment(6)))
					<a href="{{urlForLanguage($one_lang->lang, Request::segment(5).'/'. Request::segment(6))}}">{{$one_lang->lang}}</a>
				@elseif(!empty(Request::segment(5)))
					<a href="{{urlForLanguage($one_lang->lang, Request::segment(5))}}">{{$one_lang->lang}}</a>
				@elseif(!empty(Request::segment(4)))
					<a href="{{urlForLanguage($one_lang->lang, '')}}">{{$one_lang->lang}}</a>
				@elseif(!empty(Request::segment(3)))
					<a href="{{urlForFunctionLanguage($one_lang->lang, '')}}">{{$one_lang->lang}}</a>
				@else
					<a href="{{url($one_lang->lang, 'back')}}">{{$one_lang->lang}}</a>
				@endif
			@endforeach
		</li>
		<li><a class="tosite-button" target="_blank" href="/">{{trans('variables.go_to_the_site')}}</a></li>
	</ul>
@stop -->

@section('left-menu')
	<aside id="nav" style="z-index: 99;">

		<div class="logo-section-auth">
			<a><img src="/images/logo.png" height="36" width="138" alt="">{{trans('variables.title_page')}}</a>
		</div>

		<div class="navigation">
			<form class="login-form" role="form" method="POST" action="{{ url($lang.'/back/auth/register') }}" id="register-form">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="text" name="name" placeholder="name">
				<input type="text" name="login" placeholder="login">
				<input type="email" name="email" placeholder="email">
				<input type="password" name="password" placeholder="pass">
				<input type="password" name="repeat_password" placeholder="repeat pass">
				{{-- <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
				 <script>
				 grecaptcha.ready(function() {
					 grecaptcha.execute('reCAPTCHA_site_key', {action: 'homepage'}).then(function(token) {
						...
					 });
				 });
				 </script> --}}
				<input type="submit" class="submit-label" onclick="saveForm(this)" data-form-id="register-form" value="{{trans('variables.register')}}">
			</form>
		</div>
	</aside>
@stop


@section('footer')
	<footer>
		@include('admin.footer')
	</footer>
@stop

>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">@lang('pagination.next')</span>
            </li>
        @endif
    </ul>
@endif

/a>
				@elseif(!empty(Request::segment(3)))
					<a href="{{urlForFunctionLanguage($one_lang->lang, '')}}">{{$one_lang->lang}}</a>
				@else
					<a href="{{url($one_lang->lang, 'back')}}">{{$one_lang->lang}}</a>
				@endif
			@endforeach
		</li>
		<li><a class="tosite-button" target="_blank" href="/">{{trans('variables.go_to_the_site')}}</a></li>
	</ul>
@stop -->

@section('left-menu')
	<aside id="nav" style="z-index: 99;">

		<div class="logo-section-auth">
			<a><img src="/images/logo.png" height="36" width="138" alt="">{{trans('variables.title_page')}}</a>
		</div>

		<div class="navigation">
			<form class="login-form" role="form" method="POST" action="{{ url($lang.'/back/auth/register') }}" id="register-form">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="text" name="name" placeholder="name">
				<input type="text" name="login" placeholder="login">
				<input type="email" name="email" placeholder="email">
				<input type="password" name="password" placeholder="pass">
				<input type="password" name="repeat_password" placeholder="repeat pass">
				{{-- <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
				 <script>
				 grecaptcha.ready(function() {
					 grecaptcha.execute('reCAPTCHA_site_key', {action: 'homepage'}).then(function(token) {
						...
					 });
				 });
				 </script> --}}
				<input type="submit" class="submit-label" onclick="saveForm(this)" data-form-id="register-form" value="{{trans('variables.register')}}">
			</form>
		</div>
	</aside>
@stop


@section('footer')
	<footer>
		@include('admin.footer')
	</footer>
@stop

>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">@lang('pagination.next')</span>
            </li>
        @endif
    </ul>
@endif

css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <!-- CSS Reset : BEGIN -->
        <style>
            /* What it does: Remove spaces around the email design added by some email clients. */
            /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
            html,
            body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            font-family: DejaVu Sans, sans-serif;
            }
            /* What it does: Stops email clients resizing small text. */
            * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            }
            /* What it does: Stops email clients resizing small text. */
            * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            }
            /* What it does: Centers email on Android 4.4 */
            div[style*="margin: 16px 0"] {
            margin: 0 !important;
            }
            /* What it does: Stops Outlook from adding extra spacing to tables. */
            table,
            td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
            }
            /* What it does: Fixes webkit padding issue. */
            table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
            }
            /* What it does: Uses a better rendering method when resizing images in IE. */
            img {
            -ms-interpolation-mode:bicubic;
            }
            /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
            a {
            text-decoration: none;
            }
            /* What it does: A work-around for email clients meddling in triggered links. */
            *[x-apple-data-detectors],  /* iOS */
            .unstyle-auto-detected-links *,
            .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            }
            /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
            .a6S {
            display: none !important;
            opacity: 0.01 !important;
            }
            /* What it does: Prevents Gmail from changing the text color in conversation threads. */
            .im {
            color: inherit !important;
            }
            /* If the above doesn't work, add a .g-img class to any image in question. */
            img.g-img + div {
            display: none !important;
            }
            /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
            /* Create one of these media queries for each additional viewport size you'd like to fix */
            /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
            @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
            min-width: 320px !important;
            }
            }
            /* iPhone 6, 6S, 7, 8, and X */
            @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
            min-width: 375px !important;
            }
            }
            /* iPhone 6+, 7+, and 8+ */
            @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
            min-width: 414px !important;
            }
            }
            div.email-container{
            width: 100%;
            overflow: hidden;
            display: block;
            padding-left: 30px;
            padding-right: 30px;
            }

            p,a,span,div,section,article {
              font-family: 'DejaVu Sans';
              font-size: 12px;
              box-sizing: border-box;
            }

            .section {
              margin-bottom: 15px;
            }
            .logo {
              width: 50%;
              text-align: left;
              vertical-align: top;
            }
            .logo img {
              margin-top: 30px
            }
            .total-summar {
              width: 100%;
              background-color: #eddcd5;
              text-transform: uppercase;
              padding: 0 15px;
              line-height: 30px;
              margin-top: 10px;
            }

            .total-summar p {
              font-weight: 500;
              font-size: 25px;
            }

            .factura, .test {
              font-size: 25px;
              font-weight: 500;
              text-transform: uppercase;
            }
            .test {
              font-weight: 400;
              text-transform: none;
            }

            .section-right {
              width: 50%;
              justify-content: space-between;
            }

            .section-right tr {
              width: 100%;
            }

            .section-right td {
              width: 50%;
            }

            .text-right {
              text-align: right;
            }

            .furnizor {
              width: 50%;
              padding-right: 15px;
            }

            .furnizor .title {
              opacity: .5;
              padding: 10px 0;
              border-bottom: 1px solid #555151;
              width: 50%;
              margin-bottom: 10px;
              font-weight: 500;
            }
            tr,td, th {
              font-family: 'DejaVu Sans';
              padding: 10px 5px;
              vertical-align: middle;
            }
            .table-list th,
            .table-list td {
              text-align: center
            }
            table {
              width: 100%;
              border-collapse: collapse;
            }
            .table-list tr td:first-child,
            .table-list tr th:first-child {
              width: 50px;
            }
            .table-list tr td:nth-child(2),
            .table-list tr th:nth-child(2) {
              white-space: nowrap;
              width: 300px;
            }
            .table-list .tableHead {

              background: none !important;
            }
            .table-list .tableHead th {
              border-bottom: 1px solid #555151;
              border-top: 1px solid #555151;
            }
            .table-list tr.last-child {
              background: none !important;
            }
            .table-list tr.last-child td {
              border-top: 1px solid #555151;
            }
            .table-list tr.last-child td:nth-child(4),
            .table-list tr.last-child td:nth-child(5),
            .table-list tr.last-child td:nth-child(6),
            .table-list tr.last-child td:nth-child(7) {
              background: #dfdfdf;
            }
            .table-list tr:nth-child(odd) {
              background: #dfdfdf;
            }
            .stamp {
              width: 50%;
              vertical-align: top;
            }
            .stamp + td {
              vertical-align: top;
            }
            .stamp img {
              height: 148px;
              width: auto;
              margin-top: 30px;
            }
            .last-section .total-summar{
              width: 100%;
            }
            .table-middle td {
              vertical-align: top;
            }
        </style>
    </head>
    <body>
        @php
            $amount         = 0;
            $amountVat      = 0;
            $discount       = 0;
            $discountVat    = 0;
            $shippingPrice  = 0;
            $shippingPriceVat  = 0;

            foreach ($order->orderSubproducts as $key => $subproduct){
                if (!is_null($subproduct->product)){
                    $amount +=  $subproduct->product->personalPrice->price * $subproduct->qty;
                    $amountVat += ($subproduct->product->personalPrice->price * 20 / 100);
                }
            }
            foreach ($order->orderProducts as $key => $product){
                if (!is_null($product->product)){
                    $amount +=  $product->product->personalPrice->price * $subproduct->qty;
                    $amountVat += ($product->product->personalPrice->price * 20 / 100);
                }
            }

            $discount = $amount - ($amount - ($amount * $order->discount / 100));
            $discountVat = $amountVat - ($amountVat - ($amountVat * $order->discount / 100));

            $shippingPrice = $order->shipping_price * $currencyRate;
            $shippingPriceVat = $shippingPrice * 20 / 100;

            $amount = number_format((float)$amount - $discount + $shippingPrice, 2, '.', '');
            $amountVat = number_format((float)$amountVat - $discountVat + $shippingPriceVat, 2, '.', '');

        @endphp
        <div class="email-container">
            <table class="section">
                <td class="logo">
                    <img src="https://soledy.com/fronts/img/icons/logonew.png" alt="">
                </td>
                <td class="section section-right">
                  <table>
                    <tr>
                      <td>
                        <p class="factura">Factura</p>
                          <P>
                            <span>Data emiterii:</span>
                            <span>{{ date('d/m/Y') }}</span>
                          </P>
                      </td>
                      <td>
                        <div class="bloc text-right">
                            <p class="test">{{ $order->order_invoice_code }}{{ $order->order_invoice_id }}</p>
                            <p>Cota TVA: 20%</p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" class="total-summar">
                        <table>
                          <td>
                            <p>total plata</p>
                          </td>
                          <td>
                            <div class="text-right">
                              <p>{{ $amount }} {{ $currency->abbr }}</p>
                            </div>
                          </td>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
            </table>
            <div class="section table-middle">
              <table>
                <td class="furnizor">
                    <div class="title">
                        Furnizor
                    </div>
                    <div class="factura">BRAND: ANNE POPOVA</div>
                    <p>Adresa:  mun. Chisinau, sec. Centru, str. Puskin A., 5B</p>
                    <p>Telefon: +373 79488188</p>
                    <p>Email:   sales@anapopova.com</p>
                </td>
                <td class="furnizor">
                    <div class="title">
                        Client
                    </div>
                    <div class="factura">{{ $order->details->contact_name }}</div>
                    <p>Telefon: +{{ $order->details->code }} {{ $order->details->phone }}</p>
                    <p>Adresa: {{ $order->details->country }}, {{ $order->details->city }}, {{ $order->details->address }}</p>
                    <p>Email: {{ $order->details->email }}</p>
                </td>
              </table>
            </div>
            <div class="section table-list">
                <table>
                    <tr class="tableHead">
                        <th>Nr. crt</th>
                        <th>Denumirea produselor</th>
                        <th>U.M.</th>
                        <th>Cant.</th>
                        <th>Preț unitar (cu TVA) {{ $currency->abbr }}</th>
                        <th>Valoarea {{ $currency->abbr }}</th>
                        <th>Valoarea TVA {{ $currency->abbr }}</th>
                    </tr>
                    @foreach ($order->orderSubproducts as $key => $subproduct)
                        @if (!is_null($subproduct->product))
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $subproduct->product->translation->name }}</td>
                                <td>Buc.</td>
                                <td>{{ $subproduct->qty }}</td>
                                <td>{{ $subproduct->product->personalPrice->price }}</td>
                                <td>{{ number_format((float)($subproduct->product->personalPrice->price * $subproduct->qty), 2, '.', '')  }}</td>
                                <td>{{ number_format((float)($subproduct->product->personalPrice->price * 20 / 100), 2, '.', '')  }}</td>
                            </tr>
                        @endif
                    @endforeach
                    @foreach ($order->orderProducts as $key => $product)
                        @if (!is_null($product->product))
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->product->translation->name }}</td>
                                <td>Buc.</td>
                                <td>{{ $product->qty }}</td>
                                <td>{{ $product->product->personalPrice->price }}</td>
                                <td>{{ number_format((float)$product->product->personalPrice->price * $subproduct->qty, 2, '.', '')  }}</td>
                                <td>{{ number_format((float)($product->product->personalPrice->price * 20 / 100), 2, '.', '')  }}</td>
                            </tr>
                        @endif
                    @endforeach

                    <tr>
                        <td>{{ $key + 2 }}</td>
                        <td>Costul livrării:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format((float)$shippingPrice, 2, '.', '') }}</td>
                        <td>{{ number_format((float)$shippingPriceVat, 2, '.', '') }}</td>
                    </tr>

                    <tr>
                        <td>{{ $key + 3 }}</td>
                        <td>Reducere</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @if ($discount)
                            <td>-{{ number_format((float)$discount, 2, '.', '') }}</td>
                        @else
                            <td>0</td>
                        @endif
                        @if ($discountVat)
                            <td>-{{ number_format((float)$discountVat, 2, '.', '') }}</td>
                        @else
                            <td>0</td>
                        @endif
                    </tr>

                    <!--Total row-->
                    <tr class="last-child">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td></td>
                        <td>{{ $amount }}</td>
                        <td>{{ $amountVat }}</td>
                    </tr>
                </table>
            </div>
            <div class="section last-section">
                <table>
                  <td class="stamp" style="height:250px;">

                  </td>
                  <td style="text-align: right;">
                    <div class="total-summar">
                      <table>
                        <td>
                          <p>Total</p>
                        </td>
                        <td class="text-right"><p>{{ $amount }} {{ $currency->abbr }}</p></td>
                      </table>
                    </div>
                  </td>
                </table>
            </div>
        </div>
    </body>
</html>
