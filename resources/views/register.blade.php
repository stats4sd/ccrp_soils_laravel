<!doctype html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <title>Create an Account-CCRP Soils Data Platform</title>
</head>

<body>
<section class="card">
<div class="row">

<div class="card-body">
<div class="container mt-5">
<section class="col-12 mb-5" id="navigationbar">

  <h3><strong><a style="color: black;" href="https://soils.stats4sd.org/en/">CCRP Soils Data Platform</a></strong></h3>

     <div class="dropdown">
    <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">Home<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="/home">Introduction</a></li>
        <li><a href="/home/about">About</a></li>
      </ul>
    </div>

    <div class="dropdown">
    <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">Start Sampling<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="/start-sampling">Start Sampling</a></li>
        <li><a href="/data-management">Data Management</a></li>
      </ul>
    </div>

    <div class="dropdown">
    <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">Tools<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="/qr-codes">QR Codes</a></li>
        <li><a href="/downloads">Downloads</a></li>
      </ul>
    </div>

    <div class="dropdown">
    <a href="/login" style="color:black;">Log In<b class="caret"></b></a>
    </div>

    <div class="dropdown">
    <a href="/en" class="btn dropdown-toggle" data-toggle="dropdown"><img src="https://img.icons8.com/color/26/000000/great-britain.png"> English (Inglés)</a>
      <ul class="dropdown-menu">
        <li><a href="#"><img src="https://img.icons8.com/color/26/000000/bolivia.png"> Español (Spanish)</a></li>
      </ul>
    </div>


    <div class="btn dropdown">
    <a href="/groups" style="color:black;">All Projects<b class="caret"></b></a>
    </div>

    <div class="btn dropdown">
    <a href="/groups/create/step/group-details" style="color:black;">Create a Project<b class="caret"></b></a>
    </div>

    <div class="btn dropdown">
    <a href="/admin" style="color:black;">Admin<b class="caret"></b></a>
    </div>




</section>


  
    <div class="col-sm-8">

    <section class="content mb-5" id="create_account">
      <h1><b>Create an Account</b></h1>
      <p>Registering for this site is easy. Just fill in the fields below, and we'll get a new account set up for you in no time.</p>
      <div class="row">
      <div class="col-sm-6">
        <h3 class="content mb-3"><b>Account Details</b></h3>
        <form method="post" action="{{ url('home/checklogin')}}">
          {{csrf_field()}}
           <div class="form-group">
             <label><b>Username (required)</b></label>
             <input class="form-control"  type="text" name="username">
           </div>
           <div class="form-group">
             <label ><b>Email Address (required)</b></label>
             <input class="form-control"  type="email" name="email">
           </div>
           <div class="form-group">
            <label><b>Choose a Password (required)</b></label>
            <input class="form-control" type="password" name="password">
           </div>
           <div class="form-group">
            <label><b>Confirm Password (required)</b></label>
            <input class="form-control" type="password" name="password">
           </div>
           <button type="submit" class="btn btn-dark btn-block" name="sign_up">Complete Sign Up</button>
         </form>

      </div>
        <div class="col-sm-6">
          <h3 class="content mb-3"><b>Profile Details</b></h3>
          <div class="form-group">
          <label><b>Name (required)</b></label>
            <input class="form-control"  type="text" name="username">
          </div>
          <label style="color: grey;"><em><b>This field can be seen by:</em> Everyone</b></label> <button type="button" style="color: grey;" class="btn-xs">change</button>
          <label><b>Who can see this field?</b></label>
          <div class="choice">
            <input id="choice_1" type="radio" name="choice" value="everyone" />
            <label for="choice_1">Everyone</label>
          </div>

          <div class="choice">
            <input id="choice_2" type="radio" name="choice" value="only_me" />
            <label for="choice_2">Only Me</label>
          </div>

          <div class="choice">    
            <input id="choice_3" type="radio" name="choice" value="all_members" />
            <label for="choice_3">All Members</label>
          </div>


        </div>
    
    </div>
  </div>
  </div>

</div>

<div class="row">
  <div class="container">
     <div class="card card-login mx-5 mt-5">
       <div class="card-header"><strong>MY ACCOUNT</strong></div>
       <div class="card-body">
        @if(isset(Auth::user()->name))
          <script>window.location="/home/successlogin"</script>
        @endif

        @if($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>{{ $message }}</strong>
        </div>
        @endif
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
         <form method="post" action="{{ url('home/checklogin')}}">
          {{csrf_field()}}
           <div class="form-group">
             <label for="exampleInputEmail1">Username</label>
             <input class="form-control"  type="text" name="name">
           </div>
           <div class="form-group">
             <label for="exampleInputPassword1">Password</label>
             <input class="form-control"  type="password" name="password">
           </div>
           <div class="form-group">
             <div class="form-check">
               <label class="form-check-label">
                 <input class="form-check-input" type="checkbox"> Remember Password</label>
             </div>
           </div>
           <button type="submit" class="btn btn-dark btn-block" name="login">Login</button>
         </form>
         <div class="text-center">
           <a class="d-block small mt-3" href="register">Register an Account</a>
        <!-- <a class="d-block small" href="forgot-password.php">Forgot Password?</a>-->

         </div>
       </div>
     </div>
   </div>

       <!--  @if(isset(Auth::user()->email))
          <div class="alert alert-danger success-block">
            <strong>Welcome {{Auth::user()->email}}</strong>
            <br/>
          </div>
          <a href="{{ url('/home/logout')}}">Logout</a>
        @else
          <script>window.location = "/home";</script>
        @endif -->

          


</div>
</div>
</body>

<style type="text/css">
body{
  background-color: #806d5d;
}
.dropdown-toggle{
  color:black;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}
.card {
        margin:  20px; /* Added */
        float: auto; /* Added */
        margin-bottom: 20px; /* Added */
        margin-top: 20px;
}

.card-login {
  float: auto;
  right: 250px;
  top: 250px;
  display: flex;
  width: 300px;
}

</style>

