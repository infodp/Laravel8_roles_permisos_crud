<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <img class="navbar-brand-full app-header-logo" src="{{ asset('img/logo2.png') }}" width="150" alt="Infyom Logo">
        <a href="{{ url('/') }}"></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}" class="small-sidebar-text">
            <img class="navbar-brand-full img-fluid" src="{{ asset('img/logo2.png') }}" width="150px" alt=""/>
        </a>
    </div>

    <ul class="sidebar-menu">
        @include('layouts.menu')
    </ul>
</aside>
