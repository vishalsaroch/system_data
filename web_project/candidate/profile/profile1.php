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
  <style type="text/css">
    .close{
      color: white;
    }
    .modal-header{
      background-color: gray;
    }

  </style>
</head>
<body>
<?php 
     
     //Display message about account verification link only once
     // if ( isset($_SESSION['message']) )
     // {
     //     echo $_SESSION['message'];
         
         //Don't annoy the user with more messages upon page refresh
     //     unset( $_SESSION['message'] );
     // }
     
     ?>
     
     
     <?php
     
     // Keep reminding the user this account is not active, until they activate
   //   if ( !$active ){
   //       header("location:../../login2/index.php");
   // exit();
     // }
     
     ?>
<div class=container>
  <div class="row">
    <h3 align ='center' style='background-color: #d1e2ff;'>Personal Information</h3>
  
  <!-- Add Qualifaction -->
  <?php
    if(isset($_POST['submit'])){
    // if(isset($_POST['submit']==1)){
      echo "add form";
      }
      else{
        echo "edit form";}
          $id = $_POST['id'];
          $email = $_POST["$email"];
          $fname = $_POST["fname"];
          $dob=$_POST['dob'];
          $gender=$_POST['gender'];
          $matrical=$_POST['matrical'];
          $designation=$_POST['designation'];
          $clocation=$_POST['clocation'];
          $address=$_POST['address'];
          $religion=$_POST['religion'];
          $nationality = $_POST["nationality"];
          $language=$_POST['language'];
          $plocation=$_POST['plocation'];
          $notice=$_POST['notice'];
          $salary=$_POST['Salary'];
          
           // $sql = "UPDATE basicinformation SET FatherName = $fname, DOB = $dob WHERE basicinformation.sno = $id";
             // $sql = "INSERT INTO `basicinformation` (`FatherName`, `DOB`, `Gender`, `MaritalStatus`, `CurrentDesignation`, `CurrentLocation`, `Address`, `Religion`, `Nationality`, 'LanguageKnown', 'PreferredLocation'  `NoticePeriod`, `ExpectedSalary` ) VALUES ('$fname', '$dob', '$gender', '$matrical', '$designation', '$clocation', '$address', '$religion', '$nationality', '$language', '$plocation', '$notice', '$salary' )";

          $sql = "INSERT INTO `basicinformation` (`FatherName`, `DOB`, `Gender`, `MaritalStatus`, `CurrentDesignation`, `email`) VALUES ('$fname', '$dob', '$gender','$matrical', '$clocation', '$designation' ,'$email')";
         
          if ($conn->query($sql) === TRUE) {
          echo "Personal information added Successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
       
          // edit
       // $sql = "UPDATE basicinformation ". "SET FatherNamle = $fname ". 
       //         "WHERE emailid = $email" ;
       //      // mysql_select_db('dbase2');
       //      $retval = mysql_query( $sql, $conn );
            
       //      if(! $retval ) {
       //         die('Could not update data: ' . mysql_error());
       //      }
       //      echo "Updated data successfully\n";   
       //      }      
  ?>

         

   <?php
               // $sql = "SELECT * FROM basicinformation WHERE sno='1'";
              // $sql = "SELECT * FROM candidate WHERE candidate.emailid = '".$_SESSION['email']."';";
             $sql = "SELECT basicinformation.DOB, basicinformation.MaritalStatus, basicinformation.Address, basicinformation.Religion , basicinformation.Nationality, basicinformation.LanguageKnown, basicinformation.CurrentDesignation,basicinformation.CurrentLocation, basicinformation.FatherName, basicinformation.NoticePeriod, basicinformation.PreferredLocation, basicinformation.ExpectedSalary, basicinformation.gender,basicinformation.MaritalStatus,  candidate.fname, candidate.lname, candidate.emailid, candidate.mobileno, candidate.mobileno, candidate.years, candidate.months FROM basicinformation INNER JOIN candidate ON basicinformation.emailid = candidate.emailid where candidate.emailid = '".$_SESSION['email']."';";
              $result = $conn->query($sql);
              // $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
              // echo " <table class='table table-bordered' ><tr><th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
              while($row = $result->fetch_assoc()) {
                  echo "<div class='row' >
                          <div class='col-md-12' >
                              <div class='col-md-4' style='margin-top:20px; margin-bottom: 20px'>
                              <table>
                              <tr>
                                <td><strong>First Name:</strong></td><td> " . $row["fname"]. " ". $row["lname"]."</td></tr>
                                <td><strong>Father Name:</strong></td><td> " . $row["FatherName"]."</td></tr>
                                <td><strong>DOB:</strong></td><td>". $row["DOB"]."</td></tr>
                                <td><strong>Gender:</strong></td><td>" . $row["mobileno"]."</td></tr>
                                <td><strong>Matrial:</strong></td><td>" . $row["MaritalStatus"]."</td></tr>
                                <td><strong>Mobile No:</strong></td><td> " . $row["mobileno"]."</td></tr>
                                <td><strong>Email:</strong> </td><td>" . $row["emailid"]."</td></tr>
                                <td><strong>Address:</strong></td><td>" . $row["Address"]."</td></tr>
                                <td><strong>Religion:</strong></td><td>" . $row["Religion"]."</td></tr>
                                <tr><td><button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal8'  >Edit</button></td>
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
          // $conn->close();
          ?>
   
        <!-- <form method="post" action="">
          <input type="text" name="fname">
          <input type="submit" name="submit" value="submit">
        </form> -->
        <!-- <div class="container" onclick='seeMoreData(this.parentNode);''> -->
        <?php
  // $sql = "select * from basicinformation where email = $_SESSION['email']";
  // $result = $conn->query($sql);
  //             // $result = mysqli_query($conn, $sql);
  //           if ($result->num_rows = 0) {
  //             echo "<div class='container'>
  //         <!-- Trigger the modal with a button -->
  //         <button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal8'  >Add</button>";
  //             while($row = $result->fetch_assoc()) {
  //                 echo "" ;

  //             }
  //         } else {
  //             echo "<div class='container'>
  //         <!-- Trigger the modal with a button -->
  //         <button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal8'  >Update</button>";
  //         }
    ?>
        <div class="container">
          <!-- Trigger the modal with a button -->
          <h3>Personal Information</h3>
          

          <!-- Modal -->
          <div class="modal fade" id="myModal8" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content" style="width: 150%; margin-left: -120px;">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" align="center">Basic Information</h4>
                </div>
                <div class="modal-body">
                 <form method="post" action="">
                     <table id="basic" style=" border-collapse:separate; border-spacing:20px;">
                      <tr style="padding-top:20px; ">
                      
                         <td><strong><lable>Father Name:</lable></strong></td>
                        <td><input type="text" name="fname" style="width:100%;"></td>
                        <td><strong><lable>DOB:</lable></strong></td>
                        <td><input type="text" name="dob" style="width:100%;"></td>
                      </tr>

                      <tr style="padding-top:20px; ">
                         <td><strong><lable>Gender:</lable></strong></td>
                        <td><input type="radio" name="gender" value="male" class="radio">Male</td>
                        <td><input type="radio" name="gender" value="female" class="radio">Female</td>
                        <td><strong><lable>Matrical Status:</lable></strong></td>
                        <td><input type="text" name="matrical" style="width:100%;"></td>
                      </tr>

                      <tr style="padding-top:20px; ">
                         <td><strong><lable>Current Designation:</lable></strong></td>
                        <td><input type="text" name="designation" style="width:100%;"></td>
                        <td><strong><lable>Current Location :</lable></strong></td>
                        <td><input type="text" name="clocation" style="width:100%;"></td>
                      </tr>

                       <tr style="padding-top:20px;">
                         <td><strong><lable>Current Address:</lable></strong></td>
                        <td><input type="text" name="address" style="width:100%;"></td>
                        <td><strong><lable>Current Location :</lable></strong></td>
                        <td><input type="text" name="clocation" style="width:100%;"></td>
                      </tr>
                        
                      <tr style="padding-top:20px; ">
                        <td><strong><lable>Religion:</lable></strong></td>
                        <td><input type="text" name="religion" style="width:100%;"></td>
                        <td><strong><lable>Nationality:</lable></strong></td>
                        <td><input type="text" name="nationality" style="width:100%;"></td>
                      </tr>

                      <tr style="padding-top:20px; ">
                        <td><strong><lable>Language:</lable></strong></td>
                        <td><input type="text" name="language" style="width:100%;"></td>
                        <td><strong><lable>PreferredLocation:</lable></strong></td>
                        <td><input type="text" name="plocation" style="width:100%;"></td>
                      </tr>

                      <tr style="padding-top:20px; ">
                        <td><strong><lable>NoticePeriod:</lable></strong></td>
                        <td><input type="text" name="notice" style="width:100%;"></td>
                        <td><strong><lable>ExpectedSalary:</lable></strong></td>
                        <td><input type="text" name="Salary" style="width:100%;"></td>
                      </tr>
                        <td style="padding-left:170px; ">
                        <input type="submit" name="submit" id="update" value="Update" class="btn btn-info text-right" >
                        <script type="text/javascript">
                          
                        </script>
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