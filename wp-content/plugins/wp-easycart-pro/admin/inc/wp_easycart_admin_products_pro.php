<?php
if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'wp_easycart_admin_products_pro' ) ) :

final class wp_easycart_admin_products_pro{
	
	protected static $_instance = null;
	
	public static function instance( ) {
		
		if( is_null( self::$_instance ) ) {
			self::$_instance = new self(  );
		}
		return self::$_instance;
	
	}
	
	public function __construct( ){ 
		if( wp_easycart_admin_license( )->is_licensed( ) ){
			/* Advanced Options */
			add_filter( 'wp_easycart_admin_product_details_options_fields_list', array( $this, 'add_advanced_options' ) );
			add_action( 'wp_easycart_admin_product_advanced_option_row_end', array( $this, 'add_advanced_option_logic' ) );
			
			/* Option Item Images */
			add_filter( 'wp_easycart_admin_product_details_images_fields_list', array( $this, 'add_optionset_images' ) );
			
			/* Option Item Quantity Tracking */
			add_filter( 'wp_easycart_admin_optionitem_quantity_add_click', array( $this, 'allow_add_optionitem_quantity_tracking' ) );
			add_filter( 'wp_easycart_admin_optionitem_quantity_update_click', array( $this, 'allow_update_optionitem_quantity_tracking' ) );
			add_filter( 'wp_easycart_admin_optionitem_quantity_delete_click', array( $this, 'allow_delete_optionitem_quantity_tracking' ) );
			
			/* Volume Pricing */
			add_filter( 'wp_easycart_admin_tiered_pricing_add_click', array( $this, 'allow_add_tiered_pricing' ) );
			add_filter( 'wp_easycart_admin_tiered_pricing_edit_click', array( $this, 'allow_edit_tiered_pricing' ) );
			add_filter( 'wp_easycart_admin_tiered_pricing_delete_click', array( $this, 'allow_delete_tiered_pricing' ) );
			
			/* B2B Pricing */
			add_filter( 'wp_easycart_admin_b2b_pricing_add_click', array( $this, 'allow_add_b2b_pricing' ) );
			add_filter( 'wp_easycart_admin_b2b_pricing_delete_click', array( $this, 'allow_delete_b2b_pricing' ) );
			
			/* General Options (Pro Only) */
			add_filter( 'wp_easycart_admin_product_details_general_options_fields_list', array( $this, 'add_general_options' ) );
			
			/* Tax Options (Pro Only) */
			add_filter( 'wp_easycart_admin_product_details_tax_fields_list', array( $this, 'add_tax_options' ) );
			
			/* Deconetwork */
			add_filter( 'wp_easycart_admin_product_details_deconetwork_fields_list', array( $this, 'add_deconetwork' ) );
			
			/* Subscription */
			add_filter( 'wp_easycart_admin_product_details_subscription_fields_list', array( $this, 'add_subscription' ) );
			
			/* Downloads */
			add_filter( 'wp_easycart_admin_product_details_downloads_fields_list', array( $this, 'add_downloads' ) );
			
			/* Inventory Options */
			remove_action( 'wp_easycart_admin_settings_product_inventory_end', array( wp_easycart_admin_products( ), 'add_inventory_notification_setting' ) );
			add_action( 'wp_easycart_admin_settings_product_inventory_end', array( $this, 'add_inventory_notification_setting' ) );
			add_action( 'wp_easycart_admin_product_details_optionitem_quantity_fields', array( $this, 'add_inventory_notification_management' ) );
		}
	}

	/* Advanced Options */
	public function add_advanced_options( $fields ){
		for( $i=0; $i<count( $fields ); $i++ ){
			if( $fields[$i]['name'] == 'use_advanced_optionset' ){
				$fields[$i]['onclick'] = 'advanced_options_change';
				$fields[$i]['read-only'] = false;
				break;
			}
		}
		$fields[] = array(
			"name"				=> "advanced_options",
			"type"				=> "advanced_options"
		);
		return $fields;
	}
	
