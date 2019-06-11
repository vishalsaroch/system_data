<?php include("config.php");?>
<?php
$x=$_POST['userid'];
$y=$_POST['pwd'];
$sql = "select * from admin where userid = '".$x."'";
$result = $conn->query($sql);
if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: index.php");
}
else { // User exists
  while($row = $result->fetch_assoc()) {
    if($y==$row["password"])
		{
	    $row = $result->fetch_assoc();
	      $_SESSION['userid'] = $row['userid'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['adminlogin'] = true;
		    echo "<script>location='dashboard.php'</script>";
        echo "login sucessfully";
        exit();
    
		}
    }
}
?>