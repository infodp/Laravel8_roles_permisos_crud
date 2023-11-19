@foreach (auth()->user()->unreadNotifications as $notificacion)

<div class="modal fade" id="myModal-{{$notificacion->data['eventoID']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-{{ $notificacion->data['eventoID'] }}" aria-hidden="true">
<div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel-{{ $notificacion->data['eventoID'] }}">Detalles de la notificación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Agrega aquí los detalles de la inscripción del ciudadano -->
                    <label for="nombre"><b>Nombre del evento: </b>{{ $notificacion->data['nombre'] }}</label>
                    <br>
                    <label for="descripcion"><b>Descripción del evento: </b>{{ $notificacion->data['descripcion'] }}</label>
                    <br>
                    @php 
                        $fechaInicio = $notificacion->data['fechaInicio'];
                        $fechaFin = $notificacion->data['fechaFin'];
                        
                    @endphp
                    @if ($fechaInicio == $fechaFin)
                    <label for="descripcion"><b>Fecha del evento: </b>{{ $notificacion->data['fechaInicio'] }}</label>
                    <br>
                    @else
                    <label for="descripcion"><b>Fecha inicial del evento: </b>{{ $notificacion->data['fechaInicio'] }}</label>
                    <br>
                    <label for="descripcion"><b>Fecha final del evento: </b>{{ $notificacion->data['fechaFin'] }}</label>
                    <br>
                    @endif
                    @php
                        $hora = $notificacion->data['hora'];
                        $horaa = substr($hora, 0, 2);
                        $horaa = (int)$horaa;
                        $minuto = substr($hora, 3, 2);
                        $minuto = (int)$minuto;
                        $segundo = substr($hora, 6, 2);
                        $segundo = (int)$segundo;
                    @endphp
                    @if ($horaa > 12)
                    @php
                        $horaa = $horaa - 12;
                    @endphp
                        <!-- if de hora menor a 10 de la noche -->
                        @if ($horaa < 10)
                        @if ($minuto < 10)
                            @if ($segundo <  10)
                                <label for="descripcion"><b>Hora del evento: </b>0{{$horaa}}:0{{$minuto}}:0{{$segundo}} PM</label>
                            @else
                                <label for="descripcion"><b>Hora del evento: </b>0{{$horaa}}:0{{$minuto}}:{{$segundo}} PM</label>
                            @endif
                        @else
                            @if ($segundo <  10)
                                <label for="descripcion"><b>Hora del evento: </b>0{{$horaa}}:{{$minuto}}:0{{$segundo}} PM</label>
                            @else
                                <label for="descripcion"><b>Hora del evento: </b>0{{$horaa}}:{{$minuto}}:{{$segundo}} PM</label>
                            @endif
                        @endif
                        <!-- else if de hora mayor a 10 de la noche -->
                        @else
                        @if ($minuto < 10)
                            @if ($segundo <  10)
                                <label for="descripcion"><b>Hora del evento: </b>{{$horaa}}:0{{$minuto}}:0{{$segundo}} PM</label>
                            @else
                                <label for="descripcion"><b>Hora del evento: </b>{{$horaa}}:0{{$minuto}}:{{$segundo}} PM</label>
                            @endif
                        @else
                            @if ($segundo <  10)
                                <label for="descripcion"><b>Hora del evento: </b>{{$horaa}}:{{$minuto}}:0{{$segundo}} PM</label>
                            @else
                                <label for="descripcion"><b>Hora del evento: </b>{{$horaa}}:{{$minuto}}:{{$segundo}} PM</label>
                            @endif
                        @endif
                        <!-- se cierran las operaciones de >12 -->
                        @endif
                        
                    @elseif ($horaa == 12)
                        @if ($minuto < 10)
                            @if ($segundo <  10)
                                <label for="descripcion"><b>Hora del evento: </b>{{$horaa}}:0{{$minuto}}:0{{$segundo}} PM</label>
                            @else
                                <label for="descripcion"><b>Hora del evento: </b>{{$horaa}}:0{{$minuto}}:{{$segundo}} PM</label>
                            @endif
                            <label for="descripcion"><b>Hora del evento: </b>{{$horaa}}:0{{$minuto}}:{{$segundo}} PM</label>
                        @else
                            @if ($segundo <  10)
                                <label for="descripcion"><b>Hora del evento: </b>{{$horaa}}:{{$minuto}}:0{{$segundo}} PM</label>
                            @else
                                <label for="descripcion"><b>Hora del evento: </b>{{$horaa}}:{{$minuto}}:{{$segundo}} PM</label>
                            @endif
                        @endif
                    @else
                        @if ($minuto < 10)
                            @if ($segundo <  10)
                                <label for="descripcion"><b>Hora del evento: </b>{{$horaa}}:0{{$minuto}}:0{{$segundo}} AM</label>
                            @else
                                <label for="descripcion"><b>Hora del evento: </b>{{$horaa}}:0{{$minuto}}:{{$segundo}} AM</label>
                            @endif
                        @else
                            @if ($segundo <  10)
                                <label for="descripcion"><b>Hora del evento: </b>{{$horaa}}:{{$minuto}}:0{{$segundo}} PM</label>
                            @else
                                <label for="descripcion"><b>Hora del evento: </b>{{$horaa}}:{{$minuto}}:{{$segundo}} PM</label>
                            @endif
                        @endif
                    @endif
                    <input type="hidden" class="form-control" value="myModal-{{$notificacion->data['eventoID']}}" name="nombreModal" id="nombreModal">
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="mark-as-read btn btn-primary" data-id="{{$notificacion->id}}">Marcar como leido</button>
                </div>
            </div>
        </div>
</div>

@endforeach

@section('scripts')
    <script>
        function sendMarkRequest(id=null){
            console.log(id);
            return $.ajax("{{ route('markNotificacion') }}", {
                method: 'POST',
                data: {
                    id
                }
            });
        }

        $(function(){
            $('.mark-as-read').click(function(){
                let request = sendMarkRequest($(this).data('id'));

                request.done(() => {
                    $( "#recargar" ).load(window.location.href + " #recargar" );
                    var value = $('#nombreModal').val();
                    $('#'+value).modal('hide');
                });
            });
        })
    </script>
@endsection
