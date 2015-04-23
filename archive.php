<?php
/**
 * The default template for displaying Archive pages.
 *
 * @package WP_Bootstrapped
 * @subpackage WP_Bootstrapped
 * @since WordPress Bootstrapped 1.0
 *
**/

get_header(); ?>

<!-- BEGIN CONTENT --> 
    <?php 
        $header_image = get_header_image();
        if ( ! empty( $header_image ) ) { ?>
        <div class="row">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" alt="" /></a>
        </div>
    <?php } ?>

    <div class="row">
    	<div class="container">
	    		<div class="col-md-12">
	    			<?php if ( have_posts() ) : ?>
					<h1><?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'wp_bootstrapped' ), '<span>' . get_the_date() . '</span>' );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'wp_bootstrapped' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'wp_bootstrapped' ) ) . '</span>' );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'wp_bootstrapped' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'wp_bootstrapped' ) ) . '</span>' );
						else :
							_e( 'Archives', 'wp_bootstrapped' );
						endif;
					?></h1>
				</header><!-- .archive-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/* Include the post format-specific template for the content. If you want to
					 * this in a child theme then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

				endwhile;

				wp_bootstrapped_content_nav( 'nav-below' );
				?>

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
	    	</div>

		    <!-- sidebar widgets section -->
		    <div class="col-md-4">
		    <?php get_sidebar(); ?>
			</div>
		</div>
	</div>

<!-- END CONTENT -->

<?php get_footer(); ?>