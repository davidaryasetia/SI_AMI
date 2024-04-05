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
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 1,
            'kode' => 'U11.1',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk buku referensi sesuai kriteria minimal',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => 40,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 1,
            'kode' => 'U11.2',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama  dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≥ 1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => 40,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 1,
            'kode' => 'U11.3',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama dengan waktu tunggu ≤ 6 bulan dan bergaji   ≤ 1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => 40,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 1,
            'kode' => 'U11.4',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang mendapatkan pekerjaan pertama  dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≤  1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => 40,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 1,
            'kode' => 'U11.5',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang melanjutkan studi ke jenjang berikutnya',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => 40,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 1,
            'kode' => 'U11.6',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu ≤ 6 bulan dan bergaji ≥ 1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => 40,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 1,
            'kode' => 'U11.7',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≥ 1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => 40,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 1,
            'kode' => 'U11.8',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu ≤ 6 bulan dan bergaji   ≤ 1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => 40,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 1,
            'kode' => 'U11.9',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah lulusan prodi yang berwirausaha berijin dengan waktu tunggu antara 6 sd 12 bulan dan bergaji ≤  1.2 x UMP',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => 40,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 1,
            'kode' => 'U11.10',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah responden tracer study pada tahun anggaran berjalan (Lulusan T-1)',
            'satuan_ikuk' => 'lulusan',
            'target_ikuk' => 40,
        ]);

        // Unit 2 => P3M
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 2,
            'kode' => 'U23.1',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk buku referensi sesuai kriteria minimal',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 40,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 2,
            'kode' => 'U23.2',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  jurnal internasional bereputasi atau jurnal internasional terindeks pada databese internasional bereputasi (Q1-Q4)',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 24,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 2,
            'kode' => 'C9.35',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  buku nasional/internasional yang mempunyai ISBN',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 24,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 2,
            'kode' => 'U23.3',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  book chapter internasional ',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 24,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 2,
            'kode' => 'U23.4',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah karya tulis dalam bentuk  jurnal internasional/nasional berbahasa inggris atau bahasa resmi PBB terindeks pada DOAJ',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 24,
        ]);

        // Unit 3 => P3M
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 3,
            'kode' => 'U12.8',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah mahasiswa berprestasi juara 1 bidang akademik tingkat internasional ',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 24,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 3,
            'kode' => 'U12.10',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah mahasiswa berprestasi juara 2 bidang akademik tingkat internasional',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 24,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 3,
            'kode' => 'U12.12',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah mahasiswa berprestasi juara 3  bidang akademik tingkat internasional',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 24,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 3,
            'kode' => 'U12.14',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah mahasiswa berprestasi juara 1  bidang akademik tingkat nasional',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 24,
        ]);
        IndikatorKinerjaUnitKerja::create([
            'indikator_kinerja_sub_kegiatan_id' => 1,
            'unit_id' => 3,
            'kode' => 'U12.16',
            'isi_indikator_kinerja_unit_kerja' => 'Jumlah mahasiswa berprestasi juara 2  bidang akademik tingkat nasional',
            'satuan_ikuk' => 'nominal',
            'target_ikuk' => 24,
        ]);
    }
}
