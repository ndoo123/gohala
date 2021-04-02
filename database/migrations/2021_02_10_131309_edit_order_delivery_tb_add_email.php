<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditOrderDeliveryTbAddEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_delivery_tb', function (Blueprint $table) {
            $table->string('email')->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		if (Schema::hasColumn('order_delivery_tb', 'email')) {
            Schema::table('order_delivery_tb', function (Blueprint $table) {
				$table->dropColumn('email');
            });
		}
    }
}
