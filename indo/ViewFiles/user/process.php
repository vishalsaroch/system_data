<?php
if (!isset($_POST['ajax'])) {
	echo '	<center><img style="margin-top:200px;" src="/images/loader.svg" alt="Processing ..."><br><br></center>
	    <noscript>
		    <style type="text/css">
		         .process{display:none;}
		         .noscriptmsg {min-width: 300px ;margin:auto;color:red;}
		    </style>
		    <div class="noscriptmsg font-red">
		    	<center>
		    		<b>
		    			<br>You don\'t have javascript enabled, Please enable to Use and then re-submit your form<br>
		    			Here are the <a href="http://www.enable-javascript.com/" target="_blank"> instructions how to enable it</a>
	    			</b>
	    		</center>
		    </div>
		    <div style="display:none;">
		</noscript>
		<center>Processing ...</center>
		<script>
			window.history.pushState("", "Processing data by 100lution validation...", "/100lution/validation.html");
		</script>
		<div style="display:nne;">';
}

require_once 'cimages/functions_100lution.php';
SessionO::session_start_100lution();

if (!isset($_POST['process'])) {
	echo '<script>window.location = "/";</script>';
	exit;
}
$process = $_POST['process'];

if (!isset($_SESSION['s_login_string'])) {    ## Login Process
	if ($process === 'login') {
		$username = filter_data($_POST['username']);
		$password = filter_data($_POST['password']);
		if ((strlen($password) != 128) || (strlen($username) < 10)) {
			$_SESSION['MSG'] = array('danger', 'Invalid Credentials');
			echo '<script>window.location = "/index.html"</script>';
			exit;
		}elseif($row = $function->confirm_login($username, $password)){
			echo '<script>window.location = "/home.html"</script>';
			exit;
		}else{
			echo '<script>window.location = "/index.html"</script>';
			exit;
		}
	}elseif ($_GET['process'] === 'forgot') {
    }
}elseif($loggedIn = $function->check_login()){
	if ($process === 'search') {
		$string = filter_data($_POST['term']);
		$results = $function->get_search_result($string);
		echo json_encode($results);
	}elseif (($process === 'addUser') && ($loggedIn > 5)) {
		$details = array();
		foreach ($_POST as $key => $value) {
			$details[filter_data($key)] = filter_data($value);
		}
		if ($id = $function->registerUser($details)) {
			require_once 'cimages/uploads_100lution.php';
			$id = str_pad($id, 5, "0", STR_PAD_LEFT);
			$msg = uploadPic($_FILES['profilePic'], $id);
			$_SESSION['MSG'][1] .= $msg;
			echo '<script>window.location = "/users-new.html";</script>';
			exit;
		}else{
			$details['ERMaccess']  = '';
			$_SESSION['FORM'] = $details;
			echo '<script>window.location = "/users-new.html";</script>';
			exit;
		}
	}elseif (($process === 'addDesignation') && ($loggedIn > 5)) {
		$details = array();
		foreach ($_POST as $key => $value) {
			$details[filter_data($key)] = filter_data($value);
		}
		if ($id = $function->registerDesignation($details)) {
			echo '<script>window.location = "/users-new.html";</script>';
			exit;
		}else{
			$_SESSION['FORM'] = $details;
			$_SESSION['MODAL'] = '#designation';
			echo '<script>window.location = "/users-new.html";</script>';
			exit;
		}
	}elseif ($process === 'userDetails') {
		$id = filter_data($_POST['uid']);

		if ($details = $function->get_user_details($id)) {
			echo   '<div class="modal-header">
		              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span></button>
		              <h4 class="modal-title">Update User Details #'.$id.'</h4>
		            </div>
		            <div class="modal-body">
		                <div class="box-body table-responsive no-padding">
		                    <table class="table table-hover">
		                      <tr>
		                        <td colspan="2"><center><img src="/images/users/'.$id.'.png" alt="userPic"></center></td>
		                      </tr>
		                      <tr>
		                        <th>Name:</th>
		                        <td>'.$details['name'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Phone:</th>
		                        <td>'.$details['phone'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Email:</th>
		                        <td>'.$details['email'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Date of Birth:</th>
		                        <td>'.$details['dob'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Designation:</th>
		                        <td>'.$details['designation'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Center:</th>
		                        <td>'.$details['center'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Father:</th>
		                        <td>'.$details['father'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Salary:</th>
		                        <td>'.$details['salary'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Aadhar:</th>
		                        <td>'.$details['aadhar'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Address:</th>
		                        <td>'.$details['address'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Details:</th>
		                        <td>'.$details['details'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Time:</th>
		                        <td>'.$details['time'].'</td>
		                      </tr>
		                    </table>
		                </div>
                    </div>
                    <div class="modal-footer">

                      <a href="/users-new/update/'.$id.'.html" class="btn btn-primary btn-flat btn-sm margin pull-right">Update</a>
                    </div>
			';
		}
		exit;
	}elseif ($process === 'ticketDetails') {
		$id = filter_data($_POST['tid']);

		if ($details = $function->get_ticket_details($id)) {
			echo   '<div class="modal-header">
		              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span></button>
		              <h4 class="modal-title">Ticket Details #'.$details['code'].'</h4>
		            </div>
		            <div class="modal-body">
		                <div class="box-body table-responsive no-padding">
		                    <table class="table table-hover">
		                      <tr>
		                        <th>ID#:</th>
		                        <td>'.$details['id'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Code:</th>
		                        <td>'.$details['code'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Center:</th>
		                        <td>'.$details['center'].'</td>
		                      </tr>
		                      <tr>
		                        <th>City:</th>
		                        <td>'.$details['city'].'</td>
		                      </tr>
		                      <tr>
		                        <th>City Pin:</th>
		                        <td>'.$details['city_pin'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Product:</th>
		                        <td>'.$details['product'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Warranty:</th>
		                        <td>'.$details['warranty'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Purchased From:</th>
		                        <td>'.$details['pos'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Customer Name:</th>
		                        <td>'.$details['customer'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Customer Company:</th>
		                        <td>'.$details['company'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Address:</th>
		                        <td>'.$details['mobile'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Customer Email:</th>
		                        <td>'.$details['email'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Customer Address:</th>
		                        <td>'.$details['address'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Issue/Details:</th>
		                        <td>'.$details['details'].'</td>
		                      </tr>
		                      <tr>
		                        <th>ERM User:</th>
		                        <td>'.$details['user'].'</td>
		                      </tr>
		                    </table>
		                </div>
                    </div>
			';
		}
		exit;
	}elseif ($process === 'ticketJobDetails') {
		$ticketId = filter_data($_POST['tid']);

		if ($jobs = $function->get_ticket_job_details($ticketId)) {

			echo   '<div class="modal-header">
		              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span></button>
		              <h4 class="modal-title">Job Details for Ticket #'.$ticketId.'</h4>
		            </div>
		            <div class="modal-body">
		                <div class="box-body table-responsive no-padding">';
			foreach ($jobs as $job) {
		              echo '<table class="table table-hover">
		                      <tr>
		                        <th>Job Id:</th>
		                        <td>'.$job['jobId'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Center:</th>
		                        <td>'.$job['center'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Attender:</th>
		                        <td>'.$job['attender'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Work / Job:</th>
		                        <td>'.$job['work'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Priority:</th>
		                        <td>'.$job['priority'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Job Time:</th>
		                        <td>'.$job['time'].'</td>
		                      </tr>
		                    </table><hr>';
			}
			echo   '
						</div>
                    </div>
			';
		}
		exit;
	}elseif ($process === 'addTicket') {
		$details = array();
		foreach ($_POST as $key => $value) {
			$details[filter_data($key)] = filter_data($value);
		}
		if ($id = $function->registerTicket($details)) {
			require_once 'cimages/sms_100lution.php';
			sendRegSMS($details['phone'], $id);
			echo '<script>window.location = "/tickets-new.html";</script>';
			exit;
		}else{
			$_SESSION['FORM'] = $details;
			echo '<script>window.location = "/tickets-new.html";</script>';
			exit;
		}
	}elseif (($process === 'addProduct') && ($loggedIn > 5)) {
		$details = array();
		foreach ($_POST as $key => $value) {
			$details[filter_data($key)] = filter_data($value);
		}
		if ($function->registerProduct($details)) {
			echo '<script>window.location = "/products.html";</script>';
			exit;
		}else{
			$_SESSION['MODAL'] = '#newProduct';
			$_SESSION['FORM'] = $details;
			echo '<script>window.location = "/products.html";</script>';
			exit;
		}
	}elseif ($process === 'addJob') {
		$details = array();
		foreach ($_POST as $key => $value) {
			$details[filter_data($key)] = filter_data($value);
		}
		if ($id = $function->registerJob($details)) {
			if ($details['status']) {
				require_once 'cimages/sms_100lution.php';
				sendCloseSMS($details['phone'], $details['partner']);
			}
			echo '<script>window.location = "/jobs-new.html";</script>';
			exit;
		}else{
			$_SESSION['FORM'] = $details;
			echo '<script>window.location = "/jobs-new.html";</script>';
			exit;
		}
	}elseif ($process === 'jobDetails') {
		$id = filter_data($_POST['jid']);
		if ($details = $function->get_job_details($id)) {
			echo   '<div class="modal-header">
		              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span></button>
		              <h4 class="modal-title">Job Details #'.$details['jobId'].'</h4>
		            </div>
		            <div class="modal-body">
		                <div class="box-body table-responsive no-padding">
		                    <table class="table table-hover">
		                      <tr>
		                        <th>Complaint Code:</th>
		                        <td>'.$details['complaint'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Center:</th>
		                        <td>'.$details['center'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Attender:</th>
		                        <td>'.$details['attender'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Work / Job:</th>
		                        <td>'.$details['work'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Priority:</th>
		                        <td>'.$details['priority'].'</td>
		                      </tr>
		                      <tr>
		                        <th>Job Time:</th>
		                        <td>'.$details['time'].'</td>
		                      </tr>
		                    </table>
		                </div>
                    </div>
			';
		}
		exit;
	}elseif ($process === 'getUserName') {
		$id = filter_data($_POST['uid']);
		$function->get_user_name($id);
		exit;
	}elseif ($process === 'updatePassword') {
		$details = array();
		foreach ($_POST as $key => $value) {
			$details[filter_data($key)] = filter_data($value);
		}
		$newPass = filter_data($_POST['password']);
		$oldPass = filter_data($_POST['pass']);
		if (strlen($newPass) != 128) {
			$_SESSION['MODAL'] = '.login-modal';
			$_SESSION['MSG'] = array('danger', "Invalid New Password, Try Again");
			echo '<script>window.location = "/profile.html";</script>';
			exit;
		}elseif (strlen($oldPass) != 128) {
			$_SESSION['MODAL'] = '.login-modal';
			$_SESSION['MSG'] = array('danger', "Incorrect Current Password, Try Again");
			echo '<script>window.location = "/profile.html";</script>';
			exit;
		}elseif ($id = $function->changePassword($oldPass, $newPass)) {
			echo '<script>window.location = "/profile.html";</script>';
			exit;
		}else{
			$_SESSION['FORM'] = $details;
			$_SESSION['MODAL'] = '.login-modal';
			echo '<script>window.location = "/profile.html";</script>';
			exit;
		}
	}elseif ($process === 'updatePersonal') {
		$details = array();
		foreach ($_POST as $key => $value) {
			$details[filter_data($key)] = filter_data($value);
		}
		$address = filter_data($_POST['address']);
		$dob = filter_data($_POST['dob']);
		$email = filter_data($_POST['regEmail']);

		if ($id = $function->changePersonal($address, $dob, $email)) {
			echo '<script>window.location = "/profile.html";</script>';
			exit;
		}else{
			$_SESSION['FORM'] = $details;
			$_SESSION['MODAL'] = '.update-modal';
			echo '<script>window.location = "/profile.html";</script>';
			exit;
		}
	}elseif (($process === 'addPartner')&& ($loggedIn > 5)) {
		$details = array();
		foreach ($_POST as $key => $value) {
			$details[filter_data($key)] = filter_data($value);
		}
		if ($id = $function->registerPartner($details)) {
			echo '<script>window.location = "/partners.html";</script>';
			exit;
		}else{
			$_SESSION['MODAL'] = '#newPartner';
			$_SESSION['FORM'] = $details;
			//echo '<script>window.location = "/partners.html";</script>';
			exit;
		}
	}elseif (($process === 'addCenter')&& ($loggedIn > 5)) {
		$details = array();
		foreach ($_POST as $key => $value) {
			$details[filter_data($key)] = filter_data($value);
		}
		if ($id = $function->registerCenter($details)) {
			echo '<script>window.location = "/partners.html";</script>';
			exit;
		}else{
			$_SESSION['MODAL'] = '#newCenter';
			$_SESSION['FORM'] = $details;
			echo '<script>window.location = "/partners.html";</script>';
			exit;
		}
	}elseif ($process === 'addMessage') {
		$details = array();
		$receivers = $_POST['reciepients'];
		$message = $_POST['message'];
		$subject = filter_data($_POST['subject']);
		echo "<pre>";print_r($_POST);exit;
		foreach ($_POST as $key => $value) {
			$details[filter_data($key)] = filter_data($value);
		}
		if ($id = $function->registerMessage($details)) {
			echo '<script>window.location = "/message-new.html";</script>';
			exit;
		}else{
			$_SESSION['FORM'] = $details;
			echo '<script>window.location = "/message-new.html";</script>';
			exit;
		}
	}


	if (isset($_SERVER['HTTP_REFERER'])) {
		$_SESSION['MSG'] = array('danger','You have submitted Invalid details.');
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}else {
		$_SESSION['MSG'] = 'Please Login for access these pages or go through the Links';
		header('Location: http://www.frinic.com/');
	}
}
echo '</div>
<script>window.location = "/logout.html"</script>';
exit;