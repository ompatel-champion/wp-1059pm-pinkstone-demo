<?php
	
if( isset( $_GET['order_id'] ) && isset( $_GET['orderdetail_id'] ) && isset( $_GET['giftcard_id'] ) ){ 
	//Load Wordpress Connection Data
	define('WP_USE_THEMES', false);
	require('../../../../../wp-load.php');
	
	//Get the variables from the AJAX call
	$order_id = $_GET['order_id'];
	$orderdetail_id = $_GET['orderdetail_id'];
	$giftcard_id = $_GET['giftcard_id'];
	
	$mysqli = new ec_db( );
	
	$orderdetail_row = $mysqli->get_orderdetail_row_guest( $order_id, $orderdetail_id );
	
	if( $orderdetail_row ){
		
		$storepageid = get_option('ec_option_storepage');
		if( function_exists( 'icl_object_id' ) ){
			$storepageid = icl_object_id( $storepageid, 'page', true, ICL_LANGUAGE_CODE );
		}
		$store_page = get_permalink( $storepageid );
		if( class_exists( "WordPressHTTPS" ) && isset( $_SERVER['HTTPS'] ) ){
			$https_class = new WordPressHTTPS( );
			$store_page = $https_class->makeUrlHttps( $store_page );
		}
		
		if( substr_count( $store_page, '?' ) )				
            $permalink_divider = "&";
		else														
            $permalink_divider = "?";
		
		$ec_orderdetail = new ec_orderdetail( $orderdetail_row );
		
		if( file_exists( WP_PLUGIN_DIR . '/wp-easycart-data/design/theme/' . get_option( 'ec_option_base_theme' ) . "/ec_cart_email_receipt/emaillogo.jpg" ) ){
			$email_logo_url = plugins_url( "wp-easycart-data/design/theme/" . get_option( 'ec_option_base_theme' ) . "/ec_cart_email_receipt/emaillogo.jpg");
			$email_footer_url = plugins_url( "wp-easycart-data/design/theme/" . get_option( 'ec_option_base_theme' ) . "/ec_cart_email_receipt/emailfooter.jpg");
		}else{
			$email_logo_url = plugins_url( EC_PLUGIN_DIRECTORY . "/design/theme/" . get_option( 'ec_option_base_theme' ) . "/ec_cart_email_receipt/emaillogo.jpg");
			$email_footer_url = plugins_url( EC_PLUGIN_DIRECTORY . "/design/theme/" . get_option( 'ec_option_base_theme' ) . "/ec_cart_email_receipt/emailfooter.jpg");
		}
		
		// Get receipt
		if( file_exists( WP_PLUGIN_DIR . '/wp-easycart-data/design/layout/' . get_option( 'ec_option_base_layout' ) . '/ec_account_print_gift_card.php' ) )
			include WP_PLUGIN_DIR . '/wp-easycart-data/design/layout/' . get_option( 'ec_option_base_layout' ) . '/ec_account_print_gift_card.php';
		else
			include WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/design/layout/' . get_option( 'ec_option_latest_layout' ) . '/ec_account_print_gift_card.php';
	}else{
		echo "No Order Found";	
	}
}

?>