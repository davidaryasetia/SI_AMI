<?php

namespace Database\Seeders;

use App\Models\PeriodePelaksanaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodePelaksanaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PeriodePelaksanaan::create([
            'nama_periode_ami' => "Ami Tahun 2022",
            'tanggal_pembukaan_ami' => '2022-02-01',
            'tanggal_penutupan_ami' => '2024-03-01',
        ]);
        PeriodePelaksanaan::create([
            'nama_periode_ami' => "Ami Tahun 2023",
            'tanggal_pembukaan_ami' => '2023-02-01',
            'tanggal_penutupan_ami' => '2023-03-01',
        ]);
    }
}
