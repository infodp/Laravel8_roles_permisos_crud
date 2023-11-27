<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','descripcion','estado'];

    // public function ciudadanos()
    // {
    //     return $this->hasMany(Cargos_has_ciudadano::class, 'cargo_id');
    // }
    public function ciudadanos(){
        return $this->hasMany(Grupo::class, 'cargo_id');
    }
    // public function grupos()
    // {
    //     return $this->hasMany(Grupo::class, 'cargo_id');
    // }

}
