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

  <h3><strong><a style="color: black;" href="https://soils.stats4sd.org/en/">CCRP Soils Data Platform</a></strong></h3>

     <div class="dropdown">
    <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">Home<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="/home">Introduction</a></li>
        <li><a href="/home/about/">About</a></li>
      </ul>
    </div>

    <div class="dropdown">
    <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">Start Sampling<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="/start-sampling/">Start Sampling</a></li>
        <li><a href="/data-management/">Data Management</a></li>
      </ul>
    </div>

    <div class="dropdown">
    <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">Tools<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="/qr-codes/">QR Codes</a></li>
        <li><a href="/downloads/">Downloads</a></li>
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
    <a href="/groups/" style="color:black;">All Projects<b class="caret"></b></a>
    </div>

    <div class="btn dropdown">
    <a href="/groups/create/step/group-details/" style="color:black;">Create a Project<b class="caret"></b></a>




</section>


  
<div class="col-sm-8">

<section class="content mb-5" id="introduction">
  <h1>Introduction</h1>
  <p>This data platform is intended to help CCRP research projects collect and organise their soil sample data.</p>
  <p>Using the tools within the platform will help you:</p>
  <ul>
    <li>Uniquely identify each soil sample your project collects with a QR code.</li>
    <li>Enter data about the soil samples, such as location, date of sampling and other key information.</li>
    <li>Enter readings from your soil analyses and automatically calculate the results.</li>
    <li>Save the readings and results to a secure database.</li>
    <li>Automatically merge results from different analyses with your main sample information into a single dataset.</li>
  </ul>
  <p>If you work with soils, and are interested in using the Soil Health Assessment Toolkit developed by the team at <a href="https://smallholder-sha.org/"><u>smallholder-sha.org</u></a>, we recommend exploring this platform to see how these tools can help your workflow.</p>
</section>


<section class="content mb-5" id="whoweare">
  <h3><strong>Who are we?</strong></h3>
  <p>The platform is a collaboration between the Research Methods Support team at <a href="https://stats4sd.org/"><u>Stats4SD</u></a> and the Cross-cutting Soils project funded by the McKnight foundation’s <a href="http://ccrp.org/"><u>Collaborative Crop Research Program (CCRP)</u></a>.</p>
  <p>This website and associated resources are created by the CCRP Research Methods Support team and Cross-cutting Soils Project, in association with the <a href="http://ccrp.org/"><u>Collaborative Crop Research Program</u></a>. All data present in the platform remains the property of the individual projects using the platform.</p>
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
           <a class="d-block small mt-3" href="register.php">Register an Account</a>
        <!-- <a class="d-block small" href="forgot-password.php">Forgot Password?</a>-->
         </div>
       </div>
     </div>
   </div>
 <!-- Bootstrap core JavaScript-->
 <script src="vendor/jquery/jquery.min.js"></script>
 <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- Core plugin JavaScript-->
 <script src="vendor/jquery-easing/jquery.easing.min.js"></script>


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
}

</style>


