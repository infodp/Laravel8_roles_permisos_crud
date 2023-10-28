<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Evento;

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
        // $eventos = DB::table('eventos')->get();
        // $sql = 'SELECT * FROM eventos';
        // $eventos = DB::select($sql);
        // return $eventos;
        // echo $eventos;
        // while($evento = mysqli_fetch_array($eventos))
        //    {
        //    echo $evento['id'];
        //    echo $evento['nombre'];
        //    echo $evento['fecha_inicio'];
        //    echo $evento['fecha_fin'];
        // //    <!-- color: '#8BC34A' -->
        //    }
        
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
        ]);

        $event = new Evento;

        $event->nombre = $request->input('nombre');
        $event->descripcion = $request->input('descripcion');
        $event->fecha_inicio = $request->input('fecha_inicio');
        $event->fecha_fin = $request->input('fecha_final');

        $event->save();

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
}
