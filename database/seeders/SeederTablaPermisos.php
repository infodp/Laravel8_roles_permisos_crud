<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operacions sobre tabla blogs
            'ver-blog',
            'crear-blog',
            'editar-blog',
            'borrar-blog',
            //permisos sobre la tabla ciudadanos
            'ver-ciudadano',
            'crear-ciudadano',
            'editar-ciudadano',
            'borrar-ciudadano',
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
