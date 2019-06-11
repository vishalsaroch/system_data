<?php
  session_start();
  if ( $_SESSION['emplogged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location:../emplogin/index.php");  
    exit();
  }
  else {
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
  }
?>
<?php include("../config.php");?>

<?php
  $status=$_POST['status'];
  $inid=$_POST['inid'];
  $sql = "UPDATE `interview` SET `status`='".$status."' WHERE `inid`='".$inid."';";
  $run = mysqli_query($conn, $sql);
  if ($run) {
     header("location:interviewstatus.php");
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>