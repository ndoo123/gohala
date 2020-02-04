<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       

        if(!Schema::hasTable('user_tb'))
        {
            Schema::create('user_tb', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('id_card')->nullable();
                $table->string('phone')->nullable();
                $table->string('line')->nullable();
                $table->string('facebook')->nullable();
                $table->tinyInteger('user_type')->default("1")->comment="1= user,9= admin";   
                $table->string('profile_img')->nullable();
                $table->tinyInteger('is_active')->default("1");
                $table->rememberToken();
                $table->timestamps();
            });

            \DB::table('user_tb')->insert(['name'=>'ผู้ดูแลระบบ','email'=>'admin@admin.com','password'=>\Hash::make('123456'),'user_type'=>"9","created_at"=>date('Y-m-d H:i:s'),"updated_at"=>date('Y-m-d H:i:s')]);
        }

        if(!Schema::hasTable('user_address_tb'))
        {
            Schema::create('user_address_tb', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->string('name_address');
                $table->string('name_contact');
                $table->string('phone');
                $table->string('address');
                $table->integer('province_id');
                $table->string('zipcode',20);
                $table->tinyInteger('is_default')->default("0");
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
        
       
        Schema::dropIfExists('user_tb');
        Schema::dropIfExists('user_address_tb');
        
    }
}
