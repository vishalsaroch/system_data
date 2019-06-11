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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

        <div class="col-md-3">
          <div class="p-4 mb-3 bg-white">
            <?php
              $sql = "SELECT * from shop where mobileno = '".$_SESSION['email']."';";
              $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  if($row["image"]===""){
                  echo "
                    <img src='images/module.png' height='150' width='150px' data-toggle='modal' data-target='#myModal'>" ;}
                  else{
                  echo "<img src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='150' width='30%' data-toggle='modal' data-target='#myModal' align='right'>" ;}
              }
            } else {
                echo "No result found";
            }
            ?>
          </div>
        </div>
          <div class="col-md-5 mb-5 bg-white">
          <?php
              $sql = "SELECT * from shop where mobileno = '".$_SESSION['email']."';";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "
                  
                    <h3 class='mb-4'>" . $row["shopname"]. " </h3>
                    <h4 class='mb-4'>" . $row["ownername"]."</h4>
                    <p class='mb-4'><b> Address:   </b> " . $row["line1"]." " . $row["line2"]." " . $row["location"]."</p>
                    <p class='mb-4'><b> GST NO:     </b>" . $row["GST"]."</p>
                   
                    <p class='mb-4'> <b>Mobile:     </b>" . $row["mobileno"]."</p>";
                }
                } else {
                    echo "No result found";
                }
            ?> 
            <a href="edit.php" align="center" class="btn btn-info">Edit</a>    
          </div>

          <div class="col-md-4 mb-5 bg-white">
          <h3>Service</h3>
            <?php
              $sql = "SELECT * from userserviseupdate where userid = '".$_SESSION['email']."';";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  
                    if($row["image"]===""){
                    echo "<img src='images/module.png' height='150' width='150px' data-toggle='modal' data-target='#myModal'>";}
                    else{
                    echo "<img src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='150' width='50%' data-toggle='modal' data-target='#myModal'>";
                  }
                  echo "
                    <h4 class='mb-4' >" . $row["pname"]. " </h4>
                    <p class='mb-4' ><span class='fa fa-rupee'></span> " . $row["price"]. " </p>";
                  }
                } else {
                    echo "No result found";
                  }
            ?> 
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog" style="margin-top: 100px;">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body" style=" width: 30vw;">
        <div class="row">
        <div class="col-md-11" > <output id="list"></output></div>
        <div class="col-md-1" style="margin-top: 50px; ">
          <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload"  value="Choose" style="color:#fff">
            <input type="submit" value="Upload Image" name="submit" class="au-btn au-btn-icon au-btn--green">
        </form>
        </div>
        </div>
      </div>
      <script>
          function handleFileSelect(evt) {
            var files = evt.target.files; // FileList object

            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {

              // Only process image files.
              if (!f.type.match('image.*')) {
                continue;
              }

              var reader = new FileReader();

              // Closure to capture the file information.
              reader.onload = (function(theFile) {
                return function(e) {
                  // Render thumbnail.
                  var span = document.createElement('span');
                  span.innerHTML = ['<img class="thumb" src="', e.target.result,
                                    '" title="', escape(theFile.name), '" height="150px" width="150px"/>'].join('');
                  document.getElementById('list').insertBefore(span, null);
                };
              })(f);

              // Read in the image file as a data URL.
              reader.readAsDataURL(f);
            }
          }

          document.getElementById('fileToUpload').addEventListener('change', handleFileSelect, false);
        </script>
      </div>
    </div>
  </div>
</div>
<div class="site-section bg-light">
  <div class="container">
    <div class="row">
     <?php
    if(isset($_POST['submit'])){
      $images = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
      $sql = "UPDATE `shop` SET `image`='".$images."' WHERE `userid`='".$_SESSION['email']."';";
      $run = mysqli_query($conn, $sql);
      if ($run) {
        echo "<p>Shop Logo Updated Successfully</p>";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
    ?>
  </div>
  </div>
      </div>
    </div>
  </div>
  <script src="js/aos.js"></script>
  <script src="js/main.js"></script> 
  </body>
</html>