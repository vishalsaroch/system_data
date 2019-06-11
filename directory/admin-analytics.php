<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from rn53themes.net/themes/demo/directory/admin-analytics.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Apr 2019 07:07:40 GMT -->
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
	<!--== MAIN CONTRAINER ==-->
	<div class="container-fluid sb1">
		<div class="row">
			<!--== LOGO ==-->
			<div class="col-md-2 col-sm-3 col-xs-6 sb1-1"> <a href="#" class="btn-close-menu"><i class="fa fa-times" aria-hidden="true"></i></a> <a href="#" class="atab-menu"><i class="fa fa-bars tab-menu" aria-hidden="true"></i></a>
				<a href="index-1.php" class="logo"><img src="images/logo1.png" alt="" /> </a>
			</div>
			<!--== SEARCH ==-->
			<div class="col-md-6 col-sm-6 mob-hide">
				<form class="app-search">
					<input type="text" placeholder="Search..." class="form-control"> <a href="#"><i class="fa fa-search"></i></a> </form>
			</div>
			<!--== NOTIFICATION ==-->
			<div class="col-md-2 tab-hide">
				<div class="top-not-cen"> <a class='waves-effect btn-noti' href='#'><i class="fa fa-commenting-o" aria-hidden="true"></i><span>5</span></a> <a class='waves-effect btn-noti' href='#'><i class="fa fa-envelope-o" aria-hidden="true"></i><span>5</span></a> <a class='waves-effect btn-noti' href='#'><i class="fa fa-tag" aria-hidden="true"></i><span>5</span></a> </div>
			</div>
			<!--== MY ACCCOUNT ==-->
			<div class="col-md-2 col-sm-3 col-xs-6">
				<!-- Dropdown Trigger -->
				<a class='waves-effect dropdown-button top-user-pro' href='#' data-activates='top-menu'><img src="images/users/6.png" alt="" />My Account <i class="fa fa-angle-down" aria-hidden="true"></i> </a>
				<!-- Dropdown Structure -->
				<ul id='top-menu' class='dropdown-content top-menu-sty'>
					<li><a href="admin-setting.php" class="waves-effect"><i class="fa fa-cogs"></i>Admin Setting</a> </li>
					<li><a href="admin-analytics.php"><i class="fa fa-bar-chart"></i> Analytics</a> </li>
					<li><a href="admin-ads.php"><i class="fa fa-buysellads" aria-hidden="true"></i>Ads</a> </li>
					<li><a href="admin-payment.php"><i class="fa fa-usd" aria-hidden="true"></i> Payments</a> </li>
					<li><a href="admin-notifications.php"><i class="fa fa-bell-o"></i>Notifications</a> </li>
					<li><a href="#" class="waves-effect"><i class="fa fa-undo" aria-hidden="true"></i> Backup Data</a> </li>
					<li class="divider"></li>
					<li><a href="#" class="ho-dr-con-last waves-effect"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a> </li>
				</ul>
			</div>
		</div>
	</div>
	<!--== BODY CONTNAINER ==-->
	<div class="container-fluid sb2">
		<div class="row">
			<div class="sb2-1">
				<!--== USER INFO ==-->
				<div class="sb2-12">
					<ul>
						<li><img src="images/users/2.png" alt=""> </li>
						<li>
							<h5>John Smith <span> Santa Ana, CA</span></h5> </li>
						<li></li>
					</ul>
				</div>
				<!--== LEFT MENU ==-->
				<div class="sb2-13">
					<ul class="collapsible" data-collapsible="accordion">
						<li><a href="admin.php" class="menu-active"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a> </li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul" aria-hidden="true"></i> Listing</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="admin-all-listing.php">All listing</a> </li>
									<li><a href="admin-list-add.php">Add New listing</a> </li>
									<li><a href="admin-listing-category.php">All listing Categories</a> </li>
									<li><a href="admin-list-category-add.php">Add listing Categories</a> </li>
								</ul>
							</div>
						</li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="admin-all-users.php">All Users</a> </li>
									<li><a href="admin-list-users-add.php">Add New user</a> </li>
								</ul>
							</div>
						</li>
						<li><a href="admin-analytics.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> Analytics</a> </li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-buysellads" aria-hidden="true"></i>Ads</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="admin-ads.php">All Ads</a> </li>
									<li><a href="admin-ads-create.php">Create New Ads</a> </li>
								</ul>
							</div>
						</li>
						<li><a href="admin-payment.php"><i class="fa fa-usd" aria-hidden="true"></i> Payments</a> </li>
						<li><a href="admin-earnings.php"><i class="fa fa-money" aria-hidden="true"></i> Earnings</a> </li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-bell-o" aria-hidden="true"></i>Notifications</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="admin-notifications.php">All Notifications</a> </li>
									<li><a href="admin-notifications-user-add.php">User Notifications</a> </li>
									<li><a href="admin-notifications-push-add.php">Push Notifications</a> </li>
								</ul>
							</div>
						</li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-tags" aria-hidden="true"></i> List Price</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="admin-price.php">All List Price</a> </li>
									<li><a href="admin-price-list.php">Add New Price</a> </li>
								</ul>
							</div>
						</li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-rss" aria-hidden="true"></i> Blog & Articals</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="admin-blog.php">All Blogs</a> </li>
									<li><a href="admin-blog-add.php">Add Blog</a> </li>
								</ul>
							</div>
						</li>
						<li><a href="admin-setting.php"><i class="fa fa-cogs" aria-hidden="true"></i> Setting</a> </li>
						<li><a href="admin-social-media.php"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Social Media</a> </li>
						<li><a href="#" target="_blank"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a> </li>
					</ul>
				</div>
			</div>
			<!--== BODY INNER CONTAINER ==-->
			<div class="sb2-2">
				<!--== breadcrumbs ==-->
				<div class="sb2-2-2">
					<ul>
						<li><a href="index-1.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a> </li>
						<li class="active-bre"><a href="#"> Analytics</a> </li>
						<li class="page-back"><a href="admin.php"><i class="fa fa-backward" aria-hidden="true"></i> Back</a> </li>
					</ul>
				</div>
				<div class="tz-2 tz-2-admin">
					<div class="tz-2-com tz-2-main">
						<h4>Visitors Analytics - Country</h4> <a class="dropdown-button drop-down-meta drop-down-meta-inn" href="#" data-activates="dr-list"><i class="material-icons">more_vert</i></a>
						<ul id="dr-list" class="dropdown-content">
							<li><a href="#!">Add New</a> </li>
							<li><a href="#!">Edit</a> </li>
							<li><a href="#!">Update</a> </li>
							<li class="divider"></li>
							<li><a href="#!"><i class="material-icons">delete</i>Delete</a> </li>
							<li><a href="#!"><i class="material-icons">subject</i>View All</a> </li>
							<li><a href="#!"><i class="material-icons">play_for_work</i>Download</a> </li>
						</ul>
						<!-- Dropdown Structure -->
						<div class="split-row">
							<div class="col-md-12">
								<div class="box-inn-sp ad-inn-page">
									<div class="tab-inn ad-tab-inn">
										<div class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Select</th>
														<th>Country</th>
														<th>Category</th>
														<th>Visitord This Week</th>
														<th>Visitord Pre Week</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<input type="checkbox" class="filled-in" id="filled-in-box-1" />
															<label for="filled-in-box-1"></label>
														</td>
														<td><span class="txt-dark weight-500">Australia</span> </td>
														<td>Education</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>2075</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-down" aria-hidden="true"></i><span>1485</span></span>
														</td>
														<td> <span class="label label-success">Active</span> </td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" class="filled-in" id="filled-in-box-2" />
															<label for="filled-in-box-2"></label>
														</td>
														<td><span class="txt-dark weight-500">England</span> </td>
														<td>Medical</td>
														<td><span class="txt-success"><i class="fa fa-angle-down" aria-hidden="true"></i><span>4050</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>5014</span></span>
														</td>
														<td> <span class="label label-primary">Normal</span> </td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" class="filled-in" id="filled-in-box-3" />
															<label for="filled-in-box-3"></label>
														</td>
														<td><span class="txt-dark weight-500">United States</span> </td>
														<td>Online Shoping</td>
														<td><span class="txt-success"><i class="fa fa-angle-down" aria-hidden="true"></i><span>3205</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>3852</span></span>
														</td>
														<td> <span class="label label-primary">Normal</span> </td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" class="filled-in" id="filled-in-box-4" />
															<label for="filled-in-box-4"></label>
														</td>
														<td><span class="txt-dark weight-500">Australia</span> </td>
														<td>Education</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>2075</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-down" aria-hidden="true"></i><span>1485</span></span>
														</td>
														<td> <span class="label label-success">Active</span> </td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" class="filled-in" id="filled-in-box-5" />
															<label for="filled-in-box-5"></label>
														</td>
														<td><span class="txt-dark weight-500">England</span> </td>
														<td>Medical</td>
														<td><span class="txt-success"><i class="fa fa-angle-down" aria-hidden="true"></i><span>4050</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>5014</span></span>
														</td>
														<td> <span class="label label-primary">Normal</span> </td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" class="filled-in" id="filled-in-box-6" />
															<label for="filled-in-box-6"></label>
														</td>
														<td><span class="txt-dark weight-500">United States</span> </td>
														<td>Online Shoping</td>
														<td><span class="txt-success"><i class="fa fa-angle-down" aria-hidden="true"></i><span>3205</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>3852</span></span>
														</td>
														<td> <span class="label label-primary">Normal</span> </td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tz-2 tz-2-admin ad-mar-to-min">
					<div class="tz-2-com tz-2-main">
						<h4>Audiance Overview</h4> <a class="dropdown-button drop-down-meta drop-down-meta-inn" href="#" data-activates="dr-list-1"><i class="material-icons">more_vert</i></a>
						<ul id="dr-list-1" class="dropdown-content">
							<li><a href="#!">Add New</a> </li>
							<li><a href="#!">Edit</a> </li>
							<li><a href="#!">Update</a> </li>
							<li class="divider"></li>
							<li><a href="#!"><i class="material-icons">delete</i>Delete</a> </li>
							<li><a href="#!"><i class="material-icons">subject</i>View All</a> </li>
							<li><a href="#!"><i class="material-icons">play_for_work</i>Download</a> </li>
						</ul>
						<!-- Dropdown Structure -->
						<div class="split-row">
							<div class="col-md-12">
								<div class="box-inn-sp ad-inn-page">
									<div class="tab-inn ad-tab-inn">
										<div class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Select</th>
														<th>Country</th>
														<th>Users</th>
														<th>Sections</th>
														<th>New Users</th>
														<th>User Over Time</th>
														<th>Avg.Sec Duration</th>
														<th>Real Time Views</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<input type="checkbox" class="filled-in" id="filled-in-box-11" />
															<label for="filled-in-box-11"></label>
														</td>
														<td><span class="txt-dark weight-500">Brazil</span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>840</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>2075</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-down" aria-hidden="true"></i><span>1024</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>4052</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>00:02:19</span></span>
														</td>
														<td> <span class="label label-success">241</span> </td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" class="filled-in" id="filled-in-box-12" />
															<label for="filled-in-box-12"></label>
														</td>
														<td><span class="txt-dark weight-500">England</span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>742</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>1092</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-down" aria-hidden="true"></i><span>942</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>3651</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>00:04:34</span></span>
														</td>
														<td> <span class="label label-success">524</span> </td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" class="filled-in" id="filled-in-box-13" />
															<label for="filled-in-box-13"></label>
														</td>
														<td><span class="txt-dark weight-500">United States</span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>1024</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>2061</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-down" aria-hidden="true"></i><span>412</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>4053</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>00:01:58</span></span>
														</td>
														<td> <span class="label label-success">674</span> </td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" class="filled-in" id="filled-in-box-14" />
															<label for="filled-in-box-14"></label>
														</td>
														<td><span class="txt-dark weight-500">Brazil</span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>840</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>2075</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-down" aria-hidden="true"></i><span>1024</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>4052</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>00:02:19</span></span>
														</td>
														<td> <span class="label label-success">241</span> </td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" class="filled-in" id="filled-in-box-15" />
															<label for="filled-in-box-15"></label>
														</td>
														<td><span class="txt-dark weight-500">England</span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>742</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>1092</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-down" aria-hidden="true"></i><span>942</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>3651</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>00:04:34</span></span>
														</td>
														<td> <span class="label label-success">524</span> </td>
													</tr>
													<tr>
														<td>
															<input type="checkbox" class="filled-in" id="filled-in-box-16" />
															<label for="filled-in-box-16"></label>
														</td>
														<td><span class="txt-dark weight-500">United States</span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>1024</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>2061</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-down" aria-hidden="true"></i><span>412</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>4053</span></span>
														</td>
														<td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>00:01:58</span></span>
														</td>
														<td> <span class="label label-success">674</span> </td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--== BOTTOM FLOAT ICON ==-->
	<section>
		<div class="fixed-action-btn vertical">
			<a class="btn-floating btn-large red pulse"> <i class="large material-icons">mode_edit</i> </a>
			<ul>
				<li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a> </li>
				<li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a> </li>
				<li><a class="btn-floating green"><i class="material-icons">publish</i></a> </li>
				<li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a> </li>
			</ul>
		</div>
	</section>
	<!--SCRIPT FILES-->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js" type="text/javascript"></script>
	<script src="js/materialize.min.js" type="text/javascript"></script>
	<script src="js/custom.js"></script>
</body>


<!-- Mirrored from rn53themes.net/themes/demo/directory/admin-analytics.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Apr 2019 07:07:40 GMT -->
</html>