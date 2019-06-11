<?php include("config.php");?>
<?php
if(isset($_POST['submit']))
{
	$userid=$_POST['emailid'];
	$pwd=$_POST['password'];
	$name=$_POST['name'];
	$compName=$_POST['compName'];
	$contactNo=$_POST['contactNo'];
	$role=$_POST['role'];
	$date=date("Y/m/d");
	$msg="";
	 $sql = "SELECT * from `employersusers` WHERE emailid = '".$userid."'";		
	 $result1 = $conn->query($sql);
	  if ($result1->num_rows > 0) {
	  	$msg="Email id already exist.";		
	  } else {
		$sql = "INSERT INTO `employersusers` (`compName`, `username`, `emailid`, `contactNo`, `userid`, `pwd`, `date`, `role`) VALUES ('$compName', '$name', '$userid', '$contactNo', '$userid', '$pwd' , '$date' , '$role')";
			
		if ($conn->query($sql) === TRUE) {
		    // echo "Compamy Register Successfully";
		    session_start();
				$_SESSION['email'] = $userid;
		        $_SESSION['first_name'] = $name;
		        $_SESSION['last_name'] = " ";
		        
		        
		        $_SESSION['active'] = 1;	
		        
		        // This is how we'll know the user is logged in
		        $_SESSION['emplogged_in'] = true;

				echo "<script>location='./employee/profile.php'</script>";
				exit();
		    	// header("location:employee/profile.php");
				} else {
		    	echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
			    $conn->close(); 
		}   
?>