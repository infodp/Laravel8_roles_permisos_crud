<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargos_has_ciudadano;
use App\Models\Ciudadano;

class CalificacionController extends Controller
{
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
            ->select('cargos_has_ciudadanos.id as idd','cargos_has_ciudadanos.aprobado as apro','ciudadanos.id', 'ciudadanos.nombre as ciudadano', 'ciudadanos.apellido_p as ap', 'ciudadanos.apellido_m as am', 'cargos.nombre as cargo','cargos.fecha_inicio as fi','cargos.fecha_fin as ff')
            ->get();
        return view('calificaciones.index', compact('inscripciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
           'aprobado' => 'required',
        ]);
        // $ciudadanoData = $request->all();
        // $ciudadanoData['aprobado'] = false;
        // $ciudadanoData['ciudadano_id'] = $ciudadanoId;

        // Cargos_has_ciudadano::create($ciudadanoData);

        Cargos_has_ciudadano::create($request->all());

        return redirect()->route('calificaciones.index')->with('success', 'Calificacion registrada exitosamente.');
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
        //
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
            'aprobado' => 'required',
        ]);

        $inscripcion->update($request->all());

        return redirect()->route('calificacion.index')->with('success', 'Calificación actualizada exitosamente.');
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
}
