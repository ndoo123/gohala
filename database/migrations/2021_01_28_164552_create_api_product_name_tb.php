<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiProductNameTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('api_product_name_tb')) {
            Schema::create('api_product_name_tb', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name',100);
                $table->tinyInteger('status')->default(1);
            });

            DB::table('api_product_name_tb')->insert([
                ['id' => 1, 'name' => 'Facebook'],
                ['id' => 2, 'name' => 'Lazada'],
                ['id' => 3, 'name' => 'Shopee'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_product_name_tb');
    }
}
