<?php
function sendForgotSMS($numbers, $otp = false){
	$username = SMS_API_USERNAME;
	$password = SMS_API_PASSWORD;
	$sender = SMS_API_SENDERiD;
	$otp = $otp ? $otp : substr(str_shuffle('1234567890MNBVCXZLKJHGFDSAPOIUYTREWQ'), 3, 4);
	$message = "Dear Indo User,

Your request successfully processed and reseted temporary Password is

$otp

Please login by this and change it soon.";

	$message = urlencode($message);
	$url = "http://bulksms.indiawallmart.com/api/pushsms.php";
	$port = 80;
	$api_url = $url."?username=".urlencode($username)."&password=".urlencode($password)."&sender=". $sender ."&message=". $message."&numbers=".$numbers;

	$ch = curl_init( );
	curl_setopt ( $ch, CURLOPT_URL, $api_url );
	curl_setopt ( $ch, CURLOPT_PORT, $port );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	// Allowing cUrl funtions 20 second to execute
	curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
	// Waiting 20 seconds while trying to connect
	curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );
	$responce = json_decode(curl_exec( $ch ), true);
	$responce['otp'] = $otp;
	curl_close($ch);
	return $responce;
}


function sendRegSMS($numbers, $ref, $otp){
	$username = SMS_API_USERNAME;
	$password = SMS_API_PASSWORD;
	$sender = SMS_API_SENDERiD;
	//$otp = $otp ? $otp : substr(str_shuffle('1234567890MNBVCXZLKJHGFDSAPOIUYTREWQ'), 3, 4);

	$message = "Dear Customer,

Your comp. ref. # $ref. Please share OTP Code $otp with our service team.";

	$message = urlencode($message);
	$url = "http://bulksms.indiawallmart.com/api/pushsms.php";
	$port = 80;
	$api_url = $url."?username=".urlencode($username)."&password=".urlencode($password)."&sender=". $sender ."&message=". $message."&numbers=".$numbers;

	$ch = curl_init( );
	curl_setopt ( $ch, CURLOPT_URL, $api_url );
	curl_setopt ( $ch, CURLOPT_PORT, $port );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	// Allowing cUrl funtions 20 second to execute
	curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
	// Waiting 20 seconds while trying to connect
	curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );
	$responce = json_decode(curl_exec( $ch ), true);
	curl_close($ch);
	return $responce;
}


function sendPartnerSMS($numbers, $ticket, $name, $mobile, $alt_mobile, $address, $issue, $product, $update = false){
	$username = SMS_API_USERNAME;
	$password = SMS_API_PASSWORD;
	$sender = SMS_API_SENDERiD;

	$alt_mobile = $alt_mobile ? "/$alt_mobile" : "";
	$message = "Dear,

".($update ? "Ticket #$ticket details Updated as below" : "Complaint Ticket #$ticket")."
Customer- $name
Phone - $mobile $alt_mobile
Address - $address
Product- $product
Issue - $issue .";

	$message = urlencode($message);
	$url = "http://bulksms.indiawallmart.com/api/pushsms.php";
	$port = 80;
	$api_url = $url."?username=".urlencode($username)."&password=".urlencode($password)."&sender=". $sender ."&message=". $message."&numbers=".$numbers;

	$ch = curl_init( );
	curl_setopt ( $ch, CURLOPT_URL, $api_url );
	curl_setopt ( $ch, CURLOPT_PORT, $port );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	// Allowing cUrl funtions 20 second to execute
	curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
	// Waiting 20 seconds while trying to connect
	curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );
	$responce = json_decode(curl_exec( $ch ), true);
	curl_close($ch);
	return $responce;
}


function sendOrderDeliveredSMS($numbers, $orderId){
	$username = SMS_API_USERNAME;
	$password = SMS_API_PASSWORD;
	$sender = SMS_API_SENDERiD;

	$message = "Dear ".$_SESSION['SESS__name'].",

Your order #".CLIENT_SHORT_NAME.str_pad($orderId, 6, '0', STR_PAD_LEFT)." is successfully delivered,
Thanks for shopping with us.";

	$message = urlencode($message);
	$url = "http://bulksms.indiawallmart.com/api/pushsms.php";
	$port = 80;
	$api_url = $url."?username=".urlencode($username)."&password=".urlencode($password)."&sender=". $sender ."&message=". $message."&numbers=".$numbers;

	$ch = curl_init( );
	curl_setopt ( $ch, CURLOPT_URL, $api_url );
	curl_setopt ( $ch, CURLOPT_PORT, $port );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	// Allowing cUrl funtions 20 second to execute
	curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
	// Waiting 20 seconds while trying to connect
	curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );
	$responce = json_decode(curl_exec( $ch ), true);
	curl_close($ch);
	return $responce;
}