<?php
if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'wp_easycart_admin_orders_pro' ) ) :

final class wp_easycart_admin_orders_pro{
	
	protected static $_instance = null;
	
	public static function instance( ) {
		
		if( is_null( self::$_instance ) ) {
			self::$_instance = new self(  );
		}
		return self::$_instance;
	
	}
	
	public function __construct( ){ 
		if( wp_easycart_admin_license( )->is_licensed( ) ){
			add_filter( 'wp_easycart_admin_order_details_order_date_edit_action', array( $this, 'allow_order_date_edit' ), 1 );
			
			add_filter( 'wp_easycart_admin_order_details_add_new_line_action', array( $this, 'allow_add_line_item' ), 1 );
			add_filter( 'wp_easycart_admin_order_details_edit_line_action', array( $this, 'allow_edit_line_item' ), 1 );
			add_filter( 'wp_easycart_admin_order_details_delete_line_action', array( $this, 'allow_delete_line_item' ), 1 );
			add_filter( 'wp_easycart_admin_order_details_totals_edit_action', array( $this, 'allow_totals_edit' ), 1 );
			add_filter( 'wp_easycart_admin_order_details_refund_action', array( $this, 'allow_refund' ), 1 );
			
			add_filter( 'wp_easycart_admin_order_details_shipping_edit_action', array( $this, 'allow_shipping_edit' ), 1 );
			add_filter( 'wp_easycart_admin_order_details_order_edit_action', array( $this, 'allow_order_edit' ), 1 );
			add_filter( 'wp_easycart_admin_order_details_billing_edit_action', array( $this, 'allow_billing_edit' ), 1 );
			add_filter( 'wp_easycart_admin_order_details_order_bottom_edit_action', array( $this, 'allow_order_bottom_edit' ), 1 );
			
			add_action( 'wp_easycart_order_details_order_date', array( $this, 'print_order_date_form' ) );
			add_action( 'wp_easycart_admin_order_details_line_item_end', array( $this, 'print_line_item_edit_fields' ), 10, 1 );
			add_action( 'wp_easycart_admin_order_details_items_end', array( $this, 'print_add_new_line_item' ) );
			add_action( 'wp_easycart_admin_order_details_totals_content_end', array( $this, 'print_totals_form' ) );
			add_action( 'wp_easycart_order_details_refund_panel', array( $this, 'print_refund_form' ) );
			
			add_action( 'wp_easycart_admin_order_details_shipping_content_end', array( $this, 'print_shipping_form' ) );
			add_action( 'wp_easycart_order_details_order_information', array( $this, 'print_order_info_form' ) );
			add_action( 'wp_easycart_admin_order_details_billing_content_end', array( $this, 'print_billing_form' ) );
			add_action( 'wp_easycart_order_details_order_bottom_information', array( $this, 'print_order_info_bottom_form' ) );
		}
	}
	
	public function allow_order_date_edit( $action ){
		return 'ec_order_show_hide_edit_order_date';
	}
	
	public function allow_add_line_item( $action ){
		return 'ec_order_add_new_line';
	}
	
	public function allow_edit_line_item( $action ){
		return 'ec_order_edit_line_item';
	}
	
	public function allow_delete_line_item( $action ){
		return 'ec_order_delete_line_item';
	}
	
	public function allow_totals_edit( $action ){
		return 'ec_order_show_hide_edit_totals';
	}
	
	public function allow_refund( $action ){
		return 'ec_order_show_hide_edit_refund';
	}
	
	public function allow_shipping_edit( $action ){
		return 'ec_order_show_hide_edit_shipping';
	}
	
	public function allow_order_edit( $action ){
		return 'ec_order_show_hide_edit_order_information';
	}
	
	public function allow_billing_edit( $action ){
		return 'ec_order_show_hide_edit_billing';
	}
	
	public function allow_order_bottom_edit( $action ){
		return 'ec_order_show_hide_edit_order_information_bottom';
	}
	
	public function print_order_date_form( ){
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/orders/orders/order-date-form.php' );
	}
	
