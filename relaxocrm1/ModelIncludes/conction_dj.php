<?php

CLASS Connection{

   protected $dbConn;
   public $user = 0;
   public $userId = 0;
   public $userLevel = 0;
   public $center = 0;
   public $centerId = 0;
   public $ip = 0;
   protected $error = 'Opss! Error not Recorded';
   private $dbName = 'bestwebs_relaxocrm';
   function Connection(){
      try {
         $this->dbConn = new PDO("mysql:dbname=bestwebs_relaxocrm;host=192.185.129.96;port={3306}", 'bestwebs_relaxou', 'Unkn@wn7P@ssw@rd', array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+05:30'"));
         //$this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
         if (isset($_SESSION['SESS__password'])) {
            $this->user = $_SESSION['SESS__user'];
            $this->userId = $_SESSION['SESS__user_id'];
            $this->userLevel = $_SESSION['SESS__azz_level'];
            $this->center = $_SESSION['SESS__center'];
            $this->centerId = $_SESSION['SESS__center_id'];
            $this->ip = $_SESSION['IPaddress'];
         }
      } catch (Exception $e) {
        header('Location: http://www.relaxocrm.space/error/We are updating us to serve you better, Try Later');
         echo '<script>window.location= "http://www.relaxocrm.space/error/We are updating us to serve you better, Try Later";</script>';
         exit;
      }
      if (isset($_SESSION['Last_access']) && (time()-$_SESSION['Last_access'] > SESSION_TIMEOUT_IN)) {
         session_regenerate_id(true);
      }
      $_SESSION['Last_access'] = time();
   }

   protected function setSessionUser($userArray, $center = 0){
      foreach ($userArray as $key => $value) {
         $_SESSION['SESS__'.$key] = $value;
      }
      $user_browser = (string) $_SERVER['HTTP_USER_AGENT'];
      $_SESSION['SESS__password'] = hash('sha512', $userArray['password'] .'_dj_'. $user_browser);
      $_SESSION['SESS__user_id'] = sha1(base64_encode($userArray['user']));
      //$_SESSION['SESS__center_id'] = sha1(base64_encode($center));
      if (file_exists('assets/images/users/'.$_SESSION['SESS__user_id'].'.png')) {
        $_SESSION['SESS__avatar'] = '/assets/images/users/'.$_SESSION['SESS__user_id'].'.png';
      }else{
        $_SESSION['SESS__avatar'] = "/assets/images/user.png";
      }
      $this->user = $_SESSION['SESS__user'];
      $this->userId = $_SESSION['SESS__user_id'];
      $this->userLevel = $_SESSION['SESS__azz_level'];
      $this->center = $_SESSION['SESS__center'];
      $this->centerId = $_SESSION['SESS__center_id'];
      $this->ip = $_SESSION['IPaddress'];
      session_write_close();
   }

   // protected function setSessionPass($hashedPass){
      //    $user_browser = (string) $_SERVER['HTTP_USER_AGENT'];
      //    $_SESSION['SESS__password'] = hash('sha512', $hashedPass .'_dj_'. $user_browser);
      //    session_write_close();
   // }

  function getSetSQLError($errorCode, $errorMsg){
    switch ($errorCode) {
      case '1048':
        // 1048 : Column 'ul_code' cannot be null
        preg_match("/Column '([^']+)' cannot/", $errorMsg, $matches);
        return $_SESSION['MSG'] = array("danger", "Error!!! * Invalid Value for <b>".ucfirst(substr($matches[1], 3))."</b> *");
        break;

      case '1054':
        // 1054 : Unknown column 'ul_spec' in 'field list'
        preg_match("/Unknown column '([^']+)' in/", $errorMsg, $matches);
        return $_SESSION['MSG'] = array("danger", "Error!!! * Unknown Field <b>".ucfirst(substr($matches[1], 3))."</b> *");
        break;

      case '1062':
        // 1062  SQLSTATE: 23000 (ER_DUP_ENTRY) Duplicate entry '%s' for key %d
        preg_match("/Duplicate entry '([^']+)'/", $errorMsg, $matches);
        return $_SESSION['MSG'] = array("danger", "Error!!! * We have already `<b>".$matches[1]."</b>` in our database, Try another *");
        break;

      case '1063':
        // 1063  SQLSTATE: 42000 (ER_WRONG_FIELD_SPEC) Incorrect column specifier for column '%s'
        preg_match("/Incorrect (.*) column '([^']+)'/", $errorMsg, $matches);
        return $_SESSION['MSG'] = array("danger", "Error!!! * Incorrect value for <b>".ucfirst($matches[2])."</b> *");
        break;

      case '1216':
        // 1216  SQLSTATE: 23000 (ER_NO_REFERENCED_ROW) Cannot add or update a child row: a foreign key constraint fails
        preg_match("/`$this->dbName`.`([^']+)`, CONSTRAINT/", $errorMsg, $matches);
        return $_SESSION['MSG'] = array("danger", "Error!!! * There are No data in <b>".$this->getTableFamilierName($matches[1])." to whom it can match, Please Add that first.</b> *");
        break;

      case '1217':
        // 1217  SQLSTATE: 23000 (ER_ROW_IS_REFERENCED) Cannot delete or update a parent row: a foreign key constraint fails
        preg_match("/`$this->dbName`.`([^']+)`, CONSTRAINT/", $errorMsg, $matches);
        return $_SESSION['MSG'] = array("danger", "Error!!! * There are Some data in <b>".$this->getTableFamilierName($matches[1])." belongs to this, Please delete that first.</b> *");
        break;

      case '1264':
        // 1264  SQLSTATE: 01000 (ER_WARN_DATA_OUT_OF_RANGE) Data truncated; out of range for column '%s' at row %ld
        preg_match("/Out of range value for column '([^']+)'/", $errorMsg, $matches);
        return $_SESSION['MSG'] = array("danger", "Error!!! * Value for <b>".ucfirst($matches[1])."</b> is higher or lower than required *");
        break;

      case '1364':
        // 1364  SQLSTATE: HY000 (ER_TRUNCATED_WRONG_VALUE_FOR_FIELD) Field '%s' doesn't have a default value
        preg_match("/Field '(.*)' does/", $errorMsg, $matches);
        return $_SESSION['MSG'] = array("danger", "Error!!! * Incorrect Value for <b>".ucfirst(substr($matches[1], 3))."</b> *");
        break;

      case '1366':
        // 1366  SQLSTATE: HY000 (ER_TRUNCATED_WRONG_VALUE_FOR_FIELD) Incorrect %s value: '%s' for column '%s' at row %ld
        preg_match("/Incorrect (.*) value: '(.*)' for column '(.*)' /", $errorMsg, $matches);
        return $_SESSION['MSG'] = array("danger", "Error!!! * Incorrect Value for <b>".ucfirst(substr($matches[3], 3))."</b> *");
        break;

      case '1406':
        // 1406 SQLSTATE: 23000  : Data too long for column '%s' at row %ld
        preg_match("/too long for column '(.*)' at /", $errorMsg, $matches);
        return $_SESSION['MSG'] = array("danger", "Error!!! * Entered value for <b>".ucfirst(substr($matches[3], 3))." ".ucfirst(substr($matches[1], 3))."</b> is larger than acceptable * ");
        break;

      case '1451':
      case '1452':
        // 1452 SQLSTATE: 23000 (ER_NO_REFERENCED_ROW_2) Cannot add or update a child row: a foreign key constraint fails (%s)
        // Cannot delete or update a parent row: a foreign key constraint fails (`bestwebs_relxocrm2`.`complaints_feedback`, CONSTRAINT `fk_feedback_complaint` FOREIGN KEY (`ul_complaint_id`) REFERENCES `complaints_data` (`ul_complaint_id`) ON UPDATE CASCADE)
        preg_match("/`\.`(.*)`, CONSTRAINT /", $errorMsg, $matches);
        return $_SESSION['MSG'] = array("danger", "Error!!! * Cannot Add/Update/Delete this value because Some Values in <b>".$this->getTableFamilierName($matches[1])."</b> depends on this data*");
        break;

      case '1690':
        // 1690 SQLSTATE: 22003 value out of range.
        preg_match("/REFERENCES `(.*)` /", $errorMsg, $matches);
        return $_SESSION['MSG'] = array("danger", "Error!!! * Cannot Add/Update, Invalid Values or Stock not available*");
        break;

      default:
        return $_SESSION['MSG'] = array("danger", "Error $errorCode!!! * Unable to Add/Update data *");
        break;
    }
  }

  function setMessage($msg){
        $_SESSION['MSG'] = $msg;
  }

  function getMessage(){
        //$_SESSION['MSG'] = array("danger", 'just demo error msg');
        if (isset($_SESSION['MSG'])) {
            $msg = $_SESSION['MSG'];
            $_SESSION['MSG'] = array();
            unset($_SESSION['MSG']);
            return '<center>
                <div class="alert alert-'.$msg[0].' alert-dismissable" style="width:70%;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
                    <center>'.$msg[1].'</center>
                </div></center>
            ';
        }
  }

  protected function getTableFamilierName($table){
      $shoppo = $this->dbConn->prepare("SELECT table_comment FROM INFORMATION_SCHEMA.tables WHERE TABLE_NAME = :table ORDER BY table_comment DESC;");
      $shoppo->execute(array(':table' => $table));
      if ($row = $shoppo->fetchAll(PDO::FETCH_ASSOC)) {
        if ($name = $row[0]['table_comment']) {
          return $name;
        }elseif ($name = $row[1]['table_comment']) {
          return $name;
        }
      }
  }

  protected function insertData_noUpdate($table, array $vars){
      $columns = array();
      $fields = array();
      $values = array();
      foreach ($vars as $key => $value) {
         $columns[] = COLUMN_PREFIX.$key;
         $fields[] = ":$key";
         $values[":$key"] = $value;
      }
      $columns = implode(', ', $columns);
      $fields = implode(', ', $fields);
      $q = "INSERT INTO $table ($columns) VALUES ($fields)";
      $shoppo = $this->dbConn->prepare($q);
      if ($shoppo->execute($values)) {
        $id = $this->dbConn->lastInsertId();
         return $id ? $id : true;
      }
      list($errorSQLstate, $errorCode, $errorMsg) = $shoppo->errorInfo();
      $this->error = "Unable to insert in $table - ".$this->dbConn->errorInfo()[2]." $errorCode : $errorMsg";
      $this->getSetSQLError($errorCode, $errorMsg);
      return false;
  }

  protected function insertData($table, array $vars, $isUpdate = false){
      $columns = array();
      $fields = array();
      $values = array();
      foreach ($vars as $key => $value) {
         $columns[] = COLUMN_PREFIX."$key = :$key";
         $values[":$key"] = $value;
      }
      $columns = implode(', ', $columns);
      $fields = implode(', ', $fields);
      $q = "INSERT INTO $table SET $columns ";
      if ($isUpdate) {
        $q  .= " ON DUPLICATE KEY UPDATE $columns;";
      }
      //echo $q;
      $shoppo = $this->dbConn->prepare($q);
      if ($shoppo->execute($values)) {
        $id = $this->dbConn->lastInsertId();
         return $id ? $id : true;
      }
      list($errorSQLstate, $errorCode, $errorMsg) = $shoppo->errorInfo();
       $this->error = "Unable to insert in $table - ".$this->dbConn->errorInfo()[2]." $errorCode : $errorMsg";
      $this->getSetSQLError($errorCode, $errorMsg);
      return false;
  }

  protected function updateData($table, $whereCond, array $WhereVars, array $vars, $limit=1){
      $fields = array();
      $values = array();
      foreach ($vars as $key => $value) {
         $fields[] = COLUMN_PREFIX.$key." = :$key";
         $values[":$key"] = $value;
      }
      $values = array_merge($values, $WhereVars);
      $fields = implode(', ', $fields);
      $q = "UPDATE $table SET $fields WHERE $whereCond LIMIT $limit";
      $shoppo = $this->dbConn->prepare($q);
      if ($shoppo->execute($values)) {
         return $shoppo->rowCount();
      }
      list($errorSQLstate, $errorCode, $errorMsg) = $shoppo->errorInfo();
       $this->error = "Unable to update in $table - $errorCode : $errorMsg".$this->dbConn->errorInfo()[2];
      $this->getSetSQLError($errorCode, $errorMsg);
      return false;
  }

  protected function deleteData($table, $whereCond, array $WhereVars, $limit=1){
      $shoppo = $this->dbConn->prepare("DELETE FROM $table WHERE $whereCond LIMIT $limit");
      if ($shoppo->execute($WhereVars)) {
         return $shoppo->rowCount();
      }
      list($errorSQLstate, $errorCode, $errorMsg) = $shoppo->errorInfo();
       $this->error = "Unable to update in $table - $errorCode : $errorMsg";
      $this->getSetSQLError($errorCode, $errorMsg);
      return false;
  }

  protected function selectData($table, $selectColumns, $whereColumn, $id){
        $shoppo = $this->dbConn->prepare("SELECT $selectColumns FROM $table WHERE $whereColumn = :id LIMIT 1");
        $shoppo->execute(array(':id'=>$id));
        return $shoppo->fetch(PDO::FETCH_ASSOC);
  }

  function getArrayOptions_All_Table($table, $columnsArray, $additionalWhereOrderby='', $whereArray=array()){
      $columnsArray = ($columnsArray != "*") ?  'DISTINCT ul_' . implode(', ul_', $columnsArray) : "*";
      $shoppo = $this->dbConn->prepare("SELECT
          $columnsArray
          FROM $table
          $additionalWhereOrderby");
      $shoppo->execute($whereArray);
      if ($options = $shoppo->fetchAll(PDO::FETCH_ASSOC)) {
          return $options;
      }else{
          return false;
      }
  }

  function checkLogin() {
        if (isset($_SESSION['SESS__user'], $_SESSION['SESS__password'])) {    //// Check if all session variables are set ////
            $user_id = (int) $_SESSION['SESS__user'];
            $login_string = (string) $_SESSION['SESS__password'];
            $user_browser = (string) $_SERVER['HTTP_USER_AGENT'];
            $shoppo = $this->dbConn->prepare("SELECT ul_pass password, ul_status status, ul_level level FROM users_login WHERE ul_user_id = :user LIMIT 1");
            $shoppo->execute(array(':user'=>$user_id));      //// Execute the prepared query. ////
            if ($row = $shoppo->fetch(PDO::FETCH_ASSOC)) {
                $login_check = hash('sha512', $row['password'] .'_dj_'. $user_browser);
                if ($login_check === $login_string) {     //// Logged In!!!! ////
                    if ($row['status'] > 0) {
                         return (int) $row['level'];
                      }else{
                         $this->setMessage(array("danger", "Ohh !!! Something wrong happened"));
                         return false;
                      }
                }else{                        //// Not logged in or wrong session credential ////
                    $_SESSION = '';
                    $this->logOut();
                    $this->setMessage(array("danger", "Ohh !!! Something wrong happened"));
                    return false;
                }
            }
        }
        //// Not logged in ////
        $this->setMessage(array("danger", "Please Login first !"));
        return false;
  }

  function logInOutEvent($status = 1){   //// Status => 2=Logged-Out, 1-Login, 0-Lock-Page, -1=Failed ////
    $userId = (int) $this->user;
    if ($status < 1) {
      if (TRACK_USER_IP) {
        $ip = (int) ip2long($this->ip);
        $ip = $ip ? $ip : '0';
      }else{
        $ip = '0';
      }
      $time = time();
      $shoppo = $this->dbConn->prepare("INSERT INTO login_attempts (ul_user_id, ul_attempt_time, ul_attempt_status, ul_attempt_ip) VALUES (:userId, :time, :status, :ip)");
      $shoppo->execute(array(':userId'=>$userId, ':status'=>$status, ':time'=>$time, ':ip'=>$ip));
    }else{
      $shoppo = $this->dbConn->prepare("UPDATE login_attempts SET ul_attempt_status = :status WHERE (ul_user_id = :userId) AND (ul_attempt_status != -1)");
      $shoppo->execute(array(':userId'=>$userId, ':status'=>$status));
    }
  }

  function logOut(){
        $this->logInOutEvent(2);
        if(isset($_SESSION['MSG'])) $MSG = $_SESSION['MSG'];
        if(isset($_SESSION['CART'])) $CART = $_SESSION['CART'];
        $_SESSION = '';
        session_unset();
        session_destroy();
        Session::session_start_dj();
        if(isset($MSG)){
            $_SESSION['MSG'] = $MSG;
        }else{
            $_SESSION['MSG'] = array("success", "Successfully Logged out");
        }
        if(isset($CART)){
            $_SESSION['CART'] = $CART;
        }
  }

  protected function logEvent($table, $data, $status = 1){
      if (!LOG_EVENTS) return;
      $data = json_encode($data);
      $userId = (int) $this->userId;
      $error = $this->error;
      $shoppo = $this->dbConn->prepare("INSERT INTO events_log (ul_user_id, ul_table, ul_data, ul_error, ul_event_status) VALUES (:userId, :table, :data, :error, :status)");
      $shoppo->execute(array(':userId'=>$userId, ':table'=>$table, ':data'=>$data, ':error'=>$error, ':status'=>$status));
  }

  function get_partners_centers($centerId){
        $shoppo = $this->conn->prepare("SELECT center, center_code, partner FROM login_detail_partner WHERE center_id = :centerId LIMIT 1");
        $shoppo->execute(array(':centerId'=>$centerId));
        if ($row = $shoppo->fetch(PDO::FETCH_ASSOC)) {
            return $row;
        }
        echo "Wrong Center ID";
        return false;
  }

  function filter_data($var){
      $var = strip_tags($var);
      $var = preg_replace('|[^a-zA-Z0-9 -_@.#, ]|i', '', $var);
      return $var;
  }
};