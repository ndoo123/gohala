<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTranferTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_tranfer_tb', function (Blueprint $table) {
            $table->string('order_id',20)->primary();
            $table->integer('shop_id');
            $table->integer('user_id');
            $table->string('bank_name');
            $table->string('account_name');
            $table->string('account_no');
            $table->dateTime('payment_date');
            // $table->string('payment_hour',2);
            // $table->string('payment_minute',2);
            $table->decimal('price',10,2);
            $table->text('payment_remark')->nullable();
            $table->text('payment_file');
			$table->timestamps();
            // $table->primary('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_tranfer_tb');
    }
}