	public function print_line_item_edit_fields( $line_item ){
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/orders/orders/order-item.php' );
	}
	
	public function print_add_new_line_item( ){
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/orders/orders/add-new-line-item.php' );
	}
	
	public function print_totals_form( ){
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/orders/orders/order-totals-form.php' );
	}
	
	public function print_refund_form( ){
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/orders/orders/refund-form.php' );
	}
	
	public function print_shipping_form( ){
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/orders/orders/shipping-details-form.php' );
	}
	
	public function print_order_info_form( ){
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/orders/orders/order-info-form.php' );
	}
	
	public function print_billing_form( ){
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/orders/orders/billing-details-form.php' );
	}
	
	public function print_order_info_bottom_form( ){
		include( WP_EASYCART_ADMIN_PRO_PLUGIN_DIR . 'admin/template/orders/orders/order-info-bottom-form.php' );
	}
	
	public function update_order_date( ){
		global $wpdb;
		$order_id = $_POST['order_id'];
		$order_date = date( "Y-m-d h:i:s", strtotime( $_POST['order_date'] ) );
		$wpdb->query( $wpdb->prepare( "UPDATE ec_order SET order_date = %s, last_updated = NOW( ) WHERE order_id = %d", $order_date, $order_id ) );
		do_action( 'wpeasycart_order_updated', $order_id );
	}
	
	public function add_line_item( ){
		global $wpdb;
		$order_id = $_POST['order_id'];
		$product_id = $_POST['order_line_add_product_id'];
		$quantity = $_POST['order_line_add_quantity'];
		$product = $wpdb->get_row( $wpdb->prepare( "SELECT product_id, title, model_number, price, image1, is_download, is_giftcard, is_taxable, is_shippable FROM ec_product WHERE product_id = %d", $product_id ) );
		$total_price = $product->price * $quantity;
		$wpdb->query( $wpdb->prepare( "INSERT INTO ec_orderdetail( order_id, product_id, title, model_number, unit_price, total_price, quantity, image1, is_download, is_giftcard, is_taxable, is_shippable ) VALUES( %d, %d, %s, %s, %s, %s, %d, %s, %d, %d, %d, %d )", $order_id, $product->product_id, $product->title, $product->model_number, $product->price, $total_price, $quantity, $product->image1, $product->is_download, $product->is_giftcard, $product->is_taxable, $product->is_shippable ) );
		$insert_id = $wpdb->insert_id;
		do_action( 'wpeasycart_order_updated', $order_id );
		return $insert_id;
	}
	
	public function edit_line_item( ){
		global $wpdb;
		$order_id = $_POST['order_id'];
		$orderdetail_id = $_POST['orderdetail_id'];
		$quantity = $_POST['line_item_quantity_'.$orderdetail_id];
		$unit_price = $_POST['line_item_unit_price_'.$orderdetail_id];
		$total_price = $_POST['line_item_total_price_'.$orderdetail_id];
		$title = stripslashes_deep( $_POST['line_item_title_'.$orderdetail_id] );
		$model_number = stripslashes_deep( $_POST['line_item_model_number_'.$orderdetail_id] );
        $optionitem_name_1 = ( isset( $_POST['line_item_optionitem_name_1_'.$orderdetail_id] ) ) ? $_POST['line_item_optionitem_name_1_'.$orderdetail_id] : '';
        $optionitem_name_2 = ( isset( $_POST['line_item_optionitem_name_2_'.$orderdetail_id] ) ) ? $_POST['line_item_optionitem_name_2_'.$orderdetail_id] : '';
        $optionitem_name_3 = ( isset( $_POST['line_item_optionitem_name_3_'.$orderdetail_id] ) ) ? $_POST['line_item_optionitem_name_3_'.$orderdetail_id] : '';
        $optionitem_name_4 = ( isset( $_POST['line_item_optionitem_name_4_'.$orderdetail_id] ) ) ? $_POST['line_item_optionitem_name_4_'.$orderdetail_id] : '';
        $optionitem_name_5 = ( isset( $_POST['line_item_optionitem_name_5_'.$orderdetail_id] ) ) ? $_POST['line_item_optionitem_name_5_'.$orderdetail_id] : '';
        if( isset( $_POST['adv_items'] ) ){
            foreach( $_POST['adv_items'] as $adv_item ){
                $wpdb->query( $wpdb->prepare( "UPDATE ec_order_option SET option_value = %s WHERE order_option_id = %d", $adv_item['value'], $adv_item['id'] ) );
            }
        }
		$wpdb->query( $wpdb->prepare( "UPDATE ec_orderdetail SET title = %s, model_number = %s, quantity = %s, unit_price = %s, total_price = %s, optionitem_name_1 = %s, optionitem_name_2 = %s, optionitem_name_3 = %s, optionitem_name_4 = %s, optionitem_name_5 = %s WHERE order_id = %d AND orderdetail_id = %d", $title, $model_number, $quantity, $unit_price, $total_price, $optionitem_name_1, $optionitem_name_2, $optionitem_name_3, $optionitem_name_4, $optionitem_name_5, $order_id, $orderdetail_id ) );
		do_action( 'wpeasycart_order_updated', $order_id );
	}
	
