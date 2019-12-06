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

<div class="row">
  <div class="container">
     <div class="card card-login mx-5 mt-5">
       <div class="card-header"><strong>MY ACCOUNT</strong></div>
       <div class="card-body">
         <form method="post" action="{{ route('login', app()->getLocale()) }}">
          @csrf
           <div class="form-group">
             <label for="exampleInputEmail1">Username</label>
             <input class="form-control"  type="text" name="username">

              @if($errors->has('username'))
                <span class="" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif

           </div>
           <div class="form-group">
             <label for="exampleInputPassword1">Password</label>
             <input class="form-control"  type="password" name="password">

              @if($errors->has('password'))
                <span class="" role="alert">
                    <strong>{{ $errors->first('password')  }}</strong>
                </span>
            @endif


           </div>
           <div class="form-group">
             <div class="form-check">
               <label class="form-check-label">
                 <input class="form-check-input" type="checkbox"> Remember Password</label>
             </div>
           </div>
           <button type="submit" class="btn btn-dark btn-block" name="login_user">Login</button>
         </form>
         <div class="text-center">
           <a class="d-block small mt-3" href={{url(app()->getLocale().'\register')}}>Register an Account</a>
         <a class="d-block small" href="forgot-password.php">Forgot Password?</a>


         </div>
       </div>
     </div>
   </div>

   @yield('login')
</div>


</body>




