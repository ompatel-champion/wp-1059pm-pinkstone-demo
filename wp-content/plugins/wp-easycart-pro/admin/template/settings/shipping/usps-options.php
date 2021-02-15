<div class="ec_admin_list_line_item">
    
	<div class="ec_admin_settings_label">
        <div class="dashicons-before dashicons-screenoptions"></div>
        <span><?php _e( 'USPS Setup', 'wp-easycart-pro' ); ?></span>
        <a href="<?php echo wp_easycart_admin( )->helpsystem->print_docs_url('settings', 'shipping-settings', 'usps');?>" target="_blank" class="ec_help_icon_link">
            <div class="dashicons-before ec_help_icon dashicons-info"></div> <?php _e( 'Help', 'wp-easycart-pro' ); ?>
        </a>
        <?php echo wp_easycart_admin( )->helpsystem->print_vids_url('settings', 'shipping-settings', 'usps'); ?>
    </div>
    
    <div class="ec_admin_settings_input ec_admin_settings_products_section wp_easycart_admin_no_padding">
        
        <?php if( method_exists( wp_easycart_admin( ), 'load_toggle_group' ) ){ ?>
        
            <?php wp_easycart_admin( )->load_toggle_group_text( 'usps_user_name', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->usps_user_name, 'User Name', 'This is from your USPS Web Account.', '', 'ec_admin_usps_user_name_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'usps_ship_from_zip', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->usps_ship_from_zip, 'Origin Zip', 'This is the zip code you are shipping packages from.', '', 'ec_admin_usps_ship_from_zip_row', true, false ); ?>
        
        <?php }else{ ?>
            
            <?php echo __( 'Pro feature missing. Please update your WP EasyCart Plugin to fix this issue.', 'wp-easycart-pro' ); ?>
        
        <?php } ?>
        
        <?php $usps_status = wp_easycart_admin_live_shipping_rates_pro( )->get_usps_status( ); ?>
        <div class="ec_admin_live_shipping_status_connected"<?php echo ( $usps_status != 'connected' ) ? ' style="display:none"' : ''; ?> id="ec_admin_usps_status_connected"><?php _e( 'Connected', 'wp-easycart-pro' ); ?></div>
        <div class="ec_admin_live_shipping_status_error"<?php echo ( $usps_status != 'error' ) ? ' style="display:none"' : ''; ?> id="ec_admin_usps_status_error"><?php _e( 'Error', 'wp-easycart-pro' ); ?></div>
        <div class="ec_admin_live_shipping_status_disabled"<?php echo ( $usps_status != 'disabled' ) ? ' style="display:none"' : ''; ?> id="ec_admin_usps_status_disabled"><?php _e( 'Disabled', 'wp-easycart-pro' ); ?></div>
        
    </div>
    
</div>