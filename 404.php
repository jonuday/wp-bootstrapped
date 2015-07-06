<?php
/**
 * The default template for displaying pages.
 *
 * @package WP_Bootstrapped
 * @subpackage WP_Bootstrapped
 * @since WordPress Bootstrapped 1.0
 *
**/

get_header(); ?>

<!-- BEGIN CONTENT --> 

    <div class="row">
        <div class="container<?php if ( get_theme_mod('nav_fixed') == 0 ) { echo '-fluid'; } ?>">
        	<div class="col-md-12">
        		<h1>This is likely not the page you&rsquo;re looking for...</h1>

        		<p>It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching the site will help.</p>
    			
    			<?php get_search_form(); ?>
            </div>        	
    	</div>
    </div>

<!-- END CONTENT -->

<?php get_footer(); ?>