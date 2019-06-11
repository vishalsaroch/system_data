<?php

CLASS FunctionsL extends Connection {

    function noProduct ($prodType){
        return array(
            array(
                'brand' => 'will be available soon',
                'title' => 'No Item',
                'permalink' => 'no-items-'.$prodType,
                'sku' => '',
                'catId' => '',
                'catPermalink' => '',
                'price' => '',
                'discount' => ''
                )
            );
    }

    function getArray_sessionData($centerId = ''){
        $solution = $this->dbConn->prepare("SELECT
            *
            FROM session_data;");
        $solution->execute();
        if ($orders = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $orders;
        }
        return null;
    }

################################################## MENU

    function getArray_products($filterVar, $filterVal, $start, $limit){
        $solution = $this->dbConn->prepare("SELECT
            b.ul_title brand,
            p.ul_title title,
            p.ul_img_url imgUrl,
            p.ul_permalink permalink,
            p.ul_sku sku,
            c.ul_permalink catPermalink,
            m.ul_price_sale_client price,
            m.ul_price_discount_client discount
            FROM products_data p
            LEFT JOIN centers_products_data m ON m.ul_sku = p.ul_sku
            LEFT JOIN client_categories c ON c.ul_category_id = p.ul_category_id
            LEFT JOIN category_popular_brands b ON b.ul_brand_id = p.ul_brand_id
            WHERE $filterVar = :id
            LIMIT $start, $limit");
        $solution->execute(array(':id'=>$filterVal));
        if ($products = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $products;
        }else{
            return $this->noProduct('s');
        }
    }

    function getArray_pendingOrders($status = ''){
        if ($status) {
            $status = ' AND ord.status = :status ';
        }else{
            $status = ' :status ';
        }
        $center = $this->center;
        $solution = $this->dbConn->prepare("SELECT
                ord.ul_order_id id,
                ord.ul_sku sku,
                centPro.ul_center_sku centerSku,
                ord.ul_user_id customer,
                usr.ul_name customerName,
                pro.ul_title productTitle,
                ord.ul_quantity quantity,
                ord.ul_order_timestamp timestamp
                FROM orders_data ord
                LEFT JOIN users_personal usr ON usr.ul_user_id = ord.ul_user_id
                LEFT JOIN products_data pro ON pro.ul_sku = ord.ul_sku
                left join centers_products_data centPro ON centPro.ul_sku = ord.ul_sku
                WHERE ord.ul_center_id = :center $status
                ORDER BY ord.ul_order_id DESC");
        $solution->execute(array(':center'=>$center, ":status"=>$status));
        if ($products = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $products;
        }else{
            return false;
        }
    }

    function getArray_recommondedProducts($start = 0, $limit = 8){
        $solution = $this->dbConn->prepare("SELECT
            b.ul_title brand,
            p.ul_title title,
            p.ul_permalink permalink,
            p.ul_sku sku,
            m.ul_category_id catId,
            c.ul_permalink catPermalink,
            p.ul_price_sale_client price,
            p.ul_price_discount_client discount
            FROM centers_products_data p
            LEFT JOIN products_masters m ON m.ul_product_master_id = p.ul_product_master_id
            LEFT JOIN client_categories c ON c.ul_category_id = m.ul_category_id
            LEFT JOIN category_popular_brands b ON b.ul_brand_id = m.ul_brand_id
            ORDER BY p.ul_status DESC, p.ul_status DESC LIMIT $start, $limit;");
        $solution->execute();
        if ($brands = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $brands;
        }else{
            return $this->noProduct('s');
        }
    }

    function getArray_newProducts($start = 0, $limit = 8){
        $solution = $this->dbConn->prepare("SELECT
            b.ul_title brand,
            p.ul_title title,
            p.ul_permalink permalink,
            p.ul_sku sku,
            m.ul_category_id catId,
            c.ul_permalink catPermalink,
            p.ul_price_sale_client price,
            p.ul_price_discount_client discount
            FROM centers_products_data p
            LEFT JOIN products_masters m ON m.ul_product_master_id = p.ul_product_master_id
            LEFT JOIN client_categories c ON c.ul_category_id = m.ul_category_id
            LEFT JOIN category_popular_brands b ON b.ul_brand_id = m.ul_brand_id
            ORDER BY p.ul_product_timestamp DESC, p.ul_status DESC LIMIT $start, $limit;");
        $solution->execute();
        if ($brands = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $brands;
        }else{
            return $this->noProduct('s');
        }
    }

    function getArray_bestOfferProducts($start = 0, $limit = 8){
        $solution = $this->dbConn->prepare("SELECT
            b.ul_title brand,
            p.ul_title title,
            p.ul_permalink permalink,
            p.ul_sku sku,
            m.ul_category_id catId,
            c.ul_permalink catPermalink,
            p.ul_price_sale_client price,
            p.ul_price_discount_client discount
            FROM centers_products_data p
            LEFT JOIN products_masters m ON m.ul_product_master_id = p.ul_product_master_id
            LEFT JOIN client_categories c ON c.ul_category_id = m.ul_category_id
            LEFT JOIN category_popular_brands b ON b.ul_brand_id = m.ul_brand_id
            ORDER BY p.ul_price_discount_client DESC, p.ul_status DESC LIMIT $start, $limit;");
        $solution->execute();
        if ($brands = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $brands;
        }else{
            return $this->noProduct('s');
        }
    }

    function getArray_trendingProducts($skuImplodedArray){
        $solution = $this->dbConn->prepare("SELECT
            b.ul_title brand,
            p.ul_title title,
            p.ul_permalink permalink,
            p.ul_sku sku,
            m.ul_category_id catId,
            c.ul_permalink catPermalink,
            p.ul_price_sale_client price,
            p.ul_price_discount_client discount
            FROM centers_products_data p
            LEFT JOIN products_masters m ON m.ul_product_master_id = p.ul_product_master_id
            LEFT JOIN client_categories c ON c.ul_category_id = m.ul_category_id
            LEFT JOIN category_popular_brands b ON b.ul_brand_id = m.ul_brand_id
            WHERE p.ul_sku IN ($skuImplodedArray) ORDER BY p.ul_status DESC;");
        $solution->execute();
        if ($brands = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $brands;
        }else{
            return $this->noProduct('s');
        }
    }

    function getArray_productBySku($sku){
        $solution = $this->dbConn->prepare("SELECT
            b.ul_title brand,
            p.ul_title title,
            p.ul_permalink permalink,
            p.ul_sku sku,
            m.ul_category_id catId,
            c.ul_permalink catPermalink,
            p.ul_price_sale_client price,
            p.ul_price_discount_client discount
            FROM centers_products_data p
            LEFT JOIN products_masters m ON m.ul_product_master_id = p.ul_product_master_id
            LEFT JOIN client_categories c ON c.ul_category_id = m.ul_category_id
            LEFT JOIN category_popular_brands b ON b.ul_brand_id = m.ul_brand_id
            WHERE P.ul_sku = :sku LIMIT 1;");
        $solution->execute(array(':sku'=>$sku));
        if ($product = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $product;
        }else{
            return false;
        }
    }

    function getArray_productVariants($sku, $start = 0, $limit = 12){
        $solution = $this->dbConn->prepare("SELECT
            b.ul_title brand,
            p.ul_title title,
            p.ul_permalink permalink,
            p.ul_sku sku,
            m.ul_category_id catId,
            c.ul_permalink catPermalink,
            p.ul_price_sale_client price,
            p.ul_price_discount_client discount
            FROM centers_products_data p
            LEFT JOIN products_masters m ON m.ul_product_master_id = p.ul_product_master_id
            LEFT JOIN client_categories c ON c.ul_category_id = m.ul_category_id
            LEFT JOIN category_popular_brands b ON b.ul_brand_id = m.ul_brand_id
            WHERE m.ul_product_master_id = (SELECT ul_product_master_id FROM centers_products_data WHERE ul_sku = :sku) LIMIT $start, $limit;");
        $solution->execute(array(':sku'=>$sku));
        if ($product = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            if (count($product) > 1) {
                return $product;
            }
        }
        return $this->noProduct('s');
    }

    function getArray_relatedProducts($sku, $start = 0, $limit = 12){
        $solution = $this->dbConn->prepare("SELECT
            b.ul_title brand,
            p.ul_title title,
            p.ul_permalink permalink,
            p.ul_sku sku,
            m.ul_category_id catId,
            c.ul_permalink catPermalink,
            p.ul_price_sale_client price,
            p.ul_price_discount_client discount
            FROM centers_products_data p
            LEFT JOIN products_masters m ON m.ul_product_master_id = p.ul_product_master_id
            LEFT JOIN client_categories c ON c.ul_category_id = m.ul_category_id
            LEFT JOIN category_popular_brands b ON b.ul_brand_id = m.ul_brand_id
            WHERE m.ul_category_id = (SELECT sm.ul_category_id FROM centers_products_data sp LEFT JOIN products_masters sm ON sm.ul_product_master_id = sp.ul_product_master_id WHERE sp.ul_sku = :sku) LIMIT $start, $limit;");
        $solution->execute(array(':sku'=>$sku));
        if ($product = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            if (count($product) > 1) {
                return $product;
            }
        }
        return $this->noProduct('s');
    }

    function getArray_productDetailBySku($sku){
        $solution = $this->dbConn->prepare("SELECT
            p.ul_product_master_id prodMasterId,
            p.ul_product_id prodId,
            p.ul_permalink permalink,
            b.ul_title brand,
            b.ul_permalink brandPermalink,
            p.ul_title title,
            m.ul_subtitle subTitle,
            m.ul_category_id catId,
            c.ul_permalink catPermalink,
            p.ul_price_sale_client price,
            p.ul_price_discount_client discount,
            p.ul_center_id centerId,
            center.ul_name centerName,
            p.ul_highlight highlight,
            p.ul_method paymentMethod,
            p.ul_payment_title paymentTitle,
            p.ul_qty_available_stock stock,
            p.ul_warranty_time warrantyTime,
            p2.ul_warranty_text warrantyText,
            p.ul_qty_exclude_under_shipping itemLeft,
            p.ul_price_quantity_unit priceQuanity,
            p.ul_under_sale_badge badge,
            p.ul_product_variants variants,
            p.ul_suitability suitability,
            p.ul_status status,
            p2.ul_desription description,
            p2.ul_details_json_array detailsArray,
            p2.ul_images_json_array imgsArray,
            p2.ul_dimensions dimensions,
            p2.ul_replacements replacement,
            p2.ul_delivery_days deliveryTime
            FROM centers_products_data p
            LEFT JOIN centers_products_data2 p2 ON p2.ul_sku = p.ul_sku
            LEFT JOIN partners_centers center ON center.ul_center_id = p.ul_center_id
            LEFT JOIN products_masters m ON m.ul_product_master_id = p.ul_product_master_id
            LEFT JOIN client_categories c ON c.ul_category_id = m.ul_category_id
            LEFT JOIN category_popular_brands b ON b.ul_brand_id = m.ul_brand_id
            WHERE p.ul_sku = :sku LIMIT 1;");
        $solution->execute(array(':sku'=>$sku));
        if ($product = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $product;
        }else{
            return false;
        }
    }

################################################################################################################################

    function getData_designationByLevel($level){
        $solution = $this->dbConn->prepare("SELECT
            ul_name
            FROM client_level_designations
            WHERE ul_level = :level LIMIT 1;");
        $solution->execute(array(':level'=>$level));
        if ($designation = $solution->fetchColumn()) {
            return $designation;
        }else{
            return false;
        }
    }

    function getData_permalinkBySku($sku){
        $solution = $this->dbConn->prepare("SELECT
            ul_name
            FROM client_level_designations
            WHERE ul_level = :level LIMIT 1;");
        $solution->execute(array(':level'=>$level));
        if ($designation = $solution->fetchColumn()) {
            return $designation;
        }else{
            return false;
        }
    }

################################################################################################################################

    function insertData_productExcel($excelFile){
        $file_open = fopen($excelFile,"r");
        $rowNo = 0;
        while(($csv = fgetcsv($file_open, 1000, ",")) !== false) {
            //print_r($csv);
            $rowNo++;
            if ($rowNo < 3) {
                continue;
            }
            $product = array();
            $product_center = array();
            $product['center_id'] =  $this->centerId;
            $product['permalink'] = (string) strtolower(preg_replace('|[^a-zA-Z0-9]|i', '-', trim($csv[0])));
            if((int) trim($csv[1])) $product['sku'] = (int) trim($csv[1]);
            if((int) trim($csv[2])) $product['product_id'] = (int) trim($csv[2]);
            $category = (string) preg_replace('|[^a-zA-Z0-9 - _.,]|i', '', trim($csv[3]));
            $product['category_id'] = $this->selectData('client_categories', 'ul_category_id', 'ul_title', $category);
            $brand = (string) preg_replace('|[^a-zA-Z0-9 - _.,]|i', '', trim($csv[4]));
            $product['brand_id'] = $this->selectData('category_popular_brands', 'ul_brand_id', 'ul_title', $brand);
            $product['title'] = (string) ucwords(strtolower(preg_replace('|[^a-zA-Z0-9 - _.,]|i', '', trim($csv[5]))));
            $product['subtitle'] = (string) ucfirst(strtolower(preg_replace('|[^a-zA-Z0-9 - _.,]|i', '', trim($csv[6]))));
            $product['under_sale_badge'] = (trim($csv[7]) === 'Yes') ? 1 : 0;
            $product['product_variants'] = (string) preg_replace('|[^a-zA-Z0-9 , ]|i', '', trim($csv[8]));
            $product['product_variants_data'] = (string) preg_replace('|[^a-zA-Z0-9 - _.,]|i', '', trim($csv[9]));
            $product['handling'] = (string) preg_replace('|[^a-zA-Z0-9 , ]|i', '', trim($csv[10]));
            $product['suitability'] = (string) preg_replace('|[^a-zA-Z0-9 , ]|i', '', trim($csv[11]));
            $product_center['center_id'] =  $product['center_id'];
            $product_center['warranty_time'] = (int) trim($csv[12]);
            $product_center['warranty_text'] = (string) ucfirst(strtolower(preg_replace('|[^a-zA-Z0-9 - _.,]|i', '', trim($csv[13]))));
            $product_center['payment_title'] = (string) ucfirst(strtolower(preg_replace('|[^a-zA-Z0-9 - _.,]|i', '', trim($csv[14]))));
            $product_center['price_sale_center'] = (float) trim($csv[15]);
            $product_center['price_discount_center'] = (float) trim($csv[16]);
            $product_center['price_sale_client'] = (float) trim($csv[17]);
            $product_center['price_discount_center'] = (float) trim($csv[18]);
            $product_center['price_quantity_unit'] = (string) preg_replace('|[^a-zA-Z0-9 , ]|i', '', trim($csv[19]));
            $product_center['qty_available_stock'] = (int) trim($csv[20]);
            $product_center['qty_exclude_under_shipping'] = $product_center['qty_available_stock'];
            $product_center['dimensions'] = (string) preg_replace('|[^a-zA-Z0-9 , ]|i', '', trim($csv[21]));
            $product_center['delivery_days'] = (int) trim($csv[22]);
            $product_center['delivery_charges'] = (float) trim($csv[23]);
            $product_center['replacements'] = (string) ucfirst(strtolower(preg_replace('|[^a-zA-Z0-9 - _.,]|i', '', trim($csv[24]))));
            $product_center['method'] = (string) preg_replace('|[^a-zA-Z0-9 , ]|i', '', trim($csv[25]));
            $product_center['status'] = (int) trim($csv[26]);
            echo '<pre>';
            print_r($product);
            print_r($product_center);
            exit;
            // $this->dbConn->beginTransaction();
            // $id = $this->insertData('products_data', $product);
            // $product_center['sku'] = $id;
            // $id = $this->insertData('centers_products_data', $product_center);

        }
        echo "CSV Imported Successfully";
    }

    function insertData_newBrand($array){
        $this->dbConn->beginTransaction();
        if ($id = $this->insertData('category_popular_brands', $array)) {
            $this->dbConn->commit();
            $this->setMessage(array('success', 'Brand Successfully added'));
            return $id;
        }
        $this->dbConn->rollBack();
        $this->setMessage(array('danger', 'Brand could not be added, try later'));
        return false;
    }

    function insertData_newMaster($array){
        $array['center_id'] = $this->center;
        $this->dbConn->beginTransaction();
        if ($sku = $this->insertData('products_data', $array)) {
            $this->dbConn->commit();
            $this->setMessage(array('success', 'Product Master Successfully added'));
            return $sku;
        }
        $this->dbConn->rollBack();
        $this->setMessage(array('danger', 'Product Master could not be added, try later'));
        return false;
    }

    function insertData_newProduct($array){
        $array['qty_exclude_under_shipping'] = $array['qty_available_stock'];
        $array['center_id'] = $this->center;
        $this->dbConn->beginTransaction();
        if ($sku = $this->insertData('centers_products_data', $array)) {
            $this->dbConn->commit();
            $this->setMessage(array('success', 'Product Successfully added'));
            return $sku;
        }
        $this->dbConn->rollBack();
        $this->setMessage(array('danger', 'Product could not be added, try later'));
        return false;
    }

    function insertData_newCategory($array){
        $this->dbConn->beginTransaction();
        if ($id = $this->insertData('client_categories', $array)) {
            $this->dbConn->commit();
            $this->setMessage(array('success', 'Category Successfully added'));
            return $id;
        }
        $this->dbConn->rollBack();
        $this->setMessage(array('danger', 'Category could not be added, try later'));
        return false;
    }

##################################################    PARTNERS
    private function encode_data($data , $decode = false){
        if ($decode) {
            $data = preg_replace('|cdrjm|i', '=', $data);
            $data = base64_decode(str_rot13(base64_decode($data)));
        }else{
            $data = base64_encode(str_rot13(base64_encode($data)));
            $data = preg_replace('|=|', 'cdrjm', $data);
        }
        return $data;
    }

    private function hash_data($data){
        return sha1(base64_encode($data));
    }

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

    function registerPartner($partnerData){
        $solution = $this->dbConn->prepare("INSERT INTO partners (partner_name, partner_phone, partner_email, partner_doj, partner_address) VALUES (:partner_name, :partner_phone, :partner_email, :partner_doj, :partner_address)");
        if ($solution->execute(array(':partner_name'=>$partnerData['name'], ':partner_phone'=>$partnerData['phone'], ':partner_email'=>$partnerData['regEmail'], ':partner_doj'=>$partnerData['doj'], ':partner_address'=>$partnerData['address']))) {
            $this->setMessage(array('success', 'Partner <b>'.$partnerData['name'].'</b> successfully saved'));
            return true;
        }
        $error = $solution->errorInfo()[2];
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * Level <b>'.$matches[1].'</b> already Exists *'));
            return false;
        }
        $formData  = implode(', ', $partnerData);
        $this->add_event_to_log($error.' --- '.$formData, 0);
        $this->setMessage(array('danger', 'Error!!! * Something wrong happened, try later *'));
        return false;
    }

    function getPartnerOptions(){
        $solution = $this->dbConn->prepare("SELECT partner_name partner, partner_id id FROM partners");
        $solution->execute();
        $partners = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $partners;
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

    function delete_partner($partnerId){
        $solution = $this->dbConn->prepare("DELETE FROM partners WHERE partner_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$partnerId))) {
            $this->add_event_to_log('Deleted Partner #'.$partnerId, 1);
            $this->setMessage(array('success', "Partner with ID #<b>$partnerId</b> successfully Deleted"));
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Delete Partner #$partnerId --- $error", 0);
        $this->setMessage(array('danger', "Unable to Delete Partner with ID #<b>$partnerId</b>"));
        return false;
    }

#####################################################  CENTERS

    function registerCenter($centerData){
        $solution = $this->dbConn->prepare("INSERT INTO partners_centers (partner_id, center_code, center_name, center_phone1, center_phone2, center_email, center_doj, center_address, city, city_pin) VALUES (:partner_id, :center_code, :center_name, :center_phone1, :center_phone2, :center_email, :center_doj, :center_address, :city, :city_pin)");
        if ($solution->execute(array(':partner_id'=>$centerData['partner'], ':center_code'=>$centerData['code'], ':center_name'=>$centerData['name'], ':center_phone1'=>$centerData['phone1'], ':center_phone2'=>$centerData['phone2'], ':center_email'=>$centerData['email'], ':center_doj'=>$centerData['doj'], ':center_address'=>$centerData['address'], ':city'=>$centerData['city'], ':city_pin'=>$centerData['pin']))) {
            if ($centerData['code']) {
                $this->setMessage(array('success', 'Center with Code <b>'.$centerData['code'].'</b> successfully saved'));
                return true;
            }else{
                $id = $this->dbConn->lastInsertId();
                $this->setMessage(array('success', 'Center with Code <b>'.$centerData['name'].'</b> successfully saved'));
                return true;
            }

        }
        $error = $solution->errorInfo()[2];
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * Level <b>'.$matches[1].'</b> already Exists *'));
            return false;
        }
        $formData  = implode(', ', $centerData);
        $this->add_event_to_log($error.' --- '.$formData, 0);
        $this->setMessage(array('danger', 'Error!!! * Something wrong happened, try later *'));
        return false;
    }

    function getCenterOptions(){
        $solution = $this->dbConn->prepare("SELECT center_name center, center_code code, center_id id FROM partners_centers");
        $solution->execute();
        $centers = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $centers;
    }

    function get_centers_array(){
        $solution = $this->dbConn->prepare("SELECT
            c.center_id id,
            c.center_code code,
            c.center_name name,
            DATE_FORMAT(c.center_doj, '%d/%m/%Y') doj,
            c.partner_id partner_id,
            p.partner_name partner,
            CONCAT(c.center_phone1, ', ', c.center_phone2) phone,
            c.center_email email,
            CONCAT(c.center_address, ', ', c.city, ' - ', c.city_pin) address
            FROM partners_centers c
            LEFT JOIN partners p ON p.partner_id = c.partner_id;");
        $solution->execute();
        if ($partners = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $partners;
        }else{
            return false;
        }
    }

    function delete_center($centerId){
        $solution = $this->dbConn->prepare("DELETE FROM partners_centers WHERE center_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$centerId))) {
            $this->add_event_to_log('Deleted Center #'.$centerId, 1);
            $this->setMessage(array('success', "Center with ID #<b>$centerId</b> successfully Deleted"));
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Delete Center #$centerId --- $error", 0);
        $this->setMessage(array('danger', "Unable to Delete Center with ID #<b>$centerId</b>"));
        return false;
    }

    function get_partners_centers($centerId){
        $solution = $this->dbConn->prepare("SELECT center, center_code, partner FROM login_detail_partner WHERE center_id = :centerId LIMIT 1");
        $solution->execute(array(':centerId'=>$centerId));
        if ($row = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $row;
        }
        echo "Wrong Center ID";
        return false;
    }

################################################### DESIGNATIONS

    function registerDesignation($userData){
        $solution = $this->dbConn->prepare("INSERT INTO client_designations (designation_name, designation_level, work_description) VALUES (:name, :level, :description)");
        if ($solution->execute(array(':name'=>$userData['designation'], ':level'=>$userData['level'], ':description'=>$userData['details']))) {
            $this->setMessage(array('success', 'Designation <b>'.$userData['designation'].'</b> at Level <b>'.$userData['level'].'</b> successfully saved'));
            return true;
        }
        $error = $solution->errorInfo()[2];
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * Level <b>'.$matches[1].'</b> already Exists *'));
            return false;
        }
        $this->add_event_to_log($error, 0);
        $this->setMessage(array('danger', 'Error!!! * Something wrong happened, try later *'));
        return false;
    }

    function getDesignationOptions(){
        $solution = $this->dbConn->prepare("SELECT designation_id id, designation_name designation, designation_level level FROM client_designations");
        $solution->execute();
        $designations = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $designations;
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

    function delete_designation($designationId){
        $solution = $this->dbConn->prepare("DELETE FROM client_designations WHERE designation_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$designationId))) {
            $this->add_event_to_log('Deleted Designation #'.$designationId, 1);
            $this->setMessage(array('success', "Designation with ID #<b>$designationId</b> successfully Deleted"));
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Delete Designation #$designationId --- $error", 0);
        $this->setMessage(array('danger', "Unable to Delete Designation with ID #<b>$designationId</b>"));
        return false;
    }

##################################################### USERS

    function registerUser($userData){
        $name = $userData['title'].' '.$userData['name'];
        $this->dbConn->beginTransaction();
        $solution = $this->dbConn->prepare("INSERT INTO users_personal (center_id, user_name, user_email, user_mobile, designation_id) VALUES (:center, :name, :email, :mobile, :designation)");
        $solution->execute(array(':center'=>$userData['office'], ':name'=>$name, ':mobile'=>$userData['phone'], ':email'=>$userData['regEmail'], ':designation'=>$userData['designation']));
        $id = $this->dbConn->lastInsertId();
        if ($id) {
            $solution = $this->dbConn->prepare("INSERT INTO users_profile (user_id, user_dob, user_father, user_salary, user_address, user_aadhar, user_extra) VALUES (:id, :dob, :father, :salary, :address, :aadhar, :extra)");
            if ($solution->execute(array(':id'=>$id, ':dob'=>$userData['dob'], ':father'=>$userData['parent'], ':salary'=>$userData['salary'], ':address'=>$userData['address'], ':aadhar'=>$userData['aadhar'], ':extra'=>$userData['details']))) {
                if ($userData['ERMaccess']) {
                    $salt = hash('sha512', str_shuffle('ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789'));
                    $pass = hash('sha512', $salt.$userData['newpassword']);
                    $status = 1;
                    $level = ($userData['power'] == 'admin') ? 8 : 1;
                    $solution = $this->dbConn->prepare("INSERT INTO users_login (user_id, user_pass, user_salt, user_level, user_login_status) VALUES (:id, :pass, :salt, :level, :status)");
                    if ($solution->execute(array(':id'=>$id, ':pass'=>$pass, ':salt'=>$salt, ':level'=>$level, ':status'=>$status))) {
                        $this->dbConn->commit();
                        $this->setMessage(array('success', "User successfully registered with Login Access, user id #<b>$id</b>"));
                        $event = "Registered user with ID #$id with Login Access ".implode(', ', $userData);
                        $this->add_event_to_log($event, 1);
                        return $id;
                    }else{
                        $error = $solution->errorInfo()[2];
                        $this->dbConn->rollBack();
                        $this->add_event_to_log("Unable to register and give login access - $error", 0);
                        $this->setMessage(array('danger', "Unable to give Login Access (Invalid Data), Please try again or Try without Login Access"));
                        return $id;
                    }
                }else{
                    $this->dbConn->commit();
                    $this->add_event_to_log("Registered user with ID #$id without login access", 1);
                    $this->setMessage(array('success', "User successfully registered without Login Access, user id #<b>$id</b>"));
                    return $id;
                }
            }
        }
        $error = $solution->errorInfo()[2];
        $this->dbConn->rollBack();
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * <b>'.$matches[1].'</b> already registered *'));
            return false;
        }
        $this->add_event_to_log($error, 0);
        $this->setMessage(array('danger', 'Error!!! * Something wrong happened, try later *'));
        return false;
    }

    function getUserOptions(){
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

    function get_users_array($centerId){
        $level = $this->userLevel;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
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
            $solution = $this->dbConn->prepare("SELECT
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

    function delete_user($userId){
        $solution = $this->dbConn->prepare("DELETE FROM users_personal WHERE user_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$userId))) {
            $this->add_event_to_log('Deleted User #'.$userId, 1);
            $this->setMessage(array('success', "User with ID #<b>$userId</b> successfully Deleted"));
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Delete User #$userId --- $error", 0);
        $this->setMessage(array('danger', "Unable to Delete User with ID #<b>$userId</b>"));
        return false;
    }

    function change_user_status($userId){
        $solution = $this->dbConn->prepare("UPDATE users_login SET user_login_status = user_login_status * -1 WHERE user_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$userId))) {
            $this->add_event_to_log("Blocked/Unblocked User #$userId", 1);
            $this->setMessage(array('success', "User with ID #<b>$userId</b> successfully Blocked/Unblocked"));
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Block/Unblock User #$userId --- $error", 0);
        $this->setMessage(array('danger', "Unable to Block/Unblock User with ID #<b>$userId</b>"));
        return false;
    }

    function get_user_details($userId){
        $level = $this->userLevel;
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

    function changePassword($oldPass, $newPass){
        $userId = (int) $_SESSION['s_user_id'];
        $solution = $this->dbConn->prepare("SELECT user_id user, user_pass password, user_salt salt FROM users_login WHERE user_id = :id LIMIT 1");
        $solution->execute(array(":id"=>$userId));
        if ($row = $solution->fetch(PDO::FETCH_ASSOC)) {
            if ($row['password'] === hash('sha512', $row['salt'].$oldPass)) {
                $userId = $row['user'];
                $salt = hash('sha512', str_shuffle('ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789'));
                $pass = hash('sha512', $salt.$newPass);
                $solution = $this->dbConn->prepare("UPDATE users_login SET user_pass = :pass, user_salt = :salt WHERE user_id = :id LIMIT 1");
                if ($solution->execute(array(':id'=>$userId, ':pass'=>$pass, ':salt'=>$salt))) {
                    $this->add_event_to_log('Changed the password', 1);
                    $this->setMessage(array('success', 'Password successfully changed, please login with new'));
                    return true;
                }else{
                    $error = $solution->errorInfo()[2];
                    $this->add_event_to_log($error, 0);
                    $this->setMessage(array('danger', 'Unable to change Password, Please try after some time'));
                    return false;
                }
            }else{
                $this->setMessage(array('danger', 'Incorrect Old Password, Please try again'));
                return false;
            }
        }
        $error = "Forced Password change for $userId while SESSION user not exist ".$solution->errorInfo()[2];
        $this->add_event_to_log($error, 0);
        $this->setMessage(array('danger', 'Unable to change Password, Please try after some time'));
        return false;
    }

    function changePersonal($address, $dob, $email){
        $userId = (int) $_SESSION['s_user_id'];
        $this->dbConn->beginTransaction();
        $solution = $this->dbConn->prepare("UPDATE users_personal SET user_email = :email wHERE user_id = :id LIMIT 1;");
        if ($solution->execute(array(':email'=>$email, ':id'=>$userId))) {
            $solution = $this->dbConn->prepare("UPDATE users_profile SET user_dob = :dob, user_address = :address wHERE user_id = :id LIMIT 1;");
            if ($solution->execute(array(':dob'=>$dob, ':address'=>$address, ':id'=>$userId))) {
                $this->dbConn->commit();
                $this->setMessage(array('success', "Personal details successfully updated"));
                $event = "Updated Personal Details - $address, $dob, $email";
                $this->add_event_to_log($event, 1);
                return true;
            }
        }
        $event = "Want to Update Personal Details - $address, $dob, $email --- ";
        $error = $solution->errorInfo()[2];
        $this->dbConn->rollBack();
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * <b>'.$matches[1].'</b> already registered *'));
            return false;
        }
        $this->add_event_to_log($event.$error, 0);
        $this->setMessage(array('danger', 'Error!!! * Something wrong happened, try later *'));
        return false;
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

    function get_recent_users($centerId){
        $solution = $this->dbConn->prepare("SELECT
                usr.user_id id,
                ctr.center_code center,
                usr.user_name name
                FROM users_personal usr
                LEFT JOIN partners_centers ctr ON ctr.center_id  = usr.center_id
                ORDER BY usr.user_id DESC LIMIT 5;");
            $solution->execute();
        $users = $solution->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

#################################################### EMPLOYEES

    function employee_detail_array($userId){
        $solution = $this->dbConn->prepare("SELECT
            per.user_email email,
            des.designation_name designation,
            pro.user_dob dob,
            pro.user_father father,
            pro.user_address address,
            pro.user_aadhar aadhar,
            pro.user_extra extra,
            DATE_FORMAT(pro.user_timestamp, '%d/%m/%Y %H:%i') time
            FROM users_personal per
            INNER JOIN users_profile pro ON pro.user_id = per.user_id
            LEFT JOIN client_designations des ON des.designation_id  = per.designation_id
            WHERE per.user_id = :id LIMIT 1;");
        $solution->execute(array(':id'=>$userId));
        if ($details = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return false;
        }
    }

#################################################### LOGINS

    function confirm_login($username, $password, $admin=false) {
        $solution = $this->dbConn->prepare("SELECT * FROM login_details WHERE username = :username LIMIT 1");
        $solution->execute(array(':username'=>$username));
        if ($details = $solution->fetch(PDO::FETCH_ASSOC)) {
            $userId = $details['user'];
            $password = hash('sha512', $details['salt'].$password );
            if ($this->checkbrute($userId)) {
                $this->setMessage(array('danger', "Account Locked, You have made many unsuccessful attempts, Try Later"));
                return false;
            }elseif ($details['status'] < 1) {
                if ($details['status'] < 0) {
                    $this->setMessage(array('danger', "Your Account is blocked by Admin"));
                    return false;
                }else{
                    $this->setMessage(array('danger', "Your Account has been Deleted"));
                    return false;
                }
            }elseif ($details['password'] === $password){        //// Login successful. ////
                $partner = $this->get_partners_centers($details['center']);
                session_regenerate_id();
                $_SESSION['s_user_id'] = $userId;
                $_SESSION['s_username'] = $details['username'];
                $this->userLevel = (int)$details['azz_level'];
                $_SESSION['s_name'] = $details['name'];
                $_SESSION['s_partner'] = $partner['partner'];
                $this->centerId = $details['center'];
                $_SESSION['s_center'] = $partner['center'];
                $_SESSION['s_center_code'] = $partner['center_code'];
                $user_browser = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['s_login_string'] = hash('sha512', $password . $user_browser);
                if (($details['azz_level'] === '9') && ($admin === true)) {
                    $_SESSION['AuthProvider'] = '100lution';
                }
                unset($details, $partner);
                session_write_close();
                $this->logInOutEvent($userId, 0);
                return true;
            } else {
                $this->logInOutEvent($userId, -1); //// Add this failed event to login table ////
                $this->setMessage(array('danger', "Invalid Credentials "));
                return false;
            }
        } else {  //// No user exists. ////
            $ip = $_SESSION['IPaddress'];
            $this->setMessage(array('danger', 'Invalid Credentials'));
            $this->logInvalidLogin($username, $ip);
            return false;
        }
    }

    function checkbrute($userId) {
        //// All login attempts are counted from the past 30 minutes (1800 SEC). ////
        $time = time()-1800;
        $solution = $this->dbConn->prepare("SELECT COUNT(*) count FROM login_attempts WHERE (user_id = :userId) AND (attempt_time > $time) AND (attempt_status = -1)");
        $solution->execute(array(':userId'=>$userId));
        $attempts = $solution->fetch(PDO::FETCH_ASSOC)['count'];
        if ($attempts > 3) {                                                //// If there have been more than 3 failed logins ////
            return true;
        } else {
            return false;
        }
    }

    function check_login() {
        if (isset($_SESSION['s_user_id'], $_SESSION['s_login_string'])) {
            $user_id = (int) $_SESSION['s_user_id'];
            $user_browser = $_SERVER['HTTP_USER_AGENT'];  //// Get the user-agent string of the user. ////
            $solution = $this->dbConn->prepare("SELECT user_pass pass, user_salt salt, user_level level, user_login_status status FROM users_login WHERE user_id = :userId LIMIT 1");
            $solution->execute(array(':userId'=>$user_id));   //// Execute the prepared query. ////
            if ($row = $solution->fetch(PDO::FETCH_ASSOC)) {
                $login_check = hash('sha512', $row['pass'] . $user_browser);
                if ($login_check === $_SESSION['s_login_string']) { //// Logged In!!!! ////
                    if ($row['status'] > 0) {
                        return $row['level'];
                    }else{ //// Account deactivated ////
                        $_SESSION = array();
                        $this->setMessage(array('danger', 'Your Account is blocked by Admin'));
                        return false;
                    }
                }
            }
            //// wrong session OR hIJACKED ////
            $desc = "DANGER UNKNOWN invalid session data - ".urldecode(http_build_query($_SESSION));
            $this->add_event_to_log($desc, 0);
            return false;
        } //// Not logged in ////
        $this->setMessage(array('danger', 'Please Login'));
        return false;
    }

    function logInOutEvent($userId = '0', $status = 0){   ////  -1 = Failed // 0  = Logged in // 1 = logged out ////
        $userId = isset($_SESSION['s_user_id']) ? $_SESSION['s_user_id'] : $userId;
        $time = time();
        $ip = $_SESSION['IPaddress'];
        if ($status < 1) {
            $solution = $this->dbConn->prepare("INSERT INTO login_attempts (user_id, attempt_status, attempt_time, attempt_ip) VALUES (:userId, :status, :time, INET_ATON(:ip))");

            $solution->execute(array(':userId'=>$userId, ':status'=>$status, ':time'=>$time, ':ip'=>$ip));
        }else{
            $solution = $this->dbConn->prepare("UPDATE login_attempts SET attempt_status = 1 WHERE (user_id = :userId) AND (attempt_status = 0)");

            $solution->execute(array(':userId'=>$userId));
        }
    }

    function logInvalidLogin($username, $ip){   //// For non-users ....... ////
        $solution = $this->dbConn->prepare("INSERT INTO login_invalid_users (attempt_username, attempt_ip) VALUES (:username, INET_ATON(:ip))");
        $solution->bindParam(':username', $username, PDO::PARAM_INT);
        $solution->bindParam(':ip', $ip, PDO::PARAM_INT);
        $solution->execute();
    }

    function get_logins_array($start){
        $solution = $this->dbConn->prepare("SELECT
            user_id user,
            FROM_UNIXTIME(attempt_time) login,
            attempt_status status,
            logout_time logout,
            INET_NTOA(attempt_ip) ip
            FROM login_attempts LIMIT $start, 200;");
        $solution->execute();
        if ($attempts = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $attempts;
        }else{
            return false;
        }
    }

    function get_log_events_array($start){
        $solution = $this->dbConn->prepare("SELECT
            user_id user,
            event event,
            event_status status,
            event_timestamp time
            FROM events_log LIMIT $start, 200;");
        $solution->execute();
        if ($events = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $events;
        }else{
            return false;
        }
    }

    function add_event_to_log($desc, $status = 1, $user_id = '0'){
        $user_id = isset($_SESSION['s_user_id']) ? $_SESSION['s_user_id'] : $user_id;
        $solution = $this->dbConn->prepare("INSERT INTO events_log (user_id, event, event_status) VALUES (:user_id, :description, :status)");
        $solution->execute(array(':user_id'=>$user_id, ':description'=>$desc, ':status'=>$status));
    }

######################################################################################################################
###################################      Customized Function            ##############################################
######################################################################################################################

##################################################   Departments

    function department_addNew($details){
        $solution = $this->dbConn->prepare("INSERT INTO client_departments (department_name) VALUES (:department_name)");
        if ($solution->execute(array(':department_name'=>$details['name']))) {
            $this->setMessage(array('success', 'Department <b>'.$details['name'].'</b> successfully saved'));
            return true;
        }
        $error = $solution->errorInfo()[2];
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * Department <b>'.$matches[1].'</b> already Exists *'));
            return false;
        }
        $formData  = implode(', ', $details);
        $this->add_event_to_log($error.' --- '.$formData, 0);
        $this->setMessage(array('danger', 'Error!!! * Something wrong happened, try later *'));
        return false;
    }

    function department_formOptions(){
        $clientId = (int) $this->clientId;
        $solution = $this->dbConn->prepare("SELECT
        	ENCODE(department_id, $clientId) id,
        	department_name name
        	FROM client_departments;");
        $solution->execute();
        if ($departments = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $departments;
        }else{
            return false;
        }
    }

    function department_detailedArray(){
        $solution = $this->dbConn->prepare("SELECT
            department_id id,
            department_name department
            FROM departments_data;");
        $solution->execute();
        if ($departments = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $departments;
        }else{
            return false;
        }
    }

##################################################   Departments

    function designation_addNew($details){
        $solution = $this->dbConn->prepare("INSERT INTO zones_data (zone_name) VALUES (:zone_name)");
        if ($solution->execute(array(':zone_name'=>$details['name']))) {
            $this->setMessage(array('success', 'Zone <b>'.$details['name'].'</b> successfully saved'));
            return true;
        }
        $error = $solution->errorInfo()[2];
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * Zone <b>'.$matches[1].'</b> already Exists *'));
            return false;
        }
        $formData  = implode(', ', $details);
        $this->add_event_to_log($error.' --- '.$formData, 0);
        $this->setMessage(array('danger', 'Error!!! * Something wrong happened, try later *'));
        return false;
    }

    function designation_formOptions(){
        $clientId = (int) $this->clientId;
        $solution = $this->dbConn->prepare("SELECT
        	ENCODE(des.designation_id, $clientId) id,
        	des.designation_name name,
        	dep.department_name department
        	FROM client_designations des
        	LEFT JOIN client_departments dep ON dep.department_id = des.department_id;");
        $solution->execute();
        if ($zones = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $zones;
        }else{
            return false;
        }
    }

    function designation_detailedArray(){
        $solution = $this->dbConn->prepare("SELECT
            zone_id id,
            zone_name zone
            FROM zones_data;");
        $solution->execute();
        if ($zones = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $zones;
        }else{
            return false;
        }
    }

##################################################   Districts

    function registerDistrict($details){
        $solution = $this->dbConn->prepare("INSERT INTO districts_data (district_name, zone_id, center_id, state) VALUES (:district_name, :zone_id, :center_id, :state)");
        if ($solution->execute(array(':district_name'=>$details['name'], ':zone_id'=>$details['zone'], ':center_id'=>$details['center'], ':state'=>$details['state']))) {
            $this->setMessage(array('success', 'District <b>'.$details['name'].'</b> successfully saved'));
            return true;
        }
        echo $error = $solution->errorInfo()[2];
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * District <b>'.$matches[1].'</b> already Exists *'));
            return false;
        }
        $formData  = implode(', ', $details);
        $this->add_event_to_log($error.' --- '.$formData, 0);
        $this->setMessage(array('danger', 'Error!!! * Something wrong happened, try later *'));
        return false;
    }

    function getDistrictOptions(){
        $center = (int) $this->centerId;
        if ($center == 1) {
            $solution = $this->dbConn->prepare("SELECT district_id id, district_name district FROM districts_data;");
        }else{
            $solution = $this->dbConn->prepare("SELECT district_id id, district_name district FROM districts_data WHERE center_id = :center_id");
        }
        $solution->execute(array(':center_id'=>$center));
        if ($district = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $district;
        }else{
            return false;
        }
    }

    function get_district_array(){ ########
        $center = (int) $this->centerId;
        if ($center == 1) {
            $solution = $this->dbConn->prepare("SELECT
                dis.district_id id,
                dis.district_name district,
                dis.zone_id zoneId,
                zone.zone_name zone,
                dis.center_id centerId,
                cent.center_name center,
                dis.state
                FROM districts_data dis
                LEFT JOIN partners_centers cent ON cent.center_id = dis.center_id
                LEFT JOIN zones_data zone ON zone.zone_id = dis.zone_id;");
        }else{
            $solution = $this->dbConn->prepare("SELECT
                dis.district_id id,
                dis.district_name district,
                dis.zone_id zoneId,
                zone.zone_name zone,
                dis.center_id centerId,
                cent.center_name center,
                dis.state
                FROM districts_data dis
                LEFT JOIN partners_centers cent ON cent.center_id = dis.center_id
                LEFT JOIN zones_data zone ON zone.zone_id = dis.zone_id
                WHERE dis.center_id = :center_id");
        }
        $solution->execute(array(':center_id'=>$center));
        if ($district = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $district;
        }else{
            return false;
        }
    }

    function changeDistrictsData($address, $dob, $email){
        $userId = (int) $_SESSION['s_user_id'];
        $this->dbConn->beginTransaction();
        $solution = $this->dbConn->prepare("UPDATE users_personal SET user_email = :email wHERE user_id = :id LIMIT 1;");
        if ($solution->execute(array(':email'=>$email, ':id'=>$userId))) {
            $solution = $this->dbConn->prepare("UPDATE users_profile SET user_dob = :dob, user_address = :address wHERE user_id = :id LIMIT 1;");
            if ($solution->execute(array(':dob'=>$dob, ':address'=>$address, ':id'=>$userId))) {
                $this->dbConn->commit();
                $this->setMessage(array('success', "Personal details successfully updated"));
                $event = "Updated Personal Details - $address, $dob, $email";
                $this->add_event_to_log($event, 1);
                return true;
            }
        }
        $event = "Want to Update Personal Details - $address, $dob, $email --- ";
        $error = $solution->errorInfo()[2];
        $this->dbConn->rollBack();
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * <b>'.$matches[1].'</b> already registered *'));
            return false;
        }
        $this->add_event_to_log($event.$error, 0);
        $this->setMessage(array('danger', 'Error!!! * Something wrong happened, try later *'));
        return false;
    }

#################################################   Stores

    function registerStore($details){
        $solution = $this->dbConn->prepare("INSERT INTO store_stock (balance_stock, city, address, owner_name, owner_mobile, doj) VALUES (:balance_stock, :city, :address, :owner_name, :owner_mobile, :doj)");
        if ($solution->execute(array(':balance_stock'=>$details['stock'], ':city'=>$details['city'], ':address'=>$details['address'], ':owner_name'=>$details['owner'], ':owner_mobile'=>$details['mobile'], ':doj'=>$details['doj']))) {
            $this->setMessage(array('success', 'Store <b>'.$details['name'].'</b> successfully saved'));
            return true;
        }
        $error = $solution->errorInfo()[2];
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * Store <b>'.$matches[1].'</b> already Exists *'));
            return false;
        }
        $formData  = implode(', ', $details);
        $this->add_event_to_log($error.' --- '.$formData, 0);
        $this->setMessage(array('danger', 'Error!!! * Something wrong happened, try later *'));
        return false;
    }

    function getStoreOptions(){
        $solution = $this->dbConn->prepare("SELECT store_id id, city, owner_name owner FROM store_stock");
        $solution->execute();
        if ($stores = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $stores;
        }else{
            return false;
        }
    }

    function get_store_array(){
        $solution = $this->dbConn->prepare("SELECT
            store_id id,
            city,
            owner_name owner,
            balance_stock stock,
            address,
            owner_mobile mobile,
            DATE_FORMAT(doj, '%d/%m/%Y') joining,
            store_status status
            FROM store_stock");
        $solution->execute();
        if ($stores = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $stores;
        }else{
            return false;
        }
    }

    function changeStoresData($address, $dob, $email){
        $userId = (int) $_SESSION['s_user_id'];
        $this->dbConn->beginTransaction();
        $solution = $this->dbConn->prepare("UPDATE users_personal SET user_email = :email wHERE user_id = :id LIMIT 1;");
        if ($solution->execute(array(':email'=>$email, ':id'=>$userId))) {
            $solution = $this->dbConn->prepare("UPDATE users_profile SET user_dob = :dob, user_address = :address wHERE user_id = :id LIMIT 1;");
            if ($solution->execute(array(':dob'=>$dob, ':address'=>$address, ':id'=>$userId))) {
                $this->dbConn->commit();
                $this->setMessage(array('success', "Personal details successfully updated"));
                $event = "Updated Personal Details - $address, $dob, $email";
                $this->add_event_to_log($event, 1);
                return true;
            }
        }
        $event = "Want to Update Personal Details - $address, $dob, $email --- ";
        $error = $solution->errorInfo()[2];
        $this->dbConn->rollBack();
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * <b>'.$matches[1].'</b> already registered *'));
            return false;
        }
        $this->add_event_to_log($event.$error, 0);
        $this->setMessage(array('danger', 'Error!!! * Something wrong happened, try later *'));
        return false;
    }

#################################################   Blocks

    function registerBlock($details){
        $solution = $this->dbConn->prepare("INSERT INTO blocks_data (block_name, store_id, district_id, doj) VALUES (:block_name, :store_id, :district_id, :doj)");
        if ($solution->execute(array(':block_name'=>$details['name'], ':store_id'=>$details['store'], ':district_id'=>$details['district'], ':doj'=>$details['doj']))) {
            $this->setMessage(array('success', 'Block <b>'.$details['name'].'</b> successfully saved'));
            return true;
        }
        $error = $solution->errorInfo()[2];
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * Block <b>'.$matches[1].'</b> already Exists *'));
            return false;
        }
        $formData  = implode(', ', $details);
        $this->add_event_to_log($error.' --- '.$formData, 0);
        $this->setMessage(array('danger', 'Error!!! * Something wrong happened, try later *'));
        return false;
    }

    function getBlockOptions($district, $center = 0){
        if ($center == 1) {
            $solution = $this->dbConn->prepare("SELECT block_id id, district_id district, block_name block FROM blocks_data");
            $solution->execute(array(':center_id'=>$center));
            if ($blocks = $solution->fetchAll(PDO::FETCH_ASSOC)) {
                return $blocks;
            }else{
                return false;
            }
        } elseif ($center) {
            $solution = $this->dbConn->prepare("SELECT block_id id, district_id district, block_name block FROM blocks_data WHERE district_id IN (SELECT district_id FROM districts_data WHERE center_id = :center_id)");
            $solution->execute(array(':center_id'=>$center));
            if ($blocks = $solution->fetchAll(PDO::FETCH_ASSOC)) {
                return $blocks;
            }else{
                return false;
            }
        } else{
            $solution = $this->dbConn->prepare("SELECT block_id id, block_name block FROM blocks_data WHERE district_id = :district_id");
            $solution->execute(array(':district_id'=>$district));
            if ($blocks = $solution->fetchAll(PDO::FETCH_ASSOC)) {
                return $blocks;
            }else{
                return false;
            }
        }
    }

    function get_block_array(){ ########
        $center = $this->centerId;
        if ($center == 1) {
            $solution = $this->dbConn->prepare("SELECT
            blk.block_id id,
            blk.block_name block,
            dist.district_name district,
            str.owner_name owner,
            str.city store_city,
            DATE_FORMAT(blk.doj, '%d/%m/%Y') joining,
            blk.block_status status
            FROM blocks_data blk
            LEFT JOIN districts_data dist ON dist.district_id = blk.district_id
            LEFT JOIN store_stock str ON str.store_id = blk.store_id;");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
            blk.block_id id,
            blk.block_name block,
            dist.district_name district,
            str.owner_name owner,
            str.city store_city,
            DATE_FORMAT(blk.doj, '%d/%m/%Y') joining,
            blk.block_status status
            FROM blocks_data blk
            LEFT JOIN districts_data dist ON dist.district_id = blk.district_id
            LEFT JOIN store_stock str ON str.store_id = blk.store_id
            WHERE blk.district_id IN (SELECT district_id FROM districts_data WHERE center_id = :center_id);");
            $solution->execute(array(':center_id'=>$center));
        }

        if ($partners = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $partners;
        }else{
            return false;
        }
    }

    function changeBlocksData($address, $dob, $email){
        $userId = (int) $_SESSION['s_user_id'];
        $this->dbConn->beginTransaction();
        $solution = $this->dbConn->prepare("UPDATE users_personal SET user_email = :email wHERE user_id = :id LIMIT 1;");
        if ($solution->execute(array(':email'=>$email, ':id'=>$userId))) {
            $solution = $this->dbConn->prepare("UPDATE users_profile SET user_dob = :dob, user_address = :address wHERE user_id = :id LIMIT 1;");
            if ($solution->execute(array(':dob'=>$dob, ':address'=>$address, ':id'=>$userId))) {
                $this->dbConn->commit();
                $this->setMessage(array('success', "Personal details successfully updated"));
                $event = "Updated Personal Details - $address, $dob, $email";
                $this->add_event_to_log($event, 1);
                return true;
            }
        }
        $event = "Want to Update Personal Details - $address, $dob, $email --- ";
        $error = $solution->errorInfo()[2];
        $this->dbConn->rollBack();
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * <b>'.$matches[1].'</b> already registered *'));
            return false;
        }
        $this->add_event_to_log($event.$error, 0);
        $this->setMessage(array('danger', 'Error!!! * Something wrong happened, try later *'));
        return false;
    }

################################################  Volunteer

    function registerVolunteer($data){
        $ERMuser = (int) $_SESSION['s_user_id'];
        $name = $data['title'].' '.$data['name'];
        $this->dbConn->beginTransaction();
        $solution = $this->dbConn->prepare("INSERT INTO volunteers_data (user_id, designation_role, block_id, district_id, zone_id, volunteer_name, volunteer_father, volunteer_mobile, doj) VALUES (:user_id, :designation_role, :block_id, :district_id, :zone_id, :volunteer_name, :volunteer_father, :volunteer_mobile, :doj)");

        $solution->execute(array(':user_id'=>$ERMuser, ':designation_role'=>$data['designation'], ':block_id'=>$data['block'], ':district_id'=>$data['district'], ':zone_id'=>$data['zone'], ':volunteer_name'=>$name, ':volunteer_father'=>$data['parent'], ':volunteer_mobile'=>$data['phone'], ':doj'=>$data['doj']));
        $id = $this->dbConn->lastInsertId();
        //echo "<pre> $id <br><br>";
        //print_r($solution->errorInfo());
        if ($id) {
            $solution = $this->dbConn->prepare("INSERT INTO volunteers_rest_data (volunteer_id,volunteer_email,volunteer_education,amount,dob,volunteer_address,volunteer_experience,volunteer_aadhar,volunteer_pan,blood_group,category,caste,nominee_age,nominee_name,nominee_relation,family_females) VALUES (:volunteer_id, :volunteer_email, :volunteer_education, :amount, :dob, :volunteer_address, :volunteer_experience, :volunteer_aadhar, :volunteer_pan, :blood_group, :category, :caste, :nominee_age, :nominee_name, :nominee_relation, :family_females)");
            //print_r($solution->errorInfo());
            if ($solution->execute(array(':volunteer_id'=>$id, ':volunteer_email'=>$data['regEmail'], ':volunteer_education'=>$data['education'], ':amount'=>$data['fee'], ':dob'=>$data['dob'], ':volunteer_address'=>$data['address'], ':volunteer_experience'=>$data['experience'], ':volunteer_aadhar'=>$data['aadhar'], ':volunteer_pan'=>$data['pan'], ':blood_group'=>$data['blodGroup'], ':category'=>$data['category'], ':caste'=>$data['caste'], ':nominee_age'=>$data['nAge'], ':nominee_name'=>$data['nName'], ':nominee_relation'=>$data['nRelation'], ':family_females'=>$data['females']))) {
                //print_r($solution->errorInfo());
                $solution = $this->dbConn->prepare("INSERT INTO volunteers_account_data (volunteer_id, bank_name, bank_ifsc, bank_account, remuneration) VALUES (:volunteer_id, :bank_name, :bank_ifsc, :bank_account, :remuneration)");
                //print_r($solution->errorInfo());
                if ($solution->execute(array(':volunteer_id'=>$id, ':bank_name'=>$data['bank'], ':bank_ifsc'=>$data['ifsc'], ':bank_account'=>$data['bankAccount'], ':remuneration'=>$data['salary']))) {
                    //print_r($solution->errorInfo());
                    $this->dbConn->commit();
                    $msg = "Volunteer <b>$name</b> (".$data['designation'].") successfully registered with ID # <b>".$this->get_actual_volunteer_id($data['designation'], $id)."</b>";
                    $this->setMessage(array('success', $msg));
                    return $id;
                }
            }
        }
        $error = $solution->errorInfo()[2];
        $this->dbConn->rollBack();
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            if (preg_match("/PRIMARY/i", $error, $matches1)) {
                $this->setMessage(array('danger', 'Error!!! * Volunteer already registered for this Block/District *'));
                return false;
            }
            $this->setMessage(array('danger', 'Error!!! * <b>'.$matches[1].'</b> already registered *'));
            return false;
        }
        $this->add_event_to_log($error, 0);
        $this->setMessage(array('danger', 'Error!!! * <b>Something wrong happened, Please try Later *'));
        return false;
    }

    function getBlockVolunteerOptions($block){
        $solution = $this->dbConn->prepare("SELECT volunteer_id id, volunteer_name volunteer FROM volunteers_data WHERE (designation_role = 'Local Volunteer') AND (block_id = :block_id)");
        $solution->execute(array(':block_id'=>$block));
        if ($volunteers = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $volunteers;
        }else{
            return false;
        }
    }

    function get_volunteers_array($start=0, $results =500){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                vol1.volunteer_id id,
                vol1.user_id user,
                blck.block_name block,
                dstrc.district_name district,
                vol1.designation_role designation,
                vol1.volunteer_name name,
                vol1.volunteer_mobile mobile,
                DATE_FORMAT(vol1.doj, '%d/%m/%Y') joining,
                vol1.volunteer_status status
                FROM volunteers_data vol1
                LEFT JOIN blocks_data blck ON blck.block_id  = vol1.block_id
                LEFT JOIN districts_data dstrc ON dstrc.district_id = vol1.district_id
                LIMIT $start, $results;");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
                vol1.volunteer_id id,
                blck.block_name block,
                dstrc.district_name district,
                vol1.designation_role designation,
                vol1.volunteer_name name,
                vol1.volunteer_mobile mobile,
                DATE_FORMAT(vol1.doj, '%d/%m/%Y') joining,
                vol1.volunteer_status status
                FROM volunteers_data vol1
                LEFT JOIN blocks_data blck ON blck.block_id  = vol1.block_id
                LEFT JOIN districts_data dstrc ON dstrc.district_id = vol1.district_id
                WHERE vol1.district_id IN (SELECT district_id FROM districts_data WHERE center_id = :center_id)
                LIMIT $start, $results;");
            $solution->execute(array(':center_id'=>$centerId));
        }
        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function delete_volunteer($volunteerId){
        $solution = $this->dbConn->prepare("DELETE FROM complaints_data WHERE complaint_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$volunteerId))) {
            $this->add_event_to_log('Deleted Complaint #'.$volunteerId, 1);
            $this->setMessage(array('success', "Complaint with Code/ID #<b>$volunteerId</b> successfully Deleted"));
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Delete Compliant #$volunteerId --- $error", 0);
        $this->setMessage(array('danger', "Unable to Delete Compliant with Code/ID #<b>$volunteerId</b>"));
        return false;
    }

    function get_volunteer_details($volunteerId){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                vol1.volunteer_id ID,
                vol1.volunteer_name Name,
                vol1.designation_role Designation,
                vol1.volunteer_father Father,
                vol1.volunteer_mobile Mobile,
                DATE_FORMAT(vol1.doj, '%d/%m/%Y') Joining,
                blck.block_name Block,
                dstrc.district_name District,
                zone.zone_name Zone,
                vol2.volunteer_email Email,
                vol2.volunteer_education Education,
                vol2.amount Remuneration,
                DATE_FORMAT(vol2.dob, '%d/%m/%Y') DOB,
                vol2.volunteer_address Address,
                vol2.volunteer_experience Experience,
                vol2.volunteer_aadhar AADHAR,
                vol2.volunteer_pan PAN,
                vol2.blood_group Blood,
                vol2.category Category,
                vol2.caste Caste,
                vol2.nominee_age NomineeAge,
                vol2.nominee_name NomineeName,
                vol2.nominee_relation NomineeRelation,
                vol3.bank_name Bank,
                vol3.bank_ifsc IFSC,
                vol3.bank_account Account,
                vol3.remuneration Remuneration,
                vol3.last_balance LastBalance,
                DATE_FORMAT(vol1.volunteer_timestamp, '%d/%m/%Y %H:%i') AddTime,
                vol1.user_id User
                FROM volunteers_data vol1
                INNER JOIN volunteers_rest_data vol2 ON vol2.volunteer_id = vol1.volunteer_id
                INNER JOIN volunteers_account_data vol3 ON vol3.volunteer_id = vol1.volunteer_id
                LEFT JOIN blocks_data blck ON blck.block_id  = vol1.block_id
                LEFT JOIN districts_data dstrc ON dstrc.district_id = vol1.district_id
                LEFT JOIN zones_data zone ON zone.zone_id = vol1.zone_id
                WHERE vol1.volunteer_id = :volunteer;");
            $solution->execute(array(':volunteer'=>$volunteerId));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                vol1.volunteer_id ID,
                vol1.volunteer_name Name,
                vol1.designation_role Designation,
                vol1.volunteer_father Father,
                vol1.volunteer_mobile Mobile,
                DATE_FORMAT(vol1.doj, '%d/%m/%Y') Joining,
                blck.block_name Block,
                dstrc.district_name District,
                zone.zone_name Zone,
                vol2.volunteer_email Email,
                vol2.volunteer_education Education,
                vol2.amount Remuneration,
                DATE_FORMAT(vol2.dob, '%d/%m/%Y') DOB,
                vol2.volunteer_address Address,
                vol2.volunteer_experience Experience,
                vol2.volunteer_aadhar AADHAR,
                vol2.volunteer_pan PAN,
                vol2.blood_group Blood,
                vol2.category Category,
                vol2.caste Caste,
                vol2.nominee_age NomineeAge,
                vol2.nominee_name NomineeName,
                vol2.nominee_relation NomineeRelation,
                vol3.bank_name Bank,
                vol3.bank_ifsc IFSC,
                vol3.bank_account Account,
                vol3.remuneration Remuneration,
                vol3.last_balance LastBalance,
                DATE_FORMAT(vol1.volunteer_timestamp, '%d/%m/%Y %H:%i') AddTime,
                vol1.user_id User
                FROM volunteers_data vol1
                INNER JOIN volunteers_rest_data vol2 ON vol2.volunteer_id = vol1.volunteer_id
                INNER JOIN volunteers_account_data vol3 ON vol3.volunteer_id = vol1.volunteer_id
                LEFT JOIN blocks_data blck ON blck.block_id  = vol1.block_id
                LEFT JOIN districts_data dstrc ON dstrc.district_id = vol1.district_id
                LEFT JOIN zones_data zone ON zone.zone_id = vol1.zone_id
                WHERE (vol1.district_id IN (SELECT district_id FROM districts_data WHERE center_id = :center)) AND (vol1.volunteer_id = :volunteer);");
            $solution->execute(array(':center'=>$centerId, ':volunteer'=>$volunteerId));
        }
        if ($details = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $details;
        }else{
            return false;
        }
    }

    function change_volunteer_status($volunteerId){
        $solution = $this->dbConn->prepare("UPDATE complaints_data SET complaint_status = complaint_status * -1 WHERE complaint_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$volunteerId))) {
            $this->add_event_to_log("volunteer with ID #$volunteerId has been Re-Opened", 1);
            $this->setMessage(array('success', "volunteer with ID #$volunteerId successfully Re-Opened"));
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to re-open volunteer #$volunteerId --- $error", 0);
        $this->setMessage(array('danger', "Unable to Re-Open volunteer with ID #<b>$volunteerId</b>"));
        return false;
    }

    function get_recent_volunteers($results =6){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                vol1.volunteer_id id,
                blck.block_name block,
                dstrc.district_name district,
                vol1.designation_role designation,
                vol1.volunteer_name name
                FROM volunteers_data vol1
                LEFT JOIN blocks_data blck ON blck.block_id  = vol1.block_id
                LEFT JOIN districts_data dstrc ON dstrc.district_id = vol1.district_id
                ORDER BY vol1.volunteer_timestamp DESC
                LIMIT $results;");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
                vol1.volunteer_id id,
                blck.block_name block,
                dstrc.district_name district,
                vol1.designation_role designation,
                vol1.volunteer_name name
                FROM volunteers_data vol1
                LEFT JOIN blocks_data blck ON blck.block_id  = vol1.block_id
                LEFT JOIN districts_data dstrc ON dstrc.district_id = vol1.district_id
                WHERE vol1.district_id IN (SELECT district_id FROM districts_data WHERE center_id = :center_id)
                ORDER BY vol1.volunteer_timestamp DESC
                LIMIT $results;");
            $solution->execute(array(':center_id'=>$centerId));
        }
        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function get_actual_volunteer_id($designation, $id){
        switch ($designation) {
            case 'Local Volunteer':
                return 'SASB '.$id;
                break;
            case 'Block Supervisor':
                return 'SASB '.$id;
                break;
            case 'District Convener':
                return 'SASB D'.$id;
                break;
            case 'District Women & Child Development Officer':
                return 'SASB D'.$id;
                break;
            case 'Zonal Coordinator':
                return 'SASB Z'.$id;
                break;
            default:
                return 'IIF'.str_pad($id, 3, '0', STR_PAD_LEFT);
                break;
        }
    }

################################################# Members

    function registerMember($data){
        $ERMuser = (int) $_SESSION['s_user_id'];
        $name = $data['title'].' '.$data['name'];
        $district = $data['block'] / 1000;
        $district = (int) $district;
        $this->dbConn->beginTransaction();
        $solution = $this->dbConn->prepare("INSERT INTO members_data (user_id, volunteer_id, block_id, district_id, member_name, member_father, member_mobile, doj) VALUES (:user_id, :volunteer_id, :block_id, :district_id, :member_name, :member_father, :member_mobile, :doj)");
        $solution->execute(array(':user_id'=>$ERMuser, ':volunteer_id'=>$data['localVolunteer'], ':block_id'=>$data['block'], ':district_id'=>$district, ':member_name'=>$name, ':member_father'=>$data['parent'], ':member_mobile'=>$data['phone'], ':doj'=>$data['doj']));
        $id = $this->dbConn->lastInsertId();
        //echo "<pre> $id <br><br>";
        //print_r($solution->errorInfo());
        if ($id) {
            $solution = $this->dbConn->prepare("INSERT INTO members_data2(member_id, member_email, member_education, amount, dob, member_address, member_occupation, period_day, period_discontinue, any_disease, income_source, family_females, family_head, family_head_relation, family_disease) VALUES (:member_id, :member_email, :member_education, :amount, :dob, :member_address, :member_occupation, :period_day, :period_discontinue, :any_disease, :income_source, :family_females, :family_head, :family_head_relation, :family_disease)");
            //print_r($solution->errorInfo());
            if ($solution->execute(array(':member_id'=>$id, ':member_email'=>$data['regEmail'], ':member_education'=>$data['education'], ':amount'=>$data['fee'], ':dob'=>$data['dob'], ':member_address'=>$data['address'], ':member_occupation'=>$data['experience'], ':period_day'=>$data['pday'], ':period_discontinue'=>$data['discontinuity'], ':any_disease'=>$data['disease'], ':income_source'=>$data['income'], ':family_females'=>$data['females'], ':family_head'=>$data['nName'], ':family_head_relation'=>$data['nRelation'], ':family_disease'=>$data['fDisease']))) {
                    //print_r($solution->errorInfo());
                    $this->dbConn->commit();
                    $msg = "Member <b>$name</b> successfully registered with Ref # <b>".str_pad($id, 7, '0', STR_PAD_LEFT)."</b>";
                    $this->setMessage(array('success', $msg));
                    return $id;
            }
        }
        $error = $solution->errorInfo()[2];
        $this->dbConn->rollBack();
        if (preg_match("/Duplicate entry '([^']+)'/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * <b>'.$matches[1].'</b> already registered *'));
            return false;
        }
        if (preg_match("/`balance_stock` - 1/", $error, $matches)) {
            $this->setMessage(array('danger', 'Error!!! * Cannot Register, Packet Store <b>Out Of Stock</b> *'));
            return false;
        }
        $this->add_event_to_log($error, 0);
        $this->setMessage(array('danger', $error));
        return false;
    }

    function get_members_array($start=0, $active = '<', $results = 500){ ## >= for inactive // < for active
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                mem1.member_id id,
                mem1.user_id user,
                blck.block_name block,
                dstrc.district_name district,
                dstrc.district_id district_id,
                vol1.volunteer_name volunteer,
                mem1.member_name name,
                mem1.member_father father,
                mem1.member_mobile mobile,
                DATE_FORMAT(mem1.doj, '%d/%m/%Y') joining,
                mem1.member_status packets
                FROM members_data mem1
                LEFT JOIN volunteers_data vol1 ON vol1.volunteer_id  = mem1.volunteer_id
                LEFT JOIN blocks_data blck ON blck.block_id  = mem1.block_id
                LEFT JOIN districts_data dstrc ON dstrc.district_id = blck.district_id
                WHERE mem1.member_status $active 12
                ORDER BY member_id DESC
                LIMIT $start, $results;");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
                mem1.member_id id,
                mem1.user_id user,
                blck.block_name block,
                dstrc.district_name district,
                dstrc.district_id district_id,
                vol1.volunteer_name volunteer,
                mem1.member_name name,
                mem1.member_father father,
                mem1.member_mobile mobile,
                DATE_FORMAT(mem1.doj, '%d/%m/%Y') joining,
                mem1.member_status packets
                FROM members_data mem1
                LEFT JOIN volunteers_data vol1 ON vol1.volunteer_id  = mem1.volunteer_id
                LEFT JOIN blocks_data blck ON blck.block_id  = mem1.block_id
                LEFT JOIN districts_data dstrc ON dstrc.district_id = blck.district_id
                WHERE (mem1.member_status $active 12) AND (blck.district_id IN (SELECT district_id FROM districts_data WHERE center_id = :center_id))
                ORDER BY member_id DESC
                LIMIT $start, $results;");
            $solution->execute(array(':center_id'=>$centerId));
        }
        if ($tickets = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function delete_member($volunteerId){
        $solution = $this->dbConn->prepare("DELETE FROM complaints_data WHERE complaint_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$volunteerId))) {
            $this->add_event_to_log('Deleted Complaint #'.$volunteerId, 1);
            $this->setMessage(array('success', "Complaint with Code/ID #<b>$volunteerId</b> successfully Deleted"));
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Delete Compliant #$volunteerId --- $error", 0);
        $this->setMessage(array('danger', "Unable to Delete Compliant with Code/ID #<b>$volunteerId</b>"));
        return false;
    }

    function get_member_details($data){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                CONCAT(blck.district_id,mem1.member_id) ID,
                mem1.member_name Name,
                mem1.member_mobile Mobile,
                DATE_FORMAT(mem1.doj, '%d/%m/%Y') JoiningDate,
                mem1.member_status Packets,
                mem1.member_father Father,
                vol1.volunteer_name Volunteer,
                blck.block_name Block,
                dstrc.district_name District,
                DATE_FORMAT(mem2.dob, '%d/%m/%Y') DOB,
                mem2.member_email Email,
                mem2.member_education Education,
                mem2.amount MembershipAmount,
                mem2.member_address Address,
                mem2.member_occupation Occupation,
                mem2.period_day PeriodOnDay,
                mem2.period_discontinue Discontinuation,
                mem2.any_disease Disease,
                mem2.income_source IncomeSource,
                mem2.family_females FemalesInFamily,
                mem2.family_head HeadOfFamily,
                mem2.family_head_relation Relation,
                mem2.family_disease FamilyDisease,
                mem1.user_id User
                FROM members_data mem1
                INNER JOIN members_data2 mem2 ON mem2.member_id = mem1.member_id
                LEFT JOIN volunteers_data vol1 ON vol1.volunteer_id  = mem1.volunteer_id
                LEFT JOIN blocks_data blck ON blck.block_id  = mem1.block_id
                LEFT JOIN districts_data dstrc ON dstrc.district_id = blck.district_id
                WHERE mem1.member_id = :member_id
                LIMIT 1;");
            $solution->execute(array(':member_id'=>$data));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                mem1.member_id id,
                mem1.user_id user,
                blck.block_name block,
                dstrc.district_name district,
                dstrc.district_id district_id,
                vol1.volunteer_name volunteer,
                mem1.member_name name,
                mem1.member_father father,
                mem1.member_mobile mobile,
                DATE_FORMAT(mem1.doj, '%d/%m/%Y') joining,
                mem1.member_status packets
                FROM members_data mem1
                LEFT JOIN volunteers_data vol1 ON vol1.volunteer_id  = mem1.volunteer_id
                LEFT JOIN blocks_data blck ON blck.block_id  = mem1.block_id
                LEFT JOIN districts_data dstrc ON dstrc.district_id = blck.district_id
                WHERE (mem1.member_status $active 12) AND (blck.district_id IN (SELECT district_id FROM districts_data WHERE center_id = :center_id))
                LIMIT $start, 500;");
            $solution->execute(array(':center_id'=>$centerId));
        }
        if ($tickets = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

    function change_member_status($volunteerId){
        $solution = $this->dbConn->prepare("UPDATE complaints_data SET complaint_status = complaint_status * -1 WHERE complaint_id = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$volunteerId))) {
            $this->add_event_to_log("volunteer with ID #$volunteerId has been Re-Opened", 1);
            $this->setMessage(array('success', "volunteer with ID #$volunteerId successfully Re-Opened"));
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to re-open volunteer #$volunteerId --- $error", 0);
        $this->setMessage(array('danger', "Unable to Re-Open volunteer with ID #<b>$volunteerId</b>"));
        return false;
    }

    function get_member_packet_details($data){
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                CONCAT(store.owner_name,' ,',store.city) Store,
                vol1.volunteer_name Volunteer,
                DATE_FORMAT(pkt.delivery_timestamp, '%d/%m/%Y') DOB,
                DATE_FORMAT(pkt.delivery_timestamp, '%d/%m/%Y %H:%i') AddTime,
                pkt.user_id User
                FROM members_packets pkt
                LEFT JOIN volunteers_data vol1 ON vol1.volunteer_id  = pkt.volunteer_id
                LEFT JOIN store_stock store ON store.store_id = pkt.store_id
                WHERE pkt.member_id = :member_id;");
            $solution->execute(array(':member_id'=>$data));
        }else{
            $solution = $this->dbConn->prepare("SELECT
                mem1.member_id id,
                mem1.user_id user,
                blck.block_name block,
                dstrc.district_name district,
                dstrc.district_id district_id,
                vol1.volunteer_name volunteer,
                mem1.member_name name,
                mem1.member_father father,
                mem1.member_mobile mobile,
                DATE_FORMAT(mem1.doj, '%d/%m/%Y') joining,
                mem1.member_status packets
                FROM members_data mem1
                LEFT JOIN volunteers_data vol1 ON vol1.volunteer_id  = mem1.volunteer_id
                LEFT JOIN blocks_data blck ON blck.block_id  = mem1.block_id
                LEFT JOIN districts_data dstrc ON dstrc.district_id = blck.district_id
                WHERE (mem1.member_status $active 12) AND (blck.district_id IN (SELECT district_id FROM districts_data WHERE center_id = :center_id))
                LIMIT $start, 500;");
            $solution->execute(array(':center_id'=>$centerId));
        }
        if ($tickets = $solution->fetch(PDO::FETCH_ASSOC)) {
            return $tickets;
        }else{
            return false;
        }
    }

#################################################   Dashboard Data & Counters

    function dashboard_counters_data(){
        $today = date('Y-m-d');
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
            (SELECT SUM(TIMESTAMPDIFF(MONTH, doj, CURDATE())+1-member_status) FROM members_data WHERE member_status < 12 ) count1,
            (SELECT COUNT(*) FROM members_data WHERE (doj = '$today')) count3,
            (SELECT COUNT(*) FROM members_data WHERE member_status < 12) count4,
            (SELECT COUNT(*) FROM members_packets WHERE (delivery_date = '$today')) count2;
            ");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
            (SELECT SUM(TIMESTAMPDIFF(MONTH, doj, CURDATE())+1-member_status) FROM members_data WHERE (member_status < 12) AND (district_id IN (SELECT district_id FROM districts_data WHERE center_id = :center_id))) count1,
            (SELECT COUNT(*) FROM members_data WHERE (doj = '$today') AND (district_id IN (SELECT district_id FROM districts_data WHERE center_id = :center_id))) count3,
            (SELECT COUNT(*) FROM members_data WHERE (member_status < 12) AND (district_id IN (SELECT district_id FROM districts_data WHERE center_id = :center_id))) count4,
            (SELECT COUNT(*) FROM members_packets pkt LEFT JOIN members_data mem ON mem.member_id = pkt.member_id WHERE (pkt.delivery_date = '$today') AND (mem.district_id IN (SELECT district_id FROM districts_data WHERE center_id = :center_id))) count2;
            ");
            $solution->execute(array(':center_id'=>$centerId));
        }
        $count = $solution->fetch(PDO::FETCH_ASSOC);
        return $count;
    }

    function get_deliveries_array($lastHowMuch, $start=0){
        $lastHowMuch= (int) $lastHowMuch;
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                mem1.member_id id,
                mem1.member_name name,
                vol1.volunteer_name volunteer,
                mem1.member_status packets,
                DATE_FORMAT(pkt.delivery_date, '%d/%m/%Y') last_delivered,
                DATE_FORMAT(pkt.delivery_timestamp, '%d/%m/%Y %H:%i') last_updated
                FROM members_packets pkt
                LEFT JOIN volunteers_data vol1 ON vol1.volunteer_id  = pkt.volunteer_id
                LEFT JOIN members_data mem1 ON mem1.member_id  = pkt.member_id
                ORDER BY delivery_timestamp DESC
                LIMIT $start, $lastHowMuch;");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
                mem1.member_id id,
                mem1.member_name name,
                vol1.volunteer_name volunteer,
                mem1.member_status packets,
                DATE_FORMAT(pkt.delivery_date, '%d/%m/%Y') last_delivered,
                DATE_FORMAT(pkt.delivery_timestamp, '%d/%m/%Y %H:%i') last_updated
                FROM members_packets pkt
                LEFT JOIN volunteers_data vol1 ON vol1.volunteer_id  = pkt.volunteer_id
                LEFT JOIN members_data mem1 ON mem1.member_id  = pkt.member_id
                WHERE pkt.user_id IN (SELECT user_id FROM users_personal WHERE center_id = :center_id)
                ORDER BY delivery_timestamp DESC
                LIMIT $start, $lastHowMuch;");
            $solution->execute(array(':center_id'=>$centerId));
        }
        if ($deliveries = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $deliveries;
        }else{
            return false;
        }
    }

    function get_pending_deliveries_array($tillDate){// -ve value for previous and +ve for upcoming
        $lastHowMuch= (int) $lastHowMuch;
        $centerId = $this->centerId;
        if ($centerId == 1) {
            $solution = $this->dbConn->prepare("SELECT
                mem1.member_id id,
                mem1.district_id district_id,
                mem1.member_name name,
                mem1.member_mobile mobile,
                DATE_FORMAT(mem1.doj, '%d/%m/%Y') joined,
                mem1.member_status delivered,
                TIMESTAMPDIFF(MONTH, mem1.doj, '$tillDate') + 1 - mem1.member_status AS pending,
                vol1.volunteer_name volunteer,
                blck.block_name block
                FROM members_data mem1
                LEFT JOIN volunteers_data vol1 ON vol1.volunteer_id  = mem1.volunteer_id
                LEFT JOIN blocks_data blck ON blck.block_id  = mem1.block_id
                WHERE mem1.member_status < 12 AND mem1.doj < '$tillDate';");
            $solution->execute();
        }else{
            $solution = $this->dbConn->prepare("SELECT
                mem1.member_id id,
                mem1.district_id district_id,
                mem1.member_name name,
                mem1.member_mobile mobile,
                DATE_FORMAT(mem1.doj, '%d/%m/%Y') joined,
                mem1.member_status delivered,
                TIMESTAMPDIFF(MONTH, mem1.doj, '$tillDate') + 1 - mem1.member_status AS pending,
                vol1.volunteer_name volunteer,
                blck.block_name block
                FROM members_data mem1
                LEFT JOIN volunteers_data vol1 ON vol1.volunteer_id  = mem1.volunteer_id
                LEFT JOIN blocks_data blck ON blck.block_id  = mem1.block_id
                WHERE (mem1.member_status < 12) AND (mem1.doj < '$tillDate') AND (mem1.district_id IN (SELECT district_id FROM districts_data WHERE center_id = :center_id));");
            $solution->execute(array(':center_id'=>$centerId));
        }
        if ($deliveries = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $deliveries;
        }else{
            return false;
        }
    }

    function getContactOptions(){
        $solution = $this->dbConn->prepare("SELECT
                blck.block_name block,
                vol1.designation_role designation,
                vol1.volunteer_name name,
                vol1.volunteer_mobile mobile
                FROM volunteers_data vol1
                LEFT JOIN blocks_data blck ON blck.block_id  = vol1.block_id
            UNION
                SELECT
                'NA' as block,
                'User' as designation,
                per.user_name name,
                per.user_mobile mobile
                FROM users_personal per;");
        $solution->execute();
        if ($contacts = $solution->fetchAll(PDO::FETCH_ASSOC)) {
            return $contacts;
        }else{
            return false;
        }
    }

    function delete_data($table, $IDcolumn, $columnValue){
        $solution = $this->dbConn->prepare("DELETE FROM $table WHERE $IDcolumn = :id LIMIT 1;");
        if ($solution->execute(array(':id'=>$columnValue))) {
            $this->add_event_to_log('Deleted Partner #'.$partnerId, 1);
            $this->setMessage(array('success', "Partner with ID #<b>$partnerId</b> successfully Deleted"));
            return true;
        }
        $error = $solution->errorInfo()[2];
        $this->add_event_to_log("Unable to Delete Partner #$partnerId --- $error", 0);
        $this->setMessage(array('danger', "Unable to Delete Partner with ID #<b>$partnerId</b>"));
        return false;
    }

};
$functionL = new FunctionsL();