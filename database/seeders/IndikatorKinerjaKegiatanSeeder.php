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
        IndikatorKinerjaKegiatan::create([
            'unit_id' => 1,
            'kode_ikk' => 'IKU 2.3',
            'isi_indikator_kinerja_kegiatan' => 'Persentase keluaran penelitian dan pengabdian kepada masyarakat yang berhasil mendapat rekognisi internasional atau diterapkan oleh masyarakat per jumlah dosen',
            'satuan ikk' => '%',
            'target_ikk' => '100'
        ]);
        IndikatorKinerjaKegiatan::create([
            'unit_id' => 1,
            'kode_ikk' => 'IKU 5.1',
            'isi_indikator_kinerja_kegiatan' => 'Persentase ketercapaian indikator SPMI dan manajemen bidang akademik',
            'satuan ikk' => '',
            'target_ikk' => ''
        ]);
    }
}
