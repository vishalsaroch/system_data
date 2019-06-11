<!DOCTYPE html> 
<html>
<head>
  <title>Job Detail</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    .row{
      margin-top: 100px;
    }
  </style>
</head>
<body style="background-color: #e6fff2; font-family: "Times New Roman", Times, serif;">

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
    echo "<div class='col-lg-12' style='background-color:#fff'>
            <div class='col-md-10'>
            <h3>" . $row["jobTitle"]. "</h3>
            <p>" . $row["compName"]. "</p>
            <p><span><img src='images/bag.png' style='height=20px; width:20px; margin:10px;'>" . $row["year"]. "." . $row["month"]. "</span><span><img src='images/location.png' style='height=20px; width:20px; margin:10px;'>" .$row["city"]. "</span></p>
              </div>
              <div>
                 <button class='btn btn-info' style='margin-top:50px;'> Apply</button>
              </div>
            </div>
            <div class='col-lg-12' style='background-color:#fff; margin-bottom:20px;'>
            <p><b> Job Description :</b><br><span style='margin:10px;'>" . $row["description"]. "</span></p>
            <p><b>Industry :</b><span style='margin:10px;'>" . $row["Industry"]. "<span></p>
            <p><b>Functional Area:</b><span style='margin:10px;'>" . $row["Function/Dept"]. "</span></p>
              <p><b>Job-Type:</b><span style='margin:10px;'>" . $row["jobType"]. "</span></p>
              <p><b>Role:</b><span style='margin:10px;'>" . $row["role"]. "</span></p>
              <p><b>HR Detail: </b><br><b>Contact No</b><span style='margin:10px;'>" . $row["mobileno"]. "</span><br>
              <b>Hr Emailid: </b><span style='margin:10px;'>" . $row["email"]. "</span></p>
          </div>" ;
     }
     } else {
             }
              $conn->close();
              ?>
      
    </div>
    <div class="col-sm-2 sidenav">
      <!-- div class="well">
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