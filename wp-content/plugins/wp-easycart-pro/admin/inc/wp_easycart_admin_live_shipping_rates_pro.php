<?php
if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'wp_easycart_admin_live_shipping_rates_pro' ) ) :

final class wp_easycart_admin_live_shipping_rates_pro{
	
	protected static $_instance = null;
	private $wpdb;
	
	public $live_rates_file;
	
	public $australia_post_options_file;
	public $canada_post_options_file;
	public $dhl_options_file;
	public $fedex_options_file;
	public $ups_options_file;
	public $usps_options_file;
	
	public static function instance( ) {
		
		if( is_null( self::$_instance ) ) {
			self::$_instance = new self(  );
		}
		return self::$_instance;
	
	}
	
	public function __construct( ){
		// Keep reference to wpdb
		global $wpdb;
		$this->wpdb =& $wpdb;
		
		// Setup Files and Actions
		$this->live_rates_file = WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/settings/shipping/live-rates.php';
		
		$this->australia_post_options_file = WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/settings/shipping/australia-post-options.php';
		$this->canada_post_options_file = WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/settings/shipping/canada-post-options.php';
		$this->dhl_options_file = WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/settings/shipping/dhl-options.php';
		$this->fedex_options_file = WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/settings/shipping/fedex-options.php';
		$this->ups_options_file = WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/settings/shipping/ups-options.php';
		$this->usps_options_file = WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/settings/shipping/usps-options.php';
		
		if( wp_easycart_admin_license( )->is_licensed( ) ){
			remove_action( 'wpeasycart_admin_shipping_rates', array( wp_easycart_admin_live_shipping_rates( ), 'load_live_rates' ) );
			remove_action( 'wpeasycart_admin_shipping_setup', array( wp_easycart_admin_live_shipping_rates( ), 'load_australia_post_setup' ) );
			remove_action( 'wpeasycart_admin_shipping_setup', array( wp_easycart_admin_live_shipping_rates( ), 'load_canada_post_setup' ) );
			remove_action( 'wpeasycart_admin_shipping_setup', array( wp_easycart_admin_live_shipping_rates( ), 'load_dhl_setup' ) );
			remove_action( 'wpeasycart_admin_shipping_setup', array( wp_easycart_admin_live_shipping_rates( ), 'load_fedex_setup' ) );
			remove_action( 'wpeasycart_admin_shipping_setup', array( wp_easycart_admin_live_shipping_rates( ), 'load_ups_setup' ) );
			remove_action( 'wpeasycart_admin_shipping_setup', array( wp_easycart_admin_live_shipping_rates( ), 'load_usps_setup' ) );
			
			add_action( 'wpeasycart_admin_shipping_rates', array( $this, 'load_live_rates' ) );
			add_action( 'wpeasycart_admin_shipping_rates_methods', array( $this, 'add_live_rate_option' ) );
			add_action( 'wpeasycart_admin_shipping_setup', array( $this, 'load_australia_post_setup' ) );
			add_action( 'wpeasycart_admin_shipping_setup', array( $this, 'load_canada_post_setup' ) );
			add_action( 'wpeasycart_admin_shipping_setup', array( $this, 'load_dhl_setup' ) );
			add_action( 'wpeasycart_admin_shipping_setup', array( $this, 'load_fedex_setup' ) );
			add_action( 'wpeasycart_admin_shipping_setup', array( $this, 'load_ups_setup' ) );
			add_action( 'wpeasycart_admin_shipping_setup', array( $this, 'load_usps_setup' ) );
		}
	}
	
	public function load_live_rates( ){
		include( $this->live_rates_file );
	}
	
	/* Live Shipping Settings Methods */
	public function load_australia_post_setup( ){
		include( $this->australia_post_options_file );
	}
	
	public function load_canada_post_setup( ){
		include( $this->canada_post_options_file );
	}
	
	public function load_dhl_setup( ){
		include( $this->dhl_options_file );
	}
	
	public function load_fedex_setup( ){
		include( $this->fedex_options_file );
	}
	
	public function load_ups_setup( ){
		include( $this->ups_options_file );
	}
	
	public function load_usps_setup( ){
		include( $this->usps_options_file );
	}
	
