<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Cart;
use Carbon\Carbon;

class LogsHandler extends Controller
{
    public static function save($debugTrace, $problem, $user)
    {
        try {
            $currenctTime = Carbon::now()->add(3, 'hour');
            $cartId = 0;
            $email  = null;

            $cart = Cart::where('user_id', $debugTrace[0]['object']->userId)->first();

            if (!is_null($cart)) $cartId = $cart->id;
            if (!is_null($user)) $email = $user->email;

            Log::create([
                'user_id'   => $debugTrace[0]['object']->userId,
                'cart_id'   => $cartId,
                'lang'      => $debugTrace[0]['object']->lang->lang,
                'device'    => $debugTrace[0]['object']->device,
                'currency'  => $debugTrace[0]['object']->currency->abbr,
                'country'   => $debugTrace[0]['object']->country->name,
                'user_email'=> $email,
                'problem'   => $problem,
                'file'      => $debugTrace[0]['file'],
                'controller'=> $debugTrace[0]['class'],
                'referrer'  => $debugTrace[1]['class'].'@'.$debugTrace[1]['function'],
                'method'    => $debugTrace[0]['function'],
                'date'      => $currenctTime->toDateTimeString(),

            ]);
        } catch (\Exception $e) {}
    }
}

e',
                        'homewear',
                        'bijoux'
                    ];

    protected $appends = ['type'];

    public function getTypeAttribute()
    {
        if ($this->bijoux == 1) {
            return "bijoux";
        }else{
            return "homewear";
        }
    }

    public function translations()
    {
        return $this->hasMany(ProductCategoryTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(ProductCategoryTranslation::class)->where('lang_id', self::$lang);
    }

    public function translationByLang($lang)
    {
        return $this->hasOne(ProductCategoryTranslation::class)->where('lang_id', $lang)->first();
    }

    public function properties() {
        return $this->hasMany(SubProductParameter::class, 'category_id', 'id');
    }

    public function property() {
        return $this->hasOne(SubProductParameter::class, 'category_id', 'id');
    }

    public function subproductParameter()
    {
        return $this->hasOne(SubProductParameter::class, 'category_id', 'id');
    }

    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id')->where('active', 1)->orderBy('position', 'asc');
    }

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id')->orderBy('position', 'asc') ->orderBy('created_at', 'desc');
    }

    public function params()
    {
        return $this->hasMany(ParameterCategory::class, 'category_id')->orderBy('position', 'asc');
    }

    public function paremeterCategory($parameterId)
    {
        return $this->hasOne(ParameterCategory::class, 'category_id')->where('parameter_id', $parameterId);
    }

    public function parametersGroups()
    {
        return $this->hasMany(ParameterGroupCategory::class, 'category_id');
    }

    public function productCategories()
    {
        return $this->hasMany(ProductsCategories::class, 'category_id', 'id');
    }

    public function opacIds()
    {
        return $this->hasMany(CategoriesOpacId::class, 'category_id', 'id');
    }
}
