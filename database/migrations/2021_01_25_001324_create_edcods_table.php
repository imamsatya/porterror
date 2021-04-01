<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdcodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edcods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('sls');
            $table->string('status');
            $table->string('catatan_error');
            $table->string('jawaban')->nullable();
            $table->timestamps();
        });

        Schema::table('edcods', function (Blueprint $table){
                $table->integer('kab_id')->unsigned()->nullable();
                $table->foreign('kab_id')->references('id')->on('kodekabs');
                
            });

            Schema::table('edcods', function (Blueprint $table){
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id')->references('id')->on('users');
                
            });

             Schema::table('edcods', function (Blueprint $table){
                $table->integer('kegiatan_id')->unsigned()->nullable();
                $table->foreign('kegiatan_id')->references('id')->on('kegiatans');
                
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edcods');
    }
}
