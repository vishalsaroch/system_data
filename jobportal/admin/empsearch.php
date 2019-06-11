<?php
/* Displays user information and some useful messages */
session_start();
// echo session_id();
// Check if user is logged in using the session variable
if ( $_SESSION['adminlogin'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";

  header("location:../adminlogin/index.php");  
  exit();
  }else {
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
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Search Employer</title>
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
    <?php
      include("slider.php");
    ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include("nav.php");?>
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Service</h1>
          </div>
          <?php
            if(count($_POST)>0) {
              $data=$_POST["userid"];
              $sql="select * from employersusers where userid='$data'";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
          ?>
          <div class="row">
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo  $row["compName"];?></h6>
                </div>
                <div class="card-body">
                  <h5>Role : <?php echo  $row["role"];?><h5>
                  <h6>User Name : <?php echo  $row["username"];?></h6>
                  <h6>Email Id : <?php echo  $row["emailid"];?></h6>
                  <h6>Contact No : <?php echo  $row["contactNo"];?><h6>
                  <h6>Address : <?php echo  $row["address"];?><h6>
                  <h6>Location : <?php echo  $row["state"];?><h6>
                </div>
              </div>
            </div>
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Services</h6>
                </div> 
                <div class="card-body">
                  <table class="table table-bordered">
                    <tr>
                      <th>Service Name</th>
                      <th>Status</th>
                      <th>Action</th>
                      <th>Limit</th>
                      <th>Update</th>
                    </tr>
                    <tr>
                    <td>Search Candidate</td>
                      <td>
                        <?php if ($row["showjob"]=="0") {
                          echo "<div class='bg-danger text-white'>De-activate</div>";
                          }else{
                            echo "<div class='bg-success text-white'>Activate</div>";
                          }
                        ?>
                      </td>
                      <td><form action="activateservice.php" method="post">
                       <input type="text" name="userid" style="display: none;" value='<?php echo $row["userid"];?>'>
                        <select name="showjob" onchange="submitForm(this)" value='<?php if ($row["showjob"]=="0") {
                             echo "<div class='bg-success text-white'>active</div>";
                        }else{
                          echo "<div class='bg-danger text-white'>Deactive</div>";
                        }
                      ?>'>
                            <option value="">Select</option>
                            <option value="0">De-activate</option>
                            <option value="1">Activate</option>
                          </select> 

                    </form>
                    <script>
                      function submitForm(elem) {
                        if (elem.value) {
                            elem.form.submit();
                        }
                      }
                    </script></td>
                    
                      <form action="" method="post">
                      <td>
                        <input type="number" name="limit">
                        </td>
                        <td>
                        <input type="submit" name="update" value="Activate" class="btn-info">
                      </td>
                      </form>
                    
                    </tr>
                    <tr>
                    <td>Export.excel</td>
                      <td>
                        <?php if ($row["showjob"]=="0") {
                          echo "<div class='bg-danger text-white'>De-activate</div>";
                          }else{
                            echo "<div class='bg-success text-white'>Activate</div>";
                          }
                        ?>
                      </td>
                      <td><form action="activateservice.php" method="post">
                       <input type="text" name="userid" style="display: none;" value='<?php echo $row["userid"];?>'>
                        <select name="showjob" onchange="submitForm(this)" value='<?php if ($row["showjob"]=="0") {
                             echo "<div class='bg-success text-white'>active</div>";
                        }else{
                          echo "<div class='bg-danger text-white'>Deactive</div>";
                        }
                      ?>'>
                            <option value="">Select</option>
                            <option value="0">De-activate</option>
                            <option value="1">Activate</option>
                          </select> 

                    </form>
                    <script>
                      function submitForm(elem) {
                        if (elem.value) {
                            elem.form.submit();
                        }
                      }
                    </script></td>
                    
                      <form action="" method="post">
                      <td>
                        <input type="number" name="limit">
                        </td>
                        <td>
                        <input type="submit" name="update" value="Activate" class="btn-info">
                      </td>
                      </form>
                    
                    </tr>
                    <tr>
                    <td>Add Job</td>
                      <td>
                        <?php if ($row["showjob"]=="0") {
                          echo "<div class='bg-danger text-white'>De-activate</div>";
                          }else{
                            echo "<div class='bg-success text-white'>Activate</div>";
                          }
                        ?>
                      </td>
                      <td><form action="activateservice.php" method="post">
                       <input type="text" name="userid" style="display: none;" value='<?php echo $row["userid"];?>'>
                        <select name="showjob" onchange="submitForm(this)" value='<?php if ($row["showjob"]=="0") {
                             echo "<div class='bg-success text-white'>active</div>";
                        }else{
                          echo "<div class='bg-danger text-white'>Deactive</div>";
                        }
                      ?>'>
                            <option value="">Select</option>
                            <option value="0">De-activate</option>
                            <option value="1">Activate</option>
                          </select> 

                    </form>
                    <script>
                      function submitForm(elem) {
                        if (elem.value) {
                            elem.form.submit();
                        }
                      }
                    </script></td>
                    
                      <form action="" method="post">
                      <td>
                        <input type="number" name="limit">
                        </td>
                        <td>
                        <input type="submit" name="update" value="Activate" class="btn-info">
                      </td>
                      </form>
                    
                    </tr>
                    <tr>
                    <td>Recruter Job</td>
                      <td>
                        <?php if ($row["showjob"]=="0") {
                          echo "<div class='bg-danger text-white'>De-activate</div>";
                          }else{
                            echo "<div class='bg-success text-white'>Activate</div>";
                          }
                        ?>
                      </td>
                      <td><form action="activateservice.php" method="post">
                       <input type="text" name="userid" style="display: none;" value='<?php echo $row["userid"];?>'>
                        <select name="showjob" onchange="submitForm(this)" value='<?php if ($row["showjob"]=="0") {
                             echo "<div class='bg-success text-white'>active</div>";
                        }else{
                          echo "<div class='bg-danger text-white'>Deactive</div>";
                        }
                      ?>'>
                            <option value="">Select</option>
                            <option value="0">De-activate</option>
                            <option value="1">Activate</option>
                          </select> 

                    </form>
                    <script>
                      function submitForm(elem) {
                        if (elem.value) {
                            elem.form.submit();
                        }
                      }
                    </script></td>
                    
                      <form action="" method="post">
                      <td>
                        <input type="number" name="limit">
                        </td>
                        <td>
                        <input type="submit" name="update" value="Activate" class="btn-info">
                      </td>
                      </form>
                    
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php

                  }
                }
                }
            ?>
          
          

            
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
     <!--  <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>cogentsol.in</span>
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
          <a class="btn btn-primary" href="../adminlogin/logout.php">Logout</a>
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
