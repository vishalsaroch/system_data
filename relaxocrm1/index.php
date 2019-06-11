<?php
#print_r($_POST);
require_once 'ModelIncludes/config_dj.php';
require_once MODEL_DIRECTORY.'/session_dj.php';
require_once MODEL_DIRECTORY.'/conction_dj.php';
require_once MODEL_DIRECTORY.'/fnction_nologin_dj.php';
$page  = "login";

if (isset($_POST['apikey'])) {
	include_once MODEL_DIRECTORY.'/sms_dj.php';
	require_once CONTROLLER_DIRECTORY.'/process_api_dj.php';
	exit;
}elseif (isset($_POST['process'])) {
	include_once MODEL_DIRECTORY.'/sms_dj.php';
	require_once CONTROLLER_DIRECTORY.'/process_nologin_dj.php';
	exit;
}elseif(isset($_GET['page'])){
	$page  = (string) "$_GET[page]";
	if (file_exists(VIEW_DIRECTORY."/user/$page.php")) {
		$page  = "$page";
	}else{
		header('Location: /error/404');
		echo '<script>window.location = "/error/404";</script>';
		exit;
	}
}
require_once VIEW_DIRECTORY."/user/$page.php";
exit;