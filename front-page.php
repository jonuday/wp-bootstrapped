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
 
get_header('front'); 
?>
<!-- BEGIN FRONT PAGE CONTENT --> 

<?php if ( get_theme_mod('front_page_layout') == "slideshow" ) :  
     // we use the shortcode to make a new query and styles
     $args = array('category' => get_theme_mod('front_page_category'));
?>

    <div class="slideshow_full inverse">
    <?php echo do_shortcode( wp_bootstrapped_gallery($args) ); ?>
    </div>

<?php else : ?>

<div class="main <?php if (get_theme_mod('front_page_layout') !== 'default') { echo get_theme_mod('front_page_layout', ''); } ?>">
<?php if (get_theme_mod('front_page_layout') !== 'default') { echo '</div><!-- /.full.main -->'; } ?>

    <section class="row">
        <div class="container<?php if ( get_theme_mod('nav_fixed') == 0 ) { echo '-fluid'; } ?> inverse"> 
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
<?php if (get_theme_mod('front_page_layout') == 'default') { echo '</div><!-- /.main.inverse -->'; } ?>

    <!-- widgets section -->
    <?php get_sidebar('widgets'); ?>


<!-- this does not get called --> 

 <?php endif; ?>

<?php 
get_footer(); 
?>