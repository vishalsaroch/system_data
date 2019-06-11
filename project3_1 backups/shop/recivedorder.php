<?php
    $name = $_POST['name'];
	$date = $_POST['date'];
	$time = $_POST['time'];
    $contact = $_POST['mobile'];
    $location = $_POST['location'];
    $address = $_POST['address'];
	$services = $_POST['services'];
	$notes  = $_POST['notes'];
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



  		$sql = "INSERT INTO `order` (`name`, `date`, `time`, `contact`,`location`,`address`, `services`, `notes`) VALUES ('$name', '$date', '$time', '$contact','$location','$address', '$services', '$notes')";
  	
		if ($conn->query($sql) === TRUE) {
		    echo "order Plased Sucessfully";
			} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
			$conn->close();    

  	
?>