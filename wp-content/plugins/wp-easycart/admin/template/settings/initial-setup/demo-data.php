<div id="install_demo_data" class="ec_admin_list_line_item ec_admin_demo_data_line"<?php if( get_option( 'ec_option_demo_data_installed' ) ){ ?> style="display:none;"<?php }?>>
            
	<?php wp_easycart_admin( )->preloader->print_preloader( "ec_admin_demo_data_loader" ); ?>
    
    <div class="ec_admin_settings_label">
		<div class="dashicons-before dashicons-download"></div>
		<span><?php _e( 'Install Demo Data (Optional)', 'wp-easycart' ); ?></span>
		<a href="<?php echo wp_easycart_admin( )->helpsystem->print_docs_url('settings', 'initial-setup', 'demo-data');?>" target="_blank" class="ec_help_icon_link">
			<div class="dashicons-before ec_help_icon dashicons-info"></div> <?php _e( 'Help', 'wp-easycart' ); ?>
		</a>
    	<?php echo wp_easycart_admin( )->helpsystem->print_vids_url('settings', 'initial-setup', 'demo-data');?>
	</div>
    
    <div class="ec_admin_settings_input">
        <span><?php _e( 'Install our demo data for quick testing', 'wp-easycart' ); ?></span>
    </div>
    <div class="ec_admin_settings_input">
         <a href="admin.php?page=wp-easycart-settings&subpage=initial-setup&action=easycart-install-demo-data" onclick="return ec_admin_install_demo_data( );" class="wp-easycart-admin-small-button"><?php _e( 'Install Demo Data Now!', 'wp-easycart' ); ?></a>
    </div>
</div>

<div id="uninstall_demo_data" class="ec_admin_list_line_item ec_admin_demo_data_line"<?php if( !get_option( 'ec_option_demo_data_installed' ) ){ ?> style="display:none;"<?php }?>>
    
    <?php wp_easycart_admin( )->preloader->print_preloader( "ec_admin_uninstall_demo_data_loader" ); ?>
    
    <div class="ec_admin_settings_label">
		<div class="dashicons-before dashicons-download"></div>
		<span><?php _e( 'Uninstall Demo Data', 'wp-easycart' ); ?></span>
		<a href="<?php echo wp_easycart_admin( )->helpsystem->print_docs_url('settings', 'initial-setup', 'demo-data');?>" target="_blank" class="ec_help_icon_link">
			<div class="dashicons-before ec_help_icon dashicons-info"></div> <?php _e( 'Help', 'wp-easycart' ); ?>
		</a>
    	<?php echo wp_easycart_admin( )->helpsystem->print_vids_url('settings', 'initial-setup', 'demo-data');?>
	</div>
    
    <div class="ec_admin_settings_input">
        <span><?php _e( 'Uninstall demo data (will remove all data imported, including products, accounts, and orders)', 'wp-easycart' ); ?></strong></p>
    </div>
    <div class="ec_admin_settings_input">
        <a href="admin.php?page=wp-easycart-settings&subpage=initial-setup&action=easycart-install-demo-data" onclick="return ec_admin_uninstall_demo_data( );" class="wp-easycart-admin-small-button"><?php _e( 'Uninstall Demo Data', 'wp-easycart' ); ?></a>
    </div>
</div>