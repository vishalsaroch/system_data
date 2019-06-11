<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( !defined('ENVATO_HOSTED_SITE') ) {
include_once( get_template_directory() . '/inc/class-cerberus-notices.php' );
class osetin_cerberus 
{

  const SEC_IN_DAY = 86400;

  function __construct(){
    $this->checked_theme_name   = get_option( 'cerberus_checked_theme_name');
    $this->license_key          = get_option('options_license_key');            
    $this->last_checked_date    = get_option('cerberus_last_checked_date');       
    $this->last_domain_checked  = $_SERVER['SERVER_NAME'];

    if( !$this->last_cheked_date() && function_exists('acf_add_options_page')){
      \osetin\cerberus\Notices::add_notice('theme_license_deactivate');
    }

    add_action( 'after_setup_theme', array($this,'checked_token'), 50);      
  }    

  function __get($name){
    if ($name == 'checked_token'){
      return get_option('cerberus_checked_token');
    }
  }

  function checked_token($value){

    if( is_array($value) ){
      $str = '';
      ksort($value);   
      foreach($value as $param){
        $str .= $param;
      }
      return md5($str);
    }else{
      return md5($value);
    }
  }
    

    
  function update_available(){
    
  }
  

  function license_key($purchase_code) {
    if(empty($purchase_code)) return ;
    $last_status = array(
      'time'    => time(),
      'status'  => '-',
      'message' => '-'
    );
    // connect
    $post = array(
      '_nonce'                  => wp_create_nonce('activate_licence'),
      'theme_unique_name'       => OSETIN_THEME_UNIQUE_ID,
      'purchase_code'           => $purchase_code, 
      'domain'                  => $_SERVER['SERVER_NAME'],
      'user_ip_activated_from'  => $this->get_user_ip(),
    );

    $url = "https://pinsupreme.com/cerberus/verify";

    $args = array(
      'method' => 'POST',
      'timeout' => 45,
      'redirection' => 5,
      'httpversion' => '1.0',
      'blocking' => true,
      'headers' => array(),
      'body' => $post,
      'cookies' => array(),
      'sslverify ' => true
    );
   
    $request = wp_remote_post( $url,array('body' => $post, 'sslverify ' => false));
    
    if( !is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200){ 
      $response = json_decode($request['body'], true);
      if(empty($response['status'])){
        \osetin\cerberus\Notices::add_notice('theme_license_connection_error');
        $last_status['status'] = '000';
        $last_status['message'] = '<b>Connection Error. Please try again in a few minutes or contact us via email activation@pinsupreme.com</b>';
        update_option( 'cerberus_last_status', json_encode($last_status));
        return;
      }
    }else{
      \osetin\cerberus\Notices::add_notice('theme_license_connection_error');
      $last_status['status'] = '001';
      $last_status['message'] = '<b>Connection Error. Please try again in a few minutes or contact us via email activation@pinsupreme.com</b>';
      update_option( 'cerberus_last_status', json_encode($last_status));
      return;
    }
    update_option( 'cerberus_last_connection', time(), 'yes');
    // show message
    if( $response['status'] == 200){

      update_option( 'cerberus_checked_theme_name', OSETIN_THEME_UNIQUE_ID);
      update_option( 'cerberus_checked_token', $response['token']);              
      update_option( 'options_license_key', $purchase_code);
      update_option( '_options_license_key', 'field_wp4fd22efb524');
      if (update_option( 'cerberus_last_checked_date', $response['timestamp'])){
        $this->last_checked_date = $response['timestamp'];
      }
      \osetin\cerberus\Notices::add_notice('theme_license_activate');
    }elseif( $response['status'] == 422){
      \osetin\cerberus\Notices::add_notice('theme_license_status_422');
    }      
    $last_status['status'] = $response['status'];
    $last_status['message'] = $response['message'];      
    update_option( 'cerberus_last_status', json_encode($last_status));
  }

  function delete_license_key(){ 
    delete_option('cerberus_checked_theme_name');
    delete_option('cerberus_checked_token');
    delete_option('cerberus_last_domain_checked');
    delete_option('cerberus_last_checked_date');
    delete_option('cerberus_last_connection');
    delete_option( 'options_license_key');
    delete_option( '_options_license_key');
    delete_option( 'cerberus_last_status');
    \osetin\cerberus\Notices::add_notice('theme_license_deactivate');
    
    return true;

  }
    
  function is_cerberus_active(){
    if ($this->last_cheked_date() === true ){
      return true;
    }elseif($this->last_cheked_date() == '<b>Connection Error</b>'){
      return true;
    }else{
      return false;
    }
  }
  

  function last_cheked_date(){
    $expiration = 7;
    
    $day_passed = (time() - $this->last_checked_date)/self::SEC_IN_DAY;

    if($day_passed <= $expiration){
      return true;
    }

    if($day_passed >= $expiration + 50){
      return false;
    }

    $last_time_conn = get_option('cerberus_last_connection');
    
    if(!$last_time_conn || $last_time_conn < $this->last_checked_date){
      $this->license_key($this->license_key);
    }else{
      $last_day_conn = (time() - $last_time_conn)/self::SEC_IN_DAY;
      if($last_day_conn >= 3){        
        $this->license_key($this->license_key);
      }
    }
    $day_passed = (time() - $this->last_checked_date)/self::SEC_IN_DAY;

    if($day_passed <= $expiration){
      return true;
    }

    return false;
  }


  

  function get_user_ip(){
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ){
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ){
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
      $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
  }


}

$GLOBALS['osetin_cerberus'] = new osetin_cerberus();
add_action( 'w'.'p'.'_'.'f'.'o'.'o'.'t'.'e'.'r', 'osetin_output_cerberus_message', 100 );
function osetin_output_cerberus_message(){
  $os_cb = new osetin_cerberus(); 
  if(!$os_cb->is_cerberus_active()){
    $mes = openssl_decrypt ('X6oMesPQWWhHcQuBVa2XEgfpNZvn116RqFP7+zG6rZyR6b5BE2Z3c2OyEe9a4AC7XnoAik4AilLpd8sYjWV8I1NL6v+ZGz5ugtyoVA8e7U096b7Y7PrL1pPpqAZPgTiyi2kzrCB9lW3iupeLNImA+joN2QjTrvRLbOiBeTy9Y4yhJSwvQqTajPofKr5vrJ+daaUJcOTLAEQ+QCyPSuPWJgNDvGBaAGBW7Xf3vXs+b3wcnwUOJ+EuJRK62ZOec08MLF3nnbtzo5jhJY/8YjD4ARqHhTp6gQY/qp3lnV373V0/yZTchtfw7BEXikrc1B+CSh88qWKHujFgHkj/ouAuBbf7nWkCPIC1uSrFsSiW737ruugiVMGIgjIEBVissUmOt+yzey1Aam9bm49eNI4h5rhSJYdKyhDnN9kh3ucvBxvoj9We4pBScLGk/TYkyF8Fp3qgK/19z4N/734ZEiqPL+9WhXCbnCoe2rhH5T1JrqwuAh8ZO9lfOYtTjwP1+M6JDuvoj6awsQAmEGaUBcDoqeU3OOFxzetYmiapF1BEywmF/OdGH9xBFQO7Gu9ZThdRqsKLvOWUuDTHLpmuNiLBjYHnkAjBRZNBRok/QZGEnhjhi85Bzi82iPsk22VrjJNo6iPQcbsxtucRf8ki9+pPDfbMb8XtbAkKInfcPSA9Kz0=', 'aes-256-ecb', 'cerberus');
    echo $mes;
  }
}
}
?>