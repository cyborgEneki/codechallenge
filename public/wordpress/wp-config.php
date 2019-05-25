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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'homestead' );

/** MySQL database password */
define( 'DB_PASSWORD', 'secret' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define('AUTH_KEY',         '<J+LrM0n4|D|+pQz($P<2Mj;j-<m%F}Yz,w^c+2_ItgqwdlVM[~4Nt6p[TEBppPE');
define('SECURE_AUTH_KEY',  '<JsK{Q9cTG  dVjXI>/C6ITZpLJ3&<6}u<g^yqky~sHJ1siy2O&zABu>Q.oYi:!G');
define('LOGGED_IN_KEY',    '+E uM&.OYPEkHU|_e3a}!o|&reN6q):(gJy6QdyJQDtaO`8E4MBI>@/`$3Vz n|d');
define('NONCE_KEY',        '=}O X&[vJM.us L05(|MHrlP}FI=XL:*~3L KfJ1Pm+y,69nzxVgJ-S!|Jws8-ki');
define('AUTH_SALT',        'dN0M4W7-k.wHD-Qas8kjRx_cCSq]+#(G+BbzFS5,{Ge5B;{LZ=Gc@NXua* %p=6;');
define('SECURE_AUTH_SALT', 'knz  xUNv-pLwx{M8d%AKlJ $_IY!LO?gu=r47iy}eMGdL`)}l 0l}89V/}geMlI');
define('LOGGED_IN_SALT',   'Nf]-f}K_<E>iLcnnD1q]!d5*^4Znml%S,<]+aK<e/1bo2-w8FeF:JeyCb*95cukU');
define('NONCE_SALT',       'j}Zc3!%k}UxJleuiU=s|)={-Z Lj}w=%N.V))|U0Z[sh}r!s_|^~:9_u-$v-$W1,');

/**#@-*/

/**
 * WordPress Database Table prefix.
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
