<?php include("../config.php")?>
<?php
/* User login process, checks if user exists and password is correct */
//$conn->close();
// Escape email to protect against SQL injections
$x=$_POST['mobile'];

$y=$_POST['password'];
$temp = "";
//$email = $mysqli->escape_string($_POST['email']);
//$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
	
$sql = "select * from user where email = '".$x."'";
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
	        
        $_SESSION['email'] = $row['email'];
        $_SESSION['first_name'] = $row['name'];
        // $_SESSION['last_name'] = $row['lname'];
        // $_SESSION['qualification'] = $row['qualification'];
        
        $_SESSION['active'] = 1;	
        
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;
				
    echo "<script>location='../dashboard.php'</script>";
        echo "login successfully";
       
	exit();
    
		}
    }
}
?>