<?php
	$location = $_POST['location'];
	$address = $_POST['address'];
	


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

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * from `shop` WHERE location = '".$location."'";		
 $result1 = $conn->query($sql);
  if ($result1->num_rows > 0) {
  		while($row = $result1->fetch_assoc()) {
  			echo($row["shopname"].";".$row["mobileno"].";".$row["line1"]);
		}

	}
	else{
		echo "not a service area.";
	} 

			$conn->close();    

?>