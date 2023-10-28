@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Ciudadano</h3>
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


                        <form action="{{ route('cargos.update', $cargo->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del cargo: <span class="required text-danger">*</span></label>
                                        <input type="text" name="nombre" class="form-control" value="{{ $cargo->nombre }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_inicio">Fecha de inicio: <span class="required text-danger">*</span></label>
                                        <input type="date" name="fecha_inicio" class="form-control" min="{{ $cargo->fecha_inicio }}" value="{{ $cargo->fecha_inicio }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_fin">Fecha de fin: <span class="required text-danger">*</span></label>
                                        <input type="date" name="fecha_fin" min="{{ $cargo->fecha_fin }}" class="form-control" value="{{ $cargo->fecha_fin }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="estado">Estado: <span class="required text-danger">*</span></label>
                                        <select name="estado" class="form-control">
                                            <option disabled>Selecciona Estado</option>
                                            <option value="1" {{ $cargo->estado === 1 ? 'selected' : '' }}>Activo</option>
                                            <option value="0" {{ $cargo->estado === 0 ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="{{ route('cargos.index') }}" class="btn btn-warning">Cancelar</a>
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
