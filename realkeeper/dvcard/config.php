<?php
if($_SERVER['SERVER_NAME']=='localhost'){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vard";
  }
  else if($_SERVER['SERVER_NAME']=='dvcard.realkeeper.in'||$_SERVER['SERVER_NAME']=='www.dvcard.realkeeper.in'){
    $servername = "sun";
    $username = "realkeep_root";
    $password = "realkeep@44";
    $dbname = "realkeep_vard";
  }
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 
?>