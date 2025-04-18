<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cat>
 */
class CatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'age' => fake()->numberBetween(1, 38),
            'likes' => fake()->randomElement([
                'sunbathing', 'chasing lasers', 'napping', 'treats', 'cardboard boxes',
                'birdwatching', 'being brushed', 'knocking things over'
            ]),
        ];
    }
}
