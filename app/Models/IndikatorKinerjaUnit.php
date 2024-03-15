<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorKinerjaUnit extends Model
{
    use HasFactory;
    protected $table = 'indikator_kinerja_unit';
    protected $primaryKey = 'indikator_kinerja_id';
    protected $fillable = [
        'unit_id', 
        'kode', 
        'indikator_kinerja_unit_kerja', 
        'satuan', 
        'target', 
        'created_at', 
        'updated_at'
    ];
}
