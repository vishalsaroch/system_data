<?php
if($_SERVER['SERVER_NAME']=='localhost'){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbase2";
      }
      else if($_SERVER['SERVER_NAME']=='cogentsol.in'){
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
  <title>History</title>
  	
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  	input{
  		width: 90%;
  		margin-top:20px;
  		
  		padding: 10px;
  	}

  	form{
  		align-content: center;
  	}

  	.modal-header{
  		color: white;
  		background-color:black;
  	}
  	th{
  		background-color: black;
  		color:white;
  	}
   
  </style>
</head>
<body>

<div class="container">
<div class="row"><h3 align ='center' style='background-color: #d1e2ff;'>Employment History</h3>
	<?php

  	    
	    if(isset($_POST['update'])){
	       $compname = $_POST['compname'];
	       $industry=$_POST['industry'];
	       $Function=$_POST['Function'];
	       $Position=$_POST['Position'];
	       $CTC=$_POST['CTC'];
	       $EmployementPeriod=$_POST['EmployementPeriod'];
	
	       $Location=$_POST['Location'];
	       $reason= $_POST["reason"];
	       $role=$_POST['role'];
         $dateNow = date("Y/m/d");
         $userid = 
         
	      $sql = "INSERT INTO `employmenthistory` (`CompanyName`, `Industry`, `Function`, `Position`, `CTC`, `EmployementPeriod`, `Location`, `Reason`, `role`,`date`, userid) VALUES ('$compname', '$industry', '$Function', '$Position', '$CTC',  '$EmployementPeriod','$Location', '$reason', '$role', '$dateNow', );";
        

	      $run = mysqli_query($conn, $sql);
	      if ($conn->query($sql) === TRUE) {
	        echo "<div class='alert alert-success'>value added to database</div>";
	        } else {
	        echo "<div class='alert alert-danger'>Error: " . $sql . "<br><br>" . $conn->error."</div>";
	        }
	      }          
	  ?>
   
  <div class="container" id="show">
  	<table class="table table-hover">
        <tr>
          <th>Company Name 1</th>
          <th>Industry</th>
          <th>Function</th>
          <th>Position</th>
          <th>Monthly CTC/In hand</th>
          <th>Employement Period<table><tr><td style="width: 70px;">From</td><td style="width: 70px;">To</td></tr></th></table>
          <th>Location</th>
          <th>Reason for Leaving</th>
        </tr>
         <?php
      
        // $sql = "SELECT * FROM employmenthistory ";

        // $result = $conn->query($sql);
        
        // if ($result->num_rows > 1) {
        //     // output data of each row
        //     echo "<table class='table table-bordered'>";
        //     while($row = $result->fetch_assoc()) {
        //         echo "<td>" . $row["CompanyName"]. "</td>";
                
        //     }
        //      echo "</tr></table>";
        // }
      // $sql = "SELECT * FROM employmenthistory where candidate.emailid = '".$_SESSION['email']."';";
      $sql = "SELECT employmenthistory.CompanyName, employmenthistory.Industry, employmenthistory.Function, employmenthistory.Position, employmenthistory.CTC, employmenthistory.EmployementPeriod, employmenthistory.Location, employmenthistory.Reason, employmenthistory.role FROM employmenthistory INNER JOIN candidate ON employmenthistory.sno = candidate.sno where candidate.emailid = '".$_SESSION['email']."';";
       // $sql = "SELECT * FROM employmenthistory WHERE sno='1'";
              $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // echo " <table class='table table-bordered' ><tr><th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
              while($row = $result->fetch_assoc()) {
                  echo "<div class='col-lg-12'>
                          <table class='table'>
                            <tr>
                              <td> " . $row["CompanyName"]. "</td>
                              <td> " . $row["Industry"]. "</td>
                              <td> " . $row["Function"]. "</td>
                              <td> " . $row["Position"]. "</td>
                              <td> " . $row["CTC"]. "</td>
                              <td> " . $row["EmployementPeriod"]. "</td>
                              <td> " . $row["Location"]. "</td>
                              <td> " . $row["Reason"]. "</td>
                            </tr>
                            <tr><th align='center'>Roles and Responsibilities</th></tr>
                            <tr>
                              <td> " . $row["role"]. "</td>
                            </tr> 
                          </table>
                        </div>";
                  }
          } 
          $conn->close();
          ?>
</table>
</div>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal9">Add</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal9" role="dialog">
    <div class="modal-dialog" align="center">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Employment History</h4>
        </div>
        <div class="modal-body">
          <form action="" method="post">
          	<input type="text" name="compname" placeholder="Company Name"><br>
          	<input type="text" name="industry" placeholder="Industry"><br>
          	<input type="text" name="Function" placeholder="Function"><br>
          	<input type="text" name="Position" placeholder="Position"><br>
          	<input type="text" name="CTC" placeholder="Monthly CTC/In hand"><br>
          	<input type="text" name="EmployementPeriod" placeholder="Employer Period"><br>
          	<input type="text" name="Location" placeholder="Location"><br>
            <input type="text" name="reason" placeholder="Reason for Leaving" style="margin-bottom: 10px;"><br>
          	<label >Role & Responsibilities</label>
          	<textarea name="role" rows="5" style="width: 90%;"></textarea>
          	<input type="submit" name="update" value="update" class="btn btn-info">
          </form>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
  </div>
  </div>
</div>

</body>
</html>
