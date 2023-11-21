<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CargoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nombre1 = $this->faker->randomElement([
            'Itendencia','Limpieza','Secretaria 1', 'Secretaria 2', 'Secretaria 3', 'Lavador', 'Policia n1', 'Policia n2', 'Policia n3', 'Guardia'
        ]);
        $fecha1 = $this->faker->randomElement([
            '2023-11-25','2023-11-29','2023-12-03', '2023-12-06', '2023-12-10', '2023-12-11', '2023-12-14',
        ]);
        $fecha2 = $this->faker->randomElement([
            '2023-11-27','2023-11-30','2023-12-07', '2023-12-10', '2023-12-15', '2023-12-19', '2023-12-20',
        ]);
        return [
            'nombre' =>$nombre1,
            'fecha_inicio'=>$fecha1,
            'fecha_fin'=>$fecha2,
            'estado'=>1,
        ];
    }
}
