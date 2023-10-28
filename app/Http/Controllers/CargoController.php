<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
use App\Models\Cargo;
// use Carbon\Carbon;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $cargos = Cargo::all();
        return view('cargos.index', compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cargos.crear');
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
            'nombre' => 'required',
            'fecha_inicio' => 'required|regex:/^\d{4}-\d{2}-\d{2}$/',
            'fecha_fin' => 'required|regex:/^\d{4}-\d{2}-\d{2}$/',
        ]);
        $cargoData = $request->all();
        $cargoData['estado'] = true;

        Cargo::create($cargoData);

        // Ciudadano::create($request->all());

        return redirect()->route('cargos.index')->with('success', 'Cargo guardado exitosamente.');
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
    public function edit(Cargo $cargo)
    {
        return view('cargos.editar',compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargo $cargo)
    {
        // dd($request->fecha_inicio);
        request()->validate([
            'nombre' => 'required',
            'fecha_inicio' => 'required|regex:/^\d{4}-\d{2}-\d{2}$/',
            'fecha_fin' => 'required|regex:/^\d{4}-\d{2}-\d{2}$/',
            'estado'=>'required',
        ]);

        $cargo->update($request->all());

        return redirect()->route('cargos.index')->with('success', 'Cargo actualizado exitosamente.');
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
