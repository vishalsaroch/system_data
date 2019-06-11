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
	<center><img style="margin-top:200px;" src="/assets/images/loader.gif" alt="Validating ..."></center>
';

$process  = $_POST['process'];
unset($_POST['process']);
$referer = htmlentities($_SERVER['HTTP_REFERER']);

if ($process  === 'deliveryAddress') {						////  Username verify Process ////
    $details = array();
    if ($_POST['deliveryAddress'] == 'new') {
        foreach ($_POST['address'] as $key => $value) {
            $details[filter_data($key)] = filter_data($value);
        }
        $details['address'] = $details['address'].', '.$details['landmark'];
        unset($details['landmark']);
        if (($details['alternate_contact'] < 7000000012) || ($details['alternate_contact'] > 9999999987)) {
        	$_SESSION['MSG'] = array("danger", "You have entered invalid Alternate Contact Number");
            unset($_POST['address']['country'], $_POST['address']['state']);$_SESSION['FORM'] = $_POST;
        	echo '<script>window.location = "/checkout#Error"</script>';
        	header('Location: /checkout#Error');
            exit;
        }elseif ($addressId = $function->insertData_newAddress($details)) {
            $_SESSION['ORDER']['address_id'] = $addressId;
            $_SESSION['alternate_contact'] = $details['alternate_contact'];
            echo '<script>window.location = "/payments"</script>';
            header('Location: /payments');
            exit;
        } else {
            unset($_POST['address']['country'], $_POST['address']['state']);$_SESSION['FORM'] = $_POST;
        	echo '<script>window.location = "/checkout#Error"</script>';
            header('Location: /checkout');
            exit;
        }
    }elseif($_POST['deliveryAddress']){
        $userId = (int) $_SESSION['SESS__user'];
        $addressId = (int) str_replace($_SESSION['SESS__user_id'],"",$_POST['deliveryAddress']);
        if ($contact = $function->validateData_userAddressID($addressId, $userId)) {
            $_SESSION['alternate_contact'] = $contact;
            $_SESSION['ORDER']['address_id'] = $addressId;
            echo '<script>window.location = "/payments"</script>';
            header('Location: /payments');
            exit;
        }else{
            echo '<script>window.location = "/checkout"</script>';
            header('Location: /checkout');
            exit;
        }
    }
}elseif ($process  === 'finalize-order') {                  ////  Register Process ////
    $alternate_contact =
    $_SESSION['ORDER']['method'] = filter_data($_POST['payment_type']);
    if ($_POST['payment_type'] == 'Pay On Delivery') {
        $_SESSION['ORDER']['payment_status'] = 'COD';
        if ($_SESSION['OTP'] != $_POST['otp']) {
            $_SESSION['MSG'] = array('danger', "Invalid OTP Entered");
            echo '<script>window.location = "/payments"</script>';
            header('Location: /payments');
            exit;
        } elseif ($orderId = $function->insertData_userOrder($_SESSION['ORDER'], $_SESSION['CART'])) {
            $orderId  = str_pad($orderId, 6, 0, STR_PAD_LEFT);
            include MODEL_DIRECTORY.'/sms_dj.php';
            $response = sendOrderConfirmation($_SESSION['alternate_contact'], $orderId)['return'];
            if (! $response) {
                sendOrderConfirmation($_SESSION['alternate_contact'], $orderId);
            }
            unset($_SESSION['CART'], $_SESSION['ORDER'], $_SESSION['alternate_contact'], $_SESSION['OTP']);
            $_SESSION['recent_order_id'] = $orderId;
            echo '<script>window.location = "/my-history/successful"</script>';
            header('Location: /my-history/successful');
            exit;
        } else {
            echo '<script>window.location = "/payments"</script>';
            header('Location: /payments');
            exit;
        }
    }else{
        $amount = 0;
        foreach ($_SESSION['CART'] as $product) {
            $amount += $product['totalAmount'];
        }
        $_SESSION['ORDER']['amount'] = $amount;
        echo '<script>window.location = "/wallet-recharge/order"</script>';
        header('Location: /wallet-recharge/order');
        exit;
    }
}elseif ($process  === 'udatePassword') {                   ////  Forgot Process ////
    if (($_POST['password'] != $_POST['cpassword']) || (strlen($_POST['cpassword']) != 128)) {
        $_SESSION['MSG'] = array("danger", "Invalid New Passwords");
        echo '<script>window.location = "/my-password"</script>';
        header('Location: /my-password');
        exit;
    }elseif (strlen($_POST['opassword']) != 128) {
        $_SESSION['MSG'] = array("danger", "Invalid Current Password");
        echo '<script>window.location = "/my-password"</script>';
        header('Location: /my-password');
        exit;
    }
    $password = filter_data($_POST['password']);
    $opassword = filter_data($_POST['opassword']);
    if ($function->updateData_userPassword($password, $opassword) === true) {
        echo '<script>window.location = "/my-password"</script>';
        header('Location: /my-password');
        exit;
    } else {
        echo '<script>window.location = "/my-password"</script>';
        header('Location: /my-password');
        exit;
    }
}elseif ($process  === 'updateUser') {                   ////  Forgot Process ////
    $name = filter_data($_POST['name']);
    $mobile = filter_data($_POST['mobile']);
    $email = filter_data($_POST['email']);
    if ($function->updateData_userPersonal($name, $mobile, $email) === true) {
        echo '<script>window.location = "/my-profile"</script>';
        header('Location: /my-profile');
        exit;
    } else {
        echo '<script>window.location = "/my-profile"</script>';
        header('Location: /my-profile');
        exit;
    }
}else if ($process  == 'contact') {                 ////  Contact Process ////
    if (IS_CONTACT_CAPTCHA && (hash('sha512', $_POST['captcha']) != $_SESSION['captcha_code'])) {
        unset($_SESSION['captcha_code']);
        $_SESSION['FORM'] = $_POST;
        $function->setMessage(array('danger', 'Error!!! * Invalid captcha entered *'));
        echo '<script>window.location = "/contact-us?Error"</script>';
        header('Location: /contact-us?Error');
        exit;
    }
    $_POST['name'] = ucwords(strtolower(filter_data($_POST['fname'].' '.$_POST['lname'])));
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
}
$function->logOut();
echo '<script>window.location = "'.URL.'"</script>';
header('Location: '.URL);
exit;