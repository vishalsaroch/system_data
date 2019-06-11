<?php

CLASS ajaxProcess extends Connection{

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
                $this->setMessage(array('success', "Customer & Product successfully registered <a href='/BestWebs?module=warranty&mode=add&type=$productData[customer_id]&customer=$productData[customer_id]' target='_blank'> Add More Product</a> or <a href='/BestWebs?module=ticket&mode=add&type=new&customer=$productData[customer_id]' target='_blank'> Click Here to add Ticket/Complaint</a>"));
                $this->logEvent('customers,customers_products', array_merge($productData, $customerData), 1);
                return array('crn'=>$productData['customer_id'], 'cpid'=>$id);
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
};
$ajaxF = new ajaxProcess();