<?php
session_start();
if ( $_SESSION['admin_login'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location:admin/index.php");  
  exit();
}
else {
    $first_name = $_SESSION['first_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
    echo $email;
  }
?>