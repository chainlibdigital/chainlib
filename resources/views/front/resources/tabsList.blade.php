@extends('front.app')
@section('content')
@include('front.partials.header')
<main class="projects-all-content book-category-one-content">
    <div class="home-content">
        @include('front.partials.search')
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>{{ $resource->translation->name }}</h3>
                <div class="row">
                    <div class="col-md-auto">
                        <ul class="nav nav-static nav-pills" role="tablist">
                            @if ($resource->children()->count() > 0)
                                @foreach ($resource->children as $key => $child)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}" data-toggle="pill" href="#menu{{ $child->id }}">
                                        {{ $child->translation->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="col-md category-one-items tab-content">
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
                        @if ($resource->children()->count() > 0)
                        @foreach ($resource->children as $key => $child)
                        <div id="menu{{ $child->id }}" class="tab-section tab-pane fade {{ $key == 0 ? 'active in show' : '' }} ">
                            @if ($child->blogs()->count() > 0)
                            @foreach ($child->blogs as $key => $blog)
                                <div class="item-project-one">
                                    <div class="book-description">
                                        <div>
                                            <a class="title" href="{{ $blog->translation->seo_text }}">{{ $blog->translation->name }}</a>
                                        </div>
                                        <p class="description">
                                            {{ $blog->translation->description }}
                                        </p>
                                        @if ($blog->translation->body)
                                            <button type="button" name="button" class="view-more">Vezi mai mult</button>
                                            <section class="body" style="display: none">
                                                {!! $blog->translation->body !!}
                                            </section>
                                        @endif
                                    </div>
                                    <a href="{{ $blog->translation->seo_text }}" target="_blank" class="image-container">
                                        <img src="/images/blogs/{{ $blog->translation->banner }}" alt="" />
                                    </a>
                                </div>
                            @endforeach
                            @endif
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('front.partials.footer')
@stop

amily=Lato:300,400,700" rel="stylesheet">
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
            background: #f1f1f1;
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
            @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700&display=swap);
            div.email-container{
            width: 100%;
            overflow: hidden;
            display: block;
            background-image: url(https://soledy.com/fronts/img/icons/fonTechniquePages.png);
            background-repeat: repeat;
            padding-left: 15px;
            padding-right: 15px;
            }
            p, .addit{
            text-align: center;
            font-family: 'Source Sans Pro';
            font-size: 20px;
            color: #2F2F2F;
            letter-spacing: -0.05px;
            text-align: left;
            line-height: 25px;
            margin: 0;
            }
            .userName{
            font-family: 'Source Sans Pro';
            font-size: 50px;
            color: #000000;
            letter-spacing: -0.08px;
            text-align: left;
            margin-bottom: 30px;
            }
            .logo{
            display: block;
            background-image: url(https://soledy.com/fronts/img/icons/logoAfter.png);
            background-size: 110px 110px;
            background-position: 50px center;
            background-repeat: no-repeat;
            height: 130px;
            margin-top: 30px;
            }
            .gift{
            font-family: 'Source Sans Pro';
            font-size: 30px;
            color: #2F2F2F;
            letter-spacing: -0.06px;
            text-align: left;
            margin-top: 20px;
            margin-bottom: 5px;
            }
            .addit{
            margin-top: 30px;
            }
            a.butt{
            display: block;
            height: 40px;
            line-height: 40px;
            font-size: 20px;
            text-transform: uppercase;
            background-color: #4B483D;
            width: 245px;
            text-align: center;
            color: #fff;
            margin-left: 0;
            margin-top: 10px;
            font-family: 'Source Sans Pro';
            }
            .buttGroups{
            display: flex;
            width: 650px;
            margin-left: 0;
            }
            .buttGroups .butt{
            margin-right: 20px;
            }
            .miss{
            margin-top: 20px;
            }
            .ignore{
            margin-top: 30px;
            margin-bottom: 60px;
            }
            .logo2{
            background-image: url(https://soledy.com/fronts/img/icons/logo2.png);
            background-repeat: no-repeat;
            background-size: 100%;
            height: 40px;
            width: 150px;
            margin-left: 0;
            }
            ul{
            display: block;
            padding-left: 17px;
            list-style: none;
            }
            ul a,
            ul li{
            font-family: 'Source Sans Pro';
            font-size: 18px;
            color: #2F2F2F;
            letter-spacing: -0.05px;
            text-align: left;
            line-height: 25px;
            margin: 0;
            list-style: none;
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="userName">{{ trans('vars.Email-templates.emailBodyHello') }}  {{ $name }}</div>
            <p>
                You received a promocode for purchases on <a href="https://soledy.com">soledy.com</a>
            </p>
            <div class="gift">
                {{ trans('front.thanks.gift') }}
            </div>
            <p>
                {!! trans('front.thanks.promocode', ["name" => $promocode->name , "treshold" => $promocode->treshold, "date" => date("j F Y", strtotime($promocode->valid_to)), "discount" => $promocode->discount]) !!}
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

