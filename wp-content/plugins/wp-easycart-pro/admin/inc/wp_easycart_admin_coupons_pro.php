<?php
class wp_easycart_admin_coupons_pro{
	
	public $coupons_list_file;
	
	public function __construct( ){ 
		$this->coupons_list_file 		= WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/marketing/coupons/coupon-list.php';
		$this->coupons_details_file 	= WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/marketing/coupons/coupon-details.php';
		if( wp_easycart_admin_license( )->is_licensed( ) ){
			remove_action( 'wp_easycart_admin_coupon_list', array( wp_easycart_admin( ), 'show_upgrade', 1 ) );
			remove_action( 'wp_easycart_admin_coupon_details', array( wp_easycart_admin( ), 'show_upgrade', 1 ) );
			add_action( 'wp_easycart_admin_coupon_list', array( $this, 'show_list' ), 1 );
			add_action( 'wp_easycart_admin_coupon_details', array( $this, 'show_details' ), 1 );
			
			// Form Action Hooks
			add_action( 'wp_easycart_process_post_form_action', array( $this, 'process_add_coupon' ) );
			add_action( 'wp_easycart_process_post_form_action', array( $this, 'process_update_coupon' ) );
			add_action( 'wp_easycart_process_get_form_action', array( $this, 'process_delete_coupon' ) );
			add_action( 'wp_easycart_process_get_form_action', array( $this, 'process_bulk_delete_coupon' ) );
		}
	}
	
	public function process_add_coupon( ){
		if( $_POST['ec_admin_form_action'] == "add-new-coupon" ){
			$result = $this->insert_coupon( );
			wp_easycart_admin( )->redirect( 'wp-easycart-rates', 'coupons', $result );
		}
	}
	
	public function process_update_coupon( ){
		if( $_POST['ec_admin_form_action'] == "update-coupon" ){
			$result = $this->update_coupon( );
			wp_easycart_admin( )->redirect( 'wp-easycart-rates', 'coupons', $result );
		}
	}
	
	public function process_delete_coupon( ){
		if( isset($_GET['subpage']) == 'coupons' && $_GET['ec_admin_form_action'] == 'delete-coupon' && isset( $_GET['promocode_id'] ) && !isset( $_GET['bulk'] ) ){
			$result = $this->delete_coupon( );
			wp_easycart_admin( )->redirect( 'wp-easycart-rates', 'coupons', $result );
		}
	}
	
	public function process_bulk_delete_coupon( ){
		if( isset($_GET['subpage']) == 'coupons' && $_GET['ec_admin_form_action'] == 'delete-coupon' && !isset( $_GET['promocode_id'] ) && isset( $_GET['bulk'] ) ){
			$result = $this->bulk_delete_coupon( );
			wp_easycart_admin( )->redirect( 'wp-easycart-rates', 'coupons', $result );
		}
	}
	
	private function print_admin_message($status, $message) {
		if ($status == 'success') {
			$print_message = '<div id="ec_message" class="ec_admin_message_success"><div class="dashicons-before dashicons-thumbs-up"></div>'.$message.'</div>';
		} else if ($status == 'error') {
			$print_message = '<div id="ec_message" class="ec_admin_message_error"><div class="dashicons-before dashicons-thumbs-down"></div>'.$message.'</div>';
		}
		return $print_message;
	}
	
	public function show_list( ){
		if(isset($_GET['success'] )) {
			if ($_GET['success'] == 'coupon-inserted')
				echo $this->print_admin_message( 'success', __( 'Coupon successfully created', 'wp-easycart-pro' ) );
			if ($_GET['success'] == 'coupon-updated')
				echo $this->print_admin_message( 'success', __( 'Coupon successfully updated', 'wp-easycart-pro' ) );
			if ($_GET['success'] == 'coupon-deleted')
				echo $this->print_admin_message( 'success', __( 'Coupon successfully deleted', 'wp-easycart-pro' ) );
		}
		
		if(isset($_GET['error'] )) {
			if ($_GET['error'] == 'coupon-inserted-error')
				echo $this->print_admin_message( 'error', __( 'Coupon failed to create', 'wp-easycart-pro' ) );
			if ($_GET['error'] == 'coupon-updated-error')
				echo $this->print_admin_message( 'error', __( 'Coupon failed to update', 'wp-easycart-pro' ) );
			if ($_GET['error'] == 'coupon-deleted-error')
				echo $this->print_admin_message( 'error', __( 'Coupon failed to delete', 'wp-easycart-pro' ) );
			if ($_GET['error'] == 'coupon-duplicate')
				echo $this->print_admin_message( 'error', __( 'Coupon failed to create due to duplicate', 'wp-easycart-pro' ) );
		}
		
		include( $this->coupons_list_file );
	}
	
