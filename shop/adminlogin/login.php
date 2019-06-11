<?php
/* User login process, checks if user exists and password is correct */
//$conn->close();
// Escape email to protect against SQL injections
$x=$_POST['mobile'];
$y=$_POST['password'];
$temp = "";
//$email = $mysqli->escape_string($_POST['email']);
//$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
	if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "shop";
	}
	else if($_SERVER['SERVER_NAME']=='truelook.in')
	{
		$servername = "sun";
		$username = "truelook_root";
		$password = "truelook@12#123";
		$dbname = "truelook_truedb";
	}
	
	$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		//echo "Connected successfully";
	
$sql = "select * from admin where userid = '".$x."'";
// $sql = "select * from employersusers where userid = '".$x."'";
$result = $conn->query($sql);

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else { // User exists
    
	while($row = $result->fetch_assoc()) {
       // $temp = $row["password"];
		if($y==$row["password"])
		{
	//$row = $result->fetch_assoc();
	        
        $_SESSION['email'] = $row['userid'];
        $_SESSION['first_name'] = $row['name'];
        $_SESSION['last_name'] = " ";
        $_SESSION['active'] = 1;	
        
        // This is how we'll know the user is logged in
        $_SESSION['adminlogin'] = true;
				
    echo "<script>location='../admin/index.php'</script>";
       
	exit();
    
		}
    }
}
?>