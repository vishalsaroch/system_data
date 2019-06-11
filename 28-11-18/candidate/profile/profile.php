<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
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
      else if(location.hostname=='www.arkglobalholidays.co.in')
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
         header("location:../../login2/index.php");
   exit();
     }
     
     ?>

  <?php include("nav.php"); ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <?php include("basicinfo.php"); ?>    
        </div>
      </div>
    </div>
      <div class="container">
      <div class="row">
        <div class="col-lg-12">
           <?php include("qualification.php"); ?>    
        </div>
      </div>
    </div>
      <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <?php include("history.php"); ?> 
        </div>
      </div>
    </div>
</body>
</html> 