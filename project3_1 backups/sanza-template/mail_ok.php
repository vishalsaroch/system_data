<?php
$name = $_POST['FreeFullName'];
$email = $_POST['FreeEmail'];
$phone = $_POST['FreePhoneNo'];
// $subject = $_POST['FreeRequirements'];
// $formcontent=" Enquiry Form from Realkeeper.in \n Name: $name \n E-mail :$email \n Phone: $phone \n Requirements: $subject";
$recipient = "ankur@bookkeeperapp.net";
$FreeRequirements = "Enquiry Form from Realkeeper.in";
$mailheader = "From: $email \r\n";
mail($recipient, $mailheader) or die("Error!");
echo "Thank You - We'll get back to you soon!";
?>
<a href="http://www.realkeeper.in/">Click Here to Return</a>