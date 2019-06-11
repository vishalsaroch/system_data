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
var pname333,phoneno333,packid333;
function showcard333(element){
	
    document.getElementById("card333").style.display="inline";
    //alert(element.childNodes[4].innerHTML);
    document.getElementById("cardName333").innerHTML=element.childNodes[1].innerHTML;
    pname333=element.childNodes[1].innerHTML;
    phoneno333=element.childNodes[5].innerHTML;
    packid333=element.childNodes[0].innerHTML;
    //alert("phone="+phoneno333+"id="+packid333);
    }
function closeit333(){
	document.getElementById("card333").style.display="none";
}
function sendSMS333(){
			document.getElementById("card333").style.display="none";
			document.getElementById("cardName1333").innerHTML=pname333;
			document.getElementById("smsCard333").style.display="inline";
			
}

function handleIt333(){
	var urlkey3333 = "/project2/admin/markHandled333.php?packid333="+packid333;
	//alert(urlkey3);
	$.ajax({
				url: urlkey3333,
				method: "GET",
				success: function(result){alert("Query marked as handled.");
				document.getElementById("card333").style.display="none";
				location.reload();},
				failure: function(err){alert(err);},
			});
}
function sendSMS1333(){
			
			var urlkey2333="http://sms.realkeeper.in/ComposeSMS.aspx?username=nakul&password=8585&sender=TXTSMS&to="+phoneno333+"&message=Hi "+pname333+", "+document.getElementById("namet333").value+"&priority=1&dnd=1&unicode=0";
			
			$.ajax({
				
				url: urlkey2333,
				method: "GET",
				
				success: function(result){alert("SMS Sent");
				document.getElementById("smsCard333").style.display="none";},
				failure: function(err){alert(err);},
				
			});
}
function closeit1333(){
	document.getElementById("smsCard333").style.display="none";
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
<div class="page-wrapper">


<!-- *******************************************************************************************************-->	

<?php	include ("header.php"); ?>

<!-- *******************************************************************************************************-->		
		<div class="page-container">
            <!-- HEADER DESKTOP-->
				
                                <div class="card" id="card333" style="width:auto; height:148px; position: fixed; z-index:99; top:30%; left:40%; border: 10px solid pink; display:none;">
                                    <div class="card-header">
                                        <span id="cardName333"><strong>Name</strong></span>
                                        <small>'s Lead</small>
										<button type="button" class="btn btn-danger" onclick="closeit333();" style="float:right; height: 23px; width:20px; padding: 0px;">X</button>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" onclick="sendSMS333();" class="btn btn-primary">Send SMS</button>
                                        <!--<button type="button" onclick="sendMAIL333();" class="btn btn-secondary">Send Email</button>-->
                                        <button type="button" onclick="handleIt333();" class="btn btn-success">Mark as Handled</button>
                                    </div>
                                </div>
                                <div class="card" id="smsCard333" style="width:500px; height:auto; position: fixed; z-index:99; top:20%; left:40%; border: 10px solid pink; display:none;">
                                    <div class="card-header">
                                        <span id="cardName1333"><strong>Name</strong></span>
                                        <small>'s Lead</small>
										<button type="button" class="btn btn-danger" onclick="closeit1333();" style="float:right; height: 23px; width:20px; padding: 0px;">X</button>
                                    </div>
                                    <div class="card-body">
                                        <!--<input type="number" id="phoneno" class="form-control">-->
										<textarea name="textarea-input" id="namet333" rows="9" placeholder="Message" class="form-control"></textarea>
										<button type="button" onclick="sendSMS1333();" class="btn btn-primary">Send SMS</button>
                                        
                                    </div>
                                </div>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
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
						
	
						$sql = "select * from bookmytrip";
						$result = $conn->query($sql);

						if($result->num_rows>0){
							echo "<div class='row'>
                            <div class='col-lg-12'>
                                <h2 class='title-1 m-b-25'>Leads (Unhandled)</h2>
                                <div class='table-responsive table--no-card m-b-40'>
                                    <table class='table table-borderless table-striped table-earning'>
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Name</th>
                                                <th>Activities</th>
                                                <th>Destination</th>
                                                <th class='text-right'>Date of Travel</th>
                                                <th class='text-right'>Contact Number</th>
                                                
                                            </tr>
                                        </thead>
										<tbody>";
							while($row = $result->fetch_assoc()){
								if($row["isHandled3"]==0)
								
									echo "<tr onclick='showcard333(this);'><td>" .$row["sno"]."</td><td>". $row["name"]. "</td><td>" . $row["activities"]."</td><td>" . $row["destination"]."</td><td class='text-right'>" . $row["date"]."</td><td class='text-right'>" . $row["contact"]. "</td></tr>";
									
							
							}
							echo "		</tbody>
                                    </table>
                                </div>
                            </div>
							</div>";
						} else {
							echo "0 results";
						}
						
						$sql = "select * from bookmytrip";
						$result = $conn->query($sql);

						if($result->num_rows>0){
							echo "<div class='row'>
                            <div class='col-lg-12'>
                                <h2 class='title-1 m-b-25'>Leads (Handled)</h2>
                                <div class='table-responsive table--no-card m-b-40'>
                                    <table class='table table-borderless table-striped table-earning'>
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Name</th>
                                                <th>Activities</th>
                                                <th>Destination</th>
                                                <th class='text-right'>Date of Travel</th>
                                                <th class='text-right'>Contact Number</th>
                                                
                                            </tr>
                                        </thead>
										<tbody>";
							while($row = $result->fetch_assoc()){
								if($row["isHandled3"]==1)
								
									echo "<tr><td>" . $row["sno"]. "</td><td>" . $row["name"]. "</td><td>" . $row["activities"]."</td><td>" . $row["destination"]."</td><td class='text-right'>" . $row["date"]."</td><td class='text-right'>" . $row["contact"]. "</td></tr>";
									
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
						
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 RealKeepers. All rights reserved. </p>
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
