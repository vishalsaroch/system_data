<?php
###########################################################################################
########################   DEVELOPMENT CUSTOMIZABLE   #####################################
###########################################################################################
#
#
#	  MAKE ARRAY OF TABLE NAME AND COLUMN NAME as key and Their familiar value as value
#     and use that as mySql error output to show correctly error to user
#
#
#
############################################################################################

error_reporting(0);			                                  //// Set it to 0 to no error report ////
define('IS_DEVELOPMENT', false);

define('IS_TICKET_OTP', false);

define('URL', 'http://www.relaxocrm.space');
define('LOGIN_URL', 'http://www.relaxoappliances.com');
define('CLIENT_TITLE', 'Relaxo');
define('CLIENT_SHORT_NAME', 'RH');

define('CLIENT_COMPANY', 'V Concern Home Appliances');
define('CLIENT_TAGLINE', 'Get your stuff friendly');

define('CDN_ADMIN', 'http://www.relaxocrm.space/assets/admin');       //// No trailing edge slash ////
define('CDN_JS', 'http://www.relaxocrm.space/assets/js');             //// No trailing edge slash ////
define('CDN_CSS', 'http://www.relaxocrm.space/assets/css');           //// No trailing edge slash ////
define('MODEL_DIRECTORY', 'ModelIncludes');                      //// No trailing edge slash ////
define('VIEW_DIRECTORY', 'ViewPages');                           //// No trailing edge slash ////
define('CONTROLLER_DIRECTORY', 'ControllerIncludes');            //// No trailing edge slash ////
define('PRODUCT_IMAGE_DIRECTORY', 'assets/images/products/');            //// No trailing edge slash ////

define('TABLE_PREFIX', 'dj_');
define('COLUMN_PREFIX', 'ul_');

define('SMS_API_USERNAME', 'relaxo');
define('SMS_API_PASSWORD', '6693');
define('SMS_API_SENDERiD', 'OXALER');
define('SMS_API_SENDERiD2', 'OXALER');

define('IS_WALLET', true);
define('IS_WALLET_PASSWORD', true);
define('IS_MULTIVENDOR', true);

//// Set Message to $_SESSION['MSG'] =  array("noty", "center", "error", "message content") or  array("jGrowl", "center", "bg-green", "message content"); ////
define('SESSION_TIMEOUT_IN', '600');                  //// Session Timeout time in seconds, if user inactive ////
define('SESSION_NAME', 'eIdcNxiwcUbEibwC');           //// Name of created  Session ////
define('SESSION_COOKIE_TIME', 1086400);                 //// Session Cookie expiry time ////
define('HTTPS_SECURED', null);                        //// SSL Domain ////

define('PHONE_COUNTRY_CODE', '+91');

$GET_ARRAY = [
	'miscall'=>'msc.ul_number',
	'category'=>'prd.ul_category',
	'brand'=>'prd.ul_brand',
	'center'=>'cen.ul_center_id',
	'feedback-user'=>'fdb.ul_user_id',
	'user'=>'per.ul_user_id',
	'complaint-date'=>'com.ul_timestamp',
	'complaint'=>'com.ul_complaint_id',
	'ticket'=>'com.ul_complaint_id',
	'complaint-status'=>'com.ul_status',
	'customer'=>'cus.ul_customer_id',
	'customer-mobile'=>'cus.ul_mobile',
	'crn'=>'cus.ul_customer_id',
	'registration-date'=>'cusPrd.ul_timestamp',
	'warranty-status'=>'cusPrd.ul_warranty_status',
	'purchased-from'=>'cusPrd.ul_purchased_from',
	'dealer'=>'cusPrd.ul_dealer',
	'dealer-pin'=>'cusPrd.ul_dealer_pin',
	'product'=>'prd.ul_product_id',
	'spare'=>'spr.ul_spare_id'
];
#	  INDEX 	  MODULE 			 PERMISSION
// 		1		spare-store				view
// 		2		spare-store				add
// 		3		spare-store				edit
// 		4		product-store			view
// 		5		product-store			add
// 		6		product-store			edit
// 		7		sales/order				view
// 		8		sales/order				add
// 		9		sales/order				edit
// 		10		shipping/order-out		view
// 		11		shipping/order-out		add
// 		12		shipping/order-out		edit
// 		13		hr						view
// 		14		hr						add
// 		15		hr						edit
// 		16		accounts				view
// 		17		accounts				add
// 		18		accounts				edit
//		19		Product Register   		view
//		20		Product Register   		add
//		21		Product Register   		edit
//		22		Tickets      			view
//		23		Tickets      			add
//		24		Tickets      			edit
//		25		Feedback      			view
//		26		Feedback      			add
//		27		Feedback      			edit
// 		28		masters					view
// 		29		masters					add
// 		30		masters					edit
// 		31		user					view + add + edit
// 		32		logs					view
// 		33		planning				view
// 		34		center-spare-store		view
// 		35		center-spare-store		add
// 		36		center-spare-store		edit
// 		37		center-user				view + add + edit
//		38		Jobs         			view
//		39		Jobs         			add
//		40		Jobs         			edit
//
//	EXAMPLE Permission for ADMIN -       1111111111111111111111111111111111111111
//	EXAMPLE Permission for Center USer - 0000000000000000000000000000000000000110


