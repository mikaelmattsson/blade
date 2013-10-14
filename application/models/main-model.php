<?php
/**
*
* Main plugin model
* @package Blade
*/

/**
* Main model
*/
class WP_Blade_Main_Model {

	/**
	 * Return a new class instance
	 * @return { obj } class instance
	 */
	public static function make() {

		return new self();
	}

	/**
	 * Blade template
	 */
	var $bladed_template;

	/**
	 * Handle the compilation of the templates
	 * @param { str } template path
	 * @return { str } compiled template path
	 */
	public function template_include_blade( $template ) {

		if( $this->bladed_template )
			return $this->bladed_template;

		if( ! $template )
			return $template; // Noting to do here. Come back later.

		require_once( WP_BLADE_CONFIG_PATH . 'paths.php' );

		Laravel\Blade::sharpen();
		$view = Laravel\View::make( 'path: ' . $template, array() );

		$pathToCompiled = Laravel\Blade::compiled( $view->path );

		if ( ! file_exists( $pathToCompiled ) or Laravel\Blade::expired( $view->view, $view->path ) )
			file_put_contents( $pathToCompiled, Laravel\Blade::compile( $view ) );

		$view->path = $pathToCompiled;

		if ( $error = error_get_last() ) {
		    //var_dump($error);
		    //exit;
		}

		return $bladedTemplate = $view->path;

	}

	/**
	* Return a call of templateinclude blade passing template path.
	* @param { str }
	* @return { str } path of the compiled view
	*/
	function get_query_template( $template ) {

		return $this->template_include_blade( $template );
	}

}