	public function add_advanced_option_logic( $option_to_product_row ){
		global $wpdb;
		$optionsets = $wpdb->get_results( $wpdb->prepare( "SELECT ec_option_to_product.option_to_product_id, ec_option.option_id, ec_option.option_name, ec_option.option_type, ec_option.option_required FROM ec_option_to_product, ec_option WHERE ec_option_to_product.product_id = %d AND ec_option.option_id = ec_option_to_product.option_id ORDER BY ec_option_to_product.option_order ASC", $option_to_product_row->product_id ) );
		$enabled = false; $show_field = 1; $and_rules = 1; $rules = array( (object) array( 'option_id' => 0, 'operator' => '=', 'optionitem_id' => 0 ) );
		$rule_meta = $option_to_product_row->conditional_logic;
		$rules = array( );
		if( $rule_meta ){
			$logic = json_decode( $rule_meta );
			$enabled = $logic->enabled;
			$show_field = $logic->show_field;
			$and_rules = $logic->and_rules;
			$rules = $logic->rules;
		}
		
		if( count( $rules ) == 0 ){
			$rules[] = (object) array(
				'option_id'			=> 0,
				'operator'			=> '=',
				'optionitem_id' 	=> 0,
				'optionitem_value'	=> ''
			);
		}
		
		echo '<div class="ec_admin_option_logic"><input type="checkbox" class="ec_admin_enable_conditional_logic" onclick="ec_admin_product_details_enable_logic( jQuery( this ), ' . $option_to_product_row->option_to_product_id . ' );"'.( ( $enabled ) ? ' checked="checked"' : '' ).' /> ' . __( 'Enable Conditional Logic', 'wp-easycart-pro' ) . '</div>';
		echo '<div class="ec_admin_option_logic_content" data-option-to-product-id="'.$option_to_product_row->option_to_product_id.'" id="ec_logic_item_'.$option_to_product_row->option_to_product_id.'"' . ( ( $enabled ) ? ' style="display:block"' : '' ) . '>';
			echo '<div class="ec_admin_option_logic_main_row">';
				echo '<select class="logic-show" onchange="ec_admin_product_details_save_logic( '.$option_to_product_row->option_to_product_id.' );">';
					echo '<option value="1"' . ( ( $show_field ) ? ' selected="selected"' : '' ) . '>' . __( 'Show', 'wp-easycart-pro' ) . '</option>';
					echo '<option value="0"' . ( ( !$show_field ) ? ' selected="selected"' : '' ) . '>' . __( 'Hide', 'wp-easycart-pro' ) . '</option>';
				echo '</select>';
				echo '<span> ' . __( 'this field if', 'wp-easycart-pro' ) . ' </span>';
				echo '<select class="logic-and" onchange="ec_admin_product_details_save_logic( '.$option_to_product_row->option_to_product_id.' );">';
					echo '<option value="AND"'.( ( $and_rules == 'AND' ) ? ' selected="selected"' : '').'>' . __( 'All', 'wp-easycart-pro' ) . '</option>';
					echo '<option value="OR"'.( ( $and_rules == 'OR' ) ? ' selected="selected"' : '').'>' . __( 'Any', 'wp-easycart-pro' ) . '</option>';
				echo '</select>';
				echo '<span> ' . __( 'of the following match', 'wp-easycart-pro' ) . ':</span>';
			echo '</div>';
			foreach( $rules as $rule ){
				$option_selected = false;
				echo '<div class="ec_admin_option_logic_item">';
					echo '<select class="logic-option" onchange="ec_admin_product_details_change_logic( jQuery( this ), '.$option_to_product_row->option_to_product_id.' );">';
					foreach( $optionsets as $optionset ){
						if( $optionset->option_type != 'file' && $optionset->option_type != 'grid' && $optionset->option_type != 'dimensions1' && $optionset->option_type != 'dimensions2' ){
							if( $rule->option_id == $optionset->option_to_product_id )
								$option_selected = true;
							echo '<option value="' . $optionset->option_to_product_id . '"' . ( ( $rule->option_id == $optionset->option_to_product_id ) ? 'selected="selected"' : '' ) . '>' . $optionset->option_name . '</option>';
						}
					}
					echo '</select>';
					
					echo '<select class="logic-operator" onchange="ec_admin_product_details_save_logic( '.$option_to_product_row->option_to_product_id.' );">';
						echo '<option value="="' . ( ( $rule->operator == '=' ) ? 'selected="selected"' : '' ) . '>' . __( 'is', 'wp-easycart-pro' ) . '</option>';
						echo '<option value="!="' . ( ( $rule->operator == '!=' ) ? 'selected="selected"' : '' ) . '>' . __( 'is not', 'wp-easycart-pro' ) . '</option>';
						//echo '<option value=">"' . ( ( $rule->operator == '>' ) ? 'selected="selected"' : '' ) . '>greater than</option>';
						//echo '<option value="<"' . ( ( $rule->operator == '<' ) ? 'selected="selected"' : '' ) . '>less than</option>';
						//echo '<option value="LIKE"' . ( ( $rule->operator == 'LIKE' ) ? 'selected="selected"' : '' ) . '>contains</option>';
						//echo '<option value="LIKE%"' . ( ( $rule->operator == 'LIKE%' ) ? 'selected="selected"' : '' ) . '>starts with</option>';
						//echo '<option value="LIKE%%"' . ( ( $rule->operator == 'LIKE%%' ) ? 'selected="selected"' : '' ) . '>ends with</option>';
					echo '</select>';
					
					for( $i=0; $i<count( $optionsets ); $i++ ){
						if( $optionsets[$i]->option_type == 'combo' || $optionsets[$i]->option_type == 'swatch' || $optionsets[$i]->option_type == 'radio' || $optionsets[$i]->option_type == 'checkbox' ){
							$optionitems = $wpdb->get_results( $wpdb->prepare( "SELECT optionitem_id, optionitem_name FROM ec_optionitem WHERE option_id = %d ORDER BY optionitem_order ASC", $optionsets[$i]->option_id ) );
							echo '<select class="logic-optionitem" onchange="ec_admin_product_details_save_logic( '.$option_to_product_row->option_to_product_id.' );" data-option-id="' . $optionsets[$i]->option_to_product_id . '"' . ( ( ( $option_selected && $rule->option_id && $rule->option_id != $optionsets[$i]->option_to_product_id ) || ( !$rule->option_id && $i > 0 ) ) ? ' style="display:none;"' : '' ) . '>';
							foreach( $optionitems as $optionitem ){
								echo '<option value="' . $optionitem->optionitem_id . '"' . ( ( $rule->optionitem_id == $optionitem->optionitem_id ) ? 'selected="selected"' : '' ) . '>' . $optionitem->optionitem_name . '</option>';
							}
							echo '</select>';
						}else if( $optionset->option_type != 'file' && $optionsets[$i]->option_type != 'grid' && $optionsets[$i]->option_type != 'dimensions1' && $optionsets[$i]->option_type != 'dimensions2' ){
							echo '<input type="text" onkeyup="ec_admin_product_details_save_logic( '.$option_to_product_row->option_to_product_id.' );" class="logic-optionitem" value="' . ( ( $rule->optionitem_value != ''  ) ? $rule->optionitem_value : '' ) . '" data-option-id="' . $optionsets[$i]->option_to_product_id . '"' . ( ( ( $rule->option_id && $rule->option_id != $optionsets[$i]->option_to_product_id ) || ( !$rule->option_id && $i > 0 ) ) ? ' style="display:none;"' : '' ) . ' />';	
						}
					}
					
					echo '<a class="remove" href="#" onclick="ec_admin_product_details_remove_logic( this ); ec_admin_product_details_save_logic( '.$option_to_product_row->option_to_product_id.' ); return false;">-</a>';
					echo '<a class="add" href="#" onclick="ec_admin_product_details_add_logic( this ); ec_admin_product_details_save_logic( '.$option_to_product_row->option_to_product_id.' ); return false;">+</a>';
				echo '</div>';
			}
		echo '</div>';
	}
	
