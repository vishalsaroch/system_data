<?php
$fname=$_POST['fname'];	
$lname=$_POST['lname'];		
$emailid=$_POST['email'];
$mobileno=$_POST['txtEmpPhone'];
$qualification=$_POST['qua'];
$jobtitle=$_POST['job'];
$years=$_POST['year'];
$months=$_POST['month'];
$userid=$_POST['email'];
$pwd=$_POST['pwd'];
$date=date("Y/m/d");

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

// $dateNow = date("Y/m/d");
// $timeNow = time("H");
//$sql = "INSERT INTO `candidate` (`fname`, `lname`) VALUES ('$fname', '$lname')";
$sql = "INSERT INTO `candidate` (`fname`, `lname`, `emailid`, `mobileno`, `qualification`, `jobtitle`, `years`, `months`, `userid`, `pwd`, `date`) VALUES ('$fname', '$lname', '$emailid', '$mobileno', '$qualification', '$jobtitle', '$years', '$months', '$userid', '$pwd', '$date')";
// $sql = "INSERT INTO `candidate` (`fname`, `emailid`, `mobileno`, `userid`,`lname`, 'qualification', 'jobtitle','years', `pwd`, `date`) VALUES ('$CompName', '$userid', '$contactNo', '$lname', '$qual', '$title', '$years', '$months', '$userid', '$pwd', '$dateNow')";

	
if ($conn->query($sql) === TRUE) {
    echo "value added to database";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	$conn->close();    

$msg = "Hi ,Your Userid - ".$userid." Password - ".$pwd." Please visit https://cogentsol.in/candidate/profile/profile";
// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($userid,"Thanks for contacting us",$msg);  
echo "mail sent."; 
?>