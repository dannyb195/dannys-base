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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'dannys-base');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '4mhJ=C;G~E&T%{8GwqlSQ5oVcx0%uEM)|hgKsId^}?fJ;wj{dyGe$|P4@J<@_tcK');
define('SECURE_AUTH_KEY',  '!zzOxq@Pc:AEZwWQ<sG(o;IkdQI/3I1HyZHMnnIXpE+Bv7x<KitK?z#}y;8`ng8E');
define('LOGGED_IN_KEY',    't]^F6K97XN.B6iq%55gw?F}Y^RRXhd}3!KIvb0)iPR`_Z]&t[QE1y?Zv;^^|((@;');
define('NONCE_KEY',        '/!&)Z/ug+AcdzP5&csajOW2xal(R)vzuxIvXD536nm@BuPAD#cI<s63*d:m6j<b8');
define('AUTH_SALT',        '[wsg:U++z-C;p.YY>/ .r#{%Y;hr<.fTn8i}PTtA,M7N+jG|?2mIQ&AI@aJiuvh9');
define('SECURE_AUTH_SALT', 'Aq%Mf6StJm{+&}vZ9&imz}Lh|+I29X^~)hwu]u=t9v5DupnJNdU1- 4Kd|yhgb0]');
define('LOGGED_IN_SALT',   '|Fjmx:QP8(}-/*_% bK+Xb+h6OA&SFX6UF|N-Z,-SGL06e;vN5e{J)f_O|mR5+Rz');
define('NONCE_SALT',       'iRe_Yvlz?Pr $U28-<Z|m Ny)-WK]fP8Us1z*cQ<71a-,W[_HO|T)7[)QNx:&ycv');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
