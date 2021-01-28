<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiPriceTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('api_product_price_tb')) {
            Schema::create('api_product_price_tb', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('product_id');
                $table->integer('shop_id');
                $table->string('name',100);
                $table->decimal('price',10,2)->default(0.00);
                $table->tinyInteger('status')->default(0);
                $table->timestamps();
                // $table->primary('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_product_price_tb');
    }
}
