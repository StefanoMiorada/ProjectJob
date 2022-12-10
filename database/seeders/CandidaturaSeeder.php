<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Candidatura;
use \App\Models\DataLayer;

class CandidaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dl = new Datalayer;
        $lista_utenti = json_decode($dl->listaUtenti());
        $lista_annunci = json_decode($dl->listaAnnunci());
        for($i=0;$i<10;$i++){
            $faker = \Faker\Factory::create();
            $utente = $lista_utenti[array_rand($lista_utenti)];
            $annuncio = $lista_annunci[array_rand($lista_annunci)];
            Candidatura::create([
                'id_utente' => $utente->id,
                'id_annuncio' => $annuncio->id,
                'lettera_motivazionale'=>$faker->sentence(rand(20, 80)),
                'cv_path'=> $faker->image('C:\Users\stefano\ProjectJob\storage\app\public\files', 640, 480, 'animals', false,true, 'cats', true, 'jpg')
            ]);
            
        }
    }
}
