<?php
	if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dbase1";
	}
	else if($_SERVER['SERVER_NAME']=='himalyanfurniture.com')
	{
		$servername = "sun";
		$username = "himalyan_root";
		$password = "rootPWD@#";
		$dbname = "himalyan_dbase1";
	}
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 


$dateOfTravel=$_POST['dateOfTravel'];
$adultC=$_POST['adultC'];
$childC=$_POST['childC'];
$descr=$_POST['descr'];
$name=$_POST['name'];
$email=$_POST['email'];
$country=$_POST['country'];
$city=$_POST['city'];
$contact=$_POST['contact'];
$packname=$_POST['packname'];


$sql = "INSERT INTO `enquiry` (`date`, `adultC`, `childC`, `descr`, `name`, `email`, `country`, `city`, `contact`, `packname`) VALUES ('".$dateOfTravel."', '".$adultC."', '".$childC."', '".$descr."', '".$name."', '".$email."', '".$country."', '".$city."', '".$contact."', '".$packname."');";
	
//$sql = "INSERT INTO contactus (name, email, contact, subject, message) VALUES ('$a', '$b', '$c', '$d', '$e')";

if ($conn->query($sql) === TRUE) {
    echo "Thanks for sending query! :-)";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
$conn->close();
?>