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

->onDelete('cascade');
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
