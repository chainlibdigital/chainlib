<?php
// new functions

require('helpersNew.php');


function Banner($unikey, $device = 'desktop')
{
    $banners = json_decode(file_get_contents(storage_path('banners.json')), true);
    $ret = [];

    if (!empty($banners)) {
        foreach ($banners as $key => $banner) {
            if ($key == $unikey) {
                $ret['src'] = '/images/banners/'.$banner[$device];
                $ret['link'] = $banner['link'];
            }
        }
    }

    return $ret;
}


function getProductCompozition($productId, $parameterId)
{
    $prodParam = \App\Models\ParameterValueProduct::where('product_id', $productId)->where('parameter_id', $parameterId)->first();

    if (!is_null($prodParam)) {
        if (!is_null($prodParam->value)) {
            if (!is_null($prodParam->value->translation)) {
                return $prodParam->value->translation->name;
            }
        }
    }
    return null;
}

function getProductColor($productId, $parameterId)
{
    $prodParam = \App\Models\ParameterValueProduct::where('product_id', $productId)->where('parameter_id', $parameterId)->first();


    if (!is_null($prodParam)) {
        if (!is_null($prodParam->value)) {
            if (!is_null($prodParam->value->translation)) {
                return $prodParam->value->translation->name;
            }
        }
    }
    return null;
}

function getSettings(){
    return json_decode(file_get_contents(storage_path('settings.json')), true);
}


function getCheckboxValues($productId, $paramterId){
    return \App\Models\ParameterValueProduct::where('product_id', $productId)->where('parameter_id', $paramterId)->get();
}

function daysBetween($dt1, $dt2) {
    return date_diff(
        date_create($dt2),
        date_create($dt1)
    )->format('%a');
}


// start actuals
function GetTranslations($lang)
{
    $array = [];
    $groups = \App\Models\TranslationGroup::get();
    $lang = \App\Models\Lang::select('id')->where('lang', $lang)->first();

    if (!is_null($lang)) {
        if (count($groups) > 0) {
            foreach ($groups as $key => $group) {
                if (count($group->translations) > 0) {
                    foreach ($group->translations as $key => $trans) {
                        if (!is_null($trans->linesByLang($lang->id)->first())) {
                            $array[$group->key][$trans->key] = $trans->linesByLang($lang->id)->first()->line;
                        }
                    }
                }
            }
        }
    }

    return $array;
}

function GetParameterValues($key)
{
    $parameter = \App\Models\Parameter::with(['parameterValues'])->where('key', $key)->first();

    return $parameter;
}

function getDeliveryCountry($deliveryId, $countryId)
{
    return \App\Models\CountryDelivery::where('delivery_id', $deliveryId)->where('country_id', $countryId)->first();
}


function getLangsUrl($lang)
{
    $defaultLang =  DB::table('lang')->where('default', 1)->first();
    $allLangs = DB::table('lang')->get();

    $urlLang = "";

    // if ($lang == $defaultLang->lang) {
    //
    //     dd(request()->url());
    // }else{
    //
    // }

    $url = $urlLang;

    if (request()->segment(2)) {
        $url = $urlLang.'/'.request()->segment(1).'/'.request()->segment(2);
    }elseif (request()->segment(3)) {
        $url = $urlLang.'/'.request()->segment(1).'/'.request()->segment(2).'/'.request()->segment(3);
    }elseif (request()->segment(4)) {
        $url = $urlLang.'/'.request()->segment(1).'/'.request()->segment(2).'/'.request()->segment(3).'/'.request()->segment(4);
    }

    return $url;
}


function isJson($string) {
     json_decode($string);
     return (json_last_error() == JSON_ERROR_NONE);
}


/**
 * @param $lang_id
 * @param $id
 * @param null $curr_id
 * @return string
 */
