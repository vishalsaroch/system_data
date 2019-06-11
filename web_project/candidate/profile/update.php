
<?php
$mysqli = new mysqli("localhost", "root", "", "dbase2"); 
  
if($mysqli === false){ 
    die("ERROR: Could not connect. " 
            . $mysqli->connect_error); 
} 
  
$sql = "UPDATE basicinformation SET DOB='6 /April/1995' WHERE sno=1"; 
if($mysqli->query($sql) === true){ 
    echo "Records was updated successfully."; 
} else{ 
    echo "ERROR: Could not able to execute $sql. ". $mysqli->error; 
} 
$mysqli->close(); 
?> 
