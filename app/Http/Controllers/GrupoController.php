<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Grupo::query()
                ->join('cargos','cargos.id','=','grupos.cargo_id')
                ->select('grupos.id as id','grupos.nombre as nombre','grupos.fecha_inicio','grupos.fecha_fin','grupos.estado','cargos.nombre as nom_cargos');

        // Aplicar filtros según la solicitud
        if (!$request->has('reset_filtro')) {
            // No aplicar ningún filtro
            if ($request->has('filtro')) {
                switch ($request->get('filtro')) {
                    case 'filtro1':
                        $query->where('grupos.estado', '=', 1);
                        break;
                    case 'filtro2':
                        $query->where('grupos.estado', '=', 0);
                        break;
                }
            }
        }
        $grupos = $query->get();

        return view('grupos.index', compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $query = Cargo::query();

        // Aplicar filtros según la solicitud
        if (!$request->has('reset_filtro')) {
            // No aplicar ningún filtro
            if ($request->has('filtro')) {
                switch ($request->get('filtro')) {
                    case 'filtro1':
                        $query->where('estado', '=', 1);
                        break;
                    case 'filtro2':
                        $query->where('estado', '=', 0);
                        break;
                }
            }
        }
        $cargos = $query
                ->where('estado', '=',1)
                ->get();
        // $cargos=Cargo::all();
        // $cargos = Cargo::whereDoesntHave('ciudadanos')->get();
        return view('grupos.crear', compact('cargos'));
    }

    public function store(Request $request, $cargoId)
    {
        $request->validate([
            // 'nombre'=> ['required', 'unique:grupos'],
            'nombre' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ]);

        $grupoData = $request->only(['nombre', 'fecha_inicio', 'fecha_fin']);
        $grupoData['estado'] = true;
        $grupoData['cargo_id'] = $cargoId;

        Grupo::create($grupoData);

        return redirect()->route('grupos.index')->with('success', 'Grupo registrada exitosamente.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

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
    public function edit(Grupo $grupo)
    {
        return view('grupos.editar',compact('grupo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupo $grupo)
    {
        request()->validate([
            'nombre' => 'required',
            'fecha_inicio' => 'required|date|date_format:Y-m-d',
            'fecha_fin' => 'required|date|date_format:Y-m-d',
            'estado' => 'required|boolean',
            'cargo_id' => 'required',
        ]);

        $grupo->update($request->all());

        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function eliminar($id)
    {
        DB::table('grupos')->whereId($id)->delete();

        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado exitosamente.');
    }
}
