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
define('DB_NAME', 'NewLutskTimes');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'jm-(gs>9|Y6_MK<%_az0{Q^r#< ydKCuz(X$0EA~kPYTK:@.LEiwHA$zv_9=p=jl');
define('SECURE_AUTH_KEY',  'kNgcz.n9og79hY!kc?JVFClR6hN?jS}6*#Soh0Fc`gR6tT)@VeP6G[bvUa_VK`EF');
define('LOGGED_IN_KEY',    'UZ5,G2F^mpB{0zMff `_|00&G~Y Y$]}llVw`>u#8M2)nJN7EUAw4S>r6eq$9YIk');
define('NONCE_KEY',        'HV#^I>!{RS|Ldv`afnGJHIAi)Dz%NVYZ`OILB.Y_S[_Cwtsu2h8%ej&~+W,)pE{I');
define('AUTH_SALT',        '{?&o~Y,nR(+5$d+ z3(`+u`A=!~[WwT*dHRokLX]?]BIZ,e}|3q8:`p=jE.0GAmO');
define('SECURE_AUTH_SALT', 'ZG)Y%+S^&&WE3%pw:XM,8hGm0F1O43d!2gR+D.MA|q}[K<vn!Jx|6<jh3YnVH3^f');
define('LOGGED_IN_SALT',   'Xgk^ht7yMvl_^|{[TO%e]^MI:,R7M!s#H%VI|ng0^g*c$3g$!ILSv,Wu*u(;[KV0');
define('NONCE_SALT',       'UiN@R^/w8k*jgHj_|#iDH]56dX5`Y>!@A}S:.z?(oXJF=*wC(Qmm!U[gYp)T,h >');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
