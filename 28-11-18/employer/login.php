<?php
/* User login process, checks if user exists and password is correct */
//$conn->close();
// Escape email to protect against SQL injections
$x=$_POST['email'];
$y=$_POST['password'];
$temp = "";
//$email = $mysqli->escape_string($_POST['email']);
//$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
	if($_SERVER['SERVER_NAME']=='localhost')
	{
		sername = "root";
		$p$servername = "localhost";
		$uassword = "";
		$dbname = "dbase2";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
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
		//echo "Connected successfully";
	}
$sql = "select * from employersusers where userid = '".$x."'";
$result = $conn->query($sql);

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else { // User exists
    
	while($row = $result->fetch_assoc()) {
       // $temp = $row["password"];
		if($y==$row["pwd"])
		{
	//$row = $result->fetch_assoc();
	        
        $_SESSION['email'] = $row['emailid'];
        $_SESSION['first_name'] = $row['compName'];
        $_SESSION['last_name'] = " ";
        $_SESSION['active'] = 1;
        
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;
				
    echo "<script>location='../employer/dashbord2.php'</script>";
	header("location: profile.php");
	exit();
    
		}
    }
}

