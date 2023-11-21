<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
// use App\Models\Evento;

class EventoFactory extends Factory
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
            '2023-11-25','2023-11-29','2023-12-03', '2023-12-06', '2023-12-10', '2023-12-11', '2023-12-14',
        ]);
        $fecha2 = $this->faker->randomElement([
            '2023-11-25','2023-11-29','2023-12-03', '2023-12-06', '2023-12-10', '2023-12-11', '2023-12-14',
        ]);
        return [
            'nombre' =>$nombre1,
            'descripcion'=> $this->faker->text(40),
            'fecha_inicio'=>$fecha1,
            'fecha_fin' => $fecha2,
            'hora'=>$this->faker->time(),
            'estado'=>1,
        ];
    }
}
