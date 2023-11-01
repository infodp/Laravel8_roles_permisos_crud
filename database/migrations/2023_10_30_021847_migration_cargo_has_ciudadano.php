<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationCargoHasCiudadano extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos_has_ciudadanos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inscripcion');
            $table->boolean('aprobado');
            $table->foreignId('ciudadano_id') ->nullable()
            ->constrained()
            ->onDelete('set null');
            $table->foreignId('cargo_id') ->nullable()
            ->constrained()
            ->onDelete('set null');
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
        Schema::dropIfExists('cargos_has_ciudadanos');
    }
}
