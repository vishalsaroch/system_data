<?php
CLASS Connection{

  protected $dbConn;
  public $user = 0;
  public $userId = 0;
  public $userLevel = 0;
  public $centerId = 0;
  public $ip = 0;
  protected $error = 'Opss! Error not Recorded';
  function Connection(){
      try {
         $this->dbConn = new PDO("mysql:dbname=mycrmkva_indocrm;host=localhost;port={3306};charset=utf8", 'mycrmkva_indocrm', '@ullu@#ji', array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+05:30'"));  ##### SERVER #####
         // $this->dbConn = new PDO("mysql:dbname=indocrm;host=localhost;port={3306};charset=utf8", 'root', '', array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+05:30'"));  ##### LOCALHOST #######
         //$this->dbConn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
         if (isset($_SESSION['SESS__password'])) {
            $this->user = (int) $_SESSION['SESS__user'];
            $this->userId = $_SESSION['SESS__user_id'];
            $this->centerId = (int)  $_SESSION['SESS__center_id'];
            $this->userLevel = (int)  $_SESSION['SESS__azz_level'];
            $this->ip = $_SESSION['IPaddress'];
         }
      } catch (Exception $e) {
         echo '<script>window.location= "'.URL.'/error?We are updating us to serve you better, Try Later";</script>';
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
      session_write_close();
  }

  // protected function setSessionPass($hashedPass){
      //    $user_browser = (string) $_SERVER['HTTP_USER_AGENT'];
      //    $_SESSION['SESS__password'] = hash('sha512', $hashedPass .'_dj_'. $user_browser);
      //    session_write_close();
  // }

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
                <div class="alert alert-'.$msg[0].' alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
                    <center><b>'.$msg[1].'</b></center>
                </div></center>
            ';
        }
  }

  protected function getTableFamilierName($table){
      $shoppo = $this->dbConn->prepare("select table_comment FROM INFORMATION_SCHEMA.tables where TABLE_NAME = :table");
      $shoppo->execute(array(':table' => $table));
      if ($row = $shoppo->fetch(PDO::FETCH_ASSOC)) {
         return $row['table_comment'];
      }
  }

  protected function insertData($table, array $vars){
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
      $this->error = "Unable to insert in $table - ".$shoppo->errorInfo()[2];
      if (preg_match("/Duplicate entry '([^']+)'/", $this->error, $matches)) {
         $this->setMessage(array("danger", "Error!!! * We have already <b>".$matches[1]."</b> in our database, Try another *"));
      }elseif (preg_match("/Incorrect (.*) column '([^']+)'/", $this->error, $matches)) {
         $this->setMessage(array("danger", "Error!!! * Incorrect value for <b>".substr(ucfirst($matches[2]), 3)."</b> *"));
      }elseif (preg_match("/Out of range value for column '([^']+)'/", $this->error, $matches)) {
         $this->setMessage(array("danger", "Error!!! * Value for <b>".substr(ucfirst($matches[2]), 3)."</b> is higher or lower than required *"));
      }
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
      $shoppo = $this->dbConn->prepare("UPDATE $table SET $fields WHERE $whereCond LIMIT $limit");
      if ($shoppo->execute($values)) {
         return true;
      }
      $error = $shoppo->errorInfo()[2];
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
         $this->setMessage(array("danger", "Error!!! * <b>".$matches[1]."</b> already in Your database *"));
      }elseif (preg_match("/Incorrect (.*) column '([^']+)'/", $error, $matches)) {
         $this->setMessage(array("danger", "Error!!! * Incorrect value for <b>".ucfirst($matches[2])."</b> *"));
      }elseif (preg_match("/Out of range value for column '([^']+)'/", $error, $matches)) {
         $this->setMessage(array("danger", "Error!!! * Value for <b>".ucfirst($matches[2])."</b> is higher or lower than required *"));
      }
      return false;
  }

  protected function deleteData($table, $whereCond, array $WhereVars, $limit=1){
      $shoppo = $this->dbConn->prepare("DELETE FROM $table WHERE $whereCond LIMIT $limit");
      if ($shoppo->execute($WhereVars)) {
         return $shoppo->rowCount();
      }
      echo $error = $shoppo->errorInfo()[2];
      if (preg_match("/`$this->dbName`.`([^']+)`, CONSTRAINT/", $error, $matches)) {
         $this->setMessage(array("danger", "Error!!! * There are Some data in <b>".$this->getTableFamilierName($matches[1])." belongs to this, Please delete that first.</b> *"));
      }
      return false;
  }

  protected function selectData($table, $selectColumns, $whereColumn, $id){
        $shoppo = $this->dbConn->prepare("SELECT $selectColumns FROM $table WHERE $whereColumn = :id LIMIT 1");
        $shoppo->execute(array(':id'=>$id));
        return $shoppo->fetch(PDO::FETCH_ASSOC);
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
                          $this->logOut();
                         $this->setMessage(array("danger", "Ohh !!! Something wrong happened"));
                         return false;
                      }
                }else{                        //// Not logged in or wrong session credential ////
                    $this->logOut();
                    $_SESSION = '';
                    $this->logOut();
                    $this->setMessage(array("danger", "Ohh !!! Something wrong happened"));
                    return false;
                }
            }
        }
        //// Not logged in ////
        $this->logOut();
        $this->setMessage(array("danger", "Please Login first !"));
        return false;
  }

  function logInOutEvent($status = 1, $userId){   //// Status => 2=Logged-Out, 1-Login, 0-Lock-Page, -1=Failed ////
    $userId = $this->user ? (int) $this->user : $userId;
    if (! $userId) return;
    if ($status < 2) {
      if (TRACK_USER_IP) {
        $ip = ip2long($_SERVER['REMOTE_ADDR']);
        $ip = $ip ? (int)$ip : '0';
      }else{
        $ip = '0';
      }
      $time = time();
      $shoppo = $this->dbConn->prepare("INSERT INTO login_attempts (ul_user_id, ul_attempt_status, ul_attempt_ip, ul_attempt_time) VALUES (:userId, :status, :ip, :time)");
      echo $this->dbConn->errorInfo()[2];
      $shoppo->execute(array(':userId'=>$userId, ':status'=>$status, ':ip'=>$ip, ':time'=>$time));
      echo $shoppo->errorInfo()[2];
    }else{
      $shoppo = $this->dbConn->prepare("UPDATE login_attempts SET ul_attempt_status = :status WHERE (ul_user_id = :userId) AND (ul_attempt_status = 1)");
      $shoppo->execute(array(':userId'=>$userId, ':status'=>$status));
    }
  }

  function logOut(){
      $userId = $this->user;
      $this->logInOutEvent(2, $userId);
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

  protected function logEvent($desc, $status = 1){
      $userId = (int) $this->userId;
      $shoppo = $this->dbConn->prepare("INSERT INTO events_log (ul_user_id, ul_event, ul_event_status) VALUES (:userId, :event, :status)");
      $shoppo->execute(array(':userId'=>$userId, ':event'=>$desc, ':status'=>$status));
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