<?php
global $wpdb;
$country_none = array( 
    (object) array(
        'value' => '',
        'label' => __( 'Select One', 'wp-easycart-pro' )
    )
);
$country_list = $wpdb->get_results( "SELECT iso2_cnt AS value, name_cnt AS label FROM ec_country ORDER BY sort_order ASC" );
$countries = array_merge( $country_none, $country_list );
$weight_units = array(
    (object) array(
        'value' => '',
        'label' => __( 'Select One', 'wp-easycart-pro' )
    ),
    (object) array(
        'value' => 'LBS',
        'label' => 'LBS'
    ),
    (object) array(
        'value' => 'KGS',
        'label' => 'KGS'
    )
);
?>
<div class="ec_admin_list_line_item">
    
	<div class="ec_admin_settings_label">
        <div class="dashicons-before dashicons-screenoptions"></div>
        <span><?php _e( 'UPS Setup', 'wp-easycart-pro' ); ?></span>
        <a href="<?php echo wp_easycart_admin( )->helpsystem->print_docs_url('settings', 'shipping-settings', 'ups');?>" target="_blank" class="ec_help_icon_link">
            <div class="dashicons-before ec_help_icon dashicons-info"></div> <?php _e( 'Help', 'wp-easycart-pro' ); ?>
        </a>
        <?php echo wp_easycart_admin( )->helpsystem->print_vids_url('settings', 'shipping-settings', 'ups');?>
    </div>
    
    <div class="ec_admin_settings_input ec_admin_settings_products_section wp_easycart_admin_no_padding">
    
        <?php if( method_exists( wp_easycart_admin( ), 'load_toggle_group' ) ){ ?>
        
            <?php wp_easycart_admin( )->load_toggle_group_text( 'ups_access_license_number', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->ups_access_license_number, 'Access Key', 'This is from your UPS Account.', '', 'ec_admin_ups_access_license_number_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'ups_user_id', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->ups_user_id, 'User ID', 'This is from your UPS Account.', '', 'ec_admin_ups_user_id_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'ups_password', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->ups_password, 'Password', 'This is from your UPS Account.', '', 'ec_admin_ups_password_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'ups_shipper_number', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->ups_shipper_number, 'Shipper Number', 'This is from your UPS Account.', '', 'ec_admin_ups_shipper_number_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'ups_ship_from_zip', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->ups_ship_from_zip, 'Origin Postal Code', 'This is the postal code you ship from.', '', 'ec_admin_ups_ship_from_zip_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_select( 'ups_country_code', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->ups_country_code, 'Origin Country', 'This is the country you will be shipping from.', $countries, '', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_select( 'ups_weight_type', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->ups_weight_type, 'Weight Unit', 'The standard weight unit of shipments and your website product weight.', $weight_units, '', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'ups_conversion_rate', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->ups_conversion_rate, 'Conversion Rate', 'This will convert rates from the response currency into your base currency, also used to pad costs higher or lower.', '', 'ec_admin_ups_conversion_rate_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group( 'ups_negotiated_rates', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->ups_negotiated_rates, 'Negotiated Rates', 'Enabling this will get negotiated rates, if available.' ); ?>
        
        <?php }else{ ?>
            
            <?php echo __( 'Pro feature missing. Please update your WP EasyCart Plugin to fix this issue.', 'wp-easycart-pro' ); ?>
        
        <?php } ?>
        
        <?php $ups_status = wp_easycart_admin_live_shipping_rates_pro( )->get_ups_status( ); ?>
        <div class="ec_admin_live_shipping_status_connected"<?php echo ( $ups_status != 'connected' ) ? ' style="display:none"' : ''; ?> id="ec_admin_ups_status_connected"><?php _e( 'Connected', 'wp-easycart-pro' ); ?></div>
        <div class="ec_admin_live_shipping_status_error"<?php echo ( $ups_status != 'error' ) ? ' style="display:none"' : ''; ?> id="ec_admin_ups_status_error"><?php _e( 'Error', 'wp-easycart-pro' ); ?></div>
        <div class="ec_admin_live_shipping_status_disabled"<?php echo ( $ups_status != 'disabled' ) ? ' style="display:none"' : ''; ?> id="ec_admin_ups_status_disabled"><?php _e( 'Disabled', 'wp-easycart-pro' ); ?></div>
        
    </div>
    
</div>