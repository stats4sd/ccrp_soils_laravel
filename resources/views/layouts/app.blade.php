<!doctype html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CCRP Soils Data Platform</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

    <div class="d-flex flex-column justify-content-between wrapper">
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

        @yield('main')

            <!-- Footer -->
        <footer class="py-3 mt-auto bg-dark footer">
            <div class="container">
                <p class="m-0 text-center text-white">Something might go here in the footer... who knows?</p>
            </div>
            <!-- /.container -->
        </footer>
    </div>


<script src={{asset("js/app.js")}}></script>
@yield('scripts')

@include('layouts/alerts')


</body>