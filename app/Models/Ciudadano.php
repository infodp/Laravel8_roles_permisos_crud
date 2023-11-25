<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudadano extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','apellido_p', 'apellido_m','sexo','calle','num_calle', 'num_exterior', 'num_interior', 'referencia', 'estado','curp','fecha_nacimiento','num_telefonico','observaciones'];

    public function cargos()
    {
        return $this->hasMany(Cargos_has_ciudadano::class, 'ciudadano_id');
    }
}
