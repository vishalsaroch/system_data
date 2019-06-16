<!DOCTYPE .php>
	<head>
    <title>Student Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
	  <?php include("header.php");?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
      <div class="container d-flex align-items-center">
        <a class="navbar-brand" href="index.php"><img src="images/logo.png" style="height:100px; width:150px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="index.php" class="nav-link pl-0">Home</a></li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              About Us
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="about.php">About Tripro Skill</a>
              <a class="dropdown-item" href="#">Our Leadership Team</a>
              <a class="dropdown-item" href="#">Vision & Mission</a>
              <a class="dropdown-item" href="#">Our Core Team</a>
            </div>
          </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Our Vision
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Skill Development</a>
              <a class="dropdown-item" href="#">CSR</a>
              <a class="dropdown-item" href="#">Paid</a>
            </div>
          </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Partners
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Skill Development</a>
              <a class="dropdown-item" href="#">CSR</a>
              <a class="dropdown-item" href="#">Paid</a>
            </div>
          </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              News Room
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Tripro Marketing Kit</a>
              <a class="dropdown-item" href="#">Press Releases</a>
              <a class="dropdown-item" href="#">Tripro in news</a>
              <a class="dropdown-item" href="about.php">Photo</a>
              <a class="dropdown-item" href="#">Vedio</a>
              <a class="dropdown-item" href="#">Success Story</a>
              <a class="dropdown-item" href="about.php">Reports</a>
              <a class="dropdown-item" href="#">News Letter</a>
            </div>
          </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Career
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Why work with us?</a>
              <a class="dropdown-item" href="#">Current Opening </a>
            </div>
          </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Login
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="admin_login.php">Admin Login</a>
              <a class="dropdown-item" href="center_login.php">Center Login</a>
              <a class="dropdown-item" href="student_login.php">Student Login</a>
              <a class="dropdown-item" href="employer_login.php">Employer Login</a>
            </div>
          </li>
            <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->
    <section class="ftco-section ftco-consult ftco-no-pt ftco-no-pb" style="background-image: url(images/bg_7.jpg); background-size:cover" data-stellar-background-ratio="0.5">
    	<div class="container">
    		<div class="row justify-content-end">
    			<div class="col-md-6 py-5 px-md-5 bg-primary">
	          <div class="heading-section heading-section-white ftco-animate mb-5">
	            <h2 class="mb-4 text-center">Student Login</h2>
	          </div>
	          <form action="#" class="appointment-form ftco-animate">
	    				<div class="d-md-flex">
		    				<div class="form-group">
		    					<input type="text" class="form-control" placeholder="Userid" name="userid">
		    				</div>
		    			</div>
		    			<div class="d-md-flex">
		    				<div class="form-group">
		    					<input type="password" class="form-control" placeholder="password" name="password">
		    				</div>
		    			</div>
	    				<div class="d-md-flex">
			    			<div class="form-group ml-md-4">
		              			<input type="submit" value="Login" class="btn btn-secondary py-3 px-4">
		            		</div>
	    				</div>
	    			</form>
    			</div>
        	</div>
    	</div>
    </section>

    <?php include("footer.php");?>
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
