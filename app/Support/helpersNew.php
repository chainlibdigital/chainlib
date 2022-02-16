<?php

function getPage($alias, $lang)
{
    $page = DB::table('pages')
        ->join('pages_translation', 'pages_translation.page_id', '=' ,'pages.id')
        ->where('lang_id', $lang)
        ->where('alias', $alias)
        ->first();

    return $page;
}

function chechSubproductVals($filter, $currentVal, $productId, $itemId){
    $flag = false;
    $vals = [];
    if ($filter) {
        foreach ($filter as $key => $value) {
            $vals[] = $value['valueId'];
        }
    }

    $inactive = DB::table('subproducts')
        ->select('combination')
        ->where('active', 0)
        ->where('product_id', $productId)
        ->get();

        if (count($inactive) > 0) {
            foreach ($inactive as $key => $inactiv) {
                if (!in_array($itemId, $vals)) {
                $comb = (array) json_decode($inactiv->combination);
                    if (diffArray($vals, $comb) && in_array($itemId, $comb)) {
                        return true;
                    }
                }
            }
        }

        return false;
}

function chechSubproduct($productId, $itemId)
{
    $inactive = DB::table('subproducts')
        ->select('combination')
        ->where('active', 0)
        ->orWhere('stock', 0)
        ->where('product_id', $productId)
        ->get();

        if (count($inactive) > 0) {
            foreach ($inactive as $key => $inactiv) {
                // if (!in_array($itemId, $vals)) {
                $comb = (array) json_decode($inactiv->combination);
                    if (in_array($itemId, $comb)) {
                        return true;
                    }
                // }
            }
        }

        return false;
}

function diffArray($vals, $combs)
{
    $rezult = [];
    foreach ($combs as $key => $comb) {
        if (in_array($comb, $vals)) {
            if ($comb !== 0) {
                $rezult[] = $comb;
            }
        }
    }
    if (count($rezult) > 0) {
        return true;
    }
    return false;
}

function checkValue($currentValue, $value, $productId)
{
    if ($currentValue == null) {
        return false;
    }
    $inactive = DB::table('subproducts')
        ->where('active', 0)
        ->where('product_id', $productId)
        ->pluck('combination_id')
        ->toArray();

        if (count($inactive) > 0) {
            foreach ($inactive as $key => $inactiv) {
                $configuration = DB::table('subproduct_combinations')
                    ->where('id', $inactiv)
                    ->first();

                    if (!is_null($configuration)) {
                        $valuesList = $configuration->case_1 + $configuration->case_2 + $configuration->case_3;
                        $existsList = $currentValue + $value;
                        if ($valuesList == $existsList) {
                            return true;
                        }
                    }
            }
        }
        return false;
}
/**
 * @param $category_id
 * @param $lang_id
 * @return boolean
 */
function checkAutometasCategoryEdit($category_id, $lang_id, $type, $meta_id)
{
  $checked = DB::table('autometa_categories')
      ->join('autometas', 'autometa_categories.autometa_id', 'autometas.meta_id')
      ->where('lang_id', $lang_id)
      ->where('type', $type)
      ->where('category_id', $category_id)
      ->where('autometa_id', $meta_id)
      ->get();
  if(count($checked) > 0) {
    return true;
  }

  return false;
}

/**
 * @return int
 */
function genMetaId()
{
  $meta_id = rand(1, 1000);
  $temp_id = DB::table('autometas')->where('meta_id', $meta_id)->get();
  if(count($temp_id) > 0) {
    genMetaId();
  } else {
    return $meta_id;
  }
}

function checkAutometasCategoryCreate($category_id, $lang_id, $type){
    $row = DB::table('autometa_categories')
        ->join('autometas', 'autometa_categories.autometa_id', 'autometas.meta_id')
        ->where('lang_id', $lang_id)
        ->where('type', $type)
        ->where('category_id', $category_id)
        ->first();

    if (!is_null($row)) {
        return true;
    }
    return false;
}

function GetGallery($shot_code, $langId)
{
    $gallery = DB::table('galleries')
        ->select('id')
        ->where('alias', $shot_code)
        ->first();

    if (!is_null($gallery)) {

        $table = "gallery_images";

        $row = DB::table($table)
            ->join('gallery_images_translation', 'gallery_images_translation.gallery_image_id', '=', $table . '.id')
            ->where('lang_id', $langId)
            ->where('gallery_id', $gallery->id)
            // ->limit(4)
            ->get();

            return $row;
    }

        return false;
}

