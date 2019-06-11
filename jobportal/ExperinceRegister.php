<?php include("config.php");?>
<?php
$fname=$_POST['fname'];	
$lname=$_POST['lname'];		
$emailid=$_POST['email'];
$mobileno=$_POST['txtEmpPhone'];
$qualification=$_POST['qua'];
$jobtitle=$_POST['job'];
$userid=$_POST['email'];
$pwd=$_POST['Password'];
$date=date("Y/m/d");
$sql = "SELECT * from `candidate` WHERE emailid = '".$emailid."'";		
 $result1 = $conn->query($sql);
  if ($result1->num_rows > 0) {
  	echo "Email id already exist.";
  } else {
  	//$sql = "INSERT INTO `candidate` (`fname`, `lname`) VALUES ('$fname', '$lname')";
$sql = "INSERT INTO `candidate` (`fname`, `lname`, `emailid`, `mobileno`, `qualification`, `jobtitle`, `userid`, `pwd`, `date`) VALUES ('$fname', '$lname', '$emailid', '$mobileno', '$qualification', '$jobtitle', '$userid', '$pwd', '$date')";
// $sql = "INSERT INTO `candidate` (`fname`, `emailid`, `mobileno`, `userid`,`lname`, 'qualification', 'jobtitle','years', `pwd`, `date`) VALUES ('$CompName', '$userid', '$contactNo', '$lname', '$qual', '$title', '$years', '$months', '$userid', '$pwd', '$dateNow')";

	
if ($conn->query($sql) === TRUE) {
    echo "value added to database";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	$conn->close();    

$msg = "Hi ,Your Userid - ".$userid." Password - ".$pwd." Please visit https://cogentsol.in/candidate/profile/profile";
// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($userid,"Thanks for contacting us",$msg);  
echo "mail sent."; 
  }




?>