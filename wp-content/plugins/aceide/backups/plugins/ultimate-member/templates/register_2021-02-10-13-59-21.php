<?php /* start AceIDE restore code */
if ( $_POST["restorewpnonce"] === "68fa8ffe201a70a99ae5d0ce0def21067ee43ed500" ) {
if ( file_put_contents ( "/home/pm/public_html/demo/wp-content/plugins/ultimate-member/templates/register.php" ,  preg_replace( "#<\?php /\* start AceIDE restore code(.*)end AceIDE restore code \* \?>/#s", "", file_get_contents( "/home/pm/public_html/demo/wp-content/plugins/aceide/backups/plugins/ultimate-member/templates/register_2021-02-10-13-59-21.php" ) ) ) ) {
	echo __( "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file." );
}
} else {
echo "-1";
}
die();
/* end AceIDE restore code */ ?><?php if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! is_user_logged_in() ) {
	um_reset_user();
} ?>

<div class="um <?php echo esc_attr( $this->get_class( $mode ) ); ?> um-<?php echo esc_attr( $form_id ); ?>">

	<div class="um-form" data-mode="<?php echo esc_attr( $mode ) ?>">

		<form method="post" action="">

			<?php
			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_before_form
			 * @description Some actions before register form
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Register form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_before_form', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_before_form', 'my_before_form', 10, 1 );
			 * function my_before_form( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( "um_before_form", $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_before_{$mode}_fields
			 * @description Some actions before register form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Register form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_before_{$mode}_fields', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_before_{$mode}_fields', 'my_before_fields', 10, 1 );
			 * function my_before_form( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( "um_before_{$mode}_fields", $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_before_{$mode}_fields
			 * @description Some actions before register form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Register form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_before_{$mode}_fields', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_before_{$mode}_fields', 'my_before_fields', 10, 1 );
			 * function my_before_form( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( "um_main_{$mode}_fields", $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_after_form_fields
			 * @description Some actions after register form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Register form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_after_form_fields', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_after_form_fields', 'my_after_form_fields', 10, 1 );
			 * function my_after_form_fields( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( 'um_after_form_fields', $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_after_{$mode}_fields
			 * @description Some actions after register form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Register form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_after_{$mode}_fields', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_after_{$mode}_fields', 'my_after_form_fields', 10, 1 );
			 * function my_after_form_fields( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( "um_after_{$mode}_fields", $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_after_form
			 * @description Some actions after register form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Register form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_after_form', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_after_form', 'my_after_form', 10, 1 );
			 * function my_after_form( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( 'um_after_form', $args ); ?>
		
		</form>

	</div>

</div>