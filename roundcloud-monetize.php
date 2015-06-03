<?php
/*
Plugin Name: RoundCloud Monetize
Plugin URI: http://yourcloudaround.com/en/
Description:  RoundCloud Monetize plugin
Version: 1.0.1
Author:RoundCloud
Author URI: http://yourcloudaround.com/en/
License: GPL2
*/

define('RC_MONETIZE_DIR', plugin_dir_path(__FILE__));
define('RC_MONETIZE_URL', plugin_dir_url(__FILE__));
register_activation_hook(__FILE__, 'rc_monetize_activation');
register_deactivation_hook(__FILE__, 'rc_monetize_deactivation');
include dirname(__FILE__) . '/PapApi.class.php';

function rc_monetize_activation() {
	
	global $wpdb;
	$table_name = $wpdb->prefix.'rc_monetize_rotators';
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	
		
		$querystr = "CREATE TABLE ".$table_name."
		(
		id int NOT NULL AUTO_INCREMENT,
		UserId varchar(8),
		RotatorCode longtext,
		UNIQUE KEY id (id)
		);";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($querystr);
	}
	
}

function rc_monetize_deactivation() {
	delete_option('rc_monetize_PanAccountId');
	delete_option('rc_monetize_PanEmail');
	delete_option('rc_monetize_PanAccount');
	delete_option('rc_monetize_PanPassword');
	delete_option('rc_monetize_shortcode_id');

}

function rc_monetize_full_logout(){
	delete_option('rc_monetize_shortcode_id');
	delete_option('rc_monetize_PanAccountId');
	delete_option('rc_monetize_PanEmail');
	delete_option('rc_monetize_PanAccount');
	delete_option('rc_monetize_PanPassword');
}


function rc_monetize_userlist_init(){
	$icon =plugins_url('roundcloud-monetize/assets/img/icon.png');
	
	add_object_page('ROUNDCLOUD MONETIZE', 'ROUNDCLOUD MONETIZE', -1, basename(__FILE__), '', $icon);
	
	add_submenu_page(basename(__FILE__), 'General settings', 'General settings', 10, 'rc_monetize_settings', 'rc_monetize_load_settings');
	
	if(get_option('rc_monetize_PanAccountId')!==false){
		
		
		add_submenu_page(basename(__FILE__), 'Manage&Report', 'Manage&Report', 10, 'rc_monetize_manage_adv', 'rc_monetize_load_manage_adv');
		
	}

}

function rc_monetize_load_manage_adv(){
	
	include(RC_MONETIZE_DIR.'/views/PaPWindow.php');
	
}


function rc_monetize_load_settings(){
	
	include(RC_MONETIZE_DIR.'/views/settings.php');
	
}

function rc_monetize_add_my_script() {

	if($_GET['page']=='rc_monetize_settings' ||  $_GET['page']=='rc_monetize_manage_adv' ){
		
		wp_enqueue_script('roundcloud-monetize', plugins_url('/assets/js/roundcloud-monetize.js', __FILE__),'');

		wp_register_style( 'prefix-style', plugins_url('/assets/css/RoundCloud-Monetize.css', __FILE__) );
			
		wp_enqueue_style( 'prefix-style' );
			
	}
		
}

function rc_monetize_init(){

	 
}

function rc_monetize_set_option(){

	echo add_option($_GET['option_name'],$_GET['option_value'],'','yes');

}

function rc_monetize_deleteOption(){
	
	delete_option($_GET['option_name']);
	
}

function rc_monetize_update_option(){

		
		
	echo update_option($_GET['option_name'],$_GET['option_value']);

}

function rc_monetize_get_option(){
	
	echo get_option($_GET['option_name']);
	die();
}

function rc_monetize_get_affiliate_id(){
	
	echo get_option('rc_monetize_PanAccountId');
	die();
}

function rc_monetize_get_affiliate_id_front_end(){
	
	echo get_option('rc_monetize_PanAccountId');
	die();
}


function rc_monetize_get_Pan_session(){
	
	$session = new Gpf_Api_Session("http://affiliate.yourcloudaround.com/scripts/server.php");
	
	$session->login(get_option('rc_monetize_PanEmail'), get_option('rc_monetize_PanPassword'));
	
    return $session;
	
}


if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}

function rc_monetize_get_shortcode_id(){
	global $wpdb;
	$table_name = $wpdb->prefix.'rc_monetize_rotators';
	$account_id = $_GET['accountId'];
	$querystr = $wpdb->prepare( "SELECT id FROM ".$table_name." WHERE UserId =%s",$account_id);
	$ids = $wpdb->get_results($querystr);
	foreach($ids as $id) {
				
				$data[] = $id->id;	
				
			}

	update_option("rc_monetize_shortcode_id",$data[0]);
	
}

