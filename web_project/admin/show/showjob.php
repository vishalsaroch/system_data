<!DOCTYPE html> 
<html>
<head>
  <title>Job Detail</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    .row{
      margin-top: 100px;
    }
  </style>
</head>
<body>
<?php include("../list/nav.php"); ?>
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <!-- <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p> -->
    </div>
<div class="col-sm-6 text-left"> 
<?php
  $iddd=$_GET["id"];
  if($_SERVER['SERVER_NAME']=='localhost')
  {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "dbase2";
  }
  else if($_SERVER['SERVER_NAME']=='cogentsol.in')
  {
  $servername = "sun";
  $username = "cogentso_root";
  $password = "rootPWD@#";
  $dbname = "cogentso_dbase2";
  }
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  }
  $conn = new mysqli($servername, $username, $password, $dbname);
                                  
  $sql = "SELECT * FROM `job` where `sno`=".$iddd;

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {                                  
  // echo " <table class='table table-bordered' ><tr><th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
  while($row = $result->fetch_assoc()) {                                      
    echo "<div class='col-lg-12'>
            <p><b>Job ID: </b> " . $row["sno"]. "</p>
            <p><b>Job Title: </b> " . $row["jobTitle"]. "</p>
            <p><b>Job Type: </b> " . $row["jobType"]. "</p>
            <p><b>Description: </b>" . $row["description"]. "</p>
            <p><b>City: </b>" . $row["description"]. "</p>
            <p><b>Required Experince: </b>" . $row["year"]. "." . $row["month"]. "</p>
            <p><b>HR ID : </b>  " . $row["email"]. "</p><p><b>Contact No : </b> ".$row["mobileno"]."</p>
            <a href='../index.php' class='btn btn-info'>Back</a>
          </div>" ;
     }
     } else {
             }
              $conn->close();
              ?>
      
    </div>
    <div class="col-sm-2 sidenav">
      <<!-- div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p> -->
      </div>
    </div>
  </div>
</div>

</body>
</html>