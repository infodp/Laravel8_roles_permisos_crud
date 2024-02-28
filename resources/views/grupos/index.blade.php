@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Grupos</h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Botón para crear nuevo ciudadano -->
                                @can('crear-grupo')
                                    <a class="btn btn-warning" href="{{ route('grupos.create') }}" title="Crear nuevo Grupo"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo grupo</a>
                                 @endcan

                            </div>


                            <div class="col-md-6">
                                <!-- Dropdown de filtros -->
                                <div class="dropdown">
                                    <form action="{{ route('grupos.index') }}" method="GET">
                                        <!-- Otros campos de formulario según tus necesidades -->
                                        <div class="dropdown">
                                            <button class="btn btn-info dropdown-toggle" type="button" id="filtroDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Seleccionar filtros">
                                                <i class="fa fa-filter" aria-hidden="true"></i> Filtros
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="filtroDropdown">
                                                <button type="submit" class="dropdown-item {{ request('filtro') === 'filtro1' ? 'active' : '' }}" name="filtro" value="filtro1" title="Aplicar filtro">Activo</button>
                                                <button type="submit" class="dropdown-item {{ request('filtro') === 'filtro2' ? 'active' : '' }}" name="filtro" value="filtro2" title="Aplicar filtro">No activo</button>
                                                <!-- Puedes agregar más opciones según tus necesidades -->

                                                <button type="submit" class="btn btn-outline-danger btn-md" name="reset_filtro" title="Eliminar filtros">
                                                    <i class="fa fa-trash" aria-hidden="true"></i> Borrar Filtros
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                            </div>
                            <br> <br>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mt-2 table_id" id="miTabla2">
                              <thead style="background-color:#6777ef">
                                  <th style="display: none;">ID</th>
                                  <th style="color: #fff; cursor: pointer;">Nombre <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                  <th style="color:#fff; cursor: pointer; ">Fecha Inicio <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                  <th style="color:#fff; cursor: pointer; ">Fecha Fin <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                  <th style="color:#fff; cursor: pointer;">Cargo <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                  <th style="color:#fff; cursor: pointer;">Estado <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                  <th style="color:#fff;">Acciones</th>
                              </thead>
                              <tbody>
                                @foreach ($grupos as $grupo)
                                  <tr>
                                    <td style="display: none;">{{ $grupo->id }}</td>
                                    <td>{{ ucwords( $grupo->nombre) }}</td>
                                    <td>{{ ucwords($grupo->fecha_inicio)}}</td>
                                    @php
                                        \Carbon\Carbon::setlocale(LC_TIME, 'es_ES.utf8');
                                     @endphp

                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $grupo->fecha_fin)->formatLocalized('%d de %B de %Y') }}</td>
                                    <td>{{ ucwords( $grupo->nom_cargos) }}</td>
                                    <td>
                                        {{-- <div class="form-check">
                                            <input type="checkbox" disabled {{ $cargo->estado == 1 ? 'checked' : '' }} class="form-check-input"> --}}
                                            <label class="form-check-label">
                                                @if ($grupo->estado == 1)
                                                    <span class="badge badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-danger">No activo</span>
                                                @endif
                                            </label>
                                        {{-- </div> --}}
                                    </td>

                                    <td>
                                            @csrf
                                            @method('DELETE')
                                            @can('editar-grupo')
                                                <a class="btn btn-info" href="{{ route('grupos.edit', $grupo->id) }}">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i> Editar
                                                </a>
                                            @endcan
                                            @php
                                                $grupoId = $grupo->id;
                                                $grupo = \App\Models\Grupo::with('ciudadanos')->find($grupoId);
                                                $canDelete = $grupo->ciudadanos->isEmpty() && Gate::allows('borrar-grupo');
                                            @endphp
                                            @can('editar-grupo')
                                                @if ($canDelete)
                                                    @csrf
                                                    @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="fntDeleteCargo('{{ $grupo->id }}', '{{ $grupo->nombre }}')">
                                                            <i class="fa fa-trash" aria-hidden="true"></i> Borrar
                                                        </button>

                                                @endif
                                            @endcan
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <!-- Centramos la paginacion a la derecha -->
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>


    </section>
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
        { Fecha_inicio: 'fecha_inicio' },
        { fecha_fin: 'fecha_fin' },
        { cargos: 'nom_cargos' },
        { Estado: 'Estado' },
        { Acciones: 'Acciones' }
    ],

    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    }
});
    </script>

@endsection

@section('scripts')
    @if(session('success'))
        <script>
            Swal.fire(
                "Felicidades!",
                "{{ Session::get('success') }}",
                "success"
            )
        </script>
    @endif

    <script>
        function fntDeleteCargo(grupoId, nombre){
            Swal.fire({
                title: '¿Deseas eliminar el grupo ' + nombre + '?',
                text: "Ya no podrás visualizar este grupo en la tabla.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: "Cancelar"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "grupos/eliminar/"+grupoId,
                });
                window.location="http://127.0.0.1:8000/grupos";
            }
        })
        }
    </script>
@endsection



