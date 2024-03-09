<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorKinerjaUnit extends Model
{
    use HasFactory;
    protected $table = 'indikator_kinerja_unit';
    protected $primaryKey = 'indikator_kinerja_id';
    protected $guarded = [
        'indikator_kinerja_id'
    ];
}
