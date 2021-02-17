<?php

// Dev mode enabled
// Use this for uncompressed custom css codes
//if ( ! defined( 'BF_DEV_MODE' ) ) {
//	define( 'BF_DEV_MODE', TRUE );
//}


add_action('user_register','ec_sync_register_function', 10, 2);

function ec_sync_register_function($user_id){
    $ec_account = new ec_accountpage;
    $ec_account->process_form_action('sync_register');
}

function ec_sync_login_function( $user_login, $user ) {
    if($user->user_id ==''){
        //print_r($user->data);
        $GLOBALS['ec_cart_data']->cart_data->user_id = $user->data->ID;
        $GLOBALS['ec_cart_data']->cart_data->email = $user->data->user_email;
        $GLOBALS['ec_cart_data']->cart_data->username = $user->data->user_login;
        $GLOBALS['ec_cart_data']->cart_data->first_name = $user->data->user_nicename;
        $GLOBALS['ec_cart_data']->cart_data->last_name = $user->data->display_name;
        $GLOBALS['ec_cart_data']->save_session_to_db( );
    }else{
        $GLOBALS['ec_cart_data']->cart_data->user_id = $user->user_id;
        $GLOBALS['ec_cart_data']->cart_data->email = $email;
        $GLOBALS['ec_cart_data']->cart_data->username = $user->first_name . " " . $user->last_name;
        $GLOBALS['ec_cart_data']->cart_data->first_name = $user->first_name;
        $GLOBALS['ec_cart_data']->cart_data->last_name = $user->last_name;
        $GLOBALS['ec_cart_data']->save_session_to_db( );
    }
    // print_r($user_login);exit();
}
add_action('wp_login', 'ec_sync_login_function', 10, 2);


///=============================================//////