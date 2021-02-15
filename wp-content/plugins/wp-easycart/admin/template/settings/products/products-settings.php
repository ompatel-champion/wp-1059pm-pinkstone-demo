<div class="ec_admin_list_line_item">
            
	<?php wp_easycart_admin( )->preloader->print_preloader( "ec_admin_product_settings_loader" ); ?>
            
	<div class="ec_admin_settings_label">
		<div class="dashicons-before dashicons-edit"></div>
		<span><?php _e( 'Product Display', 'wp-easycart' ); ?></span>
		<a href="<?php echo wp_easycart_admin( )->helpsystem->print_docs_url('settings', 'product-settings', 'product-display');?>" target="_blank" class="ec_help_icon_link">
			<div class="dashicons-before ec_help_icon dashicons-info"></div> <?php _e( 'Help', 'wp-easycart' ); ?>
		</a>
     	<?php echo wp_easycart_admin( )->helpsystem->print_vids_url('settings', 'product-settings', 'product-display');?>
    </div>
    
    <div class="ec_admin_settings_input ec_admin_settings_products_section">
        
		<?php wp_easycart_admin( )->load_toggle_group( 'ec_option_display_as_catalog', 'ec_admin_save_product_options', get_option( 'ec_option_display_as_catalog' ), __( 'Catalog Mode', 'wp-easycart' ), __( 'Enabling will remove Add to Cart buttons & Shopping Cart functionality. CAUTION: You cannot sell products in catalog mode!', 'wp-easycart' ) ); ?>
		
        <?php wp_easycart_admin( )->load_toggle_group( 'ec_option_subscription_one_only', 'ec_admin_save_product_options', get_option( 'ec_option_subscription_one_only' ), __( 'Subscriptions: Hide Quantity', 'wp-easycart' ), __( 'Enabling this removes the quantity box from subscriptions and allows just one per purchase.', 'wp-easycart' ) ); ?>
		
		<?php
			global $wpdb;
			$user_roles = $wpdb->get_results( "SELECT * FROM ec_role WHERE admin_access = 0" );
			$restricted_roles = explode( "***", get_option('ec_option_restrict_store' ) );
			$restricted_options = array(
				(object) array(
					'value'	=> '0',
					'label'	=> __( 'No Restrictions', 'wp-easycart' )
				)
			);
			foreach( $user_roles as $user_role ){ 
				$restricted_options[] = (object) array(
					'value'	=> $user_role->role_label,
					'label'	=> $user_role->role_label
				);
			}
		?>
		
        <?php wp_easycart_admin( )->load_toggle_group_select( 'ec_option_restrict_store', 'ec_admin_save_product_text_setting', $restricted_roles, __( 'Restrict Store', 'wp-easycart' ), __( 'Select user level(s) that are allowed access to your online store. Restricted users must login to view the store.', 'wp-easycart' ), $restricted_options, 'ec_admin_enable_metric_unit_display_row', true, false, true ); ?>
        
    </div>
    
    <div class="ec_admin_settings_input">
        <input type="submit" class="ec_admin_settings_simple_button" onclick="return ec_admin_save_product_settings( );" value="<?php _e( 'Save Options', 'wp-easycart' ); ?>" />
    </div>
    
</div>