	public function show_details( ){
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . '/admin/inc/wp_easycart_admin_details_coupons.php' );
		$details = new wp_easycart_admin_details_coupons( );
		$details->output( esc_attr( $_GET['ec_admin_form_action'] ) );
	}
	
	public function insert_coupon( ){
		$original_id = $_POST['original_id'];
		$promocode_id = preg_replace( "/[^A-Za-z0-9\$\%]/", '', stripslashes_deep( $_POST['promocode_id'] ) );
		$promo_dollar = $_POST['promo_dollar'];
		$promo_percentage = $_POST['promo_percentage'];
		$promo_shipping = $_POST['promo_shipping'];
		$promo_free_item = $_POST['promo_free_item'];
		$promo_for_me = $_POST['promo_for_me'];
		$promo_bogo_dollar = $_POST['promo_bogo_dollar'];
		$promo_bogo_percentage = $_POST['promo_bogo_percentage'];
		$manufacturer_id = $_POST['manufacturer_id'];
		$product_id = $_POST['product_id'];
		$message = stripslashes_deep( $_POST['message'] );
		$max_redemptions = $_POST['max_redemptions'];
		$times_redeemed = $_POST['times_redeemed'];
		if( class_exists( 'DateTime' ) && class_exists( 'DateTimeZone' ) ){
			$date = new DateTime( $_POST['expiration_date'], new DateTimeZone( 'America/Los_Angeles' ) );
			$unix_expiration_date = $date->format( 'U' );
		}else{
			$unix_expiration_date = strtotime( $_POST['expiration_date'] );
		}
		$expiration_date = date("Y-m-d h:i:s", strtotime( $_POST['expiration_date'] ) );
		$category_id = $_POST['category_id'];
		$duration = $_POST['duration'];
		$duration_in_months = $_POST['duration_in_months'];
		
		if(isset($_POST['is_dollar_based'])) $is_dollar_based = $_POST['is_dollar_based'];
		else $is_dollar_based = 0;
		if(isset($_POST['is_percentage_based'])) $is_percentage_based = $_POST['is_percentage_based'];
		else $is_percentage_based = 0;
		if(isset($_POST['is_shipping_based'])) $is_shipping_based = $_POST['is_shipping_based'];
		else $is_shipping_based = 0;
		if(isset($_POST['is_free_item_based'])) $is_free_item_based = $_POST['is_free_item_based'];
		else $is_free_item_based = 0;
		if(isset($_POST['is_for_me_based'])) $is_for_me_based = $_POST['is_for_me_based'];
		else $is_for_me_based = 0;
		if(isset($_POST['is_bogo_based'])) $is_bogo_based = $_POST['is_bogo_based'];
		else $is_bogo_based = 0;
		
		if(isset($_POST['by_manufacturer_id'])) $by_manufacturer_id = $_POST['by_manufacturer_id'];
		else $by_manufacturer_id = 0;
		if(isset($_POST['by_product_id'])) $by_product_id = $_POST['by_product_id'];
		else $by_product_id = 0;
		if(isset($_POST['by_all_products'])) $by_all_products = $_POST['by_all_products'];
		else $by_all_products = 0;
		if(isset($_POST['by_category_id'])) $by_category_id = $_POST['by_category_id'];
		else $by_category_id = 0;
		
		$minimum_required = $_POST['minimum_required'];
		
		$query_vars = array( );
		
		global $wpdb;
		$duplicate = $wpdb->query( $wpdb->prepare( "SELECT * FROM ec_promocode WHERE ec_promocode.promocode_id='%s'", $promocode_id));
		
		//if no duplicates, insert
		if( $duplicate == 0 ){
			$wpdb->query( $wpdb->prepare( "INSERT INTO ec_promocode(promocode_id, is_dollar_based, is_percentage_based, is_shipping_based, is_free_item_based, is_for_me_based, is_bogo_based, by_manufacturer_id, by_product_id, by_all_products, promo_dollar, promo_percentage, promo_shipping, promo_free_item, promo_for_me, promo_bogo_dollar, promo_bogo_percentage, manufacturer_id, product_id, message, max_redemptions, times_redeemed, expiration_date, by_category_id, category_id, duration, duration_in_months, minimum_required ) VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %d, %d )", $promocode_id, $is_dollar_based, $is_percentage_based, $is_shipping_based, $is_free_item_based, $is_for_me_based, $is_bogo_based, $by_manufacturer_id, $by_product_id, $by_all_products, $promo_dollar, $promo_percentage, $promo_shipping, $promo_free_item, $promo_for_me, $promo_bogo_dollar, $promo_bogo_percentage, $manufacturer_id, $product_id, $message, $max_redemptions, $times_redeemed, $expiration_date, $by_category_id, $category_id, $duration, $duration_in_months, $minimum_required ) );
			if( ( get_option( 'ec_option_payment_process_method' ) == 'stripe' || get_option( 'ec_option_payment_process_method' ) == 'stripe_connect' ) && !$is_bogo_based ){
				if( get_option( 'ec_option_payment_process_method' ) == 'stripe' )
					$stripe = new ec_stripe( );
				else
					$stripe = new ec_stripe_connect( );
				$coupon = array( 
					"is_amount_off" 	=> $is_dollar_based,
					"promocode_id" 		=> $promocode_id,
					"duration" 			=> $duration,
					"duration_in_months"=> $duration_in_months,
					"amount_off" 		=> $promo_dollar * 100,
					"percent_off" 		=> $promo_percentage,
					"max_redemptions" 	=> $max_redemptions,
					"redeem_by" 		=> $unix_expiration_date
				);		
				if( $duration == 'repeating' )
					$coupon['duration_in_months'] = $duration_in_months;		
				$stripe->insert_coupon( $coupon );
			}
			$query_vars['success'] = 'coupon-inserted';
		}else{
			$query_vars['error'] = 'coupon-duplicate';
		}
		
		do_action( 'wp_easycart_coupon_created', $promocode_id );
		
		return $query_vars;
	}
	
	public function update_coupon( ){
		$original_id = $_POST['original_id'];
		$promocode_id = preg_replace( "/[^A-Za-z0-9\$\%]/", '', stripslashes_deep( $_POST['promocode_id'] ) );
		$promo_dollar = $_POST['promo_dollar'];
		$promo_percentage = $_POST['promo_percentage'];
		$promo_shipping = $_POST['promo_shipping'];
		$promo_free_item = $_POST['promo_free_item'];
		$promo_for_me = $_POST['promo_for_me'];
		$promo_bogo_dollar = $_POST['promo_bogo_dollar'];
		$promo_bogo_percentage = $_POST['promo_bogo_percentage'];
		$manufacturer_id = $_POST['manufacturer_id'];
		$product_id = $_POST['product_id'];
		$message = stripslashes_deep( $_POST['message'] );
		$max_redemptions = $_POST['max_redemptions'];
		$times_redeemed = $_POST['times_redeemed'];
		if( class_exists( 'DateTime' ) && class_exists( 'DateTimeZone' ) ){
			$date = new DateTime( $_POST['expiration_date'], new DateTimeZone( 'America/Los_Angeles' ) );
			$unix_expiration_date = $date->format( 'U' );
		}else{
			$unix_expiration_date = strtotime( $_POST['expiration_date'] );
		}
		$expiration_date = date("Y-m-d h:i:s", strtotime( $_POST['expiration_date'] ) );
		$category_id = $_POST['category_id'];
		$duration = $_POST['duration'];
		$duration_in_months = $_POST['duration_in_months'];
		
		if(isset($_POST['is_dollar_based'])) $is_dollar_based = $_POST['is_dollar_based'];
		else $is_dollar_based = 0;
		if(isset($_POST['is_percentage_based'])) $is_percentage_based = $_POST['is_percentage_based'];
		else $is_percentage_based = 0;
		if(isset($_POST['is_shipping_based'])) $is_shipping_based = $_POST['is_shipping_based'];
		else $is_shipping_based = 0;
		if(isset($_POST['is_free_item_based'])) $is_free_item_based = $_POST['is_free_item_based'];
		else $is_free_item_based = 0;
		if(isset($_POST['is_for_me_based'])) $is_for_me_based = $_POST['is_for_me_based'];
		else $is_for_me_based = 0;
		if(isset($_POST['is_bogo_based'])) $is_bogo_based = $_POST['is_bogo_based'];
		else $is_bogo_based = 0;
		
		if(isset($_POST['by_manufacturer_id'])) $by_manufacturer_id = $_POST['by_manufacturer_id'];
		else $by_manufacturer_id = 0;
		if(isset($_POST['by_product_id'])) $by_product_id = $_POST['by_product_id'];
		else $by_product_id = 0;
		if(isset($_POST['by_all_products'])) $by_all_products = $_POST['by_all_products'];
		else $by_all_products = 0;
		if(isset($_POST['by_category_id'])) $by_category_id = $_POST['by_category_id'];
		else $by_category_id = 0;
		
		$minimum_required = $_POST['minimum_required'];
		
		$query_vars = array( );
		
		global $wpdb;

		$wpdb->query( $wpdb->prepare( "UPDATE ec_promocode SET promocode_id = %s, is_dollar_based = %s, is_percentage_based = %s, is_shipping_based = %s, is_free_item_based = %s, is_for_me_based = %s, is_bogo_based = %s, by_manufacturer_id = %s, by_product_id = %s, by_all_products = %s, promo_dollar = %s, promo_percentage = %s, promo_shipping = %s, promo_free_item = %s, promo_for_me = %s, promo_bogo_dollar = %s, promo_bogo_percentage = %s, manufacturer_id = %s, product_id = %s, message = %s, max_redemptions = %s, times_redeemed = %s, expiration_date = %s, by_category_id = %s, category_id = %s, duration = %s, duration_in_months = %d, minimum_required = %d WHERE promocode_id = %s", $promocode_id, $is_dollar_based, $is_percentage_based, $is_shipping_based, $is_free_item_based, $is_for_me_based, $is_bogo_based, $by_manufacturer_id, $by_product_id, $by_all_products, $promo_dollar, $promo_percentage, $promo_shipping, $promo_free_item, $promo_for_me, $promo_bogo_dollar, $promo_bogo_percentage, $manufacturer_id, $product_id, $message, $max_redemptions, $times_redeemed, $expiration_date, $by_category_id, $category_id, $duration, $duration_in_months, $minimum_required, $original_id ) );
		
		if( ( get_option( 'ec_option_payment_process_method' ) == 'stripe' || get_option( 'ec_option_payment_process_method' ) == 'stripe_connect' ) && !$is_bogo_based ){
			if( get_option( 'ec_option_payment_process_method' ) == 'stripe' )
				$stripe = new ec_stripe( );
			else
				$stripe = new ec_stripe_connect( );
			$stripe->delete_coupon( $original_id );
			$coupon = array( 
				"is_amount_off" 	=> $is_dollar_based,
				"promocode_id" 		=> $promocode_id,
				"duration" 			=> $duration,
				"duration_in_months"=> $duration_in_months,
				"amount_off" 		=> $promo_dollar * 100,
				"percent_off" 		=> $promo_percentage,
				"max_redemptions" 	=> $max_redemptions,
				"redeem_by" 		=> $unix_expiration_date
			);				
			$stripe->insert_coupon( $coupon );
		}
		
		$query_vars['success'] = 'coupon-updated';
		
		do_action( 'wp_easycart_coupon_updated', $promocode_id );
		
		return $query_vars;	
		
	}
	
	public function delete_coupon( ){
		$promocode_id = $_GET['promocode_id'];
		$query_vars = array( );
		
		global $wpdb;
		$wpdb->query( $wpdb->prepare( "DELETE FROM ec_promocode WHERE ec_promocode.promocode_id = %s", $promocode_id ) );
		if( get_option( 'ec_option_payment_process_method' ) == 'stripe' || get_option( 'ec_option_payment_process_method' ) == 'stripe_connect' ){
			if( get_option( 'ec_option_payment_process_method' ) == 'stripe' )
				$stripe = new ec_stripe( );
			else
				$stripe = new ec_stripe_connect( );
			$stripe->delete_coupon( $promocode_id );
		}
		
		$query_vars['success'] = 'coupon-deleted';
		
		do_action( 'wp_easycart_coupon_deleted', $promocode_id );
		
		return $query_vars;
	}
	
	public function bulk_delete_coupon( ){
		global $wpdb;
		$bulk_ids = $_GET['bulk'];
		$query_vars = array( );
		foreach( $bulk_ids as $bulk_id ){
			$result = $wpdb->query( $wpdb->prepare( "DELETE FROM ec_promocode WHERE ec_promocode.promocode_id = %s", $bulk_id ) );
			if( get_option( 'ec_option_payment_process_method' ) == 'stripe' || get_option( 'ec_option_payment_process_method' ) == 'stripe_connect' ){
				if( get_option( 'ec_option_payment_process_method' ) == 'stripe' )
					$stripe = new ec_stripe( );
				else
					$stripe = new ec_stripe_connect( );
				$stripe->delete_coupon( $bulk_id );
			}
		}
		$query_vars['success'] = 'coupon-deleted';
		return $query_vars;
	}
	
}
new wp_easycart_admin_coupons_pro( );