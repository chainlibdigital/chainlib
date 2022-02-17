<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

');
    ];
});


    public function down()
    {
        Schema::dropIfExists('oauth_refresh_tokens');
    }
}


;
            $table->text('motive')->nullable();
            $table->dateTime('datetime')->useCurrent();
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
        Schema::dropIfExists('returns');
    }
}

 mb_convert_encoding($row[1], 'utf8', 'cp1251');
        $product->stock = mb_convert_encoding($row[8], 'utf8', 'cp1251');
    ];
});

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

me' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

');
    ];
});


    public function down()
    {
        Schema::dropIfExists('oauth_refresh_tokens');
    }
}



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returns');
    }
}

n_register' => 1,
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


);
            $table->string('code')->nullable();
            $table->string('video')->nullable();
            $table->unsignedInteger('stock')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('actual_price', 10, 2)->nullable();
            $table->string('discount')->nullable();
            $table->string('discount_update')->nullable();
            $table->tinyInteger('hit')->nullable();
            $table->tinyInteger('recomended')->nullable();
            $table->unsignedInteger('position')->nullable();
            $table->unsignedInteger('succesion')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

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

me' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

');
    ];
});


    public function down()
    {
        Schema::dropIfExists('oauth_refresh_tokens');
    }
}



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returns');
    }
}

ng('region')->nullable();
            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->string('code')->nullable();
            $table->string('homenumber')->nullable();
            $table->string('entrance')->nullable();
            $table->string('floor')->nullable();
            $table->string('apartment')->nullable();
            $table->string('comment')->nullable();
            $table->timestamps();

            $table->foreign('front_user_id')->references('id')->on('front_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_user_addresses');
    }
}

