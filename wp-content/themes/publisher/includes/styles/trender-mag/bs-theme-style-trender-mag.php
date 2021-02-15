<?php


/**
 * Publisher -> Trender Mag
 */
class Publisher_Theme_Style_Trender_Mag extends Publisher_Theme_Style {

	/**
	 * Style initializer
	 */
	public function __construct() {

		$this->style_id = 'trender-mag';

		add_filter( 'better-framework/panel/' . publisher_get_theme_panel_id() . '/std', array(
			$this,
			'panel_std'
		), 20 );

		add_filter( 'better-framework/panel/' . publisher_get_theme_panel_id() . '/css', array(
			$this,
			'panel_css'
		), 20 );

		add_filter( 'better-framework/taxonomy/metabox/better-category-options/css', array(
			$this,
			'customize_category_fields'
		), 20 );

		if ( Publisher_Theme_Styles_Manager::$current_style === $this->style_id ) {
			add_filter( 'publisher-theme-core/page-templates/config', array(
				$this,
				'page_templates_config'
			) );
		}

		parent::__construct();
	}


	/**
	 * Demo panel STD's
	 *
	 * @param $fields
	 *
	 * @return mixed
	 */
	function panel_std( $fields ) {

		include PUBLISHER_THEME_PATH . 'includes/styles/trender-mag/panel-std.php';

		return $fields;
	}


	/**
	 * Demo panel STD's
	 *
	 * @param $fields
	 *
	 * @return mixed
	 */
	function panel_css( $fields ) {

		include PUBLISHER_THEME_PATH . 'includes/styles/trender-mag/panel-css.php';

		// Header Menu Current Color
		//		$fields['header_menu_text_h_color']['css'][0]['selector'][] = '.site-header .search-container .search-handler';
		$fields['header_menu_text_h_color']['css'][0]['selector'][] = '.site-header.site-header.header-style-6 .main-menu.menu > li.current-menu-item > a:after';
		$fields['header_menu_text_h_color']['css'][0]['selector'][] = '.site-header.site-header.header-style-6 .main-menu.menu > li:hover > a:after';

		$fields['header_menu_text_color']['css']['color']['selector'][] = '.site-header.site-header.header-style-6 .main-menu.menu > li > a:after';

		return $fields;
	}


	/**
	 * Adds custom functions of style
	 */
	function include_functions() {
	}


	/**
	 * Modify each style or demo category fields
	 *
	 * @param $fields array
	 *
	 * @return array
	 */
	function customize_category_fields( $fields ) {

		$term_css = include PUBLISHER_THEME_PATH . 'includes/options/category-css-term_color.php';

		/**
		 * Categories
		 */
		//		$term_css['bg_color']['selector'][] = 'body.single-prim-cat-%%id%% .archive-title .term-badges span.term-badge a:hover';
		//		$term_css['selection']     = array(
		//			'selector' =>
		//				array(
		//					'body.single-prim-cat-%%id%% ::selection'
		//				),
		//			'prop'     =>
		//				array(
		//					'background' => '%%value%% !important',
		//				),
		//		);

		$fields['term_color'][ $this->get_css_id() ] = $term_css;
		// Clear memory
		unset( $term_css );

		return $fields;
	}


	/**
	 * Enqueue current style css file
	 */
	function register_assets() {

		bf_enqueue_style(
			'publisher-theme-trender-mag',
			bf_append_suffix( Publisher_Theme_Styles_Manager::get_uri( 'trender-mag/style' ), '.css' ),
			array( 'publisher' ),
			bf_append_suffix( Publisher_Theme_Styles_Manager::get_path( 'trender-mag/style' ), '.css' ),
			Better_Framework()->theme()->get( 'Version' ) . mt_rand(1000,100000)
		);
	}


	/**
	 * TinyMCE Style
	 */
	public function register_tinymce_assets() {

		bf_enqueue_tinymce_style( 'registered', 'publisher-theme-trender-mag' );
	}


	/**
	 * Injects Page templates for current style
	 *
	 * @param $page_templates
	 *
	 * @return mixed
	 */
	function page_templates_config( $page_templates ) {

		publisher_set_global( 'style-page-template', $this->style_id );

		include PUBLISHER_THEME_PATH . 'includes/styles/' . $this->style_id . '/page-templates.php';

		publisher_unset_global( 'style-page-template' );

		return $page_templates;
	}

} // Publisher_Theme_Style_Trender_Mag