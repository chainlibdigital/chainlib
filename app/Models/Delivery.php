<?php

namespace App\Models;

use App\Base as Model;

class Delivery extends Model
{
    protected $table = 'deliveries';

    protected $fillable = ['alias', 'price', 'delivery_time'];

    public function translations()
    {
        return $this->hasMany(DeliveryTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(DeliveryTranslation::class)->where('lang_id', self::$lang);
    }

    public function countries()
    {
        return $this->hasMany(CountryDelivery::class, 'delivery_id');
    }
}

>load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

 =>  url($this->lang->lang.'/order/payment/fail/'.self::$order->id),
                        "resultUrl" => URL::route('paydo-success', ['orderId' => self::$order->id, 'payment' => self::$payment]),
                        "failPath" =>  URL::route('paydo-fail',    ['orderId' => self::$order->id, 'payment' => self::$payment]),
                    ],
            ]);

            $invoceId = json_decode($request->getBody()->getContents());
            return redirect('https://paydo.com/en/payment/invoice-preprocessing/'.$invoceId->data);
        } catch (\Exception $e) {
            $problem = "Payment Paydo error.";
            LogsHandler::save(debug_backtrace(), $problem, \Auth::guard('persons')->user());
        }
    }

    public function getSuccessStatus($orderId, $payment)
    {
        self::$order = CRMOrders::find($orderId);
        self::$payment = $payment;

        $this->success();
        return redirect()->route('thanks', ['redirs' => 'success', 'checkout' => self::$order->id, 'promocode' => self::$promocode->id]);
    }

    public function getFailStatus($orderId, $payment)
    {
        self::$order = CRMOrders::find($orderId);
        self::$payment = $payment;

        $this->fail();
    }

    public function callBack()
    {
        // code...
    }
}
