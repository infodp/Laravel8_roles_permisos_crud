<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargos_has_ciudadano;
use App\Models\Ciudadano;
use Illuminate\Support\Facades\DB;

class InscripcionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-inscripcion|crear-inscripcion|editar-inscripcion|borrar-inscripcion')->only('index');
         $this->middleware('permission:crear-inscripcion', ['only' => ['create','store']]);
         $this->middleware('permission:editar-inscripcion', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-inscripcion', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inscripciones = Cargos_has_ciudadano::query()
            ->join('cargos', 'cargos.id', '=', 'cargos_has_ciudadanos.cargo_id')
            ->join('ciudadanos', 'ciudadanos.id', '=', 'cargos_has_ciudadanos.ciudadano_id')
            ->select('cargos_has_ciudadanos.id as idd','ciudadanos.id', 'ciudadanos.nombre as ciudadano', 'ciudadanos.apellido_p as ap', 'ciudadanos.apellido_m as am', 'cargos.nombre as cargo','cargos.fecha_inicio as fi','cargos.fecha_fin as ff', 'cargos.estado as estado')
            ->get();
        return view('inscripciones.index', compact('inscripciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudadanos = Ciudadano::where('estado','1')->get();
        return view('inscripciones.crear', compact('ciudadanos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $ciudadanoId)
    {
        request()->validate([
           'cargo_id' => 'required',
           'fecha_inscripcion' => 'required',
        ]);
        $ciudadanoData = $request->all();
        $ciudadanoData['aprobado'] = false;
        $ciudadanoData['ciudadano_id'] = $ciudadanoId;

        Cargos_has_ciudadano::create($ciudadanoData);

        // Ciudadano::create($request->all());

        return redirect()->route('inscripcion.index')->with('success', 'Inscripción registrada exitosamente.');
    }

    public function inscribir(Ciudadano $ciudadano){
        dd($ciudadano);
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
    public function edit(Cargos_has_ciudadano $inscripcion)
    {
        return view('inscripciones.editar',compact('inscripcion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargos_has_ciudadano $inscripcion)
    {
        request()->validate([
            'fecha_inscripcion' => 'required',
            'cargo_id' => 'required',
        ]);

        $inscripcion->update($request->all());

        return redirect()->route('inscripcion.index')->with('success', 'Inscripción actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cargos_has_ciudadano $inscripcion)
    {
        $inscripcion->delete();
        return redirect()->route('inscripcion.index')->with('success', 'Inscripción eliminada exitosamente');
    }

    public function eliminar($id)
    {
        DB::table('cargos_has_ciudadanos')->whereId($id)->delete();

        return redirect()->route('inscripcion.index')->with('success', 'Inscripción eliminada exitosamente.');
    }


    // public function guardar(Request $request, $ciudadanoId)
    // {
    //     dd($ciudadanoId);
    // }
}
