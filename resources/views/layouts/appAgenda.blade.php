<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <!-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/> -->
    <!-- Ionicons -->
    <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Nuevo -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Script de sweet alert 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- FullCalendar css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fullcalendar.min.css') }}">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">

@yield('page_css')
<!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css')}}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css')}}">

    <style>
      .toolbar {
    float: left;
    }
    .searching{
        float: right;
    }
    .card-1{
        background-color: #D6EAF8;
    }
    </style>
    @yield('page_css')


    @yield('css')
</head>
<body>

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            @include('layouts.header')

        </nav>
        <div class="main-sidebar main-sidebar-postion">
            @include('layouts.sidebar')
        </div>
        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>


        <div class="modal fade" id="exampleModal"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Registrar Nuevo Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <form name="formEvento" id="formEvento" action="{{ route('agenda.store') }}" method="post" class="datepickers">
    {{ csrf_field() }}
		<div class="form-group">
			<label for="evento" class="col-sm-12 control-label">Nombre del Evento</label>
			<div class="col-sm-10">
				<input type="text" class="form-control"  name="nombre" id="nombre" placeholder="Nombre del Evento" required/>
			</div>
		</div>
        <div class="form-group">
			    <label for="eventoDescripcion" class="col-sm-12 control-label">Descripción del Evento</label>
			  <div class="col-sm-10">
				  <input type="text" rows="4" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción del Evento" required/>
			  </div>
		  </div>
    <div class="form-group">
      <label for="fecha_inicio" class="col-sm-12 control-label">Fecha Inicio</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha Inicio"required>
      </div>
    </div>
    <div class="form-group">
      <label for="fecha_fin" class="col-sm-12 control-label">Fecha Final</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="fecha_fin" id="fecha_fin" placeholder="Fecha Final" disabled>
        <input type="hidden" class="form-control" value=" " name="fecha_final" id="fecha_final" placeholder="Fecha Final">
      </div>
    </div>
    <div class="form-group">
      <label for="fecha_inicio" class="col-sm-12 control-label">Hora Inicio</label>
      <div class="col-sm-10" id="id_0">
        <input type="text" class="form-control" name="hora_inicio" id="hora_inicio" placeholder="Hora Inicio"/ required>
      </div>
    </div>

  <!-- <div class="col-md-12" id="grupoRadio">

  <input type="radio" name="color_evento" id="orange" value="#FF5722" checked>
  <label for="orange" class="circu" style="background-color: #FF5722;"> </label>

  <input type="radio" name="color_evento" id="amber" value="#FFC107">
  <label for="amber" class="circu" style="background-color: #FFC107;"> </label>

  <input type="radio" name="color_evento" id="lime" value="#8BC34A">
  <label for="lime" class="circu" style="background-color: #8BC34A;"> </label>

  <input type="radio" name="color_evento" id="teal" value="#009688">
  <label for="teal" class="circu" style="background-color: #009688;"> </label>

  <input type="radio" name="color_evento" id="blue" value="#2196F3">
  <label for="blue" class="circu" style="background-color: #2196F3;"> </label>

  <input type="radio" name="color_evento" id="indigo" value="#9c27b0">
  <label for="indigo" class="circu" style="background-color: #9c27b0;"> </label>

</div> -->

	   <div class="modal-footer">
      	<button type="submit" class="btn btn-success">Guardar Evento</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
    	</div>
	</form>

    </div>
  </div>
</div>


