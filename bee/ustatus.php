
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
?>z

<?php
  $status=$_POST['status'];
  $inid=$_POST['inid'];
  $udate= date("Y/m/d");
  $sql = "UPDATE `form` SET `status`='".$status."', `udate`='".$udate."' WHERE `id`='".$inid."';";
  $run = mysqli_query($conn, $sql);
  if ($run) {
        
     header("location:report.php");
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>