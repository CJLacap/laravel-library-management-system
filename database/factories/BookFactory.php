<?php

namespace Database\Factories;

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
            'author_id' => '1',
            'isbn' => fake()->isbn10(),
            'publisher_id' => '2',
            'publication_year' => '2023',
            'copies' => '1',
            'status' => 'available',


        ];
    }
}
