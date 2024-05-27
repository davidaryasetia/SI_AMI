<?php

namespace Database\Seeders;

use App\Models\Auditor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Auditor 
        Auditor::create([ // 1
            'unit_id' => 1, // Ukarni
            'auditor_1' => 2, // nana
            'auditor_2' => 3, // tita
        ]);

        Auditor::create([ // 2
            'unit_id' => 2, // P3M
            'auditor_1' => null, // Hary
            'auditor_2' => null, // Selvia
        ]);

        Auditor::create([ // 3
            'unit_id' => 3,  // Penalaran
            'auditor_1' => null, // Fitri
            'auditor_2' => null, // Wenny
        ]);

        Auditor::create([ // 4
            'unit_id' => 4,  // Minat Bakat
            'auditor_1' => 5, // Selvia
            'auditor_2' => 7, // Fitrah
        ]);

        Auditor::create([ // 5
            'unit_id' => 5,  // Perencanaan
            'auditor_1' => 3, // Tita
            'auditor_2' => 7, // Fitrah
        ]);

        Auditor::create([ // 6
            'unit_id' => 6,  // P4MP Pembelajaran
            'auditor_1' => 8, // Elly
            'auditor_2' => 10, // Dedid
        ]);

        Auditor::create([ // 7
            'unit_id' => 7,  // P4MP SPM
            'auditor_1' => 9, // Elizabeth
            'auditor_2' => 10, // Dedid
        ]);

        Auditor::create([ // 8
            'unit_id' => 8,  // Departement Teknik Elektronika
            'auditor_1' => 13, // Syauqi
            'auditor_2' => 14, // Riyanto
        ]);

        Auditor::create([ // 9
            'unit_id' => 9,  // Departement Teknik Informatika
            'auditor_1' => 10, // Dedid
            'auditor_2' => 6, // Wenny
        ]);

        Auditor::create([ // 10
            'unit_id' => 9,  // Departement Teknik Mekanika Energi
            'auditor_1' => null, // Dedid
            'auditor_2' => null, // Wenny
        ]);

        Auditor::create([ // 11
            'unit_id' => 11,  // UPUK
            'auditor_1' => null, // Dedid
            'auditor_2' => null, // Wenny
        ]);

        Auditor::create([ // 12
            'unit_id' => 12,  // UPUK
            'auditor_1' => null, // Dedid
            'auditor_2' => null, // Wenny
        ]);

        Auditor::create([ // 13
            'unit_id' => 13,  // UPUK
            'auditor_1' => null, // Dedid
            'auditor_2' => null, // Wenny
        ]);
    }
}
