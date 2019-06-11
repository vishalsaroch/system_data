<?php
	$email=$_POST['email'];
	$subject=$_POST["subject"];
	$body=$_POST["body"];

	$header = "MIME-Version:1.0"."\r\n";
	$header = "Content-type:text/html;charset=UTF-8"."\r\n";
	$header = "from: we.realkeeper@gmail.com"."\r\n".
	"CC:vishalshara.logic@gmail.com";
	if(mail($email,$subject,$body, $header)){
		echo"<h1>Email send</h1>";
	}else{
		echo"<h1>email cannot send</h1>";
	}
?>