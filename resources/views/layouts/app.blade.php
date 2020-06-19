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
    <link href="{{ asset('packages/backpack/base/css/bundle.css') }}" rel="stylesheet">
</head>

<body>

    <div class="d-flex flex-column justify-content-between wrapper">

        @include('layouts.header')

        @yield('main')

        <!-- Footer -->
        <footer class="py-3 mt-auto bg-dark footer">
            <div class="container d-flex flex-justify-between">
                <p class="m-0 text-white">© 2020 Smallholder Soil Health Assessment & Stats4SD</p>
            </div>
            <!-- /.container -->
        </footer>
    </div>

    <script>
        window._locale = '{{ app()->getLocale() }}';
        window._translations = {!! cache('translations') !!};
    </script>

    <script src={{asset("js/app.js")}}></script>
    @yield('scripts')
    @stack('scripts')
    @include('vendor.backpack.base.inc.alerts')
</body>