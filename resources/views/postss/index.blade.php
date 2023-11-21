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
                                @forelse ($postNotifications as $notification)
                                    <div class="alert alert-info">
                                        <h5 class="">
                                            {{ $notification->data['nombre'] }}
                                        </h5>
                                        <p class="text-right" style="color: #e83030;">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </p>

                                        <div class="flex justify-between">
                                            <p class="font-normal text-gray-700">{{ $notification->data['descripcion'] }}</p>
                                            <a href="{{ route('marcarunanoti', $notification->id) }}" class="btn btn-primary" title="Marcar notificación como leída">
                                                Marcar como leída
                                            </a>
                                        </div>
                                    </div>

                                    @if ($loop->last)
                                        <div class="flex justify-center px-6 py-2 bg-blue-50">
                                            <a href="{{ route('mark_as_read') }}" class="btn btn-danger" title="Marcar notificaciones como leídas">
                                                Marcar todas las notificaciones como leídas
                                            </a>

                                        </div>
                                    @endif
                                @empty
                                <div class="alert alert-info">

                                    <div class="flex justify-between">
                                        <p>Sin notificaciones por leer</p>
                                    </div>
                                </div>
                                @endforelse

                                <hr class="border-top border-primary">
                                <div class="">
                                    <h3>Leídas</h3>
                                </div>

                                @forelse (auth()->user()->readNotifications as $notificatione)
                                    <div class="alert alert-secondary">
                                        <h5 class="">
                                            {{ $notificatione->data['nombre'] }}
                                        </h5>
                                        <p class="text-right" style="color: #e83030;">
                                            {{ $notificatione->created_at->diffForHumans() }}
                                        </p>
                                        <div class="flex justify-between">
                                            <p class="font-normal text-gray-700">{{ $notificatione->data['descripcion'] }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p>Sin notificaciones leídas</p>
                                @endforelse

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



