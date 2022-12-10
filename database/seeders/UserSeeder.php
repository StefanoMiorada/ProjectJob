<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // creazione di 10 utenti (non azienda)
        for($i=0;$i<10;$i++){
            $faker = \Faker\Factory::create();
            \App\Models\User::factory()->count(1)->create(['is_azienda' => 0,'nome'=> $faker->name(),'cognome'=>$faker->lastName()]);
        }
        //creazione di 10 aziende
        for($i=0;$i<10;$i++){
            $faker = \Faker\Factory::create();
            \App\Models\User::factory()->count(1)->create(['is_azienda' => 1,'nome_azienda'=> $faker->company()]);
        }
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
