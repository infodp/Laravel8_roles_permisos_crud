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
                                        <input type="text" name="nombre" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_p">Apellido paterno: </label><span class="required text-danger">*</span>
                                        <input type="text" name="apellido_p" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_m">Apellido Materno: </label><span class="required text-danger">*</span>
                                        <input type="text" name="apellido_m" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sexo">Sexo: </label><span class="required text-danger">*</span>
                                        <input type="text" name="sexo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="calle">Calle: </label><span class="required text-danger">*</span>
                                        <input type="text" name="calle" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="num_calle">Numero de calle: </label><span class="required text-danger">*</span>
                                        <input type="text" name="num_calle" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cargo_id">Cargo: </label><span class="required text-danger">*</span>
                                        <select name="cargo_id" class="form-control">
                                            @foreach(\App\Models\Cargo::get() as $cargo)
                                                <option value="{{$cargo->id}}">{{ $cargo->nombre }}</option>
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
