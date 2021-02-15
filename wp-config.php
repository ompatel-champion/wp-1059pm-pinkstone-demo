<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pm_demo' );

/** MySQL database username */
define( 'DB_USER', 'pm_demo' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Aa$17582219' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'xE0aKobdE&^+?q?w5[p>Lgr?Ib;dYY.h|-eJ9]I#HiGXa+ETKs9_=U% md~11 Vl');
define('SECURE_AUTH_KEY',  'r6!fMA<J#|]7M<Bhcz$QkutEINMO+ObGx<d9Q!8&P+m8!F#eyINnZm}ShrMhdE#D');
define('LOGGED_IN_KEY',    'xK(Im0Ilnk0{txJ#JFYwcP-)yLQrPM<!D3.y2JnB!IEg;n@5$*$jQpERg#FL$l)3');
define('NONCE_KEY',        '^0%ArV7l,8uLnX1j!A+^6xw(637l]7H3Mns0ta+l1~2O>PohhB0tF^c4?of+K.n.');
define('AUTH_SALT',        'EY*&0d7hZA_q(+4l.eZ-W[89QvE!Tbj|OD+p0r9g;6NQDzmH0/}[wX3@qKEBSMx!');
define('SECURE_AUTH_SALT', ':Fe%v/(/Y*vaw(>y^F}RQ?}}EdZ|9p(_Tv-IBk*xNl({++]/CM|~XO)@]j$3!Wa{');
define('LOGGED_IN_SALT',   'P:R?ESjT+f{p|(Su A0KzUz--EPvN@,7P{!S|N-5p7U#Q54^B#f(&!-qc)S4kWK|');
define('NONCE_SALT',       'iX/JDPYQ];(hls!ThFg6#sWP;|Q~S@e s|Qi^L12.L&6Bv-.?S6?~.*AK-6(|9v}');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'demo1_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
