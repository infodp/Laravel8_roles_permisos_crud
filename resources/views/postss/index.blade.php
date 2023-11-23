@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Bandeja de notificaciones</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            @if (auth()->user())
                                <div class="">
                                    <h3>No leídas</h3>
                                </div>
                                <div class='post-it-2'>
                                <ul>
                                @forelse ($postNotifications as $notification)
                                        <li>
                                            <a href="#JavaScript">
                                                <h2>{{ $notification->data['nombre'] }}</h2>
                                                <p>{{ $notification->data['descripcion'] }}</p>
                                                <p>{{ $notification->data['fechaInicio'] }}</p>
                                                <p>{{ $notification->created_at->diffForHumans() }}</p>
                                                <btn class="btn btn-primary" onclick="location.href= '{{ route('marcarunanoti', $notification->id) }}'"  title="Marcar notificación como leída">
                                                        Marcar como leída
                                                </btn>
                                            </a>
                                            
                                            
                                        </li>
                                @empty
                                <div class="alert alert-info">
                                    <div class="flex justify-between">
                                        <p>Sin notificaciones por leer</p>
                                    </div>
                                </div>

                                @endforelse
                                </ul>
                                </div>
                                @if (auth()->user()->unreadNotifications()->get()->count() > 0)
                                <div class="flex justify-center px-6 py-2 bg-blue-50">
                                            <a href="{{ route('mark_as_read') }}" class="btn btn-success" title="Marcar notificaciones como leídas">
                                                Marcar todas las notificaciones como leídas
                                            </a>

                                        </div>
                                @endif

                                <hr class="border-top border-primary">
                                <div class="">
                                    <h3>Leídas</h3>
                                </div>

                                <div class='post-it'>
                                <ul>
                                @forelse (auth()->user()->readNotifications as $notificatione)                                    
                                        <li>
                                            <a href="#JavaScript">
                                            <h2>{{ $notificatione->data['nombre'] }}</h2>
                                                <p>{{ $notificatione->data['descripcion'] }}</p>
                                                <p>{{ $notificatione->data['fechaInicio'] }}</p>
                                                <p>{{ $notificatione->created_at->diffForHumans() }}</p>
                                            </a>
                                        </li>
                                @empty
                                <div class="alert alert-secondary">
                                    <div class="flex justify-between">
                                        <p>Sin notificaciones leídas</p>
                                    </div>
                                </div>
                                @endforelse
                                </ul>
                                </div>

                                @if (auth()->user()->readNotifications()->get()->count() > 0)
                                    <div>
                                        <a href="{{ route('destroyNotifications') }}" class="btn btn-danger" title="Eliminar todas las notificaciones leídas">
                                            Eliminar todas las notificaciones leídas
                                        </a>
                                    </div>
                                @endif
                             @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



