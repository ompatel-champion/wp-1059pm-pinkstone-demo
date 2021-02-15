<div id="ec_account_subscriptions">
    <div class="ec_account_mobile">
        <div class="ec_cart_header ec_top"><?php echo $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_title' )?></div>
        
        <?php do_action( 'wpeasycart_account_links' ); ?>

		<div class="ec_cart_input_row">
			<?php $this->display_billing_information_link( $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_billing_information' ) ); ?>
		</div>

        <?php if( get_option( 'ec_option_use_shipping' ) ){ ?>
        <div class="ec_cart_input_row">
			<?php $this->display_shipping_information_link( $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_shipping_information' ) ); ?>
		</div>
		<?php }?>

        <div class="ec_cart_input_row">
			<?php $this->display_personal_information_link( $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_basic_inforamtion' ) ); ?>
		</div>

       <div class="ec_cart_input_row">
          <?php $this->display_password_link( $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_password' ) ); ?>
        </div>

		<?php if( $this->using_subscriptions( ) ){ ?>
        <div class="ec_cart_input_row">
          <?php $this->display_subscriptions_link( $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_subscriptions' )); ?>
        </div>
        <?php }?>

        <div class="ec_cart_input_row">
          <?php $this->display_logout_link( $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_sign_out' )); ?>
        </div>
    </div>
    
    <div class="ec_account_left">
        <div class="ec_cart_header ec_top"><?php echo $GLOBALS['language']->get_text( 'account_subscriptions', 'account_subscriptions_title' )?></div>
        <div class="ec_account_subscriptions_holder ec_account_active_subscriptions_list">
            <div class="ec_account_subscriptions_row" id="ec_subscriptions_list">
                <?php $this->subscriptions->display_subscription_list( ); //prints out a list of subscriptions of type ec_account_subscription_line.php ?>
            </div>
        </div>
        <div class="ec_cart_header"><?php echo $GLOBALS['language']->get_text( 'account_subscriptions', 'account_canceled_subscriptions_title' )?></div>
        <div class="ec_account_subscriptions_row" id="ec_subscriptions_list">
            <?php $this->subscriptions->display_canceled_subscription_list( ); //prints out a list of subscriptions of type ec_account_subscription_line.php ?>
        </div>
    </div>
    
    <div class="ec_account_right">
        <div class="ec_cart_header ec_top"><?php echo $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_title' )?></div>
        <?php do_action( 'wpeasycart_account_links' ); ?>
        <div class="ec_cart_input_row">
            <?php $this->display_billing_information_link( $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_billing_information' ) ); ?>
        </div>
        <?php if( get_option( 'ec_option_use_shipping' ) ){ ?>
        <div class="ec_cart_input_row">
            <?php $this->display_shipping_information_link( $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_shipping_information' ) ); ?>
        </div>
        <?php }?>
        <div class="ec_cart_input_row">
            <?php $this->display_personal_information_link( $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_basic_inforamtion' ) ); ?>
        </div>
        <div class="ec_cart_input_row">
          <?php $this->display_password_link( $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_password' ) ); ?>
        </div>
        <?php if( $this->using_subscriptions( ) ){ ?>
        <div class="ec_cart_input_row">
          <?php $this->display_subscriptions_link( $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_subscriptions' )); ?>
        </div>
        <?php }?>
        <div class="ec_cart_input_row">
          <?php $this->display_logout_link( $GLOBALS['language']->get_text( 'account_navigation', 'account_navigation_sign_out' )); ?>
        </div>
    </div>
</div>

<div style="clear:both;"></div>
<div id="ec_current_media_size"></div>