<?php

/**
 * Shortcode Base Class.
 *
 * @since 7.8.0
 */
class Publisher_Shortcode extends BF_Shortcode {

	public function __construct( $id = '', $options = array() ) {

		if ( ! isset( $options['version'] ) ) {

			$options['version'] = PUBLISHER_THEME_VERSION;
		}

		parent::__construct( $id, $options );
	}
}