	/* Live Method Tests */
	public function get_auspost_status( ){
		global $wpdb;
		$settings_row = $wpdb->get_row( "SELECT * FROM ec_setting" );
			
		$status = "disabled";
		if( $settings_row->auspost_api_key != "" && $settings_row->auspost_ship_from_zip != "" ){
			if( !class_exists( "ec_shipper" ) )
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_shipper.php' );
			if( !class_exists( "ec_auspost" ) )
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_auspost.php' );
			
			$settings = new ec_setting( $settings_row );
			$auspost_class = new ec_auspost( $settings );
			
			$auspost_response = $auspost_class->get_rate_test( "AUS_PARCEL_EXPRESS", $settings_row->auspost_ship_from_zip, "AU", "1" );
			
			if( !$auspost_response )
				$status = "error";
			else
				$status = "connected";
		}
		return $status;
	}
	
	public function get_canadapost_status( ){
		global $wpdb;
		$settings_row = $wpdb->get_row( "SELECT * FROM ec_setting" );
		
		$status = "disabled";
		if( $settings_row->canadapost_username != '' && $settings_row->canadapost_password != '' && $settings_row->canadapost_customer_number != '' && $settings_row->canadapost_ship_from_zip != '' ){
			
			if( !class_exists( "ec_shipper" ) ){
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_shipper.php' );
			}
			if( !class_exists( "ec_canadapost" ) ){
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_canadapost.php' );
			}
			
			$settings = new ec_setting( $settings_row );
			$canadapost = new ec_canadapost( $settings );
			$message = $canadapost->get_rate_test( "DOM.PC", $settings_row->canada_ship_from_zip, "CA", "1" );
			
			if( $message == "SUCCESS" ){
				$status = 'connected';
			}else{
				$status = 'error';
			}
		}
		return $status;
	}
	
	public function get_dhl_status( ){
		global $wpdb;
		$settings_row = $wpdb->get_row( "SELECT * FROM ec_setting" );
		
		$status = "disabled";
		if( $settings_row->dhl_site_id != '' && $settings_row->dhl_password != '' && $settings_row->dhl_ship_from_country != '' && $settings_row->dhl_ship_from_zip != '' && $settings_row->dhl_weight_unit != '' ){
			
			if( !class_exists( "ec_shipper" ) ){
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_shipper.php' );
			}
			if( !class_exists( "ec_dhl" ) ){
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_dhl.php' );
			}
			
			$settings = new ec_setting( $settings_row );
			$dhl_class = new ec_dhl( $settings );
			$dhl_response = $dhl_class->get_rate_test( "N", $settings_row->dhl_ship_from_zip, $settings_row->dhl_ship_from_country, "1" );
			$dhl_xml = new SimpleXMLElement( $dhl_response );
			
			if( $dhl_xml && $dhl_xml->Response && $dhl_xml->Response->Status && $dhl_xml->Response->Status->ActionStatus && $dhl_xml->Response->Status->ActionStatus == "Error" ){
				$status = 'error';
			}else if( $dhl_xml && $dhl_xml->GetQuoteResponse && $dhl_xml->GetQuoteResponse->Note && $dhl_xml->GetQuoteResponse->Note->Condition ){
				$status = 'error';
			}else{
				$status = 'connected';
			}
		}
		return $status;
	}
	
	public function get_fedex_status( ){
		global $wpdb;
		$settings_row = $wpdb->get_row( "SELECT * FROM ec_setting" );
		
		$status = "disabled";
		if( $settings_row->fedex_key && $settings_row->fedex_account_number && $settings_row->fedex_meter_number && $settings_row->fedex_password && $settings_row->fedex_ship_from_zip && $settings_row->fedex_weight_units && $settings_row->fedex_country_code ){
			
			if( !class_exists( "ec_shipper" ) ){
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_shipper.php' );
			}
			if( !class_exists( "ec_fedex" ) ){
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_fedex.php' );
			}
			
			$settings = new ec_setting( $settings_row );
			$fedex_class = new ec_fedex( $settings );
			$fedex_response = $fedex_class->get_rate_test( "FEDEX_GROUND", $settings_row->fedex_ship_from_zip, $settings_row->fedex_country_code, "1", 10, 10, 10, 10, array( (object) array( 'quantity' => 1, 'weight' => 1, 'width' => 10, 'length' => 10, 'height' => 10, 'is_shippable' => 1 ) ) );
			
			if( $fedex_response->HighestSeverity == 'FAILURE' || $fedex_response->HighestSeverity == 'ERROR' || ( $fedex_response->HighestSeverity == 'WARNING' && $fedex_response->Notifications->Code == 556 ) ){
				if( isset( $fedex_response->Notifications ) ){
					$status = 'error';
				}else{
					$status = 'error';
				}
			}else{
				$status = 'connected';
			}
		}
		return $status;
	}
	
