<?php
session_start();
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location:user-login/index.php");  
  exit();
}
else {
    $first_name = $_SESSION['first_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
  }
?>