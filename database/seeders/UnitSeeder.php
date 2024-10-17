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
        Unit::create([ // 1
            'nama_unit' => 'Ukarni',
            'tipe_data' => 'unit_kerja'
        ]);

        Unit::create([  // 2
            'nama_unit' => 'P3M',
            'tipe_data' => 'unit_kerja'
        ]);

        Unit::create([  // 3
            'nama_unit' => 'Penalaran',
            'tipe_data' => 'unit_kerja'
        ]);

        Unit::create([  // 4
            'nama_unit' => 'Minat Bakat',
            'tipe_data' => 'unit_kerja'
        ]);

        Unit::create([  // 5
            'nama_unit' => 'Perencanaan',
            'tipe_data' => 'unit_kerja'
        ]);

        Unit::create([ //6
            'nama_unit' => 'P4MP Pembelajaran',
            'tipe_data' => 'unit_kerja'
        ]);

        Unit::create([ // 7
            'nama_unit' => 'P4MP SPM',
            'tipe_data' => 'unit_kerja'
        ]);

        Unit::create([ // 8
            'nama_unit' => 'Departemen Teknik Elektronika',
            'tipe_data' => 'departemen_kerja'
        ]);

        Unit::create([  // 9
            'nama_unit' => 'Departemen Teknik Informatika',
            'tipe_data' => 'departemen_kerja'
        ]);

        Unit::create([ // 10
            'nama_unit' => 'Departemen Teknik Mekanika Energi',
            'tipe_data' => 'departemen_kerja'
        ]);

        Unit::create([ // 11
            'nama_unit' => 'UPUK',
            'tipe_data' => 'unit_kerja'
        ]);

        Unit::create([ // 12
            'nama_unit' => 'BAK',
            'tipe_data' => 'unit_kerja'
        ]);

        Unit::create([ // 13
            'nama_unit' => 'SPI',
            'tipe_data' => 'unit_kerja'
        ]);
    }
}