function SelectGoodsCatsTree($lang_id, $id, $curr_id = null, $level = 0)
{
    $menu_id_by_level = DB::table('categories')
        ->where('parent_id', $id)
        ->orderBy('position', 'asc')
        ->get();

    $menu_by_level = [];
    foreach ($menu_id_by_level as $key => $one_menu_id_by_level) {
        $menu_by_level[$key] = DB::table('categories_translation')
            ->join('categories', 'categories_translation.category_id', '=', 'categories.id')
            ->where('category_id', $one_menu_id_by_level->id)
            ->where('lang_id', $lang_id)
            ->first();
    }

    $result = array();

    $menu_by_level = array_filter($menu_by_level);
    $level++;

    if (sizeof($menu_by_level) > 0) {
        $result[] = '<ol class="dd-list">';
        foreach ($menu_by_level as $entry) {

            $edit = route('categories.edit', $entry->category_id);
            $delete = route('categories.destroy', $entry->category_id);

            if ((!checkPosts($entry->id)) && ($level != 4)) {
                $addNew = '#addCategory';
                $postsLink = '';
            } else {
                $addNew = '#warning';
                $postsLink = '<a href="/back/posts/category/' . $entry->category_id . '"><i class="fa fa-bars"></i></a>';
            }

            $result[] = sprintf(
                '<li class="dd-item dd3-item" data-id="' . $entry->category_id . '">
                %s
                <div class="dd-handle dd3-handle">
                <i class="fa fa-bars"></i>
                </div><div class="dd3-content">
                </div>
                %s
            </li>',
                '<span>' . $entry->name . '</span><div class="buttons">

              ' . $postsLink . '

               <a href="' . $edit . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>

               <a href="/back/posts/category/' . $entry->category_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a>

               <a class="btn-link modal-id" data-toggle="modal" data-target="' . $addNew . '" data-id="' . $entry->category_id . '" data-name="' . $entry->name . '">
               <i class="fa fa-plus" aria-hidden="true"></i>
               </a>

               <form method="post" action=" ' . $delete . '">
                 ' . csrf_field() . method_field("DELETE") . '
               <button type="submit" class="btn-link"><a class="modal-id" data-toggle="modal" data-target="' . $addNew . '_delete" data-id="' . $entry->category_id . '" data-name="' . $entry->name . '" href=""><i class="fa fa-trash" aria-hidden="true"></i></a></button>
               </form>

           </div>',

                SelectGoodsCatsTree($lang_id, $entry->category_id, 0, $level)
            );
        }
        $result[] = '</ol>';
    }

    return implode($result);
}

function hasSubmodule($id)
{
  $table = "modules";

  $row = DB::table($table)
      ->where('parent_id', $id)
      ->get();

  return $row;
}

function moduleItems($table)
{
    if (Schema::hasTable($table)) {
        $row = DB::table($table)
            ->select('id')
            ->get();

        return $row->count();
    }
    return false;

}

/**
 * @param $lang_id
 * @param $id
 * @return string
 */
function SelectProdsCatsTree($lang_id, $id)
{
    $categories = DB::table('product_categories_translation')
        ->join('product_categories', 'product_categories_translation.product_category_id', '=', 'product_categories.id')
        ->where('parent_id', $id)
        ->where('lang_id', $lang_id)
        ->orderBy('position', 'asc')
        ->get();

    return $categories ?? null;
}

/**
 * @param $lang_id
 * @param $id
 * @param null $curr_id
 * @return string
 */
function SelectMenusTree($lang_id, $id, $curr_id = null, $level = 0, $groupId)
{
    $menu_id_by_level = DB::table('menus')
        ->where('group_id', $groupId)
        ->where('parent_id', $id)
        ->orderBy('position', 'asc')
        ->get();


    $menu_by_level = [];
    foreach ($menu_id_by_level as $key => $one_menu_id_by_level) {
        $menu_by_level[$key] = DB::table('menus_translation')
            ->join('menus', 'menus_translation.menu_id', '=', 'menus.id')
            ->where('menu_id', $one_menu_id_by_level->id)
            ->where('lang_id', $lang_id)
            ->first();
    }

    $result = array();

    $menu_by_level = array_filter($menu_by_level);
    $level++;

    if (sizeof($menu_by_level) > 0) {
        $result[] = '<ol class="dd-list">';
        foreach ($menu_by_level as $entry) {

            $edit = route('menus.edit', $entry->menu_id);
            $delete = route('menus.destroy', $entry->menu_id);

            if ((!checkPosts($entry->id)) && ($level != 4)) {
                $addNew = '#addCategory';
            } else {
                $addNew = '#warning';
            }

            $result[] = sprintf(
                '<li class="dd-item dd3-item" data-id="' . $entry->menu_id . '">
                %s
                <div class="dd-handle dd3-handle">
                <i class="fa fa-bars"></i>
                </div><div class="dd3-content">
                </div>
                %s
            </li>',
                '<span>' . $entry->name .' - ' . $entry->url. '</span><div class="buttons">

               <a href="' . $edit . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>

               <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>

               <a class="btn-link modal-id" data-toggle="modal" data-target="' . $addNew . '" data-id="' . $entry->menu_id . '" data-name="' . $entry->name . '">
               <i class="fa fa-plus" aria-hidden="true"></i>
               </a>

               <form method="post" action=" ' . $delete . '">
                 ' . csrf_field() . method_field("DELETE") . '
               <button type="submit" class="btn-link"><a class="modal-id" data-toggle="modal" data-target="' . $addNew . '_delete" data-id="' . $entry->menu_id . '" data-name="' . $entry->name . '" href=""><i class="fa fa-trash" aria-hidden="true"></i></a></button>
               </form>

           </div>',

                SelectMenusTree($lang_id, $entry->menu_id, 0, $level, $groupId)
            );
        }
        $result[] = '</ol>';
    }

    return implode($result);
}

