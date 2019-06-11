<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: ./login1/index.php");  
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
<html>
<head>
<title>Mavy Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">                                   <!-- Templatemo style -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(function() {
		$("#uploadForm").submit(function(e){
			e.preventDefault();    
			var formData = new FormData(this);
			var urlkey
			if(location.hostname=='localhost')
			{
				urlkey = "/project3_1/uploadForm1.php";
			}
			else if(location.hostname=='arjjsngo.org.in')
			{
				urlkey = "uploadForm1.php";
			}
 			var urlkey2="https://sms.realkeeper.in/ComposeSMS.aspx?username=nakul&password=8585&sender=ARJNGO&to="+document.getElementById("hmobile").value.toString()+"&message=Hi "+document.getElementById("hname").value+", PM Awas Yojna me registration Karne ke liya dhaynvad apka ragistration pura ho chuka hai. Lucky draws will be opened on 1 April 2022. Registration number : 4376"+document.getElementById("aadhar98").value.substr(8)+"&priority=1&dnd=1&unicode=1";
 			//var urlkey2="https://sms.realkeeper.in/ComposeSMS.aspx?username=nakul&password=8585&sender=ARJNGO&to="+document.getElementById("hmobile").value.toString()+"&message=Hi "+document.getElementById("hname").value+" , महिला आवास योजना में रजिस्ट्रेशन करने के लिए धन्यवाद आपका रजिस्ट्रेशन पूरा हो चूका है। नंबर : 4376"+document.getElementById("aadhar98").value.substr(8)+"&priority=1&dnd=1&unicode=1";
			$.ajax({
				
				url: urlkey,
				method: "POST",
				data: formData,
				success: function(result){alert(result);//alert("Form has been submitted. Thank You.");//fnametodb();
						$.ajax({
							url: urlkey2,
							method: "GET",
							success: function(){alert("sms sent!");
							},
							failure: function(err){alert(err);},
							});
				},
				failure: function(err){alert(err);},
				cache: false,
				contentType: false,
				processData: false
				
			});
			
			return(false);
		});
	});
 </script>
