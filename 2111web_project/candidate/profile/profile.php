<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: ../login2/index.php");  
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
<html>
<head>
  <title>Profile</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="profile.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
   
  </style>
  <script>
    $(function() {
    $("#theForm").submit(function(e){
      e.preventDefault();    
      var formData = new FormData(this);
            
            
      var urlkey;
      if(location.hostname=='localhost')
      {
        urlkey = "/web_project/candidate/upload.php";
      }
      else if(location.hostname=='cogentsol.in')
      {
        urlkey = "upload.php";
      }
      $.ajax({
        
        url: urlkey,
        method: "POST",
        data: formData,
        success: function(result){alert(result);},
        failure: function(err){alert(err);},
        cache: false,
        contentType: false,
        processData: false
        
      });
      return(false);
    });
  });
      
</script>
</head>
<body>

<?php 
     
     // Display message about account verification link only once
     if ( isset($_SESSION['message']) )
     {
         echo $_SESSION['message'];
         
         // Don't annoy the user with more messages upon page refresh
         unset( $_SESSION['message'] );
     }
     
     ?>
     
     
     <?php
     
     // Keep reminding the user this account is not active, until they activate
     if ( !$active ){
         header("location: ../login2/index.php");
   exit();
     }
     
     ?>

  <?php include("nav.php"); ?>
