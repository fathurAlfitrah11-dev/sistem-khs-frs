<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">

    <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown"
            data-toggle="dropdown">

            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                {{ Auth()->user()->name }}
            </span>

            <img class="img-profile rounded-circle"
                src="{{ asset('sbadmin/img/undraw_profile.svg') }}">
        </a>

        <div class="dropdown-menu dropdown-menu-right shadow">
            <a class="dropdown-item" href="/logout">
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>