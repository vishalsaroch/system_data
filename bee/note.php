
<?php
	if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dbase1";
	}
	else if($_SERVER['SERVER_NAME']=='arjjsngo.org.in')
	{
		$servername = "sun";
		$username = "arjjsngo_root";
		$password = "rootPWD@#";
		$dbname = "arjjsngo_dbase1";
	}
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
    }
?>

<?php
  $note=$_POST['note'];
  $id=$_POST['id'];
  $sql = "UPDATE `form` SET `comment`='".$note."' WHERE `id`='".$id."';";
  $run = mysqli_query($conn, $sql);
  if ($run) {
        
     header("location:report.php");
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>