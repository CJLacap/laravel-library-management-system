<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin@email.com',
                'password' => bcrypt('123'),
                'role' => 'admin',
                'status' => 'active',
            ],

            [
                'first_name' => 'Librarian',
                'last_name' => 'User',
                'email' => 'librarian@email.com',
                'password' => bcrypt('123'),
                'role' => 'librarian',
                'status' => 'active',
            ],

            [
                'first_name' => 'User',
                'last_name' => 'User',
                'email' => 'user@email.com',
                'password' => bcrypt('123'),
                'role' => 'user',
                'status' => 'active',
            ]
        ];

        foreach ($users as $key => $user){
            User::create($user);
        }
    }
}
