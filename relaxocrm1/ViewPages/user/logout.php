<?php
if (isset($_SESSION['SESS__user'])) {
	$function->logOut();
	header('Location: /');
	echo '<script>window.location = "/";</script>';
	exit;
}else{
	header('Location: /error/404');
	echo '<script>window.location = "/error/404";</script>';
	exit;
}