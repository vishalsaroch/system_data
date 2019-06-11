<?php
include "ModelFiles/config.php";
require MODEL_DIRECTORY."/session.php";
require MODEL_DIRECTORY."/conction.php";

if (isset($_POST["ajax"])) {
	////   PROCESS AJAX REQUESTS    ////
	require MODEL_DIRECTORY."/fnction_data.php";
	require MODEL_DIRECTORY."/fnction_ajax.php";
	require CONTROLLER_DIRECTORY."/process_ajax.php";
	exit;
}elseif (isset($_POST["process"], $_SESSION['SESS__user'])) {
	////   PROCESS LOGGED-IN FORM   ////
	# require MODEL_DIRECTORY."/fnction_data.php";
	require MODEL_DIRECTORY."/fnction_login.php";
	require CONTROLLER_DIRECTORY."/process_login.php";
	exit;
}if (isset($_POST["process"])) {
	////   PROCESS NO LOGGED-IN FORM   ////
	# require MODEL_DIRECTORY."/fnction_data.php";
	require MODEL_DIRECTORY."/fnction_nologin.php";
	require CONTROLLER_DIRECTORY."/process_nologin.php";
	exit;
}else{
	////   LOAD ASKED PAGE   ////
	if (isset($_GET["page"])) {
		$page  =  filter_data($_GET["page"]);
		if (($page === "error") || (! file_exists(VIEW_DIRECTORY."/user/$page.php"))) {
			require VIEW_DIRECTORY."/user/error.php";
			exit;
		}
		require MODEL_DIRECTORY."/fnction_data.php";
	}else{
		if (isset($_SESSION['SESS__user'])) {
			require MODEL_DIRECTORY."/fnction_data.php";
			$page = "home";
		}else{
			require MODEL_DIRECTORY."/fnction_login.php";
			$page = "login";
		}

	}
	require "include.php";
	require VIEW_DIRECTORY."/user/$page.php";
	exit;
}
header('Location: /error/500');