<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CiudadanoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        $Calles=$this->faker->randomElement([
            'Av. Nogales', 'Av.idendpendencia', 'Calle Nopalera', 'Calle union', 'Av. Benito Juárez', 'Calle Honduras', 'Av. Tatiana', 'Av. Diseñar',
        ]);

        $nombre1 = $this->faker->randomElement([
            'Sergio','Saul','Valentina','Regina','Camila','Maria','Fernanda','Maria','Valeria','Renata','Victoria','Maria','Expropiasion', 'Juana','Arturo','Alexis','Carmen','Alejandro','Alejandra','Mareli','Natali',
            'Concha','Natalia', 'Mareli', 'MariaBD','Mateo','Sebastian','Emiliano','Diego','Miguel','angel','Daniel','Daniela',
            'Jesus', 'Pedro','Emiliano','Gael', 'David', 'Marco','Farid', 'Erik', 'Pablo','Santiago','Leonardo','Victoria', 'Andre','Manuel', 'Martin', 'Perla', 'Rebecca','Izmucaneth', 'Abimael','Maricela', 'Francisco',
        ]);
        $nombre2 = $this->faker->randomElement([
            'Sergio','Saul','Valentina','Regina','Camila','Maria','Fernanda','Maria','Valeria','Renata','Victoria','Maria','Expropiasion', 'Juana','Arturo','Alexis','Carmen','Alejandro','Alejandra','Mareli','Natali',
            'Concha','Natalia', 'Mareli', 'MariaBD','Mateo','Sebastian','Emiliano','Diego','Miguel','angel','Daniel','Daniela',
            'Jesus', 'Pedro','Emiliano','Gael', 'David', 'Marco','Farid', 'Erik', 'Pablo','Santiago','Leonardo','Victoria', 'Andre','Manuel', 'Martin', 'Perla', 'Rebecca','Izmucaneth', 'Abimael','Maricela', 'Francisco',
        ]);

        $apellido_paterno = $this->faker->randomElement([
            'Lopez','Garcia','Hernandez','Gonzalez','Perez','Rodriguez', 'Sanchez','Ramirez','Cruz','Gomez','Flores','Morales',
            'Vazquez','Reyes','Torres','Jimenez','Diaz','Gutierrez','Mendoza','Ruiz','Ortiz','Aguilar','Moreno','Castillo','alvarez','Zarate', 'Anaya','Juarez','Suarez','Dominguez','Ramos','Herrera','Medina','Castro','Guzman'
        ]);

        $apellido_materno = $this->faker->randomElement([
            'Lopez','Garcia','Hernandez','Gonzalez','Perez','Rodriguez', 'Sanchez','Ramirez','Cruz','Gomez','Flores','Morales',
            'Vazquez','Reyes','Torres','Jimenez','Diaz','Gutierrez','Mendoza','Ruiz','Ortiz','Aguilar','Moreno','Castillo','alvarez','Zarate', 'Anaya','Juarez','Suarez','Dominguez','Ramos','Herrera','Medina','Castro','Guzman'
        ]);

        return [
            'nombre' =>"$nombre1 $nombre2",
            'apellido_m' => $apellido_materno,
            'apellido_p'=> $apellido_paterno,
            'sexo'=>$this->faker->randomElement(['Masculino', 'Femenino']),
            'curp' => $this->faker->regexify('/[A-Z][AEIOUX][A-Z]{2}\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])[HM](AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z0-9]\d/'),
            'fecha_nacimiento'=>$this->faker->date(),
            'calle'=>$Calles,
            'num_calle'=>$this->faker->numberBetween(0, 100),
            'num_exterior'=>$this->faker->numberBetween(0, 50),
            'num_interior'=>$this->faker->numberBetween(0, 30),
            'referencia'=> $this->faker->text(30),
            'observaciones'=> $this->faker->text(30),
            'num_telefonico' => $this->faker->regexify('/^[0-9]{10}$/'),
            'estado'=>1,
        ];
    }
}
