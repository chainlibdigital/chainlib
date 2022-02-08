<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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

      $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function pay()
    {
        try {
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item = new Item();
            $item->setName(self::$order->order_hash)
                 ->setCurrency('EUR')
                 ->setQuantity(1)
                 ->setPrice(self::$amount['main']['total']);

            $itemList = new ItemList();
            $itemList->setItems(array($item));

            $amount = new Amount();
            $amount->setCurrency('EUR')->setTotal(self::$amount['main']['total']);

            $transaction = new Transaction();

            $transaction->setAmount($amount)
                        ->setItemList($itemList)
                        ->setDescription('Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('status', ['orderId' => self::$order->id, 'payment' => self::$payment]))
                          ->setCancelUrl(URL::route('cancel-status', ['orderId' => self::$order->id, 'payment' => self::$payment]));

            $payment = new Payment();
            $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));

            try {
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                if (\Config::get('app.debug')) {
                    \Session::put('error', 'Connection timeout');
                    return redirect()->route('paywithpaypal');
                } else {
                    \Session::put('error', 'Some error occur, sorry for inconvenient');
                    return redirect()->route('paywithpaypal');
                }
            }

            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }

            Session::put('paypal_payment_id', $payment->getId());
            if (isset($redirect_url)) {
                return redirect()->away($redirect_url);
            }

            \Session::put('error', 'Unknown error occurred');
            return redirect()->route('paywithpaypal');
        } catch (\Exception $e) {
            $problem = "Payment Paypal error.";
            LogsHandler::save(debug_backtrace(), $problem, \Auth::guard('persons')->user());
            // Session::flash('payment-error', 'Payment error!');
            Session::flash('payment-error', trans('vars.Notifications.paymentErorTryCatch'));
            return redirect('/ro/order/payment/'. self::$order->id);
        }
    }

    /**
     * Paypal Callback Function
     */
    public function getPaymentStatus(Request $request, $orderId = null, $payment = null)
    {
        self::$order = CRMOrders::find($orderId);
        self::$payment = 'paypal';

        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            return $this->fail();
        }

        $payment = Payment::get($request->get('paymentId'), $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved')
        {
            $this->success();
            return redirect()->route('thanks', ['redirs' => 'success', 'checkout' => self::$order->id, 'promocode' => self::$promocode->id]);
        }

        return $this->fail();
    }

    public function getPaymentCancelStatus(Request $request, $orderId = null, $payment = null)
    {
        self::$order = CRMOrders::find($orderId);
        self::$payment = 'paypal';

        $this->fail(1, 'FB: canceled, PSP: Redirect back from Paypal', 'preorders');

        return redirect('/ro/order/payment/'. $orderId);
    }

    public function callBack(){}

}
