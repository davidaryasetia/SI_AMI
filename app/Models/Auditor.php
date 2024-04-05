<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;
    protected $table='auditor';
    protected $primaryKey = 'auditor_id';
    protected $fillable = [
        'unit_id', 
        'auditor_1', 
        'auditor_2', 
        'created_at', 
        'updated_at', 
    ];
}
