<?php
/**************************
Tax Cloud
***************************/
global $wpdb;
$us_states = $wpdb->get_results( "SELECT name_sta AS label, code_sta AS value FROM ec_state WHERE idcnt_sta = 223 ORDER BY name_sta ASC" );
?>
<div class="ec_admin_list_line_item" style="float:left;">
	
	<?php wp_easycart_admin( )->preloader->print_preloader( "ec_admin_tax_cloud_loader" ); ?>
	
	<div class="ec_admin_settings_label">
        <div class="dashicons-before dashicons-cloud"></div>
        <span><?php _e( 'Tax Cloud for USA', 'wp-easycart-pro' ); ?></span>
        <a href="<?php echo wp_easycart_admin( )->helpsystem->print_docs_url('settings', 'taxes', 'tax-cloud-setup');?>" target="_blank" class="ec_help_icon_link">
            <div class="dashicons-before ec_help_icon dashicons-info"></div> <?php _e( 'Help', 'wp-easycart-pro' ); ?>
        </a>
        <?php echo wp_easycart_admin( )->helpsystem->print_vids_url('settings', 'taxes', 'tax-cloud-setup');?>
    </div>
	
	<div class="ec_admin_settings_input ec_admin_settings_products_section wp_easycart_admin_no_padding">
		
        <?php if( method_exists( wp_easycart_admin( ), 'load_toggle_group_text' ) ){ ?>
        
            <?php wp_easycart_admin( )->load_toggle_group_text( 'ec_option_tax_cloud_api_id', 'ec_admin_save_tax_cloud_text_setting', get_option( 'ec_option_tax_cloud_api_id' ), 'API ID', 'Get this from your Tax Cloud account.', '', '', true ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'ec_option_tax_cloud_api_key', 'ec_admin_save_tax_cloud_text_setting', get_option( 'ec_option_tax_cloud_api_key' ), 'API Key', 'Get this from your Tax Cloud account.', '', '', true ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'ec_option_tax_cloud_address', 'ec_admin_save_tax_cloud_text_setting', get_option( 'ec_option_tax_cloud_address' ), 'Origin Address', 'Address you are shipping from.', '', '', true ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'ec_option_tax_cloud_city', 'ec_admin_save_tax_cloud_text_setting', get_option( 'ec_option_tax_cloud_city' ), 'Origin City', 'City you are shipping from.', '', '', true ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_select( 'ec_option_tax_cloud_state', 'ec_admin_save_tax_cloud_text_setting', get_option( 'ec_option_tax_cloud_state' ), 'Origin State', 'State you are shipping from.', $us_states, '', true, false ); ?>

            <?php wp_easycart_admin( )->load_toggle_group_text( 'ec_option_tax_cloud_zip', 'ec_admin_save_tax_cloud_text_setting', get_option( 'ec_option_tax_cloud_zip' ), 'Origin Zip', 'Zip you are shipping from.', '', '', true ); ?>
        
        <?php }else{ ?>
            
            <?php echo __( 'Pro feature missing. Please update your WP EasyCart Plugin to fix this issue.', 'wp-easycart-pro' ); ?>
        
        <?php } ?>
        
	</div>
	
</div>