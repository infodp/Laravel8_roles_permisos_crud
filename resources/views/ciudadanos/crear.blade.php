@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Ciudadano</h3>
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

                        <form action="{{ route('ciudadanos.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre: </label><span class="required text-danger">*</span>
                                        <input type="text" name="nombre" pattern="[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+" title="Solo se permiten letras y espacios" class="form-control" placeholder="Nombre del nuevo ciudadano" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_p">Apellido paterno: </label><span class="required text-danger">*</span>
                                        <input type="text" name="apellido_p" pattern="[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+"  title="Solo se permiten letras" class="form-control" placeholder="Apellido Paterno del nuevo ciudadano" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_m">Apellido Materno: </label><span class="required text-danger">*</span>
                                        <input type="text" name="apellido_m" pattern="[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+"  title="Solo se permiten letras" class="form-control" placeholder="Apellido Materno del nuevo ciudadano" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sexo">Sexo: </label><span class="required text-danger">*</span>
                                        <select name="sexo" class="form-control">
                                            <option disabled selected>Selecciona sexo</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="curp">CURP: </label><span class="required text-danger">*</span>
                                        <input type="text" name="curp" pattern="[A-Za-z0-9]+" title="Solo se permiten letras y números" placeholder="CURP del nuevo ciudadano"  class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_nacimiento">Fecha de nacimiento: <span class="required text-danger">*</span></label>
                                        <input type="date" name="fecha_nacimiento" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="num_telefonico">Numero telefonico: <span class="required text-danger">*</span></label>
                                        <input type="text" name="num_telefonico" pattern="[0-9]*" title="Solo se permiten números" placeholder="Número telefonico" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="calle">Calle: </label><span class="required text-danger">*</span>
                                        <input type="text" name="calle" title="Solo se permiten letras" placeholder="Nombre del la calle" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="num_calle">Numero de calle: </label><span class="required text-danger">*</span>
                                        <input type="text" name="num_calle" pattern="[0-9]*" title="Solo se permiten números" placeholder="Número de casa" required  class="form-control">
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cargo_id">Cargo: </label><span class="required text-danger">*</span>
                                        <select name="cargo_id" class="form-control">
                                            <option disabled selected>Selecciona cargo</option>
                                            @foreach(\App\Models\Cargo::where('estado', 1)->get() as $cargo)
                                                <option value="{{$cargo->id}}">{{ $cargo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="/ciudadanos" class="btn btn-warning">Cancelar</a>
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
