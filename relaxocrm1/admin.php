<?php
//print_r($_GET);
require_once 'ModelIncludes/config_dj.php';
require_once MODEL_DIRECTORY.'/session_dj.php';

if (!isset($_SESSION['SESS__azz_level'])) {
	echo '<script type="text/javascript">window.location = "/"</script>';
	header('Location: /');
    exit;
}

require_once MODEL_DIRECTORY.'/conction_dj.php';
require_once MODEL_DIRECTORY.'/admin/fnction_admin_data_dj.php';

if (($level = $function->checkLogin()) < 1) {
	echo '<script type="text/javascript">window.location = "/error/404"</script>';
	header('Location: /error/404');
    exit;
}


if (isset($_POST['adminProcess'])) {
	require_once MODEL_DIRECTORY.'/admin/fnction_admin_login_dj.php';
	require_once CONTROLLER_DIRECTORY.'/admin/process_admin_login_dj.php';
	exit;
}elseif (isset($_POST['adminAjax'])) {
	if (isset($_POST['url'])) {
		$s = parse_url($_POST['url']);
		parse_str($s['query'], $_GET);
		$page  = "$_GET[module]-$_GET[mode]";
		//echo json_encode($s)." ---- $_POST[url] ---- $page";
		if (! file_exists(VIEW_DIRECTORY."/admin/$page.php")) {
			require_once VIEW_DIRECTORY."/admin/error.php";
			exit;
		}else{
			require_once VIEW_DIRECTORY."/admin/$page.php";
			exit;
		}
	}else{
		require_once MODEL_DIRECTORY.'/admin/fnction_admin_ajax_dj.php';
		include_once MODEL_DIRECTORY.'/sms_dj.php';
		include_once MODEL_DIRECTORY.'/mail_dj.php';
		require_once CONTROLLER_DIRECTORY.'/admin/process_admin_ajax_dj.php';
		exit;
	}
	exit;
}else{
	if (isset($_GET["module"], $_GET["mode"])) {
		$page  = "$_GET[module]-$_GET[mode]";
	}else{
		$page = 'home-dashboard';
	}
}

require_once 'admin_include_dj.php';
PageHead($page);
PageJsInclude();
PageTopBar($page);
PageLeftNavBar($page);
echo $function->getMessage();
// PageRightBar($page);
if (! file_exists(VIEW_DIRECTORY."/admin/$page.php")) {
	require_once VIEW_DIRECTORY."/admin/error.php";
}else{
	require_once VIEW_DIRECTORY."/admin/$page.php";
}
pageFooter();