<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['contact'];
$subject = $_POST['my_file'];
$formcontent="Enquiry Form from Realkeeper.in for partner careers \n From: $name \n E-mail:$email \n Phone: $phone \n my_file: $subject";
$recipient = "info@realkeeper.in";
$Requirements = "Enquiry Form from Realkeeper.in for partner careers";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
echo "Thank You - We'll get back to you soon!";
?>
<a href="http://www.realkeeper.in/">Click Here to Return</a>