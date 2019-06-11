<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="footer.css">
   <link rel="stylesheet" type="text/css" href="main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  	input{
  		/*width:20vw;
  		float:left;
  		height:30px;*/
  		margin-bottom:10px;
  		width:100%;
  	}
  </style>
<!-- <script type="text/javascript">
  	$(function () {
  $(document).scroll(function () {
	  var $nav = $(".navbar-fixed-top");
	  $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	});
});
  </script> -->
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<?php include("nav.php"); ?>
			<div class="container">
				<h1 style="color: red;  margin-top:100px;" align="center">Welcome to the World of Opportunities </h1>
				<form action="search.php" method="post" class="form-inline text-center">
					<input type="text" name="Keyword" placeholder="Company /Job Title/Key Skills" class="form-control">
					<input type="text" name="Keyword" placeholder="Select Categary" class="form-control">
					<input type="text" name="Keyword" placeholder="Location" class="form-control">
					<input type="submit" name="search"  class="form-control" style="width100px; background-color: #00bfff; color:#fff">
				</form>
			</div> 
		</div>
	</div> 
	<div class="container-fluid" style="background-color: black">
		<marquee>
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


								// Create connection
								$conn = new mysqli($servername, $username, $password, $dbname);
								// Check connection
								if ($conn->connect_error) {
								    die("Connection failed: " . $conn->connect_error);
								} 

									$sql = "SELECT * FROM employersUsers";

									$result = $conn->query($sql);
									$row = $result->fetch_assoc();
									

									
									if ($result->num_rows > 0) {
									    
									    while($row = $result->fetch_assoc()) {
									        echo "<a href='compjob.php?id=". $row['userid'] ."' title='View Record' data-toggle='tooltip' target='blank'><sapn style='color:#fff; margin:20px; font-size:36px; font-waight:bold;'>". $row["compName"]."</span></b>
										        		
										        		
									        		";

							    }
							   

							}
							
					$conn->close();
					?>
					</div>
				</div>
			<!-- <img src="images/company/13.png">
			<img src="images/company/14.png">
			<img src="images/company/17.png">
			<img src="images/company/19.png">
			<img src="images/company/21.png">
			<img src="images/company/23.png">
			<img src="images/company/24.png">
			<img src="images/company/25.png">
			<img src="images/company/32.png">
			<img src="images/company/41.png"> -->
		</marquee>
	</div>

	<div class="container-fluid">
		<div class="col-sm-12" style="border:1px solid gray; margin-bottom:20px; margin-top: 20px; padding-bottom: 10px;">
			<div class="col-sm-12" style="margin: 10px 10px 10px 0; background-color: gray">
				<h4 style="color:blue; margin-left: 70px;">Job by Industory</h4>
			</div>
			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="industory/jobfilter.php"><img src="images/Industry/IT.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="industory/jobfilter.php">IT & Telecom </a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="industory/bpo.php"><img src="images/Industry/bpo_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="industory/bpo.php">BPO/KPO </a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="industory/manufacturing.php"><img src="images/Industry/manufacturing_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="industory/manufacturing.php">Manufacturing </a>
				</div>
			</div>

			<!-- <div class="col-sm-2" align="center">
				<div class="image">
					<a href="industory/retail.php"><img src="images/Industry/retail.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="industory/retail.php">Retail</a>
				</div>
			</div> -->

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="industory/Automobile.php"><img src="images/Industry/automobile_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="industory/Automobile.php">Automobile_icon </a>
				</div>
			</div>

			<div class="col-sm-2" align="center"">
				<div class="image">
					<a href="industory/finance.php"><img src="images/Industry/finance_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="industory/finance.php">Finance</a>
				</div>
			</div>
			<!-- <div class="col-sm-2" align="center">
				<div class="image">
					<a href="industory/hospital.php"><img src="images/Industry/Hospitality_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="industory/hospital.php">Hospitality </a>
				</div>
			</div> -->

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="industory/education.php"><img src="images/Industry/Education_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="industory/education.php">Education</a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="industory/logistics.php"><img src="images/Industry/Logistics_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="industory/logistics.php">Logistics</a>
				</div>
			</div>

			<!-- <div class="col-sm-2" align="center">
				<div class="image">
					<a href="industory/PowerEnergy.php"><img src="images/Industry/PowerEnergy_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="industory/PowerEnergy.php">PowerEnergy</a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="industory/Textile.php"><img src="images/Industry/Textile_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="industory/Textile.php">Textile </a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="industory/Electrical.php"><img src="images/Industry/Electrical_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="industory/Electrical.php">Electrical </a>
				</div>
			</div> -->
		</div>

		<div class="col-sm-12" style="border:1px solid gray; margin-top:10px; margin-bottom:20px; padding-bottom: 10px;">
			<div class="col-sm-12" style="margin: 10px 10px 10px 0; background-color: gray">
				<h4 style="color:blue; margin-left: 70px;">Job by Location</h4>
			</div>

			<div class="col-sm-2" align="center" align="center">
				<div class="image">
					<a href="location/delhi.php"><img src="images/Location/delhi.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="location/delhi.php">Delhi </a>
				</div>
			</div>

			<div class="col-sm-2" align="center" align="center">
				<div class="image">
					<a href="location/chandigarh.php"><img src="images/Location/ch.jpg" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="location/chandigarh.php">Chandigarh </a>
				</div>
			</div>

			<div class="col-sm-2" align="center" align="center">
				<div class="image">
					<a href="location/hadrabad.php"><img src="images/Location/had.jpg" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="location/hadrabad.php">Hadrabad</a>
				</div>
			</div>

			<div class="col-sm-2" align="center" align="center">
				<div class="image">
					<a href="location/banglore.php"><img src="images/Location/bangalore.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="location/bangalore.php">Banglore </a>
				</div>
			</div>

			<div class="col-sm-2" align="center" align="center">
				<div class="image">
					<a href="location/kolkata.php"><img src="images/Location/kolkata.jpg" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="location/kolkata.php">Kolkata </a>
				</div>
			</div>

			<div class="col-sm-2" align="center" align="center">
				<div class="image">
					<a href="location/kota.php"><img src="images/Location/kota.jpg" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="location/kota.php">Kota </a>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<?php include("footer.php"); ?>
	
</body>
</html>
