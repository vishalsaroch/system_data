<?php
$x=$_POST['email'];
$y=$_POST['pass'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";
$temp = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
$sql = "select pass from table1 where email = '".$x."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $temp = $row["pass"];
    }
} else {
    echo "0 results";
}

if($temp==$y)
{
    header("Location: ../admin/index.html");
    
}
//$row = $result->fetch_assoc(); not working

//echo $row["pass"]; not working

/*$sql = "INSERT INTO table1 (name, rollno) VALUES ('$x', $y)";

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
*/
$conn->close();
?>