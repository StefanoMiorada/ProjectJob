<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreazioneTabellaCandidatura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('candidatura',function(Blueprint $table){
            $table->increments('id');
            $table->text('lettera_motivazionale');
            $table->string('cv_path');
            $table->integer('id_annuncio')->unsigned();
            $table->foreign('id_annuncio')->references('id')->on('annuncio')->onDelete('cascade');
            $table->integer('id_utente')->unsigned();
            $table->foreign('id_utente')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
