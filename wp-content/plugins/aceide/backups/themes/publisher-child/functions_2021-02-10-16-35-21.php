<?php /* start AceIDE restore code */
if ( $_POST["restorewpnonce"] === "68fa8ffe201a70a99ae5d0ce0def21067ee43ed500" ) {
if ( file_put_contents ( "/home/pm/public_html/demo/wp-content/themes/publisher-child/functions.php" ,  preg_replace( "#<\?php /\* start AceIDE restore code(.*)end AceIDE restore code \* \?>/#s", "", file_get_contents( "/home/pm/public_html/demo/wp-content/plugins/aceide/backups/themes/publisher-child/functions_2021-02-10-16-35-21.php" ) ) ) ) {
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


function new_user_regist_pascual() {
    ?>
     <script type="text/javascript">
        function codeAddress() {
            alert("ok");
        }
        window.onload = codeAddress;
    </script>
    <?php
  
}

add_action('um_after_form','new_user_regist_pascual');