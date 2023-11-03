@extends('layouts.appAgenda')

@section('content')

<div class="alert alert-danger alert-dismissible fade show text-center" role="alert" style="display: none;">
  El evento fue borrado correctamente.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Agenda</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-1">
                        <div class="card-body">
                            <div class="color-blue">
                                <div id="calendar" class="calendar"></div> 
                            </div>
                               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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