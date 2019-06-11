<?php
	if($_SERVER['SERVER_NAME']=='localhost')
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "dbase1";
	}
	else if($_SERVER['SERVER_NAME']=='himalyanfurniture.com')
	{
		$servername = "sun";
		$username = "himalyan_root";
		$password = "rootPWD@#";
		$dbname = "himalyan_dbase1";
	}
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

$p=$_POST['packageName'];

//if(isset($_POST["submit"]))
//{	echo "we are here";
	$file = addslashes(file_get_contents($_FILES["imagefile"]["tmp_name"]));
//}

$pdnN=$_POST['packageDurationNight'];
$pddN=$_POST['packageDurationDay'];
$pv=$_POST['packageValidity'];
$d1=$_POST['destination1'];
$d2=$_POST['destination2'];
$d3=$_POST['destination3'];
$d4=$_POST['destination4'];
$d5=$_POST['destination5'];
$d6=$_POST['destination6'];
$d7=$_POST['destination7'];
$d8=$_POST['destination8'];
$d9=$_POST['destination9'];
$d10=$_POST['destination10'];	
$pcN=$_POST['packageCost'];
$ih1=$_POST['itineraryh1'];
$id1=$_POST['itineraryd1'];
$ih2=$_POST['itineraryh2'];
$id2=$_POST['itineraryd2'];
$ih3=$_POST['itineraryh3'];
$id3=$_POST['itineraryd3'];
$ih4=$_POST['itineraryh4'];
$id4=$_POST['itineraryd4'];
$ih5=$_POST['itineraryh5'];
$id5=$_POST['itineraryd5'];
$ih6=$_POST['itineraryh6'];
$id6=$_POST['itineraryd6'];
$ih7=$_POST['itineraryh7'];
$id7=$_POST['itineraryd7'];
$ih8=$_POST['itineraryh8'];
$id8=$_POST['itineraryd8'];
$ih9=$_POST['itineraryh9'];
$id9=$_POST['itineraryd9'];
$ih10=$_POST['itineraryh10'];
$id10=$_POST['itineraryd10'];
$ih11=$_POST['itineraryh11'];
$id11=$_POST['itineraryd11'];
$ih12=$_POST['itineraryh12'];
$id12=$_POST['itineraryd12'];
$ih13=$_POST['itineraryh13'];
$id13=$_POST['itineraryd13'];
$ih14=$_POST['itineraryh14'];
$id14=$_POST['itineraryd14'];
$ih15=$_POST['itineraryh15'];
$id15=$_POST['itineraryd15'];
$ih16=$_POST['itineraryh16'];
$id16=$_POST['itineraryd16'];
$ih17=$_POST['itineraryh17'];
$id17=$_POST['itineraryd17'];
$i=$_POST['inclusions'];
$e=$_POST['exclusions'];
$f=$_POST['featured'];
$dori=$_POST['dori'];


$sql = "INSERT INTO `packages` (`packageName`, `image`, `packageDurationNight`, `packageDurationDay`, `packageValidity`, `destination1`, `destination2`, `destination3`, `destination4`, `destination5`, `destination6`, `destination7`, `destination8`, `destination9`, `destination10`, `packageCost`, `itineraryh1`, `itineraryd1`, `itineraryh2`, `itineraryd2`, `itineraryh3`, `itineraryd3`, `itineraryh4`, `itineraryd4`, `itineraryh5`, `itineraryd5`, `itineraryh6`, `itineraryd6`, `itineraryh7`, `itineraryd7`, `itineraryh8`, `itineraryd8`, `itineraryh9`, `itineraryd9`, `itineraryh10`, `itineraryd10`, `itineraryh11`, `itineraryd11`, `itineraryh12`, `itineraryd12`, `itineraryh13`, `itineraryd13`, `itineraryh14`, `itineraryd14`, `itineraryh15`, `itineraryd15`, `itineraryh16`, `itineraryd16`, `itineraryh17`, `itineraryd17`, `inclusions`, `exclusions`, `featured`, `dori`) VALUES ('$p', '$file', '$pdnN', '$pddN', '$pv', '$d1', '$d2', '$d3', '$d4', '$d5', '$d6', '$d7', '$d8', '$d9', '$d10', '$pcN', '$ih1', '$id1', '$ih2', '$id2', '$ih3', '$id3', '$ih4', '$id4', '$ih5', '$id5', '$ih6', '$id6', '$ih7', '$id7', '$ih8', '$id8', '$ih9', '$id9', '$ih10', '$id10', '$ih11', '$id11', '$ih12', '$id12', '$ih13', '$id13', '$ih14', '$id14', '$ih15', '$id15', '$ih16', '$id16', '$ih17', '$id17', '$i', '$e', '$f', '$dori')";
	
//$sql = "INSERT INTO contactus (name, email, contact, subject, message) VALUES ('$a', '$b', '$c', '$d', '$e')";

if ($conn->query($sql) === TRUE) {
    echo "Package Uploaded to DataBase";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
$conn->close();
?>