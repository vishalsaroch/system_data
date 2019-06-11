<?php
$name = $_POST['FullName'];
$email = $_POST['Email'];
$phone = $_POST['PhoneNumber'];
$subject = $_POST['Requirements'];
$formcontent="Enquiry Form from Realkeeper.in Blow \n From: $name \n E-mail:$email \n Phone: $phone \n Requirements: $subject";
$recipient = "info@realkeeper.in";
$Requirements = "Enquiry Form from Realkeeper.in Blow";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
echo "Thank You - We'll get back to you soon!";
?>
<a href="http://www.realkeeper.in/">Click Here to Return</a>