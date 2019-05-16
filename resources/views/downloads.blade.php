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
  <title>Downloads-CCRP Soils Data Platform</title>
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
        <li><a href="/start-sampling/">Start Sampling</a></li>
        <li><a href="/data-management/">Data Management</a></li>
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
</section>


<div class="col-sm-8">
<section class="content mb-5" id="generate_qr_code">
  <h3 class="mb-5"><b>Downloads</b></h3>
  <p>This page contains links to find and download resources to help you during your soil analysis. Full details of each analysis process can be found at <a href="https://smallholder-sha.org/"> https://smallholder-sha.org/</a>.</p>
</section>
<section class="mb-5">
  <h4 class="mb-4"><b>Sample Intake Process</b></h4>
  <p>There are 2 versions of the intake form available. The first is a “quick” version – this form is ready-to-go, but does not include any customisation for entering your own community lists.</p>
  <p>The second is a version that allows you to add your own community listing. This is designed to be used with this platform’s location management, but it is also a good template if you want to use it with your own project’s data management system. This version requires you to edit the XLS form by adding the choice lists for the communities and farmers that you work with.</p>
  <p><a href=""><u>Download quick version.</u></a></p>
  <p><a href=""><u>Download community list version</u></a></p>
</section>
<section class="mb-5">
  <h4 class="mb-4"><b>Analysis Forms</b></h4>
  <p>The following forms are available to assist with data entry and calculations during the analysis. These forms are designed to be used with the above intake form, and require you to have a QR code attached to each sample for identification purposes.</p>
  <p><a href=""><u>Download Full Protocol as pdf file</u></a> (includes all analyses)</p>
</section>
<section class="mb-5">
  <h4 class="mb-4"><b>Active carbon:</b></h4>
  <p><a href="https://smallholder-sha.org/protocol-1/active-carbon/"><u>View protocol online</u></a> (redirects to smallholder.sha.org)</p>
  <p><a href=""><u>Download Active Carbon (POXC) form</u></a></p>
</section>
<section class="mb-5">
  <h4 class="mb-4"><b>Soil pH:</b></h4>
  <p><a href="https://smallholder-sha.org/protocol-1/soil_ph/"><u>View protocol online</u></a> (redirects to smallholder.sha.org)</p>
  <p><a href=""><u>ccrp_soils-ph-analysis</u></a></p>
</section>
<section class="mb-5">
  <h4 class="mb-4"><b>Available Phosphorus:</b></h4>
  <p><a href="https://smallholder-sha.org/protocol-1/available-phosphorus/"><u>View protocol online</u></a> (redirects to smallholder.sha.org)</p>
  <p><a href=""><u>ccrp_soils-p-analysis</u></a></p>
  
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


