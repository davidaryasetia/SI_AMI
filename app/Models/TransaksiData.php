<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiData extends Model
{
    use HasFactory;
    protected $table = 'transaksi_data_ikuk';
    protected $primaryKey = 'transaksi_data_ikuk_id';
    protected $fillable = [
        'indikator_kinerja_unit_kerja_id',
        'jadwal_ami_id',
        'laporan_auditor_id',
        'riwayat_nama_unit',
        'hasil_audit',
        'realisasi_ikuk',
        'analisis_usulan_keberhasilan',
        'target_lama',
        'usulan_target_tahun_depan',
        'strategi_pencapaian',
        'sarpras_yang_dibutuhkan',
        'faktor_pendukung',
        'faktor_penghambat',
        'akar_masalah',
        'tindak_lanjut',
        'data_dukung',
        'status_pengisian_audite',
        'status_pengisian_auditor',
        'status_finalisasi_audite',
        'tanggal_status_finalisasi_audite',
        'status_finalisasi_auditor1',
        'tanggal_status_finalisasi_auditor1',
        'status_finalisasi_auditor2',
        'tanggal_status_finalisasi_auditor2',
    ];

    // Terhadap indikator kinerja unit kerja
    public function indikator_ikuk(): BelongsTo
    {
        return $this->belongsTo(IndikatorKinerjaUnitKerja::class, 'indikator_kinerja_unit_kerja_id', 'indikator_kinerja_unit_kerja_id');
    }

    // Terhadap periode pelaksanaa
    public function periode_pelaksanaan(): BelongsTo
    {
        return $this->belongsTo(PeriodePelaksanaan::class, "jadwal_ami_id", "jadwal_ami_id");
    }
}
