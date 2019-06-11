<?php
session_start();
$mobileno = $_GET["mobileno"];
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

  if (count($_POST) > 0) {
    $result = mysqli_query($conn, "SELECT * from shop WHERE mobileno='" . $mobileno . "'");
    $row = mysqli_fetch_array($result);
    if ($_POST["currentPassword"] == $row["pwd"]) {
      // echo "true";

      // } 
        mysqli_query($conn, "UPDATE shop set pwd='" . $_POST["newPassword"] . "' WHERE mobileno='" . $mobileno . "'");
        // $message = "Password Changed";

         header("location: index.php");
        // echo  $_POST["newPassword"];
    } else
        $message = "Current Password is not correct";
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
              <h2 class="text-black font-weight-light mb-2 display-1">Change</h2>
              <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
                  <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                 <input type="password" name="currentPassword" id="currentPassword"  placeholder="Old Password" autocomplete="off" style="margin:10px;">
                  <span id="currentPassword"  class="required" ></span>
                  <script>
                    function myFunction() {
                      var x = document.getElementById("currentPassword");
                      if (x.type === "password") {
                        x.type = "text";
                      } else {
                        x.type = "password";
                      }
                    }
                    </script>
                   
                    <input type="password" name="newPassword" style="margin:10px;" placeholder="New Password" required autocomplete="off">
                    <span id="newPassword" class="required"></span>
                
                    <input type="password" name="confirmPassword" style="margin:10px;" placeholder="Conform Password" required autocomplete="off">
                    <span id="confirmPassword" class="required"></span>
                  
                    <input type="submit" name="submit" value="Submit" class="btn- btn-info" style="margin:10px;" required autocomplete="off"><br><br>
                 
                  </form>
                
                <script>
                function validatePassword() {
                var currentPassword,newPassword,confirmPassword,output = true;

                currentPassword = document.frmChange.currentPassword;
                newPassword = document.frmChange.newPassword;
                confirmPassword = document.frmChange.confirmPassword;

                if(!currentPassword.value) {
                currentPassword.focus();
                document.getElementById("currentPassword").innerHTML = "required";
                output = false;
                }
                else if(!newPassword.value) {
                newPassword.focus();
                document.getElementById("newPassword").innerHTML = "required";
                output = false;
                }
                else if(!confirmPassword.value) {
                confirmPassword.focus();
                document.getElementById("confirmPassword").innerHTML = "required";
                output = false;
                }
                if(newPassword.value != confirmPassword.value) {
                newPassword.value="";
                confirmPassword.value="";
                newPassword.focus();
                document.getElementById("confirmPassword").innerHTML = "not same";
                output = false;
                }   
                return output;
                }
                </script>
               <!--  <form action="" method="post" align="center" style="padding-right:10px" name="frmChange" onSubmit="return validatePassword()">
                <input type="hidden"  placeholder="Current Password" style="margin: 5px;" >
                  <input type="text" name="currentPassword" placeholder="Current Password" style="margin: 5px;"><br>
                  <input type="password" name="newPassword" placeholder="New Password" style="margin: 10px;"><br>
                  <input type="password" name="confirmPassword" placeholder="Conform Password" style="margin: 5px;"><br>
                  <!-- <input type="password" name="password" placeholder="password" style="margin: 10px;"><br> -->
                 <!--  <button>login</button> -->
                 <!--  <input type="submit" name="submit" value="Udate" align="left" class="btn btn-success" style="margin:5px;"><br><br> -->
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
 <!--  <script>
    function validatePassword() {
    var currentPassword,newPassword,confirmPassword,output = true;
    currentPassword = document.frmChange.currentPassword;
    newPassword = document.frmChange.newPassword;
    confirmPassword = document.frmChange.confirmPassword;

    if(!currentPassword.value) {
    currentPassword.focus();
    document.getElementById("currentPassword").innerHTML = "required";
    output = false;
    }
    else if(!newPassword.value) {
    newPassword.focus();
    document.getElementById("newPassword").innerHTML = "required";
    output = false;
    }
    else if(!confirmPassword.value) {
    confirmPassword.focus();
    document.getElementById("confirmPassword").innerHTML = "required";
    output = false;
    }
    if(newPassword.value != confirmPassword.value) {
    newPassword.value="";
    confirmPassword.value="";
    newPassword.focus();
    document.getElementById("confirmPassword").innerHTML = "not same";
    output = false;
    }   
    return output;
    }
    </script> --> 
   <script type="text/javascript">
function getQueryStrings() { 
  var assoc  = {};
  var decode = function (s) { return decodeURIComponent(s.replace(/\+/g, " ")); };
  var queryString = location.search.substring(1); 
  var keyValues = queryString.split('&'); 

  for(var i in keyValues) { 
    var key = keyValues[i].split('=');
    if (key.length > 1) {
      assoc[decode(key[0])] = decode(key[1]);
    }
  } 

  return assoc; 
}
      var qs = getQueryStrings();
      var active = qs["active"];
      var att = document.createAttribute("class");
        att.value = "active";
      if(active=="home")
      {        
        document.getElementById("home").setAttributeNode(att);
      }
      if(active=="haircut")
      {        
        document.getElementById("haircut").setAttributeNode(att);
      }
      if(active=="services")
      {        
        document.getElementById("services").setAttributeNode(att);
      }
      if(active=="about")
      {        
        document.getElementById("about").setAttributeNode(att);
      }
      if(active=="contact")
      {        
        document.getElementById("contact").setAttributeNode(att);
      }
      if(active=="addshop")
      {        
        document.getElementById("addshop").setAttributeNode(att);
      }
      if(active=="Login")
      {        
        document.getElementById("Login").setAttributeNode(att);
      }
    </script> 
  </body>
</html>
