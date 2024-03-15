<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LingkupAudit extends Model
{
    use HasFactory;
    protected $table = 'lingkup_audit';
    protected $primaryKey = 'no_lingkup';
    protected $fillable = [
      'lingkup', 
      'created_at', 
      'updated_at'  
    ];
}
