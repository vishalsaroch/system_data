<?php
/* Displays user information and some useful messages */
session_start();
// echo session_id();
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location:../login/index.php");  
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
  <!-- Custom fonts for this template-->
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
      <nav class="navbar navbar-expand-lg  ftco_navbar bg-light ftco-navbar-light shadow" id="ftco-navbar  " >
        <div class="container">
          <a href="../index.php" class="navbar-brand"><img src="../images/logo.png"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu" style="color: #000;"></span>
          </button>

          <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active"><a href="Profile.php" class="nav-link" style="color:#000; font-weight: bold">Profile</a></li>
              <li class="nav-item"><a href="myjob.php" class="nav-link" style="color:#000; font-weight: bold">My Job</a></li>
              
              <li class="dropdown nav-item">
                <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" style="text-transform: capitalize; color:#000; font-weight: bold;"><?php echo $first_name;?> <?php echo $last_name;?><span class="caret" ></span></a>
                <ul class="dropdown-menu" style="padding:10px;">
                  <li><a href="../login/logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->

        <div class="container">
        <br><br><br><br>
          <div class="row">
              <?php
              $sql = "SELECT * FROM interview INNER JOIN job ON interview.jobid=job.sno where interview.canid = '".$_SESSION['email']."';";
                //$sql = "SELECT * from interview where canid = '".$_SESSION['email']."';";
                //$sql = "SELECT * FROM ((interview INNER JOIN job ON job.sno = interview.jobid) INNER JOIN job ON educational.userid = job.userid) ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
              ?>
                <table class="table table-bordered bg-white">
                  <tr>
                    <th>Job Title</th>
                    <th>company</th>
                    <th>Industry</th>
                    <th>Designation</th>
                    <th>Location</th>
                    <th>Experience</th>
                    <th>Status</th>
                    <th>Date of Joining</th>
                    <th>Ofered Salary</th>
                  </tr>
                  <?php
                    while($row = $result->fetch_assoc()) {
                  ?>
                  <tr>
                    <td><?php echo $row["jobTitle"] ?></td>
                    <td><?php echo $row["compName"] ?></td>
                    <td><?php echo $row["Industry"] ?></td>
                    <td><?php echo $row["designation"] ?></td>
                    <td><?php echo $row["location"] ?></td>
                    <td><?php echo $row["experince"] ?></td>
                    <td><?php if ($row["status"]==0) {
                        echo "<div class='bg-warning text-white'>panding</div>";}
                        elseif ($row["status"]==1) {
                          echo "<div class='bg-success text-white'>Selected</div>";
                        }else{
                          echo "<div class='bg-danger text-white'>Rejected</div>";
                        }
                      ?></td>
                    <td><?php echo $row["doj"] ?></td>
                    <!-- <td><?php echo $row["Reason"] ?></td>
                    <td><?php echo $row["Function"] ?></td>-->
                    <td><?php echo $row["offered_salary"] ?></td> 
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
          <!-- /.container-fluid -->
          </div>
          

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
