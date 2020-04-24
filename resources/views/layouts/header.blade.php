<!-- Navigation / Header Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">{{ t("CCRP Soils Data Platform") }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">{{ t("Home") }}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">{{ t("About") }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('qr-codes') }}">{{ t("QR Codes") }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('downloads') }}">{{ t("Downloads") }}</a>
                </li>
                @if(auth()->guest())
                    <li class="nav-item ml-4">
                        <a class="nav-link" href="{{ route('login') }}">{{ t("Login") }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ t("Register") }}</a>
                    </li>
                @endif
                @if(auth()->check())
                    <li class="nav-item ml-4">
                        <a href="{{ route('logout') }}" class="nav-link">{{ t("Logout") }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>