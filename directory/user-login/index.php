<?php include("../config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from rn53themes.net/themes/demo/directory/login.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Apr 2019 07:04:07 GMT -->
<head>
  <title>PostToo</title>
  <!-- META TAGS -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- FAV ICON(BROWSER TAB ICON) -->
  <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">
  <!-- GOOGLE FONT -->
  <link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
  <!-- FONTAWESOME ICONS -->
  <link rel="../stylesheet" href="css/font-awesome.min.css">
  <!-- ALL CSS FILES -->
  <link href="../css/materialize.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
  <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
  <link href="../css/responsive.css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>
<?php 
  if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
      if (isset($_POST['login'])) { //user logging in

          require 'login.php';
          
      }
      
      elseif (isset($_POST['register'])) { //user registering
          
          require 'register.php';
          
      }
  }
?>

<body data-ng-app="">
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
  <!--TOP SEARCH SECTION-->
  <section class="bottomMenu dir-il-top-fix">
    <div class="container top-search-main">
      <div class="row">
        <div class="ts-menu">
          <!--SECTION: LOGO-->
          <div class="ts-menu-1">
            <a href="../index.php"><img src="../images/aff-logo.png" alt=""> </a>
          </div>
          <!--SECTION: BROWSE CATEGORY(NOTE:IT'S HIDE ON MOBILE & TABLET VIEW)-->
          <div class="ts-menu-2"><!-- <a href="#" class="t-bb">All Pages <i class="fa fa-angle-down" aria-hidden="true"></i></a> -->
            <!--SECTION: BROWSE CATEGORY-->
            <!-- <div class="cat-menu cat-menu-1">
              <div class="dz-menu">
                <div class="dz-menu-inn">
                  <h4>Frontend Pages</h4>
                  <ul>
                    <li><a href="index-1.php">Home 1</a></li>
                    <li><a href="index-2.php">Home 2</a></li>
                    <li><a href="index-3.php">Home 3</a></li><li><a href="index-4.php">Home 4</a></li>
                    <li><a href="list.php">All Listing</a></li>
                    <li><a href="listing-details.php">Listing Details </a> </li>
                    <li><a href="price.php">Add Listing</a> </li>
                    <li><a href="list-lead.php">Lead Listing</a></li>
                    <li><a href="list-grid.php">Listing Grid View</a></li>
                  </ul>
                </div>
                <div class="dz-menu-inn">
                  <h4>Frontend Pages</h4>
                  <ul>
                    <li><a href="new-business.php"> New Listings </a> </li>
                    <li><a href="nearby-listings.php">Nearby Listings</a> </li>
                    <li><a href="customer-reviews.php"> Customer Reviews</a> </li>
                    <li><a href="trendings.php"> Top Trendings</a> </li>
                    <li><a href="how-it-work.php"> How It Work</a> </li>
                    <li><a href="advertise.php"> Advertise with us</a> </li>
                    <li><a href="price.php"> Price Details</a> </li>
                  </ul>
                </div>
                <div class="dz-menu-inn">
                  <h4>Frontend Pages</h4>
                  <ul>
                    <li><a href="about-us.php"> About Us</a> </li>
                    <li><a href="customer-reviews.php"> Customer Reviews</a> </li>
                    <li><a href="contact-us.php"> Contact Us</a> </li>
                    <li><a href="blog.php"> Blog Post</a> </li>
                    <li><a href="blog-content.php"> Blog Details</a> </li>
                    <li><a href="elements.php"> All Elements </a> </li>
                    <li><a href="shop-listing-details.php"> Shop Details </a> </li>
                    <li><a href="property-listing-details.php"> Property Details </a> </li>
                  </ul>
                </div>
                <div class="dz-menu-inn">
                  <h4>Dashboard Pages</h4>
                  <ul>
                    <li><a href="dashboard.php"> Dashboard</a> </li>
                    <li><a href="db-invoice.php"> Invoice</a> </li>
                    <li><a href="db-setting.php"> User Setting</a> </li>
                    <li><a href="db-all-listing.php"> All Listings</a> </li>
                    <li><a href="db-listing-add.php"> Add New Listing</a> </li>
                    <li><a href="db-review.php"> Listing Reviews</a> </li>
                    <li><a href="db-payment.php"> Listing Payments </a> </li>
                  </ul>
                </div>
                <div class="dz-menu-inn">
                  <h4>Dashboard Pages</h4>
                  <ul>
                    <li><a href="register.php"> User Register</a> </li>
                    <li><a href="login.php"> User Login</a> </li>
                    <li><a href="forgot-pass.php"> Forgot Password</a> </li>
                    <li><a href="db-message.php"> Messages</a> </li>
                    <li><a href="db-my-profile.php"> Dashboard Profile</a> </li>
                    <li><a href="db-post-ads.php"> Post Ads </a> </li>
                    <li><a href="db-invoice-download.php"> Download Invoice </a> </li>
                  </ul>
                </div>
                <div class="dz-menu-inn lat-menu">
                  <h4>Admin Panel Pages</h4>
                  <ul>
                    <li><a target="_blank" href="admin.php"> Admin</a> </li>
                    <li><a target="_blank" href="admin-all-listing.php"> All Listing</a> </li>
                    <li><a target="_blank" href="admin-all-users.php"> All Users</a> </li>
                    <li><a target="_blank" href="admin-analytics.php"> Analytics</a> </li>
                    <li><a target="_blank" href="admin-ads.php"> Advertisement</a> </li>
                    <li><a target="_blank" href="admin-setting.php"> Admin Setting </a> </li>
                    <li><a target="_blank" href="admin-payment.php"> Payments </a> </li>
                  </ul>
                </div>
              </div>
              <div class="dir-home-nav-bot">
                <ul>
                  <li>A few reasons you’ll love Online Business Directory <span>Call us on: +01 6214 6548</span> </li>
                  <li><a href="advertise.php" class="waves-effect waves-light btn-large"><i class="fa fa-bullhorn"></i> Advertise with us</a>
                  </li>
                  <li><a href="db-listing-add.php" class="waves-effect waves-light btn-large"><i class="fa fa-bookmark"></i> Add your business</a>
                  </li>
                </ul>
              </div>
            </div> -->
          </div>
          <!--SECTION: SEARCH BOX-->
          <div class="ts-menu-3">
            <div class="">
              <form class="tourz-search-form tourz-top-search-form" style="visibility: hidden">
                <div class="input-field">
                  <input type="text" id="top-select-city" class="autocomplete">
                  <label for="top-select-city">Enter city</label>
                </div>
                <div class="input-field">
                  <input type="text" id="top-select-search" class="autocomplete">
                  <label for="top-select-search" class="search-hotel-type">Search your services like hotel, resorts, events and more</label>
                </div>
                <div class="input-field">
                  <input type="submit" value="" class="waves-effect waves-light tourz-top-sear-btn"> </div>
              </form>
            </div>
          </div>
          <!--SECTION: REGISTER,SIGNIN AND ADD YOUR BUSINESS-->
          <div class="ts-menu-4">
            <div class="v3-top-ri">
              <ul>
                <li><a href="../register.php" class="v3-menu-sign"><i class="fa fa-sign-in"></i>Register</a> </li>
              </ul>
            </div>
          </div>
          <!--MOBILE MENU ICON:IT'S ONLY SHOW ON MOBILE & TABLET VIEW-->
          <div class="ts-menu-5"><span><i class="fa fa-bars" aria-hidden="true"></i></span> </div>
          <!--MOBILE MENU CONTAINER:IT'S ONLY SHOW ON MOBILE & TABLET VIEW-->
          <div class="mob-right-nav" data-wow-duration="0.5s">
            <div class="mob-right-nav-close"><i class="fa fa-times" aria-hidden="true"></i> </div>
            <h5>Business</h5>
            <ul class="mob-menu-icon">
              <li><a href="../price.php">Add Business</a> </li>
              <li><a href="../register.php">Register</a> </li>
              <li><a href="login.php">Sign In</a> </li>
            </ul>
            <h5>All Categories</h5>
            <ul>
              <li><a href="../list.php"><i class="fa fa-angle-right" aria-hidden="true"></i> Help Services</a> </li>
              <li><a href="../list.php"><i class="fa fa-angle-right" aria-hidden="true"></i> Appliances Repair & Services</a> </li>
              <li><a href="../list.php"><i class="fa fa-angle-right" aria-hidden="true"></i> Furniture Dealers</a> </li>
              <li><a href="../list.php"><i class="fa fa-angle-right" aria-hidden="true"></i> Packers and Movers</a> </li>
              <li><a href="../list.php"><i class="fa fa-angle-right" aria-hidden="true"></i> Pest Control </a> </li>
              <li><a href="../list.php"><i class="fa fa-angle-right" aria-hidden="true"></i> Solar Product Dealers</a> </li>
              <li><a href="../list.php"><i class="fa fa-angle-right" aria-hidden="true"></i> Interior Designers</a> </li>
              <li><a href="../list.php"><i class="fa fa-angle-right" aria-hidden="true"></i> Carpenters</a> </li>
              <li><a href="../list.php"><i class="fa fa-angle-right" aria-hidden="true"></i> Plumbing Contractors</a> </li>
              <li><a href="../list.php"><i class="fa fa-angle-right" aria-hidden="true"></i> Modular Kitchen</a> </li>
              <li><a href="../list.php"><i class="fa fa-angle-right" aria-hidden="true"></i> Internet Service Providers</a> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="tz-register">
      <div class="log-in-pop">
        <div class="log-in-pop-left">
          <h1>Hello... <span>{{ name1 }}</span></h1>
          <p>Don't have an account? Create your account. It's take less then a minutes</p>
          <h4>Login with social media</h4>
          <ul>
            <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a>
            </li>
            <li><a href="#"><i class="fa fa-google"></i> Google+</a>
            </li>
            <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a>
            </li>
          </ul>
        </div>
        <div class="log-in-pop-right">
          <!-- <a href="#" class="pop-close" data-dismiss="modal"><img src="../images/cancel.png" alt="" />
          </a> -->
          <h4>Login</h4>
          <!-- <p>Don't have an account? Create your account. It's take less then a minutes</p> -->
          <form class="user" action="index.php" method="post">
            <div class="form-group">
              <input type="text" name="mobile" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
            </div>
            <div class="form-group">
              <input type="password"  name="password" class="form-control " id="exampleInputPassword" placeholder="Password">
            </div>
            <div class="input-field s4">
								<input type="submit" value="Login" name="login" class="waves-effect waves-light log-in-btn"> </div>
            <!-- <input type="submit" name="login" value="login" align="left" class="btn btn-danger btn-block" > -->
          </form>
          <div class="input-field s12"> <a href="#">Forgot password</a> | <a href="../register.php">Create a new account</a> </div>
          
          <!-- <form action="index.php" method="post" class="s12">
            <div>
              <div class="input-field s12">
                <input type="text" name="mobile" class="validate">
                <label>User name</label>
              </div>
            </div>
            <div>
              <div class="input-field s12">
                <input type="password" name="password" class="validate">
                <label>Password</label>
              </div>
            </div>
            <div>
              <div class="input-field s4">
                <input type="submit" value="Login" class="waves-effect waves-light log-in-btn"> </div>
            </div>
            <div>
              <div class="input-field s12"> <a href="forgot-pass.php">Forgot password</a> | <a href="register.php">Create a new account</a> </div>
            </div>
          </form> -->
        </div>
        
      </div>
  </section>
  
  <!--FOOTER SECTION-->
  
  <!--QUOTS POPUP-->
  <section>
    <!-- GET QUOTES POPUP -->
    <div class="modal fade dir-pop-com" id="list-quo" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header dir-pop-head">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Get a Quotes</h4>
            <!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
          </div>
          <div class="modal-body dir-pop-body">
            <form method="userreg.php" class="form-horizontal">
              <!--LISTING INFORMATION-->
              <div class="form-group has-feedback ak-field">
                <label class="col-md-4 control-label">Full Name *</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="name" placeholder="" required> </div>
              </div>
              <!--LISTING INFORMATION-->
              <div class="form-group has-feedback ak-field">
                <label class="col-md-4 control-label">Mobile</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="mobile" placeholder=""> </div>
              </div>
              <!--LISTING INFORMATION-->
              <div class="form-group has-feedback ak-field">
                <label class="col-md-4 control-label">Email</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="email" placeholder=""> </div>
              </div>
              <!--LISTING INFORMATION-->
              <div class="form-group has-feedback ak-field">
                <label class="col-md-4 control-label">Message</label>
                <div class="col-md-8 get-quo">
                  <textarea class="form-control"></textarea>
                </div>
              </div>
              <!--LISTING INFORMATION-->
              <div class="form-group has-feedback ak-field">
                <div class="col-md-6 col-md-offset-4">
                  <input type="submit" value="SUBMIT" class="pop-btn"> </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- GET QUOTES Popup END -->
  </section>
  <!--SCRIPT FILES-->
  <script src="../js/jquery.min.js"></script>
  <script src="../js/angular.min.js"></script>
  <script src="../js/bootstrap.js" type="text/javascript"></script>
  <script src="../js/materialize.min.js" type="text/javascript"></script>
  <script src="../js/custom.js"></script>
</body>


<!-- Mirrored from rn53themes.net/themes/demo/directory/login.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Apr 2019 07:04:08 GMT -->
</html>