<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOauthAuthCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_auth_codes', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->bigInteger('user_id');
            $table->unsignedInteger('client_id');
            $table->text('scopes')->nullable();
            $table->boolean('revoked');
            $table->dateTime('expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oauth_auth_codes');
    }
}

-m-d H:i:s"), ),
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

tring('treshold')->nullable();
            $table->string('period')->nullable();
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
        Schema::dropIfExists('promocode_types');
    }
}

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
