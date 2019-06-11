<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: ../login/index.php");  
  exit();
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];

    $active = $_SESSION['active'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Advance Search</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  	label{
  		margin: 10px;
  	}
    body{
      background-color: #ffff99;
    }
  </style>
  <script>
  function seeMoreData(element){
    var candidateId=element.childNodes[1].innerHTML;
    //alert(candidateId);
    if(location.hostname=='localhost')
      {
        window.open("/web_project/employer/post.php?id="+jobid.toString());
      }
      else if(location.hostname=='cogentsol.in')
      {
        window.open("post.php?id="+candidateId.toString());
      }
    }
  </script>
</head>
<body>

<?php 
     
     // Display message about account verification link only once
     if ( isset($_SESSION['message']) )
     {
         echo $_SESSION['message'];
         
         // Don't annoy the user with more messages upon page refresh
         unset( $_SESSION['message'] );
     }
     
     ?>
    
     <?php
     
     // Keep reminding the user this account is not active, until they activate
     if ( !$active ){
         header("location: ../login/index.php");
   exit();
     }
     ?>
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
     <?php include("nav.php"); ?>
  
    <div class="container">
        <div class="row">
        	<div class="col-md-12 centered ">
            	<h3 align= "center" style="margin-top:150px; font-size:30px; font-weight: bold; color:#ff471a; ">ADVANCE SEARCH</h3>
            </div>
        </div>
    </div>

    <!-- <div class="container">
      <form action='searchpage.php' method='POST' style='margin-top: 13px;''>
        <div class="col-md-6">
                      
                      <input type="text" name="Keyword" class="form-control">
                      <input type="text" name="Keyword" class="form-control">
                      <input type="text" name="Keyword" class="form-control">
        
        <input type='submit' name='submit' value='Search'>
      </form>
    </div> -->
    <div class="container">
         <div class="row">
            <div class="col-md-12 ">
                <h3 align="center" style="color: white; background-color: black; "></h3>
                <div class="row register-form">
                  <form action"searchpage.php" method="post" class="">
                    <div class="col-md-6">
                      <label>Keyword</label>
                      <input type="text" name="Keyword" class="form-control">
                      <label>Experience</label><br>
                      <div class="col-md-6" style="margin-bottom: 20px;">
                        <input type="number" name="Expmin" class="form-control" >
                      </div>
                      <div class="col-md-6" style="margin-bottom: 20px;">
                        <input type="number" name="Expmax" class="form-control">
                      </div>
                      <label>Location</label>
                      
                      <?php
                                      $sql="select * from state";
                                      $result = $conn->query($sql);
                                    ?>
                                      
                                    <input list="state" name="state" class="form-control" placeholder="State *"/>
                                      <datalist id="state" name="state">
                                        <option value="" style="width:100%">Select State</option>
                                          <?php
                                            if ($result->num_rows > 0) {
                                              while($row = $result->fetch_assoc()) {
                                                echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                              }
                                            }
                                          ?>
                                    </datalist>
                      <label>Industry</label>
                      <?php
                                      $sql="select * from industry";
                                      $result = $conn->query($sql);
                                    ?>
                                      
                                    <input list="industry" name="industry" class="form-control" placeholder="Industry *"/>
                                      <datalist id="industry" name="industry">
                                        <option value="" style="width:100%">Select Industry</option>
                                          <?php
                                            if ($result->num_rows > 0) {
                                              while($row = $result->fetch_assoc()) {
                                                echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                              }
                                            }
                                          ?>
                                    </datalist>
                      <label>Function</label>
                      <input type="text" name="Function" class="form-control">
                      <label>Designation</label>
                      <input type="text" name="Designation" class="form-control">
                    </div>
                    <div class="col-md-6">
                    <label>Salary</label><br>
                      <div class="col-md-6" style="margin-bottom: 20px;">
                        <input type="number" name="salmin" class="form-control" >
                      </div>
                      <div class="col-md-6" style="margin-bottom: 20px;">
                        <input type="number" name="salmax" class="form-control">
                      </div>
                      <label>Education</label>
                      <?php
                                      $sql="select * from cource";
                                      $result = $conn->query($sql);
                                    ?>
                                      
                                    <input list="cource" name="course" class="form-control" placeholder="Course *"/>
                                      <datalist id="cource" name="cource">
                                        <option value="" style="width:100%">Select Course</option>
                                          <?php
                                            if ($result->num_rows > 0) {
                                              while($row = $result->fetch_assoc()) {
                                                echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                              }
                                            }
                                          ?>
                                    </datalist>
                      
                      <label>Gender</label>
                      <input type="radio" name="gender" class="radio-inline"><label>Male</label> 
                      <input type="radio" name="gender" class="radio-inline"><label>Female</label><br>  
                      <label>Notice period</label>
                      <input type="text" name="Notice" class="form-control">
                      <label>Expected Salary</label>
                      <input type="number" name="expsal" class="form-control">
                      <label>Last updated</label>
                      <input type="text" name="Lastupdate" class="form-control">

                      <input type="submit" name="Search" class="btn btn-info" align="right" value="Search Candidate" style="margin:10px;">
                    </div>
                  </form>
              </div>
              </div>
              </div>
              </div>
    
              <footer style="background-color:black; height: 100px; margin-top: 20px;" ></footer>
                       
</body>
</html>