function get_rc_monetize_rotator( $atts, $content = null ) {
	
	
$scr = 'var rc_banners_array=[];
var banner_html =jQuery(str);
for(var i = 0;i<jQuery(banner_html).length;i++){
	
	id = jQuery(banner_html)[i].id;
	rc_banners_array.push(id);
	
}

function rc_getRandomArbitary(min, max){
	
	return Math.floor(Math.random() * (max - min + 1)) + min;
	
}

var r = rc_getRandomArbitary(0,rc_banners_array.length-1);

for(var i = 0;i<jQuery(banner_html).length;i++){
	
	if(rc_banners_array[r]== jQuery(banner_html)[i].id){
		str = jQuery(banner_html)[i].outerHTML;
		str = str.replace("<!--"," ");
		str = str.replace("//-->"," ");
		document.write(str);
		
	}
	
}

</script>';
	
	
	
	extract( shortcode_atts( array(
		'id' => '-1'
	), $atts ) );


	
	global $wpdb;
	$table_name = $wpdb->prefix.'rc_monetize_rotators';
	
	$querystr = $wpdb->prepare("SELECT RotatorCode FROM ".$table_name." WHERE id =%d",$id);
	
	$codes = $wpdb->get_results($querystr);

	foreach($codes as $code) {
				
			$data = $code;	
				
			}
	$data->RotatorCode = urldecode($data->RotatorCode);	
	$data->RotatorCode = str_replace("<!--"," ",$data->RotatorCode);
	$data->RotatorCode = str_replace("//-->"," ",$data->RotatorCode);
	$doc = new DOMDocument();
	$result = $doc->loadHTML($data->RotatorCode);
	$xpath = new DOMXpath($doc);
	$items = $xpath->query('//div[@class="item"]');
	$c = 0;
   
	$r = rand(0, $items->length-1);

		$result = str_replace("encodeURIComponent(encodeURIComponent(document.URL))","+encodeURIComponent(encodeURIComponent(document.URL))+",$items->item($r)->nodeValue);
		return "<script>".$result." </script>";
	
	
}

function rc_monetize_write_rotator_code_to_db(){
	global $wpdb;
	$table_name = $wpdb->prefix.'rc_monetize_rotators';
	$user_id = $_GET['user_id'];
	$querystr = $wpdb->prepare("SELECT id FROM ".$table_name." WHERE UserId =%s",$user_id);
	$id = $wpdb->get_results($querystr);
	if(count($id)==0){
		$code = $_GET['code'];
		$querystr = $wpdb->prepare("INSERT INTO ".$table_name." ( UserId, RotatorCode) VALUES (%s, %s )",$user_id,$code);
		$execut= $wpdb->query($querystr);
		echo $wpdb->insert_id;
		die();
	}else{
		$code = $_GET['code'];
		$querystr = $wpdb->prepare("UPDATE ".$table_name." SET RotatorCode =%s WHERE UserId =%s ",$code,$user_id);
		$execut= $wpdb->query($querystr);
		echo 'update';
		die();
	}
	
	
}




class roundcloud_monetize_widget extends WP_Widget {

function __construct() {
parent::__construct(

'RoundCloud_Banner_Rotator', 

__('RoundCloud Banner Rotator', 'RoundCloud_Banner_Rotator'), 

array( 'description' => __( 'RoundCloud Banner Rotator', 'RoundCloud_Banner_Rotator' ), ) );
}


public function widget( $args, $instance ) {

$id = get_option("rc_monetize_shortcode_id");

if($id !== false){
global $wpdb;
	$table_name = $wpdb->prefix.'rc_monetize_rotators';
	
	$querystr = $wpdb->prepare("SELECT RotatorCode FROM ".$table_name." WHERE id =%d",$id);
	
	$codes = $wpdb->get_results($querystr);
if($codes->length!==0){
	foreach($codes as $code) {
				
			$data = $code;	
				
			}
	$data->RotatorCode = urldecode($data->RotatorCode);	
	$data->RotatorCode = str_replace("<!--"," ",$data->RotatorCode);
	$data->RotatorCode = str_replace("//-->"," ",$data->RotatorCode);
	$data->RotatorCode =  str_replace("encodeURIComponent(encodeURIComponent(document.URL))","+encodeURIComponent(encodeURIComponent(document.URL))+",$data->RotatorCode);
	$doc = new DOMDocument();
	$result = $doc->loadHTML($data->RotatorCode);
	$xpath = new DOMXpath($doc);
	$items = $xpath->query('//div[@class="item"]');
	$c = 0;
   
	$r = rand(0, $items->length-1);
	$new_dom = new DOMDocument();
	$new_dom->appendChild($new_dom->importNode($items->item($r), TRUE));
	$result = $new_dom->saveHTML();

	echo $result;
}
}
	
}

function innerXML($node) { 
$doc = $node->ownerDocument; 
$frag = $doc->createDocumentFragment(); 
foreach ($node->childNodes as $child) 
{ 
$frag->appendChild($child->cloneNode(TRUE)); 
} 
return $doc->saveXML($frag);
 }
		

public function form( $instance ) {

}
	

public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} 


function roundcloud_load_widget() {
	register_widget( 'roundcloud_monetize_widget' );
}
add_action('init', 'rc_monetize_add_my_script');
add_action( 'widgets_init', 'roundcloud_load_widget' );
add_shortcode( 'rc_monetize_rotator', 'get_rc_monetize_rotator' );
add_action('wp_ajax_nopriv_rc_monetizeget_affiliate_id', 'rc_monetize_get_affiliate_id_front_end' );
add_action('wp_ajax_rc_monetize_get_affiliate_id', 'rc_monetize_get_affiliate_id' );
add_action('wp_ajax_rc_monetize_update_option', 'rc_monetize_update_option' );
add_action('wp_ajax_rc_monetize_set_option', 'rc_monetize_set_option' );
add_action('wp_ajax_rc_monetize_get_shortcode_id', 'rc_monetize_get_shortcode_id' );
add_action('wp_ajax_rc_monetize_get_option', 'rc_monetize_get_option' );
add_action('wp_ajax_rc_monetize_logout', 'rc_monetize_full_logout' );
add_action('wp_ajax_rc_monetize_write_rotator_code_to_db', 'rc_monetize_write_rotator_code_to_db' );
add_action('plugins_loaded', 'rc_monetize_init');

add_action('admin_menu','rc_monetize_userlist_init');

?>