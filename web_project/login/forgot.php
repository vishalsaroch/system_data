<?php
  session_start();
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
if(isset($_POST['submit']))
{
  $user_id = $_POST['user_id'];
  $result = mysqli_query($conn,"SELECT * FROM employersusers where emailid='" . $_POST['user_id'] . "'");
  $row = mysqli_fetch_assoc($result);
  $fetch_user_id=$row['emailid'];
  $email_id=$row['emailid'];
  // $password=$row['password'];
  if($user_id==$fetch_user_id) {
        // $to = $email_id;
                // $subject = "Password";
                // $txt = "Your password is : $password.";
                // $headers = "From: password@studentstutorial.com" . "\r\n" .
                // "CC: somebodyelse@example.com";
                // mail($to,$subject,$txt,$headers);
      //   $to = $email_id;
      //           $subject = "Password";
      //           $txt = "Your password is : $password.";
      //           $headers = "From: password@studentstutorial.com" . "\r\n" .
      //           "CC: somebodyelse@example.com";
      //           mail($to,$subject,$txt,$headers);
      //}
        // echo "valid id";
        header("location: change.php?email=".$user_id);
      }
        else{
           echo '<script>alert("Email id does not exist.\nPlease enter a Valid email id.");</script>';
        }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Your Password</title>
  <!-- <?php include 'css/css.html'; ?> -->
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
 <div><img src="img/ashwani.png"> </div>
  <div class="form">

    <h1>Reset Your Password</h1>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label>
        Email Address<span class="req">*</span>
      </label>
      <input type="email" style="height:40px;" required autocomplete="off" name="user_id"/>
    </div>
   <!--  <button class="button button-block"/>Reset</button> -->
   <input type="submit" style="height:40px;" name="submit">
    </form>
  </div>
          
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>

</html>
