<?php
	if($_SERVER['SERVER_NAME']=='localhost')
		{
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "dbase3";
		}
		else if($_SERVER['SERVER_NAME']=='rkce.in')
		{
			$servername = "sun";
			$username = "cogentso_root";
			$password = "rootPWD@#";
			$dbname = "cogentso_dbase2";
		}
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
	} 
?>