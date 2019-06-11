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
		$dbname = "arkgloba_dbase1";
	}
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 


$dateOfTravel=$_GET['date'];
$descr=$_GET['descr'];
$name=$_GET['pname'];
$email=$_GET['pemail'];
$country=$_GET['country'];
$city=$_GET['city'];
$contact=$_GET['phoneno'];
$packname=$_GET['packname'];


$sql = "UPDATE `enquiry` SET `isHandled`=1 WHERE `date`='".$dateOfTravel."' AND `descr`='".$descr."' AND `name`='".$name."' AND `email`='".$email."' AND `country`='".$country."' AND `city`='".$city."' AND `contact`='".$contact."' AND `packname`='".$packname."'";

if ($conn->query($sql) === TRUE) {
    echo "Query Handled :-)";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
$conn->close();
?>