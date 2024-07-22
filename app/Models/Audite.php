<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audite extends Model
{
    use HasFactory;
    protected $table = 'audite';
    protected $primaryKey = 'audite_id';
    protected $fillable = [
        'unit_id',
        'unit_cabang_id',
        'user_id',
    ];
}
