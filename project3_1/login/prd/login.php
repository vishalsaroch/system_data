<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$x=$_POST['email'];
$y=$_POST['password'];
//$email = $mysqli->escape_string($_POST['email']);
//$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
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
	else if($_SERVER['SERVER_NAME']=='himalyanfurniture.com')
	{
		$servername = "sun";
		$username = "himalyan_root";
		$password = "rootPWD@#";
		$dbname = "himalyan_dbase1";
							
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		//echo "Connected successfully";
	}

$sql = "select * from users where email = '".$x."'";
$result = $conn->query($sql);

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
	exit();
}
else { // User exists
    
	while($row = $result->fetch_assoc()) {
       // $temp = $row["password"];
		if($y==$row["password"])
		{
	//$row = $result->fetch_assoc();
	        
        $_SESSION['email'] = $row['email'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['active'] = $row['active'];
        
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;
		
		/*echo $_SESSION['email'];
		echo $_SESSION['first_name'];
		echo $_SESSION['last_name'];
		echo $_SESSION['active'];
		echo $_SESSION['logged_in'];	
		echo "till here coming";	*/
		
	echo "<script>location='../admin'</script>";
    //header("Location: /home/himalyanfurnitur/public_html/admin");
	//header("location: /home/himalyanfurnitur/public_html/login/profile.php");
	exit();
		}
    }
}

