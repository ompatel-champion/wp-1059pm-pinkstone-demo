<?php
$is_premium = false;
$is_pro = false;
$is_expired = false;
$query_var = '';

if( function_exists( 'wp_easycart_admin_license' ) ){
	if( !wp_easycart_admin_license( )->active_license && wp_easycart_admin_license( )->valid_license ){
		$is_expired = true;
	}
	if( wp_easycart_admin_license( )->valid_license ){
		$is_pro = true;
	}
}
if( function_exists( 'ec_license_manager' ) ){
	$license_data = ec_license_manager( )->ec_get_license( );
	if( isset( $license_data->model_number ) && $license_data->model_number == 'ec410' )
		$is_premium = true;
	
}
if( get_option( 'wp_easycart_license_info' ) ){
	$registration_info = get_option( 'wp_easycart_license_info' );
	$query_var = '?transaction_key='.esc_attr( $registration_info['transaction_key'] );
}

if( $is_expired && $is_pro ){ // Existing license that is expired - Send to Premium Renewal
	$button = $app_button = $iphone_button = $ipad_button = $android_button = '<a href="https://www.wpeasycart.com/products/wp-easycart-premium-support-extensions/' . $query_var . '" target="_blank" class="get-extension">Renew License</a>';

}else if( !$is_pro ){ // No license - Send to buy Premium
	$button = $app_button = $iphone_button = $ipad_button = $android_button = 'custom';

}else if( $is_pro && !$is_premium ){ // Is valid PRO license - Send to Upgrade
	$button = $app_button = $iphone_button = $ipad_button = $android_button = '<a href="http://www.wpeasycart.com/products/wp-easycart-pro-to-premium-upgrade/' . $query_var . '" target="_blank" class="get-extension">Upgrade Today</a>';

}else{ // Premium User - Send to Download
	$button = '<a href="https://www.wpeasycart.com/premium-members-page/" target="_blank" class="get-extension">' . __( 'Download Extension', 'wp-easycart' ) . '</a>';
	$app_button = '<a href="https://www.wpeasycart.com/premium-members-page/" target="_blank" class="get-extension">' . __( 'Download App', 'wp-easycart' ) . '</a>';
	$iphone_button = '<a href="https://itunes.apple.com/us/app/wp-easycart-iphone/id1289942523?ls=1&mt=8" target="_blank" class="get-extension">' . __( 'Download App', 'wp-easycart' ) . '</a>';
	$ipad_button = '<a href="https://itunes.apple.com/us/app/wp-easycart/id616846878?mt=8" target="_blank" class="get-extension">' . __( 'Download App', 'wp-easycart' ) . '</a>';
	$android_button = '<a href="https://play.google.com/store/apps/details?id=air.com.wpeasycart.androidtablet&hl=en" target="_blank" class="get-extension">' . __( 'Download App', 'wp-easycart' ) . '</a>';
}
?>

