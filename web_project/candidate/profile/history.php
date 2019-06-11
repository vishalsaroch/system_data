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
  <script type="text/javascript">

    function myfunction123(element){
    // alert(element.innerHTML);
    document.getElementById("popupcompname").value=element.childNodes[1].innerHTML;
    document.getElementById("popupindustry").value=element.childNodes[3].innerHTML;
    document.getElementById("popupFunction").value=element.childNodes[5].innerHTML;
    document.getElementById("popupPosition").value=element.childNodes[7].innerHTML;
    document.getElementById("popupCTC").value=element.childNodes[9].innerHTML;
    document.getElementById("popupEmployementPeriod").value=element.childNodes[11].innerHTML;
    document.getElementById("popupLocation").value=element.childNodes[13].innerHTML;
    document.getElementById("popupreason").value=element.childNodes[15].innerHTML;
    document.getElementById("popuprole").value=element.childNodes[17].innerHTML;
  }
  </script>
  <style type="text/css">
    input{
      margin:10px;
    }
  </style>
</head>
<body>

<div class="container">
<div class="row"><h3 align ='center' style='background-color: #d1e2ff;'>Employment History</h3>
	<?php
    if(isset($_POST['add'])){
       $compname = $_POST['compname'];
       $industry=$_POST['industry'];
       $Function=$_POST['Function'];
       $Position=$_POST['Position'];
       $CTC=$_POST['CTC'];
       $EmployementPeriod=$_POST['EmployementPeriod'];
       $Location=$_POST['location'];
       $reason= $_POST["reason"];
       $role=$_POST['role'];
       $userid=$_POST['userid'];
       $date=date("Y/m/d");
       
       $sql = "INSERT INTO `employmenthistory` (`CompanyName`, `Industry`, `Function`, `Position`, `CTC`, `EmployementPeriod`, `Location`, `Reason`, `role`, `userid`, `date`) VALUES ('$compname', '$industry', '$Function', '$Position', '$CTC',  '$EmployementPeriod' ,'$Location', '$reason', '$role', '$userid', '$date')";
        

	      $run = mysqli_query($conn, $sql);
	      if ($run) {
	        echo "<div class='alert alert-success'>value added to database</div>";
	        } else {
	        echo "<div class='alert alert-danger'>Error: " . $sql . "<br><br>" . $conn->error."</div>";
	        }
	      }          
	  ?>

    <?php
    if(isset($_POST['update'])){
       $compname=$_POST['compname'];
       $industry=$_POST['industry'];
       $Function=$_POST['Function'];
       $Position=$_POST['Position'];
       $CTC=$_POST['CTC'];
       $EmployementPeriod=$_POST['EmployementPeriod'];
       $Location=$_POST['location'];
       $reason= $_POST["reason"];
       $role=$_POST['role'];
       $userid=$_POST['userid'];
       $date=date("Y/m/d");
       
       $sql = "UPDATE `employmenthistory` SET `CompanyName`='".$compname."',`Industry`='".$industry."',`Function`='".$Function."',`Position`='".$Position."',`CTC`='".$CTC."',`EmployementPeriod`='".$EmployementPeriod."',`Location`='".$Location."',`Reason`='".$reason."',`role`='".$date."',`userid`='".$userid."',`date`='".$date."' WHERE `userid`='".$_SESSION['email']."' and `CompanyName`='".$compname."';";
            //$sql = "INSERT INTO `educational` (`Qualification`, `Course`, `Specialization`, `BoardUniversity`, `Year`, `Location`, `marks`, `userid`, `date`) VALUES ('$qualifaction', '$cource', '$specialization','$board', '$year', ',$Location', '$marks', '$userid', '$date')";
            $run = mysqli_query($conn, $sql);
            if ($run) {
              echo "<p>Qualifaction Updated Successfully</p>";
              } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
            }    
               
    ?>   
  <div class="container" id="show">
  	
         <?php
      
        
      // $sql = "SELECT * FROM employmenthistory where candidate.emailid = '".$_SESSION['email']."';";
         // $sql = "SELECT educational.sno, educational.Qualification, educational.Course, educational.BoardUniversity, educational.Specialization, educational.Year, educational.Location, educational.marks FROM educational INNER JOIN candidate ON educational.sno = candidate.sno where candidate.emailid = '".$_SESSION['email']."';";
       $sql = "SELECT employmenthistory.CompanyName, employmenthistory.Industry, employmenthistory.Function, employmenthistory.Position, employmenthistory.CTC, employmenthistory.EmployementPeriod, employmenthistory.Location, employmenthistory.Reason, employmenthistory.role FROM employmenthistory INNER JOIN candidate ON employmenthistory.userid = candidate.userid where candidate.emailid = '".$_SESSION['email']."';";
         // $sql = "SELECT * FROM employmenthistory WHERE sno='1'";
              $result = $conn->query($sql);
            if ($result->num_rows > 0) {
               echo " <table class='table table-hover'>
                          <tr>
                            <th>Company Name</th>
                            <th>Industry</th>
                            <th>Function</th>
                            <th>Position</th>
                            <th>Monthly CTC/In hand</th>
                            <th>Employement Period<table><tr><td style='width: 70px;'>From</td><td style='width: 70px;''>To</td></tr></th></table>
                            <th>Location</th>
                            <th>Reason for Leaving</th>
                             <th>Role</th>
                             <th></th>
                             <th></th>
                          </tr>";
              while($row = $result->fetch_assoc()) {
                  echo "<tr>
                              <td> " . $row["CompanyName"]. "</td>
                              <td> " . $row["Industry"]. "</td>
                              <td> " . $row["Function"]. "</td>
                              <td> " . $row["Position"]. "</td>
                              <td> " . $row["CTC"]. "</td>
                              <td> " . $row["EmployementPeriod"]. "</td>
                              <td> " . $row["Location"]. "</td>
                              <td> " . $row["Reason"]. "</td>
                              <td> " . $row["role"]. "</td>
                              <td> <button type='button' class='btn btn-info btn-lg'  data-toggle='modal' data-target='#myModal20' onclick='myfunction123(this.parentNode.parentNode)'><span class='glyphicon glyphicon-edit'></span></button></td>
                          <td onclick='deleteData1(this.parentNode);' >
                            <span id='delete' class='glyphicon glyphicon-trash alert alert-danger' aria-hidden='true'></span>
                          </td>
                          </tr>";
                        }
                      }else {
              echo "</table>";
                } 
              ?>
