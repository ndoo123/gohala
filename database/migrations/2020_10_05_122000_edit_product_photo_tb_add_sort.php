<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditProductPhotoTbAddSort extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_photo_tb', function (Blueprint $table) {
            $table->tinyInteger('position')->after('is_default');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		if (Schema::hasColumn('product_photo_tb', 'position')) {
            Schema::table('product_photo_tb', function (Blueprint $table) {
				$table->dropColumn('position');
            });
		}
    }
}
