<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationCiudadano extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciudadanos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido_p');
            $table->string('apellido_m');
            $table->string('sexo');
            $table->string('curp');
            $table->date('fecha_nacimiento');
            $table->string('calle');
            $table->bigInteger('num_calle');
            $table->bigInteger('num_exterior');
            $table->bigInteger('num_interior');
            $table->string('referencia');
            $table->boolean('estado');
            $table->bigInteger('num_telefonico');
            $table->string('observaciones');
            // $table->foreignId('cargo_id') ->nullable()
            // ->constrained()
            // ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ciudadanos');
    }
}
