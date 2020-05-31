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
    @livewireStyles
</head>

<body>

    <div class="d-flex flex-column justify-content-between wrapper">

        @include('layouts.header')

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
    @stack('scripts')
    @include('layouts.alerts')
    @livewireScripts

</body>