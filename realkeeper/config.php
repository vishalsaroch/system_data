<?php
if($_SERVER['SERVER_NAME']=='localhost'){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "realkeeper";
  }
  else if($_SERVER['SERVER_NAME']=='www.realkeeper.in'||$_SERVER['SERVER_NAME']=='realkeeper.in'){
    $servername = "sun";
    $username = "realkeep_root1";
    $password = "rootPWD@#";
    $dbname = "realkeep_account";
  }
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 
?>