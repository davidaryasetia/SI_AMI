<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;
    protected $table = 'indikator_kinerja';
    protected $primaryKey = 'indikator_kinerja_id';
    protected $guarded = [
        'indikator_kinerja_id'
    ];
}
