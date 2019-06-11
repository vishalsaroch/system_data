<?php
$ajax  = $_POST['ajax'];
unset($_POST['ajax']);
$level = $_SESSION['SESS__azz_level'];
if (! $level) {
    echo '{"status":"danger", "message":"Invalid Request, Please Login"}';
    exit;
}

if ($ajax  === 'addTicket') {						////  Ticket Add  Process ////
    if (! $_POST['customer']['alternate_mobile']) {
        $alt_mobile = false;
        unset($_POST['customer']['alternate_mobile']);
    }else{
        $alt_mobile = $_POST['customer']['alternate_mobile'];
    }
    if (! $_POST['product']['purchase_date']) {
        unset($_POST['product']['purchase_date']);
    }

    list($customer_id, $customer_product_id, $product_id) = explode(',', filter_data($_POST['customer_id']));

    $customer = array();
    foreach ($_POST['customer'] as $key => $value) {
        $customer[filter_data($key)] = filter_data($value);
    }
    if (! $customer_id) {
        $customer_id = $ajaxF->registerCustomer($customer);
    }

    if (! $customer_product_id) {
        $customer_product = array();
        foreach ($_POST['product'] as $key => $value) {
            $customer_product[filter_data($key)] = filter_data($value);
        }
        $customer_product['customer_id'] = $customer_id;
        $customer_product_id = $ajaxF->registerCustomerProduct($customer_product);
    }

    $complaint = array();
    foreach ($_POST['complaint'] as $key => $value) {
        $complaint[filter_data($key)] = filter_data($value);
    }
    $complaint['code'] = strtoupper($complaint['code']);
    $complaint['customer_id'] = (int) $customer_id;
    $complaint['customer_product_id'] = (int) $customer_product_id;
    $complaint['otp'] = str_shuffle(mt_rand(1000,9999));
    if ($complaint_id = $ajaxF->registerComplaint($complaint)) {
        require_once MODEL_DIRECTORY.'/sms.php';
        $complaint_id = str_pad($complaint_id, 6, 0, STR_PAD_LEFT);
        $responce1 = sendRegSMS($customer['mobile'], $complaint_id, $complaint['otp'])['return'];
        $responce1 = $responce1 ? ' Customer SMS Sent ' : ' Customer SMS Not Sent '.'<a href=\'/tickets-new/'.$complaint_id.'/resendSMSCus\' title=\'Resend Customer SMS\'>Resend</a> ';
        $city = $function->get_cityByPin($customer['pin'])[0];
        $address = $customer['address'].', '.$city['city'].', '.$city['district'].' - '.$customer['pin'];
        $product = filter_data($_POST['productName'].' - '.$_POST['productModel']);
        $numbers = filter_data($_POST['centerContact']);
        $responce2 = sendPartnerSMS($numbers, $complaint_id, $customer['name'], $customer['mobile'], $alt_mobile, $address, $complaint['details'], $product)['return'];
        $responce2 = $responce2 ? ' Service Center SMS Sent ' : ' Service Center SMS Not Sent '.'<a href=\'/tickets-new/'.$complaint_id.'/resendSMSCen\' title=\'Resend Center SMS\'>Resend</a> ';
        echo '{"status":"success", "message":"Ticket Successfully Raised with Complaint No. <b># '.$complaint_id.'</b>, '.$responce1.', '.$responce2.'"}';
        exit;
    }else{
        echo '{"status":"danger", "message":"Unable to raise ticket ('.$_SESSION['MSG'][1].'), Please Try Later "}';
        exit;
    }
}elseif (($ajax  === 'updateTicket') && $level > 7) {                      ////  Ticket Add  Process ////
    if (! $_POST['customer']['alternate_mobile']) {
        unset($_POST['customer']['alternate_mobile']);
    }
    if (! $_POST['product']['purchase_date']) {
        unset($_POST['product']['purchase_date']);
    }

    list($customer_id, $customer_product_id, $product_id) = explode(',', filter_data($_POST['customer_id']));
    $complaint_id = (int) $_POST['complaint_id'];

    $customer = array();
    foreach ($_POST['customer'] as $key => $value) {
        $customer[filter_data($key)] = filter_data($value);
    }
    $customer_id = (int) $customer_id;
    $customer_id = $ajaxF->updateCustomer($customer, $customer_id);

    $customer_product = array();
    foreach ($_POST['product'] as $key => $value) {
        $customer_product[filter_data($key)] = filter_data($value);
    }
    $customer_product_id = (int) $customer_product_id;
    $customer_product_id = $ajaxF->updateCustomerProduct($customer_product, $customer_product_id);

    $complaint = array();
    foreach ($_POST['complaint'] as $key => $value) {
        $complaint[filter_data($key)] = filter_data($value);
    }
    $complaint_id = (int) $complaint_id;
    $complaint_id = $ajaxF->updateComplaint($complaint, $complaint_id);
    if ($customer_id && $customer_product_id && $complaint_id) {
        require_once MODEL_DIRECTORY.'/sms.php';
        $complaint_id = str_pad($complaint_id, 6, 0, STR_PAD_LEFT);

        $city = $function->get_cityByPin($customer['pin'])[0];
        $address = $customer['address'].', '.$city['city'].', '.$city['district'].' - '.$customer['pin'];
        $product = filter_data($_POST['productName'].' - '.$_POST['productModel']);
        $numbers = filter_data($_POST['centerContact']);
        $responce2 = sendPartnerSMS($numbers, $complaint_id, $customer['name'], $customer['mobile'], $address, $complaint['details'], $product, true)['return'];
        $responce2 = $responce2 ? ' Service Center SMS Sent ' : ' Service Center SMS Not Sent '.'<a href=\'/tickets-new/'.$complaint_id.'/resendSMSCen\' title=\'Resend Center SMS\'>Resend</a> ';
        echo '{"status":"success", "message":"Ticket <b># '.$complaint_id.'</b> Successfully Updated, '.$responce2.'"}';
        exit;
    }else{
        echo '{"status":"danger", "message":"Ticket not Updated, ('.$_SESSION['MSG'][1].'), Please Try Later "}';
        exit;
    }
}elseif (($ajax  === 'OLDupdateTicket') && $level > 7) {                       ////  Ticket Add  Process ////
    $customer_id = (int) filter_data($_POST['customer_id']);
    $customer = array();
    foreach ($_POST['customer'] as $key => $value) {
        $customer[filter_data($key)] = filter_data($value);
    }
    $complaint = array();
    foreach ($_POST['complaint'] as $key => $value) {
        $complaint[filter_data($key)] = filter_data($value);
    }
    $complaint['code'] = strtoupper($complaint['code']);
    $complaint['customer_id'] = $customer_id;
    $complaint['otp'] = str_shuffle(mt_rand(1000,9999));
    if (($complaint_id = $ajaxF->updateComplaint($complaint)) && ($customer_id = $ajaxF->updateCustomer($customer))) {
        require_once MODEL_DIRECTORY.'/sms.php';
        $complaint_id = str_pad($complaint_id, 6, 0, STR_PAD_LEFT);
        $city = $function->get_cityByPin($customer['pin'])[0];
        $address = $customer['address'].', '.$city['city'].', '.$city['district'].' - '.$customer['pin'];
        $product = filter_data($_POST['product'].' - '.$_POST['productModel']);
        $numbers = filter_data($_POST['centerContact']);
        $responce2 = sendPartnerSMS($numbers, $complaint_id, $customer['name'], $customer['mobile'], $address, $complaint['details'], $product, true)['return'];
        $responce2 = $responce2 ? ' Service Center SMS Sent ' : ' Service Center SMS Not Sent ';
        echo '{"status":"success", "message":"Ticket <b># '.$complaint_id.'</b> Successfully Updated, '.$responce2.'"}';
        exit;
    }else{
        echo '{"status":"danger", "message":"Unable to update ticket ('.$_SESSION['MSG'][1].'), Please Try Later"}';
        exit;
    }
}elseif ($ajax  === 'addJob') {                       ////  Ticket Add  Process ////

    ########## start ADMIN CLOSING #############
    if (($_POST['job']['type'] === 'Closed by Admin') && ($level > 7)) {
        $job = array();
        foreach ($_POST['job'] as $key => $value) {
            $job[filter_data($key)] = filter_data($value);
        }
        if (isset($_POST['purchase_date']) && (! $_POST['purchase_date'])) {
            unset($_POST['purchase_date']);
            $purchaseDate = false;
        }else{
            $purchaseDate = filter_data($_POST['purchase_date']);
        }
        $job['km_run'] = (int) $job['km_run'];
        if ($jobId = $ajaxF->registerJob($job, $purchaseDate)) {
            $jobId = str_pad($jobId, 6, 0, STR_PAD_LEFT);
            $status = ($job['status'] === '1') ? 'and Complaint Ticket Closed' : ' and Complaint Ticket Still Open';
            echo '{"status":"success", "message":"Job  # '.$jobId.' Successfully Added to Complaint '.$status.'"}';
            exit;
        }
        echo '{"status":"danger", "message":"Unable to Close, Please Try Again"}';
        exit;
     ########## end ADMIN CLOSING #############

     ########## start CANCELING #############
    }else if (($_POST['job']['type'] === 'Canceled')) {
        $job = array();
        foreach ($_POST['job'] as $key => $value) {
            $job[filter_data($key)] = filter_data($value);
        }
        $purchaseDate = false;
        $job['km_run'] = 0;

        if ($jobId = $ajaxF->registerJob($job, $purchaseDate)) {
            $jobId = str_pad($jobId, 6, 0, STR_PAD_LEFT);
            echo '{"status":"success", "message":"Job  # '.$jobId.' Successfully Added and Complaint #'.$job['complaint_id'].' Canceled"}';
            exit;
        }
        echo '{"status":"danger", "message":"Unable to Cancel, Please Try Again"}';
        exit;
     ########## end CANCELING #############
     ########## start Other TYPE #############
    }elseif (($_POST['job']['type'] === 'Service Center')) {
        $job = array();
        foreach ($_POST['job'] as $key => $value) {
            $job[filter_data($key)] = filter_data($value);
        }
        $job['status'] = -1;
        $purchaseDate = false;
        if ($jobId = $ajaxF->registerJob($job, $purchaseDate)) {
            $jobId = str_pad($jobId, 6, 0, STR_PAD_LEFT);
            $status = 'Complaint Re-scheduled';
            echo '{"status":"success", "message":"Job  # '.$jobId.' Successfully Added & Complaint Re-scheduled"}';
            exit;
        }
        echo '{"status":"danger", "message":"Unable to Close, Please Try Again"}';
        exit;
     ########## end ADMIN CLOSING #############

     ########## start CANCELING #############
    }else{
        if (isset($_POST['purchase_date']) && (! $_POST['purchase_date'])) {
            unset($_POST['purchase_date']);
            $purchaseDate = false;
        }else{
            $purchaseDate = filter_data($_POST['purchase_date']);
        }
        if (isset($_POST['tat']) && (! $_POST['tat'])) {
            unset($_POST['tat']);
        }

        $job = array();
        foreach ($_POST['job'] as $key => $value) {
            $job[filter_data($key)] = filter_data($value);
        }

        $otp = (int) $_POST['otp'];
        $ComplaintData = $function->getComplainOTP($job['complaint_id']);
        if (($ComplaintData['status'] === '1') || ($job['status'] < $ComplaintData['status']))  {
            echo '{"status":"danger", "message":"Complaint Already Closed or Proceeded, Please Try with New"}';
            exit;
        }elseif (($_SESSION['SESS__center_id'] != $ComplaintData['center']) && ('1' != $_SESSION['SESS__center_id'])) {
            echo '{"status":"danger", "message":"Invalid Complaint Ticket Selected, Please Try Again"}';
            exit;
        }elseif (($otp != $ComplaintData['otp']) && ($job['km_run'] !== '0')) {
            echo '{"status":"danger", "message":"Invalid Customer OTP, Please Try Again"}';
            exit;
        }
        if ($jobId = $ajaxF->registerJob($job, $purchaseDate)) {
            $jobId = str_pad($jobId, 6, 0, STR_PAD_LEFT);
            $status = ($job['status'] === '1') ? 'and Complaint Ticket Closed' : ' and Complaint Ticket Still Open';
            echo '{"status":"success", "message":"Job  # '.$jobId.' Successfully Added to Complaint '.$status.'"}';
            exit;
        }else{
            echo '{"status":"danger", "message":"Unable to add Job, Please Try Later"}';
            exit;
        }
    }
    exit;
}elseif ($ajax  === 'findTicket') {                        ////  Add to cart Process ////
    $qstring = filter_data($_POST['phrase']);
    $result = $function->getArray_tickeSearchResults($qstring);
    echo json_encode($result);
    exit;
}elseif ($ajax  === 'findCity') {                        ////  Add to cart Process ////
    $pin = (int) filter_data($_POST['pin']);
    $result = $function->get_cityByPin($pin);
    echo json_encode($result);
    exit;
}elseif ($ajax  === 'findDistrict') {                        ////  Add to cart Process ////
    $state = filter_data($_POST['state']);
    $result = $function->get_districtByState($state);
    echo json_encode($result);
    exit;
}elseif ($ajax  === 'findPin') {                        ////  Add to cart Process ////
    $district = filter_data($_POST['district']);
    $result = $function->get_cityByDistrict($district);
    echo json_encode($result);
    exit;
}elseif ($ajax  === 'ticketDetails') {                        ////  Add to cart Process ////
    $id = filter_data($_POST['tid']);
    if ($details = $function->get_ticket_details($id)) {
        echo   '<div class="modal-header">
                    <h3 class="printHeader"><img src="/assets/images/logo.png"></h3>
                    <button type="button" class="close pull-right noprint" data-dismiss="modal" aria-label="Close">
                        <span class="pull-right" aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span>
                    </button>
                    &nbsp; &nbsp; &nbsp; &nbsp;
                    <button  class="pull-right noprint" type="button" onclick="window.print();">
                        <span aria-hidden="true"><i class="glyphicon glyphicon-print"></i></span>
                    </button>
                    <h4 class="modal-title">Ticket Details #'.str_pad($details['code'], 6, 0, STR_PAD_LEFT).'</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                          <tr>
                            <th>Center:</th>
                            <td>'.$details['center'].'</td>
                          </tr>
                          <tr>
                            <th>Time:</th>
                            <td>'.$details['open_time'].' - '.$details['close_time'].'</td>
                          </tr>
                          <tr>
                            <th>Product:</th>
                            <td>'.$details['product'].', '.$details['proVariant'].'</td>
                          </tr>
                          <tr>
                            <th>Quantity:</th>
                            <td>'.$details['company'].'</td>
                          </tr>
                          <tr>
                            <th>Warranty:</th>
                            <td>'.$details['warranty'].'</td>
                          </tr>
                          <tr>
                            <th>Date of Purchase:</th>
                            <td>'.$details['dop'].'</td>
                          </tr>
                          <tr>
                            <th>Customer Name:</th>
                            <td>'.$details['customer'].'</td>
                          </tr>
                          <tr>
                            <th>Contact:</th>
                            <td>'.$details['mobile'].'/'.$details['alt_mobile'].'</td>
                          </tr>
                          <tr>
                            <th>Customer Email:</th>
                            <td>'.$details['email'].'</td>
                          </tr>
                          <tr>
                            <th>Customer Address:</th>
                            <td>'.$details['address'].', <br>'.$details['city'].', '.$details['district'].', '.$details['state'].'</td>
                          </tr>
                         <tr>
                            <th>City Pin:</th>
                            <td>'.$details['city_pin'].'</td>
                          </tr>
                          <tr>
                            <th>Issue/Details:</th>
                            <td>'.$details['details'].'</td>
                          </tr>
                          <tr class="noprint">
                            <th>ERM User:</th>
                            <td>'.$details['user'].'</td>
                          </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <table class="table">
                        <tr class="printHeader">
                            <td colspan="2">Work Job Done : <br><br><br></td>
                        </tr>
                        <tr class="printHeader">
                            <td colspan="2">Date : </td>
                        </tr>
                        <tr class="printHeader">
                            <td colspan="2">Technician Name & Contact : </td>
                        </tr>
                        <tr class="printHeader">
                            <td>OTP : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                            <td>Customer Signature</td>
                        </tr>
                    </table>
                </div>
        ';
    }else{
        echo "<p style='padding-top:80px;'><center>Something Wrong in this ticket</center></p>";
    }
    exit;
}elseif ($ajax === 'ticketJobDetails') {
    $ticketId = filter_data($_POST['tid']);
    if ($jobs = $function->get_ticket_job_details($ticketId)) {

        echo   '<div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></span></button>
                  <h4 class="modal-title">Job Details for Ticket #'.str_pad($ticketId, 6, 0, STR_PAD_LEFT).'</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive no-padding">';
        foreach ($jobs as $job) {
                  echo '<table class="table table-hover">
                          <tr>
                            <th>Job Id:</th>
                            <td>'.$job['jobId'].'</td>
                          </tr>
                          <tr>
                            <th>Center:</th>
                            <td>'.$job['centerName'].' ('.$job['center'].')</td>
                          </tr>
                          <tr>
                            <th>Attender:</th>
                            <td>'.$job['attender'].'</td>
                          </tr>
                          <tr>
                            <th>Work / Job:</th>
                            <td>'.$job['work'].'</td>
                          </tr>
                          <tr>
                            <th>Priority:</th>
                            <td>'.$job['priority'].'</td>
                          </tr>
                          <tr>
                            <th>Job Time:</th>
                            <td>'.$job['time'].'</td>
                          </tr>'.
                          (($job['user'] == 2) ?
                          '<tr>
                            <th>Worked/Closed/Canceled By:</th>
                            <td>Admin</td>
                          </tr>' :
                          '<tr>
                            <th>Worked/Closed/Canceled By:</th>
                            <td>Center</td>
                          </tr>').
                        '</table><hr>';
        }
        echo   '
                    </div>
                </div>
        ';
    }else{
        echo "<p style='padding-top:80px;'><center>Something Wrong in this ticket or No Job Done for this Ticket</center></p>";
    }
    exit;
}
echo "Error 404";