<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
use App\Models\Cargo;
use Illuminate\Support\Facades\DB;
// use Carbon\Carbon;

class CargoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-cargo|crear-cargo|editar-cargo|borrar-cargo')->only('index');
         $this->middleware('permission:crear-cargo', ['only' => ['create','store']]);
         $this->middleware('permission:editar-cargo', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-cargo', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        $cargos = $query->get();
        // $cargos = Cargo::whereDoesntHave('ciudadanos')->get();
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
            'nombre' => ['required', 'unique:cargos'],
            'descripcion' => 'required',
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
            'descripcion'=>'required',
            'estado' => 'required|boolean',
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

    public function eliminar($id)
    {
        DB::table('cargos')->whereId($id)->delete();

        return redirect()->route('cargos.index')->with('success', 'Cargo eliminado exitosamente.');
    }
}
