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
                                        <label for="nombre">Nombre: </label></label><span class="required text-danger">*</span>
                                        <input type="text" name="nombre" class="form-control" value="{{ $ciudadano->nombre }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_p">Apellido paterno: </label></label><span class="required text-danger">*</span>
                                        <input type="text" name="apellido_p" class="form-control" value="{{ $ciudadano->apellido_p }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_m">Apellido materno: </label></label><span class="required text-danger">*</span>
                                        <input type="text" name="apellido_m" class="form-control" value="{{ $ciudadano->apellido_m }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sexo">Sexo: </label></label><span class="required text-danger">*</span>
                                        <select name="sexo" class="form-control">
                                            <option value="Hombre" {{ $ciudadano->sexo === 'Hombre' ? 'selected' : '' }}>Hombre</option>
                                            <option value="Mujer" {{ $ciudadano->sexo === 'Mujer' ? 'selected' : '' }}>Mujer</option>
                                            <option value="Otro" {{ $ciudadano->sexo === 'Otro' ? 'selected' : '' }}>Otro</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="calle">Calle: </label></label><span class="required text-danger">*</span>
                                        <input type="text" name="calle" class="form-control" value="{{ $ciudadano->calle }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="num_calle">Numero de calle: </label></label><span class="required text-danger">*</span>
                                        <input type="text" name="num_calle" class="form-control" value="{{ $ciudadano->num_calle }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cargo_id">Cargo: </label></label><span class="required text-danger">*</span>
                                        <select name="cargo_id" class="form-control">
                                            <option value="">Seleccionar cargo</option>
                                            @foreach(\App\Models\Cargo::get() as $cargo)
                                                <option value="{{$cargo->id}}" {{ $ciudadano->cargo_id == $cargo->id ? 'selected' : '' }}>{{ $cargo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
