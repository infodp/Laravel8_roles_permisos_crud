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
                        @can('crear-ciudadano')
                             <a class="btn btn-warning" href="{{ route('ciudadanos.create') }}" title="Crear nuevo ciudadano"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Ciudadano</a>
                        @endcan
                      <div>
                      <br>
                      </div>
                        <div class="table-responsive">
                            <table class="table table-striped mt-2 table_id" id="miTabla2">
                              <thead style="background-color:#6777ef">
                                  <th style="display: none;">ID</th>
                                  <th style="color:#fff;">Nombre</th>
                                  <th style="color:#fff;">Apellido paterno</th>
                                  <th style="color:#fff;">Apellido Materno</th>
                                  <th style="color:#fff;">Estado</th>
                                  <th style="color:#fff;">Acciones</th>
                              </thead>
                              <tbody>
                                @foreach ($ciudadanos as $ciudadano)
                                  <tr>
                                    <td style="display: none;">{{ $ciudadano->id }}</td>
                                    <td>{{ $ciudadano->nombre }}</td>
                                    <td>{{ $ciudadano->apellido_p }}</td>
                                    <td>{{ $ciudadano->apellido_m }}</td>
                                    <td>
                                        @if ($ciudadano->estado==1)
                                            <span class="badge badge-success">Activo</span>
                                        @endif
                                        @if($ciudadano->estado==0)
                                            <span class="badge badge-danger">No activo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('ciudadanos.destroy',$ciudadano->id) }}" method="POST" id="frmDatos">
                                            @can('editar-ciudadano')
                                                <a class="btn btn-info" href="{{ route('ciudadanos.edit',$ciudadano->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                                            @endcan
                                            @php
                                                $ciudadanoId = $ciudadano->id;
                                                $cargo = \App\Models\Ciudadano::with('cargos')->find($ciudadanoId);
                                                $canDelete = $cargo->cargos->isEmpty() && Gate::allows('borrar-ciudadanos');
                                            @endphp

                                            @if ($canDelete)
                                                @csrf
                                                @method('DELETE')
                                                @can('borrar-ciudadano')
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
        { Apellido_p: 'Apellido_p' },
        { Apellido_m: 'Apellido_m' },
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
                // this.submit();
            }
            })
        })

    </script>
@endsection
