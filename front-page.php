<?php
/**
 * Template Name: Front Page
 * A page template with three widget areas under a main banner area.
 *
 * @package WP_Bootstrapped
 * @subpackage WP_Bootstrapped
 * @since WordPress Bootstrapped 1.0
 *
**/
 
get_header(); 
?>

<!-- BEGIN FRONT PAGE CONTENT --> 
<div class="main">

    <section class="row">
        <div class="container"> 
            <?php if ( have_posts() ) : ?>

                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', get_post_format() ); ?>
                <?php endwhile; ?>
    <!-- this gets called -->
                <?php wp_bootstrapped_content_nav( 'nav-below' ); ?>

            <?php else : ?>

                <article id="post-0" class="post no-results not-found col-md-12">

                <?php if ( current_user_can( 'edit_posts' ) ) :
                    // Show a different message to a logged-in user who can add posts.
                ?>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php _e( 'No posts to display', 'wp_bootstrapped' ); ?></h1>
                    </header>

                    <div class="entry-content">
                        <p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'wp_bootstrapped' ), admin_url( 'post-new.php' ) ); ?></p>
                    </div><!-- .entry-content -->

                <?php else :
                    // Show the default message to everyone else.
                ?>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php _e( 'Nothing Found', 'wp_bootstrapped' ); ?></h1>
                    </header>

                    <div class="entry-content">
                        <p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'wp_bootstrapped' ); ?></p>
                        <?php get_search_form(); ?>
                    </div><!-- .entry-content -->
                <?php endif; // end current_user_can() check ?>

                </article><!-- #post-0 -->

            <?php endif; // end have_posts() check ?>
        </div>
    </section>
</div><!-- /.main -->

    <!-- widgets section -->
    <?php get_sidebar('widgets'); ?>



<!-- this does not get called --> 
<?php 
get_footer(); 
?>