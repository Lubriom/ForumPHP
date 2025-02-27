<?php

namespace Database\Factories;

use App\Models\Hilo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mensaje' => $this->faker->sentence(18), 
            'hilo_id' => Hilo::inRandomOrder()->first()->id, 
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
