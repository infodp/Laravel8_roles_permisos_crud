{{-- @extends('layouts.app')

@section('content')
    <!-- Otras secciones de contenido si las hay -->

    <a class="btn btn-info" href="{{ route('ciudadanos.details', $ciudadano->id) }}" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-pencil" aria-hidden="true"></i> Ver Detalles
    </a> --}}

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Contenido del modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Detalles de {{ $ciudadano->nombre }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Agrega aquí la información que deseas mostrar para este ciudadano -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <!-- Puedes agregar más botones o acciones aquí si es necesario -->
                </div>
            </div>
        </div>
    </div>

    <!-- Otras secciones de contenido si las hay -->
{{-- @endsection --}}
