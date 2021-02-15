<?php

$css_id = $this->get_css_id();

/**
 * =>Color & Style
 */
$theme_color = include PUBLISHER_THEME_PATH . 'includes/options/panel-css-theme_color.php';

$theme_color['border_color']['selector'][]    = '.better-newsticker .heading:before';

$fields['theme_color'][ $css_id ] = $theme_color;

$fields['topbar_bg_color'][ $css_id ] = array(
	array(
		'selector' => array(
			'.site-header .topbar > .content-wrap',
		),
		'prop'     => array(
			'background-color' => '%%value%% !important'
		)
	),
);

unset( $theme_color ); // clean memory

