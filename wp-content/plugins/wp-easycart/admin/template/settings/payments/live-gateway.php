<div class="ec_admin_list_line_item">
    
    <?php wp_easycart_admin( )->preloader->print_preloader( "ec_admin_live_gateway_display_loader" ); ?>
    
    <div class="ec_admin_settings_label"><div class="dashicons-before dashicons-lock"></div><span><?php _e( 'Live Payment', 'wp-easycart' ); ?></span>
        <a href="<?php echo wp_easycart_admin( )->helpsystem->print_docs_url('settings', 'payment', 'live-gateway');?>" target="_blank" class="ec_help_icon_link">
            <div class="dashicons-before ec_help_icon dashicons-info"></div> <?php _e( 'Help', 'wp-easycart' ); ?>
        </a>
        <?php echo wp_easycart_admin( )->helpsystem->print_vids_url('settings', 'payment', 'live-gateway');?>
    </div>
    
    <?php if( get_option( 'ec_option_stripe_connect_use_sandbox' ) && get_option( 'ec_option_stripe_connect_sandbox_access_token' ) != '' ){ ?>
    <div class="ec_admin_stripe_holder">
    	<h1 class="ec_admin_stripe_title"><?php _e( 'Connected with Stripe Sandbox', 'wp-easycart' ); ?></h1>
        <h3 class="ec_admin_stripe_subtitle"><?php _e( 'You are ready to process payments in test mode', 'wp-easycart' ); ?></h3>
        <div class="ec_admin_stripe_button_row">
        	<div style="width:100%;"><img style="max-width:100%;" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/Stripe Logo (blue).png' ); ?>" alt="Stripe" /></div>
    		<?php if( get_option( 'ec_option_stripe_connect_production_access_token' ) != '' ){ ?>
            <a href="admin.php?page=wp-easycart-settings&subpage=payment&ec_admin_form_action=stripe-connect-use-production"><?php _e( 'Switch to Live Mode', 'wp-easycart' ); ?></a>
            <?php }else{ ?>
            <a href="https://connect.wpeasycart.com/connect/?step=start&redirect=<?php echo urlencode( admin_url( ) . '?ec_admin_form_action=stripe_onboard&env=production' ); ?>&env=production"><?php _e( 'Switch to Live Mode', 'wp-easycart' ); ?></a><?php }?> | <a href="admin.php?page=wp-easycart-settings&subpage=payment&ec_admin_form_action=stripe-connect-sandbox-disconnect"><?php _e( 'Change Payment Method', 'wp-easycart' ); ?></a>
        </div>
        <div class="ec_admin_stripe_legal">*<?php _e( 'WP EasyCart charges a 2% application fee on all sales with Stripe in the free edition.', 'wp-easycart' ); ?></div>
    	<div class="ec_admin_settings_notice" style="text-align:center; padding:0 10px 20px;"><strong><?php _e( 'Webhook URL', 'wp-easycart' ); ?>:</strong> <?php echo plugins_url( EC_PLUGIN_DIRECTORY . "/inc/scripts/stripe_webhook.php" ); ?></div>
    	<div class="ec_admin_settings_notice" style="text-align:center; padding:0 10px 20px;"><strong><?php _e( 'To Do', 'wp-easycart' ); ?>:</strong> <?php _e( 'You must add the Webhook URL to your Stripe account for best results.', 'wp-easycart' ); ?> <a href="http://docs.wpeasycart.com/wp-easycart-administrative-console-guide/?section=stripe" target="_blank"><?php _e( 'Click Here to Learn More', 'wp-easycart' ); ?></a></div>
    </div>
    
	<?php }else if( !get_option( 'ec_option_stripe_connect_use_sandbox' ) && get_option( 'ec_option_stripe_connect_production_access_token' ) != '' ){ ?>
    <div class="ec_admin_stripe_holder">
    	<h1 class="ec_admin_stripe_title"><?php _e( 'Connected with Stripe', 'wp-easycart' ); ?></h1>
        <h3 class="ec_admin_stripe_subtitle"><?php _e( 'You are ready to process payments in live mode', 'wp-easycart' ); ?></h3>
        <div class="ec_admin_stripe_button_row">
        	<div style="width:100%;"><img style="max-width:100%;" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/Stripe Logo (blue).png' ); ?>" alt="Stripe" /></div>
    		<?php if( get_option( 'ec_option_stripe_connect_sandbox_access_token' ) != '' ){ ?>
            <a href="admin.php?page=wp-easycart-settings&subpage=payment&ec_admin_form_action=stripe-connect-use-sandbox"><?php _e( 'Switch to Sandbox Mode', 'wp-easycart' ); ?></a>
            <?php }else{ ?>
            <a href="https://connect.wpeasycart.com/connect/?step=start&redirect=<?php echo urlencode( admin_url( ) . '?ec_admin_form_action=stripe_onboard&env=sandbox' ); ?>&env=sandbox"><?php _e( 'Switch to Sandbox Mode', 'wp-easycart' ); ?></a><?php }?> | <a href="admin.php?page=wp-easycart-settings&subpage=payment&ec_admin_form_action=stripe-connect-production-disconnect"><?php _e( 'Change Payment Method', 'wp-easycart' ); ?></a>
        </div>
        <div class="ec_admin_stripe_legal">*<?php _e( 'WP EasyCart charges a 2% application fee on all sales with Stripe in the free edition.', 'wp-easycart' ); ?></div>
    	<div class="ec_admin_settings_notice" style="text-align:center; padding:0 10px 20px;"><strong><?php _e( 'Webhook URL', 'wp-easycart' ); ?>:</strong> <?php echo plugins_url( EC_PLUGIN_DIRECTORY . "/inc/scripts/stripe_webhook.php" ); ?></div>
    </div>
    
    <?php }else{ ?>
    <div class="ec_admin_stripe_holder">
    	<h1 class="ec_admin_stripe_title"><?php _e( 'WP EasyCart + Stripe', 'wp-easycart' ); ?></h1>
        <h3 class="ec_admin_stripe_subtitle"><?php _e( 'Included FREE in WP EasyCart!', 'wp-easycart' ); ?>*</h3>
        <div class="ec_admin_stripe_button_row">
        	<a href="https://connect.wpeasycart.com/connect/?step=start&redirect=<?php echo urlencode( admin_url( ) . '?ec_admin_form_action=stripe_onboard&env=production' ); ?>&env=production" target="_self">
        		<img src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/blue-on-light.png' ); ?>" alt="<?php _e( 'Connect with Stripe', 'wp-easycart' ); ?>" />
    		</a>
            <br />
            <a href="https://connect.wpeasycart.com/connect/?step=start&redirect=<?php echo urlencode( admin_url( ) . '?ec_admin_form_action=stripe_onboard&env=sandbox' ); ?>&env=sandbox"><?php _e( 'Try Sandbox First?', 'wp-easycart' ); ?></a>
        </div>
        <div class="ec_admin_stripe_legal">*<?php _e( 'WP EasyCart charges a 2% application fee on all sales with Stripe in the free edition.', 'wp-easycart' ); ?></div>
    
    	<div class="ec_admin_paypal_or">-- <?php _e( 'OR', 'wp-easycart' ); ?> --</div>
    </div>
    
    <?php do_action( 'wp_easycart_admin_live_gateway_post_stripe' ); ?>
    
    <h1 class="ec_admin_stripe_title" style="color:#333; margin-top:10px;"><?php _e( 'Use one of our PRO gateways', 'wp-easycart' ); ?></h1>
    <h3 class="ec_admin_stripe_subtitle"><?php _e( 'No Application Fees, Sell Like a Pro!', 'wp-easycart' ); ?></h3>
     
    <div class="ec_admin_live_gateway_select">
    	<select id="ec_option_payment_process_method" name="ec_option_payment_process_method" onchange="toggle_live_gateways( );<?php do_action( 'wp_easycart_pro_add_live_save' ); ?>" value="<?php echo get_option('ec_option_payment_process_method'); ?>" style="width:250px;">
        	<option value="0" <?php if( get_option( 'ec_option_payment_process_method') == "0" ){ echo " selected"; } ?>><?php _e( 'No Live Payment Processor', 'wp-easycart' ); ?></option>
        	<?php do_action( 'wpeasycart_admin_load_live_gateway_select_options' ); ?>
    	</select>
    </div>
    
    <?php do_action( 'wpeasycart_admin_load_live_gateway_settings' ); ?>
    
    <div class="ec_admin_settings_input<?php if( get_option( 'ec_option_payment_process_method' ) != '0' && get_option( 'ec_option_payment_process_method' ) != 'custom' ){ ?> ec_admin_initial_hide<?php }?>" id="ec_admin_live_gateway_none">
        <?php /*<input type="submit" class="ec_admin_settings_simple_button" onclick="return ec_admin_save_live_gateway_selection( );" value="<?php _e( 'Save Options" />*/ ?>
    </div>
    <?php }?>
    
</div>