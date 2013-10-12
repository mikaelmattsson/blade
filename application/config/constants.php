<?php
/**
* Define constants the plugin is going to be using
*
* @package Blade
*/

/*
|---------------------------------------------------------------------
| Main plugin constants
|---------------------------------------------------------------------
|
| Constants to standarize things
*/


/**
* Path for the helpers folder
*/
define( 'HELPERS_PATH', APP_PATH . 'helpers/' );

/**
* Path for the models
*/
define( 'MODELS_PATH', APP_PATH . 'models/' );

/**
* Path for the controllers
*/
define( 'CONTROLLERS_PATH', APP_PATH . 'controllers/' );

/**
* Path for views
*/
define( 'VIEWS_PATH', APP_PATH . 'views/' );

/**
 * Storage path
 */
define( 'BLADE_STORAGE_PATH', WP_BLADE_ROOT . 'storage/views' );

//------------------------------
//  General constants
//--------------------------------

// File extension
define( 'EXT', '.php' );

// Line break
define('CRLF', "\r\n");

// Blade files extension
define('BLADE_EXT', '.php');

// Directory separator
if ( ! defined( 'DS' ) )
	define( 'DS', DIRECTORY_SEPARATOR );


// Default bundle
define( 'DEFAULT_BUNDLE', 'application' );

// MB String
define( 'MB_STRING', (int) function_exists( 'mb_get_info' ) );
