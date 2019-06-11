<?php
/* Displays user information and some useful messages */
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
	<title>Profile</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">	
 /* body {
	    background-image: url("back1.jpg");
	    background-repeat: no-repeat;
    }*/
    h1{
    	color: white;
    	background-color: black;
    	width:300px;
    	opacity: 0.5;
    	margin-left: 300px;
    }
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
	<div class="container" style="margin-top:100px; height:700px;">	
		<div class="col-sm-12"  style="margin-top: 20px; margin-bottom: 10px;"> 
				<h3 align ="center" style="background-color: #d8fff6">Employer Profile</h3>
				<h4 align ="center"  style="background-color: #d8fff6">Company Detail </h4>
				<div class="col-lg-5">
				<strong>Comapny name:</strong><br>
				<strong>Comapny Address:</strong><br>
				<strong>Company Email id:</strong><br>
				<strong>Company Work:</strong><br>
				<strong>Company logo:</strong><br>
				<strong>Company Hr name:</strong><br>
				<strong>Company logo:</strong><br>
				</div>
				<div class="col-lg-5">

				<?php
						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "dbase2";

						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);
						// Check connection
						if ($conn->connect_error) {
						    die("Connection failed: " . $conn->connect_error);
						} 

							$sql = "SELECT * FROM employersusers WHERE sno='1'";

							$result = $conn->query($sql);
						if ($result->num_rows > 0) {
					    // echo " <table class='table table-bordered' ><tr><th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
					    while($row = $result->fetch_assoc()) {
					        echo "<div class='col-lg-5'>
                              <p>
                                  <b>Compnay name : </b>
                               " . $row["compName"]. "
                               </p>
                                <p>
                                  <b>Email id : </b>
                                  " . $row["emailid"]."
                                </p>
                                <p>
                                  <b>Contact Number : </b>
                                  " . $row["contactNo"]."
                                </p>
                                <p>
                                  <b>Contact Number : </b>
                                  " . $row["contactNo"]."
                                </p>
                          </div>" ;

					    }
					} else {
					    echo "</table>";
					}
					$conn->close();
					?>
			</div>

      <div class="col-lg-2">
      <form id="theForm" action="p" method="post" enctype="multipart/form-data">
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Upload Image" name="submit" class="au-btn au-btn-icon au-btn--green">
      </form>
      <a href="employer.php" class="btn btn-info">Edit Profile</a></div>	
		</div>
	</div>
 <footer style="background-color: black; height: 100px;"></footer>
</body>
</html>