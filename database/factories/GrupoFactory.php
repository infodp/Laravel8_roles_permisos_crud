<?php

namespace Database\Factories;
use App\Models\Cargo;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nombre1 = $this->faker->randomElement([
            'IDS','ODP','DFF 1', 'SRR 2', 'OWOR 3', 'FSPF', 'EEMFE n1', 'DSFL n2', 'ERWR n3', 'HFFR'
        ]);
        $fecha1 = $this->faker->randomElement([
            '2023-11-25','2023-11-29','2023-12-03', '2023-12-06', '2023-12-10', '2023-12-11', '2023-12-14',
        ]);
        $fecha2 = $this->faker->randomElement([
            '2023-11-27','2023-11-30','2023-12-07', '2023-12-10', '2023-12-15', '2023-12-19', '2023-12-20',
        ]);
        return [
            'nombre' =>$nombre1,
            'fecha_inicio'=> $fecha1,
            'fecha_fin'=> $fecha2,
            'estado'=>1,
            'cargo_id'=>Cargo::inRandomOrder()->first()->id,
        ];
    }
}
