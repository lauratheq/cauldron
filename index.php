<?php

if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', __DIR__ );
require_once ABSPATH . '/config.php';

if ( DEBUG_MODE === true ) {
	ini_set( 'display_errors', 1 );
	ini_set( 'display_startup_errors', 1 );
	error_reporting( E_ALL );
}

require_once ABSPATH . '/src/Hooks.php';
require_once ABSPATH . '/src/Helpers.php';
require_once ABSPATH . '/src/DB.php';
require_once ABSPATH . '/src/Options.php';
