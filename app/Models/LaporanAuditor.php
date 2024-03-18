<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAuditor extends Model
{
    use HasFactory;
    protected $table = 'laporan_auditor';
    protected $primaryKey = 'laporan_auditor_id';
    protected $fillable = [
        'created_at', 
        'updated_at', 
        'no_tujuan', 
        'no_lingkup'
    ];
}
