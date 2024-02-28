@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Rol</h3>
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

                    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="">Nombre del Rol:</label> <span class="required text-danger">*</span>
                                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="">Permisos para este Rol:</label><span class="required text-danger">*</span>
                                <br/>
                                <div class="container">
                                    @php $permissionsCount = count($permission); @endphp
                                    @for ($i = 0; $i < $permissionsCount; $i += 4)
                                        <div class="row">
                                            @for ($j = $i; $j < min($i + 4, $permissionsCount); $j++)
                                                <div class="col">
                                                    <label>
                                                        {{ Form::checkbox('permission[]', $permission[$j]->id, in_array($permission[$j]->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                                        {{ $permission[$j]->name }}
                                                    </label>
                                                </div>
                                            @endfor
                                        </div>
                                    @endfor
                                </div>

                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="/roles" class="btn btn-warning">Cancelar</a>
                        </div>

                    </div>
                    {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
