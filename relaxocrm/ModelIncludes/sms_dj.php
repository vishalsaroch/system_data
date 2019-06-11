<?php
function sendSMS($numbers, $message, $senderId2 = false, $api = "kit19"){
	$sender = SMS_API_SENDERiD;
	// $api = ($api) ? api : SMS_API;
	$username = SMS_API_USERNAME;
	$password = SMS_API_PASSWORD;
	$port = 80;

	if ($api == "kit19") {
		$api_url = "http://www.kit19.com/ComposeSMS.aspx?username=".rawurlencode($username)."&password=".rawurlencode($password)."&sender=". $sender ."&to=".rawurlencode($numbers)."&message=". rawurlencode($message)."&priority=1&dnd=1&unicode=0";
		$pattern = "/http...([0-9a-zA-Z-.]*).([0-9]*).(.*)/";
	    preg_match($pattern,$api_url,$args);
	    $in = "";
	    $fp = fsockopen($args[1],80, $errno, $errstr, 30);
	    if (!$fp) {
	       return("$errstr ($errno)");
	    } else {
		    $args[3] = "C".$args[3];
	        $out = "GET /$args[3] HTTP/1.1\r\n";
	        $out .= "Host: $args[1]:$args[2]\r\n";
	        $out .= "User-agent: PARSHWA WEB SOLUTIONS\r\n";
	        $out .= "Accept: */*\r\n";
	        $out .= "Connection: Close\r\n\r\n";

	        fwrite($fp, $out);
	        while (!feof($fp)) {
	           $in.=fgets($fp, 128);
	        }
	    }
	    fclose($fp);
	    return($in);
	}else{
		$api_url = "http://bulksms.indiawallmart.com/api/pushsms.php?username=".urlencode($username)."&password=".urlencode($password)."&sender=". $sender ."&message=". urlencode($message)."&numbers=".urlencode($numbers);
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
}

function sendSMS_byIndiawallmart($numbers, $message, $senderId = false, $api = 0){
	$sender = ($senderId == "Oxaler") ? SMS_API_SENDERiD2 : SMS_API_SENDERiD;
	$username = SMS_API_USERNAME;
	$password = SMS_API_PASSWORD;
	$message = urlencode($message);
	$port = 80;

	if ($api) {
		$api_url = "http://www.kit19.com/ComposeSMS.aspx?username=".urlencode($username)."&password=".urlencode($password)."&sender=". $sender ."&to=".$numbers."&message=". $message."&priority=1&dnd=1&unicode=0";
	}else{
		$api_url = "http://bulksms.indiawallmart.com/api/pushsms.php?username=".urlencode($username)."&password=".urlencode($password)."&sender=". $sender ."&message=". $message."&numbers=".$numbers;
	}

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