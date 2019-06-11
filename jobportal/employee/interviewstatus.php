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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
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
      <?php include("nav.php");?>
        <!-- End of Topbar -->
    <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800" style="visibility: hidden">Tables</h1>
          <p class="mb-4" style="visibility: hidden">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net" style="visibility: hidden">official DataTables documentation</a>.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Interview Status</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <tr class="bg-primary text-white">
                    <th>Candidate Name</th>
                    <th>Recruter ID</th>
                    <th>Industory</th>
                    <th>Designation</th>
                    <th>Location</th>
                    <th>Current Salary</th>
                    <th>Notice Period</th>
                    <th>Resume</th>
                    <th>Interview Date</th>
                    <th>Status</th>
                    <th>Date of joining</th>
                    <th>Offered salary</th>
                    <th>Action</th>
                  </tr><?php
                  $sql = "SELECT * FROM ((interview INNER JOIN job ON job.sno = interview.jobid) INNER JOIN candidate ON candidate.emailid = interview.canid) where interview.recid = '".$_SESSION['email']."';";
                    // $sql = "SELECT * FROM interview";
                    //$sql = "SELECT * FROM interview INNER JOIN job ON interview.jobid=job.sno where interview.canid = '".$_SESSION['email']."';";
                    $result = $conn->query($sql); 
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        ?>
                  <tr>
                  <td><?php echo $row["fname"];?> <?php echo $row["lname"];?></td>
                  <td><?php echo $row["recid"];?></td>
                  <td><?php echo $row["Industry"];?></td>
                  <td><?php echo $row["designation"];?></td>
                  <td><?php echo $row["location"];?></td>
                  
                  <td><?php echo $row["ExpectedSalary"];?></td>
                  <td><?php echo $row["NoticePeriod"];?></td>
                  <td><a href="search.php?id=<?php echo $row["canid"];?>" target="-blank" class="btn btn-primary py-2 mr-1"><?php echo $row["fname"];?></a></td>
                  <td><?php echo $row["interview_date"];?></td>
                  <td><?php if ($row["status"]==0) {
                        echo "<div class='bg-warning text-white'>panding</div>";}
                        elseif ($row["status"]==1) {
                          echo "<div class='bg-success text-white'>Selected</div>";
                        }elseif ($row["status"]==3) {
                          echo "<div class='bg-warning text-white'>Shortlisted</div>";}
                          else{echo "<div class='bg-danger text-white'>Rejected</div>";

                        }
                      ?></td>

                     
                     <td>
                       <form action="interviewgetstatus.php" method="post">
                       <input type="text" name="inid" style="display: none;" value='<?php echo $row["inid"];?>'>
                        <select name="status" onchange="submitForm(this)" value='<?php if ($row["status"]==0) {
                        echo "<div class='bg-warning text-white'>panding</div>";}
                        elseif ($row["status"]==1) {
                          echo "<div class='bg-success text-white'>Selected</div>";
                        }else {
                          echo "<div class='bg-danger text-white'>Rejected</div>";
                        }
                      ?>'>
                            <option value="0" class="bg-primary text-white">Choose</option>
                            <option value="1">Selected</option>
                            <option value="2">Rejected</option>
                            <option value="3">Short Listed</option>
                            
                            
                        </select> 
                    </form>


                     <script>
                        function submitForm(elem) {
                            if (elem.value) {
                                elem.form.submit();
                            }
                        }
                    </script>
                     </td>
                     
                     <form method="post" action="selected.php">
                      <td><input type="date" name="doj" value="<?php echo $row['doj'];?>"></td>
                      <td><input type="number" name="salary" value="<?php echo $row["offered_salary"];?>">
                      <input type="hidden" name="inid" value="<?php echo $row["inid"];?>">
                      </td>
                      <td><input type="submit" name="update" class="btn btn-warning"  value="update"></td>
                    </form>
                  </tr>
                  <?php
                            }
                            } else {
                        echo "no result found";
                      }
                  $conn->close();
                  ?>
                </table>
              </div>
            </div>
          </div>
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Interview Status</h4>
                </div>
                <div class="modal-body">
                 <form action="" method="post">
                   <div class="radio-inline">
                    <label><input type="radio" value="Accepted">Accepted</label>
                  </div>
                  <div class="radio-inline">
                    <label><input type="radio" value="Rejected">Rejected</label>
                  </div>
                  <div class="radio disabled">
                    <label><input type="radio" value="Hold">Hold</label>
                  </div>
                  <div class="radio disabled">
                    <label><input type="Check" value="Not Come">Not Come</label>
                  </div>

                 </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div> 
        </div>
        <!-- /.container-fluid -->

</div>
</div>
</div>
</body>
</html>

