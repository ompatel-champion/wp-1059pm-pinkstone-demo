<div class="ec_admin_settings_input ec_admin_settings_third_party_section ec_admin_settings_<?php if( get_option('ec_option_payment_third_party') == "payfast_thirdparty" ){ ?>show<?php }else{?>hide<?php }?>" id="payfast_thirdparty">
	<span><?php _e( 'Setup PayFast', 'wp-easycart-pro' ); ?></span>
    <div>
        <?php _e( 'Merchant ID', 'wp-easycart-pro' ); ?>
        <input name="ec_option_payfast_merchant_id"  id="ec_option_payfast_merchant_id" type="text" value="<?php echo get_option('ec_option_payfast_merchant_id'); ?>" />
    </div>
    <div>
        <?php _e( 'Merchant Key', 'wp-easycart-pro' ); ?>
        <input name="ec_option_payfast_merchant_key"  id="ec_option_payfast_merchant_key" type="text" value="<?php echo get_option('ec_option_payfast_merchant_key'); ?>" />
    </div>
    <div>
        <?php _e( 'Passphrase (optional)', 'wp-easycart-pro' ); ?>
        <input name="ec_option_payfast_passphrase"  id="ec_option_payfast_passphrase" type="text" value="<?php echo get_option('ec_option_payfast_passphrase'); ?>" />
    </div>
    <div>
        <?php _e( 'Sandbox Mode', 'wp-easycart-pro' ); ?>
        <select name="ec_option_payfast_sandbox" id="ec_option_payfast_sandbox">
            <option value="1" <?php if (get_option('ec_option_payfast_sandbox') == 1) echo ' selected'; ?>><?php _e( 'Yes (Sandbox Mode)', 'wp-easycart-pro' ); ?></option>
            <option value="0" <?php if (get_option('ec_option_payfast_sandbox') == 0) echo ' selected'; ?>><?php _e( 'No (Live Mode)', 'wp-easycart-pro' ); ?></option>
        </select>
    </div>
    <div class="ec_admin_settings_input">
        <input type="submit" class="ec_admin_settings_simple_button" onclick="return ec_admin_save_payfast_options( );" value="<?php _e( 'Save Options', 'wp-easycart-pro' ); ?>" />
    </div>
</div>