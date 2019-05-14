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
  <title>Data Management-CCRP Soils Data Platform</title>
</head>

<body>
<section class="card mt-5">
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



<section class="content mb-5" id="form_data_management">
  <div class="alert alert-info">
    To view data for a project you must first be invited to the group. Please either go to the projects page and request membership for your project, or contact rms@stats4sd.org.
  </div>

  <h1 class="mb-5"><strong>Form and Data Management</strong></h1>
  <p>This page is where you manage the forms that are shared with you through Kobotoolbox, and review and download data collected through those forms.</p>
  <p>To collect data through this platform, please do the following:</p>
  <div class="card card-login mx-5 mt-5">
    <div class="card-header"><h3><strong>Instructions</strong></h3></div>
      <div class="card-body">
        <h4><b>1. Sync Forms to Kobotoolbox</b></h4>
          <p>The table below shows the forms available for your project. Deployed forms are shared with your Kobotoolbox account - you should be able to see them by logging into Kobotools using your project account. To deploy a form, click the button in the Status column.</p>
        <h4 class="mt-5"><b>2. Collect Data</b></h4>
          <p>With your forms deployed, you can collect data via Kobotoolbox / ODK Collect in the normal way. To pull new records from Kobotoolbox, click the button above. This will update the table with the number of records collected with each form.</p>
        <h4 class="mt-5"><b>3. Merge and download data</b></h4>
          <p>You can download data from Kobotoolbox directly, but this will give you one data file per form. Using this platform, you can get a merged dataset, containing 1 row per soil sample and data from all the forms above.</p>
      </div>
    </div>
</section>
<section>
  <div class="card card-login mx-5 mt-5">
    <div class="card-header"><h3><b>Forms and Data</b></h3></div>
      <div class="card-body">
        
      </div>
    
  </div>
</section>
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
           <button type="submit" class="btn btn-primary btn-block" name="login_user">Login</button>
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
  background-color: #734d26;
}
.dropdown-toggle{
  color:black;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}
</style>


