<?php
include_once '../config.php';
$iddd=$_GET["id"];
mysqli_query($conn,"DELETE FROM educational WHERE sno='" . $iddd . "'");

echo "Educational Delete sucessfully";
 header("location:profile.php"); 
?>
