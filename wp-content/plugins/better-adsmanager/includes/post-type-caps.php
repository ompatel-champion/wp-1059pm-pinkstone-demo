<?php


/**
 * Class Better_Ads_Post_Types_Caps
 *
 * @since  1.20.0
 */
class Better_Ads_Post_Types_Caps {

	/**
	 * @var string[]
	 */
	protected $capability_types = [ 'campaign', 'banner' ];

	/**
	 * @var string[]
	 */
	protected $capabilities = [
		'edit_%s',
		'read_%s',
		'delete_%s',
		'edit_%ss',
		'edit_others_%ss',
		'delete_%ss',
		'publish_%ss',
		'read_private_%ss',
		'edit_%ss',
	];

	/**
	 * @since  1.20.0
	 */
	public static function init() {

		$instance = new self;

		add_action( 'init', array( $instance, 'setup_roles' ), 8 );

		add_action( 'better-framework/panel/save', [ $instance, 'save_panel' ] );
	}


	public function save_panel( $panel ) {

		if ( empty( $panel['id'] ) || $panel['id'] !== 'better_ads_manager' ) {

			return;
		}

		$this->drop_roles();
	}


	protected function drop_roles() {

		$all_roles = array_keys( better_ads_user_roles() );

		foreach ( array_diff( $all_roles, $this->roles() ) as $role ) {

			if ( 'administrator' === $role ) { // Don't remove access for Administrators because they always have access to all options
				continue;
			}

			$this->drop_all_caps( $role );
		}
	}


	/**
	 * @hooked init
	 *
	 * @since  1.20.0
	 */
	public function setup_roles() {

		foreach ( $this->capability_types as $type ) {

			$this->setup_post_type_caps( $type );
		}
	}

	/**
	 * @param string $capability_type
	 *
	 * @since  1.20.0
	 * @return bool true on success or false otherwise.99
	 */
	protected function setup_post_type_caps( $capability_type ) {

		$roles   = $this->roles();
		$roles[] = 'administrator';  // Administrators always have access to all options

		foreach ( array_filter( $roles ) as $role ) {

			$this->setup_role_caps( $role, $capability_type );
		}


		return true;
	}


	/**
	 * @param string $role
	 * @param string $capability_type
	 *
	 * @since  1.20.0
	 * @return bool true on success or false otherwise.99
	 */
	protected function setup_role_caps( $role, $capability_type ) {

		if ( ! $role_object = get_role( $role ) ) {

			return false;
		}

		foreach ( $this->capabilities as $capability ) {

			$role_object->add_cap(
				sprintf( $capability, $capability_type )
			);
		}

		return true;
	}

	/**
	 * @param string $role
	 *
	 * @return bool
	 */
	protected function drop_all_caps( $role ) {

		if ( ! $role_object = get_role( $role ) ) {

			return false;
		}

		foreach ( $this->capability_types as $capability_type ) {

			foreach ( $this->capabilities as $capability ) {

				$role_object->remove_cap(
					sprintf( $capability, $capability_type )
				);
			}
		}

		return true;
	}


	/**
	 * Get saved roles list.
	 *
	 * @return array
	 */
	public function roles() {

		$options = get_option( 'better_ads_manager', [] );

		return isset( $options['roles'] ) ? $options['roles'] : [];
	}
}

