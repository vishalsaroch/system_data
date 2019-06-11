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

$packid555=$_POST['packiddd'];

$sql = "DELETE FROM `packages` WHERE sno=".$packid555;
//$sql = "UPDATE `enquiry` SET `isCustomer`=1 WHERE `sno`='".$packid555."'";

if ($conn->query($sql) === TRUE) {
    //echo "Query Handled :-)";
    /*if($_SERVER['SERVER_NAME']=='localhost')
	{
        header("location: project2/admin/packages.php");
	}
	else if($_SERVER['SERVER_NAME']=='arjjsngo.org.in')
	{
        header("location: admin/packages.php");
	}*/
    header("location: admin/packages.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
$conn->close();
?>