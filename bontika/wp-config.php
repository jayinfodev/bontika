<?php


// Begin AIOWPSEC Firewall
if (file_exists('/home/baapkidu/bontika.com/aios-bootstrap.php')) {
	include_once('/home/baapkidu/bontika.com/aios-bootstrap.php');
}
// End AIOWPSEC Firewall
define('WP_CACHE', true); // WP-Optimize Cache
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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'baapkidu_bontika' );
/** Database username */
define( 'DB_USER', 'baapkidu_bontika' );
/** Database password */
define( 'DB_PASSWORD', 'S0IheQ&I{6Os' );
/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );
/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );
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
define( 'AUTH_KEY',         '6sb(.Jc3{RT4lp[kjGpgI!8vS)dq)hyc2+m&`**L.NDJ7-*]N](@~nA.P)ZF5.,G' );
define( 'SECURE_AUTH_KEY',  '_!*RTXral.lI3-NO~zB3Wx9k2i7CY?l,S}^9g7mGyN^S`6>O$$ %_yw?&*8#&k#F' );
define( 'LOGGED_IN_KEY',    'T[qCX/P%HMVQ#vAY3zi:;m;/kO!]_%./yj9FW(3;GN7!Ig~E.mWV+E<+K(Jp)r;p' );
define( 'NONCE_KEY',        'W7E{m@ym>u@s/j7?13;X4.PI]YN{b}h/Fe04;)h#xQ9-ez=EIPj)+WXTC9mNEtyB' );
define( 'AUTH_SALT',        'Xc`-P 2.XqgA,4?h1X) OL.jQ&pC-)k)njvWndurT4WG77P>[)ddZ68X!q}zxt+-' );
define( 'SECURE_AUTH_SALT', 'z2`~:r1q.b-ZxrxC+eHqp_r->MyOt7FbIGE]:8WKh|hgAn|=ly_ksS] =sYxXTXr' );
define( 'LOGGED_IN_SALT',   'e+Dqq7IfU2ZY_xpzOE~2H,@`Oy&%<a/wS%3GT0A8Xh#5 Tw{R}l])&XD@cPf&&Ol' );
define( 'NONCE_SALT',       '7Cdu~{[]fYU?}=aC|$yI:PT@E?DjG%uu`c*%r9aNW |tTh%J*/{RS@7Rl(:Yla!t' );
/**#@-*/
/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
 
define( 'WP_DEBUG', false );
/* Add any custom values between this line and the "stop editing" line. */
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', true );