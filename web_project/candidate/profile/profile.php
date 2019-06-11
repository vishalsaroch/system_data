<?php
/* Displays user information and some useful messages */
session_start();
// echo session_id();
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in2'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: ../../login2/index.php");  
  exit();
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
     echo $email;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <link rel="icon" href="images/ashwani.png" type="image/png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" type="text/css" href="profile.css" > -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <style type="text/css">
    .close{
      color: white;
    }
    .modal-header{
      background-color: gray;
    }
     /*input{
      width: 90%;
      margin-top:20px;
      
      padding: 10px;
    }
*/
    form{
      align-content: center;
    }

    .modal-header{
      color: white;
      background-color:silver;
    }
    th{
      background-color: black;
      color:white;
    }
    .close{
      background-color: white;
    }

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
         header("location:../../login2/index.php");
   exit();
     }
     
?>
     <?php
      if($_SERVER['SERVER_NAME']=='localhost'){
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "dbase2";
            }
            else if($_SERVER['SERVER_NAME']=='cogentsol.in'){
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
      ?>

  <?php include("nav.php"); ?>
    <div class="container">
      <div class="row" style="background-color: #0adcba; padding:10px;">
          <div class="col-lg-10">
          <?php
        if(isset($_POST['submit'])){
            
            $images = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
            $sql = "UPDATE `candidate` SET `image`='".$images."' WHERE `userid`='".$_SESSION['email']."';";

            $run = mysqli_query($conn, $sql);
            if ($run) {
              echo "<p>Profile Picture Updated Successfully</p>";
              } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
              }
            }
        ?>
        
        <?php
          $sql = "SELECT * from candidate where candidate.emailid = '".$_SESSION['email']."';";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  echo "<strong style='text-transform: uppercase;'> " . $row["fname"]. " " . $row["lname"]. "</strong><br>
                  <p> " . $row["qualification"]. "</p>
                  <p> " . $row["jobtitle"]. "</p><p> " . $row["emailid"]. "</p>
                  
                  <p> " . $row["years"]. "." . $row["months"]. " year</p>
                   " . $row["mobileno"]. "
                  ";
                }
          } else {
              echo "0 results";
          }
        ?>
          </div>
          <div class="col-lg-2">
            <?php
              $sql = "SELECT * from candidate where candidate.emailid = '".$_SESSION['email']."';";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  echo "<img src='data:image/jpeg;base64,".base64_encode($row["image"])."' height='150' width='150'/ data-toggle='modal' data-target='#myModal'>";
                  }
              } else {
                  echo "<imgsrc='images/headshot-male.png'height='150' width='150'>";
              }
            ?>
          </div>
      </div>
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-body" style=" width: 30vw;">
              <div class="row">
                <div class="col-md-11" > <output id="list"></output></div>
                <div class="col-md-1" style="margin-top: 50px; ">
                  <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" id="fileToUpload"  value="Choose" style="color:#fff">
                    <input type="submit" value="Upload Image" name="submit" class="au-btn au-btn-icon au-btn--green">
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

          <div class="col-lg-12">
            <?php
              include("basicinfo.php"); 
            ?> 
          </div> 
        </div>
      </div>
  
      
          <div class="col-lg-12">
            <?php 
             include("qualification.php"); 
            ?>    
          </div>
       
          <div class="col-lg-12">
            <?php 
               include("history.php");   
             ?> 
          </div>
        
</body>
</html> 