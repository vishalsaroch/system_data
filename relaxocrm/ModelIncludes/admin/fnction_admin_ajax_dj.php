<?php

CLASS FunctionsA extends Connection {

################################################### INSERT
    function deleteData_table($table, $id){
        switch ($table) {
            case 'user':
                $table = "users_personal";
                $whereCond = " ul_user_id = :id ";
                $WhereVars = array(":id"=>$id);
                break;

            case 'spare':
                $table = "client_spares";
                $whereCond = " ul_spare_id = :id ";
                $WhereVars = array(":id"=>$id);
                break;

            case 'product':
                $table = "client_products";
                $whereCond = " ul_product_id = :id ";
                $WhereVars = array(":id"=>$id);
                break;

            case 'center':
                $table = "partners_centers";
                $whereCond = " ul_center_id = :id ";
                $WhereVars = array(":id"=>$id);
                break;

            case 'customer-personal':
                $table = "clients_customers";
                $whereCond = " ul_customer_id = :id ";
                $WhereVars = array(":id"=>$id);
                break;

            case 'customer-product':
                $table = "clients_customers_products";
                $whereCond = " ul_customer_product_id = :id ";
                $WhereVars = array(":id"=>$id);
                break;

            case 'job':
                $table = "complaints_jobs";
                $whereCond = " ul_job_id = :id ";
                $WhereVars = array(":id"=>$id);
                break;

            case 'ticket':
                $table = "complaints_data";
                $whereCond = " ul_complaint_id = :id ";
                $WhereVars = array(":id"=>$id);
                break;

            case 'feedback':
                $table = "complaints_feedback";
                $whereCond = " ul_feedback_id = :id ";
                $WhereVars = array(":id"=>$id);
                break;

            case 'product-spare':
                echo $id;
                list($prd,$spr) = explode('-', $id);
                $table = "client_product_spares";
                $whereCond = " ul_product_id = :prd AND ul_spare_id = :spr ";
                $WhereVars = array(":prd"=>$prd, ":spr"=>$spr);
                break;

            default:
                return false;
                break;
        }
        $deletedData = $this->getArrayOptions_All_Table($table, "*", " WHERE $whereCond", $WhereVars);
        if ($this->deleteData($table, $whereCond, $WhereVars)) {
            $this->logEvent("Deleted $table", $deletedData, 1);
            $this->setMessage(array('success', "Details successfully deleted"));
            return true;
        }
        $this->logEvent("Delete $table", array("Unable to delete $id "), 0);
        return false;
    }

    function updateData_STATUS($table, $id, $status){
        $statuses = ["block"=>0, "unblock"=>1];
        switch ($table) {
            case 'user':
                $table = "users_login";
                $q = "UPDATE users_login SET ul_status = :status WHERE ul_user_id = :id LIMIT 1 ";
                $vars = array(":status"=>$statuses[$status], ":id"=>$id);
                break;

            case 'spare':
                $table = "client_spares";
                $q = "UPDATE client_spares SET ul_status = :status WHERE ul_spare_id = :id LIMIT 1 ";
                $vars = array(":status"=>$statuses[$status], ":id"=>$id);
                break;

            case 'product':
                $table = "client_products";
                $q = "UPDATE client_products SET ul_status = :status WHERE ul_product_id = :id LIMIT 1 ";
                $vars = array(":status"=>$statuses[$status], ":id"=>$id);
                break;

            case 'center':
                $table = "partners_centers";
                $q = "UPDATE partners_centers cen SET cen.ul_status = :status WHERE cen.ul_center_id = :id ";
                $vars = array(":status"=>$statuses[$status], ":id"=>$id);
                break;

            default:
                return false;
                break;
        }
        $solution = $this->dbConn->prepare($q);
        if ($solution->execute($vars)) {
            $this->logEvent("Updated $table", "Status of $id CHanged to $status", 1);
            $this->setMessage(array('success', "Status successfully Changed ({$status}ed)"));
            return true;
        }
        $this->setMessage(array('danger', "Unable to Update Status, Try Later"));
        echo $solution = $this->dbConn->errorInfo()[2].$solution->errorInfo()[2];
        $this->logEvent("Updated $table", "Status of $id tried to Changed to $status", 0);
        return false;
    }

    function insertData_newSpare($array, $isUpdate){
        $this->dbConn->beginTransaction();
        if ($id = $this->insertData('client_spares', $array, $isUpdate)) {
            $_SESSION['MSG'] = array('success', "Spare Successfully added ");
            $this->dbConn->commit();
            $this->logEvent('client_spares', $array, 1);
            return $id;
        }
        $this->dbConn->rollBack();
        $this->logEvent('client_spares', $array, 0);
        return false;
    }

    function updateData_spare($array, $id){
        $this->dbConn->beginTransaction();
        if ($id = $this->insertData('client_spares', $array)) {
            $_SESSION['MSG'] = array('success', "Spare Successfully added ");
            $this->dbConn->commit();
            $this->logEvent('client_spares', $array, 1);
            return $id;
        }
        $this->dbConn->rollBack();
        $this->logEvent('client_spares', $array, 0);
        return false;
    }

    function insertData_newProduct($array, $spares, $isUpdate){
        $this->dbConn->beginTransaction();
        if ($id = $this->insertData('client_products', $array, $isUpdate)) {
            $solution = $this->dbConn->prepare("DELETE FROM client_product_spares WHERE ul_product_id = :id;");
            $solution->execute(array(':id'=>$id));
            foreach ($spares as $key => $value) {
                $spareArray = array('product_id'=>$id, 'spare_id'=>$key, 'quantity'=>$value);
                $this->insertData('client_product_spares', $spareArray);
            }
            $_SESSION['MSG'] = array('success', "Product Successfully added ");
            $this->dbConn->commit();
            $this->logEvent('client_products', $array, 1);
            return $id;
        }
        $this->dbConn->rollBack();
        $this->logEvent('client_products', $array, 0);
        return false;
    }

    function insertData_newCenterCumUser($centerData, $userData, $password, $level = 1){
        $this->dbConn->beginTransaction();
        if ($userData['center_id'] = $this->insertData('partners_centers', $centerData)) {
            $salt = hash('sha512', str_shuffle('ABCDEFGHJKLMNPprstuvwxyz23456789'));
            $password = hash('sha512', $password.'_dj_'.$salt);
            if ($id = $this->insertData('users_personal', $userData)) {
                $loginArray = array('user_id' => $id, 'pass' => $password, 'salt' => $salt, 'level' => $level);
                if ($this->insertData('users_login', $loginArray)) {
                    $this->dbConn->commit();
                    $this->setMessage(array('success', "Center & User successfully registered with us"));
                    $this->logEvent('center,users_login,personal', array_merge($loginArray, $userData, $centerData), 1);
                    return $userData['center_id'];
                }else{
                    $this->dbConn->rollBack();
                    $this->logEvent('users_login', $loginArray, 0);
                    return false;
                }
            }
            $this->dbConn->rollBack();
            $this->logEvent('users_personal', $userData, 0);
            return false;
        }
        $this->dbConn->rollBack();
        $this->logEvent('partners_centers', $centerData, 0);
        return false;
    }

    function insertData_inwardChallan($array, $spares, $code){
        $this->dbConn->beginTransaction();
        $q = "INSERT INTO spares_inventory_transactions ( ul_code, ul_code_type, ul_center_id, ul_spare_id, ul_stock, ul_price, ul_gst, ul_type, ul_date) VALUES ".implode(', ', $array);
        $shoppo = $this->dbConn->prepare($q);
        if ($shoppo->execute($spares)) {
            $this->dbConn->commit();
            $this->setMessage(array('success', "Challan\/Invoice <b>$code</b> Successfully Added"));
            $this->logEvent('spares_inventory_transactions', $spares, 1);
            return true;
        }
        list($errorSQLstate, $errorCode, $errorMsg) = $shoppo->errorInfo();
        $this->error = $this->dbConn->errorInfo()[2]." $errorCode : $errorMsg";
        $this->getSetSQLError($errorCode, $errorMsg);
        $this->dbConn->rollBack();
        $this->logEvent('spares_inventory_transactions', $spares, 0);
        return false;
    }

    function insertData_expense($array, $expenses, $code){
        $this->dbConn->beginTransaction();
        $q = "INSERT INTO client_expenses ( ul_code, ul_amount, ul_gst, ul_type, ul_date, ul_description) VALUES ".implode(', ', $array);
        $shoppo = $this->dbConn->prepare($q);
        if ($shoppo->execute($expenses)) {
            $this->dbConn->commit();
            $this->setMessage(array('success', "Expense\/Income <b>$code</b> Successfully Added"));
            $this->logEvent('client_expenses', $expenses, 1);
            return true;
        }
        list($errorSQLstate, $errorCode, $errorMsg) = $shoppo->errorInfo();
        $this->error = $this->dbConn->errorInfo()[2]." $errorCode : $errorMsg";
        $this->getSetSQLError($errorCode, $errorMsg);
        $this->dbConn->rollBack();
        $this->logEvent('client_expenses', $expenses, 0);
        return false;
    }

    function insertData_warranty($customerData, $productData, $isUpdate){
        print_r($customerData);
        print_r($productData);
        echo "$isUpdate";
        if (is_int($customerData)) {
            $productData['customer_id'] = $customerData;
        }elseif($customerData && ($id = $this->insertData('clients_customers', $customerData, $isUpdate))){
            $productData['customer_id'] = $id;
            if ($isUpdate == "customer-personal"){
                $this->logEvent('customers updated', $customerData, 1);
                $this->setMessage(array('success', "Customer Details Successfully updated"));
                return true;
            }
        }elseif($isUpdate != "customer-product"){
            $this->logEvent('clients_customers', $customerData, 0);
            return false;
        }
        $this->dbConn->beginTransaction();
        if (($productData['customer_id'] && ($isUpdate != "customer-personal")) || ($isUpdate == "customer-product")) {
            if ($id = $this->insertData('clients_customers_products', $productData, $isUpdate)) {
                $return = array('crn'=>"C".date('ymd').$productData['customer_id'], 'cpid'=>$id);
                $this->dbConn->commit();
                if ($isUpdate) {
                    $this->setMessage(array('success', "Customer Product successfully Updated"));
                    $this->logEvent('customers_products updated', $productData, 1);
                    return true;
                }else{
                    $this->setMessage(array('success', "Customer & Product successfully registered with CRN #$return[crn] <a href='/BestWebs?module=warranty&mode=add&type=new&crn=$return[crn]' target='_blank'> Add More Product</a> or <a href='/BestWebs?module=ticket&mode=add&type=new&crn=$return[crn]' target='_blank'> Click Here to add Ticket/Complaint</a>"));
                    $this->logEvent('customers,customers_products', array_merge($productData, $customerData), 1);
                    return $return;
                }
            }
            $this->dbConn->rollBack();
            $this->logEvent('clients_customers_products', $productData, 0);
            return false;
        }
    }

    function insertData_ticket($complaintData, $customerData, $warranty_status, $isUpdate){
        $complaintData["user_id"] = $this->user;
        $this->dbConn->beginTransaction();
        if ($id = $this->insertData('complaints_data', $complaintData, $isUpdate)) {
            $this->updateData('clients_customers', ' ul_customer_id = :customer ', array(":customer"=>$complaintData["customer_id"]), $customerData);
            $this->updateData('clients_customers_products', ' ul_customer_product_id = :product ', array(":product"=>$complaintData["customer_product_id"]), array("warranty_status"=>$warranty_status));
            $this->dbConn->commit();
            $this->setMessage(array('success', "Ticket/Complaint <b>$id</b> Successfully ".($isUpdate ? "Updated" : "Raised")));
            $this->logEvent('complaints_data, customers', array_merge($complaintData, $customerData), 1);
            return $id;
        }
        $this->dbConn->rollBack();
        $this->logEvent('complaints_data', $complaintData, 0);
        return false;
    }

    function insertData_job($jobData, $spareData, $complaintData){
        $jobData["user_id"] = $this->user;
        $this->dbConn->beginTransaction();
        $complaintData['status'] = $jobData['status'];
        if ($id = $this->insertData('complaints_jobs', $jobData)) {
            if($this->updateData('complaints_data', ' ul_complaint_id = :complaint ', array(":complaint"=>$jobData["complaint_id"]), $complaintData)){
                if (count($spareData) > 1) {
                    $spares = array();
                    foreach ($spareData as $spare) {
                        $spares[] = " ($id, $spare) ";
                    }
                    $q = "INSERT INTO complaints_jobs_spares (ul_job_id, ul_spare_id) VALUES ".implode(",", $spares);
                    $shoppo = $this->dbConn->prepare($q);
                    if ($shoppo->execute()) {
                        $_SESSION['MSG'] = array('success', "Job #$id Successfully added ");
                        $this->dbConn->commit();
                        $this->logEvent('complaints_jobs', $jobData, 1);
                        return $id;
                    }
                }elseif (count($spareData) == 1) {
                    $spareData = array("spare_id"=>$spareData[0], "job_id"=>$id);
                    if ($this->insertData('complaints_jobs_spares', $spareData)) {
                        $_SESSION['MSG'] = array('success', "Job #$id Successfully added ");
                        $this->dbConn->commit();
                        $this->logEvent('complaints_jobs', $jobData, 1);
                        return $id;
                    }
                }else{
                    $_SESSION['MSG'] = array('success', "Job #$id Successfully added ");
                    $this->dbConn->commit();
                    $this->logEvent('complaints_jobs', $jobData, 1);
                    return $id;
                }
                $this->dbConn->rollBack();
                $this->logEvent('complaints_jobs_spares', $spareData, 0);
                return false;
            }
            $complaintData["complaint_id"] = $jobData["complaint_id"];
            $this->dbConn->rollBack();
            $this->logEvent('complaints_data', $complaintData, 0);
            return false;
        }
        $this->dbConn->rollBack();
        $this->logEvent('complaints_jobs', $jobData, 0);
        return false;
    }

    function insertData_newUser($userData, $password, $level = 1){
        $this->dbConn->beginTransaction();
        if ($_SESSION['SESS__center_id'] != 1) $userData['center_id'] = $_SESSION['SESS__center_id'];
        $salt = hash('sha512', str_shuffle('ABCDEFGHJKLMNPprstuvwxyz23456789'));
        $password = hash('sha512', $password.'_dj_'.$salt);
        if ($id = $this->insertData('users_personal', $userData)) {
            $loginArray = array('user_id' => $id, 'pass' => $password, 'salt' => $salt, 'level' => $level);
            if ($this->insertData('users_login', $loginArray)) {
                $this->dbConn->commit();
                $this->setMessage(array('success', "User successfully registered with us"));
                $this->logEvent('users_login,users_personal', array_merge($loginArray, $userData), 1);
                return $id;
            }else{
                $this->dbConn->rollBack();
                $this->logEvent('users_login', $loginArray, 0);
                return false;
            }
        }
        $this->dbConn->rollBack();
        $this->logEvent('users_personal', $userData, 0);
        return false;
    }

    function updateData_resetPassword($user, $pass){
        $password = hash('sha512',$pass);
        $this->dbConn->beginTransaction();
        $salt = hash('sha512', str_shuffle('ABCDEFGHJKLMNPprstuvwxyz23456789'));
        $password = hash('sha512', $password.'_dj_'.$salt);
        $data = array(
            "pass"=>$password,
            "salt"=>$salt
        );
        if ($this->updateData('users_login', ' ul_user_id = :user ', array(":user"=>$user), $data)) {
            $this->dbConn->commit();
            $this->setMessage(array('success', " User Password Successfully reseted to <b>$pass</b> "));
            $this->logEvent('users_login', array(" Password Reseted of user $user"), 1);
            return true;
        }
        $this->dbConn->rollBack();
        if(! isset($_SESSION['MSG'])) $this->setMessage(array('danger', "Unable to Reset this Password, Please Try Later"));
        $this->logEvent('users_login', array("Unable to Reset Password of user $user"), 0);
        return false;
    }

    function updateData_userPassword($password, $opassword){
        $userId = $this->user;
        $user_browser = (string) $_SERVER['HTTP_USER_AGENT'];
        $shoppo = $this->dbConn->prepare("SELECT ul_salt salt, ul_pass password FROM users_login WHERE ul_user_id = :id LIMIT 1");
        $shoppo->execute(array(':id'=>$userId));
        if ($row = $shoppo->fetch(PDO::FETCH_ASSOC)) {
            if ($row['password'] === hash('sha512', $opassword.'_dj_'.$row['salt'])) {
                $salt = hash('sha512', str_shuffle('ABCDEFGHJKLMNPprstuvwxyz23456789'));
                $password = hash('sha512', $password.'_dj_'.$salt);
                $shoppo = $this->dbConn->prepare("UPDATE users_login SET ul_pass = :password, ul_salt = :salt WHERE ul_user_id = :id LIMIT 1");
                if ($shoppo->execute(array(':id'=>$userId, ':password'=>$password, ':salt'=>$salt))) {
                    $_SESSION['SESS__password'] = hash('sha512', $password .'_dj_'. $user_browser);
                    $this->setMessage(array('success', 'Password Successfully Changed'));
                    $event = "Changed Password from ".$row['password'];
                    $this->logEvent('users_login', array(" Password Changed "), 1);
                    return true;
                }
                $this->setMessage(array('danger', 'Unable to update password, Please try later'));
            }else{
                $this->setMessage(array('danger', 'Incorrect Current Password'));
            }
        }else{
            $this->setMessage(array('danger', 'Unable to update password, Please try later'));
        }
        $event = "Unable to update Password to $password Error - ".$this->dbConn->errorInfo()[2];
        $this->logEvent('users_login', array("Unable to Change Password"), 0);
        return false;
    }

    function insertData_newPinCode($details){
        $this->dbConn->beginTransaction();
        if ($id = $this->insertData('pincodes_data', $details)) {
            $this->dbConn->commit();
            $this->setMessage(array('success', "Pincode <b>$details[pincode]</b> Successfully Added"));
            $this->logEvent('pincodes_data', $details, 1);
            return $id;
        }
        $this->dbConn->rollBack();
        $this->logEvent('pincodes_data', $details, 0);
        return false;
    }

################################################### UPDATE

    function updateData_missCall($id, $status, $details = ''){
        if($details){
            $statusType = 'ul_status = 1';
        }else {
            $statusType = 'ul_status = -1';
            $details = "No Tagging, Force Closed!";
        }
        $data = array("status"=>$status, "user_id"=>$this->user, "details"=>$details);
        if ($this->updateData('clients_customers_misscall', " ul_misscall_id = :misscall AND $statusType ", array(":misscall"=>$id), $data)) {
            $data["misscall_id"] = $id;
            $this->setMessage(array('success', "Call Successfully Completed"));
            $this->logEvent('clients_customers_misscall', $data, 1);
            return $id;
        }
        $data["misscall_id"] = $id;
        $this->setMessage(array('success', "Call Already Completed by Others"));
        $this->logEvent('clients_customers_misscall', $data, 0);
        return true;
    }

    function updateData_ticketTechnician($ticket, $user){
        $data = array("complaint_id"=>$ticket, "center_user_id"=>$user);
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $where = "com.ul_complaint_id = :complaint";
            $whereArray = array(":user"=>$user, ':complaint'=>$ticket);
        }else{
            $where = "com.ul_complaint_id = :complaint AND com.ul_center_id = :center";
            $whereArray = array(":user"=>$user, ':complaint'=>$ticket, ':center'=>$centerId);
        }
        $this->dbConn->beginTransaction();
        $solution = $this->dbConn->prepare("UPDATE complaints_data com SET com.ul_centers_user_id = :user WHERE $where LIMIT 1;");
        if ($solution->execute($whereArray)) {
            $this->dbConn->commit();
            $this->setMessage(array('success', "Technician Successfully Assigned"));
            $this->logEvent('complaints_data', $data, 1);
            return true;
        }
        $this->dbConn->rollBack();
        $this->setMessage(array('danger', "Unable to Assign Technician, Please try later after refreshing Page"));
        $this->logEvent('complaints_data', $data, 0);
        return false;
    }

    function insertData_ticketFeedback($data){
        $data['user_id'] = $this->user;
        $this->dbConn->beginTransaction();
        if ($id = $this->insertData('complaints_feedback', $data)) {
            $this->dbConn->commit();
            $this->setMessage(array('success', "Feedback Successfully Added"));
            $this->logEvent('complaints_feedback', $data, 1);
            return true;
        }
        $this->dbConn->rollBack();
        $this->setMessage(array('danger', "Unable to Add Feedback, Please try later or refresh Page"));
        $this->logEvent('complaints_feedback', $data, 0);
        return false;
    }
};
$functionA = new FunctionsA();