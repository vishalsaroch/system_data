<?php
###########################################################################################
########################   DEVELOPMENT CUSTOMIZABLE   #####################################
######################################################################################

error_reporting(-1);			                                  //// Set it to 0 to no error report ////

define('URL', 'http://www.indocrm.space');
define('LOGIN_URL', 'http://www.indocrm.space/login');
define('CLIENT_TITLE', 'Indo Hightech');
define('CLIENT_SHORT_NAME', 'IH');

define('CLIENT_COMPANY', 'Indo Hightech Pvt Ltd');
define('CLIENT_TAGLINE', 'touching tomorrow ...');

define('CDN_ADMIN', 'http://www.indocrm.space/assets/admin');       //// No trailing edge slash ////
define('CDN_JS', 'http://www.indocrm.space/assets/js');             //// No trailing edge slash ////
define('CDN_CSS', 'http://www.indocrm.space/assets/css');           //// No trailing edge slash ////
define('MODEL_DIRECTORY', 'ModelFiles');                      //// No trailing edge slash ////
define('VIEW_DIRECTORY', 'ViewFiles');                           //// No trailing edge slash ////
define('CONTROLLER_DIRECTORY', 'ControllerFiles');            //// No trailing edge slash ////

define('TABLE_PREFIX', 'dj_');
define('COLUMN_PREFIX', 'ul_');

define('SMS_API_USERNAME', 'weindia');
define('SMS_API_PASSWORD', 'kkelectro143');
define('SMS_API_SENDERiD', 'INDOHT');

define('IS_WALLET', true);
define('IS_WALLET_PASSWORD', true);
define('IS_MULTIVENDOR', true);

//// Set Message to $_SESSION['MSG'] =  array("noty", "center", "error", "message content") or  array("jGrowl", "center", "bg-green", "message content"); ////
define('SESSION_TIMEOUT_IN', '6000');                  //// Session Timeout time in seconds, if user inactive ////
define('SESSION_NAME', 'eIdcNxiwcUbEibwC');           //// Name of created  Session ////
define('SESSION_COOKIE_TIME', 1086400);                 //// Session Cookie expiry time ////
define('HTTPS_SECURED', null);                        //// SSL Domain ////

define('PHONE_COUNTRY_CODE', '+91');


function filter_data($var){
  $var = trim(strip_tags($var));
  $var = preg_replace('|[^a-zA-Z0-9 -_@.#, ]|i', '', $var);
  return $var;
}

/*
	function get_error($errno, $errstr, $errfile, $errrline){
		echo   '<script type="text/javascript">
					$(function(){
						noty({
							text:"Error : '.$errstr.' in '.$errfile.' on line '.$errrline.'",
							type:"error",
							dismissQueue:!0,
							theme:"_100lutionUI",
							layout:"top"
						}), !1
					});
				</script>';
	}
	set_error_handler("get_error");
*/

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
    define('ADMIN_PART', 0.05); ## DEFAULT IS CATEGORY_WISE
    define('FC_PART', 0.25);
	define('BTC_PART', 0.70);
	define('TAX3', 'SGST');
	define('SURCHARGE1', 'SB_cess');
	define('SURCHARGE2', 'KK_cess');
	define('SURCHARGE3', 'GST');

	define('SUPPORT_PHONE', '8888888888');
	define('SUPPORT_EMAIL', 'support@indocrm.space');

	define('COMPLAINT_PHONE', '8888888888');
	define('COMPLAINT_EMAIL', 'care@indocrm.space');

	define('CONTACT_PHONE', '8888888888');
	define('CONTACT_EMAIL', 'info@indocrm.space');

	define('CORPORATE_ADDRESS_LINE1', 'Future TradeZone,');
	define('CORPORATE_ADDRESS_LINE2', '401 Federal Street,');
	define('CORPORATE_ADDRESS_LINE3', 'Suite 4 Dover DE - 19901');
	define('CORPORATE_ADDRESS_MAP', '#');

	define('BUSINESS_ADDRESS_LINE1', '');
	define('BUSINESS_ADDRESS_LINE2', '');
	define('BUSINESS_ADDRESS_LINE3', '');


	define('BTC_ADDRESS', '1PmoAefNSgTayXKUGJEMa69Nqa2AsYiKZR');
	define('FACEBOOK_LINK', '#');
	define('GOOGLE_LINK', '#');
	define('YOUTUBE_LINK', '#');
	define('LINKEDIN_LINK', '#');
	define('TWITTER_LINK', '#');
	define('WHATSAPP_LINK', '#');

	define('EXTERNALLY_HOSTED_IMAGE', false);

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