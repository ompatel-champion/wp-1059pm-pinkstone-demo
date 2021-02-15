<?php

// Dev mode enabled
// Use this for uncompressed custom css codes
//if ( ! defined( 'BF_DEV_MODE' ) ) {
//	define( 'BF_DEV_MODE', TRUE );
//}

add_action('um_post_registration_approved_hook', 'new_user_regist_pascual', 10, 2);
function new_user_regist_pascual($user_id, $args){
    global $wpdb;
    $user = get_user_by( 'id', $user_id );

    $sql2 = "INSERT INTO `ec_user` (email,password,first_name,last_name,user_level) VALUES('".$user->user_email."','".$user->user_pass."','".$user->user_login."','".$user->user_login."','shopper')";
    $wpdb->query($sql2);
    $last_user_id = $wpdb->insert_id;
}