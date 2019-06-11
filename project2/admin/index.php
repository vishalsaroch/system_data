<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: ../login/index.php");  
  exit();
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <?php include 'css/css.html'; ?>

</head>

<body class="animsition">
          <?php 
     
          // Display message about account verification link only once
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];
              
              // Don't annoy the user with more messages upon page refresh
              unset( $_SESSION['message'] );
          }
          
          ?>
          </p>
          
          <?php
          
          // Keep reminding the user this account is not active, until they activate
          if ( !$active ){
              header("location: ../login/index.php");
			  exit();
          }
          
          ?>
<div class="page-wrapper">


<!-- *******************************************************************************************************-->	

<?php	include ("header.php"); ?>

<!-- *******************************************************************************************************-->		
		<div class="page-container">
            <!-- HEADER DESKTOP-->
								
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
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
						
						$sql = "select count(*) from packages";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        
                            echo $row["count(*)"];   //FINALLY WORKING :)
                        
                            //$conn->close();
                        ?>
                                                </h2>
                                                <span>Total <br>Packages</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                            <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                        <?php
						
						$sql1 = "select count(*) from bookmytrip";
                        $result1 = $conn->query($sql1);
                        $row1 = $result1->fetch_assoc();
                        $sql2 = "select count(*) from contactus";
                        $result2 = $conn->query($sql2);
                        $row2 = $result2->fetch_assoc();
                        $sql3 = "select count(*) from enquiry";
                        $result3 = $conn->query($sql3);
                        $row3 = $result3->fetch_assoc();
                        //echo $row3["count(*)"];
                        echo $row1["count(*)"]+$row2["count(*)"]+$row3["count(*)"];   //FINALLY WORKING :)
                        
                            //$conn->close();
                        ?>
                            </h2>
                                                <span>Total <br>Enquiry</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                        <?php
						
						$sql1 = "select count(*) from bookmytrip where isHandled3=0";
                        $result1 = $conn->query($sql1);
                        $row1 = $result1->fetch_assoc();
                        $sql2 = "select count(*) from contactus where isHandled2=0";
                        $result2 = $conn->query($sql2);
                        $row2 = $result2->fetch_assoc();
                        $sql3 = "select count(*) from enquiry where isHandled=0";
                        $result3 = $conn->query($sql3);
                        $row3 = $result3->fetch_assoc();
                        //echo $row3["count(*)"];
                        echo $row1["count(*)"]+$row2["count(*)"]+$row3["count(*)"];   //FINALLY WORKING :)
                        
                            //$conn->close();
                        ?>
                                                </h2>
                                                <span>Unhandled <br>Enquiries</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                <?php
						
						$sql1 = "select count(*) from bookmytrip where isCustomer3=1";
                        $result1 = $conn->query($sql1);
                        $row1 = $result1->fetch_assoc();
                        $sql2 = "select count(*) from contactus where isCustomer2=1";
                        $result2 = $conn->query($sql2);
                        $row2 = $result2->fetch_assoc();
                        $sql3 = "select count(*) from enquiry where isCustomer=1";
                        $result3 = $conn->query($sql3);
                        $row3 = $result3->fetch_assoc();
                        //echo $row3["count(*)"];
                        echo $row1["count(*)"]+$row2["count(*)"]+$row3["count(*)"];   //FINALLY WORKING :)
                        
                            $conn->close();
                        ?>
                                                </h2>
                                                <span>Total <br>Customers</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Powered by <a href="https://www.realkeeper.in">RealKeeper</a>. All rights reserved. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
