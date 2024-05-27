<?php

namespace Database\Seeders;

use App\Models\IndikatorKinerjaKegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndikatorKinerjaKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // ---------------------- Ukarni ------------------
        IndikatorKinerjaKegiatan::create([
            'unit_id' => 1, // ikk_ukarni
            'kode_ikk' => 'IKU 1.1',
            'isi_indikator_kinerja_kegiatan' => 'Persentase lulusan S1 dan D4/D3/D2 yang berhasil mendapat pekerjaan; melanjutkan studi; atau menjadi wiraswast',
            'satuan_ikk' => '%',
            'target_ikk' => null,
        ]);

        IndikatorKinerjaKegiatan::create([ // 2
            'unit_id' => 1, // ikk_ukarni
            'kode_ikk' => 'IKU 6.2',
            'isi_indikator_kinerja_kegiatan' => 'Persentase ketercapaian indikator SPMI dan manajemen bidang kerjasama',
            'satuan_ikk' => '',
            'target_ikk' => null,
        ]);

        // ---------------------- Ukarni ------------------



        // ---------------------- P3M ------------------
        IndikatorKinerjaKegiatan::create([ // 3
            'unit_id' => 2, // IKK_P3M
            'kode_ikk' => 'IKU 2.3  ',
            'isi_indikator_kinerja_kegiatan' => 'Persentase keluaran penelitian dan pengabdian kepada masyarakat yang berhasil mendapat rekognisi internasional atau diterapkan oleh masyarakat per jumlah dosen',
            'satuan_ikk' => '%',
            'target_ikk' => null,

        ]);

        IndikatorKinerjaKegiatan::create([ // 4
            'unit_id' => 2, // IKK_P3M
            'kode_ikk' => 'IKU 5.1',
            'isi_indikator_kinerja_kegiatan' => 'Persentase mahasiswa S1 dan D4/D3/D2 yang menghabiskan paling sedikit 20 (dua puluh) sks di luar kampus; atau meraih prestasi paling rendah tingkat nasional',
            'satuan_ikk' => '%',
            'target_ikk' => null,

        ]);

        // ---------------------- PENALARAN ------------------
        IndikatorKinerjaKegiatan::create([ // 5
            'unit_id' => 3, // IKK_PENALARAN
            'kode_ikk' => 'IKU 1.2',
            'isi_indikator_kinerja_kegiatan' => 'Persentase mahasiswa S1 dan D4/D3/D2 yang menghabiskan paling sedikit 20 (dua puluh) sks di luar kampus; atau meraih prestasi paling rendah tingkat nasional',
            'satuan_ikk' => '%',
            'target_ikk' => null,

        ]);

        IndikatorKinerjaKegiatan::create([ // 6
            'unit_id' => 2, // IKK_P3M
            'kode_ikk' => 'IKU 2.1',
            'isi_indikator_kinerja_kegiatan' => 'Persentase dosen yang berkegiatan tridharma di kampus lain, di QS100 berdasarkan bidang ilmu (QS100 by subject), bekerja sebagai praktisi di dunia industri, atau membina mahasiswa yang berhasil meraih prestasi paling rendah tingkat nasional dalam 5 (lima) tahun terakhir',
            'satuan_ikk' => '%',
            'target_ikk' => null,

        ]);

        IndikatorKinerjaKegiatan::create([ // 7
            'unit_id' => 2, // IKK_P3M
            'kode_ikk' => 'IKU 5.2',
            'isi_indikator_kinerja_kegiatan' => 'Persentase ketercapaian indikator SPMI dan manajemen bidang kemahasiswaan',
            'satuan_ikk' => '%',
            'target_ikk' => null,
        ]);
    }
}
