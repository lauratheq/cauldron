<?php

// set the absolute path to the system
// and load the user config
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', __DIR__ );
require_once ABSPATH . '/config.php';

// overwrite the debug mode
if ( DEBUG_MODE === true ) {
	ini_set( 'display_errors', 1 );
	ini_set( 'display_startup_errors', 1 );
	error_reporting( E_ALL );
}

// Load the hook system
require_once ABSPATH . '/src/Hook.php';
require_once ABSPATH . '/src/Hooks.php';

// database
require_once ABSPATH . '/src/DB.php';

// load the plugin system


// System is loaded, engage
Hooks::exec( 'plugins_loaded' );

// helpers
require_once ABSPATH . '/src/Helpers.php';

// options
require_once ABSPATH . '/src/Options.php';

// placeholder for the template

// System is loaded, engage
Hooks::exec( 'system_loaded' );
