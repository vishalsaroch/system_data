<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['con'];
$subject = $_POST['message'];
$formcontent="Enquiry Form from Realkeeper.in partner website from contact us\n From: $name \n E-mail:$email \n Phone: $phone \n message: $subject";
$recipient = "info@realkeeper.in";
$Requirements = "Enquiry Form from Realkeeper.in parter website from contact us page";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
echo "Thank You - We'll get back to you soon!";
?>
<a href="http://www.realkeeper.in/">Click Here to Return</a>