<?php
$p=$_POST['packname'];
?>
<!DOCTYPE HTML>

<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ARK Global Holidays</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Planning a trip anywhere in world? Come here to us." />
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	
	 <link rel="icon" href="favicon.ico" type="image/gif/ico" sizes="16x16">

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ARK Global Holidays: Destinations</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by GetTemplates.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="GetTemplates.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index.html">Traveler <em>.</em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li class="has-dropdown">
							<a href="destination.html">Destinations</a>
							<ul class="dropdown">
								<li><a href="destination.html">Europe</a></li>
								<li><a href="destination.html">Asia</a></li>
								<li><a href="destination.html">America</a></li>
								<li><a href="destination.html">Canada</a></li>
							</ul>
						</li>
						<li><a href="packages.html">Packages</a></li>
						<li class="has-dropdown">
							<a href="#">Car Tariff</a>
							<ul class="dropdown">
								<li><a href="#">Platinum</a></li>
								<li><a href="#">Gold</a></li>
								<li><a href="#">Silver</a></li>
								<li><a href="#">grafite</a></li>
							</ul>
						</li>
						<li><a href="contact.html">Contact Us</a></li>
					</ul>		
				</div>
			</div>
			
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/banner1.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="row row-mt-15em">

						<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
							<h1><?=$p?></h1>	
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
	</header>
	
	<div class="gtco-section">
		<div class="gtco-container">
			
			
