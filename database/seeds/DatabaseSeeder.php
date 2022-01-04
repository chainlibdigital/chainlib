<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LangsTableSeeder::class);
        $this->call(AdminUsersTableSeed::class);
        $this->call(ModulesTableSeed::class);
        $this->call(UserFieldTableSeeder::class);
        $this->call(ContactsTablesSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(GeneralTableSeeder::class);
    }
}


dInteger('subproduct_id')->default(0);
            $table->unsignedInteger('qty')->nullable();
            $table->string('code')->nullable();
            $table->unsignedInteger('discount')->nullable();
            $table->decimal('old_price', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('currency')->nullable();
            $table->string('img')->nullable();
            $table->string('details')->nullable();
            $table->boolean('deleted')->default(0);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('crm_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_order_items');
    }
}
