<?php

CLASS LoginProcess extends Connection{

    function insertData_newAddress($array){
    	$array['user_id'] = $this->user;
        $this->dbConn->beginTransaction();
        if ($id = $this->insertData('users_addresses', $array)) {
            $this->dbConn->commit();
            $this->setMessage(array('success', 'Address Successfully added'));
            return $id;
        }
       echo  $this->dbConn->errorInfo()[2];
        $this->dbConn->rollBack();
        $this->setMessage(array('danger', 'Address could not be added, try later'));
        return false;
    }

    function insertData_sessionData($cartArray, $orderArray){
    	$userId = $this->user;
    	$array = array('user_id'=>$userId, 'cart_json_array'=>$cartArray, 'order_json_array'=>$orderArray);
        $this->dbConn->beginTransaction();
        if ($id = $this->insertData('session_data', $array)) {
            $this->dbConn->commit();
            $this->setMessage(array('success', 'Order Successfully added'));
            return $id;
        }
        $this->dbConn->rollBack();
        $this->setMessage(array('danger', 'Order could not be added, try later'));
        return false;
    }

    function insertData_userOrder($orderArray, $cartArray){
    	$orderArray['user_id'] = $this->user;
    	echo '<pre>';print_r($orderArray);print_r($cartArray);
    	$this->dbConn->beginTransaction();
    	$count = 0;
    	foreach ($cartArray as $sku => $product) {
    		$orderArray['center_id'] = $product['center'];
    		$orderArray['sku'] = $sku;
    		$orderArray['amount'] = $product['totalAmount'];
    		$orderArray['quantity'] = $product['qty'];
    		$orderArray['delivery_date'] = date('Y-m-d', strtotime("+".$product['deliveryDays']." days"));
    		if ($id = $this->insertData('orders_data', $orderArray)) {
	            $count++;
	        }
    	}
    	if ($count == count($cartArray)) {
    		$this->dbConn->commit();
    		$this->setMessage(array('success', 'Order Successfully added, thanks for choosing us'));
    		return true;
    	}elseif ($count) {
    		$this->dbConn->commit();
    		$this->setMessage(array('danger', 'Order Partially added, thanks for choosing us'));
    		return true;
    	}
        $this->dbConn->rollBack();
        return false;
    }

    function updateData_userPassword($password, $opassword){
    	$userId = $this->user;
    	$user_browser = (string) $_SERVER['HTTP_USER_AGENT'];
    	$shoppo = $this->dbConn->prepare("SELECT ul_salt salt, ul_pass password FROM users_login WHERE ul_user_id = :id LIMIT 1");
        $shoppo->execute(array(':id'=>$userId));
        if ($row = $shoppo->fetch(PDO::FETCH_ASSOC)) {
        	if ($row['password'] === hash('sha512', $opassword.'_dj_'.$row['salt'])) {
        		$password = hash('sha512', $password.'_dj_'.$row['salt']);
        		$shoppo = $this->dbConn->prepare("UPDATE users_login SET ul_pass = :password WHERE ul_user_id = :id LIMIT 1");
		        if ($shoppo->execute(array(':id'=>$userId, ':password'=>$password))) {
		        	$_SESSION['SESS__password'] = hash('sha512', $password .'_dj_'. $user_browser);
		        	$this->setMessage(array('success', 'Password Successfully Changed'));
					$event = "Changed Password from ".$row['password'];
			        $this->logEvent($event, 1);
		        	return true;
		        }
		        $this->setMessage(array('danger', 'Unable to update password, Please try later'));
        	}else{
                $this->setMessage(array('danger', 'Invalid Current Password'));
            }
        }else{
	        $this->setMessage(array('danger', 'Unable to update password, Please try later'));
        }
        echo $event = "Unable to update Password to $password Error - ".$this->dbConn->errorInfo()[2];
        $this->logEvent($event, 0);
        return false;
    }

    function updateData_userPersonal($name, $mobile, $email){
    	$userId = $this->user;
    	$shoppo = $this->dbConn->prepare("UPDATE users_personal SET ul_name = :name, ul_mobile = :mobile, ul_email = :email WHERE ul_user_id = :id LIMIT 1");
        if ($shoppo->execute(array(':id'=>$userId, ':mobile'=>$mobile, ':email'=>$email, ':name'=>$name))) {
        	$this->setMessage(array('success', 'Details Successfully Updated'));
        	$_SESSION['SESS__name'] = $name;
			$event = "Changed Personal details to $name, $email, $mobile";
	        $this->logEvent($event, 1);
        	return true;
        }else{
	        $this->setMessage(array('danger', 'Unable to update details, Please try later'));
        }
        $event = "Unable to update Personal details to $name, $email, $mobile Error - ".$this->dbConn->errorInfo()[2];
        $this->logEvent($event, 0);
        return false;
    }

    function validateData_pincodeDelivery($pincode){
        $solution = $this->dbConn->prepare("SELECT
                service
                FROM pincodes_data
                WHERE ul_pincode = :id LIMIT 1");
        $solution->execute(array(':id'=>$pincode));
        if ($status = $solution->fetchColumn(PDO::FETCH_ASSOC)) {
            return $status;
        }else{
            return false;
        }
    }

    function validateData_userAddressID($addressId, $userId){
        $solution = $this->dbConn->prepare("SELECT ul_alternate_contact FROM users_addresses WHERE ul_address_id = :address AND ul_user_id = :id AND ul_address_status >= 0 LIMIT 1;");
        $solution->execute(array(':id'=>$userId, ':address'=>$addressId));
        if ($contact = $solution->fetchColumn()) {
            return $contact;
        }else{
            return false;
        }
    }

    function query_register($postData){
        $this->dbConn->beginTransaction();
        $id = $this->insertData('contact_queries', $postData);
        if ($id) {
            $this->dbConn->commit();
            $this->setMessage(array('success', "We have successfully received your message ref# ".CLIENT_SHORT_NAME.str_pad($id, 6, 0, STR_PAD_LEFT).", get back to you soon"));
            $event = "Registered query with ID #$id with Data ".json_encode($postData);
            $this->logEvent($event, 1);
            return $id;
        }
        $this->dbConn->rollBack();
        $this->setMessage(array('danger', "Unable to recieve your query, Please try later"));
        $this->logEvent("Unable to register query ERROR# - $this->error", 0);
        return false;
    }

};
$function = new LoginProcess();