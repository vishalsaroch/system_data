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
  <script>
  function seeMoreData(element){
    var candidateId=element.childNodes[1].innerHTML;
    //alert(candidateId);
    if(location.hostname=='localhost')
      {
        window.open("/web_project/admin/show/showCandidate.php?id="+candidateId.toString());
      }
      else if(location.hostname=='cogentsol.in')
      {
        window.open("post.php?id="+candidateId.toString());
      }
  }
</script>
</head>
<body>
<?php include("../list/nav.php"); ?>
<div class="container text-center">    
  <div class="row content" style="margin-top: 100px;">
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
    // $conn = new mysqli($servername, $username, $password, $dbname);

     $sql = "SELECT * FROM `Candidate` where `sno`=".$iddd;

      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
        echo " 
                <div class='col-sm-8'>
                  <h1 align='center'>Candidate info</h1>
                    <div class='col-sm-12' align='center'>

                    <h3>" . $row["fname"]. " " . $row["lname"]. "</h3>
                      <h4>" . $row["jobtitle"]. "</h4>
                       <p>" . $row["emailid"]. "</p>
                      <p> ".$row["mobileno"]."</p>
                      </div>
                  </div>
               
              ";
        }
      } else {
      }


     $sql = "SELECT * FROM `basicinformation` where `sno`=".$iddd;
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
        echo " <div class='row' text-center>
                          <div class='col-md-2'></div>
                          <div class='col-md-8' style='margin-top:20px; margin-bottom: 20px' align='center'>
                            <h1>Basic Detail</h1>
                              <table class='teble'>
                                <tr>
                                  <td><strong>Father Name:</strong></td><td> " . $row["FatherName"]."</td></tr>
                                  <td><strong>Gender:</strong></td><td>" . $row["Gender"]."</td></tr>
                                  <td><strong>Address:</strong></td><td>" . $row["Address"]."</td></tr>
                                  <td><strong>Matrial:</strong></td><td>" . $row["MaritalStatus"]."</td></tr>
                                  <td><strong>Religion:</strong></td><td>" . $row["Religion"]."</td></tr>
                                  <td><strong>Nationality:</strong></td><td>" . $row["Nationality"]."<td></tr>
                                  <td><strong>Language Known:</strong></td><td>" . $row["LanguageKnown"]."</td></tr>
                                  <td><strong>Current Designation:</strong></td><td>" . $row["CurrentDesignation"]."</td></tr>
                                  <td><strong>Current Location:</strong></td><td>" . $row["CurrentLocation"]."</td></tr>
                                  <td><strong>Preferred Location:</strong></td><td>" . $row["PreferredLocation"]."</td></tr>
                                  <td><strong>Notice Period:</strong</td><td>" . $row["NoticePeriod"]." Month</td></tr>
                                  <td><strong>Expected Salary:</strong></td><td>" . $row["ExpectedSalary"]."</td></tr>
                                </tr>
                              </table>
                            <a href='../index.php' class='btn btn-info'>Back</a>
                           </div> 
                          <div class='col-md-2'></div>";
                           }
          } else {
              echo "</table>";
          }

          $sql = "SELECT * FROM `educational` where `sno`=".$iddd;

      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
        echo " 
                <div class='col-sm-8'>
                  <h1 align='center'>Educational and Qualification</h1>
                    <div class='col-sm-12' align='center'>
                    <table>
                      <tr><th>Qualification</th><td>" . $row["Course"]."</td></tr>
                      <tr><th>Course</th><td>" . $row["Course"]. "</td></tr>
                      <tr><th>Specialization</th><td>" . $row["Specialization"]. "</td></tr>
                      <tr><th>BoardUniversity</th><td>".$row["BoardUniversity"]."</td></tr>
                      <tr><th>Year</th><td>" . $row["Year"]. "</td></tr>
                      <tr><th>Location</th><td>" . $row["Location"]. "</td></tr>
                      <tr><th>marks</th><td>".$row["marks"]."</td></tr>
                      </table>
                      </div>
                  </div>
               
              ";
        }
      } else {
      }

      $sql = "SELECT * FROM `employmenthistory` where `sno`=".$iddd;

      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
        echo " 
                <div class='col-sm-8'>
                  <h1 align='center'>Employement History</h1>
                    <div class='col-sm-12' align='center'>
                    <table>
                      <tr><th>Company Name</th><td>" . $row["CompanyName"]."</td></tr>
                      <tr><th>Industry </th><td>" . $row["Industry"]. "</td></tr>
                      <tr><th>Function</th><td>" . $row["Function"]. "</td></tr>
                      <tr><th>Position</th><td>".$row["Position"]."</td></tr>
                      <tr><th>CTC</th><td>" . $row["CTC"]. "</td></tr>
                      <tr><th>Employement Period</th><td>" . $row["EmployementPeriod"]. "</td></tr>
                      <tr><th>Reason</th><td>".$row["Reason"]."</td></tr>
                      </table>
                      </div>
                  </div>";
        }
      } else {
      }

      $conn->close();    
            // $sql = "SELECT basicinformation.DOB, basicinformation.MaritalStatus, basicinformation.Address, basicinformation.Religion , basicinformation.Nationality, basicinformation.LanguageKnown, basicinformation.CurrentDesignation,basicinformation.CurrentLocation, basicinformation.FatherName, basicinformation.NoticePeriod, basicinformation.PreferredLocation, basicinformation.ExpectedSalary, basicinformation.Gender,basicinformation.MaritalStatus,  candidate.fname, candidate.lname, candidate.emailid, candidate.mobileno, candidate.mobileno, candidate.years, candidate.months FROM basicinformation INNER JOIN candidate ON basicinformation.sno = candidate.sno ";  
            // // $sql = "SELECT basicinformation.DOB, basicinformation.MaritalStatus, basicinformation.Address, basicinformation.Religion , basicinformation.Nationality, basicinformation.LanguageKnown, basicinformation.CurrentDesignation,basicinformation.CurrentLocation, basicinformation.FatherName, basicinformation.NoticePeriod, basicinformation.PreferredLocation, basicinformation.ExpectedSalary, basicinformation.gender,basicinformation.MaritalStatus,  candidate.fname, candidate.lname, candidate.emailid, candidate.mobileno, candidate.mobileno, candidate.years, candidate.months FROM basicinformation INNER JOIN candidate ON basicinformation.sno = candidate.sno where candidate.emailid = '".$_SESSION['email']."';";
            // $result = $conn->query($sql);
            //   // $result = mysqli_query($conn, $sql);
            // if ($result->num_rows > 0) {
            //   // echo " <table class='table table-bordered' ><tr><th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
            //   while($row = $result->fetch_assoc()) {
            //       echo "<div class='row' >
            //               <div class='col-md-2'></div>
            //               <div class='col-md-8' style='margin-top:20px; margin-bottom: 20px'>
            //                 <div class='well'>
            //                 <h1>Basic Detail</h1>
            //                   <table>
            //                     <tr>
            //                       <td><strong>First Name:</strong></td><td> " . $row["fname"]. " ". $row["lname"]."</td></tr>
            //                       <td><strong>Father Name:</strong></td><td> " . $row["FatherName"]."</td></tr>
            //                       <td><strong>Email:</strong> </td><td>" . $row["emailid"]."</td></tr>
            //                       <td><strong>Gender:</strong></td><td>" . $row["Gender"]."</td></tr>
            //                       <td><strong>Mobile No:</strong></td><td> " . $row["mobileno"]."</td></tr>
            //                       <td><strong>Address:</strong></td><td>" . $row["Address"]."</td></tr>
            //                       <td><strong>Matrial:</strong></td><td>" . $row["MaritalStatus"]."</td></tr>
            //                       <td><strong>Religion:</strong></td><td>" . $row["Religion"]."</td></tr>
            //                       <td><strong>Nationality:</strong></td><td>" . $row["Nationality"]."<td></tr>
            //                       <td><strong>Language Known:</strong></td><td>" . $row["LanguageKnown"]."</td></tr>
            //                       <td><strong>Current Designation:</strong></td><td>" . $row["CurrentDesignation"]."</td></tr>
            //                       <td><strong>Current Location:</strong></td><td>" . $row["CurrentLocation"]."</td></tr>
            //                       <td><strong>Preferred Location:</strong></td><td>" . $row["PreferredLocation"]."</td></tr>
            //                       <td><strong>Total Experience:</strong></td><td> " . $row["years"]. ".". $row["months"]." Years</tr>
            //                       <td><strong>Notice Period:</strong</td><td>" . $row["NoticePeriod"]." Month</td></tr>
            //                       <td><strong>Expected Salary:</strong></td><td>" . $row["ExpectedSalary"]."</td></tr>
            //                     </tr>
            //                   </table>
            //                 </div>
            //                </div> 
            //               <div class='col-md-2'></div>" ;
          //     }
          // } else {
          //     echo "</table>";
          // }
          // $conn->close();
          ?>
    </div>
      <div class="col-sm-2 sidenav"></div>
    </div>
  </div>
</div>

</body>
</html>