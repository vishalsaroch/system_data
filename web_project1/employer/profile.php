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
<nav class="navbar navbar navbar-fixed-top" style="height: 100px; background-color: black; color: white;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src="images/ashwani1.png"></a>
    </div>
    <ul class="nav navbar-nav" style="margin-top: 30px;">
      <li class="active"><a href="dashbord2.php">Deshbord</a></li>
     <!--  <li><a href="#">Search Candidate</a></li> -->
      <li><a href="showjob.php">All Posted Job</a></li>
      <li><a href="job.php">Add new Job</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right" style="margin-top: 30px;>
      
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user" sizes="50x50">
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="profile.php">Profile</a></li>
          <li><a href="setting.php">Setting</a></li>
          <li><a href="logout.php">logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
	<div class="container" style="margin-top:100px; height:700px;">	
		<div class="col-sm-12"  style="margin-top: 20px; margin-bottom: 10px;"> 
				<h3 align ="center" style="background-color: #d8fff6">Employer Profile</h3>
				<h4 align ="center"  style="background-color: #d8fff6">Company Detail </h4>
				<div class="col-lg-6">
				<strong>Comapny name:</strong><br>
				<strong>Comapny Address:</strong><br>
				<strong>Company Email id:</strong><br>
				<strong>Company Work:</strong><br>
				<strong>Company logo:</strong><br>
				<strong>Company Hr name:</strong><br>
				<strong>Company logo:</strong><br>
				</div>
				<div class="col-lg-6">

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
					        echo "<div class='col-lg-6'>
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
		</div>
	</div>
 <footer style="background-color: black; height: 100px;"></footer>
</body>
</html>