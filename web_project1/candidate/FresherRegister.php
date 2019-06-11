<?php
	if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dbase2";
	}
	else if($_SERVER['SERVER_NAME']=='cogentsol.in')
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

 
$fname1 = $_POST["fname"];

$lname1=$_POST['lname'];
$email1=$_POST['email'];
$txtEmpPhone1=$_POST['txtEmpPhone'];
$qua1=$_POST['qua'];
$job1=$_POST['job'];
// $year1=$_POST['year'];
// $month1=$_POST['month'];


$sql = "INSERT INTO `candidate` (`fname`, `lname`, `emailid`, `mobileno`, `qualification`, `jobtitle`) VALUES ('$fname1', '$lname1', '$email1', '$txtEmpPhone1', '$qua1', '$job1')";
	
if ($conn->query($sql) === TRUE) {
    echo "value added to database";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}	
    
// the message
$msg = "Hi ".$fname1.",\nThanks for contacting us.\n\nWe will surely get back to you.";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($email1,"Thanks for contacting us",$msg);


$conn->close();
?>