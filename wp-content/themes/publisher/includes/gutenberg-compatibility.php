<?php

class Publisher_Gutenberg_Compatibility {

	public static function run() {

		$instance = new self();

		add_action( 'init', [ $instance, 'init' ] );
	}

	public function init() {

		if ( ! \BF_Gutenberg_Shortcode_Wrapper::is_gutenberg_active() ) {

			return;
		}

		add_filter( 'better-framework/gutenberg/sticky-fields', array( $this, 'append_shared_fields_list' ) );
		add_filter( 'better-framework/gutenberg/sticky-stds', array( $this, 'append_shared_fields_std' ) );

		self::gallery_shortcode_compatible();
	}


	/**
	 * Make WordPress core gallery block compatible with Publisher gallery.
	 */
	public function gallery_shortcode_compatible() {

		unregister_block_type('core/gallery');

		register_block_type(
			'core/gallery',
			array(
				'render_callback' => array( $this, 'gallery_shortcode_render' ),
				'attributes'      => [
					'galleryType' => array( 'type' => 'string' ),
					'title'       => array( 'type' => 'string' ),
				]
			)
		);
	}

	/**
	 * WordPress core/gallery block render callback.
	 *
	 * @param array $attributes
	 * @param string $content
	 *
	 * @return string
	 */
	public function gallery_shortcode_render( $attributes, $content ) {

		return Publisher_Theme_Gallery_Slider::instance()->extend_gallery_shortcode( $content, $attributes );
	}


	/**
	 * @param array &$fields
	 */
	public function append_shared_fields_list( &$fields ) {

		$fields[] = array(
			'type'           => 'tab',
			'name'           => __( 'Publisher Text Settings', 'publisher' ),
			'id'             => 'general',
			//
			'include_blocks' => array( 'core/paragraph' ),
		);

		$fields[] = array(
			'type'    => 'select',
			'name'    => __( 'Text Padding', 'publisher' ),
			'id'      => 'textPadding',
			//
			'options' => array(
				''               => __( 'No Padding', 'publisher' ),
				'bs-padding-0-1' => __( 'Text ⇠', 'publisher' ),
				'bs-padding-1-0' => __( '⇢ Text', 'publisher' ),
				'bs-padding-1-1' => __( '⇢ Text ⇠', 'publisher' ),
				'bs-padding-1-2' => __( '⇢ Text ⇠⇠', 'publisher' ),
				'bs-padding-2-1' => __( '⇢⇢ Text ⇠', 'publisher' ),
				'bs-padding-2-2' => __( '⇢⇢ Text ⇠⇠', 'publisher' ),
				'bs-padding-3-3' => __( '⇢⇢⇢ Text ⇠⇠⇠', 'publisher' ),
			),
			'action'  => 'add_class',
		);

		$fields[] = array(
			'type'   => 'switch',
			'name'   => __( 'Intro', 'publisher' ),
			'id'     => 'bs-intro',
			//
			'action' => 'add_class',
		);

		$fields[] = array(
			'type'           => 'tab',
			'name'           => __( 'Publisher List Settings', 'publisher' ),
			'id'             => 'general',
			//
			'include_blocks' => array( 'core/list' ),
		);
		$fields[] = array(
			'type'        => 'select',
			'name'        => __( 'Custom List', 'publisher' ),
			'id'          => 'custom-list',
			//
			'options'     => array(
				''                    => __( 'Default Style', 'publisher' ),
				'list-style-check'    => __( 'Check List', 'publisher' ),
				'list-style-star'     => __( 'Star List', 'publisher' ),
				'list-style-edit'     => __( 'Edit List', 'publisher' ),
				'list-style-file'     => __( 'File List', 'publisher' ),
				'list-style-heart'    => __( 'Heart List', 'publisher' ),
				'list-style-folder'   => __( 'Folder List', 'publisher' ),
				'list-style-asterisk' => __( 'Asterisk List', 'publisher' ),
			),
			'action'      => 'add_class',
			'fixed_class' => 'bs-shortcode-list',
		);

		/**
		 * Add support for custom gallery settings.
		 *
		 * @see views/general/shortcodes/bs-image-gallery-admin.php
		 */

		$fields[] = array(
			'type'           => 'tab',
			'name'           => __( 'Publisher Gallery Settings', 'publisher' ),
			'id'             => 'general',
			//
			'include_blocks' => array( 'core/gallery' ),
		);

		$fields[] = array(
			'type'    => 'select',
			'name'    => __( 'Gallery Type', 'publisher' ),
			'id'      => 'bgs_gallery_type',
			//
			'options' => array(
				''       => __( 'Default', 'publisher' ),
				'slider' => sprintf( __( '%s Gallery Slider', 'publisher' ), publisher_white_label_get_option( 'publisher' ) ),
			),
		);

		$fields[] = array(
			'type' => 'text',
			'name' => __( 'Gallery Title', 'publisher' ),
			'id'   => 'bgs_gallery_title',
		);

		$fields[] = array(
			'type'    => 'select',
			'name'    => __( 'Image Size', 'publisher' ),
			'id'      => 'bgs_gallery_image_size',
			//
			'options' => array(
				''      => sprintf( __( '%s - Large', 'publisher' ), publisher_white_label_get_option( 'publisher' ) ),
				'small' => sprintf( __( '%s - Small', 'publisher' ), publisher_white_label_get_option( 'publisher' ) ),
				'full'  => __( 'Full size image - No crop', 'publisher' ),
			),
		);
	}


	public function append_shared_fields_std( &$std ) {

		$std['logo_img_sample']        = '';
		$std['bgs_gallery_type']       = '';
		$std['bgs_gallery_title']      = '';
		$std['bgs_gallery_image_size'] = '';
	}
}