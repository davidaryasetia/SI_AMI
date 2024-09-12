<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorKinerjaSubKegiatan extends Model
{
    use HasFactory;
    protected $table = 'indikator_kinerja_sub_kegiatan';
    protected $primaryKey = 'indikator_kinerja_sub_kegiatan_id';
    protected $fillable = [
        'indikator_kinerja_kegiatan_id', 
        'isi_indikator_kinerja_sub_kegiatan', 
        'satuan_iksk', 
        'target_iksk'
    ];
}
