<div class="ec_admin_list_line_item">
    
	<div class="ec_admin_settings_label">
        <div class="dashicons-before dashicons-screenoptions"></div>
        <span><?php _e( 'Canada Post Setup', 'wp-easycart-pro' ); ?></span>
        <a href="<?php echo wp_easycart_admin( )->helpsystem->print_docs_url('settings', 'shipping-settings', 'canada-post');?>" target="_blank" class="ec_help_icon_link">
            <div class="dashicons-before ec_help_icon dashicons-info"></div> <?php _e( 'Help', 'wp-easycart-pro' ); ?>
        </a>
        <?php echo wp_easycart_admin( )->helpsystem->print_vids_url('settings', 'shipping-settings', 'canada-post');?>
    </div>
    
    <div class="ec_admin_settings_input ec_admin_settings_products_section wp_easycart_admin_no_padding">
        
        <?php if( method_exists( wp_easycart_admin( ), 'load_toggle_group' ) ){ ?>
        
            <?php wp_easycart_admin( )->load_toggle_group_text( 'canadapost_username', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->canadapost_username, 'API User Name', 'This is from your Canada Post Account.', '', 'ec_admin_canadapost_username_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'canadapost_password', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->canadapost_password, 'API Password', 'This is from your Canada Post Account.', '', 'ec_admin_canadapost_password_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'canadapost_customer_number', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->canadapost_customer_number, 'Customer Number', 'This is from your Canada Post Account.', '', 'ec_admin_canadapost_customer_number_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'canadapost_contract_id', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->canadapost_contract_id, 'Negotiated Rates Contract ID', 'This is from your Canada Post Account.', '', 'ec_admin_canadapost_contract_id_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'canadapost_ship_from_zip', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->canadapost_ship_from_zip, 'Ship From Postal Code', 'This is the postal code you are shipping from.', '', 'ec_admin_canadapost_ship_from_zip_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group( 'canadapost_test_mode', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->canadapost_test_mode, 'Test Mode', 'Enabling this will get requests in test mode through Canada Post.' ); ?>
		
        <?php }else{ ?>
            
            <?php echo __( 'Pro feature missing. Please update your WP EasyCart Plugin to fix this issue.', 'wp-easycart-pro' ); ?>
        
        <?php } ?>
        
        <?php $canadapost_status = wp_easycart_admin_live_shipping_rates_pro( )->get_canadapost_status( ); ?>
        <div class="ec_admin_live_shipping_status_connected"<?php echo ( $canadapost_status != 'connected' ) ? ' style="display:none"' : ''; ?> id="ec_admin_canadapost_status_connected"><?php _e( 'Connected', 'wp-easycart-pro' ); ?></div>
        <div class="ec_admin_live_shipping_status_error"<?php echo ( $canadapost_status != 'error' ) ? ' style="display:none"' : ''; ?> id="ec_admin_canadapost_status_error"><?php _e( 'Error', 'wp-easycart-pro' ); ?></div>
        <div class="ec_admin_live_shipping_status_disabled"<?php echo ( $canadapost_status != 'disabled' ) ? ' style="display:none"' : ''; ?> id="ec_admin_canadapost_status_disabled"><?php _e( 'Disabled', 'wp-easycart-pro' ); ?></div>
        
    </div>
    
</div>