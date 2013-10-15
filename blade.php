<?php
/**
*
* Plugin Name: Blade
* Plugin URI: https://github.com/MikaelMattsson/blade
* Description: The Blade template engine developed by Taylor Otwell and used in Laravel. Enables the use of Blade in your template files.
* Version: 0.3.0
* Author: Mikael Mattsson, Pablo Vallejo
* Author URI: http://weblyan.se
*
* @package Blade
* @author Mike Mattsson, Pablo Vallejo <mikael@weblyan.se>
*/


/*
|-----------------------------------------------------------------------------------
| Set configuration settings
|-----------------------------------------------------------------------------------
| Set important configuration settings
|
*/
ini_set( 'display_errors', 1 );


/*
|-----------------------------------------------------------------------------------
| Define Principal Constants
|-----------------------------------------------------------------------------------
|
| These are constans to refarece folders in the plugin
|
*/

/**
 * Plugin Root
 */
define( 'WP_BLADE_ROOT', dirname( __FILE__ ) . '/' );

/**
* Path for the application foler inside the theme
*/
define( 'WP_BLADE_APP_PATH', WP_BLADE_ROOT . 'application/' );

/**
 * Path of assets
 */
define( 'WP_BLADE_ASSETS_PATH', WP_BLADE_ROOT . 'assets/' );

/**
* Path for the config folder
*/
define( 'WP_BLADE_CONFIG_PATH', WP_BLADE_APP_PATH . 'config/' );

/**
* Path for libraries
*/
define( 'WP_BLADE_LIBRARIES_PATH', WP_BLADE_APP_PATH . 'lib/' );

/*
|-------------------------------------------------------------------------
| Start the plugin by instanciating the cain controller
|-------------------------------------------------------------------------
|
| In order to bootstrap the application we've require the initialize file
| which loads all the necessary controllers, helpers, models and other files.
|
| After that, instanciate the main controller which will add actions and the like.
*/

require_once ( WP_BLADE_CONFIG_PATH . '/initialize.php' );
WP_Blade_Main_Controller::make();
