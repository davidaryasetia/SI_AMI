<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitBranch extends Model
{
    use HasFactory;
    protected $table='unit_cabang';
    protected $primaryKey='unit_cabang_id';
    protected $fillable=[
        'unit_id',
        'nama_unit_branch', 
        'created_at', 
        'updated_at'
    ];
    
}
