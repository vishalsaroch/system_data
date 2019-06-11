<!DOCTYPE html>
<html>
<head>
	<title>Aboutus</title>
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
		</div>
		<div class="container">
			<h1 align="center" style="margin-top: 30px; background-color: black;color: white; opacity: 0.5;">ABOUT US</h1>
			<p>"Cogent Solutions is a leading Business support services provider, with the aim of providing employment, Payroll, statutory compliance services, cost effective recruitment & manpower solution, by deeply understanding of requirement of our clients across any possible functional area. </p>
 
			<p>We have been providing eminent corporate, with the best professionals to suit every possible manpower requirement and have, in turn, acquired an enviable reputation in India as a leading manpower solution provider. </p>
 
			<p>It’s our commitment to our client to find solution to their problems.</p>  
 
			<p>Essentially, our aim is to delight our clients with our efficient services to providing qualitative manpower to our clients.</p>
		</div>
	</div>
	
<!-- Footer -->
	<?php include("footer.php"); ?>
</body>
</html>
