<?php

CLASS noLoginProcess extends Connection{

	function user__Login($username, $password) {
        $shoppo = $this->dbConn->prepare("SELECT * FROM user_login_details WHERE email = :username OR mobile = :username LIMIT 1");
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
                    $this->logInOutEvent(1, $userId);    //// Add this successful event to login table ////
                    session_regenerate_id();
                    return true;
                }else{
                    $this->logInOutEvent(-1, $userId);   //// Add this successful event to login table ////
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
	    	$ip = ip2long($_SERVER['REMOTE_ADDR']);
	    	$ip = $ip ? (int)$ip : '0';
  		}else{
  			$ip = '0';
  		}
		$shoppo = $this->dbConn->prepare("INSERT INTO login_invalid_users (ul_attempt_username, ul_attempt_ip) VALUES (:username, :ip)");
		$shoppo->bindParam(':username', $username, PDO::PARAM_STR);
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
                $walletArray = array('user_id'=>$id);
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
};
$function = new noLoginProcess();