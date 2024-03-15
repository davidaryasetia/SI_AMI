<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuPelaksanaan extends Model
{
    use HasFactory;
    protected $table = 'waktu_pelaksanaan';
    protected $primaryKey = 'pelaksanaan_id';
    protected $fillable = [
        'tahun', 
        'semester', 
        'tanggal_pembukaan_ami', 
        'tanggal_penutupan_ami', 
        'created_at', 
        'updated_at'
    ];
}
