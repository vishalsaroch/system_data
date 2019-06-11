<?php include("db.php");?>
<?php
	$name=$_POST['sname'];
	$rollno=$_POST['rollno'];
	$time_now=mktime(date('h')+5,date('i')+30,date('s'));
	date_default_timezone_set('Asia/Kolkata');
?>	
<?php

if(!empty($_POST['rating']) && !empty($_POST['itemId'])){
$itemId = $_POST['itemId'];
$userID = 1234567;
$insertRating = "INSERT INTO student (rollno, name, imtime, timeout, remarks) VALUES ('".$rollno."', '".$itmein."', '".$_POST['timeout']."', '".$_POST['remarks']."', '".$_POST["comment"]."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')";
mysqli_query($conn, $insertRating) or die("database error: ". mysqli_error($conn));
echo "rating saved!";
}
?>