<div class="ec_admin_extensions_list_wrap">
	<div class="ec_admin_extensions_list">
		
		<!--column 1-->
    	<div class="ec_admin_extension_item">
        	<h3><?php _e( 'Desktop App', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'Desktop App', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-desktop.jpg' ); ?>" />
            </a>
            <p><?php _e( 'Manage your store from your desktop with the WP EasyCart Desktop Application.', 'wp-easycart' ); ?></p>
            <?php echo ( $app_button != 'custom' ) ? $app_button : '<a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?>
        </div>
        <div class="ec_admin_extension_item">
        	<h3><?php _e( 'iPhone App', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'iPhone App', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-iphone.jpg' ); ?>" />
            </a>
            <p><?php _e( 'Manage your store from your iPhone with the WP EasyCart iPhone Application. Download from the iTunes app store today!', 'wp-easycart' ); ?></p>
            <?php echo ( $iphone_button != 'custom' ) ? $iphone_button : '<a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?>
        </div>
        <div class="ec_admin_extension_item">
        	<h3><?php _e( 'MailChimp', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'MailChimp Extension', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-mailchimp.jpg' ); ?>" />
            </a>
            <p><?php _e( 'Fully integrated with MailChimp\'s eCommerce features to track purchases directly related to mail campaigns.', 'wp-easycart' ); ?></p>
            <?php echo ( $button != 'custom' ) ? $button : '<a href="https://www.wpeasycart.com/wordpress-mailchimp-extension/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?><br>
			 <a href="http://docs.wpeasycart.com/wp-easycart-extensions-guide/?section=mailchimp" target="_blank" class="get-extension"><?php _e( 'Intallation Guide', 'wp-easycart' ); ?></a> 
        </div>
		<div class="ec_admin_extension_item">
        	<h3><?php _e( 'AffiliateWP Product Rates', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'AffiliateWP', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-affiliatewp.jpg' ); ?>" />
            </a>
            <p><?php _e( 'The AffiiliateWP product add-on allows you to add custom rates for individual products through Affiliate WP.  You still must have an AffiliateWP license and software to utilize this in combination with EasyCart.', 'wp-easycart' ); ?></p>
            <?php echo ( $button != 'custom' ) ? $button : '<a href="https://www.wpeasycart.com/wordpress-affiliate-wp-extension/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?>	<br>
			 <a href="http://docs.wpeasycart.com/wp-easycart-extensions-guide/?section=affiliatewp" target="_blank" class="get-extension"><?php _e( 'Intallation Guide', 'wp-easycart' ); ?></a> 		
        </div>
        <div class="ec_admin_extension_item">
        	<h3><?php _e( 'Tabs', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'Tabs Extension', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-tabs.jpg' ); ?>" />
            </a>
            <p><?php _e( 'The WP EasyCart Tabs Extension allows you to create custom tabs for each product. Now you can have more than just the Description &amp; Specifications tabs on each product entry.', 'wp-easycart' ); ?></p>
            <?php echo ( $button != 'custom' ) ? $button : '<a href="https://www.wpeasycart.com/wordpress-extra-tabs-extension/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?><br>
			 <a href="http://docs.wpeasycart.com/wp-easycart-extensions-guide/?section=system-requirements" target="_blank" class="get-extension"><?php _e( 'Intallation Guide', 'wp-easycart' ); ?></a>
        </div>
		
		
		<!--column 2-->
        <div class="ec_admin_extension_item">
        	<h3><?php _e( 'iPad App', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'iPad App', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-ipad.jpg' ); ?>" />
            </a>
            <p><?php _e( 'Manage your store from your iPad with the WP EasyCart iPad Application. Download from the iTunes app store today!', 'wp-easycart' ); ?></p>
            <?php echo ( $ipad_button != 'custom' ) ? $ipad_button : '<a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?>
        </div>
        <div class="ec_admin_extension_item">
        	<h3><?php _e( 'ShipStation', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'ShipStation Extension', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-shipstation.jpg' ); ?>" />
            </a>
            <p><?php _e( 'The WP EasyCart ShipStation extension automatically exports orders to ShipStation to quickly manage and automate your shipping system.', 'wp-easycart' ); ?></p>
            <?php echo ( $button != 'custom' ) ? $button : '<a href="https://www.wpeasycart.com/wordpress-shipstation-extension/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?><br>
			 <a href="http://docs.wpeasycart.com/wp-easycart-extensions-guide/?section=shipstation" target="_blank" class="get-extension"><?php _e( 'Intallation Guide', 'wp-easycart' ); ?></a>
        </div>
        <div class="ec_admin_extension_item">
        	<h3><?php _e( 'Stamps.com', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'Stamps.com Extension', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-stamps.jpg' ); ?>" />
            </a>
            <p><?php _e( 'The WP EasyCart Stamps.com extension allows you to purchase and print packaging labels for EasyCart orders directly with Stamps.com account.', 'wp-easycart' ); ?></p>
            <?php echo ( $button != 'custom' ) ? $button : '<a href="https://www.wpeasycart.com/wordpress-usps-stamps-extension/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?><br>
			 <a href="http://docs.wpeasycart.com/wp-easycart-extensions-guide/?section=stamps-com" target="_blank" class="get-extension"><?php _e( 'Intallation Guide', 'wp-easycart' ); ?></a>
        </div>
		<div class="ec_admin_extension_item">
        	<h3><?php _e( 'BlueCheck', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'Mandrill Extension', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-mandrill.jpg' ); ?>" />
            </a>
            <p><?php _e( 'The Mandrill extension will send your email subscribers from EasyCart to the Mandrill email system for more professional email sending.', 'wp-easycart' ); ?></p>
            <?php echo ( $button != 'custom' ) ? $button : '<a href="https://www.wpeasycart.com/wordpress-mandrill-extension/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?><br>
			 <a href="http://docs.wpeasycart.com/wp-easycart-extensions-guide/?section=mandrill-email" target="_blank" class="get-extension"><?php _e( 'Intallation Guide', 'wp-easycart' ); ?></a>
        </div>
        <div class="ec_admin_extension_item">
        	<h3><?php _e( 'BlueCheck', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'BlueCheck Extension', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-bluecheck.jpg' ); ?>" />
            </a>
            <p><?php _e( 'This plugin allows you to verify the age of your customers when selling vapor and eCigarette type goods. Learn more about BlueCheck at', 'wp-easycart' ); ?> <a href="http://www.bluecheck.me/" target="_blank">http://www.bluecheck.me/</a>.</p>
            <?php echo ( $button != 'custom' ) ? $button : '<a href="https://www.wpeasycart.com/wordpress-bluecheck-extension/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?><br>
			 <a href="http://docs.wpeasycart.com/wp-easycart-extensions-guide/?section=bluecheck" target="_blank" class="get-extension"><?php _e( 'Intallation Guide', 'wp-easycart' ); ?></a>
        </div>
		
		
		
		<!--column 3-->
        <div class="ec_admin_extension_item">
        	<h3><?php _e( 'Android App', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'Android App', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-android.jpg' ); ?>" />
            </a>
            <p><?php _e( 'Manage your store from your Android device with the WP EasyCart iPad Application. Download from the Google Play app store today!', 'wp-easycart' ); ?></p>
            <?php echo ( $android_button != 'custom' ) ? $android_button : '<a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?>
        </div>
		<div class="ec_admin_extension_item">
        	<h3><?php _e( 'Facebook & Instagram', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'Groupon Extension', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-facebook.jpg' ); ?>" />
            </a>
            <p><?php _e( 'Sell your products on Facebook & Instagram with the new feed extension.  Quickly pull products into Facebook dynamically or via CSV.', 'wp-easycart' ); ?></p>
            <?php echo ( $button != 'custom' ) ? $button : '<a href="https://www.wpeasycart.com/wordpress-facebook-instagram-extension/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?><br>
			 <a href="http://docs.wpeasycart.com/wp-easycart-extensions-guide/?section=facebook-instagram" target="_blank" class="get-extension"><?php _e( 'Intallation Guide', 'wp-easycart' ); ?></a>
        </div>
        <div class="ec_admin_extension_item">
        	<h3><?php _e( 'Groupon', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'Groupon Extension', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-groupon.jpg' ); ?>" />
            </a>
            <p><?php _e( 'Import your Groupon coupon codes quickly into your WP EasyCart system.', 'wp-easycart' ); ?></p>
            <?php echo ( $button != 'custom' ) ? $button : '<a href="https://www.wpeasycart.com/wordpress-groupon-extension/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?><br>
			 <a href="http://docs.wpeasycart.com/wp-easycart-extensions-guide/?section=groupon-importer" target="_blank" class="get-extension"><?php _e( 'Intallation Guide', 'wp-easycart' ); ?></a>
        </div>
        <div class="ec_admin_extension_item">
        	<h3><?php _e( 'Quickbooks', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'Quickbooks Extension', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-quickbooks.jpg' ); ?>" />
            </a>
            <p><?php _e( 'The EasyCart QuickBooks integration plugin allows you to seamlessly have order information, customer account data, and even product information flow from EasyCart to your QuickBooks.', 'wp-easycart' ); ?></p>
            <?php echo ( $button != 'custom' ) ? $button : '<a href="https://www.wpeasycart.com/wordpress-quickbooks-extension/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?><br>
			 <a href="http://docs.wpeasycart.com/wp-easycart-extensions-guide/?section=quickbooks" target="_blank" class="get-extension"><?php _e( 'Intallation Guide', 'wp-easycart' ); ?></a>
        </div>
        <div class="ec_admin_extension_item">
        	<h3><?php _e( 'Optimal Logistics', 'wp-easycart' ); ?></h3>
            <a href="https://www.wpeasycart.com/wordpress-ecommerce-premium-edition/" target="_blank">
                <img alt="<?php _e( 'Optimal Logistics Extension', 'wp-easycart' ); ?>" src="<?php echo plugins_url( EC_PLUGIN_DIRECTORY . '/admin/images/extension-optimalship.jpg' ); ?>" />
            </a>
            <p><?php _e( 'This plugin allows you to use Optimalship to get a single DHL rate for international orders.', 'wp-easycart' ); ?></p>
            <?php echo ( $button != 'custom' ) ? $button : '<a href="https://www.wpeasycart.com/wordpress-optimalship-extension/" target="_blank" class="get-extension">' . __( 'Learn More', 'wp-easycart' ) . '</a>'; ?><br>
			 <a href="http://docs.wpeasycart.com/wp-easycart-extensions-guide/?section=optimal-logistics" target="_blank" class="get-extension"><?php _e( 'Intallation Guide', 'wp-easycart' ); ?></a>
        </div>
    </div>
</div>
	