	public function delete_line_item( ){
		global $wpdb;
		$order_id = $_POST['order_id'];
		$orderdetail_id = $_POST['orderdetail_id'];
		$wpdb->query( $wpdb->prepare( "DELETE FROM ec_orderdetail WHERE order_id = %d AND orderdetail_id = %d", $order_id, $orderdetail_id ) );
		do_action( 'wpeasycart_order_updated', $order_id );
	}
	
	public function update_order_management_info( ){
		global $wpdb;
		
		$order_id = $_POST['order_id'];
		$user_email = stripslashes_deep( $_POST['user_email'] );
		$card_holder_name = stripslashes_deep( $_POST['card_holder_name'] );
		$creditcard_digits = $_POST['creditcard_digits'];
		$cc_exp_month = $_POST['cc_exp_month'];
		$cc_exp_year = $_POST['cc_exp_year'];
		
		$wpdb->query( $wpdb->prepare( "UPDATE ec_order SET user_email = %s, card_holder_name = %s, creditcard_digits = %s, cc_exp_month = %s, cc_exp_year = %s, last_updated = NOW( ) WHERE order_id = %d", $user_email, $card_holder_name, $creditcard_digits, $cc_exp_month, $cc_exp_year, $order_id ) );
		do_action( 'wpeasycart_order_updated', $order_id );
	}
	
	public function update_order_management_info_bottom( ){
		global $wpdb;
		
		$order_id = $_POST['order_id'];
		$order_ip_address = $_POST['order_ip_address'];
		$agreed_to_terms = $_POST['agreed_to_terms'];
		
		$wpdb->query( $wpdb->prepare( "UPDATE ec_order SET order_ip_address = %s, agreed_to_terms = %d, last_updated = NOW( ) WHERE order_id = %d", $order_ip_address, $agreed_to_terms, $order_id ) );
		do_action( 'wpeasycart_order_updated', $order_id );
	}
	
	public function update_billing_address( ){
		global $wpdb;
		
		$order_id = $_POST['order_id'];
		$billing_first_name = stripslashes_deep( $_POST['billing_first_name'] );
		$billing_last_name = stripslashes_deep( $_POST['billing_last_name'] );
		$billing_company_name = stripslashes_deep( $_POST['billing_company_name'] );
		$billing_address_line_1 = stripslashes_deep( $_POST['billing_address_line_1'] );
		$billing_address_line_2 = stripslashes_deep( $_POST['billing_address_line_2'] );
		$billing_city = stripslashes_deep( $_POST['billing_city'] );
		$billing_state = stripslashes_deep( $_POST['billing_state'] );
		$billing_country = stripslashes_deep( $_POST['billing_country'] );
		$billing_zip = stripslashes_deep( $_POST['billing_zip'] );
		$billing_phone = stripslashes_deep( $_POST['billing_phone'] );

		$wpdb->query( $wpdb->prepare( "UPDATE ec_order SET billing_first_name = %s, billing_last_name = %s, billing_company_name = %s, billing_address_line_1 = %s, billing_address_line_2 = %s, billing_city = %s, billing_state = %s, billing_country = %s, billing_zip = %s, billing_phone = %s, last_updated = NOW( ) WHERE order_id = %d", $billing_first_name, $billing_last_name, $billing_company_name, $billing_address_line_1, $billing_address_line_2, $billing_city, $billing_state, $billing_country, $billing_zip, $billing_phone, $order_id ) );
		do_action( 'wpeasycart_order_updated', $order_id );
	}
	
