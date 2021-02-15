<div class="ec_admin_settings_input ec_admin_settings_live_payment_section ec_admin_settings_<?php if( get_option('ec_option_payment_process_method') == "securenet" ){ ?>show<?php }else{?>hide<?php }?>" id="securenet">
    <span><?php _e( 'Setup WorldPay', 'wp-easycart-pro' ); ?></span>
    <div>
        <?php _e( 'SecureNet ID', 'wp-easycart-pro' ); ?>
        <input name="ec_option_securenet_id"  id="ec_option_securenet_id" type="text" value="<?php echo get_option('ec_option_securenet_id'); ?>" />
    </div>
    <div>
        <?php _e( 'Secure Key', 'wp-easycart-pro' ); ?>
        <input name="ec_option_securenet_secure_key"  id="ec_option_securenet_secure_key" type="password" value="<?php echo get_option('ec_option_securenet_secure_key'); ?>" />
    </div>
    <div>
        <?php _e( 'Sandbox Mode', 'wp-easycart-pro' ); ?>
        <select name="ec_option_securenet_use_sandbox" id="ec_option_securenet_use_sandbox">
            <option value="0" <?php if (get_option('ec_option_securenet_use_sandbox') == 0) echo ' selected'; ?>><?php _e( 'No', 'wp-easycart-pro' ); ?></option>
            <option value="1" <?php if (get_option('ec_option_securenet_use_sandbox') == 1) echo ' selected'; ?>><?php _e( 'Yes', 'wp-easycart-pro' ); ?></option>
        </select>
    </div>
    <div class="ec_admin_settings_input">
        <input type="submit" class="ec_admin_settings_simple_button" onclick="return ec_admin_save_securenet_options( );" value="<?php _e( 'Save Options', 'wp-easycart-pro' ); ?>" />
    </div>
</div>