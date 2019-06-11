<?php
if (isset($_SESSION['SESS__user'])) {
	$function->logOut();
	header('Location: '.URL);
	exit;
}else{
	header('Location: /error/404');
	exit;
}