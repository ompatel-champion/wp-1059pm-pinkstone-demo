<?php


class Better_Social_Counter_Aparat_API implements Better_Social_Counter_Service_Interface {

	/**
	 * @var string $service_id
	 */
	protected $service_id = 'aparat';

	/**
	 * @var \Better_Social_Counter_Data $data
	 */
	protected $data;

	/**
	 * @param $data
	 *
	 * @return bool
	 */
	public function init( $data ) {

		$this->data = $data;

		return true;
	}

	/**
	 * @param bool $force
	 *
	 * @return bool|string
	 */
	public function count( $force = false ) {

		$count = false;

		if ( ! $force && ! Better_Social_Counter::get_option( $this->service_id . '_show_counter' ) ) {
			return $count;
		}

		if ( ! $force && Better_Social_Counter::get_option( $this->service_id . '_count' ) ) {
			$count = Better_Social_Counter::get_option( $this->service_id . '_count' );
		}

		if ( ! $count ) {

			$page_id = $this->id();

			$results = $this->_get_aparat_account_info( $page_id );

			$count = intval($results);
		}

		return bf_human_number_format( $count );
	}

	protected function _get_aparat_account_info( $username ) {

		$cache = wp_cache_get( $username, __METHOD__ );

		if ( false !== $cache ) {

			return $cache;
		}

		$url = sprintf(
			"https://www.aparat.com/etc/api/profile/username/%s",
			$username
		);

		$results = Better_Social_Counter_Utilities::request( $url );

		if ( ! empty( $results['profile']['follower_cnt']) ) {

			wp_cache_add( $username, $results, __METHOD__ );

			return $results['profile']['follower_cnt'];
		}

		return false;
	}

	/**
	 * Get page link
	 *
	 * @return string
	 */
	public function link() {

		return 'https://www.aparat.com/' . $this->id();
	}


	public function use_cache( $format ) {

		return true;
	}


	public function id() {

		$page_id = str_replace(
			array(
				'https://www.aparat.com/',
			),
			'',
			$this->data->id()
		);

		return $page_id;
	}
}