@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar inscripción</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif
                        <form action="{{ route('inscripcion.update', $inscripcion->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del ciudadano: </label>
                                        @php
                                            $ciudadano = \App\Models\Ciudadano::find($inscripcion->ciudadano_id);
                                            $nombreCiudadano = $ciudadano ? $ciudadano->nombre : '';
                                        @endphp
                                        <label class="form-control" autocomplete="off" readonly>{{ ucwords($nombreCiudadano) }} {{ ucwords($ciudadano->apellido_p) }} {{ ucwords($ciudadano->apellido_m)}}</label>
                                    </div>
                                </div>

                                @php
                                    $grupos = \App\Models\Grupo::query()
                                            ->join('cargos','cargos.id','=','grupos.cargo_id')
                                            ->select('grupos.id as idGrupo','grupos.nombre as nombreGrupo','cargos.nombre as cargo')
                                            ->where('grupos.estado', 1)->get();
                                @endphp
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <label for="grupo_id">Grupo asignado: <span class="required text-danger">*</span></label>
                                        <select name="grupo_id" class="form-control">
                                            <option value="">Seleccionar grupo</option>
                                            @foreach($grupos as $grupo)
                                                <option value="{{ $grupo->idGrupo }}" {{ $inscripcion->grupo_id == $grupo->idGrupo ? 'selected' : '' }}>
                                                    {{ $grupo->nombreGrupo }} {{'-> Cargo['}}{{$grupo->cargo}}{{']'}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_inscripcion">Fecha de inscripción: <span class="required text-danger">*</span></label>
                                        <input type="date" name="fecha_inscripcion" class="form-control" value="{{ $inscripcion->fecha_inscripcion}}">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="{{ route('inscripcion.index') }}" class="btn btn-warning">Cancelar</a>
                                </div>
                            </div>
                        </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
