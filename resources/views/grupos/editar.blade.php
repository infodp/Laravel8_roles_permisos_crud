@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar grupo</h3>
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
                        <form action="{{ route('grupos.update', $grupo->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del grupo: <span class="required text-danger">*</span></label>
                                        <input type="text" name="nombre" class="form-control" value="{{ $grupo->nombre ?? '' }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_inicio">Fecha de inicio: <span class="required text-danger">*</span></label>
                                        <input type="date" name="fecha_inicio" class="form-control" min="{{ $grupo->fecha_inicio }}" value="{{ $grupo->fecha_inicio }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_fin">Fecha de fin: <span class="required text-danger">*</span></label>
                                        <input type="date" name="fecha_fin" min="{{ $grupo->fecha_fin }}" class="form-control" value="{{ $grupo->fecha_fin }}">
                                    </div>
                                </div>

                                {{-- <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="form-floating">
                                            <label for="nombre">Descripcion: <span class="required text-danger">*</span></label>
                                            <textarea class="form-control" name="descripcion" style="height: 70px">{{ $grupo->descripcion }}</textarea>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cargo_id">Nombre del Cargo: <span class="required text-danger">*</span></label>
                                        <select name="cargo_id" class="form-control">
                                            <option value="">Seleccionar cargo</option>
                                            @foreach(\App\Models\Cargo::where('estado', 1)->get() as $cargo)
                                                <option value="{{ $cargo->id }}" {{ $grupo->cargo_id == $cargo->id ? 'selected' : '' }}>
                                                    {{ $cargo->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="estado">Estado: <span class="required text-danger">*</span></label>
                                        <select name="estado" class="form-control">
                                            <option disabled>Selecciona Estado</option>
                                            <option value="1" {{ $grupo->estado === 1 ? 'selected' : '' }}>Activo</option>
                                            <option value="0" {{ $grupo->estado === 0 ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="{{ route('grupos.index') }}" class="btn btn-warning">Cancelar</a>
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
