<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargos_has_ciudadano extends Model
{
    use HasFactory;

    protected $fillable = ['ciudadano_id','cargo_id','fecha_inscripcion','aprobado'];

}
