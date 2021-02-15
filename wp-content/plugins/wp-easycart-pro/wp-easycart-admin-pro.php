<?php
/**
 * Plugin Name: WP EasyCart PRO
 * Plugin URI: http://www.wpeasycart.com
 * Description: This extension to the EasyCart adds all of the PRO features to your WP EasyCart shopping cart system.
 
 * Version: 5.0.1
 * Author: WP EasyCart
 * Author URI: http://www.wpeasycart.com
 * Text Domain: wp-easycart-pro
 * Domain Path: /languages
 
 * @package wp-easycart-pro
 * @version 5.0.1
 * @author WP EasyCart <sales@wpeasycart.com>
 * @copyright Copyright (c) 2012, WP EasyCart
 * @link http://www.wpeasycart.com
 */

if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'wp_easycart_admin_pro' ) ) :

final class wp_easycart_admin_pro{
	
	protected static $_instance = null;
	
	public static function instance( ) {
		if( is_null( self::$_instance ) ) {
			self::$_instance = new self(  );
		}
		return self::$_instance;
	}
	
	public function __construct( ){ 
		if( !defined( 'WP_EASYCART_ADMIN_PRO_PLUGIN_DIR' ) )
			define( 'WP_EASYCART_ADMIN_PRO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			
		if( ! defined( 'WP_EASYCART_ADMIN_PRO_PLUGIN_URL' ) )
			define( 'WP_EASYCART_ADMIN_PRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		if( ! defined( 'WP_EASYCART_ADMIN_PRO_PLUGIN_FILE' ) )
			define( 'WP_EASYCART_ADMIN_PRO_PLUGIN_FILE', __FILE__ );
	
		if( !defined( 'WP_EASYCART_ADMIN_PRO_VERSION' ) )
			define( 'WP_EASYCART_ADMIN_PRO_VERSION', '5.0.1' );
			
		/* WP Hooks */
        add_action( 'plugins_loaded', array( $this, 'load_translation' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
		add_action( 'admin_notices', array( $this, 'v3_wp_easycart_check' ) );
		add_action( "in_plugin_update_message-wp-easycart-pro/wp-easycart-admin-pro.php", array( $this, 'show_upgrade_message' ), 10, 2 );
		add_action( 'wp_easycart_admin_messages', array( $this, 'maybe_show_square_upgrade' ) );
		add_action( 'wp_easycart_admin_messages', array( $this, 'trial_expired_check' ), 1 );
		add_action( 'wpeasycart_order_paid', array( $this, 'maybe_send_push_notification' ), 10, 1 );
		
		add_filter( 'wp_easycart_stripe_connect_fee_rate', array( $this, 'remove_stripe_fee' ) );
		add_filter( 'wp_easycart_allow_paypal_express', array( $this, 'allow_express' ) );
		
		/* WP EC Hooks */
		add_action( 'wp_easycart_admin_pro_ready', array( $this, 'load_admin_pro' ) );
		
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'plugin-updates/plugin-update-checker.php' );
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'license/ec_license_manager.php' );
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'license/wp_easycart_admin_license.php' );
		
		$license_type = wp_easycart_admin_license( )->license_check( );
		$registration_info = get_option( 'wp_easycart_license_info' );
		$license_data = ec_license_manager( )->ec_get_license( );
		
		if( $license_type == "trial" ){
			add_filter( 'wp_easycart_trial_start_content', array( $this, 'remove_trial_start_content' ) );
			add_filter( 'wp_easycart_upgrade_pro_url', array( $this, 'update_pro_upgrade_url' ) );
			add_filter( 'wp_easycart_upgrade_premium_url', array( $this, 'update_premium_upgrade_url' ) );
		}
		
		if( $license_type == "trial" && wp_easycart_admin_license( )->license_expired ){
			add_action( 'wp_easycart_email_receipt_top', array( $this, 'show_admin_email_trial_notice' ), 10, 2 );
			
		}else if( wp_easycart_admin_license( )->license_expired ){
			add_action( 'wp_easycart_email_receipt_top', array( $this, 'show_admin_email_renew_notice' ), 10, 2 );
		}
		
		if( wp_easycart_admin_license( )->license_expired ){
			add_filter( 'wp_easycart_admin_upgrade_file', array( $this, 'replace_with_renew' ) );
			add_filter( 'admin_notices', array( $this, 'license_expired_notice' ) );
		}
		
		if( is_admin( ) ){
			if( is_callable( 'socket_create' ) && is_callable( 'socket_connect' ) && is_callable( 'socket_close' ) ){
				$socket = socket_create( AF_INET, SOCK_STREAM, SOL_TCP );
				$connection = @socket_connect( $socket, "connect.wpeasycart.com", 443 );
				$url = ( $connection ) ? "https://connect.wpeasycart.com" : "https://support.wpeasycart.com";
				@socket_close( $socket );
			}else{
				$url = "https://connect.wpeasycart.com";
			}
			
			if( $url == "https://support.wpeasycart.com" ){
				if( is_callable( 'socket_create' ) && is_callable( 'socket_connect' ) && is_callable( 'socket_close' ) ){
					$socket = socket_create( AF_INET, SOCK_STREAM, SOL_TCP );
					$connection = @socket_connect( $socket, "support.wpeasycart.com", 443 );
					$url = ( $connection ) ? "https://support.wpeasycart.com" : false;
					@socket_close( $socket );
				}else{
					$url = "https://support.wpeasycart.com";
				}
			}
			
			if( $url ){
			
				if( $registration_info && isset( $registration_info['transaction_key'] ) ){
					$MyUpdateChecker = new PluginUpdateChecker_2_0(
						$url . '/downloads/wp-easycart-pro/wp-easycart-admin-pro.php?transaction_key='.$registration_info['transaction_key'],
						__FILE__,
						'wp-easycart-pro'
					);
				
				}else if( $license_data && isset( $license_data->siteurl ) ){
					$MyUpdateChecker = new PluginUpdateChecker_2_0(
						$url . '/downloads/wp-easycart-pro/wp-easycart-admin-pro.php?siteurl='.$license_data->siteurl,
						__FILE__,
						'wp-easycart-pro'
					);
				
				}else{
					$MyUpdateChecker = new PluginUpdateChecker_2_0(
						$url . '/downloads/wp-easycart-pro/wp-easycart-admin-pro.php',
						__FILE__,
						'wp-easycart-pro'
					);
				}
				
			}
		}
	}
	
	public function show_admin_email_trial_notice( $order_id, $is_admin ){
		if( $is_admin ){
			echo '<tr height="10"><td colspan="4" style="background-color:#a01818;"></td></tr>';
			echo '<tr><td colspan="4" align="center" style="background-color:#a01818; color:#FFF; text-align:center; font-size:26px;">';
			echo __( 'YOUR WP EASYCART TRIAL IS OVER!', 'wp-easycart-pro' ) . '<br />';
			echo '<a class="button" href="';
			echo $this->update_pro_upgrade_url( $url );
			echo '" style="color:white;" target="_blank">' . __( 'CLICK TO UPGRADE', 'wp-easycart-pro' ) . '</a>';
			echo '</td></tr>';
			echo '<tr height="10"><td colspan="4" style="background-color:#a01818;"></td></tr>';
			echo '<tr height="25"><td colspan="4" style="background-color:#ffffff;"></td></tr>';
		}
	}
	
	public function show_admin_email_renew_notice( $order_id, $is_admin ){
		if( $is_admin ){
			echo '<tr height="10"><td colspan="4" style="background-color:#a01818;"></td></tr>';
			echo '<tr><td colspan="4" align="center" style="background-color:#a01818; color:#FFF; text-align:center; font-size:20px;">';
			$license_data = ec_license_manager( )->ec_get_license( );
			$license_info = get_option( 'wp_easycart_license_info' );
			echo sprintf( __( 'YOUR WP EASYCART LICENSE IS EXPIRED! Please renew today to continue using your %s license.', 'wp-easycart-pro' ), ( ( $license_data->model_number == 'ec400' ) ? 'Professional' : 'Premium' ) );
			echo '<br /><a class="button" href="';
			if( $license_data->model_number == 'ec400' ){
				echo 'https://www.wpeasycart.com/products/wp-easycart-professional-support-upgrades/?transaction_key=' . $license_info['transaction_key'];
			}else{
				echo 'https://www.wpeasycart.com/products/wp-easycart-premium-support-extensions/?transaction_key=' . $license_info['transaction_key'];
			}
			echo '" style="color:white;" target="_blank">' . __( 'CLICK TO RENEW NOW', 'wp-easycart-pro' ) . '</a>';
			echo '</td></tr>';
			echo '<tr height="10"><td colspan="4" style="background-color:#a01818;"></td></tr>';
			echo '<tr height="25"><td colspan="4" style="background-color:#ffffff;"></td></tr>';
		}
	}
	
	public function update_pro_upgrade_url( $url ){
		$license_info = get_option( 'wp_easycart_license_info' );
		if( is_array( $license_info ) && isset( $license_info['transaction_key'] ) ){
			return 'https://www.wpeasycart.com/products/wp-easycart-trial-upgrade/?transaction_key=' . $license_info['transaction_key'] . '&license_type=Professional';
		}
		return $url;
	}
	
	public function update_premium_upgrade_url( $url ){
		$license_info = get_option( 'wp_easycart_license_info' );
		if( is_array( $license_info ) && isset( $license_info['transaction_key'] ) ){
			return 'https://www.wpeasycart.com/products/wp-easycart-trial-upgrade/?transaction_key=' . $license_info['transaction_key'] . '&license_type=Premium';
		}
		return $url;
	}
	
	public function remove_trial_start_content( $content ){
		return "";
	}
	
	public function replace_with_renew( $file ){
		return WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'license/renew.php';
	}
	
	public function show_upgrade_message( $plugin_data, $response ){
		if( wp_easycart_admin_license( )->license_data->key_version == 'v3' ){
            echo '</p></div><div class="update-message notice inline notice-error notice-alt"><p>' . sprintf( __( 'Updates are disabled because your license no longer supports updates. Please %sclick here%s to go to your account and upgrade your license.', 'wp-easycart-pro' ), '<a href="http://www.wpeasycart.com/my-account" target="_blank">', '</a>' ) . '<script>jQuery( "#wp-easycart-pro-update > td > .notice-warning" ).remove( );</script>';
        }else if( !wp_easycart_admin_license( )->valid_license ){
			echo '</p></div><div class="update-message notice inline notice-error notice-alt"><p>' . sprintf( __( 'No license was found. If you have already purchased a license register it by %s clicking here %s. If you are in need of a license, %s purchase one here %s.', 'wp-easycart-pro' ), '<a href="admin.php?page=wp-easycart-registration&subpage=registration">', '</a>', '<a href="' . apply_filters( 'wp_easycart_upgrade_pro_url', 'https://www.wpeasycart.com/wordpress-shopping-cart-pricing/' ) . '" target="_blank">', '</a>' ) . '<script>jQuery( "#wp-easycart-pro-update > td > .notice-warning" ).remove( );</script>';
		}else if( !wp_easycart_admin_license( )->active_license ){
			$registration_info = get_option( 'wp_easycart_license_info' );
			if( $registration_info ){
				echo '</p></div><div class="update-message notice inline notice-error notice-alt"><p>' . sprintf( __( 'Updates are disabled because your license has expired. Please %sclick here to renew your license%s and continue receiving updates.', 'wp-easycart-pro' ), '<a href="http://www.wpeasycart.com/products/wp-easycart-professional-support-upgrades/?transaction_key=' . $registration_info['transaction_key'] . '" target="_blank">', '</a>' ) . '<script>jQuery( "#wp-easycart-pro-update > td > .notice-warning" ).remove( );</script>';
			}else{
				echo '</p></div><div class="update-message notice inline notice-error notice-alt"><p>' . sprintf( __( 'Updates are disabled because your license has expired. Please %sclick here%s to go to your account and renew your license.', 'wp-easycart-pro' ), '<a href="http://www.wpeasycart.com/my-account" target="_blank">', '</a>' ) . '<script>jQuery( "#wp-easycart-pro-update > td > .notice-warning" ).remove( );</script>';
			}
		}
	}
	
	public function load_admin_pro( ){
		if( wp_easycart_admin_license( )->is_licensed( ) ){
			remove_action( 'wp_easycart_admin_messages', array( wp_easycart_admin( ), 'load_upsell_image' ) );
			remove_action( 'wp_easycart_admin_upsell_popup', array( wp_easycart_admin( ), 'load_upsell_popup' ) );
			add_action( 'wp_easycart_admin_product_slideout_option_types', array( $this, 'add_product_slideout_option' ) );
			add_filter( 'wp_easycart_admin_lock_icon', array( $this, 'remove_lock_icon' ) );
		}
		if( isset( $_GET['page'] ) && $_GET['page'] == 'wp-easycart-rates' ){
			include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_abandon_cart_pro.php' );
			include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_coupons_pro.php' );
			include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_giftcards_pro.php' );
			include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_promotions_pro.php' );
		
		}
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_products_pro.php' );
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_subscription_plans_pro.php' );
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_downloads_pro.php' );
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_live_shipping_rates_pro.php' );
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_orders_pro.php' );
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_payments_pro.php' );
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_subscriptions_pro.php' );
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_taxes_pro.php' );
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_third_party_pro.php' );
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/inc/wp_easycart_admin_user_role_pro.php' );
	}
	
	public function remove_lock_icon( $content ){
		return "";
	}
	
	public function remove_stripe_fee( $fee ){
		if( wp_easycart_admin_license( )->valid_license && wp_easycart_admin_license( )->active_license )
			return 0;
		return $fee;
	}
	
	public function allow_express( $allow ){
		if( wp_easycart_admin_license( )->valid_license && wp_easycart_admin_license( )->active_license )
			$allow = true;
		return $allow;
	}
	
	public function add_product_slideout_option( ){
		echo '<option value="2">Advanced Options</option>';
	}
	
	public function maybe_show_square_upgrade( ){
		if( get_option( 'ec_option_payment_process_method' ) == 'square' && get_option( 'ec_option_square_application_id' ) != '' ){
			$app_redirect_state = rand( 1000000, 9999999 );
			echo '<div style="width:100%; text-align:center; max-width:100%;"><a href="https://support.wpeasycart.com/square/?url=' . admin_url( ) . '&state=' . $app_redirect_state . '"><img src="' . plugins_url( 'wp-easycart-pro/admin/images/Square-Upgrade-Banner.png' ) . '" style="max-width:100%; height:auto;" alt="' . sprintf( __( 'Update Your %s Setup', 'wp-easycart-pro' ), 'Square' ) . '" /></a></div>';
		}
	}
	
	public function trial_expired_check( ){
		if( isset( wp_easycart_admin_license( )->license_data->response_error ) ){
			echo '<h3 style="background:#00bcd4; color:#FFF; padding:20px; margin:0 20px 0 19px; text-align:center;">' . __( 'The WP EasyCart Registration system is currently down. We have temporarily disabled registration checks and you will see this V3 message in the meantime. Please disregard at this time.', 'wp-easycart-pro' ) . '</h3>';
			
		}else if( isset( wp_easycart_admin_license( )->license_data->is_trial ) && wp_easycart_admin_license( )->license_data->is_trial && strtotime( date( 'Y-m-d', strtotime( wp_easycart_admin_license( )->license_data->support_end_date ) ) ) < strtotime( date( 'Y-m-d' ) ) ){
			echo '<h3 style="background:#a01818; color:#FFF; padding:20px; margin:0 10px; text-align:center;">' . __( 'Your PRO Trial Has EXPIRED.', 'wp-easycart-pro' ) . ' <a href="https://www.wpeasycart.com/products/wp-easycart-trial-upgrade/';
			$license_info = get_option( 'wp_easycart_license_info' );
			if( is_array( $license_info ) && isset( $license_info['transaction_key'] ) ){ 
				echo '?transaction_key=' . $license_info['transaction_key'];
			}
			echo '" target="_blank" style="margin-left:10px; border-radius:5px; background:#FFF; padding:5px 10px; font-size:14px; text-decoration:none; text-transform:uppercase; color:#a01818; border:2px solid #f1f1f1;">' . __( 'Upgrade Now', 'wp-easycart-pro' ) . '</a></h3>';
			remove_all_actions( 'wp_easycart_admin_shell_content' );
			$registration = new wp_easycart_admin_registration( );
			$registration->load_registration_status( );
		
		}else if( isset( wp_easycart_admin_license( )->license_data->is_trial ) && wp_easycart_admin_license( )->license_data->is_trial ){
			echo '<h3 style="background:#00bcd4; color:#FFF; padding:20px; margin:0 20px 0 19px; text-align:center;">' . sprintf( __( 'Your PRO Trial is Active. Trial Expires on %s', 'wp-easycart-pro' ), date( 'F d, Y', strtotime( wp_easycart_admin_license( )->license_data->support_end_date ) ) ) . ' <a href="' . apply_filters( 'wp_easycart_upgrade_pro_url', 'https://www.wpeasycart.com/wordpress-shopping-cart-pricing/' ) . '" target="_blank" style="margin-left:10px; border-radius:5px; background:#FFF; padding:5px 10px; font-size:14px; text-decoration:none; text-transform:uppercase; color:#02bcd4; border:2px solid #f1f1f1;">' . __( 'Upgrade Now', 'wp-easycart-pro' ) . '</a></h3>';
		
		}
	}
	
	public function __clone( ) {
		// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'wp-easycart-pro' ), '1.0' );
	}
	
	public function __wakeup( ){
		// Unserializing instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'wp-easycart-pro' ), '1.0' );
	}
    
    public function load_translation( ){
        load_plugin_textdomain( 'wp-easycart-pro', FALSE, '/wp-easycart-pro/languages' );
    }
	
	public function load_scripts( ){
		if( current_user_can( 'manage_options' ) && isset( $_GET['page'] ) && substr( $_GET['page'], 0, 11 ) == "wp-easycart" ){
			if( isset( $_GET['page'] ) && $_GET['page'] == "wp-easycart-rates" && isset( $_GET['subpage'] ) && $_GET['subpage'] == "coupons" ){
				wp_register_script( 'wp_easycart_admin_coupons_js', WP_EASYCART_ADMIN_PRO_PLUGIN_URL . '/admin/js/coupons.js', array( 'jquery' ), EC_CURRENT_VERSION );
				wp_enqueue_script( 'wp_easycart_admin_coupons_js' );
			}else if( isset( $_GET['page'] ) && $_GET['page'] == "wp-easycart-rates" && isset( $_GET['subpage'] ) && $_GET['subpage'] == "promotions" ){
				wp_register_script( 'wp_easycart_admin_promotions_js', WP_EASYCART_ADMIN_PRO_PLUGIN_URL . '/admin/js/promotions.js', array( 'jquery' ), EC_CURRENT_VERSION );
				wp_enqueue_script( 'wp_easycart_admin_promotions_js' );	
			}else if( isset( $_GET['page'] ) && $_GET['page'] == "wp-easycart-orders" && ( !isset( $_GET['subpage'] ) || $_GET['subpage'] == "orders" ) ){
				wp_register_script( 'wp_easycart_admin_orders_pro_js', WP_EASYCART_ADMIN_PRO_PLUGIN_URL . 'admin/js/orders.js', array( 'jquery' ), WP_EASYCART_ADMIN_PRO_VERSION );
				wp_enqueue_script( 'wp_easycart_admin_orders_pro_js' );
			}else if( isset( $_GET['page'] ) && $_GET['page'] == "wp-easycart-orders" && isset( $_GET['subpage'] ) && $_GET['subpage'] == "subscriptions" ){
				wp_register_script( 'wp_easycart_admin_subscriptions_pro_js', WP_EASYCART_ADMIN_PRO_PLUGIN_URL . 'admin/js/subscriptions.js', array( 'jquery' ), WP_EASYCART_ADMIN_PRO_VERSION );
				wp_enqueue_script( 'wp_easycart_admin_subscriptions_pro_js' );
			}else if( isset( $_GET['page'] ) && $_GET['page'] == "wp-easycart-orders" && isset( $_GET['subpage'] ) && $_GET['subpage'] == "downloads" ){
				wp_register_script( 'wp_easycart_admin_downloads_js', WP_EASYCART_ADMIN_PRO_PLUGIN_URL . 'admin/js/downloads.js', array( 'jquery' ), EC_CURRENT_VERSION );
				wp_enqueue_script( 'wp_easycart_admin_downloads_js' );
			}else if( isset( $_GET['page'] ) && $_GET['page'] == "wp-easycart-settings" && isset( $_GET['subpage'] ) && $_GET['subpage'] == "shipping-settings" ){
				wp_register_script( 'wp_easycart_admin_shipping_settings_pro_js', WP_EASYCART_ADMIN_PRO_PLUGIN_URL . 'admin/js/shipping-settings.js', array( 'jquery' ), EC_CURRENT_VERSION );
				wp_enqueue_script( 'wp_easycart_admin_shipping_settings_pro_js' );
			}
		}
	}
	
	public function v3_wp_easycart_check( ){
		if( !$this->is_wp_easycart_installed( ) ){
			echo '<div class="updated">';
			echo '<p>' . sprintf( __( 'WP EasyCart PRO requires WP EasyCart Version 4.0.0 or greater. Please %sclick here to install WP EasyCart%s', 'wp-easycart-pro' ), '<a href="' . admin_url( 'plugin-install.php?s=wp-easycart&tab=search&type=term' ) . '">', '</a>' ) . '</p>';
			echo '</div>';
			
		}else if( $this->is_wp_easycart_v3( ) ){
			echo '<div class="updated">';
			echo '<p>' . sprintf( __( 'WP EasyCart PRO requires WP EasyCart Version 4.0.0 or greater. Please %sclick here to update your WP EasyCart plugin%s', 'wp-easycart-pro' ), '<a href="' . admin_url( 'update-core.php' ) . '">', '</a>' ) . '</p>';
			echo '</div>';
			echo '<style>#setting-error-wpec_tgmpa{ display:none !important; }</style>';
		}
	}
	
	public function license_expired_notice( ){
		echo '<div class="notice notice-error">';
		echo '<p>';
		$license_data = ec_license_manager( )->ec_get_license( );
		$license_info = get_option( 'wp_easycart_license_info' );
		if( wp_easycart_admin_license( )->license_data->is_trial ){
			echo sprintf( __( 'Your WP EasyCart trial expired on %s. Please upgrade today to continue using the WP EasyCart.', 'wp-easycart-pro' ), date( 'F j, Y', strtotime( wp_easycart_admin_license( )->license_data->support_end_date ) ) );
			echo '<a class="button" href="https://www.wpeasycart.com/products/wp-easycart-trial-upgrade/?transaction_key=' . $license_info['transaction_key'];
			echo '" style="margin-left:10px; color:white; background-color:#0085ba;" target="_blank">' . __( 'UPGRADE NOW', 'wp-easycart-pro' ) . '</a>';
		}else{
			echo sprintf( __( 'Your WP EasyCart license expired on %s. You have been reverted to the FREE edition and 2%% fees may apply. Please renew today to continue using your %s license.', 'wp-easycart-pro' ), date( 'F j, Y', strtotime( wp_easycart_admin_license( )->license_data->support_end_date ) ), ( ( $license_data->model_number == 'ec400' ) ? 'Professional' : 'Premium' ) );
			echo '<a class="button" href="';
			if( $license_data->model_number == 'ec400' ){
				echo 'https://www.wpeasycart.com/products/wp-easycart-professional-support-upgrades/?transaction_key=' . $license_info['transaction_key'];
			}else{
				echo 'https://www.wpeasycart.com/products/wp-easycart-premium-support-extensions/?transaction_key=' . $license_info['transaction_key'];
			}
			echo '" style="margin-left:10px; color:white; background-color:#0085ba;" target="_blank">' . __( 'RENEW NOW', 'wp-easycart-pro' ) . '</a>';
		}
		echo '</p>';
		echo '</div>';
	}
	
	public function is_wp_easycart_installed( ){
		if( file_exists( WP_PLUGIN_DIR . '/wp-easycart/wpeasycart.php' ) ){
			return true;
		}else{
			return false;
		}
	}
	
	public function is_wp_easycart_v3( ){
		$plugin_file = WP_PLUGIN_DIR . '/wp-easycart/wpeasycart.php';
		if( file_exists( $plugin_file ) ){
			$plugin_info = get_plugin_data( $plugin_file );
			if( version_compare( $plugin_info['Version'], '4.0.0' ) < 0 ){
				return true;
			}
		}
		return false;
	}
	
	public function maybe_send_push_notification( $order_id ){
		if( get_option( 'ec_option_enable_push_notifications' ) ){
			global $wpdb;
			$order = $wpdb->get_row( $wpdb->prepare( "SELECT order_id, grand_total FROM ec_order WHERE order_id = %d", $order_id ) );
			$app_url = str_replace( "www.", "", str_replace( "http://", "", str_replace( "https://", "", get_site_url( ) ) ) );
			$license = get_option( 'wp_easycart_license_info' );
			$transaction_key = $license['transaction_key'];
			$url = "https://connect.wpeasycart.com/notifications/create.php?order_id=".$order->order_id."&grand_total=".urlencode( $GLOBALS['currency']->get_currency_display( $order->grand_total ) )."&app_url=".urlencode( $app_url )."&transaction_key=".urlencode( $transaction_key );
			
			$ch = curl_init( );
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_POST, false ); 
			curl_setopt( $ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch, CURLOPT_TIMEOUT, (int) 30 );
			curl_exec(   $ch );
			curl_close(  $ch );
		}
	}
	
}
endif; // End if class_exists check

function wp_easycart_admin_pro( ){
	return wp_easycart_admin_pro::instance( );
}
wp_easycart_admin_pro( );

register_uninstall_hook( __FILE__, 'wp_easycart_admin_pro_uninstall' );
function wp_easycart_admin_pro_uninstall( ){
	delete_transient( 'ec_license_data' );
}

add_action( 'activated_plugin', 'wp_easycart_pro_activation_redirect' );
function wp_easycart_pro_activation_redirect( $plugin ) {
    do_action( 'wpeasycart_pro_activated' );
    if( $plugin == plugin_basename( __FILE__ ) && wp_easycart_admin_pro( )->is_wp_easycart_installed( ) && !wp_easycart_admin_pro( )->is_wp_easycart_v3( ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=wp-easycart-registration' ) ) );
    }
}
add_action( 'plugins_loaded', 'wp_easycart_pro_load_textdomain' );
function wp_easycart_pro_load_textdomain( ){
    load_plugin_textdomain( 'wp-easycart-pro', false, basename( dirname( __FILE__ ) ) . '/languages/' );
}