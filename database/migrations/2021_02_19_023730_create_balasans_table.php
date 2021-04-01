<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balasans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('balasan')->nullable();

            $table->timestamps();
        });

        Schema::table('balasans', function (Blueprint $table){
                $table->integer('edcod_id')->unsigned()->nullable();
                $table->foreign('edcod_id')->references('id')->on('edcods');
                
            });

            Schema::table('balasans', function (Blueprint $table){
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id')->references('id')->on('users');
                
            });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawabans');
    }
}
