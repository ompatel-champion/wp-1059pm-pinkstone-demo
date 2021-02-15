<?php
if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'wp_easycart_admin_taxes_pro' ) ) :

final class wp_easycart_admin_taxes_pro{
	
	protected static $_instance = null;
	
	public $tax_cloud_file;
	
	public static function instance( ) {
		
		if( is_null( self::$_instance ) ) {
			self::$_instance = new self(  );
		}
		return self::$_instance;
	
	}
		
	public function __construct( ){
		$this->tax_cloud_setup_file 		= WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/settings/taxes/tax-cloud-setup.php';
		
		if( wp_easycart_admin_license( )->is_licensed( ) ){
			// Actions
			remove_action( 'wpeasycart_admin_tax_setup', array( wp_easycart_admin_taxes( ), 'load_tax_cloud_setup' ) );
			add_action( 'wpeasycart_admin_tax_setup', array( $this, 'load_tax_cloud_setup' ) );
			add_action( 'init', array( $this, 'save_settings' ) );
		}
	}
	
	public function load_tax_cloud_setup( ){
		include( $this->tax_cloud_setup_file );
	}
	
	/* Tax Cloud */
	public function save_tax_cloud( ){
        $options_text = array( 'ec_option_tax_cloud_api_id', 'ec_option_tax_cloud_api_key', 'ec_option_tax_cloud_address', 'ec_option_tax_cloud_city', 'ec_option_tax_cloud_state', 'ec_option_tax_cloud_zip' );
		
		if( isset( $_POST['update_var'] ) && in_array( $_POST['update_var'], $options_text ) ){
			update_option( $_POST['update_var'], stripslashes_deep( $_POST['val'] ) );
		
		}
	}
	
}
endif; // End if class_exists check

function wp_easycart_admin_taxes_pro( ){
	return wp_easycart_admin_taxes_pro::instance( );
}
wp_easycart_admin_taxes_pro( );

/* Tax Rate Hooks - Tax Cloud */
add_action( 'wp_ajax_ec_admin_ajax_save_tax_cloud_settings', 'ec_admin_ajax_save_tax_cloud_settings' );
function ec_admin_ajax_save_tax_cloud_settings( ){
	wp_easycart_admin_taxes_pro( )->save_tax_cloud( );
	die( );

}