	/* Option Item Images */
	public function add_optionset_images( $fields ){
		for( $i=0; $i<count( $fields ); $i++ ){
			if( $fields[$i]['name'] == 'use_optionitem_images' ){
				$fields[$i]['onclick'] = 'optionitem_images_change';
				$fields[$i]['read-only'] = false;
				break;
			}
		}
		$fields[] = array(
			"name"				=> "optionitem_images",
			"type"				=> "optionitem_images"
		);
		return $fields;
	}
	
	/* Option Item Quantity Tracking */
	public function allow_add_optionitem_quantity_tracking( $action ){
		return "ec_admin_product_details_add_optionitem_quantity";
	}
	
	public function allow_update_optionitem_quantity_tracking( $action ){
		return "ec_admin_product_details_update_optionitem_quantity";
	}
	
	public function allow_delete_optionitem_quantity_tracking( $action ){
		return "ec_admin_product_details_delete_optionitem_quantity";
	}
	
	/* Tiered Pricing */
	public function allow_add_tiered_pricing( $action ){
		return "ec_admin_product_details_add_price_tier";
	}
	
	public function allow_edit_tiered_pricing( $action ){
		return "ec_admin_product_details_edit_price_tier";
	}
	
	public function allow_delete_tiered_pricing( $action ){
		return "ec_admin_product_details_delete_price_tier";
	}
	
