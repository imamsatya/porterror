<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->string('fotoname');
            $table->string('path');
            $table->timestamps();
        });

                Schema::table('fotos', function (Blueprint $table){
                $table->integer('edcod_id')->unsigned()->nullable();
                $table->foreign('edcod_id')->references('id')->on('edcods');
                
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fotos');
    }
}
