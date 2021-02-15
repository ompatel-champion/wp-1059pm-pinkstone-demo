<?php

if ( ! function_exists( 'bf_scripts' ) ) {

	/**
	 * @global $bf_scripts BF_Scripts object
	 *
	 * @since 2.9.0
	 * @return BF_Scripts
	 */
	function bf_scripts() {

		global $bf_scripts;

		if ( $bf_scripts ) {
			return $bf_scripts;
		}

		$bf_scripts = new BF_Scripts();
		$bf_scripts->init();

		return $bf_scripts;
	}
}

if ( ! function_exists( 'bf_style' ) ) {

	/**
	 * @global $bf_styles BF_Styles object
	 *
	 * @since 2.9.0
	 * @return BF_Styles
	 */
	function bf_styles() {

		global $bf_styles;

		if ( $bf_styles ) {
			return $bf_styles;
		}

		$bf_styles = new BF_Styles();
		$bf_styles->init();

		return $bf_styles;
	}
}

if ( ! function_exists( 'bf_booster_is_active' ) ) {
	/**
	 * Returns state of Booster sections
	 *
	 * @param string $section
	 *
	 * @return bool|mixed
	 */
	function bf_booster_is_active( $section = '' ) {

		return BF_Booster::is_active( $section );
	}
}
