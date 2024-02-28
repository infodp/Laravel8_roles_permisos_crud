<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\notificaciones;
use App\Models\Evento;
use App\Models\User;
use App\Events\NotificacionEvento;
use Illuminate\Notifications\Notifiable;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $eventos= Evento::all();
        
        return view('agenda.index')->with('eventos', $eventos);

    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
            'hora_inicio' => 'required',
        ]);

        $hora = $request->input('hora_inicio');
        $horaa = substr($hora, 0, 2);
        $horaa = (int)$horaa;
        $minuto = substr($hora, 3, 2);
        $minuto = (int)$minuto;
        $segundo = substr($hora, 6, 2);
        $segundo = (int)$segundo;
        $formato = substr($hora, 9, 2);
        if($formato=="PM" && $horaa!=12){
            $horaa = $horaa + 12;
        }

        $horaEvento = "$horaa:$minuto:$segundo";

        $event = new Evento;

        $event->nombre = $request->input('nombre');
        $event->descripcion = $request->input('descripcion');
        $event->fecha_inicio = $request->input('fecha_inicio');
        $event->fecha_fin = $request->input('fecha_final');
        $event->hora = $horaEvento;
        $event->estado = true;

        $event->save();

        // auth()->user()->notify(new notificaciones($event));
        
        // User::all()
        // ->each(function(User $user) use ($event){
        //     $user->notify(new notificaciones($event));
        // });
        event(new NotificacionEvento($event));

        return redirect()->route('agenda.index')->with('success', 'Evento guardado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        echo 'estas en la actualización';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('eventos')->whereId($id)->delete();
    }

    public function eliminar($id)
    {
        DB::table('eventos')->whereId($id)->delete();
    }

    public function actualizar(Request $request)
    {
        $this->validate($request,[
            'evento' => 'required',
            'descripcionn' => 'required',
            'fecha_inicioo' => 'required',
            'fecha_finall' => 'required',
            'hora_inicioo' => 'required',
        ]);
        $hora = $_POST['hora_inicioo'];
        $horaa = substr($hora, 0, 2);
        $horaa = (int)$horaa;
        $minuto = substr($hora, 3, 2);
        $minuto = (int)$minuto;
        $segundo = substr($hora, 6, 2);
        $segundo = (int)$segundo;
        $formato = substr($hora, 9, 2);
        if($formato=="PM" && $horaa!=12){
            $horaa = $horaa + 12;
        }

        $horaEvento = "$horaa:$minuto:$segundo";
        $id = $_POST["idEvento"];
        $event = evento::findOrFail($id);
        $event->nombre = $_POST["evento"];
        $event->descripcion = $_POST['descripcionn'];
        $event->fecha_inicio = $_POST['fecha_inicioo'];
        $event->fecha_fin = $_POST['fecha_finall'];
        $event->hora = $horaEvento;

        $event->save();

        return redirect()->route('agenda.index')->with('success', 'Evento actualizado exitosamente.');
        // echo $dni;
        // echo("estas en la actualización");
    }

    public function drag_drop()
    {
        $id         = $_POST['idEvento'];
        $start            = $_REQUEST['start'];
        $end              = $_REQUEST['end']; 

        $event = evento::findOrFail($id);
        $event->fecha_inicio = $_REQUEST['start'];
        $event->fecha_fin = $_REQUEST['end']; 
        $event->save();
    }

    public function markNotificacion(Request $request){
        auth()->user()->unreadNotifications
            ->when($request->input('id'), function($query) use ($request){
                return $query->where('id', $request->input('id'));
            })->markAsRead();
        return response()->noContent();
    }
}
