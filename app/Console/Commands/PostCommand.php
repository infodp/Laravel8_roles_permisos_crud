<?php

namespace App\Console\Commands;

use App\Models\Evento;
use App\Models\Post;
use Illuminate\Console\Command;
use App\Events\NotificacionEvento;
use Carbon\Carbon;

class PostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creamos una notificación en la base de datos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $eventos = Evento::query()
                        ->select('nombre', 'descripcion','fecha_inicio', 'fecha_fin','hora')
                        ->where('estado','=',1)
                        ->get();

        foreach ($eventos as $evento) {
            $fechaInicio = Carbon::parse($evento->fecha_inicio);
            $diasRestantes = $fechaInicio->diffInDays(Carbon::today());

            if ($diasRestantes <= 3) {
                event(new NotificacionEvento($evento));
            }
        }
    }
}
