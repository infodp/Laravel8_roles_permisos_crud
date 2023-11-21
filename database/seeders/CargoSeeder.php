<?php

namespace Database\Seeders;
use App\Models\Cargo;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cargo::factory()
            ->count(8)
            ->create();
    }
}
