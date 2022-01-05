<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
         'App\Console\Commands\checkStocks',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        \Artisan::call('check:stocks');
        \Artisan::call('update:stocks');

        $schedule->command('update:stocks')
                 ->hourly();

        $schedule->command('\App\Console\Commands\checkStocks')
              ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

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
