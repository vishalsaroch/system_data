<?php
// /* Displays user information and some useful messages */
// session_start();

// // Check if user is logged in using the session variable
// if ( $_SESSION['logged_in'] != 1 ) {
//   $_SESSION['message'] = "You must log in before viewing your profile page!";
//   header("location: ../adminlogin/index.php");  
//   exit();
// }
// else {
//     // Makes it easier to read
//     $first_name = $_SESSION['first_name'];
//     $last_name = $_SESSION['last_name'];
//     $email = $_SESSION['email'];
//     $active = $_SESSION['active'];
// }
?>
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  

  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    h3{
      background-color: black;
      color: white;
    }
    .col-sm-12{
    background: #4CAF50;
    color: white;
    padding: 15px;
    width: 100%;
    height: 400px;
    overflow: scroll;
    border: 1px solid #ccc;
    
  </style>
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
   //   if ( !$active ){
   //       header("location:../adminlogin/index.php");
   // exit();
   //   }
     
     ?> 
  
  <?php include("nav.php"); ?>
  <div class="container-fluid">
    <img src="images/management-banner.jpg" style="height:300px; width: 100%; margin-top: 50px; margin-bottom:50px;">
  </div>
  <?php include("list/employer.php"); ?>
  <?php include("list/candidate.php"); ?>
  <?php include("list/job.php"); ?>
  <?php include("list/contact.php"); ?>
</body>
</html>
