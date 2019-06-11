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

	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
    $(function() {
		$("#theForm").submit(function(){	
			var data = "name="+document.getElementById("name").value+"&activities="+document.getElementById("activities").value+"&destination="+document.getElementById("destination").value+"&date="+document.getElementById("date").value+"&contact="+document.getElementById("contact").value;
			//var str = $(this).serialize();
			
			var urlkey;
			if(location.hostname=='localhost')
			{
				urlkey = "/project1/bookyourtrip.php";
			}
			else if(location.hostname=='www.arkglobalholidays.co.in')
			{
				urlkey = "bookyourtrip.php";
			}
			$.ajax({
				//url: "/home/himalyanfurnitur/public_html/submitcontactusform.php",
				url: urlkey,
				method: "POST",
				data: data,
				success: function(result){alert(result);},
				failure: function(err){alert(err);}
				//alert(result);  the result variable will contain any text echoed by submitcontactusform.php
			});
			return(false);
		});
		
		/*$("#location1").click(function(){	
			var data = "location="+document.getElementById("location1name").innerHTML;
						
			var urlkey;
			if(location.hostname=='localhost')
			{
				urlkey = "/project1/destination.php";
			}
			else if(location.hostname=='himalyanfurniture.com')
			{
				urlkey = "destination.php";
			}
			$.ajax({
				
				url: urlkey,
				method: "POST",
				data: data,
				success: function(result){alert(result);},
				failure: function(err){alert(err);}
				
			});
			return(false);
		});*/
		
	});
