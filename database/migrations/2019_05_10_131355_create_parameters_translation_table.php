<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametersTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters_translation', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->unsignedInteger('lang_id')->nullable();
            $table->unsignedInteger('parameter_id')->nullable();
            $table->string('name')->nullable();
            $table->string('unit')->nullable();

            $table->timestamps();

            $table->foreign('lang_id')->references('id')->on('langs')->onDelete('cascade');
            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameters_translation');
    }
}

t',
            'field_group' => 'company',
            'in_register' => 0,
            'in_cabinet' => 0,
            'in_cart' => 0,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 0,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'priorityaddress',
            'type' => 'select',
            'field_group' => 'priorityaddress',
            'in_register' => 0,
            'in_cabinet' => 1,
            'in_cart' => 0,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 0,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'homenumber',
            'type' => 'text',
            'field_group' => 'address',
            'in_register' => 0,
            'in_cabinet' => 1,
            'in_cart' => 0,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 0,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'entrance',
            'type' => 'text',
            'field_group' => 'address',
            'in_register' => 0,
            'in_cabinet' => 1,
            'in_cart' => 0,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 0,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'floor',
            'type' => 'text',
            'field_group' => 'address',
            'in_register' => 0,
            'in_cabinet' => 1,
            'in_cart' => 0,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 0,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'comment',
            'type' => 'text',
            'field_group' => 'address',
            'in_register' => 0,
            'in_cabinet' => 1,
            'in_cart' => 0,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 0,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'maxaddress',
            'type' => 'select',
            'field_group' => 'general',
            'value' => '10',
            'in_register' => 0,
            'in_cabinet' => 0,
            'in_cart' => 0,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 0,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'countries',
            'type' => 'select',
            'field_group' => 'general',
            'in_register' => 0,
            'in_cabinet' => 0,
            'in_cart' => 0,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 0,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'return_amount_days',
            'type' => 'text',
            'field_group' => 'general',
            'value' => 6,
            'in_register' => 0,
            'in_cabinet' => 1,
            'in_cart' => 0,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 0,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}

