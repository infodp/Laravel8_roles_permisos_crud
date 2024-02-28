<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargos_has_ciudadano;
use App\Models\Ciudadano;
use App\Models\Grupo;
use DateTime;
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
            ->join('grupos', 'grupos.id', '=', 'cargos_has_ciudadanos.grupo_id')
            ->join('ciudadanos', 'ciudadanos.id', '=', 'cargos_has_ciudadanos.ciudadano_id')
            ->join('cargos','cargos.id', '=', 'grupos.cargo_id')
            ->select('cargos_has_ciudadanos.id as idd','ciudadanos.id', 'ciudadanos.nombre as ciudadano', 'ciudadanos.apellido_p as ap', 'ciudadanos.apellido_m as am', 'grupos.nombre as grupo','grupos.fecha_inicio as fi','grupos.fecha_fin as ff', 'grupos.estado as estado','cargos.nombre as cargo')
            ->get();
        return view('inscripciones.index', compact('inscripciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    $query = Ciudadano::query();

    // Aplicar filtros según la solicitud
    if (!$request->has('reset_filtro')) {
        // No aplicar ningún filtro
        if ($request->has('filtro')) {
            switch ($request->get('filtro')) {
                case 'filtro1':
                    $query->where('sexo', '=', 'Masculino');
                    break;
                case 'filtro2':
                    $query->where('sexo', '=', 'Femenino');
                    break;
            }
        }
    }

    // Filtrar por ciudadanos con estado igual a 1
    $ciudadanos = $query->where('estado', '=', 1)->get();

    $grupos = Grupo::query()
                ->join('cargos','cargos.id','=','grupos.cargo_id')
                ->select('grupos.id as id','grupos.nombre as nombre','grupos.fecha_inicio','grupos.fecha_fin','grupos.estado','cargos.nombre as nom_cargos')
                ->where('grupos.estado', '=',1)
                ->get();

    return view('inscripciones.crear', compact('ciudadanos','grupos'));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $ciudadanoId)
    {
        $grupoId = $request->input('inscribir');
        // dd($grupoId);
        // request()->validate([
        //    'grupo_id' => 'required',
        // ]);
        $ciudadanoData['fecha_inscripcion'] = today();
        $ciudadanoData['aprobado'] = false;
        $ciudadanoData['observacion'] = '';
        $ciudadanoData['grupo_id'] = $grupoId;
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
            'grupo_id' => 'required',
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