	public function update_shipping_address( ){
		global $wpdb;
		
		$order_id = $_POST['order_id'];
		$shipping_first_name = stripslashes_deep( $_POST['shipping_first_name'] );
		$shipping_last_name = stripslashes_deep( $_POST['shipping_last_name'] );
		$shipping_company_name = stripslashes_deep( $_POST['shipping_company_name'] );
		$shipping_address_line_1 = stripslashes_deep( $_POST['shipping_address_line_1'] );
		$shipping_address_line_2 = stripslashes_deep( $_POST['shipping_address_line_2'] );
		$shipping_city = stripslashes_deep( $_POST['shipping_city'] );
		$shipping_state = stripslashes_deep( $_POST['shipping_state'] );
		$shipping_country = stripslashes_deep( $_POST['shipping_country'] );
		$shipping_zip = stripslashes_deep( $_POST['shipping_zip'] );
		$shipping_phone = stripslashes_deep( $_POST['shipping_phone'] );

		$wpdb->query( $wpdb->prepare( "UPDATE ec_order SET shipping_first_name = %s, shipping_last_name = %s, shipping_company_name = %s, shipping_address_line_1 = %s, shipping_address_line_2 = %s, shipping_city = %s, shipping_state = %s, shipping_country = %s, shipping_zip = %s, shipping_phone = %s, last_updated = NOW( ) WHERE order_id = %d", $shipping_first_name, $shipping_last_name, $shipping_company_name, $shipping_address_line_1, $shipping_address_line_2, $shipping_city, $shipping_state, $shipping_country, $shipping_zip, $shipping_phone, $order_id ) );
		do_action( 'wpeasycart_order_updated', $order_id );
	}
	
	public function update_order_totals( ){
		global $wpdb;
		
		$order_id = $_POST['order_id'];
		$sub_total = $_POST['sub_total'];
		$tax_total = $_POST['tax_total'];
		$shipping_total = $_POST['shipping_total'];
		$discount_total = $_POST['discount_total'];
		$vat_total = $_POST['vat_total'];
		$duty_total = $_POST['duty_total'];
		$grand_total = $_POST['grand_total'];
		$refund_total = $_POST['refund_total'];
		$gst_total = $_POST['gst_total'];
		$gst_rate = $_POST['gst_rate'];
		$pst_total = $_POST['pst_total'];
		$pst_rate = $_POST['pst_rate'];
		$hst_total = $_POST['hst_total'];
		$hst_rate = $_POST['hst_rate'];
		$vat_rate = $_POST['vat_rate'];
		$vat_registration_number = $_POST['vat_registration_number'];
		
		$wpdb->query( $wpdb->prepare( "UPDATE ec_order SET sub_total = %s, tax_total = %s, shipping_total = %s, discount_total = %s, vat_total = %s, duty_total = %s, grand_total = %s, refund_total = %s, gst_total = %s, gst_rate = %s, pst_total = %s, pst_rate = %s, hst_total = %s, hst_rate = %s, vat_rate = %s, vat_registration_number = %s, last_updated = NOW( ) WHERE order_id = %d", $sub_total, $tax_total, $shipping_total, $discount_total, $vat_total, $duty_total, $grand_total, $refund_total, $gst_total, $gst_rate, $pst_total, $pst_rate, $hst_total, $hst_rate, $vat_rate, $vat_registration_number, $order_id ) );
		do_action( 'wpeasycart_order_updated', $order_id );
	}
	
