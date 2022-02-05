<?php

namespace App\Models;

use App\Base as Model;

class WishList extends Model
{
    protected $table = 'wishlist';

    protected $fillable = ['product_id', 'subproduct_id', 'user_id', 'is_logged', 'set_id'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function subproduct()
    {
        return $this->hasOne(SubProduct::class, 'id', 'subproduct_id');
    }

    public function set()
    {
        return $this->hasOne(Set::class, 'id', 'set_id');
    }

}

n report(Exception $exception)
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

RING);
        $dataSet = array_values($orderHash);
        $dataSet[] = $secretKey;

        $signature = hash('sha256', implode(':', $dataSet));

        $client = new \GuzzleHttp\Client();
        $url = "https://payop.com/v1/invoices/create";

        $tokenPayop = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjE2MTExIiwiYWNjZXNzVG9rZW4iOiJmYmE5ZTJkNTZhOWQwNGU5MDA2ODhiYmIiLCJ0b2tlbklkIjoiMjA4Iiwid2FsbGV0SWQiOiI4MjY0IiwidGltZSI6MTU3Nzc4NjkxNSwiZXhwaXJlZEF0IjoxNTg1Njg4NDAwLCJyb2xlcyI6W119.toEBTY107EeiAAnXz1KEYiMf-q7RcBUS0LiwDPYOcNM";

        $order = CRMOrders::find(self::$order->id);

        $request = $client->post($url, [
            'headers' => [
                    'Authorization' =>  "Bearer {$tokenPayop}",
                    'Content-Type' => 'application/json',
                ],
            'json' => [
                "publicKey" => 'application-1a421d0a-3ecc-42b5-9429-650b7fae882a',
                "order" => [
                        "id" => self::$order->id,
                        "amount" => $amount,
                        "currency" =>  "EUR",
                        "items" => [
                            [
                               "id" => "1",
                               "name" => "ds",
                               "price" => $amount
                           ],
                        ],
                        "description" => ""
                    ],
                    "signature" => $signature,
                    "payer" => [
                        "email" => self::$order->details->email,
                        "phone" => '+'. self::$order->details->code .' '. self::$order->details->phone,
                        "name" => self::$order->details->contact_name,
                        "extraFields" => []
                    ],
                    "paymentMethod" => $methodId,
                    "language" => "en",
                    "resultUrl" => url($this->lang->lang.'/order/payment/success/'.self::$order->id),
                    "failPath" =>  url($this->lang->lang.'/order/payment/fail/'.self::$order->id),
                ],
        ]);

        $invoceId = json_decode($request->getBody()->getContents());
        return redirect('https://payop.com/en/payment/invoice-preprocessing/'.$invoceId->data);
    }
}
