<?php

namespace App\Http\Controllers;

use App\Models\Ciudadano;
// use App\Models\Cargo;

use Illuminate\Http\Request;

class CiudadanoController extends Controller
{
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

    public function index()
    {
        $ciudadanos = Ciudadano::all();
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
            'calle' => 'required',
            'num_calle' => 'required',
        ]);

        Ciudadano::create($request->all());

        return redirect()->route('ciudadanos.index');
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
            'calle' => 'required',
            'num_calle' => 'required',
        ]);

        $ciudadano->update($request->all());

        return redirect()->route('ciudadanos.index');
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
