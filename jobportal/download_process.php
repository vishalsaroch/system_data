<?php include("config.php");?>
<?php
	$name=$_POST['name'];	
	$email=$_POST['email'];		
	$number=$_POST['number'];
	$mobileno=$_POST['txtEmpPhone'];
	$date=date("Y/m/d");
	$sql = "INSERT INTO `download` (`name`,`email`, `mobileno``date`) VALUES ('$nname', '$emailid', '$mobileno', '$date')";
	if ($conn->query($sql) === TRUE) {
	    echo "Download in Process";
	    // echo "<a href='https://www.dropbox.com/s/701auzbihaaat1m/Realkeeper_Setup.exe?dl=1'>";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();    
?>

