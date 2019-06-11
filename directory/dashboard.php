<?php include("config.php");?>
<?php include("user-session.php");?>	

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from rn53themes.net/themes/demo/directory/dashboard.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Apr 2019 07:07:32 GMT -->
<head>
	<title>Dashboard</title>
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
<?php 
     
     // Display message about account verification link only once
     if (isset($_SESSION['message']) )
     {
        echo $_SESSION['message'];
         
         // Don't annoy the user with more messages upon page refresh
         unset( $_SESSION['message'] );
     }
?>
<?php
    // Keep reminding the user this account is not active, until they activate
     if ( !$active ){
         header("location:login/index.php");
   exit();
     }
     
?>

<body>
	<div id="preloader">
		<div id="status">&nbsp;</div>
	</div>
	<?php include("search.php"); ?>
	<!--DASHBOARD-->
	<section>
		<div class="tz">
			<!--LEFT SECTION-->
			
			<?php include("left-nav.php");?>
			
			<!--CENTER SECTION-->
			<div class="tz-2">
				<div class="tz-2-com tz-2-main">
					<h4>Manage Booking</h4>
					<div class="tz-2-main-com">
						<div class="tz-2-main-1">
							<div class="tz-2-main-2"> <img src="images/icon/d1.png" alt="" /><span>All Ads</span>
								<!-- <p>All My Posted Ads</p> -->
								<!-- <h2>04</h2> --> 
								<?php
                            		$sql="select count('id') from post where userid='$email'";
                            		$result=mysqli_query($conn,$sql);
                            		$row=mysqli_fetch_array($result);
                            		echo "<a href='db-all-listing.php'><h2>".$row[0]."</h2></a>";     
                          		?>
							</div>
						</div>
						<div class="tz-2-main-1">
							<div class="tz-2-main-2"> <img src="images/icon/d2.png" alt="" /><span>Review</span>
								<!-- <p>All the Lorem Ipsum generators on the</p> -->
								<h2>69</h2> </div>
						</div>
						<div class="tz-2-main-1">
							<div class="tz-2-main-2"> <img src="images/icon/d3.png" alt="" /><span>Messages</span>
								<!-- <p>All the Lorem Ipsum generators on the</p> -->
								<h2>53</h2> </div>
						</div>
					</div>
					<div class="tz-2-com tz-2-main">
					<h4>Manage Ads</h4>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Ads</h2><hr>
							<!-- <p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p> -->
						</div>
						
						<table class="responsive-table bordered">
							<thead>
								<tr>
									<th>Ad Name</th>
									<th>Date</th>
									<!-- <th>Rating</th> -->
									<th>Status</th>
									<th>Edit</th>
								</tr>
							</thead>
							<?php
								$sql = "SELECT * from post where post.userid = '".$_SESSION['email']."'ORDER BY id DESC LIMIT 5;";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
							?>
							<tbody>
								<tr>
									<td><?php echo $row["title"];?></td>
									<td><?php echo $row["current_time"];?></td>
									<!-- <td><span class="db-list-rat"><?php echo $row["status"];?></span>
									</td> -->
									<td><span class="db-list-ststus">
									<?php 
										if($row["status"]==="")
											echo "Inactive";
										else
											echo "Activate'>";
									?>
									</span>
									</td>
									<td><a href="db-listing-edit.php" class="db-list-edit">Edit</a>
									</td>
								</tr>
							</tbody>
							<?php
								}}
							?>
						</table>
					</div>
				</div>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Payment & analytics</h2>
							<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>
						</div>
						<table class="responsive-table bordered">
							<thead>
								<tr>
									<th>Listing Name</th>
									<th>Views(week)</th>
									<th>Payment</th>
									<th>Listing Type</th>
									<th>Make Payment</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Taj Luxury Hotel & Resorts</td>
									<td>142</td>
									<td><span class="db-list-rat">Done</span>
									</td>
									<td><span class="db-list-ststus">Premium</span>
									</td>
									<td><a href="db-payment.php" class="db-list-edit">Payment</a>
									</td>
								</tr>
								<tr>
									<td>Joney Health and Fitness</td>
									<td>53</td>
									<td><span class="db-list-rat">Done</span>
									</td>
									<td><span class="db-list-ststus-na">Free</span>
									</td>
									<td><a href="db-payment.php" class="db-list-edit">Payment</a>
									</td>
								</tr>
								<tr>
									<td>Effi Furniture Dealers</td>
									<td>76</td>
									<td><span class="db-list-ststus-na">No</span>
									</td>
									<td><span class="db-list-ststus-na">Free</span>
									</td>
									<td><a href="db-payment.php" class="db-list-edit">Payment</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Messages</h2>
							<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>
						</div>
						<div class="tz-mess">
							<ul>
								<li class="view-msg">
									<h5><img src="images/users/1.png" alt="" />Listing Enquiry <span class="tz-msg-un-read">unread</span></h5>
									<p>Nulla egestas leo elit, eu sollicitudin diam suscipit non. Nunc imperdiet hendrerit mi, mollis sagittis risus accumsan ac.</p>
									<div class="hid-msg"><a href="#"><i class="fa fa-eye" title="view"></i></a><a href="#"><i class="fa fa-trash" title="delete"></i></a>
									</div>
								</li>
								<li class="view-msg">
									<h5><img src="images/users/4.png" alt="" />Request for meet <span class="tz-msg-read">unread</span></h5>
									<p>Duis nulla ligula, interdum porta nulla sed, efficitur tempus lacus. Quisque facilisis, sapien tempor mollis sollicitudin, urna ligula vulputate nulla, rhoncus faucibus justo mauris eget elit.Pellentesque eget pellentesque dolor.</p>
									<div class="hid-msg"><a href="#"><i class="fa fa-eye" title="view"></i></a><a href="#"><i class="fa fa-trash" title="delete"></i></a>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Reviews</h2>
							<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>
						</div>
						<div class="tz-mess">
							<ul>
								<li class="view-msg">
									<h5><img src="images/users/1.png" alt="" />Jessica <span class="tz-revi-star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i></span></h5>
									<p>Cras viverra ligula ut sem tincidunt, et volutpat dui facilisis. Nulla congue arcu vitae lectus cursus finibus. Pellentesque consequat ante eu elit tincidunt pharetra.</p>
									<div class="hid-msg"><a href="#!"><i class="fa fa-check" title="approve this review"></i></a><a href="#!"><i class="fa fa-edit" title="edit"></i></a><a href="#!"><i class="fa fa-trash" title="delete"></i></a><a href="#!"><i class="fa fa-reply edit-replay" title="replay"></i></a>
										<form class="col s12 hide-box">
											<div class="">
												<div class="input-field col s12">
													<textarea class="materialize-textarea"></textarea>
													<label>Write your replay</label>
												</div>
												<div class="input-field col s12">
													<input type="submit" value="Submit" class="waves-effect waves-light btn-large"> </div>
											</div>
										</form>
									</div>
								</li>
								<li class="view-msg">
									<h5><img src="images/users/1.png" alt="" />	Christopher <span class="tz-revi-star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i></span></h5>
									<p>Duis nulla ligula, interdum porta nulla sed, efficitur tempus lacus. Quisque facilisis, sapien tempor mollis sollicitudin, urna ligula vulputate nulla, rhoncus faucibus justo mauris eget elit.Pellentesque eget pellentesque dolor.</p>
									<div class="hid-msg"><a href="#!"><i class="fa fa-check" title="approve this review"></i></a><a href="#!"><i class="fa fa-edit" title="edit"></i></a><a href="#!"><i class="fa fa-trash" title="delete"></i></a><a href="#!"><i class="fa fa-reply edit-replay" title="replay"></i></a>
										<form class="col s12 hide-box">
											<div class="">
												<div class="input-field col s12">
													<textarea class="materialize-textarea"></textarea>
													<label>Write your replay</label>
												</div>
												<div class="input-field col s12">
													<input type="submit" value="Submit" class="waves-effect waves-light btn-large"> </div>
											</div>
										</form>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php include("notification.php");?>
		</div>
	</section>
	<!--END DASHBOARD-->
	
	<!--FOOTER SECTION-->
	<!--QUOTS POPUP-->
	<section>
		<div class="modal fade dir-pop-com" id="list-quo" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header dir-pop-head">
						<button type="button" class="close" data-dismiss="modal">×</button>
						<h4 class="modal-title">Get a Quotes</h4>
					</div>
					<div class="modal-body dir-pop-body">
						<form method="post" class="form-horizontal">
							<div class="form-group has-feedback ak-field">
								<label class="col-md-4 control-label">Full Name *</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="fname" placeholder="" required> </div>
							</div>
							<div class="form-group has-feedback ak-field">
								<label class="col-md-4 control-label">Mobile</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="mobile" placeholder=""> </div>
							</div>
							<div class="form-group has-feedback ak-field">
								<label class="col-md-4 control-label">Email</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="email" placeholder=""> </div>
							</div>
							<div class="form-group has-feedback ak-field">
								<label class="col-md-4 control-label">Message</label>
								<div class="col-md-8 get-quo">
									<textarea class="form-control"></textarea>
								</div>
							</div>
							<div class="form-group has-feedback ak-field">
								<div class="col-md-6 col-md-offset-4">
									<input type="submit" value="SUBMIT" class="pop-btn"> </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js" type="text/javascript"></script>
	<script src="js/materialize.min.js" type="text/javascript"></script>
	<script src="js/custom.js"></script>
</body>


<!-- Mirrored from rn53themes.net/themes/demo/directory/dashboard.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Apr 2019 07:07:34 GMT -->
</html>