function GetGalleryById($id, $langId)
{
    $gallery = DB::table('galleries')
        ->select('id')
        ->where('id', $id)
        ->first();

    if (!is_null($gallery)) {

        $table = "gallery_images";

        $row = DB::table($table)
            ->join('gallery_images_translation', 'gallery_images_translation.gallery_image_id', '=', $table . '.id')
            ->where('lang_id', $langId)
            ->where('gallery_id', $gallery->id)
            ->limit(4)
            ->get();

            return $row;
    }

        return false;
}



function getParamProdValue($parameterId, $productId)
{
    $table = "parameters_values_products";

    $row = DB::table($table)
        ->select('parameter_value_id')
        ->where('product_id', $productId)
        ->where('parameter_id', $parameterId)
        ->first();

    if (!is_null($row)) {
        return $row->parameter_value_id;
    }

    return null;
}

function getParameterChechedItems($parameterId, $productId)
{
    $table = "parameters_values_products";

    $row = DB::table($table)
        ->select('parameter_value_id')
        ->where('product_id', $productId)
        ->where('parameter_id', $parameterId)
        ->get()
        ->pluck('parameter_value_id')->toArray();

    return $row;
}


function getCategories($parent_id, $lang_id) {
  $row = DB::table('product_categories')
      ->join('product_categories_translation', 'product_categories_translation.product_category_id', '=', 'product_categories.id')
      ->where('parent_id', $parent_id)
      ->where('lang_id', $lang_id)
      ->get();
    if (!empty($row)) {
        return $row;
    }
    return false;
}


function getProductImages($product_id, $lang_id) {
  $row = DB::table('product_images')
      ->join('product_images_translation', 'product_images.id', '=', 'product_images_translation.product_image_id')
      ->where('lang_id', $lang_id)
      ->where('product_id', $product_id)
      ->get();
    if (!empty($row)) {
        return $row;
    }
    return false;
}

function getPromotionProducts($lang_id) {
  $row = DB::table('products')
      ->join('products_translation', 'products.id', '=', 'products_translation.product_id')
      ->where('lang_id', $lang_id)
      ->where('promotion_id', '!=', 0)
      ->orderBy('products.created_at', 'desc')
      ->select('products.*', 'products.alias as productAlias','products_translation.*')
      ->paginate(12);
    if (!empty($row)) {
        return $row;
    }
    return false;
}

function getRecomendedProducts($lang_id) {
  $row = DB::table('products')
      ->join('products_translation', 'products.id', '=', 'products_translation.product_id')
      ->where('lang_id', $lang_id)
      ->where('recomended', 1)
      ->orderBy('products.created_at', 'desc')
      ->limit(15)
      ->select('products.*', 'products.alias as productAlias','products_translation.*')
      ->get();

     if (!empty($row)) {
        return $row;
    }
    return false;
}

// function getPromosImage($lang_id) {
//   $row = DB::table('promotions')
//       ->join('promotions_translation', 'promotions.id', '=', 'promotions_translation.promotion_id')
//       ->where('lang_id', $lang_id)
//       ->orderBy('promotions.created_at', 'desc')
//       ->limit(5)
//       ->get();
//     if (!empty($row)) {
//         return $row;
//     }
//     return false;
// }

// function getBrandsImage($lang_id) {
//   $row = DB::table('brands')
//       ->join('brands_translation', 'brands.id', '=', 'brands_translation.brand_id')
//       ->where('lang_id', $lang_id)
//       ->orderBy('brands.created_at', 'desc')
//       ->get();
//     if (!empty($row)) {
//         return $row;
//     }
//     return false;
// }

// function getCategoryName($alias, $lang_id) {
//   $category = DB::table('product_categories')
//       ->join('product_categories_translation', 'product_categories.id', '=', 'product_categories_translation.product_category_id')
//       ->where('lang_id', $lang_id)
//       ->where('alias', $alias)
//       ->first();
//     if (count($category) > 0) {
//         return $category->name;
//     }
//     return false;
// }

