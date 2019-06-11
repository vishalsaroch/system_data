<?php

CLASS ajaxProcess extends Connection{

    function registerCustomer($array){
        if ($id = $this->insertData('complaints_users', $array)) {
            $this->logEvent("New Customer Registered # $id ---  Data# - ".json_encode($array), 1);
            return  $id;
        }
        $this->logEvent("Unable to register new Customer ERROR# - $this->error ------ Data# - ".json_encode($array), 0);
        return false;
    }

    function registerCustomerProduct($array){
        if ($id = $this->insertData('complaints_user_products', $array)) {
            $this->logEvent("New Customer's Product Registered # $id ---  Data# - ".json_encode($array), 1);
            return  $id;
        }
        $this->logEvent("Unable to register new Customer's Product ERROR# - $this->error ------ Data# - ".json_encode($array), 0);
        return false;
    }

    function registerComplaint($array){
        $array['user_id'] = (int) $this->user;
        if ($id = $this->insertData('complaints_data', $array)) {
            $this->logEvent("New Complaint Registered for Customer # ".$array['customer_id']."  ---  Data# - ".json_encode($array), 1);
            return  $id;
        }
        $this->logEvent("Unable to register Customer Complain ERROR# - $this->error ------ Data# - ".json_encode($array), 0);
        return false;
    }

    function updateCustomer($array, $id){
        $params = array();
        $paramArray = array(':id'=>$id);
        foreach ($array as $key => $value) {
            $params[] =  "ul_$key = :$key";
            $paramArray[":$key"] = $value;
        }
        $params = implode(", ", $params);

        $shoppo = $this->dbConn->prepare("UPDATE complaints_users SET
            $params
            WHERE ul_customer_id = :id
            LIMIT 1");
        if ($shoppo->execute($paramArray)) {
            $this->setMessage(array('success', 'Details Successfully Updated'));
            $event = "Customer #".$id." Updated new details are ".json_encode($array);
            $this->logEvent($event, 1);
            return $id;
        }else{
            $this->setMessage(array('danger', 'Unable to update Customer details, Please try later'));
        }
        $event = "Unable to update Customer #".$id." as ".json_encode($array)." Error - ".$this->dbConn->errorInfo()[2];
        $this->logEvent($event, 0);
        return false;
    }

    function updateCustomerProduct($array, $id){
        $params = array();
        $paramArray = array(':id'=>$id);
        foreach ($array as $key => $value) {
            $params[] =  "ul_$key = :$key";
            $paramArray[":$key"] = $value;
        }
        $params = implode(", ", $params);
        $shoppo = $this->dbConn->prepare("UPDATE complaints_user_products SET
            $params
            WHERE ul_customer_product_id = :id
            LIMIT 1");
        if ($shoppo->execute($paramArray)) {
            $this->setMessage(array('success', 'Details Successfully Updated'));
            $event = "Customers Product #".$id." Updated new details are ".json_encode($array);
            $this->logEvent($event, 1);
            return $id;
        }else{
            $this->setMessage(array('danger', 'Unable to update Customers Product details, Please try later'));
        }
        $event = "Unable to update Customers Product #".$id." as ".json_encode($array)." Error - ".$this->dbConn->errorInfo()[2];
        $this->logEvent($event, 0);
        return false;
    }

    function updateComplaint($array, $id){
        $params = array();
        $paramArray = array(':id'=>$id);
        foreach ($array as $key => $value) {
            $params[] =  "ul_$key = :$key";
            $paramArray[":$key"] = $value;
        }
        $params = implode(", ", $params);
        $shoppo = $this->dbConn->prepare("UPDATE complaints_data SET
            $params
            WHERE ul_complaint_id = :id
            LIMIT 1");
        if ($shoppo->execute($paramArray)) {
            $this->setMessage(array('success', 'Details Successfully Updated'));
            $event = "Complaint #".$id." Updated new details are ".json_encode($array);
            $this->logEvent($event, 1);
            return $id;
        }else{
            $this->setMessage(array('danger', 'Unable to update Complaint details, Please try later'));
        }
        $event = "Unable to update Complaint #".$id." details as ".json_encode($array)." Error - ".$shoppo->errorInfo()[2];
        $this->logEvent($event, 0);
        return false;
    }

    function registerJob($array, $purchaseDate){
        $array['user_id'] = (int) $this->user;
        //print_r($array);
        if ($id = $this->insertData('complaints_jobs', $array)) {
            $this->logEvent("New Job Registered ------ Data# - ".json_encode($array), 1);
            if ($purchaseDate) {
                $shoppo = $this->dbConn->prepare("UPDATE complaints_user_products usrPrd
                                                INNER JOIN complaints_data com ON com.ul_customer_id = usrPrd.ul_customer_id
                                                SET usrPrd.ul_purchase_date = :date
                                                WHERE com.ul_complaint_id = :id;");
                if (! $shoppo->execute(array(':id'=>$array['complaint_id'], ':date'=>$purchaseDate))) {
                    $this->logEvent("Unable to update date of purchase for Job #$id  ERROR# - ".$shoppo->errorInfo()[2], 0);
                    $this->setMessage(array("danger", "Job #$id Successfully Saved but Date of Purchase has not updated."));
                }
            }
            return  $id;
        }
        $this->logEvent("Unable to register Job ERROR# - $this->error ------ Data# - ".json_encode($array), 0);
        return false;
    }

    function deleteData_userAddress($addressId){
        $userId = $this->userId;
        $whereCond = "ul_address_id = :id AND ul_user_id = :user";
        $WhereVars = array(':id' => $addressId, ':user' => $addressId);
        if ($this->deleteData('users_addresses', $whereCond, $WhereVars, 1)) {
            return true;
        }else{
            return false;
        }
    }

    function insert_newsLetter($email){
        $array = array('email' => $email, 'ip' => $this->ip);
        if ($id = $this->insertData('frontend_newsletter', $array)) {
            return  true;
        }
        return false;
    }

};
$ajaxF = new ajaxProcess();