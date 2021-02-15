<?php

/**
 * Enable bs products to update automatically in background.
 *
 * @since 3.11.0
 */
class BF_Product_Auto_Update {

	/**
	 * Initialize the auto updater.
	 *
	 * @since 3.11.0
	 */
	public function init() {

		add_filter( 'all_plugins', [ $this, 'plugin_auto_update' ] );
		add_filter( 'wp_prepare_themes_for_js', [ $this, 'theme_auto_update_for_js' ] );
	}

	/**
	 * Enable BS Plugins to use auto-update feature.
	 *
	 * @hooked all_plugins
	 *
	 * @param array $plugins
	 *
	 * @since  3.11.0
	 * @return array
	 */
	public function plugin_auto_update( $plugins ) {

		foreach ( $this->premium_bundled_plugins() as $plugin_file ) {

			if ( isset( $plugins[ $plugin_file ] ) ) {

				$plugins[ $plugin_file ]['update-supported'] = true;
			}
		}

		return $plugins;
	}

	/**
	 * @param array $prepared_themes Array of theme data.
	 *
	 * @since 3.11.1
	 * @return array
	 */
	public function theme_auto_update_for_js( $prepared_themes ) {

		if ( ! function_exists( 'bf_register_product_get_info' ) ) {

			return $prepared_themes;
		}

		$info = bf_register_product_get_info();

		if ( empty( $info['product_type'] ) || 'theme' !== $info['product_type'] ) {

			return $prepared_themes;
		}

		$theme_folders = array_unique( [ $info['product_folder'], get_template() ] );

		foreach ( $theme_folders as $theme_folder ) {

			if ( isset( $prepared_themes[ $theme_folder ]['autoupdate']['supported'] ) ) {

				$prepared_themes[ $theme_folder ]['autoupdate']['supported'] = true;
			}
		}

		return $prepared_themes;
	}

	/**
	 * Get list of premium bundled plugins.
	 *
	 * @since 3.11.0
	 * @return array
	 */
	public function premium_bundled_plugins() {

		if ( ! function_exists( 'bf_get_plugins_config' ) ) {

			return [];
		}

		$premium_plugins = [];

		foreach ( bf_get_plugins_config() as $plugin ) {

			if ( empty( $plugin['is_premium'] ) || empty( $plugin['have_access'] ) ) {

				continue;
			}

			$premium_plugins[] = BF_Product_Updater::plugin_slug_to_file_path( $plugin['slug'] );
		}

		return array_filter( $premium_plugins );
	}
}
