<header id="header" class="header fixed-top" data-scrollto-offset="0">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
            <img src="/assets/img/logo.svg" alt="">
            <span class="color-gia ms-2" style="font-family: var(--font-secondary);">GIA Pringgading</span>
        </a>

        <nav id="navbar" class="navbar">
            <ul>

                <li><a class="{{ (request()->segment(1) == '') ? 'active' : '' }}" href="/">Home</a></li>
                <li><a class="{{ (request()->segment(1) == 'rents') ? 'active' : '' }}" href="/rents">Rents</a></li>
                <li><a class="{{ (request()->segment(1) == 'rooms') ? 'active' : '' }}" href="/rooms">Rooms</a></li>
                <li><a class="{{ (request()->segment(1) == 'divisions') ? 'active' : '' }}" href="/divisions">Divisions</a></li>
                <li><a class="{{ (request()->segment(1) == 'departments') ? 'active' : '' }}" href="/departments">Departments</a></li>
                <li><a class="" href="/schedules">Schedules</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle d-none"></i>
        </nav><!-- .navbar -->
        
        <a class="btn-getstarted" href="/login">Login</a>

    </div>
</header>