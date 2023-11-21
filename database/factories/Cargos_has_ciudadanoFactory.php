<?php

namespace Database\Factories;

use App\Models\Cargo;
use App\Models\Ciudadano;
use Illuminate\Database\Eloquent\Factories\Factory;

class Cargos_has_ciudadanoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nombre1 = $this->faker->randomElement([
            'Bailes','Dia de muestos','Comparsa 1','Comparsa 2','Muerteada','Grito de independencia','Desfile 1','Desfile 2','Desfile3 ','Exposicion primaria','Exposicion secundaria','Día de la bandera','Homenaje', 'Alza de bandera',
        ]);

        $fecha1 = $this->faker->randomElement([
            '2023-11-23','2023-11-29','2023-12-03', '2023-12-06', '2023-12-10', '2023-12-11', '2023-12-14',
        ]);
        return [
            'fecha_inscripcion' =>$fecha1,
            'aprobado' => $this->faker->numberBetween(0, 1),
            'ciudadano_id'=>Ciudadano::inRandomOrder()->first()->id,
            'cargo_id'=>Cargo::inRandomOrder()->first()->id,
        ];
    }
}
