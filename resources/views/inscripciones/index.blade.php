@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Inscripciones</h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">
                            @can('crear-inscripcion')
                                <a class="btn btn-warning" href="{{ route('inscripcion.create') }}" title="Inscribir nuevo ciudadano"><i class="fa fa-plus" aria-hidden="true"></i> Nueva inscripción</a>
                            @endcan
                        <div>
                            <br>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mt-2 table_id" id="miTabla2">
                              <thead style="background-color:#6777ef">
                                  <th style="display: none;">ID</th>
                                  <th style="color:#fff; cursor: pointer;">Ciudadano <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                  <th style="color:#fff; cursor: pointer;">Cargo Inscrito<i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                  <th style="color:#fff; cursor: pointer;">Grupo <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                  <th style="color:#fff; cursor: pointer;">Tiempo Restante <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                  <th style="color:#fff;" class="text-center">Acciones</th>
                              </thead>
                              <tbody>
                                @foreach ($inscripciones as $inscripcion)
                                    <tr>
                                        <td style="display: none;">{{ $inscripcion->idd }}</td>
                                        <td>{{ ucwords($inscripcion->ciudadano) }} {{' '}} {{ ucwords($inscripcion->ap) }} {{' '}} {{ ucwords($inscripcion->am) }}</td>
                                        <td>{{ ucwords($inscripcion->cargo) }}</td>
                                        <td>{{ ucwords($inscripcion->grupo) }}</td>
                                        <td>
                                            @if($inscripcion->fi < now())
                                                    {{ ucwords('Curso impartido')}}
                                            @else
                                                @php
                                                    $fechaRestante = \Carbon\Carbon::parse($inscripcion->fi)->diff(now());
                                                @endphp
                                                    {{ ucwords($fechaRestante->days . ' días') }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <!-- <form action="{{ route('inscripcion.destroy', $inscripcion->idd) }}" method="POST" id="frmDatos"> -->
                                                @csrf
                                                @method('DELETE')
                                               @php
                                                    $date=date("Y-m-d");
                                               @endphp
                                                @if($date <= $inscripcion->fi)
                                                    @can('editar-inscripcion')
                                                    <a class="btn btn-info" href="{{ route('inscripcion.edit', $inscripcion->idd) }}" title="Editar inscripción">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i> Editar
                                                    </a>
                                                    @endcan
                                                @endif
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDetalles-{{ $inscripcion->idd }}" title="Inspeccionar inscripción">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> Ver Detalles
                                                </button>

                                                @can('borrar-ciudadanos')
                                                    <button type="submit" class="btn btn-danger" onclick="fntDeleteInscripcion('{{ $inscripcion->idd }}', '{{ $inscripcion->ciudadano }}')">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Borrar
                                                    </button>
                                                @endcan

                                            <!-- </form> -->
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
    @foreach ($inscripciones as $inscripcion)
<div class="modal" id="modalDetalles-{{ $inscripcion->idd }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-{{ $inscripcion->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel-{{ $inscripcion->id }}">Detalles de la inscripción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Información de la inscripción</h4>
                <p><strong>Ciudadano:</strong> {{ ucwords($inscripcion->ciudadano) }} {{' '}} {{ ucwords($inscripcion->ap) }} {{' '}} {{ ucwords($inscripcion->am) }}</p>
                <p><strong>Fecha de inicio:</strong> {{ $inscripcion->fi }}</p>
                <p><strong>Fecha de fin:</strong> {{ $inscripcion->ff }}</p>
                <p><strong>Cargo inscrito:</strong> {{ $inscripcion->cargo }}</p>
                <p><strong>Grupo inscrito:</strong> {{ $inscripcion->grupo }}</p>
                <!-- Agrega más detalles aquí -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
        [8, 12, 15],
        [8, 12, 15]
    ],

    columns: [
        { Id: 'Id' },
        { Ciudadano: 'Ciudadano' },
        // { Ap: 'Ap' },
        // { Am: 'Am' },
        { Cargo: 'Cargo' },
        { Grupo: 'grupo' },
        { TiempoR: 'tr' },
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
        function fntDeleteInscripcion(inscripcionId, ciudadano){
            Swal.fire({
                title: '¿Deseas eliminar la inscripción del ciudadano '+ ciudadano + '?',
                text: "Ya no podrás visualizar esta inscripción en la tabla.",
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
                    url: "inscripcion/eliminar/"+inscripcionId,
                });
                window.location="http://127.0.0.1:8000/inscripcion";
            }
        })
        }

    </script>
@endsection



