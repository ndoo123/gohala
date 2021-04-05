<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditProductTbAddSeo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('product_tb', 'metaTitle')) {
            Schema::table('product_tb', function (Blueprint $table) {
                $table->text('metaTitle')->after('default_photo');
                $table->text('metaKeywords')->after('metaTitle');
                $table->text('metaDescription')->after('metaKeywords');
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
        if (Schema::hasColumn('product_tb', 'metaTitle')) {
            Schema::table('product_tb', function (Blueprint $table) {
                $table->dropColumn(['metaTitle', 'metaKeywords', 'metaDescription']);
            });
        }
    }
}
