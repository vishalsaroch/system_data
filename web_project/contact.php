<!DOCTYPE html>
<html>
<head>
	<title>Contact</title>
	<link rel="icon" href="images/ashwani.png" type="image/png">
<meta charset="utf-8">	
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="footer.css">
   <link rel="stylesheet" type="text/css" href="main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript">
  	$(function () {
  $(document).scroll(function () {
	  var $nav = $(".navbar-fixed-top");
	  $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	});
});
  </script>
  <style type="text/css">
  	/*input{
  		margin-top:10px;
  		margin-bottom: 10px;
  	}*/
  </style>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<?php include("nav.php"); ?>
		</div>	
		<div class="container">
			<h1 align="center" style="margin-top: 30px; background-color: black;color: white; opacity: 0.5;">Contact Us</h1>
			<div class="col-sm-12">
				<div class="col-sm-6" style="margin-top: 30px">
					<p><b>Address :</b>	Rohini, Delhi</p>	
					<p><b>Contact no :</b> 9990458999</p>	
					<p><b>Email  ID :</b> sunder.jangir@gmail.com </p>
					<p><b>Website :</b> cogentsol.in</p>
				</div>
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
					       $name = $_POST['name'];
					       $email = $_POST['email'];
					       $phoneno = $_POST['phoneno'];
					       $location = $_POST['location'];
					       $inquery = $_POST['inquery'];
					        
					 
					     $query = "INSERT INTO `contact` (`name`, `email`, `phoneno`, `location`, `inquery`) VALUES ('".$name."', '".$email."', '".$phoneno."', '".$location."', '".$inquery."')";
					        $run = mysqli_query($conn, $query);
					        if($run){
					           echo "data insurted sucessfully";
					        }else{
					            echo "Error".mysqli-error(conn);
					        }
					    }
					?>
				<div class="col-sm-6" style="margin-top: 30px">
					<form method="post" action="">
						<label style="margin-bottom: 10px;">Name</label>
						<input type="text" name="name"  placeholder="Name" class="form-control" required>
						<label style="margin-bottom: 10px;">Email</label>
						<input type="email" name="email" placeholder="Eamil"  class="form-control" required>
						<label style="margin-bottom: 10px;">Phone No</label>
						<input type="number" name="phoneno"  placeholder="Phone no" class="form-control" required>
						<label style="margin-bottom: 10px;">Location</label>
						<input type="text" name="location"  placeholder="location" class="form-control" required>
						<label style="margin-bottom: 10px;">Inquery</label>
						<textarea class="form-control" name="inquery rows="3"></textarea>
						<input type="submit" name="submit" value="submit" class="btn btn-success" style="width: 100px; margin:10px;" text>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include("footer.php"); ?>
</body>
</html>
