<?php
function exitS($msg){
    if (isset($_POST['ajax'])) {
        echo $msg;
        unset($_SESSION['MSG']);
        exit;
    }else{
        $referer = isset($_SERVER['HTTP_REFERER']) ? htmlentities($_SERVER['HTTP_REFERER']) : '/';
        header('Location:  '.$referer);
        echo '<script>window.location = "'.$referer.'";</script>';
        exit;
    }
}
$process  = $_POST['process'];
// print_r($_POST);
if        ($process  == 'login') {					////  Username verify Process ////
	$username = filter_data($_POST['username']);
	$password = filter_data($_POST['password']);
    if (! (filter_var($username, FILTER_VALIDATE_EMAIL) || ($username < 9999999987 && $username > 7000000012))) {
    	$function->setMessage(array("danger", "Invalid Username or Password"));
    	exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
    } else if (strlen($password) != 128) {
    	$function->setMessage(array("danger", "Invalid Username or Password"));
    	exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
    } else if ($function->user__Login($username, $password) === true) {
    	$_SESSION['MSG'] = array();
    	echo "<script>window.location = '/BestWebs?Successful'</script>";
        header("Location: /BestWebs?Successful");
        exit;
    }
	exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
} else if ($process  === 'warrantypush') {             ////  Add Warranty   ////
    if (isset($_POST['customer_id'])) {
        $details = (int) filter_data($_POST['customer_id']);
    }else{
        $details = array();
        foreach ($_POST['form'] as $key => $value) {
            $details[filter_data($key)] = filter_data($value);
        }
        $details['name'] =  ucwords($details['name']);
        $details['company'] =  ucwords($details['company']);
        $details['email'] =  strtolower($details['email']);
    }
    $product = array();
    foreach ($_POST['product'] as $key => $value) {
        $product[filter_data($key)] = filter_data($value);
    }
    $product['code'] =  strtoupper($product['code']);
    $product['dealer'] =  strtoupper($product['dealer']);
    if(! $product['purchased_from']) unset($product['purchased_from']);
    if(! $product['dealer_pin']) unset($product['dealer_pin']);
    $data = $function->insertData_warranty($details, $product);
    if($data){
        $customerMsg = "Dear Customer,\nWelcome to $_POST[productBrand].\nYour Product $_POST[productName]$_POST[productCat] successfully registered with CRN $data[crn]. Thanks for Choosing us.";
        $customerMsgResponse = sendSMS_byIndiawallmart($details["mobile"], $customerMsg, $_POST['productBrand'])['return'] ? ' Customer SMS Sent ' : " Customer SMS Not Sent <span class='entity-details' data-id='$data[cpid]' data-entity='ticket'><a href='javascript:void(0);' class='btn-action' data-action='resendCRN' title='Resend Customer CRN SMS'>Resend</a></span> ";
    }
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
} else if ($process  === 'fetchDependentSelect') {     ////  Fetch Dependent Chain Select Options ////
    $entity = $_POST['entity'];
    if ($entity === "pin-StateDistrictCity"){
        $var = (int) filter_data($_POST['id']);
        $results = $function->getArrayOptions_All_Table('pincodes_data', array('city cities', 'district district', 'state state'), " WHERE ul_pincode = :pin ", array(":pin"=>$var));
        exitS('{"status":"success", "message":'.json_encode($results, true).' }');
    }elseif ($entity === "state-DistrictCity"){
        $var = (string) filter_data($_POST['id']);
        $results = $function->getArrayOptions_All_Table('pincodes_data', array('district district'), " WHERE ul_state = :state ", array(":state"=>$var));
        exitS('{"status":"success", "message":'.json_encode($results, true).' }');
    }elseif ($entity === "district-CityPin"){
        $var = (string) filter_data($_POST['id']);
        $results = $function->getArrayOptions_All_Table('pincodes_data', array('city cities', 'pincode pin'), " WHERE ul_district = :district ", array(":district"=>$var));
        exitS('{"status":"success", "message":'.json_encode($results, true).' }');
    }elseif ($entity === "mobile-CustomerProduct"){
        $var = (string) filter_data($_POST['id']);
        $results = $function->getArray_customersSearch($var);
        exitS('{"status":"success", "message":'.json_encode($results, true).' }');
    }elseif ($entity === "crn-CustomerProduct"){
        $var = filter_data($_POST['id']);
        $results = $function->getArray_customersSearch('', $var);
        exitS('{"status":"success", "message":'.json_encode($results, true).' }');
    }
} else if ($process  === 'addTicket') {                ////  Add Ticket     ////
    //print_r($_POST);exit;
    $details = array();
    $customer = array();
    $sms = array();
    $warranty_status = filter_data($_POST["product"]["warranty_status"]);
    foreach ($_POST['form'] as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
    }
    $details['customer_id'] = substr($details['customer_id'], 7);
    foreach ($_POST['customer'] as $key => $value) {
        $customer[filter_data($key)] = filter_data($value);
    }
    foreach ($_POST['sms'] as $key => $value) {
        $sms[filter_data($key)] = filter_data($value);
    }
    $details["otp"] = substr(str_shuffle('1234567890'), 3, 4);
    $ticketId = $function->insertData_ticket($details, $customer, $warranty_status);
    if($ticketId){
        $sms["ref"] = "T".date("ymd")."$ticketId";

        $centerMsg = "Dear Associate,\n\nComplaint Ticket - $sms[ref]\nCustomer- $sms[name]\nPhone - $customer[mobile]  $customer[alternate_mobile]\nAddress - $sms[address]\nProduct- $sms[product]\nIssue - $details[details].";
        $centerMsgResponse = sendSMS_byIndiawallmart($sms["centerContact"], $centerMsg, $sms['brand'])['return'] ? ' Service Center SMS Sent ' : " Center SMS Not Sent <span class='entity-details' data-id='$ticketId.' data-entity='ticket'><a href='javascript:void(0);' class='btn-action' data-action='resendCenter' title='Resend Center SMS'>Resend</a></span> ";

        $customerMsg = "Dear Customer,\n\nYour complaint ticket ref $sms[ref] has been successfully registered. We will try to resolve it as soon as possible.";
        $customerMsgResponse = sendSMS_byIndiawallmart($customer["mobile"], $customerMsg, $sms['brand'])['return'] ? ' Customer SMS Sent ' : " Customer SMS Not Sent <span class='entity-details' data-id='$ticketId.' data-entity='ticket'><a href='javascript:void(0);' class='btn-action' data-action='resendCustomer' title='Resend Customer SMS'>Resend</a></span> ";

        $_SESSION['MSG'][1] .= " $centerMsgResponse, $customerMsgResponse";
    }
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
} else if ($process  === 'checkTicket') {                ////  Add Ticket     ////
    $var = filter_data($_POST['id']);
    $results = $function->getDetail_ticket($var);
    if ($results) {
        exitS('{"status":"success", "message":'.json_encode($results, true).' }');
    }
    exitS('{"status":"danger", "message":"Entered Ticket Complaint Number <b>'.$var.'</b> is invalid" }');
}
exitS('{"status":"danger", "message":"Unable to process your request, Please Try Later " }');