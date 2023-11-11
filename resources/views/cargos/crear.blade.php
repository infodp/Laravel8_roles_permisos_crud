@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Cargo</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                        <label class="text-danger">Los campos con * son obligatorios</label>
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

                        <form action="{{ route('cargos.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del cargo: <span class="required text-danger">*</span></label>
                                        <input type="text" name="nombre" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_inicio">Fecha de inicio: <span class="required text-danger">*</span></label>
                                        <input type="date" name="fecha_inicio" class="form-control" required>
                                    </div>
                                </div>

                                @php
                                    $fecha_in = request('fecha_inicio'); // Obtiene la fecha de inicio ingresada por el usuario

                                    if (!empty($fecha_in)) {
                                        $fecha_fi = date("Y-m-d", strtotime($fecha_in . "+2 days")); // Calcula la fecha de fin (2 días después)
                                    }
                                    else {
                                        $fecha_fi = date("Y-m-d"); // Si no se ingresa una fecha de inicio, la fecha de fin será la fecha actual
                                    }
                                @endphp

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_fin">Fecha de fin: <span class="required text-danger">*</span></label>
                                        <input type="date" name="fecha_fin" min="{{$fecha_fi}}" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="/cargos" class="btn btn-warning">Cancelar</a>
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
