<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"
>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- utf-8 works for most cases -->
        <meta name="viewport" content="width=device-width">
        <!-- Forcing initial-scale shouldn't be necessary -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Use the latest (edge) version of IE rendering engine -->
        <meta name="x-apple-disable-message-reformatting">
        <!-- Disable auto-scale in iOS 10 Mail entirely -->
        <title></title>
        <!-- The title tag shows in email notifications, like Android 4.4. -->
        <link href="//fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <!-- CSS Reset : BEGIN -->
        <style>
            body,html{margin:0 auto!important;padding:0!important;height:100%!important;width:100%!important;font-family:DejaVu Sans,sans-serif}*{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}*{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}div[style*="margin: 16px 0"]{margin:0!important}table,td{mso-table-lspace:0!important;mso-table-rspace:0!important}table{border-spacing:0!important;border-collapse:collapse!important;table-layout:fixed!important;margin:0 auto!important}img{-ms-interpolation-mode:bicubic}a{text-decoration:none}.aBn,.unstyle-auto-detected-links *,[x-apple-data-detectors]{border-bottom:0!important;cursor:default!important;color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}.a6S{display:none!important;opacity:.01!important}.im{color:inherit!important}img.g-img+div{display:none!important}@media only screen and (min-device-width:320px) and (max-device-width:374px){u~div .email-container{min-width:320px!important}}@media only screen and (min-device-width:375px) and (max-device-width:413px){u~div .email-container{min-width:375px!important}}@media only screen and (min-device-width:414px){u~div .email-container{min-width:414px!important}}div.email-container{width:100%;overflow:hidden;display:block;padding-left:30px;padding-right:30px}a,article,div,p,section,span{font-family:'DejaVu Sans';font-size:12px;box-sizing:border-box}.section{margin-bottom:15px}.logo{width:50%;text-align:left;vertical-align:top}.logo img{margin-top:30px}.total-summar{width:100%;background-color:#eddcd5;text-transform:uppercase;padding:0 15px;line-height:30px;margin-top:10px}.total-summar p{font-weight:500;font-size:25px}.factura,.test{font-size:25px;font-weight:500;text-transform:uppercase}.test{font-weight:400;text-transform:none}.section-right{width:50%;justify-content:space-between}.section-right tr{width:100%}.section-right td{width:50%}.text-right{text-align:right}.furnizor{width:50%;padding-right:15px}.furnizor .title{opacity:.5;padding:10px 0;border-bottom:1px solid #555151;width:50%;margin-bottom:10px;font-weight:500}td,th,tr{font-family:'DejaVu Sans';padding:10px 5px;vertical-align:middle}.table-list td,.table-list th{text-align:center}table{width:100%;border-collapse:collapse}.table-list tr td:first-child,.table-list tr th:first-child{width:50px}.table-list tr td:nth-child(2),.table-list tr th:nth-child(2){white-space:nowrap;width:300px}.table-list .tableHead{background:0 0!important}.table-list .tableHead th{border-bottom:1px solid #555151;border-top:1px solid #555151}.table-list tr.last-child{background:0 0!important}.table-list tr.last-child td{border-top:1px solid #555151}.table-list tr.last-child td:nth-child(4),.table-list tr.last-child td:nth-child(5),.table-list tr.last-child td:nth-child(6),.table-list tr.last-child td:nth-child(7){background:#dfdfdf}.table-list tr:nth-child(odd){background:#dfdfdf}.stamp{width:50%;vertical-align:top}.stamp+td{vertical-align:top}.stamp img{height:148px;width:auto;margin-top:30px}.last-section .total-summar{width:100%}.table-middle td{vertical-align:top}
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
                    $amount +=  $subproduct->product->mainPrice->price * $subproduct->qty;
                    $amountVat += ($subproduct->product->mainPrice->price * 19 / 100);
                }
            }
            foreach ($order->orderProducts as $key => $product){
                if (!is_null($product->product)){
                    $amount +=  $product->product->mainPrice->price * $product->qty;
                    $amountVat += ($product->product->mainPrice->price * 19 / 100);
                }
            }

            $discount = $amount - ($amount - ($amount * $order->discount / 100));
            $discountVat = $amountVat - ($amountVat - ($amountVat * $order->discount / 100));

            $shippingPrice = $order->shipping_price / $currencyRate;
            $shippingPriceVat = $shippingPrice * 19 / 100;

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
                        <p class="factura">Invoice</p>
                          <P>
                            <span>Date of issue:</span>
                            <span>{{ date('d/m/Y') }}</span>
                          </P>
                      </td>
                      <td>
                        <div class="bloc text-right">
                            <p class="test">{{ $order->order_invoice_code }}{{ $order->order_invoice_id }}</p>
                            <p>VAT rate: 19%</p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" class="total-summar">
                        <table>
                          <td>
                            <p>Total Payment</p>
                          </td>
                          <td>
                            <div class="text-right">
                              <p>{{ $amount }} {{ $mainCurrency->abbr }}</p>
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
                        Supplier
                    </div>
                    <div class="factura">Company: IT MALL OÜ</div>
                    <p>Tax-ID: <b>14561245</b></p>
                    <p>VAT-code: RO42015090</p>
                    <p>Legal Address: Estonia, Harju maakond, Tallinn, Kesklinna linnaosa, Järvevana tee 9-40, 11314</p>
                    <p>Warehouse address: Romania, Brasov, str. Zizinului 9B</p>
                    <p>IBAN: BE64 9670 3809 0852</p>
                    <p>Bank: TransferWise Europe SA</p>
                    <p>Email: info@annépopova.com</p>
                    <p>Phone: +40312294664</p>
                </td>
                <td class="furnizor">
                    <div class="title">
                        Client
                    </div>
                    <div class="factura">{{ $order->details->contact_name }}</div>
                    <p>Phone: +{{ $order->details->code }} {{ $order->details->phone }}</p>
                    <p>Address: {{ $order->details->country }}, {{ $order->details->city }}, {{ $order->details->address }}</p>
                    <p>Email: {{ $order->details->email }}</p>
                </td>
              </table>
            </div>
            <div class="section table-list">
                <table>
                    <tr class="tableHead">
                        <th>Nr. crt</th>
                        <th>Products' name:</th>
                        <th>U.M.</th>
                        <th>Qty.</th>
                        <th>Unit price (with VAT) {{ $mainCurrency->abbr }}</th>
                        <th>Total amount {{ $mainCurrency->abbr }}</th>
                        <th>VAT amount {{ $mainCurrency->abbr }}</th>
                    </tr>
                    @foreach ($order->orderSubproducts as $key => $subproduct)
                        @if (!is_null($subproduct->product))
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $subproduct->product->translation->name }}</td>
                                <td>Pcs.</td>
                                <td>{{ $subproduct->qty }}</td>
                                <td>{{ $subproduct->product->mainPrice->price }}</td>
                                <td>{{ number_format((float)($subproduct->product->mainPrice->price * $subproduct->qty), 2, '.', '')  }}</td>
                                <td>{{ number_format((float)($subproduct->product->mainPrice->price * 19 / 100), 2, '.', '')  }}</td>
                            </tr>
                        @endif
                    @endforeach
                    @foreach ($order->orderProducts as $key => $product)
                        @if (!is_null($product->product))
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->product->translation->name }}</td>
                                <td>Pcs.</td>
                                <td>{{ $product->qty }}</td>
                                <td>{{ $product->product->mainPrice->price }}</td>
                                <td>{{ number_format((float)$product->product->mainPrice->price * $product->qty, 2, '.', '')  }}</td>
                                <td>{{ number_format((float)($product->product->mainPrice->price * 19 / 100), 2, '.', '')  }}</td>
                            </tr>
                        @endif
                    @endforeach

                    <tr>
                        <td></td>
                        <td>Shipping cost:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format((float)$shippingPrice, 2, '.', '') }}</td>
                        <td>{{ number_format((float)$shippingPriceVat, 2, '.', '') }}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>Discount:</td>
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
                    <p>Supplier's signature:</p>
                    <img src="https://annepopova.com/images/signature.png" alt="">
                  </td>
                  <td style="text-align: right;">
                    <div class="total-summar">
                      <table>
                        <td>
                          <p>Total</p>
                        </td>
                        <td class="text-right"><p>{{ $amount }} {{ $mainCurrency->abbr }}</p></td>
                      </table>
                    </div>
                  </td>
                </table>
            </div>
        </div>
    </body>
</html>