</head>

    <body>
       <?php 
     
          // Display message about account verification link only once
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];
              
              // Don't annoy the user with more messages upon page refresh
              unset( $_SESSION['message'] );
          }
          
          ?>
          
          
          <?php
          
          // Keep reminding the user this account is not active, until they activate
          if ( !$active ){
              header("location: ./login1/index.php");
			  exit();
          }
          
          ?>
        <div class="bg-top navbar-light">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-center align-items-stretch">
    			<div class="col-md-4 d-flex align-items-center py-4">
    				<a class="navbar-brand" href="index.html"><!-- <span class="flaticon-bee mr-1"></span> -->Mavy</a>
    			</div>
	    		<div class="col-lg-8 d-block">
		    		<div class="row d-flex">
					    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
					    	<div class="icon d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
					    	<div class="text d-flex align-items-center">
						    	<span>youremail@email.com</span>
						    </div>
					    </div>
					    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
					    	<div class="icon d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <div class="text d-flex align-items-center">
						    	<span>Call Us: + 1235 2355 98</span>
						    </div>
					    </div>
					    <div class="col-md topper d-flex align-items-center align-items-stretch">
					    	<p class="mb-0 d-flex d-block">
					    		<a href="login1/logout.php" class="btn btn-primary d-flex align-items-center justify-content-center">
					    			<span>Logout</span>
					    		</a>
					    	</p>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menu
                </button>
                <form action="search.php" class="searchform order-lg-last" method="post">
                <div class="form-group d-flex">
                    <input type="text" class="form-control pl-3" placeholder="Search" name="name">
                    <button type="submit" placeholder="" class="form-control search"><span class="ion-ios-search"></span></button>
                </div>
                </form>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="index.html" class="nav-link pl-0">Home</a></li>
                        <li class="nav-item active"><a href="blog.php" class="nav-link">Register</a></li>
                        <li class="nav-item"><a href="report.php" class="nav-link">Report</a></li>
                        <!-- <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
                        <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <section class="ftco-no-pt ftco-margin-top">
    	<div class="container">
    		<div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-xs-center"><br>
                    <h2 class="tm-gold-text tm-title text-cecter">महिला आवास विकास योजना</h2>
                    <!--<h3>Housing For All (urban)</h3>-->
                </div>
            </div>
        </div>
    </section>
    <div class="page-wrapper"><section class="ftco-no-pt ftco-margin-top">
    	<div class="container">
    		<div class="row"> 
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Registration Form</strong>
                                </div>
                                <div class="card-body card-block">
                                    <form id="uploadForm" action="uploadForm.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Applicant Name</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="hname" name="hname" placeholder="" class="form-control" required>
                                                
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label class=" form-control-label">Gender?</label>
                                            </div>
                                            <div class="col col-md-9">
                                                <div class="form-check-inline form-check">
                                                    <label for="inline-radio1" class="form-check-label ">
                                                        <input type="radio" id="inline-radio1" name="hgender" value="1" class="form-check-input" required>Male &nbsp; &nbsp; &nbsp;
                                                    </label>
                                                    <label for="inline-radio2" class="form-check-label ">
                                                        <input type="radio" id="inline-radio2" name="hgender" value="0" class="form-check-input">Female
                                                    </label>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Date of Birth</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="date" id="text-input" name="hage" placeholder="" class="form-control" required>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Father/Husband's name</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <div class="form-check-inline form-check">
                                                    <label for="inline-radio1" class="form-check-label ">
                                                        <input type="radio" id="inline-radio1" name="fathorhusb" value="1" class="form-check-input" required>Father &nbsp; &nbsp; &nbsp;
                                                    </label>
                                                    <label for="inline-radio2" class="form-check-label ">
                                                        <input type="radio" id="inline-radio2" name="fathorhusb" value="0" class="form-check-input">Husband
                                                    </label>
                                                    
                                                </div>
                                                <input type="text" id="text-input" name="hfather" placeholder="" class="form-control" required>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Present Address and Contact Details</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="text-input" name="haddress" placeholder="" class="form-control" required>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">House/ Flat / Door no.</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="text-input" name="hdoor" placeholder="" class="form-control">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Name of Street</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="text-input" name="hstreet" placeholder="" class="form-control">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">City (name)</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="text-input" name="hcity" placeholder="" class="form-control">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Captial State ( Name )</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="text-input" name="hstate" placeholder="" class="form-control" required>
                                                
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Since How Long Living in Delhi (years)</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="number" id="text-input" name="yearsinD" placeholder="" class="form-control" required>
                                                
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Bank Account</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="text-input" name="bankAcc" placeholder="" class="form-control" required>
                                                
                                            </div>
                                        </div>
                                                                            
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Mobile number</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="number" id="hmobile" name="hmobile" placeholder="" class="form-control" required>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Apply</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                    <select name="hotherid" class="form-control">
                                                        <option value="Flat">Flat</option>
                                                        <option value="Construction">Construction</option>
                                                        <option value="Subsidy">Subsidy</option>
                                                        
                                                    </select> 
                                                <!--<input type="text" id="text-input" name="hotherid" placeholder="" class="form-control">-->
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">squre feet</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="text-input" name="magerment" placeholder="" class="form-control">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Aadhaar Number</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="aadhar98" name="haadhar" placeholder="" class="form-control" required>
                                                
                                            </div>
                                        </div>
                                        
                                        <table>
                                                <tr>
                                                    <td>S.no.</td><td>Name</td><td>Relation</td><td>Gender</td><td>age</td><td>Aadhar Number</td><td>Other ID type</td><td>Other ID number</td>
                                                </tr>
                                        
                                            <tr>
                                                <td><input type="text" id="text-input" value="1" name="" class="form-control" style="width: 45px;" disabled></td><td><input type="text" id="text-input" name="name1" class="form-control"></td><td><input type="text" id="text-input" name="relation1" class="form-control"></td><td><input type="text" id="text-input" name="gender1" class="form-control"></td><td><input type="text" id="text-input" name="age1" class="form-control"></td><td><input type="text" id="text-input" name="aadhar1" class="form-control"></td><td><input type="text" id="text-input" name="otherid1" class="form-control"></td><td><input type="text" id="text-input" name="otheridno1" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" id="text-input" value="2" name="" class="form-control" style="width: 45px;" disabled></td><td><input type="text" id="text-input" name="name2" class="form-control"></td><td><input type="text" id="text-input" name="relation2" class="form-control"></td><td><input type="text" id="text-input" name="gender2" class="form-control"></td><td><input type="text" id="text-input" name="age2" class="form-control"></td><td><input type="text" id="text-input" name="aadhar2" class="form-control"></td><td><input type="text" id="text-input" name="otherid2" class="form-control"></td><td><input type="text" id="text-input" name="otheridno2" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" id="text-input" value="3" name="" class="form-control" style="width: 45px;" disabled></td><td><input type="text" id="text-input" name="name3" class="form-control"></td><td><input type="text" id="text-input" name="relation3" class="form-control"></td><td><input type="text" id="text-input" name="gender3" class="form-control"></td><td><input type="text" id="text-input" name="age3" class="form-control"></td><td><input type="text" id="text-input" name="aadhar3" class="form-control"></td><td><input type="text" id="text-input" name="otherid3" class="form-control"></td><td><input type="text" id="text-input" name="otheridno3" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" id="text-input" value="4" name="" class="form-control" style="width: 45px;" disabled></td><td><input type="text" id="text-input" name="name4" class="form-control"></td><td><input type="text" id="text-input" name="relation4" class="form-control"></td><td><input type="text" id="text-input" name="gender4" class="form-control"></td><td><input type="text" id="text-input" name="age4" class="form-control"></td><td><input type="text" id="text-input" name="aadhar4" class="form-control"></td><td><input type="text" id="text-input" name="otherid4" class="form-control"></td><td><input type="text" id="text-input" name="otheridno4" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" id="text-input" value="5" name="" class="form-control" style="width: 45px;" disabled></td><td><input type="text" id="text-input" name="name5" class="form-control"></td><td><input type="text" id="text-input" name="relation5" class="form-control"></td><td><input type="text" id="text-input" name="gender5" class="form-control"></td><td><input type="text" id="text-input" name="age5" class="form-control"></td><td><input type="text" id="text-input" name="aadhar5" class="form-control"></td><td><input type="text" id="text-input" name="otherid5" class="form-control"></td><td><input type="text" id="text-input" name="otheridno5" class="form-control"></td>
                                            </tr>
                                        </table>	
                                        <!--<button type="button" class="btn btn-primary btn-sm" onclick="addRow();">+ Add row</button>-->
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label class=" form-control-label">Whether Person with Disability?</label>
                                            </div>
                                            <div class="col col-md-9">
                                                <div class="form-check-inline form-check">
                                                    <label for="inline-radio1" class="form-check-label ">
                                                        <input type="radio" id="inline-radio1" name="hdisability" value="1" class="form-check-input" required>Yes &nbsp; &nbsp; &nbsp;
                                                    </label>
                                                    <label for="inline-radio2" class="form-check-label ">
                                                        <input type="radio" id="inline-radio2" name="hdisability" value="0" class="form-check-input">No
                                                    </label>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label class=" form-control-label">Married?</label>
                                            </div>
                                            <div class="col col-md-9">
                                                <div class="form-check-inline form-check">
                                                    <label for="inline-radio1" class="form-check-label ">
                                                        <input type="radio" id="inline-radio1" name="hmarried" value="1" class="form-check-input" required>Yes &nbsp; &nbsp; &nbsp;
                                                    </label>
                                                    <label for="inline-radio2" class="form-check-label ">
                                                        <input type="radio" id="inline-radio2" name="hmarried" value="0" class="form-check-input">No
                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label for="inline-radio2" class="form-check-label ">
                                                        <input type="radio" id="inline-radio2" name="hmarried" value="2" class="form-check-input">Divorcy
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label for="inline-radio2" class="form-check-label ">
                                                        <input type="radio" id="inline-radio2" name="hmarried" value="3" class="form-check-input">Widow
                                                    </label>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Present Rent(INR)</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="number" id="text-input" name="hrent" placeholder="" class="form-control">
                                                
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Monthly Income(INR)</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="number" id="text-input" name="hincome" placeholder="" class="form-control" required>
                                                
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary btn-sm" >
                                            <button type="reset" class="btn btn-danger btn-sm">
                                                <i class="fa fa-ban"></i> Reset
                                            </button>
                                        </div>
                                        
                                    </form>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>      
                    
                </div>
            </div>
        </div>
    
    </sction>
        
        
    <footer class="ftco-footer ftco-bg-dark" style="padding-bottom:-20px; ">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-5">
              <h2 class="ftco-heading-2 logo">महिला आवास विकास योजना</h2>
              <p>अब हर महिला के नाम पर होगा अपना घर, अपनी जमीन इस योजना का निर्माण समाज में महिलाओं के सम्मान,महिलाओं के औदे को ऊंचा उठाने और महिलाओं को असह्याय या बेसहारा न समझने के लिए किया गया है। </p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
            
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-5 ml-md-4">
              <h2 class="ftco-heading-2">Services</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Construction</a></li>
                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Renovation</a></li>
                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Painting</a></li>
                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Interior Design</a></li>
                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Exterior Design</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-5">
            <div class="ftco-footer-widget mb-5">
              <h2 class="ftco-heading-2">Recent Blog</h2>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> Feb. 07, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
              <div class="block-21 mb-5 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> Feb. 07, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="col-md">
            <div class="ftco-footer-widget mb-5">
            	<h2 class="ftco-heading-2">Newsletter</h2>
              <form action="#" class="subscribe-form">
                <div class="form-group">
                  <input type="text" class="form-control mb-2 text-center" placeholder="Enter email address">
                  <input type="submit" value="Subscribe" class="form-control submit px-3">
                </div>
              </form>
            </div>
          </div> -->
          <div class="col-md-12 text-center">
          	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  					Copyright &copy;<script>document.write(new Date().getFullYear());</script> | Design And Developed by <a href="https://rws.realkeeper.in" target="_blank">Realkeeper Technologies</a>
  					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
  				</div>
    </footer>

        <!-- load JS files -->
        <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
        <script src="https://www.atlasestateagents.co.uk/javascript/tether.min.js"></script> <!-- Tether for Bootstrap, http://stackoverflow.com/questions/34567939/how-to-fix-the-error-error-bootstrap-tooltips-require-tether-http-github-h --> 
        <script src="js/bootstrap.min.js"></script>                 <!-- Bootstrap (http://v4-alpha.getbootstrap.com/) -->
       
</body>
</html>