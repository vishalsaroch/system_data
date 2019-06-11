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
    // $contactNo = $_SESSION['contactNo'];


    $active = $_SESSION['active'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create job</title>
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
     <?php include("nav.php"); ?>
  
    <div class="container">
        <div class="row">
        	<div class="col-md-12 centered ">
            	<h3 align= "center">Post a new <font size="10" color="orange">JOB</font></h3>
            </div>
        </div>
    </div>
    <div class="container">
         <div class="row">
            <div class="col-md-4 register-left">
                <img src="images/jobicon.png" height="400px" width="350px" style=" position: static;" />
                   <!--  <h3>Welcome</h3>
                        <p>I am Frisher</p> -->
                </div>
                <div class="col-md-8 ">
                	<h3 align="center" style="color: white; background-color: black">Job Detail</h3>
                    <div class="row register-form">
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
                                   $jobTitle = $_POST['jobTitle'];
                                   $jobType = $_POST['jobType'];
                                   $city = $_POST['city'];
                                   // $location = $_POST['location'];
                                   $industry = $_POST['industry'];
                                   $Function = $_POST['function'];
                                   $role = $_POST['role'];
                                   $qualifation = $_POST['qualifation'];
                                   $nationality = $_POST['nationality'];
                                   $year = $_POST['year'];
                                   $month = $_POST['month'];
                                   $description = $_POST['description'];
                                   $emailid = $_POST['email'];
                                   $mobileno = $_POST['mobileno'];
                                   $dateNow = date("Y/m/d");
                                   $compName = $_POST['compName'];
                                   
                                   // $userid = $_POST['userid'];

                             
                                 $query = "INSERT INTO `job` (`jobTitle`, `jobType`, `city`,  `Industry`, `Function/Dept` , `role`, `Qualification`, `Nationality`, `year`, `month`, `description`, `email`, `mobileno`, `date`, `userid`, `compName`) VALUES ('".$jobTitle."', '".$jobType."', '".$city."',  '".$industry."', '".$Function."', '".$role."', '".$qualifation."', '".$nationality."', '".$year."', '".$month."', '".$description."', '".$emailid."', '".$mobileno."', '".$dateNow."', '".$email."', '".$compName."')";
                                    $run = mysqli_query($conn, $query);
                                    if($run){
                                       echo "New job added sucessfully";
                                    }else{
                                        echo "Error: " . $query. "<br>" . $conn->error;
                                    }
                                }
                            ?>
                        <form  method="post" action="" id="job">
                            <div class="form-froup">
                                
                                    
                                    <input type="hidden" name="compName" value="<?php echo $_SESSION['first_name'];?>"/>
                                
                                <div class="col-md-6" style="margin-top: 10px;">
                                    <label>Designation</label>
                                    <input type="text" name="jobTitle" class="form-control" placeholder="Job Title*"  required />
                                </div>

                                <div class="col-md-6" style="margin-top: 10px;">
                                    <label>Job details</label>
                                    <input type="text" name="jobType" class="form-control" placeholder=" Job Type: Full-Time, Part-Time, Work form abroad *"  required/>
                                </div>

                                 <div class="col-md-6" style="margin-top: 10px;">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" placeholder="City *"  required/>
                                </div>

                              <div class="col-md-6" style="margin-top: 10px;">
                                    <label>Location</label>
                                    <!-- <input type="text" name="location" class="form-control" placeholder="Location *"  required/> -->
                                    <?php
                                      $sql="select * from location";
                                      $result = $conn->query($sql);
                                    ?>
                                      
                                    <input list="location" name="location" placeholder="location" class="form-control" placeholder="Location *"  required/>
                                      <datalist id="location" name="location">
                                        <option value="" style="width:100%">Select Location</option>
                                          <?php
                                            if ($result->num_rows > 0) {
                                              while($row = $result->fetch_assoc()) {
                                                echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                              }
                                            }
                                          ?>
                                    </datalist>
                                </div>

                                <div class="col-md-6" style="margin-top: 10px;">
                                    <label>Industry</label>
                                    <!-- <input type="text" name="industry" class="form-control" placeholder="Industry *"  required/> -->
                                    <?php
                                      $sql="select * from industry";
                                      $result = $conn->query($sql);
                                    ?>
                                      
                                    <input list="industry" name=" industry"  class="form-control" placeholder="Industry *"  required/>
                                      <datalist id="industry" name="industry" >
                                        <option value="" style="width:100%">Select Location</option>
                                          <?php
                                            if ($result->num_rows > 0) {
                                              while($row = $result->fetch_assoc()) {
                                                echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                              }
                                            }
                                          ?>
                                      </datalist>
                                </div>
                                <?php
                                      $sql="select * from department";
                                      $result = $conn->query($sql);
                                    ?>
                                <div class="col-md-6" style="margin-top: 10px;">
                                    <label>Function& Department </label>
                                   <!--  <input type="text" name="function" class="form-control" placeholder="Function& Department *"  required/> -->
                                   <input list="function" name=" function"  class="form-control" placeholder="Function& Department*"  required/>
                                      <datalist id="function" name="function" >
                                        <option value="" style="width:100%">Select Location</option>
                                          <?php
                                            if ($result->num_rows > 0) {
                                              while($row = $result->fetch_assoc()) {
                                                echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                              }
                                            }
                                          ?>
                                      </datalist>
                                </div>
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <label>Role & responsibility</label>
                                    <textarea  class="form-control" name ="role" placeholder="Role & responsibility *" textarea rows="4" cols="50"></textarea>
                                  </div>

                                <div class="col-md-6" style="margin-top: 10px;">
                                    <label>Qualifation</label>
                                   <!--  <input type="text" name="qualifation" class="form-control" placeholder="Qualifation *"  required/> -->
                                    <?php
                                      $sql="select * from qualifaction";
                                      $result = $conn->query($sql);
                                    ?>
                                      
                                    <input list="qualifation" name=" qualifation"  class="form-control" placeholder="Qualifaction *"  required/>
                                      <datalist id="qualifation" name="qualifation" >
                                        <option value="" style="width:100%">Select Location</option>
                                          <?php
                                            if ($result->num_rows > 0) {
                                              while($row = $result->fetch_assoc()) {
                                                echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                              }
                                            }
                                          ?>
                                      </datalist>
                                </div>

                                <div class="col-md-6" style="margin-top: 10px;">
                                    <label>Nationality</label>
                                    <input type="text" name="nationality" class="form-control" placeholder="Nationality *"  required/>
                                </div>
                            
                                <div class="col-md-6" style="margin-top: 10px;" >
                                	<label style="top-margin:20px;">Experince</label>
                                  <input type="text" name="year" class="form-control" placeholder="Experince *"  required/>
                                </div>
                                <div class="col-md-6" style="margin-top: 10px;" >
                                    <label style="top-margin:20px;">Salary</label>
                                    <input type="text" name="month" class="form-control" placeholder="Salary *"  required/>
                                </div>
                                	<!-- <div class="col-md-6" style="margin-top: 10px;">
    	                               
    	                                <label>Years</label>
    		                                <select name="year" class="form-control" required>
    		                                  <option value="0">0</option>
                    										  <option value="1">1</option>
                    										  <option value="2">2</option>
                    										  <option value="3">3</option>
                    										  <option value="4">4</option>
                    										  <option value="6">6</option>
                    										  <option value="7">7</option>
                    										  <option value="8">8</option>
                    										  <option value="9">9</option>
                    										  <option value="10">10</option>
                    										  <option value="11">11</option>
                    										  <option value="12">12</option>
                    										</select>
                    									</div>
                               		

                               		<div class="col-md-6" style="margin-top: 10px;">
    	                                
    	                                <label>Months</label>
    		                                <select name="month" class="form-control" required>
    		                                  <option value="0">0</option>
                    										  <option value="1">1</option>
                    										  <option value="2">2</option>
                    										  <option value="3">3</option>
                    										  <option value="4">4</option>
                    										  <option value="6">6</option>
                    										  <option value="7">7</option>
                    										  <option value="8">8</option>
                    										  <option value="9">9</option>
                    										  <option value="10">10</option>
                    										  <option value="11">11</option>
                    										  <option value="12">12</option>
                    										</select>
    									
                               		</div> -->
                                    <div class="col-md-12"style="margin-top: 10px;">
                               
                                    <label>job Discription</label>
                                    <textarea  class="form-control" name ="description" placeholder="Your Phone *" textarea rows="10" cols="50"></textarea>
                                
                                </div>	

                                <div class="col-md-12" style="margin-top: 10px;">
                                	<h3 align="center" style="color: white; background-color: black">HR Detail</h3>	
                                	<div class="col-md-6"style="margin-top: 10px;">
                                	 	<?php

                                    ?>
        	                                <label>Email</label>
        	                                <input type="email" name="email" class="form-control"value="<?php echo $_SESSION['email'];?>"  />

        	                            </div>
                                   
                                    <div class="col-md-6"style="margin-top: 10px;">
                                    	<label>Mobile No</label>
        	                                <input type="number" name="mobileno" class="form-control" placeholder="Mobile No *"  />
        	                        </div>

        	                           
                                         <input type="submit" name="submit" value="Add Job" style="margin-left:670px; margin-top: 20px" class="btn btn-info">

    	                           </div>
                                </div>
                        </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        </span>
                        <footer style="background-color:black; height: 100px; margin-top: 20px;" ></footer>
                       
</body>
</html>