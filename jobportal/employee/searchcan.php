<?php
/* Displays user information and some useful messages */
session_start();
// echo session_id();
// Check if user is logged in using the session variable
if ( $_SESSION['emplogged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location:../emplogin/index.php");  
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
<?php include("../config.php");?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo $first_name;?> <?php echo $last_name;?></title>
  <link rel="icon" href="../images/logo.png" type="image/png">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="../css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="../css/animate.css">
  <link rel="stylesheet" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" href="../css/owl.theme.default.min.css">
  <link rel="stylesheet" href="../css/magnific-popup.css">
  <link rel="stylesheet" href="../css/aos.css">
  <link rel="stylesheet" href="../css/ionicons.min.css">
  <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="../css/jquery.timepicker.css">
  <link rel="stylesheet" href="../css/flaticon.css">
  <link rel="stylesheet" href="../css/icomoon.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
  <div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include("nav.php");?>
        <div class="container">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="visibility: hidden;">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="visibility: hidden;"><i class="fas fa-download fa-sm text-white-50" ></i> Generate Report</a>
          </div>
         
          <div class="row">
            <div class="col-xl-12 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <form action="searchcan.php" method="post" class="search-job">
                    <div class="row">
                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <div class="icon"><span class="icon-user"></span></div>
                            <input type="text" name="des" class="form-control" placeholder="eg. Developer">
                          </div>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <input type="text" name="edu" class="form-control" placeholder="Qualifaction">
                          </div>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <div class="icon"><span class="icon-map-marker"></span></div>
                            <input type="text" name="location" class="form-control" placeholder="Location">
                          </div>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-group">
                          <div class="form-field">
                            <input type="submit" value="Search" class="form-control btn btn-primary">
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>  
              </div>
            </div>
            <div class="container">
              <div class="row">
                <table class="table table-bordered bg-light">
                  <tr class="bg-info text-light">
                    <th>Candidate Id</th>
                    <th>Candidate Name</th>
                    <th>Job title</th>
                    <th>Position</th>
                    <th>Experience</th>
                    <th>Company name</th>
                    <th>Location</th>
                    <th>Industory</th>
                    <th>Contact no</th>
                    <th>Emailid</th>
                    <th>Qualifation</th>
                  </tr>
                  <?php include("../config.php");?>
              <?php
                if(count($_POST)>0) {
                    $des=$_POST["des"];
                    $edu=$_POST["edu"];
                    $loc=$_POST["location"];
                    $result = mysqli_query($conn,"SELECT candidate.fname, candidate.lname, candidate.jobtitle, candidate.years, candidate.months, candidate.emailid, candidate.mobileno, candidate.CurrentLocation, employmenthistory.CompanyName, employmenthistory.Industry, employmenthistory.Function, employmenthistory.Position, employmenthistory.CTC, employmenthistory.EmployementPeriod, employmenthistory.Location, employmenthistory.Reason, employmenthistory.role, educational.sno, educational.userid, educational.Qualification, educational.Course, educational.BoardUniversity, educational.Specialization, educational.Year, educational.Location, educational.marks, educational.userid, candidate.userid FROM ((candidate INNER JOIN educational ON educational.userid = candidate.userid) INNER JOIN employmenthistory ON educational.userid = employmenthistory.userid) where candidate.jobtitle ='$des' and educational.Qualification = '$edu' and candidate.CurrentLocation='$loc' and employmenthistory.userid ");   
               
                  }
              ?>
               
                <?php
                  $i=0;
                  while($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                  <td><?php echo  $row["sno"];?></td>
                  <td><?php echo  $row["fname"];?> <?php echo  $row["lname"];?></td>
                  <td><?php echo  $row["jobtitle"];?></td>
                  <td><?php echo  $row["Position"];?></td>
                  <td><?php echo  $row["years"];?></td>
                  <td><?php echo  $row["CompanyName"];?></td>
                  <td><?php echo  $row["Location"];?></td>
                  <td><?php echo  $row["Industry"];?></td>
                  <td><?php echo  $row["mobileno"];?></td>
                  <td><?php echo  $row["emailid"];?></td>
                  <td><?php echo  $row["Course"];?></td>
                      
                </tr>

                <?php
                  $i++;
                  }
                  echo "</table>";
                ?>
                
            
              
               
              

            
    </div>
  </div>
    
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
