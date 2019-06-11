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

// $search = 0;
// $Search = $_POST["Search"]

// $_SESSION["search"]= $row["search"]

// $temp1 = "enabled";
// $temp2 = "enabled";
// $temp3 = "enabled";
// $temp4 = "enabled";
// $temp5 = "enabled";

// if($_SESSION["search"]!=1)
// $temp1 = "disabled";

// if($_SESSION["addjob"]!=1)
// $temp1 = "disabled";

// if($_SESSION["showjob"]!=1)
// $temp1 = "disabled";

// if($_SESSION["excel"]!=1)
// $temp1 = "disabled";

// if($_SESSION["candidate"]!=1)
// $temp1 = "disabled";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashbord</title>
	<link rel="icon" href="images/ashwani.png" type="image/png">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">	
 	h1{
    	color: white;
    	background-color: black;
    	width:300px;
    	opacity: 0.5;
    	margin-left: 300px;
    }
    
    button{
    	color: white;
    	background-color: orange;
    	width:170px;
    	opacity: 0.5;
    	margin-left: 385px;
    }
    th{
    	text-align: center
    }
    tr:hover{
    	background-color: #CFF3FB;
    }
   
    body{
    	background-color: #ffff99
    }
    th{background-color: black; color: white;}
</style>
<script>
	function seeMoreData(element){
		var candidateId=element.childNodes[1].innerHTML;
		alert(candidateId);
		if(location.hostname=='localhost')
			{
				window.open("/web_project/employer/showCandidate.php?id="+candidateId.toString());
			}
			else if(location.hostname=='cogentsol.in')
			{
				window.open("showCandidate.php?id="+candidateId.toString());
			}
	}
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

	<div class="container-fluid" style="background-image: url(images/header.jpg); background-repeat: no-repeat; ">
		<div class="row">
			<!-- <div class="col-lg-12" style="margin-top: 50px; margin-bottom: 50px">
				<h1 ><b>Post a new job</b></h1>
				<h3 style="color: white; background-color: black; width:200px; opacity: 0.5; margin-left: 370px;" align="center">Hire for free </h3>
				<a href="job.php"><button type="button"><font size="4px"> Create a Job</font></button></a>
				<!--  <a href="job.html">Create Job</a>  -->
			<!-- </div> -->
			<!-- <div class="container">
				<div class="row"> -->
				<div class="col-lg-12" style="margin-top: 250px; margin-bottom: 50px">
					<form action='searchpage.php' method='POST'  class="inline-form">
						<div class="col-lg-3">
							<input type="text" name="data" class="form-control" placeholder="Skill">
						</div>
						<div class="col-lg-3">
				 			<input type="text" name="exerience" class="form-control" placeholder="Exerience">
						</div>
						<div class="col-lg-3">
							<input type="text" name="salary" class="form-control" placeholder="salary">
						</div>
						<div class="col-lg-3">
							<input type='submit' name='submit' value='Search A Candidate' class="btn btn-info">
						</div> 
					</form>
			<!-- </div> -->
			</div> 
			


			<div class="col-md-12" style="margin-top: 100px; margin-bottom: 50px;" > 
				<!-- <h3 align ="center">List of  Experienced Candidate.</h3>
				<div class="col-lg-12"> -->
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
							    echo "<table class='table'><tr> <th>Photo</th> <th>Name</th><th>Qualification</th><th>Job Title</th> <th>Experience</th><th><form action='excel.php' class='btn btn-succcss' method post><input type='submit' name='submit' class='btn btn-success' value='Export TO Excel'></form>	</th></tr>";
							    while($row = $result->fetch_assoc()) {
							    	
							        echo "<tr><td> <img src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='100' width='100'/></td> <td style='display:none'>" . $row["userid"]. "</td><td>" . $row["fname"]." " . $row["lname"]. "</td><td> " . $row["qualification"]. "</td> <td> " . $row["jobtitle"]. "</td> <td> " . $row["years"]. "." . $row["months"]. "</td><td><a href='showCandidate.php?id=". $row['userid'] ."' title='View Record' data-toggle='tooltip' target='blank'><span class='glyphicon glyphicon-eye-open' style='color:blue; font-size:30px;'></span></td></tr>";
							    }
							} else {
							    echo "</table>";
							}
							$conn->close();
							?>
							<!-- <form action="excel.php" class="btn btn-succcss" method post>
								<input type="submit" name="export" class="btn btn-success" value="Export TO Excel">
							</form> -->
			<!-- </div>	 -->
		</div>
	</div>
 
</body>
</html>