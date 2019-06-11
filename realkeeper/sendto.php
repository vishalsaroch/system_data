<?php include("config.php");?>
<?php
  $status=$_POST['status'];
  $inid=$_POST['inid'];
  $udate= date("Y/m/d");
  $sql = "UPDATE `requstdemo` SET `sendto`='".$status."', `udate`='".$udate."' WHERE `id`='".$inid."';";
  $run = mysqli_query($conn, $sql);
  if ($run) {
        
     header("location:dashboard.php");
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>