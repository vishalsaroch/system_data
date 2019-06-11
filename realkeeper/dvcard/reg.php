<?php include("config.php");?>
<?php
	$name=$_POST['name'];
	echo $name;
	$email=$_POST['email'];
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];
	$date=date("Y/m/d");
	
	 $sql = "SELECT * from `user` WHERE email = '".$email."'";		
	 $result1 = $conn->query($sql);
	  if ($result1->num_rows > 0) {
	  	// $msg="Email id already exist.";	
	  	echo "Email id already exist.";	
	  } elseif($password1 != $password2){
         echo "Passwords doesn't Match";
         } 
	  else {
		$sql = "INSERT INTO `user` ( `email`, `password`) VALUES ( '$email', '$password1')";
		//$sql = "INSERT INTO `user` (`name`, `email`, `password`, `date`) VALUES ('$name', '$email', '$password1', '$date')";
			
		if ($conn->query($sql) === TRUE) {
		    // echo "Compamy Register Successfully";
		    session_start();
				$_SESSION['email'] = $email;
		        $_SESSION['first_name'] = $name;
		        $_SESSION['last_name'] = " ";
		        
		        
		        $_SESSION['active'] = 1;	
		        
		        // This is how we'll know the user is logged in
		        $_SESSION['logged_in'] = true;

				echo "<script>location='info.php'</script>";
				exit();
		    	// header("location:employee/profile.php");
				} else {
		    	echo "Error: " . $sql . "<br>" . $conn->error;
				}
			
			    $conn->close(); 
		}
?>