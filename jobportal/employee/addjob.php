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
        <?php
          if(isset($_POST['submit'])){
             $jobTitle = $_POST['jobTitle'];
             $companyname = $_POST['companyname'];
             $jobType = $_POST['jobType'];
             $industory = $_POST['industory'];
             $designation = $_POST['designation'];
             $location = $_POST['location'];
             $description = $_POST['description'];
             $dateNow = date("Y/m/d");
             $userid = $_POST['userid'];
             $Recuriter = $_POST['rec'];

             $exp = $_POST['exp'];
             // $Recuriter=implode($_POST['rec']);
             echo $Recuriter;
             $query = "INSERT INTO `job` (`jobTitle`, `compName`, `jobType`, `Industry`, `designation`, `location`, `description`, `date`, `userid`, `hire`, `experince`) VALUES ('".$jobTitle."', '".$companyname."', '".$jobType."', '".$designation."', '".$jobType."', '".$location."', '".$description."', '".$dateNow."', '".$userid."', '".$Recuriter."', '".$exp."')";
              $run = mysqli_query($conn, $query);
              if($run){
                 echo "New job added sucessfully";
                 header("location:compjob.php");
              }else{
                  echo "Error: " . $query. "<br>" . $conn->error;
              }
          }
      ?>
        <div class="container">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="visibility: hidden;">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="visibility: hidden;"><i class="fas fa-download fa-sm text-white-50" ></i> Generate Report</a>
          </div>
          <div class="row">
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <form action="" method="post" class="p-5 bg-white">
                  <div class="row form-group">
                    <div class="col-md-12 mb-3 mb-md-0">
                      <label class="font-weight-bold" for="fullname">Job Title</label>
                      <input type="hidden" name="userid" value="<?php echo "$email"?>">
                      <input type="text" name="jobTitle" id="fullname" class="form-control" placeholder="eg. Professional UI/UX Designer">
                    </div>
                  </div>
                  <div class="row form-group mb-5">
                    <div class="col-md-12 mb-3 mb-md-0">
                      <label class="font-weight-bold" for="fullname">Company</label>
                      <input type="text" name="companyname" id="fullname" class="form-control" placeholder="eg. Facebook, Inc.">
                    </div>
                  </div>
                  <div class="row form-group">
                  <label class="font-weight-bold" for="fullname">Job Type</label>
                    <div class="col-md-12 mb-3 mb-md-0">
                      <label for="option-job-type-1">
                        <input type="radio" name="jobType" name="job-type" Value="Full Time" required> Full Time
                      </label>
                    </div>
                    <div class="col-md-12 mb-3 mb-md-0">
                      <label for="option-job-type-2">
                        <input type="radio" name="jobType" name="job-type" value="Part Time" required> Part Time
                      </label>
                    </div>
                    <div class="col-md-12 mb-3 mb-md-0">
                      <label for="option-job-type-3">
                        <input type="radio" name="jobType" name="job-type" value="Freelance" required> Freelance
                      </label>
                    </div>
                    <div class="col-md-12 mb-3 mb-md-0">
                      <label for="option-job-type-4">
                        <input type="radio" name="jobType" name="job-type" value="Internship" required> Internship
                      </label>
                    </div>
                    <div class="col-md-12 mb-3 mb-md-0">
                      <label for="option-job-type-4">
                        <input type="radio" name="jobType" name="job-type" value="Termporary" required> Termporary
                      </label>
                    </div>
                  </div>
                  <div class="row form-group mb-4">
                  <label class="font-weight-bold" for="fullname">Industory</label>
                    <div class="col-md-12 mb-3 mb-md-0">
                      <?php
                        $sql="select * from industry";
                        $result = $conn->query($sql);
                      ?>
                      
                      <input list="industry" name="industory" placeholder="Industry" class="form-control" required="">
                        <datalist id="industry" name="industry">
                          <option value="" style="width:100%;">Select Location</option>
                            <?php
                              if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                  echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                }
                              }
                            ?>
                          </datalist><br>
                          </div>
                        </div>
                  <div class="row form-group">
                    <div class="col-md-12 mb-3 mb-md-0">
                      <label class="font-weight-bold" for="fullname">Designation</label>
                      <input type="text" name="designation" id="designation" class="form-control">
                    </div>
                  </div>
                  <div class="row form-group mb-4">
                  <label class="font-weight-bold" for="fullname">Location</label>
                    <div class="col-md-12 mb-3 mb-md-0">
                      <?php
                        $sql="select * from location";
                        $result = $conn->query($sql);
                      ?>
                      
                      <input list="location" name="location" placeholder="location" class="form-control" required="">
                        <datalist id="location" name="location">
                          <option value="" style="width:100%;">Select Location</option>
                            <?php
                              if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                  echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                }
                              }
                            ?>
                          </datalist><br>
                          </div>
                        </div>
                      <div class="row form-group">
                      <label class="font-weight-bold" for="fullname">Experience</label>
                        <div class="col-md-12 mb-3 mb-md-0">
                          <input name="exp" placeholder="Experence" class="form-control" required="">
                        </div>
                      </div>


                      <div class="row form-group">
                      <label class="font-weight-bold" for="fullname">Job Discription</label>
                        <div class="col-md-12 mb-3 mb-md-0">
                          <textarea name ="description" class="form-control" id="summernote" cols="30" rows="5" required></textarea>
                        </div>
                      </div>
                      <script>
                        $('#summernote').summernote({
                          placeholder: 'job description',
                          tabsize: 2,
                          height: 100
                        });
                      </script>
                      <div class="row form-group">
                      <input type="hidden" name="rec" value="0" />
                      <span><input type="Checkbox" name="rec" value="1"></span>&nbsp;&nbsp;
                      <span><label class="font-weight-bold" for="fullname">Hire a Employer</label></span>
                      <!-- <?php
                        if(isset($_POST['rec'])){
                          $checked_count = count($_POST['rec']);
                          echo $checked_count;
                        }
                        else{
                          
                        }
                      ?> -->
                      </div>

                      <div class="row form-group">
                        <div class="col-md-12">
                          <input type="submit" name="submit" value="Post" class="btn btn-primary  py-2 px-5">
                        </div>
                      </div>
                    </form>
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
