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
                                        <label for="ciudadano">Nombre del ciudadano: <span class="required text-danger">*</span></label>
                                        <select name="ciudadano" class="form-control">
                                            <option value="">Seleccionar cargo</option>
                                            @foreach(\App\Models\Ciudadano::where('estado', 1)->get() as $ciudadano)
                                                <option value="{{ $ciudadano->id }}" {{ $inscripcion->ciudadano_id == $ciudadano->id ? 'selected' : '' }}>
                                                    {{ $ciudadano->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cargo_id">Nombre del Cargo: <span class="required text-danger">*</span></label>
                                        <select name="cargo_id" class="form-control">
                                            <option value="">Seleccionar cargo</option>
                                            @foreach(\App\Models\Cargo::where('estado', 1)->get() as $cargo)
                                                <option value="{{ $cargo->id }}" {{ $inscripcion->cargo_id == $cargo->id ? 'selected' : '' }}>
                                                    {{ $cargo->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inscripcion">Fecha de inscripción: <span class="required text-danger">*</span></label>
                                        <input type="date" name="inscripcion" class="form-control" value="{{ $inscripcion->fecha_inscripcion }}">
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
