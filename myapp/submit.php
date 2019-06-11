<?php
$x=$_POST['name'];
$y=$_POST['rollno'];
$servername = "sun";
$username = "himalyan_root";
$password = "rootPWD@#";
$dbname = "himalyan_dbase1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
$sql = "INSERT INTO table1 (name, rollno) VALUES ('$x', $y)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "select name, rollno from table1";
$result = $conn->query($sql);

if($result->num_rows>0){
	echo "<table>";
	while($row = $result->fetch_assoc()){
		echo "<tr><td> Name: " . $row["name"]. "  " . $row["rollno"]. "</td><tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}

$conn->close();
?>