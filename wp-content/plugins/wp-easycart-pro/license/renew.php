<?php
$curr_page = "";
if( isset( $_GET['subpage'] ) )
	$curr_page = esc_attr( $_GET['subpage'] );
else
	$curr_page = esc_attr( $_GET['page'] );
?>
<div class="ec_admin_settings_panel ec_admin_details_panel">
    
    <div class="ec_admin_important_numbered_list">
		
        <div class="ec_admin_flex_row">

			<div class="ec_admin_list_line_item ec_admin_col_12 ec_admin_col_first">
			
                <div class="ec_admin_settings_label">
                    <div class="dashicons-before dashicons-lock"></div>
                    <span>Your License Has Expired!</span>
                    <a href="https://www.wpeasycart.com/wordpress-shopping-cart-pricing/" target="_blank" class="ec_help_icon_link"><div class="dashicons-before ec_help_icon dashicons-info"></div></a>
                </div>
    
                <div class="ec_admin_upgrade_wrap">
                    
                    <div>                   
						<?php
						$pro_plugin_base = 'wp-easycart-pro/wp-easycart-admin-pro.php';
						$pro_plugin_file = WP_PLUGIN_DIR . '/' . $pro_plugin_base;
						if( file_exists( $pro_plugin_file ) && !is_plugin_active( $pro_plugin_base ) ) {
							echo '<div class="ec_admin_message_error">';
							echo '<p>WP EasyCart PRO is installed but NOT ACTIVATED. Please <a href="' . wp_easycart_admin( )->get_pro_activation_link( ) . '">click here to activate your WP EasyCart PRO plugin</a>.</p>';
							echo '</div>';
						} ?>
                        <?php $license_data = ec_license_manager( )->ec_get_license( ); ?>
                        <?php $license_info = get_option( 'wp_easycart_license_info' ); ?>
						<div class="ec_admin_upgrade_header">You must <?php echo ( $license_data->is_trial ) ? 'upgrade' : 'renew'; ?> your license to use this feature</div>
						<div class="ec_admin_upgrade_subheader">Your <?php echo ( $license_data->is_trial ) ? 'trial ended' : 'license expired'; ?> on <?php echo date( 'F j, Y', strtotime( wp_easycart_admin_license( )->license_data->support_end_date ) ); ?><br />Please <?php echo ( $license_data->is_trial ) ? 'upgrade' : 'renew'; ?> today to continue using the WP EasyCart.</div>
						<?php if( $license_data->is_trial ){ ?>
                        <div class="ec_admin_upgrade_subheader ec_admin_upgrade_box_signup_row"><a href="https://www.wpeasycart.com/products/wp-easycart-trial-upgrade/?transaction_key=<?php echo $license_info['transaction_key']; ?>" target="_blank">UPGRADE TODAY</a></div>
						<?php }else if( $license_data->model_number == 'ec400' ){ ?>
                        <div class="ec_admin_upgrade_subheader ec_admin_upgrade_box_signup_row"><a href="https://www.wpeasycart.com/products/wp-easycart-professional-support-upgrades/?transaction_key=<?php echo $license_info['transaction_key']; ?>" target="_blank">RENEW LICENSE</a></div>
						<?php }else{ ?>
                        <div class="ec_admin_upgrade_subheader ec_admin_upgrade_box_signup_row"><a href="https://www.wpeasycart.com/products/wp-easycart-premium-support-extensions/?transaction_key=<?php echo $license_info['transaction_key']; ?>" target="_blank">RENEW LICENSE</a></div>
						<?php }?>
                        <div class="ec_admin_upgrade_box_line_item"><a href="https://www.wpeasycart.com/wordpress-shopping-cart-pricing/" target="_blank">You are currently reverted to the FREE edition, learn more about license types here.</a></div>
                    </div>
                    
                    <div class="ec_admin_upgrade_divider" style="margin-bottom:25px;"><div></div></div>
                    
                    <div class="ec_admin_upgrade_box_container"<?php if( $license_data->model_number == 'ec410' ){ ?> style="display:block;"<?php }?>>
                    	
                        <?php if( $license_data->model_number == 'ec400' ){ ?>
                        <div class="ec_admin_upgrade_box ec_admin_upgrade_box_most_popular">
                            
                            <div class="ec_admin_upgrade_box_line_item">
                                <div class="ec_admin_upgrade_box_title">Professional</div>
                            </div>
                            
                            <div class="ec_admin_upgrade_box_line_item"><img src="<?php echo plugins_url( 'wp-easycart/admin/images/v4-professional-edition.jpg' ); ?>" alt="Premium Edition" /></div>
                            
                            <div class="ec_admin_upgrade_box_line_item ec_admin_upgrade_box_signup_row">
                            	<?php if( $license_data->is_trial ){ ?>
                            	<a href="https://www.wpeasycart.com/products/wp-easycart-trial-upgrade/?transaction_key=<?php echo $license_info['transaction_key']; ?>&license_type=professional" target="_blank">UPGRADE TRIAL</a>
                                <?php }else if( $license_data->model_number == 'ec400' ){ ?>
                                <a href="https://www.wpeasycart.com/products/wp-easycart-professional-support-upgrades/?transaction_key=<?php echo $license_info['transaction_key']; ?>" target="_blank">RENEW LICENSE</a>
                                <?php }else{ ?>
                                <a href="https://www.wpeasycart.com/products/wp-easycart-professional-support-upgrades/?transaction_key=<?php echo $license_info['transaction_key']; ?>" target="_blank">DOWNGRADE LICENSE</a>
                                <?php }?>
                            </div>
                            
                            <div class="ec_admin_upgrade_box_line_item">30+ Payment Methods</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">Sell with PayPal, Square, Intuit, Stripe & More</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">USPS, UPS, FedEx, DHL, Australia Post, & Canada Post</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">Unlimited Support Tickets</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">Coupons, Promotions, & Gift Cards</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">B2B, Volume & Option Product Pricing</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">Categories & Product Groupings</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">Sell Downloads, Subscriptions, & Gift Cards</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">12 Advanced Product Variant Types</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">8+ Tax Options</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">Unlimited Products</div>
                            
                            <div class="ec_admin_upgrade_box_line_item" style="color:#666;">No Premium Extensions</div>
                            
                            <div class="ec_admin_upgrade_box_line_item" style="color:#666;">No Premium Apps</div>
                            
                            <div class="ec_admin_upgrade_box_line_item" style="color:#666;">No QuickBooks</div>
                            
                            <div class="ec_admin_upgrade_box_line_item" style="color:#666;">No MailChimp</div>
                            
                            <div class="ec_admin_upgrade_box_line_item" style="color:#666;">No ShipStation</div>
                            
                            <div class="ec_admin_upgrade_box_line_item" style="color:#666;">No Groupon Importer</div>
                            
                            <div class="ec_admin_upgrade_box_line_item ec_admin_upgrade_box_signup_row">
								<?php if( $license_data->is_trial ){ ?>
                            	<a href="https://www.wpeasycart.com/products/wp-easycart-trial-upgrade/?transaction_key=<?php echo $license_info['transaction_key']; ?>&license_type=professional" target="_blank">UPGRADE TRIAL</a>
                                <?php }else if( $license_data->model_number == 'ec400' ){ ?>
                                <a href="https://www.wpeasycart.com/products/wp-easycart-professional-support-upgrades/?transaction_key=<?php echo $license_info['transaction_key']; ?>" target="_blank">RENEW LICENSE</a>
                                <?php }else{ ?>
                                <a href="https://www.wpeasycart.com/products/wp-easycart-professional-support-upgrades/?transaction_key=<?php echo $license_info['transaction_key']; ?>" target="_blank">DOWNGRADE LICENSE</a>
                                <?php }?>
                            </div>
                            
                        </div>
                        <?php }?>
                        
                        <div class="ec_admin_upgrade_box"<?php if( $license_data->model_number == 'ec410' ){ ?> style="width:100%; margin:0;"<?php }?>>
                        
                            <div class="ec_admin_upgrade_box_line_item">
                                <div class="ec_admin_upgrade_box_title">Premium</div>
                            </div>
                            
                            <div class="ec_admin_upgrade_box_line_item"><img src="<?php echo plugins_url( 'wp-easycart/admin/images/v4-premium-edition.jpg' ); ?>" alt="Premium Edition" /></div>
                            
                            <div class="ec_admin_upgrade_box_line_item ec_admin_upgrade_box_signup_row">
                            	<?php if( $license_data->is_trial ){ ?>
                            	<a href="https://www.wpeasycart.com/products/wp-easycart-trial-upgrade/?transaction_key=<?php echo $license_info['transaction_key']; ?>&license_type=premium" target="_blank">UPGRADE TRIAL</a>
                                <?php }else if( $license_data->model_number == 'ec400' ){ ?>
                                <a href="https://www.wpeasycart.com/products/wp-easycart-premium-support-extensions/?transaction_key=<?php echo $license_info['transaction_key']; ?>" target="_blank">UPGRADE LICENSE</a>
                                <?php }else{ ?>
                                <a href="https://www.wpeasycart.com/products/wp-easycart-premium-support-extensions/?transaction_key=<?php echo $license_info['transaction_key']; ?>" target="_blank">RENEW LICENSE</a>
                                <?php }?>
                            </div>
                            
                            <div class="ec_admin_upgrade_box_line_item">30+ Payment Methods</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">Sell with PayPal, Square, Intuit, Stripe & More</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">USPS, UPS, FedEx, DHL, Australia Post, & Canada Post</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">Unlimited Support Tickets</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">Coupons, Promotions, & Gift Cards</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">B2B, Volume & Option Product Pricing</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">Categories & Product Groupings</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">Sell Downloads, Subscriptions, & Gift Cards</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">12 Advanced Product Variant Types</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">8+ Tax Options</div>
                            
                            <div class="ec_admin_upgrade_box_line_item">Unlimited Products</div>
                            
                            <div class="ec_admin_upgrade_box_line_item ec_admin_upgrade_special_line_item">10 Premium Extensions</div>
                            
                            <div class="ec_admin_upgrade_box_line_item ec_admin_upgrade_special_line_item">3 Premium Apps</div>
                            
                            <div class="ec_admin_upgrade_box_line_item ec_admin_upgrade_special_line_item">QuickBooks for Desktop</div>
                            
                            <div class="ec_admin_upgrade_box_line_item ec_admin_upgrade_special_line_item">MailChimp e-commerce API 3.0</div>
                            
                            <div class="ec_admin_upgrade_box_line_item ec_admin_upgrade_special_line_item">Full ShipStation Integration</div>
                            
                            <div class="ec_admin_upgrade_box_line_item ec_admin_upgrade_special_line_item">Groupon Importer</div>
                            
                           	<div class="ec_admin_upgrade_box_line_item ec_admin_upgrade_box_signup_row">
                            	<?php if( $license_data->is_trial ){ ?>
                            	<a href="https://www.wpeasycart.com/products/wp-easycart-trial-upgrade/?transaction_key=<?php echo $license_info['transaction_key']; ?>&license_type=premium" target="_blank">UPGRADE TRIAL</a>
                                <?php }else if( $license_data->model_number == 'ec400' ){ ?>
                                <a href="https://www.wpeasycart.com/products/wp-easycart-premium-support-extensions/?transaction_key=<?php echo $license_info['transaction_key']; ?>" target="_blank">UPGRADE LICENSE</a>
                                <?php }else{ ?>
                                <a href="https://www.wpeasycart.com/products/wp-easycart-premium-support-extensions/?transaction_key=<?php echo $license_info['transaction_key']; ?>" target="_blank">RENEW LICENSE</a>
                                <?php }?>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
			</div>
		</div>
	</div>
</div>