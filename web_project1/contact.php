<meta charset="utf-8">	
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <style type="text/css">
  	input{
  		margin-top:10px;
  		margin-bottom: 10px;
  	}
  </style>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<nav class="navbar-headerbar  navbar-fixed-top">                                                                                   
			   <div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>                        
			      </button>
			      <a class="navbar-brand" href="index.html"><img src="images/ashwani.png" style="margin-top: -20px;"></a>
				    </div>
				    <div class="collapse navbar-collapse" id="myNavbar">
				      <ul class="nav navbar-nav navbar-right">
				        <li class="active"><a href="index.html"><span class="glyphicon glyphicon-home"></span> Home </a></li>
				               <li><a href="aboutus.html">About Company</a></li>
				              <li class="dropdown">
				                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Services<span class="caret"></span></a>
				                <ul class="dropdown-menu">
				                  <li><a href="payroll.html">Payroll & Statutory Compliance</a></li>
				                  <li><a href="requirment.html">Recruitment & Staffing</a></li>
				                  <li><a href="training.html">Training</a></li>
				                </ul>
				              </li>
				          <li><a href="contact.php">Contact </a></li>
				          <li><a href=".\candidate\as.html">Sign Up </a></li>
				          <li><a href=".\employer\EmployerSignup.html">Employer Zone </a></li>				          
				      </ul>
				    </div>
				  </div>
				</nav>
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
					<div class="col-sm-12" >
						<label style="margin-bottom: 10px;">Name</label>
						<input type="text" name="name"  placeholder="Name" class="form-control" required>
					</div>


					<div class="col-sm-12" >
						<label style="margin-bottom: 10px;">Email</label>
						<input type="email" name="email" placeholder="Eamil"  class="form-control" required>
					</div>

					<div class="col-sm-12" >
						<label style="margin-bottom: 10px;">Phone No</label>
						<input type="number" name="phoneno"  placeholder="Phone no" class="form-control" required>
					</div>
					<div class="col-sm-12">
						<label style="margin-bottom: 10px;">Location</label>
						<input type="text" name="location"  placeholder="location" class="form-control" required>
					</div>
					<div class="col-sm-12">
						<label style="margin-bottom: 10px;">Inquery</label>
						<textarea class="form-control" name="inquery" rows="3"></textarea>
					</div>
					<div class="col-sm-12" >
						<input type="submit" name="submit" value="submit" class="btn btn-success" style="width: 100px; margin-left: 400px;">
					</div>

				</form>
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
					<h5>Quick links</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Home</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>About</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
						<li><a href="https://wwwe.sunlimetech.com" title="Design and developed by"><i class="fa fa-angle-double-right"></i>Imprint</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
					<ul class="list-unstyled list-inline social text-center">
						<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-facebook"></i></a></li>
						<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-google-plus"></i></a></li>
						<li class="list-inline-item"><a href="javascript:void();" target="_blank"><i class="fa fa-envelope"></i></a></li>
					</ul>
				</div>
				</hr>
			</div>	
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
					<p><u><a href="https://www.nationaltransaction.com/">National Transaction Corporation</a></u> is a Registered MSP/ISO of Elavon, Inc. Georgia [a wholly owned subsidiary of U.S. Bancorp, Minneapolis, MN]</p>
					<p class="h6">&copy All right Reversed.<a class="text-green ml-2" href="https://www.sunlimetech.com" target="_blank">Sunlimetech</a></p>
				</div>
				</hr>
			</div>	
		</div>
	</section>
	<!-- ./Footer -->
</body>
</html>
