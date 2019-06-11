<?php

if (!isset($_POST['adminProcess']) || !($level = $function->checkLogin())) {
	header('Location: '.LOGIN_URL);
	exit;
}
echo '
	<noscript>
	    <style type="text/css">
	         .process{display:none;}
	         .noscriptmsg {min-width: 300px ;margin: 200px auto;}
	    </style>
	    <div class="noscriptmsg font-red">
	    	<center>
	    		<b>
	    			<br>You don\'t have javascript enabled, Please enable to Use and then re-submit your form<br>
	    			Here are the <a href="http://www.enable-javascript.com/" target="_blank"> instructions how to enable it</a>
    			</b>
    		</center>
	    </div>
	</noscript>
	<script>
		window.history.pushState("", "Validating data by BestWebs-hash-validation...", "/BestWebs-hash/validation.html");
	</script>
	<div class="process">
	<center><img style="margin-top:0px;" src="/assets/Images/loader.gif" alt="Validating ..."></center>
';

$process  = $_POST['adminProcess'];
$referer = htmlentities($_SERVER['HTTP_REFERER']);
if ($process  === 'uploadExcel') {					////  Excel upload  Process ////
    if(isset($_FILES["uploadExcel"])) {
        $excelFile = $_FILES["uploadExcel"]["tmp_name"];
        $function->insertData_productExcel($excelFile);
        exit;
    }
	$username = filter_data($_POST['username']);
    if (($username < 7000000012) || ($username > 9999999987)) {
    	$_SESSION['MSG'] = array("noty", "center", "error", "<i class='glyph-icon icon-child mrg5R'></i> Sorry, We don't recognize You.");
    	echo '<script>window.location = "/index.html?login='.$username.'#Error"</script>';
    	exit;
    }elseif ($function->get__Login($username)) {
        echo '<script>window.location = "/account.html"</script>';
        exit;
    } else {
    	echo '<script>window.location = "/index.html?login='.$username.'#Error"</script>';
        exit;
    }
}elseif ($process  === 'addBrand') {                ////  Password verify Process ////
    $details = array();
    foreach ($_POST['product'] as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
    }
    $details['permalink'] = strtolower(preg_replace('|[^a-zA-Z0-9]|i', '-', $details['title']));
    if ($function->insertData_newBrand($details)) {
        echo '<script>window.location = "/shoppo-admin?module=product&mode=add-brand&type=new"</script>';
        exit;
    } else {
        echo '<script>window.location = "/shoppo-admin?module=product&mode=add-brand&type=new"</script>';
        exit;
    }
}elseif ($process  === 'addMaster') {               ////  Password verify Process ////
    $details = array();
    foreach ($_POST['master'] as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
        if (! $details[$key]) unset($details[$key]);
    }
    $details['permalink'] = strtolower(preg_replace('|[^a-zA-Z0-9]|i', '-', $details['title']));
    if ($sku = $function->insertData_newMaster($details)) {
        include 'ModelIncludes/uploads_dj.php';
        uploadPic($_FILES['productImage'], $sku.'-'.$details['permalink'], 'assets/Images/Products/', true);
        echo '<script>window.location = "/shoppo-admin?module=product&mode=add-master&type=new"</script>';
        exit;
    } else {
        echo '<script>window.location = "/shoppo-admin?module=product&mode=add-master&type=new"</script>';
        exit;
    }
}elseif ($process  === 'addProduct') {               ////  Password verify Process ////
    $details = array();
    foreach ($_POST['product'] as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
        if (! $details[$key]) unset($details[$key]);
    }
    $details['price_sale_center'] = $details['price_sale_center'] - ($details['price_sale_center']*$details['price_discount_center']/100);
    $details['price_sale_client'] = $details['price_sale_client'] - ($details['price_sale_client']*$details['price_discount_client']/100);
    if ($sku = $function->insertData_newProduct($details) === true) {
        echo '<script>window.location = "/shoppo-admin?module=product&mode=add&type=new"</script>';
        exit;
    } else {
        echo '<script>window.location = "/shoppo-admin?module=product&mode=add&type=new"</script>';
        exit;
    }
}elseif ($process  === 'addCategory') {               ////  Password verify Process ////
    $details = array();
    foreach ($_POST['category'] as $key => $value) {
        $details[filter_data($key)] = filter_data($value);
        if (! $details[$key]) unset($details[$key]);
    }
    $details['permalink'] = strtolower(preg_replace('|[^a-zA-Z0-9]|i', '-', $details['title']));
    $details['meta_json_array'] = '{"title":"Category","keywords":"shopping, online, ecommerce","description":"Shoppo is a platform for everything for your household","slider":[{"imgSrc":"slider1.png","href":"\/product\/1\/1\/Malai-kofta\/cheesy-way-item","title":"Irresistibly Smooth & Flawless Dish","subtitle":"The One","text":"Primer blurs the appearance of pores for a flawless-looking bas, helps to enhance complexion","button":"Shop Now"},{"imgSrc":"slider1.png","href":"\/product\/1\/1\/Malai-kofta\/cheesy-way-item","title":"Irresistibly Smooth & Flawless Dish","subtitle":"The Two","text":"Primer blurs the appearance of pores for a flawless-looking bas, helps to enhance complexion","button":"Shop Now"},{"imgSrc":"slider1.png","href":"\/product\/1\/1\/Malai-kofta\/cheesy-way-item","title":"Irresistibly Smooth & Flawless Dish","subtitle":"The Three","text":"Primer blurs the appearance of pores for a flawless-looking bas, helps to enhance complexion","button":"Shop Now"}],"other":{"top-categories":[{"imgSrc":"slider1.png","href":"\/product\/1\/1\/Malai-kofta\/cheesy-way-item","title":"Irresistibly Smooth & Flawless Dish","subtitle":"The One","text":"medium","button":"Shop Now"},{"imgSrc":"slider1.png","href":"\/product\/1\/1\/Malai-kofta\/cheesy-way-item","title":"Irresistibly Smooth & Flawless Dish","subtitle":"The Two","text":"medium","button":"Shop Now"},{"imgSrc":"slider1.png","href":"\/product\/1\/1\/Malai-kofta\/cheesy-way-item","title":"Irresistibly Smooth & Flawless Dish","subtitle":"The Three","text":"small","button":"Shop Now"},{"imgSrc":"slider1.png","href":"\/product\/1\/1\/Malai-kofta\/cheesy-way-item","title":"Irresistibly Smooth & Flawless Dish","subtitle":"The Three","text":"small","button":"Shop Now"},{"imgSrc":"slider1.png","href":"\/product\/1\/1\/Malai-kofta\/cheesy-way-item","title":"Irresistibly Smooth & Flawless Dish","subtitle":"The Three","text":"small","button":"Shop Now"}],"banner":{"imgSrc":"banner.png","href":"\/login","title":"Buy every Household thing on single click","subtitle":"Join Shoppo","text":"","button":"Register"},"trending":"1,2,3,4,5,6,7,8,9,10"}}';
    if ($sku = $function->insertData_newCategory($details)) {
        include 'ModelIncludes/uploads_dj.php';
        uploadPic($_FILES['categoryImage'], $details['permalink'], 'assets/Images/Category/');
        echo '<script>window.location = "/shoppo-admin?module=categories&mode=add&type=new"</script>';
        exit;
    } else {
        echo '<script>window.location = "/shoppo-admin?module=categories&mode=add&type=new"</script>';
        exit;
    }
}

echo "<pre>";
print_r($_SESSION);
print_r($_POST);
exit;

$function->logOut();
echo '<script>window.location = "'.URL.'"</script>';
exit;