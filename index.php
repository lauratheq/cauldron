<?php

ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

if (!defined('ABSPATH'))
	define('ABSPATH', __DIR__);

require_once ABSPATH . '/config.php';
require_once ABSPATH . '/src/Hooks.php';
require_once ABSPATH . '/src/DB.php';
