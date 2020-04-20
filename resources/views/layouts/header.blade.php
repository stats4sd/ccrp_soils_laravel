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
                    <a class="nav-link" href="{{url(app()->getLocale().'\home')}}">{{ t("Home") }}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url(app()->getLocale().'\about')}}">{{ t("About") }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url(app()->getLocale().'\qr-codes')}}">{{ t("QR Codes") }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url(app()->getLocale().'\downloads')}}">{{ t("Downloads") }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>