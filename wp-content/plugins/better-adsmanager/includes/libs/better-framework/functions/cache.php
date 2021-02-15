<?php

if ( ! function_exists( 'bf_cache_set' ) ) {

	/**
	 * Saves the data to the cache.
	 *
	 * @param int|string $key    The cache key to use for retrieval later.
	 * @param mixed      $data   The contents to store in the cache.
	 * @param string     $group  Optional. Where to group the cache contents. Enables the same key
	 *                           to be used across groups. Default empty.
	 * @param int        $expire Optional. When to expire the cache contents, in seconds.
	 *
	 * @since 3.11.1
	 * @return bool True on success, false on failure.
	 */
	function bf_cache_set( $key, $data, $group = '', $expire = 0 ) {

		if ( ! wp_using_ext_object_cache() ) {

			return _bf_cache_set( $key, $data, $group, $expire );
		}

		return wp_cache_set( $key, $data, $group, $expire );
	}
}

if ( ! function_exists( 'bf_cache_get' ) ) {

	/**
	 * Retrieves the cache contents from the cache by key and group.
	 *
	 * @param int|string $key                   The key under which the cache contents are stored.
	 * @param string     $group                 Optional. Where the cache contents are grouped. Default empty.
	 * @param bool       $force                 Optional. Whether to force an update of the local cache
	 *                                          from the persistent cache. Default false.
	 * @param bool       $found                 Optional. Whether the key was found in the cache (passed by reference).
	 *
	 * @since 3.11.1
	 * @return mixed|false The cache contents on success, false on failure to retrieve contents.
	 */
	function bf_cache_get( $key, $group = '', $force = false, &$found = null ) {

		if ( ! wp_using_ext_object_cache() ) {

			return _bf_cache_get( $key, $group, $force, $found );
		}

		return wp_cache_get( $key, $group, $force, $found );
	}
}

if ( ! function_exists( 'bf_cache_delete' ) ) {

	/**
	 * Removes the item from the cache.
	 *
	 * Removes an item from memcached with identified by $key after $time seconds.
	 * The $time parameter allows an object to be queued for deletion without
	 * immediately deleting. Between the time that it is queued and the time it's deleted,
	 * add, replace, and get will fail, but set will succeed.
	 *
	 * @param string $key   The key under which to store the value.
	 * @param string $group The group value appended to the $key.
	 *
	 * @since 3.11.1
	 * @return bool True on success, false on failure.
	 */
	function bf_cache_delete( $key, $group = '' ) {

		if ( ! wp_using_ext_object_cache() ) {

			return _bf_cache_delete( $key, $group );
		}

		return wp_cache_delete( $key, $group );
	}
}

if ( ! function_exists( '_bf_cache_set' ) ) {

	/**
	 * Saves the data into a transient.
	 *
	 * @param int|string $key    The cache key to use for retrieval later.
	 * @param mixed      $data   The contents to store in the cache.
	 * @param string     $group  Optional. Where to group the cache contents. Enables the same key
	 *                           to be used across groups. Default empty.
	 * @param int        $expire Optional. When to expire the cache contents, in seconds.
	 *
	 * @since 3.11.1
	 * @return bool True on success, false on failure.
	 */
	function _bf_cache_set( $key, $data, $group = '', $expire = 0 ) {

		$transient_name = rtrim( sprintf( '%s-%s', $key, $group ), '-' );

		return set_transient( $transient_name, $data, $expire );
	}
}

if ( ! function_exists( '_bf_cache_get' ) ) {

	/**
	 * Retrieves the cache contents from the transient.
	 *
	 * @param int|string $key                   The key under which the cache contents are stored.
	 * @param string     $group                 Optional. Where the cache contents are grouped. Default empty.
	 * @param bool       $force                 Optional. DC
	 * @param bool       $found                 Optional. Whether the key was found in the cache (passed by reference).
	 *                                          disambiguate a return of false, a storable value. Default null.
	 *
	 * @since 3.11.1
	 * @return mixed|false The cache contents on success, false on failure to retrieve contents.
	 */
	function _bf_cache_get( $key, $group = '', $force = false, &$found = null ) {

		$transient_name = rtrim( sprintf( '%s-%s', $key, $group ), '-' );
		$result         = get_transient( $transient_name );
		$found          = false !== $result;

		return $result;
	}
}

if ( ! function_exists( '_bf_cache_delete' ) ) {

	/**
	 * Removes the transient.
	 *
	 * Removes an item from memcached with identified by $key after $time seconds.
	 * The $time parameter allows an object to be queued for deletion without
	 * immediately deleting. Between the time that it is queued and the time it's deleted,
	 * add, replace, and get will fail, but set will succeed.
	 *
	 * @param string $key   The key under which to store the value.
	 * @param string $group The group value appended to the $key.
	 *
	 * @since 3.11.1
	 * @return bool True on success, false on failure.
	 */
	function _bf_cache_delete( $key, $group = '' ) {

		$transient_name = rtrim( sprintf( '%s-%s', $key, $group ), '-' );

		return delete_transient( $transient_name );
	}
}
