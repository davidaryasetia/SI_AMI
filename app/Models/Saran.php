<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    use HasFactory;
    protected $table = 'saran';
    protected $primaryKey = 'no_saran';
    protected $fillable = [
        'indikator_kinerja', 
        'created_at', 
        'updated_at', 
        'laporan_auditor_id'
    ];
}
