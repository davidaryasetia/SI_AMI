<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Unit
        Unit::create([
            'nama_unit' => 'Ukarni',
        ]);
        Unit::create([
            'nama_unit' => 'P3M',
        ]);
        Unit::create([
            'nama_unit' => 'Penalaran',
        ]);
        Unit::create([
            'nama_unit' => 'Minat Bakat',
        ]);
        Unit::create([
            'nama_unit' => 'Perencanaan',
        ]);
        Unit::create([
            'nama_unit' => 'P4MP Pembelajaran',
        ]);
        Unit::create([
            'nama_unit' => 'P4MP SPM',
        ]);
        Unit::create([
            'nama_unit' => 'Departemen Teknik Informatika',
        ]);
        Unit::create([
            'nama_unit' => 'Departemen Teknik Elektronika',
        ]);
        Unit::create([
            'nama_unit' => 'Departemen Teknik Mekanika Energi',
        ]);
    }
}
