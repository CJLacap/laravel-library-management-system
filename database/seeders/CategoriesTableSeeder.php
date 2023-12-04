<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Define categories data
         $categories = [
            ['name' => 'Fiction', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Non-Fiction', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Science Fiction', 'created_at' => now(), 'updated_at' => now()],
            ['name' => "Children's and Young Adult", 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mystery/Thriller', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Science Fiction and Fantasy', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Romance', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Horror', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Historical Fiction', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Science and Nature', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Self-Help and Personal Development', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Philosophy', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Religion and Spirituality', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'History', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Art and Photography', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Business and Economics', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cookbooks and Food', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Travel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Poetry', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Drama and Plays', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Comics and Graphic Novels', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Reference', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Humor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sports and Outdoors', 'created_at' => now(), 'updated_at' => now()],

        ];

        // Insert data into the categories table
        DB::table('categories')->insert($categories);
    }
}