	/* B2B Pricing */
	public function allow_add_b2b_pricing( $action ){
		return "ec_admin_product_details_add_role_price";
	}
	
	public function allow_delete_b2b_pricing( $action ){
		return "ec_admin_product_details_delete_role_price";
	}
	
	/* General Options */
	public function add_general_options( $fields ){
		for( $i=0; $i<count( $fields ); $i++ ){
			if( $fields[$i]['name'] == 'is_donation' ){
				unset( $fields[$i]['onclick'] );
				$fields[$i]['read-only'] = false;
			
			}else if( $fields[$i]['name'] == 'is_giftcard' ){
				unset( $fields[$i]['onclick'] );
				$fields[$i]['read-only'] = false;
			
			}else if( $fields[$i]['name'] == 'inquiry_mode' ){
				$fields[$i]['onclick'] = 'ec_admin_product_details_inquiry_change';
				$fields[$i]['read-only'] = false;
			
			}else if( $fields[$i]['name'] == 'catalog_mode' ){
				unset( $fields[$i]['onclick'] );
				$fields[$i]['read-only'] = false;
			}
		}
		return $fields;
	}
	
	/* Tax Options */
	public function add_tax_options( $fields ){
		for( $i=0; $i<count( $fields ); $i++ ){
			if( $fields[$i]['name'] == 'TIC' ){
				unset( $fields[$i]['onclick'] );
				$fields[$i]['read-only'] = false;
			}
		}
		return $fields;
	}
	
	/* Deconetwork */
	public function add_deconetwork( $fields ){
		for( $i=0; $i<count( $fields ); $i++ ){
			if( $fields[$i]['name'] == 'is_deconetwork' ){
				$fields[$i]['onclick'] = 'ec_admin_product_details_deconetwork_toggle';
				$fields[$i]['read-only'] = false;
				break;
			}
		}
		return $fields;
	}
	
	/* Subscription */
	public function add_subscription( $fields ){
		for( $i=0; $i<count( $fields ); $i++ ){
			if( $fields[$i]['name'] == 'is_subscription_item' ){
				$fields[$i]['onclick'] = 'ec_admin_product_details_subscription_change';
				$fields[$i]['read-only'] = false;
				break;
			}
		}
		return $fields;
	}
	
	/* Downloads */
	public function add_downloads( $fields ){
		for( $i=0; $i<count( $fields ); $i++ ){
			if( $fields[$i]['name'] == 'is_download' ){
				$fields[$i]['onclick'] = 'ec_admin_product_details_download_toggle';
				$fields[$i]['read-only'] = false;
				break;
			}
		}
		return $fields;
	}
	
