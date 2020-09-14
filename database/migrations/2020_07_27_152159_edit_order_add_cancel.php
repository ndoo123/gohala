<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditOrderAddCancel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('order_tb'))
        {
            Schema::table('order_tb', function (Blueprint $table) {
                $table->text('cancel_remark')->nullable();
                $table->tinyInteger('cancel_by')->comment('1=shop,2=customer')->nullable();
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
        if (Schema::hasColumn('order_tb', 'cancel_remark')) {
            $table->dropColumn('cancel_remark');
        }
        if (Schema::hasColumn('order_tb', 'cancel_by')) {
            $table->dropColumn('cancel_by');
        }
    }
}