<?php
	if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dbase1";	
	}
	else if($_SERVER['SERVER_NAME']=='himalyanfurniture.com')
	{
		$servername = "sun";
		$username = "himalyan_root";
		$password = "rootPWD@#";
		$dbname = "himalyan_dbase1";
	}
	

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
$sql = "SELECT * from packages where packageName='".$p."'";
$result = $conn->query($sql);

		if($result->num_rows>0){
						
			while($row = $result->fetch_assoc()){
				echo "
					<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-8'>
							<p style='margin-top:10px;'><b>Duration : </b>".$row['packageDurationNight']." Night / ".$row['packageDurationDay']." Days<br>
							<b>Validity : </b>".$row['packageValidity']."<br>
							<b>Destination Covered : </b>".$row['destination1']." ".$row['destination2']." ".$row['destination3']." ".$row['destination4']." ".$row['destination5']." ".$row['destination6']." ".$row['destination7']." ".$row['destination8']." ".$row['destination9']." ".$row['destination10']."<br>
							<b>Price (Starting From) : </b>".$row['packageCost']."</p>
							<form id='orderpackage' action='orderpackage.php' method='POST'  style='display: inline;'>
								<input type='text' id='packkk1' name='packname' style='display: none;'>
								<input type='submit' value='Book Tour' class='btn btn-primary'>
							</form><br><br>
						</div>
						<div class='col-sm-4'>
							<img src='data:image/jpeg;base64,".base64_encode($row['image'])."' alt='Image' class='img-responsive' style='margin-top: 15px'>
						</div>
					</div><br>
					<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12' style='background-color: rgb(9, 198, 171);'>
							<h3 style='margin-top:10px;margin-bottom:10px;'>Your Itinerary</h3>
						</div>
					</div>
					";
				if($row['itineraryh1'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 1 : </b></span><b>".$row["itineraryh1"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd1"]."</p>
						</div>
					</div>";
					if($row['itineraryh2'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 2 : </b></span><b>".$row["itineraryh2"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd2"]."</p>
						</div>
					</div>";
					if($row['itineraryh3'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 3 : </b></span><b>".$row["itineraryh3"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd3"]."</p>
						</div>
					</div>";
					if($row['itineraryh4'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 4 : </b></span><b>".$row["itineraryh4"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd4"]."</p>
						</div>
					</div>";
					if($row['itineraryh5'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 5 : </b></span><b>".$row["itineraryh5"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd5"]."</p>
						</div>
					</div>";
					if($row['itineraryh6'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 6 : </b></span><b>".$row["itineraryh6"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd6"]."</p>
						</div>
					</div>";
					if($row['itineraryh7'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 7 : </b></span><b>".$row["itineraryh7"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd7"]."</p>
						</div>
					</div>";
					if($row['itineraryh8'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 8 : </b></span><b>".$row["itineraryh8"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd8"]."</p>
						</div>
					</div>";
					if($row['itineraryh9'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 9 : </b></span><b>".$row["itineraryh9"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd9"]."</p>
						</div>
					</div>";
					if($row['itineraryh10'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 10 : </b></span><b>".$row["itineraryh10"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd10"]."</p>
						</div>
					</div>";
					if($row['itineraryh11'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 11 : </b></span><b>".$row["itineraryh11"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd11"]."</p>
						</div>
					</div>";
					if($row['itineraryh12'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 12 : </b></span><b>".$row["itineraryh12"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd12"]."</p>
						</div>
					</div>";
					if($row['itineraryh13'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 13 : </b></span><b>".$row["itineraryh13"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd13"]."</p>
						</div>
					</div>";
					if($row['itineraryh14'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 14 : </b></span><b>".$row["itineraryh14"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd14"]."</p>
						</div>
					</div>";
					if($row['itineraryh15'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 15 : </b></span><b>".$row["itineraryh15"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd15"]."</p>
						</div>
					</div>";
					if($row['itineraryh16'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 16 : </b></span><b>".$row["itineraryh16"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd16"]."</p>
						</div>
					</div>";
					if($row['itineraryh17'])
				echo "<div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Day 17 : </b></span><b>".$row["itineraryh17"]."</b><br></p>
							<p style='margin-bottom:10px;'>".$row["itineraryd17"]."</p>
						</div>
					</div>";
					
					if($row['inclusions'])
				echo "<br><div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Inclusions</b></span></p>
							<p style='margin-bottom:10px;'>".$row["inclusions"]."</p>
						</div>
					</div>";
					
					if($row['exclusions'])
				echo "<br><div class='row' style='border: 1px solid grey'>
						<div class='col-sm-12'>
							<p style='margin-top:10px;margin-bottom:5px;'><span style='color:rgb(9, 198, 171);'><b>Exclusions</b></span></p>
							<p style='margin-bottom:10px;'>".$row["exclusions"]."</p>
						</div>
					</div>";
					
					echo "<br><br><form id='orderpackage' action='orderpackage.php' method='POST'  style='display: inline;'>
								<input type='text' id='packkk2' name='packname' style='display: none;'>
								<input style='margin-left:44%;' type='submit' value='Book Tour' class='btn btn-primary'>
							</form><br><br>
							
							<script>document.getElementById('packkk1').value='".$p."';
							document.getElementById('packkk2').value='".$p."';</script>
							";
			}
		} 
		else {
				echo "0 results";
		}
$conn->close();
?>
			
		</div>
	</div>
	
	
				
			
	
	<div id="gtco-subscribe">
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Subscribe</h2>
					<p>Be the first to know about the new templates.</p>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					<form class="form-inline">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label for="email" class="sr-only">Email</label>
								<input type="email" class="form-control" id="email" placeholder="Your Email">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<button type="submit" class="btn btn-default btn-block">Subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container">
			<div class="row row-p	b-md">

				<div class="col-md-4">
					<div class="gtco-widget">
						<h3>About Us</h3>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore eos molestias quod sint ipsum possimus temporibus officia iste perspiciatis consectetur in fugiat repudiandae cum. Totam cupiditate nostrum ut neque ab?</p>
					</div>
				</div>

				<div class="col-md-2 col-md-push-1">
					<div class="gtco-widget">
						<h3>Destination</h3>
						<ul class="gtco-footer-links">
							<li><a href="#">Europe</a></li>
							<li><a href="#">Australia</a></li>
							<li><a href="#">Asia</a></li>
							<li><a href="#">Canada</a></li>
							<li><a href="#">Dubai</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-2 col-md-push-1">
					<div class="gtco-widget">
						<h3>Hotels</h3>
						<ul class="gtco-footer-links">
							<li><a href="#">Luxe Hotel</a></li>
							<li><a href="#">Italy 5 Star hotel</a></li>
							<li><a href="#">Dubai Hotel</a></li>
							<li><a href="#">Deluxe Hotel</a></li>
							<li><a href="#">BoraBora Hotel</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-3 col-md-push-1">
					<div class="gtco-widget">
						<h3>Get In Touch</h3>
						<ul class="gtco-quick-contact">
							<li><a href="#"><i class="icon-phone"></i> +1 234 567 890</a></li>
							<li><a href="#"><i class="icon-mail2"></i> info@GetTemplates.co</a></li>
							<li><a href="#"><i class="icon-chat"></i> Live Chat</a></li>
						</ul>
					</div>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12">
					<p class="pull-left">
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="http://GetTemplates.co/" target="_blank">iamnakulsuryan@gmail.com</a> Demo Images: <a href="http://unsplash.com/" target="_blank">Unsplash</a></small>
					</p>
					<p class="pull-right">
						<ul class="gtco-social-icons pull-right">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer>
	<!-- </div> -->

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>

	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>

	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	
	<!-- Datepicker -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	

	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

