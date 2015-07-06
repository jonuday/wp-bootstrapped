<?php
/**
 * The default template for displaying pages.
 *
 * @package WP_Bootstrapped
 * @subpackage WP_Bootstrapped
 * @since WordPress Bootstrapped 1.0
 *
**/
?>


    <div class="clear<?php if (has_nav_menu('footer-menu')) { echo '-double'; } ?>"></div>
    
    <footer class="footer navbar-<?php echo get_theme_mod('nav_style', 'default'); ?> <?php if ( get_theme_mod('nav_fixed') == 1 ) { echo 'footer-fixed'; } ?>">

        <?php if ( has_nav_menu( 'footer-menu') ) { ?>
            <div class="row">
                <div class="container-fluid"> 
                    <div class="nav col-xs-12">
                        <?php wp_nav_menu( array( 'container_class' => 'navbar', 'theme_location' => 'footer-menu', 'menu_class' => 'nav nav-pills' , 'walker' => new wp_bootstrapped_Walker_Nav_Menu ) ); ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="container-fluid">
                <div class="copyright col-sm-6 col-xs-12">
                        <p>&copy; <?php bloginfo('name'); ?> <?php echo date(Y); ?></p>
                    </div>
                    <div class="col-sm-6 col-xs-12 theme text-right">
                        <p><a href="https://github.com/jonuday/wp-bootstrapped" alt="A Bootstrapped Theme for Wordpress">WordPress Bootstrapped Theme</a> for <a href="http://wordpress.org" alt="Wordpress">Wordpress</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>    
    
    <?php if ( get_theme_mod('nav_fixed') == '' ) { echo '</div>'; } ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.10.1.min.js"><\/script>')</script>

    <script src="<?php bloginfo('template_directory'); ?>/bootstrap/js/bootstrap.min.js"></script>

    <script src="<?php bloginfo('template_directory'); ?>/js/responsive-images.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>

    <?php wp_footer(); ?>
</body>
</html>