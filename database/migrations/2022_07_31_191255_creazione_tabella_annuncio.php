<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreazioneTabellaAnnuncio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('annuncio', function(Blueprint $table){
            $table->increments('id');
            $table->string('posizione');
            $table->string('luogo');
            $table->text('dettagli');
            $table->text('richieste');
            $table->enum('tipo_contratto', ['tempo determinato', 'tempo indeterminato', 'apprendistato',
            'stage curriculare','stage extracurriculare']);
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
