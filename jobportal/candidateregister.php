<!DOCTYPE html>
<html>
    <head>
        <title>Fresher Registration</title>
        <link rel="icon" href="images/logo.png" type="image/png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
            <div class="container">
              <a href="index.php"><img src="images/logo.png"></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span>
              </button>

              <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item cta cta-colored"><a href="login/index.php" class="nav-link">Login</a></li>
                </ul>
              </div>
            </div>
        </nav>
        <!-- END nav -->
        
        <div class="ftco-section bg-light">
          <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="p-4 mb-3 bg-white">
                      <img src="images/icon_1.png" class="img-responsive" />
                    </div>
                </div>
           
                <div class="col-md-12 col-lg-8 mb-5">
                    <form action="" method="post" id="ExperinceRegister" enctype="multipart/form-data" class="p-5 bg-white">

                        <h2 class="text-center text-primary">Candidate Registration</h2>
                        <?php include("config.php");?>
						<?php
                        
                        if(isset($_POST['submit']))
                        {
                        $fname=$_POST['fname']; 
                        $lname=$_POST['lname'];     
                        $emailid=$_POST['email'];
                        $mobileno=$_POST['txtEmpPhone'];
                        $qualification=$_POST['qua'];
                        $jobtitle=$_POST['job'];
                        $userid=$_POST['email'];
                        $pwd=$_POST['Password'];
                        $date=date("Y/m/d");
                        $sql = "SELECT * from `candidate` WHERE emailid = '".$emailid."'";      
                        $result1 = $conn->query($sql);
                        if ($result1->num_rows > 0) {
                        echo "<div class='bg-danger text-light text-center'>Email id already exist.</div>";
                        } else {
                        $sql = "INSERT INTO `candidate` (`fname`, `lname`, `emailid`, `mobileno`, `qualification`, `jobtitle`, `userid`, `pwd`, `date`) VALUES ('$fname', '$lname', '$emailid', '$mobileno', '$qualification', '$jobtitle', '$userid', '$pwd', '$date')";

                        if ($conn->query($sql) === TRUE) {
                            // echo "Compamy Register Successfully";
                            session_start();
                                $_SESSION['email'] = $userid;
                                $_SESSION['first_name'] = $fname;
                                $_SESSION['last_name'] = " ";
                                $_SESSION['active'] = 1;    
                                
                                // This is how we'll know the user is logged in
                                $_SESSION['logged_in'] = true;

                                echo "<script>location='./candidate/profile.php'</script>";
                                exit();
                                // header("location:employee/profile.php");
                                } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }
                                $conn->close(); 
                        }
                        ?>
                        <div class="row form-group">
                            <div class="col-md-12" style="margin-top: 20px;">
                                <input type="text" id ="name123" name="fname" class="form-control" placeholder="First Name *" required />
                            </div>
                            <div class="col-md-12" style="margin-top: 20px;" style="margin-top: 20px;">
                                <input type="text" name="lname" class="form-control" placeholder="Last Name *"  required />
                            </div>

                            <div class="col-md-12" style="margin-top: 20px;">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Your Email *"  required/>
                            </div>

                            <div class="col-md-12" style="margin-top: 20px;">
                                <input type="number" minlength="10" id="phoneno" maxlength="10" name="txtEmpPhone" class="form-control" placeholder="Your Phone *"/>
                            </div>

                            <div class="col-md-12" style="margin-top: 20px;">
                                <input type="text" name="qua" class="form-control" placeholder="qualifaction *" required/>
                            </div>
                                                        
                            <div class="col-md-12" style="margin-top: 20px;">
                                <input type="text" name="job" class="form-control" placeholder="Job Title *" required/>    
                            </div>
                             <div class="col-md-12" style="margin-top: 20px;">
                                <input type="password" name="Password" class="form-control" placeholder="Password *" required/>    
                            </div>
                            <div class="col-md-12"style="margin-top: 20px;">
                                <input type="submit" name="submit" class="btn btn-info btn-lg" value="Sign Up"> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     </div>
</div>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-migrate-3.0.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/jquery.stellar.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/aos.js"></script>
        <script src="js/jquery.animateNumber.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/jquery.timepicker.min.js"></script>
        <script src="js/scrollax.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
        <script src="js/google-map.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>