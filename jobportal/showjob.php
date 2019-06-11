

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>job Detail</title>
  <link rel="icon" href="images/logo.png" type="image/png">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">
  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
  <div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand-lg  ftco_navbar bg-light ftco-navbar-light shadow" id="ftco-navbar  " >
          <div class="container">
            <a href="index.php" class="navbar-brand"><img src="images/logo.png"></a>
          </div>
        </nav>
        <br>
        <br>
        <br>
        <div class="container">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="visibility: hidden;">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="visibility: hidden;"><i class="fas fa-download fa-sm text-white-50" ></i> Generate Report</a>
          </div>
		  <?php include("config.php");?>
          <?php
            $iddd=$_GET["id"];
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
                      <form action="applyjob.php" method="post">
                        <input type="text" name="jobid" value="<?php echo $row["jobTitle"];?>" style="display:none">
                       
                        <input type="submit" name="apply" value="apply" class="btn btn-primary">
                      </form>
                    </div>
                  </div>
                  <div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">
                    <div class="mb-4 mb-md-0 mr-5">
                      <div class="job-post-item-body d-block d-md-flex">
                        <div class="mr-3"> <?php echo  $row["description"];?></div>
                       </div>
                    </div>
                  </div>
                  <?php
                    }
                  } else {
                echo "no result found";
              }
           $conn->close();
          ?>
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