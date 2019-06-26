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
  <title>How the platform works-CCRP Soil Data Platform</title>
</head>

<body>
<section class="card">
<div class="row">

<div class="card-body">
<div class="container mt-5">
<section class="col-12 mb-5" id="navigationbar">

  <h3><strong><a style="color: black;" href="https://soils.stats4sd.org/">CCRP Soils Data Platform</a></strong></h3>

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
    <a href="#" class="btn dropdown-toggle" data-toggle="dropdown"><img src="https://img.icons8.com/color/26/000000/great-britain.png"> English (Inglés)<b class="caret"></b></a>
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


<!-- Modify the content after this comment -->

</section>
<div class="col-sm-8">
<section class="content mb-5" id="introduction">
  <h1>How the platform works</h1>
  <p>There are three main components to this data platform:</p>
  <ul>
    <li>A set of ODK forms for use when collecting and analysing soil samples;</li>
    <li>A QR Code generation tool, to help you uniquely identify and manage your physical samples;</li>
    <li>A MySQL Database that helps organise data collected through the different forms.</li>
  </ul>
  <p>You can use these components in different ways, described below.</p>
</section>


<section class="content mb-5" id="whoweare">
  <h3><strong>1. Register to use the platform’s database</strong></h3>
  <p>Registering on the site will give you access to the full set of tools, including the ability to collect data via your own Kobotoolbox account, have it synchronised to the platform, and then automatically merged into downloadable datasets.</p>
  <p>To make full use of the platform, you need to have a kobotoolbox account for your project – if you don’t have one, you can set one up easily at https://kf.kobotoolbox.org. This platform integrates with Kobotoolbox to let you collect soil sample and analysis data with the same tools you use for other data collection activities.</p>
  <p>To get started, use the links in the sidebar to register a new project account. The RMS or Soils team will be notified and will be able to confirm your account and help you get started.</p>
</section>

<section class="content mb-5" id="whoweare">
  <h3><strong>2. Just use the ODK forms</strong></h3>
  <p>Using the downloadable resources requires no sign-up, simply download the XLS forms you wish to use from our downloads page.</p>
  <p>The different analysis protocols all require some level of calculation. The ODK forms we have developed have these calculations programmed in, to help save time and reduce the chance of errors in your results.</p>
  <p>The analysis forms require you to scan a QR or barcode at the start of the process, to identify your soil sample. We highly recommend using QR codes for uniquely identifying your physical samples, as they can be printed out and kept with the sample. See the QR code generation page for more information.</p>
  <p>To see all the forms available and choose ones to download, go to our downloads page.</p>
</section>
</div>
</div>
</div>

<div class="row">
  <div class="container">
     <div class="card card-login mx-5 mt-5">
       <div class="card-header"><strong>MY ACCOUNT</strong></div>
       <div class="card-body">
         <form method="post" action="login.php">
           <div class="form-group">
             <label for="exampleInputEmail1">Username</label>
             <input class="form-control"  type="text" name="username">
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
           <button type="submit" class="btn btn-dark btn-block" name="login_user">Login</button>
         </form>
         <div class="text-center">
           <a class="d-block small mt-3" href="/register">Register an Account</a>
        <!-- <a class="d-block small" href="forgot-password.php">Forgot Password?</a>-->
         </div>
       </div>
     </div>
   </div>


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


