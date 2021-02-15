<?php


abstract class BF_Gutenberg_Field_Transformer {

	public $wrap_section_container = true;

	/**
	 * @var array
	 */
	protected $field;


	/**
	 *
	 * @param int $iteration
	 *
	 * @return array
	 */
	abstract public function transform_field( $iteration );


	/**
	 * The component name.
	 *
	 * @return string
	 */
	abstract public function component();


	/**
	 * Return value data type.
	 *
	 * @return string
	 */
	public static function data_type() {

		return 'string';
	}

	/**
	 * @param array $field
	 */
	public function init( $field ) {

		$this->field = $field;
	}


	/**
	 * @param string $index
	 *
	 * @return mixed
	 */
	public function field( $index = '' ) {

		if ( $index ) {

			return isset( $this->field[ $index ] ) ? $this->field[ $index ] : null;
		}

		return $this->field;
	}


	/**
	 * @link https://wordpress.org/gutenberg/handbook/block-api/attributes/
	 *
	 * @param array $parent parent tab. optional
	 *
	 * @return array
	 */
	public function the_attribute( $parent = [] ) {

		if ( $type = static::data_type() ) {

			$items      = false; // it will fix Undefined index: items in wp-includes/rest-api.php:093
			$for_blocks = isset( $parent['include_blocks'] ) ? $parent['include_blocks'] : [];

			return compact( 'type', 'items', 'for_blocks' );
		}

		return array();
	}


	/**
	 * @return array
	 */
	public function children_items_list() {

		return array();
	}


	public function children_item( $item ) {

		return $item;
	}
}
