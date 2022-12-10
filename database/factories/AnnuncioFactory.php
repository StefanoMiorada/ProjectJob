<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Annuncio>
 */
class AnnuncioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'posizione' => fake()->jobTitle(),
            'luogo' => fake()->city(),
            'dettagli' => fake()->sentence(rand(10, 50)),
            'richieste' => fake()->sentence(rand(10, 50))
        ];
    }
}
