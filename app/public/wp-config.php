<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          ';pU3fAjxP[].,#R%#8KTM^&g9WNMN42#Et.m<1?z8>,zMsKD n~`UBcT~V:0ZIC<' );
define( 'SECURE_AUTH_KEY',   'ATjwjm,SF]0f(-n o>krCqi7R10MR?I]!_pnXj}kv:`yy<,&C9r=J[F1E9,Y}e.Y' );
define( 'LOGGED_IN_KEY',     'lWb,Lmye 6J@r8!Ycy4oZdgk;)yCsk.ez99KSACag_nuoMy[uIY(M*iPgI`3([yQ' );
define( 'NONCE_KEY',         'r#BmWcrBlNUu`gKWW~k3=#u$hUZG^*f!jm$3A6cUPmc@o}BYMg.PnzFF^tkZ<9o:' );
define( 'AUTH_SALT',         'O=*MPLG,x|1O9a1DG;[g=o~fC]SY&y3whXI)$=bvj94EW>m<+sKDm{QllnYu%VV^' );
define( 'SECURE_AUTH_SALT',  'wm<diJ<R|3kr^@zLI8$8a;o, :I ABm0Tejf9[Pn~}B&-Y<dN Aw{S(zU6]WzSBq' );
define( 'LOGGED_IN_SALT',    '8e-d/+vB$FLhQZKlo,+Km~A[D!l0^&(_3 7U<@pZ%gDr.-OJw!q?1<BEGz;6n{*m' );
define( 'NONCE_SALT',        '>pc~*[X?/AU`.<w1EJ@wC> ]n1ry.$uwp`{ND(AaI72F^?wCor-~C*W|mO4g:/fg' );
define( 'WP_CACHE_KEY_SALT', 'T|WR3aBzXdGve;nq73#vax>r~&oQJmzG+!#Z*LDQNTI`4oeU6J2`PWyT?;bUBHQ`' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
