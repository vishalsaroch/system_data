<?php
#print_r($_POST);
require_once 'ModelIncludes/config_dj.php';
$page  = "login";

require_once VIEW_DIRECTORY."/user/$page.php";
exit;