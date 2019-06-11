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
	<script type="text/javascript">
  	$(function () {
  $(document).scroll(function () {
	  var $nav = $(".navbar-fixed-top");
	  $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	});
});
  </script>
</head>
<body>
	<div class="wrapper">
		<div class="header">
		<?php include("nav.php"); ?>
		<div class="container">
				<h1 style="color: red;  margin-top:150px;" align="center">Welcome to the World of Opportunities </h1>
				<div class="col-sm-12" style=" height:auto;  opacity: 0.9;">
					<form action="emp.php" method="post">
						<input type="text" name="skill" placeholder="Company /Job Title/Key Skills" style="width: 330px; float: left;  height:50px; font-weight: bold; padding-left:10px; margin-top: 25px;">
						<input type="text" name="skill" placeholder="Select Categary" style="width: 330px; float: left;  height:50px; font-weight: bold; padding-left:10px; margin-top: 25px;">
						<input type="text" name="skill" placeholder="Location" style="width: 330px; float: left;  height:50px; font-weight: bold; padding-left:10px; margin-top: 25px;">
						<input type="submit" name="search" value="Search" style="width: 100px; float: left; background-color: orange; height:50px; font-weight: bold; margin-top: 25px;">
					</form>
				</div>
			</div> 
		</div>
	</div> 
	<div class="container-fluid" style="background-color: black">
		<marquee>
			<img src="images/company/13.png">
			<img src="images/company/14.png">
			<img src="images/company/17.png">
			<img src="images/company/19.png">
			<img src="images/company/21.png">
			<img src="images/company/23.png">
			<img src="images/company/24.png">
			<img src="images/company/25.png">
			<img src="images/company/32.png">
			<img src="images/company/41.png">
		</marquee>
	</div>

	<div class="container-fluid" >

		<div class="col-sm-12" style="border:1px solid gray; margin-bottom:20px; margin-top: 20px; padding-bottom: 10px;">
			<div class="col-sm-12" style="margin: 10px 10px 10px 0; background-color: gray">
				<h4 style="color:blue; margin-left: 70px;">Job by Industory</h4>
			</div>
			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/IT.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">IT & Telecom </a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/bpo_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">BPO/KPO </a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/manufacturing_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">manufacturing </a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/retail.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">retail </a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/automobile_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">automobile_icon </a>
				</div>
			</div>

			<div class="col-sm-2" align="center"">
				<div class="image">
					<a href="#"><img src="images/Industry/finance_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">IT & Telecom </a>
				</div>
			</div>
		<!-- </div>

		<div class="col-sm-12" style="margin-top: 10px"> -->
			
			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/Hospitality_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">Hospitality </a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/Education_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">Education </a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/Logistics_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">Logistics </a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/PowerEnergy_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">PowerEnergy </a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/Textile_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">Textile </a>
				</div>
			</div>

			<div class="col-sm-2" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/Electrical_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">Electrical </a>
				</div>
			</div>
		</div>

		<div class="col-sm-12" style="border:1px solid gray; margin-top:10px; margin-bottom:20px; padding-bottom: 10px;">
			<div class="col-sm-12" style="margin: 10px 10px 10px 0; background-color: gray">
				<h4 style="color:blue; margin-left: 70px;">Job by Location</h4>
			</div>

			<div class="col-sm-2" align="center" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/Hospitality_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">Delhi </a>
				</div>
			</div>

			<div class="col-sm-2" align="center" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/Education_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">Chandigarh </a>
				</div>
			</div>

			<div class="col-sm-2" align="center" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/Logistics_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">Hadrabad </a>
				</div>
			</div>

			<div class="col-sm-2" align="center" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/PowerEnergy_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">Banglore </a>
				</div>
			</div>

			<div class="col-sm-2" align="center" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/Textile_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">Kolkata </a>
				</div>
			</div>

			<div class="col-sm-2" align="center" align="center">
				<div class="image">
					<a href="#"><img src="images/Industry/Electrical_icon.png" style="height: 70px; width: 70px;"></a>
				</div>
				<div class="text">
					<a href="#">Kota </a>
				</div>
			</div>
		</div>

	</div>
	<!-- Footer -->
	<section id="footer">
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Quick links</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Home</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>About</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Videos</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Quick links</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Home</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>About</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Videos</a></li>
					</ul>
				</div>
				 <div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Social Media links</h5>
					<ul class="list-unstyled list-inline social text-center">
						<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-facebook"></i></a></li><br>
						<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-twitter"></i></a></li><br>
						<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-instagram"></i></a></li><br>
						<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-google-plus"></i></a></li><br>
						
					</ul>
				</div>
			</div>
			<div class="col-sm-12 text-center">
				<b>Realkpper Technology.</b><br>
				<b>Copyright ©2018 - Vision India Services Pvt Ltd - All rights Reserved.</b>
			</div>
		</div>	
	</section>	
	
</body>
</html>
