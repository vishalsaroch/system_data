<?php
  session_start();
  if ( $_SESSION['emplogged_in'] == false ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location:../emplogin/index.php");  
    exit();
  }
  else {
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
  }
?>
<?php include("../config.php");?>
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
            <div class="bg-success text-center text-light text-bold"><?php echo $photo;?></div><br>
              <div class="row" style="height:200px; margin-bottom: 25px;">
                <div class="col-xl-12 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="dropdown-list-image mr-3">
                          <?php
                            $sql = "SELECT * from employersusers where employersusers.emailid = '".$_SESSION['email']."';";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                if($row["image"]===""){
                                  echo "<img class='rounded-circle' src='../images/emppro.jpg' height='100' width='100px' data-toggle='modal' data-target='#myModal' class='img-rounded'>" ;}
                                else
                                  echo "<img class='rounded-circle' src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='100' width='100px;' data-toggle='modal' data-target='#myModal' class='img-rounded'><br>";
                                }
                              } else {
                                echo "<imgsrc='images/headshot-male.png'height='150' width='150'>";
                            }
                          ?>
                          <div class="modal fade" id="myModal" role="dialog" style="margin-top: 100px;">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-6" > <output id="list"></output></div>
                                    <div class="col-md-6">
                                      <form action="" method="post" enctype="multipart/form-data">
                                      <br><br>
                                        <input type="file" name="fileToUpload" id="fileToUpload"  value="Choose" style="color:#fff" ><br><br>
                                        <input type="submit" value="Upload Image" name="submit" class="btn btn-primary">
                                        </form>
                                      </div>
                                  </div>
                                </div>
                                <script>
                                  function handleFileSelect(evt) {
                                    var files = evt.target.files; // FileList object

                                    // Loop through the FileList and render image files as thumbnails.
                                    for (var i = 0, f; f = files[i]; i++) {

                                      // Only process image files.
                                      if (!f.type.match('image.*')) {
                                        continue;
                                      }

                                      var reader = new FileReader();

                                      // Closure to capture the file information.
                                      reader.onload = (function(theFile) {
                                        return function(e) {
                                          // Render thumbnail.
                                          var span = document.createElement('span');
                                          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                                                            '" title="', escape(theFile.name), '" height="150px" width="150px"/>'].join('');
                                          document.getElementById('list').insertBefore(span, null);
                                        };
                                      })(f);

                                      // Read in the image file as a data URL.
                                      reader.readAsDataURL(f);
                                    }
                                  }

                                document.getElementById('fileToUpload').addEventListener('change', handleFileSelect, false);
                              </script>
                            </div>
                          </div>
                        </div>
                        <div class="status-indicator bg-success"></div>
                      </div>
                      <?php
                      $sql = "SELECT * from employersusers where employersusers.emailid = '".$_SESSION['email']."';";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                      ?>
                      <div class="col mr-2">
                       <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase mb-1"><?php echo $row["compName"];?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row["industory"];?></div>
                        <div class="text-md font-weight-bold text-uppercase mb-1"><?php echo $row["address"];?><br><?php echo $row["state"];?></div>
                        </div>
                      </div>
                    </div>
                  </div>  
                </div>
              </div>
              <?php
                if(isset($_POST['update'])){
                  $address=$_POST['address'];
                  $state=$_POST['state'];
                  $industory= $_POST["industory"];
                  $Statutory=$_POST['Statutory'];
                  $date=date("Y/m/d");
                  $sql = "UPDATE `employersusers` SET `address`='".$address."', `state`='".$state."',`industory`='".$industory."',`Statutory`='".$Statutory."', `date`='".$date."' WHERE `userid`='".$_SESSION['email']."';";
                  $run = mysqli_query($conn, $sql);
                  if ($run) {
                    echo "<div class='bg-success text-center text-light text-bold'>Company Information Updated Successfully</div><br>";
                    } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
              }
            ?>
            <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">Company information</h6>
                  <div class="no-arrow">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editbasic">Edit</button>
                   <!-- The Modal -->
                    <div class="modal" id="editbasic">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header ard-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary text-uppercase">COMPANY INFORMATION</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                            <form method="post" action="">
                              <lable class="text-primary font-weight-bold">Address:</lable>
                              <input type="text" name="address" class="form-control" value="<?php echo $row["address"];?>"><br>
                              <lable class="text-primary font-weight-bold">Location:</lable>
                              <input type="text" name="state" id="popuplocation" class="form-control" value="<?php echo $row["state"];?>"><br>
                              <lable class="text-primary font-weight-bold">INDUSTORY:</lable>
                              <input type="text" name="industory" value="<?php echo $row["industory"];?>" class="form-control"><br>
                              <lable class="text-primary font-weight-bold">Statutory:</lable>
                              <input type="text" name="Statutory" value="<?php echo $row["Statutory"];?>" class="form-control"><br>
                              <input type="submit" name="update" id="update" value="Update" class="btn btn-info" >
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
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-xl-5 col-lg-5"></div>
                    <div class="col-xl-6 col-lg-6">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Recruiter Name</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["username"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Email id</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["emailid"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Mobile no</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["contactNo"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">industory</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["industory"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">address</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["address"];?></div>
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Statutory</div>
                      <div class="text-md font-weight-bold  mb-1"><?php echo $row["Statutory"];?></div>
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

            </div>
          <!-- /.container-fluid -->
          </div>
      <!-- End of Main Content -->

     

    </div>
    <!-- End of Content Wrapper -->

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
