@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Cargos</h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <a class="btn btn-warning" href="{{ route('cargos.create') }}" title="Crear nuevo Cargo"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Cargo</a>
                        <div>
                            <br>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mt-2 table_id" id="miTabla2">
                              <thead style="background-color:#6777ef">
                                  <th style="display: none;">ID</th>
                                  <th style="color:#fff;">Nombre <i class="fas fa-sort-desc fa-2x" aria-hidden="true"></i></th>
                                  <th style="color:#fff;">Fecha de inicio</th>
                                  <th style="color:#fff;">Fecha fin</th>
                                  <th style="color:#fff;">Estado</th>
                                  <th style="color:#fff;">Acciones</th>
                              </thead>
                              <tbody>
                                @foreach ($cargos as $cargo)
                                  <tr>
                                    <td style="display: none;">{{ $cargo->id }}</td>
                                    <td>{{ $cargo->nombre }}</td>
                                    <td>{{ $cargo->fecha_inicio}}</td>
                                    @php
                                        \Carbon\Carbon::setlocale(LC_TIME, 'es_ES.utf8');
                                     @endphp

                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $cargo->fecha_fin)->formatLocalized('%d de %B de %Y') }}</td>

                                    {{-- <td>
                                        @if ($cargo->estado==1)
                                            {{'Activo'}}
                                        @endif
                                        @if($cargo->estado==0)
                                            {{'Inhactivo'}}
                                        @endif
                                    </td> --}}
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" disabled {{ $cargo->estado == 1 ? 'checked' : '' }} class="form-check-input">
                                            <label class="form-check-label">
                                                @if ($cargo->estado == 1)
                                                    {{ 'Activo' }}
                                                @elseif ($cargo->estado == 0)
                                                    {{ 'Inactivo' }}
                                                @endif
                                            </label>
                                        </div>
                                    </td>

                                    <td>
                                        <form action="{{ route('cargos.destroy',$cargo->id) }}" method="POST">
                                            @can('editar-ciudadanos')
                                            <a class="btn btn-info" href="{{ route('cargos.edit',$cargo->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                                            @endcan
                                            {{-- @php
                                                $cargoId = $cargo->id; // Reemplaza con el ID del cargo que deseas verificar
                                                $cargos = \App\Models\Cargo::where('id', $cargoId)
                                                    ->whereDoesntHave('ciudadanos')->get();
                                            @endphp
                                            @if (!$cargos->isEmpty())
                                                @csrf
                                                @method('DELETE')
                                                @can('borrar-ciudadanos')
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Borrar</button>
                                                @endcan
                                            @endif --}}
                                        </form>
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
        { Fecha_inicio: 'Fecha_inicio' },
        { Fecha_fin: 'Fecha_fin' },
        { Estado: 'Estado' },
        { Acciones: 'Acciones' }
    ],

    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    }
});
    </script>

@endsection



