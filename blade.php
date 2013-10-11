<?php 
/**
 *
 * @package   Blade
 * @author    Mikael Mattsson <mikael@weblyan.se>
 *
 * @wordpress-plugin
 * Plugin Name: Blade
 * Plugin URI:  
 * Description: The Blade template engine developed by Taylor Otwell and used in Laravel. Enables the use of Blade in your template files.
 * Version:     0.2.2
 * Author:      Mikael Mattsson
 * Author URI:  http://weblyan.se
 */
 
define('EXT', '.php');
define('CRLF', "\r\n");
define('BLADE_EXT', '.php');

if ( ! defined('DS')){
	define('DS', DIRECTORY_SEPARATOR);
}

define('DEFAULT_BUNDLE', 'application');
define('MB_STRING', (int) function_exists('mb_get_info'));
$blade_storage_path = dirname(__FILE__).'/storage/views';

require_once('laravel/blade.php');
require_once('laravel/section.php');
require_once('laravel/view.php');
require_once('laravel/event.php');
require_once('wpblade.php');
require_once('helpers.php');


add_action('template_include', 'template_include_blade');

$bladedTemplate = '';

function template_include_blade( $template ) {

	global $bladedTemplate;
	global $blade_storage_path;

	if($bladedTemplate)
		return $bladedTemplate;

	if(!$template)
		return $template; //Noting to do here. Come back later.

	require_once('paths.php');
	
	Laravel\Blade::sharpen();
	$view = Laravel\View::make('path: '.$template,array());

	$pathToCompiled = Laravel\Blade::compiled($view->path);

	if ( ! file_exists($pathToCompiled) or Laravel\Blade::expired($view->view, $view->path)){
		file_put_contents($pathToCompiled, Laravel\Blade::compile($view));
	}

	$view->path = $pathToCompiled;

	if ( $error = error_get_last() ) {
	    //var_dump($error);
	    //exit;
	}

	return $bladedTemplate = $view->path;
}


add_filter('index_template','filter_get_query_template');
add_filter('page_template','filter_get_query_template');

function filter_get_query_template($template){
	return template_include_blade( $template );
}

function blade_set_storage_path($path){
	global $blade_storage_path;
	$blade_storage_path = $path;
}