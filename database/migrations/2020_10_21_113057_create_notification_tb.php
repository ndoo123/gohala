<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('notification_tb')) {
            Schema::create('notification_tb', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->nullable();
                $table->integer('shop_id');
                $table->string('order_id',20)->nullable();
                $table->mediumInteger('event_id');
                $table->text('info');
                $table->tinyInteger('is_read')->default(0);
                $table->tinyInteger('is_read_global')->default(0);
                $table->text('user_info');
                $table->tinyInteger('user_is_read')->default(0);
                $table->tinyInteger('user_is_read_global')->default(0);
                $table->timestamps();
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
        Schema::dropIfExists('notification_tb');
    }
}
