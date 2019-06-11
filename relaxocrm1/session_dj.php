<?php

class Session {
	static function getIpDetails($ip = ''){
		if (!$ip) {
			if ($_SESSION['IPaddress'] != $_SERVER['REMOTE_ADDR']) {
				return false;
			}else{
				$ip = $_SESSION['IPaddress'];
			}
		}
		$json       = file_get_contents("http://ipinfo.io/{$ip}");
        $ipdetails    = json_decode($json);
        $json       = file_get_contents("http://country.io/currency.json");
	    $currencydetails    = json_decode($json);
        $data =  array('city' => $ipdetails->city, 'country' => $ipdetails->country, 'currency' => $currencydetails->{$ipdetails->country});
        return $data;
	}

	static protected function preventHijacking() {
		if(!isset($_SESSION['IPaddress']) || !isset($_SESSION['userAgent'])) return false;
		if ($_SESSION['IPaddress'] != $_SERVER['REMOTE_ADDR']) return false;
		if( $_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT']) return false;
		return true;
	}

	static protected function regenerateSession() {
		if(isset($_SESSION['OBSOLETE']) && $_SESSION['OBSOLETE'] == true) return;   //// If this session is obsolete it means  there already is a new id ////
		$_SESSION['OBSOLETE'] = true; 			//// Set current session to expire in 10 seconds ////
		$_SESSION['EXPIRES'] = time() + 10;   	//// Create new session without destroying the old one ////
		session_regenerate_id(false); 	//// Grab current session ID and close both sessions to allow other scripts to use them ////
		$newSession = session_id();
		session_write_close(); 	 		//// Set session ID to the new one, and start it back up again ////
		session_id($newSession);
		session_start();
		unset($_SESSION['OBSOLETE']); 	//// Now we unset the obsolete and expiration values for the session we want to keep ////
		unset($_SESSION['EXPIRES']);
	}

	static protected function validateSession() {
		if( isset($_SESSION['OBSOLETE']) && !isset($_SESSION['EXPIRES']) ) 	return false;
		if(isset($_SESSION['EXPIRES']) && $_SESSION['EXPIRES'] < time()) return false;
		return true;
	}

	static function session_start_dj($name = SESSION_NAME, $limit = SESSION_COOKIE_TIME, $path = '/', $domain = '', $secure = HTTPS_SECURED) {
		if (ini_set('session.use_only_cookies', 1) === FALSE) {		 //// Forces sessions to only use cookies. ////
			echo '<script>window.location= "'.URL.'/error?Please enable browser cookies to use this application then reload page.";</script>';
	        exit;
		}
		session_name($name); 	 //// Set the cookie name ////
		$https = isset($secure) ? $secure : isset($_SERVER['HTTPS']); 	  //// Set SSL level ////
		session_set_cookie_params($limit, $path, $domain, $https, true);   //// Set session cookie options ////
		session_start();
		if(self::validateSession()) 	{ 	//// Make sure the session hasn't expired, and destroy it if it has ////
			if(!self::preventHijacking()) 		{ 	 //// Check to see if the session is new or a hijacking attempt ////
				$_SESSION = array(); 	  //// Reset session data and regenerate id ////
				$_SESSION['IPaddress'] = $_SERVER['REMOTE_ADDR'];
				$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
				self::regenerateSession();
			}elseif(mt_rand(1, 100) <= 5){ 		 //// Give a 5% chance of the session id changing on any request ////
				self::regenerateSession();
			}
		}else{
			$_SESSION = array();
			session_destroy();
			session_start();
		}
	}

	static function generateCaptcha(){
		$str = str_shuffle('ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789');
	    $captcha_code = substr($str, mt_rand(0,45), 5);
	    $captcha_backgrounds = array(
	   		URL.'/assets/captcha/backgrounds/45-degree-fabric.png',
	   	    URL.'/assets/captcha/backgrounds/cloth-alike.png',
	   	    URL.'/assets/captcha/backgrounds/grey-sandbag.png',
	   	    URL.'/assets/captcha/backgrounds/kinda-jean.png',
	   	    URL.'/assets/captcha/backgrounds/polyester-lite.png',
	   	    URL.'/assets/captcha/backgrounds/stitched-wool.png',
	   	    URL.'/assets/captcha/backgrounds/white-carbon.png',
	   	    URL.'/assets/captcha/backgrounds/white-wave.png'
	   	);
	    $captcha_fonts = array(
	   		URL.'/assets/captcha/fonts/times_new_yorker.ttf',
	   		URL.'/assets/captcha/fonts/KGHAPPYSolid.ttf',
	   		URL.'/assets/captcha/fonts/DubielItalic.ttf',
	   		URL.'/assets/captcha/fonts/KGHAPPY.ttf'
	   	);
	    $_SESSION['captcha_code'] = hash('sha512', $captcha_code);
	    session_write_close();
	    $background = $captcha_backgrounds[mt_rand(0, 7)];
	    list($bg_width, $bg_height, $bg_type, $bg_attr) = getimagesize($background);
	    $captcha = imagecreatefrompng($background);
	    $color = imagecolorallocate($captcha, 102, 102, 102);
	    $angle = mt_rand( 2, 8 );
	    $font = $captcha_fonts[mt_rand(0, 3)];
	    $font_size = 16;
	    $text_box_size = imagettfbbox($font_size, $angle, $font, $captcha_code);
	    $box_width = abs($text_box_size[6] - $text_box_size[2]);
	    $box_height = abs($text_box_size[5] - $text_box_size[1]);
	    $text_pos_x_min = 0;
	    $text_pos_x_max = ($bg_width) - ($box_width);
	    $text_pos_x = mt_rand($text_pos_x_min, $text_pos_x_max);
	    $text_pos_y_min = $box_height;
	    $text_pos_y_max = ($bg_height) - ($box_height / 2);
	    if ($text_pos_y_min > $text_pos_y_max) {   $temp_text_pos_y = $text_pos_y_min;
		    $text_pos_y_min = $text_pos_y_max;
		    $text_pos_y_max = $temp_text_pos_y;
	    }
	    $text_pos_y = mt_rand($text_pos_y_min, $text_pos_y_max);
	    $shadow_color = imagecolorallocate($captcha, 255, 255, 255);
	    imagettftext($captcha, $font_size, $angle, $text_pos_x + 2, $text_pos_y + 2, $shadow_color, $font, $captcha_code);
	    imagettftext($captcha, $font_size, $angle, $text_pos_x, $text_pos_y, $color, $font, $captcha_code);
	    header("Content-type: image/png");
	    imagepng($captcha);
	}
};

Session::session_start_dj();