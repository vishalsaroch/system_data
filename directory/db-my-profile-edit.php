<?php include("config.php");?>
<?php include("user-session.php");?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from rn53themes.net/themes/demo/directory/db-my-profile-edit.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Apr 2019 07:08:20 GMT -->
<head>
	<title>Posttoo</title>
	<!-- META TAGS -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- FAV ICON(BROWSER TAB ICON) -->
	<link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">
	<!-- GOOGLE FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
	<!-- FONTAWESOME ICONS -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- ALL CSS FILES -->
	<link href="css/materialize.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
	<link href="css/responsive.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<div id="preloader">
		<div id="status">&nbsp;</div>
	</div>
	<!--TOP SEARCH SECTION-->
	<?php include("search.php");?>
	<!--DASHBOARD-->
	<?php
		$sql = "SELECT * from user where user.email = '".$_SESSION['email']."';";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
	?>
	<section>
	<?php
	$sql = "SELECT * from user where user.email = '".$_SESSION['email']."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
?>
<div class="tz-l">
				<div class="tz-l-1">
					<ul>
						<li>
							<?php 
								if($row["image"]===""){
									echo "<img class='rounded-circle' src='images/db-profile.jpg'  data-toggle='modal' data-target='#myModal' class='img-rounded'>" ;}
								else
								echo "<img class='rounded-circle' src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='100' width='100px;' data-toggle='modal' data-target='#myModal' class='img-rounded'><br>";
								}
							} else {
							echo "<imgsrc='images/headshot-male.png'height='150' width='150'>";
						}
					}
				}
						?>
					</li>
					<li><b align="center"><?php echo $first_name; ?><b></li>
					</ul>
				</div>
				<div class="tz-l-2">
					<ul>
						<li>
							<a href="dashboard.php" class="tz-lma"><img src="images/icon/dbl1.png" alt="" /> My Dashboard</a>
						</li>
						<li>
							<a href="db-all-listing.php"><img src="images/icon/dbl11.png" alt="" /> All Posted Ads</a>
						</li>
						<li>
							<a href="db-listing-add.php"><img src="images/icon/dbl11.png" alt="" /> Create New Ad</a>
						</li>
						<!-- <li>
							<a href="db-message.php"><img src="images/icon/dbl14.png" alt="" /> Messages(12)</a>
						</li>
						<li>
							<a href="db-review.php"><img src="images/icon/dbl13.png" alt="" /> Reviews(05)</a>
						</li>-->
						<li> 
							<a href="db-my-profile.php"><img src="images/icon/dbl6.png" alt="" /> My Profile</a>
						</li>
						<!-- <li>
							<a href="db-post-ads.php"><img src="images/icon/dbl11.png" alt="" /> Ad Summary</a>
						</li> -->
						<!-- <li>
							<a href="db-payment.php"><img src="images/icon/dbl9.png" alt=""> Check Out</a>
						</li>
						<li>
							<a href="db-invoice-all.php"><img src="images/icon/db21.png" alt="" /> Invoice</a>
						</li>						 -->
						<!-- <li>
							<a href="db-claim.php"><img src="images/icon/dbl7.png" alt="" /> Claim & Refund</a>
						</li>
						<li>
							<a href="db-setting.php"><img src="images/icon/dbl210.png" alt="" /> Setting</a>
						</li> -->
						
						<li>
							<a href="user-login/logout.php"><img src="images/icon/dbl12.png" alt="" /> Log Out</a>
						</li>
					</ul>
				</div>
			</div>
			<!--CENTER SECTION-->
			<?php
				if(isset($_POST['submit'])){
			  	// $photo="";
			 	$name=$_POST['name'];
			 	$email=$_POST['email'];
			 	$password=$_POST['password'];
			 	$mobile=$_POST['mobile'];
			 	$image = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
			    $sql = "UPDATE `user` SET `name`='".$name."', `email`='".$email."', `password`='".$password."', `mobile`='".$mobile."' , `image`='".$image."' WHERE `email`='".$_SESSION['email']."';";
			    $run = mysqli_query($conn, $sql);	
			    if ($run) {
			     
			      echo "Profile Picture Updated Successfully";
			      } else {
			     
			      echo "Error: " . $sql . "<br>" . $conn->error;
			    }
			}
			  
			?>
			<?php
				$sql = "SELECT * from user where user.email = '".$_SESSION['email']."';";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
			?>
			<div class="tz-2">
				<div class="tz-2-com tz-2-main">
					<h4>Profile</h4>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Edit Profile</h2>
							<!-- <p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p> -->
						</div>
						<div class="tz2-form-pay tz2-form-com">
							<form class="col s12" method="post" action="" enctype="multipart/form-data">
								<div class="row">
									<div class="input-field col s12">
										<input type="text" class="validate" value="<?php echo $row["name"]; ?>" name="name">
										<label>User Name</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="password" class="validate" value="<?php echo $row["Password"]; ?>" name="password">
										<label>Enter Password</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="password" class="validate" name="password">
										<label>Confirm Password</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="email" name="email" class="validate" value="<?php echo $row["email"]; ?>">
										<label>Email id</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="number" name="mobile" class="validate" value="<?php echo $row["mobile"]; ?>">
										<label>Phone</label>
									</div>
								</div>
								<!-- <div class="row">
									<div class="input-field col s12">
										<select>
											<option value="" disabled selected>Select Status</option>
											<option value="1">Active</option>
											<option value="2">Non-Active</option>
										</select>
									</div>
								</div> -->
								<!-- <div class="row">
									<div class="input-field col s12">
									<label>Date Of Birth</label>
										<input type="date" class="validate" name="dob">
										
									</div>
								</div> -->
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="fileToUpload">
											 </div>
										<div class="file-path-wrapper">
											<input class="file-path validate" name="fileToUpload" type="text"> </div>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="submit" value="Update" name="submit" class="waves-effect waves-light full-btn"> </div>
								</div>
							</form>
						</div>
						<div class="db-mak-pay-bot">
							<!-- <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters</p> --> <a href="db-setting.php" class="waves-effect waves-light btn-large">Profile Setting</a> </div>
					</div>
				</div>
			</div>
			<?php 
				}
                  } else {
                  echo "user not found";
                  }
            ?>
			<!--RIGHT SECTION-->
			<div class="tz-3">
				<h4>Notifications(18)</h4>
				<ul>
					<li>
						<a href="#!"> <img src="images/icon/dbr1.jpg" alt="" />
							<h5>Joseph, write a review</h5>
							<p>All the Lorem Ipsum generators on the</p>
						</a>
					</li>
					<li>
						<a href="#!"> <img src="images/icon/dbr2.jpg" alt="" />
							<h5>14 New Messages</h5>
							<p>All the Lorem Ipsum generators on the</p>
						</a>
					</li>
					<li>
						<a href="#!"> <img src="images/icon/dbr3.jpg" alt="" />
							<h5>Ads expairy soon</h5>
							<p>All the Lorem Ipsum generators on the</p>
						</a>
					</li>
					<li>
						<a href="#!"> <img src="images/icon/dbr4.jpg" alt="" />
							<h5>Post free ads - today only</h5>
							<p>All the Lorem Ipsum generators on the</p>
						</a>
					</li>
					<li>
						<a href="#!"> <img src="images/icon/dbr5.jpg" alt="" />
							<h5>listing limit increase</h5>
							<p>All the Lorem Ipsum generators on the</p>
						</a>
					</li>
					<li>
						<a href="#!"> <img src="images/icon/dbr6.jpg" alt="" />
							<h5>mobile app launch</h5>
							<p>All the Lorem Ipsum generators on the</p>
						</a>
					</li>
					<li>
						<a href="#!"> <img src="images/icon/dbr7.jpg" alt="" />
							<h5>Setting Updated</h5>
							<p>All the Lorem Ipsum generators on the</p>
						</a>
					</li>
					<li>
						<a href="#!"> <img src="images/icon/dbr8.jpg" alt="" />
							<h5>Increase listing viewers</h5>
							<p>All the Lorem Ipsum generators on the</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</section>
	<!--END DASHBOARD-->
	<!--MOBILE APP-->
	
	<!--FOOTER SECTION-->
	<footer id="colophon" class="site-footer clearfix">
		<div id="quaternary" class="sidebar-container " role="complementary">
			<div class="sidebar-inner">
				<div class="widget-area clearfix">
					<div id="azh_widget-2" class="widget widget_azh_widget">
						<div data-section="section">
							<div class="container">
								<div class="row">
									<div class="col-sm-4 col-md-3 foot-logo"> <img src="images/foot-logo.png" alt="logo">
										<p class="hasimg">Worlds's No. 1 Local Business Directory Website.</p>
										<p class="hasimg">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
									</div>
									<div class="col-sm-4 col-md-3">
										<h4>Support & Help</h4>
										<ul class="two-columns">
											<li> <a href="advertise.php">Advertise us</a> </li>
											<li> <a href="about-us.php">About Us</a> </li>
											<li> <a href="customer-reviews.php">Review</a> </li>
											<li> <a href="how-it-work.php">How it works </a> </li>
											<li> <a href="add-listing.php">Add Business</a> </li>
											<li> <a href="#!">Register</a> </li>
											<li> <a href="#!">Login</a> </li>
											<li> <a href="#!">Quick Enquiry</a> </li>
											<li> <a href="#!">Ratings </a> </li>
											<li> <a href="trendings.php">Top Trends</a> </li>
										</ul>
									</div>
									<div class="col-sm-4 col-md-3">
										<h4>Popular Services</h4>
										<ul class="two-columns">
											<li> <a href="#!">Hotels</a> </li>
											<li> <a href="#!">Hospitals</a> </li>
											<li> <a href="#!">Transportation</a> </li>
											<li> <a href="#!">Real Estates </a> </li>
											<li> <a href="#!">Automobiles</a> </li>
											<li> <a href="#!">Resorts</a> </li>
											<li> <a href="#!">Education</a> </li>
											<li> <a href="#!">Sports Events</a> </li>
											<li> <a href="#!">Web Services </a> </li>
											<li> <a href="#!">Skin Care</a> </li>
										</ul>
									</div>
									<div class="col-sm-4 col-md-3">
										<h4>Cities Covered</h4>
										<ul class="two-columns">
											<li> <a href="#!">Atlanta</a> </li>
											<li> <a href="#!">Austin</a> </li>
											<li> <a href="#!">Baltimore</a> </li>
											<li> <a href="#!">Boston </a> </li>
											<li> <a href="#!">Chicago</a> </li>
											<li> <a href="#!">Indianapolis</a> </li>
											<li> <a href="#!">Las Vegas</a> </li>
											<li> <a href="#!">Los Angeles</a> </li>
											<li> <a href="#!">Louisville </a> </li>
											<li> <a href="#!">Houston</a> </li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div data-section="section" class="foot-sec2">
							<div class="container">
								<div class="row">
									<div class="col-sm-3">
										<h4>Payment Options</h4>
										<p class="hasimg"> <img src="images/payment.png" alt="payment"> </p>
									</div>
									<div class="col-sm-4">
										<h4>Address</h4>
										<p>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A. Landmark : Next To Airport</p>
										<p> <span class="strong">Phone: </span> <span class="highlighted">+01 1245 2541</span> </p>
									</div>
									<div class="col-sm-5 foot-social">
										<h4>Follow with us</h4>
										<p>Join the thousands of other There are many variations of passages of Lorem Ipsum available</p>
										<ul>
											<li><a href="#!"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
											<li><a href="#!"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </li>
											<li><a href="#!"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
											<li><a href="#!"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>
											<li><a href="#!"><i class="fa fa-youtube" aria-hidden="true"></i></a> </li>
											<li><a href="#!"><i class="fa fa-whatsapp" aria-hidden="true"></i></a> </li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- .widget-area -->
			</div>
			<!-- .sidebar-inner -->
		</div>
		<!-- #quaternary -->
	</footer>
	<!--COPY RIGHTS-->
	<section class="copy">
		<div class="container">
			<p>copyrights © 2017 RN53Themes.net. &nbsp;&nbsp;All rights reserved. </p>
		</div>
	</section>
	<!--QUOTS POPUP-->
	<section>
		<!-- GET QUOTES POPUP -->
		<div class="modal fade dir-pop-com" id="list-quo" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header dir-pop-head">
						<button type="button" class="close" data-dismiss="modal">×</button>
						<h4 class="modal-title">Get a Quotes</h4>
						<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
					</div>
					<div class="modal-body dir-pop-body">
						<form method="post" class="form-horizontal">
							<!--LISTING INFORMATION-->
							<div class="form-group has-feedback ak-field">
								<label class="col-md-4 control-label">Full Name *</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="fname" placeholder="" required> </div>
							</div>
							<!--LISTING INFORMATION-->
							<div class="form-group has-feedback ak-field">
								<label class="col-md-4 control-label">Mobile</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="mobile" placeholder=""> </div>
							</div>
							<!--LISTING INFORMATION-->
							<div class="form-group has-feedback ak-field">
								<label class="col-md-4 control-label">Email</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="email" placeholder=""> </div>
							</div>
							<!--LISTING INFORMATION-->
							<div class="form-group has-feedback ak-field">
								<label class="col-md-4 control-label">Message</label>
								<div class="col-md-8 get-quo">
									<textarea class="form-control"></textarea>
								</div>
							</div>
							<!--LISTING INFORMATION-->
							<div class="form-group has-feedback ak-field">
								<div class="col-md-6 col-md-offset-4">
									<input type="submit" value="SUBMIT" class="pop-btn"> </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- GET QUOTES Popup END -->
	</section>
	<!--SCRIPT FILES-->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js" type="text/javascript"></script>
	<script src="js/materialize.min.js" type="text/javascript"></script>
	<script src="js/custom.js"></script>
</body>
<!-- Mirrored from rn53themes.net/themes/demo/directory/db-my-profile-edit.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Apr 2019 07:08:20 GMT -->
</html>