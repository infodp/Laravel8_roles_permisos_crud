@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Crear inscripción</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">Lista de ciudadanos disponibles</h5>
                        <div class="col-md-6">
                            <!-- Dropdown de filtros -->
                            <div class="dropdown">
                                <form action="{{ route('inscripcion.create') }}" method="GET">
                                    <!-- Otros campos de formulario según tus necesidades -->
                                    <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button" id="filtroDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Seleccionar filtros">
                                            <i class="fa fa-filter" aria-hidden="true"></i> Filtros
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="filtroDropdown">
                                            <button type="submit" class="dropdown-item {{ request('filtro') === 'filtro1' ? 'active' : '' }}" name="filtro" value="filtro1" title="Aplicar filtro">Masculino</button>
                                            <button type="submit" class="dropdown-item {{ request('filtro') === 'filtro2' ? 'active' : '' }}" name="filtro" value="filtro2" title="Aplicar filtro">Femenino</button>
                                            <!-- Puedes agregar más opciones según tus necesidades -->

                                            <button type="submit" class="btn btn-outline-danger btn-md" name="reset_filtro" title="Eliminar filtros">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Borrar Filtros
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
                                    <th style="color:#fff;">Curp</th>
                                    <th style="color:#fff;">Ciudadano</th>
                                    <th style="color:#fff;">Sexo</th>
                                    <th style="color:#fff;">Acción</th>
                                </thead>
                                <tbody>
                                    @foreach ($ciudadanos as $ciudadano)
                                        <tr>
                                            <td style="display: none;">{{ $ciudadano->id }}</td>
                                            <td>{{ucwords ($ciudadano->curp) }}</td>
                                            <td>{{ucwords ($ciudadano->nombre ) }} {{  ucwords ($ciudadano->apellido_p ) }} {{  ucwords ($ciudadano->apellido_m ) }}</td>
                                            <td>{{ucwords ($ciudadano->sexo ) }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-{{ $ciudadano->id }}" title='Seleccionar un grupo'>Inscribir a grupo</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Centramos la paginación a la derecha -->
                        </div>
                        <br>
                        <div class="col-md-12 text-right">
                            <a href="{{ route('inscripcion.index') }}" class="btn btn-warning" title="Cancelar inscripción">Cancelar Inscripción</a><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal para mostrar detalles de la inscripción -->
@foreach ($ciudadanos as $ciudadano)
    <div class="modal fade modal-ciudadano" id="myModal-{{ $ciudadano->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-{{ $ciudadano->id }}" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel-{{ $ciudadano->id }}">Seleccionar grupo para inscribir al ciudadano:
                            {{ ucwords($ciudadano->nombre)}} {{ ucwords($ciudadano->apellido_p)}} {{ ucwords($ciudadano->apellido_m)}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('storeInscripcion', ['ciudadano' => $ciudadano->id]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped mt-2 table_id" id="miTabla3" style="width: 100%;">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color: #fff; cursor: pointer;">Grupo</th>
                                    <th style="color:#fff; cursor: pointer;">Fecha Inicio</th>
                                    <th style="color:#fff; cursor: pointer;">Fecha Fin</th>
                                    <th style="color:#fff; cursor: pointer;">Cargo</th>
                                    <th style="color:#fff;">Acción</th>
                                </thead>
                                <tbody>
                                    @foreach ($grupos as $grupo)
                                        <tr>
                                            <td style="display: none;">{{ $grupo->id }}</td>
                                            <td>{{ ucwords($grupo->nombre) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($grupo->fecha_inicio)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($grupo->fecha_fin)->format('d-m-Y') }}</td>
                                            <td>{{ ucwords($grupo->nom_cargos) }}</td>
                                            <td>
                                                <!-- Agrega aquí tus acciones si es necesario -->
                                                <button type="submit" class="btn btn-info" name="inscribir" value="{{ $grupo->id }}">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i> Inscribir
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar registro</button>
                        </div>
                    </div>
                </form>
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
    // Inicializar DataTable para la primera tabla
    new DataTable('#miTabla2', {
        lengthMenu: [
            [5, 8, 12],
            [5, 8, 12]
        ],
        columns: [
            { Id: 'Id' },
            { Curp: 'curp' },
            { Ciudadano: 'Ciudadano' },
            { Sexo: 'Sexo' },
            { Acciones: 'Acciones' }
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        }
    });

    // Inicializar DataTable para la segunda tabla
    $('.modal-ciudadano').each(function() {
        new DataTable($(this).find('.table_id'), {
            lengthMenu: [
                [5, 10, 15],
                [5, 10, 15]
            ],
            columns: [
                { Id: 'Id' },
                { Nombre: 'Nombre' },
                { Fecha_inicio: 'Fecha_inicio' },
                { Fecha_fin: 'Fecha_fin' },
                { Cargo: 'Cargo' },
                { Acciones: 'Acciones' }
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            }
        });
    });
</script>


@endsection
