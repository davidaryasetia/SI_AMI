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
        ]);

        Unit::create([  // 2
            'nama_unit' => 'P3M',
        ]);

        Unit::create([  // 3
            'nama_unit' => 'Penalaran',
        ]);

        Unit::create([  // 4
            'nama_unit' => 'Minat Bakat',
        ]);

        Unit::create([  // 5
            'nama_unit' => 'Perencanaan',
        ]);

        Unit::create([ //6
            'nama_unit' => 'P4MP Pembelajaran',
        ]);

        Unit::create([ // 7
            'nama_unit' => 'P4MP SPM',
        ]);

        Unit::create([ // 8
            'nama_unit' => 'Departemen Teknik Elektronika',
        ]);

        Unit::create([  // 9
            'nama_unit' => 'Departemen Teknik Informatika',
        ]);

        Unit::create([ // 10
            'nama_unit' => 'Departemen Teknik Mekanika Energi',
        ]);


        Unit::create([ // 11
            'nama_unit' => 'UPUK',
        ]);

        Unit::create([ // 12
            'nama_unit' => 'BAK',
        ]);

        Unit::create([ // 13
            'nama_unit' => 'SPI',
        ]);
    }
}
