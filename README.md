WP Blade
=======

Brings Laravel's great template engine, Blade, to WordPress. Just install and start using blade in your theme.

Blade is the template engine for Laravel, a very popular php framework, developed by Taylor Otwell. This plugin brings the same template engine to WordPress. Using a template engine will result in much cleaner template files and quicker development. Normal php can still be used in the template files. The plugin also adds a WordPress specific snippet to blade. Check out the examples for more info.

**WordPress repository**: 
[Blade](http://wordpress.org/plugins/blade/)

**Blade Tutorial on YouTube**:
[Video Tutorial](http://www.youtube.com/watch?v=H6JJtr0Frcs)

### Echo/print

**Normal**
```php

<?php echo $foo ?>
```

**Blade**
```php

{{ $foo }}
```

### Post data

**Normal**
```php

<?php the_title() ?>
```

**Blade**
```php

{{ the_title() }}
```

### If statement

**Normal**
```php

<?php if( has_post_thumbnail() ) : ?>
    <?php the_post_thumbnail() ?>
<?php else: ?>
    <img src="<?php bloginfo( 'stylesheet_directory' ) ?>/images/thumbnail-default.jpg" />
<?php endif; ?>
```

**Blade**
```php

@if( has_post_thumbnail() )
    {{ the_post_thumbnail() }}
@else
    <img src="{{ bloginfo( 'stylesheet_directory' ) }}/images/thumbnail-default.jpg" />
@endif
```


### WordPress loop
**Normal**
```php

<ul>
	<?php $query = new WP_Query( array( 'post_type' => 'post' ) ); ?>
	<?php if ( $query->have_posts() ) : ?>
	        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
	        <li><a href="<?php the_permalink() ?>"> <?php the_title() ?> </a></li>
	        <?php endwhile; ?>
	<?php else : ?>
	        <li><?php _e( 'Sorry, no posts matched your criteria.' ) ?></li>
	<?php endif; wp_reset_postdata(); ?>
</ul>
```

**Blade.** WordPress specific snippet
```php
<ul>
	@wpquery( array( 'post_type' => 'post' ) )
	        <li><a href="{{ the_permalink() }}">{{ the_title() }}</a></li>
	@wpempty
	        <li>{{ __( 'Sorry, no posts matched your criteria.' ) }}</li>
	@wpend
</ul>
```


### Advanced Custom Fields
**Normal**
```php
<ul>
    <?php if( get_field( 'images' ) ): ?>
        <?php while( has_sub_field( 'images' ) ): ?>
            <li><img src="<?php the_sub_field( 'image' ) ?>" /></li>
        <?php endwhile; ?>
    <?php endif; ?>
</ul>
```

**Blade**
```php
<ul>
    @acfrepeater('images')
        <li>{{ get_sub_field( 'image' ) }}</li>
    @acfend
</ul>
```

### Including files

Files included with functions, e.g. `the_header()`, will not be compiled by Blade, however the php code in the file is still executed. To include a file with blade use:

```php

@include( 'header' )
```

Note that you should not type “.php”.

### Layouts

**master.php**
```html
<html>
    <div class="content">
        @yield( 'content' )
    </div>
</html>
```

**page.php**

```html

@layout( 'master' )

@section( 'content' )
    <p>Lorem ipsum</p>
@endsection
```


## Documentation

Check out the complete [Blade Documentation](http://three.laravel.com/docs/views/templating) for more examples.


## Contributing

Pull requests are highly appreciated. Feel free to report a bug, typo, enhancement or a feature you want to add to the plugin.
