<?php


class BF_Gutenberg_BF_Button extends BF_Gutenberg_Field_Transformer {


	/**
	 * @param int $iteration
	 *
	 * @return mixed
	 */
	public function transform_field( $iteration ) {

		return array(
			'classesName' => isset( $this->field['class-name'] ) ? $this->field['class-name'] : '',
			'name'        => isset( $this->field['name'] ) ? $this->field['name'] : '',
			'customAttrs' => $this->attrs(),
		);
	}

	public function attrs() {

		if ( empty( $this->field['custom-attrs'] ) ) {

			return [];
		}

		$attrs = [];

		foreach ( $this->field['custom-attrs'] as $key => $value ) {

			$attrs[] = [
				'key'   => sanitize_key( $key ),
				'value' => esc_attr( $value ),
			];
		}

		return $attrs;
	}

	/**
	 * The component name.
	 *
	 * @return string
	 */
	public function component() {

		return 'BF_Button';
	}


	/**
	 * Return value data type.
	 *
	 * @return string
	 */
	public static function data_type() {

		return '';
	}
}
