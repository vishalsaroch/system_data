
<?php include("adminsession.php");?>
<?php include("config.php");?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="img/favicon.png" type="image/png">
	<title>Realkeeper Software | GST Billing Software | Accounting Software by real keeper</title>
	<meta name="keywords" content="Billing Software, Gst Billing Software, Realkeeper Software,  Accounting Software, realk keeper ">
<meta name="description" content="Best Software for GST Billing, Filing, Inventory & Accounting Management for Retailers, Distributors & Manufacturers Call Now 87 99 77 5429 "/>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
	<link rel="stylesheet" href="vendors/animate-css/animate.css">
	<link rel="stylesheet" href="vendors/flaticon/flaticon.css">
	<!-- main css -->
	<link rel="stylesheet" href="css/style.css">
</head>
<?php 
//   if ( isset($_SESSION['message']) ){
//      echo $_SESSION['message'];
//      unset( $_SESSION['message'] );
// }
?>

<?php
//   if ( !$active ){
//     header("location:index.php");
//     exit();
//   }
?>
<body>
<header class="header_area">
		<!-- <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#9999ff; color:#fff; height:50%;">
                    <div class="container" style="font-size: 14px">
                    	<ul class="nav col-lg-6" style="padding: 10px;">	
                        	<li style="padding-right:10px;"><sapn>CALL FOR DEMO :+91-78-2767-2267</sapn></li>
                        </ul>
                        <ul class="nav col-lg-6 nav-right" style="padding: 10px;">
                        	<li style="padding-right:10px;"><a style="color: #fff;" data-toggle="modal" data-target="#myModal" a href="#">Log In</a></li>
	                        <li style="padding-right:10px;"><a href="#" style="color: #fff;">Pay Now</a></li>	                        <li style="padding-right:10px;"><a href="#" style="color: #fff;">CA Connect</a></li>
	                        <li style="padding-right:10px;"><a href="support.php" style="color: #fff;">Get Support</a></li>
	                    </ul>
                    </div>
                </nav> -->
                <!-- Global site tag (gtag.js) - Google Analytics -->
                <script async src="https://www.googletagmanager.com/gtag/js?id=UA-77941351-1"></script>
                <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-77941351-1');
                </script>
                <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#fff;">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <a class="navbar-brand logo_h" href="index.php"><img src="img/realkeeper logonew.jpg"  alt=""></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" style="color: black">
                            <span class="icon-bar" style="background-color: black;"></span>
					        <span class="icon-bar" style="background-color: black;"></span>
					        <span class="icon-bar" style="background-color: black;"></span> 
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                            <ul class="nav navbar-nav menu_nav justify-content-center">
                                <!-- <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li> -->
                                <li class="nav-item"><a class="nav-link" href="dashboard.php" style="color: black">Demo Request</a></li>
                                <li class="nav-item"><a class="nav-link" href="download_report.php" style="color: black">Download</a></li>
                                <li class="nav-item"><a class="nav-link" href="followup.php" style="color: black">Follow Up</a></li>
                                <li class="nav-item"><a class="nav-link" href="customer.php" style="color: black">Customers</a></li>
                                <li class="nav-item"><a class="nav-link" href="logout.php" style="color: black">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

	<!--================Start Features Area =================-->
	<section class="features_area">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<div class="main_title">
						<h2>Demo Request</h2>
						<div class="row">
                        <?php
                            $sql = "SELECT * from requstdemo where  sendto= 'Customer'";
                            $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                        ?>  
							<table class = "table table bodered">
                                <tr>
                                    <th>Request Id</th>
                                    <th>Name</th>
                                    <th>Contact no</th>
                                    <th>Emailid</th>
                                    <th>Date</th>
                                    <!-- <th>Send To</th> -->
                                </tr>
                                <?php
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                <td><?php echo $row["id"] ?></td>
                                <td><?php echo $row["name"] ?></td>
                                <td><?php echo $row["email"] ?></td>
                                <td><?php echo $row["mobile"] ?></td>
                                <td><?php echo $row["date"] ?></td>
                                <!-- <td>
                                <form action="sendto.php" method="post">
                                <input type="text" name="inid" style="display: none;" value='<?php echo $row["id"];?>'>
                                    <select name="status" onchange="submitForm(this)">
                                        <option value="0" class="bg-info text-white">Send To</option>
                                        <option value="Non Customer">Customer</option>
                                        <option value="Non Customer">Non Customer</option>
                                    </select> 
                                </form>


                                <script>
                                    function submitForm(elem) {
                                        if (elem.value) {
                                            elem.form.submit();
                                        }
                                    }
                                </script>
                     </td> -->
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
            <?php include("footer.php");?>
	
	

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/stellar.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
	<script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
	<script src="vendors/isotope/isotope-min.js"></script>
	<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="vendors/counter-up/jquery.waypoints.min.js"></script>
	<script src="vendors/counter-up/jquery.counterup.min.js"></script>
	<script src="js/mail-script.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/theme.js"></script>
	
</body>

</html>