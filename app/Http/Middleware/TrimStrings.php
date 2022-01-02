<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array
     */
    protected $except = [
        'password',
        'password_confirmation',
    ];
}


($paypal_conf['settings']);
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

end Email error.(". $subject .")";
            LogsHandler::save(debug_backtrace(), $problem, \Auth::guard('persons')->user());
        }
    }

    /**
     * Send email with attach file
     */
    public function sendEmailAttach($data, $email, $subject, $template, $path, $filename)
    {
        $from = $this->from;

        try {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Mail::send($template, $data, function($message) use ($email, $subject, $from, $path, $filename)
                {
                    $message->to($email, $subject)
                            ->from($from)
                            ->subject($subject);

                    if(is_file($path . '/' . $filename)){
                        $message->attach($path . '/' . $filename);
                    }
                });
            }
        } catch (\Exception $e) {
            $problem = "Send Email error.(". $subject .")";
            LogsHandler::save(debug_backtrace(), $problem, \Auth::guard('persons')->user());
        }
    }

}
