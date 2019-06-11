<?php include("config.php");?>
<?php include("user-session.php");?>
<?php
	// $photo=$_POST['photo'];
	$photo = addslashes(file_get_contents($_FILES["photo"]["tmp_name"]));
	$address=$_POST['address'];
	$cnumber=$_POST['cnumber'];
	$code='91';
	// $b = gettype($code);
	$whatsaapno=$_POST['whatsaap'];
	// $a = gettype($whatsaap);
	$whatsaap=$code . $whatsaapno;
	$facebook=$_POST['facebook'];
	$skype=$_POST['skype'];
	$company=$_POST['company'];
	$des=$_POST['des'];
	$web=$_POST['web'];
	// $logo=$_POST['logo'];
	$logo = addslashes(file_get_contents($_FILES["logo"]["tmp_name"]));

	$sql = "UPDATE `user` SET `photo`='".$photo."', `phone`='".$cnumber."', `whatsaap`='".$whatsaap."',`facebook`='".$facebook."',`skype`='".$skype."',`Address`='".$address."', `company`='".$company."',`designation`='".$des."',`website`='".$web."', `logo`='".$logo."' WHERE `email`='".$_SESSION['email']."';";
             // $sql = "UPDATE `candidate` SET `FatherName`='".$fathername."',`DOB`='".$dob."',`Gender`='".$gender."',`MatricalStatus`='".$matricalStatus."',`CurrentDesignation`='".$designation."',`CurrentLocation`='".$clocation."',`Address`='".$address."', `Religion`='".$religion."',`Nationality`='".$nationality."',`LanguageKnown`='".$language."',`PreferredLocation`='".$plocation."',`  NoticePeriod`='".$notice."',`  ExpectedSalary`='".$ExpectedSalary."', `date`='".$date."' WHERE `userid`='".$_SESSION['email']."';";
            
            $run = mysqli_query($conn, $sql);
            if ($run) {
              echo "<div class='bg-success text-center text-light text-bold'>Personal Information Updated Successfully</div><br>";
              echo "<script>location='index.php'</script>";
              } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
            
?>