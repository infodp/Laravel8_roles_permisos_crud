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
                        @can('crear-cargo')
                            <a class="btn btn-warning" href="{{ route('cargos.create') }}" title="Crear nuevo Cargo"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Cargo</a>
                        @endcan
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

                                    <td>
                                        {{-- <div class="form-check">
                                            <input type="checkbox" disabled {{ $cargo->estado == 1 ? 'checked' : '' }} class="form-check-input"> --}}
                                            <label class="form-check-label">
                                                @if ($cargo->estado == 1)
                                                    <span class="badge badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-danger">No activo</span>
                                                @endif
                                            </label>
                                        {{-- </div> --}}
                                    </td>

                                    <td>
                                        <form action="{{ route('cargos.destroy', $cargo->id) }}" method="POST" id="frmDatos">
                                            @csrf
                                            @method('DELETE')
                                            @can('editar-cargo')
                                            <a class="btn btn-info" href="{{ route('cargos.edit', $cargo->id) }}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i> Editar
                                            </a>
                                            @endcan
                                            @php
                                                $cargoId = $cargo->id;
                                                $cargo = \App\Models\Cargo::with('ciudadanos')->find($cargoId);
                                                $canDelete = $cargo->ciudadanos->isEmpty() && Gate::allows('borrar-ciudadanos');
                                            @endphp

                                                @if ($canDelete)
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('borrar-cargo')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa fa-trash" aria-hidden="true"></i> Borrar
                                                        </button>
                                                    @endcan
                                                @endif

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
        $('#frmDatos').on('submit', function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Deseas eliminar esta inscripción?',
                text: "Ya no podrás visualizar esta inscripción en la tabla.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: "Cancelar"
            }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
})
        })

    </script>
@endsection



