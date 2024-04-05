<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorKinerjaUnitKerja extends Model
{
    use HasFactory;
    protected $table = 'indikator_kinerja_unit_kerja';
    protected $primaryKey = 'indikator_kinerja_unit_kerja_id';
    protected $fillable = [
        'indikator_kinerja_sub_kegiatan_id', 
        'kode', 
        'isi_indikator_kinerja_unit_kerja', 
        'satuan', 
        'target', 
        'created_at', 
        'updated_at'
    ];
}
