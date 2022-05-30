<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Promocode</title>
    </head>
    <body>
        <h5>{{ trans('front.thanks.gift') }}</h5>

        <p>{{ trans('front.thanks.promocode', ["name" => $promocode->name, "treshold" => $promocode->treshold, "date" => date("j F Y", strtotime($promocode->valid_to)), "discount" => $promocode->discount]) }}</p>

        </table>
    </body>
</html>

ello') }}  {{ $name }}</div>
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
