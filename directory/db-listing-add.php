<?php include("config.php");?>
<?php include("user-session.php");?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from rn53themes.net/themes/demo/directory/db-listing-add.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Apr 2019 07:04:08 GMT -->
<head>
	<title>World Best Local Directory Website template</title>
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
						?>
					</li>
					<li><b align="center"><?php echo $first_name; ?><b></li>
					</ul>
				</div>
				<div class="tz-l-2">
					<ul>
						<li>
							<a href="dashboard.php"><img src="images/icon/dbl1.png" alt="" /> My Dashboard</a>
						</li>
						<li>
							<a href="db-all-listing.php"><img src="images/icon/dbl11.png" alt="" /> All Posted Ads</a>
						</li>
						<li>
							<a href="db-listing-add.php" class="tz-lma"><img src="images/icon/dbl11.png" alt="" /> Create New Ad</a>
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
			<div class="tz-2">
				<div class="tz-2-com tz-2-main">
					<h4>Submit Post</h4>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Add New Post</h2>
							<!-- <p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p> -->
						</div>
						<div class="hom-cre-acc-left hom-cre-acc-right">
							<div class="">
								<form class="" method="post" action="save_post.php" enctype="multipart/form-data">
									<div class="row">
										<div class="input-field col s6">
											<input id="first_name" type="text" class="validate" name="ad_title">
											<label for="first_name">Ad Title</label>
										</div>
										<div class="input-field col s6">
											<input id="last_name" type="text" class="validate" name="price">
											<label for="last_name">Price</label>
										</div>
									</div>

									<div class="row">
										<div class="input-field col s6">
										<?php
					                        $sql="select * from categories";
					                        $result = $conn->query($sql);
					                      ?>
					                      <input id="last_name" list="Category" type="text" class="validate" name="Category" class="validate">
											<label for="last_name">Category</label>
					                     	<datalist id="Category" name="Category">
					                          <option value="" style="width:100%">Select Location</option>
					                            <?php
					                              if ($result->num_rows > 0) {
					                                while($row = $result->fetch_assoc()) {
					                                  echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
					                                }
					                              }
					                            ?>
					                        </datalist>
										</div>
										<div class="input-field col s6">
											<?php
											// $Category = $_GET['Category'];
											// echo $Category;
					                        $sql="select * from sub-categories";
					                        $result = $conn->query($sql);
					                      ?>
					                      <input id="last_name" list="sub-Category" type="text" class="validate" name="sub_Categories" class="validate">
											<label for="last_name"> Sub Category</label>
					                     	<datalist id="sub-Category" name="Category">
					                          <option value="" style="width:100%">Select Location</option>
					                            <?php
					                              if ($result->num_rows > 0) {
					                                while($row = $result->fetch_assoc()) {
					                                  echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
					                                }
					                              }
					                            ?>
					                        </datalist>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s4">
											<select id="list_name" class="validate" name="Condition">
												<option>Condition</option>
												<option value="New">New</option>
												<option value="Little Used">Little Used</option>
												<option value="Medimum Used">Medimum Used</option>
												<option value="Roughly">Roughly</option>
												<option value="Other">Other</option>
											</select>
											<!-- <label for="list_name">Condition</label> -->
										</div>
										<div class="input-field col s4">
											<select id="list_name" name="ad_for" class="validate">
												<option>ad for</option>
												<option value="Sale">Sale</option>
												<option value="Rent">Rent</option>
												<option value="Other">Other</option>
											</select>
										</div>
										<div class="input-field col s4">
											<select id="list_name" class="validate" name="Brand">
												<option>Brand</option>
												<option value="Sale">Other</option>
												
											</select>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<textarea class="validate" name="ad_description"></textarea>
											<!-- <input id="list_phone" type="text" class="validate"> -->
											<label for="list_phone">Ad Description </label>
										</div>
									</div>
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>image <span class="v2-db-form-note">(image size 1350x500):<span></h5>
										</div>
									</div>
									<div class="row tz-file-upload">
										<div class="file-field input-field">
											<div class="tz-up-btn"> <span>File</span>
												<input type="file" name="image1"> </div>
											<div class="file-path-wrapper db-v2-pg-inp">
												<input class="file-path validate" type="text" name="image1"> 
											</div>
										</div>
									</div>
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>image <span class="v2-db-form-note">(image size 1350x500):<span></h5>
										</div>
									</div>
									<div class="row tz-file-upload">
										<div class="file-field input-field">
											<div class="tz-up-btn"> <span>File</span>
												<input type="file" name="image2"> </div>
											<div class="file-path-wrapper db-v2-pg-inp">
												<input class="file-path validate" type="text" name="image2"> 
											</div>
										</div>
									</div>
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>image <span class="v2-db-form-note">(image size 1350x500):<span></h5>
										</div>
									</div>
									<div class="row tz-file-upload">
										<div class="file-field input-field">
											<div class="tz-up-btn"> <span>File</span>
												<input type="file" name="image3"> </div>
											<div class="file-path-wrapper db-v2-pg-inp">
												<input class="file-path validate" type="text" name="image3"> 
											</div>
										</div>
									</div>
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>image <span class="v2-db-form-note">(image size 1350x500):<span></h5>
										</div>
									</div>
									<div class="row tz-file-upload">
										<div class="file-field input-field">
											<div class="tz-up-btn"> <span>File</span>
												<input type="file" name="image4"> </div>
											<div class="file-path-wrapper db-v2-pg-inp">
												<input class="file-path validate" type="text" name="image4"> 
											</div>
										</div>
									</div>
									<!-- <div class="row">
										<div class="input-field col s3">
											<input id="email" type="file" class="validate btn btn-info">
											<label for="email">image</label>
										</div>
										<div class="input-field col s3">
											<input id="email" type="file" class="validate">
											<label for="email">image</label>
										</div>
										<div class="input-field col s3">
											<input id="email" type="file" class="validate">
											<label for="email">image</label>
										</div>
										<div class="input-field col s3">
											<input id="email" type="file" class="validate">
											<label for="email">image</label>
										</div>
									</div> -->
									<div class="row">
										<div class="input-field col s12">
											<input id="list_addr" type="text" class="validate" name="address">
											<label for="list_addr">Address</label>
										</div>
									</div>
									<!-- <div class="row">
										<div class="input-field col s12">
											<select>
												<option value="" disabled selected>Listing Type</option>
												<option value="1">Free</option>
												<option value="2">Premium</option>
												<option value="3">Premium Plus</option>
												<option value="3">Ultra Premium Plus</option>
											</select>
										</div>
									</div> -->
									<div class="row">
										<div class="input-field col s12">
										<input type="text" name="city">
										<label for="last_name"> City</label>
											<!-- <select>
												<option value="" disabled selected>Choose your city</option>
												<option value="1">Kyoto</option>
												<option value="2">Charleston</option>
												<option value="3">Florence</option>
												<option value="">Rome</option>
												<option value="">Mexico City</option>
												<option value="">Barcelona</option>
												<option value="">San Francisco</option>
												<option value="">Chicago</option>
												<option value="">Paris</option>
												<option value="">Tokyo</option>
												<option value="">Beijing</option>
												<option value="">Jerusalem</option>
											</select> -->
										</div>
									</div>
									<div class="row">
									<div class="input-field col s12">
										<select name="show_ads">
											<option value="" disabled selected>Where your Ads show</option>
											<option value="Home Page">Home Page</option>
											<option value="Listing Page">Listing Page</option>
											<option value="Footer Part">Footer Part</option>
											<option value="Header Part">Header Part</option>
										</select>
									</div>
								</div>
								<!-- <div class="row">
									<div class="input-field col s12">
										<select>
											<option value="" disabled selected>Select Duration</option>
											<option value="1">Demo - 5mins - Free</option>
											<option value="1">One Day - $10</option>
											<option value="1">One Week - $50</option>
											<option value="2">One Month - $ 200</option>
											<option value="3">Two Months - $350</option>
											<option value="3">Six Months - $700</option>
											<option value="3">One Year - $1000</option>
										</select>
									</div>
								</div>
								<div class="row">
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
										<input type="date" class="validate">
										<label></label>
									</div>
								</div> -->
									<!-- <div class="row">
										<div class="input-field col s12">
											<select multiple>
												<option value="" disabled selected>Select Category</option>
												<option value="">Hotels & Resorts</option>
												<option value="">Real Estate</option>
												<option value="">Trainings</option>
												<option value="">Education</option>
												<option value="">Hospitals</option>
												<option value="">Transportation</option>
												<option value="">Automobilers</option>
												<option value="">Computer Repair</option>
												<option value="">Property</option>
												<option value="">Food Court</option>
												<option value="">Sports Events</option>
												<option value="">Tour & Travels</option>
												<option value="">Health Care</option>
												<option value="">Gym & Fitness</option>
												<option value="">Packers and Movers</option>
												<option value="">Interior Design</option>
												<option value="">Clubs</option>
												<option value="">Mobile Shops</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<select multiple>
												<option value="" disabled selected>Opening Days</option>
												<option value="">All Days</option>
												<option value="">Monday</option>
												<option value="">Tuesday</option>
												<option value="">Wednesday</option>
												<option value="">Thursday</option>
												<option value="">Friday</option>
												<option value="">Saturday</option>
												<option value="">Sunday</option>
											</select>
										</div>
									</div>
								<div class="row">
									<div class="input-field col s6">
										<select>
											<option value="" disabled selected>Open Time</option>
											<option value="">12:00 AM</option>
											<option value="">01:00 AM</option>
											<option value="">02:00 AM</option>
											<option value="">03:00 AM</option>
											<option value="">04:00 AM</option>
											<option value="">05:00 AM</option>
											<option value="">06:00 AM</option>
											<option value="">07:00 AM</option>
											<option value="">08:00 AM</option>
											<option value="">09:00 AM</option>
											<option value="">10:00 AM</option>
											<option value="">11:00 AM</option>
											<option value="">12:00 PM</option>
											<option value="">01:00 PM</option>
											<option value="">02:00 PM</option>
											<option value="">03:00 PM</option>
											<option value="">04:00 PM</option>
											<option value="">05:00 PM</option>
											<option value="">06:00 PM</option>
											<option value="">07:00 PM</option>
											<option value="">08:00 PM</option>
											<option value="">09:00 PM</option>
											<option value="">10:00 PM</option>
											<option value="">11:00 PM</option>											
										</select>
									</div>
									<div class="input-field col s6">
										<select>
											<option value="" disabled selected>Closing Time</option>
											<option value="">12:00 AM</option>
											<option value="">01:00 AM</option>
											<option value="">02:00 AM</option>
											<option value="">03:00 AM</option>
											<option value="">04:00 AM</option>
											<option value="">05:00 AM</option>
											<option value="">06:00 AM</option>
											<option value="">07:00 AM</option>
											<option value="">08:00 AM</option>
											<option value="">09:00 AM</option>
											<option value="">10:00 AM</option>
											<option value="">11:00 AM</option>
											<option value="">12:00 PM</option>
											<option value="">01:00 PM</option>
											<option value="">02:00 PM</option>
											<option value="">03:00 PM</option>
											<option value="">04:00 PM</option>
											<option value="">05:00 PM</option>
											<option value="">06:00 PM</option>
											<option value="">07:00 PM</option>
											<option value="">08:00 PM</option>
											<option value="">09:00 PM</option>
											<option value="">10:00 PM</option>
											<option value="">11:00 PM</option>	
										</select>
									</div>
								</div>
									<div class="row"> </div>
									<div class="row">
										<div class="input-field col s12">
											<textarea id="textarea1" class="materialize-textarea"></textarea>
											<label for="textarea1">Listing Descriptions</label>
										</div>
									</div>
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>Social Media Informations:</h5>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input type="text" class="validate">
											<label>www.facebook.com/directory</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input type="text" class="validate">
											<label>www.googleplus.com/directory</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input type="text" class="validate">
											<label>www.twitter.com/directory</label>
										</div>
									</div>	
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>Listing Guarantee:</h5>
										</div>
									</div>	
									<div class="row">
										<div class="input-field col s12">
											<select>
												<option value="" disabled selected>Select Service Guarantee</option>
												<option value="1">Upto 2 month of service</option>
												<option value="2">Upto 6 month of service</option>
												<option value="3">Upto 1 year of service</option>
												<option value="4">Upto 2 year of service</option>
												<option value="5">Upto 5 year of service</option>
											</select>
										</div>
									</div>									
									<div class="row">
										<div class="input-field col s12">
											<select>
												<option value="" disabled selected>Are you a Professionals for this service?</option>
												<option value="1">Yes</option>
												<option value="2">No</option>
											</select>
										</div>
									</div>									
									<div class="row">
										<div class="input-field col s12">
											<select>
												<option value="" disabled selected>Insurance Limits</option>
												<option value="1">Upto $5,000</option>
												<option value="2">Upto $10,000</option>
												<option value="3">Upto $15,000</option>
											</select>
										</div>
									</div>	
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>Google Map:</h5>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input type="text" class="validate">
											<label>Past your iframe code here</label>
										</div>
									</div>
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>360 Degree View:</h5>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input type="text" class="validate">
											<label>Past your iframe code here</label>
										</div>
									</div>									
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>Cover Image <span class="v2-db-form-note">(image size 1350x500):<span></h5>
										</div>
									</div>
									<div class="row tz-file-upload">
										<div class="file-field input-field">
											<div class="tz-up-btn"> <span>File</span>
												<input type="file"> </div>
											<div class="file-path-wrapper db-v2-pg-inp">
												<input class="file-path validate" type="text"> 
											</div>
										</div>
									</div>
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>Photo Gallery <span class="v2-db-form-note">(upload multiple photos note:size 750x500):<span></h5>
										</div>
									</div>
									<div class="row tz-file-upload">
										<div class="file-field input-field">
											<div class="tz-up-btn"> <span>File</span>
												<input type="file" multiple> </div>
											<div class="file-path-wrapper db-v2-pg-inp">
												<input class="file-path validate" type="text"> 
											</div>
										</div>
									</div>									
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>Services Offered <span class="v2-db-form-note">(Enter service name and upload service image note:size 400x250):<span>:</h5>
										</div>
									</div>	
									<div class="row">
										<div class="input-field col s6">
											<input type="text" class="validate">
											<label>Service Name (ex:Room Booking)</label>
										</div>
										<div class="col s6">
											<div class="row tz-file-upload">
												<div class="file-field input-field">
													<div class="tz-up-btn"> <span>File</span>
														<input type="file"> </div>
													<div class="file-path-wrapper db-v2-pg-inp">
														<input class="file-path validate" type="text"> 
													</div>
												</div>
											</div>
										</div>										
									</div>
									<div class="row">
										<div class="input-field col s6">
											<input type="text" class="validate">
											<label>Service Name (ex:Java Development)</label>
										</div>
										<div class="col s6">
											<div class="row tz-file-upload">
												<div class="file-field input-field">
													<div class="tz-up-btn"> <span>File</span>
														<input type="file"> </div>
													<div class="file-path-wrapper db-v2-pg-inp">
														<input class="file-path validate" type="text"> 
													</div>
												</div>
											</div>
										</div>										
									</div>
									<div class="row">
										<div class="input-field col s6">
											<input type="text" class="validate">
											<label>Service Name (ex:Home Lones)</label>
										</div>
										<div class="col s6">
											<div class="row tz-file-upload">
												<div class="file-field input-field">
													<div class="tz-up-btn"> <span>File</span>
														<input type="file"> </div>
													<div class="file-path-wrapper db-v2-pg-inp">
														<input class="file-path validate" type="text"> 
													</div>
												</div>
											</div>
										</div>										
									</div>
									<div class="row">
										<div class="input-field col s6">
											<input type="text" class="validate">
											<label>Service Name (ex:Property Rent)</label>
										</div>
										<div class="col s6">
											<div class="row tz-file-upload">
												<div class="file-field input-field">
													<div class="tz-up-btn"> <span>File</span>
														<input type="file"> </div>
													<div class="file-path-wrapper db-v2-pg-inp">
														<input class="file-path validate" type="text"> 
													</div>
												</div>
											</div>
										</div>										
									</div>
									<div class="row">
										<div class="input-field col s6">
											<input type="text" class="validate">
											<label>Service Name (ex:Job Trainings)</label>
										</div>
										<div class="col s6">
											<div class="row tz-file-upload">
												<div class="file-field input-field">
													<div class="tz-up-btn"> <span>File</span>
														<input type="file"> </div>
													<div class="file-path-wrapper db-v2-pg-inp">
														<input class="file-path validate" type="text"> 
													</div>
												</div>
											</div>
										</div>										
									</div>
									<div class="row">
										<div class="input-field col s6">
											<input type="text" class="validate">
											<label>Service Name (ex:Travels)</label>
										</div>
										<div class="col s6">
											<div class="row tz-file-upload">
												<div class="file-field input-field">
													<div class="tz-up-btn"> <span>File</span>
														<input type="file"> </div>
													<div class="file-path-wrapper db-v2-pg-inp">
														<input class="file-path validate" type="text"> 
													</div>
												</div>
											</div>
										</div>										
									</div> -->									
									<div class="row">
										<div class="input-field col s12 v2-mar-top-40"> <!-- <a class="waves-effect waves-light btn-large full-btn" href="db-payment.php">Submit Listing & Pay</a> -->
										<input type="submit" name="submit" value="Submit Listing & Pay">
										 </div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
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
	<!-- <section class="web-app com-padd">
		<div class="container">
			<div class="row">
				<div class="col-md-6 web-app-img"> <img src="images/mobile.png" alt="" /> </div>
				<div class="col-md-6 web-app-con">
					<h2>Looking for the Best Service Provider? <span>Get the App!</span></h2>
					<ul>
						<li><i class="fa fa-check" aria-hidden="true"></i> Find nearby listings</li>
						<li><i class="fa fa-check" aria-hidden="true"></i> Easy service enquiry</li>
						<li><i class="fa fa-check" aria-hidden="true"></i> Listing reviews and ratings</li>
						<li><i class="fa fa-check" aria-hidden="true"></i> Manage your listing, enquiry and reviews</li>
					</ul> <span>We'll send you a link, open it on your phone to download the app</span>
					<form>
						<ul>
							<li>
								<input type="text" placeholder="+01" /> </li>
							<li>
								<input type="number" placeholder="Enter mobile number" /> </li>
							<li>
								<input type="submit" value="Get App Link" /> </li>
						</ul>
					</form>
					<a href="#"><img src="images/android.png" alt="" /> </a>
					<a href="#"><img src="images/apple.png" alt="" /> </a>
				</div>
			</div>
		</div>
	</section> -->
	<!--FOOTER SECTION-->
	
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


<!-- Mirrored from rn53themes.net/themes/demo/directory/db-listing-add.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Apr 2019 07:04:16 GMT -->
</html>