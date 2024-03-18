<?php

namespace Database\Seeders;

use App\Models\LaporanAuditor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaporanAuditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LaporanAuditor::create([
            'no_tujuan' => 1, 
            'no_lingkup' => 1, 
        ]);
        LaporanAuditor::create([
            'no_tujuan' => 1, 
            'no_lingkup' => 1, 
        ]);
        LaporanAuditor::create([
            'no_tujuan' => 1, 
            'no_lingkup' => 1, 
        ]);
    }
}
