<?php

namespace Database\Seeders;

use App\Models\IndikatorKinerjaUnitKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndikatorKinerjaUnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ukarni -> IKSK_1
        IndikatorKinerjaUnitKerja::create([ // 1
            'unit_id' => 1, 
            'kode_ikuk' => 'U11.1',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama dengan waktu tunggu ≤ 6 bulan dan bergaji ≥ 1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => null,
        ]);
        IndikatorKinerjaUnitKerja::create([ // 2
            'unit_id' => 1, 
            'kode_ikuk' => 'U11.2',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama  dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≥ 1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => null,
        ]);
        IndikatorKinerjaUnitKerja::create([ // 3
            'unit_id' => 1, 
            'kode_ikuk' => 'U11.3',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama dengan waktu tunggu ≤ 6 bulan dan bergaji   ≤ 1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => null,
        ]);
        IndikatorKinerjaUnitKerja::create([ // 4
            'unit_id' => 1, 
            'kode_ikuk' => 'U11.4',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama  dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≤  1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => 40,
        ]);

        // Ukarni -> IKSK_2
        IndikatorKinerjaUnitKerja::create([ // 5
            'unit_id' => 1, 
            'kode_ikuk' => 'U11.5',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang melanjutkan studi ke jenjang berikutnya',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => null,
        ]);

        // Ukarni -> IKSK_3
        IndikatorKinerjaUnitKerja::create([ // 6
            'unit_id' => 1, 
            'kode_ikuk' => 'U11.6',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu ≤ 6 bulan dan bergaji ≥ 1.2 x UMP
            ',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => null,
        ]);
        IndikatorKinerjaUnitKerja::create([ //7
            'unit_id' => 1, 
            'kode_ikuk' => 'U11.7',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≥ 1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => null,
        ]);
        IndikatorKinerjaUnitKerja::create([ // 8
            'unit_id' => 1, 
            'kode_ikuk' => 'U11.8',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu ≤ 6 bulan dan bergaji   ≤ 1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => null,
        ]);
        IndikatorKinerjaUnitKerja::create([ // 9
            'unit_id' => 1, 
            'kode_ikuk' => 'U11.9',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≤  1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => null,
        ]);

        // Ukarni -> IKSK_4
        IndikatorKinerjaUnitKerja::create([ // 10
            'unit_id' => 1, 
            'kode_ikuk' => 'U11.10',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah responden tracer study pada tahun anggaran berjalan (Lulusan T-1)',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => null,
        ]);

        // P3M -> IKSK_6
        IndikatorKinerjaUnitKerja::create([ // 11
            'unit_id' => 2, 
            'kode_ikuk' => 'U23.1',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk buku referensi sesuai kriteria minimal',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 1,
        ]);
        IndikatorKinerjaUnitKerja::create([ // 12
            'unit_id' => 2, 
            'kode_ikuk' => 'U23.2',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  jurnal internasional bereputasi atau jurnal internasional terindeks pada databese internasional bereputasi (Q1-Q4)',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 24,
        ]);
        IndikatorKinerjaUnitKerja::create([ // 13
            'unit_id' => 2, 
            'kode_ikuk' => 'C9.35',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  buku nasional/internasional yang mempunyai ISBN',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 24,
        ]);
        IndikatorKinerjaUnitKerja::create([ // 14
            'unit_id' => 3, 
            'kode_ikuk' => 'U23.3',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  book chapter internasional ',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 24,
        ]);
        IndikatorKinerjaUnitKerja::create([ //15
            'unit_id' => 3, 
            'kode_ikuk' => 'U23.4',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  jurnal internasional/nasional berbahasa inggris atau bahasa resmi PBB terindeks pada DOAJ',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 24,
        ]);




        // // Unit 3 => P3M
        // IndikatorKinerjaUnitKerja::create([ // 15
        // 'unit_id' => 1, 
        //     'unit_id' => 3,
        //     'kode_ikuk' => 'U12.8',
        //     'isi_indikator_kinerja_unit_kerja' => 'Jumlah mahasiswa berprestasi juara 1 bidang akademik tingkat internasional ',
        //     'satuan_ikuk' => 'nominal',
        //     'target_ikuk' => 24,
        // ]);
        // IndikatorKinerjaUnitKerja::create([
        // 'unit_id' => 1, 
        //     'unit_id' => 3,
        //     'kode_ikuk' => 'U12.10',
        //     'isi_indikator_kinerja_unit_kerja' => 'Jumlah mahasiswa berprestasi juara 2 bidang akademik tingkat internasional',
        //     'satuan_ikuk' => 'nominal',
        //     'target_ikuk' => 24,
        // ]);
        // IndikatorKinerjaUnitKerja::create([
        // 'unit_id' => 1, 
        //     'unit_id' => 3,
        //     'kode_ikuk' => 'U12.12',
        //     'isi_indikator_kinerja_unit_kerja' => 'Jumlah mahasiswa berprestasi juara 3  bidang akademik tingkat internasional',
        //     'satuan_ikuk' => 'nominal',
        //     'target_ikuk' => 24,
        // ]);
        // IndikatorKinerjaUnitKerja::create([
        // 'unit_id' => 1, 
        //     'unit_id' => 3,
        //     'kode_ikuk' => 'U12.14',
        //     'isi_indikator_kinerja_unit_kerja' => 'Jumlah mahasiswa berprestasi juara 1  bidang akademik tingkat nasional',
        //     'satuan_ikuk' => 'nominal',
        //     'target_ikuk' => 24,
        // ]);
        // IndikatorKinerjaUnitKerja::create([
        // 'unit_id' => 1, 
        //     'unit_id' => 3,
        //     'kode_ikuk' => 'U12.16',
        //     'isi_indikator_kinerja_unit_kerja' => 'Jumlah mahasiswa berprestasi juara 2  bidang akademik tingkat nasional',
        //     'satuan_ikuk' => 'nominal',
        //     'target_ikuk' => 24,
        // ]);
    }
}
