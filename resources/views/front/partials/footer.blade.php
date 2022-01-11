<footer>
    <div class="container">
        <div class="row footer-inner">
            <div class="col-md-4 col-12">
                <a href="index.html" class="logo">
                    <img src="/CL-horizontal_on_transparent.png" alt=""/>
                </a>
                <p>
                    ChainLib - digital space created for authors that provides a "shelf space" and visibility to their
                    readers, with copyright protection ensured by blockchain technology
                </p>
                <div class="networksFooter">
                    <a href="https://www.facebook.com/annaamita17" class="networksFooter-container">
                        <img src="/fronts/img/svg/facebook-f-brands.svg" alt="">
                    </a>
                    <a href="https://www.instagram.com/anna_amita/" class="networksFooter-container">
                        <img src="/instagram-1.svg" alt="">
                    </a>
                    <a href="https://www.youtube.com/watch?v=7fbCOdWE2T4" class="networksFooter-container">
                        <img src="/fronts/img/svg/youtube-brands.svg" alt="">
                    </a>
                </div>
            </div>
            <div class="col-md col-12">
                <ul>
                    @php
                        $i = 0;
                    @endphp
                    <li class="title">Catalog</li>
                    @foreach ($categoriesMenu as $key => $category)
                        @if ($category->children->count() > 0)
                            @foreach ($category->children as $key => $child)
                                @if($i <= 3)
                                    @php
                                        $i++;
                                    @endphp
                                    <li>
                                        <a href="{{ url('/'.$lang->lang.'/catalog/'. $child->alias) }}">
                                            {{ $child->translation->name }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-md col-12">
                <ul>
                    <li class="title">About</li>
                    <li><a href="{{ url('/'.$lang->lang.'/about') }}">About</a></li>
                    <li><a href="{{ url('/'.$lang->lang.'/faq') }}">FAQ</a></li>
                    <li><a href="{{ url('/'.$lang->lang.'/contacts') }}">Contacts</a></li>
                    <li><a href="{{ url('/'.$lang->lang.'/propose-book') }}">Submit a Book Proposal</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="search-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close" data-dismiss="modal"></div>
                <div class="title-modal">Search</div>
                <search></search>
            </div>
        </div>
    </div>

</footer>

<div class="modal fade" id="settings-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close" data-dismiss="modal"></div>
            <div class="title-modal">settings</div>
            <form action="">
                <div class="select-container">
                    <span>Language</span>
                    @php
                        $url = '';
                        if (request()->path()) {
                            $url = substr(request()->path(), 2);
                        }
                    @endphp
                    <select name="" id="" onchange="if (this.value) window.location.href=this.value">
                        <option {{ $lang->lang == 'en' ? 'selected' : '' }} value="{{ url('/en'.$url) }}">EN</option>
                        <option {{ $lang->lang == 'ro' ? 'selected' : '' }}  value="{{ url('/ro'.$url) }}">RO</option>
                        <option {{ $lang->lang == 'ru' ? 'selected' : '' }} value="{{ url('/ru'.$url) }}">RU</option>
                    </select>
                </div>
                {{-- <input type="submit" value="Save" data-dismiss="modal" /> --}}
            </form>
        </div>
    </div>
</div>

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