	/* Inventory */
	public function add_inventory_notification_setting( ){
		if( method_exists( wp_easycart_admin( ), 'load_toggle_group' ) ){
            wp_easycart_admin( )->load_toggle_group( 'ec_option_enable_inventory_notification', 'ec_admin_save_product_options', get_option( 'ec_option_enable_inventory_notification' ), __( 'Stock Notifications: Customers', 'wp-easycart-pro' ), __( 'Enabling this allows your customers to subscribe to low stock notifications.', 'wp-easycart-pro' ) );
        }else{
            echo __( 'Pro feature missing. Please update your WP EasyCart Plugin to fix this issue', 'wp-easycart-pro' );
        }
	}
	
	public function add_inventory_notification_management( ){
		if( get_option( 'ec_option_enable_inventory_notification' ) ){
			echo '<div class="ec_admin_stock_notification_view">';
				echo '<div class="ec_out_of_stock_notify_loader_cover" style="display:none;"></div>';
				echo '<div class="ec_out_of_stock_notify_loader" style="display:none;"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
				echo '<h4>' . __( 'Instock Subscribers', 'wp-easycart-pro' ) . ' <a href="#" onclick="ec_admin_notify_all_subscribers( ' . ( int ) $_GET['product_id'] . ' ); return false;">' . __( 'Notify All', 'wp-easycart-pro' ) . '</a></h4>';
				echo '<div class="ec_admin_stock_notification_add_new"><label>' . __( 'Add Email', 'wp-easycart-pro' ) . ':</label> <input type="text" id="ec_notify_new_email" value="" /> <input type="button" onclick="ec_admin_add_notify_subscriber( ' . (int) $_GET['product_id'] . ' );" value="' . __( 'Add New', 'wp-easycart-pro' ) . '" /></div>';
				echo '<div class="ec_admin_message_success" id="ec_admin_notify_success" style="display:none; float:left; width:100%; margin:0 0 5px;">' . __( 'Customer(s) have been notified that this product is in stock.', 'wp-easycart-pro' ) . '</div>';
				$this->print_notify_subscriber_table( ( int ) $_GET['product_id'] );
			echo '</div>'; 
		}
	}
	
	private function print_notify_subscriber_table( $product_id ){
		global $wpdb;
		$date_format = '%b %d, %Y';
		$subscribers = $wpdb->get_results( $wpdb->prepare( "SELECT product_subscriber_id, email, status, DATE_FORMAT( last_notified, %s ) AS last_notified FROM ec_product_subscriber WHERE product_id = %d ORDER BY email ASC", $date_format, $product_id ) );
		echo '<table class="wp-list-table widefat fixed striped">';
			echo '<thead>';
				echo '<tr>';
					echo '<th>' . __( 'Email', 'wp-easycart-pro' ) . '</th>';
					echo '<th>' . __( 'Status', 'wp-easycart-pro' ) . '</th>';
					echo '<th>' .__( 'Last Notified', 'wp-easycart-pro' ) . '</th>';
					echo '<th width="35%;"></th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
				if( count( $subscribers ) > 0 ){
					foreach( $subscribers as $subscriber ){
				echo '<tr>';
					echo '<td>' . $subscriber->email . '</td>';
					echo '<td>' . $subscriber->status . '</td>';
					echo '<td>' . ( ( $subscriber->last_notified ) ? $subscriber->last_notified : __( 'Never', 'wp-easycart-pro' ) ) . '</td>';
					echo '<td align="right">';
						echo '<a href="#" onclick="ec_admin_' . ( ( $subscriber->status == 'subscribed' ) ? 'unsubscribe' : 'subscribe' ) . '_notify_subscriber( ' . $subscriber->product_subscriber_id . ', ' . $product_id . ' ); return false;">' . ( ( $subscriber->status == 'subscribed' ) ? __( 'Unsubscribe', 'wp-easycart-pro' ) : __( 'Subscribe', 'wp-easycart-pro' ) ) . '</a> | ';
						echo '<a href="#" onclick="ec_admin_delete_notify_subscriber( ' . $subscriber->product_subscriber_id . ', ' . $product_id . ' ); return false;">' . __( 'Delete', 'wp-easycart-pro' ) . '</a> | ';
						echo '<a href="#" onclick="ec_admin_notify_subscriber( ' . $subscriber->product_subscriber_id . ', ' . $product_id . ' ); return false;">' . __( 'Notify', 'wp-easycart-pro' ) . '</a>';
					echo '</td>';
				echo '</tr>';
					}
				}else{
					echo '<tr><td colspan="4" style="text-align:center">' . __( 'No Subscribers Available', 'wp-easycart-pro' ) . '</td></tr>';	
				}
			echo '</tbody>';
		echo '</table>';
	}
	
