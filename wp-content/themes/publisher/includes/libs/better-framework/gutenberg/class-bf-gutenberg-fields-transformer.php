<?php


class BF_Gutenberg_Fields_Transformer {

	public static function instance() {

		$instance = new self();
		$instance->init();

		return $instance;
	}


	/**
	 *
	 */
	public function init() {

		if ( is_admin() ) {
			add_action( 'better-framework/shortcodes/gutenberg-fields', array( $this, 'ajax_prepare_fields' ) );
		}
	}


	public function ajax_prepare_fields( $blocks ) {

		wp_send_json_success( $this->prepare_blocks_fields( $blocks ) );
	}


	/**
	 * @param array $blocks
	 *
	 * @return array
	 */
	public function prepare_blocks_fields( $blocks ) {

		$results = array();

		if ( empty( $blocks ) ) {

			return $results;
		}

		if ( ! class_exists( 'BF_Fields_To_Gutenberg' ) ) {
			require BF_PATH . 'gutenberg/class-bf-fields-to-gutenberg.php';
		}

		foreach ( $blocks as $block ) {

			if ( ! $shortcode = BF_Shortcodes_Manager::factory( $block, array(), true ) ) {
				continue;
			}

			if ( ! $block_fields = $shortcode->get_fields() ) {
				continue;
			}
			$converter = new BF_Fields_To_Gutenberg(
				$block_fields,
				$shortcode->defaults
			);

			$results[ $block ] = $converter->transform();
		}

		return $results;
	}


	/**
	 * @param array $blocks
	 *
	 * @return array
	 */
	public function prepare_blocks_attributes( $blocks ) {

		$results = [];

		foreach ( $blocks as $block ) {

			if ( $fields = $this->block_attributes( $block ) ) {

				$results[ $block ] = $fields;
			}
		}

		return $results;
	}

	/**
	 * Get the block gutenberg attributes.
	 *
	 * @param string $block_id The block id
	 *
	 * @since 3.11.1
	 * @return array
	 */
	public function block_attributes( $block_id ) {

		if ( ! $fields = $this->block_fields( $block_id ) ) {

			return [];
		}

		if ( ! class_exists( 'BF_Fields_To_Gutenberg' ) ) {
			require BF_PATH . 'gutenberg/class-bf-fields-to-gutenberg.php';
		}

		$converter = new BF_Fields_To_Gutenberg(
			$fields
		);

		return $converter->list_attributes();

	}

	/**
	 * Get the block fields array
	 *
	 * @param string $block_id The block id
	 *
	 * @since 3.11.1
	 * @return array
	 */
	public function block_fields( $block_id ) {

		if ( ! $shortcode = BF_Shortcodes_Manager::factory( $block_id, array(), true ) ) {

			return [];
		}

		return $shortcode->get_fields();
	}
}
