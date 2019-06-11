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
    span{
      line-height: 1;
    }
  </style>
</head>
<body style="background-color: #e6ffee">
<?php include("nav.php"); ?>
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <!-- <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p> -->
    </div>
<div class="col-sm-8 text-left" style="background-color: #fff; padding-bottom:20px; margin-top: 100px;"> 
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
    while($row = $result->fetch_assoc()) {
        echo "<div class='col-lg-12'>
                <h3> " . $row["jobTitle"]. "</h3>
                <p><span style='margin:10px; font-weight: bold;'>Experience:</span>" . $row["year"]. " years.</p>
                <p><span style='margin:10px; font-weight: bold;'>Salary:</span>" . $row["month"]. " L P A </p>
                <p><span style='margin:10px; font-weight: bold;'>Qualification:</span>" . $row["Qualification"]. "</p>
                <p><span style='margin:10px; font-weight: bold;'>Job Type:</span>" . $row["jobType"]. "</p>
                <p><span style='margin:10px; font-weight: bold;'>Industry:</span>" . $row["Industry"]. "</p>
                <p><span style='margin:10px; font-weight: bold;'>Function/Dept : </span>" . $row["Function/Dept"]. "</p>
                <p><span style='margin:10px; font-weight: bold;'>Role/Responsibility :  : </span>" . $row["role"]. "</p>
                <p><span style='margin:10px; font-weight: bold;'>Job Type : </span>" . $row["jobType"]. "</p>
                <p><span style='margin:10px; font-weight: bold;'>Nationality : </span>" . $row["Nationality"]. "</p>
                <p><span style='margin:10px; font-weight: bold;'>Job Discription:</span><br><br><span style='margin:10px;'> " . $row["description"]. "</span></p>
                
                <a href='showjob.php' class='btn btn-info'>Back</a>
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