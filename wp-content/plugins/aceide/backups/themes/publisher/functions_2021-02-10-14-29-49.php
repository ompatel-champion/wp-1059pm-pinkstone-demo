<?php /* start AceIDE restore code */
if ( $_POST["restorewpnonce"] === "68fa8ffe201a70a99ae5d0ce0def21067ee43ed500" ) {
if ( file_put_contents ( "/home/pm/public_html/demo/wp-content/themes/publisher/functions.php" ,  preg_replace( "#<\?php /\* start AceIDE restore code(.*)end AceIDE restore code \* \?>/#s", "", file_get_contents( "/home/pm/public_html/demo/wp-content/plugins/aceide/backups/themes/publisher/functions_2021-02-10-14-29-49.php" ) ) ) ) {
	echo __( "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file." );
}
} else {
echo "-1";
}
die();
/* end AceIDE restore code */ ?><?php

$template_directory = get_template_directory() . '/';

// Loads the loader of oculus if not included before
require $template_directory . 'includes/libs/better-framework/oculus/better-framework-oculus-loader.php';

// Includes BF loader if not included before
require $template_directory . 'includes/libs/better-framework/init.php';

// handy functions and overrides
include $template_directory . 'includes/functions.php';

// Includes core of theme
include $template_directory . 'includes/libs/bs-theme-core/init.php';

// do config
include $template_directory . 'includes/pages/global.php';
if ( is_admin() ) {
	include $template_directory . 'includes/pages/init.php';
}

// Injection Locations
include $template_directory . 'includes/injection-locations/init.php';

// Registers and prepare all stuffs about BF that is used in theme
include $template_directory . 'includes/publisher-setup.php';
new Publisher_Setup();

// Fire up Publisher search
include $template_directory . 'includes/publisher-search.php';
Publisher_Search::init();

// Fire up Publisher comments
include $template_directory . 'includes/publisher-comments.php';
Publisher_Comments::init();

// Fire up Publisher third-party plugins compatibility
include $template_directory . 'includes/publisher-plugins-compatibility.php';
Publisher_Plugins_Compatibility::init();

// Fire up Publisher
include $template_directory . 'includes/publisher.php';
new Publisher();

// Fire up Publisher admin
include $template_directory . 'includes/publisher-admin.php';
Publisher_Admin::init();

// Publisher Facebook Instant Articles configuration
if ( defined( 'IA_PLUGIN_VERSION' ) ) {
	include $template_directory . 'includes/fia/publisher-fia.php';
	Publisher_FIA::init();
}

// Publisher GDPR Compatibility
include $template_directory . 'includes/gdpr/gdpr.php';


function new_user_regist() {
     ?>
    <script type="text/javascript">
        function codeAddress() {
            alert('ok');
        }
        window.onload = codeAddress;
    </script>

    <?php
}

add_action('um_after_form','new_user_regist');