<div class="container">

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
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              } 


               // $sql = "SELECT * FROM candidate WHERE sno='1'";
              // $sql = "SELECT basicinformation.DOB, candidate.mobileno FROM basicinformation INNER JOIN candidate ON basicinformation.sno = candidate.sno;";
             $sql = "SELECT basicinformation.DOB, basicinformation.MaritalStatus, basicinformation.Address, basicinformation.Religion , basicinformation.Nationality, basicinformation.LanguageKnown, basicinformation.CurrentDesignation,basicinformation.CurrentLocation, basicinformation.FatherName, basicinformation.NoticePeriod, basicinformation.PreferredLocation, basicinformation.ExpectedSalary, basicinformation.gender,basicinformation.MaritalStatus,  candidate.fname, candidate.lname, candidate.emailid, candidate.mobileno, candidate.mobileno, candidate.years, candidate.months FROM basicinformation INNER JOIN candidate ON basicinformation.sno = candidate.sno;";
              $result = $conn->query($sql);
              // $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
              // echo " <table class='table table-bordered' ><tr><th>First Name</th> <th>Last Name</th> <th> Email Id</td> <th> Mobile No</th> <th> Qualification</th></tr>";
              while($row = $result->fetch_assoc()) {
                  echo "<div class='row' >
                            
                            <h3 align ='center' style='background-color: #d1e2ff;'>Personal Information</h3>
                            <div class='col-md-12' >
                              <div class='col-md-4' style='margin-top:20px; margin-bottom: 20px'>
                              <table >
                              <tr>
                                <td><strong>First Name:</strong></td><td> " . $row["fname"]. " ". $row["lname"]."</td></tr>
                                <td><strong>Father Name:</strong></td><td> " . $row["FatherName"]."</td></tr>
                                <td><strong>DOB:</strong></td><td>". $row["DOB"]."</td></tr>
                                <td><strong>Gender:</strong></td><td>" . $row["mobileno"]."</td></tr>
                                <td><strong>Matrial:</strong></td><td>" . $row["MaritalStatus"]."</td></tr>
                                <td><strong>Mobile No:</strong></td><td> " . $row["mobileno"]."</td></tr>
                                <td><strong>Email:</strong> </td><td>" . $row["emailid"]."</td></tr>
                                <td><strong>Address:</strong></td><td>" . $row["Address"]."</td></tr>
                                <td><strong>Religion:</strong></td><td>" . $row["Religion"]."</td>
                              </tr>
                                </table>
                              </div>
                              <div class='col-md-4' style='margin-left: 100px; margin-top:20px; margin-bottom: 20px'>
                              <table>
                              <tr>
                                <td><strong>Nationality:</strong></td><td>" . $row["Nationality"]."<td></tr>
                                <td><strong>Language Known:</strong></td><td>" . $row["LanguageKnown"]."</td></tr>
                                <td><strong>Current Designation:</strong></td><td>" . $row["CurrentDesignation"]."</td></tr>
                                <td><strong>Current Location:</strong></td><td>" . $row["CurrentLocation"]."</td></tr>
                                <td><strong>Preferred Location:</strong></td><td>" . $row["PreferredLocation"]."</td></tr>
                                <td><strong>Total Experience:</strong></td><td> " . $row["years"]. ".". $row["months"]." Years</tr>
                                <td><strong>Notice Period:</strong</td><td>" . $row["NoticePeriod"]." Month</td></tr>
                                <td><strong>Expected Salary:</strong></td><td>" . $row["ExpectedSalary"]."</td></tr>
                                </table>
                            </div>
                            <div class='col-md-2' style='margin-top:20px; margin-left: 90px; margin-bottom: 20px' >
                            <form id='theForm' action='p' method='post' enctype='multipart/form-data'>
                              <input type='file' name='fileToUpload' id='fileToUpload'>
                              <input type='submit' value='Upload Image' name='submit' class='au-btn au-btn-icon au-btn--green'>
                            </form>
                            <a href='#' class='btn btn-info' style='margin-top: 20px; width: 70%' id='personal'> EDIT Profile</a>
                        </div>" ;
              }
          } else {
              echo "</table>";
          }
          $conn->close();
          ?>
                   
    </div>


        <!-- The Modal -->

    <div class="col-md-12" style="margin-top: 20px; ">
      <h3 align="center" style=" background-color: #d1e2ff; margin-top:  20px;">Educational & Professional Qualification</h3>
      <?php
      
      ?>
      <table class="table table-hover">
        <tr>
          <th>Qualification Level</th>
          <th>Course/Program</th>
          <th>Specialization</th>
          <th>Name of Board/University</th>
          <th>Year of Passing</th>
          <th>Location</th>
          <th>% of Marks Obtained</th>
        </tr>
        <script>
            $(document).ready(function(){
              $("#delete1").click(function(){
                  $("#10").hide();
                  $("#delete1").hide();
                  $("#edit1").hide();
              });
            });
         </script>
        <tr>
          <th id="10">10</th>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>
              <button id="edit1" class="btn btn-warning">Edit</button>
              <button id="delete1" class="btn btn-danger">Delete</button>
          </td>
        </tr>
        <script>
            $(document).ready(function(){
              $("#delete2").click(function(){
                  $("#12").hide();
                  $("#delet2").hide();
                   $("#edit2").hide();
              });
            });
         </script>
        <tr id="12">
          <th>12</th>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>
              <button id="edit2" class="btn btn-warning">Edit</button>
              <button id="delete2" class="btn btn-danger">Delete</button>
          </td>
        </tr>
        <script>
            $(document).ready(function(){
              $("#delete3").click(function(){
                  $("#gr").hide();
                  $("#delet3").hide();
                   $("#edit3").hide();
              });
            });
         </script>
        <tr id ="gr">
          <th>Graduation</th>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>
             <button id="edit3" class=" flip btn btn-warning">Edit</button>
              <button id="delete3" class="btn btn-danger">Delete</button>
          </td>
        </tr>
        <tr>
          <script>
            $(document).ready(function(){
              $("#delete4").click(function(){
                  $("#delete4").hide();
                  $("#edit4").hide();
                  $("#post").hide();
              });
            });
         </script>
          <th id ="post">Postgraduation</th>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>
              <button id="edit4" class="btn btn-warning">Edit</button>
              <button id="delete4" class="btn btn-danger">Delete</button>
          </td>
        </tr>
      </table>
     
      <button type="button" class="flip btn btn-success" onclick="myFunction()" style="margin-bottom: 20px;">Add</button>
      <div id="panel" style="margin-bottom: 20px;">
        <span id='close' onclick='this.parentNode.parentNode.parentNode.removeChild(this.childNode.childNode); return false;'>x</span>
        <form action="welcome.php" method ="get">
          <table style=" border-collapse:separate; border-spacing:10px;">
              <tr style="padding-top:20px; ">
                <td><label>Quallifaction:</label></td>
                <td>
                  <input list="qualifactions" name="browser">
                  <datalist id="qualifactions">
                    <option value="Schooling">
                    <option value="Graduation">
                    <option value="Diploma">
                    <option value="Post Graduate or Equivalent">
                    <option value="PhD/MPhil or Equivalent">
                    <option value="Other">
                  </datalist>
                </td>
                <td><label>Course/Program:</label></td>
                <td>
                    <input list="cources" name="cource">
                    <datalist id="cources">
                      <option value="Below 10th">
                      <option value="10th">
                      <option value="12th">
                      <option value="B.A">
                      <option value="B.Arch">
                      <option value="B.B.A/B.M.S">
                      <option value="B.Com">
                      <option value="B.Des">
                      <option value="B.Ed">
                      <option value="B.EI.Ed">
                      <option value="B.P.Ed">
                      <option value="B.Pharma">
                      <option value="B.Sc">
                      <option value="B.Tech/B.E.">
                      <option value="B.U.M.S">
                    </datalist>
                </td>
                <td><label>Specialization:</label></td>
                <td>
                  <input list="specializations" name="specialization">
                    <datalist id="specializations">
                      <option value="Advertising/Mass Communication">
                      <option value="Aerospace Engineering">
                      <option value="Agriculture">
                      <option value="Animation Film Design">
                      <option value="Anthropology">
                      <option value="Apparel Design">
                      <option value="Architecture">
                      <option value="Art History">
                      <option value="Arts & Humanities">
                      <option value="Arts&Humanities">
                      <option value="Astronautical Engineering">
                      <option value="Automobile">
                      <option value="Aviation">
                      <option value="Aviation Medicine/Aerospace Medicine">
                      <option value="Ayurveda">
                    </datalist>
                </td>
              </tr>
            <br>
              <tr style="padding-top:20px; ">
                <td><label>Name of Board/University:</label></td>
                <td>
                  <input list="specializations" name="specialization">
                    <datalist id="specializations">
                      <option value="Advertising/Mass Communication">
                      <option value="Aerospace Engineering">
                      <option value="Agriculture">
                      <option value="Animation Film Design">
                      <option value="Anthropology">
                      <option value="Apparel Design">
                      <option value="Architecture">
                      <option value="Art History">
                      <option value="Arts & Humanities">
                      <option value="Arts&Humanities">
                      <option value="Astronautical Engineering">
                      <option value="Automobile">
                      <option value="Aviation">
                      <option value="Aviation Medicine/Aerospace Medicine">
                      <option value="Ayurveda">
                    </datalist>
                </td>
                <td><label>Year of Passing:</label></td>
                <td><input type="text" name="qua"></td>
                <td><label>Location:</label></td>
                <td>
                  <input type="text" name="location">

                </td>
            </tr>
            <tr style="padding-top:20px; ">
                <td><label>% of Marks Obtained:</label></td>
                <td><input type="text" name="qua"></td>
                <td></td>
                <td><input type="submit" name="submit" value="Update"></td>
            </tr>
          </table>
          </form>
        </div>

        <script>
        function myFunction() {
            document.getElementById("panel").style.display = "block";
        }
        </script>
      </div>
    </div>

    <div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px;" >
      <h3 align="center" style=" background-color:#d1e2ff;">Employment History</h3>
      <table class="table table-hover">
        <tr>
          <th>Company Name 1</th>
          <th>Industry</th>
          <th>Function</th>
          <th>Position</th>
          <th>Monthly CTC/In hand</th>
          <th>Employement Period<table><tr><td style="width: 70px;">From</td><td style="width: 70px;">To</td></tr></th></table>
          <th>Location</th>
          <th>Reason for Leaving</th>
        </tr>
        <trid="tr5">
          <td>Zapbuild</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td><table><tr><td style="width: 70px;"></td><td style="width: 70px;"></td></tr></th></table></td>
          <td></td>
          <td></td>
        </tr>
        <tr><table><tr>
      <h4 align="center" style="background-color: black; color:white; color: #fff">Role & Responsibilities</h4>
           <p>The demand for better software is growing, and software engineers are becoming more highly sought after than ever before. Software engineer was number one on Mashable’s list of "Hottest Tech Jobs for 2014."" US News also ranked software development as its number one "Best Job of 2014."<br>

          Not surprising, considering that there are currently 4,461 employers hiring for software engineering positions in the U.S. (Mashable).<br>
          The national average salary for software engineers is around $90,374. However engineers in the San Francisco Bay Area typically make upwards of 14% more than that (Glassdoor).<br>

          "More jobs mean more competition amongst companies to hire the best and brightest, so software engineering jobs pay well and often come with great benefits. The flip side of this is that many engineers receive multiple simultaneous offers. Making the right long term career decision can be difficult when evaluating several opportunities." - Alfonso Tiscareno, Vice President, IT.</p></tr>
          </table>
          </tr>
          <tr >
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
             <td><button id="add5" class="btn btn-success">Add</button></td>
            <td><button id="edit5" class="btn btn-warning">Edit</button></td>
            <td><button id="delete5" class="btn btn-danger">Delete</button></td>
         </tr>
         <script>
            $(document).ready(function(){
              $("#delete5").click(function(){
                  $("#delete5").hide();
                  $("#edit5").hide();
                  $("tr5").hide();
                   $("add5").hide();
              });
            });
         </script>
        </table>
      </div>
    <!-- <div class="col-md-12" style="margin-top: 20px; margin-bottom: 30px;">
      <h3 align="center"><a href="#" class="btn-success" style="margin-top: 10px; margin-bottom: 30px;">Save</a></h3>
    </div> -->
  </div>

