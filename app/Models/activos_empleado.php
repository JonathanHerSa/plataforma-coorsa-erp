<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activos_empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id',
        'activo_id',
        'status',
        'fecha',
    ];
}
