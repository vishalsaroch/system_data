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
var pname,phoneno,pemail,packname,date,descr,country,city,packid111;
function showcard(element){
	
document.getElementById("card").style.display="inline";
//alert(element.childNodes[4].innerHTML);
document.getElementById("cardName").innerHTML=element.childNodes[5].innerHTML;
pname=element.childNodes[5].innerHTML;
phoneno=element.childNodes[9].innerHTML;
pemail=element.childNodes[6].innerHTML;
// packname=element.childNodes[0].innerHTML;
// date=element.childNodes[1].innerHTML;
// descr=element.childNodes[3].innerHTML;
// country=element.childNodes[6].innerHTML;
// city=element.childNodes[7].innerHTML;
packid111=element.childNodes[0].innerHTML;
}
function closeit(){
	document.getElementById("card").style.display="none";
}
function closeit1(){
	document.getElementById("smsCard").style.display="none";
}
function closeit2(){
	document.getElementById("mailCard").style.display="none";
}
function sendSMS(){
			document.getElementById("card").style.display="none";
			document.getElementById("cardName1").innerHTML=pname;
			document.getElementById("smsCard").style.display="inline";
			
}
function sendSMS1(){
			
			var urlkey2="http://sms.realkeeper.in/ComposeSMS.aspx?username=nakul&password=8585&sender=TXTSMS&to="+phoneno+"&message=Hi "+pname+", "+document.getElementById("namet").value+"&priority=1&dnd=1&unicode=0";
			
			$.ajax({
				
				url: urlkey2,
				method: "GET",
				
				success: function(result){alert("SMS Sent");
				document.getElementById("smsCard").style.display="none";},
				failure: function(err){alert(err);},
				
			});
}
function sendMAIL(){
			document.getElementById("card").style.display="none";
			document.getElementById("cardName2").innerHTML=pname;
			document.getElementById("mailCard").style.display="inline";
			document.getElementById("name4").value=pname;
			document.getElementById("email4").value=pemail;
}
$(function() {
		$("#sendmail").submit(function(e){
			e.preventDefault();    
			var formData = new FormData(this);
						
			var urlkey
			
			if(location.hostname=='localhost')
			{
				urlkey = "/project2/admin/sendmail3.php";
			}
			else if(location.hostname=='www.arkglobalholidays.co.in')
			{
				urlkey = "sendmail3.php";
			}
			
			
			
			$.ajax({
				
				url: urlkey,
				method: "POST",
				data: formData,
				success: function(result){alert("mail sent");
				document.getElementById("mailCard").style.display="none";},
				failure: function(err){alert(err);},
				cache: false,
				contentType: false,
				processData: false
				
			});
			
			return(false);
		});
	});
    function handleIt(){
	var urlkey3 = "/project2/admin/markHandled111.php?packid111="+packid111;
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
/*function handleIt(){
	var urlkey3 = "/project2/admin/markHandled.php?pname="+pname+"&phoneno="+phoneno+"&pemail="+pemail+"&packname="+packname+"&date="+date+"&descr="+descr+"&country="+country+"&city="+city;
	//alert(urlkey3);
	$.ajax({
				url: urlkey3,
				method: "GET",
				success: function(result){alert("Query marked as handled.");
				document.getElementById("card").style.display="none";
				location.reload();},
				failure: function(err){alert(err);},
			});
}*/



















var pname222,phoneno222,pemail222,packid222;
function showcard222(element){
	
    document.getElementById("card222").style.display="inline";
    //alert(element.childNodes[4].innerHTML);
    document.getElementById("cardName222").innerHTML=element.childNodes[1].innerHTML;
    pname222=element.childNodes[1].innerHTML;
    phoneno222=element.childNodes[3].innerHTML;
    pemail222=element.childNodes[2].innerHTML;
    packid222=element.childNodes[0].innerHTML;
    
    }
function closeit222(){
	document.getElementById("card222").style.display="none";
}
function sendSMS222(){
			document.getElementById("card222").style.display="none";
			document.getElementById("cardName1222").innerHTML=pname222;
			document.getElementById("smsCard222").style.display="inline";
			
}
function sendMAIL222(){
			document.getElementById("card222").style.display="none";
			document.getElementById("cardName2222").innerHTML=pname222;
			document.getElementById("mailCard222").style.display="inline";
			document.getElementById("name4222").value=pname222;
			document.getElementById("email4222").value=pemail222;
}
function handleIt222(){
	var urlkey3222 = "/project2/admin/markHandled222.php?packid222="+packid222;
	//alert(urlkey3);
	$.ajax({
				url: urlkey3222,
				method: "GET",
				success: function(result){alert("Query marked as handled.");
				document.getElementById("card222").style.display="none";
				location.reload();},
				failure: function(err){alert(err);},
			});
}
function sendSMS1222(){
			
			var urlkey2222="http://sms.realkeeper.in/ComposeSMS.aspx?username=nakul&password=8585&sender=TXTSMS&to="+phoneno222+"&message=Hi "+pname222+", "+document.getElementById("namet222").value+"&priority=1&dnd=1&unicode=0";
			
			$.ajax({
				
				url: urlkey2222,
				method: "GET",
				
				success: function(result){alert("SMS Sent");
				document.getElementById("smsCard222").style.display="none";},
				failure: function(err){alert(err);},
				
			});
}
function closeit1222(){
	document.getElementById("smsCard222").style.display="none";
}
function closeit2222(){
	document.getElementById("mailCard222").style.display="none";
}
$(function() {
		$("#sendmail222").submit(function(e){
			e.preventDefault();    
			var formData = new FormData(this);
						
			var urlkey
			
			if(location.hostname=='localhost')
			{
				urlkey222 = "/project2/admin/sendmail3.php";
			}
			else if(location.hostname=='www.arkglobalholidays.co.in')
			{
				urlkey222 = "sendmail3.php";
			}
			
			
			
			$.ajax({
				
				url: urlkey222,
				method: "POST",
				data: formData,
				success: function(result){alert("mail sent");
				document.getElementById("mailCard222").style.display="none";},
				failure: function(err){alert(err);},
				cache: false,
				contentType: false,
				processData: false
				
			});
			
			return(false);
		});
	});








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
								<div class="card" id="card" style="width:auto; height:148px; position: fixed; z-index:99; top:30%; left:40%; border: 10px solid pink; display:none;">
                                    <div class="card-header">
                                        <span id="cardName"><strong>Name</strong></span>
                                        <small>'s Lead</small>
										<button type="button" class="btn btn-danger" onclick="closeit();" style="float:right; height: 23px; width:20px; padding: 0px;">X</button>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" onclick="sendSMS();" class="btn btn-primary">Send SMS</button>
                                        <button type="button" onclick="sendMAIL();" class="btn btn-secondary">Send Email</button>
                                        <button type="button" onclick="handleIt();" class="btn btn-success">Mark as Handled</button>
                                    </div>
                                </div>
								<div class="card" id="smsCard" style="width:500px; height:auto; position: fixed; z-index:99; top:20%; left:40%; border: 10px solid pink; display:none;">
                                    <div class="card-header">
                                        <span id="cardName1"><strong>Name</strong></span>
                                        <small>'s Lead</small>
										<button type="button" class="btn btn-danger" onclick="closeit1();" style="float:right; height: 23px; width:20px; padding: 0px;">X</button>
                                    </div>
                                    <div class="card-body">
                                        <!--<input type="number" id="phoneno" class="form-control">-->
										<textarea name="textarea-input" id="namet" rows="9" placeholder="Message" class="form-control"></textarea>
										<button type="button" onclick="sendSMS1();" class="btn btn-primary">Send SMS</button>
                                        
                                    </div>
                                </div>
								<div class="card" id="mailCard" style="width:500px; height:auto; position: fixed; z-index:99; top:20%; left:40%; border: 10px solid pink; display:none;">
                                    <div class="card-header">
                                        <span id="cardName2"><strong>Name</strong></span>
                                        <small>'s Lead</small>
										<button type="button" class="btn btn-danger" onclick="closeit2();" style="float:right; height: 23px; width:20px; padding: 0px;">X</button>
                                    </div>
                                    <div class="card-body">
                                        <form id="sendmail" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
											<input type="text" name="name" id="name4" class="form-control" style="display:none">
											To:<input type="text" name="email" id="email4" class="form-control" style="display:inline">
											<input type="text" name="subject" id="subject" placeholder="Subject" class="form-control" required>
											<input type="file" name="file45" class="form-control">
											<textarea name="message" id="" rows="9" placeholder="Message" class="form-control" required></textarea>
											<input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary btn-sm">
                                        </form>
                                    </div>
                                </div>

                                <div class="card" id="card222" style="width:auto; height:148px; position: fixed; z-index:99; top:30%; left:40%; border: 10px solid pink; display:none;">
                                    <div class="card-header">
                                        <span id="cardName222"><strong>Name</strong></span>
                                        <small>'s Lead</small>
										<button type="button" class="btn btn-danger" onclick="closeit222();" style="float:right; height: 23px; width:20px; padding: 0px;">X</button>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" onclick="sendSMS222();" class="btn btn-primary">Send SMS</button>
                                        <button type="button" onclick="sendMAIL222();" class="btn btn-secondary">Send Email</button>
                                        <button type="button" onclick="handleIt222();" class="btn btn-success">Mark as Handled</button>
                                    </div>
                                </div>
                                <div class="card" id="smsCard222" style="width:500px; height:auto; position: fixed; z-index:99; top:20%; left:40%; border: 10px solid pink; display:none;">
                                    <div class="card-header">
                                        <span id="cardName1222"><strong>Name</strong></span>
                                        <small>'s Lead</small>
										<button type="button" class="btn btn-danger" onclick="closeit1222();" style="float:right; height: 23px; width:20px; padding: 0px;">X</button>
                                    </div>
                                    <div class="card-body">
                                        <!--<input type="number" id="phoneno" class="form-control">-->
										<textarea name="textarea-input" id="namet222" rows="9" placeholder="Message" class="form-control"></textarea>
										<button type="button" onclick="sendSMS1222();" class="btn btn-primary">Send SMS</button>
                                        
                                    </div>
                                </div>
                                <div class="card" id="mailCard222" style="width:500px; height:auto; position: fixed; z-index:99; top:20%; left:40%; border: 10px solid pink; display:none;">
                                    <div class="card-header">
                                        <span id="cardName2222"><strong>Name</strong></span>
                                        <small>'s Lead</small>
										<button type="button" class="btn btn-danger" onclick="closeit2222();" style="float:right; height: 23px; width:20px; padding: 0px;">X</button>
                                    </div>
                                    <div class="card-body">
                                        <form id="sendmail222" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
											<input type="text" name="name" id="name4222" class="form-control" style="display:none">
											To:<input type="text" name="email" id="email4222" class="form-control" style="display:inline">
											<input type="text" name="subject" id="subject" placeholder="Subject" class="form-control" required>
											<input type="file" name="file45" class="form-control">
											<textarea name="message" id="" rows="9" placeholder="Message" class="form-control" required></textarea>
											<input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary btn-sm">
                                        </form>
                                    </div>
                                </div>

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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>add item</button>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2>10368</h2>
                                                <span>members online</span>
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
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2>388,688</h2>
                                                <span>items solid</span>
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
                                                <h2>1,086</h2>
                                                <span>this week</span>
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
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <div class="text">
                                                <h2>$1,060,386</h2>
                                                <span>total earnings</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
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
						
						$sql = "select * from enquiry";
						$result = $conn->query($sql);

						if($result->num_rows>0){
							echo "<div class='row'>
                            <div class='col-lg-12'>
                                <h2 class='title-1 m-b-25'>Leads 1 (Unhandled)</h2>
                                <div class='table-responsive table--no-card m-b-40'>
                                    <table class='table table-borderless table-striped table-earning'>
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Package Name</th>
                                                <th>Date</th>
												<th>persons</th>
                                                <th>Desciption</th>
                                                <th>Name</th>
												<th>Email</th>
                                                <th>Country</th>
                                                <th>City</th>
												<th>Contact</th>
												
                                            </tr>
                                        </thead>
										<tbody>";
							while($row = $result->fetch_assoc()){
								if($row["isHandled"]==0)
								
									echo "<tr onclick='showcard(this);'><td>" . $row["sno"]. "</td><td>". $row["packname"]. "</td><td>" . $row["date"]. "</td><td>" . $row["adultC"]."Adults & ".$row["childC"]." Childs</td><td>" . $row["descr"]."</td><td>" . $row["name"]."</td><td>" . $row["email"]. "</td><td>" . $row["country"]."</td><td>" . $row["city"]."</td><td>" . $row["contact"]."</td></tr>";
									
							}
							echo "		</tbody>
                                    </table>
                                </div>
                            </div>
							</div>";
						} else {
							echo "0 results";
						}
						
						$sql2 = "select * from contactus";
						$result2 = $conn->query($sql2);

						if($result2->num_rows>0){
							echo "<div class='row'>
                            <div class='col-lg-12'>
                                <h2 class='title-1 m-b-25'>Leads 2 (Unhandled)</h2>
                                <div class='table-responsive table--no-card m-b-40'>
                                    <table class='table table-borderless table-striped table-earning'>
                                        <thead>
                                            <tr>
                                                <th>sno</th>
                                                <th>Name</th>
                                                <th>Email Id</th>
                                                <th>Contact No</th>
                                                <th class='text-right'>Subject</th>
                                                <th class='text-right'>Message</th>
                                                
                                            </tr>
                                        </thead>
										<tbody>";
							while($row = $result2->fetch_assoc()){
								if($row["isHandled2"]==0)
									echo "<tr onclick='showcard222(this);'><td>" .$row["sno"]."</td><td>". $row["name"]. "</td><td>" . $row["email"]."</td><td>" . $row["contact"]."</td><td class='text-right'>" . $row["subject"]."</td><td class='text-right'>" . $row["message"]."</td></tr>";
									
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
                                <h2 class='title-1 m-b-25'>Leads 3 (Unhandled)</h2>
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
