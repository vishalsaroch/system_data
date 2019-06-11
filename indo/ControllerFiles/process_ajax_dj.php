<?php
$ajax  = $_POST['ajax'];
unset($_POST['ajax']);

if ($ajax  == 'load-more') {                     ////  Load More Product Process ////
    $start = (int) filter_data($_POST['start']);
    $products = $function->getArray_recommondedProducts($start, 16);
    if (!$products) {
        echo 'no-more';
        exit;
    }
    foreach ($products as $product) {
        $imgSrc = $product['imgUrl'] ?  $product['imgUrl'] : '/assets/images/products/'.$product['sku'].'-'.$product['permalink'].'.png';
        $badge = $product['badge'] ? '<span class="label-tags"><span class="label label-default arrowed-right">Sale</span></span>' : '';
        echo '
            <div class="col-xs-6 col-sm-4 col-lg-3 box-product-outer">
                <div data-skuId="'.$product['sku'].'" data-catId="'.$product['catId'].'" class="box-product">
                  <div class="img-wrapper" title="'.$product['brand'].'">
                    <img alt="Product" src="/assets/images/icon.png" data-src="'.$imgSrc.'">
                    <noscript><img alt="Product" src="'.$imgSrc.'"></noscript>
                    <div class="tags tags-left">
                        '.$badge.'
                    </div>
                  </div>
                  <h6 title="'.$product['title'].'">'.$product['title'].'</h6>
                  <div class="price">
                    <div class="currency-sign">'.$product['price'].' <span class="label-tags">
                    <span class="label label-default">'.$product['discount'].'%</span></span></div>
                    <span class="price-old currency-sign">'.round($product['price']/(1 - $product['discount']/100), 2).'</span>
                  </div>
                </div>
            </div>
        ';
    }
    exit;
}elseif ($ajax  == 'sendPodOTP'){
    $alternate_contact =  $_SESSION['alternate_contact'];
    $otp = substr(str_shuffle('1234567890'), 3, 4);
    include MODEL_DIRECTORY.'/sms_dj.php';
    $response = sendPodOTP($alternate_contact, $otp)['return'];
    if ($response) {
        $_SESSION['OTP'] = $otp;
        echo "true";
    }else{
        echo "false";
    }
    exit;
}elseif ($ajax  == 'productDetail') {                     ////  Product Detail Process ////
    $catId = (int) filter_data($_POST['catId']);
    $sku = (int) filter_data($_POST['skuId']);

    $product = $function->getArray_productDetailBySku($sku);
    if (!$product) {
        echo json_encode(array('status'=>'error'));
        exit;
    }
    $product['imgUrl'] = $product['imgUrl'] ? $product['imgUrl'] : '/assets/images/products/'.$sku.'-'.$product['permalink'].'.png';
    $product['altImages'] = array();
    $product['status'] = 'success';
    echo json_encode($product);
    exit;
}elseif ($ajax  == 'add-cart') {						////  Add to cart Process ////
	$sku = (int) filter_data($_POST['product']);
    $qty = (int) filter_data($_POST['quantity']);
    $product = $function->getArray_productBySku($sku);
    $imgSrc = $product['imgUrl'] ?  $product['imgUrl'] : '/assets/images/product/'.$product['sku'].'-'.$product['permalink'].'.png';
    if (! $product) {
        echo 'false';
        exit;
    }
    if (isset($_SESSION['CART'])) {
        $isAlreadyInCart = array_key_exists($product['sku'], $_SESSION['CART']);
        if ($isAlreadyInCart) {
            if (PER_PRODUCT_DELIVERY_CHARGES) {
                $_SESSION['CART'][$product['sku']]['deliveryCharges'] = $_SESSION['CART'][$product['sku']]['deliveryCharges'] + ($_SESSION['CART'][$product['sku']]['deliveryCharges'] * $qty / $_SESSION['CART'][$product['sku']]['qty']);
                $_SESSION['CART'][$product['sku']]['qty'] += $qty;
                $_SESSION['CART'][$product['sku']]['totalAmount'] = $_SESSION['CART'][$product['sku']]['qty'] * $product['price'];
            }else{
                $_SESSION['CART'][$product['sku']]['qty'] += $qty;
                $_SESSION['CART'][$product['sku']]['totalAmount'] = $_SESSION['CART'][$product['sku']]['qty'] * $product['price'];
            }

        }else{
            $_SESSION['CART'][$product['sku']] = array(
                'center' => $product['center'],
                'brand' => $product['brand'],
                'deliveryDays' => $product['deliveryDays'],
                'title' => $product['title'],
                'permalink' => $product['permalink'],
                'catId' => $product['catId'],
                'catPermalink' => $product['catPermalink'],
                'price' => $product['price'],
                'imgSrc' => $imgSrc,
                'deliveryCharges' => $product['deliveryCharges'],
                'qty' => $qty,
                'totalAmount' => (float) $product['price']*$qty
            );
            if (PER_PRODUCT_DELIVERY_CHARGES) {
                $_SESSION['CART'][$product['sku']]['deliveryCharges'] = $_SESSION['CART'][$product['sku']]['deliveryCharges'] * $qty;
            }
        }
    }else{
        $_SESSION['CART'] = array(
            $product['sku'] => array(
                'center' => $product['center'],
                'brand' => $product['brand'],
                'deliveryDays' => $product['deliveryDays'],
                'title' => $product['title'],
                'permalink' => $product['permalink'],
                'catId' => $product['catId'],
                'catPermalink' => $product['catPermalink'],
                'price' => $product['price'],
                'imgSrc' => $imgSrc,
                'deliveryCharges' => $product['deliveryCharges'],
                'qty' => $qty,
                'totalAmount' => (float) $product['price']*$qty
            )
        );
    }
    exit;
}elseif ($ajax  == 'main-search') {                        ////  Add to cart Process ////
    $qstring = filter_data($_POST['phrase']);
    $result = $function->getArray_searchResults($qstring);
    if (count($result) < 1) {
        echo '[{"name":"No Result Found for <b>'.$qstring.'</b>","url":"#"}]';
        exit;
    }
    echo json_encode($result);
    exit;
}elseif ($ajax  == 'update-cart') {                        ////  Add to cart Process ////
    $sku = (int) filter_data($_POST['product']);
    $qty = (int) filter_data($_POST['quantity']);
    if (isset($_SESSION['CART'][$sku])) {
        if (PER_PRODUCT_DELIVERY_CHARGES) {
            $_SESSION['CART'][$sku]['deliveryCharges'] = ($_SESSION['CART'][$sku]['deliveryCharges']/$_SESSION['CART'][$sku]['qty'])*$qty;
        }
        $_SESSION['CART'][$sku]['totalAmount'] = ($_SESSION['CART'][$sku]['totalAmount']/$_SESSION['CART'][$sku]['qty'])*$qty;
        $_SESSION['CART'][$sku]['qty'] = $qty;
        echo "true";
    }else{
        echo "false";
    }
    exit;
}elseif ($ajax  == 'remove-cart') {                     ////  Add to cart Process ////
    $sku = (int) filter_data($_POST['product']);
    if (isset($_SESSION['CART'][$sku])) {
        unset($_SESSION['CART'][$sku]);
        echo "true";
    }else{
        echo 'false';
    }
    exit;
}elseif ($ajax  == 'remove-address') {                     ////  Add to cart Process ////
    $addressId = (int) str_replace($_SESSION['SESS__user_id'],"",$_POST['address']);
    if ($ajaxF->deleteData_userAddress($addressId)) {
        echo "true";
    }else{
        echo 'false';
    }
    exit;
}elseif ($ajax  == 'newsletter') {				////  subscribe newsletter Process ////
	$email = filter_data($_POST['email']);
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    	echo 'Invalid Email';
        exit;
    }
    if ($ajaxF->insert_newsLetter($email)) {
        echo 'Subscribed';
        exit;
    } else {
        if (preg_match("/We have already/", $_SESSION['MSG'][1])) {
            echo 'Already In';
            exit;
        }
    	echo 'Failed';
        exit;
    }
}
echo 'Something Wrong';
exit;