<?php
  $name=$_POST["name"];
  //echo $_POST["name"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Mavy Search</title>
     <link rel="icon" href="images/logo.png" type="image/png">
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">                                   <!-- Templatemo style -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    
  <div class="bg-top navbar-light">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-center align-items-stretch">
    			<div class="col-md-4 d-flex align-items-center py-4">
    				<a class="navbar-brand" href="index.html"><!-- <span class="flaticon-bee mr-1"></span> -->Mavy</a>
    			</div>
	    		<div class="col-lg-8 d-block">
		    		<div class="row d-flex">
					    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
					    	<div class="icon d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
					    	<div class="text d-flex align-items-center">
						    	<span>youremail@email.com</span>
						    </div>
					    </div>
					    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
					    	<div class="icon d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <div class="text d-flex align-items-center">
						    	<span>Call Us: + 1235 2355 98</span>
						    </div>
					    </div>
					    <div class="col-md topper d-flex align-items-center align-items-stretch">
					    	<p class="mb-0 d-flex d-block">
					    		<a href="login1/logout.php" class="btn btn-primary d-flex align-items-center justify-content-center">
					    			<span>Logout</span>
					    		</a>
					    	</p>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menu
                </button>
                <form action="search.php" class="searchform order-lg-last">
                    <div class="form-group d-flex">
                        <input type="text" class="form-control pl-3" placeholder="Search" name="search">
                        <button type="submit" placeholder="" class="form-control search"><span class="ion-ios-search"></span></button>
                    </div>
                </form>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="index.html" class="nav-link pl-0">Home</a></li>
                        <li class="nav-item"><a href="blog.php" class="nav-link">Register</a></li>
                        <li class="nav-item active"><a href="report.php" class="nav-link">Report</a></li>
                        <!-- <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
                        <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- END nav -->
    <?php
	if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dbase1";
	}
	else if($_SERVER['SERVER_NAME']=='arjjsngo.org.in')
	{
		$servername = "sun";
		$username = "arjjsngo_root";
		$password = "rootPWD@#";
		$dbname = "arjjsngo_dbase1";
	}
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      
  }
  
?>
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-xs-center"><br>
      <h2 class="tm-gold-text tm-title text-cecter">महिला आवास विकास योजना</h2>
						<!--<h3>Housing For All (urban)</h3>-->
                    </div>
        <div class="page-wrapper">
        
            <!-- MAIN CONTENT-->
            <!--<div class="main-content">-->
                <div class="section__content section__content--p75">
                    <div class="container-fluid">
                        <div class="row">
                        <?php
                    $sql = "SELECT * FROM form where haadhar='$name'";
                      $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                  ?>
                  <div class="table-responsive">
                  <table class="table table-bordered">
                    <tr class="bg-primary text-light">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Contact No</th>
                      <th>Address</th>
                      <th>Monthly Income</th>
                      <th>Yearly Income</th>
                      <th>Applied Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  <?php
                          while($row = $result->fetch_assoc()) {
                  ?>
                    
                      <tr>
                        <td><?php echo $row["id"] ?></td>
                        <td><?php echo $row["hname"] ?></td>
                        <td><?php echo $row["hmobile"] ?></td>
                        <td><?php echo $row["haddress"] ?></td>
                        <td><?php echo $row["hrent"] ?></td>
                        <td><?php echo $row["hincome"] ?></td>
                        <td><?php echo $row["cdate"] ?></td>
                        <td><?php if ($row["status"]==0) {
                        echo "<div class='bg-warning text-white'>panding</div>";}
                        elseif ($row["status"]==1) {
                          echo "<div class='bg-success text-white'>Accepted</div>";
                        }elseif ($row["status"]==3) {
                          echo "<div class='bg-warning text-white'>Shortlisted</div>";}
                          else{echo "<div class='bg-danger text-white'>Rejected</div>";
                        }
                      ?></td>
                        <td>
                       <form action="ustatus.php" method="post">
                       <input type="text" name="inid" style="display: none;" value='<?php echo $row["id"];?>'>
                        <select name="status" onchange="submitForm(this)" value='<?php if ($row["status"]==0) {
                        echo "<div class='bg-warning text-white'>panding</div>";}
                        elseif ($row["status"]==1) {
                          echo "<div class='bg-success text-white'>Selected</div>";
                        }else {
                          echo "<div class='bg-danger text-white'>Rejected</div>";
                        }
                      ?>'>
                            <option value="0" class="bg-primary text-white">Choose</option>
                            <option value="1">Selected</option>
                            <option value="2">Rejected</option>
                            <option value="3">Short Listed</option>
                        </select> 
                    </form>


                     <script>
                        function submitForm(elem) {
                            if (elem.value) {
                                elem.form.submit();
                            }
                        }
                    </script>
                     </td>

                      </tr>


                      
                    <?php
                      }
                      echo "</table>";
                    } else {
                      echo "no result found";
                    }
                  ?>
                                            
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>

                        
                    </div>
                </div>
            </div>
        </div>
   
        <footer class="ftco-footer ftco-bg-dark" style="padding-bottom:-20px; ">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-5">
              <h2 class="ftco-heading-2 logo">महिला आवास विकास योजना</h2>
              <p>अब हर महिला के नाम पर होगा अपना घर, अपनी जमीन इस योजना का निर्माण समाज में महिलाओं के सम्मान,महिलाओं के औदे को ऊंचा उठाने और महिलाओं को असह्याय या बेसहारा न समझने के लिए किया गया है। </p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
            
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-5 ml-md-4">
              <h2 class="ftco-heading-2">Services</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Construction</a></li>
                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Renovation</a></li>
                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Painting</a></li>
                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Interior Design</a></li>
                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Exterior Design</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-5">
            <div class="ftco-footer-widget mb-5">
              <h2 class="ftco-heading-2">Recent Blog</h2>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> Feb. 07, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
              <div class="block-21 mb-5 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> Feb. 07, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="col-md">
            <div class="ftco-footer-widget mb-5">
            	<h2 class="ftco-heading-2">Newsletter</h2>
              <form action="#" class="subscribe-form">
                <div class="form-group">
                  <input type="text" class="form-control mb-2 text-center" placeholder="Enter email address">
                  <input type="submit" value="Subscribe" class="form-control submit px-3">
                </div>
              </form>
            </div>
          </div> -->
          <div class="col-md-12 text-center">
          	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  					Copyright &copy;<script>document.write(new Date().getFullYear());</script> | Design And Developed by <a href="https://rws.realkeeper.in" target="_blank">Realkeeper Technologies</a>
  					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
  				</div>
    </footer>

      
    
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
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>