<?php
	if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dbase1";
	}
	else if($_SERVER['SERVER_NAME']=='www.arkglobalholidays.co.in')
		{
			$servername = "sun";
			$username = "arkgloba_root";
			$password = "rootPWD@#";
			$dbname = "arkgloba_dbase1";}
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

$packid555=$_GET['packid555'];

$sql = "UPDATE `contactus` SET `isCustomer2`=1 WHERE `sno`='".$packid555."'";

if ($conn->query($sql) === TRUE) {
    echo "Query Handled :-)";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
$conn->close();
?>