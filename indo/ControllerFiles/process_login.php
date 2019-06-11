<?php

if (!isset($_POST['process']) || !($level = $function->checkLogin())) {
	header('Location: '.LOGIN_URL);
	exit;
}
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
		window.history.pushState("", "Validating data by 100lution-hash-validation...", "/100lution-hash/validation.html");
	</script>
	<div class="process">
	<center><img style="margin-top:200px;" src="/assets/images/loader.svg" alt="Validating ..."></center>
';

$process  = $_POST['process'];
unset($_POST['process']);
$referer = $_SERVER['HTTP_REFERER'] ? htmlentities($_SERVER['HTTP_REFERER']) : URL;

if ($process === 'addProduct') {
    $details = array();
    foreach ($_POST as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
    }
    $details['code'] = strtoupper($details['code']);
    if ($id = $function->registerProduct($details)) {
        echo '<script>window.location = "/products";</script>';
        header('Location: /products');
        exit;
    }else{
        $_SESSION['FORM'] = $details;
        echo '<script>window.location = "/products";</script>';
        header('Location: /products');
        exit;
    }
}elseif ($process  === 'addCenter') {						////  Username verify Process ////
    $details = array();
    foreach ($_POST as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
    }
    if ($id = $function->registerCenter($details)) {
        echo '<script>window.location = "/centers";</script>';
        header('Location: /centers');
        exit;
    }else{
        $_SESSION['FORM'] = $details;
        echo '<script>window.location = "/centers";</script>';
        header('Location: /centers');
        exit;
    }
}elseif ($process  === 'addUser') {                  ////  Register Process ////
    $details = array();
    if (($_POST['cpassword'] != $_POST['password']) || (strlen($_POST['password']) != 128)) {
        $_SESSION['FORM'] = $_POST;
        $_SESSION['MSG'] = array('danger', 'Password and Confirm Password Doesn\'t Matched or Invalid Passwords');
        echo '<script>window.location = "/users-new";</script>';
        header('Location: /users-new');
        exit;
    }
    unset($_POST['cpassword']);
    foreach ($_POST as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
    }
    if ($id = $function->registerUser($details)) {
        include MODEL_DIRECTORY.'/uploads.php';
        $msg1 = uploadFile($_FILES['upload1'], $_SESSION['SESS__user'].'-upload1');
        $msg2 = uploadFile($_FILES['upload2'], $_SESSION['SESS__user'].'-upload2');
        $_SESSION['MSG'][1] .= ' '.$msg1.' '.$msg2;
        echo '<script>window.location = "/users-new";</script>';
        header('Location: /users-new');
        exit;
    }else{
        $_SESSION['FORM'] = $details;
        echo '<script>window.location = "/users-new";</script>';
        header('Location: /users-new');
        exit;
    }
}elseif ($process  === 'addCenterCumUser') {                       ////  Username verify Process ////
    $cenDetails = array();
    $usrDetails = array();
    if (($_POST['cpassword'] != $_POST['password']) || (strlen($_POST['password']) != 128)) {
        $_SESSION['FORM'] = $_POST;
        $_SESSION['MSG'] = array('danger', 'Password and Confirm Password Doesn\'t Matched or Invalid Passwords');
        echo '<script>window.location = "/centers";</script>';
        header('Location: /centers');
        exit;
    }
    unset($_POST['cpassword']);
    $cenDetails['name'] = $usrDetails['name'] = filter_data($_POST['name']);
    if ($_POST['doj']) {
        $cenDetails['doj'] = filter_data($_POST['doj']);
    }
    $cenDetails['code'] = filter_data($_POST['code']);
    $cenDetails['phone1'] = $usrDetails['mobile'] = filter_data($_POST['phone1']);
    $cenDetails['email'] = $usrDetails['email'] = filter_data($_POST['email']);
    $cenDetails['address']  = $usrDetails['address'] = filter_data($_POST['address']);
    $usrDetails['father'] = '';
    $cenDetails['city'] = filter_data($_POST['city']);
    $cenDetails['city_pin'] = filter_data($_POST['city_pin']);
    $usrDetails['password'] = filter_data($_POST['password']);
    $usrDetails['aadhar'] = filter_data($_POST['aadhar']);
    $usrDetails['pan'] = filter_data($_POST['pan']);
    $cenDetails['gstin'] = filter_data($_POST['gstin']);
    if ($id = $function->registerCenterCumUser($cenDetails, $usrDetails)) {
        echo '<script>window.location = "/centers";</script>';
        header('Location: /centers');
        exit;
    }else{
        $_SESSION['FORM'] = $cenDetails;
        echo '<script>window.location = "/centers";</script>';
        header('Location: /centers');
        exit;
    }
}elseif ($process  === 'updateCenterCumUser') {                       ////  Username verify Process ////
    $cenDetails = array();
    $usrDetails = array();
    $cenDetails['phone1'] = $usrDetails['mobile'] = filter_data($_POST['phone1']);
    $cenDetails['phone2'] = filter_data($_POST['phone2']);
    $cenDetails['email'] = $usrDetails['email'] = filter_data($_POST['email']);
    $cenDetails['address']  = $usrDetails['address'] = filter_data($_POST['address']);
    $cenDetails['city'] = filter_data($_POST['city']);
    $cenDetails['city_pin'] = filter_data($_POST['city_pin']);
    $usrDetails['address'] = $usrDetails['address'].', '.$cenDetails['city'].', '.$cenDetails['city_pin'];
    $usrDetails['aadhar'] = filter_data($_POST['aadhar']);
    $usrDetails['pan'] = filter_data($_POST['pan']);
    $cenDetails['gstin'] = filter_data($_POST['gstin']);
    if ($id = $function->updateData_centerCumUser($cenDetails, $usrDetails)) {
        echo '<script>window.location = "/profile";</script>';
        header('Location: /profile');
        exit;
    }else{
        $_SESSION['FORM'] = $cenDetails;
        echo '<script>window.location = "/profile";</script>';
        header('Location: /profile');
        exit;
    }
}elseif ($process  === 'udatePassword') {                   ////  Forgot Process ////
    if (($_POST['password'] != $_POST['cpassword']) || (strlen($_POST['cpassword']) != 128)) {
        $_SESSION['MSG'] = array("danger", "Invalid New Passwords");
        echo '<script>window.location = "/profile/edit"</script>';
        header('Location: /profile/edit');
        exit;
    }elseif (strlen($_POST['opassword']) != 128) {
        $_SESSION['MSG'] = array("danger", "Invalid Current Password");
        echo '<script>window.location = "/profile/edit"</script>';
        header('Location: /profile/edit');
        exit;
    }
    $password = filter_data($_POST['password']);
    $opassword = filter_data($_POST['opassword']);
    if ($function->updateData_userPassword($password, $opassword) === true) {
        echo '<script>window.location = "/profile"</script>';
        header('Location: /profile');
        exit;
    } else {
        echo '<script>window.location = "/profile/edit"</script>';
        header('Location: /profile/edit');
        exit;
    }
}elseif ($process  === 'updateUser') {                      ////  Forgot Process ////
    $name = filter_data($_POST['name']);
    $mobile = filter_data($_POST['mobile']);
    $email = filter_data($_POST['email']);
    if ($function->updateData_userPersonal($name, $mobile, $email) === true) {
        echo '<script>window.location = "/profile"</script>';
        header('Location: /profile');
        exit;
    } else {
        echo '<script>window.location = "/profile/edit"</script>';
        header('Location: /profile/edit');
        exit;
    }
}
echo '<script>window.location = "'.$referer.'"</script>';
header('Location: '.$referer);
exit;