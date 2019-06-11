<?php
/* Displays user information and some useful messages */
session_start();
// echo session_id();
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in2'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";

  header("location:login2/index.php");  
  exit();
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
    
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>HairSal &mdash; Colorlib Website Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,700,900|Display+Playfair:200,300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
</head>
  <body>
 
  <?php 
     
     // Display message about account verification link only once
     if ( isset($_SESSION['message']) )
     {
         echo $_SESSION['message'];
         
         // Don't annoy the user with more messages upon page refresh
         unset( $_SESSION['message'] );
     }
?>
<?php
    // Keep reminding the user this account is not active, until they activate
     if ( !$active ){
         header("location:login2/index.php");
   exit();
     }
     
?>
     <?php
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
      ?>   
      <?php include("nav2.php");?>

      <div class="site-section bg-light">
      <div class="container">
        <div class="row">
         <?php
          if(isset($_POST['submit'])){
              $location = $_POST['location'];
              $line1 = $_POST['line1'];
              $line2 = $_POST['line2'];
              $GST = $_POST['GST'];
              
              $sql = "UPDATE `shop` SET `location`='".$location."', `line1`='".$line1."', `line2`='".$line2."',  `GST`='".$GST."' WHERE `userid`='".$_SESSION['email']."';";
              $run = mysqli_query($conn, $sql);
              if ($run) {
                echo "<script>location='profile.php'</script>";
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
              }
          ?>
          <?php
         
          ?>
          <div class="col-md-12">
            <?php
            $sql = "SELECT * from shop where mobileno = '".$_SESSION['email']."';";
              $result = $conn->query($sql);
              while($row = $result->fetch_assoc()) {
                $location= $row['location'];
                $line1= $row['line1'];
                $line2= $row['line2'];
                $GST = $row['GST'];
              } 
            ?>
            <div class="p-4 mb-3 bg-white">
               <form action="" method="post" id="Register" enctype="multipart/form-data" class="p-5 bg-white">
                      <h2 class="mb-4 site-section-heading">Profile Update</h2>
                      <div class="col-md-12" style="margin-top: 20px;">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control" placeholder="Location *" value="<?php echo $location;?>">
                        </div>

                        <div class="col-md-12" style="margin-top: 20px;">
                            <label>Address Line 1</label>
                            <input type="text" name="line1" class="form-control" placeholder=""  value="<?php echo $line1;?>">
                        </div>

                        <div class="col-md-12" style="margin-top: 20px;">
                            <label>Address Line 2</label>
                            <input type="text" name="line2" class="form-control" placeholder="" value="<?php echo $line2;?>">
                        </div>
                                                    
                        <div class="col-md-12" style="margin-top: 20px;">
                            <label>GST</label>
                            <input type="text" name="GST" class="form-control" placeholder="$GST *" value="<?php echo $GST;?>" required/>    
                        </div>
                        
                        <div class="col-md-6"style="margin-top: 20px;">
                          <input type="submit" name="submit" class="btn btn-success" value="Update" > 
                        </div>
                        </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include("footer.php");?>
  </div>

<script src="js/aos.js"></script>

  <script src="js/main.js"></script> 
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
        att.value = "dashboard";
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
