<?php include("config.php");?>


<?php
    $name=$_POST['name'];   
    $email=$_POST['email'];     
    // $number=$_POST['number'];
    $mobile=$_POST['mobile'];
//  echo $mobile;
    $date=date("Y/m/d");
    $sql = "INSERT INTO `requstdemo` (`name`,`email`, `mobile`, `date`) VALUES ('$name', '$email', '$mobile', '$date')";
    if ($conn->query($sql) === TRUE) {
    //   echo "Demo Book Successfully";
       // echo "<a href='index.php'>Back to Home<a/>";
       // echo "<script>location='https://www.dropbox.com/s/701auzbihaaat1m/Realkeeper_Setup.exe?dl=1'</script>";
      
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();    
?>
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

<body>

<?php include("header.php");?>
    <!--================Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    <section class="home_banner_area">
        <div class="banner_inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" style="text-align: center; margin:100px;color: #fff;">
                        <h2 style="font-size: 48px;">Demo Book Successfully</h2>
                        <!--<h4>OOPS! NOTHING WAS FOUND</h4>-->
                        <!--<p>The page you are looking for might have been removed had its name changed or is temporarily unavailable. <a href="index.php" style="color:blue">Return to homepage</a></p>-->
                    </div>
                    <!-- The Modal -->
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->
    <!--================Footer Area =================-->
    <footer>
            <div class="container-fluid" style="background-color: #000; color:#fff; padding:20px;">
                <div class="row footer_inner">
                    <div class="col-lg-4 col-sm-4">
                        <aside class="f_widget ab_widget">
                            <div class="f_title">
                                <h3 style="color: #fff">About Me</h3>
                            </div>
                            <p> Realkeeper is always on lookout for partnerships that would enhance the value-delivery system to it's Customers.</p>
                            
                        </aside>
                    </div>
                    
                    <div class="col-lg-4">
                        <aside class="f_widget social_widget">
                            <div class="f_title">
                                <h3 style="color: #fff">Quick Links</h3>
                             </div>
                            
                            <ul class="list" style="color: #fff">
                                <li ><a href="http://rws.realkeeper.in/" style="color: #fff">  Web services</a></li><br>
                                <li><a href="http://go.realkeeper.in/" style="color: #fff"> Digital Marketing </a></li><br>
                                <li><a href="http://misscall.realkeeper.in/" style="color: #fff"> Missed Call</li><br>
                                <li><a href="http://sms.realkeeper.in/logMe.aspx" style="color: #fff"> SMS Services</li><br>
                                <li><a href="http://sms.realkeeper.in/logMe.aspx" style="color: #fff"> Book A Domain</li><br>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-lg-4">
                        <aside class="f_widget social_widget">
                            <div class="f_title">
                                <h3 style="color: #fff">Social Media</h3>
                            </div>
                            
                            <ul class="list" style="color: #fff">
                                <li><a href="#" style="color: #fff"><i class="fa fa-facebook"></i> Facebook</a></li><br>
                                <li><a href="#" style="color: #fff"><i class="fa fa-twitter"></i> Twitter</a></li><br>
                                <li><a href="#" style="color: #fff"><i class="fa fa-youtube"></i></a> Youtube</li><br>
                                <li><a href="#" style="color: #fff"><i class="fa fa-google-plus"></i></a> Google Plus</li><br>
                                <li><a href="#" style="color: #fff"><i class="fa fa-linkedin"></i> Facebook</a></li><br>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
            <div class="container-fluid" style="padding:10px;">
                <div class="row">
                    <div class="col-lg-2">
                        <a href="#" style="color: #000;">Join Webinar</a>
                    </div>
                    <div class="col-lg-1">
                        <a href="#" style="color: #000;">Testimonials</a>
                    </div>
                    <div class="col-lg-1">
                        <a href="#" style="color: #000;">Rate Us</a>
                    </div>
                    <div class="col-lg-2">
                        <a href="#" style="color: #000;">Terms & Conditions</a>
                    </div>
                    <div class="col-lg-2">
                        <a href="#" style="color: #000;">IPR and Redressal Policy</a>
                    </div> 
                    <div class="col-lg-2">
                        <a href="#" style="color: #000;">Refund Policy</a>
                    </div>
                    <div class="col-lg-1">
                        <a href="#" style="color: #000;">Sitemap</a>
                    </div> 
                </div>
            </div>
            <div class="container-fluid" style="background-color:#9999ff; padding:10px;">
                <div class="row">
                    <div class="col-lg-4">
                        <h4 style="text-align: center"><a href="http://www.realkeeper.in/"  target="_blank" style="color:#fff; "> Realkeeper Technologies Pvt. Ltd</a></h4>
                    </div>  
                

                    <div class="col-lg-4">
                        <h4 style="text-align: center; text-align:center; color:#fff;">Missed Call: +91-78-2767-2267</h4>
                    </div>  
                    
                    <div class="col-lg-4">
                        <h4 style="text-align: center; color:#fff;">Support : support@realkeeper.in </h4>
                    </div>  
                </div>
            </div>
            
        </footer>
    <!--================End Footer Area =================-->

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
