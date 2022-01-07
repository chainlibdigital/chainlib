<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Admin\Http\Controllers\AdminController;

class checkStocks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:stocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check products stocks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $admin = new AdminController();
        // $admin->checkProductsStocks();
    }
}

en;

        $request = self::$client->get($url, [
            'headers' => [
                    'Authorization' =>  "Bearer {$token}"
                ]
            ]);

        $response = json_decode($request->getBody()->getContents());
        $warehouseID = 1;

        $i = 0;
        if ($response->data) {
            foreach ($response->data as $key => $responseProduct) {
                if (count($responseProduct->storage) > 0) {
                    $subproduct = SubProduct::where('code', $responseProduct->sku)->first();
                    if (!is_null($subproduct)) {
                        WarehousesStock::where('warehouse_id', $warehouseID)
                                        ->where('subproduct_id', $subproduct->id)
                                        ->update([
                                            'stock' => $responseProduct->storage[0]->available_stock,
                                        ]);
                    }else{
                        $product = Product::where('code', $responseProduct->sku)->first();
                        if (!is_null($product)) {
                            WarehousesStock::where('warehouse_id', $warehouseID)
                                            ->where('subproduct_id', null)
                                            ->where('product_id', $product->id)
                                            ->update([
                                                'stock' => $responseProduct->storage[0]->available_stock,
                                            ]);
                        }
                    }
                    $i++;
                }else{
                    $subproduct = SubProduct::where('code', $responseProduct->sku)->first();
                    if (!is_null($subproduct)) {
                        WarehousesStock::where('warehouse_id', $warehouseID)
                                        ->where('subproduct_id', $subproduct->id)
                                        ->update([
                                            'stock' => 0,
                                        ]);
                    }else{
                        $product = Product::where('code', $responseProduct->sku)->first();
                        if (!is_null($product)) {
                            WarehousesStock::where('warehouse_id', $warehouseID)
                                            ->where('product_id', $product->id)
                                            ->where('subproduct_id', null)
                                            ->update([
                                                'stock' => 0,
                                            ]);
                        }
                    }
                }
            }
        }

        if ($page == 0) {
            try {
                $this->updateSetStocks();
            } catch (\Exception $e) {
                $problem = "Update Set Stocks Error.";
                LogsHandler::save(debug_backtrace(), $problem, \Auth::guard('persons')->user());
            }
        }

        if (count($response->data) == 100) {
            $page = $page + 1;
            $this->synchronizeStocks($page);
        }
    }

    public function updateSetStocks()
    {
        $sets = Set::get();
        $outOfStock = 0;

        foreach ($sets as $key => $set) {
            if ($set->products->count() > 0) {
                foreach ($set->products as $key => $product) {
                    if ($set->gift_product_id !== $product->id) {
                        if ($product->warehouse->stock == 0) {
                            $outOfStock++;
                        }
                    }
                }
            }
            if ($outOfStock == ($set->products->count() - 1)) {
                $set->update(["stock" => 0]);
            }else{
                $set->update(["stock" => 1]);
            }
        }
    }

}




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