	public function get_ups_status( ){
		global $wpdb;
		$settings_row = $wpdb->get_row( "SELECT * FROM ec_setting" );
		
		$status = "disabled";
		if( $settings_row->ups_access_license_number && $settings_row->ups_user_id && $settings_row->ups_password && $settings_row->ups_ship_from_zip && $settings_row->ups_shipper_number && $settings_row->ups_country_code && $settings_row->ups_weight_type ){
			
			if( !class_exists( "ec_shipper" ) ){
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_shipper.php' );
			}
			if( !class_exists( "ec_ups" ) ){
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_ups.php' );
			}
			
			// Run test of the settings
			$settings = new ec_setting( $settings_row );
			$ups_class = new ec_ups( $settings );
			$ups_response = $ups_class->get_rate_test( "01", $settings_row->ups_ship_from_zip, $settings_row->ups_country_code, "1", 10, 10, 10, 10, array( (object) array( 'quantity' => 1, 'weight' => 1, 'width' => 10, 'length' => 10, 'height' => 10, 'is_shippable' => 1 ) ) );
			$ups_response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $ups_response );
			$ups_xml = new SimpleXMLElement($ups_response);
			$body = $ups_xml->xpath('//soapenvBody');
			$body = $body[0];
			$db = new ec_db( );
			$db->insert_response( 0, 0, "UPS TEST XML", $ups_response . " ----- " . print_r( $body, true ) );
		
			if( !isset( $body->soapenvFault ) && $body->rateRateResponse->commonResponse->commonResponseStatus->commonCode == "1" ){
				$status = 'connected';
			}else{
				$status = 'error';
			}
		}
		return $status;
	}
	
	public function get_usps_status( ){
		global $wpdb;
		$settings_row = $wpdb->get_row( "SELECT * FROM ec_setting" );
		
		$status = "disabled";
		if( $settings_row->usps_user_name && $settings_row->usps_ship_from_zip ){
			
			if( !class_exists( "ec_shipper" ) ){
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_shipper.php' );
			}
			if( !class_exists( "ec_usps" ) ){
				include( WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/inc/classes/shipping/ec_usps.php' );
			}
			
			$settings = new ec_setting( $settings_row );
			$usps_class = new ec_usps( $settings );
			$usps_response = $usps_class->get_rate_test( "PRIORITY", $settings_row->usps_ship_from_zip, "US", "1", 0, 0, 0, 0, array( (object) array( 'quantity' => 1, 'weight' => 1, 'width' => 1, 'length' => 1, 'height' => 1, 'is_shippable' => 1 ) ) );
			
			if( strlen( $usps_response ) <= 0 )
				return 'error';
			
			$usps_xml = new SimpleXMLElement( $usps_response );
			
			if( $usps_xml->Number ){
				$status = 'error';
			}else if( $usps_xml->Package[0]->Error ){
				$status = 'error';
			}else{
				$status = 'connected';
			}
		}
		return $status;
	}
	
	/* Shipping Live Methods */
	public function add_shipping_live_rate( ){
		$is_auspost_based = $is_canadapost_based = $is_dhl_based = $is_fedex_based = $is_ups_based = $is_usps_based = 0;
		$free_shipping_at = -1;
		if( $_POST['ec_admin_new_live_free_shipping_threshold'] != '' )
			$free_shipping_at = $_POST['ec_admin_new_live_free_shipping_threshold'];
		
		${$_POST['ec_admin_new_live_code_type']} = 1;
		if( $_POST['ec_admin_new_live_override_rate'] != '' ){
			$this->wpdb->query( $this->wpdb->prepare( "INSERT INTO ec_shippingrate( is_auspost_based, is_canadapost_based, is_dhl_based, is_fedex_based, is_ups_based, is_usps_based, shipping_code, shipping_label, shipping_override_rate, free_shipping_at, zone_id ) VALUES( %d, %d, %d, %d, %d, %d, %s, %s, %s, %s, %d )", $is_auspost_based, $is_canadapost_based, $is_dhl_based, $is_fedex_based, $is_ups_based, $is_usps_based, $_POST['ec_admin_new_live_code_' . $_POST['ec_admin_new_live_code_type']], stripslashes_deep( $_POST['ec_admin_new_live_label'] ), $_POST['ec_admin_new_live_override_rate'], $free_shipping_at, $_POST['ec_admin_new_live_shipping_zone'] ) );
		}else{
			$this->wpdb->query( $this->wpdb->prepare( "INSERT INTO ec_shippingrate( is_auspost_based, is_canadapost_based, is_dhl_based, is_fedex_based, is_ups_based, is_usps_based, shipping_code, shipping_label, free_shipping_at, zone_id ) VALUES( %d, %d, %d, %d, %d, %d, %s, %s, %s, %d )", $is_auspost_based, $is_canadapost_based, $is_dhl_based, $is_fedex_based, $is_ups_based, $is_usps_based, $_POST['ec_admin_new_live_code_' . $_POST['ec_admin_new_live_code_type']], stripslashes_deep( $_POST['ec_admin_new_live_label'] ), $free_shipping_at, $_POST['ec_admin_new_live_shipping_zone'] ) );
		}
		return $this->wpdb->insert_id;
	}
	
	public function update_shipping_live_rate( ){
		$shipping_rates = $this->wpdb->get_results( "SELECT * FROM ec_shippingrate WHERE is_auspost_based = 1 OR is_canadapost_based = 1 OR is_dhl_based = 1 OR is_fedex_based = 1 OR is_ups_based = 1 OR is_usps_based = 1" );
		foreach( $shipping_rates as $trigger ){
			$is_auspost_based = $is_canadapost_based = $is_dhl_based = $is_fedex_based = $is_ups_based = $is_usps_based = 0;
			$free_shipping_at = -1;
			if( $_POST['ec_admin_new_live_free_shipping_threshold_'.$trigger->shippingrate_id] != '' )
				$free_shipping_at = $_POST['ec_admin_new_live_free_shipping_threshold_'.$trigger->shippingrate_id];
			${$_POST['ec_admin_new_live_code_type_' . $trigger->shippingrate_id]} = 1;
			if( $_POST['ec_admin_new_live_override_rate_'.$trigger->shippingrate_id] != '' ){
				$this->wpdb->query( $this->wpdb->prepare( "UPDATE ec_shippingrate SET is_auspost_based = %d, is_canadapost_based = %d, is_dhl_based = %d, is_fedex_based = %d, is_ups_based = %d, is_usps_based = %d, shipping_code = %s, shipping_label = %s, shipping_override_rate = %s, free_shipping_at = %s, zone_id = %d WHERE shippingrate_id = %d", $is_auspost_based, $is_canadapost_based, $is_dhl_based, $is_fedex_based, $is_ups_based, $is_usps_based, $_POST['ec_admin_new_live_code_' . $_POST['ec_admin_new_live_code_type_' . $trigger->shippingrate_id] . '_' . $trigger->shippingrate_id], stripslashes_deep( $_POST['ec_admin_new_live_label_'.$trigger->shippingrate_id] ), $_POST['ec_admin_new_live_override_rate_'.$trigger->shippingrate_id], $free_shipping_at, $_POST['ec_admin_new_live_shipping_zone_'.$trigger->shippingrate_id], $trigger->shippingrate_id ) );
			}else{
				$this->wpdb->query( $this->wpdb->prepare( "UPDATE ec_shippingrate SET is_auspost_based = %d, is_canadapost_based = %d, is_dhl_based = %d, is_fedex_based = %d, is_ups_based = %d, is_usps_based = %d, shipping_code = %s, shipping_label = %s, shipping_override_rate = NULL, free_shipping_at = %s, zone_id = %d WHERE shippingrate_id = %d", $is_auspost_based, $is_canadapost_based, $is_dhl_based, $is_fedex_based, $is_ups_based, $is_usps_based, $_POST['ec_admin_new_live_code_' . $_POST['ec_admin_new_live_code_type_' . $trigger->shippingrate_id] . '_' . $trigger->shippingrate_id], stripslashes_deep( $_POST['ec_admin_new_live_label_'.$trigger->shippingrate_id] ), $free_shipping_at, $_POST['ec_admin_new_live_shipping_zone_'.$trigger->shippingrate_id], $trigger->shippingrate_id ) );
			}
		}
	}
	
	public function add_live_rate_option( ){
		echo "<option value=\"live\" ";
		if( wp_easycart_admin( )->settings->shipping_method == 'live' ){
			echo " selected";
		}
		echo ">" . __( 'Live Shipping Rates', 'wp-easycart-pro' ) . "</option>";
	}
	
	public function delete_shipping_rate( ){
		$shippingrate_id = $_POST['shippingrate_id'];
		$this->wpdb->query( $this->wpdb->prepare( "DELETE FROM ec_shippingrate WHERE shippingrate_id = %d", $shippingrate_id ) );
	}
	
	/* Live Shipping Settings Update Functions */
	public function insert_base_auspost_rates( ){
        $this->wpdb->query( "INSERT INTO ec_shippingrate (is_demo_item, zone_id, is_price_based, is_weight_based, is_method_based, is_quantity_based, is_percentage_based, is_ups_based, is_usps_based, is_fedex_based, is_auspost_based, is_dhl_based, is_canadapost_based, trigger_rate, shipping_rate, shipping_label, shipping_order, shipping_code, shipping_override_rate, free_shipping_at) VALUES (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 'Australia Post Parcel Post', 0, 'AUS_PARCEL_REGULAR', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 'Australia Post Express Post', 0, 'AUS_PARCEL_EXPRESS', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 'Australia Post International Express', 0, 'INT_PARCEL_EXP_OWN_PACKAGING', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 'Australia Post International Standard', 0, 'INT_PARCEL_STD_OWN_PACKAGING', NULL, -1)" );
        $this->wpdb->query( $this->wpdb->prepare( "UPDATE ec_setting SET shipping_method = %s", 'live' ) );
    }
	
	public function insert_base_capost_rates( ){
        $this->wpdb->query( "INSERT INTO ec_shippingrate (is_demo_item, zone_id, is_price_based, is_weight_based, is_method_based, is_quantity_based, is_percentage_based, is_ups_based, is_usps_based, is_fedex_based, is_auspost_based, is_dhl_based, is_canadapost_based, trigger_rate, shipping_rate, shipping_label, shipping_order, shipping_code, shipping_override_rate, free_shipping_at) VALUES (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 'Canada Post Regular Parcel - Domestic', 0, 'DOM.RP', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 'Canada Post Priority - Domestic', 0, 'DOM.PC', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 'Canada post Xpresspost - Domestic', 0, 'DOM.XP', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 'Canada Post Expedited Parcel - USA', 0, 'USA.EP', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 'Canada Post Priority Parcel - USA', 0, 'USA.PW.PARCEL', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 'Canada Post Xpresspost - USA', 0, 'USA.XP', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 'Canada Post Parcel Air - International', 0, 'INT.IP.AIR', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 'Canada Post Priority Parcel - International', 0, 'INT.PW.PARCEL', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 'Canada Post Xpresspost - International', 0, 'INT.XP', NULL, -1)" );
        $this->wpdb->query( $this->wpdb->prepare( "UPDATE ec_setting SET shipping_method = %s", 'live' ) );
    }
	
	public function insert_base_dhl_rates( ){
        $this->wpdb->query( "INSERT INTO ec_shippingrate (is_demo_item, zone_id, is_price_based, is_weight_based, is_method_based, is_quantity_based, is_percentage_based, is_ups_based, is_usps_based, is_fedex_based, is_auspost_based, is_dhl_based, is_canadapost_based, trigger_rate, shipping_rate, shipping_label, shipping_order, shipping_code, shipping_override_rate, free_shipping_at) VALUES (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 'DHL Domestic Express', 0, 'N', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 'DHL Economy Select', 0, 'H', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 'DHL Europack', 0, '9', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 'DHL Same Day', 0, 'S', NULL, -1)" );
        $this->wpdb->query( $this->wpdb->prepare( "UPDATE ec_setting SET shipping_method = %s", 'live' ) );
    }
	
	public function insert_base_fedex_rates( ){
        $this->wpdb->query( "INSERT INTO ec_shippingrate (is_demo_item, zone_id, is_price_based, is_weight_based, is_method_based, is_quantity_based, is_percentage_based, is_ups_based, is_usps_based, is_fedex_based, is_auspost_based, is_dhl_based, is_canadapost_based, trigger_rate, shipping_rate, shipping_label, shipping_order, shipping_code, shipping_override_rate, free_shipping_at) VALUES (0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 'FedEx Ground', 0, 'GROUND_HOME_DELIVERY', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 'FedEx 2 Day', 0, 'FEDEX_2_DAY', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 'FedEx Priority Overnight', 0, 'PRIORITY_OVERNIGHT', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 'FedEx International Economy', 0, 'INTERNATIONAL_ECONOMY', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 'FedEx International First', 0, 'INTERNATIONAL_FIRST', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 'FedEx International Priority', 0, 'INTERNATIONAL_PRIORITY', NULL, -1)" );
        $this->wpdb->query( $this->wpdb->prepare( "UPDATE ec_setting SET shipping_method = %s", 'live' ) );
    }
	
	public function insert_base_ups_rates( ){
        $this->wpdb->query( "INSERT INTO ec_shippingrate (is_demo_item, zone_id, is_price_based, is_weight_based, is_method_based, is_quantity_based, is_percentage_based, is_ups_based, is_usps_based, is_fedex_based, is_auspost_based, is_dhl_based, is_canadapost_based, trigger_rate, shipping_rate, shipping_label, shipping_order, shipping_code, shipping_override_rate, free_shipping_at) VALUES (0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'UPS Next Day Air', 0, '01', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'UPS Second Day Air', 0, '02', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'UPS Ground', 0, '03', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'UPS Standard', 0, '11', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'UPS Three-Day Select', 0, '12', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'UPS Next Day Air Saver', 0, '13', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'UPS Express', 0, '07', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'UPS Saver', 0, '65', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'UPS Worldwide ExpressSM', 0, '07', NULL, -1);" );
        $this->wpdb->query( $this->wpdb->prepare( "UPDATE ec_setting SET shipping_method = %s", 'live' ) );
    }
	
	public function insert_base_usps_rates( ){
        $this->wpdb->query( "INSERT INTO ec_shippingrate (is_demo_item, zone_id, is_price_based, is_weight_based, is_method_based, is_quantity_based, is_percentage_based, is_ups_based, is_usps_based, is_fedex_based, is_auspost_based, is_dhl_based, is_canadapost_based, trigger_rate, shipping_rate, shipping_label, shipping_order, shipping_code, shipping_override_rate, free_shipping_at) VALUES (0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 'USPS Retail Ground', 0, 'STANDARD POST', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 'USPS Priority', 0, 'PRIORITY', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 'USPS Express', 0, 'EXPRESS', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 'USPS Plus', 0, 'PLUS', NULL, -1), (0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 'USPS First Class', 0, 'FIRST CLASS', NULL, -1);" );
        $this->wpdb->query( $this->wpdb->prepare( "UPDATE ec_setting SET shipping_method = %s", 'live' ) );
    }
    
    public function save_shipping_settings( ){
		global $wpdb;
        
        $auspost_options = array( 'auspost_api_key', 'auspost_ship_from_zip' );
        $capost_options = array( 'canadapost_username', 'canadapost_password', 'canadapost_customer_number', 'canadapost_contract_id', 'canadapost_ship_from_zip', 'canadapost_test_mode' );
        $dhl_options = array( 'dhl_site_id', 'dhl_password', 'dhl_ship_from_zip', 'dhl_ship_from_country', 'dhl_weight_unit', 'dhl_test_mode' );
        $fedex_options = array( 'fedex_key', 'fedex_account_number', 'fedex_meter_number', 'fedex_password', 'fedex_ship_from_zip', 'fedex_country_code', 'fedex_weight_units', 'fedex_conversion_rate', 'fedex_test_account' );
        $ups_options = array( 'ups_access_license_number', 'ups_user_id', 'ups_password', 'ups_shipper_number', 'ups_ship_from_zip', 'ups_country_code', 'ups_weight_type', 'ups_conversion_rate', 'ups_negotiated_rates' );
        $usps_options = array( 'usps_user_name', 'usps_ship_from_zip' );
		
        $type = '';
        if( in_array( $_POST['update_var'], $auspost_options ) ){
            $type = 'auspost';
            
        }else if( in_array( $_POST['update_var'], $capost_options ) ){
            $type = 'canadapost';
            
        }else if( in_array( $_POST['update_var'], $dhl_options ) ){
            $type = 'dhl';
            
        }else if( in_array( $_POST['update_var'], $fedex_options ) ){
            $type = 'fedex';
            
        }else if( in_array( $_POST['update_var'], $ups_options ) ){
            $type = 'ups';
            
        }else if( in_array( $_POST['update_var'], $usps_options ) ){
            $type = 'usps';
            
        }
        
        if( $type != '' ){
            $this->wpdb->query( $this->wpdb->prepare( "UPDATE ec_setting SET " . $_POST['update_var'] . " = %s", trim( stripslashes_deep( $_POST['val'] ) ) ) );
                 
            /* Live Rate Initializations */
            $current_rates = $this->wpdb->get_results( "SELECT * FROM ec_shippingrate WHERE is_" . $type . "_based = 1" );
            if( !$current_rates ){
                if( $type == 'canadapost' ){
                    $this->{'insert_base_capost_rates'}( );
                }else{
                    $this->{'insert_base_' . $type . '_rates'}( );
                }
            }
            
        }else if( $_POST['update_var'] == 'ec_option_dhl_account_number' || $_POST['update_var'] == 'dhl_ship_from_country' || $_POST['update_var'] == 'dhl_weight_unit' ){
            $type = 'dhl';
            update_option( $_POST['update_var'], trim( stripslashes_deep( $_POST['val'] ) ) );
            
        }
        
        echo json_encode( (object) array( 'type' => $type, 'response' => $this->{'get_' . $type . '_status'}( ) ) );
	}
	
}
endif; // End if class_exists check

