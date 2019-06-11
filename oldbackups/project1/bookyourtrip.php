<?php
$a=$_POST['name'];
$b=$_POST['activities'];
$c=$_POST['destination'];
$d=$_POST['date'];
$e=$_POST['contact'];
	if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dbase1";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	}
	else if($_SERVER['SERVER_NAME']=='himalyanfurniture.com')
	{
		$servername = "sun";
		$username = "himalyan_root";
		$password = "rootPWD@#";
		$dbname = "himalyan_dbase1";
							
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		//echo "Connected successfully";
	}
$sql = "INSERT INTO bookmytrip (name, activities, destination, date, contact) VALUES ('$a', '$b', '$c', '$d', '$e')";

if ($conn->query($sql) === TRUE) {
    echo "Thanks for Booking trip!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>