<div class="modal" id="modalUpdateEvento"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar mi Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <form name="formEventoUpdate" id="formEventoUpdate" action="{{ route('agenda.actualizar') }}" method="post" class="datepickers">
  @csrf
    <input type="hidden" class="form-control" name="idEvento" id="idEvento">
    <div class="form-group">
      <label for="evento" class="col-sm-12 control-label">Nombre del Evento</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="evento" id="evento" placeholder="Nombre del Evento" required/>
      </div>
    </div>
    <div class="form-group">
			    <label for="eventoDescripcion" class="col-sm-12 control-label">Descripción del Evento</label>
			  <div class="col-sm-10">
				  <input type="text" rows="4" class="form-control" name="descripcionn" id="descripcionn" placeholder="Descripción del Evento" required/>
			  </div>
	</div>
    <div class="form-group">
      <label for="fecha_inicio" class="col-sm-12 control-label">Fecha Inicio</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="fecha_inicioo" id="fecha_inicioo" placeholder="Fecha Inicio" required>
      </div>
    </div>
    <div class="form-group">
      <label for="fecha_fin" class="col-sm-12 control-label">Fecha Final</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="fecha_finn" id="fecha_finn" placeholder="Fecha Final" disabled>
        <input type="hidden" class="form-control" value="" name="fecha_finall" id="fecha_finall">
        <input type="hidden" class="form-control" value=" " name="validar" id="validar">
      </div>
    </div>
    <div class="form-group">
      <label for="fecha_inicio" class="col-sm-12 control-label">Hora Inicio</label>
      <div class="col-sm-10" id="id_1">
        <input type="text" class="form-control" name="hora_inicioo" id="hora_inicioo" placeholder="Hora Inicio" required/>
      </div>
    </div>

     <div class="modal-footer">
        <button type="submit" class="btn btn-success">Guardar Evento</button>
        <button type="button" class="btn btn-secondary" id="salir" data-dismiss="modal">Cerrar</button>
      </div>
  </form>

    </div>
  </div>
</div>
        <footer class="main-footer">
            @include('layouts.footer')
        </footer>
    </div>
</div>

@include('profile.change_password')
@include('profile.edit_profile')
@include('layouts.modalNotificacionInfo')

</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src ="{{ asset('js/jquery-3.0.0.min.js') }}"> </script>

<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('web/js/stisla.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<script src="{{ mix('assets/js/profile.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script src="{{ asset('assets/js/custom/buscador.js') }}"></script>

<!-- Nuevo -->
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/fullcalendar.min.js') }}"></script>

@yield('page_js')
@yield('scripts')
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
              window.alert('Exito!');
                $( "#recargar" ).load(window.location.href + " #recargar" );
                var value = $('#nombreModal').val();
                $('#'+value).modal('hide');
            });
        });
    })
</script>
<script>
    let loggedInUser =@json(\Illuminate\Support\Facades\Auth::user());
    let loginUrl = '{{ route('login') }}';
    // Loading button plugin (removed from BS4)
    (function ($) {
        $.fn.button = function (action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };
    }(jQuery));
</script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<!-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->

<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fullcalendar.min.js') }}"></script>
<script src="{{ asset('locales/es.js') }}"></script>

<!-- Js de sweet alert 2 -->
<!-- <script src="{{ asset('js/botones.js') }}"></script> -->

