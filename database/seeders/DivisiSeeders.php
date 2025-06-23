<?php

namespace Database\Seeders;

use App\Models\Admin\ComunityModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisiSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ComunityModel::create([
            'image_divisi' => '',
            'name_divisi' => 'Divisi Eksternal'
        ]);

        ComunityModel::create([
            'image_divisi' => '',
            'name_divisi' => 'Divisi Internal'
        ]);
    }
}