$levels = array(
	1 =>'Technician',
	2 =>'Center Operator',
	3 =>'Center Head',
	4 =>'State Head',
	5 =>'Service Associate',
	6 =>'Store Associate',
	7 =>'Sales Associate',
	8 =>'Manager',
	9 =>'Admin'
);

function filter_data($var){
  // $var = strip_tags($var);
  // $var = preg_replace('|[^a-zA-Z0-9 -_@.#, ]|i', '', $var);
	$var = htmlentities(trim($var));
	$var = strip_tags($var);
  return $var;
}

/*
    CLIENT              -->      Our Client to which we wants to sale our web application
    PARTNERS            -->      Partner of client with them they wants to work as same as them
    PARTNERS CENTERS    -->      Vendors/Centers of Parters or clients
    USERS
    Page name must be file name
*/

###################################################################################################################################################
########################   CLIENT CUSTOMIZABLE   ##################################################################################################
# UNCOMMENT ALL BELOW IF DONT WANT TO GOT THESE VALUES FROM DATABASE and COMMENT RELAVENT VALUES CONNECTION construct CLASS

#/*
    define('CLIENT_TAX', '0.18'); // % Applied for CLIENT Transactions and Charges
    define('PRODUCT_WISE_TAX', false); ## DEFAULT IS CATEGORY_WISE
    define('THRESHOLD_KM', '20');

    define('TAX1', 'IGST');
	define('TAX2', 'CGST');
	define('TAX3', 'SGST');
	define('SURCHARGE1', 'SB_cess');
	define('SURCHARGE2', 'KK_cess');
	define('SURCHARGE1_VALUE', '0.00');
	define('SURCHARGE2_VALUE', '0.00');
	define('PER_PRODUCT_DELIVERY_CHARGES', true); // Set False if wants for per Order

	define('PRODUCT_REPLACEMENT_TEXT', 'Seller Will accept Replacement/Return of this Product Within 15 Days from the Date of Delivery');
	define('PRODUCT_PAYMENT_TITLE', 'At Awesome Discounted Price, Inclusive of All Taxes');
	define('WARRANTY_TEXT', 'Manufacturer Warranty');

	define('LOG_EVENTS', true);



	define('SUPPORT_PHONE', '9718181389');
	define('SUPPORT_EMAIL', 'support@relaxocrm.space');

	define('COMPLAINT_PHONE', '08030636403');
	define('COMPLAINT_EMAIL', 'service@relaxoappliances.com');

	define('CONTACT_PHONE', '9718181389');
	define('CONTACT_EMAIL', 'info@relaxocrm.space');

	define('CORPORATE_ADDRESS_LINE1', 'New Delhi,');
	define('CORPORATE_ADDRESS_LINE2', 'New Delhi,');
	define('CORPORATE_ADDRESS_LINE3', 'New Delhi');
	define('CORPORATE_ADDRESS_MAP', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.4809851317127!2d77.34265261508294!3d28.645313582412733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfad0f1c70f19%3A0x515e35db33c4332b!2sBags+N+More!5e0!3m2!1sen!2sin!4v1503728141255');

	define('BUSINESS_ADDRESS_LINE1', 'New Delhi,');
	define('BUSINESS_ADDRESS_LINE2', 'New Delhi,');
	define('BUSINESS_ADDRESS_LINE3', 'New Delhi');


	define('FACEBOOK_LINK', 'https://www.facebook.com/relaxocrm');
	define('GOOGLE_LINK', 'https://www.facebook.com/relaxocrm');
	define('YOUTUBE_LINK', 'https://www.youtube.com/relaxocrm');
	define('LINKEDIN_LINK', 'https://in.linkedin.com/relaxocrm');
	define('TWITTER_LINK', 'https://www.twitter.com/relaxocrm');
	define('WHATSAPP_LINK', 'whatsapp://send?text=http://www.relaxocrm.space');

	define('EXTERNALLY_HOSTED_IMAGE', true);

	define('LOADER_STYLE', 'loader1.gif');
	define('IS_TRANSITIONS', false);
	define('IS_ANIMATIONS', false);
	define('IS_FORGOT_CAPTCHA', false);
	define('IS_LOGIN_CAPTCHA', false);
	define('IS_REGISTER_CAPTCHA', false);
	define('IS_CHECKOUT_CAPTCHA', false);
	define('IS_CONTACT_CAPTCHA', false);
	define('IS_SMS', false);
	define('IS_SMS_OTP', false);
	define('IS_EMAILS', false);
	define('IS_EMAIL_VERIFY', false);
	define('TRACK_USER_IP', true);  ////  Supports only IPV4 ////

	define('ADSENSE_1', '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <!-- fliptoearn --> <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6211044082670489" data-ad-slot="8918968259"  data-ad-format="auto"></ins> <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>');                        ////   SMALL   ////
	define('ADSENSE_2', '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <!-- fliptoearn --> <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6211044082670489" data-ad-slot="8918968259"  data-ad-format="auto"></ins> <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>');                        ////   MEDIUM   ////
	define('ADSENSE_3', '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <!-- fliptoearn --> <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6211044082670489" data-ad-slot="8918968259"  data-ad-format="auto"></ins> <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>');                        ////   LARGE   /////
#*/