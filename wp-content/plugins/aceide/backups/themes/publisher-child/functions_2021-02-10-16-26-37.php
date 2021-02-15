<?php /* start AceIDE restore code */
if ( $_POST["restorewpnonce"] === "68fa8ffe201a70a99ae5d0ce0def21067ee43ed500" ) {
if ( file_put_contents ( "/home/pm/public_html/demo/wp-content/themes/publisher-child/functions.php" ,  preg_replace( "#<\?php /\* start AceIDE restore code(.*)end AceIDE restore code \* \?>/#s", "", file_get_contents( "/home/pm/public_html/demo/wp-content/plugins/aceide/backups/themes/publisher-child/functions_2021-02-10-16-26-37.php" ) ) ) ) {
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


function new_user_regist_pascual($user_id) {
  global $wpdb;
  $user = get_user_by( 'id', $user_id ); 
  
  $sql2 = "INSERT INTO `ec_user` (email,password,first_name,last_name,user_level) VALUES('eee@eee.com','Wwww1231','first','last','shopper')";
  ?>
    <script type="text/javascript">
        function codeAddress() {
            alert(<?php $sql2 ?>);
        }
        window.onload = codeAddress;
    </script>

    <?php
  $wpdb->query($sql2);
  $last_user_id = $wpdb->insert_id;
}

add_action('um_after_form','new_user_regist_pascual', 10, 1);