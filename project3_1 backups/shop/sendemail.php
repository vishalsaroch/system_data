<?php
$from    =  $_POST['email'];
$to      = 'truelook.in';
$subject = $_POST['subject'];
$message = $_POST['message'];
$headers = array(
    'From' => $from,
    // 'Reply-To' => 'webmaster@example.com',
    'X-Mailer' => 'PHP/' . phpversion()
);

mail($to, $subject, $message, $headers);
?>
 


<a href="index.html">Click Here to Return</a>