function wp_easycart_admin_live_shipping_rates_pro( ){
	return wp_easycart_admin_live_shipping_rates_pro::instance( );
}
wp_easycart_admin_live_shipping_rates_pro( );

add_action( 'wp_ajax_ec_admin_ajax_add_live_trigger', 'ec_admin_ajax_add_live_trigger' );
function ec_admin_ajax_add_live_trigger( ){
	global $wpdb;
	$currency = new ec_currency( );
	$shippingrate_id = wp_easycart_admin_live_shipping_rates_pro( )->add_shipping_live_rate( );
	$trigger = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ec_shippingrate WHERE shippingrate_id = %d", $shippingrate_id ) );
	wp_easycart_admin( )->init_shipping_data( );
	wp_easycart_admin_live_shipping_rates_pro( )->load_live_rates( );
	die( );
}

add_action( 'wp_ajax_ec_admin_ajax_delete_live_trigger', 'ec_admin_ajax_delete_live_trigger' );
function ec_admin_ajax_delete_live_trigger( ){
	global $wpdb;
	wp_easycart_admin_live_shipping_rates_pro( )->delete_shipping_rate( $_POST['shippingrate_id'] );
	$rows = $wpdb->get_results( "SELECT * FROM ec_shippingrate WHERE is_auspost_based = 1 OR is_canadapost_based = 1 OR is_dhl_based = 1 OR is_fedex_based = 1 OR is_ups_based = 1 OR is_usps_based = 1" );
	echo count( $rows );
	die( );
}

add_action( 'wp_ajax_ec_admin_ajax_update_shipping_live_triggers', 'ec_admin_ajax_update_shipping_live_triggers' );
function ec_admin_ajax_update_shipping_live_triggers( ){
	wp_easycart_admin_live_shipping_rates_pro( )->update_shipping_live_rate( );
	die( );
}

add_action( 'wp_ajax_ec_admin_ajax_save_shipping_settings_pro', 'ec_admin_ajax_save_shipping_settings_pro' );
function ec_admin_ajax_save_shipping_settings_pro( ){
	wp_easycart_admin_live_shipping_rates_pro( )->save_shipping_settings( );
	die( );
}
?>