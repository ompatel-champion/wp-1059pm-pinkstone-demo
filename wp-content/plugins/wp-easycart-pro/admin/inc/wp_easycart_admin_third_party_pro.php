<?php
if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'wp_easycart_admin_third_party_pro' ) ) :

final class wp_easycart_admin_third_party_pro{
	
	protected static $_instance = null;
	
	public $amazon_file;
	public $deconetwork_file;
	public $facebook_file;
	
	public static function instance( ) {
		
		if( is_null( self::$_instance ) ) {
			self::$_instance = new self(  );
		}
		return self::$_instance;
	
	}
		
	public function __construct( ){
		// Setup File Names 
		$this->amazon_file	 				 = WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/admin/template/settings/third-party/amazon.php';
		$this->deconetwork_file	 			 = WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/admin/template/settings/third-party/deconetwork.php';
		$this->facebook_file	 			 = WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/settings/third-party/facebook.php';
		
		if( wp_easycart_admin_license( )->is_licensed( ) ){
			// Actions
			remove_action( 'wpeasycart_admin_third_party', array( wp_easycart_admin_third_party( ), 'load_amazon_settings' ) );
			remove_action( 'wpeasycart_admin_third_party', array( wp_easycart_admin_third_party( ), 'load_deconetwork_settings' ) );
			remove_action( 'wpeasycart_admin_third_party', array( wp_easycart_admin_third_party( ), 'load_facebook_settings' ) );
			add_action( 'wpeasycart_admin_third_party', array( $this, 'load_amazon_settings' ) );
			add_action( 'wpeasycart_admin_third_party', array( $this, 'load_deconetwork_settings' ) );
			add_action( 'wpeasycart_admin_third_party', array( $this, 'load_facebook_settings' ) );
			add_action( 'init', array( $this, 'save_settings' ) );
		}
	}
	
	public function load_amazon_settings( ){
		include( $this->amazon_file );
	}
	
	public function load_deconetwork_settings( ){
		include( $this->deconetwork_file );
	}
	
	public function load_facebook_settings( ){
		include( $this->facebook_file );
	}
	
	public function save_amazon_settings( ) {
		$ec_option_amazon_key = stripslashes_deep( $_POST['ec_option_amazon_key'] );
		$ec_option_amazon_secret = stripslashes_deep( $_POST['ec_option_amazon_secret'] );
		$ec_option_amazon_bucket = stripslashes_deep( $_POST['ec_option_amazon_bucket'] );
		$ec_option_amazon_bucket_region = $_POST['ec_option_amazon_bucket_region'];
		
		if( isset( $_POST['ec_option_amazon_key'] ) )
			$ec_option_amazon_key = $_POST['ec_option_amazon_key'];
		if( isset( $_POST['ec_option_amazon_secret'] ) )
			$ec_option_amazon_secret = $_POST['ec_option_amazon_secret'];
		if( isset( $_POST['ec_option_amazon_bucket'] ) )
			$ec_option_amazon_bucket = $_POST['ec_option_amazon_bucket'];
		if( isset( $_POST['ec_option_amazon_bucket_region'] ) )
			$ec_option_amazon_bucket_region = $_POST['ec_option_amazon_bucket_region'];

		
		update_option( 'ec_option_amazon_key', $ec_option_amazon_key );
		update_option( 'ec_option_amazon_secret', $ec_option_amazon_secret );
		update_option( 'ec_option_amazon_bucket', $ec_option_amazon_bucket );
		update_option( 'ec_option_amazon_bucket_region', $ec_option_amazon_bucket_region );
	}
	
	public function save_deconetwork_settings( ) {
		$ec_option_deconetwork_url = stripslashes_deep( $_POST['ec_option_deconetwork_url'] );
		$ec_option_deconetwork_password = stripslashes_deep( $_POST['ec_option_deconetwork_password'] );
		
		if( isset( $_POST['ec_option_deconetwork_url'] ) )
			$ec_option_deconetwork_url = $_POST['ec_option_deconetwork_url'];
		if( isset( $_POST['ec_option_deconetwork_password'] ) )
			$ec_option_deconetwork_password = $_POST['ec_option_deconetwork_password'];

		
		update_option( 'ec_option_deconetwork_url', $ec_option_deconetwork_url );
		update_option( 'ec_option_deconetwork_password', $ec_option_deconetwork_password );
	}
	
	public function save_facebook_settings( ) {
		$ec_option_fb_pixel = stripslashes_deep( $_POST['ec_option_fb_pixel'] );
		update_option( 'ec_option_fb_pixel', $ec_option_fb_pixel );
	}
	
	public function save_settings( ){
		if( current_user_can( 'manage_options' ) && isset( $_POST['ec_admin_form_action'] ) && $_POST['ec_admin_form_action'] == "save-thirdparty-setup" ){
			$this->save_amazon_settings( );
			$this->save_deconetwork_settings( );
		}
	}
}
endif; // End if class_exists check

function wp_easycart_admin_third_party_pro( ){
	return wp_easycart_admin_third_party_pro::instance( );
}
wp_easycart_admin_third_party_pro( );

add_action( 'wp_ajax_ec_admin_ajax_save_deconetwork_settings', 'ec_admin_ajax_save_deconetwork_settings' );
function ec_admin_ajax_save_deconetwork_settings( ){
	wp_easycart_admin_third_party_pro( )->save_deconetwork_settings( );
	die( );
}
add_action( 'wp_ajax_ec_admin_ajax_save_amazon_settings', 'ec_admin_ajax_save_amazon_settings' );
function ec_admin_ajax_save_amazon_settings( ){
	wp_easycart_admin_third_party_pro( )->save_amazon_settings( );
	die( );
}
add_action( 'wp_ajax_ec_admin_ajax_save_facebook_settings', 'ec_admin_ajax_save_facebook_settings' );
function ec_admin_ajax_save_facebook_settings( ){
	wp_easycart_admin_third_party_pro( )->save_facebook_settings( );
	die( );
}