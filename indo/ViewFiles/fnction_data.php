<?php

CLASS Functions extends Connection {
################################################## MENU

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

    function get_products_array(){
        $solution = $this->dbConn->prepare("SELECT
            ul_product_id id,
            ul_warranty warranty,
            ul_code code,
            ul_category category,
            ul_name product,
            ul_variant variant,
            IFNULL(ul_description, 'No Description Provided') description
            FROM client_products;");
        $solution->execute();
        if ($products = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $products;
        }else{
            return false;
        }
    }

    function getCenterOptions(){
        $solution = $this->dbConn->prepare("SELECT
            ul_city city,
            ul_city_pin pin,
            ul_name center,
            ul_phone1 contact,
            ul_code code,
            ul_center_id id
            FROM partners_centers");
        $solution->execute();
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
            c.ul_center_id id,
            c.ul_code code,
            c.ul_name name,
            DATE_FORMAT(c.ul_doj, '%d/%m/%Y') doj,
            c.ul_partner_id partner_id,
            c.ul_phone1 phone1,
            c.ul_email email,
            c.ul_address address,
            c.ul_city city,
            c.ul_city_pin pin
            FROM partners_centers c;");
        $solution->execute();
        if ($centers = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $centers;
        }else{
            return false;
        }
    }

    function get_tickets_array($status, $start=0){
        $end = ($status < 0) ? 1000000 : 10000;
        $centerId = $this->centerId;
        if ($centerId == 1) {
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
                            usr.ul_company company,
                            usr.ul_pin pin,
                            usr.ul_mobile mobile
                            FROM complaints_data dat
                            INNER JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                            LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                            LEFT JOIN client_products pro ON pro.ul_product_id = usr.ul_product_id
                            WHERE dat.ul_status = :status
                            LIMIT $start, $end;");
            $solution->execute(array(':status'=>$status));
        }else{
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
                            usr.ul_company company,
                            usr.ul_pin pin,
                            usr.ul_mobile mobile
                            FROM complaints_data dat
                            INNER JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                            LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                            LEFT JOIN client_products pro ON pro.ul_product_id = usr.ul_product_id
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


    function get_ticketsReports_array($status, $from, $to, $center, $state, $district, $onlyOpen){
        //echo "$status, $from, $to, $center, $state, $district, $onlyOpen";
        $from = "$from 00:00:00";
        $to = "$to 23:59:59";
        $center = (int) $center;
        $whereCond = " (dat.ul_status > :status) AND (dat.ul_timestamp BETWEEN :from AND :to) ";
        $whereArray = array(':status'=>$status, ':from'=>$from, ':to'=>$to);
        if ($onlyOpen) {
            $whereCond = " (dat.ul_status = -1) AND (dat.ul_timestamp BETWEEN :from AND :to) ";
            $whereArray = array(':from'=>$from, ':to'=>$to);
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
                        usr.ul_company company,
                        usr.ul_pin pin,
                        usr.ul_km_run km_run,
                        usr.ul_mobile mobile,
                        dat.ul_status status
                        FROM complaints_data dat
                        INNER JOIN complaints_users usr ON usr.ul_customer_id = dat.ul_customer_id
                        LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                        LEFT JOIN client_products pro ON pro.ul_product_id = usr.ul_product_id
                        WHERE $whereCond;");
        $solution->execute($whereArray);

        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function getArray_tickeSearchResults($phrase){
        $solution = $this->dbConn->prepare("SELECT
            cus.ul_customer_id customer,
            cus.ul_product_id product,
            cus.ul_purchase_date purchaseDate,
            cus.ul_name name,
            cus.ul_company company,
            cus.ul_mobile mobile,
            cus.ul_alternate_mobile alternateMobile,
            cus.ul_email email,
            cus.ul_pin pin,
            cus.ul_address address,
            cus.ul_landmark landmark,
            cus.ul_km_run km_run,
            com.ul_complaint_id complain,
            com.ul_code complaintCode,
            com.ul_center_id center,
            com.ul_warranty_status warranty,
            com.ul_details details,
            com.ul_est_resolution_date reolutionDate,
            com.ul_status status,
            DATE_FORMAT(com.ul_timestamp, '%d/%m/%Y %H:%i:%s') timestamp,
            pro.ul_product_id productId,
            pro.ul_code productCode,
            cen.ul_name centerName,
            cen.ul_code centerCode,
            cen.ul_phone1 centerContact
            FROM complaints_data com
            LEFT JOIN complaints_users cus ON cus.ul_customer_id = com.ul_customer_id
            LEFT JOIN client_products pro ON pro.ul_product_id = cus.ul_product_id
            LEFT JOIN partners_centers cen ON cen.ul_center_id = com.ul_center_id
            WHERE cus.ul_mobile = :phrase
            OR cus.ul_alternate_mobile = :phrase
            OR com.ul_code = :phrase
            OR cus.ul_email = :phrase
            OR cus.ul_pin = :phrase
            ORDER BY com.ul_complaint_id DESC
            LIMIT 10;");
        $solution->execute(array(':phrase'=>$phrase));
        $product = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $product;
    }

    function getArray_tickeData($id){
        $solution = $this->dbConn->prepare("SELECT
            cus.ul_customer_id customer,
            cus.ul_product_id product,
            cus.ul_purchase_date purchaseDate,
            cus.ul_name name,
            cus.ul_company company,
            cus.ul_mobile mobile,
            cus.ul_alternate_mobile alternateMobile,
            cus.ul_email email,
            cus.ul_pin pin,
            cus.ul_address address,
            cus.ul_landmark landmark,
            cus.ul_km_run km_run,
            com.ul_complaint_id complain,
            com.ul_code complaintCode,
            com.ul_center_id center,
            com.ul_warranty_status warranty,
            com.ul_details details,
            com.ul_est_resolution_date reolutionDate,
            com.ul_status status,
            DATE_FORMAT(com.ul_timestamp, '%d/%m/%Y %H:%i:%s') timestamp,
            pro.ul_product_id productId,
            pro.ul_code productCode,
            cen.ul_name centerName,
            cen.ul_code centerCode
            FROM complaints_data com
            LEFT JOIN complaints_users cus ON cus.ul_customer_id = com.ul_customer_id
            LEFT JOIN client_products pro ON pro.ul_product_id = cus.ul_product_id
            LEFT JOIN partners_centers cen ON cen.ul_center_id = com.ul_center_id
            WHERE com.ul_complaint_id = :id
            LIMIT 10;");
        $solution->execute(array(':id'=>$id));
        $complaint = $solution->fetch(PDO::FETCH_ASSOC);
        return $complaint;
    }

    function get_recent_tickets_data($centerId){
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                com.ul_complaint_id complaint,
                com.ul_code code,
                cen.ul_code center,
                cen.ul_name centerName,
                cen.ul_city city,
                com.ul_status status,
                pro.ul_name product,
                pro.ul_variant model,
                DATE_FORMAT(com.ul_est_resolution_date, '%d/%m/%y') tat,
                DATE_FORMAT(com.ul_timestamp, '%d/%m/%y, %h:%i %p') time
                FROM complaints_data com
                LEFT JOIN partners_centers cen ON cen.ul_center_id = com.ul_center_id
                LEFT JOIN complaints_users cus ON cus.ul_customer_id = com.ul_customer_id
                LEFT JOIN client_products pro ON pro.ul_product_id = cus.ul_product_id
                ORDER BY com.ul_complaint_id DESC LIMIT 6;");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
                com.ul_complaint_id complaint,
                com.ul_code code,
                cen.ul_code center,
                cen.ul_name centerName,
                cen.ul_city city,
                com.ul_status status,
                pro.ul_name product,
                pro.ul_variant model,
                DATE_FORMAT(com.ul_est_resolution_date, '%d/%m/%y') tat,
                DATE_FORMAT(com.ul_timestamp, '%d/%m/%y, %h:%i %p') time
                FROM complaints_data com
                LEFT JOIN partners_centers cen ON cen.ul_center_id = com.ul_center_id
                LEFT JOIN complaints_users cus ON cus.ul_customer_id = com.ul_customer_id
                LEFT JOIN client_products pro ON pro.ul_product_id = cus.ul_product_id
                WHERE cen.ul_center_id = :centerId
                ORDER BY com.ul_complaint_id DESC LIMIT 6;");
            $solution->execute(array(':centerId'=>$centerId));
        }
        $tickets = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $tickets;
    }

    function getComplainSMS($id){
        $solution = $this->dbConn->prepare("SELECT
            cus.ul_mobile mobile,
            com.ul_complaint_id id,
            com.ul_otp otp
            FROM complaints_data com
            LEFT JOIN complaints_users cus ON cus.ul_customer_id = com.ul_customer_id
            WHERE com.ul_complaint_id = :phrase
            LIMIT 1;");
        $solution->execute(array(':phrase'=>$id));
        if ($product = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $product;
        }
        return false;
    }

    function getComplainOTP($id){
        $solution = $this->dbConn->prepare("SELECT
            com.ul_otp otp,
            com.ul_center_id center,
            com.ul_status status
            FROM complaints_data com
            WHERE com.ul_complaint_id = :phrase
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
            com.ul_complaint_id id,
            com.ul_code code,
            cen.ul_code center,
            usr.ul_name name,
            DATE_FORMAT(com.ul_timestamp, '%d/%m/%y') date,
            usr.ul_mobile mobile
            FROM complaints_data com
            LEFT JOIN complaints_users usr on usr.ul_customer_id = com.ul_customer_id
            LEFT JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
            WHERE com.ul_status = -1");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
            com.ul_complaint_id id,
            com.ul_code code,
            cen.ul_code center,
            DATE_FORMAT(com.ul_timestamp, '%d/%m/%y') date,
            usr.ul_name name,
            usr.ul_mobile mobile
            FROM complaints_data com
            LEFT JOIN complaints_users usr on usr.ul_customer_id = com.ul_customer_id
            LEFT JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
            WHERE com.ul_status = -1
            AND com.ul_center_id = :center");
            $solution->execute(array(':center'=>$centerId));
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

    function get_recent_closed_tickets($centerId){
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                com.ul_complaint_id complaint,
                com.ul_code code,
                cen.ul_code center,
                cen.ul_name centerName,
                cen.ul_city city,
                com.ul_status status,
                pro.ul_name product,
                pro.ul_variant model,
                DATE_FORMAT(com.ul_est_resolution_date, '%d/%m/%y') tat,
                DATE_FORMAT(com.ul_timestamp, '%d/%m/%y, %h:%i %p') time
                FROM complaints_data com
                LEFT JOIN partners_centers cen ON cen.ul_center_id = com.ul_center_id
                LEFT JOIN complaints_users cus ON cus.ul_customer_id = com.ul_customer_id
                LEFT JOIN client_products pro ON pro.ul_product_id = cus.ul_product_id
                WHERE com.ul_status = 1
                ORDER BY com.ul_est_resolution_date DESC LIMIT 6;");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
                com.ul_complaint_id complaint,
                com.ul_code code,
                cen.ul_code center,
                cen.ul_name centerName,
                cen.ul_city city,
                com.ul_status status,
                pro.ul_name product,
                pro.ul_variant model,
                DATE_FORMAT(com.ul_est_resolution_date, '%d/%m/%y') tat,
                DATE_FORMAT(com.ul_timestamp, '%d/%m/%y, %h:%i %p') time
                FROM complaints_data com
                LEFT JOIN partners_centers cen ON cen.ul_center_id = com.ul_center_id
                LEFT JOIN complaints_users cus ON cus.ul_customer_id = com.ul_customer_id
                LEFT JOIN client_products pro ON pro.ul_product_id = cus.ul_product_id
                WHERE com.ul_center_id = :centerId AND com.ul_status = 1
                ORDER BY com.ul_est_resolution_date DESC LIMIT 6;");
            $solution->execute(array(':centerId'=>$centerId));
        }
        $tickets = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $tickets;
    }

    function get_recent_job_works($centerId){
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                com.ul_code code,
                job.ul_job_id jobId,
                com.ul_status status,
                job.ul_status_brief_internal descr,
                DATE_FORMAT(job.ul_timestamp, '%d/%m/%y, %h:%i %p') time
                FROM complaints_jobs job
                LEFT JOIN complaints_data com ON com.ul_complaint_id  = job.ul_complaint_id
                ORDER BY job.ul_job_id DESC LIMIT 5;");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
                com.ul_code code,
                job.ul_job_id jobId,
                com.ul_status status,
                job.ul_status_brief_internal descr,
                DATE_FORMAT(job.ul_timestamp, '%d/%m/%y, %h:%i %p') time
                FROM complaints_jobs job
                LEFT JOIN complaints_data com ON com.ul_complaint_id  = job.ul_complaint_id
                WHERE com.ul_center_id = :centerId
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

    function get_ticket_details($ticketId){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                dat.ul_complaint_id id,
                dat.ul_code code,
                cen.ul_name center,
                user.ul_pin city_pin,
                pro.ul_name product,
                dat.ul_warranty_status warranty,
                user.ul_purchased_from pos,
                user.ul_name customer,
                user.ul_company company,
                user.ul_mobile mobile,
                user.ul_alternate_mobile alt_mobile,
                user.ul_email email,
                user.ul_address address,
                dat.ul_details details,
                dat.ul_user_id user,
                city.city city,
                city.district district,
                city.state state
                FROM complaints_data dat
                INNER JOIN complaints_users user ON user.ul_customer_id = dat.ul_customer_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                LEFT JOIN client_products pro ON pro.ul_product_id = user.ul_product_id
                LEFT JOIN pincodes_data city ON city.pincode = user.ul_pin
                WHERE dat.ul_complaint_id = :ticket");
            $solution->execute(array(':ticket'=>$ticketId));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                dat.ul_complaint_id id,
                dat.ul_code code,
                cen.ul_name center,
                user.ul_pin city_pin,
                pro.ul_name product,
                dat.ul_warranty_status warranty,
                user.ul_purchased_from pos,
                user.ul_name customer,
                user.ul_company company,
                user.ul_mobile mobile,
                user.ul_alternate_mobile alt_mobile,
                user.ul_email email,
                user.ul_address address,
                dat.ul_details details,
                dat.ul_user_id user,
                city.city city,
                city.district district,
                city.state state
                FROM complaints_data dat
                INNER JOIN complaints_users user ON user.ul_customer_id = dat.ul_customer_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = dat.ul_center_id
                LEFT JOIN client_products pro ON pro.ul_product_id = user.ul_product_id
                LEFT JOIN pincodes_data city ON city.pincode = user.ul_pin
                WHERE (dat.ul_complaint_id = :ticket) AND (dat.ul_center_id = :center);");
            $solution->execute(array(':center'=>$centerId, ':ticket'=>$ticketId));
        }
        if ($details = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $details;
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


################################################################################################################################

    function getArrayUser_dashboardInfo($userId){
        $solution = $this->dbConn->prepare("SELECT
                pl.ul_name plan,
                pl.ul_amount amount,
                pl.ul_time time,
                pl.ul_direct direct,
                pl.ul_daily daily,
                p.ul_sponsor sponsor,
                p.ul_position position,
                p.ul_plan_timestamp takenOn
                FROM users_personal p
                LEFT JOIN clients_plans pl ON pl.ul_plan_id = p.ul_plan_id
                WHERE p.ul_user_id = :id LIMIT 1");
        $solution->execute(array(':id'=>$userId));
        if ($details = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return false;
        }
    }

    function getArrayUser_walletInfo($userId){
        $solution = $this->dbConn->prepare("SELECT
                pl.ul_amount amount,
                pl.ul_daily daily,
                p.ul_plan_timestamp takenOn,
                wl.ul_btc_wallet btcWallet,
                wl.ul_fc_wallet fcWallet,
                wl.ul_timestamp updated
                FROM users_personal p
                LEFT JOIN users_wallet wl ON wl.ul_user_id = p.ul_user_id
                LEFT JOIN clients_plans pl ON pl.ul_plan_id = p.ul_plan_id
                WHERE p.ul_user_id = :id LIMIT 1");
        $solution->execute(array(':id'=>$userId));
        if ($details = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return array(
                'amount'=>0,
                'daily'=>0,
                'takenOn'=> date('Y-m-d'),
                'btcWallet'=>0,
                'fcWallet'=>0,
                'updated'=>date('Y-m-d H:i:s')
            );
        }
    }

    function getArrayUser_walletBTCInfo($userId){
        $solution = $this->dbConn->prepare("SELECT
                wl.ul_btc_address address,
                wl.ul_btc_account account
                FROM users_wallet wl
                WHERE wl.ul_user_id = :id LIMIT 1");
        $solution->execute(array(':id'=>$userId));
        if ($details = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return array(
                'address'=>0,
                'account'=>0
            );
        }
    }

    function getArrayUser_userTickets($userId){
        $solution = $this->dbConn->prepare("SELECT
                ul_ticket_title ticket_title,
                ul_ticket ticket,
                ul_ticket_file ticket_file,
                ul_timestamp timestamp,
                ul_resolution_title resolution_title,
                ul_resolution resolution,
                ul_resolution_timestamp resolution_timestamp,
                ul_status status
                FROM users_ticket t
                WHERE t.ul_user_id = :id");
        $solution->execute(array(':id'=>$userId));
        if ($details = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return false;
        }
    }

    function getArrayUser_walletTransactions($userId){
        $solution = $this->dbConn->prepare("SELECT
                w.ul_withdrawl_id txn_id,
                'DR' as txn_type,
                w.ul_amount amount,
                CONCAT (w.ul_withdraw_type, ' ', w.ul_withdraw_to_account) txn_for,
                w.ul_timestamp time
                FROM user_withdraws w
                WHERE w.ul_user_id = :id
            UNION
                SELECT
                c.ul_commission_id txn_id,
                'CR' as txn_type,
                c.ul_amount amount,
                c.ul_for_user txn_for,
                c.ul_timestamp time
                FROM user_commission_transactions c
                WHERE c.ul_user_id = :id");
        $solution->execute(array(':id'=>$userId));
        if ($details = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return array(
                array(
                'txn_id'=>'NO DATA',
                'txn_type'=>'',
                'amount'=> '',
                'txn_for'=>'',
                'time'=>'')
            );
        }
    }

    function getArrayUser_profileInfo($userId){
        $solution = $this->dbConn->prepare("SELECT
                p.ul_name name,
                p.ul_mobile mobile,
                p.ul_email email,
                p.ul_username username,
                p.ul_country country,
                p.ul_city city,
                p.ul_sponsor sponsor,
                p.ul_position position
                FROM users_personal p
                WHERE p.ul_user_id = :id LIMIT 1");
        $solution->execute(array(':id'=>$userId));
        if ($details = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return false;
        }
    }

    // function parseTree($src_arr, $currentid, $parentfound = false, $cats = array()){
        //     foreach($src_arr as $row){
        //         if((!$parentfound && $row['username'] == $currentid) || $row['sponsor'] == $currentid){
        //             $rowdata = array();
        //             foreach($row as $k => $v)
        //                 $rowdata[$k] = $v;
        //             $cats[] = $rowdata;
        //             if($row['sponsor'] == $currentid){
        //                 $cats = array_merge($cats, $this->parseTree($src_arr, $row['username'], true));
        //             }
        //         }
        //     }
        //     return $cats;
    // }

    function parseTree($datas, $parent = 0){
        static $tree = array();
        for($i=0, $ni=count($datas); $i < $ni; $i++){
            if($datas[$i]['sponsor'] == $parent){
                $tree[] = $datas[$i];
                $this->parseTree($datas, $datas[$i]['username']);
            }
        }
        return $tree;
    }

    function getArrayUser_chainList($userId, $username){
        $solution = $this->dbConn->prepare("SELECT
            p.ul_username username,
            p.ul_name name,
            p.ul_sponsor sponsor,
            p.ul_position position,
            p.ul_timestamp timestamp
            FROM users_personal p
            WHERE p.ul_user_id > :id");
        $solution->execute(array(':id'=>$userId));
        if ($details = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $this->parseTree($details, $username);
        }else{
            return array(
                array(
                    'username' => '',
                    'name' => 'No Users in Downline',
                    'sponsor' => '',
                    'position' => '',
                    'timestamp' => ''
                )
            );
        }
    }

    function getArrayUser_chainTree($userId, $username){
        $solution = $this->dbConn->prepare("SELECT
            p.ul_username username,
            p.ul_name name,
            p.ul_sponsor sponsor,
            p.ul_position title
            FROM users_personal p
            WHERE p.ul_user_id > :id");
        $solution->execute(array(':id'=>$userId));
        if ($details = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $this->parseTree($details, $username);
        }else{
            return array(
                array(
                    'username' => '',
                    'name' => 'No Users in Downline',
                    'sponsor' => '',
                    'title' => ''
                )
            );
        }
    }

    function getArrayUser_chainBusinessCount($userId, $username){
        $solution = $this->dbConn->prepare("SELECT
            p.ul_username username,
            p.ul_sponsor sponsor,
            pl.ul_amount amount
            FROM users_personal p
            LEFT JOIN clients_plans pl ON pl.ul_plan_id = p.ul_plan_id
            WHERE p.ul_user_id > :id");
        $solution->execute(array(':id'=>$userId));
        if ($details = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            $team = $this->parseTree($details, $username);
            $business = 0;
            $count = 0;
            foreach ($team as $value) {
                $business += $value['amount'];
                $count++;
            }
            return array($count, $business);
        }else{
            return array(0, 0);
        }
    }

    function getArrayUser_chainDirect($username){
        $solution = $this->dbConn->prepare("SELECT
            p.ul_username username,
            p.ul_name name,
            p.ul_sponsor sponsor,
            p.ul_position position,
            p.ul_timestamp timestamp
            FROM users_personal p
            WHERE p.ul_sponsor = :id");
        $solution->execute(array(':id'=>$username));
        if ($details = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return array(
                array(
                    'username' => '',
                    'name' => 'No Users in Downline',
                    'sponsor' => '',
                    'position' => '',
                    'timestamp' => ''
                )
            );
        }
    }

    function getArrayUser_incentivesDaily($userId){
        $solution = $this->dbConn->prepare("SELECT
                pl.ul_time time,
                pl.ul_daily daily,
                p.ul_multiplier_timestamp multiplyFrom,
                p.ul_multiplier multiplier,
                p.ul_plan_timestamp takenOn
                FROM users_personal p
                LEFT JOIN clients_plans pl ON pl.ul_plan_id = p.ul_plan_id
                WHERE p.ul_user_id = :id LIMIT 1");
        $solution->execute(array(':id'=>$userId));
        if ($details = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return false;
        }
    }

    function parseSeniorTree($sponsor){
        $sponsor = array('sponsor'=>$sponsor, 'username'=>'', 'position'=>'', 'id'=>'', 'planId'=>'');
        $tree = array();
        $seniors = array();
        do{
            $tree[] = $sponsor;
            $seniors[] = $sponsor['sponsor'];
            $solution = $this->dbConn->prepare("SELECT p.ul_user_id id, p.ul_plan_id planId, p.ul_username username, p.ul_sponsor sponsor, p.ul_position position FROM users_personal p WHERE p.ul_username = :username");
            $solution->execute(array(':username'=>array_pop($seniors)));
        }while ($sponsor = $solution->fetch(PDO::FETCH_ASSOC));
        return $tree;
    }

################################################################################################################################

    function getData_ProductTaxes($sku, $catId){
        if(PRODUCT_WISE_TAX){
            $where = 'ul_hsn_code';
            $id = $sku;
        }else{
            $where = 'ul_category_id';
            $id = $catId;
        }
        $solution = $this->dbConn->prepare("SELECT
                ul_tax1 ".TAX1.",
                ul_tax2 ".TAX2.",
                ul_tax3 ".TAX3.",
                ul_surcharge1 ".SURCHARGE1.",
                ul_surcharge2 ".SURCHARGE2.",
                ul_surcharge3 ".SURCHARGE3."
                FROM client_taxation
                WHERE $where = :id LIMIT 1");
        $solution->execute(array(':id'=>$id));
        if ($taxes = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $taxes;
        }else{
            return false;
        }
    }

    function getArray_mainSearchResults($phrase){
        $phrase = explode(' ', $phrase);
        $result = array();
        foreach ($phrase as $keyword) {
            $solution = $this->dbConn->prepare("SELECT
                p.ul_title name,
                c.ul_title description,
                CONCAT('/product/', p.ul_category_id, '/', p.ul_sku, '/', c.ul_permalink, '/', p.ul_permalink) url
                FROM products_data p
                INNER JOIN centers_products_data m ON m.ul_sku = p.ul_sku
                LEFT JOIN client_categories c ON c.ul_category_id = p.ul_category_id
                LEFT JOIN category_popular_brands b ON b.ul_brand_id = p.ul_brand_id
                WHERE p.ul_product_variants_data RLIKE :phrase
                OR p.ul_title RLIKE :phrase
                OR p.ul_subtitle RLIKE :phrase
                OR c.ul_title RLIKE :phrase
                OR b.ul_title RLIKE :phrase
                LIMIT 10;");
            $solution->execute(array(':phrase'=>$keyword));
            $product = $solution->fetchAll(PDO::FETCH_ASSOC);
            $result = array_merge($result, $product);
        }
        //return $result;
        $result = array_count_values( array_map("serialize", $result));
        arsort($result,SORT_NUMERIC);
        $result = array_map("unserialize",array_keys($result));
        return $result;
    }



################################################################################################################################

};
$function = new Functions();