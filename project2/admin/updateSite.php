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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
		$(function() {
		$("#theForm").submit(function(e){
			e.preventDefault();    
			var formData = new FormData(this);
						
			var str = document.getElementById('fileToUpload').value;
			var text = str.replace(/\\/g,"@");
			var arr = text.split("@");
			var fname = arr[(arr.length-1)];
			
			var urlkey;
			if(location.hostname=='localhost')
			{
				urlkey = "/project2/admin/upload.php";
			}
			else if(location.hostname=='www.arkglobalholidays.co.in')
			{
				urlkey = "upload.php";
			}
			$.ajax({
				
				url: urlkey,
				method: "POST",
				data: formData,
				success: function(result){alert(result);fnametodb();},
				failure: function(err){alert(err);},
				cache: false,
				contentType: false,
				processData: false
				
			});
			
			function fnametodb(){
				
			var data = "filename="+fname;
						
			var urlkey;
			if(location.hostname=='localhost')
			{
				urlkey = "/project2/admin/fnametodb.php";
			}
			else if(location.hostname=='www.arkglobalholidays.co.in')
			{
				urlkey = "fnametodb.php";
			}
			$.ajax({
				url: urlkey,
				method: "POST",
				data: data,
				success: function(result){alert(result);},
				failure: function(err){alert(err);}
				});
			return(false);
		
			
			}
			
			
			return(false);
		});
	});
			</script>
			<!--<script>
			function myFunction() {
				document.getElementById("filename12").value = "nakul";//document.getElementById('fileToUpload');
			}
			</script>-->
            <!-- END BREADCRUMB-->
			
			
            <!-- STATISTIC-->
            <section class="statistic">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-12 col-lg-6">
								<div class="col-md-12">
								<div class="recent-report2" style="height:263px">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <span class="au-breadcrumb-span">Wanna change home Screen Banner image?:</span>
                                        <form id="theForm" action="" method="post" enctype="multipart/form-data">
                                            <br>Select image to upload:<br>
											<!--<input type="text" name="filename" id="filename12">-->
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                            <!--<button onclick="myFunction()">Try it</button>-->
											<input type="submit" value="Upload Image" name="submit" class="au-btn au-btn-icon au-btn--green">
                                        </form>
                                    </div>
                                     
                                </div>
                            	</div>
								</div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="statistic__item" style="height:263px">
                                    <span class="desc"><br> &nbsp; &nbsp;Add new Package</span><br><br><br><br>
                                    <button style="width:95%; margin-left:10px; margin-top:10px; font-size:22px" class="au-btn au-btn-icon au-btn--green" type="button" onclick="window.location = './newpackage.html'">Add</button>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </section>
						
                        
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
