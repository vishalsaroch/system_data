<?php include"../config.php"?>
<?php
session_start();
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
  if(isset($_POST['submit'])){
    $images = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
    $sql = "UPDATE `employersusers` SET `image`='".$images."' WHERE `userid`='".$_SESSION['email']."';";
    $run = mysqli_query($conn, $sql);
    if ($run) {
      $photo = "Company logo Updated Successfully";
      } else {
      $photo = "Error: " . $sql . "<br>" . $conn->error;
    }
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
  <div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include("nav.php");?>
          <div class="container">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800" style="visibility: hidden;">Dashboard</h1>
              <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="visibility: hidden;"><i class="fas fa-download fa-sm text-white-50" ></i> Generate Report</a>
          </div>
          <div class="bg-success text-center text-light text-bold"><?php echo $photo;?></div><br>
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
                            <input type="text" name="des"class="form-control" placeholder="eg. Developer">
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