</table>
</div>

<!-- Add Employment History -->
  <!-- Trigger the modal with a button -->
  <div class="row">
  <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal9" style="margin-left:35px; margin-top: 20px;">Add</button>

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
          	<input type="text" id="compname" name="compname" placeholder="Company Name"><br>
          	 <!-- <input type="text" name="industry" placeholder="Industry"><br> -->
            <?php
              $sql="select * from industry";
              $result = $conn->query($sql);
            ?>
            
            <input list="industry" name="industry" placeholder="Industry">
              <datalist id="industry" name="industry">
                <option value="" style="width:100%">Select industry</option>
                  <?php
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                      }
                    }
                  ?>
              </datalist><br>
          	<input type="text" id="Function" name="Function" placeholder="Function"><br>
          	<input type="text" id="Position" name="Position" placeholder="Position"><br>
          	<input type="text" id="CTC" name="CTC" placeholder="Monthly CTC/In hand"><br>
          	<input type="text" id="EmployementPeriod" name="EmployementPeriod" placeholder="Employer Period"><br>
          	<!-- <input type="text" name="Location" placeholder="Location"><br> -->
            <?php
              $sql="select * from location";
              $result = $conn->query($sql);
            ?>
              
            <input list="location" id="popupLocation" name="location" placeholder="location">
              <datalist id="location" name="location">
                <option value="" style="width:100%">Select Location</option>
                  <?php
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                      }
                    }
                  ?>
            </datalist><br>
            <input type="text" id="reason" name="reason" placeholder="Reason for Leaving" "><br>
             <input type="hidden" name="userid" value="<?php echo "$email"?>">
          	<label >Role & Responsibilities</label>
          	<textarea name="role" id="role" rows="5" style="width: 90%;"></textarea>
          	<input type="submit" name="add" value="add" class="btn btn-info">
          </form>
        </div>
        
      </div>
      
    </div>
    </div>
      <!-- edit  model -->
    <div class="row">
    <!-- Modal -->
      <div class="modal fade" id="myModal20" role="dialog">
          <div class="modal-dialog" align="center">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Employment History</h4>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <input type="text" id="popupcompname" name="compname" placeholder="Company Name"><br>
             <!-- <input type="text" name="industry" placeholder="Industry"><br> -->
            <?php
              $sql="select * from industry";
              $result = $conn->query($sql);
            ?>
            
            <input list="popupindustry" name="industry" placeholder="Industry">
              <datalist id="industry" name="industry">
                <option value="" style="width:100%">Select industry</option>
                  <?php
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                      }
                    }
                  ?>
              </datalist><br>
            <input type="text" id="popupFunction" name="Function" placeholder="Function"><br>
            <input type="text" id="popupPosition" name="Position" placeholder="Position"><br>
            <input type="text" id="popupCTC" name="CTC" placeholder="Monthly CTC/In hand"><br>
            <input type="text" id="popupEmployementPeriod" name="EmployementPeriod" placeholder="Employer Period"><br>
            <!-- <input type="text" name="Location" placeholder="Location"><br> -->
            <?php
              $sql="select * from location";
              $result = $conn->query($sql);
            ?>
              
            <input list="location" id="popupLocation" name="location" placeholder="location">
              <datalist id="location" name="location">
                <option value="" style="width:100%">Select Location</option>
                  <?php
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                      }
                    }
                  $conn->close();  
                  ?>
            </datalist><br>
            <input type="text" id="popupreason" name="reason" placeholder="Reason for Leaving" "><br>
             <input type="hidden" name="userid" value="<?php echo "$email"?>">
            <label >Role & Responsibilities</label>
            <textarea name="role" id="popuprole" rows="5" style="width: 90%;"></textarea>
            <input type="submit" name="update" value="UPDATE" class="btn btn-info">
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
