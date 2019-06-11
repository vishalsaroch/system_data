<?php
  session_start();
 if($_SERVER['SERVER_NAME']=='localhost')
        {
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "shop";
        }
        else if($_SERVER['SERVER_NAME']=='truelook.in')
        {
          $servername = "sun";
          $username = "truelook_root";
          $password = "truelook@12#123";
          $dbname = "truelook_truedb";
        }
      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      } 
if(isset($_POST['submit']))
{
  $user_id = $_POST['userid'];
  $result = mysqli_query($conn,"SELECT * FROM shop where mobileno='" . $_POST['userid'] . "'");
  $row = mysqli_fetch_assoc($result);
  $fetch_user_id=$row['mobileno'];
  $email_id=$row['mobileno'];
  // $password=$row['password'];
  if($user_id==$fetch_user_id) {
       header("location: change.php?mobileno=".$user_id);
    // echo "user is here.";
      }
        else{
           echo '<script>alert("Email id does not exist.\nPlease enter a Valid email id.");</script>';
        }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>HairSal &mdash; Colorlib Website Template</title>
    <?php include 'css/css.html'; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery-migrate-3.0.1.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.stellar.min.js"></script>
    <script src="../js/jquery.countdown.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/bootstrap-datepicker.min.js"></script>
    <style type="text/css">
        input{
            color:#000;
        }
    </style>
  </head>
  
  <body>
  <div class="site-wrap"> 

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar py-1" role="banner">

      <div class="container-fluid">
        <div class="row align-items-center">
          
          <div class="col-6 col-xl-2" data-aos="fade-down">
            <h1 class="mb-0"><a href="../index.php" class="text-black h2 mb-0">Truelook</a></h1>
          </div>
          

          <div class="col-6 col-xl-2 text-right" data-aos="fade-down">
            <div class="d-none d-xl-inline-block">
              <ul class="site-menu js-clone-nav ml-auto list-unstyled d-flex text-right mb-0" data-class="social">
                <li>
                  <a href="#" class="pl-0 pr-3 text-black"><span class="icon-facebook"></span></a>
                </li>
                <li>
                  <a href="#" class="pl-3 pr-3 text-black"><span class="icon-twitter"></span></a>
                </li>
                <li>
                  <a href="#" class="pl-3 pr-3 text-black"><span class="icon-instagram"></span></a>
                </li>
                <li>
                  <a href="#" class="pl-3 pr-3 text-black"><span class="icon-youtube-play"></span></a>
                </li>
              </ul>
            </div>

            <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

          </div>

        </div>
      </div>
      
    </header>
  <div class="slide-one-item home-slider owl-carousel">
   <div class="site-blocks-cover inner-page-cover" style="background-image: url(../images/haircut-banner.jpg); background-repeat: no-repeat;" data-aos="fade" data-stellar-background-ratio="0.9">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
         
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400" style="background-color: #fff; opacity: 0.7">
              <h2 class="text-black font-weight-light mb-2 display-1">Forgot</h2>
                <form action="" method="post" align="center" style="padding-right:10px">
                  <input type="text" name="userid" placeholder="userid" style="margin: 10px;"><br>
                  <!-- <input type="password" name="password" placeholder="password" style="margin: 10px;"><br> -->
                  <!-- <button>login</button> -->
                  <input type="submit" name="submit" value="Forgot" align="left" class="btn btn-success" style="margin:10px;"><br><br>
                  <!-- Not registered? <a href="#">Create an account</a><br>
                  <a href="forgot.php">Forgot Password</a><br><br> -->
                </form>
            </div>
        </div>
        </div>
    </div>
    </div>
    <?php include("../footer.php");?>
</div>

<script src="../js/aos.js"></script>

  <script src="../js/main.js"></script> 
  </body>
</html>
