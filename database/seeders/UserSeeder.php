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
     */
    public function run(): void
    {
        User::create([
            'image' => '',
            'username' => 'Khopid',
            'email' => 'admin01@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'image' => '',
            'username' => 'Egy',
            'email' => 'admin02@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'image' => '',
            'username' => 'Azis',
            'email' => 'user01@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        User::create([
            'image' => '',
            'username' => 'Azka',
            'email' => 'user02@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
