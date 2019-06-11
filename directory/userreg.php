<?php include("config.php");?>
<?php
	$name=$_POST['name'];
	$email=$_POST['email'];
	$mobileno=$_POST['mobileno'];
	$password=$_POST['password1'];
	$date=date("Y/m/d");
	$msg="";
	 $sql = "SELECT * from `user` WHERE email = '".$email."'";		
	 $result1 = $conn->query($sql);
	  if ($result1->num_rows > 0) {
	  	// $msg="Email id already exist.";	
	  	echo "Email id already exist.";	
	  } else {
		$sql = "INSERT INTO `user` (`name`, `email`, `mobile`, `password`, `date`) VALUES ('$name', '$email', '$mobileno', '$password', '$date')";
			
		if ($conn->query($sql) === TRUE) {
		    // echo "Compamy Register Successfully";
		    session_start();
				$_SESSION['email'] = $email;
		        $_SESSION['first_name'] = $name;
		        $_SESSION['last_name'] = " ";
		        
		        
		        $_SESSION['active'] = 1;	
		        
		        // This is how we'll know the user is logged in
		        $_SESSION['logged_in'] = true;

				echo "<script>location='dashboard.php'</script>";
				exit();
		    	// header("location:employee/profile.php");
				} else {
		    	echo "Error: " . $sql . "<br>" . $conn->error;
				}
			
			    $conn->close(); 
		}
?>