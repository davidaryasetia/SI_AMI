<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;
    protected $table='unit';
    protected $primaryKey = 'unit_id';
    protected $guarded = [
        'unit_id'
    ];
}
