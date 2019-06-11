<?php
$a=$_POST['name'];
$b=$_POST['email'];
$c=$_POST['contact'];
$d=$_POST['subject'];
$e=$_POST['message'];
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
$sql = "INSERT INTO contactus (name, email, contact, subject, message) VALUES ('$a', '$b', '$c', '$d', '$e')";

if ($conn->query($sql) === TRUE) {
    echo "Thanks for Contacting us!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
/*
$sql = "select name, email, contact, subject, message from contactus";
$result = $conn->query($sql);

if($result->num_rows>0){
	echo "<table>";
	while($row = $result->fetch_assoc()){
		echo "<tr><td> Name: " . $row["name"]. "  " . $row["email"]."  " . $row["contact"]."  " . $row["subject"]."  " . $row["message"]. "</td><tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}
*/
$conn->close();
?>