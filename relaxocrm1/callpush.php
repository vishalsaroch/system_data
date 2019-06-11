<?php
#print_r($_REQUEST);
require_once 'ModelIncludes/config_dj.php';
require_once MODEL_DIRECTORY.'/session_dj.php';
require_once MODEL_DIRECTORY.'/conction_dj.php';
include_once MODEL_DIRECTORY.'/sms_dj.php';

$details = array();
$details["number"] = filter_data($_REQUEST['who']);
$details["channel"] = filter_data($_REQUEST['ChannelID']);
$details["circle"] = filter_data($_REQUEST['Circle']);
$details["operator"] = filter_data($_REQUEST['Operator']);
$details["timestamp"] = filter_data($_REQUEST['DateTime']);


CLASS FunctionsAPI extends Connection {
	################################################### INSERT
	function insertData_missCall($array){
        $this->dbConn->beginTransaction();
        if ($id = $this->insertData('clients_customers_misscall', $array)) {
            $_SESSION['MSG'] = array('success', "Misscall Successfully added ");
            $this->dbConn->commit();
            $this->logEvent('clients_customers_misscall', $array, 1);
            return $id;
        }
        $this->dbConn->rollBack();
        $this->logEvent('clients_customers_misscall', $array, 0);
        return false;
	}
}
$apiF = new FunctionsAPI();
if ($apiF->insertData_missCall($details)){
    echo "Success";
}else{
    echo "Fail";
}


$customerMsg = "Dear Customer,
Thanks for Calling ".CLIENT_TITLE." . We will Call you shortly (10 AM to 6 PM).
or You can Visit us at www.relaxoappliances.com";
sendSMS($details["number"], $customerMsg);