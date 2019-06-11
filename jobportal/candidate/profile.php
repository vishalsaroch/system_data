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
<?php
  $photo="";
  if(isset($_POST['submit'])){
    $images = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
    $sql = "UPDATE `candidate` SET `image`='".$images."' WHERE `userid`='".$_SESSION['email']."';";
    $run = mysqli_query($conn, $sql);
    if ($run) {
      // echo "<span class='alert alert-success'>Profile Picture Updated Successfully</span>";
      $photo = "Profile Picture Updated Successfully";
      } else {
      // echo "Error: " . $sql . "<br>" . $conn->error;
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
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
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
            <li class="nav-item"><a href="myjob.php" class="nav-link" style="color:#000; font-weight: bold">interview status</a></li>
            
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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="visibility: hidden;">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="visibility: hidden;"><i class="fas fa-download fa-sm text-white-50" ></i> Generate Report</a>
          </div>
          <div class="bg-success text-center text-light text-bold"><?php echo $photo;?></div><br>
          <!-- Content Row -->
          <div class="row" style="height:200px; margin-bottom: 25px;">
          <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                  <div class="dropdown-list-image mr-3">
                    <?php
                      $sql = "SELECT * from candidate where candidate.emailid = '".$_SESSION['email']."';";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          if($row["image"]===""){
                            echo "<img class='rounded-circle' src='../images/can.png' height='100' width='100px' data-toggle='modal' data-target='#myModal' class='img-rounded'>" ;}
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
                  
                  $sql = "SELECT * from candidate where candidate.emailid = '".$_SESSION['email']."';";
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                  ?>
                  <div class="col mr-2">
                   <div class="h5 mb-0 font-weight-bold text-gray-800 text-uppercase mb-1"><?php echo $row["fname"];?> <?php echo $row["lname"];?></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row["jobtitle"];?></div>
                     
                      <div span="text-md font-weight-bold  mb-1"><?php echo $row["emailid"];?></div>
                       <div span="text-md font-weight-bold  mb-1"><?php echo $row["mobileno"];?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

           <?php
            if(isset($_POST['update'])){
              $dob=$_POST['dob'];
              $gender=$_POST['gender'];
              $matricalStatus=$_POST['matricalStatus'];
              $designation=$_POST['designation'];
              $clocation=$_POST['clocation'];
              $address=$_POST['address'];
              $clocation=$_POST['clocation'];
              $religion= $_POST["religion"];
              $nationality=$_POST['nationality'];
              $plocation=$_POST['plocation'];
              $date=date("Y/m/d");
              $sql = "UPDATE `candidate` SET `DOB`='".$dob."', `Gender`='".$gender."', `maritalStatus`='".$matricalStatus."',`CurrentDesignation`='".$designation."',`CurrentLocation`='".$clocation."',`Address`='".$address."', `Religion`='".$religion."',`Nationality`='".$nationality."',`PreferredLocation`='".$plocation."', `date`='".$date."' WHERE `userid`='".$_SESSION['email']."';";
             // $sql = "UPDATE `candidate` SET `FatherName`='".$fathername."',`DOB`='".$dob."',`Gender`='".$gender."',`MatricalStatus`='".$matricalStatus."',`CurrentDesignation`='".$designation."',`CurrentLocation`='".$clocation."',`Address`='".$address."', `Religion`='".$religion."',`Nationality`='".$nationality."',`LanguageKnown`='".$language."',`PreferredLocation`='".$plocation."',`  NoticePeriod`='".$notice."',`  ExpectedSalary`='".$ExpectedSalary."', `date`='".$date."' WHERE `userid`='".$_SESSION['email']."';";
            
            $run = mysqli_query($conn, $sql);
            if ($run) {
              echo "<div class='bg-success text-center text-light text-bold'>Personal Information Updated Successfully</div><br>";
              } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
            }
          ?>



          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">Basic Information</h6>
                  <div class="no-arrow">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editbasic">Edit</button>
                   <!-- The Modal -->
                    <div class="modal" id="editbasic">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header ard-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary text-uppercase">Basic Information</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                            <form method="post" action="">
                              <label class="text-primary font-weight-bold" class="text-primary font-weight-bold">DOB:</label>
                              <input type="date" name="dob" id="popupdob" class="form-control" value="<?php echo $row["DOB"];?>"><br>
                              <label class="text-primary font-weight-bold" class="text-primary font-weight-bold">Gender:</label>
                              <label class="radio-inline" style="text-indent: 25px;"><input type="radio" name="gender" id="popupgender" value="male" class="radio" <?php if($row['Gender']=="male"){echo "checked";}?>>Male</label>
                              <label class="radio-inline " style="text-indent: 40px;"><input type="radio" name="gender" id="popupgender"  value="female" class="radio" <?php if($row['Gender']=="female"){echo "checked";}?>>Female</label>
                              <br>
                              <label class="text-primary font-weight-bold">Address:</label>
                              <input type="text" name="address" id="popupaddress" class="form-control" value="<?php echo $row["Address"];?>"><br>
                              <label class="text-primary font-weight-bold">Location:</label>
                              <input type="text" name="clocation" id="popuplocation" class="form-control" value="<?php echo $row["CurrentLocation"];?>"><br>
                              <label class="text-primary font-weight-bold">Matrical Status:</label>
                              <input type="text" name="matricalStatus" id="popupMatricalStatus" class="form-control" value="<?php echo $row["MaritalStatus"];?>"><br>
                              <label class="text-primary font-weight-bold">Designation:</label>
                              <input type="text" name="designation" id="popupdesignation" class="form-control" value="<?php echo $row["CurrentDesignation"];?>"><br>
                              <label class="text-primary font-weight-bold">Religion:</label>
                              <input type="text" name="religion" id="popupreligion" class="form-control" value="<?php echo $row["Religion"];?>"><br>
                              <label class="text-primary font-weight-bold">Nationality:</label>
                              <input type="text" name="nationality" id="popupnationality" class="form-control" value="<?php echo $row["Nationality"];?>"><br>
                              <label class="text-primary font-weight-bold">PreferredLocation:</label>
                              <input type="text" name="plocation" id="popupplocation" class="form-control" value="<?php echo $row["PreferredLocation"];?>"><br>
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
                    <div class="col-xl-6 col-lg-6">
                      <span class="text-md font-weight-bold text-primary text-uppercase mb-1">Dob</span> : 
                      <span span="text-md font-weight-bold  mb-1"><?php echo $row["DOB"];?></span><br>
                      <span class="text-md font-weight-bold text-primary text-uppercase mb-1">Gender</span>:
                      <span span="text-md font-weight-bold  mb-1"><?php echo $row["Gender"];?></span><br>
                      <span class="text-md font-weight-bold text-primary text-uppercase mb-1">Mobile no</span> : 
                      <span span="text-md font-weight-bold  mb-1"><?php echo $row["mobileno"];?></span><br>
                      <span class="text-md font-weight-bold text-primary text-uppercase mb-1">Email</Span> : 
                      <span span="text-md font-weight-bold  mb-1"><?php echo $row["emailid"];?></span><br>
                      <span class="text-md font-weight-bold text-primary text-uppercase mb-1">address</span> : 
                      <span span="text-md font-weight-bold  mb-1"><?php echo $row["Address"];?></span><br>
                      <span class="text-md font-weight-bold text-primary text-uppercase mb-1">location</span> : 
                      <span span="text-md font-weight-bold  mb-1"><?php echo $row["CurrentLocation"];?></span><br>
                    </div>
                      <div class="col-xl-6 col-lg-6">
                      <span class="text-md font-weight-bold text-primary text-uppercase mb-1">Marital Status</span> : 
                      <span span="text-md font-weight-bold  mb-1"><?php echo $row["MaritalStatus"];?></span><br>
                      <span class="text-md font-weight-bold text-primary text-uppercase mb-1">Current Designation</span> : 
                      <span span="text-md font-weight-bold  mb-1"><?php echo $row["CurrentDesignation"];?></span><br>
                      <span class="text-md font-weight-bold text-primary text-uppercase mb-1"> Religion</span> : 
                      <span span="text-md font-weight-bold  mb-1"><?php echo $row["Religion"];?></span><br>
                      <span class="text-md font-weight-bold text-primary text-uppercase mb-1">Nationality</span> : 
                      <span span="text-md font-weight-bold  mb-1"><?php echo $row["Nationality"];?></span><br>
                      <span class="text-md font-weight-bold text-primary text-uppercase mb-1">Preferred Location</span> : 
                      <span span="text-md font-weight-bold  mb-1"><?php echo $row["PreferredLocation"];?></span><br>
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

<!--======================================================================================================================================================================================================== -->
        <?php
          if(isset($_POST['Eduadd'])){
            $qualifaction = $_POST["qualifaction"];
            $cource=$_POST['cource'];
            $specialization=$_POST['specialization'];
            $board=$_POST['board'];
            $year=$_POST['year'];
            $Location=$_POST['location'];
            $marks=$_POST['marks'];
            $userid=$_POST['userid'];
            $date=date("Y/m/d");

            //$sql = "UPDATE `educational` SET `Qualification`='".$qualifaction."',`Course`='".$cource."' WHERE `userid`='".$_SESSION['email']."' and `Qualification`='".$qualifaction."';";
            // $sql = "UPDATE `educational` SET `Qualification`='".$qualifaction."',`Course`='".$cource."',`Specialization`='".$specialization."',`BoardUniversity`='".$board."',`Year`='".$year."',`Location`='".$Location."',`marks`='".$marks."',`date`='".$date."' WHERE `userid`='".$_SESSION['email']."' and `Qualification`='".$qualifaction."';";
            $sql = "INSERT INTO `educational` (`Qualification`, `Course`, `Specialization`, `BoardUniversity`, `Year`, `Location`, `marks`, `userid`, `date`) VALUES ('$qualifaction', '$cource', '$specialization','$board', '$year', '$Location', '$marks', '$userid', '$date')";
            $run = mysqli_query($conn, $sql);
            if ($run) {
             echo "<div class='bg-success text-center text-light text-bold'>Personal Information Updated Successfully</div><br>";
              } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
            }          
    ?>

    <?php
          if(isset($_POST['Eduupdate'])){
            $qualifaction = $_POST["qualifaction"];
            $cource=$_POST['cource'];
            $specialization=$_POST['specialization'];
            $board=$_POST['board'];
            $year=$_POST['year'];
            $Location=$_POST['location'];
            $marks=$_POST['marks'];
            $userid=$_POST['userid'];
            

            //$sql = "UPDATE `educational` SET `Qualification`='".$qualifaction."',`Course`='".$cource."' WHERE `userid`='".$_SESSION['email']."' and `sno`='".$qualifaction."';";
            $sql = "UPDATE `educational` SET `Qualification`='".$qualifaction."',`Course`='".$cource."',`Specialization`='".$specialization."',`BoardUniversity`='".$board."',`Year`='".$year."',`Location`='".$Location."',`marks`='".$marks."' WHERE `userid`='".$_SESSION['email']."' and `Qualification`='".$qualifaction."';";
           
            $run = mysqli_query($conn, $sql);
            if ($run) {
             echo "<div class='bg-success text-center text-light text-bold'>Educational Information Updated Successfully</div><br>";
              } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
            }          
    ?>
        <!-- Education and qualifaction -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">educational qualification</h6>
                  <div class="no-arrow">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addqua">Add</button>
                   <!-- The Modal -->
                    <div class="modal" id="addqua">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header ard-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary text-uppercase">EDUCATIONAL QUALIFICATION</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                            <form action="" method ="post">
                  
                              <?php
                                $sql="select * from qualifaction";
                                $result = $conn->query($sql);
                              ?>
                            
                              <input list="qualifactions" name="qualifaction" placeholder="Qualifactions" class="form-control">
                              <datalist id="qualifactions" name="qualifaction">
                              <!-- <select name="qualification" id="qualification"> -->
                                <option value="">Select qualification</option>
                                <?php
                                  if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                      echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                    }
                                  }
                                ?>
                              </datalist><br>

                              <?php
                                $sql="select * from cource";
                                $result = $conn->query($sql);
                              ?>
                          
                              <input list="cource" name="cource" placeholder="Course" class="form-control">
                              <datalist id="cource">
                              <!-- <select name="qualification" id="qualification"> -->
                                <option value="">Course</option>
                                <?php
                                  if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                      echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                    }
                                  }
                                ?>
                              </datalist><br>

                              <?php
                                $sql="select * from specialization";
                                $result = $conn->query($sql);
                              ?>
                              <input list="specializations" name="specialization" placeholder="Specialization" class="form-control">
                              <datalist id="specializations">
                                <option value="">Select Specializations</option>
                                <?php
                                  if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                      echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                    }
                                  }
                                ?>
                              </datalist><br>
                                    
                              <input list="board" name="board" placeholder="Name of Board/University" class="form-control"><br>
                              <input type="text" name="year" placeholder="Year of Passing" class="form-control"><br>
                              <input type="hidden" name="userid" value="<?php echo "$email"?>">

                              <?php
                                $sql="select * from location";
                                $result = $conn->query($sql);
                              ?>
                          
                              <input list="location" name="location" placeholder="Loction" class="form-control">
                              <datalist id="location" name="location">
                              <!-- <select name="qualification" id="qualification"> -->
                                <option value="">Location</option>
                                <?php
                                  if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                      echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                    }
                                  }
                                ?>
                              </datalist><br>
                            
                              <input type="text" name="marks" placeholder="% of Marks Obtained" class="form-control"><br>
                              <input type="submit" name="Eduadd"  onclick="add" value="Add" class="btn btn-info">
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
                   <?php
                    $sql = "SELECT educational.sno, educational.userid, educational.Qualification, educational.Course, educational.BoardUniversity, educational.Specialization, educational.Year, educational.Location, educational.marks, educational.userid, candidate.userid FROM educational INNER JOIN candidate ON educational.userid = candidate.userid where candidate.emailid = '".$_SESSION['email']."';";
                      $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                  ?>
                  <div class="table-responsive">
                  <table class="table table-bordered">
                    <tr class="bg-primary text-light">
                      <th>Qualification</th>
                      <th>Course</th>
                      <th>Specialization</th>
                      <th>Board/University</th>
                      <th>Year</th>
                      <th>Location</th>
                      <th>Marks</th>
                      <th>Action</th>
                    </tr>
                  <?php
                          while($row = $result->fetch_assoc()) {
                  ?>
                    
                      <tr>
                        <td><?php echo $row["Qualification"] ?></td>
                        <td><?php echo $row["Course"] ?></td>
                        <td><?php echo $row["Specialization"] ?></td>
                        <td><?php echo $row["BoardUniversity"] ?></td>
                        <td><?php echo $row["Year"] ?></td>
                        <td><?php echo $row["Location"] ?></td>
                        <td><?php echo $row["marks"] ?></td>
                        <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal2222">Edit</button>
                        <a href="deledu.php?id=<?php echo $row["sno"];?>" class="btn btn-danger">Delete</a>
                        </td>

                      </tr>


                      
                    <?php
                      }
                      echo "</table>";
                    } else {
                      echo "no result found";
                    }
                  ?>
                  <div class="modal" id="myModal2222">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header ard-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary text-uppercase">EDUCATIONAL QUALIFICATION</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                            <form action="" method ="post">
                              <input name="sno" value="<?php echo $row["sno"]; ?>" class="form-control" type="hidden">
                  
                              <?php
                                $sql="select * from qualifaction";
                                $result = $conn->query($sql);
                              ?>
                          
                              <input list="qualifactions" name="qualifaction" value="<?php echo $row["Qualification"]; ?>" class="form-control">
                              <datalist id="qualifactions" name="qualifaction">
                              <!-- <select name="qualification" id="qualification"> -->
                                <option value="">Select qualification</option>
                                <?php
                                  if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                      echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                    }
                                  }
                                ?>
                              </datalist><br>

                              <?php
                                $sql="select * from cource";
                                $result = $conn->query($sql);
                              ?>
                          
                              <input list="cource" name="cource" value="<?php echo $row["Course"]; ?>" class="form-control">
                              <datalist  id="cource">
                              <!-- <select name="qualification" id="qualification"> -->
                                <option value="">Course</option>
                                <?php
                                  if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                      echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                    }
                                  }
                                ?>
                              </datalist><br>

                              <?php
                                $sql="select * from specialization";
                                $result = $conn->query($sql);
                              ?>
                              <input list="specializations" name="specialization" value="<?php echo $row["Specialization"]; ?>" class="form-control">
                              <datalist id="specializations">
                                <option value="">Select Specializations</option>
                                <?php
                                  if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                      echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                    }
                                  }
                                ?>
                              </datalist><br>
                                    
                              <input list="board" name="board" value="<?php echo $row["BoardUniversity"] ?>" class="form-control"><br>
                              <input type="text" name="year" value="<?php echo $row["Year"] ?>" class="form-control"><br>
                              <input type="hidden" name="userid" value="<?php echo "$email"?>">

                              <?php
                                $sql="select * from location";
                                $result = $conn->query($sql);
                              ?>
                          
                              <input list="location" name="location" <?php echo $row["Location"] ?> class="form-control">
                              <datalist id="location" name="location">
                              <!-- <select name="qualification" id="qualification"> -->
                                <option value="">Location</option>
                                <?php
                                  if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                      echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                    }
                                  }
                                ?>
                              </datalist><br>
                            
                              <input type="text" name="marks" value="<?php echo $row["marks"] ?>" class="form-control"><br>
                              <input type="submit" name="Eduupdate" value="Update" class="btn btn-warning">
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
                </div>
              </div>
            </div>
            </div>
          <!-- /.container-fluid -->
          
