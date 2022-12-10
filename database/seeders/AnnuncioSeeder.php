<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Annuncio;
use \App\Models\DataLayer;

class AnnuncioSeeder extends Seeder
{
    /**
     * php artisan db:seed --class=AnnuncioSeeder
     *
     * @return void
     */
    public function run()
    {
        $dl = new Datalayer;
        $lista_aziende = json_decode($dl->listaAziende());
        $lista_contratti = $dl->get_enum_values ('Annuncio','tipo_contratto');
        for($i=0;$i<10;$i++){
            $azienda = $lista_aziende[array_rand($lista_aziende)];
            $contratto = $lista_contratti[array_rand($lista_contratti)];
            \App\Models\Annuncio::factory()->count(1)->create(['id_utente' => $azienda->id,'tipo_contratto'=>$contratto]);
        }
        
    }
}
