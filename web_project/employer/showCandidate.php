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
<body  style="background-color:#abcdef;">
<?php include("nav.php"); ?>
<div class="container-fluid" >    
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8" style="background-color:#fff;"> 
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

    $sql = "SELECT * FROM `Candidate` where `emailid`='".$iddd."'";

            $result = $conn->query($sql);
              
            if ($result->num_rows) {
              
              while($row = $result->fetch_assoc()) {
                  echo "<div class='row' ><h3 align='center' style='background-color:#000; color:#fff'>Personal Information</h3>
                          <h1 style='text-transform: uppercase;' align='center'>" . $row["fname"]. " ". $row["lname"]."</h1>
                          <div class='col-md-5' style='margin-top:20px; margin-bottom: 20px'>
                            <p><strong>DOB : </strong>" . $row["DOB"]."<p>
                            <p><strong>Gender : </strong>" . $row["Gender"]."<p>
                            <p><strong>Mobile No : </strong>" . $row["mobileno"]."<p>
                            <p><strong>Email Id : </strong>" . $row["emailid"]."<p>
                            <p><strong>Matrial : </strong>" . $row["MaritalStatus"]."<p>
                            <p><strong>Address : </strong>" . $row["Address"]."<p>
                            <p><strong>Religion : </strong>" . $row["Religion"]."<p>
                            
                          </div>
                          <div class='col-md-5' style='margin-top:20px; margin-bottom: 20px'>
                            <p><strong>jobtitle : </strong>" . $row["jobtitle"]."<p>
                            <p><strong>Designation : </strong>" . $row["CurrentDesignation"]."<p>
                            <p><strong>Experince : </strong>" . $row["years"]."." . $row["months"]." Year<p>
                            <p><strong>PreferredLocation : </strong>" . $row["PreferredLocation"]."<p>
                            <p><strong>Expected Salary : </strong>" . $row["ExpectedSalary"]."<p>
                            <p><strong>Nationality : </strong>" . $row["Nationality"]."<p>
                            <p><strong>Language : </strong>" . $row["LanguageKnown"]."<p> 
                          </div>
                          <div class='col-md-2' style='margin-top:20px; margin-bottom: 20px'>
                          <img src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='100' width='100'/>
                          </div>
                        </div> " ;
              }
          } else {
              echo " No Candidate Found";
          }

          ?>
          <?php
         
          $sql = "SELECT * FROM `educational` where  `userid`='".$iddd."'";
            $result = $conn->query($sql);
              
            if ($result->num_rows) {
               echo "<h3 align='center' style='background-color:#000; color:#fff'>Education & Qualification</h3>";
              while($row = $result->fetch_assoc()) {
                      echo "<div class='row' style=' box-shadow: 5px grey;' margin-top:20x;>
                              
                            <div class='col-md-6' style='margin-top:20px; margin-bottom: 20px margin-left:10px; '>
                            <p><strong>Qualification : </strong>" . $row["Qualification"]."<p>
                            <p><strong>Specialization : </strong>" . $row["Specialization"]."<p>
                            <p><strong>Location : </strong>" . $row["Location"]."<p>
                            <p><strong>Year  : </strong>" . $row["Year"]."<p> 
                          </div>
                          <div class='col-md-6' style='margin-top:20px; margin-bottom: 20px'>
                            <p><strong>Course : </strong>" . $row["Course"]."<p>
                            <p><strong>BoardUniversity : </strong>" . $row["BoardUniversity"]."<p>
                            
                            <p><strong>Marks: </strong>" . $row["marks"]."<p>
                            
                          </div>
                        </div> " ;
              }
          } else {
              echo " ";
          }
          ?>
          <?php
          
           $sql = "SELECT * FROM `EmploymentHistory` where `userid`='".$iddd."'";
            $result = $conn->query($sql);
              
            if ($result->num_rows) {
              echo "<h3 align='center' style='background-color:#000; color:#fff'>Emloyment Experience</h3>";
              while($row = $result->fetch_assoc()) {
                      echo "<div class='row' >
                              
                            <div class='col-md-6' style='margin-top:20px; margin-bottom: 20px'>
                            <p><strong>Company: </strong>" . $row["CompanyName"]."<p>
                            <p><strong>Function : </strong>" . $row["Function"]."<p>
                            <p><strong>CTC : </strong>" . $row["CTC"]."<p>
                             
                          </div>
                          <div class='col-md-6' style='margin-top:20px; margin-bottom: 20px'>
                          <p><strong>Industry : </strong>" . $row["Industry"]."<p>
                          <p><strong>Reason : </strong>" . $row["Reason"]."<p>
                          <p><strong>Employement Period: </strong>" . $row["EmployementPeriod"]."<p>
                           </div> 
                           <div class='col-md-12'>
                            <p><strong>Role: </strong>" . $row["role"]."<p>
                            </div>
                          </div> " ;
              }
          } else {
              echo "";
          }
          $conn->close();
          ?>
    </div>
      <div class="col-md-2 sidenav"></div>
    </div>
  </div>
</div>

</body>
</html>