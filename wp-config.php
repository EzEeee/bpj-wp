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
define('DB_NAME', 'badjoyproductions-wp');

/** MySQL database username */
define('DB_USER', 'pault653');

/** MySQL database password */
define('DB_PASSWORD', 'VfaFks7qMX8kn2bH');

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
define('AUTH_KEY',         '|&`j>;SL|]f_#`FV`4t=*V-{9vo25~&^|VS5uES}d(Vk{Vcn|9(|LXRc!I99qZFJ');
define('SECURE_AUTH_KEY',  '+diA$QIfjD)c_GaJR9eAwt!9aPBK]pzl3W=3)Kp7?`%_Tk-Wl~]:BU-0MYtZA*el');
define('LOGGED_IN_KEY',    't{:wfEg&-kixBA^-1@gP{{N/-JtPQxHYpY6Vov^)U?tBOt5l=E4cd.QP%1e+m5VV');
define('NONCE_KEY',        'yFiB60^cT0j3iN1w&IS[c#N}60 X(WoMfby@*?dZd[BE@l-fiA=]De(X,DdUN2Xx');
define('AUTH_SALT',        'mz5nC)==|^,^h+[u;({Ka$s#V29_S667+?Zw*^XZ^@Kb{yFp8X5g=Wd<x+h<J}g}');
define('SECURE_AUTH_SALT', 'mT^OQxJT:dD<;-H~pp<=&vC]#@e64*|IRZSm0`Y3ucd2eNjW+9/U1/05g+O8QNIV');
define('LOGGED_IN_SALT',   'lypLmqJjpEP-%lN,rx+YIsT+NL?QE*T&P^%J2pN~$Sbw]?;=|@ZZvORK3mOS9-r}');
define('NONCE_SALT',       'DM^MdRjUX7/<0/9E(<tYc?78[isWe|R].|YUa?q<p&UEdtrz+8`Z{AfB_Wp+2fKU');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dbbjp_';

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
define('WP_DEBUG', false);

define('WP_MEMORY_LIMIT', '3000M');

set_time_limit(60);


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
