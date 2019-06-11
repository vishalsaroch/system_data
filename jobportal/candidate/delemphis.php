<?php
include_once '../config.php';
$iddd=$_GET["id"];

mysqli_query($conn,"DELETE FROM employmenthistory WHERE CompanyName='" . $iddd . "'");

echo "Employmenthistory delete sucessfully";
header("location:profile.php"); 
?>
