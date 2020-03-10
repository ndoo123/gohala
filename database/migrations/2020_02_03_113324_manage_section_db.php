<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManageSectionDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //SYSTEM
        if (!Schema::hasTable('province_tb')) {
            Schema::create('province_tb', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('name_en');
            });
            DB::table('province_tb')->insert([
                array("id"=>"1","name"=>"กรุงเทพมหานคร","name_en"=>"Bangkok"),
                array("id"=>"2","name"=>"สมุทรปราการ","name_en"=>"Samut Prakan"),
                array("id"=>"3","name"=>"นนทบุรี","name_en"=>"Nonthaburi"),
                array("id"=>"4","name"=>"ปทุมธานี","name_en"=>"Pathum Thani"),
                array("id"=>"5","name"=>"พระนครศรีอยุธยา","name_en"=>"Phra Nakhon Si Ayutthaya"),
                array("id"=>"6","name"=>"อ่างทอง","name_en"=>"Ang Thong"),
                array("id"=>"7","name"=>"ลพบุรี","name_en"=>"Loburi"),
                array("id"=>"8","name"=>"สิงห์บุรี","name_en"=>"Sing Buri"),
                array("id"=>"9","name"=>"ชัยนาท","name_en"=>"Chai Nat"),
                array("id"=>"10","name"=>"สระบุรี","name_en"=>"Saraburi"),
                array("id"=>"11","name"=>"ชลบุรี","name_en"=>"Chon Buri"),
                array("id"=>"12","name"=>"ระยอง","name_en"=>"Rayong"),
                array("id"=>"13","name"=>"จันทบุรี","name_en"=>"Chanthaburi"),
                array("id"=>"14","name"=>"ตราด","name_en"=>"Trat"),
                array("id"=>"15","name"=>"ฉะเชิงเทรา","name_en"=>"Chachoengsao"),
                array("id"=>"16","name"=>"ปราจีนบุรี","name_en"=>"Prachin Buri"),
                array("id"=>"17","name"=>"นครนายก","name_en"=>"Nakhon Nayok"),
                array("id"=>"18","name"=>"สระแก้ว","name_en"=>"Sa Kaeo"),
                array("id"=>"19","name"=>"นครราชสีมา","name_en"=>"Nakhon Ratchasima"),
                array("id"=>"20","name"=>"บุรีรัมย์","name_en"=>"Buri Ram"),
                array("id"=>"21","name"=>"สุรินทร์","name_en"=>"Surin"),
                array("id"=>"22","name"=>"ศรีสะเกษ","name_en"=>"Si Sa Ket"),
                array("id"=>"23","name"=>"อุบลราชธานี","name_en"=>"Ubon Ratchathani"),
                array("id"=>"24","name"=>"ยโสธร","name_en"=>"Yasothon"),
                array("id"=>"25","name"=>"ชัยภูมิ","name_en"=>"Chaiyaphum"),
                array("id"=>"26","name"=>"อำนาจเจริญ","name_en"=>"Amnat Charoen"),
                array("id"=>"27","name"=>"หนองบัวลำภู","name_en"=>"Nong Bua Lam Phu"),
                array("id"=>"28","name"=>"ขอนแก่น","name_en"=>"Khon Kaen"),
                array("id"=>"29","name"=>"อุดรธานี","name_en"=>"Udon Thani"),
                array("id"=>"30","name"=>"เลย","name_en"=>"Loei"),
                array("id"=>"31","name"=>"หนองคาย","name_en"=>"Nong Khai"),
                array("id"=>"32","name"=>"มหาสารคาม","name_en"=>"Maha Sarakham"),
                array("id"=>"33","name"=>"ร้อยเอ็ด","name_en"=>"Roi Et"),
                array("id"=>"34","name"=>"กาฬสินธุ์","name_en"=>"Kalasin"),
                array("id"=>"35","name"=>"สกลนคร","name_en"=>"Sakon Nakhon"),
                array("id"=>"36","name"=>"นครพนม","name_en"=>"Nakhon Phanom"),
                array("id"=>"37","name"=>"มุกดาหาร","name_en"=>"Mukdahan"),
                array("id"=>"38","name"=>"เชียงใหม่","name_en"=>"Chiang Mai"),
                array("id"=>"39","name"=>"ลำพูน","name_en"=>"Lamphun"),
                array("id"=>"40","name"=>"ลำปาง","name_en"=>"Lampang"),
                array("id"=>"41","name"=>"อุตรดิตถ์","name_en"=>"Uttaradit"),
                array("id"=>"42","name"=>"แพร่","name_en"=>"Phrae"),
                array("id"=>"43","name"=>"น่าน","name_en"=>"Nan"),
                array("id"=>"44","name"=>"พะเยา","name_en"=>"Phayao"),
                array("id"=>"45","name"=>"เชียงราย","name_en"=>"Chiang Rai"),
                array("id"=>"46","name"=>"แม่ฮ่องสอน","name_en"=>"Mae Hong Son"),
                array("id"=>"47","name"=>"นครสวรรค์","name_en"=>"Nakhon Sawan"),
                array("id"=>"48","name"=>"อุทัยธานี","name_en"=>"Uthai Thani"),
                array("id"=>"49","name"=>"กำแพงเพชร","name_en"=>"Kamphaeng Phet"),
                array("id"=>"50","name"=>"ตาก","name_en"=>"Tak"),
                array("id"=>"51","name"=>"สุโขทัย","name_en"=>"Sukhothai"),
                array("id"=>"52","name"=>"พิษณุโลก","name_en"=>"Phitsanulok"),
                array("id"=>"53","name"=>"พิจิตร","name_en"=>"Phichit"),
                array("id"=>"54","name"=>"เพชรบูรณ์","name_en"=>"Phetchabun"),
                array("id"=>"55","name"=>"ราชบุรี","name_en"=>"Ratchaburi"),
                array("id"=>"56","name"=>"กาญจนบุรี","name_en"=>"Kanchanaburi"),
                array("id"=>"57","name"=>"สุพรรณบุรี","name_en"=>"Suphan Buri"),
                array("id"=>"58","name"=>"นครปฐม","name_en"=>"Nakhon Pathom"),
                array("id"=>"59","name"=>"สมุทรสาคร","name_en"=>"Samut Sakhon"),
                array("id"=>"60","name"=>"สมุทรสงคราม","name_en"=>"Samut Songkhram"),
                array("id"=>"61","name"=>"เพชรบุรี","name_en"=>"Phetchaburi"),
                array("id"=>"62","name"=>"ประจวบคีรีขันธ์","name_en"=>"Prachuap Khiri Khan"),
                array("id"=>"63","name"=>"นครศรีธรรมราช","name_en"=>"Nakhon Si Thammarat"),
                array("id"=>"64","name"=>"กระบี่","name_en"=>"Krabi"),
                array("id"=>"65","name"=>"พังงา","name_en"=>"Phangnga"),
                array("id"=>"66","name"=>"ภูเก็ต","name_en"=>"Phuket"),
                array("id"=>"67","name"=>"สุราษฎร์ธานี","name_en"=>"Surat Thani"),
                array("id"=>"68","name"=>"ระนอง","name_en"=>"Ranong"),
                array("id"=>"69","name"=>"ชุมพร","name_en"=>"Chumphon"),
                array("id"=>"70","name"=>"สงขลา","name_en"=>"Songkhla"),
                array("id"=>"71","name"=>"สตูล","name_en"=>"Satun"),
                array("id"=>"72","name"=>"ตรัง","name_en"=>"Trang"),
                array("id"=>"73","name"=>"พัทลุง","name_en"=>"Phatthalung"),
                array("id"=>"74","name"=>"ปัตตานี","name_en"=>"Pattani"),
                array("id"=>"75","name"=>"ยะลา","name_en"=>"Yala"),
                array("id"=>"76","name"=>"นราธิวาส","name_en"=>"Narathiwat"),
                array("id"=>"77","name"=>"บึงกาฬ","name_en"=>"buogkan")
            ]);
        }

        if(!Schema::hasTable('category_tb'))
        {
            Schema::create('category_tb', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('slug');
                $table->integer("parent_id")->nullable();

            });
            \DB::table('category_tb')->insert([
                ['name'=>'อุปกรณ์ไฟฟ้า','slug'=>'อุปกรณ์ไฟฟ้า'],
                ['name'=>'เครื่องสำอาง','slug'=>'เครื่องสำอาง']
            ]);
        }
        if(!Schema::hasTable('payment_method_tb'))
        {
            Schema::create('payment_method_tb', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
            });
            \DB::table('payment_method_tb')->insert([
                ['name'=>'เงินสด'],
                ['name'=>'โอนเงิน'],
            ]);
        }
        if(!Schema::hasTable('ship_method_tb'))
        {
            Schema::create('ship_method_tb', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
            });
            \DB::table('ship_method_tb')->insert([
                ['name'=>'Kerry'],
                ['name'=>'ไปรษณีย์'],
            ]);
        }
        //END SYSTEM

        if(!Schema::hasTable('shop_tb'))
        {
            Schema::create('shop_tb', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->comment="owner id";
                $table->string('url')->unique();
                $table->string('name');
                $table->string('tax_id')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->string('facebook')->nullable();
                $table->string('line')->nullable();
                $table->string('address')->nullable();
                $table->integer('province_id');
                $table->string('zipcode',20)->nullable();
                $table->integer('run_sku_id')->default(1);
                $table->integer('run_order_id')->default(1);
                $table->integer('run_receipt_id')->default(1);
                $table->tinyInteger('is_open')->default("1");
                $table->timestamps();
                
            });
        }
        if(!Schema::hasTable('shop_payment_tb'))
        {
            Schema::create('shop_payment_tb', function (Blueprint $table) {
                $table->integer('shop_id');
                $table->integer('method_id');
                $table->text('payment_data')->nullable();
                $table->primary(['shop_id','method_id']);
                
            });
        }
        if(!Schema::hasTable('shop_shipping_tb'))
        {
            Schema::create('shop_shipping_tb', function (Blueprint $table) {
                $table->integer('shop_id');
                $table->integer('shipping_id');
                $table->decimal('ship_cost',10,2);
                $table->tinyInteger('cal_type')->default("1")->comment="1=all one price,2=multiple by qty";
                $table->primary(['shop_id','shipping_id']);
            });
        }

        if(!Schema::hasTable('product_tb'))
        {
            Schema::create('product_tb', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('shop_id')->unsigned();
                $table->string('sku',20);
                $table->string('name');
                $table->string('info_short')->nullable();
                $table->string('info_full')->nullable();
                $table->integer('category_id');
               
                $table->integer('qty')->default(1);
                $table->decimal('cost',10,2);
                $table->decimal('price',10,2);
                $table->tinyInteger('is_discount')->default("0")->comment="0= no discount,1=discount amount,2=discount percent";
                $table->decimal('discount_value',10,2)->default("0.00");
                $table->tinyInteger('status')->default("1")->comment="0=not show,1=available,2=show out of stock";
                $table->tinyInteger('is_pos')->default("1");
                $table->tinyInteger('is_ecom')->default("1");
                $table->decimal('rate')->default("0.00");
                // $table->integer('run_photo_id')->default("1");
                $table->string('slug')->nullable();
                $table->string('default_photo')->nullable();
                $table->timestamps();
           
            });
        }
        if(!Schema::hasTable('product_slug_tb'))
        {
            Schema::create('product_slug_tb', function (Blueprint $table) {
               
                $table->integer('shop_id')->unsigned();
                $table->integer('product_id')->unsigned();
                $table->string('slug');
                $table->primary(['product_id','slug']);
            });
            
        }
        if(!Schema::hasTable('product_photo_tb'))
        {
            Schema::create('product_photo_tb', function (Blueprint $table) {
                $table->integer('product_id');
                $table->string('name');
                $table->integer('shop_id')->unsigned();
                // $table->string('real_name');
                // $table->string('name');
                $table->tinyInteger('photo_type')->default("1")->comment="1=common,2=bank slip";
                $table->tinyInteger('is_default')->default("0");
                $table->timestamps();
                $table->primary(['product_id','name']);
            });
        }
        if(!Schema::hasTable('receipt_tb'))
        {
            Schema::create('receipt_tb', function (Blueprint $table) {
               // receipt items ใช้ อันเดียวกับ order_item_tb เลย
                $table->string('id',20)->primary()->comment="R+shop_id+#+y+m+run_receipt_id";
                $table->integer('shop_id')->unsigned();
                $table->string('order_id');
                $table->string('bill_title');
                $table->string('bill_address');
                $table->string('bill_tax');
                $table->tinyInteger('receipt_type')->default("1")->comment="1=receipt,2=tax invoice";
                $table->tinyInteger("channel_id")->default("1")->comment="1=online,2=pos";
                $table->tinyInteger('status')->default("1")->comment="0=ยกเลิก,1= ชำระแล้ว";
                $table->string('shipping_code',20)->nullable();
                $table->datetime('order_date');
                $table->datetime('paid_date');
                $table->decimal('total',10,2);
                $table->integer('seller_user_id')->nullable()->comment="id ผุ้ขาย";
                $table->integer('buyer_user_id')->nullable()->comment="ชื่อผู้ซื้อ สามารถว่างได้ กรณีไม่ใช่เมมเบอร์";
                $table->timestamps();
            });
        }
        if(!Schema::hasTable('order_payment_tb'))
        {
            Schema::create('order_payment_tb', function (Blueprint $table) {
                $table->string('order_id',20);
                $table->integer('id')->comment="ใช้ run_item_id ของ orde_tb";
                $table->tinyInteger("payment_method_id")->default("1")->comment="ดู table payment_method_tb";
                $table->decimal('amount',10,2);
                $table->string('credit_name')->nullable();
                $table->string('credit_no')->nullable();
                $table->string('credit_exp')->nullable();
                $table->primary(['order_id','id']);
            });
        }
        if(!Schema::hasTable('order_tb'))
        {
            Schema::create('order_tb', function (Blueprint $table) {
               
                $table->string('id',20)->primary()->comment="O+y+m+(shop_id 3 digits)+shop run order_id";
                $table->integer('shop_id')->unsigned();
                $table->tinyInteger("channel_id")->default("1")->comment="1=online,2=pos";
                $table->tinyInteger('status')->default("1")->comment="0=ยกเลิก,1= สั่งซื้อ,2=ยืนยัน,3=จัดส่ง,4=ส่งสำเร็จ";
                $table->string('shipping_code',20)->nullable();
                $table->integer('shipping_id')->comment="0=หน้าร้าน/pos, >=1 ดูที่ shipping_method";
                $table->datetime('order_date');
                $table->decimal('total',10,2);
                $table->integer('seller_user_id')->nullable()->comment="id ผุ้ขาย";
                $table->integer('buyer_user_id')->nullable()->comment="ชื่อผู้ซื้อ สามารถว่างได้ กรณีไม่ใช่เมมเบอร์";
                $table->integer('run_item_id')->default(1);
                $table->timestamps();
            });
        }
        if(!Schema::hasTable('order_item_tb'))
        {
            Schema::create('order_item_tb', function (Blueprint $table) {
               
                $table->string('order_id',20)->comment="order_id";
                $table->integer('id')->comment="run_item_id";
                $table->integer("product_id");
                $table->string('product_name');
                $table->string('remark');
                $table->integer('qty')->default(0);
                $table->decimal('price',10,2);
                $table->decimal('total',10,2);
                $table->tinyInteger('status')->default("1")->comment="1 need confirm,2=confirm item";
                $table->primary(['order_id','id']);

            });
        }
        if(!Schema::hasTable('order_delivery_tb'))
        {
            Schema::create('order_delivery_tb', function (Blueprint $table) {
               
                $table->string('order_id',20)->primary()->comment="order_id";
                $table->datetime('confirm_date')->nullable();
                $table->datetime('delivery_date')->nullable();
                $table->datetime('received_date')->nullable();
                $table->string('name');
                $table->string('address');
                $table->integer('province_id');
                $table->string('zipcode',20);
                $table->string('phone',100);
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
        
        Schema::dropIfExists('category_tb');
        Schema::dropIfExists('payment_method_tb');
        Schema::dropIfExists('ship_method_tb');
        Schema::dropIfExists('product_slug_tb');
        Schema::dropIfExists('product_tb');
        Schema::dropIfExists('product_photo_tb');
        Schema::dropIfExists('shop_tb');
        Schema::dropIfExists('shop_payment_tb');
        Schema::dropIfExists('shop_shipping_tb');
        Schema::dropIfExists('province_tb');
        Schema::dropIfExists('order_tb');
        Schema::dropIfExists('order_item_tb');
        Schema::dropIfExists('order_delivery_tb');  
        Schema::dropIfExists('receipt_tb');    
        Schema::dropIfExists('order_payment_tb'); 
        Schema::dropIfExists('shop_category_tb'); 
        
        
          

    }
}
