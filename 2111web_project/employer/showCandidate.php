<!DOCTYPE html> 
<html>
<head>
  <title>Show Candidate</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php include("nav.php"); ?>
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <!-- <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p> -->
    </div>
<div class="col-sm-12 text-left"> 
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

    // $sql = "SELECT * FROM `Candidate` where `sno`=".$iddd;

                                  // $result = $conn->query($sql);
                                  // if ($result->num_rows > 0) {
                                    // echo " <table class='table table-bordered' ><tr><th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
                                //     while($row = $result->fetch_assoc()) {
                                //         echo "<div class='col-lg-12'>
                                //                 <h3>" . $row["jobTitle"]. "</h3>
                                //                 <p>" . $row["description"]. "</p>
                                //                 <p><b>HR ID : </b>  " . $row["email"]. "</p><p><b>Contact No : </b> ".$row["mobileno"]."</p>
                                //                 <a href='job.php' class='btn btn-info'>Edit</a>
                                //                 <a href='showjob.php' class='btn btn-info'>Back</a>
                                //                 </div>" ;
                                //     }
                                // } else {
                                    
                                // }
                                // $conn->close();    
            $sql = "SELECT basicinformation.DOB, basicinformation.MaritalStatus, basicinformation.Address, basicinformation.Religion , basicinformation.Nationality, basicinformation.LanguageKnown, basicinformation.CurrentDesignation,basicinformation.CurrentLocation, basicinformation.FatherName, basicinformation.NoticePeriod, basicinformation.PreferredLocation, basicinformation.ExpectedSalary, basicinformation.Gender,basicinformation.MaritalStatus,  candidate.fname, candidate.lname, candidate.emailid, candidate.mobileno, candidate.mobileno, candidate.years, candidate.months FROM basicinformation INNER JOIN candidate ON basicinformation.sno = candidate.sno ";  
            $result = $conn->query($sql);
              // $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
              // echo " <table class='table table-bordered' ><tr><th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
              while($row = $result->fetch_assoc()) {
                  echo "<div class='row' >
                          <div class='col-md-2'></div>
                          <div class='col-md-8' style='margin-top:20px; margin-bottom: 20px'>
                            <div class='well'>
                            <h1>Basic Detail</h1>
                              <table>
                                <tr>
                                  <td><strong>First Name:</strong></td><td> " . $row["fname"]. " ". $row["lname"]."</td></tr>
                                  <td><strong>Father Name:</strong></td><td> " . $row["FatherName"]."</td></tr>
                                  <td><strong>Email:</strong> </td><td>" . $row["emailid"]."</td></tr>
                                  <td><strong>Gender:</strong></td><td>" . $row["Gender"]."</td></tr>
                                  <td><strong>Mobile No:</strong></td><td> " . $row["mobileno"]."</td></tr>
                                  <td><strong>Address:</strong></td><td>" . $row["Address"]."</td></tr>
                                  <td><strong>Matrial:</strong></td><td>" . $row["MaritalStatus"]."</td></tr>
                                  <td><strong>Religion:</strong></td><td>" . $row["Religion"]."</td></tr>
                                  <td><strong>Nationality:</strong></td><td>" . $row["Nationality"]."<td></tr>
                                  <td><strong>Language Known:</strong></td><td>" . $row["LanguageKnown"]."</td></tr>
                                  <td><strong>Current Designation:</strong></td><td>" . $row["CurrentDesignation"]."</td></tr>
                                  <td><strong>Current Location:</strong></td><td>" . $row["CurrentLocation"]."</td></tr>
                                  <td><strong>Preferred Location:</strong></td><td>" . $row["PreferredLocation"]."</td></tr>
                                  <td><strong>Total Experience:</strong></td><td> " . $row["years"]. ".". $row["months"]." Years</tr>
                                  <td><strong>Notice Period:</strong</td><td>" . $row["NoticePeriod"]." Month</td></tr>
                                  <td><strong>Expected Salary:</strong></td><td>" . $row["ExpectedSalary"]."</td></tr>
                                </tr>
                              </table>
                            </div>
                           </div> 
                          <div class='col-md-2'></div>" ;
              }
          } else {
              echo "</table>";
          }
          $conn->close();
          ?>
    </div>
      <div class="col-sm-2 sidenav"></div>
    </div>
  </div>
</div>

</body>
</html>