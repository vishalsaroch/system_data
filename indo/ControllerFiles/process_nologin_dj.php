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
	<center><img style="margin:auto" src="/assets/images/loader.gif" alt="Validating ..."><br><br>Validating ...</center>
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
    if (! (filter_var($username, FILTER_VALIDATE_EMAIL) || ($username < 9999999987 && $username > 7000000012))) {
    	$function->setMessage(array("danger", "Invalid Username or Password"));
    	$_SESSION['MODAL'] = "#loginModal";
    	echo "<script>window.location = '$referer'</script>";
    	header("Location: $referer");
    	exit;
    } else if (strlen($password) != 128) {
    	$function->setMessage(array("danger", "Invalid Username or Password"));
    	$_SESSION['MODAL'] = "#loginModal";
    	echo "<script>window.location = '$referer'</script>";
        header("Location: $referer");
        exit;
    } else if ($function->user__Login($username, $password) === true) {
    	if ($_SESSION['SESS__azz_level'] == 1) {
    		echo "<script>window.location = '$referer?Successful'</script>";
	        header("Location: $referer?Successful");
	        exit;
    	}else if ($_SESSION['SESS__azz_level'] > 1) {
    		echo "<script>window.location = '/shoppo-admin?Successful'</script>";
    		header("Location: /shoppo-admin?Successful");
    		exit;
    	}
    } else {
    	$_SESSION['MODAL'] = "#loginModal";
    	echo "<script>window.location = '$referer'</script>";
        header("Location: $referer");
        exit;
    }
} else if ($process  == 'registerVendor') {				   ////  Register Process ////
	if (IS_REGISTER_CAPTCHA && (hash('sha512', $_POST['captcha']) != $_SESSION['captcha_code'])) {
		unset($_SESSION['captcha_code']);
		$_SESSION['FORM'] = $_POST;
    	$function->setMessage(array('danger', 'Error!!! * Invalid captcha entered *'));
    	echo '<script>window.location = "/login/vendor?Error"</script>';
    	header('Location: /login/vendor?Error');
    	exit;
	}
	unset($_POST['cpassword']);
	$_POST['name'] = ucwords(strtolower(filter_data($_POST['name'])));
	$_POST['mobile'] = filter_data($_POST['mobile']);
	$_POST['email'] = filter_data($_POST['email']);
	$_POST['password'] = filter_data($_POST['password']);
	$centerData = $_POST['shop'];
	unset($_POST['shop']);
	foreach ($centerData as $key => $value) {
		$centerData[filter_data($key)] = filter_data($value);
	}
    if ($function->center_Register($_POST, $centerData, 4)) {
    	$function->user__Login($_POST['mobile'], $_POST['password']);
    	echo "<script>window.location = '/shoppo-admin?Successful'</script>";
    	header('Location: /shoppo-admin?Successful');
    	exit;
	}else{
		$_POST['fname'] = $fname;
		$_POST['lname'] = $lname;
		$_POST['shop'] = $centerData;
		unset($_POST['password']);
		$_SESSION['FORM'] = $_POST;
    	echo '<script>window.location = "/login/vendor?Error"</script>';
    	header('Location: /login/vendor?Error');
    	exit;
	}
} else if ($process  == 'registerUser') {				   ////  Register Process ////
	if (IS_REGISTER_CAPTCHA && (hash('sha512', $_POST['captcha']) != $_SESSION['captcha_code'])) {
		unset($_SESSION['captcha_code']);
		$_SESSION['FORM'] = $_POST;
    	$function->setMessage(array('danger', 'Error!!! * Invalid captcha entered *'));
    	echo "<script>window.location = '$referer?Error'</script>";
    	header("Location: $referer?Error");
    	exit;
	}
	$name = filter_data($_POST['name']);
	unset($_POST['cpassword']);
	$_POST['name'] = ucwords(strtolower($name));
	$_POST['mobile'] = filter_data($_POST['mobile']);
	$_POST['email'] = filter_data($_POST['email']);
	$_POST['password'] = filter_data($_POST['password']);

    if ($function->user_Register($_POST, 1)) {
    	$function->user__Login($_POST['mobile'], $_POST['password']);
    	echo "<script>window.location = '$referer?Successful'</script>";
    	header("Location: $referer?Successful");
    	exit;
	}else{
		unset($_POST['password']);
		$_SESSION['FORM'] = $_POST;
    	echo "<script>window.location = '$referer?Error'</script>";
    	header("Location: $referer?Error");
    	exit;
	}
} else if ($process  == 'contact') {					   ////  Contact Process ////
	if (IS_CONTACT_CAPTCHA && (hash('sha512', $_POST['captcha']) != $_SESSION['captcha_code'])) {
		unset($_SESSION['captcha_code']);
		$_SESSION['FORM'] = $_POST;
    	$function->setMessage(array('danger', 'Error!!! * Invalid captcha entered *'));
    	echo '<script>window.location = "/contact-us?Error"</script>';
    	header('Location: /contact-us?Error');
    	exit;
	}
	$_POST['name'] = ucwords(strtolower(filter_data($_POST['name'])));
	$_POST['phone'] = (int) filter_data($_POST['phone']);
	$_POST['email'] = filter_data($_POST['email']);
	$_POST['subject'] = ucfirst(strtolower(filter_data($_POST['subject'])));
	$_POST['message'] = filter_data($_POST['message']);

	if ($function->query_register($_POST)) {
		require_once MODEL_DIRECTORY.'/mail_dj.php';
		sendContactMail($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['subject'], $_POST['message']);
    	echo '<script>window.location = "/contact-us?Success"</script>';
    	header('Location: /contact-us?Success');
    	exit;
	}else{
		$_SESSION['FORM'] = $_POST;
    	echo '<script>window.location = "/contact-us?Error"</script>';
    	header('Location: /contact-us?Error');
    	exit;
	}
} else if ($process  == 'forgot') {					       ////  Forgot Process ////
	if (IS_FORGOT_CAPTCHA && (hash('sha512', $_POST['captcha']) != $_SESSION['captcha_code'])) {
		$_SESSION['FORM'] = $_POST;
    	$function->setMessage(array('danger', 'Error!!! * Invalid captcha entered *'));
    	echo "<script>window.location = '$referer?Error'</script>";
    	header("Location: $referer?Error");
    	exit;
	}

	$username = filter_data($_POST['username']);
	if ($row = $function->confirmUser($username)) {
		$userId = $row['user'];
		$mobile = $row['username'];
		if ($row['status'] < 1){
        	$function->setMessage(array('danger', 'Account De-activated, write us at <b><a href="mailto:'.CLIENT_EMAIL.'">'.CLIENT_EMAIL.'</a></b>'));
    		echo "<script>window.location = '$referer?Error'</script>";
    		header("Location: $referer?Error");
    		exit;
        }else{
        	require_once '../plogs/sms_api_100.php';
			if ($pass = sendForgotSMS($mobile)) {
				if ($function->updatePass($userId, $pass)) {
					$function->setMessage(array('success', 'Password reset details successfully sent to your registered mobile'));
					echo "<script>window.location = '$referer?Success'</script>";
            		header("Location: $referer?Success");
            		exit;
				}
			}
			$function->setMessage(array('danger', 'Unable to reset password, Please try later <small>(Ignore if any SMS sent)</small>'));
			echo "<script>window.location = '$referer?Error'</script>";
    		header("Location: $referer?Error");
    		exit;
        }
	}
	$function->setMessage(array('danger', 'Error!!! * Invalid username Entered *'));
	echo "<script>window.location = '$referer?Error'</script>";
	header("Location: $referer?Error");
	exit;
}
echo '<script>window.location = "'.URL.'"</script>';
header('Location: '.URL);
exit;