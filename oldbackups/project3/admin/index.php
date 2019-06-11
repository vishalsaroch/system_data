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
<script>
var iddd,phoneno,pemail,packname,date,descr,country,city;
function showcard(element){
	
document.getElementById("card").style.display="inline";
//alert(element.childNodes[4].innerHTML);
document.getElementById("cardName").innerHTML=element.childNodes[1].innerHTML;
iddd=element.childNodes[0].innerHTML;
}
function closeit(){
	document.getElementById("card").style.display="none";
}

function openPage(){
			if(location.hostname=='localhost')
			{
				window.open("/project3/admin/openPrint.php?id="+iddd.toString());
			}
			else if(location.hostname=='arjjsngo.org.in')
			{
				window.open("openPrint.php?id="+iddd.toString());
			}
			//window.open("/project3/admin/openPrint.php?id="+iddd.toString());
}

	
function handleIt(){
	var urlkey3 = "/project3/admin/openPrint.php?id="+iddd;
	//alert(urlkey3);
	$.ajax({
				url: urlkey3,
				method: "GET",
				success: function(result){alert("Query marked as handled.");
				document.getElementById("card").style.display="none";
				location.reload();},
				failure: function(err){alert(err);},
			});
}
</script>
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
    <div class="page-wrapper" style="position: relative; top:-50px;">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo.jpg" alt="RealKeeper" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.php">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="index2.php">Dashboard 2</a>
                                </li>
                               
                            </ul>
                        </li>
                        
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                   
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            
        </aside>
        <!-- END MENU SIDEBAR-->

						
						
        <!-- PAGE CONTAINER-->
        <div class="container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop" style="position:relative; left:0px; top:0px; z-index:99;">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
						<div class="logo" style="">
							<a href="#">
							<img src="images/icon/logo.png" alt="Cool Admin" />
							</a>
						</div>
                            
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                       
                                        
                                        
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        
                                        
                                        
                                    </div>
                                    
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?= $last_name ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            
                                            <div class="account-dropdown__footer">
                                                <a href="../login/logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
								<div class="card" id="card" style="width:auto; height:148px; position: fixed; z-index:99; top:30%; left:40%; border: 10px solid pink; display:none;">
                                    <div class="card-header">
                                        <span id="cardName"><strong>Name</strong></span>
                                        <small>'s Lead</small>
										<button type="button" class="btn btn-danger" onclick="closeit();" style="float:right; height: 23px; width:20px; padding: 0px;">X</button>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" onclick="openPage();" class="btn btn-primary">Open</button>
                                        
                                    </div>
                                </div>
								
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30" style="position:relative; top:-90px;">
                    <div class="container-fluid">
                        
                        
                        
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
						else if($_SERVER['SERVER_NAME']=='arjjsngo.org.in')
						{
							$servername = "sun";
							$username = "arjjsngo_root";
							$password = "rootPWD@#";
							$dbname = "arjjsngo_dbase1";
							
							// Create connection
							$conn = new mysqli($servername, $username, $password, $dbname);
							// Check connection
							if ($conn->connect_error) {
							    die("Connection failed: " . $conn->connect_error);
							} 
							//echo "Connected successfully";
						}
						
						$sql = "select * from form";
						$result = $conn->query($sql);

						if($result->num_rows>0){
							echo "<div class='row'>
                            <div class='col-lg-12'>
                                <h2 class='title-1 m-b-25'>Forms Submitted</h2>
                                <div class='table-responsive table--no-card m-b-40'>
                                    <table class='table table-borderless table-striped table-earning'>
                                        <thead>
                                            <tr>
												<th>ID</th>
                                                <th>Head's Name</th>
                                                <th>age</th>
												<th>Father/Husband's name</th>
                                                <th>Address</th>
                                                <th>H.no</th>
												<th>City</th>
                                                <th>Mobile no</th>
                                                <th>Aadhar no</th>
												<th>OtherID</th>
												<th>Monthly income</th>
                                            </tr>
                                        </thead>
										<tbody>";
							while($row = $result->fetch_assoc()){
																
									echo "<tr onclick='showcard(this);'><td>" . $row["id"]. "</td><td>". $row["hname"]. "</td><td>" . $row["hage"]. "</td><td>" . $row["hfather"]. "</td><td>".$row["haddress"]."</td><td>" . $row["hdoor"]."</td><td>" . $row["hcity"]."</td><td>" . $row["hmobile"]. "</td><td>" . $row["haadhar"]."</td><td>" . $row["hotherid"]."</td><td>" . $row["hincome"]."</td></tr>";
									
							}
							echo "		</tbody>
                                    </table>
                                </div>
                            </div>
							</div>";
						} else {
							echo "0 results";
						}
						 						
						$conn->close();
						
						?>
						
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
