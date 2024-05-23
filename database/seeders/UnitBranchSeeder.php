<?php

namespace Database\Seeders;

use App\Models\UnitBranch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # Departemen Teknik Elektronika
        UnitBranch::create([ // 1
            'unit_id' => '8',
            'nama_unit_branch' => 'D4 Teknik Elektronika',
        ]);
        UnitBranch::create([ // 2
            'unit_id' => '8',
            'nama_unit_branch' => 'D3 Teknik Elektronika',
        ]);
        UnitBranch::create([ // 3
            'unit_id' => '8',
            'nama_unit_branch' => 'D3 Teknik Telekomunikasi',
        ]);
        UnitBranch::create([ // 4
            'unit_id' => '8',
            'nama_unit_branch' => 'D4 Teknik Telekomunikasi',
        ]);
        UnitBranch::create([ // 5
            'unit_id' => '8',
            'nama_unit_branch' => 'D4 Teknik Elektro Industri',
        ]);
        UnitBranch::create([  // 6
            'unit_id' => '8',
            'nama_unit_branch' => 'D4 Teknik Rekayasa Internet',


        # Departement Teknik Informatika
        ]);
        UnitBranch::create([ // 7
            'unit_id' => '9',
            'nama_unit_branch' => 'D4 Teknik Informatika',
        ]);
        UnitBranch::create([ // 8
            'unit_id' => '9',
            'nama_unit_branch' => 'D3 Teknik Informatika',
        ]);
        UnitBranch::create([ // 9
            'unit_id' => '9',
            'nama_unit_branch' => 'D4 Teknik Komputer',
        ]);
        UnitBranch::create([ // 10
            'unit_id' => '9',
            'nama_unit_branch' => 'D4 Sains Data Terapan',
        ]);

        # Departemen Teknik Mekanika Energi
        UnitBranch::create([ // 11
            'unit_id' => '10',
            'nama_unit_branch' => 'D4 Teknik Mekatronika',
        ]);
        UnitBranch::create([ // 12
            'unit_id' => '10',
            'nama_unit_branch' => 'D4 Sistem Pembangkit Energi',
        ]);
    }
}
