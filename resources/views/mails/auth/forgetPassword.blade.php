<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <meta charset="utf-8">
        <!-- utf-8 works for most cases -->
        <meta name="viewport" content="width=device-width">
        <!-- Forcing initial-scale shouldn't be necessary -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Use the latest (edge) version of IE rendering engine -->
        <meta name="x-apple-disable-message-reformatting">
        <!-- Disable auto-scale in iOS 10 Mail entirely -->
        <title></title>
        <!-- The title tag shows in email notifications, like Android 4.4. -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
        <!-- CSS Reset : BEGIN -->
        <style>
            body,html{margin:0 auto!important;padding:0!important;height:100%!important;width:100%!important;background:#f1f1f1}*{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}*{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}div[style*="margin: 16px 0"]{margin:0!important}table,td{mso-table-lspace:0!important;mso-table-rspace:0!important}table{border-spacing:0!important;border-collapse:collapse!important;table-layout:fixed!important;margin:0 auto!important}img{-ms-interpolation-mode:bicubic}a{text-decoration:none}.aBn,.unstyle-auto-detected-links *,[x-apple-data-detectors]{border-bottom:0!important;cursor:default!important;color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}.a6S{display:none!important;opacity:.01!important}.im{color:inherit!important}img.g-img+div{display:none!important}@media only screen and (min-device-width:320px) and (max-device-width:374px){u~div .email-container{min-width:320px!important}}@media only screen and (min-device-width:375px) and (max-device-width:413px){u~div .email-container{min-width:375px!important}}@media only screen and (min-device-width:414px){u~div .email-container{min-width:414px!important}}div.email-container{width:100%;overflow:hidden;display:block;background-repeat:repeat;padding-left:15px;padding-right:15px}.addit,p{text-align:center;font-family:'Source Sans Pro';font-size:20px;color:#2f2f2f;letter-spacing:-.05px;text-align:left;line-height:25px;margin:0}.userName{font-family:'Source Sans Pro';font-size:50px;color:#000;letter-spacing:-.08px;text-align:left;margin-bottom:30px}.logo{display:block;background-size:110px 110px;background-position:50px center;background-repeat:no-repeat;height:130px;margin-top:30px}.gift{font-family:'Source Sans Pro';font-size:30px;color:#2f2f2f;letter-spacing:-.06px;text-align:left;margin-top:20px;margin-bottom:5px}.addit{margin-top:30px}a.butt{display:block;height:40px;line-height:40px;font-size:20px;text-transform:uppercase;background-color:#4b483d;width:245px;text-align:center;color:#fff;margin-left:0;margin-top:10px;font-family:'Source Sans Pro'}.buttGroups{display:flex;width:650px;margin-left:0}.buttGroups .butt{margin-right:20px}.miss{margin-top:20px}.ignore{margin-top:30px;margin-bottom:60px}.logo2{background-repeat:no-repeat;background-size:100%;height:40px;width:150px;margin-left:0}ul{display:block;padding-left:17px;list-style:none}.addit a,ul a,ul li{font-family:'Source Sans Pro';font-size:18px;color:#2f2f2f;letter-spacing:-.05px;text-align:left;line-height:25px;margin:0;list-style:none}
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="userName">{{ trans('vars.Email-templates.emailBodyHello') }}</div>
            <h4>{{ trans('vars.Email-templates.emailForegtPassSubject') }}</h4>
            <p>{{ trans('vars.Email-templates.emailForgetPassBodyCode') }} : <b>{{ $code }}</b></p>
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


s --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