</script>
	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><img src="./images/logo1.jpg" alt="logo"></div>
					<!--<div id="gtco-logo"><a href="index.html">ARK Global Holidays</a></div>-->
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="about.html">About Us</a></li>
						<li class="has-dropdown">
							<a href="#">Packages</a>
							<ul class="dropdown">
								<li><a href="featured.php">Featured</a></li>
								<li><a href="domestic.php">Domestic</a></li>
								<li><a href="international.php">Internation</a></li>
								
							</ul>
						</li>
						<li><a href="destinations.php">Destinations</a></li>
						<li><a href="https://arkglobalholidays.co.in/blog">Blogs</a></li>
						<li><a href="contact.html">Contact Us</a></li>
					</ul>	
				</div>
			</div>
			
		</div>
	</nav>
	
	<?php
		if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dbase1";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	}
	else if($_SERVER['SERVER_NAME']=='www.arkglobalholidays.co.in')
	{
		$servername = "sun";
		$username = "arkgloba_root";
		$password = "rootPWD@#";
		$dbname = "arkgloba_dbase1";
							
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		//echo "Connected successfully";
	}
	$fn ='';
	$sql= "select * from bannerimages";
	$result = $conn->query($sql);

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "No banner image exist in database!";
    //header("location: error.php");
	//$conn->close();
}
else { 
    
	while($row = $result->fetch_assoc()) {
       
		$fn=$row["filename"];
		//$conn->close();
		
		//echo $fn;
		}
    }
	
	?>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/<?= $fn ?>); height:700px;">
	<!--<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/home_wallpaper.jpg)">-->
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					

					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<h1 style="margin-top:-150px;">Planing Trip To Anywhere in The World?</h1>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap" style="top: -100px; left: -70%; width: 200%;">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3>Book Your Trip</h3>
											<form action="" method="POST" id="theForm" >
													<div class="col-md-6">
														Your Name<input  type="text" id="name" class="form-control">
													</div>
													<div class="col-md-6" >
														Contact number<input type="number" id="contact" class="form-control" required>
													</div><br><br><br><br>
													<div class="col-md-6">
														Number of Persons														<input  type="number" id="activities" class="form-control">
													</div>
													<div class="col-md-6" >
														Destination<input type="text" id="destination" class="form-control">
													</div><br><br><br><br>
													<div class="col-md-6" >
														Date Travel<input type="date" id="date" class="form-control">
													</div>
													
													<div class="col-md-6" style="margin-top:30px;">
														<input type="submit" class="btn btn-primary btn-block" value="Submit">
													</div>



												
												
												<div class="row form-group">
													
												</div>
											</form>	
										</div>

										
									</div>
								</div>
							</div>
						</div>
					</div>
							
					
				</div>
			</div>
		</div>
	</header>
	
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Most Popular Destinations</h2>
					<p>Here are the world's most popular places you would like to go. Please select a location you will like to go.</p>
				</div>
			</div>
			<div class="row">

				<div class="col-lg-4 col-md-4 col-sm-6">
					<form action="destination.php" method="POST" class="fh5co-card-item">
						<figure>
							<a href="images/delhi.jpg" class="fh5co-card-item image-popup"><img src="images/delhi.jpg" alt="Image" class="img-responsive"></a>
						</figure>
						<div class="fh5co-text">
							<h2>Delhi</h2>
							
							<p>Delhi now belonged to everyone who lived in it. But no one belonged to Delhi..</p>
							<input type="text" id="loc1" name="location" value="Delhi" style="display: none;">
							<input type="submit" value="Explore" class="btn btn-primary">
						</div>
					</form>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<form action="destination.php" method="POST" class="fh5co-card-item">
						<figure>
							<a href="images/mumbai.jpg" class="fh5co-card-item image-popup"><img src="images/mumbai.jpg" alt="Image" class="img-responsive"></a>
						</figure>
						<div class="fh5co-text">
							<h2>Mumbai</h2>
							
							<p>Mumbai may not be my city. But it is my kind of city..</p>
							<input type="text" id="loc2" name="location" value="Mumbai" style="display: none;">
							<input type="submit" value="Explore" class="btn btn-primary">
						</div>
					</form>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<form action="destination.php" method="POST" class="fh5co-card-item">
						<figure>
							<a href="images/uttarakhand.jpg" class="fh5co-card-item image-popup"><img src="images/uttarakhand.jpg" alt="Image" class="img-responsive"></a>
						</figure>
						<div class="fh5co-text">
							<h2>Uttarakhand</h2>
							
							<p>Uttarakhand : Dev Bhoomi : The Land of gods..</p>
							<input type="text" id="loc3" name="location" value="Uttarakhand" style="display: none;">
							<input type="submit" value="Explore" class="btn btn-primary">
						</div>
					</form>
				</div>


				<div class="col-lg-4 col-md-4 col-sm-6">
					<form action="destination.php" method="POST" class="fh5co-card-item">
						<figure>
							<a href="images/jammukashmir.jpg" class="fh5co-card-item image-popup"><img src="images/jammukashmir.jpg" alt="Image" class="img-responsive"></a>
						</figure>
						<div class="fh5co-text">
							<h2>Jammu & Kashmir</h2>
							
							<p>If there is heaven on earth, it is here, it is here, it is here..</p>
							<input type="text" id="loc4" name="location" value="jammuKashmir" style="display: none;">
							<input type="submit" value="Explore" class="btn btn-primary">
						</div>
					</form>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6">
					<form action="destination.php" method="POST" class="fh5co-card-item">
						<figure>
							<a href="images/kerala.jpg" class="fh5co-card-item image-popup"><img src="images/kerala.jpg" alt="Image" class="img-responsive"></a>
						</figure>
						<div class="fh5co-text">
							<h2>Kerala</h2>
							
							<p>In every walk with nature one receives far more than he seeks..</p>
							<input type="text" id="loc5" name="location" value="Kerala" style="display: none;">
							<input type="submit" value="Explore" class="btn btn-primary">
						</div>
					</form>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6">
					<form action="destination.php" method="POST" class="fh5co-card-item">
						<figure>
							<a href="images/rajasthan.jpg" class="fh5co-card-item image-popup"><img src="images/rajasthan.jpg" alt="Image" class="img-responsive"></a>
						</figure>
						<div class="fh5co-text">
							<h2>Rajasthan</h2>
							
							<p>The dessert has its holiness of silence, the crowd its holiness of conversation..</p>
							<input type="text" id="loc6" name="location" value="Rajasthan" style="display: none;">
							<input type="submit" value="Explore" class="btn btn-primary">
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
	
	<div id="gtco-features">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2>How It Works</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i>1</i>
						</span>
						<h3>Lorem ipsum dolor sit amet</h3>
						<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i>2</i>
						</span>
						<h3>Consectetur adipisicing elit</h3>
						<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i>3</i>
						</span>
						<h3>Dignissimos asperiores vitae</h3>
						<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
					</div>
				</div>
				

			</div>
		</div>
	</div>


	<div class="gtco-cover gtco-cover-sm" style="background-image: url(images/img_bg_1.jpg)"  data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container text-center">
			<div class="display-t">
				<div class="display-tc">
					<h1>We have high quality services that you will surely love!</h1>
				</div>	
			</div>
		</div>
	</div>

	<div id="gtco-counter" class="gtco-section">
		<div class="gtco-container">

			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2>Our Success</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
				</div>
			</div>

			<div class="row">
				
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="196" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Destination</span>

					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="97" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Hotels</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="12402" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Travelers</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="12202" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Happy Customer</span>

					</div>
				</div>
					
			</div>
		</div>
	</div>

	

	<div id="gtco-subscribe">
		<div class="gtco-container">
		<div class="row">
					<?php
						if($_SERVER['SERVER_NAME']=='localhost')
						{
							$servername = "localhost";
							$username = "root";
							$password = "";
							$dbname = "dbase1";	
						}
						else if($_SERVER['SERVER_NAME']=='www.arkglobalholidays.co.in')
						{
							$servername = "sun";
							$username = "arkgloba_root";
							$password = "rootPWD@#";
							$dbname = "arkgloba_dbase1";
						}
						

							$conn = new mysqli($servername, $username, $password, $dbname);
							if ($conn->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							}
							
					$sql = "SELECT packageName, image, packageDurationNight, packageDurationDay, destination1, destination2, destination3, destination4, destination5, destination6, destination7, destination8, destination9, destination10, packageCost from packages where featured=1";
					$result = $conn->query($sql);

							if($result->num_rows>0){
										$i = 1;		
								while($row = $result->fetch_assoc()){
									
									echo "
									<div class='col-lg-4 col-md-4 col-sm-6'>
									<div class='fh5co-card-item'>
										<form action='destinationitem.php' method='POST' style='display: inline;'>
											<figure>
												<a href='data:image/jpeg;base64,".base64_encode($row['image'])."' class='fh5co-card-item image-popup'><img src='data:image/jpeg;base64,".base64_encode($row['image'])."' alt='Image' class='img-responsive'></a>
											</figure>
											<div class='fh5co-text' style='display: inline;'>
												<h2 id='packagename".$i."'>".$row['packageName']."</h2>
												<p><b>".$row['packageDurationNight']." Night/".$row['packageDurationDay']." Days</b><br>
												".$row['destination1']." ".$row['destination2']." ".$row['destination3']." ".$row['destination4']." ".$row['destination5']." ".$row['destination6']." ".$row['destination7']." ".$row['destination8']." ".$row['destination9']." ".$row['destination10']." <br>
												<b>Price (Starts from) :</b> ".$row['packageCost']."</p>
												<input type='text' id='pack".$i."' name='packname' style='display: none;'>
												<input type='submit' value='View Details' class='btn btn-primary' style='width:100%'>
													
											</div>
										</form>
										<form id='orderpackage' action='orderpackage.php' method='POST'  style='display: inline;'>
												<input type='text' id='packk".$i."' name='packname' style='display: none;'>
												<input type='submit' value='Book Tour' class='btn btn-primary' style='width:100%'>
										</form>
									</div>
									</div>
									<script>
										document.getElementById('pack".$i."').value=document.getElementById('packagename".$i."').innerHTML;
										document.getElementById('packk".$i."').value=document.getElementById('packagename".$i."').innerHTML;
									</script>";
								++$i;
								if($i==4)
								break;
								}
							} 
							else {
									echo "0 results";
							}
					$conn->close();
					?>
				
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
						<h3>Domestic Destination</h3>
						<ul class="gtco-footer-links">
							<li><a href="#">Delhi</a></li>
							<li><a href="#">Mumbai</a></li>
							<li><a href="#">Rajasthan</a></li>
							<li><a href="#">Shilma</a></li>
							<li><a href="#">Kerala</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-2 col-md-push-1">
					<div class="gtco-widget">
						<h3>Internation Destination</h3>
						<ul class="gtco-footer-links">
							<li><a href="#">Europe</a></li>
							<li><a href="#">Australia</a></li>
							<li><a href="#">Asia</a></li>
							<li><a href="#">Canada</a></li>
							<li><a href="#">Dubai</a></li>
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
						<small class="block">&copy; ARK Global Holidays. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="https://www.realkeeper.in" target="_blank">realkeeper.in</a> </small>
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
	
	<script>
	/*	document.getElementById("loc1").value=document.getElementById("location1name").innerHTML;
		document.getElementById("loc2").value=document.getElementById("location2name").innerHTML;
		document.getElementById("loc3").value=document.getElementById("location3name").innerHTML;
		document.getElementById("loc4").value=document.getElementById("location4name").innerHTML;
		document.getElementById("loc5").value=document.getElementById("location5name").innerHTML;
		document.getElementById("loc6").value=document.getElementById("location6name").innerHTML;*/
	</script>
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

