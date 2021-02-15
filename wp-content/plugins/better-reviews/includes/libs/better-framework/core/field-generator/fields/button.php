<?php
/***
 *  BetterFramework is BetterStudio framework for themes and plugins.
 *
 *  ______      _   _             ______                                           _
 *  | ___ \    | | | |            |  ___|                                         | |
 *  | |_/ / ___| |_| |_ ___ _ __  | |_ _ __ __ _ _ __ ___   _____      _____  _ __| | __
 *  | ___ \/ _ \ __| __/ _ \ '__| |  _| '__/ _` | '_ ` _ \ / _ \ \ /\ / / _ \| '__| |/ /
 *  | |_/ /  __/ |_| ||  __/ |    | | | | | (_| | | | | | |  __/\ V  V / (_) | |  |   <
 *  \____/ \___|\__|\__\___|_|    \_| |_|  \__,_|_| |_| |_|\___| \_/\_/ \___/|_|  |_|\_\
 *
 *  Copyright © 2017 Better Studio
 *
 *
 *  Our portfolio is here: https://betterstudio.com/
 *
 *  \--> BetterStudio, 2018 <--/
 */

$data_attrs = isset( $options['custom-attrs'] ) ? $options['custom-attrs'] : [];
?>
<div class="bf-button-field-container">
    <a class="bf-button bf-main-button <?php echo isset( $options['class-name'] ) ? esc_attr( $options['class-name'] ) : '' ?>"
		<?php foreach ( $data_attrs as $key => $name ) { ?>
			<?php printf( '%s="%s"', sanitize_key($key), esc_attr($name) ); ?>
		<?php } ?>
    ><?php echo $options['name']; // escaped before ?></a>
</div>
