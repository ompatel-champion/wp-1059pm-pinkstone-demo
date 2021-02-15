<?php /* start AceIDE restore code */
if ( $_POST["restorewpnonce"] === "68fa8ffe201a70a99ae5d0ce0def21067ee43ed500" ) {
if ( file_put_contents ( "/home/pm/public_html/demo/wp-content/themes/publisher-child/functions.php" ,  preg_replace( "#<\?php /\* start AceIDE restore code(.*)end AceIDE restore code \* \?>/#s", "", file_get_contents( "/home/pm/public_html/demo/wp-content/plugins/aceide/backups/themes/publisher-child/functions_2021-02-10-14-53-09.php" ) ) ) ) {
	echo __( "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file." );
}
} else {
echo "-1";
}
die();
/* end AceIDE restore code */ ?><?php

// Dev mode enabled
// Use this for uncompressed custom css codes
//if ( ! defined( 'BF_DEV_MODE' ) ) {
//	define( 'BF_DEV_MODE', TRUE );
//}


add_action( 'password_reset', function( $user, $pass ) 
{  
    global $wpdb;   
    $usersql = "SELECT `user_id`, `email` FROM `ec_user` WHERE `email`='".$user->data->user_email."'";
	$userinfo = $wpdb->get_row($usersql);
	$user_id = $userinfo->user_id;

    $hash_password = wp_hash_password($pass);
    
     $mmbr_up = "UPDATE ec_user SET password='".$hash_password."' WHERE user_id=".$user_id;
     $wpdb->query($mmbr_up);
   
}, 10, 2 );

add_action('user_register','my_register_function', 10, 2);

function my_register_function($user_id){
  global $wpdb;
  $user = get_user_by( 'id', $user_id ); 
  
     $sql2 = "INSERT INTO `ec_user` (email,password,first_name,last_name,user_level) VALUES('".$user->user_email."','".$user->user_pass."','".$user->user_login."','".$user->user_login."','shopper')";
            $wpdb->query($sql2);
            $last_user_id = $wpdb->insert_id;
}

add_filter( 'wp_easycart_sync_wordpress_users', 'wordpress_users_sync' );
function wordpress_users_sync( $should_sync ){
	if(isset($_POST)){
		if($_POST['ec_account_register_password_retype'] !="" && $_POST['ec_account_register_email'] !=""){
			global $wpdb;
			$hash_password = wp_hash_password($_POST['ec_account_register_password_retype']);
			$username = $_POST['ec_account_register_email'];
			$firstname = $_POST['ec_account_register_first_name'];
			$lastname = $_POST['ec_account_register_last_name'];
			$wp_capabilities = 'a:2:{s:10:"subscriber";b:1;s:15:"bbp_participant";b:1;}';

			$sql2 = "INSERT INTO ".$wpdb->prefix."users (user_login,user_pass,user_nicename,user_email,user_registered,user_status,display_name) VALUES('".$username."','".$hash_password."','".$username."','".$username."','".date('Y-m-d h:i:s')."',0,'".$username."')";
						$wpdb->query($sql2);
						$last_user_id = $wpdb->insert_id;
			$user_meta = "INSERT INTO ".$wpdb->prefix."usermeta (`user_id`, `meta_key`, `meta_value`) VALUES ('".$last_user_id."', 'nickname', '".$username."'), ('".$last_user_id."', 'first_name', '".$firstname."'), ('".$last_user_id."', 'last_name', '".$lastname."'), ('".$last_user_id."', '".$wpdb->prefix."capabilities', '".$wp_capabilities."')";
				$wpdb->query($user_meta);

				/*$GLOBALS['ec_cart_data']->cart_data->user_id = $last_user_id;
				$GLOBALS['ec_cart_data']->cart_data->email = $username;
				$GLOBALS['ec_cart_data']->cart_data->username = $username;
				$GLOBALS['ec_cart_data']->cart_data->first_name = $firstname;
				$GLOBALS['ec_cart_data']->cart_data->last_name = $lastname;
				$GLOBALS['ec_cart_data']->save_session_to_db( );*/

				$user = get_user_by('email', $username );
				wp_clear_auth_cookie();
			    wp_set_current_user ( $last_user_id );
			    wp_set_auth_cookie  ( $last_user_id );
			    $redirect_to = user_admin_url();
			    wp_safe_redirect( $redirect_to );
				return true;
		}						
	}
	
	if(isset($_REQUEST)){
		if($_REQUEST['ec_page'] == 'logout'){
			wp_clear_auth_cookie();
		}
	}
	//print_r($_POST); exit();
	//print_r($should_sync); exit();

}

function ecuserlogin( $user_login, $user ) {    
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
add_action('wp_login', 'ecuserlogin', 10, 2);

add_action( 'wpeasycart_login_success', 'users_login_function' );
function users_login_function( $email ){
	$user = get_user_by('email', $email );
	wp_clear_auth_cookie();
    wp_set_current_user ( $user->ID );
    wp_set_auth_cookie  ( $user->ID );
    $redirect_to = user_admin_url();
    wp_safe_redirect( $redirect_to );
}

function logout_redirect765(){
	$current_user = wp_get_current_user(); 
	$GLOBALS['ec_cart_data']->cart_data->user_id = '';
	$GLOBALS['ec_cart_data']->cart_data->email = '';
	$GLOBALS['ec_cart_data']->cart_data->username = '';
	$GLOBALS['ec_cart_data']->cart_data->first_name = '';
	$GLOBALS['ec_cart_data']->cart_data->last_name = '';
	$GLOBALS['ec_cart_data']->save_session_to_db( );
	wp_clear_auth_cookie();  
}
add_action('wp_logout','logout_redirect765');

function new_user_regist_pascual() {
     ?>
    <script type="text/javascript">
        function codeAddress() {
            <!-- alert('ok'); -->
        }
        window.onload = codeAddress;
    </script>

    <?php
}

add_action('um_after_form','new_user_regist_pascual');