<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductCategoryTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('shop_category_tb'))
        {
            Schema::create('shop_category_tb', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('shop_id');
                $table->integer('user_id')->index();
                $table->string('name');
                $table->integer('parent_id')->nullable();
                $table->tinyInteger('is_active')->default("0");
                $table->string('slug');
                $table->timestamps();
            });
        }
        if(!Schema::hasTable('shop_category_product_tb'))
        {
            Schema::create('shop_category_product_tb', function (Blueprint $table) {
                $table->integer('shop_id');
                $table->integer('category_id')->index();
                $table->integer('product_id');
                $table->primary(['category_id','product_id']);
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
        Schema::dropIfExists("shop_category_tb");
        Schema::dropIfExists("shop_category_product_tb");
    }
}
