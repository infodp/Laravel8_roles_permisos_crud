<?php

namespace Database\Seeders;

use App\Models\Cargos_has_ciudadano;
use Database\Factories\Cargo_has_ciudadanoFactory;
use Illuminate\Database\Seeder;

class Cargos_has_ciudadanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cargos_has_ciudadano::factory()
            ->count(20)
            ->create();
    }
}
