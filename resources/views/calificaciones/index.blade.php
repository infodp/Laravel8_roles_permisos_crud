@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Calificaciones</h3>
  </div>
  <div class="section-body">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <!-- Dropdown de filtros -->
                            <div class="dropdown">
                                <form action="{{ route('calificacion.index') }}" method="GET">
                                    <!-- Otros campos de formulario según tus necesidades -->
                                    <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button" id="filtroDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Seleccionar filtros">
                                            <i class="fa fa-filter" aria-hidden="true"></i> Filtros
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="filtroDropdown">
                                            <button type="submit" class="dropdown-item {{ request('filtro') === 'filtro1' ? 'active' : '' }}" name="filtro" value="filtro1"  title="Aplicar filtro">Aprobado</button>
                                            <button type="submit" class="dropdown-item {{ request('filtro') === 'filtro2' ? 'active' : '' }}" name="filtro" value="filtro2"  title="Aplicar filtro">No aprovado</button>
                                            <!-- Puedes agregar más opciones según tus necesidades -->

                                            <button type="submit" class="btn btn-outline-danger btn-md" name="reset_filtro"  title="Eliminar filtros">
                                                <i class="fa fa-trash" aria-hidden="true" ></i> Borrar Filtros
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    <div>
                        <br> <br>
                    </div>
                </div>

                    <div class="table-responsive">
                        <table class="table table-striped mt-2 table_id" id="miTabla2">
                            <thead style="background-color:#6777ef; color: #fff;">
                                <th style="display: none;">ID</th>
                                <th style="color:#fff; cursor: pointer;">Nombre <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></i></th>
                                <th style="color:#fff; cursor: pointer;">Cargo inscrito  <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                <th style="color:#fff; cursor: pointer;">Estatus <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                <th style="color:#fff; cursor: pointer;">Periodo del cargo <i class="fas fa-caret-square-o-down" aria-hidden="true"></i></th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($inscripciones as $inscripcion)
                                    <tr>
                                        <td style="display: none;">{{ $inscripcion->idd }}</td>
                                        <td>{{ ucwords($inscripcion->ciudadano) }} {{' '}} {{ ucwords($inscripcion->ap) }} {{' '}} {{ ucwords($inscripcion->am) }}</td>
                                        <td>{{ ucwords($inscripcion->cargo) }}</td>
                                        <td>
                                            @if($inscripcion->apro == 1)
                                                <span class="badge badge-success">Aprobado</span>
                                            @else
                                                <span class="badge badge-danger">No aprobado</span>
                                            @endif
                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($inscripcion->fi)) }} al {{ date('d/m/Y', strtotime($inscripcion->ff)) }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-{{ $inscripcion->idd }}" title="Calificar ciudadano"><i class="fa fa-pencil" aria-hidden="true"></i> Evaluar</a>

                                            @if ($inscripcion->apro == 1)
                                                 <a class="btn btn-secondary" href="#"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Descargar constancia</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

@foreach ($inscripciones as $inscripcion)
<div class="modal fade" id="myModal-{{ $inscripcion->idd }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-{{ $inscripcion->idd }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel-{{ $inscripcion->idd }}">Detalles de la inscripción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Agrega aquí los detalles de la inscripción del ciudadano -->
                <h6 class="modal-title">Evaluar el cargo del ciudadano:</h6>
                <H5 class="modal-title" style="color: #0000ffc2;">{{ ucwords($inscripcion->ciudadano) }} {{ ucwords($inscripcion->ap) }} {{ ucwords($inscripcion->am) }}</H5>
                <form action="{{ route('calificaciones.update',$inscripcion->idd) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="aprobado">Estado:</label>
                                <select name="aprobado" id="aprobado" class="form-control">
                                    <option disabled selected>Selecciona el estado</option>
                                    <option value="1" {{ $inscripcion->apro === 1 ? 'selected' : '' }}>Aprobado</option>
                                    <option value="0"  {{ $inscripcion->apro === 0  ? 'selected' : '' }}>No Aprobado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="observacion">Observaciones:</label>
                                <textarea  name="observacion" class="form-control" rows="4">{{ $inscripcion->observacion }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
            [5, 10, 15],
            [5, 10, 15]
        ],
        columns: [
            { Id: 'Id' },
            { Ciudadano: 'Ciudadano' },
            { Estado: 'Apro' },
            { Cargo: 'Cargo' },
            { Periodo: 'fi' },
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


@endsection

