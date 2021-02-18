<?php

// Dev mode enabled
// Use this for uncompressed custom css codes
//if ( ! defined( 'BF_DEV_MODE' ) ) {
//	define( 'BF_DEV_MODE', TRUE );
//}

add_action('wp_login', 'ec_sync_login_function', 2, 2);
add_action('user_register','ec_sync_register_function', 10, 2);

function ec_sync_register_function($user_id){
    $ec_account = new ec_accountpage;
    $ec_account->process_form_action('sync_register');
}

function ec_sync_login_function() {
    $ec_account = new ec_accountpage;
    $ec_account->process_form_action('sync_login');
}
