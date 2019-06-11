<?php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Personal Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class=container>
  <div class="row">
    <h3 align ='center' style='background-color: #d1e2ff;'>Personal Information</h3>
  
<!-- Add Qualifaction -->
  <?php
    // if(isset($_POST['submit'])){
        
    //       $fname = $_POST["fname"];
    //       $dob=$_POST['dob'];
    //       $gender=$_POST['gender'];
    //       $matrical=$_POST['matrical'];
    //       $designation=$_POST['designation'];
    //       $clocation=$_POST['clocation'];
    //       $address=$_POST['address'];
    //       $religion=$_POST['religion'];
    //       $nationality = $_POST["nationality"];
    //       $language=$_POST['language'];
    //       $plocation=$_POST['plocation'];
    //       $notice=$_POST['notice'];
    //       $salary=$_POST['Salary'];
//          UPDATE `basicinformation` SET `CurrentLocation` = ' Himachal ' WHERE `basicinformation`.`sno` = 1;
//             if($mysqli->query($sql) === true){ 
//                 echo "Records was updated successfully."; 
//             } else{ 
//                 echo "ERROR: Could not able to execute $sql. ". $mysqli->error; 
// } 
          // $sql = "UPDATE basicinformation SET FatherName='Sansar chand WHERE sno=1";
          //   // $sql = "INSERT INTO `basicinformation` (`FatherName`, `DOB`, `Gender`, `MaritalStatus`, `CurrentDesignation`, `CurrentLocation`, `Address`, `Religion`, `Nationality`, 'LanguageKnown', 'PreferredLocation'  `NoticePeriod`, `ExpectedSalary` ) VALUES ('$fname', '$dob', '$gender', '$matrical', '$designation', '$clocation', '$address', '$religion', '$nationality', '$language', '$plocation', '$notice', '$salary' )";

          // // $sql = "INSERT INTO `basicinformation` (`FatherName`, `DOB`, `Gender`, `MaritalStatus`, 'CurrentLocation') VALUES ('$fname', '$dob', '$gender','$matrical', '$clocation')";

          // $run = mysqli_query($conn, $sql);
          // if($run){
          //    echo "<p>Data updated sucessfully</p>";
          // }else{
          //     echo "Error".mysqli-error(conn);
          // }

        //   if ($conn->query($sql) === TRUE) {
        //   echo "value added to database";
        // } else {
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }
              // }          
         ?>

         <?php
            $mysqli = new mysqli("localhost", "root", "", "dbase2"); 
              
            if($mysqli === false){ 
                die("ERROR: Could not connect. " 
                        . $mysqli->connect_error); 
            } 
            if(isset($_POST['submit'])){
                    
              $fname = $_POST["fname"];  
              $sql = "UPDATE basicinformation SET DOB='6 /April/1995', FatherName='Asok Kumar' where candidate.emailid = '".$_SESSION['sno']."';"; 
              if($mysqli->query($sql) === true){ 
                  echo "Records was updated successfully."; 
              } else{ 
                  echo "ERROR: Could not able to execute $sql. ". $mysqli->error; 
              } 
            }
            $mysqli->close(); 
        ?> 

   <?php
              // $sql = "SELECT * FROM basicinformation WHERE sno='1'";
              //  $sql = "SELECT * FROM candidat WHERE sno='1'";
             $sql = "SELECT basicinformation.DOB, basicinformation.MaritalStatus, basicinformation.Address, basicinformation.Religion , basicinformation.Nationality, basicinformation.LanguageKnown, basicinformation.CurrentDesignation,basicinformation.CurrentLocation, basicinformation.FatherName, basicinformation.NoticePeriod, basicinformation.PreferredLocation, basicinformation.ExpectedSalary, basicinformation.gender,basicinformation.MaritalStatus,  candidate.fname, candidate.lname, candidate.emailid, candidate.mobileno, candidate.mobileno, candidate.years, candidate.months FROM basicinformation INNER JOIN candidate ON basicinformation.sno = candidate.sno where candidate.emailid = '".$_SESSION['email']."';";
              $result = $conn->query($sql);
              // $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
              // echo " <table class='table table-bordered' ><tr><th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
              while($row = $result->fetch_assoc()) {
                  echo "<div class='row' >
                          <div class='col-md-12' >
                              <div class='col-md-4' style='margin-top:20px; margin-bottom: 20px'>
                              <table >
                              <tr>
                                <td><strong>First Name:</strong></td><td> " . $row["fname"]. " ". $row["lname"]."</td></tr>
                                <td><strong>Father Name:</strong></td><td> " . $row["FatherName"]."</td></tr>
                                <td><strong>DOB:</strong></td><td>". $row["DOB"]."</td></tr>
                                <td><strong>Gender:</strong></td><td>" . $row["mobileno"]."</td></tr>
                                <td><strong>Matrial:</strong></td><td>" . $row["MaritalStatus"]."</td></tr>
                                <td><strong>Mobile No:</strong></td><td> " . $row["mobileno"]."</td></tr>
                                <td><strong>Email:</strong> </td><td>" . $row["emailid"]."</td></tr>
                                <td><strong>Address:</strong></td><td>" . $row["Address"]."</td></tr>
                                <td><strong>Religion:</strong></td><td>" . $row["Religion"]."</td>
                              </tr>
                                </table>
                              </div>
                              <div class='col-md-4' style='margin-left: 100px; margin-top:20px; margin-bottom: 20px'>
                              <table>
                              <tr>
                                <td><strong>Nationality:</strong></td><td>" . $row["Nationality"]."<td></tr>
                                <td><strong>Language Known:</strong></td><td>" . $row["LanguageKnown"]."</td></tr>
                                <td><strong>Current Designation:</strong></td><td>" . $row["CurrentDesignation"]."</td></tr>
                                <td><strong>Current Location:</strong></td><td>" . $row["CurrentLocation"]."</td></tr>
                                <td><strong>Preferred Location:</strong></td><td>" . $row["PreferredLocation"]."</td></tr>
                                <td><strong>Total Experience:</strong></td><td> " . $row["years"]. ".". $row["months"]." Years</tr>
                                <td><strong>Notice Period:</strong</td><td>" . $row["NoticePeriod"]." Month</td></tr>
                                <td><strong>Expected Salary:</strong></td><td>" . $row["ExpectedSalary"]."</td></tr>
                                </table>
                            </div>
                            <div class='col-md-2' style='margin-top:20px; margin-left: 90px; margin-bottom: 20px' >
                              
                        </div>" ;

              }
          } else {
              echo "</table>";
          }
          $conn->close();
          ?>
   
        <!-- <form method="post" action="">
          <input type="text" name="fname">
          <input type="submit" name="submit" value="submit">
        </form> -->
        <!-- <div class="container" onclick='seeMoreData(this.parentNode);''> -->
        <div class="container" >
          <!-- Trigger the modal with a button -->
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"  >Edit</button>

          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content" style="width: 150%; margin-left: -120px;">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Basic Information</h4>
                </div>
                <div class="modal-body">
                 <form method="post" action="">
                     <table id="basic" style=" border-collapse:separate; border-spacing:20px;">
                      <tr style="padding-top:20px; ">
                         <th><lable>Father Name:</lable></th>
                        <td><input type="text" name="fname" style="width:100%;"></td>
                        <th><lable>DOB:</lable></th>
                        <td><input type="text" name="dob" style="width:100%;"></td>
                      </tr>

                      <tr style="padding-top:20px; ">
                         <th><lable>Gender:</lable></th>
                        <td><input type="text" name="gender" style="width:100%;"></td>
                        <th><lable>Matrical Status:</lable></th>
                        <td><input type="text" name="matrical" style="width:100%;"></td>
                      </tr>

                      <tr style="padding-top:20px; ">
                         <th><lable>Current Designation:</lable></th>
                        <td><input type="text" name="designation" style="width:100%;"></td>
                        <th><lable>Current Location :</lable></th>
                        <td><input type="text" name="clocation" style="width:100%;"></td>
                      </tr>

                       <tr style="padding-top:20px; ">
                         <th><lable>Current Address:</lable></th>
                        <td><input type="text" name="address" style="width:100%;"></td>
                        <th><lable>Current Location :</lable></th>
                        <td><input type="text" name="clocation" style="width:100%;"></td>
                      </tr>
                        
                      <tr style="padding-top:20px; ">
                        <th><lable>Religion:</lable></th>
                        <td><input type="text" name="religion" style="width:100%;"></td>
                        <th><lable>Nationality:</lable></th>
                        <td><input type="text" name="nationality" style="width:100%;"></td>
                      </tr>

                      <tr style="padding-top:20px; ">
                        <th><lable>Language:</lable></th>
                        <td><input type="text" name="language" style="width:100%;"></td>
                        <th><lable>PreferredLocation:</lable></th>
                        <td><input type="text" name="plocation" style="width:100%;"></td>
                      </tr>

                      <tr style="padding-top:20px; ">
                        <th><lable>NoticePeriod:</lable></th>
                        <td><input type="text" name="notice" style="width:100%;"></td>
                        <th><lable>ExpectedSalary:</lable></th>
                        <td><input type="text" name="Salary" style="width:100%;"></td>
                      </tr>
                        <td style="padding-left:170px; ">
                        <input type="submit" name="submit" value="Update" class="btn btn-info text-right" >
                        </td>
                      </tr>
                    </table>
                  </form>
                </div>
                  
              </div>
              
            </div>
          </div>
        </div>  
        </div>
        </div>

</body>
</html>