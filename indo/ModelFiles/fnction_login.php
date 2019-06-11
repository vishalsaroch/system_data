<?php

CLASS LoginProcess extends Connection{

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

    function updateData_centerCumUser($cenDetails, $usrDetails){
        $userId = $this->user;
        $centerId = $this->centerId;
        $status = 0;

        $shoppo = $this->dbConn->prepare("UPDATE partners_centers SET ul_phone1 = :phone1, ul_phone2 = :phone2, ul_email = :email, ul_address = :address, ul_gstin = :gstin, ul_city = :city, ul_city_pin = :city_pin WHERE ul_center_id = :id LIMIT 1");
        if ($shoppo->execute(array(':id'=>$centerId, ':phone1'=>$cenDetails['phone1'], ':phone2'=>$cenDetails['phone2'], ':email'=>$cenDetails['email'], ':address'=>$cenDetails['address'], ':gstin'=>$cenDetails['gstin'], ':city'=>$cenDetails['city'], ':city_pin'=>$cenDetails['city_pin']))) {
            $_SESSION['SESS__email'] = $cenDetails['email'];
            $_SESSION['SESS__mobile'] = $cenDetails['phone1'];
            $event = "Changed Center details to ".json_encode($cenDetails);
            $this->logEvent($event, 0);
            $status++;
        }else{
            $event = "Unable to Update Center details to ".json_encode($cenDetails).' ERROR ## - '.$shoppo->errorInfo()[2];
            $this->logEvent($event, 1);
        }

        $shoppo = $this->dbConn->prepare("UPDATE users_personal SET ul_mobile = :mobile, ul_email = :email, ul_address = :address, ul_aadhar = :aadhar, ul_pan = :pan WHERE ul_user_id = :id LIMIT 1");
        if ($shoppo->execute(array(':id'=>$userId, ':mobile'=>$usrDetails['mobile'], ':email'=>$usrDetails['email'], ':address'=>$usrDetails['address'], ':aadhar'=>$usrDetails['aadhar'], ':pan'=>$usrDetails['pan']))) {
            $event = "Changed User details to ".json_encode($usrDetails);
            $this->logEvent($event, 1);
            $status++;
        }else{
            $event = "Unable to Update User details to ".json_encode($usrDetails).' ERROR ## - '.$shoppo->errorInfo()[2];
            $this->logEvent($event, 0);
        }

        if ($status) {
            $this->setMessage(array('success', 'Details Successfully/Partially Updated'));
            return true;
        }else{
            $this->setMessage(array('danger', 'Unable to update details, Please try later'));
            return false;
        }
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

    function query_register($postData){
        $this->dbConn->beginTransaction();
        $id = $this->insertData('contact_queries', $postData);
        if ($id) {
            $this->dbConn->commit();
            $this->setMessage(array('success', "We have successfully received your message ref# ".CLIENT_SHORT_NAME.str_pad($id, 6, STR_PAD_LEFT).", get back to you soon"));
            $event = "Registered query with ID #$id with Data ".json_encode($postData);
            $this->logEvent($event, 1);
            return $id;
        }
        $this->dbConn->rollBack();
        $this->setMessage(array('danger', "Unable to recieve your query, Please try later"));
        $this->logEvent("Unable to register query ERROR# - $this->error", 0);
        return false;
    }

    function registerProduct($array){
        if ($id = $this->insertData('client_products', $array)) {
            $this->setMessage(array('success', 'Product Successfully added'));
            return $id;
        }
        $this->setMessage(array('danger', 'Product could not be added, try later'));
        $this->logEvent($this->error, 0);
        return false;
    }

    function registerCenter($array){
        if ($id = $this->insertData('partners_centers', $array)) {
            $this->setMessage(array('success', "Center '".$array['code']."' Successfully added"));
            return $id;
        }
        $this->setMessage(array('danger', 'Center could not be added, try later'));
        $this->logEvent($this->error, 0);
        return false;
    }

    function registerUser($userData, $level = 1){
        $password = $userData['password'];
        unset($userData['password']);
        $salt = hash('sha512', str_shuffle('ABCDEFGHJKLMNPprstuvwxyz23456789'));
        $password = hash('sha512', $password.'_dj_'.$salt);
        $this->dbConn->beginTransaction();
        $id = $this->insertData('users_personal', $userData);
        if ($id) {
            $loginArray = array('user_id' => $id, 'pass' => $password, 'salt' => $salt, 'level' => $level);
            if ($this->insertData('users_login', $loginArray)) {
                $this->dbConn->commit();
                $this->setMessage(array('success', "User successfully registered with us"));
                $event = "Registered user with ID #$id with Data ".json_encode(array_merge($loginArray, $userData));
                $this->logEvent($event, 1);
                return $id;
            }else{
                $this->dbConn->rollBack();
                $this->logEvent("Unable to register user ERROR# - $this->error", 0);
                $this->setMessage(array('danger', "Unable to Register, Please try later"));
                return false;
            }
        }
        $this->dbConn->rollBack();
        $this->setMessage(array('danger', "Unable to Register, Please try later"));
        $this->logEvent("Unable to register user ERROR# - $this->error", 0);
        return false;
    }

    function registerCenterCumUser($centerData, $userData, $level = 1){
        $this->dbConn->beginTransaction();
        if ($userData['center_id'] = $this->insertData('partners_centers', $centerData)) {
            $password = $userData['password'];
            unset($userData['password']);
            $salt = hash('sha512', str_shuffle('ABCDEFGHJKLMNPprstuvwxyz23456789'));
            $password = hash('sha512', $password.'_dj_'.$salt);

            $id = $this->insertData('users_personal', $userData);
            if ($id) {
                $loginArray = array('user_id' => $id, 'pass' => $password, 'salt' => $salt, 'level' => $level);
                if ($this->insertData('users_login', $loginArray)) {
                    $this->dbConn->commit();
                    $this->setMessage(array('success', "Center & User successfully registered with us"));
                    $event = "Registered user with ID #$id with Data ".json_encode(array_merge($loginArray, $userData, $centerData));
                    $this->logEvent($event, 1);
                    return $id;
                }else{
                    $this->dbConn->rollBack();
                    $this->logEvent("Unable to register User login ERROR# - $this->error", 0);
                    $this->setMessage(array('danger', "Unable to Register User Login Details, Please try later"));
                    return false;
                }
            }
            $this->dbConn->rollBack();
            $this->logEvent("Unable to register User personal ERROR# - $this->error", 0);
            $this->setMessage(array('danger', "Unable to Register User Personal Details, Please try later"));
            return false;
        }
        $this->dbConn->rollBack();
        $this->setMessage(array('danger', "Unable to Register Center, Please try later"));
        $this->logEvent("Unable to register user ERROR# - $this->error", 0);
        return false;
    }












    function registerDesignation($userData){
        $solution = $this->conn->prepare("INSERT INTO client_designations (designation_name, designation_level, work_description) VALUES (:name, :level, :description)");
        if ($solution->execute(array(':name'=>$userData['designation'], ':level'=>$userData['level'], ':description'=>$userData['details']))) {
            $_SESSION['MSG'] = array('success', 'Designation <b>'.$userData['designation'].'</b> at Level <b>'.$userData['level'].'</b> successfully saved');
            return true;
        }
        $error = $solution->errorInfo()[2];
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $_SESSION['MSG'] = array('danger', 'Error!!! * Level <b>'.$matches[1].'</b> already Exists *');
            return false;
        }
        $this->add_event_to_log($error, 0);
        $_SESSION['MSG'] = array('danger', 'Error!!! * Something wrong happened, try later *');
        return false;
    }

    function get_users_array($centerId){
        $level = $_SESSION['s_user_level'];
        if ($centerId == 1) {
            $solution = $this->conn->prepare("SELECT
                per.user_id id,
                cen.center_code center,
                per.user_name name,
                des.designation_name designation,
                per.user_mobile phone,
                IFNULL(log.user_login_status, 'NA') status
                FROM users_personal per
                LEFT JOIN users_login log ON log.user_id = per.user_id
                LEFT JOIN partners_centers cen ON cen.center_id  = per.center_id
                LEFT JOIN client_designations des ON des.designation_id = per.designation_id WHERE per.user_id != 1;");
            $solution->execute(array(':level'=>$level));
        }else{
            $solution = $this->conn->prepare("SELECT
                per.user_id id,
                cen.center_code center,
                per.user_name name,
                des.designation_name designation,
                per.user_mobile phone,
                IFNULL(log.user_login_status, 'NA') status
                FROM users_personal per
                LEFT JOIN users_login log ON log.user_id = per.user_id
                LEFT JOIN partners_centers cen ON cen.center_id  = per.center_id
                LEFT JOIN client_designations des ON des.designation_id = per.designation_id
                WHERE (per.center_id = :centerId) AND per.user_id != 1;");
            $solution->execute(array(':centerId'=>$centerId, ':level'=>$level));
        }
        $users = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    function change_user_status($userId){
        $solution = $this->conn->prepare("UPDATE users_login SET user_login_status = user_login_status * -1 WHERE user_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$userId))) {
            $this->add_event_to_log("Blocked/Unblocked User #$userId", 1);
            $_SESSION['MSG'] = array('success', "User with ID #<b>$userId</b> successfully Blocked/Unblocked");
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Block/Unblock User #$userId --- $error", 0);
        $_SESSION['MSG'] = array('danger', "Unable to Block/Unblock User with ID #<b>$userId</b>");
        return false;
    }

    function change_ticket_status($ticketId){
        $solution = $this->conn->prepare("UPDATE complaints_data SET complaint_status = complaint_status * -1 WHERE complaint_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$ticketId))) {
            $this->add_event_to_log("Ticket with ID #$ticketId has been Re-Opened", 1);
            $_SESSION['MSG'] = array('success', "Ticket with ID #$ticketId successfully Re-Opened");
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to re-open ticket #$ticketId --- $error", 0);
        $_SESSION['MSG'] = array('danger', "Unable to Re-Open Ticket with ID #<b>$ticketId</b>");
        return false;
    }

    function delete_ticket($ticketId){
        $solution = $this->conn->prepare("DELETE FROM complaints_data WHERE complaint_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$ticketId))) {
            $this->add_event_to_log('Deleted Complaint #'.$ticketId, 1);
            $_SESSION['MSG'] = array('success', "Complaint with Code/ID #<b>$ticketId</b> successfully Deleted");
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Delete Compliant #$ticketId --- $error", 0);
        $_SESSION['MSG'] = array('danger', "Unable to Delete Compliant with Code/ID #<b>$ticketId</b>");
        return false;
    }

    function delete_user($userId){
        $solution = $this->conn->prepare("DELETE FROM users_personal WHERE user_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$userId))) {
            $this->add_event_to_log('Deleted User #'.$userId, 1);
            $_SESSION['MSG'] = array('success', "User with ID #<b>$userId</b> successfully Deleted");
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Delete User #$userId --- $error", 0);
        $_SESSION['MSG'] = array('danger', "Unable to Delete User with ID #<b>$userId</b>");
        return false;
    }

    function delete_partner($partnerId){
        $solution = $this->conn->prepare("DELETE FROM partners WHERE partner_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$partnerId))) {
            $this->add_event_to_log('Deleted Partner #'.$partnerId, 1);
            $_SESSION['MSG'] = array('success', "Partner with ID #<b>$partnerId</b> successfully Deleted");
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Delete Partner #$partnerId --- $error", 0);
        $_SESSION['MSG'] = array('danger', "Unable to Delete Partner with ID #<b>$partnerId</b>");
        return false;
    }

    function delete_center($centerId){
        $solution = $this->conn->prepare("DELETE FROM partners_centers WHERE center_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$centerId))) {
            $this->add_event_to_log('Deleted Center #'.$centerId, 1);
            $_SESSION['MSG'] = array('success', "Center with ID #<b>$centerId</b> successfully Deleted");
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Delete Center #$centerId --- $error", 0);
        $_SESSION['MSG'] = array('danger', "Unable to Delete Center with ID #<b>$centerId</b>");
        return false;
    }

    function delete_designation($designationId){
        $solution = $this->conn->prepare("DELETE FROM client_designations WHERE designation_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$designationId))) {
            $this->add_event_to_log('Deleted Designation #'.$designationId, 1);
            $_SESSION['MSG'] = array('success', "Designation with ID #<b>$designationId</b> successfully Deleted");
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Delete Designation #$designationId --- $error", 0);
        $_SESSION['MSG'] = array('danger', "Unable to Delete Designation with ID #<b>$designationId</b>");
        return false;
    }

    function delete_product($productId){
        $solution = $this->conn->prepare("DELETE FROM client_products WHERE product_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$productId))) {
            $this->add_event_to_log('Deleted Product #'.$productId, 1);
            $_SESSION['MSG'] = array('success', "Product with ID #<b>$productId</b> successfully Deleted");
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Delete Product #$productId --- $error", 0);
        $_SESSION['MSG'] = array('danger', "Unable to Delete Product with ID #<b>$productId</b>");
        return false;
    }

    function registerJob($jobData){
        $ERMuser = (int) $_SESSION['s_user_id'];
        if ($jobData['status'] == 1) {
            $status = 1;
            $tat = date('Y-m-d H:i:s');
        }else{
            $status = -1;
            $tat = $jobData['tat'];
        }
        $this->conn->beginTransaction();
        $solution = $this->conn->prepare("INSERT INTO complaints_jobs (complaint_id, attender_name, user_id, complaint_priority, status_brief_desc) VALUES (:complaint_id, :attender_name, :user_id, :complaint_priority, :status_brief_desc)");
        $solution->execute(array(':complaint_id'=>$jobData['complaint'], ':attender_name'=>$jobData['attender'], ':user_id'=>$ERMuser, ':complaint_priority'=>$jobData['priority'], ':status_brief_desc'=>$jobData['job']));
        $jobId = $this->conn->lastInsertId();
        if ($jobId) {
            $solution = $this->conn->prepare("UPDATE complaints_data SET complaint_status = :status, est_resolution_date = :tat WHERE complaint_id = :id LIMIT 1;");
            if ($solution->execute(array(':status'=>$status, ':tat'=>$tat, ':id'=>$jobData['complaint']))) {
                $this->conn->commit();
                $_SESSION['MSG'] = array('success', "Job #<b>$jobId</b> for Ticket #<b>".$jobData['complaint']."</b> successfully added");
                return $jobId;
            }
        }
        echo $error = $solution->errorInfo()[2];
        $this->conn->rollBack();
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $_SESSION['MSG'] = array('danger', 'Error!!! * <b>'.$matches[1].'</b> already registered *');
            return false;
        }
        $this->add_event_to_log($error, 0);
        $_SESSION['MSG'] = array('danger', 'Error!!! * Something wrong happened, try later *');
        return false;
    }

    function registerPartner($partnerData){
        $solution = $this->conn->prepare("INSERT INTO partners (partner_name, partner_phone, partner_email, partner_doj, partner_address) VALUES (:partner_name, :partner_phone, :partner_email, :partner_doj, :partner_address)");
        if ($solution->execute(array(':partner_name'=>$partnerData['name'], ':partner_phone'=>$partnerData['phone'], ':partner_email'=>$partnerData['regEmail'], ':partner_doj'=>$partnerData['doj'], ':partner_address'=>$partnerData['address']))) {
            $_SESSION['MSG'] = array('success', 'Partner <b>'.$partnerData['name'].'</b> successfully saved');
            return true;
        }
        $error = $solution->errorInfo()[2];
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $_SESSION['MSG'] = array('danger', 'Error!!! * Level <b>'.$matches[1].'</b> already Exists *');
            return false;
        }
        $formData  = implode(', ', $partnerData);
        $this->add_event_to_log($error.' --- '.$formData, 0);
        $_SESSION['MSG'] = array('danger', 'Error!!! * Something wrong happened, try later *');
        return false;
    }

};
$function = new LoginProcess();