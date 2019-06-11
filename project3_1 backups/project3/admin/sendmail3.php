<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];
$filename = $_FILES["file45"]["name"];

if($_SERVER['SERVER_NAME']=='localhost')
	{
		$target_dir = "./uploads/";
	}
	else if($_SERVER['SERVER_NAME']=='www.arkglobalholidays.co.in')
	{
		$target_dir = "/home/arkglobalholidays/public_html/admin/uploads/";
	}

$target_file = $target_dir . basename($_FILES["file45"]["name"]);

$uploadOk = 1;

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.arkglobalholidays.co.in';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'arkadmin@arkglobalholidays.co.in';                 // SMTP username
    $mail->Password = 'testpwd1@2';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
	
	//Recipients
    $mail->setFrom('iamnakulsuryan@gmail.com', 'Nakul');
    $mail->addAddress($email, $name);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('Trip.pdf');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
    if (move_uploaded_file($_FILES["file45"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file45"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.".$_FILES["45"]["error"];
    }}
	$mail->addAttachment('./uploads/'.$_FILES["file45"]["name"]);
	
	
    //Content
	$body = $message;
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}