	public function add_new_stock_notification_user( ){
		global $wpdb;
		$found = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ec_product_subscriber WHERE email = %s AND product_id = %d", $_POST['email'], $_POST['product_id'] ) );
		if( !$found )
			$wpdb->query( $wpdb->prepare( "INSERT INTO ec_product_subscriber( email, product_id ) VALUES( %s, %d )", $_POST['email'], $_POST['product_id'] ) );
		$this->print_notify_subscriber_table( ( int ) $_POST['product_id'] );
	}
	
	public function delete_stock_notification_item( ){
		global $wpdb;
		$wpdb->query( $wpdb->prepare( "DELETE FROM ec_product_subscriber WHERE product_subscriber_id = %d", $_POST['product_subscriber_id'] ) );
		$this->print_notify_subscriber_table( ( int ) $_POST['product_id'] );
	}
	
	public function subscribe_stock_notification_item( ){
		global $wpdb;
		$wpdb->query( $wpdb->prepare( "UPDATE ec_product_subscriber SET status = 'subscribed' WHERE product_subscriber_id = %d", $_POST['product_subscriber_id'] ) );
		$this->print_notify_subscriber_table( ( int ) $_POST['product_id'] );
	}
	
	public function unsubscribe_stock_notification_item( ){
		global $wpdb;
		$wpdb->query( $wpdb->prepare( "UPDATE ec_product_subscriber SET status = 'unsubscribed' WHERE product_subscriber_id = %d", $_POST['product_subscriber_id'] ) );
		$this->print_notify_subscriber_table( ( int ) $_POST['product_id'] );
	}
	
	public function notify_subscriber( ){
		global $wpdb;
		$product_id = $_POST['product_id'];
		$product_subscriber_id = $_POST['product_subscriber_id'];
		$wpdb->query( $wpdb->prepare( "UPDATE ec_product_subscriber SET last_notified = NOW( ) WHERE product_subscriber_id = %d", $product_subscriber_id ) );
		$subscribers = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ec_product_subscriber WHERE product_subscriber_id = %d AND status = 'subscribed'", $product_subscriber_id ) );
		$this->send_notification( $subscribers, $product_id );
		$this->print_notify_subscriber_table( $product_id );
	}
	
	public function notify_all_subscribers( ){
		global $wpdb;
		$product_id = ( int ) $_POST['product_id'];
		$wpdb->query( $wpdb->prepare( "UPDATE ec_product_subscriber SET last_notified = NOW( ) WHERE product_id = %d", $product_id ) );
		$subscribers = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ec_product_subscriber WHERE product_id = %d AND status = 'subscribed'", $product_id ) );
		$this->send_notification( $subscribers, $product_id );
		$this->print_notify_subscriber_table( $product_id );
	}
	
