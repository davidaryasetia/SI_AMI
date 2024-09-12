<?php

namespace Database\Seeders;

use App\Models\LingkupAudit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LingkupAuditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LingkupAudit::create([
            'lingkup' => 'Indikator Kinerja Yang sesuai dengan unit terkait', 
        ]);
    }
}
