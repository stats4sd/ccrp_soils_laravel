<!-- Navigation / Header Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">{{ t("CCRP Soils Data Platform") }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'home') active @endif" href="{{ route('home') }}">{{ t("Home") }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'about') active @endif" href="{{ route('about') }}">{{ t("About") }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'qr-codes') active @endif" href="{{ route('qr-codes') }}">{{ t("QR Codes") }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'downloads') active @endif" href="{{ route('downloads') }}">{{ t("Downloads") }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ t("Change language") }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <form action="{{ route('language') }}" method="POST">

                            @csrf
                            <input type="hidden" name="lang" value="en">
                            <input type="hidden" name="redirect" value="{{ URL::full() }}">
                            <button type="submit" class="dropdown-item">English</button>
                        </form>
                        <form action="{{ route('language') }}" method="POST">
                            @csrf
                            <input type="hidden" name="lang" value="fr">
                            <input type="hidden" name="redirect" value="{{ URL::full() }}">
                            <button type="submit" class="dropdown-item">Français</button>
                        </form>
                        <form action="{{ route('language') }}" method="POST">
                            @csrf
                            <input type="hidden" name="lang" value="es">
                            <input type="hidden" name="redirect" value="{{ URL::full() }}">
                            <button type="submit" class="dropdown-item">Español</button>
                        </form>
                    </div>
                </li>
                @if(auth()->guest())
                    <li class="nav-item ml-4">
                        <a class="nav-link @if(Route::currentRouteName() === 'login') active @endif" href="{{ route('login') }}">{{ t("Login") }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Route::currentRouteName() === 'register') active @endif" href="{{ route('register') }}">{{ t("Register") }}</a>
                    </li>
                @endif
                @if(auth()->check())
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backpack') }}">{{ t("Admin Panel") }}</a>
                        </li>
                    @endif
                    <li class="nav-item ml-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button name="logout" type="submit" class="nav-link btn btn-link">{{ t("Logout") }}</button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>