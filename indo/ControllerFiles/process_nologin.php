<?php
echo '
	<noscript>
	    <style type="text/css">
	         .process{display:none;}
	         .noscriptmsg {min-width: 300px ;margin: 200px auto;}
	    </style>
	    <div class="noscriptmsg font-red">
	    	<center>
	    		<b>
	    			<br>You don\'t have javascript enabled, Please enable to Use and then re-submit your form<br>
	    			Here are the <a href="http://www.enable-javascript.com/" target="_blank"> instructions how to enable it</a>
    			</b>
    		</center>
	    </div>
	</noscript>
	<script>
		window.history.pushState("", "Validating data by shoppo-hash-validation...", "/shoppo-hash/validation.html");
	</script>
	<div class="process">
	<center><img style="margin:auto" src="/assets/images/loader.svg" alt="Validating ..."><br><br>Validating ...</center>
	<div style="display:nne;">
';
$process  = $_POST['process'];
unset($_POST['process']);
$referer = isset($_SERVER['HTTP_REFERER']) ? htmlentities($_SERVER['HTTP_REFERER']) : '/';
if(isset($_POST['referer'])){
	$referer = htmlentities($_POST['referer']);
	unset($_POST['referer']);
}

if ($process  == 'login') {	////  Username verify Process ////
	$username = filter_data($_POST['username']);
	$password = filter_data($_POST['password']);
    if (strlen($password) != 128) {
    	$function->setMessage(array("danger", "Invalid Username or Password"));
    	echo "<script>window.location = '$referer?Error'</script>";
        header("Location: $referer?Error");
        exit;
    } else if ($function->user__Login($username, $password) === true) {
    	echo "<script>window.location = '/home?Successful'</script>";
        header("Location: /home?Successful");
        exit;
    } else {
    	echo "<script>window.location = '$referer?Error'</script>";
        header("Location: $referer?Error");
        exit;
    }
} else if ($process  == 'forgot') {					       ////  Forgot Process ////
	if (IS_FORGOT_CAPTCHA && (hash('sha512', $_POST['captcha']) != $_SESSION['captcha_code'])) {
		$_SESSION['FORM'] = $_POST;
    	$function->setMessage(array('danger', 'Error!!! * Invalid captcha entered *'));
    	echo '<script>window.location = "/login?Error"</script>';
    	header('Location: /login?Error');
    	exit;
	}

	$username = filter_data($_POST['username']);
	if ($row = $function->confirmUser($username)) {
		$userId = $row['user'];
		$mobile = $row['username'];
		if ($row['status'] < 1){
        	$function->setMessage(array('danger', 'Account De-activated, write us at <b><a href="mailto:'.CLIENT_EMAIL.'">'.CLIENT_EMAIL.'</a></b>'));
    		echo '<script>window.location = "/login?Error"</script>';
    		header('Location: /login?Error');
    		exit;
        }else{
        	require_once '../plogs/sms_api_100.php';
			if ($pass = sendForgotSMS($mobile)) {
				if ($function->updatePass($userId, $pass)) {
					$function->setMessage(array('success', 'Password reset details successfully sent to your registered mobile'));
					echo '<script>window.location = "/login?Success"</script>';
            		header('Location: /login?Success');
            		exit;
				}
			}
			$function->setMessage(array('danger', 'Unable to reset password, Please try later <small>(Ignore if any SMS sent)</small>'));
			echo '<script>window.location = "/login?Error"</script>';
    		header('Location: /login?Error');
    		exit;
        }
	}
	$function->setMessage(array('danger', 'Error!!! * Invalid username Entered *'));
	echo '<script>window.location = "/login?Error"</script>';
	header('Location: /login?Error');
	exit;
} else if ($process  == 'api') {					       ////  Forgot Process ////
	$complaint = filter_data($_POST['complaint']);
	if ($row = $function->confirmUser($username)) {
		$userId = $row['user'];
		$mobile = $row['username'];
		if ($row['status'] < 1){
        	$function->setMessage(array('danger', 'Account De-activated, write us at <b><a href="mailto:'.CLIENT_EMAIL.'">'.CLIENT_EMAIL.'</a></b>'));
    		echo '<script>window.location = "/login?Error"</script>';
    		header('Location: /login?Error');
    		exit;
        }else{
        	require_once '../plogs/sms_api_100.php';
			if ($pass = sendForgotSMS($mobile)) {
				if ($function->updatePass($userId, $pass)) {
					$function->setMessage(array('success', 'Password reset details successfully sent to your registered mobile'));
					echo '<script>window.location = "/login?Success"</script>';
            		header('Location: /login?Success');
            		exit;
				}
			}
			$function->setMessage(array('danger', 'Unable to reset password, Please try later <small>(Ignore if any SMS sent)</small>'));
			echo '<script>window.location = "/login?Error"</script>';
    		header('Location: /login?Error');
    		exit;
        }
	}
	$function->setMessage(array('danger', 'Error!!! * Invalid username Entered *'));
	echo '<script>window.location = "/login?Error"</script>';
	header('Location: /login?Error');
	exit;
}

echo '<script>window.location = "'.URL.'"</script>';
header('Location: '.URL);
exit;