<?php

namespace Database\Seeders;

use App\Models\TujuanAudit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TujuanAuditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TujuanAudit::create([
            'tujuan' => 'Melihat kesesuaian antara pelaksanaan standar dengan indikator kinerja yang
            telah ditetapkan pada standar SPMI PENS.',
        ]);
    }
}
