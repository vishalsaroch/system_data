<?php
$userid=$_POST['userid'];
$pwd=$_POST['pwd'];
$compName=$_POST['compName'];
$contactNo=$_POST['contactNo'];
// $lname=$_POST['lanme'];
$contactNo=$_POST['contactNo'];

                                  $msg = "Hi ,Your Userid - ".$userid." Password - ".$pwd." Please visit https://cogentsol.in/candidate/profile/profile";

                                    // use wordwrap() if lines are longer than 70 characters
                                    $msg = wordwrap($msg,70);

                                    // send email
                                    mail($userid,"Thanks for contacting us",$msg);  
                                    echo "mail sent."; 

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
$lname=$_POST['lanme'];		
$qual=$_POST['qual'];
$title=$_POST['title'];
$years=$_POST['years'];
$months=$_POST['months'];
$dateNow = date("Y/m/d");
$timeNow = time("H");
$sql = "INSERT INTO `candidate` (`fname`, 'lname`, emailid`, `mobileno`, 'qualification', 'jobtitle', 'years', 'months' `userid`, `pwd`, `date`) VALUES ('$compName', '$lname', '$userid', '$contactNo', '$userid', '$qual', '$title', '$years', '$months' '$pwd', '$dateNow', '$timeNow')";
// $sql = "INSERT INTO `candidate` (`fname`, `emailid`, `mobileno`, `userid`,`lname`, 'qualification', 'jobtitle','years', `pwd`, `date`) VALUES ('$CompName', '$userid', '$contactNo', '$lname', '$qual', '$title', '$years', '$months', '$userid', '$pwd', '$dateNow')";

	
if ($conn->query($sql) === TRUE) {
    echo "value added to database";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    $conn->close();    
?>