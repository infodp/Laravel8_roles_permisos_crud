@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Crear grupo</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-6">
                            <!-- Dropdown de filtros -->
                            <div class="dropdown">
                                <form action="{{ route('grupos.create') }}" method="GET">
                                    <!-- Otros campos de formulario según tus necesidades -->
                                    <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button" id="filtroDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Seleccionar filtros">
                                            <i class="fa fa-filter" aria-hidden="true"></i> Filtros
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="filtroDropdown">
                                            <button type="submit" class="dropdown-item {{ request('filtro') === 'filtro1' ? 'active' : '' }}" name="filtro" value="filtro1" title="Aplicar filtro">Activo</button>
                                            <button type="submit" class="dropdown-item {{ request('filtro') === 'filtro2' ? 'active' : '' }}" name="filtro" value="filtro2"  title="Aplicar filtro">Inhactivo</button>
                                            <!-- Puedes agregar más opciones según tus necesidades -->

                                            <button type="submit" class="btn btn-outline-danger btn-md" name="reset_filtro"  title="Eliminar filtros">
                                                <i class="fa fa-trash" aria-hidden="true" ></i> Borrar Filtros
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <br>
                        <!-- Aquí comienza el contenido de tu vista -->
                        <div class="table-responsive">
                            <table class="table table-striped mt-2 table_id" id="miTabla2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Descripción</th>
                                    {{-- <th style="color:#fff;">Apellido Materno</th> --}}
                                    <th style="color:#fff;">Acción</th>
                                </thead>
                                <tbody>
                                    @foreach ($cargos as $cargo)
                                        <tr>
                                            <td style="display: none;">{{ $cargo->id }}</td>
                                            <td>{{ $cargo->nombre }}</td>
                                            <td>{{ $cargo->descripcion }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-{{ $cargo->id }}" title='Inscribir a un cargo'>Inscribir</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Centramos la paginación a la derecha -->
                        </div>
                        <br>
                        <div class="col-md-12 text-right">
                            <a href="{{ route('grupos.index') }}" class="btn btn-warning" title="Cancelar inscripción">Cancelar</a><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal para mostrar detalles de la inscripción -->
@foreach ($cargos as $cargo)
    <div class="modal fade" id="myModal-{{ $cargo->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-{{ $cargo->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel-{{ $cargo->id }}">Detalles del grupo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('storeGrupo', ['cargo' => $cargo->id]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre del grupo: <span class="required text-danger">*</span></label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de inicio:<span class="required text-danger">*</span></label>
                                    <input type="date" name="fecha_inicio" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha_fin">Fecha fin:<span class="required text-danger">*</span></label>
                                    <input type="date" name="fecha_fin" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Cargo seleccionado: <span class="required text-danger">*</span></label>
                                    <label type="text" class="form-control" disabled>{{$cargo->nombre}}</label>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cargo_id">Cargo: </label><span class="required text-danger">*</span>
                                    <select name="cargo_id" class="form-control custom-select" required>
                                        <option disabled selected value="">Selecciona cargo</option>
                                        @foreach(\App\Models\Cargo::where('estado', 1)->get() as $cargo)
                                            <option value="{{$cargo->id}}">{{ $cargo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endforeach


<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<!-- DATATABLES -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- BOOTSTRAP -->
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    new DataTable('#miTabla2', {
        lengthMenu: [
            [3, 5, 15],
            [3, 5, 15]
        ],

        columns: [
            { Id: 'Id' },
            { Nombre: 'Nombre' },
            { Estado: 'estado' },
            { Acciones: 'Acciones' }
        ],

        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        }
    });
</script>
@endsection
