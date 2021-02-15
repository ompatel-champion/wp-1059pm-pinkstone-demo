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
        'value' => 'LB',
        'label' => 'LBS'
    ),
    (object) array(
        'value' => 'KG',
        'label' => 'KGS'
    )
);
?>
<div class="ec_admin_list_line_item">
    
	<div class="ec_admin_settings_label">
        <div class="dashicons-before dashicons-screenoptions"></div>
        <span><?php _e( 'FedEx Setup', 'wp-easycart-pro' ); ?></span>
        <a href="<?php echo wp_easycart_admin( )->helpsystem->print_docs_url('settings', 'shipping-settings', 'fedex');?>" target="_blank" class="ec_help_icon_link">
            <div class="dashicons-before ec_help_icon dashicons-info"></div> <?php _e( 'Help', 'wp-easycart-pro' ); ?>
        </a>
        <?php echo wp_easycart_admin( )->helpsystem->print_vids_url('settings', 'shipping-settings', 'fedex');?>
    </div>
    
    <div class="ec_admin_settings_input ec_admin_settings_products_section wp_easycart_admin_no_padding">
        
        <?php if( method_exists( wp_easycart_admin( ), 'load_toggle_group' ) ){ ?>
        
            <?php wp_easycart_admin( )->load_toggle_group_text( 'fedex_key', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->fedex_key, 'Access Key', 'This is from your FedEx Account.', '', 'ec_admin_fedex_key_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'fedex_account_number', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->fedex_account_number, 'Account Number', 'This is from your FedEx Account.', '', 'ec_admin_fedex_account_number_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'fedex_meter_number', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->fedex_meter_number, 'Meter Number', 'This is the meter number for your FedEx account.', '', 'ec_admin_fedex_meter_number_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'fedex_password', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->fedex_password, 'API Password', 'This is your FedEx API password.', '', 'ec_admin_fedex_password_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'fedex_ship_from_zip', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->fedex_ship_from_zip, 'Origin Postal Code', 'This is the postal code you will be shipping from.', '', 'ec_admin_fedex_ship_from_zip_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_select( 'fedex_country_code', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->fedex_country_code, 'Origin Country', 'This is the country you will be shipping from.', $countries, '', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_select( 'fedex_weight_units', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->fedex_weight_units, 'Weight Unit', 'The standard weight unit of shipments and your website product weight.', $weight_units, '', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'fedex_conversion_rate', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->fedex_conversion_rate, 'Conversion Rate', 'This is the conversion rate to use from returning FedEx rates to your base currency (or use to add a percentage to every rate).', '1.000', 'ec_admin_fedex_conversion_rate_row', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group( 'fedex_test_account', 'ec_admin_save_shipping_text_setting_pro', wp_easycart_admin( )->settings->fedex_test_account, 'Test Mode', 'Enabling this will get requests in test mode through FedEx.' ); ?>
		
        <?php }else{ ?>
            
            <?php echo __( 'Pro feature missing. Please update your WP EasyCart Plugin to fix this issue.', 'wp-easycart-pro' ); ?>
        
        <?php } ?>
        
        <?php $fedex_status = wp_easycart_admin_live_shipping_rates_pro( )->get_fedex_status( ); ?>
        <div class="ec_admin_live_shipping_status_connected"<?php echo ( $fedex_status != 'connected' ) ? ' style="display:none"' : ''; ?> id="ec_admin_fedex_status_connected"><?php _e( 'Connected', 'wp-easycart-pro' ); ?></div>
        <div class="ec_admin_live_shipping_status_error"<?php echo ( $fedex_status != 'error' ) ? ' style="display:none"' : ''; ?> id="ec_admin_fedex_status_error"><?php _e( 'Error', 'wp-easycart-pro' ); ?></div>
        <div class="ec_admin_live_shipping_status_disabled"<?php echo ( $fedex_status != 'disabled' ) ? ' style="display:none"' : ''; ?> id="ec_admin_fedex_status_disabled"><?php _e( 'Disabled', 'wp-easycart-pro' ); ?></div>
        
    </div>
    
</div>