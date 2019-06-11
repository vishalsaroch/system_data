<?php
#print_r($_GET);
require 'ModelIncludes/config_dj.php';
require 'ModelIncludes/session_dj.php';

if (! isset($_SESSION['SESS__azz_level']) || ($_SESSION['SESS__azz_level'] < 2)) {
	echo '<script>window.location = "/error/404"</script>';
    exit;
}

if (isset($_GET['module'],$_GET['mode'])) {
	$page  = (string) $_GET['module'].'-'.$_GET['mode'];
	if (($page === 'error') || (! file_exists(VIEW_DIRECTORY."/admin/$page.php"))) {
		define('CURRENT_PAGE', 'error');
		require VIEW_DIRECTORY."/admin/error.php";
		exit;
	}
}else{
	$page = 'home';
}

require 'ModelIncludes/conction_dj.php';

if (isset($_POST['adminProcess'])) {
	require 'ModelIncludes/fnction_admin_data_dj.php';
	require CONTROLLER_DIRECTORY.'/process_admin_login_dj.php';
	exit;
}elseif (isset($_POST['adminAjax'])) {
	////   PROCESS AJAX REQUESTS    ////
	require 'ModelIncludes/fnction_admin_ajax_dj.php';
	require CONTROLLER_DIRECTORY.'/procss_admin_ajax_dj.php';
	exit;
}

require 'ModelIncludes/fnction_admin_data_dj.php';
require 'admin_include_dj.php';


define('CURRENT_PAGE', $page);
require VIEW_DIRECTORY."/admin/$page.php";
exit;