<?php


class Better_Social_Counter_Telegram_API implements Better_Social_Counter_Service_Interface {

	/**
	 * @var string
	 */
	protected $service_id = 'telegram';


	/**
	 * @var Better_Social_Counter_Data
	 */
	protected $data;


	/**
	 * Get input data
	 *
	 * @param Better_Social_Counter_Data $data
	 *
	 * @return bool
	 */
	public function init( $data ) {

		$this->data = $data;

		return true;
	}


	/**
	 *
	 * @return int
	 */
	public function count() {

		$count = false;

		if ( ! Better_Social_Counter::get_option( $this->service_id . '_show_counter' ) ) {
			return $count;
		}

		if ( Better_Social_Counter::get_option( $this->service_id . '_count' ) ) {
			$count = Better_Social_Counter::get_option( $this->service_id . '_count' );
		}

		if ( ! $count ) {
			if ( $title = $this->data->get( 'name' ) ) {
				return $title;
			}
		}

		return bf_human_number_format( $count );
	}


	/**
	 * Get page link
	 *
	 *
	 * @return string
	 */
	public function link() {

		return $this->normalize_link( $this->data->id() );
	}


	public function use_cache( $format ) {

		return 'full' === $format;
	}

	/**
	 * Check link included http or https , otherwise adding "https://" to link.
	 *
	 * @param $link
	 *
	 * @return string
	 */
	public function normalize_link( $link ) {

		if ( strpos( $link, 'http' ) === false ) {

			return 'https://' . $link;
		}

		return $link;
	}
}
