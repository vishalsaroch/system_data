<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: ./login2/index.php");  
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Aadarsh Rekha Jeevan Jyoti Society (N.G.O)</title>
<!--
Classic Template
http://www.arjjsngo.com/tm-488-classic
-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" href="css/templatemo-style.css">                                   <!-- Templatemo style -->
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
			var urlkey2="http://sms.realkeeper.in/ComposeSMS.aspx?username=nakul&password=8585&sender=TXTSMS&to="+document.getElementById("hmobile").value.toString()+"&message=Hi "+document.getElementById("hname").value+", Adarsh rekha jiwan jyoti soceity  Ayushman Bharat Yojna me ragistraion karne ke liye dhanyvad apka ragistraion pura ho chuka hai. Registration number : 9876"+document.getElementById("ration98").value.substr(6)+"&priority=1&dnd=1&unicode=0";
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
          </p>
          
          <?php
          
          // Keep reminding the user this account is not active, until they activate
          if ( !$active ){
              header("location: ./login2/index.php");
			  exit();
          }
          
          ?>
        <div class="tm-header">
            <div class="container-fluid">
                <div class="tm-header-inner">
         <a href="#" class="navbar-brand tm-site-name">ARJJS NGO</a>
                    

                    <!-- navbar -->
                    <nav class="navbar tm-main-nav">

                        <button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse" data-target="#tmNavbar">
                            &#9776;
                  </button>
                        
                        <div class="collapse navbar-toggleable-sm" id="tmNavbar">
                            <ul class="nav navbar-nav">
                                <li class="nav-item active">
                                    <a href="index.html" class="nav-link">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="about.html" class="nav-link">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="blog.php" class="nav-link">Housing form</a>
                                </li>
                                <li class="nav-item">
                                    <a href="blog1.php" class="nav-link">Reg. form</a>
                                </li>
                                <li class="nav-item">
                                    <a href="contact.html" class="nav-link">Contact</a>
                                </li>
                            </ul>                        
                        </div>
                        
                    </nav>  

                </div>                                  
            </div>            
        </div>

        <!--<div class="tm-blog-img-container">
            
        </div>-->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-xs-center">
                        <h2 class="tm-gold-text tm-title">आदर्श रेखा जीवन ज्योति सोसाइटी</h2>
						<h3>Ayushman Bharat Yojna</h3>
                    </div>
        <div class="page-wrapper">
        
            <!-- MAIN CONTENT-->
            <!--<div class="main-content">-->
                <div class="section__content section__content--p75">
                    <div class="container-fluid">
                        <div class="row">
                            
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Registration Form</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form id="uploadForm" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                                                    <input type="text" id="text-input" name="hage" placeholder="" class="form-control" required>
                                                    
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
                                                    <label for="text-input" class=" form-control-label">Ration Card No.</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="ration98" name="bankAcc" placeholder="" class="form-control" required>
                                                    
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
                                                    <label for="text-input" class=" form-control-label">Other ID type</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="hotherid" placeholder="" class="form-control">
                                                    
                                                </div>
                                            </div>
											
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Aadhaar Number</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="haadhar" placeholder="" class="form-control" required>
                                                    
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
        
        
        <footer class="tm-footer">
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        
                        <div class="tm-footer-content-box">
                                
                            </div>    
                        </div>
                                                
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="tm-footer-content-box tm-footer-links-container">
                        
                            
                            </nav>

                        </div>
                        
                    </div>

                    
                    <div class="clearfix hidden-lg-up"></div>

                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">

                        <div class="tm-footer-content-box">
                        
                          

                        </div>
                        
                    </div>

                    

                        </div>
                        
                    </div>


                </div>

                <div class="row">
                    <div class="col-xs-12 tm-copyright-col">
                        <p class="tm-copyright-text">Copyright 2018 आदर्श रेखा जीवन ज्योति सोसाइटी</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- load JS files -->
        <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
        <script src="https://www.atlasestateagents.co.uk/javascript/tether.min.js"></script> <!-- Tether for Bootstrap, http://stackoverflow.com/questions/34567939/how-to-fix-the-error-error-bootstrap-tooltips-require-tether-http-github-h --> 
        <script src="js/bootstrap.min.js"></script>                 <!-- Bootstrap (http://v4-alpha.getbootstrap.com/) -->
       
</body>
</html>