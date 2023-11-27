<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','cargo_id','fecha_inicio','fecha_fin','estado'];

    public function ciudadanos()
    {
        return $this->hasMany(Cargos_has_ciudadano::class, 'grupo_id');
    }
}
