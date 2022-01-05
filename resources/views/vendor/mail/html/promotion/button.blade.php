<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <a href="{{ $url }}" class="button button-green" target="_blank">{{ $slot }}</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>


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

="{{ url($lang->lang.'/login/instagram') }}"><img src="{{asset('fronts/img/icons/insta.png')}}" alt="">Conecteazate cu instagram</a>
                </div> --}}
              </div>
            </div>
            <div class="col-12 pad">
                <h3 class="text-center">{{trans('front.ja.signUp')}}</h3>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8 col-12 aboutEstel">
                <div class="row">
                    <div class="col-12 face face2">
                        <a href="{{ url($lang->lang.'/login/facebook') }}"><img src="{{asset('fronts/img/icons/facebook.png')}}" alt="">Conecteazate cu facebook</a>
                    </div>
                    <div class="col-12 face face2">
                        <a href="{{ url($lang->lang.'/login/google') }}"><img src="{{asset('fronts/img/icons/chrome.png')}}" alt="">Conecteazate cu chrome</a>
                    </div>
                    {{-- <div class="col-12 face face2">
                        <a href="{{ url($lang->lang.'/login/instagram') }}"><img src="{{asset('fronts/img/icons/insta.png')}}" alt="">Conecteazate cu instagram</a>
                    </div> --}}
                </div>
                <h4>{{trans('front.ja.about')}} Julia Alert</h4>
                <ul>
                    <li><a href="{{url($lang->lang.'/about')}}">{{trans('front.ja.aboutUs')}}</a></li>
                    <li><a href="{{url($lang->lang.'/condition')}}">{{trans('front.ja.conditions')}}</a></li>
                    <li><a href="{{url($lang->lang.'/cookie')}}">{{trans('front.ja.cookie')}}</a></li>
                    <li><a href="{{url($lang->lang.'/privacy')}}">{{trans('front.ja.privacy')}}</a></li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-8 col-12 regBoxBorder">
                <div class="regBox">
                    <div class="row">
                        <div class="col-12">
                            <h4>{{trans('front.ja.signUp')}}</h4>
                        </div>
                    </div>
                    <register />
              </div>
        </div>
    </div>
</div>
</div>
@include('front.partials.footer')
@stop