	public function refund_order( ){
		global $wpdb;
		
		$order_id = $_POST['order_id'];
		$refund_amount  = $_POST['refund_amount'];
		$is_partial_refund = $is_full_refund = false;
		$query_vars = array( );
		
		$order = $wpdb->get_row( $wpdb->prepare( "SELECT affirm_charge_id, stripe_charge_id, order_notes, refund_total, grand_total, gateway_transaction_id, order_gateway FROM ec_order WHERE order_id = %d", $order_id ) );
		
		if( $refund_amount + $order->refund_total < $order->grand_total )
			$is_partial_refund = true;
		else
			$is_full_refund = true;
		
		if( $refund_amount + $order->refund_total > $order->grand_total )
			$refund_amount = $order->grand_total - $order->refund_total;
		
		$gateway_class = "ec_" . $order->order_gateway;
		if( $order->order_gateway == "stripe_connect" )
			$gateway_key = 'stripe_charge_id';
		else if( $order->order_gateway == "affirm" || $order->order_gateway == "stripe" )
			$gateway_key = $order->order_gateway . '_charge_id';
		else
			$gateway_key = 'gateway_transaction_id';
			
		if( $order->order_gateway == 'paypal-express' ){
			$gateway = new ec_paypal( );
			$refund_result = $gateway->refund_express_charge( $order_id, $order->{$gateway_key}, $refund_amount );
			
		}else if( class_exists( $gateway_class ) ){
			$gateway = new $gateway_class( );
			$refund_result = $gateway->refund_charge( $order->{$gateway_key}, $refund_amount );
			
		}else{
			$refund_result = false;
		}
        
        if( $order->order_gateway == 'square' && $is_full_refund ){
            $gateway->cancel_order( $order->{$gateway_key} );
        }
		
		if( $refund_result ){
			$date = date('l jS \of F Y h:i:s A');
			if( strlen( $order->order_notes ) > 0 )
				$new_order_notes = $order->order_notes . PHP_EOL .  PHP_EOL . sprintf( __( "Refund of %s made on %s", 'wp-easycart-pro' ), $GLOBALS['currency']->get_currency_display( $refund_amount ), $date );
			else
				$new_order_notes = sprintf( __( "Refund of %s made on %s", 'wp-easycart-pro' ), $GLOBALS['currency']->get_currency_display( $refund_amount ), $date );
			
			if( $is_full_refund )
				$orderstatus_id = 16;
			else
				$orderstatus_id = 17;
			
			$wpdb->query( $wpdb->prepare( "UPDATE ec_order SET ec_order.refund_total = ( ec_order.refund_total + %s ), ec_order.order_notes = %s, ec_order.orderstatus_id = %d, last_updated = NOW( ) WHERE ec_order.order_id = %d", $refund_amount, $new_order_notes, $orderstatus_id, $order_id ) );
			
			if( $orderstatus_id == 16 ){ // Check for gift card to refund
				$order_details = $wpdb->get_results( $wpdb->prepare( "SELECT is_giftcard, giftcard_id FROM ec_orderdetail WHERE order_id = %d", $order_id ) );
				foreach( $order_details as $order_detail ){
					if( $detail->is_giftcard ){
						$wpdb->query( $wpdb->prepare( "DELETE FROM ec_giftcard WHERE ec_giftcard.giftcard_id = %s", $order_detail->giftcard_id ) );
					}
				}
			}
			
			if( $orderstatus_id == 16 ) // Is Full Refund
				do_action( 'wpeasycart_full_order_refund', $order_id );
			else
				do_action( 'wpeasycart_partial_order_refund', $order_id, $refund_amount, ( $refund_amount + $order->refund_total ) );
			
			$query_vars['success'] = 'refund-success';
			$query_vars['orderstatus_id'] = $orderstatus_id;
			$query_vars['is_full_refund'] = $is_full_refund;
			$query_vars['refund_remaining'] = $GLOBALS['currency']->get_number_only( $order->grand_total - $order->refund_total - $refund_amount );
			$query_vars['refund_total'] = $GLOBALS['currency']->get_number_only( $refund_amount + $order->refund_total );
			$query_vars['order_notes'] = $new_order_notes;
			
		}else{
			$query_vars['error'] = 'refund-failed';
		}
		return $query_vars;
	}
	
}
endif; // End if class_exists check

