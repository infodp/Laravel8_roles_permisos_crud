@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Crear inscripcion</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Aquí comienza el contenido de tu vista -->
                        <div class="table-responsive">
                            <table class="table table-striped mt-2 table_id" id="miTabla2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Apellido paterno</th>
                                    <th style="color:#fff;">Apellido Materno</th>
                                    <th style="color:#fff;">Acción</th>
                                </thead>
                                <tbody>
                                    @foreach ($ciudadanos as $ciudadano)
                                        <tr>
                                            <td style="display: none;">{{ $ciudadano->id }}</td>
                                            <td>{{ $ciudadano->nombre }}</td>
                                            <td>{{ $ciudadano->apellido_p }}</td>
                                            <td>{{ $ciudadano->apellido_m }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-{{ $ciudadano->id }}" title='Inscribir a un cargo'>Inscribir</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Centramos la paginación a la derecha -->
                        </div>
                        <br>
                        <div class="col-md-12 text-right">
                            <a href="{{ route('inscripcion.index') }}" class="btn btn-warning" title="Cancelar inscripción">Cancelar</a><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal para mostrar detalles de la inscripción -->
@foreach ($ciudadanos as $ciudadano)
    <div class="modal fade" id="myModal-{{ $ciudadano->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-{{ $ciudadano->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel-{{ $ciudadano->id }}">Detalles de la inscripción</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Agrega aquí los detalles de la inscripción del ciudadano -->
                    <h4 class="modal-title">Selecciona el cargo al que vas a inscribir al ciudadano:</h4>
                    <p class="modal-title">{{ $ciudadano->nombre }} {{ $ciudadano->apellido_p }} {{ $ciudadano->apellido_m }}</p>
                    <form action="{{ route('store', ['ciudadano' => $ciudadano->id]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cargo_id">Cargo: </label><span class="required text-danger">*</span>
                                    <select name="cargo_id" class="form-control custom-select" required>
                                        <option disabled selected value="">Selecciona cargo</option>
                                        @foreach(\App\Models\Cargo::where('estado', 1)->get() as $cargo)
                                            <option value="{{$cargo->id}}">{{ $cargo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha_inscripcion">Fecha de inscripcion:<span class="required text-danger">*</span></label>
                                    <input type="date" name="fecha_inscripcion" class="form-control" required>
                                </div>
                            </div>
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
            { Apellido_p: 'Apellido_p' },
            { Apellido_m: 'Apellido_m' },
            { Acciones: 'Acciones' }
        ],

        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        }
    });
</script>
@endsection
