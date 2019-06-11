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
	<title>Dashbord</title>
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
<nav class="navbar navbar " style="height: 100px; background-color: black; color: white;">
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
          <li><a href="../login/logout.php">logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
	<div class="container" style="background-image: url(images/header.jpg); background-repeat: no-repeat;margin-left: 100px">
		<div class="row">
			<div class="col-sm-12" style="margin-top: 50px; margin-bottom: 50px">
				<h1 ><b>Post a new job</b></h1>
				<h3 style="color: white; background-color: black; width:200px; opacity: 0.5; margin-left: 370px;" align="center">Hire for free </h3>
				<a href="job.php"><button type="button"><font size="4px"> Create a Job</font></button></a>
				<!--  <a href="job.html">Create Job</a>  -->
			</div>
			<div class="col-sm-12"  style="margin-top: 10px; margin-bottom: 50px"> 
				<div class="col-sm-5" >	
						<label style="color:orange; margin-left: 30px;"><b> Skill</b></label>
						<input type="text" name="where" class="form-control " placeholder="Job Title, Keywords, or Company.">
				</div>

				<div class="col-sm-5" >						
						<label style="color: orange; margin-left: 30px;"><b> Qualifaction</b></label>
						<input type="text" name="where" class="form-control" placeholder="City, State, Pin-code.">
				</div>
				<div class="col-sm-2" >
					<a class="btn btn-info" style="margin-left: 30px; margin-top: 25px;">Find aCandidate</a>
					<!-- <a href="job.html"><button type="button"><font size="4px"> Find Job</font></button></a> -->
				</div>
			</div>


			<div class="col-sm-12"  > 
				<h3 align ="center" style="margin-top: 100px; margin-bottom: 50px;">List of  Experienced Candidate.</h3>
				<div class="col-lg-12">
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

							$sql = "SELECT * FROM candidate";

							$result = $conn->query($sql);
						if ($result->num_rows > 0) {
					    echo "<table class='table ' ><tr> <th>ID</th> <th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
					    while($row = $result->fetch_assoc()) {
					    	if($row["sno"]<10)
					        echo "<tr> <td> 0000" . $row["sno"]. "</td> <td> " . $row["fname"]. "</td> <td> " . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["qualification"]. "</td><td><a href='#'>See More...</a></td></tr>";
					    else if($row["sno"]<100)
					        echo "<tr> <td> 000" . $row["sno"]. "</td> <td> " . $row["fname"]. "</td> <td> " . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["qualification"]. "</td><td><a href='#'>See More...</a></td></tr>";
					    else
					        echo "<tr> <td> 00" . $row["sno"]. "</td> <td> " . $row["fname"]. "</td> <td> " . $row["lname"]. "</td> <td> " . $row["emailid"]. "</td> <td> " . $row["mobileno"]. "</td> <td> " . $row["qualification"]. "</td><td><a href='#'>See More...</a></td></tr>";
					    }
					} else {
					    echo "</table>";
					}
					$conn->close();
					?>
			</div>	
		</div>
	</div>
 
</body>
</html>