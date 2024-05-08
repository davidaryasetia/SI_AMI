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
        Auditor::create([
            'unit_id' => 1,
            'auditor_1' => 2,
            'auditor_2' => 3,
        ]);
        Auditor::create([
            'unit_id' => 2,
            'auditor_1' => 1,
            'auditor_2' => 5,
        ]);
        Auditor::create([
            'unit_id' => 3,
            'auditor_1' => 4,
            'auditor_2' => 6,
        ]);
    }
}
