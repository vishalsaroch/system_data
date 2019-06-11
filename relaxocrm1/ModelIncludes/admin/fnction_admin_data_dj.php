<?php

CLASS Functions extends Connection {


################################################## MENU
    function getData_dashboard($centerId){
        $centerId = (int) $centerId;
        $today = date('Y-m-d');
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
            (SELECT COUNT(*) FROM clients_customers_products WHERE (ul_timestamp >= '$today')) todayProduct,
            (SELECT COUNT(*) FROM complaints_jobs WHERE (ul_timestamp >= '$today')) todayUpdated,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_timestamp >= '$today')) todayTicket,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_status < 1) AND (ul_est_resolution_date <= '$today')) todayCompletion,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_status < 1)) totalPending,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_status = 1)) totalClosed,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_status = 2)) totalCanceled");
            $solution->execute();
        }elseif($this->userLevel > 1){
            $solution = $this->dbConn->prepare("SELECT
            0 todayProduct,
            (SELECT COUNT(*) FROM complaints_jobs job INNER JOIN complaints_data com ON com.ul_complaint_id = job.ul_complaint_id WHERE (com.ul_center_id = :center) AND (job.ul_timestamp >= '$today')) todayUpdated,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_center_id = :center) AND (ul_timestamp >= '$today')) todayTicket,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_center_id = :center) AND (ul_status < 1) AND (ul_est_resolution_date <= '$today')) todayCompletion,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_center_id = :center) AND (ul_status < 1)) totalPending,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_center_id = :center) AND (ul_status = 1)) totalClosed,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_center_id = :center) AND (ul_status = 2)) totalCanceled");
            $solution->execute(array(':center'=>$centerId));
        }else{
            $solution = $this->dbConn->prepare("SELECT
            0 todayProduct,
            (SELECT COUNT(*) FROM complaints_jobs job INNER JOIN complaints_data com ON com.ul_complaint_id = job.ul_complaint_id WHERE (com.ul_center_id = :center) AND (ul_centers_user_id = :user) AND (job.ul_timestamp >= '$today')) todayUpdated,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_center_id = :center) AND (ul_centers_user_id = :user) AND (ul_timestamp >= '$today')) todayTicket,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_center_id = :center) AND (ul_centers_user_id = :user) AND (ul_status < 1) AND (ul_est_resolution_date <= '$today')) todayCompletion,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_center_id = :center) AND (ul_centers_user_id = :user) AND (ul_status < 1)) totalPending,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_center_id = :center) AND (ul_centers_user_id = :user) AND (ul_status = 1)) totalClosed,
            (SELECT COUNT(*) FROM complaints_data WHERE (ul_center_id = :center) AND (ul_centers_user_id = :user) AND (ul_status = 2)) totalCanceled");
            $solution->execute(array(':center'=>$centerId, ':user'=>$this->userId));
        }
        $count = $solution->fetch(PDO::FETCH_ASSOC);
        return $count;
    }

    function getArray_products($start=0, $results=1000, $where='', $whereArray=array()){
        $q = "SELECT
            prd.ul_product_id id,
            prd.ul_code code,
            prd.ul_brand brand,
            prd.ul_category category,
            prd.ul_stock stock,
            prd.ul_hsn hsn,
            prd.ul_warranty warranty,
            prd.ul_spec1 spec1,
            prd.ul_spec2 spec2,
            prd.ul_name name,
            prd.ul_model model,
            prd.ul_status status
            FROM client_products prd
            $where
            LIMIT $start, $results;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute($whereArray);
        if ($resuts = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $resuts;
        }else{
            return false;
        }
    }

    function getArray_productSpares($start=0, $results=1000, $where='', $whereArray=array()){
        $q = "SELECT
            prd.ul_product_id prd_id,
            prd.ul_code prd_code,
            prd.ul_brand prd_brand,
            prd.ul_category prd_category,
            prd.ul_spec1 prd_spec1,
            prd.ul_spec2 prd_spec2,
            prd.ul_name prd_name,
            prd.ul_model prd_model,
            spr.ul_spare_id spr_id,
            IFNULL(spr.ul_code, 'No Spare Added') spr_code,
            spr.ul_category spr_category,
            spr.ul_name spr_name,
            spr.ul_model spr_model,
            spr.ul_spec spr_spec,
            prdSpr.ul_quantity spr_qty
            FROM client_products prd
            LEFT JOIN client_product_spares prdSpr ON prdSpr.ul_product_id = prd.ul_product_id
            LEFT JOIN client_spares spr ON spr.ul_spare_id = prdSpr.ul_spare_id
            $where
            LIMIT $start, $results;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute($whereArray);
        if ($resuts = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $resuts;
        }else{
            return false;
        }
    }

    function getArray_customersPersonal($start=0, $results=1000, $where='', $whereArray=array()){
        $solution = $this->dbConn->prepare("SELECT
                            cus.ul_name customer,
                            cus.ul_code code,
                            cus.ul_city_pin pin,
                            cus.ul_mobile mobile,
                            cus.ul_alternate_mobile alternate_mobile,
                            cus.ul_email email,
                            cus.ul_customer_id id,
                            cus.ul_address address,
                            cus.ul_landmark landmark,
                            pin.ul_state state,
                            pin.ul_district district,
                            pin.ul_city city
                            FROM clients_customers cus
                            INNER JOIN pincodes_data pin ON pin.ul_pincode = cus.ul_city_pin
                            $where
                            LIMIT $start, $results;");
        $solution->execute($whereArray);
        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function getDetail_customer($customerId){
        $solution = $this->dbConn->prepare("SELECT
                            cus.ul_name customer,
                            cus.ul_code code,
                            cus.ul_city_pin pin,
                            cus.ul_mobile mobile,
                            cus.ul_alternate_mobile alternate_mobile,
                            cus.ul_email email,
                            cus.ul_customer_id id,
                            cus.ul_address address,
                            cus.ul_landmark landmark,
                            pin.ul_state state,
                            pin.ul_district district,
                            pin.ul_city city
                            FROM clients_customers cus
                            INNER JOIN pincodes_data pin ON pin.ul_pincode = cus.ul_city_pin
                            WHERE (cus.ul_customer_id = :crn)
                            LIMIT 1;");
        $solution->execute(array(':crn'=>$customerId));
        if ($resukt = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $resukt;
        }else{
            return false;
        }
    }

    function getArray_customersProduct($start=0, $results=1000, $where='', $whereArray=array()){
        $q = "SELECT
            cus.ul_customer_id id,
            cus.ul_code code,
            cus.ul_name customer,
            prd.ul_product_id product_id,
            prd.ul_name product,
            prd.ul_model model,
            prd.ul_brand brand,
            cusPrd.ul_customer_product_id customer_product_id,
            cusPrd.ul_warranty_status warranty,
            cusPrd.ul_quantity quantity,
            DATE_FORMAT(cusPrd.ul_purchase_date, '%d/%m/%y') purchase_date
            FROM clients_customers cus
            INNER JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_id = cus.ul_customer_id
            INNER JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
            $where
            LIMIT $start, $results;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute($whereArray);
        if ($details = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return false;
        }
    }

    function getDetail_customerProduct($customerProductId){
        $q = "SELECT
            cus.ul_customer_id id,
            cus.ul_code code,
            cus.ul_name customer,
            cus.ul_company company,
            prd.ul_brand brand,
            prd.ul_category productCat,
            prd.ul_name product,
            prd.ul_model model,
            prd.ul_product_id product_id,
            cusPrd.ul_purchased_from purchased_from,
            cusPrd.ul_warranty_status warranty,
            cusPrd.ul_quantity quantity,
            cusPrd.ul_code productCode,
            cusPrd.ul_dealer dealer,
            cusPrd.ul_dealer_address dealer_address,
            cusPrd.ul_dealer_pin dealer_pin,
            DATE_FORMAT(cusPrd.ul_purchase_date, '%d/%m/%Y') purchase_date
            FROM clients_customers cus
            INNER JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_id = cus.ul_customer_id
            INNER JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
            WHERE cusPrd.ul_customer_product_id = :product
            LIMIT 1;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute(array(":product"=>$customerProductId));
        if ($result = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $result;
        }else{
            return false;
        }
    }

    function getArray_tickets($start=0, $results=1000, $where='', $whereArray=array()){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $q = "SELECT
                        com.ul_complaint_id id,
                        com.ul_code code,
            DATE_FORMAT(com.ul_est_resolution_date, '%d/%m/%Y') close_time,
            DATE_FORMAT(com.ul_timestamp, '%d/%m/%y %h:%i %p') open_time,
                        cen.ul_code center,
                        cen.ul_name centerName,
                        cen.ul_city city,
                        prd.ul_brand brand,
                        prd.ul_name product,
                        prd.ul_model model,
                        cus.ul_name customer,
                        com.ul_quantity quantity,
                        cus.ul_mobile mobile,
                        com.ul_status status
                        FROM complaints_data com
                        LEFT JOIN clients_customers cus ON cus.ul_customer_id = com.ul_customer_id
                        LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_product_id = com.ul_customer_product_id
                        LEFT JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
                        LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                        $where
                        ORDER BY com.ul_complaint_id DESC
                        LIMIT $start, $results;";
        }else{
            $where .= " AND (cen.ul_center_id = :center) ";
            $whereArray[":center"] = $centerId;
            if ($this->userLevel == 1) {
                $where .= " AND (com.ul_centers_user_id = :userId) ";
                $whereArray[":userId"] = $this->user;
            }
            $q ="SELECT
                        com.ul_complaint_id id,
                        com.ul_code code,
            DATE_FORMAT(com.ul_est_resolution_date, '%d/%m/%Y') close_time,
            DATE_FORMAT(com.ul_timestamp, '%d/%m/%y %h:%i %p') open_time,
                 CONCAT(cus.ul_landmark, ', ', pin.ul_city) center,
                        cus.ul_address centerName,
                 CONCAT(pin.ul_district, ', ', pin.ul_state) city,
                        prd.ul_brand brand,
                        prd.ul_name product,
                        prd.ul_model model,
                        cus.ul_name customer,
                        com.ul_quantity quantity,
                        cus.ul_mobile mobile,
                        com.ul_status status
                        FROM complaints_data com
                        INNER JOIN clients_customers cus ON cus.ul_customer_id = com.ul_customer_id
                        INNER JOIN pincodes_data pin ON pin.ul_pincode = cus.ul_city_pin
                        LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_product_id = com.ul_customer_product_id
                        LEFT JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
                        LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                        $where
                        ORDER BY com.ul_complaint_id DESC
                        LIMIT $start, $results;";
        }
        $solution = $this->dbConn->prepare($q);
        $solution->execute($whereArray);
        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function getArray_centersReports($where='', $whereArray=array()){
        $centerId = $this->centerId;
        $q = "SELECT
                        COUNT(com.ul_complaint_id) complaints,
                        SUM(com.ul_quantity) quantity,
                        cen.ul_code center,
                        cen.ul_name centerName,
                        cen.ul_center_id id,
                        com.ul_status status
                        FROM complaints_data com
                        LEFT JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
                        $where
                        GROUP BY com.ul_status, com.ul_center_id;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute($whereArray);
        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function getArray_centerReportDetail($where='', $whereArray=array()){
        $centerId = $this->centerId;
            $q = "SELECT
                    prd.ul_product_id product_id,
                    prd.ul_brand brand,
                    prd.ul_name product,
                    prd.ul_model model,
                    prd.ul_service_rate_1 rate24,
                    prd.ul_service_rate_2 rate48,
                    prd.ul_service_rate_3 rate72,
                    prd.ul_service_rate_4 rateMore72,
                    cus.ul_customer_id customer_id,
                    cus.ul_code crn,
                    cus.ul_name customer,
                    com.ul_complaint_id complaint,
                    com.ul_code code,
                    com.ul_quantity quantity,
                    DATE_FORMAT(com.ul_timestamp, '%d/%m/%y %h:%i %p') open_time,
                    com.ul_action_hours time,
                    job.ul_job_id job_id,
                    job.ul_km_run km,
                    job.ul_status status
                    FROM complaints_data com
                    LEFT JOIN clients_customers cus ON cus.ul_customer_id = com.ul_customer_id
                    LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_product_id = com.ul_customer_product_id
                    INNER JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
                    INNER JOIN complaints_jobs job ON job.ul_complaint_id = com.ul_complaint_id
                    LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                    $where;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute($whereArray);
        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function getArray_centersReportsBrief($where='', $whereArray=array()){
        $centerId = $this->centerId;
        $q = "SELECT
                        COUNT(com.ul_complaint_id) complaints,
                        SUM(com.ul_quantity) quantity,
                        'Within 24 Hours' time,
                        com.ul_status status
                        FROM complaints_data com
                        $where AND com.ul_action_hours <= 24
                        GROUP BY com.ul_status
                UNION
                    SELECT
                        COUNT(com.ul_complaint_id) complaints,
                        SUM(com.ul_quantity) quantity,
                        'Within 25 TO 48 Hours' time,
                        com.ul_status status
                        FROM complaints_data com
                        $where AND com.ul_action_hours > 24 AND com.ul_action_hours <= 48
                        GROUP BY com.ul_status
                UNION
                    SELECT
                        COUNT(com.ul_complaint_id) complaints,
                        SUM(com.ul_quantity) quantity,
                        'Within 49 TO 72 Hours' time,
                        com.ul_status status
                        FROM complaints_data com
                        $where AND com.ul_action_hours > 48 AND com.ul_action_hours <= 72
                        GROUP BY com.ul_status
                UNION
                    SELECT
                        COUNT(com.ul_complaint_id) complaints,
                        SUM(com.ul_quantity) quantity,
                        'More than 72 Hours' time,
                        com.ul_status status
                        FROM complaints_data com
                        $where AND com.ul_action_hours > 72
                        GROUP BY com.ul_status;
                UNION
                    SELECT
                        '' complaints,
                        SUM(job.ul_km_run) quantity,
                        'KM Run for Closed within 72 Hours' time,
                        com.ul_status status
                        FROM complaints_data com
                        left JOIN complaints_jobs job ON job.ul_complaint_id = com.ul_complaint_id
                        $where AND (job.ul_status IN (1,4)) AND com.ul_action_hours < 73 AND job.ul_km_run > 20;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute($whereArray);
        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function getDetail_ticket($ticket, $status=false){
        $status = ($status !== false) ? " AND (com.ul_status = $status) " :  " ";
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                            com.ul_complaint_id id,
                            com.ul_code code,
                            cus.ul_code crn,
                            cus.ul_name customer,
                            cus.ul_company company,
                            cus.ul_mobile mobile,
                            cus.ul_alternate_mobile alternate_mobile,
                            cus.ul_email email,
                            cus.ul_address address,
                            cus.ul_landmark landmark,
                            pin.ul_city city,
                            pin.ul_district district,
                            pin.ul_state state,
                            cus.ul_city_pin city_pin,
                            prd.ul_brand brand,
                            prd.ul_category category,
                            prd.ul_name product,
                            prd.ul_model model,
                            prd.ul_spec1 spec1,
                            prd.ul_spec2 spec2,
                            cusPrd.ul_warranty_status warranty,
                            com.ul_quantity quantity,
                            com.ul_details details,
                            com.ul_status status,
                DATE_FORMAT(com.ul_timestamp, '%d/%m/%y %h:%i %p') open_time,
                DATE_FORMAT(com.ul_est_resolution_date, '%d/%m/%Y') erd,
                            cusPrd.ul_customer_product_id customer_product_id,
                            cen.ul_code center,
                            cen.ul_center_id center_id,
                            cen.ul_name centerName,
                            cen.ul_city centerCity,
                            tec.ul_name technician,
                            tec.ul_mobile technicianMobile,
                            usr.ul_name user
                            FROM complaints_data com
                            LEFT JOIN clients_customers cus ON cus.ul_customer_id = com.ul_customer_id
                            LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_product_id = com.ul_customer_product_id
                            LEFT JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
                            LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                            LEFT JOIN pincodes_data pin ON pin.ul_pincode = cus.ul_city_pin
                            LEFT JOIN users_personal tec ON tec.ul_user_id = com.ul_centers_user_id
                            LEFT JOIN users_personal usr ON usr.ul_user_id = com.ul_user_id
                            WHERE (com.ul_complaint_id = :ticket) $status
                            LIMIT 1;");
            $solution->execute(array(':ticket'=>$ticket));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                            com.ul_complaint_id id,
                            com.ul_code code,
                            cus.ul_code crn,
                            cus.ul_customer_id customer_id,
                            cus.ul_name customer,
                            cus.ul_company company,
                            cus.ul_mobile mobile,
                            cus.ul_alternate_mobile alternate_mobile,
                            cus.ul_email email,
                            cus.ul_address address,
                            cus.ul_landmark landmark,
                            pin.ul_city city,
                            pin.ul_district district,
                            pin.ul_state state,
                            cus.ul_city_pin city_pin,
                            prd.ul_brand brand,
                            prd.ul_category category,
                            prd.ul_name product,
                            prd.ul_model model,
                            prd.ul_spec1 spec1,
                            prd.ul_spec2 spec2,
                            cusPrd.ul_warranty_status warranty,
                            com.ul_quantity quantity,
                            com.ul_details details,
                            com.ul_status status,
                DATE_FORMAT(com.ul_timestamp, '%d/%m/%y %h:%i %p') open_time,
                DATE_FORMAT(com.ul_est_resolution_date, '%d/%m/%Y') erd,
                            cen.ul_code center,
                            cen.ul_center_id center_id,
                            cen.ul_name centerName,
                            cen.ul_city centerCity,
                            tec.ul_name technician,
                            tec.ul_mobile technicianMobile
                            FROM complaints_data com
                            LEFT JOIN clients_customers cus ON cus.ul_customer_id = com.ul_customer_id
                            LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_product_id = com.ul_customer_product_id
                            LEFT JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
                            LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                            LEFT JOIN pincodes_data pin ON pin.ul_pincode = cus.ul_city_pin
                            LEFT JOIN users_personal tec ON tec.ul_user_id = com.ul_centers_user_id
                            WHERE (cen.ul_center_id = :center) AND (com.ul_complaint_id = :ticket) $status
                            LIMIT 1;");
            $solution->execute(array(':center'=>$centerId, ':ticket'=>$ticket));
        }
        if ($tickets = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function getArray_jobs($start=0, $results=1000, $where='', $whereArray=array()){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                            DISTINCT job.ul_job_id id,
                            com.ul_complaint_id complaint_id,
                            com.ul_code code,
                DATE_FORMAT(job.ul_timestamp, '%d/%m/%y %h:%i %p') job_time,
                            job.ul_status_brief_internal work_done,
                            job.ul_status_brief_customer status,
                            job.ul_attender_name attender,
                            job.ul_type type,
                            job.ul_status stts,
                            job.ul_km_run km,
              IFNULL(CONCAT(spr.ul_category, ', ', spr.ul_name, ', ', spr.ul_model), 'No Spare Replaced') replaced_spare
                            FROM complaints_jobs job
                            LEFT JOIN complaints_data com ON com.ul_complaint_id = job.ul_complaint_id
                            LEFT JOIN complaints_jobs_spares jobSpr ON jobSpr.ul_job_id = job.ul_job_id
                            LEFT JOIN client_spares spr ON spr.ul_spare_id = jobSpr.ul_spare_id
                            $where
                            LIMIT $start, $results;");
            $solution->execute($whereArray);
        }else{
            $where .= " AND (cen.ul_center_id = :center) ";
            $whereArray[":center"] = $centerId;
            $solution = $this->dbConn->prepare("SELECT
                            DISTINCT job.ul_job_id id,
                            com.ul_complaint_id complaint_id,
                            com.ul_code code,
                DATE_FORMAT(job.ul_timestamp, '%d/%m/%y %h:%i %p') job_time,
                            job.ul_status_brief_internal work_done,
                            job.ul_status_brief_customer status,
                            job.ul_attender_name attender,
                            job.ul_type type,
                            job.ul_status stts,
                            job.ul_km_run km,
              IFNULL(CONCAT(spr.ul_category, ', ', spr.ul_name, ', ', spr.ul_model), 'No Spare Replaced') replaced_spare
                            FROM complaints_jobs job
                            LEFT JOIN complaints_data com ON com.ul_complaint_id = job.ul_complaint_id
                            LEFT JOIN complaints_jobs_spares jobSpr ON jobSpr.ul_job_id = job.ul_job_id
                            LEFT JOIN client_spares spr ON spr.ul_spare_id = jobSpr.ul_spare_id
                            $where
                            LIMIT $start, $results;");
            $solution->execute($whereArray);
        }
        if ($jobs = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $jobs;
        }else{
            return false;
        }
    }

    function getDetail_job($jobId, $status=false){
        $status = ($status !== false) ? " AND (com.ul_status = $status) " :  " ";
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                            com.ul_complaint_id id,
                            com.ul_code code,
                            cus.ul_name customer,
                            cus.ul_company company,
                            cus.ul_mobile mobile,
                            cus.ul_alternate_mobile alternate_mobile,
                            cus.ul_email email,
                            cus.ul_address address,
                            cus.ul_landmark landmark,
                            pin.ul_city city,
                            pin.ul_district district,
                            pin.ul_state state,
                            cus.ul_city_pin city_pin,
                            prd.ul_brand brand,
                            prd.ul_category category,
                            prd.ul_name product,
                            prd.ul_model model,
                            prd.ul_spec1 spec1,
                            prd.ul_spec2 spec2,
                            com.ul_quantity quantity,
                            com.ul_details details,
                DATE_FORMAT(com.ul_timestamp, '%d/%m/%y %h:%i %p') open_time,
                            cen.ul_code center,
                            cen.ul_name centerName,
                            tec.ul_name technician,
                            tec.ul_mobile technicianMobile,
                            usr.ul_name user
                            FROM complaints_data com
                            LEFT JOIN clients_customers cus ON cus.ul_customer_id = com.ul_customer_id
                            LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_product_id = com.ul_customer_product_id
                            LEFT JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
                            LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                            LEFT JOIN pincodes_data pin ON pin.ul_pincode = cus.ul_city_pin
                            LEFT JOIN users_personal tec ON tec.ul_user_id = com.ul_centers_user_id
                            LEFT JOIN users_personal usr ON usr.ul_user_id = com.ul_user_id
                            WHERE (com.ul_complaint_id = :ticket) $status
                            LIMIT 1;");
            $solution->execute(array(':ticket'=>$ticket));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                            com.ul_complaint_id id,
                            com.ul_code code,
                            cus.ul_name customer,
                            cus.ul_company company,
                            cus.ul_mobile mobile,
                            cus.ul_alternate_mobile alternate_mobile,
                            cus.ul_email email,
                            cus.ul_address address,
                            cus.ul_landmark landmark,
                            pin.ul_city city,
                            pin.ul_district district,
                            pin.ul_state state,
                            cus.ul_city_pin city_pin,
                            prd.ul_brand brand,
                            prd.ul_category category,
                            prd.ul_name product,
                            prd.ul_model model,
                            prd.ul_spec1 spec1,
                            prd.ul_spec2 spec2,
                            com.ul_quantity quantity,
                            com.ul_details details,
                DATE_FORMAT(com.ul_timestamp, '%d/%m/%y %h:%i %p') open_time,
                            cen.ul_code center,
                            cen.ul_name centerName,
                            tec.ul_name technician,
                            tec.ul_mobile technicianMobile
                            FROM complaints_data com
                            LEFT JOIN clients_customers cus ON cus.ul_customer_id = com.ul_customer_id
                            LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_product_id = com.ul_customer_product_id
                            LEFT JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
                            LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                            LEFT JOIN pincodes_data pin ON pin.ul_pincode = cus.ul_city_pin
                            LEFT JOIN users_personal tec ON tec.ul_user_id = com.ul_centers_user_id
                            WHERE (cen.ul_center_id = :center) AND (com.ul_complaint_id = :ticket) $status
                            LIMIT 1;");
            $solution->execute(array(':center'=>$centerId, ':ticket'=>$ticket));
        }
        if ($tickets = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function getArray_expenses($start=0, $results=1000, $where='', $whereArray=array()){
        $q = "SELECT
                exp.ul_transaction_id id,
                exp.ul_code code,
                exp.ul_type type,
                exp.ul_amount amount,
                exp.ul_gst gst,
                exp.ul_description description,
                DATE_FORMAT(exp.ul_date, '%d/%m/%Y') date
            FROM client_expenses exp
            $where
            LIMIT $start, $results;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute($whereArray);
        if ($results = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $results;
        }else{
            return false;
        }
    }

    function getArray_missCalls($type="new", $start=0, $results=1000, $where='', $whereArray=array()){
        if ($type === "new") {
            $where = " WHERE ul_status < 0 ".$where;
            $q = "SELECT
                msc.ul_misscall_id id,
                msc.ul_number mobile,
                msc.ul_circle circle,
                msc.ul_status status,
                msc.ul_timestamp time
                FROM clients_customers_misscall msc
                $where
                ORDER BY ul_misscall_id DESC
                LIMIT $start, $results;";
        }else{
            $where = " WHERE ul_status >= 0 ".$where;
            $q = "SELECT
                msc.ul_misscall_id id,
                msc.ul_number mobile,
                msc.ul_circle circle,
                msc.ul_timestamp time,
                msc.ul_status status,
                DATE_FORMAT(msc.ul_call_time, '%d/%m/%y %h:%i %p') callTime,
                per.ul_name name
                FROM clients_customers_misscall msc
                LEFT JOIN users_personal per ON per.ul_user_id = msc.ul_user_id
                $where
                ORDER BY ul_misscall_id DESC
                LIMIT $start, $results;";
        }
        $solution = $this->dbConn->prepare($q);
        $solution->execute($whereArray);
        if ($resuts = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $resuts;
        }else{
            return false;
        }
    }

    function getData_missCallTag($number){
        $solution = $this->dbConn->prepare("SELECT
                            msc.ul_circle circle,
                            msc.ul_details details,
                            DATE_FORMAT(msc.ul_call_time, '%d/%m/%y %h:%i %p') time,
                            per.ul_name user
                            FROM clients_customers_misscall msc
                            LEFT JOIN users_personal per ON per.ul_user_id = msc.ul_user_id
                            WHERE msc.ul_number = :number;");
        $solution->execute(array(':number'=>$number));
        if ($results = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $results;
        }else{
            return false;
        }
    }

    function getArray_spares($start = 0, $results = 1000, $isStock = true){
        if($isStock == true){
            $q = "
                spr.ul_price price,
                spr.ul_gst gst,
                spr.ul_stock stock,
                spr.ul_old_stock old_stock,
                ";
        }else{
            $q = "
                spr.ul_hsn hsn,
                spr.ul_brand brand,
                spr.ul_warranty warranty,
                ";
        }
        $q = "SELECT
                spr.ul_spare_id id,
                spr.ul_code code,
                spr.ul_category category,
                spr.ul_name name,
                spr.ul_model model,
                spr.ul_spec spec,
                $q
                spr.ul_status status
                FROM client_spares spr
                ORDER BY spr.ul_spare_id DESC
                LIMIT $start, $results;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute();
        if ($resuts = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $resuts;
        }else{
            return false;
        }
    }

    function getDetail_spare($id){
        $q = "SELECT
                spr.ul_spare_id spare_id,
                spr.ul_code code,
                spr.ul_category category,
                spr.ul_price price,
                spr.ul_gst gst,
                spr.ul_hsn hsn,
                spr.ul_brand brand,
                spr.ul_warranty warranty,
                spr.ul_spec spec,
                spr.ul_description description,
                spr.ul_stock stock,
                spr.ul_name name,
                spr.ul_model model,
                spr.ul_status status
                FROM client_spares spr
                WHERE spr.ul_spare_id = :id
                LIMIT 1;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute(array(":id"=>$id));
        if ($resuts = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $resuts;
        }else{
            return false;
        }
    }

    function getDetail_product($id){
        $q = "SELECT
                prd.ul_product_id product_id,
                prd.ul_code code,
                prd.ul_brand brand,
                prd.ul_category category,
                prd.ul_stock stock,
                prd.ul_hsn hsn,
                prd.ul_spec1 spec1,
                prd.ul_spec2 spec2,
                prd.ul_name name,
                prd.ul_price price,
                prd.ul_gst gst,
                prd.ul_warranty warranty,
                prd.ul_description description,
                prd.ul_model model
                FROM client_products prd
                WHERE prd.ul_product_id = :id
                LIMIT 1;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute(array(":id"=>$id));
        if ($resuts = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $resuts;
        }else{
            return false;
        }
    }

    function getDetail_productsSpares($id){
        $q = "SELECT
                prdSpr.ul_spare_id spare_id,
                prdSpr.ul_quantity quantity
                FROM client_product_spares prdSpr
                WHERE prdSpr.ul_product_id = :id;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute(array(":id"=>$id));
        if ($resuts = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $resuts;
        }else{
            return false;
        }
    }

    function getArray_centers($start=0, $results=1000, $where='', $whereArray=array()){
        $solution = $this->dbConn->prepare("SELECT
            cen.ul_center_id id,
            cen.ul_code code,
            cen.ul_name name,
            DATE_FORMAT(cen.ul_doj, '%d/%m/%Y') doj,
            DATE_FORMAT(cen.ul_expiry, '%d/%m/%Y') expiry,
            cen.ul_phone1 phone1,
            cen.ul_phone2 phone2,
            cen.ul_email email,
            cen.ul_address address,
            cen.ul_city city,
            cen.ul_city_pin pin,
            cen.ul_status status
            FROM partners_centers cen
            $where
            LIMIT $start, $results;");
        $solution->execute($whereArray);
        if ($centers = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $centers;
        }else{
            return false;
        }
    }

    function getDetail_center($centerId){
        $solution = $this->dbConn->prepare("SELECT
            cen.ul_center_id id,
            cen.ul_code code,
            cen.ul_name name,
            DATE_FORMAT(cen.ul_doj, '%d/%m/%Y') doj,
            DATE_FORMAT(cen.ul_expiry, '%d/%m/%Y') expiry,
            cen.ul_phone1 phone1,
            cen.ul_phone2 phone2,
            cen.ul_email email,
            cen.ul_address address,
            cen.ul_city city,
            cen.ul_city_pin pin,
            cen.ul_status status
            FROM partners_centers cen
            WHERE cen.ul_center_id = :cen;");
        $solution->execute(array(":cen"=>$centerId));
        if ($result = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $result;
        }else{
            return false;
        }
    }

    function getArray_events($start){
        $solution = $this->dbConn->prepare("SELECT
            ul_event_id id,
            ul_user_id user,
            ul_table t_able,
            ul_error error,
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

    function getArray_logins($start=0, $results=200, $where='', $whereArray=array()){
        $solution = $this->dbConn->prepare("SELECT
            log.ul_user_id user,
            per.ul_name name,
            cen.ul_name center,
            per.ul_center_id centerId,
            DATE_FORMAT(FROM_UNIXTIME(log.ul_attempt_time), '%d/%m/%y %h:%i %p') login,
            log.ul_attempt_status status,
            DATE_FORMAT(log.ul_logout_time, '%d/%m/%y %h:%i %p') logout,
            INET_NTOA(log.ul_attempt_ip) ip
            FROM login_attempts log
            LEFT JOIN users_personal per ON per.ul_user_id = log.ul_user_id
            LEFT JOIN partners_centers cen ON cen.ul_center_id = per.ul_center_id
            LIMIT $start, $results;");
        $solution->execute();
        if ($attempts = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $attempts;
        }else{
            return false;
        }
    }

    function getArray_invalidLogins($start, $results = 100){
        $solution = $this->dbConn->prepare("SELECT
            ul_attempt_username user,
            FROM_UNIXTIME(ul_attempt_time) login,
            INET_NTOA(ul_attempt_ip) ip
            FROM login_invalid_users LIMIT $start, $results;");
        $solution->execute();
        if ($attempts = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $attempts;
        }else{
            return false;
        }
    }

    function getArray_customersSearch($keyword, $crn = ''){
        if ($crn) {
            $keyword = $crn;
            $where = "cus.ul_customer_id = :keyword OR cus.ul_code = :keyword";
        }else{
            $where = "cus.ul_mobile = :keyword OR cus.ul_alternate_mobile = :keyword";
        }
        $solution = $this->dbConn->prepare("SELECT
            cus.ul_customer_id id,
            cus.ul_code crn,
            cus.ul_name name,
            cus.ul_mobile mobile,
            cus.ul_alternate_mobile alternate_mobile,
            cus.ul_address address,
            cus.ul_city_pin pin,
            cus.ul_email email,
            cus.ul_landmark landmark,
            cus.ul_company company,
            prd.ul_name product,
            prd.ul_model model,
            prd.ul_brand brand,
            prd.ul_warranty warranty,
            cusPrd.ul_quantity quantity,
            cusPrd.ul_customer_product_id customer_product,
            cusPrd.ul_purchase_date purchase_date,
            pin.ul_state state,
            pin.ul_district district,
            pin.ul_city city,
            com.ul_code complaint
            FROM clients_customers cus
            LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_id = cus.ul_customer_id
            LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
            LEFT JOIN pincodes_data pin ON pin.ul_pincode = cus.ul_city_pin
            LEFT JOIN complaints_data com ON com.ul_customer_product_id = cusPrd.ul_customer_product_id
            WHERE $where ;");
        $solution->execute(array(':keyword'=>$keyword));
        if ($events = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $events;
        }else{
            return false;
        }
    }

    function getDetail_jobTicket($ticket){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                            per.ul_name technician,
                            prd.ul_brand brand,
                            prd.ul_category category,
                            prd.ul_name product,
                            prd.ul_model model,
                            prd.ul_spec1 spec1,
                            prd.ul_spec2 spec2,
                            com.ul_quantity quantity,
                            prdSpr.ul_spare_id spare,
                            spr.ul_category spareCategory,
                            spr.ul_name spareName,
                            spr.ul_model spareModel
                            FROM complaints_data com
                            LEFT JOIN users_personal per ON per.ul_user_id = com.ul_centers_user_id
                            LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_product_id = com.ul_customer_product_id
                            LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                            LEFT JOIN client_product_spares prdSpr ON prdSpr.ul_product_id = prd.ul_product_id
                            LEFT JOIN client_spares spr ON spr.ul_spare_id = prdSpr.ul_spare_id
                            WHERE (com.ul_status < 1) AND (com.ul_complaint_id = :ticket);");
            $solution->execute(array(':ticket'=>$ticket));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                            per.ul_name technician,
                            prd.ul_brand brand,
                            prd.ul_category category,
                            prd.ul_name product,
                            prd.ul_model model,
                            prd.ul_spec1 spec1,
                            prd.ul_spec2 spec2,
                            com.ul_quantity quantity,
                            prdSpr.ul_spare_id spare,
                            spr.ul_category spareCategory,
                            spr.ul_name spareName,
                            spr.ul_model spareModel
                            FROM complaints_data com
                            LEFT JOIN users_personal per ON per.ul_user_id = com.ul_centers_user_id
                            LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_product_id = com.ul_customer_product_id
                            LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                            LEFT JOIN client_product_spares prdSpr ON prdSpr.ul_product_id = prd.ul_product_id
                            LEFT JOIN client_spares spr ON spr.ul_spare_id = prdSpr.ul_spare_id
                            WHERE (com.ul_center_id = :center) AND (com.ul_status < 1) AND (com.ul_complaint_id = :ticket);");
            $solution->execute(array(':center'=>$centerId, ':ticket'=>$ticket));
        }
        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function getDetail_ticketJobs($ticket){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                            job.ul_job_id jobId,
                DATE_FORMAT(job.ul_timestamp, '%d/%m/%y %h:%i %p') job_time,
                            job.ul_status_brief_internal Work_Done,
                            job.ul_status_brief_customer Status,
                            job.ul_attender_name attender,
                            job.ul_type type,
                            job.ul_status stts,
                            job.ul_km_run km,
              IFNULL(CONCAT(spr.ul_category, ', ', spr.ul_name, ', ', spr.ul_model), 'No Spare Replaced') replaced_spare
                            FROM complaints_jobs job
                            LEFT JOIN complaints_jobs_spares jobSpr ON jobSpr.ul_job_id = job.ul_job_id
                            LEFT JOIN client_spares spr ON spr.ul_spare_id = jobSpr.ul_spare_id
                            WHERE (job.ul_complaint_id = :ticket);");
            $solution->execute(array(':ticket'=>$ticket));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                            job.ul_job_id jobId,
                DATE_FORMAT(job.ul_timestamp, '%d/%m/%y %h:%i %p') job_time,
                            job.ul_status_brief_internal Work_Done,
                            job.ul_status_brief_customer Status,
                            job.ul_attender_name attender,
                            job.ul_type type,
                            job.ul_status stts,
                            job.ul_km_run km,
              IFNULL(CONCAT(spr.ul_category, ', ', spr.ul_name, ', ', spr.ul_model), 'No Spare Replaced') replaced_spare
                            FROM complaints_jobs job
                            LEFT JOIN complaints_jobs_spares jobSpr ON jobSpr.ul_job_id = job.ul_job_id
                            LEFT JOIN client_spares spr ON spr.ul_spare_id = jobSpr.ul_spare_id
                            WHERE (com.ul_center_id = :center) AND (com.ul_status = -1) AND (com.ul_complaint_id = :ticket);");
            $solution->execute(array(':center'=>$centerId, ':ticket'=>$ticket));
        }
        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function getData_ticketTechnician($id){
        $centerId = $this->centerId;
        $solution = $this->dbConn->prepare("SELECT
                            per.ul_name technician,
                            per.ul_user_id id,
                            per.ul_mobile mobile
                            FROM complaints_data com
                            LEFT JOIN users_personal per ON per.ul_user_id = com.ul_centers_user_id
                            WHERE com.ul_complaint_id = :complaint
                        UNION
                            SELECT
                            per.ul_name technician,
                            per.ul_user_id id,
                            per.ul_mobile mobile
                            FROM users_personal per
                            WHERE per.ul_center_id = :center;");
        $solution->execute(array(':complaint'=>$id, ':center'=>$centerId));
        if ($users = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $users;
        }else{
            return false;
        }
    }

    function getArray_ticketFeedbacks($start=0, $results=1000, $where='', $whereArray=array()){
        $centerId = $this->centerId;
        $q = "SELECT
                    com.ul_complaint_id id,
                    com.ul_code code,
        DATE_FORMAT(com.ul_est_resolution_date, '%d/%m/%Y') close_time,
        DATE_FORMAT(com.ul_timestamp, '%d/%m/%y %h:%i %p') open_time,
                    com.ul_quantity quantity,
                    com.ul_status status,
                    cen.ul_code center,
                    cen.ul_name centerName,
                    cen.ul_city city,
                    prd.ul_brand brand,
                    prd.ul_name product,
                    prd.ul_model model,
                    cus.ul_name customer,
                    cus.ul_mobile mobile,
                    per.ul_name user,
                    fdb.ul_feedback_id feedback_id,
                    fdb.ul_user_id feedback
                    FROM complaints_data com
                    LEFT JOIN clients_customers cus ON cus.ul_customer_id = com.ul_customer_id
                    LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_product_id = com.ul_customer_product_id
                    LEFT JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
                    LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                    LEFT JOIN complaints_feedback fdb ON fdb.ul_complaint_id = com.ul_complaint_id
                    LEFT JOIN users_personal per ON per.ul_user_id = com.ul_user_id
                    $where
                    ORDER BY com.ul_complaint_id DESC
                    LIMIT $start, $results;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute($whereArray);
        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function getData_ticketFeedback($id){
        $solution = $this->dbConn->prepare("SELECT
                            fdb.ul_complaint_id id,
                            per.ul_name user,
                            fdb.ul_review review,
                            fdb.ul_rating rating,
                DATE_FORMAT(fdb.ul_timestamp, '%d/%m/%y %h:%i %p') time
                            FROM complaints_feedback fdb
                            LEFT JOIN users_personal per ON per.ul_user_id = fdb.ul_user_id
                            WHERE fdb.ul_complaint_id = :complaint;");
        $solution->execute(array(':complaint'=>$id));
        if ($results = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $results;
        }else{
            return false;
        }
    }

    function getData_ticketOTP($id){
        $solution = $this->dbConn->prepare("SELECT
                            com.ul_otp otp
                            FROM complaints_data com
                            WHERE com.ul_complaint_id = :complaint;");
        $solution->execute(array(':complaint'=>$id));
        if ($results = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $results;
        }else{
            return false;
        }
    }

    function getData_ticketCenter($id){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $where = "com.ul_complaint_id = :complaint";
            $whereArray = array(':complaint'=>$id);
        }else{
            $where = "com.ul_complaint_id = :complaint AND com.ul_center_id = :center";
            $whereArray = array(':complaint'=>$id, ':center'=>$centerId);
        }
        $solution = $this->dbConn->prepare("SELECT
                            cen.ul_phone1 centerContact,
                            com.ul_complaint_id id,
                            com.ul_code code,
                            com.ul_quantity quantity,
                            com.ul_details details,
                            prd.ul_category category,
                            prd.ul_model model,
                            prd.ul_brand brand,
                            prd.ul_name product,
                            cus.ul_name name,
                            cus.ul_mobile mobile,
                            cus.ul_alternate_mobile alternate_mobile,
                            cus.ul_address address,
                            pin.ul_district district,
                            pin.ul_city city
                            FROM complaints_data com
                            LEFT JOIN partners_centers cen ON cen.ul_center_id = com.ul_center_id
                            LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_product_id = com.ul_customer_product_id
                            LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                            LEFT JOIN clients_customers cus ON cus.ul_customer_id = com.ul_customer_id
                            LEFT JOIN pincodes_data pin ON pin.ul_pincode = cus.ul_city_pin
                            WHERE $where LIMIT 1;");
        $solution->execute($whereArray);
        if ($users = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $users;
        }else{
            return false;
        }
    }

    function getData_ticketCustomerOTP($id){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $where = "com.ul_complaint_id = :complaint";
            $whereArray = array(':complaint'=>$id);
        }else{
            $where = "com.ul_complaint_id = :complaint AND com.ul_center_id = :center";
            $whereArray = array(':complaint'=>$id, ':center'=>$centerId);
        }
        $solution = $this->dbConn->prepare("SELECT
                            per.ul_name technician,
                            per.ul_mobile contact,
                            prd.ul_brand brand,
                            cus.ul_code crn,
                            cus.ul_mobile mobile,
                            com.ul_code code,
                            com.ul_otp otp
                            FROM complaints_data com
                            LEFT JOIN clients_customers cus ON cus.ul_customer_id = com.ul_customer_id
                            LEFT JOIN users_personal per ON per.ul_user_id = com.ul_centers_user_id
                            LEFT JOIN clients_customers_products cusPrd ON cusPrd.ul_customer_product_id = com.ul_customer_product_id
                            LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                            WHERE $where LIMIT 1;");
        $solution->execute($whereArray);
        if ($result = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $result;
        }else{
            return false;
        }
    }

    function getData_ticketCustomerCRN($id){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $where = "cusPrd.ul_customer_product_id = :customer_product";
            $whereArray = array(':customer_product'=>$id);
        }else{
            $where = "cusPrd.ul_customer_product_id = :customer_product AND com.ul_center_id = :center";
            $whereArray = array(':customer_product'=>$id, ':center'=>$centerId);
        }
        $solution = $this->dbConn->prepare("SELECT
                            prd.ul_category category,
                            prd.ul_brand brand,
                            prd.ul_name product,
                            cus.ul_code crn,
                            cus.ul_mobile mobile
                            FROM clients_customers_products cusPrd
                            LEFT JOIN clients_customers cus ON cus.ul_customer_id = cusPrd.ul_customer_id
                            LEFT JOIN client_products prd ON prd.ul_product_id = cusPrd.ul_product_id
                            WHERE $where LIMIT 1;");
        $solution->execute($whereArray);
        if ($result = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $result;
        }else{
            return false;
        }
    }

    function getArray_openTickets(){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
            com.ul_complaint_id id,
            com.ul_code code,
            cen.ul_code center,
            cus.ul_name name,
            DATE_FORMAT(com.ul_timestamp, '%d/%m/%y') date,
            cus.ul_mobile mobile
            FROM complaints_data com
            LEFT JOIN clients_customers cus on cus.ul_customer_id = com.ul_customer_id
            LEFT JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
            WHERE com.ul_status < 1");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
            com.ul_complaint_id id,
            com.ul_code code,
            cen.ul_code center,
            DATE_FORMAT(com.ul_timestamp, '%d/%m/%y') date,
            cus.ul_name name,
            cus.ul_mobile mobile
            FROM complaints_data com
            LEFT JOIN clients_customers cus on cus.ul_customer_id = com.ul_customer_id
            LEFT JOIN partners_centers cen ON cen.ul_center_id  = com.ul_center_id
            WHERE com.ul_status < 1
            AND com.ul_center_id = :center");
            $solution->execute(array(':center'=>$centerId));
        }
        $tickets = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $tickets;
    }

    function getArray_users(){
        $level = $this->userLevel;
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                per.ul_user_id id,
                per.ul_code code,
                cen.ul_code center,
                cen.ul_center_id center_id,
                cen.ul_name centerName,
                per.ul_name name,
                per.ul_designation designation,
                per.ul_mobile mobile,
                per.ul_email email,
                log.ul_status status
                FROM users_personal per
                LEFT JOIN users_login log ON log.ul_user_id = per.ul_user_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = per.ul_center_id
                WHERE log.ul_level < :level ;");
            $solution->execute(array(':level'=>$level));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                per.ul_user_id id,
                per.ul_code code,
                cen.ul_code center,
                cen.ul_center_id center_id,
                cen.ul_name centerName,
                per.ul_name name,
                per.ul_designation designation,
                per.ul_email email,
                per.ul_mobile mobile,
                log.ul_status status
                FROM users_personal per
                LEFT JOIN users_login log ON log.ul_user_id = per.ul_user_id
                LEFT JOIN partners_centers cen ON cen.ul_center_id  = per.ul_center_id
                WHERE (per.ul_center_id = :centerId)
                AND log.ul_level < :level ;");
            $solution->execute(array(':centerId'=>$centerId, ':level'=>$level));
        }
        $users = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    function getDetail_user($id){
        $centerId = $this->centerId;
        $userLevel = $this->userLevel;
        if ($centerId == 1) {
            $q = "SELECT
            per.ul_code code,
            per.ul_name name,
            per.ul_father father,
            per.ul_address address,
            per.ul_city_pin city_pin,
            pin.ul_city city,
            pin.ul_district district,
            pin.ul_state state,
            per.ul_mobile mobile,
            per.ul_email email,
            per.ul_designation designation,
            per.ul_dob dob,
            per.ul_doj doj,
            per.ul_aadhar aadhar,
            per.ul_pan pan,
            per.ul_jobs jobs,
            per.ul_run_km_balance run_km_balance,
            cen.ul_phone1 phone1,
            cen.ul_phone2 phone2,
            cen.ul_email cenEmail,
            cen.ul_gstin gstin,
            cen.ul_address cenAddress,
            DATE_FORMAT(per.ul_timestamp, '%d/%m/%y %h:%i %p') time
            FROM users_personal per
            LEFT JOIN users_login log ON log.ul_user_id = per.ul_user_id
            LEFT JOIN partners_centers cen ON cen.ul_center_id = per.ul_center_id
            LEFT JOIN pincodes_data pin ON pin.ul_pincode = per.ul_city_pin
            WHERE per.ul_user_id = :id AND log.ul_level <= :level LIMIT 1;";
            $whereArray = array(':id'=>$id, ':level'=>$userLevel);
        }else{
            $q = "SELECT
            per.ul_code code,
            per.ul_name name,
            per.ul_father father,
            per.ul_address address,
            per.ul_city_pin city_pin,
            pin.ul_city city,
            pin.ul_district district,
            pin.ul_state state,
            per.ul_mobile mobile,
            per.ul_email email,
            per.ul_designation designation,
            per.ul_dob dob,
            per.ul_doj doj,
            per.ul_aadhar aadhar,
            per.ul_pan pan,
            per.ul_jobs jobs,
            per.ul_run_km_balance run_km_balance,
            cen.ul_phone1 phone1,
            cen.ul_phone2 phone2,
            cen.ul_email cenEmail,
            cen.ul_gstin gstin,
            cen.ul_address cenAddress,
            DATE_FORMAT(per.ul_timestamp, '%d/%m/%y %h:%i %p') time
            FROM users_personal per
            LEFT JOIN users_login log ON log.ul_user_id = per.ul_user_id
            LEFT JOIN partners_centers cen ON cen.ul_center_id = per.ul_center_id
            LEFT JOIN pincodes_data pin ON pin.ul_pincode = per.ul_city_pin
            WHERE per.ul_user_id = :id AND per.ul_center_id = :center AND log.ul_level <= :level LIMIT 1;";
            $whereArray = array(':id'=>$id, ':center'=>$center, ':level'=>$userLevel);
        }
        $solution = $this->dbConn->prepare($q);
        $solution->execute($whereArray);
        if ($details = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return false;
        }
    }

    function getArray_inwardChallan($start=0, $results=1000, $where='', $whereArray=array()){
        $q = "SELECT
            chl.ul_challan_id id,
            chl.ul_code code,
            chl.ul_code_type code_type,
            cen.ul_name center,
            chl.ul_center_id centerId,
            spr.ul_brand brand,
            spr.ul_category category,
            spr.ul_name name,
            spr.ul_model model,
            spr.ul_spec1 spec1,
            spr.ul_spec2 spec2,
            spr.ul_quantity_in_otherUnity unit,
            chl.ul_stock stock,
            DATE_FORMAT(chl.ul_date, '%d/%m/%Y') date
            FROM spares_inventory_transactions chl
            LEFT JOIN partners_centers cen ON cen.ul_center_id = chl.ul_center_id
            LEFT JOIN client_products spr ON spr.ul_spare_id = chl.ul_spare_id
            $where
            LIMIT $start, $results;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute($whereArray);
        if ($resuts = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $resuts;
        }else{
            return false;
        }
    }

    function getArray_outwardChallan($start=0, $results=1000, $where='', $whereArray=array()){
        $q = "SELECT
            chl.ul_challan_id id,
            chl.ul_code code,
            chl.ul_code_type code_type,
            cen.ul_name center,
            chl.ul_center_id centerId,
            chl.ul_order_id orderId,
            spr.ul_brand brand,
            spr.ul_category category,
            spr.ul_name name,
            spr.ul_model model,
            spr.ul_spec1 spec1,
            spr.ul_spec2 spec2,
            spr.ul_quantity_in_otherUnity unit,
            chl.ul_stock stock,
            DATE_FORMAT(chl.ul_date, '%d/%m/%Y') date
            FROM spares_inventory_transactions chl
            LEFT JOIN partners_centers cen ON cen.ul_center_id = chl.ul_center_id
            LEFT JOIN client_products spr ON spr.ul_spare_id = chl.ul_spare_id
            $where
            LIMIT $start, $results;";
        $solution = $this->dbConn->prepare($q);
        $solution->execute($whereArray);
        if ($resuts = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $resuts;
        }else{
            return false;
        }
    }

################################################################################################################################

    function nice_time($date, $full = false){ ////   FROMAT -> YYYY-MM-DD
        $periods  = array(
                  "Year" => 31556926,
                  "Month" => 2629743,
                  "Week" => 604800,
                  "Day" => 86400,
                  "Hour" => 3600,
                  "Minute" => 60,
                  "Second" => 1);
        $now = time();
        $unix_date = strtotime($date);
        if(empty($unix_date)) {
            return "Date not Available";
        }
        if($now > $unix_date) {
            $difference = $now - $unix_date;
            $tense = " ago";
        } else {
            $difference = $unix_date - $now;
            $tense = " from now";
        }
        $difference = (float) $difference;
        $segments = array();
        foreach ($periods as $period => $value) {
            $suffix = '';
            $count = floor($difference/$value);
            if ($count == 0) {
                continue;
            }elseif ($count > 1) {
                $suffix = 's';
            }
            $segments[] = $count.' '.$period.$suffix;
            $difference = $difference % $value;
            if (!$full) {
                return $segments[0].$tense;
            }
        }
        return implode(', ', $segments).$tense;
    }
};
$function = new Functions();