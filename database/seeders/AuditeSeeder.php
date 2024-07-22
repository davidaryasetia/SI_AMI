<?php

namespace Database\Seeders;

use App\Models\Audite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuditeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Audite::create([ // 1
            'unit_id' => 1, // Ukarni
            'unit_cabang_id' => NULL,
            'user_id' => 1, 
        ]);
        Audite::create([ //2
            'unit_id' => 2, // P3M
            'unit_cabang_id' => NULL,
            'user_id' => 2, 
        ]);
        Audite::create([ // 3
            'unit_id' => 3, // Penalaran
            'unit_cabang_id' => NULL,
            'user_id' => 3, 
        ]);
        Audite::create([ // 4
           'unit_id' => 4, // Minat Bakat
            'unit_cabang_id' => NULL,
            'user_id' => 4, 
        ]);
        Audite::create([ // 5
            'unit_id' => 5, // Perencanaa
            'unit_cabang_id' => NULL,
            'user_id' => 5, 
        ]);
        Audite::create([ //6
            'unit_id' => 6, // P4MP Pembelajran
            'unit_cabang_id' => NULL,
            'user_id' => 6, 
        ]);
        Audite::create([ //7
            'unit_id' => 7, // P4MP SPM
            'unit_cabang_id' => NULL,
            'user_id' => 7, 
        ]);

         // ----------- Departement Teknik Elektronika --------------------//
        Audite::create([ // 8 
           'unit_id' => 8, // Departemen Teknik Elektronika
            'unit_cabang_id' => NULL, // Kadep
            'user_id' => 8, 
        ]);
        Audite::create([ // 9 
            'unit_id' => 8, // Departemen Teknik Elektronika
            'unit_cabang_id' => 1, // D4 Teknik Elektronika
            'user_id' => 9, 
        ]);
        Audite::create([ //10
            'unit_id' => 8, // Departemnen Teknik Elektronika
            'unit_cabang_id' => 2, // D3 Teknik Elektronika
            'user_id' => 10, 
        ]);
        Audite::create([ //11
            'unit_id' => 8, // Departement Teknik Elektronika 
            'unit_cabang_id' => 3, // D3 Teknik Telekomunikasi
            'user_id' => 11, 
        ]);
        Audite::create([ //12
            'unit_id' => 8, // Departement Teknik Elektronika
            'unit_cabang_id' => 4, // D4 Teknik Telekomunikasi
            'user_id' => 12, 
        ]);


        // ------------- Departement Teknik Informatika -------------------//
        Audite::create([ //13
            'unit_id' => 9, // Departement Teknik Informatika
            'unit_cabang_id' => null, // D4 Teknik Informatika
            'user_id' => 13, 
        ]);
        Audite::create([ //14
            'unit_id' => 9, // Departement Teknik Informatika
            'unit_cabang_id' => 7, // D4 Teknik Informatika
            'user_id' => 14, 
        ]);
        Audite::create([ //15
            'unit_id' => 9, // Departement Teknik Informatika
            'unit_cabang_id' => 8, // D3 Teknik Informatika
            'user_id' => 15, 
        ]);
        Audite::create([ //16
            'unit_id' => 9, // Departement Teknik Informatika
            'unit_cabang_id' => 9, // D4 Teknik Komputer
            'user_id' => 16, 
        ]);
        Audite::create([ //17
            'unit_id' => 9, // Departement Teknik Informatika
            'unit_cabang_id' => 10, // D4 Sains Data Terapan
            'user_id' => 17, 
        ]);

         // ------------- Departement Teknik Mekanika Energi --------------//
        Audite::create([ //18
           'unit_id' => 10, // Departement Teknik Mekanika Energi
            'unit_cabang_id' => NULL, // D4 Teknik Mekatronika
            'user_id' => 18, 
        ]);
        Audite::create([ //19
            'unit_id' => 10, // Departement Teknik Mekanika Energi
            'unit_cabang_id' => 11, // D4 Teknik Mekatronika
            'user_id' => 19, 
        ]);
        Audite::create([ //20
            'unit_id' => 10, // Departement Teknik Mekanika Energi
            'unit_cabang_id' => 12, // D4 Sistem Pembangkit Energi
            'user_id' => 20, 
        ]);
    }
}
