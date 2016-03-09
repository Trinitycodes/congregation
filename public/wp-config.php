<?php


// ** MySQL settings ** //
if (file_exists(dirname(__FILE__) . '/wp-config-local.php')) {
  # IMPORTANT: ensure your local config does not include wp-settings.php
  require_once(dirname(__FILE__) . '/wp-config-local.php');
} else {
  // Don't show deprecations; useful under PHP 5.5
  error_reporting(E_ALL ^ E_DEPRECATED);
  define('DB_NAME',          $_ENV['DB_NAME'] );
  define('DB_USER',          $_ENV['DB_USER'] );
  define('DB_PASSWORD',      $_ENV['DB_PASS'] );
  define('DB_HOST',          $_ENV['DB_HOST'] );
  define('DB_CHARSET',       'utf8');
  define('DB_COLLATE',       '');
  $table_prefix  = 'wp_';
  define('WPLANG', '');
  define('WP_DEBUG', false);
  /* That's all, stop editing! Happy blogging. */
}

define('AUTH_KEY',         ';7}:%.3+.jaeE&,u4Aq,O6-~|kr Lz#sp6pu;RWzcSC38<,2MACjq-UiRI_1tIU(');
define('SECURE_AUTH_KEY',  'h2=T-UGx^%+q},QS~;ZTP]6f%r<bE&j}tT)~uXb]rcsU`Z)W/kslURa2mbcSGa/m');
define('LOGGED_IN_KEY',    '@s6gkwZf}`),HXY;)2Jj4l+omeE^KM ->OO2PzGNF*K%8 ;7s~HQT|/)1q9+VTk@');
define('NONCE_KEY',        'N$5|{v}?t%cz6vAwLhEh+:ur)uMs,P}+xX)wBV?>U+L6ddb-v}x$6>;>=w.Q;@-L');
define('AUTH_SALT',        '=2_<.NXelZGvGtm@CPt~_NiK8A64iQ7nF-(2r!/Gr<$>76i=N)L,1m*Q{]a:H#>N');
define('SECURE_AUTH_SALT', 'ShhLG;Z/*13=}9TOwfPI &Qs0|i4JBXDyyTs&/HnVbov$Yi`c@3AV(RG`o+<D)k>');
define('LOGGED_IN_SALT',   'P8->wm-t9;oR%MB`^$Q-;[8|e:a;U T@9z4~%[0#iH$UlxTP&xy_j2DZjwdi@2+8');
define('NONCE_SALT',       'u;Xa0{E-=gw0`*ZV*M*i8!V5BD.%2^KX6Y*_#+}FDdrxw1Ea;-ZVq!9^1=&[jDk0');


$table_prefix = 'wp_';

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
