<?php

class WP_Blade{
	
	
	protected static $compilers = array(
		'wpquery',
		'wpempty',
		'wpend',
		'debug',
	);
	
	
		public static function compile_string($value, $view = null)
		{

			foreach (static::$compilers as $compiler)
			{
				$method = "compile_{$compiler}";
	
				$value = static::$method($value, $view);
			}
			
			return $value;
		}
		
		protected static function compile_wpquery($value)
		{
			$pattern = '/(\s*)@wpquery(\s*\(.*\))/';
			$replacement  = '$1<?php $bladequery = new WP_Query$2; ';
			$replacement .= 'if ( $bladequery->have_posts() ) : ';
			$replacement .= 'while ( $bladequery->have_posts() ) : ';
			$replacement .= '$bladequery->the_post(); ?> ';

			return preg_replace($pattern, $replacement, $value);
		}
		
		protected static function compile_wpempty($value)
		{
			return str_replace('@wpempty', '<?php endwhile; ?><?php else: ?>', $value);
		}
	
		protected static function compile_wpend($value)
		{
			return str_replace('@wpend', '<?php endif; wp_reset_postdata(); ?>', $value);
		}
		
		protected static function compile_debug($value)
		{
			//done last
			if(strpos($value,'@debug'))
				die($value);
			return $value;
		}

}