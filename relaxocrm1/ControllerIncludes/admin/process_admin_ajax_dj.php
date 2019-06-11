<?php

$ajax = $_POST['adminAjax'];
$action = isset($_POST['action']) ? $_POST['action'] : false;

$userLevel = (int) $_SESSION['SESS__azz_level'];
unset($_POST['adminAjax']);

function exitS($msg){
    if (isset($_POST['ajax'])) {
        echo $msg;
        unset($_SESSION['MSG']);
        exit;
    }else{
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/shoppo-admin';
        header('Location:  '.$referer);
        echo '<script>window.location = "'.$referer.'"</script>';
        exit;
    }
}

if      ($ajax  === 'changePage') {               ////  Load Pages     ////
    $url = htmlentities($_POST['url']);
    if (isset($_GET['module'],$_GET['mode'])) {
        $page  = (string) $_GET['module'].'-'.$_GET['mode'];
        if (($page === 'error') || (! file_exists(VIEW_DIRECTORY."/admin/$page.php"))) {
            define('CURRENT_PAGE', 'error');
            require VIEW_DIRECTORY."/admin/error.php";
            exitS();
        }
    }else{
        $page = 'home';
    }
    exitS();
}elseif ($ajax  === 'addSpare') {                 ////  Add Categories ////
    $details = array();
    if (! $_POST['form']['spare_id']) {
        unset($_POST['form']['spare_id']);
        $isUpdate = false;
    }else{
        $isUpdate = true;
    }
    foreach ($_POST['form'] as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
    }
    $details['code'] = strtoupper($details['code']);
    $details['hsn'] = strtoupper($details['hsn']);
    $details['category'] =  ucwords(strtolower($details['category']));
    $details['brand'] =  ucwords($details['brand']);
    $details['name'] =  ucwords($details['name']);
    $details['model'] =  ucwords($details['model']);
    $spareId = $functionA->insertData_newSpare($details, $isUpdate);
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}elseif ($ajax  === 'addProduct') {               ////  Add Categories ////
    $details = array();
    $spares = array();
    if (! $_POST['form']['product_id']) {
        unset($_POST['form']['product_id']);
        $isUpdate = false;
    }else{
        $isUpdate = true;
    }
    foreach ($_POST['form'] as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
    }
    if (isset($_POST['spareName'])) {
        foreach ($_POST['spareName'] as $key => $value) {
            $spares[filter_data($value)] = filter_data($_POST['spareQuantity'][$key]);
        }
    }
    $details['code'] = strtoupper($details['code']);
    $details['hsn'] = strtoupper($details['hsn']);
    $details['category'] =  ucwords(strtolower($details['category']));
    $details['brand'] =  ucwords($details['brand']);
    $details['name'] =  ucwords($details['name']);
    $details['model'] =  ucwords($details['model']);
    $details['spec1'] =  ucwords($details['spec1']);
    $spareId = $functionA->insertData_newProduct($details, $spares, $isUpdate);
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}elseif ($ajax  === 'addCenterCumUser') {         ////  Add Categories ////
    $details = array();
    $personal = array();
    foreach ($_POST['form'] as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
    }
    foreach ($_POST['personal'] as $key => $value) {
        $personal[filter_data($key)] = filter_data($value);
    }
    $password = filter_data($_POST['password']);
    if (($_POST['cpassword'] != $_POST['password']) || (strlen($password) != 128)) {
        exitS('{"status":"danger", "message":"Password and Confirm Password Doesn\'t Matched or Invalid Passwords " }');
    }
    $details['partner_id'] = 1;
    if (! $details['phone2']) unset($details['phone2']);
    $details['code'] = strtoupper($details['code']);
    $details['name'] =  ucwords($details['name']);
    $personal['designation'] = $levels[4];
    $personal['email'] = $details['email'];
    $personal['name'] =  ucwords($personal['name']);
    $personal['pan'] =  strtoupper($personal['pan']);
    $centerId = $functionA->insertData_newCenterCumUser($details, $personal, $password, 4);
    if($centerId){
        $centerId = "A".date('ymd').str_pad($centerId,4,"0",STR_PAD_LEFT);
        $customerMsg = "Dear Associate,\nWelcome to ".CLIENT_TITLE." Family.\nYou have successfully registered with ID $centerId. Use Mobile Number as Username";
        $customerMsgResponse = sendSMS($personal["mobile"], $customerMsg)['return'] ? ' user SMS Sent ' : ' user SMS Not Sent '.'<a href=\'\' title=\'Resend user SMS\'>Resend</a> ';
    }
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}elseif ($ajax  === 'addUser') {                  ////  Add Categories ////
    $details = array();
    foreach ($_POST['form'] as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
        if (!$value) unset($details[$key]);
    }
    $password = filter_data($_POST['password']);
    $level = (int) filter_data($_POST['level']);
    if (($_POST['cpassword'] != $password) || (strlen($password) != 128)) {
        exitS('{"status":"danger", "message":"Password and Confirm Password Doesn\'t Matched or Invalid Passwords " }');
    }
    $details['address'] = "$details[address], $details[district], $details[state] - $details[city]";
    unset($details['district'],$details['state'],$details['city']);
    if ($level >= ($userLevel - 1)) {
        exitS('{"status":"danger", "message":"You Don\'t have Permissions to Add this user. " }');
    }
    $details['designation'] = $levels[$level];
    $details['name'] =  ucwords($details['name']);
    $details['father'] =  ucwords($details['father']);
    $details['pan'] =  strtoupper($details['pan']);
    $userId = $functionA->insertData_newUser($details, $password, $level);
    if($userId){
        $userId = "U".date('ymd').str_pad($userId,4,"0",STR_PAD_LEFT);
        $customerMsg = "Dear User,\nWelcome to ".CLIENT_TITLE." Family.\nYou have successfully registered with ID $userId. Use Mobile Number as Username";
        $customerMsgResponse = sendSMS($details["mobile"], $customerMsg)['return'] ? ' user SMS Sent ' : ' user SMS Not Sent '.'<a href=\'\' title=\'Resend user SMS\'>Resend</a> ';
    }
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}elseif ($ajax  === 'addInChallan') {             ////  Add Categories ////
    $details = array();
    $spares = array();
    $spares[":center_id"] = (int) filter_data($_POST['party']);
    $spares[":date"] = filter_data($_POST['date']);
    $code = $spares[":code"] = filter_data($_POST['challan']);
    $spares[":code_type"] = filter_data($_POST['type']);
    $spares[":type"] = filter_data($_POST['stock']);
    foreach ($_POST['spareName'] as $key => $value) {
        $key = (int) $key;
        $details[] = " (:code , :code_type, :center_id, :spare_id$key, :stock$key, :price$key, :gst$key, :type, :date ) ";
        $spares[":spare_id$key"] = (int) filter_data($value);
        $spares[":stock$key"] = (int) filter_data($_POST['spareQuantity'][$key]);
        $spares[":price$key"] = (float) filter_data($_POST['spareAmount'][$key]);
        $spares[":gst$key"] = (float) filter_data($_POST['spareGST'][$key]);
    }
    $spareId = $functionA->insertData_inwardChallan($details, $spares, $code);
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}elseif ($ajax  === 'addExpense') {               ////  Add Categories ////
    $details = array();
    $expenses = array();
    $expenses[":date"] = filter_data($_POST['date']);
    $code = $expenses[":code"] = filter_data($_POST['challan']);
    $type = (int) filter_data($_POST['type']);
    foreach ($_POST['expenseType'] as $key => $value) {
        $key = (int) $key;
        $details[] = " (:code , :amount$key, :gst$key, :type$key, :date, :description$key ) ";
        $expenses[":type$key"] = filter_data($value);
        $expenses[":description$key"] = filter_data($_POST['expenseDetail'][$key]);
        $expenses[":amount$key"] = (float) filter_data($type * $_POST['expenseAmount'][$key]);
        $expenses[":gst$key"] = (float) filter_data($type * $_POST['expenseGST'][$key]);
    }
    print_r($expenses);
    $spareId = $functionA->insertData_expense($details, $expenses, $code);
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}elseif ($ajax  === 'addWarranty') {              ////  Add Warranty   ////
    $details = array();
    $product = array();
    $isUpdate = false;
    print_r($_POST);
    if (isset($_POST['customer_id'])) {
        $details = (int) filter_data($_POST['customer_id']);
    }elseif(isset($_POST['form'])){
        foreach ($_POST['form'] as $key => $value) {
            $details[filter_data($key)] = filter_data($value);
        }
        if(! $details['alternate_mobile']) unset($details['alternate_mobile']);
        $details['name'] =  ucwords($details['name']);
        $details['company'] =  ucwords($details['company']);
        $details['email'] =  strtolower($details['email']);
        if(isset($_POST['form']['customer_id'])) {
            $isUpdate = 'customer-personal';
            goto finalUpdate1;
        }
    }

    foreach ($_POST['product'] as $key => $value) {
        if(! $value) continue;
        $product[filter_data($key)] = filter_data($value);
    }
    if(isset($_POST['product']['customer_product_id']))  $isUpdate = 'customer-product';

    $product['code'] =  strtoupper($product['code']);
    if(! $product['purchased_from']) unset($product['purchased_from']);
    if(! $product['dealer_pin']) unset($product['dealer_pin']);

    finalUpdate1:
    $data = $functionA->insertData_warranty($details, $product, $isUpdate);
    if($data && (!$isUpdate)){
        $customerMsg = "Dear Customer,\nWelcome to $_POST[productBrand].\nYour Product $_POST[productName]$_POST[productCat] successfully registered with CRN $data[crn]. Thanks for Choosing us.";
        $customerMsgResponse = sendSMS($details["mobile"], $customerMsg, $_POST['productBrand'])['return'] ? ' Customer SMS Sent ' : " Customer SMS Not Sent <span class='entity-details' data-id='$data[cpid]' data-entity='ticket'><a href='javascript:void(0);' class='btn-action' data-action='resendCRN' title='Resend Customer CRN SMS'>Resend</a></span> ";
    }
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}elseif ($ajax  === 'fetchDependentSelect') {     ////  Fetch Dependent Chain Select Options ////
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
    }elseif ($entity === "productId-product"){
        $var = filter_data($_POST['id']);
        $results = $function->getArrayOptions_All_Table('client_products', array('product_id id', 'category category', 'brand brand', 'name product', 'model model' , 'spec1 spec1' , 'spec2 spec2'), " WHERE ul_product_id = :id OR ul_code = :id ", array(":id"=>$var))[0];
        exitS('{"status":"success", "message":'.json_encode($results, true).' }');
    }
}elseif ($ajax  === 'addTicket') {                ////  Add Ticket     ////
    $details = array();
    $customer = array();
    $sms = array();
    $isUpdate = false;
    $warranty_status = filter_data($_POST["product"]["warranty_status"]);
    foreach ($_POST['form'] as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
    }
    $details['customer_id'] = substr($details['customer_id'], 7);
    if(isset($_POST['form']['complaint_id'])) {
        $isUpdate = true;
        $details["otp"] = $function->getData_ticketCustomerOTP($details['complaint_id'])["otp"];
        goto finalUpdate2;
    }
    foreach ($_POST['customer'] as $key => $value) {
        $customer[filter_data($key)] = filter_data($value);
    }
    foreach ($_POST['sms'] as $key => $value) {
        $sms[filter_data($key)] = filter_data($value);
    }
    $details["otp"] = substr(str_shuffle('1234567890'), 3, 4);
    finalUpdate2:
    // print_r($details);
    // print_r($_POST);
    $ticketId = $functionA->insertData_ticket($details, $customer, $warranty_status, $isUpdate);
    if($ticketId && (!$isUpdate)){
        $subject = "Greetings from ".CLIENT_TITLE;
        if($customer['email']) sendMail($customer['email'], $sms['name'], $subject);


        $sms["ref"] = "T".date("ymd")."$ticketId";
        $centerMsg = "Dear Associate,\n\nComplaint Ticket - $sms[ref]\nCustomer- $sms[name]\nPhone - $customer[mobile]  $customer[alternate_mobile]\nAddress - $sms[address]\nProduct- $sms[product]\nIssue - $details[details].";
        $centerMsgResponse = sendSMS($sms["centerContact"], $centerMsg, $sms['brand'])['return'] ? ' Service Center SMS Sent ' : " Center SMS Not Sent <span class='entity-details' data-id='$ticketId.' data-entity='ticket'><a href='javascript:void(0);' class='btn-action' data-action='resendCenter' title='Resend Center SMS'>Resend</a></span> ";

        $customerMsg = "Dear Customer,\n\nYour complaint ticket ref $sms[ref] has been successfully registered. We will try to resolve it as soon as possible.";
        $customerMsgResponse = sendSMS($customer["mobile"], $customerMsg, $sms['brand'])['return'] ? ' Customer SMS Sent ' : " Customer SMS Not Sent <span class='entity-details' data-id='$ticketId.' data-entity='ticket'><a href='javascript:void(0);' class='btn-action' data-action='resendCustomer' title='Resend Customer SMS'>Resend</a></span> ";

        $_SESSION['MSG'][1] .= " $centerMsgResponse, $customerMsgResponse";
    }
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}elseif ($ajax  === 'addJob') {                   ////  Add Job        ////
    $details = array();
    $complaint = array();
    $spare = array();
    foreach ($_POST['form'] as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
    }
    if (isset($_POST['partReplace'])) {
        foreach ($_POST['partReplace'] as $value) {
            $spare[] = (int) filter_data($value);
        }
    }
    if (isset($_POST['complaint'])) {
        foreach ($_POST['complaint'] as $key => $value) {
            $complaint[filter_data($key)] = filter_data($value);
        }
    }
    $customer = $function->getData_ticketCustomerOTP($details['complaint_id']);
    if(! isset($complaint['complaint_priority'])) unset($complaint['complaint_priority']);
    if ($details['type'] == "Canceled"){

    }elseif ($details['type'] == "Outside") {

    }elseif ($details['type'] == "Local") {

    }elseif ($details['type'] == "Closed by Admin") {
        if(! $complaint['purchase_date']) unset($complaint['purchase_date']);
    }
    if (IS_TICKET_OTP && ($details['status'] != "2") && ($_SESSION['SESS__azz_level'] < 8 ) && ($customer['otp'] != $complaint['otp'])) {
        exitS('{"status":"danger", "message":"Incorrect Customer OTP " }');
    }
    unset($complaint['otp']);
    $jobId = $functionA->insertData_job($details, $spare, $complaint);
    if($jobId){
        $customerMsg = "Dear Customer,\nStatus of your complaint ticket ref. # $customer[code] is - \n$details[status_brief_customer].";
        sendSMS($customer["mobile"], $customerMsg, $customer['brand']);
    }
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}elseif ($ajax  === 'updateTechnician') {         ////  Add Categories ////
    $ticket = (int) filter_data($_POST['entity']);
    $user = (int) filter_data($_POST['id']['user']);
    if($functionA->updateData_ticketTechnician($ticket, $user)){
        $customerMsg = "Dear Customer,\n$data[technician] ($data[contact]) will visit as soon as possible for ticket ref. #$data[code].";
        if (IS_TICKET_OTP) {
            $data = $function->getData_ticketCustomerOTP($ticket);
            $customerMsg .= " Share your OTP $data[otp].";
        }
        sendSMS($data["mobile"], $customerMsg, $data['brand']);
    }
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}elseif ($ajax  === 'ticketFeedback') {           ////  Add Categories ////
    $feedback['complaint_id'] = (int) filter_data($_POST['entity']);
    $feedback['review'] = filter_data($_POST['id']['review']);
    $feedback['rating'] = (int) filter_data($_POST['id']['rating']);
    $functionA->insertData_ticketFeedback($feedback);
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}elseif ($ajax  === "updateProfile"){
    if (isset($_FILES['changePic'])) {
        include MODEL_DIRECTORY.'/uploads_dj.php';
        if($msg = uploadPic($_FILES['changePic'], $_SESSION['SESS__user_id'])){
            exitS('{"status":"danger", "message":"'.$msg.'" }');
        }
        exitS('{"status":"success", "message":"Profile Picture Successfully Updated " }');
    }elseif(isset($_POST['password'])){
        if (($_POST['password'] != $_POST['cpassword']) || (strlen($_POST['cpassword']) != 128)) {
            exitS('{"status":"danger", "message":"Both Passwords doesn\'t matched or Invalid Passwords " }');
            exit;
        }elseif (strlen($_POST['opassword']) != 128) {
            exitS('{"status":"danger", "message":"Incorrect Current Password " }');
            exit;
        }
        $password = filter_data($_POST['password']);
        $opassword = filter_data($_POST['opassword']);
        if ($functionA->updateData_userPassword($password, $opassword) === true) {
            exitS('{"status":"success", "message":"Password Successfully Updated " }');
        }
        exitS('{"status":"danger", "message":"Unable to update password, Please try later " }');
    }
}elseif ($ajax  === 'addPincode') {               ////  Add Pincode ////
    $details = array();
    foreach ($_POST['form'] as $key => $value) {
        $details[filter_data($key)] = ucwords(filter_data($value));
        if (!$value) unset($details[$key]);
    }
    $userId = $functionA->insertData_newPinCode($details);
    exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}

