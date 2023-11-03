<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'fecha_inicio','fecha_fin','estado'];

    public function ciudadanos()
    {
        return $this->hasMany(Cargos_has_ciudadano::class, 'cargo_id');
    }

}
