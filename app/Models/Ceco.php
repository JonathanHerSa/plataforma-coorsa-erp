<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ceco extends Model
{
    use HasFactory;

    public function puestos()
    {
        return $this->belongsToMany(puesto::class,'departamento_puestos', 'departamento_id', 'puesto_id');
    }
}