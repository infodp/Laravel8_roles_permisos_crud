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


                        <form action="{{ route('ciudadanos.update', $ciudadano->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre: <span class="required text-danger">*</span></label>
                                        <input type="text" name="nombre" pattern="[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+" title="Solo se permiten letras y espacios" class="form-control" placeholder="Nombre del ciudadano" value="{{ $ciudadano->nombre }}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_p">Apellido paterno: <span class="required text-danger">*</span></label>
                                        <input type="text" name="apellido_p" pattern="[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+" title="Solo se permiten letras" class="form-control" placeholder="Apellido Paterno del ciudadano" value="{{ $ciudadano->apellido_p }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_m">Apellido materno: <span class="required text-danger">*</span></label>
                                        <input type="text" name="apellido_m" pattern="[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+"title="Solo se permiten letras" class="form-control" placeholder="Apellido Materno del ciudadano" value="{{ $ciudadano->apellido_m }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sexo">Sexo: <span class="required text-danger">*</span></label>
                                        <select name="sexo" class="form-control">
                                            <option disabled selected>Selecciona sexo</option>
                                            <option value="Masculino" {{ $ciudadano->sexo === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                            <option value="Femenino" {{ $ciudadano->sexo === 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="curp">Curp: <span class="required text-danger">*</span></label>
                                        <input type="text" name="curp" pattern="[A-Za-z0-9]+" title="Solo se permiten letras y números" placeholder="CURP del ciudadano" class="form-control" value="{{ $ciudadano->curp }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_nacimiento">Fecha de nacimiento: <span class="required text-danger">*</span></label>
                                        <input type="date" name="fecha_nacimiento" class="form-control" value="{{ $ciudadano->fecha_nacimiento }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="num_telefonico">Numero telefonico: <span class="required text-danger">*</span></label>
                                        <input type="tel" name="num_telefonico" pattern="[0-9]*" title="Solo se permiten números" placeholder="Número telefonico" class="form-control" value="{{ $ciudadano->num_telefonico }}">
                                    </div>
                                </div>

                                {{-- datos del domicilio --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="calle">Calle: <span class="required text-danger">*</span></label>
                                        <input type="text" name="calle" pattern="[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+" title="Solo se permiten letras" placeholder="Nombre del la calle" class="form-control" value="{{ $ciudadano->calle }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="num_calle">Numero de calle: <span class="required text-danger">*</span></label>
                                        <input type="text" name="num_calle" pattern="[0-9]*" title="Solo se permiten números" placeholder="Número de casa"  class="form-control" value="{{ $ciudadano->num_calle }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="estado">Estado: <span class="required text-danger">*</span></label>
                                        <select name="estado" class="form-control">
                                            <option disabled>Selecciona Estado</option>
                                            <option value="1" {{ $ciudadano->estado === 1 ? 'selected' : '' }}>Activo</option>
                                            <option value="0" {{ $ciudadano->estado === 0 ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="{{ route('ciudadanos.index') }}" class="btn btn-warning">Cancelar</a>
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