</div>
<footer style="background-color: #d1e2ff; height: 100px;"></footer>  

<div id="per" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <form method="post" action="">
       <table id="basic" style=" border-collapse:separate; border-spacing:20px;">
        <tr><h3 align="center">Basic Infomation</h3></tr>

        <tr style="padding-top:20px; ">
           <th><lable>Father Name:</lable></th>
          <td><input type="text" name="fname"style="width:100%;"></td>
          <th><lable>D.O.B</lable></th>
          <td><input type="date" name="dob"  style="width:100%;"></td>
        </tr>

         <tr style="padding-top:20px; ">
          <th><lable>Gender</lable></th>
           <td> <input type="radio" name="male" value="male" checked> Male
           <input type="radio" name="female" value="female"> Female</td>
          <th><lable>Matrical</lable></th>
           <td> <input type="radio" name="matrical" value="Married" checked> Married
           <input type="radio" name="matrical" value="female"> Unmarried</td>
        </tr>

         <tr style="padding-top:20px; ">
          
          <th><lable>Language Known</lable></th>
          <td width="100%"><input type="checkbox" name="language" value="Hindi"> Hindi
          <input type="checkbox" name="language" value="English"> English 
          <input type="checkbox" name="language" value="Punjabi"> Punjabi
          <input type="checkbox" name="language" value="Other"> Other </td>
        </tr> 

       

         <tr style="padding-top:20px; ">
           <th><lable>Nationality:</lable></th>
          <td><input type="text" name="nationality"style="width:100%;"></td>
          <th><lable>Religion</lable></th>
          <td><input type="text" name="relign"  style="width:100%;"></td>
        </tr>

        <tr>
          <th><lable>Address:</lable></th>
          <td><input type="text" name="address"style="width:100%;"></td>
          <th><lable>Current Address:</lable></th>
          <td><input type="text" name="caddress"style="width:100%;"></td>
        </tr>

        <tr style="padding-top:20px; ">
          <th><lable>Preferred Location:</lable></th>
          <td><input type="text" name="plocation" style="width:100%;"></td>
           <th><lable>Mobile</lable></th>
          <td><input type="number" name="Mobile"style="width:100%;"></td> 
        </tr>

       

        <tr style="padding-top:10px; ">
          <th><lable>Notice Period:</lable></th>
          <td><input type="text" name="notice"style="width:100%;"></td>
          <th><lable>Expected Salary:</lable></th>
          <td><input type="number" name="salary"  style="width:100%;"></td>
        </tr>

         <tr style="padding-top:10px; ">
           <th><lable>Total Experience:</lable></th>
          <td><input type="text" name="fname" style="width:100%;"></td>
          <td></td> 
          <td style="padding-left:170px; ">
          <input type="submit" name="update" value="Update" class="btn btn-info" >
          </td>
        </tr>
        
      </table>
    </form>
  </div>
      <script>
    // Get the modal
    var modal = document.getElementById('per');

    // Get the button that opens the modal
    var btn = document.getElementById("personal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>

   <?php
//   if($_SERVER['SERVER_NAME']=='localhost')
//   {
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "dbase2";
//   }
//   else if($_SERVER['SERVER_NAME']=='cogentsol.in')
//   {
//     $servername = "sun";
//     $username = "cogentso_root";
//     $password = "rootPWD@#";
//     $dbname = "cogentso_dbase2";
//   }
//     // Create connection
//     $conn = new mysqli($servername, $username, $password, $dbname);
//     // Check connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     } 

 
// $fname = $_POST["fname"];
// $dob=$_POST['dob'];
// $gender=$_POST['gender'];
// $matrical=$_POST['matrical'];
// $designation=$_POST['designation'];
// $clocation=$_POST['clocation'];
// $address=$_POST['address'];
// $relign=$_POST['relign'];
// $nationality = $_POST["nationality"];
// $language=$_POST['language'];
// $plocation=$_POST['plocation'];
// $notice=$_POST['notice'];
// $salary=$_POST['salary'];


// $sql = "INSERT INTO `basicinformation` (`FatherName`, `DOB`, `Gender`, `MaritalStatus`, `CurrentDesignation`, `CurrentLocation`, `Address`, `Religion`, `Nationality`, `LanguageKnown`, `PreferredLocation`, `NoticePeriod`, `ExpectedSalary` ) VALUES ('$fname', '$dob', '$gender', '$matrical', '$designation','$address', '$relign', '$nationality', '$plocation', '$language' '$notice', '$salary' )";
  
// if ($conn->query($sql) === TRUE) {
//     echo "value added to database";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// } 
    
// // the message
// $msg = "Hi ".$fname1.",\nThanks for contacting us.\n\nWe will surely get back to you.";

// // use wordwrap() if lines are longer than 70 characters
// $msg = wordwrap($msg,70);

// // send email
// mail($email1,"Thanks for contacting us",$msg);


// $conn->close();
?>
  </footer>
</body>
</html> 