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
        #DTE
        UnitBranch::create([
            'unit_id' => '8',
            'nama_unit_branch' => 'D4 Teknik Elektronika',
        ]);
        UnitBranch::create([
            'unit_id' => '8',
            'nama_unit_branch' => 'D3 Teknik Elektronika',
        ]);
        UnitBranch::create([
            'unit_id' => '8',
            'nama_unit_branch' => 'D3 Teknik Telekomunikasi',
        ]);
        UnitBranch::create([
            'unit_id' => '8',
            'nama_unit_branch' => 'D4 Teknik Telekomunikasi',
        ]);
        UnitBranch::create([
            'unit_id' => '8',
            'nama_unit_branch' => 'D4 Teknik Elektro Industri',
        ]);
        UnitBranch::create([
            'unit_id' => '8',
            'nama_unit_branch' => 'D4 Teknik Rekayasa Internet',
        
        
        # DTIK
        ]);
        UnitBranch::create([
            'unit_id' => '9',
            'nama_unit_branch' => 'D4 Teknik Informatika',
        ]);
        UnitBranch::create([
            'unit_id' => '9',
            'nama_unit_branch' => 'D3 Teknik Informatika',
        ]);
        UnitBranch::create([
            'unit_id' => '9',
            'nama_unit_branch' => 'D4 Teknik Komputer',
        ]);
        UnitBranch::create([
            'unit_id' => '9',
            'nama_unit_branch' => 'D4 Sains Data Terapan',
        ]);
        
        # DTME
        UnitBranch::create([
            'unit_id' => '10',
            'nama_unit_branch' => 'D4 Teknik Mekatronika',
        ]);
        UnitBranch::create([
            'unit_id' => '10',
            'nama_unit_branch' => 'D4 Sistem Pembangkit Energi',
        ]);
        
    }
}
