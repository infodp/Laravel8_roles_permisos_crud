<?php

namespace App\Http\Controllers;

use App\Models\Ciudadano;
use Illuminate\Support\Facades\DB;
// use App\Models\Cargo;

use Illuminate\Http\Request;

class CiudadanoController extends Controller
{
    public $ver = false;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:ver-ciudadano|crear-ciudadano|editar-ciudadano|borrar-ciudadano')->only('index');
         $this->middleware('permission:crear-ciudadano', ['only' => ['create','store']]);
         $this->middleware('permission:editar-ciudadano', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-ciudadano', ['only' => ['destroy']]);
    }

    public function index(Request $request)
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
                    case 'filtro3':
                        $query->where('estado', '=', 1);
                        break;
                        case 'filtro4':
                        $query->where('estado', '=', 0);
                        break;
                }
            }
        }
        $ciudadanos = $query->get();
        // $ciudadanos = Ciudadano::all();
        return view('ciudadanos.index', compact('ciudadanos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ciudadanos.crear');
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
            'apellido_p' => 'required',
            'apellido_m' => 'required',
            'sexo' => 'required',
            'fecha_nacimiento' => 'required',
            'curp' =>  ['required', 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'],
            'num_telefonico' => 'required|regex:/^[0-9]{10}$/',
            'calle' => 'required',
            'num_calle' => 'required',
        ]);
        $ciudadanoData = $request->all();
        $ciudadanoData['estado'] = true;

        Ciudadano::create($ciudadanoData);

        // Ciudadano::create($request->all());

        return redirect()->route('ciudadanos.index')->with('success', 'Ciudadano guardado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ciudadano $ciudadano)
    {
        // $ciudadano=Ciudadano::find($ciudadano-)
        // $this->ver = true;
        return view('ciudadanos.ver');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ciudadano $ciudadano)
    {
        // dd($ciudadano);
        return view('ciudadanos.editar',compact('ciudadano'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ciudadano $ciudadano)
    {
        request()->validate([
            'nombre' => 'required',
            'apellido_p' => 'required',
            'apellido_m' => 'required',
            'sexo' => 'required',
            'fecha_nacimiento' => 'required',
            'curp' =>  ['required', 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'],
            'num_telefonico' => 'required|regex:/^[0-9]{10}$/',
            'calle' => 'required',
            'num_calle' => 'required',
            'estado'=>'required',
        ]);

        $ciudadano->update($request->all());

        return redirect()->route('ciudadanos.index')->with('success', 'Ciudadano actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ciudadano $ciudadano)
    {
        $ciudadano->delete();

        return redirect()->route('ciudadanos.index')->with('success', 'Ciudadano eliminado exitosamente.');
    }

    public function showModal(Ciudadano $ciudadano)
    {
        // dd('ddd');
        return view('ciudadanos.ver');
    }

    public function eliminarId($id)
    {
        DB::table('ciudadanos')->whereId($id)->delete();

        return redirect()->route('ciudadanos.index')->with('success', 'Ciudadano eliminado exitosamente.');
    }
}
