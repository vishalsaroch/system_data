<?php
$userid=$_POST['userid'];
$pwd=$_POST['pwd'];
$compName=$_POST['compName'];
$contactNo=$_POST['contactNo'];
                                  $msg = "Hi ,Your Userid - ".$userid." Password - ".$pwd." Please visit https://cogentsol.in/employer/dashbord2";

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

 
$sql = "INSERT INTO `employersUsers` (`compName`, `emailid`, `contactNo`, `userid`, `pwd`) VALUES ('$compName', '$userid', '$contactNo', '$userid', '$pwd')";
	
if ($conn->query($sql) === TRUE) {
    echo "value added to database";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    $conn->close();    
?>