// #############   ACTIONS  ###############
if ($action === "delete"){
        $id = filter_data($_POST['id']);
        $result = $functionA->deleteData_table($ajax, $id);
        exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}elseif ($action === "block" || $action === "unblock"){
        $id = (int) filter_data($_POST['id']);
        $result = $functionA->updateData_STATUS($ajax, $id, $action);
        exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
}elseif ($ajax  === 'misscall') {                     ////  Add Categories ////
    if ($action === "tag"){
        $id = (int) filter_data($_POST['id']['id']);
        $tagging = filter_data($_POST['id']['tagging']);
        $status = ($_POST['id']['status'] == 1) ? 1 : 0;
        $result = $functionA->updateData_missCall($id, $status, $tagging);
        exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
    }elseif($action === "call"){
        $time = time();
        if(isset($_SESSION["next_call"]) && $_SESSION["next_call"] > $time){
            exitS('{"status":"danger", "message":"Please wait & Finish, Tag Previous Call First, till don\'t click on call. " }');
        }else{
            $_SESSION["next_call"] = $time + 300;
        }
        $number = filter_data($_POST['id']);
        $id = (int) filter_data($_POST['number']);
        $result = $function->getData_missCallTag($number);
        if($functionA->updateData_missCall($id, 1) === true){
            exitS('{"status":"success", "message":'.$_SESSION['MSG'][1].' }');
        }else{
            exitS('{"status":"success", "message":'.json_encode($result).' }');
        }
    }else{
        $number = filter_data($_POST['id']);
        $result = $function->getData_missCallTag($number);
        exitS('{"status":"success", "message":'.json_encode($result).' }');
    }
}elseif ($ajax  === 'ticket') {                   ////  Add Categories ////
    if ($action === "technician"){
        $id = (int) filter_data($_POST['id']);
        $result = $function->getData_ticketTechnician($id);
        exitS('{"status":"success", "message":'.json_encode($result).' }');
    }elseif ($action === "resendCenter"){
        $id = (int) filter_data($_POST['id']);
        $data = $function->getData_ticketCenter($id);
        $centerMsg = "Dear Associate,\n\nComplaint Ticket - $data[code]\nCustomer- $data[name]\nPhone - $data[mobile]  $data[alternate_mobile]\nAddress - $data[address], $data[city], $data[district]\nProduct- $data[category] $data[product] $data[model]\nIssue - $data[details].";
        if(sendSMS($data["centerContact"], $centerMsg, $data["brand"])['return']){
            exitS('{"status":"success", "message":{"title":"Yupp!","footer":"","body":" Center SMS Sent "} }');
        }else{
            exitS('{"status":"danger", "message":{"title":"Oops!","footer":"","body":" Center SMS Not Sent "} }');
        }
    }elseif ($action === "resendCustomer"){
        if (! IS_TICKET_OTP) {
            exitS('{"status":"success", "message":{"title":"Yupp!","footer":"","body":" OTP Disabled by Admin "} }');
        }
        $id = (int) filter_data($_POST['id']);
        $data = $function->getData_ticketCustomerOTP($id);
        $customerMsg = "Dear Customer,\n$data[technician] ($data[contact]) will visit as soon as possible. Share your OTP $data[otp] for ticket ref. #$data[code].";
        if (sendSMS($data["mobile"], $customerMsg, $data["brand"])['return']) {
            exitS('{"status":"success", "message":{"title":"Yupp!","footer":"","body":" Customer SMS Sent "} }');
        }else{
            exitS('{"status":"danger", "message":{"title":"Oops!","footer":"","body":"  Customer SMS Not Sent  "} }');
        }
    }elseif ($action === "resendCRN"){
        $id = (int) filter_data($_POST['id']);
        $data = $function->getData_ticketCustomerCRN($id);
        $customerMsg = "Dear Customer,\nWelcome to $data[brand].\nYour Product $data[category]$data[product] successfully registered with CRN $data[crn]. Thanks for Choosing us.";
        if (sendSMS($details["mobile"], $customerMsg, $data["brand"])['return']) {
            exitS('{"status":"success", "message":{"title":"Yupp!","footer":"","body":" Center SMS Sent "} }');
        }else{
            exitS('{"status":"danger", "message":{"title":"Oops!","footer":"","body":" Customer SMS Not Sent  "} }');
        }
    }elseif ($action === "jobTicket"){
        $id = (int) filter_data($_POST['id']);
        $result = $function->getDetail_jobTicket($id);
        exitS('{"status":"success", "id":"'.$id.'", "message":'.json_encode($result).' }');
    }elseif ($action === "details"){
        $id = (int) filter_data($_POST['id']);
        if($result = $function->getDetail_ticket($id)){
            exitS('{"status":"success", "message":'.json_encode($result).' }');
        }
        exitS('{"status":"danger", "message":"<b>Invalid Complaint Selected or Something bad happened try later</b>" }');
    }elseif ($action === "jobdetails"){
        $id = (int) filter_data($_POST['id']);
        if($result = $function->getDetail_ticketJobs($id)){
            exitS('{"status":"success", "message":'.json_encode($result).' }');
        }
        exitS('{"status":"danger", "message":"Invalid Complaint Selected or <b> No Job Performed yet </b>, try later" }');
    }elseif ($action === "feedback"){
        $id = (int) filter_data($_POST['id']);
        $result = $function->getData_ticketFeedback($id);
        exitS('{"status":"success", "message":'.json_encode($result).' }');
    }elseif ($action === "view-otp"){
        if (! IS_TICKET_OTP) {
            exitS('{"status":"success", "message":" OTP Disabled by Admin "');
        }
        $id = (int) filter_data($_POST['id']);
        $result = $function->getData_ticketOTP($id);
        exitS('{"status":"success", "message":"OTP for this complaint is : <b>'.$result["otp"].'</b>" }');
    }
}elseif ($ajax  === 'product'){
    if ($action === "details"){
        $id = (int) filter_data($_POST['id']);
        if($result = $function->getDetail_product($id)){
            exitS('{"status":"success", "message":'.json_encode($result).' }');
        }
        exitS('{"status":"danger", "message":"<b>Invalid User Selected or Something bad happened try later</b>" }');
    }
}elseif ($ajax  === 'spare') {                    ////  Fetch Dependent Chain Select Options ////
    if ($action === "details"){
        $id = (int) filter_data($_POST['id']);
        if($result = $function->getDetail_spare($id)){
            exitS('{"status":"success", "message":'.json_encode($result).' }');
        }
        exitS('{"status":"danger", "message":"<b>Invalid User Selected or Something bad happened try later</b>" }');
    }elseif ($action === "payout"){
        $id = (int) filter_data($_POST['id']);
        $payouts = $function->getArray_categoryPayout($category);
        exitS('{"status":"success", "message":{"title":"", "content":'.json_encode($payouts, true).'} }');
    }
}elseif ($ajax  === 'user') {                    ////  Fetch Dependent Chain Select Options ////
    if ($action === "reset"){
        $pass = str_shuffle(mt_rand(100000,999999));
        $id = (int) filter_data($_POST['id']);
        if($functionA->updateData_resetPassword($id, $pass)){
            $customer = $function->getArrayOptions_All_Table('users_personal', array('mobile mobile'), " WHERE ul_user_id = :id ", array(":id"=>$id))[0];
            $customerMsg = "Dear User,\nYour password successfully reseted to\n\n$customer[mobile]\n\nUse this Mobile Number as Username\n".CLIENT_TITLE;
            sendSMS($customer["mobile"], $customerMsg);
        }
        exitS('{"status":"'.$_SESSION['MSG'][0].'", "message":"'.$_SESSION['MSG'][1].' " }');
    }elseif ($action === "details"){
        $id = (int) filter_data($_POST['id']);
        if($result = $function->getDetail_user($id)){
            exitS('{"status":"success", "message":'.json_encode($result).' }');
        }
        exitS('{"status":"danger", "message":"<b>Invalid User Selected or Something bad happened try later</b>" }');
    }
}elseif ($ajax  === 'customer-product') {                 ////  Fetch Dependent Chain Select Options ////
    if ($action === "details"){
        $id = (int) filter_data($_POST['id']);
        if($result = $function->getDetail_customerProduct($id)){
            exitS('{"status":"success", "message":'.json_encode($result).' }');
        }
        exitS('{"status":"danger", "message":"<b>Invalid Customer Product Selected or Something bad happened try later</b>" }');
    }
}elseif ($ajax  === 'customer-personal') {                 ////  Fetch Dependent Chain Select Options ////
    if ($action === "details"){
        $id = (int) filter_data($_POST['id']);
        if($result = $function->getDetail_customer($id)){
            exitS('{"status":"success", "message":'.json_encode($result).' }');
        }
        exitS('{"status":"danger", "message":"<b>Invalid CRN Selected or Something bad happened try later</b>" }');
    }
}elseif ($ajax  === 'center') {                   ////  Fetch Dependent Chain Select Options ////
    if ($action === "details"){
        $id = (int) filter_data($_POST['id']);
        if($result = $function->getDetail_center($id)){
            exitS('{"status":"success", "message":'.json_encode($result).' }');
        }
        exitS('{"status":"danger", "message":"<b>Invalid Center Selected or Something bad happened try later</b>" }');
    }
}
exitS('{"status":"danger", "message":"Unable to process your request, Please Try Later " }');