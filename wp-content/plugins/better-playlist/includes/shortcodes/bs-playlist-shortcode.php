<?php


/**
 * Class BS_PlayList_Shortcode
 */
abstract class BS_PlayList_Shortcode extends BF_Shortcode {

	/**
	 * BroadCast Service Instance
	 *
	 * @return BS_PlayList_Service_Interface instance
	 */
	abstract protected function get_service();


	/**
	 * Default attributes that can be changed in class childs
	 *
	 * @var array
	 */
	protected $default_attrs = array(
		'type'                => 'playlist',
		'videos_limit'        => 50,
		'playlist_title'      => false,
		'show_playlist_title' => true,
		'videos'              => '',
		'style'               => 'style-1',
		'by'                  => '',
		//
		'title'               => '',
		'show_title'          => 0,
		'icon'                => '',
		'heading_style'       => 'default',
		'heading_color'       => '',
		//
		'bs-show-desktop'     => 1,
		'bs-show-tablet'      => 1,
		'bs-show-phone'       => 1,
		'css'                 => '',
		'custom-css-class'    => '',
		'custom-id'           => '',
	);


	/**
	 * Initialize shortcode
	 *
	 * @param string $id
	 * @param array $options
	 */
	function __construct( $id, $options = array() ) {

		// default translated title
		if ( empty( $this->default_attrs['title'] ) ) {
			$this->default_attrs['title'] = Better_Playlist::_get( 'widget_playlist' );
		}

		$_options = array(
			'defaults'              => $this->default_attrs,
			'have_widget'           => true,
			'have_vc_add_on'        => true,
			'have_gutenberg_add_on' => true,

		);

		$_options = wp_parse_args( $_options, $options );

		parent::__construct( $id, $_options );
	}


	/**
	 * Filter custom css codes for shortcode widget!
	 *
	 * @param $fields
	 *
	 * @return array
	 */
	function register_custom_css( $fields ) {

		return $fields;
	}


	/**
	 * Handle displaying of shortcode
	 *
	 * @param array $attrs
	 * @param string $content
	 *
	 * @return string
	 */
	function display( array $attrs, $content = '' ) {

		$this->sanitize_attrs( $attrs );

		//set service object
		$attrs['playlist_service'] = $this->get_service();

		if ( ! isset( $attrs['class'] ) ) {
			$attrs['class'] = '';
		}

		$attrs['class'] .= $this->extra_classes( $attrs );

		// custom css classes from generators
		if ( ! empty( $attrs['css-class'] ) ) {
			$attrs['class'] .= " {$attrs['css-class']}";
		}

		// custom css classes shortcode settings
		if ( ! empty( $attrs['custom-css-class'] ) ) {
			$attrs['class'] .= " {$attrs['custom-css-class']}";
		}

		ob_start();

		bsp_set_prop( 'shortcode-bs-playlist-atts', $attrs );

		include $this->get_template( $attrs );

		bsp_clear_prop();

		return ob_get_clean();

	}


	/**
	 * Prepares custom classes for plylist container
	 *
	 * @param $attrs
	 *
	 * @return string
	 */
	protected function extra_classes( &$attrs ) {

		$classes = array();

		$classes[] = $this->id;

		$classes[] = 'bsp-' . $attrs['style'];

		if ( ! empty( $attrs['playlist_service'] ) && is_object( $attrs['playlist_service'] ) ) {
			$classes[] = str_replace( '_', '-', strtolower( get_class( ( $attrs['playlist_service'] ) ) ) );
		}

		$classes = array_map( 'sanitize_html_class', $classes );

		return implode( ' ', $classes );
	}


	/**
	 * Sanitize attributes
	 *
	 * @param $attrs
	 */
	protected function sanitize_attrs( &$attrs ) {

	}


	/**
	 * Registers Visual Composer Add-on
	 */
	function register_vc_add_on() {

		vc_map(
			array(
				"name"        => $this->name,
				"base"        => $this->id,
				"description" => $this->description,
				"weight"      => 1,

				"wrapper_height" => 'full',

				"category" => __( 'Publisher', 'better-studio' ),

				"params" => $this->page_builder_fields( 'VC' ),
			)
		);
	}


