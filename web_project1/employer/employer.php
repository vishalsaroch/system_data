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
	<div class="container-fluid">
		<header>
			<!-- <img src="images/banner2.jpg" width="1340px"> -->
			<img src="images/logo2.png">
		</header>
	</div>

	<div class="container" style="background-image: url('background.jpg'); background-repeat: no-repeat; background-color: #cccccc;">
		<h1 align="center" style="background-color: black; color:white; opacity: 0.5;">Employer Registration </h1>
		<form action="employer.php" action="post">
			<div class="col-md-12" style="margin-top: 20px">

				<label for="companyname" style="margin-top: 10px; margin-left: 325px;"> Company Name</label>
				<div class="col-md-6" style="margin-top: 10px; margin-left:300px;">
					<input type="text" name="compname" placeholder="Company Name" style="height: 40px; padding-left: 20px; width: 530px;" >
				</div>
				<br>

				<div class="col-md-6" style="margin-left: 300px;">
					<table>
						<tr>
							<td >
								<label style="margin-top: 10px; margin-left: 10px;"> Address</label><br>
								<div class="col-md-3" style="margin-top: 10px; margin-left: -15px;">
									<input type="text" name="compaddr" placeholder="Company Address" style="height: 40px; padding-left: 20px; width:350px" >
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

				<label style="margin-top: 10px; margin-left: 325px;"> Company Contact</label>
				<div class="col-md-6" style="margin-top: 10px; margin-left:300px;">
					<input type="number" name="compcon" placeholder="Company Contact" style="height: 40px; padding-left: 20px; width: 530px;" >
				</div>
				<br>

				<label style="margin-top: 10px; margin-left: 325px;"> Mobile No</label>
				<div class="col-md-6" style="margin-top: 10px; margin-left:300px;">
					<input type="number" name="mobile" placeholder="Mobile Number" style="height: 40px; padding-left: 20px; width: 530px;" >
				</div>
				<br>

				<label style="margin-top: 10px; margin-left: 325px;"> Email</label>
				<div class="col-md-6" style="margin-top: 10px; margin-left:300px;">
					<input type="Email" name="Email" placeholder="Email" style="height: 40px; padding-left: 20px; width: 530px;" >
				</div>
				<br>

				<label style="margin-top: 10px; margin-left: 325px;"> Inductry</label>
				<div class="col-md-6" style="margin-top: 10px; margin-left:300px;">
					<input type="text" name="mobile" placeholder="Industry" style="height: 40px; padding-left: 20px; width: 530px;" >
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
					<input type="submit" value="Sign Up" name="signup" class="btn btn-info" style="margin-left: 450px;">
				</div>

			</div>
		</form>
	</div>
	<footer style="background-color: black; color: white; height: 100px;"></footer>
</body>
</html>