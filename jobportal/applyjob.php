<?php include("config.php");?>
<?php
/* Displays user information and some useful messages */
session_start();
// echo session_id();
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] == false ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location:login/index.php");  
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

<?php
  $jobid=$_POST["jobid"];
  $apply=$_POST["apply"];
  $date = date("Y/m/d");
  
  echo $jobid;
  echo $email;
  $sql = "UPDATE `candidate` SET `jobid`='".$jobid."', `apply`='".$apply."' WHERE `userid`='".$_SESSION['email']."';";
  $sql = "INSERT INTO `interview` (`jobid`, `canid`,`date`) VALUES ('$jobid', '$email', '$date')";
    $run = mysqli_query($conn, $sql);
    if ($run) {
      echo "Job Applied Successfully";
      echo "<script>location='showjob.php?id=$jobid' </script>";
      } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>
