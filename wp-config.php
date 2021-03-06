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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'harassanjose' );

/** MySQL database username */
define( 'DB_USER', 'Kamino' );

/** MySQL database password */
define( 'DB_PASSWORD', 'h4r4224nj0s3' );

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
define( 'AUTH_KEY',         '=ivr8w$<-W`)lX6]qpf~[y;&j4c@;Ox3x:KkxqBpWA=fU5Ew5&1 IgE5@usRS}<n' );
define( 'SECURE_AUTH_KEY',  'aQP5YA|P8>97Bi{xT#CCgURv[&.IH5pm0kM,xlCSI!RgTvbeOCae}ns5>tjf_bu`' );
define( 'LOGGED_IN_KEY',    'S8+h?+qqMi?NheTx.d[/TI_a?r-!l)s,~cIZ;TS@(UtP$O=6o_hD|2z*-p<`)izE' );
define( 'NONCE_KEY',        '`*,v*v.Jk`o@a0-NE_-wOP@sEGK;t71t(L-oI+=|F]qr_l-0#0~kOn&W.H-EzJ3Y' );
define( 'AUTH_SALT',        'bii.sD3D`[02Y?5H+:EizEmQufj`el_j.R{eH2o3?YS`(Jj5Ajs&A.BSswlE>^RN' );
define( 'SECURE_AUTH_SALT', '&uHCY)wsg~uFWBlOf@`)Nv|0&kPr!##*5swqmb<-jh[$At,pH;lH:LM_)}Y/q1$5' );
define( 'LOGGED_IN_SALT',   'ld3n#<PJM BY&,`rS&rwobF:^[Kcl;>CV@x8y}Kob;E-nj6RIy>wu;P@]6|CxCv+' );
define( 'NONCE_SALT',       'omlnBqK2W`r/GS}AKZBDqh-l<SY0QE:!up{R}0^N>?Gifau#8Lw/5OLvBq4aTU_w' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'hsj_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
