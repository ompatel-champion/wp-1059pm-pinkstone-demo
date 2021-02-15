<?php

/**
 * Base shortcode class for Aparat playlist
 */
class BS_Aparat_Playlist_Shortcode extends BS_PlayList_Shortcode {

	/**
	 * Decode Videos List Encoded by Visual Composer
	 *
	 * @param array $attrs
	 */
	protected function sanitize_attrs( &$attrs ) {
		if ( ! Better_Framework::widget_manager()->get_current_sidebar() ) {
			if ( ! empty( $attrs['videos'] ) ) {
				$attrs['videos'] = htmlentities( rawurldecode( base64_decode( $attrs['videos'] ) ), ENT_COMPAT, 'UTF-8' );
			}
		}
	}


	/**
	 * Injects service provider to shortcode
	 *
	 * @return BS_Aparat_PlayList_Service
	 */
	protected function get_service() {
		return new BS_Aparat_PlayList_Service();
	}

	/**
	 * Customize labels for Aparat
	 * @return array
	 */
	public function get_labels() {

		return array(
			'type=playlist'       => __( 'Aparat Playlist', 'better-studio' ),
			'type=custom'       => __( 'Aparat Custom Links (Video Link)', 'better-studio' )
		);
	}

} // BS_Aparat_Playlist_1_Shortcode


/**
 * bs-aparat-playlist-1 shortcode
 */
class BS_Aparat_Playlist_1_Shortcode extends BS_Aparat_Playlist_Shortcode {

	public function __construct( $id, $_options ) {
		$this->name                  = __( 'Aparat Playlist 1', 'better-studio' );
		$this->default_attrs['style'] = 'style-1';
		parent::__construct( $id, $_options );
	}

} // BS_Aparat_Playlist_1_Shortcode


/**
 * BS Aparat playlist 1 widget
 */
class BS_Aparat_PlayList_1_Widget extends BS_PlayList_Widget {

	public function __construct() {

		$this->widget_name        = __( 'BetterStudio - Aparat Playlist 1', 'better-studio' );
		$this->widget_description = __( 'Aparat Playlist 1', 'better-studio' );
		$this->widget_ID          = 'bs-aparat-playlist-1';

		parent::__construct();
	}

} // BS_Aparat_PlayList_1_Widget class

/**
 * bs-aparat-playlist-1 shortcode
 */
class BS_Aparat_Playlist_2_Shortcode extends BS_Aparat_Playlist_Shortcode {


	public function __construct( $id, $_options ) {
		$this->name                  = __( 'Aparat Playlist 2', 'better-studio' );
		$this->default_attrs['style'] = 'style-2';
		parent::__construct( $id, $_options );
	}

} // BS_Aparat_Playlist_2_Shortcode


/**
 * BS Aparat playlist 2 widget
 */
class BS_Aparat_PlayList_2_Widget extends BS_PlayList_Widget {

	public function __construct() {

		$this->widget_name        = __( 'BetterStudio - Aparat Playlist 2', 'better-studio' );
		$this->widget_description = __( 'Aparat Playlist 2', 'better-studio' );
		$this->widget_ID          = 'bs-aparat-playlist-2';

		parent::__construct();
	}

} // BS_Aparat_PlayList_2_Widget class
