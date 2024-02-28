@extends('layouts.auth_app')
@section('title')
    Forgot Password
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header"><h4>Resetear Contraseña</h4></div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Correo</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" tabindex="1" value="{{ old('email') }}" autofocus required>
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Enviar enlace
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        ¿Recordó su información de inicio de sesión? <a href="{{ route('login') }}">Iniciar sesion</a>
    </div>
@endsection
