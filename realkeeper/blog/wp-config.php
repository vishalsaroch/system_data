<?php
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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'realkeep_wp595' );

/** MySQL database username */
define( 'DB_USER', 'realkeep_wp595' );

/** MySQL database password */
define( 'DB_PASSWORD', 'n1)E]VL[6pS4)s(L' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'bgyynp7j3qwnnprnr8gzjqhp3entjx8o3vfy467wlj9rlqbs27ncaldxh1tiv7cg' );
define( 'SECURE_AUTH_KEY',  'x7ezd9tsrwffhgx3rsylmprngt4jfyoi9y8xj80pxj1pfbf10uxdgo1qajtcas3n' );
define( 'LOGGED_IN_KEY',    'm0r2feopqmukoydzyuyblqhdxaylarcufdp93j4s8z4qd4oz4a5jfoyid2ateahp' );
define( 'NONCE_KEY',        'ecb80ikmdhwpbybhyzfnksu5cncp1yice7krza64kwrvmsgjqfcywlbuj56t1yif' );
define( 'AUTH_SALT',        '6htg0ifgwjxaoisseqhegrxeqmv2oweqjyfq06uemcod6tutl70v02mtj0vmuevj' );
define( 'SECURE_AUTH_SALT', 'he3cnhaqoienv8fmsboo30alvfnmlqziiw0barkkwuxkm5ars1mi84swr2efjnku' );
define( 'LOGGED_IN_SALT',   'ltk7knwnn0ldlcosgses8dvspoygrhqrnsaoh5uyogwbhz5eckfwn7plpbyaldce' );
define( 'NONCE_SALT',       'ejbf9njphru08unusn0vahprxivdwllagbzdyf4adjl7mr7tabssghrsu98l9lyu' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpq9_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
