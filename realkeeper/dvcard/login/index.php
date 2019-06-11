<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>dvcard</title>
    <link rel="icon" href="../images/realkeeper.png" type="image/png">
    <link rel="manifest" href="../manifest.json" crossorigin="use-credentials">
      <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,700,900|Display+Playfair:200,300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="../https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">
    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="./sw.js"></script>
    <!--<script src="../js/jquery-3.3.1.min.js"></script>-->
    <!--<script src="../js/jquery-migrate-3.0.1.min.js"></script>-->
    <!--<script src="../js/jquery-ui.js"></script>-->
    <!--<script src="../js/popper.min.js"></script>-->
    <!--<script src="../js/bootstrap.min.js"></script>-->
    <!--<script src="../js/owl.carousel.min.js"></script>-->
    <!--<script src="../js/jquery.stellar.min.js"></script>-->
    <!--<script src="../js/jquery.countdown.min.js"></script>-->
    <!--<script src="../js/jquery.magnific-popup.min.js"></script>-->
    <!--<script src="../js/bootstrap-datepicker.min.js"></script>-->
    <style type="text/css">
        input{
            color:#000;
        }
    </style>
  </head>
  <?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
        
    }
    
    elseif (isset($_POST['register'])) { //user registering
        
        require 'register.php';
        
    }
}
?>
<body class="bg-gradient">
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a href="../index.php"><img src="images/realkeper.png"></a>
    </div>
  </nav>

  <div class="container" style="margin-top:100px;">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row" >
              <!-- <div class="col-lg-6 d-none d-lg-block"><img src="../images/272163416.jpg" style="height: 100%;width: 100%"></div> -->
              <div class="col-lg-9 bg-success">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4 text-light">User login</h1>
                  </div>
                  <form class="user" action="index.php" method="post">
                    <div class="form-group">
                      <input type="text" name="mobile" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password"  name="password" class="form-control " id="exampleInputPassword" placeholder="Password">
                    </div>
                    
                    <input type="submit" name="login" value="login" align="left" class="btn btn-primary btn-block" >
                    <a class="text-light" href="forgot.php">Forget Password ?</a><br>
                    <a class="text-light" href="../signup.php">Create a new account</a>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.easing.1.3.js"></script>
  <script src="../js/jquery.waypoints.min.js"></script>
  <script src="../js/jquery.stellar.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.magnific-popup.min.js"></script>
  <script src="../js/aos.js"></script>
  <script src="../js/jquery.animateNumber.min.js"></script>
  <script src="../js/bootstrap-datepicker.js"></script>
  <script src="../js/jquery.timepicker.min.js"></script>
  <script src="../js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="../js/google-map.js"></script>
  <script src="../js/main.js"></script>

  

</body>

</html>
