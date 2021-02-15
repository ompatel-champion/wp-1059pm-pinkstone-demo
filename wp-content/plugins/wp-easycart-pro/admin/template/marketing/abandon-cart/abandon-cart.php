<div class="ec_admin_list_line_item_fullwidth ec_admin_demo_data_line">
            
	<?php wp_easycart_admin( )->preloader->print_preloader( "ec_admin_abandon_cart_loader" ); ?>
    
    <div class="ec_admin_settings_label">
        <div class="dashicons-before dashicons-update"></div>
        <span><?php _e( 'Abandoned Carts', 'wp-easycart-pro' ); ?></span>
        <a href="<?php echo wp_easycart_admin( )->helpsystem->print_docs_url('marketing', 'abandoned-carts', 'settings');?>" target="_blank" class="ec_help_icon_link">
            <div class="dashicons-before ec_help_icon dashicons-info"></div> <?php _e( 'Help', 'wp-easycart-pro' ); ?>
        </a>
        <?php echo wp_easycart_admin( )->helpsystem->print_vids_url('marketing', 'abandoned-carts', 'settings');?>
    </div>
    
    <div class="ec_admin_settings_input ec_admin_settings_live_payment_section">
        <?php
			global $wpdb;
			
			$isupdate = false;
			$abandoned_carts = $wpdb->get_results( "SELECT ec_tempcart.tempcart_id, 
														   ec_tempcart.session_id,
														   ec_tempcart.quantity, 
														   ec_tempcart.abandoned_cart_email_sent, 
														   DATE_FORMAT( ec_tempcart.last_changed_date, '%b %e, %Y' ) AS tempcart_date, 
														   ec_tempcart_data.billing_first_name, 
														   ec_tempcart_data.billing_last_name, 
														   ec_tempcart_data.email, 
														   ec_product.title 
														   
													FROM ec_tempcart_data, ec_tempcart 
													LEFT JOIN ec_product ON ec_product.product_id = ec_tempcart.product_id 
													WHERE ec_tempcart.hide_from_admin = 0 AND
														  ec_tempcart_data.session_id = ec_tempcart.session_id AND 
														  ec_tempcart_data.email != '' 
													
													ORDER BY ec_tempcart.session_id, 
															 last_changed_date DESC LIMIT 100" 
			);
			$products = $wpdb->get_results( "SELECT ec_product.product_id, ec_product.title FROM ec_product" );
			?>
			
			<div>
				<?php if( $isupdate && $isupdate == "1" ) { ?>
					<div id='setting-error-settings_updated' class='updated settings-success'><p><strong><?php _e( 'Abandoned Email Sent to User.', 'wp-easycart-pro' ); ?></strong></p></div>
				<?php }else if( $isupdate && $isupdate == "2" ) { ?>
					<div id='setting-error-settings_updated' class='updated settings-success'><p><strong><?php _e( 'Automatic abandoned cart emails will be sent after 3 days of inactivity.', 'wp-easycart-pro' ); ?></strong></p></div>
				<?php }else if( $isupdate && $isupdate == "3" ) { ?>
					<div id='setting-error-settings_updated' class='updated settings-success'><p><strong><?php _e( 'Automatic abandoned cart emails are now OFF.', 'wp-easycart-pro' ); ?></strong></p></div>
				<?php } ?>
				<?php if( get_option( 'ec_option_abandoned_cart_automation' ) ){ ?>
                <a href="admin.php?page=wp-easycart-rates&subpage=abandon-cart&ec_admin_form_action=turn-off-abandoned-automation"><?php _e( 'Turn off Automatic Abandoned Cart Emails', 'wp-easycart-pro' ); ?></a>
				<?php }else{ ?>
                <a href="admin.php?page=wp-easycart-rates&subpage=abandon-cart&ec_admin_form_action=turn-on-abandoned-automation"><?php _e( 'Turn on Automatic Abandoned Cart Emails', 'wp-easycart-pro' ); ?></a>
				<?php }?>
				<table class="wp-list-table widefat fixed striped pages" style="margin-top:10px; margin-bottom: 10px;" id="ec_admin_abandoned_cart_list">
					<thead>
						<tr>
							<td class="manage-column column-primary" width="150px"><strong><?php _e( 'Product', 'wp-easycart-pro' ); ?></strong></td>
							<td class="manage-column column-primary" width="45px"><strong><?php _e( 'Qty', 'wp-easycart-pro' ); ?></strong></td>
							<td class="manage-column column-primary" width="120px"><strong><?php _e( 'Customer', 'wp-easycart-pro' ); ?></strong></td>
							<td class="manage-column column-primary" width="150px"><strong><?php _e( 'Email', 'wp-easycart-pro' ); ?></strong></td>
							<td class="manage-column column-primary" width="100px"><strong><?php _e( 'Date', 'wp-easycart-pro' ); ?></strong></td>
							<td class="manage-column column-primary" width="90px"><strong><?php _e( 'Times Sent', 'wp-easycart-pro' ); ?></strong></td>
							<td></td>
                            
						</tr>
					</thead>
					<tbody>
						<?php 
						if( count( $abandoned_carts ) > 0 ){
							$last_session = '';
							$new_cart = false;
							foreach( $abandoned_carts as $cart ){ 
								if( $last_session != $cart->session_id ){
									$last_session = $cart->session_id;
									$new_cart = true;
								}
								if( $new_cart ){ ?>            
						<tr>
							<td colspan="7" height="1px" bgcolor="#999999"></td>
						</tr>
								<?php } ?>
						<tr>
							<td><?php echo $cart->title; ?></td>
							<td align="center"><?php echo $cart->quantity; ?></td>
							<td><?php echo $cart->billing_first_name . " " . $cart->billing_last_name; ?></td>
							<td><?php echo $cart->email; ?></td>
							<td><?php echo $cart->tempcart_date; ?></td>
							<td align="center"><?php echo $cart->abandoned_cart_email_sent; ?></td>
							<td><?php if( $new_cart ){ ?><a href="admin.php?page=wp-easycart-rates&subpage=abandon-cart&ec_admin_form_action=send-abandoned-email&tempcart_id=<?php echo $cart->tempcart_id; ?>"><?php _e( 'Email Reminder', 'wp-easycart-pro' ); ?></a> | <a href="admin.php?page=wp-easycart-rates&subpage=abandon-cart&ec_admin_form_action=remove-from-list&tempcart_session_id=<?php echo $cart->session_id; ?>"><?php _e( 'Remove from List', 'wp-easycart-pro' ); ?></a><?php }?></td>
						</tr>
						<?php 
								$new_cart = false;
							}
						}else{ ?>
						<tr>
							<td  colspan="7"><?php _e( 'No Abandoned Cart(s) Found', 'wp-easycart-pro' ); ?></td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>	
    </div>
</div>
           
           
