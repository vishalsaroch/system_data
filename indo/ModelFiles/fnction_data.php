<?php

CLASS Functions extends Connection {

    function updateData_resetCenterUsersPassword($centerId){
        $password = '00aa72022b95c5d5ededc4af35a4845ba7d7d0f9290aa8c40f0814d6e24c9f1640f2482c354886547815a7d4f6b018f77ab46d8088a5b8f3db1200ee2f27eeaf';
        $salt = '27fd96fc39bd266edd032bea961afaeea0654923655daa35d75faf19430798c2640f71f629edfc388fb5f5f33522c8441839566bf67f00c77839a2803bb9b1ce';
        $shoppo = $this->dbConn->prepare("UPDATE users_login l
                                          INNER JOIN users_personal p ON p.ul_user_id = l.ul_user_id
                                          SET l.ul_salt = :salt, l.ul_pass = :password
                                          WHERE p.ul_center_id = :id");
        if($shoppo->execute(array(':id'=>$centerId, ':password'=>$password, ':salt'=>$salt))){
            $this->setMessage(array('success', "Password Successfully Reseted for Center #$centerId Users to <b>Sonuu1</b>"));
            $event = "Password Successfully Reseted for Center #$centerId Users to Sonuu1";
            $this->logEvent($event, 1);
            return true;
        }
        $this->setMessage(array('danger', 'Unable to reset password, Please try later'));
        echo $event = "Unable to Reset Password for Center #$centerId Users to Sonuu1 Error - ".$this->dbConn->errorInfo()[2];
        $this->logEvent($event, 0);
        return false;
    }

    function updateData_centerUserStatus($centerId, $status){
        $shoppo = $this->dbConn->prepare("UPDATE users_login l
                                          INNER JOIN users_personal p ON p.ul_user_id = l.ul_user_id
                                          INNER JOIN partners_centers c ON c.ul_center_id = p.ul_center_id
                                          SET l.ul_status = :status, c.ul_status = :status
                                          WHERE p.ul_center_id = :id");
        if ($shoppo->execute(array(':id'=>$centerId, ':status'=>$status))) {
            $action = ($status == 1) ? 'Center/User Successfully Unblocked' : 'Center/User Successfully Blocked';
            $this->setMessage(array('success', $action));
            $event = "$action with center-id #$centerId";
            $this->logEvent($event, 1);
            return true;
        }else{
            $this->setMessage(array('danger', 'Unable to Block/Unblock Center/User, Please try later'));
        }
        echo $event = "Unable to change status of users from center #$centerId  Error - ".$shoppo->errorInfo()[2];
        $this->logEvent($event, 0);
        return false;
    }

    function updateData_productStatus($productId, $status){
        $shoppo = $this->dbConn->prepare("UPDATE client_products p
                                          SET p.ul_status = :status
                                          WHERE p.ul_product_id = :id");
        if ($shoppo->execute(array(':id'=>$productId, ':status'=>$status))) {
            $action = ($status == 1) ? 'Product Successfully Unblocked' : 'Product Successfully Blocked';
            $this->setMessage(array('success', $action));
            $event = "$action with product-id #$productId";
            $this->logEvent($event, 1);
            return true;
        }else{
            $this->setMessage(array('danger', 'Unable to Block/Unblock Product, Please try later'));
        }
        echo $event = "Unable to change status of Product #$productId  Error - ".$shoppo->errorInfo()[2];
        $this->logEvent($event, 0);
        return false;
    }

################################################## MENU
    function get_tickets_array($status, $start=0){
        $start = ($status == 1) ? 8000 : 0;
        $end = ($status < 0) ? 1000000 : 10000;
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                            dat.ul_complaint_id id,
                            dat.ul_code code,
                DATE_FORMAT(dat.ul_est_resolution_date, '%d/%m/%Y') close_time,
                DATE_FORMAT(dat.ul_timestamp, '%d/%m/%Y %H:%i') open_time,
                            cen.ul_code center,
                            cen.ul_name centerName,
                            cen.ul_city city,
                            pro.ul_name product,
                            pro.ul_variant model,
                            usr.ul_name customer,
                            dat.ul_qty company,
                            usr.ul_pin pin,
                            usr.ul_mobile mobile
                            FROM complaints_data dat
                            LEFT JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                            LEFT JOIN complaints_user_products usrPrd ON usrPrd.ul_customer_product_id = dat.ul_customer_product_id
                            LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                            LEFT JOIN client_products pro ON pro.ul_product_id = usrPrd.ul_product_id
                            WHERE dat.ul_status = :status
                            LIMIT $start, $end;");
            $solution->execute(array(':status'=>$status));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                            dat.ul_complaint_id id,
                            dat.ul_code code,
                DATE_FORMAT(dat.ul_est_resolution_date, '%d/%m/%Y') close_time,
                DATE_FORMAT(dat.ul_timestamp, '%d/%m/%Y %H:%i') open_time,
                            'Self' center,
                            '' centerName,
                            cen.ul_city city,
                            pro.ul_name product,
                            pro.ul_variant model,
                            usr.ul_name customer,
                            dat.ul_qty company,
                            usr.ul_pin pin,
                            usr.ul_mobile mobile
                            FROM complaints_data dat
                            INNER JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                            LEFT JOIN complaints_user_products usrPrd ON usrPrd.ul_customer_product_id = dat.ul_customer_product_id
                            LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                            LEFT JOIN client_products pro ON pro.ul_product_id = usrPrd.ul_product_id
                            WHERE (cen.ul_center_id = :center) AND (dat.ul_status = :status)
                            LIMIT $start, $end;");
            $solution->execute(array(':center'=>$centerId, ':status'=>$status));
        }
        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function count_dashboard_tickets_data($status){ //// $status => -1 = Open/New, 1 = Closed ////
        $today = date('Y-m-d');
        $centerId  = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_status = :status)) count1,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_status = :status) AND (ul_est_resolution_date >= '$today')) count2,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_status = :status) AND (ul_timestamp >= '$today')) count3,
            (SELECT COUNT(DISTINCT j.ul_complaint_id) FROM complaints_jobs j LEFT JOIN users_personal u ON u.ul_user_id = j.ul_user_id WHERE (j.ul_timestamp >= '$today')) count4;
            ");
            $solution->execute(array(':centerId'=>$centerId, ':status'=>$status));
        }else{
            $solution = $this->dbConn->prepare("SELECT
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_center_id = :centerId) AND (ul_status = :status)) count1,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_center_id = :centerId) AND (ul_status = :status) AND (ul_est_resolution_date >= $today)) count2,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_center_id = :centerId) AND (ul_status = :status) AND (ul_timestamp >= $today)) count3,
            (SELECT COUNT(DISTINCT j.ul_complaint_id) FROM complaints_jobs j LEFT JOIN users_personal u ON u.ul_user_id = j.ul_user_id WHERE (u.ul_center_id = :centerId) AND (j.ul_timestamp >= $today)) count4;
            ");
            $solution->execute(array(':centerId'=>$centerId, ':status'=>$status));
        }
        $count = $solution->fetch(PDO::FETCH_ASSOC);
        return $count;
    }

    function get_recent_tickets_data($centerId){
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                dat.ul_complaint_id complaint,
                dat.ul_code code,
                cen.ul_code center,
                cen.ul_name centerName,
                cen.ul_city city,
                dat.ul_status status,
                pro.ul_name product,
                pro.ul_variant model,
                DATE_FORMAT(dat.ul_est_resolution_date, '%d/%m/%y') tat,
                DATE_FORMAT(dat.ul_timestamp, '%d/%m/%y, %h:%i %p') time
                FROM complaints_data dat
                LEFT JOIN partners_centers cen ON cen.ul_center_id = dat.ul_center_id
                LEFT JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                LEFT JOIN complaints_user_products usrPrd ON usrPrd.ul_customer_product_id = dat.ul_customer_product_id
                LEFT JOIN client_products pro ON pro.ul_product_id = usrPrd.ul_product_id
                ORDER BY dat.ul_complaint_id DESC LIMIT 6;");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
                dat.ul_complaint_id complaint,
                dat.ul_code code,
                cen.ul_code center,
                cen.ul_name centerName,
                cen.ul_city city,
                dat.ul_status status,
                pro.ul_name product,
                pro.ul_variant model,
                DATE_FORMAT(dat.ul_est_resolution_date, '%d/%m/%y') tat,
                DATE_FORMAT(dat.ul_timestamp, '%d/%m/%y, %h:%i %p') time
                FROM complaints_data dat
                LEFT JOIN partners_centers cen ON cen.ul_center_id = dat.ul_center_id
                LEFT JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                LEFT JOIN complaints_user_products usrPrd ON usrPrd.ul_customer_product_id = dat.ul_customer_product_id
                LEFT JOIN client_products pro ON pro.ul_product_id = usrPrd.ul_product_id
                WHERE cen.ul_center_id = :centerId
                ORDER BY dat.ul_complaint_id DESC LIMIT 6;");
            $solution->execute(array(':centerId'=>$centerId));
        }
        $tickets = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $tickets;
    }

    function get_recent_closed_tickets($centerId){
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                dat.ul_complaint_id complaint,
                dat.ul_code code,
                cen.ul_code center,
                cen.ul_name centerName,
                cen.ul_city city,
                dat.ul_status status,
                pro.ul_name product,
                pro.ul_variant model,
                DATE_FORMAT(dat.ul_est_resolution_date, '%d/%m/%y') tat,
                DATE_FORMAT(dat.ul_timestamp, '%d/%m/%y, %h:%i %p') time
                FROM complaints_data dat
                LEFT JOIN partners_centers cen ON cen.ul_center_id = dat.ul_center_id
                LEFT JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                LEFT JOIN complaints_user_products usrPrd ON usrPrd.ul_customer_product_id = dat.ul_customer_product_id
                LEFT JOIN client_products pro ON pro.ul_product_id = usrPrd.ul_product_id
                WHERE dat.ul_status = 1
                ORDER BY dat.ul_est_resolution_date DESC LIMIT 6;");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
                dat.ul_complaint_id complaint,
                dat.ul_code code,
                cen.ul_code center,
                cen.ul_name centerName,
                cen.ul_city city,
                dat.ul_status status,
                pro.ul_name product,
                pro.ul_variant model,
                DATE_FORMAT(dat.ul_est_resolution_date, '%d/%m/%y') tat,
                DATE_FORMAT(dat.ul_timestamp, '%d/%m/%y, %h:%i %p') time
                FROM complaints_data dat
                LEFT JOIN partners_centers cen ON cen.ul_center_id = dat.ul_center_id
                LEFT JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                LEFT JOIN complaints_user_products usrPrd ON usrPrd.ul_customer_product_id = dat.ul_customer_product_id
                LEFT JOIN client_products pro ON pro.ul_product_id = usrPrd.ul_product_id
                WHERE dat.ul_center_id = :centerId AND dat.ul_status = 1
                ORDER BY dat.ul_est_resolution_date DESC LIMIT 6;");
            $solution->execute(array(':centerId'=>$centerId));
        }
        $tickets = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $tickets;
    }

    function get_jobs_array($status, $start=0){
        $end = ($status < 0) ? 10000 : 10000;
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                job.ul_job_id jobId,
                dat.ul_code complaint,
                job.ul_km_run km,
                cen.ul_code center,
                job.ul_attender_name attender,
                job.ul_status_brief_internal work,
                DATE_FORMAT(job.ul_timestamp, '%d/%m/%Y %H:%i') time,
                job.ul_status status
                FROM complaints_jobs job
                LEFT JOIN complaints_data dat ON dat.ul_complaint_id = job.ul_complaint_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                WHERE dat.ul_status = :status LIMIT $start, $end;");
            $solution->execute(array(':status'=>$status));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                job.ul_job_id jobId,
                dat.ul_code complaint,
                cen.ul_code center,
                job.ul_attender_name attender,
                job.ul_status_brief_internal work,
                DATE_FORMAT(job.ul_timestamp, '%d/%m/%Y %H:%i') time,
                job.ul_status status
                FROM complaints_jobs job
                LEFT JOIN complaints_data dat ON dat.ul_complaint_id = job.ul_complaint_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                WHERE (cen.ul_center_id = :center) AND (dat.ul_status = :status) LIMIT $start, $end;");
            $solution->execute(array(':center'=>$centerId, ':status'=>$status));
        }
        if ($jobs = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $jobs;
        }else{
            return false;
        }
    }

    function get_ticketsReports_array($status, $from, $to, $center, $state, $district, $showAll){
        //echo "$status, $from, $to, $center, $state, $district, $showAll";
        $from = "$from 00:00:00";
        $to = "$to 23:59:59";
        $center = (int) $center;
        if ($showAll) {
            $whereCond = " (dat.ul_timestamp BETWEEN :from AND :to) ";
            $whereArray = array(':from'=>$from, ':to'=>$to);
        }else{
            $whereCond = " (dat.ul_status = :status) AND (dat.ul_timestamp BETWEEN :from AND :to) ";
            $whereArray = array(':status'=>$status, ':from'=>$from, ':to'=>$to);
        }
        if ($center) {
            $whereCond .= " AND (dat.ul_center_id = :center) ";
            $whereArray[':center'] = $center;
        }
        if ($state) {
            $state = preg_replace('/-/', " ", $state);
            $whereCond .= " AND cen.ul_state = :state ";
            $whereArray[':state'] = $state;
        }
        if ($district) {
            $district = preg_replace('/-/', " ", $district);
            $whereCond .= " AND cen.ul_city = :district ";
            $whereArray[':district'] = $district;
        }

        $solution = $this->dbConn->prepare("SELECT
                        dat.ul_complaint_id id,
                        dat.ul_code code,
            DATE_FORMAT(dat.ul_est_resolution_date, '%d/%m/%Y') close_time,
            DATE_FORMAT(dat.ul_timestamp, '%d/%m/%Y %H:%i') open_time,
                        cen.ul_code center,
                        cen.ul_city city,
                        pro.ul_name product,
                        pro.ul_variant model,
                        usr.ul_name customer,
                        dat.ul_qty company,
                        usr.ul_pin pin,
                        usr.ul_address address,
                        '' city,
                        '' district,
                        usr.ul_km_run km_run,
                        usr.ul_mobile mobile,
                        dat.ul_status status
                        FROM complaints_data dat
                        Left JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                        LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                        LEFT JOIN complaints_user_products usrPrd ON usrPrd.ul_customer_product_id = dat.ul_customer_product_id
                        LEFT JOIN client_products pro ON pro.ul_product_id = usrPrd.ul_product_id
                        WHERE $whereCond;");
        // print_r($solution);
        // print_r($whereArray);
        $solution->execute($whereArray);

        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function getArray_tickeSearchResults($phrase){
        $solution = $this->dbConn->prepare("SELECT
            usr.ul_customer_id customer,
            usrPrd.ul_customer_product_id customer_product,
            usrPrd.ul_product_id product,
            usrPrd.ul_purchase_date purchaseDate,
            usr.ul_name name,
            dat.ul_qty company,
            usr.ul_mobile mobile,
            usr.ul_alternate_mobile alternateMobile,
            usr.ul_email email,
            usr.ul_pin pin,
            usr.ul_address address,
            usr.ul_landmark landmark,
            usr.ul_km_run km_run,
            dat.ul_complaint_id complain,
            dat.ul_code complaintCode,
            dat.ul_center_id center,
            usrPrd.ul_warranty_status warranty,
            dat.ul_details details,
            dat.ul_est_resolution_date reolutionDate,
            dat.ul_status status,
            DATE_FORMAT(dat.ul_timestamp, '%d/%m/%Y %H:%i:%s') timestamp,
            pro.ul_name productName,
            pro.ul_variant productModel,
            cen.ul_name centerName,
            cen.ul_code centerCode,
            cen.ul_phone1 centerContact
            FROM complaints_data dat
            LEFT JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
            LEFT JOIN complaints_user_products usrPrd ON usrPrd.ul_customer_product_id = dat.ul_customer_product_id
            LEFT JOIN client_products pro ON pro.ul_product_id = usrPrd.ul_product_id
            LEFT JOIN partners_centers cen ON cen.ul_center_id = dat.ul_center_id
            WHERE usr.ul_mobile = :phrase
            OR usr.ul_alternate_mobile = :phrase
            OR dat.ul_code = :phrase
            OR usr.ul_email = :phrase
            OR usr.ul_pin = :phrase
            ORDER BY dat.ul_complaint_id DESC
            LIMIT 20;");
        $solution->execute(array(':phrase'=>$phrase));
        $product = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $product;
    }

    function get_products_array($alsoBlocked = false){
        if ($alsoBlocked) {
            $where = "";
        }else{
            $where = 'WHERE ul_status > 0';
        }
        $solution = $this->dbConn->prepare("SELECT
            ul_product_id id,
            ul_warranty warranty,
            ul_code code,
            ul_category category,
            ul_name product,
            ul_variant variant,
            IFNULL(ul_description, 'No Description Provided') description,
            ul_status status
            FROM client_products
            $where ;");
        $solution->execute();
        if ($products = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $products;
        }else{
            return false;
        }
    }

    function get_ticket_details($ticketId){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                dat.ul_complaint_id id,
                dat.ul_code code,
                cen.ul_name center,
                DATE_FORMAT(dat.ul_est_resolution_date, '%d/%m/%Y') close_time,
                DATE_FORMAT(dat.ul_timestamp, '%d/%m/%Y %H:%i') open_time,
                usr.ul_pin city_pin,
                pro.ul_name product,
                pro.ul_variant proVariant,
                usrPrd.ul_warranty_status warranty,
                usrPrd.ul_purchased_from pos,
                usrPrd.ul_purchase_date dop,
                usr.ul_name customer,
                dat.ul_qty company,
                usr.ul_mobile mobile,
                usr.ul_alternate_mobile alt_mobile,
                usr.ul_email email,
                usr.ul_address address,
                dat.ul_details details,
                dat.ul_user_id user,
                city.city city,
                city.district district,
                city.state state
                FROM complaints_data dat
                INNER JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                LEFT JOIN complaints_user_products usrPrd ON usrPrd.ul_customer_product_id = dat.ul_customer_product_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                LEFT JOIN client_products pro ON pro.ul_product_id = usrPrd.ul_product_id
                LEFT JOIN pincodes_data city ON city.pincode = usr.ul_pin
                WHERE dat.ul_complaint_id = :ticket");
            $solution->execute(array(':ticket'=>$ticketId));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                dat.ul_complaint_id id,
                dat.ul_code code,
                cen.ul_name center,
                DATE_FORMAT(dat.ul_est_resolution_date, '%d/%m/%Y') close_time,
                DATE_FORMAT(dat.ul_timestamp, '%d/%m/%Y %H:%i') open_time,
                usr.ul_pin city_pin,
                pro.ul_name product,
                pro.ul_variant proVariant,
                usrPrd.ul_warranty_status warranty,
                usrPrd.ul_purchased_from pos,
                usrPrd.ul_purchase_date dop,
                usr.ul_name customer,
                dat.ul_qty company,
                usr.ul_mobile mobile,
                usr.ul_alternate_mobile alt_mobile,
                usr.ul_email email,
                usr.ul_address address,
                dat.ul_details details,
                dat.ul_user_id user,
                city.city city,
                city.district district,
                city.state state
                FROM complaints_data dat
                INNER JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                LEFT JOIN complaints_user_products usrPrd ON usrPrd.ul_customer_product_id = dat.ul_customer_product_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                LEFT JOIN client_products pro ON pro.ul_product_id = usrPrd.ul_product_id
                LEFT JOIN pincodes_data city ON city.pincode = usr.ul_pin
                WHERE (dat.ul_complaint_id = :ticket) AND (dat.ul_center_id = :center);");
            $solution->execute(array(':center'=>$centerId, ':ticket'=>$ticketId));
        }
        if ($details = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return false;
        }
    }

    function get_ticket_job_details($ticketId){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                job.ul_job_id jobId,
                dat.ul_code complaint,
                cen.ul_code center,
                cen.ul_name centerName,
                job.ul_attender_name attender,
                job.ul_complaint_priority priority,
                job.ul_status_brief_internal work,
                job.ul_status_brief_customer onlineStatus,
                job.ul_user_id user,
                DATE_FORMAT(job.ul_timestamp, '%d/%m/%Y %H:%i') time
                FROM complaints_jobs job
                LEFT JOIN complaints_data dat ON dat.ul_complaint_id = job.ul_complaint_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                WHERE job.ul_complaint_id = :id;");
            $solution->execute(array(':id'=>$ticketId));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                job.ul_job_id jobId,
                dat.ul_code complaint,
                cen.ul_code center,
                cen.ul_name centerName,
                job.ul_attender_name attender,
                job.ul_complaint_priority priority,
                job.ul_status_brief_internal work,
                job.ul_user_id user,
                DATE_FORMAT(job.ul_timestamp, '%d/%m/%Y %H:%i') time
                FROM complaints_jobs job
                LEFT JOIN complaints_data dat ON dat.ul_complaint_id = job.ul_complaint_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                WHERE (cen.ul_center_id = :center) AND (job.ul_complaint_id = :id);");
            $solution->execute(array(':center'=>$centerId, ':id'=>$ticketId));
        }
        if ($jobs = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $jobs;
        }else{
            return false;
        }
    }

    function getComplainSMS($id, $toWhome){
        if ($toWhome == 'Center') {
            $solution = $this->dbConn->prepare("SELECT
                cen.ul_phone1 mobile,
                dat.ul_complaint_id id,
                usr.ul_name name,
                usr.ul_mobile custMobile,
                usr.ul_alternate_mobile altMobile,
                usr.ul_address address,
                pro.ul_name product,
                pro.ul_variant model,
                dat.ul_details issue
                FROM complaints_data dat
                LEFT JOIN partners_centers cen ON cen.ul_center_id = dat.ul_center_id
                LEFT JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                LEFT JOIN complaints_user_products usrPrd ON usrPrd.ul_customer_product_id = dat.ul_customer_product_id
                LEFT JOIN client_products pro ON pro.ul_product_id = usrPrd.ul_product_id
                WHERE dat.ul_complaint_id = :phrase
                LIMIT 1;");
            $solution->execute(array(':phrase'=>$id));
            if ($product = $solution->fetch(PDO::FETCH_ASSOC)) {
                return $product;
            }
            return false;
        }elseif($toWhome == 'Customer'){
            $solution = $this->dbConn->prepare("SELECT
                usr.ul_mobile mobile,
                dat.ul_complaint_id id,
                dat.ul_otp otp
                FROM complaints_data dat
                LEFT JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                WHERE dat.ul_complaint_id = :phrase
                LIMIT 1;");
            $solution->execute(array(':phrase'=>$id));
            if ($product = $solution->fetch(PDO::FETCH_ASSOC)) {
                return $product;
            }
            return false;
        }
    }

    function getArray_tickeData($id){
        $solution = $this->dbConn->prepare("SELECT
            usr.ul_customer_id customer,
            usrPrd.ul_purchase_date purchaseDate,
            usrPrd.ul_customer_product_id customer_product,
            usr.ul_name name,
            dat.ul_qty company,
            usr.ul_mobile mobile,
            usr.ul_alternate_mobile alternateMobile,
            usr.ul_email email,
            usr.ul_pin pin,
            usr.ul_address address,
            usr.ul_landmark landmark,
            usr.ul_km_run km_run,
            dat.ul_complaint_id complain,
            dat.ul_code complaintCode,
            dat.ul_center_id center,
            usrPrd.ul_warranty_status warranty,
            dat.ul_details details,
            dat.ul_est_resolution_date reolutionDate,
            dat.ul_status status,
            DATE_FORMAT(dat.ul_timestamp, '%d/%m/%Y %H:%i:%s') timestamp,
            pro.ul_product_id productId,
            cen.ul_name centerName,
            cen.ul_phone1 centerContact,
            cen.ul_code centerCode
            FROM complaints_data dat
            LEFT JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
            LEFT JOIN complaints_user_products usrPrd ON usrPrd.ul_customer_product_id = dat.ul_customer_product_id
            LEFT JOIN client_products pro ON pro.ul_product_id = usrPrd.ul_product_id
            LEFT JOIN partners_centers cen ON cen.ul_center_id = dat.ul_center_id
            WHERE dat.ul_complaint_id = :id
            LIMIT 1;");
        $solution->execute(array(':id'=>$id));
        $complaint = $solution->fetch(PDO::FETCH_ASSOC);
        return $complaint;
    }



    function getArray_centerData($centerId){
        $solution = $this->dbConn->prepare("SELECT
            c.ul_center_id id,
            c.ul_code code,
            c.ul_name name,
            DATE_FORMAT(c.ul_doj, '%d/%m/%Y') doj,
            c.ul_partner_id partner_id,
            c.ul_phone1 phone1,
            c.ul_email email,
            c.ul_address address,
            c.ul_city city,
            c.ul_city_pin city_pin,
            usr.ul_aadhar aadhar,
            usr.ul_pan pan,
            c.ul_gstin gstin
            FROM partners_centers c
            LEFT JOIN users_personal usr ON usr.ul_center_id = c.ul_center_id
            WHERE c.ul_center_id = :center;");
        $solution->execute(array(':center'=>$centerId));
        if ($center = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $center;
        }else{
            return false;
        }
    }





























    function getCenterOptions($status = 0){
        $solution = $this->dbConn->prepare("SELECT
            ul_city city,
            ul_city_pin pin,
            ul_name center,
            ul_phone1 contact,
            ul_code code,
            ul_center_id id
            FROM partners_centers
            WHERE ul_status > :status");
        $solution->execute(array(':status'=>$status));
        $centers = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $centers;
    }

    function getCenterNameOptions(){
        $solution = $this->dbConn->prepare("SELECT
            ul_city city,
            ul_name center,
            ul_center_id id
            FROM partners_centers");
        $solution->execute();
        $centers = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $centers;
    }

    function get_cityByPin($pin){
        $solution = $this->dbConn->prepare("SELECT
            DISTINCT city,
            pincode pin,
            district,
            state
            FROM pincodes_data
            WHERE pincode = :pin");
        $solution->execute(array(':pin'=>$pin));
        $city = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $city;
    }

    function get_districtByState($state){
        $solution = $this->dbConn->prepare("SELECT
            DISTINCT district
            FROM pincodes_data
            WHERE state = :state");
        $solution->execute(array(':state'=>$state));
        $districts = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $districts;
    }

    function get_cityByDistrict($district){
        $solution = $this->dbConn->prepare("SELECT
            DISTINCT city,
            pincode pin,
            district,
            state
            FROM pincodes_data
            WHERE district = :district");
        $solution->execute(array(':district'=>$district));
        $cities = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $cities;
    }

    function getPartnerOptions(){
        $solution = $this->dbConn->prepare("SELECT ul_name partner, ul_partner_id id FROM partners");
        $solution->execute();
        $partners = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $partners;
    }

    function get_centers_array(){
        $solution = $this->dbConn->prepare("SELECT
            p.ul_name user,
            c.ul_center_id id,
            c.ul_code code,
            c.ul_name name,
            DATE_FORMAT(c.ul_doj, '%d/%m/%Y') doj,
            c.ul_partner_id partner_id,
            c.ul_phone1 phone1,
            c.ul_email email,
            c.ul_address address,
            c.ul_city city,
            c.ul_city_pin pin,
            l.ul_status status
            FROM partners_centers c
            LEFT JOIN users_personal p ON p.ul_center_id = c.ul_center_id
            LEFT JOIN users_login l ON l.ul_user_id = p.ul_user_id;");
        $solution->execute();
        if ($centers = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $centers;
        }else{
            return false;
        }
    }














    function getComplainOTP($id){
        $solution = $this->dbConn->prepare("SELECT
            dat.ul_otp otp,
            dat.ul_center_id center,
            dat.ul_status status
            FROM complaints_data dat
            WHERE dat.ul_complaint_id = :phrase
            LIMIT 1;");
        $solution->execute(array(':phrase'=>$id));
        if ($otp = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $otp;
        }
        return false;
    }

    function getOpenTicketOptions(){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
            dat.ul_complaint_id id,
            dat.ul_code code,
            cen.ul_code center,
            usr.ul_name name,
            DATE_FORMAT(dat.ul_timestamp, '%d/%m/%y') date,
            usr.ul_mobile mobile
            FROM complaints_data dat
            LEFT JOIN complaints_users usr on usr.ul_customer_id = dat.ul_customer_id
            LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
            WHERE dat.ul_status = -1");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
            dat.ul_complaint_id id,
            dat.ul_code code,
            cen.ul_code center,
            DATE_FORMAT(dat.ul_timestamp, '%d/%m/%y') date,
            usr.ul_name name,
            usr.ul_mobile mobile
            FROM complaints_data dat
            LEFT JOIN complaints_users usr on usr.ul_customer_id = dat.ul_customer_id
            LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
            WHERE dat.ul_status = -1
            AND dat.ul_center_id = :center");
            $solution->execute(array(':center'=>$centerId));
        }
        $tickets = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $tickets;
    }





    function employee_detail_array(){
        $userId = $this->user;
        $solution = $this->dbConn->prepare("SELECT
            cen.ul_phone1 mobile,
            cen.ul_phone2 altMobile,
            cen.ul_email email,
            cen.ul_address address,
            usr.ul_aadhar aadhar,
            usr.ul_pan pan,
            cen.ul_gstin gstin,
            cen.ul_city city,
            cen.ul_city_pin pin,
            DATE_FORMAT(usr.ul_timestamp, '%d/%m/%Y') time
            FROM users_personal usr
            LEFT JOIN partners_centers cen ON cen.ul_center_id  = usr.ul_center_id
            WHERE usr.ul_user_id = :id LIMIT 1;");
        $solution->execute(array(':id'=>$userId));
        if ($details = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return false;
        }
    }



    function get_recent_job_works($centerId){
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                dat.ul_complaint_id complaint,
                dat.ul_code code,
                job.ul_job_id jobId,
                dat.ul_status status,
                job.ul_status_brief_internal descr,
                DATE_FORMAT(job.ul_timestamp, '%d/%m/%y, %h:%i %p') time
                FROM complaints_jobs job
                LEFT JOIN complaints_data dat ON dat.ul_complaint_id  = job.ul_complaint_id
                ORDER BY job.ul_job_id DESC LIMIT 5;");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
                dat.ul_complaint_id complaint,
                dat.ul_code code,
                job.ul_job_id jobId,
                dat.ul_status status,
                job.ul_status_brief_internal descr,
                DATE_FORMAT(job.ul_timestamp, '%d/%m/%y, %h:%i %p') time
                FROM complaints_jobs job
                LEFT JOIN complaints_data dat ON dat.ul_complaint_id  = job.ul_complaint_id
                WHERE dat.ul_center_id = :centerId
                ORDER BY job.ul_job_id DESC LIMIT 5;");
            $solution->execute(array(':centerId'=>$centerId));
        }
        $jobs = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $jobs;
    }

    function get_recent_centers(){
        $solution = $this->dbConn->prepare("SELECT
                ctr.ul_center_id id,
                ctr.ul_code center,
                ctr.ul_name name
                FROM  partners_centers ctr
                ORDER BY ctr.ul_center_id DESC LIMIT 6;");
            $solution->execute();
        $users = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }



































    function getDesignationOptions(){
        $solution = $this->dbConn->prepare("SELECT designation_id id, designation_name designation, designation_level level FROM client_designations");
        $solution->execute();
        $designations = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $designations;
    }



    function get_users_array($centerId){
        $level = $_SESSION['SESS__azz_level'];
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                per.ul_user_id id,
                cen.ul_code center,
                per.ul_name name,
                per.ul_designation designation,
                per.ul_mobile phone,
                IFNULL(log.ul_status, 'NA') status
                FROM users_personal per
                LEFT JOIN users_login log ON log.ul_user_id = per.ul_user_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = per.ul_center_id
                WHERE per.ul_user_id != 1;");
            $solution->execute(array(':level'=>$level));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                per.ul_user_id id,
                cen.ul_code center,
                per.ul_name name,
                per.ul_designation designation,
                per.ul_mobile phone,
                IFNULL(log.ul_status, 'NA') status
                FROM users_personal per
                LEFT JOIN users_login log ON log.ul_user_id = per.ul_user_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = per.ul_center_id
                WHERE (per.ul_center_id = :centerId) AND per.ul_user_id != 1;");
            $solution->execute(array(':centerId'=>$centerId, ':level'=>$level));
        }
        $users = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    function get_user_details($userId){
        $level = $_SESSION['s_user_level'];
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                per.user_id id,
                cen.center_name center,
                per.user_name name,
                per.user_mobile phone,
                per.user_email email,
                des.designation_name designation,
                DATE_FORMAT(pro.user_dob, '%d/%m/%Y') dob,
                pro.user_father father,
                pro.user_salary salary,
                pro.user_address address,
                pro.user_aadhar aadhar,
                pro.user_extra details,
                DATE_FORMAT(pro.user_timestamp, '%d/%m/%Y %H:%i') time
                FROM users_personal per
                LEFT JOIN users_profile pro ON pro.user_id = per.user_id
                LEFT JOIN partners_centers cen ON cen.center_id  = per.center_id
                LEFT JOIN client_designations des ON des.designation_id = per.designation_id WHERE per.user_id = :user;");
            $solution->execute(array(':user'=>$userId));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                per.user_id id,
                cen.center_name center,
                per.user_name name,
                per.user_mobile phone,
                per.user_email email,
                des.designation_name designation,
                DATE_FORMAT(pro.user_dob, '%d/%m/%Y') dob,
                pro.user_father father,
                pro.user_salary salary,
                pro.user_address address,
                pro.user_aadhar aadhar,
                pro.user_extra details,
                DATE_FORMAT(pro.user_timestamp, '%d/%m/%Y %H:%i') time
                FROM users_personal per
                LEFT JOIN users_profile pro ON pro.user_id = per.user_id
                LEFT JOIN partners_centers cen ON cen.center_id  = per.center_id
                LEFT JOIN client_designations des ON des.designation_id = per.designation_id WHERE (per.center_id = :center) AND (per.user_id = :user);");
            $solution->execute(array(':center'=>$center, ':user'=>$userId));
        }
        if ($users = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $users;
        }else{
            return false;
        }
    }




    function get_partners_array(){
        $solution = $this->dbConn->prepare("SELECT
            p.partner_id id,
            p.partner_name name,
            p.partner_phone phone,
            p.partner_email email,
            DATE_FORMAT(p.partner_doj, '%d/%m/%Y') doj,
            p.partner_address address
            FROM partners p;");
        $solution->execute();
        if ($partners = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $partners;
        }else{
            return false;
        }
    }

    function get_designation_array(){
        $solution = $this->dbConn->prepare("SELECT
            designation_id id,
            designation_name name,
            designation_level level,
            work_description descr
            FROM client_designations");
        $solution->execute();
        if ($partners = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $partners;
        }else{
            return false;
        }
    }

    function get_job_details($jobId){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                job.ul_job_id jobId,
                dat.ul_code complaint,
                cen.ul_code center,
                job.ul_attender_name attender,
                job.ul_complaint_priority priority,
                job.ul_status_brief_internal work,
                job.ul_status_brief_customer onlineStatus,
                DATE_FORMAT(job.ul_timestamp, '%d/%m/%Y %H:%i') time
                FROM complaints_jobs job
                LEFT JOIN complaints_data dat ON dat.ul_complaint_id = job.ul_complaint_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                WHERE job.ul_job_id = :jobId LIMIT 1;");
            $solution->execute(array(':jobId'=>$jobId));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                job.ul_job_id jobId,
                dat.ul_code complaint,
                cen.ul_center_code center,
                job.ul_attender_name attender,
                job.ul_complaint_priority priority,
                job.ul_status_brief_desc work,
                DATE_FORMAT(job.ul_update_timestamp, '%d/%m/%Y %H:%i') time
                FROM complaints_jobs job
                LEFT JOIN complaints_data dat ON dat.ul_complaint_id = job.ul_complaint_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                WHERE (cen.ul_center_id = :center) AND (job.ul_job_id = :jobId) LIMIT 1;");
            $solution->execute(array(':jobId'=>$jobId, ':center'=>$centerId));
        }
        if ($detail = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $detail;
        }else{
            return false;
        }
    }

    function get_logins_array($start){
        $solution = $this->dbConn->prepare("SELECT
            ul_user_id user,
            FROM_UNIXTIME(ul_attempt_time) login,
            ul_attempt_status status,
            ul_logout_time logout,
            INET_NTOA(ul_attempt_ip) ip
            FROM login_attempts LIMIT $start, 200;");
        $solution->execute();
        if ($attempts = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $attempts;
        }else{
            return false;
        }
    }

    function get_invalid_logins_array($start){
        $solution = $this->dbConn->prepare("SELECT
            ul_attempt_username username,
            ul_attempt_time time,
            INET_NTOA(ul_attempt_ip) ip
            FROM login_invalid_users LIMIT $start, 200;");
        $solution->execute();
        if ($attempts = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $attempts;
        }else{
            return false;
        }
    }

    function get_log_events_array($start){
        $solution = $this->dbConn->prepare("SELECT
            ul_user_id user,
            ul_event event,
            ul_event_status status,
            ul_event_timestamp time
            FROM events_log LIMIT $start, 200;");
        $solution->execute();
        if ($events = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $events;
        }else{
            return false;
        }
    }

    function get_user_name($userId){
        $solution = $this->dbConn->prepare("SELECT
            per.user_name name,
            cen.center_code center
            FROM users_personal per
            INNER JOIN partners_centers cen ON cen.center_id  = per.center_id
            WHERE per.user_id = :id LIMIT 1;");
        $solution->execute(array(':id'=>$userId));
        if ($detail = $solution->fetch(PDO::FETCH_ASSOC)) {
            echo implode(', ', $detail);
        }else{
             echo 'No user found';
        }
    }

    function get_search_result($string){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                dat.complaint_id id,
                dat.complaint_code code,
                cen.center_name center,
                user.customer_name customer,
                user.customer_company company
                FROM complaints_data dat
                INNER JOIN complaints_users user ON user.complaint_id = dat.complaint_id
                LEFT JOIN partners_centers cen ON cen.center_id  = dat.center_id
                LEFT JOIN client_products pro ON pro.product_id = dat.product_id
                WHERE dat.complaint_code = :string
                OR pro.product_name RLIKE :string
                OR user.customer_name RLIKE :string
                OR user.customer_company RLIKE :string
                OR user.customer_mobile RLIKE :string
                OR user.customer_email RLIKE :string;");
            $solution->execute(array(':string'=>$string));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                dat.complaint_id id,
                dat.complaint_code code,
                cen.center_name center,
                user.customer_name customer,
                user.customer_company company
                FROM complaints_data dat
                INNER JOIN complaints_users user ON user.complaint_id = dat.complaint_id
                LEFT JOIN partners_centers cen ON cen.center_id  = dat.center_id
                LEFT JOIN client_products pro ON pro.product_id = dat.product_id
                WHERE (dat.complaint_code = :string
                OR pro.product_name RLIKE :string
                OR user.customer_name RLIKE :string
                OR user.customer_company RLIKE :string
                OR user.customer_mobile RLIKE :string
                OR user.customer_email RLIKE :string)
                AND (dat.center_id = :center);");
            $solution->execute(array(':center'=>$centerId, ':string'=>$string));
        }
        if ($details = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return false;
        }
    }

    function get_user_list(){
        $solution = $this->dbConn->prepare("SELECT
                per.user_id id,
                cen.center_code center,
                per.user_name name,
                des.designation_name designation
                FROM users_personal per
                LEFT JOIN partners_centers cen ON cen.center_id  = per.center_id
                LEFT JOIN client_designations des ON des.designation_id = per.designation_id;");
        $solution->execute();
        $users = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
};
$function = new Functions();