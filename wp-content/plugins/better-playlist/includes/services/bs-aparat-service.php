<?php

/**
 * BetterStudio Aparat playlist service
 */
class BS_Aparat_PlayList_Service implements BS_PlayList_Service_Interface {

	/**
	 * Fetch Videos Info From Google API
	 *
	 * @param array $videos
	 *
	 * @return array|bool array on success or false on failure.
	 */
	public function get_videos_info( $videos ) {

		$results = array();

		foreach ( $videos as $video ) {

			$url  = 'https://www.aparat.com/etc/api/video/videohash/' . $video;
			$data = BS_PlayList::fetch_json_data( $url );

			$idx = $video;

			$results[ $idx ] = array(
				'title'      => $data->video->title,
				'thumbnails' => $data->video->small_poster,
				'duration'   => $data->video->duration,
			);
		}

		return $results ? $results : false;
	}


	/**
	 * Get Aparat PlayList Snippet Info
	 *
	 * @param string $play_list_id
	 *
	 * @return bool|stdClass
	 */
	public function get_playlist_info( $play_list_id ) {

		$url  = 'https://www.aparat.com/playlist/' . $play_list_id;
		$html = file_get_html( $url );

		return (object) array(
			'username' => $html->find( '.playlist-creator .details a', 0 )->plaintext,
			'title'    => $html->find( '.playlist-title .title .text', 0 )->plaintext,
		);
	}


	/**
	 * Filters attribute
	 *
	 * @param $attrs
	 *
	 * @return mixed
	 */
	public function filter_attrs( $attrs ) {

		if ( ! empty( $attrs['videos'] ) ) {

			$videos = &$attrs['videos'];
			$videos = explode( "\n", $videos );
			$videos = array_filter( $videos );
			$videos = array_map( array( $this, 'get_video_ID' ), $videos );
		}

		if ( ! empty( $attrs['playlist_url'] ) ) {

			$attrs['playlist_url'] = $this->bs_get_playlist_ID( $attrs['playlist_url'] );
		}

		return $attrs;
	}


	/**
	 * get video ID from URL
	 *
	 * @param $aparat_url
	 *
	 * @return string
	 */
	protected function get_video_ID( $aparat_url ) {

		if ( preg_match( '/aparat.com\/v\/(\w+)/mis', $aparat_url, $matched ) ) {

			$q = end( $matched );
			if ( ! empty( $q ) ) {

				return $q;
			}
		}
	}


	/**
	 * Get playlist ID from URL
	 *
	 * @param $aparat_url
	 *
	 * @return string
	 */
	protected function bs_get_playlist_ID( $aparat_url ) {

		if ( preg_match( '/playlist=(\d+)|playlist\/(\d+)/mis', $aparat_url, $matched ) ) {

			$q = end( $matched );
			if ( ! empty( $q ) ) {

				return $q;
			}
		}
	}


	/**
	 * @param     $play_list_id
	 *
	 * @param int $limit
	 *
	 * @return array|bool
	 */
	public function get_playlist_videos_info( $play_list_id, $limit = 50 ) {


		$url = 'https://www.aparat.com/playlist/' . $play_list_id;

		$html = file_get_html( $url );
		$html = $html->find( '.playlist-list .playlist-item' );

		$fetched_items   = 0;
		$playlist_videos = array();

		foreach ( $html as $item ) {

			if ( $fetched_items < $limit && preg_match( '/data-uid="(.*?)"/msi', $item->outertext, $matches ) ) {

				$playlist_videos [] = $matches[1];
				$fetched_items ++;
			}
			continue;
		}


		return $this->get_videos_info( $playlist_videos );
	}


	/**
	 * Returns frame URL
	 *
	 * @param $attrs
	 *
	 * @return string
	 */
	public function default_frame_url( $attrs ) {
		return 'https://www.aparat.com/video/video/embed/videohash/{video-id}/vt/frame';
	}


	/**
	 * Returns video frame url
	 *
	 * @param $attrs
	 *
	 * @return string
	 */
	public function change_video_frame_url( $attrs ) {
		return 'https://www.aparat.com/video/video/embed/videohash/{video-id}/vt/frame';
	}

} // BS_Aparat_PlayList_Service
