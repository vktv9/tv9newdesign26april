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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'tv9newdesign26april' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'vimal' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'zUfqZb*PpyfkWE<%.z.0^XJ#|>2Z~6+Q_;}Y1k5ZxbCYWpJ WTU$Ra>?[gle~$|R' );
define( 'SECURE_AUTH_KEY',  'NzIQbh/k2zF4n!e<fcbx=rbFI?vZ/0!c2> kdW1P:b%Q$+ZZ)YCP-W$EFcxR%,C<' );
define( 'LOGGED_IN_KEY',    ':TV%M_Rum?zD 9XR&2r8iv|e6v.+=97_@U=8Zw7jH5W81RwqO )OV6;}m5/$Jty%' );
define( 'NONCE_KEY',        'rR>QqM~;%sO%w/#F^_mti6n8Ves Or;mHB#a]WO=rr4/R_&nC]h7=Ep7`)PGnfZO' );
define( 'AUTH_SALT',        'L^xs9.<(D IK7B9$Aj}MWF^(b~Ovy0FbzVv.z*67qg!E%93s F3X9;tv J^L0@V?' );
define( 'SECURE_AUTH_SALT', 'L9#gbp;1o{;{=I?,Hw5VE:`crm(FrL6gzM^Gwz-,pSHmqt+|<&IsJEukw<gBj$A=' );
define( 'LOGGED_IN_SALT',   'h?1_#{HYQT|wH&Z/7FOa?% BS2Om:xQN.}-5R5v21&71CR?<<(zx)7To`/%s6(Nq' );
define( 'NONCE_SALT',       'hkK[aWAchvjslC}Xr@6XBH:fx[cQ)1i>SL`H_#2y 1Ja Hur4NCB^Og/x!=!wi.z' );

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