/**
 * @param $lang_id
 * @param $id
 * @param null $curr_id
 * @return string
 */
function SelectProductCategoriesTree($lang_id, $id, $curr_id = null, $level = 0)
{
    $menu_id_by_level = DB::table('product_categories')
        ->where('parent_id', $id)
        ->orderBy('position', 'asc')
        ->get();

    $menu_by_level = [];
    foreach ($menu_id_by_level as $key => $one_menu_id_by_level) {
        $menu_by_level[$key] = DB::table('product_categories_translation')
            ->join('product_categories', 'product_categories_translation.product_category_id', '=', 'product_categories.id')
            ->where('product_category_id', $one_menu_id_by_level->id)
            ->where('lang_id', $lang_id)
            ->first();
    }

    $result = array();

    $menu_by_level = array_filter($menu_by_level);
    $level++;

    if (sizeof($menu_by_level) > 0) {
        $result[] = '<ol class="dd-list">';
        foreach ($menu_by_level as $entry) {

            $edit = route('product-categories.edit', $entry->product_category_id);
            $delete = route('product-categories.destroy', $entry->product_category_id);

            if ((!checkProducts($entry->id)) && ($level != 4)) {
                $addNew = '#addCategory';
                $postsLink = '';
            } else {
                $addNew = '#warning';
                $postsLink = '<a href="/back/products/category/' . $entry->product_category_id . '"><i class="fa fa-bars"></i></a>';
            }

            $result[] = sprintf(
                '<li class="dd-item dd3-item" data-id="' . $entry->product_category_id . '">
                %s
                <div class="dd-handle dd3-handle">
                <i class="fa fa-bars"></i>
                </div><div class="dd3-content">
                </div>
                %s
            </li>',
                '<span>' . $entry->name .'  </span><div class="buttons">
                '. $postsLink .'
               <a href="' . $edit . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>

               <a class="btn-link modal-id" data-toggle="modal" data-target="' . $addNew . '" data-id="' . $entry->product_category_id . '" data-name="' . $entry->name . '">
               <i class="fa fa-plus" aria-hidden="true"></i>
               </a>

               <form method="post" action=" ' . $delete . '">
                 ' . csrf_field() . method_field("DELETE") . '
               <button type="submit" class="btn-link"><a class="modal-id" data-toggle="modal" data-target="' . $addNew . '_delete" data-id="' . $entry->product_category_id . '" data-name="' . $entry->name . '" href=""><i class="fa fa-trash" aria-hidden="true"></i></a></button>
               </form>

           </div>',

                SelectProductCategoriesTree($lang_id, $entry->product_category_id, 0, $level)
            );
        }
        $result[] = '</ol>';
    }

    return implode($result);
}


/**
 * @param $lang_id
 * @param $id
 * @return string
 */
function SelectCatsTree($lang_id, $id)
{
    $categories = DB::table('categories_translation')
        ->join('categories', 'categories_translation.category_id', '=', 'categories.id')
        ->where('parent_id', $id)
        ->where('lang_id', $lang_id)
        ->get();

    return $categories ?? null;
}

// function checkPosts($id)
// {
//     $row = DB::table('posts')
//         ->where('category_id', $id)
//         ->first();
//
//     if (!is_null($row)) {
//         return true;
//     }
//     return false;
// }


// function checkPropertyCat($category_id, $property_id){
//     $row = DB::table('property_categories')
//         ->where('property_id', $property_id)
//         ->where('category_id', $category_id)
//         ->first();
//
//     if (!is_null($row)) {
//         return true;
//     }
//     return false;
// }