	public function send_notification( $subscribers, $product_id ){
		$db = new ec_db( );
		$result = $db->get_product_list( "WHERE product.product_id = " . (int) $product_id, '', '', '', '' );
		
		$product = new ec_product( $result[0], 0, 0, 0, 0, 0 );
		$email_logo_url = get_option( 'ec_option_email_logo' ) . "' alt='" . get_bloginfo( "name" );
	 	
		$headers   = array();
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-Type: text/html; charset=utf-8";
		$headers[] = "From: " . stripslashes( get_option( 'ec_option_order_from_email' ) );
		$headers[] = "Reply-To: " . stripslashes( get_option( 'ec_option_order_from_email' ) );
		$headers[] = "X-Mailer: PHP/".phpversion();
		
		foreach( $subscribers as $subscriber ){
			ob_start();
			if( file_exists( WP_PLUGIN_DIR . '/wp-easycart-data/design/layout/' . get_option( 'ec_option_base_layout' ) . '/ec_product_stock_notify_email.php' ) )	
				include WP_PLUGIN_DIR . '/wp-easycart-data/design/layout/' . get_option( 'ec_option_base_layout' ) . '/ec_product_stock_notify_email.php';	
			else
				include WP_PLUGIN_DIR . "/" . EC_PLUGIN_DIRECTORY . '/design/layout/' . get_option( 'ec_option_latest_layout' ) . '/ec_product_stock_notify_email.php';
			$message = ob_get_clean();
			ob_start();
			
			$email_send_method = get_option( 'ec_option_use_wp_mail' );
			$email_send_method = apply_filters( 'wpeasycart_email_method', $email_send_method );
			
			if( $email_send_method == "1" ){
				wp_mail( $subscriber->email, $GLOBALS['language']->get_text( 'ec_stock_notify_email', 'email_title' ), $message, implode( "\r\n", $headers ) );
				
			}else if( $email_send_method == "0" ){
				$admin_email = stripslashes( get_option( 'ec_option_bcc_email_addresses' ) );
				$subject = $GLOBALS['language']->get_text( 'ec_stock_notify_email', 'email_title' );
				$mailer = new wpeasycart_mailer( );
				$mailer->send_order_email( $subscriber->email, $subject, $message );
				
			}else{
				do_action( 'wpeasycart_custom_order_email', stripslashes( get_option( 'ec_option_order_from_email' ) ), $subscriber->email, '', $GLOBALS['language']->get_text( 'ec_stock_notify_email', 'email_title' ), $message );
			}
		}
	}
}
endif; // End if class_exists check

function wp_easycart_admin_products_pro( ){
	return wp_easycart_admin_products_pro::instance( );
}
wp_easycart_admin_products_pro( );

add_action( 'wp_ajax_ec_ajax_admin_subscribe_to_stock_notification', 'ec_ajax_admin_subscribe_to_stock_notification' );
function ec_ajax_admin_subscribe_to_stock_notification( ){
	wp_easycart_admin_products_pro( )->add_new_stock_notification_user( );
	die( );
}

add_action( 'wp_ajax_ec_ajax_admin_delete_stock_notification_item', 'ec_ajax_admin_delete_stock_notification_item' );
function ec_ajax_admin_delete_stock_notification_item( ){
	wp_easycart_admin_products_pro( )->delete_stock_notification_item( );
	die( );
}

add_action( 'wp_ajax_ec_ajax_admin_subscribe_stock_notification_item', 'ec_ajax_admin_subscribe_stock_notification_item' );
function ec_ajax_admin_subscribe_stock_notification_item( ){
	wp_easycart_admin_products_pro( )->subscribe_stock_notification_item( );
	die( );
}

add_action( 'wp_ajax_ec_ajax_admin_unsubscribe_stock_notification_item', 'ec_ajax_admin_unsubscribe_stock_notification_item' );
function ec_ajax_admin_unsubscribe_stock_notification_item( ){
	wp_easycart_admin_products_pro( )->unsubscribe_stock_notification_item( );
	die( );
}

add_action( 'wp_ajax_ec_ajax_admin_notify_subscriber', 'ec_ajax_admin_notify_subscriber' );
function ec_ajax_admin_notify_subscriber( ){
	wp_easycart_admin_products_pro( )->notify_subscriber( );
	die( );
}

add_action( 'wp_ajax_ec_ajax_admin_notify_all_subscribers', 'ec_ajax_admin_notify_all_subscribers' );
function ec_ajax_admin_notify_all_subscribers( ){
	wp_easycart_admin_products_pro( )->notify_all_subscribers( );
	die( );
}