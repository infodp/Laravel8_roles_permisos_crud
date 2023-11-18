@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Ciudadanos</h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Botón para crear nuevo ciudadano -->
                                @can('crear-ciudadano')
                                    <a class="btn btn-warning" href="{{ route('ciudadanos.create') }}" title="Crear nuevo ciudadano">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Nuevo Ciudadano
                                    </a>
                                @endcan
                            </div>

                            <div class="col-md-6">
                                <!-- Dropdown de filtros -->
                                <div class="dropdown">
                                    <form action="{{ route('ciudadanos.index') }}" method="GET">
                                        <!-- Otros campos de formulario según tus necesidades -->
                                        <div class="dropdown">
                                            <button class="btn btn-info dropdown-toggle" type="button" id="filtroDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Seleccionar filtros">
                                                <i class="fa fa-filter" aria-hidden="true"></i> Filtros
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="filtroDropdown">
                                                <button type="submit" class="dropdown-item {{ request('filtro') === 'filtro1' ? 'active' : '' }}" name="filtro" value="filtro1" title="Aplicar filtro">Masculino</button>
                                                <button type="submit" class="dropdown-item {{ request('filtro') === 'filtro2' ? 'active' : '' }}" name="filtro" value="filtro2"  title="Aplicar filtro">Femenino</button>
                                                <button type="submit" class="dropdown-item {{ request('filtro') === 'filtro3' ? 'active' : '' }}" name="filtro" value="filtro3"  title="Aplicar filtro">Activo</button>
                                                <button type="submit" class="dropdown-item {{ request('filtro') === 'filtro4' ? 'active' : '' }}" name="filtro" value="filtro4"  title="Aplicar filtro">No activo</button>
                                                <!-- Puedes agregar más opciones según tus necesidades -->

                                                <button type="submit" class="btn btn-outline-danger btn-md" name="reset_filtro"  title="Eliminar filtros">
                                                    <i class="fa fa-trash" aria-hidden="true" ></i> Borrar Filtros
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                      <br><br>
                      </div>
                        <div class="table-responsive">
                            <table class="table table-striped mt-2 table_id" id="miTabla2">
                              <thead style="background-color:#6777ef">
                                  <th style="display: none; cursor: pointer;">ID</th>
                                  <th style="color:#fff; cursor: pointer;">Nombre <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                  <th style="color:#fff; cursor: pointer;">Apellido Paterno  <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                  <th style="color:#fff; cursor: pointer;">Apellido Materno  <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                  <th style="color:#fff; cursor: pointer;">Estado <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                  <th style="color:#fff;">Sexo</th>
                                  <th style="color:#fff;" class="text-center">Acciones</th>
                              </thead>
                              <tbody>
                                @foreach ($ciudadanos as $ciudadano)
                                  <tr>
                                    <td style="display: none;">{{ $ciudadano->id }}</td>
                                    <td>{{ ucwords($ciudadano->nombre) }}</td>
                                    <td>{{ ucwords($ciudadano->apellido_p) }}</td>
                                    <td>{{ ucwords($ciudadano->apellido_m) }}</td>
                                    <td>
                                        @if ($ciudadano->estado==1)
                                            <span class="badge badge-success">Activo</span>
                                        @endif
                                        @if($ciudadano->estado==0)
                                            <span class="badge badge-danger">No activo</span>
                                        @endif
                                    </td>
                                    <td>{{ ucwords($ciudadano->sexo) }}</td>
                                    <td>
                                        <!-- <form action="{{ route('ciudadanos.destroy',$ciudadano->id) }}" method="POST"> -->
                                            @can('editar-ciudadanos')
                                            <a class="btn btn-info" href="{{ route('ciudadanos.edit',$ciudadano->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                                            @endcan
                                            @php
                                                $ciudadanoId = $ciudadano->id;
                                                $cargo = \App\Models\Ciudadano::with('cargos')->find($ciudadanoId);
                                                $canDelete = $cargo->cargos->isEmpty() && Gate::allows('borrar-ciudadano');
                                            @endphp

                                            @if ($canDelete)
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="fntDeleteCiudadano({{ $ciudadano->id }})">
                                                    <i class="fa fa-trash" aria-hidden="true"></i> Borrar
                                                </button>
                                            @endif
                                        <!-- </form> -->
                                        {{-- <i class="fa-solid fa-pen-to-square"></i> --}}
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
        { Apellido_p: 'Apellido_p' },
        { Apellido_m: 'Apellido_m' },
        { Estado: 'Estado' },
        { Sexo: 'Sexo' },
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
        function fntDeleteCiudadano(ciudadanoId){
            Swal.fire({
                title: '¿Deseas eliminar este ciudadano?',
                text: "Ya no podrás visualizar este ciudadano en la tabla.",
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
                    url: "ciudadanos/eliminarId/"+ciudadanoId,
                });
                window.location="http://127.0.0.1:8000/ciudadanos";
            }
        })
        }
    </script>
@endsection
