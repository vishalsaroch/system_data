<?php 
/* Main page with two forms: sign up and log in */
require 'db.php'; 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Empoyee Forget password</title>
    <?php include 'css/css.html'; ?>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style type="text/css">
        @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
        .login-block{
            background: #DE6262;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to bottom, #FFB88C, #DE6262); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        float:left;
        width:100%;
        padding : 50px 0;
        }
        /*.banner-sec{background:url(images/exp.jpg)  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}*/
        .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
        .carousel-inner{border-radius:0 10px 10px 0;}
        .carousel-caption{text-align:left; left:5%;}
        .login-sec{padding: 50px 30px; position:relative;}
        .login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
        .login-sec .copy-text i{color:#FEB58A;}
        .login-sec .copy-text a{color:#E36262;}
        .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
        .login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
        .btn-login{background: #DE6262; color:#fff; font-weight:600;}
        .banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
        .banner-text h2{color:#fff; font-weight:600;}
        .banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
        .banner-text p{color:#fff;}
        /*input{margin-bottom: 20px;}*/
    </style>
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
<body>
    <section class="login-block">
        <div class="container">
        <div class="row">
        <div class="col-md-3">  <img src="images/ashwani.png" style="margin-left: 30px;"></div>
            <div class="col-md-6 login-sec">
               
                <h2 class="text-center"> Employee Forget Password</h2>
                <form action="index.php" method="post" autocomplete="off" align="center">
              <!-- <div class="form-group" > -->
               <!--  <label for="exampleInputEmail1" class="text-uppercase">Username</label> -->
               Old Password
                <input type="password" class="form-control" name="email" placeholder="" required><br>
                
             <!--  </div>
              <div class="form-group"> -->
               <!--  <label for="exampleInputPassword1" class="text-uppercase">Password</label> -->
               Confrom Password
                <input type="password" class="form-control" name="password" placeholder="" required><br>
                 New Password
                <input type="password" class="form-control" name="password" placeholder="" required><br>
              <!-- </div>
              
              
                <div class="form-check"> -->
               <!--  <label class="form-check-label">
                  <input type="checkbox" class="form-check-input">
                  <small>Remember Me</small>
                </label> -->
                <!-- <button type="submit" class="btn btn-login float-right">Submit</button> -->
                <!--<input type="submit"  class="btn btn-info" name="login" value="Login" style="margin-left: 250px">-->
                <button class="btn btn-info" name="login"/>Update Password</button>

                <!-- <a href="forgot.php">Forgot Password</a> -->
         <!--  </div> -->
        </form>
        <form id="myform">
<label for="password">Password</label>
<input id="password" name="password" />
<br/>
<label for="password_again">Again</label>
<input class="left" id="password_again" name="password_again" />
<br>
<input type="submit" value="Validate!">
</form>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
// just for the demos, avoids form submit
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
$( "#myform" ).validate({
  rules: {
    password: "required",
    password_again: {
      equalTo: "#password"
    }
  }
});
</script>

</div>
<!-- <div class="col-md-8 banner-sec">
           
</div> -->
</section>
</body>
</html>