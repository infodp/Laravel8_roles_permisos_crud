<?php

namespace Database\Seeders;

// use App\Models\Cargo;
// use App\Models\Cargos_has_ciudadano;
// use App\Models\Ciudadano;
// use App\Models\Evento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Cargo::class,
            Ciudadano::class,
            Evento::class,
            User::class,
            Cargos_has_ciudadano::class,
        ]);
    }
}
