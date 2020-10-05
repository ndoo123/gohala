<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class EditProductAddSort extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('product_tb'))
        {
            Schema::table('product_tb', function (Blueprint $table) {
                $table->mediumInteger('position')->default(0);
            });

			$shop = DB::table('shop_tb')->get();
			foreach($shop as $s)
			{
				$product = DB::table('product_tb')->where('shop_id',$s->id)->get();
				foreach($product as $p_key => $p)
				{
					DB::table('product_tb')->where('id',$p->id)->update(['position' => $p_key+1]);
					// DB::table('product_tb')->where('id',$p->id)->update(['position'=>1]);
					// $p->save();
				}
			}
        }
		// DB::table('product_tb')->all();
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('product_tb', 'position')) {
            Schema::table('product_tb', function (Blueprint $table) {
                $table->dropColumn('position');
            });
        }
    }
}
