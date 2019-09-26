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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'I/Q3CCExKoQ7QqgmJZjmrB93K3qGGsDwA11rUxZiycn1evAK588gZqjn/Je5/M2r5C5r5ZRuvIlBAM3IWx6tXg==');
define('SECURE_AUTH_KEY',  'fNwOjCvv8xXjo4pR3L/skvNMlHiF8IMWcJLEVIEPfj0J3XD0DfjV3831m+CSIyezKuKlet0g6X/oFLTB69UpNA==');
define('LOGGED_IN_KEY',    'or7jQldas9S2G8mrs6N5Z2jJRF6ApjIjo/V7I+5PpNz9Hq+x/yqz7IxAjscYYAD0d8FKBA3xcJ+odFzfPeAnMQ==');
define('NONCE_KEY',        'Z5V3z7vU6JiMQAJoF+00K9pLyrxkFqSG7ImxZ8fcwATNmB3/8Mq4lQIri1FOjUf0PN1QpP7TSgPyFblKf/HoCg==');
define('AUTH_SALT',        'm+vgTDVXLxjyd1nXmU7R/xcIElTL3wMqio5Q7vQ3o0rR+UFzHkElaKxkoEud4kIX6JjHgpKBPNCRBIqc6s2TMA==');
define('SECURE_AUTH_SALT', '9WI2YK5JW3W7lGG8zO01wgybuFgtg5g2+oTBRLw7IaBPOhMe+a4lOikFEsHlCLtDmjlwLISOpjVcFr5H6PDa3w==');
define('LOGGED_IN_SALT',   'pc+m7tYXGXE7cJlkiXHV0Xu2mh34Zuw6fjNZ4FLlRihXhveZ+Bs8S669PXAubRK/Mw8fvcyG8XAw5sjbgW7U0g==');
define('NONCE_SALT',       'MaTaneXPIa716yQHDK7RXcN46Q286tV1Alid+5nmkgBe1GlXdixS0d/JirLwmyJhm1AAsuerhn7uDyOnBrG1Fg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
