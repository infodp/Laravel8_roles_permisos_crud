<form class="form-inline mr-auto" action="#">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>

{{-- Espacio de las notificaciones en la campanita --}}
<li class="dropdown">
    <ul class="navbar-nav navbar-right">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="notificationsDropdown" aria-expanded="false">
                 @if (count(auth()->user()->unreadNotifications))
                    <span class="badge badge-sm badge-danger">
                         {{ count(auth()->user()->unreadNotifications) }}
                    </span>
                 @endif 
                <i class="fa fa-bell-o" aria-hidden="true" style="color: white;"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <span class="dropdown-header">Notificacion sin leer</span>
                <!-- Contenido de notificaciones aquí -->
                @forelse (auth()->user()->unreadNotifications as $notificacion)
                
                    <a class="dropdown-item has-icon" data-toggle="modal" href="#" data-target="#myModal-{{$notificacion->data['eventoID']}}">
                        <i class="fas fa-envelope mr-2"></i> {{$notificacion->data['nombre']}}
                        <span class="ml-3 pull-right text-muted text-sm">{{$notificacion->created_at->diffForHumans()}}</span>
                    </a>
                    
                    @empty
                    <span class="ml-3 text-muted text-sm">Sin notificaciones por leer</span>
                @endforelse
                <div class="dropdown-divider"> </div>
                <span class="dropdown-header">Notificacion leidas</span>
                @forelse (auth()->user()->readNotifications as $notificacion)
                    <a class="dropdown-item has-icon" href="#" >
                        <i class="fas fa-envelope mr-2"></i> {{$notificacion->data['nombre']}}
                    </a>
                    @empty
                    <span class="ml-3 text-muted text-sm">Sin notificaciones leídas</span>
                @endforelse
                <div class="dropdown-divider"> </div>
                <a class="dropdown-footer dropdown-item" href="#" >Leer todas las notificaciones</a>
            </ul>
            
        </li>
    </ul>
</li>


    @if(\Illuminate\Support\Facades\Auth::user())
        <li class="dropdown">
            <a href="#" data-toggle="dropdown"
               class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('img/logo.png') }}"
                     class="rounded-circle mr-1 thumbnail-rounded user-thumbnail ">
                <div class="d-sm-none d-lg-inline-block">
                    ¡Hola! {{Str::words(Auth::user()->name)}}</div>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">
                    Bienvenido, {{\Illuminate\Support\Facades\Auth::user()->name}}</div>
                <a class="dropdown-item has-icon edit-profile" href="#" data-id="{{ \Auth::id() }}">
                    <i class="fa fa-user"></i>Editar Perfil de Usuario</a>
                <a class="dropdown-item has-icon" data-toggle="modal" data-target="#changePasswordModal" href="#" data-id="{{ \Auth::id() }}"><i
                            class="fa fa-lock"> </i>Cambiar contraseña</a>
                <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger"
                   onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
    @else
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                {{--                <img alt="image" src="#" class="rounded-circle mr-1">--}}
                <div class="d-sm-none d-lg-inline-block">{{ __('messages.common.hello') }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">{{ __('messages.common.login') }}
                    / {{ __('messages.common.register') }}</div>
                <a href="{{ route('login') }}" class="dropdown-item has-icon">
                    <i class="fas fa-sign-in-alt"></i> {{ __('messages.common.login') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('register') }}" class="dropdown-item has-icon">
                    <i class="fas fa-user-plus"></i> {{ __('messages.common.register') }}
                </a>
            </div>
        </li>
    @endif
</ul>

