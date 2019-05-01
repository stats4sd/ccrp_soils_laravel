

<!doctype html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>CCRP Soils Data Platform</title>
</head>

<body>
<section class="card mt-5">
<div class="row">

<div class="card-body">
<div class="container mt-5">
<section class="col-12 mb-5" id="navigationbar">

  <h3><strong><a style="color: black;" href="https://soils.stats4sd.org/en/">CCRP Soils Data Platform</a></strong></h3>
  <div class="dropdown" id="myTogglerNav">
        <button class="dropbtn">Home</button>
        <div class="dropdown-content">
          <a href="#">Introduction</a>
          <a href="#">About</a>
        </div>
      </div>
      <div class="dropdown">
        <button class="dropbtn">Start Sampling</button>
        <div class="dropdown-content">
          <a href="#">Introduction</a>
          <a href="#">About</a>
        </div>
      </div>
      <div class="dropdown">
        <button class="dropbtn">Tools</button>
        <div class="dropdown-content">
          <a href="#">Introduction</a>
          <a href="#">About</a>
        </div>
      </div>
      <div class="dropdown">
        <button class="dropbtn">Projects&Users</button>
        <div class="dropdown-content">
          <a href="#"></a>
          <a href="#"></a>
        </div>
      </div>

    <div class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Home<b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="#">Introduction</a></li>
        <li><a href="#">About</a></li>
      </ul>
    </div>

    <div class="dropdown">
      <a class="nav-item nav-link dropdown-toggle" data-toggle="dropdown" id="example" aria-haspopup="true" aria-expanded="false" href="#">another Example</a>
        <div class="dropdown-menu" aria-labelledby="example">
          <a class="dropdown-item" href="#">Introduction</a>
          <a class="dropdown-item" href="#">About</a>
        </div>
    </div>

</section>
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
</section>


</body>
</html>


<script src="js/jquery.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<style type="text/css">
/* Dropdown Button */
.dropdown-menu{
  background-color: white;
}
body{
  background-color: #734d26;
}
.dropbtn {
  background-color: transparent;
  color: black;
  padding: 16px;
  font-size: 16px;
  border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #ddd;}

.nav{
  display: flex;
}


</style>


