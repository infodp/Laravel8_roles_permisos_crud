<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/home">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>

    @can('ver-usuario')
    <a class="nav-link" href="/usuarios">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>
    @endcan

    @can('ver-rol')
    <a class="nav-link" href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>
    @endcan

    @can('ver-blog')
    <a class="nav-link" href="/blogs">
        <i class=" fas fa-blog"></i><span>Blogs</span>
    </a>
    @endcan

    <a class="nav-link" href="/agenda">
        <i class=" fas fa-calendar-minus-o fa-lg"></i><span>Agenda</span>
    </a>

    @can('ver-ciudadano')
    <a class="nav-link" href="/ciudadanos">
        <i class=" fas fa-user-circle fa-lg"></i><span>Ciudadanos</span>
    </a>
    @endcan

    @can('ver-cargo')
    <a class="nav-link" href="/cargos">
        <i class=" fas fa-university fa-lg"></i><span>Cargos</span>
    </a>
    @endcan

    @can('ver-inscripcion')
    <a class="nav-link" href="/inscripcion">
        <i class="fas fa-address-book"></i><span>Inscripciones</span>
    </a>
    @endcan


    <a class="nav-link" href="/calificacion">
        <i class="fas fa-graduation-cap"></i><span>Aprobaciones</span>
    </a>
</li>
