<?php
/* Displays user information and some useful messages */
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: ../login/index.php");  
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
<html>
<head>
	<title>Company Profile</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">	
  body {
	    background-color: #ffff99;"
    }
    /*h1{
    	color: white;
    	/*background-color: black;*/
    	/*width:300px;
    	opacity: 0.5;
    	margin-left: 300px;
      font-family: arial*/
    }*/
     /*h3{
    	color: white;
    	background-color: black;
    	width:200px;
    	opacity: 0.5;
    	margin-left: 550px;
    }*/
     button{
    	color: white;
    	background-color: orange;
    	width:170px;
    	opacity: 0.5;
    	margin-left: 385px;
    }
    tr:hover{
    	background-color: #CFF3FB;
    }
    table td {
    	border:1px solid blue;

    }

    th{background-color: black; color: white;}
   
  /*.thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
  }*/
</style>
<script type="text/javascript">
  
$(function() {
    $("#theForm").submit(function(e){
      e.preventDefault();    
      var formData = new FormData(this);
            
            
      var urlkey;
      if(location.hostname=='localhost')
      {
        urlkey = "/web_project/employer/upload.php";
      }
      else if(location.hostname=='cogentsol.in')
      {
        urlkey = "upload.php";
      }
      $.ajax({
        
        url: urlkey,
        method: "POST",
        data: formData,
        success: function(result){alert(result);},
        failure: function(err){alert(err);},
        cache: false,
        contentType: false,
        processData: false
      });
      return(false);
    });
  });
      
</script>


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
         header("location: ../login/index.php");
   exit();
     }
     
     ?>
<?php include("nav.php"); ?>
<?php
          if($_SERVER['SERVER_NAME']=='localhost')
            {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dbase2";
            }
            else if($_SERVER['SERVER_NAME']=='cogentsol.in')
            {
                $servername = "sun";
                $username = "cogentso_root";
                $password = "rootPWD@#";
                $dbname = "cogentso_dbase2";
            }
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
?>
	<div class="container" style="margin-top:50px; height:700px;">	
    <?php
        if(isset($_POST['submit'])){
          $images = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
            $sql = "UPDATE `employersusers` SET `image`='".$images."' WHERE `userid`='".$_SESSION['email']."';";
            $run = mysqli_query($conn, $sql);
            if ($run) {
              echo "<p>Company Logo Updated Successfully</p>";
              } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
            }
        ?>
          <?php
              // echo "<br><br><br><br>".$_SESSION["email"];
              $sql = "SELECT * from employersusers where emailid = '".$_SESSION['email']."';";
						  $result = $conn->query($sql);
						  if ($result->num_rows > 0) {
					    while($row = $result->fetch_assoc()) {
					        echo "<div class='col-md-3'></div>
                  <div class='col-md-6' style='margin-top:30px;'>
                    <img src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='150' width='30%' data-toggle='modal' data-target='#myModal' align='right'>
                    <p>
                        
                     <h3 style='text-transform: uppercase; font-weight:bold;'>" . $row["compName"]. " Pvt Ltd</h3>
                     </p>

                     <p>
                        <b>Address : </b>
                        <p>" . $row["address"]." " . $row["state"]."</p>
                      </p>

                      <p>
                        <b>Product : </b>
                        <span>" . $row["product"]."</span>
                      </p>
                      
                      <p>
                        <b>Statutory : </b>
                        <span>" . $row["Statutory"]."</span>
                      </p>
                      <a href='employer.php' class='btn btn-info'>Edit</a>
                      <p>
                        <b>Email id : </b>
                        <span>" . $row["emailid"]."</span>
                      </p>
                      <p>
                        <b>Contact Number : </b>
                        <span>" . $row["contactNo"]."</span>
                      </p>
                      <p>
                        <div class='col-md-3'></div>
                    </div>
                <div class='col-lg-3'></div>" ;
                         

					    }
					} else {
					    echo "No result found";
					}
					$conn->close();
          // echo $_SESSION["Error"];
					?>
			</div>
      <div class="container">

  <!-- Trigger the modal with a button -->
 

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        
          
        <div class="modal-body" style=" width: 30vw;">
        <div class="row">
        <div class="col-md-11" > <output id="list"></output></div>
       <!--  <div class="col-md-4"></div> -->
        <div class="col-md-1" style="margin-top: 50px; " 
        >
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


     
     
      
      </div>	
		</div>
	</div>
 <footer style="background-color: black; height: 100px;"></footer>
 
</body>
</html>