	/**
	 * @return array
	 */
	public function get_fields() {

		$labels = array(
			'type'           => __( 'Playlist Type', 'better-studio' ),
			'type=playlist'  => __( 'Youtube Playlist', 'better-studio' ),
			'type=custom'    => __( 'Custom Video Links', 'better-studio' ),
			'playlist_title' => __( 'Playlist Title', 'better-studio' ),
			'playlist_url'   => __( 'Playlist URL', 'better-studio' ),
			'videos_limit'   => __( 'Maximum Videos Count', 'better-studio' ),
			'videos'         => __( 'Playlist Videos List', 'better-studio' ),
			'by'             => __( 'By', 'better-studio' ),
		);

		$labels = wp_parse_args( $this->get_labels(), $labels );

		// Fields of this shortcode
		$fields = array(
			array(
				'type' => 'tab',
				'name' => __( 'Videos', 'better-studio' ),
				'id'   => 'videos_tab',
			),
			array(
				"type"           => 'select',
				"name"           => $labels['type'],
				"id"             => 'type',
				'value'          => $this->defaults['type'],
				"options"        => array(
					'playlist' => $labels['type=playlist'],
					'custom'   => $labels['type=custom'],
				),
				'always_show'    => true,
				//
				"vc_admin_label" => false,
			),
			array(
				"type"           => 'text',
				"name"           => $labels['playlist_url'],
				"id"             => 'playlist_url',
				'show_on'        => array( 'type=playlist' ),
				//
				"vc_admin_label" => true,
			),
			array(
				"type"           => 'textarea_raw_html',
				"name"           => $labels['videos'],
				"id"             => 'videos',
				'desc'           => __( 'Enter videos links each in one line.', 'better-studio' ),
				'show_on'        => array( 'type=custom' ),
				"vc_admin_label" => false,
			),
			array(
				"type"           => 'text',
				"name"           => $labels['videos_limit'],
				"id"             => 'videos_limit',
				'show_on'        => array( 'type=playlist' ),
				//
				"vc_admin_label" => false,
			),
			array(
				"type"           => 'text',
				"name"           => $labels['by'],
				"id"             => 'by',
				'desc'           => __( 'Enter your name.', 'better-studio' ),
				'show_on'        => array( 'type=custom' ),
				//
				"vc_admin_label" => false,
			),
			array(
				"type"           => 'text',
				"name"           => $labels['playlist_title'],
				"id"             => 'playlist_title',
				//
				"vc_admin_label" => true,
			),
			array(
				"type"           => 'switchery',
				"name"           => __( 'Show Playlist Title?', 'better-studio' ),
				"id"             => 'show_playlist_title',
				//
				"vc_admin_label" => false,
			),
		);


		/**
		 * Retrieve heading fields from outside (our themes are defining them)
		 */
		{
			$heading_fields = apply_filters( 'better-framework/shortcodes/heading-fields', array(), $this->id );

			if ( $heading_fields ) {
				$fields = array_merge( $fields, $heading_fields );
			}
		}


		/**
		 * Retrieve design fields from outside (our themes are defining them)
		 */
		{
			$design_fields = apply_filters( 'better-framework/shortcodes/design-fields', array(), $this->id );

			if ( $design_fields ) {
				$fields = array_merge( $fields, $design_fields );
			}
		}

		return $fields;
	}


	/**
	 * method for override labels array indexes
	 *
	 * @return array
	 */
	function get_labels() {

		return array();
	}


	/**
	 * Finds appropriate template file and return path
	 * This make option to change template in themes
	 *
	 * @param $attrs
	 *
	 * @return string
	 */
	function get_template( $attrs ) {

		// Use theme specified template for shortcode
		if ( file_exists( get_template_directory() . '/better-playlist/bs-playlist-' . $attrs['style'] . '.php' ) ) {
			return get_template_directory() . '/better-playlist/bs-playlist-' . $attrs['style'] . '.php';
		}

		return Better_Playlist::dir_path() . 'views/bs-playlist-' . $attrs['style'] . '.php';

	} // get_template


	/**
	 * Registers Page Builder Add-on
	 */
	public function page_builder_settings() {


		return array(
			'name'           => $this->name,
			"base"           => $this->id,
			"description"    => $this->description,
			"weight"         => 10,
			"wrapper_height" => 'full',
			"category"       => __( 'Better Studio', 'better-studio' ),
			'icon_url'       => Better_Playlist::dir_url( sprintf( 'img/%s.png', $this->id ) ),
		);
	} // page_builder_settings
} // BS_PlayList_Shortcode
