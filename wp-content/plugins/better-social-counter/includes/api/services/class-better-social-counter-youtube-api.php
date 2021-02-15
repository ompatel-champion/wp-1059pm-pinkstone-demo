<?php


class Better_Social_Counter_YouTube_API implements Better_Social_Counter_Service_Interface {

	/**
	 * @var string
	 */
	protected $service_id = 'youtube';


	/**
	 * @var string
	 */
	public $key = 'AIzaSyDxWftWFYn_qNYvxgysiam6Ccor8c28sFI';


	/**
	 * @var Better_Social_Counter_Data
	 */
	protected $data;


	/**
	 * @var string
	 */
	protected $type;


	/**
	 * Get input data
	 *
	 * @param Better_Social_Counter_Data $data
	 *
	 * @return bool
	 */
	public function init( $data ) {

		$this->data = $data;

		// After data set to use the $this->id() func to get clean ID
		// detect on the init
		if ( $this->data->get( 'type' ) === 'auto' ) {
			$this->data->set( 'type', strlen( $this->clean_ID() ) === 24 ? 'channel' : 'user' );
		}

		return true;
	}


	/**
	 *
	 * @param bool $force
	 *
	 * @return int
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

			switch ( $this->data->get( 'type' ) ) {

				case 'channel':
					$results = $this->_get_youtube_channel_info( $this->clean_ID() );
					break;

				case 'user':
					$results = $this->_get_youtube_account_info( $this->clean_ID() );
					break;

			}

			if ( isset( $results['items'][0]['statistics']['subscriberCount'] ) ) {
				$count = intval( $results['items'][0]['statistics']['subscriberCount'] );
			}
		}

		return bf_human_number_format( $count );
	}


	protected function _get_youtube_account_info( $username ) {

		$cache = wp_cache_get( $username, __METHOD__ );

		if ( false !== $cache ) {

			return $cache;
		}

		$url = sprintf(
			"https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=%s&key=%s",
			$username,
			$this->key
		);

		$results = Better_Social_Counter_Utilities::request( $url );

		if ( ! empty( $results['items'][0] ) ) {

			wp_cache_add( $username, $results, __METHOD__ );

			return $results;
		}

		return false;
	}


	protected function _get_youtube_channel_info( $channel_id ) {

		$cache = wp_cache_get( $channel_id, __METHOD__ );

		if ( false !== $cache ) {

			return $cache;
		}

		$url     = sprintf(
			"https://www.googleapis.com/youtube/v3/channels?part=statistics&id=%s&key=%s",
			$channel_id,
			$this->key
		);
		$results = Better_Social_Counter_Utilities::request( $url );

		if ( ! empty( $results['items'][0] ) ) {

			wp_cache_add( $channel_id, $results, __METHOD__ );

			return $results;
		}

		return false;
	}


	/**
	 * Get page link
	 *
	 * @return string
	 */
	public function link() {

		if ( $this->data->get( 'type' ) == 'channel' ) {
			return 'https://youtube.com/channel/' . $this->clean_ID();
		}

		return 'https://youtube.com/user/' . $this->clean_ID();
	}


	public function use_cache( $format ) {

		return true;
	}


	public function clean_ID() {

		$page_id = str_replace(
			array(
				'https://youtube.com/channel/',
				'https://www.youtube.com/channel/',
				'https://youtube.com/user/',
				'https://www.youtube.com/user/',
			),
			'',
			$this->data->id()
		);

		return $page_id;
	}


}