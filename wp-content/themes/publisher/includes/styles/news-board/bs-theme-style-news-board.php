<?php


/**
 * Publisher -> News Board
 */
class Publisher_Theme_Style_News_Board extends Publisher_Theme_Style {

	/**
	 * Style initializer
	 */
	public function __construct() {

		$this->style_id = 'news-board';

		add_filter( 'better-framework/panel/' . publisher_get_theme_panel_id() . '/std', array(
			$this,
			'panel_std'
		), 20 );

		add_filter( 'better-framework/panel/' . publisher_get_theme_panel_id() . '/css', array(
			$this,
			'panel_css'
		), 20 );

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

		include PUBLISHER_THEME_PATH . 'includes/styles/news-board/panel-std.php';

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

		include PUBLISHER_THEME_PATH . 'includes/styles/news-board/panel-css.php';

		return $fields;
	}


	/**
	 * Adds custom functions of style
	 */
	function include_functions() {
	}


	/**
	 * Enqueue current style css file
	 */
	function register_assets() {

		bf_enqueue_style(
			'publisher-theme-news-board',
			bf_append_suffix( Publisher_Theme_Styles_Manager::get_uri( 'news-board/style' ), '.css' ),
			array( 'publisher' ),
			bf_append_suffix( Publisher_Theme_Styles_Manager::get_path( 'news-board/style' ), '.css' ),
			Better_Framework()->theme()->get( 'Version' )  . mt_rand(1000000,100000000000)
		);
	}


	/**
	 * TinyMCE Style
	 */
	public function register_tinymce_assets() {

		bf_enqueue_tinymce_style( 'registered', 'publisher-theme-news-board' );
	}

} // Publisher_Theme_Style_News_Board
