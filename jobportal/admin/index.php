<?php
  session_start();
  if ( $_SESSION['adminlogin'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location:../adminlogin/index.php");  
    exit();
  }
  else {
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>cogentsol - Dashboard</title>
  <link rel="icon" href="../images/logo.png" type="image/png">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
<?php 
  if ( isset($_SESSION['message']) ){
     echo $_SESSION['message'];
     unset( $_SESSION['message'] );
}
?>

<?php
  if ( !$active ){
    header("location:adminlogin/index.php");
    exit();
  }
?>

<?php
  include("db.php");
 ?>
  
<div id="wrapper">
  <?php include("slider.php");?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include("nav.php");?>
          <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>
            <div class="row">
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">candidates</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php
                            $sql="select count('id') from candidate";
                            $result=mysqli_query($conn,$sql);
                            $row=mysqli_fetch_array($result);
                            echo "$row[0]";     
                          ?>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Recruiter</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php
                            $sql="select count('id') from employersusers where role='Recruiter'";
                            $result=mysqli_query($conn,$sql);
                            $row=mysqli_fetch_array($result);
                            echo "$row[0]";     
                          ?>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">jobs</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                              <?php
                                $sql="select count('sno') from job";
                                $result=mysqli_query($conn,$sql);
                                $row=mysqli_fetch_array($result);
                                echo "$row[0]";     
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">company</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php
                            $sql="select count('sno') from employersusers where role='employer'";
                            $result=mysqli_query($conn,$sql);
                            $row=mysqli_fetch_array($result);
                            echo "$row[0]";     
                          ?>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Candidate</h6>
                    <form method="post" action="excel.php">
                      <input type="submit" name="export_candidate" value="Export To Excel" class="btn btn-info">
                    </form>
                  </div>
                  <div class="card-body">
                    <div class="chart-area">
                      <table class="table table-bordered">
                        <tr>
                          <th>Candidate id</th>
                          <th>Customer Name</th>
                          <th>Job Title</th>
                          <th>location</th>
                          <th>Qualification</th>
                          <th>job Title</th>
                          <th>Experience</th>
                        </tr>
                        <?php
                          $sql = "SELECT * from candidate ORDER BY sno DESC LIMIT 6";
                          $result = $conn->query($sql);
                          while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                          <td><?php echo $row["sno"]; ?></td>
                          <td><?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?></td>
                          <td><?php echo $row["jobtitle"]; ?></td>
                          <td><?php echo $row["CurrentLocation"]; ?></td>
                          <td><?php echo $row["qualification"]; ?></td>
                          <td><?php echo $row["jobtitle"]; ?></td>
                          <td><?php echo $row["years"]; ?>.<?php echo $row["months"]; ?></td>
                        </tr>
                        <?php
                          }
                        ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Company</h6>
                    <form method="post" action="companyexcel.php">
                      <input type="submit" name="export_company" value="Export To Excel" class="btn btn-info">
                    </form>
                  </div>
                  <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                      <table class="table table-bordered">
                        <tr>
                         <th>Employer id</th>
                          <th>Employername</th>
                          <th>company name</th>
                        </tr>
                        <?php
                          $sql = "SELECT * from employersusers ORDER BY sno DESC LIMIT 4";
                          $result = $conn->query($sql);
                          while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                          <td><?php echo $row["sno"]; ?></td>
                          <td><?php echo $row["username"]; ?></td>
                          <td><?php echo $row["compName"]; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            <div class="col-lg-12 mb-8">
              <div class="card shadow mb-4">
                <!-- <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Job</h6>
                   <form method="post" action="jobexcel.php">
                      <input type="submit" name="export_job" value="Export To Excel" class="btn btn-info">
                    </form>
                </div> -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Job</h6>
                    <form method="post" action="jobexcel.php">
                      <input type="submit" name="export_job" value="Export To Excel" class="btn btn-info">
                    </form>
                  </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <tr>
                      <th>Job id</th>
                      <th>Job Title</th>
                      <th>Company Name</th>
                      <th>Job Type</th>
                      <th>Location</th>
                    </tr>
                    <?php
                      $sql = "SELECT * from job ORDER BY sno DESC LIMIT 5";
                      $result = $conn->query($sql);
                      while($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                      <td><?php echo $row["sno"];?></td>
                      <td><?php echo $row["jobTitle"];?></td>
                      <td><?php echo $row["compName"];?></td>
                      <td><?php echo $row["jobType"];?></td>
                      <td><?php echo $row["location"];?></td>
                    </tr>
                    <?php
                    }
                    ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>cogentsol.in</span>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
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
          <a class="btn btn-primary" href="../adminlogin/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>
