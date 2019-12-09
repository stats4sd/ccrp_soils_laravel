
<!doctype html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>CCRP Soils Data Platform</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="card-page">
    <section class="card-background" id="card-body">
        <div class="row">
            <div class="card-body">
                <div class="container mt-5">
                    <section class="col-12 mb-5" id="navigationbar">

                        <h3><strong><a style="color: black;" href="https://soils.stats4sd.org/en/">{{ t("CCRP Soils Data Platform") }}</a></strong></h3>

                        <div class="dropdown">
                            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">{{ t("Home") }}<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href={{url(app()->getLocale().'\home')}}>{{ t("Introduction") }}</a></li>
                                <li><a href={{url(app()->getLocale().'\about')}}>{{ t("About") }}</a></li>
                            </ul>
                        </div>

                        <div class="dropdown">
                            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">{{ t("Start Sampling") }}<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href={{url(app()->getLocale().'\start-sampling')}}>{{ t("Start Sampling") }}</a></li>
                                <li><a href={{url(app()->getLocale().'\data-management')}}>{{ t("Data Management") }}</a></li>
                            </ul>
                        </div>

                        <div class="dropdown">
                            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">{{ t("Tools") }}<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href={{url(app()->getLocale().'\qr-codes')}}>{{ t("QR Codes") }}</a></li>
                                <li><a href={{url(app()->getLocale().'\downloads')}}>{{ t("Downloads") }}</a></li>
                            </ul>
                        </div>

                        <div class="dropdown">
                            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown"><img src="{{ asset("images/locale/" . app()->getLocale() . "-flag.png") }}">{{ app()->getLocale() }}</a>
                            <ul class="dropdown-menu">
                                @foreach(config('app.available_locales') as $locale)
                                    <li><a id="{{ $locale }}"><img src="{{ asset("images/locale/{$locale}-flag.png") }}"> {{ $locale }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="btn dropdown">
                            <a href="{{url(app()->getLocale().'\projects')}}"  style="color:black;">{{ t("All Projects") }}<b class="caret"></b></a>
                        </div>

                        <div class="btn dropdown">
                            <a href="{{url(app()->getLocale().'\create-project')}} " style="color:black;">{{ t("Create a Project") }}<b class="caret"></b></a>
                        </div>
                        <div class="btn dropdown">
                            <a href="{{url('admin')}}" id="admin" style="color:black;">{{ t("Admin") }}<b class="caret"></b></a>
                        </div>

                    </section>
                    <div class="row">
                        <div class="col-sm-8">
                            @yield('content')
                        </div>
                        <div class="col-sm-4">
                            @if(!auth()->check())
                            <div id="login" class="row">
                                @include('layouts.login')
                            </div>
                            @endif

                            @if(auth()->check())
                            <div id="logout" class="row" >
                                @include('layouts.account')
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

        <script src={{asset("js/app.js")}}></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $.ajaxSetup({
                    headers:
                    { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
            });

            jQuery(document).ready(function(){
                jQuery('#info_login').hide();
                jQuery("#admin").click(function(event){
                    event.preventDefault();

                    $.ajax({
                        url : '/en/home/admin',
                        type : 'POST',
                        processData: false,
                        contentType: false,
                        success : function(result){
                            console.log(result);
                            if(result.admin){
                                window.location.replace("/admin");
                            }else{
                                window.location.replace("/en/home");
                                jQuery('#info_login').show();
                            }
                        }
                    });
                });
            });

            
//changes en to sp
jQuery(document).ready(function(){
    jQuery("#es").click(function(event){
        event.preventDefault();

        $.ajax({
            url : '/en/home/login',
            type : 'POST',
            processData: false,
            contentType: false,
            success : function(result){

                var url      = window.location.href;
                var origin   = window.location.origin;
                var current_url = url.substring(origin.length + 4, url.length);

                window.location.replace("/es/".concat(current_url));

            }
        });
    });
});

//changes es to en
jQuery(document).ready(function(){
    jQuery("#en").click(function(event){
        event.preventDefault();

        $.ajax({
            url : '/en/home/login',
            type : 'POST',
            processData: false,
            contentType: false,
            success : function(result){

                var url      = window.location.href;
                var origin   = window.location.origin;
                var current_url = url.substring(origin.length + 4, url.length);

                window.location.replace("/en/".concat(current_url));

            }
        });
    });
});


</script>
@include('layouts/alerts')

@yield('script')