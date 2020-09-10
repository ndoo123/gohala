<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class EditShopCateAddSort extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('shop_category_tb'))
        {
            Schema::table('shop_category_tb', function (Blueprint $table) {
                $table->mediumInteger('position')->default(0);
            });

			$shop = DB::table('shop_tb')->get();
			foreach($shop as $s)
			{
				$cate = DB::table('shop_category_tb')->where('shop_id',$s->id)->get();
				foreach($cate as $c_key => $c)
				{
					DB::table('shop_category_tb')->where('id',$c->id)->update(['position' => $c_key+1]);
					// DB::table('shop_category_tb')->where('id',$p->id)->update(['position'=>1]);
					// $p->save();
				}
			}
        }
		// DB::table('shop_category_tb')->all();
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('shop_category_tb', 'position')) {
            $table->dropColumn('position');
        }
    }
}
