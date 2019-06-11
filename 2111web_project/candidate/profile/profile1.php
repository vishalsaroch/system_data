
<!DOCTYPE html>
<html>
<head>
  <title>Add Qualifaction</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    p{
      background-color: green;
    }
  </style>
</head>
<body>
<div class="container">
<!-- Add Qualifaction -->
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
      if(isset($_POST['submit'])){
        
          $fname = $_POST["fname"];
          $dob=$_POST['dob'];
          $gender=$_POST['male'];
          $matrical=$_POST['matrical'];
          $designation=$_POST['designation'];
          $clocation=$_POST['clocation'];
          $address=$_POST['address'];
          $relign=$_POST['relign'];
          $nationality = $_POST["nationality"];
          // $language=$_POST['language'];
          $plocation=$_POST['plocation'];
          $notice=$_POST['notice'];
          $salary=$_POST['salary'];
          // $query = "INSERT INTO `basicinformation` (FatherName) VALUES ('$fname')", ;
          $sql = "INSERT INTO `basicinformation` (`FatherName`, `DOB`, `Gender`, `MaritalStatus`, `CurrentDesignation`, `CurrentLocation`, `Address`, `Religion`, `Nationality`, `PreferredLocation`, `NoticePeriod`, `ExpectedSalary` ) VALUES ('$fname', '$dob', '$gender', '$matrical', '$designation','$address', '$relign', '$nationality', '$notice', '$salary' )";

          $run = mysqli_query($conn, $sql);
          // if($run){
          //    echo "<p>fathername updated sucessfully</p>";
          // }else{
          //     echo "Error".mysqli-error(conn);
          // }

          if ($conn->query($sql) === TRUE) {
    echo "value added to database";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
      }          
   ?>
   
        <form method="post" action="">
          <input type="text" name="fname">
          <input type="submit" name="submit" value="submit">
        </form>
        <div class="container">
          <h2>Modal Example</h2>
          <!-- Trigger the modal with a button -->
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit</button>

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
                        <td><input type="text" name="fname"style="width:100%;"></td>
                        <th><lable>D.O.B</lable></th>
                        <td><input type="date" name="dob"  style="width:100%;"></td>
                      </tr>

                       <tr style="padding-top:20px; ">
                        <th><lable>Gender</lable></th>
                         <td> <input type="radio" name="male" value="male" checked> Male
                         <input type="radio" name="female" value="female"> Female</td>
                        <th><lable>Matrical</lable></th>
                         <td> <input type="radio" name="matrical" value="Married" checked> Married
                         <input type="radio" name="matrical" value="female"> Unmarried</td>
                      </tr>

                       <tr style="padding-top:20px; ">
                        
                        <!-- <th><lable>Language Known</lable></th>
                        <td width="100%"><input type="checkbox" name="language" value="Hindi"> Hindi
                        <input type="checkbox" name="language" value="English"> English 
                        <input type="checkbox" name="language" value="Punjabi"> Punjabi
                        <input type="checkbox" name="language" value="Other"> Other </td> -->

                        <th><lable>Nationality:</lable></th>
                        <td><input type="text" name="designation"style="width:100%;"></td>
                      </tr> 

                     

                       <tr style="padding-top:20px; ">
                         <th><lable>Nationality:</lable></th>
                        <td><input type="text" name="nationality"style="width:100%;"></td>
                        <th><lable>Religion</lable></th>
                        <td><input type="text" name="relign"  style="width:100%;"></td>
                      </tr>

                      <tr>
                        <th><lable>Address:</lable></th>
                        <td><input type="text" name="address"style="width:100%;"></td>
                        <th><lable>Current Address:</lable></th>
                        <td><input type="text" name="clocation"style="width:100%;"></td>
                      </tr>

                      <tr style="padding-top:20px; ">
                        <th><lable>Preferred Location:</lable></th>
                        <td><input type="text" name="plocation" style="width:100%;"></td>
                         <th><lable>Mobile</lable></th>
                        <td><input type="number" name="Mobile"style="width:100%;"></td> 
                      </tr>

                     

                      <tr style="padding-top:10px; ">
                        <th><lable>Notice Period:</lable></th>
                        <td><input type="text" name="notice"style="width:100%;"></td>
                        <th><lable>Expected Salary:</lable></th>
                        <td><input type="number" name="salary"  style="width:100%;"></td>
                      </tr>

                       <tr style="padding-top:10px; ">
                         <th><lable>Total Experience:</lable></th>
                        <td><input type="text" name="fname" style="width:100%;"></td>
                        <td></td> 
                        <td style="padding-left:170px; ">
                        <input type="submit" name="submit" value="Update" class="btn btn-info" >
                        </td>
                      </tr>
                      
                    </table>
                  </form>
                </div>
                  
              </div>
              
            </div>
          </div>
          
        </div>  
<!-- Add cources -->
</body>
</html>