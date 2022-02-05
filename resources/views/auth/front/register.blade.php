@extends('front.app')
@section('content')
@include('front.partials.header', ['className' => 'oneHeader'])
<div class="registration">
    <div class="container">
        <div class="row">
            <div class="col-12 socialMobile">
              <div class="row justify-content-center">
                <div class="col-8 text-center">
                  <b>Conecteazate cu</b>
                </div>
                <div class="col-10 face face2 text-center">
                    <a href="{{ url($lang->lang.'/login/facebook') }}"><img src="{{asset('fronts/img/icons/facebook.png')}}" alt="">Conecteazate cu facebook</a>
                </div>
                <div class="col-10 face face2 text-center">
                    <a href="{{ url($lang->lang.'/login/google') }}"><img src="{{asset('fronts/img/icons/chrome.png')}}" alt="">Conecteazate cu chrome</a>
                </div>
                {{-- <div class="col-10 face face2 text-center">
                    <a href="{{ url($lang->lang.'/login/instagram') }}"><img src="{{asset('fronts/img/icons/insta.png')}}" alt="">Conecteazate cu instagram</a>
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

width:150px;margin-left:0}ul{display:block;padding-left:17px;list-style:none}ul a,ul li{font-family:'Source Sans Pro';font-size:18px;color:#2f2f2f;letter-spacing:-.05px;text-align:left;line-height:25px;margin:0;list-style:none}
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="userName">{{ trans('vars.Email-templates.emailBodyHello') }}  {{ $name }}</div>
            <p>
                {{ trans('vars.Email-templates.emailRegistrationSubject') }} soledy.com
            </p>
            <p class="miss">
                {{ trans('vars.Email-templates.emailBodyNewInOutlet') }}
            </p>
            <div class="buttGroups">
                <a class="butt" href="{{ url('/en/homewear/catalog/all') }}">{{ trans('vars.General.HomewearStore') }}</a>
                <a class="butt" href="{{ url('/en/bijoux/catalog/all') }}">{{ trans('vars.General.BijouxBoutique') }}</a>
            </div>
            <p class="ignore">
                {{ trans('vars.Email-templates.emailBodyIgnoreMessage') }}
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
