<?php

namespace Database\Seeders;

use App\Models\Admin\ComunityModel;
use App\Models\Auth\AuthModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        AuthModel::create([
            'image' => '',
            'username' => 'Khopid',
            'email' => 'admin01@gmail.com',
            'password' => Hash::make('password123'),
            'divisi_id' => null,
            'role' => 'admin',
        ]);

        AuthModel::create([
            'image' => '',
            'username' => 'Egy',
            'email' => 'admin02@gmail.com',
            'password' => Hash::make('password'),
            'divisi_id' => null,
            'role' => 'admin',
        ]);

        AuthModel::create([
            'image' => '',
            'username' => 'Divisi Eksternal',
            'email' => 'user01@gmail.com',
            'password' => Hash::make('password123'),
            'divisi_id' => 1,
            'role' => 'user',
        ]);

        AuthModel::create([
            'image' => '',
            'username' => 'Divisi Internal',
            'email' => 'user02@gmail.com',
            'password' => Hash::make('password'),
            'divisi_id' => 2,
            'role' => 'user',
        ]);
    }
}
