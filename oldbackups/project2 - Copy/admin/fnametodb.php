<?php
$fn=$_POST['filename'];

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
	else if($_SERVER['SERVER_NAME']=='www.arkglobalholidays.co.in')
	{
		$servername = "sun";
		$username = "arkgloba_root";
		$password = "rootPWD@#";
		$dbname = "arkgloba_dbase1";
							
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		//echo "Connected successfully";
	}
$sql = "UPDATE `bannerimages` SET `filename`='$fn'";

if ($conn->query($sql) === TRUE) {
    //echo "file name saved to data base";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>