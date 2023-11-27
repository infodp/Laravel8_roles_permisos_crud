<?php

namespace Database\Seeders;

use App\Models\Grupo;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grupo::factory()
            ->count(8)
            ->create();
    }
}
