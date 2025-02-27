<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static $usedCombinations = [];

    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $postIds = Post::pluck('id')->toArray();

        // Si no hay usuarios o posts, lanzar una excepción
        if (empty($userIds) || empty($postIds)) {
            throw new \Exception("No hay usuarios o posts en la base de datos.");
        }

        do {
            $user_id = $this->faker->randomElement($userIds);
            $post_id = $this->faker->randomElement($postIds);
            $key = "{$user_id}-{$post_id}"; // Clave única para la combinación
        } while (
            in_array($key, self::$usedCombinations) ||
            Like::where('user_id', $user_id)->where('post_id', $post_id)->exists()
        );

        // Registrar la combinación para que no se repita en esta ejecución
        self::$usedCombinations[] = $key;

        return [
            'user_id' => $user_id,
            'post_id' => $post_id
        ];
    }
}
