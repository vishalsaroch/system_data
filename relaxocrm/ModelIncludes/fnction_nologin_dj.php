<?php

CLASS noLoginProcess extends Connection{
    function getArrayOptions_All_Table($table, $columnsArray, $additionalWhereOrderby = '', $whereArray = array()){
        $columns = 'DISTINCT ul_' . implode(', ul_', $columnsArray);;
        $shoppo = $this->dbConn->prepare("SELECT
            $columns
            FROM $table
            $additionalWhereOrderby");
        $shoppo->execute($whereArray);
        if ($options = $shoppo->fetchAll(PDO::FETCH_ASSOC)) {
            return $options;
        }else{
            return false;
        }
    }

	function user__Login($username, $password) {
        $shoppo = $this->dbConn->prepare("SELECT * FROM user_login_details WHERE (email = :username) OR (mobile = :username) LIMIT 1");
        $shoppo->execute(array(':username'=>$username));
        if ($row = $shoppo->fetch(PDO::FETCH_ASSOC)) {
            $userId = $row['user'];
            if (($row['status'] < 1)){  //// Account is De-activated or Expired////
            	$this->setMessage(array("danger", "Account Blocked, Please write us at <b><a href='mailto:".SUPPORT_EMAIL."'>".SUPPORT_EMAIL."</a></b> for support."));
                    return false;
            }else if ($this->checkBrute($userId) == true){  	//// Account is locked  ////
	            $this->setMessage(array("danger", "You have made many unsuccessful attempts, please try after sometime."));
	            return false;
            }else{
                if ($row['password'] === hash('sha512', $password.'_dj_'.$row['salt'])){
                    unset($row['salt']);
                    $this->setSessionUser($row);
                    $this->logInOutEvent(0);    //// Add this successful event to login table ////
                    return true;
                }else{
                    $this->logInOutEvent(-1);   //// Add this successful event to login table ////
                    $this->setMessage(array("danger", "Invalid Username or Password"));
                    return false;
                }
            }
        }
    	$this->logInvalidLogin($username);
        $this->setMessage(array("danger", "Invalid Username or Password"));
        return false;
    }

    // function verify__Login($password) {
        // 	$username = $this->username;
        //     if ($user = $this->confirmPass($password, $username)) {
        //         if ($user['user'] === $this->userId){
        //         	$this->setSessionPass($password);
        //             $this->logInOutEvent(1);  	//// Add this successful event to login table ////
        //             return true;
        //         }else{
        //         	$this->logEvent("Danger!!! Forced login tried for user ".$user['user']." with password  = '$password'", 0);
        //         	$this->setMessage(array("danger", "Invalid Login Request"));
        //         	$this->logInOutEvent(-1);
        //         	return false;
        //         }
        //     }else{
        //     	$this->logInOutEvent(-1);  	//// Add this successful event to login table ////
        //         $this->setMessage(array("danger", "Invalid Password"));
        //         return false;
        //     }
    // }

	function checkBrute($userId) {
		//// All login attempts are counted from the past 30 minutes (1800 SEC). ////
		if ($shoppo = $this->dbConn->prepare("SELECT COUNT(user_id) count FROM login_attempts WHERE (user_id = :userId) AND (NOW() - 1800 > attempt_time) AND (attempt_status = -1)")) {
			$shoppo->execute(array(':userId'=>$userId));
			$attempts = $shoppo->fetch(PDO::FETCH_ASSOC)['count'];
			if ($attempts > 3) {												//// If there have been more than 3 failed logins ////
				return true;
			} else {
				return false;
			}
		}
  	}

  	function logInvalidLogin($username){	//// For non-users ....... ////
  		if (TRACK_USER_IP) {
	    	$ip = ip2long($this->ip);
	    	$ip = $ip ? $ip : '0';
  		}else{
  			$ip = '0';
  		}
		$shoppo = $this->dbConn->prepare("INSERT INTO login_invalid_users (attempt_username, attempt_ip) VALUES (:username, :ip)");
		$shoppo->bindParam(':username', $username, PDO::PARAM_INT);
		$shoppo->bindParam(':ip', $ip, PDO::PARAM_INT);
		$shoppo->execute();
  	}

	function user_Register($userData, $level){
        $password = $userData['password'];
        unset($userData['password']);
        $salt = hash('sha512', str_shuffle('ABCDEFGHJKLMNPprstuvwxyz23456789'));
        $password = hash('sha512', $password.'_dj_'.$salt);
        $this->dbConn->beginTransaction();
        $id = $this->insertData('users_personal', $userData);
        if ($id) {
            $loginArray = array('user_id' => $id, 'pass' => $password, 'salt' => $salt, 'level' => $level);
            if ($this->insertData('users_login', $loginArray)) {
                $walletArray = array('user_id'=>$id, 'password'=>$password);
                $this->insertData('users_wallet', $walletArray);
                $this->dbConn->commit();
                $this->setMessage(array('success', "You have successfully registered with us"));
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
        $this->logEvent("Unable to register user ERROR# - $this->error", 0);
        return false;
    }

    function center_Register($userData, $centerData, $level){
        $centerData['phone1'] = $userData['mobile'];
        $password = $userData['password'];
        unset($userData['password']);
        $salt = hash('sha512', str_shuffle('ABCDEFGHJKLMNPprstuvwxyz23456789'));
        $password = hash('sha512', $password.'_dj_'.$salt);
        $this->dbConn->beginTransaction();
        if ($centerId = $this->insertData('partners_centers', $centerData)) {
            $userData['center_id'] = $centerId;
            $id = $this->insertData('users_personal', $userData);
            if ($id) {
                $loginArray = array('user_id' => $id, 'pass' => $password, 'salt' => $salt, 'level' => $level);
                if ($this->insertData('users_login', $loginArray)) {
                    $this->dbConn->commit();
                    $this->setMessage(array('success', "You have successfully registered with us"));
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
        }
        $this->dbConn->rollBack();
        $this->logEvent("Unable to register vendor ERROR# - $this->error", 0);
        return false;
    }

    function query_register($postData){
        $this->dbConn->beginTransaction();
        $id = $this->insertData('contact_queries', $postData);
        if ($id) {
            $this->dbConn->commit();
            $this->setMessage(array('success', "We have successfully received your message ref# ".CLIENT_SHORT_NAME.str_pad($id, 6, '0', STR_PAD_LEFT).", get back to you soon"));
            $event = "Registered query with ID #$id with Data ".json_encode($postData);
            $this->logEvent($event, 1);
            return $id;
        }
        $this->dbConn->rollBack();
        $this->setMessage(array('success', "Unable to recieve your query, Please try later"));
        $this->logEvent("Unable to register query ERROR# - $this->error", 0);
        return false;
    }

    function loginSocialUser($userData, $pass = '', $level = 1){
        $solution = $this->dbConn->prepare("SELECT * FROM user_login_details WHERE (email = :email) OR (mobile = :mobile) LIMIT 1");
        $solution->execute(array(':mobile'=>$userData['mobile'], ':email'=>$userData['email']));
        if ($user = $solution->fetch(PDO::FETCH_ASSOC)) {
            $userData['user'] = $id;
            $userData['password'] = $pass;
            $userData['azz_level'] = $level;
            $this->setSessionUser($userData);
            return true;
        }else{
            $this->dbConn->beginTransaction();
            $id = $this->insertData('users_personal', $userData);
            if ($id) {
                $salt = hash('sha512', str_shuffle('ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789'));
                $pass = hash('sha512', $pass.'solution'.$salt);
                $loginArray = array('user_id' => $id, 'pass' => $pass, 'salt' => $salt, 'level' => $level);
                if ($this->insertData('users_login', $loginArray)) {
                    $this->dbConn->commit();
                    $userData['user'] = $id;
                    $userData['password'] = $pass;
                    $userData['azz_level'] = $level;
                    $this->setSessionUser($userData);
                    return true;
                }
            }

            $error = $userSocialId.' not registered -'.$solution->errorInfo()[2];
            $this->dbConn->rollBack();
            $_SESSION['MSG'] = array('danger', 'Error!!! * Something wrong happened, try later *'.$error);
            return false;
        }
    }

    function insertData_warranty($customerData, $productData){
        if (is_int($customerData)) {
            $productData['customer_id'] = $customerData;
        }elseif($id = $this->insertData('clients_customers', $customerData)){
            $productData['customer_id'] = $id;
        }else{
            $this->logEvent('clients_customers', $customerData, 0);
            return false;
        }
        $this->dbConn->beginTransaction();
        if ($productData['customer_id']) {
            if ($id = $this->insertData('clients_customers_products', $productData)) {
                $this->dbConn->commit();
                $return = array('crn'=>"C".date('ymd').$productData['customer_id'], 'cpid'=>$id);
                $this->setMessage(array('success', "Customer & Product successfully registered with CRN #$return[crn]"));
                $this->logEvent('customers,customers_products', array_merge($productData, $customerData), 1);
                return $return;
            }
            $this->dbConn->rollBack();
            $this->logEvent('clients_customers_products', $productData, 0);
            return false;
        }
    }

    function insertData_ticket($complaintData, $customerData, $warranty_status){
        $complaintData["user_id"] = $this->user;
        $this->dbConn->beginTransaction();
        if ($id = $this->insertData('complaints_data', $complaintData)) {
            $this->updateData('clients_customers', ' ul_customer_id = :customer ', array(":customer"=>$complaintData["customer_id"]), $customerData);
            $this->updateData('clients_customers_products', ' ul_customer_product_id = :product ', array(":product"=>$complaintData["customer_product_id"]), array("warranty_status"=>$warranty_status));
            $this->dbConn->commit();
            $this->setMessage(array('success', "Ticket/Complaint <b>$id</b> Successfully Raised"));
            $this->logEvent('complaints_data, customers', array_merge($complaintData, $customerData), 1);
            return $id;
        }
        $this->dbConn->rollBack();
        $this->logEvent('complaints_data', $complaintData, 0);
        return false;
    }

    function getDetail_ticket($ticket){
        $solution = $this->dbConn->prepare("SELECT
                        com.ul_complaint_id ticketId,
                        com.ul_code code,
                        DATE_FORMAT(com.ul_timestamp, '%d/%m/%Y %h:%i %p') open_time,
                        DATE_FORMAT(com.ul_est_resolution_date, '%d/%m/%Y') close_time,
                        com.ul_quantity quantity,
                        com.ul_details details,
                        com.ul_status status,
                        cus.ul_name customer,
                        cus.ul_mobile mobile,
                        cus.ul_alternate_mobile alternate_mobile,
                        cus.ul_email email,
                        cus.ul_company company,
                        cus.ul_address address,
                        cus.ul_city_pin city_pin,
                        cus.ul_landmark landmark,
                        pin.ul_city city,
                        pin.ul_district district,
                        pin.ul_state state,
                        per.ul_name technician,
                        per.ul_mobile technicianMobile,
                        prd.ul_brand brand,
                        prd.ul_category category,
                        prd.ul_name product,
                        prd.ul_model model,
                        prd.ul_spec1 spec1,
                        prd.ul_spec2 spec2
                        FROM complaints_data com
                        LEFT JOIN clients_customers cus ON cus.ul_customer_id = com.ul_customer_id
                        LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_product_id = com.ul_customer_product_id
                        LEFT JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
                        LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                        LEFT JOIN pincodes_data pin ON pin.ul_pincode = cus.ul_city_pin
                        LEFT JOIN users_personal per ON per.ul_user_id = com.ul_centers_user_id
                        WHERE (com.ul_code = :ticket) OR (com.ul_complaint_id = :ticket)
                        LIMIT 1;");
        $solution->execute(array(':ticket'=>$ticket));
        if ($tickets = $solution->fetch(PDO::FETCH_ASSOC)) {
            $solution = $this->dbConn->prepare("SELECT
                            job.ul_attender_name attender,
                            DATE_FORMAT(job.ul_timestamp, '%d/%m/%Y %h:%i %p') job_time,
                            job.ul_status_brief_customer detail,
                            job.ul_status status
                            FROM complaints_jobs job
                            WHERE job.ul_complaint_id = :ticket;");
            $solution->execute(array(':ticket'=>$tickets["ticketId"]));
            $jobs = $solution->fetchAll(PDO::FETCH_ASSOC);
            return array("ticket"=>$tickets, "job"=>$jobs);
        }else{
            return false;
        }
    }
};
$function = new noLoginProcess();