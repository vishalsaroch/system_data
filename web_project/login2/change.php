<?php
session_start();
$email = $_GET["email"];
if($_SERVER['SERVER_NAME']=='localhost'){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbase2";
      }
      else if($_SERVER['SERVER_NAME']=='cogentsol.in'){
        $servername = "sun";
        $username = "cogentso_root";
        $password = "rootPWD@#";
        $dbname = "cogentso_dbase2";
      }
       // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      } 

  if (count($_POST) > 0) {
    $result = mysqli_query($conn, "SELECT * from candidate WHERE userid='" . $email . "'");
    $row = mysqli_fetch_array($result);
    if ($_POST["currentPassword"] == $row["pwd"]) {
      // echo "true";

      // } 
        mysqli_query($conn, "UPDATE candidate set pwd='" . $_POST["newPassword"] . "' WHERE userId='" . $email . "'");
        $message = "Password Changed";
         header("location: index.php");
    } else
        $message = "Current Password is not correct";
}
?>
<html>
  <head>
  <title>Change Password</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  <div><img src="img/ashwani.png"> </div>
    <div class="form">
      <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
      <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
      <h1>Change Password</h1></td>
      <script>
        function myFunction() {
          var x = document.getElementById("currentPassword");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
        </script>
    
     
       <div class="field-wrap" style="">
        <label>Current Password</label>
        <input type="password" name="currentPassword" id="currentPassword" style="height:40px; " required autocomplete="off">
        
        <span id="currentPassword"  class="required" ></span>
       </div>
      <!-- <div class="field-wrap">
       <span>Show Password</span><input type="checkbox" onclick="myFunction()" style="height:40px;"  autocomplete="off" align="left">
      </div> -->
      <div class="field-wrap">
        <label>New Password</label>
        <input type="password" name="newPassword" style="height:40px;" required autocomplete="off">
        <span id="newPassword" class="required"></span>
      </div>
      <div class="field-wrap">
        <label>Confirm Password</label>
        <input type="password" name="confirmPassword" style="height:40px;" required autocomplete="off">
        <span id="confirmPassword" class="required"></span>
      </div>
        <input type="submit" name="submit" value="Submit" class="btnSubmit" style="height:40px;" required autocomplete="off">
     
      </form>
    </div>
    <script>
    function validatePassword() {
    var currentPassword,newPassword,confirmPassword,output = true;

    currentPassword = document.frmChange.currentPassword;
    newPassword = document.frmChange.newPassword;
    confirmPassword = document.frmChange.confirmPassword;

    if(!currentPassword.value) {
    currentPassword.focus();
    document.getElementById("currentPassword").innerHTML = "required";
    output = false;
    }
    else if(!newPassword.value) {
    newPassword.focus();
    document.getElementById("newPassword").innerHTML = "required";
    output = false;
    }
    else if(!confirmPassword.value) {
    confirmPassword.focus();
    document.getElementById("confirmPassword").innerHTML = "required";
    output = false;
    }
    if(newPassword.value != confirmPassword.value) {
    newPassword.value="";
    confirmPassword.value="";
    newPassword.focus();
    document.getElementById("confirmPassword").innerHTML = "not same";
    output = false;
    }   
    return output;
    }
    </script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>

  </body>
</html>