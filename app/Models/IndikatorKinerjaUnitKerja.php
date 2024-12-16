<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IndikatorKinerjaUnitKerja extends Model
{
    use HasFactory;
    protected $table = 'indikator_kinerja_unit_kerja';
    protected $primaryKey = 'indikator_kinerja_unit_kerja_id';
    protected $fillable = [
        'jadwal_ami_id',
        'indikator_kinerja_sub_kegiatan_id',
        'unit_id',
        'kode_ikuk',
        'isi_indikator_kinerja_unit_kerja',
        'satuan_ikuk',
        'target_ikuk',
        'created_at',
        'updated_at'
    ];

    public function periode_pelaksanaan(): BelongsTo
    {
        return $this->belongsTo(PeriodePelaksanaan::class, 'jadwal_ami_id', 'jadwal_ami_id');
    }

    public function transaksiDataIkuk(): HasMany
    {
        return $this->hasMany(TransaksiData::class, 'indikator_kinerja_unit_kerja_id', 'indikator_kinerja_unit_kerja_id');
    }
}
