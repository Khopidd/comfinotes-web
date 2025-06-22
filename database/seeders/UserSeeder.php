<?php

namespace Database\Seeders;

use App\Models\Admin\AdminModel;
use App\Models\Admin\ComunityModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisi1 = ComunityModel::create(['name_divisi' => 'PDD']);
        $divisi2 = ComunityModel::create(['name_divisi' => 'Internal']);

        AdminModel::create([
            'image' => '',
            'username' => 'Khopid',
            'email' => 'admin01@gmail.com',
            'password' => Hash::make('password123'),
            'divisi_id' => null,
            'role' => 'admin',
        ]);

        AdminModel::create([
            'image' => '',
            'username' => 'Egy',
            'email' => 'admin02@gmail.com',
            'password' => Hash::make('password'),
            'divisi_id' => null,
            'role' => 'admin',
        ]);

        AdminModel::create([
            'image' => '',
            'username' => 'Azis',
            'email' => 'user01@gmail.com',
            'password' => Hash::make('password123'),
            'divisi_id' => $divisi1->id,
            'role' => 'user',
        ]);

        AdminModel::create([
            'image' => '',
            'username' => 'Azka',
            'email' => 'user02@gmail.com',
            'password' => Hash::make('password'),
            'divisi_id' => $divisi2->id,
            'role' => 'user',
        ]);
    }
}
