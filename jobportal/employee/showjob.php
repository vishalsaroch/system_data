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
         <?php
            $iddd=$_GET["id"];
           // Create connection
            $sql = "SELECT * FROM `job` where `sno`=".$iddd;
            $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                 echo '<div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">

                  <div class="mb-4 mb-md-0 mr-5">
                    <div class="job-post-item-header d-flex align-items-center">
                      <h2 class="mr-3 text-black h3">' . $row["jobTitle"]. '</h2>
                      <div class="badge-wrap">
                       <span class="bg-primary text-white badge py-2 px-3">' . $row["jobType"]. '</span>
                      </div>
                    </div>
                    <div class="job-post-item-body d-block d-md-flex">
                      <div class="mr-3"><span class="icon-layers"></span> <a href="#">' . $row["compName"]. '</a></div>
                      <div><span class="icon-my_location"></span> <span>' . $row["location"]. '</span></div>
                    </div>
                  </div>';
          ?>
                  <div class="ml-auto d-flex">
                    <a href="showjob.php?id=<?php echo $row["sno"];?>" target="-blank" class="btn btn-primary py-2 mr-1" data-toggle="modal" data-target="#myModal">search</a>
                  </div>

                  <div class="modal" id="myModal">
                    <div class="modal-dialog">
                      <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Search Candidate </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                            <form method="post" action="search.php" target="_blank">
                              <input type="text" name="query" class="form-control" placeholder="Candidate id"><br>
                              <input type="submit" name="search" value="search" class="btn btn-secondary">
                            </form>
                          </div>

                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>

                        </div>
                      </div>
                    </div>
                      
                  </div>

                  <div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">
                    <div class="mb-4 mb-md-0 mr-5">
                      <div class="job-post-item-body d-block d-md-flex">
                      
                        <div class="mr-3">
                        <b>Experience:</b> <?php echo  $row["experince"];?> Years.<br>
                        <b>Designation:</b> <?php echo  $row["designation"];?> Years.<br>
                        <b>Industory: </b><?php echo  $row["Industry"];?><br>
                        <p><?php echo  $row["description"];?></p>
                        </div>
                      </div>
                    </div>';
                  </div>


                    <?php
                    }
                  } else {
                echo "no result found";
              }
          // $conn->close();
          ?>

          <div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">
            <div class="mb-4 mb-md-0 mr-5">
              <div class="job-post-item-body d-block d-md-flex">
              <div class="mr-3 col-md-2"></div>
                <div class="mr-3 col-md-10">
                <h4>Interview Lineup</h4><br>
                <form action="" method="post">
                    <div class="row form-group">
                        <input type="text" name="canid" class="form-control" placeholder="Enter your candidateid" required="">
                    </div> 
                    <!-- <div class="row form-group">
                        <textarea name ="candetaile" class="form-control" id="summernote" cols="30" rows="5" required></textarea>
                    </div> -->
                    <div class="row form-group">
                        <input type="submit" name="update" class="btn btn-primary" value="update">
                    </div>
                  <!-- <script>
                    $('#summernote').summernote({
                      placeholder: 'Candidate detail',
                      tabsize: 2,
                      height: 100
                    });
                  </script>  -->
                </form>
                <?php
                if(isset($_POST['update'])){
                  $canid = $_POST['canid'];
                  $dateNow = date("Y/m/d");
                  $query = "INSERT INTO `interview` (`canid`, `recid`,`date`, `jobid`) VALUES ('".$canid."', '".$email."', '".$dateNow."', '".$iddd."')";
                    $run = mysqli_query($conn, $query);
                    if($run){
                       echo "Interview Schduled sucessfully";
                    }else{
                        echo "Error: " . $query. "<br>" . $conn->error;
                    }
                }
                ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        
  <!-- Bootstrap core JavaScript-->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>  
  
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
