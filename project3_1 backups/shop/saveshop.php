<?php
    $shopname = $_POST['shopname'];
	$ownername = $_POST['ownername'];
    $mobile = $_POST['mobile'];
	$location = $_POST['location'];
	$userid=$_POST['mobile'];
	$pwd=$_POST['pwd'];

if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "shop";
	}
	else if($_SERVER['SERVER_NAME']=='truelook.in')
	{
		$servername = "sun";
		$username = "truelook_root";
		$password = "truelook@12#123";
		$dbname = "truelook_truedb";
	}
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 



$sql = "SELECT * from `shop` WHERE mobileno = '".$mobile."'";		
 $result1 = $conn->query($sql);
  if ($result1->num_rows > 0) {
  	echo "User is already exist.";
  } else {
  		$sql = "INSERT INTO `shop` (`shopname`, `ownername`, `mobileno`, `location`, `userid`, `pwd`) VALUES ('$shopname', '$ownername', '$mobile', '$location', '$userid', '$pwd'  )";
  	
		if ($conn->query($sql) === TRUE) {
		    echo "User Registed Sucessfully";
			} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
			$conn->close();    

  	}




?>