<?php
	if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dbase1";
	}
	else if($_SERVER['SERVER_NAME']=='arjjsngo.org.in')
	{
		$servername = "sun";
		$username = "arjjsngo_root";
		$password = "rootPWD@#";
		$dbname = "arjjsngo_dbase1";
	}
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

$packid333=$_GET['packid333'];

$sql = "UPDATE `bookmytrip` SET `isHandled3`=1 WHERE `sno`='".$packid333."'";

if ($conn->query($sql) === TRUE) {
    echo "Query Handled :-)";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
$conn->close();
?>