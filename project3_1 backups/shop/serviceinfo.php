<?php
/* Displays user information and some useful messages */
session_start();
// echo session_id();
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in2'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";

  header("location:login2/index.php");  
  exit();
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>

<?php 
     
     // Display message about account verification link only once
     if ( isset($_SESSION['message']) )
     {
         echo $_SESSION['message'];
         
         // Don't annoy the user with more messages upon page refresh
         unset( $_SESSION['message'] );
     }
?>
<?php
    // Keep reminding the user this account is not active, until they activate
     if ( !$active ){
         header("location:login2/index.php");
   exit();
     }
     
?>
<?php
    $pname = $_POST['pname'];
	$price = $_POST['price'];
    $dis = $_POST['dis'];
    $images = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
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
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 



// $sql = "SELECT * from `userserviseupdate` WHERE pname = '".$pname."'";		
//  $result1 = $conn->query($sql);
//   if ($result1->num_rows > 0) {
//   	echo "User is already exist.";
//   	header("location:profile.php");
//   } else {
  		// $sql = "INSERT INTO `userserviseupdate` (`pname`, `dis`, `price`, `image`, `userid`) VALUES ('$pname', '$dis', '$price', '$images' , '$email')";

		$sql = "INSERT INTO `userserviseupdate` (`image`, `userid`) VALUES ('$images' , '$email')";  	
		if ($conn->query($sql) === TRUE) {

		    echo "User Registed Sucessfully";
		    // header("location:profile.php");
			} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
			$conn->close();    

  	// }




?>