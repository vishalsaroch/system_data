<?php
    if($_SERVER['SERVER_NAME']=='localhost'){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "shop";
    }
    else if($_SERVER['SERVER_NAME']=='truelook.in')
  	{
  		$servername = "sun";
  		$username = "truelook_root";
  		$password = "truelook@12#123";
  		$dbname = "truelook_truedb";
  	}
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
  ?>