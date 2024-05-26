<nav class="navbar navbar-expand-md navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand h1" href="{{ route('home') }}">
            <img src="image/logo.png" width="30" height="30" class="d-inline-block align-top img-circle" alt="Logo">
            Hotel Sigma Skibidi
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <x-nav-item-tamu label="Home" :link="route('home')" />
                <x-nav-item-tamu label="Kamar" :link="route('kamar')" />
                @auth('web')
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        {{ Auth::guard('web')->user()->nama }} <i class="fas fa-caret-down"> </i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                    
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                        </a>

                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>