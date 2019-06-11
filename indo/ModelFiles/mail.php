<?php

function sendMail($email, $mobile, $regId){
	$qstrVar = str_shuffle('santoshandtannu');
	$qstr = sha1($qstrVar);
	$qstr = URL.'/account.html?'.$qstr.'='.str_rot13(base64_encode(base64_encode($regId.'==='.$mobile))).'&verify='.$qstrVar;

	$subject = "Account verification at ".CLIENT_TITLE."";
	$message = "
	<html>
	<head>
	<title>".CLIENT_TITLE."</title>
	</head>
	<body>
	<p>This email is to verify your identity on ".URL."!<br><br></p>
	<table>
	<tr>
	<th>Click on link below to verify<br><small>(Please ignore if you have not register)</small></th>
	</tr>
	<tr>
	<td><br><a href='".$qstr."' rel='nofollow'>".$qstr."</a></td>
	</tr>
	</table>
	</body>
	</html>
	";
	$headers  = "MIME-Version: 1.0" . "\r\n"
				. "Content-type:text/html;charset=UTF-8" . "\r\n"
				. 'FROM: '.CLIENT_TITLE.' <'.CONTACT_EMAIL.'>' . "\r\n";
	if (mail($email,$subject,$message,$headers)) {
		return true;
	}else{
		mail($email,$subject,$message,$headers);
	}
}

function sendContactMail($name, $email,$mobile, $subj, $message){
	$subject = "Contact Query from your website ".CLIENT_TITLE;
	$message = "
	<html>
	<head>
	<title>".CLIENT_TITLE."</title>
	</head>
	<body>
	<p>This email is from FliptoEarn ".URL." Contact Form !<br><br></p>
	<table>
	<tr>
	<th>Name: <br></th>
	<td> $name<br></td>
	</tr>
	<tr>
	<th>Subject: <br></th>
	<td> $subj<br></td>
	</tr>
	<tr>
	<th>Mobile: <br></th>
	<td> $mobile<br></td>
	</tr>
	<tr>
	<th>Message: <br></th>
	<td> $message<br></td>
	</tr>
	</table>
	</body>
	</html>
	";
	$headers  = "MIME-Version: 1.0" . "\r\n"
				. "Content-type:text/html;charset=UTF-8" . "\r\n"
				. 'FROM: '.$name.' <'.$email.'>' . "\r\n";
	if (mail(CONTACT_EMAIL,$subject,$message,$headers)) {
		return true;
	}else{
		mail(CONTACT_EMAIL,$subject,$message,$headers);
	}
}

function sendForgotMail($email){
	$pass = substr(str_shuffle('1234567890MNBVCXZLKJHGFDSAPOIUYTREWQ'), 3, 7);
	$subject = CLIENT_TITLE." Password Reset";
	$message = "
	<html>
	<head>
	<title>".CLIENT_TITLE."</title>
	</head>
	<body>
	<p>Your Password successfully reseted on ".URL."!<br><br></p>
	<table>
	<tr>
	<th>Your temporary Password for login is &nbsp; &nbsp; - &nbsp; &nbsp; <i>".$pass."</i><br><small>(Please Change it soon)</small></th>
	</tr>
	<tr>
	<td><br><h2>&nbsp;</h2></td>
	</tr>
	</table>
	</body>
	</html>
	";
	$headers  = "MIME-Version: 1.0" . "\r\n"
				. "Content-type:text/html;charset=UTF-8" . "\r\n"
				. 'FROM: '.CLIENT_TITLE.' <'.CONTACT_EMAIL.'>' . "\r\n";
	if (mail($email,$subject,$message,$headers)) {
		return hash('sha512', $pass);
	}else{
		if (mail($email,$subject,$message,$headers)) {
			return hash('sha512', $pass);
		}
	}
	return false;
}