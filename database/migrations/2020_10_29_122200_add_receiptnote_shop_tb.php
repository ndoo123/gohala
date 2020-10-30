<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReceiptnoteShopTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shop_tb', function (Blueprint $table) {
            $table->string('receipt_note')->after('receipt_type')->default("* ขอบคุณ *");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		if (Schema::hasColumn('shop_tb', 'receipt_note')) {
            Schema::table('shop_tb', function (Blueprint $table) {
				$table->dropColumn('receipt_note');
            });
		}
    }
}
