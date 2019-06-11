<!DOCTYPE html>
<html>
<head>
	<title>File upload using ajax in PHP</title>

	<script>
$(function() {
    $("#theForm").submit(function(e){
      e.preventDefault();    
      var formData = new FormData(this);
            
            
      var urlkey;
      if(location.hostname=='localhost')
      {
        urlkey = "/web_project/candidate/upload.php";
      }
      else if(location.hostname=='www.arkglobalholidays.co.in')
      {
        urlkey = "upload.php";
      }
      $.ajax({
        
        url: urlkey,
        method: "POST",
        data: formData,
        success: function(result){alert(result);},
        failure: function(err){alert(err);},
        cache: false,
        contentType: false,
        processData: false
        
      });
      
        
      
      return(false);
    });
  });
      
</script>

</head>
<body>
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


               // $sql = "SELECT * FROM candidate WHERE sno='1'";
              // $sql = "SELECT basicinformation.DOB, candidate.mobileno FROM basicinformation INNER JOIN candidate ON basicinformation.sno = candidate.sno;";
             $sql = "SELECT basicinformation.DOB, basicinformation.MaritalStatus, basicinformation.Address, basicinformation.Religion , basicinformation.Nationality, basicinformation.LanguageKnown, basicinformation.CurrentDesignation,basicinformation.CurrentLocation, basicinformation.FatherName, basicinformation.NoticePeriod, basicinformation.PreferredLocation, basicinformation.ExpectedSalary, basicinformation.gender,basicinformation.MaritalStatus,  candidate.fname, candidate.lname, candidate.emailid, candidate.mobileno, candidate.mobileno, candidate.years, candidate.months FROM basicinformation INNER JOIN candidate ON basicinformation.sno = candidate.sno;";
              $result = $conn->query($sql);
              // $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
              // echo " <table class='table table-bordered' ><tr><th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
              while($row = $result->fetch_assoc()) {
                  echo "<div class='row' >
                            
                            <h3 align ='center' style='background-color: #d1e2ff;'>Personal Information</h3>
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
                              
                            <a href='#' class='btn btn-info' style='margin-top: 20px; width: 70%' id='personal'> EDIT Profile</a>
                        </div>" ;

              }
          } else {
              echo "</table>";
          }
          $conn->close();
          ?>

	<form id="theForm" action="upload.php" method="post" enctype="multipart/form-data">
                                            <br>Select image to upload:<br>
                      <!--<input type="text" name="filename" id="filename12">-->
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                            <!--<button onclick="myFunction()">Try it</button>-->
                      <input type="submit" value="Upload Image" name="submit" class="au-btn au-btn-icon au-btn--green">
                                        </form>
</body>
</html>