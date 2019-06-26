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
  <title>CCRP Soils Data Platform</title>
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
        <li><a href="/home">{{ t("Introduction") }}</a></li>
        <li><a href="/home/about">{{ t("About") }}</a></li>
      </ul>
    </div>

    <div class="dropdown">
    <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">{{ t("Start Sampling") }}<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="/start-sampling">{{ t("Start Sampling") }}</a></li>
        <li><a href="/data-management">{{ t("Data Management") }}</a></li>
      </ul>
    </div>

    <div class="dropdown">
    <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">{{ t("Tools") }}<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="/qr-codes">{{ t("QR Codes") }}</a></li>
        <li><a href="/downloads">{{ t("Downloads") }}</a></li>
      </ul>
    </div>

    <div class="dropdown">
    <a href="/login" style="color:black;">{{ t("Log In") }}<b class="caret"></b></a>
    </div>

    <div class="dropdown">
    <a href="/en" class="btn dropdown-toggle" data-toggle="dropdown"><img src="https://img.icons8.com/color/26/000000/great-britain.png"> English (Inglés)</a>
      <ul class="dropdown-menu">
        <li><a href="#"><img src="https://img.icons8.com/color/26/000000/bolivia.png"> Español (Spanish)</a></li>
      </ul>
    </div>


    <div class="btn dropdown">
    <a href="/groups" style="color:black;">{{ t("All Projects") }}<b class="caret"></b></a>
    </div>

    <div class="btn dropdown">
    <a href="/groups/create/step/group-details" style="color:black;">{{ t("Create a Project") }}<b class="caret"></b></a>
    </div>

    <div class="btn dropdown">
    <a href="/admin" style="color:black;">{{ t("Admin") }}<b class="caret"></b></a>
    </div>
</section>



<div class="col-sm-8">

<section class="content mb-5" id="introduction">
  <h1>{{ t("Introduction") }}</h1>
  <p>{{ t("This data platform is intended to help CCRP research projects collect and organise their soil sample data.") }}</p>
  <p>{{ t("Using the tools within the platform will help you:") }}</p>
  <ul>
    <li>{{ t("Uniquely identify each soil sample your project collects with a QR code.") }}</li>
    <li>{{ t("Enter data about the soil samples, such as location, date of sampling and other key information.") }}</li>
    <li>{{ t("Enter readings from your soil analyses and automatically calculate the results.") }}</li>
    <li>{{ t("Save the readings and results to a secure database.") }}</li>
    <li>{{ t("Automatically merge results from different analyses with your main sample information into a single dataset.") }}</li>
  </ul>
  <p>{{ t("If you work with soils, and are interested in using the Soil Health Assessment Toolkit developed by the team at <a href='https://smallholder-sha.org/'><u>smallholder-sha.org</u></a>, we recommend exploring this platform to see how these tools can help your workflow.") }}</p>
</section>


<section class="content mb-5" id="whoweare">
  <h3><strong>Who are we?</strong></h3>
  <p>The platform is a collaboration between the Research Methods Support team at <a href='https://stats4sd.org/'><u>Stats4SD</u></a> and the Cross-cutting Soils project funded by the McKnight foundation’s <a href='http://ccrp.org/'><u>Collaborative Crop Research Program (CCRP)</u></a>.</p>
  <p>{{ t("This website and associated resources are created by the CCRP Research Methods Support team and Cross-cutting Soils Project, in association with the <a href='http://ccrp.org/'><u>Collaborative Crop Research Program</u></a>. All data present in the platform remains the property of the individual projects using the platform.") }}</p>
</section>
</div>
</div>

</div>

<div class="row">
  <div class="container">
     <div class="card card-login mx-5 mt-5">
       <div class="card-header"><strong>{{ t("MY ACCOUNT") }}</strong></div>
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
             <label for="exampleInputEmail1">{{ t("Username") }}</label>
             <input class="form-control"  type="text" name="name">
           </div>
           <div class="form-group">
             <label for="exampleInputPassword1">{{ t("Password") }}</label>
             <input class="form-control"  type="password" name="password">
           </div>
           <div class="form-group">
             <div class="form-check">
               <label class="form-check-label">
                 <input class="form-check-input" type="checkbox"> Remember Password</label>
             </div>
           </div>
           <button type="submit" class="btn btn-dark btn-block" name="login">{{ t("Login") }}</button>
         </form>
         <div class="text-center">
           <a class="d-block small mt-3" href="/register">{{ t("Register an Account") }}</a>
        <!-- <a class="d-block small" href="forgot-password.php">Forgot Password?</a>-->

         </div>
       </div>
     </div>
   </div>

        @if(isset(Auth::user()->email))
          <div class="alert alert-danger success-block">
            <strong>Welcome {{Auth::user()->email}}</strong>
            <br/>
          </div>
          <a href="{{ url('/home/logout')}}">Logout</a>
        @else
          <script>window.location = "/home";</script>
        @endif




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


