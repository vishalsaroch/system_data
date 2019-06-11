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
                                  
  $sql = "SELECT * FROM `employersusers` where `sno`=".$iddd;

// $sql = "SELECT employersusers.compName, employersusers.MaritalStatus, employersusers.contactNo, employer.address, employer.state, employer.industory, employer.product, employer.   Statutory FROM employersusers INNER JOIN employer ON employersusers.emailid = employer.emailid where where `sno`=".$iddd;

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {                                  
  // echo " <table class='table table-bordered' ><tr><th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
  while($row = $result->fetch_assoc()) {                                      
    echo "<div class='col-lg-12 '>
            <h3><b>Company Name : </b> " . $row["compName"]. "</h3>
             <p><b>Company Email ID : </b>" . $row["emailid"]. "</p>

            <p><b>HR Cntact No : </b>  " . $row["contactNo"]. "</p>
          </div>" ;
     }
     } 


  $sql = "SELECT * FROM `employer` where `sno`=".$iddd;

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {                                  
  // echo " <table class='table table-bordered' ><tr><th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
  while($row = $result->fetch_assoc()) {                                      
    echo "<div class='col-lg-12'>
            <p> <b>address : </b>" . $row["address"]. "</p>
             <p><b>State : </b>" . $row["state"]. "</p>
            <p><b>Industory : </b>  " . $row["industory"]. "</p>
             <p><b>Product : </b>  " . $row["product"]. "</p>
             <p><b>Statutory : </b>  " . $row["Statutory"]. "</p>
            <a href='../index.php' class='btn btn-info'>Back</a>
          </div>" ;
     }
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

<div class="container">
<div class="col-sm-2"></div>
  <div class="col-sm-12">
  <h3>Services</h3>
  <table class="table">
  <tr>
    
    <td><b>Advance Search</b></td>
    <td><b>Add New Job</b></td>
    <td><b>Show My Job</b></td>
    <td><b>EmportTo Execl</b></td>
    <td><b>Show Candidate</b></td>
  </tr>

  <tr>
    
    <td><input type="Checkbox" name="advanceSearch"></td>
    <td><input type="Checkbox" name="newjob"></td>
    <td><input type="Checkbox" name="Showjob"></td>
    <td><b><input type="Checkbox" name="export"></b></td>
    <td><b><input type="Checkbox" name="showcandidate"></b></td>
  </tr>
  </table>
  </div>
  <div class="col-sm-2"></div>

  
</div>

</body>
</html>