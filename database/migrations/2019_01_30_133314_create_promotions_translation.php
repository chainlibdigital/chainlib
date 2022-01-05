<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions_translation', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->unsignedInteger('lang_id')->nullable();
            $table->unsignedInteger('promotion_id')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->string('banner')->nullable();
            $table->string('banner_mob')->nullable();
            $table->text('seo_text')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->timestamps();

            $table->foreign('lang_id')->references('id')->on('langs')->onDelete('cascade');
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions_translation');
    }
}

pdated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'surname',
            'type' => 'text',
            'field_group' => 'personaldata',
            'in_register' => 1,
            'in_cabinet' => 1,
            'in_cart' => 1,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 1,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'email',
            'type' => 'email',
            'field_group' => 'personaldata',
            'in_register' => 1,
            'in_cabinet' => 1,
            'in_cart' => 1,
            'in_auth' => 1,
            'unique_field' => 1,
            'required_field' => 1,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'phone',
            'type' => 'text',
            'field_group' => 'personaldata',
            'in_register' => 1,
            'in_cabinet' => 1,
            'in_cart' => 1,
            'in_auth' => 0,
            'unique_field' => 1,
            'required_field' => 1,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'birthday',
            'type' => 'date',
            'field_group' => 'personaldata',
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
            'field' => 'terms_agreement',
            'type' => 'checkbox',
            'field_group' => 'personaldata',
            'in_register' => 1,
            'in_cabinet' => 1,
            'in_cart' => 1,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 1,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'promo_agreement',
            'type' => 'checkbox',
            'field_group' => 'personaldata',
            'in_register' => 1,
            'in_cabinet' => 1,
            'in_cart' => 1,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 0,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'personaldata_agreement',
            'type' => 'checkbox',
            'field_group' => 'personaldata',
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
            'field' => 'addressname',
            'type' => 'text',
            'field_group' => 'address',
            'in_register' => 0,
            'in_cabinet' => 1,
            'in_cart' => 1,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 1,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'country',
            'type' => 'select',
            'field_group' => 'address',
            'in_register' => 0,
            'in_cabinet' => 1,
            'in_cart' => 1,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 1,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'region',
            'type' => 'select',
            'field_group' => 'address',
            'in_register' => 0,
            'in_cabinet' => 1,
            'in_cart' => 1,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 1,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'location',
            'type' => 'select',
            'field_group' => 'address',
            'in_register' => 0,
            'in_cabinet' => 1,
            'in_cart' => 1,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 1,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'address',
            'type' => 'text',
            'field_group' => 'address',
            'in_register' => 0,
            'in_cabinet' => 1,
            'in_cart' => 0,
            'in_auth' => 0,
            'unique_field' => 0,
            'required_field' => 1,
            'return_field' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('userfields')->insert([
            'field' => 'code',
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
            'field' => 'apartment',
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
            'field' => 'company',
            'type' => 'text',
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
            'field' => 'companyaddress',
            'type' => 'text',
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
            'field' => 'fisc',
            'type' => 'text',
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

')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedInteger('spam')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_users_unlogged');
    }
}
