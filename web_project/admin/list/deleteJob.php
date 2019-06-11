<?php
if($_SERVER['SERVER_NAME']=='localhost')
  {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbase2";
  }
  else if($_SERVER['SERVER_NAME']=='cogentsol.in')
  {
    $servername = "sun";
    $username = "cogentso_root";
    $password = "rootPWD@#";
    $dbname = "cogentso_dbase2";
  }


//Delete Action.php
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
$jobId1=$_POST["userid"];

$sql = "delete from `job` where sno = $jobId1";
$result = $conn->query($sql);

    if($result==true){
        echo "recode deleted successfully";
    } else {
        echo "0 results";
                        }
?>