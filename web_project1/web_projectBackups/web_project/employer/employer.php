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
	<title>Employer Signup</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</head>
<body>
<?php include("nav.php"); ?>
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
		if(isset($_POST['submit'])){

		$address=$_POST['address'];
		// $state=$_POST['state'];
		// $industry=$_POST['industry'];
		// $product=$_POST['product'];
		// $statutory=$_POST['statutory'];
		// $dateNow = date("Y/m/d");
		 $sql = "INSERT INTO `employer` (`address`) VALUES ('$address')";

		// $sql = "INSERT INTO `employer` (`address`, `state`, `industory`, `product`, `Statutory`, `date`) VALUES ('$address', '$state', '$industry', '$product', '$statutory', '$dateNow', '$dateNow')";
		if ($conn->query($sql) === TRUE) {
		    echo "value added to database";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
		}
	?>

	
<!-- <?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button class="btn" type="submit" name="save" >Save</button>
<?php endif ?> -->
		<div class="container" style="background-image: url('background.jpg'); background-repeat: no-repeat; background-color: #cccccc;">
		<h1 align="center" style="background-color: black; color:white; opacity: 0.5;">Employer Registration </h1>
		<form action="" action="post">
			

				<div class="col-md-6" style="margin-left: 300px;">
					<table>
						<tr>
							<td>
								<label style="margin-top: 10px; margin-left: 10px;"> Address</label><br>
								<div class="col-md-3" style="margin-top: 10px; margin-left: -15px;">
									<input type="text" name="address" placeholder="Company Address" style="height: 40px; padding-left: 20px; width:350px;">
								</div>
							</td>
							<td>
								<label style="margin-top: 10px; margin-left: 10px;" > State</label><br>
								<div class="col-md-3" style="margin-top: 10px; ">
									<input type="text" name="state" placeholder="State" style="height: 40px; padding-left: 20px; width:150px" >
								</div>
							</td>
						</tr>
					</table>
				</div>
				<br>

				<label style="margin-top: 10px; margin-left: 325px;"> Inductry</label>
				<div class="col-md-6" style="margin-top: 10px; margin-left:300px;">
					<input type="text" name="industry" placeholder="Industry" style="height: 40px; padding-left: 20px; width: 530px;" >
				</div>
				<br>

				<label style="margin-top: 10px; margin-left: 325px;"> Product/Services</label>
				<div class="col-md-6" style="margin-top: 10px; margin-left:300px;">
					<input type="text" name="product" placeholder="Product/Services" style="height: 40px; padding-left: 20px; width: 530px;" >
				</div>
				<br>

				<label style="margin-top: 10px; margin-left: 325px;"> Statutory Compliance alert</label>
				<div class="col-md-6" style="margin-top: 10px; margin-left:300px;">
					<input type="text" name="statutory" placeholder="Statutory Compliance alert" style="height: 40px; padding-left: 20px; width: 530px;" >
				</div>
				<br>
				<div class="col-md-6" style="margin-top: 10px; margin-left:300px; margin-bottom: 20px;" >
					<input type="submit" value="update" name="submit" class="btn btn-info" style="margin-left: 450px;">
				</div>

			</div>
		</form>
	</div>
	<footer style="background-color: black; color: white; height: 100px;"></footer>
</body>
</html>