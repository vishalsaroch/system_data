<?php include("config.php");
// session_start();
?>
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
<!--================Header Menu Area =================-->
	<header class="header_area">
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#9999ff; color:#fff; height:50%;">
                    <div class="container" style="font-size: 14px">
                    	<ul class="nav col-lg-8" style="padding: 10px;">	
                        	<li style="padding-right:10px;"><sapn>CALL FOR DEMO :+91-78-2767-2267</sapn></li>
                        </ul>
                        <ul class="nav col-lg-4 nav-right" style="padding: 10px;">
                        	<li style="padding-right:10px;"><a style="color: #fff;" data-toggle="modal" data-target="#myModal" a href="#">Log In</a></li>
	                        <li style="padding-right:10px;"><a href="#" style="color: #fff;">Pay Now</a></li>	                        <li style="padding-right:10px;"><a href="#" style="color: #fff;">CA Connect</a></li>
	                        <li style="padding-right:10px;"><a href="support.php" style="color: #fff;">Get Support</a></li>
	                    </ul>
                    </div>
                </nav>
                <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-77941351-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-77941351-1');
</script>
                <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#fff;">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <a class="navbar-brand logo_h" href="index.php"><img src="img/realkeeper logonew.jpg"  alt=""></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" style="color: black">
                            <span class="icon-bar" style="background-color: black;"></span>
					        <span class="icon-bar" style="background-color: black;"></span>
					        <span class="icon-bar" style="background-color: black;"></span> 
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                            <ul class="nav navbar-nav menu_nav justify-content-center">
                                <!-- <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li> -->
                                <li class="nav-item"><a class="nav-link" href="#" style="color: black">Features</a></li>
                                <li class="nav-item"><a class="nav-link" href="price.php" style="color: black">Pricing</a></li>
                                <!-- <li class="nav-item"><a class="nav-link" href="price.php">academy</a></li> -->
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                    aria-expanded="false" style="color: black">about realkeeper</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="#" style="color: black">get to know us</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#" style="color: black">Partner with us</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#" style="color: black">careers</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#" style="color: black">academy</a></li>
                                        
                                    </ul>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="http://blog.realkeeper.in" class="nav-link" target="_blank"
                                    aria-expanded="false" style="color: black">Blog</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="contact.php" style="color: black">Contact</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="nav-item"><a href="https://play.google.com/store/apps/details?id=com.realkeeper&hl=en_IN" target="_blank" class="primary_btn text-uppercase" style="color: black">Get App Now</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="modal fade" id="myModal" style="top: 150px">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <!-- Modal Header -->
			        <div class="modal-header">
			          <h4 class="modal-title">Login</h4>
			           <button type="button" class="close" data-dismiss="modal">&times;</button>
			        </div>
			        
			        <!-- Modal body -->
			        <div class="modal-body">
			          <form action"" method="post">
			          	<input type="email" name="userid" placeholder="User Name" class="form-control" style="margin:10px;">
			          	<input type="password" name="pwd" placeholder="Password" class="form-control" style="margin:10px;">
			          	<input type="submit" name="login" value="Login" class="btn-primary" style="margin:10px;">
			          </form>
			        </div>
			        <!-- Modal footer -->
			        <div class="modal-footer"></div>
			      </div>
			    </div>
			  </div>
         </header>
	<!--================Header Menu Area =================-->
