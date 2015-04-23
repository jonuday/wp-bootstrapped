<?php
/**
 * The default template for displaying pages.
 *
 * @package WP_Bootstrapped
 * @subpackage WP_Bootstrapped
 * @since WordPress Initializr 1.0
 *
**/
?>




    <div class="clear<?php if (has_nav_menu('footer-menu')) { echo '-double'; } ?>"></div>
    
    <footer class="footer navbar-<?php echo get_theme_mod('nav_style', 'default'); ?> footer-fixed">

        <?php if ( has_nav_menu( 'footer-menu') ) { ?>
            <div class="row">
                <div class="container"> 
                    <div class="nav col-xs-12">
                        <?php wp_nav_menu( array( 'container_class' => 'navbar', 'theme_location' => 'footer-menu', 'menu_class' => 'nav nav-pills' , 'walker' => new wp_initilizr_Walker_Nav_Menu ) ); ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="container">
                <div class="copyright col-sm-4 col-xs-12">
                        <p>&copy; <?php bloginfo('name'); ?> <?php echo date(Y); ?></p>
                    </div>
                    <div class="col-sm-4 col-xs-12 theme">
                        <p><a href="http://jonuday.com/initializr-bootstrap-theme-for-wordpress" alt="Initializr Bootstrap Theme for Wordpress">Initializr Bootstrap Theme</a> for <a href="http://wordpress.org" alt="Wordpress">Wordpress</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>    
    

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php bloginfo('template_directory'); ?>/bootstrap-green/js/jquery-1.10.1.min.js"><\/script>')</script>

    <script src="<?php bloginfo('template_directory'); ?>/bootstrap-green/js/bootstrap.min.js"></script>

    <script src="<?php bloginfo('template_directory'); ?>/js/responsive-images.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>

    <?php wp_footer(); ?>
</body>
</html>