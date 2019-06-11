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


$hname=$_POST['hname'];
$hgender=$_POST['hgender'];
$hage=$_POST['hage'];
$hfather=$_POST['hfather'];
$haddress=$_POST['haddress'];
$hdoor=$_POST['hdoor'];
$hstreet=$_POST['hstreet'];
$hcity=$_POST['hcity'];
$hstate=$_POST['hstate'];
$hdistrict=$_POST['hdistrict'];
$hmobile=$_POST['hmobile'];
$hotherid=$_POST['hotherid'];
$haadhar=$_POST['haadhar'];
$hdisability=$_POST['hdisability'];
$hmarried=$_POST['hmarried'];
$hrent=$_POST['hrent'];
$hincome=$_POST['hincome'];

$name1=$_POST['name1'];
$relation1=$_POST['relation1'];
$gender1=$_POST['gender1'];
$age1=$_POST['age1'];
$aadhar1=$_POST['aadhar1'];
$otherid1=$_POST['otherid1'];
$otheridno1=$_POST['otheridno1'];

$name2=$_POST['name2'];
$relation2=$_POST['relation2'];
$gender2=$_POST['gender2'];
$age2=$_POST['age2'];
$aadhar2=$_POST['aadhar2'];
$otherid2=$_POST['otherid2'];
$otheridno2=$_POST['otheridno2'];

$name3=$_POST['name3'];
$relation3=$_POST['relation3'];
$gender3=$_POST['gender3'];
$age3=$_POST['age3'];
$aadhar3=$_POST['aadhar3'];
$otherid3=$_POST['otherid3'];
$otheridno3=$_POST['otheridno3'];

$name4=$_POST['name4'];
$relation4=$_POST['relation4'];
$gender4=$_POST['gender4'];
$age4=$_POST['age4'];
$aadhar4=$_POST['aadhar4'];
$otherid4=$_POST['otherid4'];
$otheridno4=$_POST['otheridno4'];

$name5=$_POST['name5'];
$relation5=$_POST['relation5'];
$gender5=$_POST['gender5'];
$age5=$_POST['age5'];
$aadhar5=$_POST['aadhar5'];
$otherid5=$_POST['otherid5'];
$otheridno5=$_POST['otheridno5'];

$sql = "INSERT INTO `form` (`hname`, `hgender`, `hage`, `hfather`, `haddress`, `hdoor`, `hstreet`, `hcity`, `hstate`, `hdistrict`, `hmobile`, `hotherid`, `haadhar`, `hdisability`, `hmarried`, `hrent`, `hincome`, `name1`, `relation1`, `gender1`, `age1`, `aadhar1`, `otherid1`, `otheridno1`, `name2`, `relation2`, `gender2`, `age2`, `aadhar2`, `otherid2`, `otheridno2`, `name3`, `relation3`, `gender3`, `age3`, `aadhar3`, `otherid3`, `otheridno3`, `name4`, `relation4`, `gender4`, `age4`, `aadhar4`, `otherid4`, `otheridno4`, `name5`, `relation5`, `gender5`, `age5`, `aadhar5`, `otherid5`, `otheridno5`) VALUES ('".$hname."', '".$hgender."', '".$hage."', '".$hfather."', '".$haddress."', '".$hdoor."', '".$hstreet."', '".$hcity."', '".$hstate."', '".$hdistrict."', '".$hmobile."', '".$hotherid."', '".$haadhar."', '".$hdisability."', '".$hmarried."', '".$hrent."', '".$hincome."', '".$name1."', '".$relation1."', '".$gender1."', '".$age1."', '".$aadhar1."', '".$otherid1."', '".$otheridno1."', '".$name2."', '".$relation2."', '".$gender2."', '".$age2."', '".$aadhar2."', '".$otherid2."', '".$otheridno2."', '".$name3."', '".$relation3."', '".$gender3."', '".$age3."', '".$aadhar3."', '".$otherid3."', '".$otheridno3."', '".$name4."', '".$relation4."', '".$gender4."', '".$age4."', '".$aadhar4."', '".$otherid4."', '".$otheridno4."', '".$name5."', '".$relation5."', '".$gender5."', '".$age5."', '".$aadhar5."', '".$otherid5."', '".$otheridno5."');";

//$sql = "INSERT INTO `form` (`hname`, `hgender`, `hage`, `hfather`, `haddress`, `hdoor`, `hstreet`, `hcity`, `hstate`, `hdistrict`, `hmobile`, `hotherid`, `haadhar`, `hdisability`, `hmarried`, `hrent`, `hincome`, `name1`, `relation1`, `gender1`, `age1`, `aadhar1`, `otherid1`, `otheridno1`, `name2`, `relation2`, `gender2`, `age2`, `aadhar2`, `otherid2`, `otheridno2`, `name3`, `relation3`, `gender3`, `age3`, `aadhar3`, `otherid3`, `otheridno3`, `name4`, `relation4`, `gender4`, `age4`, `aadhar4`, `otherid4`, `otheridno4`, `name5`, `relation5`, `gender5`, `age5`, `aadhar5`, `otherid5`, `otheridno5`) VALUES ('".$hname."', '".$hgender".', '".$hage."', '".$hfather."', '".$haddress."', '".$hdoor."', '".$hstreet."', '".$hcity."', '".$hstate."', '".$hdistrict."', '".$hmobile."', '".$hotherid."', '".$haadhar."', '".$hdisability."', '".$hmarried."', '".$hrent."', '".$hincome."', '".$name1."', '".$relation1."', '".$gender1."', '".$age1."', '".$aadhar1."', '".$otherid1."', '".$otheridno1."', '".$name2."', '".$relation2."', '".$gender2."', '".$age2."', '".$aadhar2."', '".$otherid2."', '".$otheridno2."', '".$name3."', '".$relation3."', '".$gender3."', '".$age3."', '".$aadhar3."', '".$otherid3."', '".$otheridno3."', '".$name4."', '".$relation4."', '".$gender4."', '".$age4."', '".$aadhar4."', '".$otherid4."', '".$otheridno4."', '".$name5."', '".$relation5."', '".$gender5."', '".$age5."', '".$aadhar5."', '".$otherid5."', '".$otheridno5."');";
	

if ($conn->query($sql) === TRUE) {
    echo "Thanks for submitting form! :-)";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
$conn->close();
?>