// function getParentCategory($category_id, $lang_id) {
//     $categoryArr = [];
//
//     if(count(hasParent($category_id, $lang_id)) > 0) {
//       $temp = hasParent($category_id);
//       array_push($categoryArr, $temp->alias);
//
//       if(count(hasParent($temp->parent_id, $lang_id)) > 0) {
//         $temp = hasParent($temp->parent_id);
//         array_push($categoryArr, $temp->alias);
//
//         if(count(hasParent($temp->parent_id, $lang_id)) > 0) {
//           $temp = hasParent($temp->parent_id);
//           array_push($categoryArr, $temp->alias);
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

/ production link: https://paynet.md/acquiring/setecom
	/**
		The base URL to UI
	*/
	const PAYNET_BASE_UI_SERVER_URL = "https://paynet.md/acquiring/getecom";  // production link: https://paynet.md/acquiring/getecom

	/**
		The base URL to API
	*/
	const PAYNET_BASE_API_URL = 'https://paynet.md:4446';                     // production link: https://paynet.md:4446
	/**
		The expiry time for this operation, in hours
	*/
	const EXPIRY_DATE_HOURS = 4 ;//  hours

	const ADAPTING_HOURS = 1 ;//  hours

	public function __construct($merchant_code = null,$merchant_secret_key = null, $merchant_user = null, $merchant_user_password = null)
	{
		$this->merchant_code = $merchant_code;
		$this->merchant_secret_key = $merchant_secret_key;
		$this->merchant_user = $merchant_user;
		$this->merchant_user_password = $merchant_user_password;
		$this->api_base_url = self::PAYNET_BASE_API_URL;
	}

	public function Version()
	{
		return self::API_VERSION;
	}

	public function TokenGet($addHeader = false)
	{
		$path = '/auth';
		$params = [
            'grant_type' 	=> 'password',
            'username'      => $this->merchant_user,
            'password'    	=> $this->merchant_user_password
        ];

		$tokenReq =  $this->callApi($path, 'POST', $params);
		$result = new PaynetResult();

		if($tokenReq->Code == PaynetCode::SUCCESS)
		{
			if(array_key_exists('access_token', $tokenReq->Data))
			{
				$result->Code = PaynetCode::SUCCESS;
				if($addHeader)
					$result->Data = ["Authorization: Bearer ".$tokenReq->Data['access_token']];
				else
					$result->Data = $tokenReq->Data['access_token'];
			}else
			{
				$result->Code = PaynetCode::USERNAME_OR_PASSWORD_WRONG;
				if(array_key_exists('Message', $tokenReq->Data))
					$result->Message = $tokenReq->Data['Message'];
				if(array_key_exists('error', $tokenReq->Data))
					$result->Message = $tokenReq->Data['error'];
			}
		} else
		{
			$result->Code = $tokenReq->Code;
			$result->Message = $tokenReq->Message;
		}
		return $result;
	}

	public function PaymentGet($externalID)
	{
		$path = '/api/Payments';
		$params = [
            'ExternalID' 	=> $externalID
        ];

		$tokenReq =  $this->TokenGet(true);
		$result = new PaynetResult();

		if($tokenReq->IsOk())
		{
			$resultCheck = $this->callApi($path, 'GET',null, $params, $tokenReq->Data);
			if($resultCheck->IsOk())
			{
				$result->Code = $resultCheck->Code;

				if(array_key_exists('Code',$resultCheck->Data))
				{
						$result->Code = $resultCheck->Data['Code'];
						$result->Message = $resultCheck->Data['Message'];
				}else
				{
					$result->Data = $resultCheck->Data;
				}

			}else
				$result = $resultCheck;
		}else
		{
			$result->Code = $tokenReq->Code;
			$result->Message = $tokenReq->Message;
		}
		return $result;
	}

	public function FormCreate($pRequest)
	{
		$result = new PaynetResult();
		$result->Code = PaynetCode::SUCCESS;

			//----------------- preparing a service  ----------------------------
			$_service_name = '';
			$product_line = 0;
			$_service_item = "";
			//-------------------------------------------------------------------
			$pRequest->ExpiryDate = $this->ExpiryDateGet(self::EXPIRY_DATE_HOURS);

			$amount = 0;
			foreach ( $pRequest->Service["Products"] as $item ) {
					$_service_item .='<input type="hidden" name="Services[0][Products]['.$product_line.'][LineNo]" value="'.htmlspecialchars_decode($item['LineNo']).'"/>';
					$_service_item .='<input type="hidden" name="Services[0][Products]['.$product_line.'][Code]" value="'.htmlspecialchars_decode($item['Code']).'"/>';
					$_service_item .='<input type="hidden" name="Services[0][Products]['.$product_line.'][BarCode]" value="'.htmlspecialchars_decode($item['Barcode']).'"/>';
					$_service_item .='<input type="hidden" name="Services[0][Products]['.$product_line.'][Name]" value="'.htmlspecialchars_decode($item['Name']).'"/>';
					$_service_item .='<input type="hidden" name="Services[0][Products]['.$product_line.'][Description]" value="'.htmlspecialchars_decode($item['Descrption']).'"/>';
					$_service_item .='<input type="hidden" name="Services[0][Products]['.$product_line.'][Quantity]" value="'.htmlspecialchars_decode($item['Quantity'] ).'"/>';
					$_service_item .='<input type="hidden" name="Services[0][Products]['.$product_line.'][UnitPrice]" value="'.htmlspecialchars_decode(($item['UnitPrice'])).'"/>';
					$product_line++;
					$amount += $item['Quantity']/100 * $item['UnitPrice'];
			}

			$pRequest->Service["Amount"] = $amount;
		    $signature = $this->SignatureGet($pRequest);
			$pp_form =  '<form method="POST" action="'.self::PAYNET_BASE_UI_URL.'">'.
						'<input type="hidden" name="ExternalID" value="'.$pRequest->ExternalID.'"/>'.
						'<input type="hidden" name="Services[0][Description]" value="'.htmlspecialchars_decode($pRequest->Service["Description"]).'"/>'.
						'<input type="hidden" name="Services[0][Name]" value="'.htmlspecialchars_decode($pRequest->Service["Name"]).'"/>'.
						'<input type="hidden" name="Services[0][Amount]" value="'.$amount.'"/>'.
						$_service_item.
						'<input type="hidden" name="Currency" value="'.$pRequest->Currency.'"/>'.
						'<input type="hidden" name="Merchant" value="'.$this->merchant_code.'"/>'.
						'<input type="hidden" name="Customer.Code"   value="'.htmlspecialchars_decode($pRequest->Customer['Code']).'"/>'.
						'<input type="hidden" name="Customer.Name"   value="'.htmlspecialchars_decode($pRequest->Customer['Name']).'"/>'.
						'<input type="hidden" name="Customer.Address"   value="'.htmlspecialchars_decode($pRequest->Customer['Address']).'"/>'.
						'<input type="hidden" name="ExternalDate" value="'.htmlspecialchars_decode($this->ExternalDate()).'"/>'.
						'<input type="hidden" name="LinkUrlSuccess" value="'.htmlspecialchars_decode($pRequest->LinkSuccess).'"/>'.
						'<input type="hidden" name="LinkUrlCancel" value="'.htmlspecialchars_decode($pRequest->LinkCancel).'"/>'.
						'<input type="hidden" name="ExpiryDate"   value="'.htmlspecialchars_decode($pRequest->ExpiryDate).'"/>'.
						'<input type="hidden" name="Signature" value="'.$signature.'"/>'.
						'<input type="hidden" name="Lang" value="'.$pRequest->Lang.'"/>'.
						'<input type="submit" value="GO to a payment gateway of paynet" />'.
						'</form>';
		$result->Data = $pp_form;
		return $result;
	}

	public  function PaymentReg($pRequest)
	{
		$path = '/api/Payments/Send';
		$pRequest->ExpiryDate = $this->ExpiryDateGet(self::EXPIRY_DATE_HOURS);
		//------------- calculating total amount
		foreach ( $pRequest->Service[0]['Products'] as $item ) {

							$pRequest->Service[0]['Amount'] += ($item['Quantity']/100) * $item['UnitPrice'];
		}

		$params = [
			'Invoice' => $pRequest->ExternalID,
			'MerchantCode' => $this->merchant_code,
			'LinkUrlSuccess' =>  $pRequest->LinkSuccess,
			'LinkUrlCancel' => $pRequest->LinkCancel,
			'Customer' => $pRequest->Customer,
			'Payer' => null,
			'Currency' => 498,
			'ExternalDate' => $this->ExternalDate(),
			'ExpiryDate' => $this->ExpiryDateGet(self::EXPIRY_DATE_HOURS),
			'Services' => $pRequest->Service,
			'Lang' => $pRequest->Lang
        ];

		$tokenReq =  $this->TokenGet(true);
		$result = new PaynetResult();

		if($tokenReq->IsOk())
		{
			$resultCheck = $this->callApi($path, 'POST', $params,null, $tokenReq->Data);
			if($resultCheck->IsOk())
			{
				$result->Code = $resultCheck->Code;

				if(array_key_exists('Code',$resultCheck->Data))
				{
						$result->Code = $resultCheck->Data['Code'];
						$result->Message = $resultCheck->Data['Message'];
				}else
				{
					// print_r($resultCheck->Data);
					//print_r($pRequest);
					$pp_form =  '<form method="POST" action="'.self::PAYNET_BASE_UI_SERVER_URL.'">'.
					'<input type="hidden" name="operation" value="'.htmlspecialchars_decode($resultCheck->Data['PaymentId']).'"/>'.
					'<input type="hidden" name="LinkUrlSucces" value="'.htmlspecialchars_decode($pRequest->LinkSuccess).'"/>'.
					'<input type="hidden" name="LinkUrlCancel" value="'.htmlspecialchars_decode($pRequest->LinkCancel).'"/>'.
					'<input type="hidden" name="ExpiryDate"   value="'.htmlspecialchars_decode($pRequest->ExpiryDate).'"/>'.
					'<input type="hidden" name="Signature" value="'.$resultCheck->Data['Signature'].'"/>'.
					'<input type="hidden" name="Lang" value="'.$pRequest->Lang.'"/>'.
					'<input type="submit" value="GO to a payment gateway of paynet" />'.
					'</form>';
					$result->Data = $pp_form;
				}

			}else
				$result = $resultCheck;
		}else
		{
			$result->Code = $tokenReq->Code;
			$result->Message = $tokenReq->Message;
		}
		return $result;
	}
	private function callApi($path, $method = 'GET', $params = [], $query_params = [], $headers = [])
    {
		$result = new PaynetResult();

        $url = $this->api_base_url . $path;

		// dd(count($query_params) > 0);

        // if (count($query_params) > 0) {
        //     $url .= '?' . http_build_query($query_params);
        // }

        $ch = curl_init($url);
        if ($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if ($method != 'GET') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));// json_encode($params));
		}

        $json_response = curl_exec($ch);

        if ($json_response === false) {
            /*
             * If an error occurred, remember the error
             * and return false.
             */
            $result->Message = curl_error($ch).', '.curl_errno($ch);
			$result->Code = PaynetCode::CONNECTION_ERROR;
            //print_r(curl_errno($ch));

            // Remember to close the cURL object
            curl_close($ch);
            return $result;
        }

        /*
         * No error, just decode the JSON response, and return it.
         */
        $result->Data = json_decode($json_response, true);

        // Remember to close the cURL object
        curl_close($ch);
		$result->Code = PaynetCode::SUCCESS;
        return $result;
    }

	private function ExpiryDateGet($addHours)
	{
		$date = strtotime("+".$addHours." hour");
		return date('Y-m-d', $date).'T'.date('H:i:s', $date);
	}

	public function ExternalDate($addHours = self::ADAPTING_HOURS)
	{
		$date = strtotime("+".$addHours." hour");
		return date('Y-m-d', $date).'T'.date('H:i:s', $date);
	}
	private function SignatureGet($request)
	{
			$_sing_raw  = $request->Currency;
			$_sing_raw .= $request->Customer['Address'].$request->Customer['Code'].$request->Customer['Name'];
			$_sing_raw .= $request->ExpiryDate.strval($request->ExternalID).$this->merchant_code;
			$_sing_raw .= $request->Service['Amount'].$request->Service['Name'].$request->Service['Description'];
			$_sing_raw .= $this->merchant_secret_key;

			return base64_encode(md5($_sing_raw, true));
	}
	public function __get ($name) {
        return $this->$name ?? null;
    }
}
