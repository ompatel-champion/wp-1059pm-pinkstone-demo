<div class="ec_admin_settings_input ec_admin_settings_live_payment_section ec_admin_settings_<?php if( get_option('ec_option_payment_process_method') == "authorize" ){ ?>show<?php }else{?>hide<?php }?>" id="authorize">
    <span><?php _e( 'Setup Authorize.net', 'wp-easycart-pro' ); ?></span>
    <div>
        <?php _e( 'Login ID', 'wp-easycart-pro' ); ?>
        <input name="ec_option_authorize_login_id" id="ec_option_authorize_login_id" type="text" value="<?php echo get_option('ec_option_authorize_login_id'); ?>" />
    </div>
    <div>
        <?php _e( 'Transaction Key', 'wp-easycart-pro' ); ?>
        <input name="ec_option_authorize_trans_key" id="ec_option_authorize_trans_key" type="text" value="<?php echo get_option('ec_option_authorize_trans_key'); ?>" />
    </div>
    <div>
        <?php _e( 'Currency Code', 'wp-easycart-pro' ); ?>
        <select name="ec_option_authorize_currency_code" id="ec_option_authorize_currency_code">
            <option value="USD" <?php if ( get_option( 'ec_option_authorize_currency_code') == "USD" ){ echo " selected=\"selected\""; } ?>><?php _e( 'USD', 'wp-easycart-pro' ); ?></option>
            <option value="CAD" <?php if ( get_option( 'ec_option_authorize_currency_code') == "CAD" ){ echo " selected=\"selected\""; } ?>><?php _e( 'CAD', 'wp-easycart-pro' ); ?></option>
            <option value="EUR" <?php if ( get_option( 'ec_option_authorize_currency_code') == "EUR" ){ echo " selected=\"selected\""; } ?>><?php _e( 'EUR', 'wp-easycart-pro' ); ?></option>
            <option value="GBP" <?php if ( get_option( 'ec_option_authorize_currency_code') == "GBP" ){ echo " selected=\"selected\""; } ?>><?php _e( 'GBP', 'wp-easycart-pro' ); ?></option>
        </select>
    </div>
    <div>
        <?php _e( 'Test Mode', 'wp-easycart-pro' ); ?>
        <select name="ec_option_authorize_test_mode" id="ec_option_authorize_test_mode">
            <option value="1" <?php if (get_option('ec_option_authorize_test_mode') == 1) echo ' selected'; ?>><?php _e( 'Yes, Put into Test Mode', 'wp-easycart-pro' ); ?></option>
            <option value="0" <?php if (get_option('ec_option_authorize_test_mode') == 0) echo ' selected'; ?>><?php _e( 'No, Process Live Transactions', 'wp-easycart-pro' ); ?></option>
        </select>
    </div>
    <div>
        <?php _e( 'Developer Account', 'wp-easycart-pro' ); ?>
        <select name="ec_option_authorize_developer_account" id="ec_option_authorize_developer_account">
            <option value="1" <?php if (get_option('ec_option_authorize_developer_account') == 1) echo ' selected'; ?>><?php _e( 'Yes, This is a Developer Account', 'wp-easycart-pro' ); ?></option>
            <option value="0" <?php if (get_option('ec_option_authorize_developer_account') == 0) echo ' selected'; ?>><?php _e( 'No, This is a Live Account', 'wp-easycart-pro' ); ?></option>
        </select>
    </div>
    <div class="ec_admin_settings_input">
        <input type="submit" class="ec_admin_settings_simple_button" onclick="return ec_admin_save_authorize_options( );" value="<?php _e( 'Save Options', 'wp-easycart-pro' ); ?>" />
    </div>
</div>