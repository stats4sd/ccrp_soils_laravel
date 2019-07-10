
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

<body>
  <section class="card">
    <div class="row">
      <div class="card-body">
        <div class="container mt-5">
        <section class="col-12 mb-5" id="navigationbar">

          <h3><strong><a style="color: black;" href="https://soils.stats4sd.org/en/">{{ t("CCRP Soils Data Platform") }}</a></strong></h3>

            <div class="dropdown">
              <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">{{ t("Home") }}<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="home">{{ t("Introduction") }}</a></li>
                  <li><a href="about">{{ t("About") }}</a></li>
                </ul>
            </div>

            <div class="dropdown">
              <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">{{ t("Start Sampling") }}<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="start-sampling">{{ t("Start Sampling") }}</a></li>
                  <li><a href="data-management">{{ t("Data Management") }}</a></li>
                </ul>
            </div>

            <div class="dropdown">
              <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">{{ t("Tools") }}<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="qr-codes">{{ t("QR Codes") }}</a></li>
                  <li><a href="downloads">{{ t("Downloads") }}</a></li>
                </ul>
            </div>

            <div class="dropdown">
              <a href="login" style="color:black;">{{ t("Log In") }}<b class="caret"></b></a>
            </div>

            <div class="dropdown">
              <a href="#" class="btn dropdown-toggle" data-toggle="dropdown"><img src="https://img.icons8.com/color/26/000000/great-britain.png"> English (Inglés)</a>
                <ul class="dropdown-menu">
                  <li><a href="#"><img src="https://img.icons8.com/color/26/000000/bolivia.png"> Español (Spanish)</a></li>
                </ul>
            </div>

            <div class="btn dropdown">
              <a href="projects" style="color:black;">{{ t("All Projects") }}<b class="caret"></b></a>
            </div>

            <div class="btn dropdown">
              <a href="create-project" style="color:black;">{{ t("Create a Project") }}<b class="caret"></b></a>
            </div>

            <div class="btn dropdown">
              <a href="{{url('admin')}}" style="color:black;">{{ t("Admin") }}<b class="caret"></b></a>
            </div>
      </section>
        @yield('content')

      </div>
    </div>
</body>


 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="row">
  <div class="container">
     <div class="card card-login mx-5 mt-5 sticky-top">
       <div class="card-header"><strong>{{ t("MY ACCOUNT") }}</strong></div>
       <div class="card-body">
         <form method="post" action="login.php">
           <div class="form-group">
             <label for="exampleInputEmail1">{{ t("Username") }}</label>
             <input class="form-control"  type="text" name="username">
           </div>
           <div class="form-group">
             <label for="exampleInputPassword1">{{ t("Password") }}</label>
             <input class="form-control"  type="password" name="password">
           </div>
           <div class="form-group">
             <div class="form-check">
               <label class="form-check-label">
                 <input class="form-check-input" type="checkbox"> {{ t("Remember Password") }}</label>
             </div>
           </div>
           <button type="submit" class="btn btn-dark btn-block" name="login_user">{{ t("Login") }}</button>
         </form>
         <div class="text-center">
           <a class="d-block small mt-3" href="/en/register">{{ t("Register an Account") }}</a>
        <a class="d-block small" href="forgot-password.php">{{ t("Forgot Password?") }}</a>
         </div>
       </div>
     </div>
   </div>
    @yield('login')
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

        $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

    });
</script>
@yield('script')