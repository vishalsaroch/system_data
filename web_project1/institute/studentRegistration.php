<?php
if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "institute";
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

		if(isset($_POST['register'])){
		   $fname = $_POST['fname'];
		   $lname = $_POST['lname'];
		   $fathername = $_POST['fathername'];
		   $mname = $_POST['mname'];
		   $dob = $_POST['dob'];
		   $gender = $_POST['gender'];
		   $email = $_POST['email'];
		   $mobileno = $_POST['mobileno'];
		   // $date = date("Y/m/d"); 
		$sql = "INSERT INTO `student` (`fname`, `lname`, `fathername`, `mothername`, `dob`, `gender`, `emailid`, `mobileno`) VALUES ('$fname', '$lname', '$fathername', '$mname', '$dob', '$gender', '$email' , '$mobileno')";

    // $sql = "UPDATE `student` SET `address`='".$address."',`state`='".$state."', `industory`='".$industry."' , `product`='".$product."', `Statutory`='".$Statutory."', `date`='".$date."' WHERE `userid`='".$_SESSION['email']."';";
   $run = mysqli_query($conn, $sql);
    if ($run) {
      echo "<p>Student Admit Successfully</p>";
      } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title> Stuent Registration</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<h1>Student registration form</h1>
	<form  method="post" action="">
	<div class="row">
		<div class="col-md-6">
			<label>First Name</label>
			<input type="text" name="fname" class="form-control" required>
			<label>Father Name</label>
			<input type="text" name="fathername" class="form-control" required>
			<label>Gender</label><br>
			<input type="radio" name="gender" value="Male" ><label>Male</label>
			<input type="radio" name="gender" value="Female" ><label>Female</label><br>
			<label>Emailid</label>
			<input type="email" name="email" class="form-control" required>

		</div>
	
		<div class="col-md-6">
			<label>Last name</label>
			<input type="text" name="lname" class="form-control" required>
			<label>Mother Name</label>
			<input type="text" name="mname" class="form-control" required>
			<label>DOB</label>
			<input type="date" name="dob" class="form-control" required>
			<label>Mobile Number</label>
			<input type="number" name="mobileno"  maxlength="10" minlength="10" class="form-control" required>
			<input type="submit" name="register" value="Register" class="btn btn-info">

		</div>
	</div>
	</form>
</div>
</body>
</html>