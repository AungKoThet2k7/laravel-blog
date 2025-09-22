<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'AK',
            'email' => 'ak@gmail.com',
            'role' => 'admin',
            'password' => Hash::make("asdffdsa"),
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make("asdffdsa"),
        ]);

        User::factory()->create([
            'name' => 'Test Editor',
            'email' => 'editor@gmail.com',
            'role' => 'editor',
            'password' => Hash::make("asdffdsa"),
        ]);

        User::factory()->create([
            'name' => 'Test Author',
            'email' => 'author@gmail.com',
            'role' => 'author',
            'password' => Hash::make("asdffdsa"),
        ]);

        User::factory(10)->create();
    }
}
