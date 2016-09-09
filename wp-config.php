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
define('DB_NAME', 'bjpblogwp');

/** MySQL database username */
define('DB_USER', 'pault876');

/** MySQL database password */
define('DB_PASSWORD', '2YKyVHBWcz80Mg5W');

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
define('AUTH_KEY',         '79W,sc;{W+@Mpy1#^rS2(?w]$rjRtnRmwXT5%OB,$|p:J=Bi6?-90rC_8dbA*QhD');
define('SECURE_AUTH_KEY',  'bRtAi-NHv0:@_aL0MI$wfn5Vs$4}j]hT_>4,{L)(*TC)oFB/Zq}E8Tpa6vD%1LoT');
define('LOGGED_IN_KEY',    'ED(T|%1}-XJ[Q*}y|;)l[!<7T{&-m3id?X~pJ&X+<-L ,[I}Hg.90l}j5YDy)_1w');
define('NONCE_KEY',        'BQC6h+DUOJE,TP`%>+b{p-EZlt1h{-ru,fow@G_2#&iHzS.le:E5tC~CHVa9hs8K');
define('AUTH_SALT',        'WE;x/yek4X,OXK2p<Gw^M/X[CeZQNZI;eK;[@jfK=$q_n ;D|B3:X,jGI@M+qcNb');
define('SECURE_AUTH_SALT', 'Ii(?5j{ypd$+}oVBi?ugQ@amP$tmipXI)KJj3e8HVLh%N{bvY10sx>nkS/P+Yj_W');
define('LOGGED_IN_SALT',   'aI!W,rIZxvm8J?]+J{Bh<|QI,a!F s*6v`mzqL@TFGO=@2s@Q! ibb>`M1Ij(t|F');
define('NONCE_SALT',       'J{p{j&!Mm9}fB*-/3&P(0F&x@Z>--E-owPv]Cf&RMKOOLf0+5nBW(cD`+HtE%3-S');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