<!--=================================================================================================================================================================================================-->
<?php
            if(isset($_POST['addexp'])){
               $compname = $_POST['compname'];
               $industry=$_POST['industry'];
               $Function=$_POST['Function'];
               $Position=$_POST['Position'];
               $CTC=$_POST['CTC'];
               $EmployementPeriod=$_POST['EmployementPeriod'];
               $Location=$_POST['location'];
               $reason= $_POST["reason"];
               $role=$_POST['role'];
               $userid=$_POST['userid'];
               $date=date("Y/m/d");
               
               $sql = "INSERT INTO `employmenthistory` (`CompanyName`, `Industry`, `Function`, `Position`, `CTC`, `EmployementPeriod`, `Location`, `Reason`, `role`, `userid`, `date`) VALUES ('$compname', '$industry', '$Function', '$Position', '$CTC',  '$EmployementPeriod' ,'$Location', '$reason', '$role', '$userid', '$date')";
                

                $run = mysqli_query($conn, $sql);
                if ($run) {
                  echo "<div class='alert alert-success'>Employment History added Successfully</div>";
                  } else {
                  echo "<div class='alert alert-danger'>Error: " . $sql . "<br><br>" . $conn->error."</div>";
                  }
                }          
            ?>

            <?php
            if(isset($_POST['updateexp'])){
               $compname = $_POST['compname'];
               $industry=$_POST['industry'];
               $Function=$_POST['Function'];
               $Position=$_POST['Position'];
               $CTC=$_POST['CTC'];
               $EmployementPeriod=$_POST['EmployementPeriod'];
               $Location=$_POST['location'];
               $reason= $_POST["reason"];
               $role=$_POST['role'];
               $userid=$_POST['userid'];
               $date=date("Y/m/d");
               
               $sql = "UPDATE `employmenthistory` SET `CompanyName`='".$compname."',`Industry`='".$industry."',`Function`='".$Function."',`Position`='".$Position."',`CTC`='".$CTC."',`EmployementPeriod`='".$EmployementPeriod."',`Location`='".$Location."',`Reason`='".$reason."',`role`='".$role."',`date`='".$date."' WHERE `userid`='".$_SESSION['email']."' and `CompanyName`='".$compname."';";

                $run = mysqli_query($conn, $sql);
                if ($run) {
                  echo "<div class='alert alert-success'>Employment History Updated Successfully</div>";
                  } else {
                  echo "<div class='alert alert-danger'>Error: " . $sql . "<br><br>" . $conn->error."</div>";
                  }
                }  
            ?>

            <?php
              $total_exp = 0;
              $sql = "SELECT employmenthistory.EmployementPeriod FROM employmenthistory INNER JOIN candidate ON employmenthistory.userid = candidate.userid where candidate.emailid = '".$_SESSION['email']."';";
                      
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $total_exp = $total_exp + $row['EmployementPeriod'];
                }
              }
                    
            ?>
          
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">Job Experience</h6>
                  <div class="no-arrow">
                  <span style="background-color:#123453; color:#fff;">
                  <?php 
                    if($total_exp == 0)
                    echo "Friesher";
                    else
                    echo $total_exp;
                    echo " Years"
                  ?> 
                  </span>&nbsp; &nbsp;
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addexp">Add</button>
                   <!-- The Modal -->
                    <div class="modal" id="addexp">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header ard-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary text-uppercase">Job Experience</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                            <form action="" method="post">
                              <input type="text" id="compname" name="compname" placeholder="Company Name" class="form-control"><br>
                               <!-- <input type="text" name="industry" placeholder="Industry"><br> -->
                              <?php
                                $sql="select * from industry";
                                $result = $conn->query($sql);
                              ?>
                              
                              <input list="industry" name="industry" placeholder="Industry" class="form-control">
                                <datalist id="industry" name="industry">
                                  <option value="" style="width:100%">Select industry</option>
                                    <?php
                                      if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                          echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                        }
                                      }
                                    ?>
                                </datalist><br>
                              <input type="text" id="Function" name="Function" placeholder="Function" class="form-control"><br>
                              <input type="text" id="Position" name="Position" placeholder="Position" class="form-control"><br>
                              <input type="text" id="CTC" name="CTC" placeholder="Monthly CTC/In hand" class="form-control"><br>
                              <input type="text" id="EmployementPeriod" name="EmployementPeriod" placeholder="Employer Period" class="form-control"><br>
                              
                              <?php
                                $sql="select * from location";
                                $result = $conn->query($sql);
                              ?>
                                
                              <input list="location" id="popupLocation" name="location" placeholder="location" class="form-control">
                                <datalist id="location" name="location">
                                  <option value="" style="width:100%">Select Location</option>
                                    <?php
                                      if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                          echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                        }
                                      }
                                    ?>
                              </datalist><br>
                              <input type="text" id="reason" name="reason" placeholder="Reason for Leaving" class="form-control"><br>
                               <input type="hidden" name="userid" value="<?php echo "$email"?>">
                              <label >Role & Responsibilities</label>
                              <textarea name="role" id="summernote" rows="5" class="form-control"></textarea><br>
                              <input type="submit" name="addexp" value="add" class="btn btn-info">
                            </form>  
                          </div>
                          <script>
                            $('#summernote').summernote({
                              placeholder: 'Hello stand alone ui',
                              tabsize: 2,
                              height: 100
                            });
                          </script>
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
                    <?php
                    
                      $sql = "SELECT employmenthistory.CompanyName, employmenthistory.Industry, employmenthistory.Function, employmenthistory.Position, employmenthistory.CTC, employmenthistory.EmployementPeriod, employmenthistory.Location, employmenthistory.Reason, employmenthistory.role FROM employmenthistory INNER JOIN candidate ON employmenthistory.userid = candidate.userid where candidate.emailid = '".$_SESSION['email']."';";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                          $exp=$row["EmployementPeriod"];
                          
                    ?>
                     <div class="table-responsive">
                    <table class="table table-bordered">
                      <tr class="btn-primary text-light">
                        <th>Company Name</th>
                        <th>Industry</th>
                        <th>Function</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Location</th>
                        <th>Employment Period</th>
                        <th>Reason for Leaving</th>
                        <th>Role</th>
                        <th>Action</th>
                      </tr>
                    <?php
                      while($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                      <td><?php echo $row["CompanyName"] ?></td>
                      <td><?php echo $row["Industry"] ?></td>
                      <td><?php echo $row["Function"] ?></td>
                      <td><?php echo $row["Position"] ?></td>
                      <td><?php echo $row["CTC"] ?></td>
                      <td><?php echo $row["Location"] ?></td>
                      <td><?php echo $row["EmployementPeriod"]?> Year</td>
                      <td><?php echo $row["Reason"] ?></td>
                      <td><?php echo $row["role"] ?></td>
                     <td>
                     <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal3333">Edit</button>
                      <a href="delemphis.php?id=<?php echo $row["CompanyName"];?>" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
                    <?php
                      }
                      echo "</table>";
                     }else {
                      echo "no result found";
                    }
                  ?>
                  
                  
                  </div>
                  

                  <div class="modal" id="myModal3333">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header ard-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary text-uppercase">Job Experience</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                            <form action="" method="post">
                            <?php echo $row["CompanyName"];?>
                              <input type="text" id="compname" name="compname" value='<?php echo $row["CompanyName"];?>' class="form-control"><br>
                               <!-- <input type="text" name="industry" placeholder="Industry"><br> -->
                              <?php
                                $sql="select * from industry";
                                $result = $conn->query($sql);
                              ?>
                              
                              <input list="industry" name="industry" placeholder="Industry" class="form-control">
                                <datalist id="industry" name="industry">
                                  <option value="" style="width:100%">Select industry</option>
                                    <?php
                                      if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                          echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                        }
                                      }
                                    ?>
                                </datalist><br>
                              <input type="text" id="Function" name="Function" placeholder="Function" class="form-control"><br>
                              <input type="text" id="Position" name="Position" placeholder="Position" class="form-control"><br>
                              <input type="text" id="CTC" name="CTC" placeholder="Monthly CTC/In hand" class="form-control"><br>
                              <input type="text" id="EmployementPeriod" name="EmployementPeriod" placeholder="Employer Period" class="form-control"><br>
                              
                              <?php
                                $sql="select * from location";
                                $result = $conn->query($sql);
                              ?>
                                
                              <input list="location" id="popupLocation" name="location" placeholder="location" class="form-control">
                                <datalist id="location" name="location">
                                  <option value="" style="width:100%">Select Location</option>
                                    <?php
                                      if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                          echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                        }
                                      }
                                    ?>
                              </datalist><br>
                              <input type="text" id="reason" name="reason" placeholder="Reason for Leaving" class="form-control"><br>
                               <input type="hidden" name="userid" value="<?php echo "$email"?>">
                              <label >Role & Responsibilities</label>
                              <textarea name="role" id="summernote" rows="5" class="form-control"></textarea><br>
                              <input type="submit" name="updateexp" value="Update" class="btn btn-warning">
                            </form>  
                          </div>
                          <script>
                            $('#summernote').summernote({
                              placeholder: 'Hello stand alone ui',
                              tabsize: 2,
                              height: 100
                            });
                          </script>
                          <!-- Modal footer -->
                          <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  </div>
                </div>
              </div>
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
