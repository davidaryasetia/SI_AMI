<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;
    protected $table='auditor';
    protected $primaryKey = 'auditor_id';
    protected $guarded = [
        'unit_id', 
        'user_id', 
        'created_at', 
        'updated_at' 
    ];
}
