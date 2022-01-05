<?php

use Illuminate\Database\Seeder;

class GeneralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('generals')->delete();
        DB::table('generals_translation')->delete();

        $langs = DB::table('langs')->get();

        $generals = array(
      		array('name' => 'order', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ),
          array('name' => 'order', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ),
          array('name' => 'order', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ),
          array('name' => 'order', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ),
          array('name' => 'checkbox', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ),
          array('name' => 'checkbox', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ),
          array('name' => 'shippingReturns', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ),
          array('name' => 'description', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ),
        );

        DB::table('generals')->insert($generals);

        $generals = DB::table('generals')->get();

        foreach ($generals as $key => $general) {
            foreach ($langs as $key => $lang) {
                DB::table('generals_translation')->insert([
                        'general_id' => $general->id,
                        'lang_id' => $lang->id,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]);
            }
        }
    }
}

            $table->foreign('lang_id')->references('id')->on('langs')->onDelete('cascade');
            $table->foreign('param_val_id')->references('id')->on('parameters_values_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameters_values_products_translation');
    }
}
