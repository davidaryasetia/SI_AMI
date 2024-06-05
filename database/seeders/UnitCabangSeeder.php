<?php

namespace Database\Seeders;

use App\Models\UnitBranch;
use App\Models\UnitCabang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitCabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # Departemen Teknik Elektronika
        UnitCabang::create([ // 1
            'unit_id' => '8',
            'nama_unit_cabang' => 'D4 Teknik Elektronika',
        ]);
        UnitCabang::create([ // 2
            'unit_id' => '8',
            'nama_unit_cabang' => 'D3 Teknik Elektronika',
        ]);
        UnitCabang::create([ // 3
            'unit_id' => '8',
            'nama_unit_cabang' => 'D3 Teknik Telekomunikasi',
        ]);
        UnitCabang::create([ // 4
            'unit_id' => '8',
            'nama_unit_cabang' => 'D4 Teknik Telekomunikasi',
        ]);
        UnitCabang::create([ // 5
            'unit_id' => '8',
            'nama_unit_cabang' => 'D4 Teknik Elektro Industri',
        ]);
        UnitCabang::create([  // 6
            'unit_id' => '8',
            'nama_unit_cabang' => 'D4 Teknik Rekayasa Internet',


            # Departement Teknik Informatika
        ]);
        UnitCabang::create([ // 7
            'unit_id' => '9',
            'nama_unit_cabang' => 'D4 Teknik Informatika',
        ]);
        UnitCabang::create([ // 8
            'unit_id' => '9',
            'nama_unit_cabang' => 'D3 Teknik Informatika',
        ]);
        UnitCabang::create([ // 9
            'unit_id' => '9',
            'nama_unit_cabang' => 'D4 Teknik Komputer',
        ]);
        UnitCabang::create([ // 10
            'unit_id' => '9',
            'nama_unit_cabang' => 'D4 Sains Data Terapan',
        ]);

        # Departemen Teknik Mekanika Energi
        UnitCabang::create([ // 11
            'unit_id' => '10',
            'nama_unit_cabang' => 'D4 Teknik Mekatronika',
        ]);
        UnitCabang::create([ // 12
            'unit_id' => '10',
            'nama_unit_cabang' => 'D4 Sistem Pembangkit Energi',
        ]);
    }
}