<script type="text/javascript">
    $(document).ready(function() {
    $("#calendar").fullCalendar({
        header: {
        left: "prev,next today",
        center: "title",
        right: "month,agendaWeek,agendaDay"
        },


    locale: 'es',

    defaultView: "month",
    navLinks: true,
    editable: true,
    eventLimit: true,
    selectable: true,
    selectHelper: false,
    events: [
      <?php
       foreach ($eventos as $evento) { ?>
        {

          _id: '<?php echo $evento['id']; ?>',
          title: '<?php echo $evento['nombre']; ?>',
          descripcion: '<?php echo $evento['descripcion']; ?>',
          start: '<?php echo $evento['fecha_inicio']; ?>',
          end:   '<?php echo $evento['fecha_fin']; ?>',
          our:   '<?php echo $evento['hora']; ?>',
          color: '#009688'
        },
          <?php } ?>
    ],

// //Nuevo Evento

  select: function(start, end){
    var op = document.getElementById("validar").value;
    console.log('El valor de op es: ' + op);
      $("#exampleModal").modal();
      // $("input[name=fecha_inicio]").val(start.format('DD-MM-YYYY'));
      $("input[name=fecha_inicio]").val(start.format('YYYY-MM-DD'));

      // var valorFechaFin = end.format("DD-MM-YYYY");
      var valorFechaFin = end.format("YYYY-MM-DD");
      var F_final = moment(valorFechaFin, "YYYY-MM-DD").subtract(1, 'days').format('YYYY-MM-DD'); //Le resto 1 dia
      $("input[name=fecha_fin]").val(F_final);
      $("input[name=fecha_final]").val(F_final);
    },






//Eliminar Evento

eventRender: function(event, element) {

    element
      .find(".fc-content")
      .prepend("<span id='btnCerrar'; class='closeon material-icons'>&#xe5cd;</span>");

    element.find(".closeon").on("click", function() {
      var aniId = event._id;
      $('input[name=validar').val('no');
    Swal.fire({
  title: '¿Deseas eliminar este evento?',
  text: "Ya no podrás visualizar este evento en el calendario",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, eliminar',
  cancelButtonText: "Cancelar"
}).then((result) => {
  if (result.isConfirmed) {
    $("#calendar").fullCalendar("removeEvents", event._id);

     $.ajax({
            type: "post",
            url: "agenda/eliminar/"+aniId,
        });
      Swal.fire(
      'Eliminado!',
      'Tu evento se ha eliminado de manera correcta.',
      'success'
    )
  }
})

});
},


//Moviendo Evento Drag - Drop
eventDrop: function (event, delta) {
  var idEvento = event._id;
  $('#modalUpdateEvento').modal('hide');
  if(event.end == null){
    var start = (event.start.format('YYYY-MM-DD'));
    var end = (event.start.format("YYYY-MM-DD"));
    } else{
      var start = (event.start.format('YYYY-MM-DD'));
      var end = (event.end.format("YYYY-MM-DD"));
    }


    $.ajax({
        url: "agenda/drag_drop/",
        data: 'start=' + start + '&end=' + end + '&idEvento=' + idEvento,
        type: "POST",
        success: function (response) {
         // $("#respuesta").html(response);
        }
    });
},

//Modificar Evento del Calendario
eventClick:function(event){
    var idEvento = event._id;

    $('input[name=idEvento').val(idEvento);
    $('input[name=evento').val(event.title);
    $('input[name=descripcionn').val(event.descripcion);
    $('input[name=fecha_inicioo').val(event.start.format('YYYY-MM-DD'));

    console.log(event.start);
    if(event.end == null){
      $('input[name=fecha_finn').val(event.start.format('YYYY-MM-DD'));
      $('input[name=fecha_finall').val(event.start.format('YYYY-MM-DD'));
    } else{
      var valorFechaFin = event.end.format("YYYY-MM-DD");
      var F_final = moment(valorFechaFin, "YYYY-MM-DD").subtract(1, 'days').format('YYYY-MM-DD'); // Le restamos un día
      $('input[name=fecha_finn').val(F_final);
      $('input[name=fecha_finall').val(F_final);
    }
    var hora = event.our;
    var horas = hora.split(':');
    var horaIn = horas[0];
    var minuto = horas[1];
    var segundos = horas[2];
    console.log(horaIn);
    if(horaIn > 12){
      horaIn = horaIn - 12;
      console.log(horaIn);
      $('input[name=hora_inicioo').val('0'+horaIn+':'+minuto+':'+segundos+' PM');
    } else if(horaIn < 12){
      $('input[name=hora_inicioo').val(event.our+' AM')
    } else if(horaIn == 12){
      $('input[name=hora_inicioo').val(event.our+' PM');
    }
    var op = document.getElementById("validar").value;
    console.log('El valor de op es: ' + op);
    if(op == ' '){
      $("#modalUpdateEvento").modal();
    } else{
      $('input[name=validar').val(' ');
    }

  },


  });

});

</script>
</html>
