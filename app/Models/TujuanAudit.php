<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanAudit extends Model
{
    use HasFactory;
    protected $table = 'tujuan_audit';
    protected $primaryKey = 'no_tujuan';
    protected $fillable = [
        'tujuan', 
        'created_at', 
        'updated_at'
    ];
}
