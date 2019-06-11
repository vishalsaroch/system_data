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

  <!-- <script>
  $(function() {
      $("#update").submit(function(e){ 
            
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
              method: "get",
              success: function(result){
                alert(result);
                      },
              failure: function(result){}
          });

          // return(false);
          alert("Servies Updated Sucessfully");
      
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
      if(isset($_POST['update'])){
          $images = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
          $sql = "INSERT INTO `userserviseupdate` (`image`) VALUES ('$images')";   
          if ($conn->query($sql) === TRUE) {

        echo "User Registed Sucessfully";
        // header("location:profile.php");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
     
  ?>

  <?php
     if(isset($_POST['submit'])){
       $services = $_POST['services'];
       print_r($services);
      echo $services;
      }
        
    ?>
   <div class="site-section bg-light">
      <div class="container">
        <div class="row">
         <div class="col-md-12 bg-white">
            <!-- <div class="p-4 mb-3 "> -->
              <h3><b>Services</b></h3>
          <?php
              // $sql = "SELECT * from services where mobileno = '".$_SESSION['email']."';";
            $sql = "SELECT * from services";
            $result = $conn->query($sql);
              while($row = $result->fetch_assoc()) {
                $service= $row["Name"];
            ?>
          <div class="container">
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content" style="margin-top: 100px;">
                  <div class="modal-header">
                   <h4 class="modal-title" class="text-center" id="show"></h4>
                  </div>
                  <div class="modal-body">
                      <form method="post" action="">
                      <input type="text" name="pname" class="form-control" placeholder="Product Name *">
                      <br>
                         <input type="number" placeholder="Price" name="price" class="form-control">
                         <br>
                          <textarea  name="dis" placeholder="Discription" class="form-control"></textarea>
                          <br>
                          <div class="col-md-11" > <output id="list"></output></div>
                           <input type="file" name="fileToUpload" id="fileToUpload"  value="Choose">
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

                
        
              <input type="text" name="data" value="<?php echo $service;?>" id="data12" display="none">
              <button type="button" name='services' data-toggle="modal" data-target="#myModal" value="<?php echo $service;?>"   class="btn btn-success" style="margin:10px; width: 200px;" id="getdata" onclick="data()"> <?php echo $service;?></button>
              
              <script type="text/javascript">
                function data(){
                var data= document.getElementById("data12").value;
                // alert(data);
                document.getElementById("show").innerHTML=data;
                }
              </script>

              <?php
              }
              ?>
              
              <!-- <input type='submit'  name='submit' value='Activate' class='btn btn-danger' algin='center'> -->
           <!--  </form> -->
               
        <!-- </div> -->
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
