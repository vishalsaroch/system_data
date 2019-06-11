<?php
/* Displays user information and some useful messages */
session_start();
// echo session_id();
// Check if user is logged in using the session variable
if ( $_SESSION['adminlogin'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location:../login/index.php");  
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
include('db.php');
?>
<?php
	$showjob=$_POST['showjob'];
	$userid=$_POST['userid'];
	$sql = "UPDATE `employersusers` SET `showjob`='".$showjob."' WHERE `userid`='".$userid."';";
	$run = mysqli_query($conn, $sql);	
	if ($run) {
		echo ". $showjob .";
		header("location:empsearch.php");
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

?>