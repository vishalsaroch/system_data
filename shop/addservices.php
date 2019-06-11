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

    <script type="text/javascript">
        function myfunction124(){
          var productName = document.getElementById("getdata").value;
          document.getElementById("pname").value = productName;
        }
    </script>
    <!-- <script>
      $(function() {
        $("#update").submit(function(e){ 
        var data12 = "&pname="+document.getElementById("pname").value+"&price="+document.getElementById("price").value+"&dis="+document.getElementById("dis").value+"&fileToUpload="+document.getElementById("fileToUpload").value;
        var formData = new FormData(this);
        window.alert(data12);
        if(location.hostname=='localhost')
            {
               urlkey = "/shop/updateservices.php";
            }
            else if(location.hostname=='truelook.in')
            {
                urlkey = "updateservices.php";
            }
            $.ajax({
              url: urlkey,
              method: "POST",
              data: formData,
              success: function(result){alert(result);
              if(result!=="services is already Activated."){
              window.location = "profile.php";
               }
              },
              failure: function(err){alert(err);},
              cache: false,
              contentType: false,
              processData: false
            });
          });
        });
    </script> -->
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
    if($_SERVER['SERVER_NAME']=='localhost'){
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
  <?php
   if(isset($_POST['submit'])){
     $services = $_POST['services'];
    }
  ?>

  <div class="site-section bg-light">
  <div class="container">
    <div class="row">
     <div class="col-md-12 bg-white">
        <!-- <div class="p-4 mb-3 "> -->
      <h3 style="text-align: center; line-height: 30px;">Services</h3>
      <?php
        $sql = "SELECT * from services";
        $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) {
            $service= $row["pname"];
      ?>

      <?php
        if(isset($_POST['update'])){
          $product= $_POST['pname'];
          $price = $_POST['price'];
          $dis = $_POST['dis'];
          $for = $_POST['for'];
          $images = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
          $sql = "SELECT * FROM userserviseupdate where pname = '".$product."' and userid = '".$email."'";
          $result1 = $conn->query($sql);
            if ($result1->num_rows > 0) {
              echo "Services is alredy Activated.";
            } else {
          $sql = "INSERT INTO `userserviseupdate` (`pname`, `price`, `dis` , `for`, `image`, `userid`) VALUES ('$product', '$price', '$dis', '$for', '$images','$email')";
            $run = mysqli_query($conn, $sql);
            if($run){
              }else{
                  echo "Error: " . $query. "<br>" . $conn->error;
              }
          $conn->close(); 
        }
      }
    ?>
      <div class="col-md-4" style="float:left">
      <?php 
        if($row["image"]===""){
          echo "<img src='images/module.png' height='150' width='150px' data-toggle='modal' data-target='#myModal'>";}
          else{
          echo "<img src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='150' width='50%' data-toggle='modal' data-target='#myModal'>";
        }
      ?>

      <button type="button" name='services' data-toggle="modal" data-target="#myModal" class="btn btn-success" style="margin:10px; width: 200px;" id="getdata" onclick='myfunction124()' value="<?php echo $service;?>"> <?php echo $service;?></button>
      </div>
      <div class="container">
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content" style="margin-top: 100px;">
              <div class="modal-header">
               <h4 class="modal-title" class="text-center"></h4>
              </div>
              <div class="modal-body">
                  <form method="post" action="" id="update" enctype="multipart/form-data">
                      <input type="text" id="pname" name="pname" class="form-control" placeholder="Product Name *">
                      <br>
                     <input type="number" id="price" placeholder="Price" name="price" class="form-control">
                     <br>
                      <textarea  name="dis" id="dis" placeholder="Discription" class="form-control"></textarea>
                      <br>
                      <label class="radio-inline" style="text-indent: 25px;"><input type="radio" name="for"value="Man" class="radio">Man</label>
                      
                      <label class="radio-inline" style="text-indent: 40px;"><input type="radio" name="for"value="woman" class="radio">Women</label>
                      <div class="col-md-11" > <output id="list"></output></div>
                        <input type="file" name="fileToUpload" id="fileToUpload"  value="Choose" style="color:#fff">
                     <br><br>
                     <input type="submit" name="update" value="update" class="btn btn-info">
                     <br>
                  </form>          
              </div>
              <div class="modal-footer"></div>
            </div>
          </div>
        </div>
      </div>
      <?php
        }
      ?>
    </div>
    </div>
  </div>
</div>
    <?php include("footer.php");?>
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
            reader.readAsDataURL(f);
            }
          }
        document.getElementById('fileToUpload').addEventListener('change', handleFileSelect, false);
        </script>

	<script src="js/aos.js"></script>

  <script src="js/main.js"></script> 
   
  </body>
</html>
