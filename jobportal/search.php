<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Cogentsol - Home</title>
     <link rel="icon" href="images/logo.png" type="image/png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
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
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a href="index.php" class="navbar-brand"><img src="images/logo.png"></a>
        
      </div>
    </nav>
    <!-- END nav -->
    <?php
      if($_SERVER['SERVER_NAME']=='localhost')
          {
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "dbase2";
          }
          else if($_SERVER['SERVER_NAME']=='cogentsol.in')
          {
           $servername = "sun";
          $username = "cogentso_root";
          $password = "rootPWD@#";
          $dbname = "cogentso_dbase2";
          }
         $conn = new mysqli($servername, $username, $password, $dbname);
          
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
           if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;
        $total_pages_sql = "SELECT COUNT(*) FROM job";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
        if(count($_POST)>0) {
          $jobtitle=$_POST["jobtitle"];
          $location=$_POST["location"];
          $exp=$_POST["exp"];
          $result = mysqli_query($conn,"SELECT * FROM job where jobTitle='$jobtitle' and location='$location' and experince='$exp' LIMIT $offset, $no_of_records_per_page");
        }
      ?>
   <section class="ftco-section bg-light">
      <div class="container">
        <div class="row">
        <?php
          $i=0;
          while($row = mysqli_fetch_array($result)) {
        ?>
          <div class="col-md-12 ftco-animate">
            <div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">
              <div class="mb-4 mb-md-0 mr-5">
                <div class="job-post-item-header d-flex align-items-center">
                  <h2 class="mr-3 text-black h3"><?php echo  $row["jobTitle"];?></h2>
                  <div class="badge-wrap">
                   <span class="bg-primary text-white badge py-2 px-3"><?php echo  $row["jobType"];?></span>
                  </div>
                </div>
                <div class="job-post-item-body d-block d-md-flex">
                  <div class="mr-3"><span class="icon-layers"></span> <a href="#"><?php echo  $row["compName"];?></a></div>
                  <div><span class="icon-my_location"></span> <span><?php echo  $row["location"];?></span></div>
                </div>
              </div>
              <div class="ml-auto d-flex">
               <a href="showjob.php?id=<?php echo $row["sno"];?>" target="-blank" class="btn btn-primary py-2 mr-1">view</a>
              </div>
            </div>
          </div><!-- end -->
          <?php
            $i++;
            }
          ?>
        </div>

        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                  
                <li><a href="?pageno=1">&lt;</a></li>
                <?php
                    for ($i=1; $i <$pageno ; $i++) { 
                    
                  ?>
                <li class="<?php if($pageno <= $i){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno <= $i){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                </li>
                <?php }?>
                <li><a href="?pageno=<?php echo $total_pages; ?>">&gt;</a></li>
            </ul>
              <!-- <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul> -->
            </div>
          </div>
        </div>
      </div>
    </section>
   
    

      
    <?php include("footer.php");?>
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>