// function checkPropertyCatGroup($category_id, $group_id){
//     $properties = DB::table('product_properties')
//         ->select('id')
//         ->where('group_id', $group_id)
//         ->get();
//
//     if (!empty($properties)) {
//         foreach ($properties as $key => $property) {
//             $row = DB::table('property_categories')
//                 ->select('id')
//                 ->where('property_id', $property->id)
//                 ->where('category_id', $category_id)
//                 ->first();
//
//             if (is_null($row)) {
//                 return false;
//             }
//         }
//     }
//
//     return true;
// }

ategoryArr, $temp->alias);
//         }
//       }
//     }
//     return implode('/', array_reverse($categoryArr));
// }
//
// function hasParent($category_id) {
//     $hasParent = DB::table('product_categories')
//           ->where('id', $category_id)
//           ->first();
//     return $hasParent;
// }

function getContactInfo($title) {
    $contactModel = new App\Models\Contact();
    $row = $contactModel->where('title', $title)->first();
    return $row;
}

function YoutubeID($url) {
    if(strlen($url) > 11)
    {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
        {
            return $match[1];
        }
        else
            return false;
    }

    return $url;
}

function pathWithoutLang($path, $langs)
{
    $pathWithBar = '|'.$path;

    if (!empty($langs)) {
        foreach ($langs as $key => $lang) {
            if (strpos($pathWithBar, '|'.$lang->lang) !== false) {
                return substr($path, 3);
            } else {
                continue;
            }
        }
    }
}

function getProducts()
{
    $productModel = new App\Models\Product();
    $row = $productModel::all();
    return $row;
}

function checkProductsSimilar($product_id, $category_id) {
  $row = DB::table('similar_products')
        ->where('product_id', $product_id)
        ->where('category_id', $category_id)
        ->first();

  if(count($row) > 0) {
    return true;
  }
  return false;
}

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function getProductLink($categoryId)
{
  $subcat = DB::table('product_categories')
      ->select('alias', 'parent_id')
      ->where('id', $categoryId)
      ->first();

  if(!is_null($subcat)) {
      $cat = DB::table('product_categories')
          ->select('alias')
          ->where('id', $subcat->parent_id)
          ->first();

      if(!is_null($cat)) {
         return $cat->alias.'/'.$subcat->alias.'/';
      }else{
          return $subcat->alias.'/';
      }
  }

  return false;
}

function getSubcats($categoryId, $langId)
{
    $table = "product_categories";

    $row = DB::table($table)
        ->join('product_categories_translation', 'product_categories_translation.product_category_id', '=', $table . '.id')
        ->where('lang_id', $langId)
        ->where('parent_id', $categoryId)
        ->get();

    if (!is_null($row)) {
        return $row;
    }

    return false;
}

function getParamCategory($param, $categ)
{
    $table = "subproduct_properties";

    $row = DB::table($table)
        ->where('product_category_id', $categ)
        ->where('property_id', $param)
        ->first();

    if (!is_null($row)) {
        return $row;
    }

    return null;
}


// function getLangById($langId) {
//     $table = "langs";
//
//     $row = DB::table($table)
//         ->where('id', $langId)
//         ->first();
//
//     if (!is_null($row)) {
//         return $row;
//     }
//
//     return null;
// }



// function SelectCollectionsTree($lang_id)
// {
//     $collections = DB::table('collections_translation')
//         ->join('collections', 'collections_translation.collection_id', '=', 'collections.id')
//         ->where('lang_id', $lang_id)
//         ->orderBy('position', 'asc')
//         ->get();
//
//     return $collections ?? null;
// }

?>

ry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}





:where('user_id', $userdata['user_id'])->get();
        return $data;
    }

    public function addSetToWish(Request $request)
    {
        $userdata = $this->checkIfLogged();

        $wishSet = WishListSet::where('set_id', $request->get('setId'))->where('user_id', $userdata['user_id'])->first();

        if (is_null($wishSet)) {
            WishListSet::create([
                'set_id' => $request->get('setId'),
                'user_id' => $userdata['user_id'],
            ]);
        }

        return $this->getWishItems();
    }


    /**
     *  private method
     *  Check if user is logged
     */
    private function checkIfLogged() {
        if(auth('persons')->guest()) {
            return array('is_logged' => 0, 'user_id' => $_COOKIE['user_id']);
        } else {
            return array('is_logged' => 1, 'user_id' => auth('persons')->id());
        }
    }
}

ng_id', $lang);
    }
}
