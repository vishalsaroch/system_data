co<!DOCTYPE html>
<html>
<head>
	<title>Dashbord</title>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">	
 /* body {
	    background-image: url("back1.jpg");
	    background-repeat: no-repeat;
    }*/
    h1{
    	color: #0099cc
    	/*background-color: black;*/
    	width:300px;
    	opacity: 0.5;
    	margin-left: 300px;
    }
     /*h3{
    	color: white;
    	background-color: black;
    	width:200px;
    	opacity: 0.5;
    	margin-left: 550px;
    }*/
     button{
    	color: white;
    	background-color: orange;
    	width:170px;
    	opacity: 0.5;
    	margin-left: 385px;
    }
    .col-lg-12:hover{
    	background-color: #CFF3FB;
    }
</style>
</head>
<body>
		<nav class="navbar navbar" style="height: 120px; background-color: black; color: white;" >
      <div class="container-fluid">
        <div class="nav-header">
          <a class="navbar-brand" href="#"><img src="images/ashwani1.png"></a>
        </div>
       <ul class="nav navbar-nav" style="margin-top: 30px">
            <li class="active"><a href="dashbord.php">Dashbord</a></li>
            <li><a href="profile.php">Update Profile</a></li>
            <li><a href="#">My Jobs</a></li>
        </ul>

    <ul class="nav navbar-nav navbar-right" style="margin-top: 30px">
        
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
      </ul>
  </div>
</nav>

	<div class="container" >
		<div class="row"style="margin-top: 10px; margin-bottom: 50px; background-color: #e6fff2; height: 150px;">
			
			<div class="col-sm-12" style="margin-top:30px; margin-bottom: 30px; "> 
				<div class="col-sm-5" >	
						<label style="color:orange; margin-left: 30px;"><b> What</b></label>
						<input type="text" name="where" class="form-control " placeholder="Job Title, Keywords, or Company.">
				</div>

				<div class="col-sm-5" >						
						<label style="color: orange; margin-left: 30px;"><b> Where</b></label>
						<input type="text" name="where" class="form-control" placeholder="City, State, Pin-code.">
				</div>
				<div class="col-sm-2" >
					<a class="btn btn-info" style="margin-left: 30px; margin-top: 25px;">Find a Job</a>
					<!-- <a href="job.html"><button type="button"><font size="4px"> Find Job</font></button></a> -->
				</div>
			</div>
			<div class="col-sm-12"  style="margin-top: 20px; margin-bottom: 0px;"> 
				<h3 align ="center" style="background-color: #f6f0ef">List of Job for you.</h3>
			</div>

			<div class="col-lg-12">
				<div class="col-sm-9">
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


								// Create connection
								$conn = new mysqli($servername, $username, $password, $dbname);
								// Check connection
								if ($conn->connect_error) {
								    die("Connection failed: " . $conn->connect_error);
								} 

									$sql = "SELECT * FROM job";

									$result = $conn->query($sql);
									$row = $result->fetch_assoc();
									

									
									if ($result->num_rows > 0) {
									    // output data of each row
									    // echo "<table><tr><th>qualifaction</th><th>courses/programs</th><th>specialization</th><th>industry</th><th>Department</th><th>state</th><th>locaation</th></tr>";
									    while($row = $result->fetch_assoc()) {
									        echo " <div class='col-sm-12' style]'margin-bottom:40px;'> <h3>". $row["jobTitle"]."</h3>
										        		<p>". $row["jobType"]."</p>
										        		<p>". $row["description"]."</p>
										        		<p>". $row["city"]."</p>
									        		</div>";

							    }
							   

							}
							
					$conn->close();
					?>
					</div>
				</div>

				
		</div>
		</div>
		<footer style="background-color: black; height:150px;"></footer>
</body>
</html>