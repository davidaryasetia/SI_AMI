<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;
    protected $table = 'pertanyaan';
    protected $primaryKey = 'no_pertanyaan';
    protected $fillable = [
        'pertanyaan', 
        'jawaban', 
        'keterangan', 
        'created_at', 
        'updated_at', 
        'laporan_auditor'
    ];
}
