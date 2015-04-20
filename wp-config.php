<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] );
define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] );

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'theorlos_wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ',%5JY^tUM1l-;XP%;Jkq=F*[g^@0^])9b%|4>u:F00i*-H*omJHjbiv70:;P@N;.');
define('SECURE_AUTH_KEY',  'Xn*zsA2E2=xpu-5z#vzoEST]%(%!+t@7@-U&Eyiw%)Y.A$QkbR8!T{eRvj&|H:+3');
define('LOGGED_IN_KEY',    '>+U^WGwa4>LT<Az.,_<E|WAIJ(4u3n.JE{A=Pp}-fy&`5ol|_SFW`R%X9-fDS NN');
define('NONCE_KEY',        'LCsOpY:PWS:|mC[}|WaXd}J}J4A%-6ZlWICbKG|r-|mkN6a>Roxt0@:Z]7/$k;xq');
define('AUTH_SALT',        'KZEHz*-Gl0Fql|(1`Zt|Uj{F2b8@Iz|oZA<BhY8;K?{_k+[9n99jvF1s=MXv)6!T');
define('SECURE_AUTH_SALT', '/VVP;C]az*N{zSu-ziR_w6u|.K vsxH-5ymTkWb1@#S,B}h.mS#Vx#sI(PUuQC> ');
define('LOGGED_IN_SALT',   '?u9D3{+t^.VERms|29[KFA@%+HqHQ%<>fCNL,nc[7dTwD1z*.,TN L20?(D&!]KG');
define('NONCE_SALT',       '~V$J)]8S,53{__8)xp@Ajc.R^k)x0${oZVp]h1>%^`U)tdyBU3]OB sX3Kl+6g~}');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_orlo_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
