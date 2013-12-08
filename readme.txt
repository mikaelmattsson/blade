=== Blade ===
Contributors: konvent
Tags: Blade, Laravel, Template, Engine
Requires at least: 3.0.0
Tested up to: 3.7
Stable tag: 0.3.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Brings Laravel's great template engine, Blade, to Wordpress. Just install and start using blade in your theme.

== Description ==

Note that the plugin is in beta and changes made in the future could result in your current code no longer working.

Blade is the template engine for Laravel, a very popular php framework, developed by Taylor Otwell. This plugin brings the same template engine to wordpress.
Using a template engine will result in much cleaner template files and quicker development. Normal php can still be used in the template files.
The plugin also adds a wordpress specific snippet to blade. Check out the examples for more info.

= echo/print =

`<?php echo $foo ?>`
can be replaced with... 
`{{$foo}}`

= post data =

`<?php the_title() ?>`
can be replaced with... 
`{{the_title()}}`

= if() =
`<?php if(has_post_thumbnail()) : ?>
    <?php the_post_thumbnail() ?>
<?php else: ?>
    <img src="<?php bloginfo( 'stylesheet_directory' ) ?>/images/thumbnail-default.jpg" />
<?php endif; ?>`
can be replaced with... 
`@if(has_post_thumbnail())
    {{the_post_thumbnail() }}
@else 
    <img src="{{bloginfo( 'stylesheet_directory' )}}/images/thumbnail-default.jpg" />
@endif`

= the loop =
`<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <a href="<?php the_permalink() ?>"><?php the_title() ?></a><br>
<?php endwhile; else: ?>
        <p>404</p>
<?php endif; ?>`
 
can be replaced with... 
`@wpposts
       <a href="{{the_permalink()}}">{{the_title()}}</a><br>
@wpempty
        <p>404</p>
@wpend`

= wordpress query =
`<ul>
<?php $query = new WP_Query( array('post_type' => 'post') ); ?>
<?php if ( $query->have_posts() ) : ?>
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <li><a href="<?php the_permalink() ?>"> <?php the_title() ?> </a></li>
        <?php endwhile; ?>
<?php else : ?>
        <li><?php _e('Sorry, no posts matched your criteria.') ?></li>
<?php endif; wp_reset_postdata(); ?>
</ul>`
 
can be replaced with... 
`<ul>
@wpquery(array('post_type' => 'post'))
        <li><a href="{{the_permalink()}}">{{the_title()}}</a></li>
@wpempty
        <li>{{ __('Sorry, no posts matched your criteria.') }}</li>
@wpend
</ul>`





= Including files =

Files included with functions, e.g. the_header(), will not be compiled by Blade, however the php code in the file is still executed.
To include a file with blade use:
`@include('header')`
Note that you should not type “.php”.

You can also use layouts.

master.php:
`<html>
    <div class="content">
        @yield('content')
    </div>
</html>`
page.php:
`@layout('master')

@section('content')
    <p>Lorem ipsum</p>
@endsection`


See the [Blade documentation](http://three.laravel.com/docs/views/templating "Laravel 3 Templating") for more info

Contribute on github: [github.com/MikaelMattsson/blade](https://github.com/MikaelMattsson/blade)

== Installation ==

1. Upload folder `blade` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Make sure that `/wp-content/plugins/blade/storage/views/` is writable by php 
1. Done! You can now use Blade in your theme

= More options =

It is recommended thay you change the path to the location where the compiled views are stored to within your theme. This will fix problems with wpml. To do so, put the following code in your theme folder and create the folder/directory “bladecache” in your theme folder.
`if(function_exists('blade_set_storage_path')){
    blade_set_storage_path(get_template_directory().'/bladecache');
}`


== Changelog ==

= 0.3.3 =
* Compatibility update for PHP 5.5

= 0.3.2 =
* Added @wpposts

= 0.3.1 =
* Changed the structure of all files.

= 0.2.0 =
* The view templates are now loaded differently.
* Better errorhandling.
* Added possibility to change the storage path.

= 0.1.1 =
* Added a fix for plugins that import the template file directly using the template path fetched using get_query_template() like WP e-Commerce;

= 0.1.0 =
* initial (beta)
