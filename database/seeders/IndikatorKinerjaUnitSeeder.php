<?php

namespace Database\Seeders;

use App\Models\IndikatorKinerjaUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndikatorKinerjaUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Indikator Kinerja Unit
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.1',
            'indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk buku referensi sesuai kriteria minimal',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.2',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama  dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≥ 1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.3',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama dengan waktu tunggu ≤ 6 bulan dan bergaji   ≤ 1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.4',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama  dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≤  1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.5',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang melanjutkan studi ke jenjang berikutnya',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.6',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu ≤ 6 bulan dan bergaji ≥ 1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.7',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≥ 1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.8',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu ≤ 6 bulan dan bergaji   ≤ 1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.9',
            'indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≤  1.2 x UMP',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 1,
            'kode' => 'U11.10',
            'indikator_kinerja_unit_kerja' => 'Jumlah responden tracer study pada tahun anggaran berjalan (Lulusan T-1)',
            'satuan' => 'lulusan',
            'target' => 40,
        ]);

        IndikatorKinerjaUnit::create([
            'unit_id' => 2,
            'kode' => 'U23.1',
            'indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk buku referensi sesuai kriteria minimal',
            'satuan' => 'nominal',
            'target' => 40,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 2,
            'kode' => 'U23.2',
            'indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  jurnal internasional bereputasi atau jurnal internasional terindeks pada databese internasional bereputasi (Q1-Q4)',
            'satuan' => 'nominal',
            'target' => 24,
        ]);
        IndikatorKinerjaUnit::create([
            'unit_id' => 2,
            'kode' => 'U23.3',
            'indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  jurnal internasional bereputasi atau jurnal internasional terindeks pada databese internasional bereputasi (Q1-Q4)',
            'satuan' => 'nominal',
            'target' => 24,
        ]);
    }
}
