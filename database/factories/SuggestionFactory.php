<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Suggestion>
 */
class SuggestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Fake Suggestion',
            'short_description' => fake()->paragraph,
            'long_description' => fake()->paragraph,
            'user_id' => User::inRandomOrder()->first()->id,
            'status' => 1
        ];
    }
}
