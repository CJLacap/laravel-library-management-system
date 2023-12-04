<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence($nbWords = 9, $variableNbWords = true),
            'author_id' => Author::factory(),
            'isbn' => fake()->isbn13(),
            'publisher_id' => Publisher::factory(),
            'publication_year' => fake()->year(),
            'copies' => rand(1,2),
            'status' => 'available',


        ];
    }
}
