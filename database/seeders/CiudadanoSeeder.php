<?php

namespace Database\Seeders;

use App\Models\Ciudadano;
use Illuminate\Database\Seeder;

class CiudadanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ciudadano::factory()
            ->count(20)
            ->create();
    }
}
