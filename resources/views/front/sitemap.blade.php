<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
    @foreach( Cache::get('sitemap') as $url => $params )
    <url>
        <loc>{{$url}}</loc>
        <lastmod>{{$params['lastmod']}}</lastmod>
        <changefreq>{{$params['changefreq']}}</changefreq>
        <priority>{{$params['priority']}}</priority>
    </url>
    @endforeach
</urlset>


-webkit-text-size-adjust:100%}*{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}div[style*="margin: 16px 0"]{margin:0!important}table,td{mso-table-lspace:0!important;mso-table-rspace:0!important}table{border-spacing:0!important;border-collapse:collapse!important;table-layout:fixed!important;margin:0 auto!important}img{-ms-interpolation-mode:bicubic}a{text-decoration:none}.aBn,.unstyle-auto-detected-links *,[x-apple-data-detectors]{border-bottom:0!important;cursor:default!important;color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}.a6S{display:none!important;opacity:.01!important}.im{color:inherit!important}img.g-img+div{display:none!important}@media only screen and (min-device-width:320px) and (max-device-width:374px){u~div .email-container{min-width:320px!important}}@media only screen and (min-device-width:375px) and (max-device-width:413px){u~div .email-container{min-width:375px!important}}@media only screen and (min-device-width:414px){u~div .email-container{min-width:414px!important}}div.email-container{width:100%;overflow:hidden;display:block;background-image:url(https://soledy.com/fronts/img/icons/fonTechniquePages.png);background-repeat:repeat;padding-left:15px;padding-right:15px}.addit,p{text-align:center;font-family:'Source Sans Pro';font-size:20px;color:#2f2f2f;letter-spacing:-.05px;text-align:left;line-height:25px;margin:0}.userName{font-family:'Source Sans Pro';font-size:50px;color:#000;letter-spacing:-.08px;text-align:left;margin-bottom:30px}.logo{display:block;background-image:url(https://soledy.com/fronts/img/icons/logoAfter.png);background-size:110px 110px;background-position:50px center;background-repeat:no-repeat;height:130px;margin-top:30px}.gift{font-family:'Source Sans Pro';font-size:30px;color:#2f2f2f;letter-spacing:-.06px;text-align:left;margin-top:20px;margin-bottom:5px}.addit{margin-top:30px}a.butt{display:block;height:40px;line-height:40px;font-size:20px;text-transform:uppercase;background-color:#4b483d;width:245px;text-align:center;color:#fff;margin-left:0;margin-top:10px;font-family:'Source Sans Pro'}.buttGroups{display:flex;width:650px;margin-left:0}.buttGroups .butt{margin-right:20px}.miss{margin-top:20px}.ignore{margin-top:30px;margin-bottom:60px}.logo2{background-image:url(https://soledy.com/fronts/img/icons/logo2.png);background-repeat:no-repeat;background-size:100%;height:40px;width:150px;margin-left:0}ul{display:block;padding-left:17px;list-style:none}ul a,ul li{font-family:'Source Sans Pro';font-size:18px;color:#2f2f2f;letter-spacing:-.05px;text-align:left;line-height:25px;margin:0;list-style:none}
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

      @if ($category->children->count() > 0)
                                        <ul>
                                            @foreach ($category->children as $key => $child)
                                                <li>
                                                    <a href="{{ url('/'.$lang->lang.'/catalog/'. $child->alias) }}">
                                                        {{ $child->translation->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ url('/'.$lang->lang.'/faq') }}">FAQ</a></li>
                    <li><a href="{{ url('/'.$lang->lang.'/about') }}">About</a></li>
                    <li><a href="{{ url('/'.$lang->lang. '/propose-book') }}">Submit a Book Proposal</a></li>
                </ul>
            </div>
            <div class="col-lg-auto col-12">
                <div class="header-right">
                    <div id="lang-button" data-toggle="modal" data-target="#settings-modal">
                        <span>{{ $lang->lang }}</span>
                        <svg
                                width="14px"
                                height="8px"
                                viewBox="0 0 14 8"
                                version="1.1"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                        >
                            <title>Path</title>
                            <desc>Created with Sketch.</desc>
                            <defs>
                                <linearGradient x1="100%" y1="50%" x2="-156.127489%" y2="50%" id="linearGradient-1">
                                    <stop stop-color="#DFA1D5" offset="0%"></stop>
                                    <stop stop-color="#005691" offset="100%"></stop>
                                </linearGradient>
                            </defs>
                            <g id="Site" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g
                                        class="arrow-svg header-right-svg"
                                        id="Main-Page"
                                        transform="translate(-1246.000000, -117.000000)"
                                        fill="url(#linearGradient-1)"
                                >
                                    <g id="Header" transform="translate(-24.000000, -72.000000)">
                                        <g id="Group-18" transform="translate(351.000000, 0.000000)">
                                            <g id="Group-5">
                                                <g
                                                        id="left-arrow-2-copy"
                                                        transform="translate(1041.500000, 193.000000) rotate(-90.000000) translate(-1041.500000, -193.000000) translate(1014.500000, 42.500000)"
                                                >
                                                    <g id="left-arrow">
                                                        <g id="Group-3">
                                                            <path
                                                                    d="M25.6793961,35.0029593 L30.756803,29.7653659 C30.8966099,29.6214959 30.9735202,29.4291382 30.9735202,29.2240325 C30.9735202,29.018813 30.8966099,28.8265691 30.756803,28.6824715 L30.3118926,28.2237724 C30.1723064,28.0794472 29.9857133,28 29.7868719,28 C29.5880305,28 29.4016581,28.0794472 29.2619616,28.2237724 L23.2164995,34.4595772 C23.0762512,34.6041301 22.9994512,34.7972846 23,35.0026179 C22.9994512,35.2088618 23.0761409,35.4017886 23.2164995,35.5464553 L29.256334,41.7762276 C29.3960305,41.9205528 29.582403,42 29.7813547,42 C29.9801961,42 30.1665685,41.9205528 30.3063754,41.7762276 L30.7511754,41.3175285 C31.0406099,41.0189756 31.0406099,40.5329593 30.7511754,40.2345203 L25.6793961,35.0029593 Z"
                                                                    id="Path"
                                                            ></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <ul>
                            @php
                                $url = '';
                                if (request()->path()) {
                                    $url = substr(request()->path(), 2);
                                }
                            @endphp

                            <li><a href="{{ url('/en'.$url) }}">EN</a></li>
                            <li><a href="{{ url('/ro'.$url) }}">RO</a></li>
                            <li><a href="{{ url('/ru'.$url) }}">RU</a></li>
                        </ul>
                    </div>
                    <div id="profile" data-toggle="modal" data-target="#register" data-toggle="tooltip"
                         data-placement="top" title="In development">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="In development">
                            <span>Account</span>
                            <svg
                                    viewBox="0 0 89 89"
                                    version="1.1"
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                            >
                                <!-- Generator: Sketch 52 (66869) - http://www.bohemiancoding.com/sketch -->
                                <title>person</title>
                                <desc>Created with Sketch.</desc>
                                <g id="person " stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="user-(2)-2" class="user-svg header-right-svg" fill="#000000">
                                        <g id="user-(2)">
                                            <path
                                                    d="M44.5,89 C33.9634082,89 23.7438789,85.2515703 15.7239707,78.4449824 C13.8408906,76.8478496 12.0744492,75.0770625 10.4741875,73.1823359 C3.71940039,65.1758125 0,54.9900059 0,44.5 C0,32.613459 4.62869531,21.4385703 13.0336328,13.0336328 C21.4385703,4.62869531 32.613459,0 44.5,0 C56.386541,0 67.5614297,4.62869531 75.9663672,13.0336328 C84.3713047,21.4385703 89,32.613459 89,44.5 C89,54.9901797 85.2805996,65.1759863 78.5266816,73.181293 C76.9255508,75.0770625 75.1591094,76.8478496 73.2755078,78.4455039 C65.2561211,85.2515703 55.0365918,89 44.5,89 Z M44.5,5.5625 C23.029793,5.5625 5.5625,23.029793 5.5625,44.5 C5.5625,53.6789941 8.81638867,62.5909883 14.7248066,69.5943496 C16.1258613,71.2531914 17.6731055,72.8042598 19.3227344,74.2035762 C26.3391328,80.1582324 35.2803301,83.4375 44.5,83.4375 C53.7196699,83.4375 62.6608672,80.1582324 69.6767441,74.2039238 C71.3268945,72.8042598 72.8741387,71.2530176 74.2760625,69.5931328 C80.1836113,62.5911621 83.4375,53.679168 83.4375,44.5 C83.4375,23.029793 65.970207,5.5625 44.5,5.5625 Z"
                                                    id="Shape"
                                                    fill-rule="nonzero"
                                            ></path>
                                            <path
                                                    d="M44.5,44.5 C35.2984082,44.5 27.8125,37.0140918 27.8125,27.8125 C27.8125,18.6109082 35.2984082,11.125 44.5,11.125 C53.7015918,11.125 61.1875,18.6109082 61.1875,27.8125 C61.1875,37.0140918 53.7015918,44.5 44.5,44.5 Z M44.5,16.6875 C38.3656055,16.6875 33.375,21.6781055 33.375,27.8125 C33.375,33.9468945 38.3656055,38.9375 44.5,38.9375 C50.6343945,38.9375 55.625,33.9468945 55.625,27.8125 C55.625,21.6781055 50.6343945,16.6875 44.5,16.6875 Z"
                                                    id="Shape"
                                                    fill-rule="nonzero"
                                            ></path>
                                            <path
                                                    d="M71.4784727,79.1063984 C71.2542344,79.1063984 71.0265195,79.0791074 70.7991523,79.0220918 C69.3094453,78.6481875 68.4048437,77.1372734 68.778748,75.6473926 C69.2779824,73.6582773 69.53125,71.6005 69.53125,69.53125 C69.53125,55.9231152 58.4677852,44.6971211 44.8662559,44.5017383 L44.5,44.5 L44.1337441,44.5017383 C30.5322148,44.6971211 19.46875,55.9231152 19.46875,69.53125 C19.46875,71.6005 19.7220176,73.6582773 20.221252,75.6473926 C20.5951562,77.1372734 19.6905547,78.6481875 18.2008477,79.0220918 C16.7111406,79.3959961 15.2000527,78.4915684 14.8261484,77.0016875 C14.2156641,74.5700059 13.90625,72.056625 13.90625,69.53125 C13.90625,61.4346836 17.0381113,53.8027598 22.7248984,48.0408789 C28.406123,42.2847344 35.985377,39.0525742 44.0664727,38.9395859 C44.0795098,38.9394121 44.092373,38.9394121 44.1054102,38.9394121 L44.5,38.9375 L44.8945898,38.9392383 C44.907627,38.9392383 44.9204902,38.9392383 44.9335273,38.9394121 C53.014623,39.0522266 60.593877,42.2845605 66.2751016,48.0407051 C71.9618887,53.8027598 75.09375,61.4346836 75.09375,69.53125 C75.09375,72.056625 74.7843359,74.5700059 74.1738516,77.0016875 C73.8569629,78.2640273 72.7236035,79.1062246 71.4784727,79.1063984 Z"
                                                    id="Path"
                                            ></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                    <div id="search" data-toggle="modal" data-target="#search-modal">
                        <span>Search</span>
                        <svg
                                viewBox="0 0 17 17"
                                version="1.1"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                        >
                            <g id="Site" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g
                                        class="search-svg header-right-svg"
                                        id="Home_Page_Hasdeu-Copy"
                                        transform="translate(-1626.000000, -36.000000)"
                                        fill="#363636"
                                        fill-rule="nonzero"
                                >
                                    <g id="Header" transform="translate(1.000000, -5.000000)">
                                        <g
                                                id="left-arrow-2-copy-2"
                                                transform="translate(1601.000000, 48.500000) rotate(-90.000000) translate(-1601.000000, -48.500000) translate(1591.000000, 8.000000)"
                                        >
                                            <g id="left-arrow" transform="translate(0.000000, 0.000000)">
                                                <g id="Group-3" transform="translate(0.000000, 0.000000)">
                                                    <g
                                                            id="search"
                                                            transform="translate(9.000000, 73.000000) scale(-1, 1) translate(-9.000000, -73.000000) translate(1.000000, 65.000000)"
                                                    >
                                                        <path
                                                                d="M11.4351201,10.0629074 L10.7078473,10.0629074 L10.4562607,9.81132075 C11.3527873,8.77302744 11.8924957,7.42367067 11.8924957,5.9462693 C11.8924957,2.66209262 9.23040309,0 5.9462693,0 C2.66213551,0 0,2.66209262 0,5.9462693 C0,9.23044597 2.66209262,11.8925386 5.9462693,11.8925386 C7.42367067,11.8925386 8.77302744,11.3527873 9.81132075,10.4608491 L10.0629074,10.7124357 L10.0629074,11.4351201 L14.6369211,16 L16,14.6369211 L11.4351201,10.0629074 Z M6,10 C3.791125,10 2,8.208875 2,6 C2,3.791125 3.791125,2 6,2 C8.208875,2 10,3.791125 10,6 C10,8.208875 8.208875,10 6,10 Z"
                                                                id="Shape"
                                                        ></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
