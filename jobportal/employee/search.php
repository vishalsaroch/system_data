
<?php include("../config.php");?>
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
<?php
  $photo="";
  $iddd=$_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Candidate CV</title>
  <link rel="icon" href="../images/logo.png" type="image/png">
  <!-- Custom fonts for this template-->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
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
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include("nav.php");?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->

        <div class="container">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="visibility: hidden;">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="visibility: hidden;"><i class="fas fa-download fa-sm text-white-50" ></i> Generate Report</a>
          </div>
          <div class="bg-success text-center text-light text-bold"><?php echo $photo;?></div><br>
          <!-- Content Row -->
          <div class="row" style="height:200px; margin-bottom: 25px;">
          <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                  
                  <div class="dropdown-list-image mr-3">
                    <?php
                      $sql = "SELECT * from candidate where candidate.emailid = '".$iddd."';";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          if($row["image"]===""){
                            echo "<img class='rounded-circle' src='../images/can.png' height='100' width='100px'>" ;}
                            else
                            echo "<img class='rounded-circle' src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='100' width='100px;''><br>";
                            }
                          } else {
                          echo "<imgsrc='images/headshot-male.png'height='150' width='150'>";
                          }
                    ?>
                    

                    <div class="status-indicator bg-success"></div>
                  </div>
                  
                  <?php
                  $sql = "SELECT * from candidate where candidate.emailid = '".$iddd."';";
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                  ?>
                  <div class="col mr-2">
                   <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase mb-1"><?php echo $row["fname"];?> <?php echo $row["lname"];?></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row["jobtitle"];?></div>
                    <div class="text-md font-weight-bold text-uppercase mb-1"><?php echo $row["years"];?>.<?php echo $row["months"];?> years</div>
                    <div class="text-md font-weight-bold  mb-1"><?php echo $row["emailid"];?></div>
                    <div class="text-md font-weight-bold  mb-1"><?php echo $row["mobileno"];?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">Basic Information</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-xl-6 col-lg-6">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Dob</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["DOB"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Gender</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["Gender"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Mobile no</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["mobileno"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Email</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["emailid"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">address</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["Address"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">location</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["CurrentLocation"];?></div>
                      </div>
                      <div class="col-xl-6 col-lg-6">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Marital Status</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["MaritalStatus"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Current Designation</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["CurrentDesignation"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1"> Religion</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["Religion"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Nationality</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["Nationality"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Preferred Location</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["PreferredLocation"];?></div>
                    </div>
                    <?php
                      }
                        } else {
                            echo "0 results";
                        }
                    ?>
                    <!-- </div> -->
                  </div>
                </div>
              </div>
            </div>
            
          <!-- /.container-fluid -->
          </div>

<!--======================================================================================================================================================================================================== -->
        

    
        <!-- Education and qualifaction -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">educational qualification</h6>
                </div>
                
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row">
                   <?php
                    $sql = "SELECT educational.sno, educational.userid, educational.Qualification, educational.Course, educational.BoardUniversity, educational.Specialization, educational.Year, educational.Location, educational.marks, educational.userid, candidate.userid FROM educational INNER JOIN candidate ON educational.userid = candidate.userid where candidate.emailid = '".$iddd."';";
                      $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                  ?>
                  <table class="table table-border">
                    <tr class="bg-primary text-light">
                      <th>Qualification</th>
                      <th>Course</th>
                      <th>Specialization</th>
                      <th>Board/University</th>
                      <th>Year</th>
                      <th>Location</th>
                      <th>Marks</th>
                    </tr>
                  <?php
                          while($row = $result->fetch_assoc()) {
                  ?>
                    <tr>
                      <td><?php echo $row["Qualification"] ?></td>
                      <td><?php echo $row["Course"] ?></td>
                      <td><?php echo $row["Specialization"] ?></td>
                      <td><?php echo $row["BoardUniversity"] ?></td>
                      <td><?php echo $row["Year"] ?></td>
                      <td><?php echo $row["Location"] ?></td>
                      <td><?php echo $row["marks"] ?></td>
                    </tr>


                      
                    <?php
                      }
                      echo "</table>";
                    } else {
                      echo "no result found";
                    }
                  ?>
                  </div>
                </div>
              </div>
            </div>
          <!-- /.container-fluid -->
          </div>
<!--=================================================================================================================================================================================================-->
          
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">Job Experience</h6>
                  
                </div>

               <!-- Card Body -->
                <!-- <div class="card-body"> -->
                  <div class="row">
                    <?php
                      $sql = "SELECT employmenthistory.CompanyName, employmenthistory.Industry, employmenthistory.Function, employmenthistory.Position, employmenthistory.CTC, employmenthistory.EmployementPeriod, employmenthistory.Location, employmenthistory.Reason, employmenthistory.role FROM employmenthistory INNER JOIN candidate ON employmenthistory.userid = candidate.userid where candidate.emailid = '".$iddd."';";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                    ?>
                    <table class="table table-bordered">
                      <tr class="btn-primary text-light">
                        <th>Company Name</th>
                        <th>Industry</th>
                        <th>Function</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Location</th>
                        <th>Employment Period</th>
                        <th>Reason for Leaving</th>
                        <th>Role</th>
                      </tr>
                    <?php
                      while($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                      <td><?php echo $row["CompanyName"] ?></td>
                      <td><?php echo $row["Industry"] ?></td>
                      <td><?php echo $row["Function"] ?></td>
                      <td><?php echo $row["Position"] ?></td>
                      <td><?php echo $row["CTC"] ?></td>
                      <td><?php echo $row["Location"] ?></td>
                      <td><?php echo $row["EmployementPeriod"] ?> Year (Experience)</td>
                      <td><?php echo $row["Reason"] ?></td>
                      <td><?php echo $row["role"] ?></td>
                    </tr>
                    
                    <?php
                      }
                      echo "</table>";
                     }else {
                      echo "no result found";
                    }
                  ?>

                  
                </div>
                  </div>
                </div>
              </div>
           <!--  </div> -->
          <!-- /.container-fluid -->
          </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <!-- <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer> -->
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
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