function wp_easycart_admin_orders_pro( ){
	return wp_easycart_admin_orders_pro::instance( );
}
wp_easycart_admin_orders_pro( );
add_action( 'wp_ajax_ec_admin_ajax_save_order_date', 'ec_admin_ajax_save_order_date' );
function ec_admin_ajax_save_order_date( ){
	wp_easycart_admin_orders_pro( )->update_order_date( );
	die( );
}
add_action( 'wp_ajax_ec_admin_ajax_add_new_order_detail_line_item', 'ec_admin_ajax_add_new_order_detail_line_item' );
function ec_admin_ajax_add_new_order_detail_line_item( ){
	global $wpdb;
	$orderdetail_id = wp_easycart_admin_orders_pro( )->add_line_item( );
	$line_item = $wpdb->get_row( $wpdb->prepare( "SELECT ec_orderdetail.*, ec_order.subscription_id FROM ec_orderdetail LEFT JOIN ec_order ON (ec_order.order_id = ec_orderdetail.order_id) WHERE ec_orderdetail.orderdetail_id = %s ORDER BY orderdetail_id", $orderdetail_id ) );
    include(  WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/admin/template/orders/orders/order-item.php' );
	die( );
}
add_action( 'wp_ajax_ec_admin_ajax_edit_order_detail_line_item', 'ec_admin_ajax_edit_order_detail_line_item' );
function ec_admin_ajax_edit_order_detail_line_item( ){
	wp_easycart_admin_orders_pro( )->edit_line_item( );
	die( );
}
add_action( 'wp_ajax_ec_admin_ajax_delete_order_detail_line_item', 'ec_admin_ajax_delete_order_detail_line_item' );
function ec_admin_ajax_delete_order_detail_line_item( ){
	wp_easycart_admin_orders_pro( )->delete_line_item( );
	die( );
}
add_action( 'wp_ajax_ec_admin_ajax_save_order_management_details', 'ec_admin_ajax_save_order_management_details' );
function ec_admin_ajax_save_order_management_details( ){
	wp_easycart_admin_orders_pro( )->update_order_management_info( );
	die( );
}
add_action( 'wp_ajax_ec_admin_ajax_save_order_management_details_bottom', 'ec_admin_ajax_save_order_management_details_bottom' );
function ec_admin_ajax_save_order_management_details_bottom( ){
	wp_easycart_admin_orders_pro( )->update_order_management_info_bottom( );
	die( );
}
add_action( 'wp_ajax_ec_admin_ajax_save_order_billing_address', 'ec_admin_ajax_save_order_billing_address' );
function ec_admin_ajax_save_order_billing_address( ){
	wp_easycart_admin_orders_pro( )->update_billing_address( );
	die( );
}
add_action( 'wp_ajax_ec_admin_ajax_save_order_shipping_address', 'ec_admin_ajax_save_order_shipping_address' );
function ec_admin_ajax_save_order_shipping_address( ){
	wp_easycart_admin_orders_pro( )->update_shipping_address( );
	die( );
}
add_action( 'wp_ajax_ec_admin_ajax_edit_order_totals', 'ec_admin_ajax_edit_order_totals' );
function ec_admin_ajax_edit_order_totals( ){
	wp_easycart_admin_orders_pro( )->update_order_totals( );
	die( );
}
add_action( 'wp_ajax_ec_admin_ajax_process_refund', 'ec_admin_ajax_process_refund' );
function ec_admin_ajax_process_refund( ){
	$refund_result = wp_easycart_admin_orders_pro( )->refund_order( );
	echo json_encode( $refund_result );
	die( );
}