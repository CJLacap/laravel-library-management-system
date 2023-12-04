<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(20)->create();
        // \App\Models\Book::factory(20)->create();
        \App\Models\BookLocation::factory(50)->create();

        $this->call(UserTableSeeder::class);
        //24 categories
        $this->call(CategoriesTableSeeder::class);

        $category_id = DB::table('categories')->pluck('id');
        $book_ids = DB::table('books')->pluck('id');
        foreach ($book_ids as $book_id) {
            \App\Models\BookCategory::create([
                'book_id' => $book_id,
                'category_id' => rand(1,24)
            ]);
            
        }


    }
}
