<?php
/**
 * The default template for displaying pages.
 *
 * @package WP_Bootstrapped
 * @subpackage WP_Bootstrapped
 * @since WordPress Bootstrapped 1.0
 *
**/
?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php  wp_title('|',true,'right'); ?> <?php bloginfo('name'); ?></title>
        <meta name="description" content="<?php bloginfo( 'description' ); ?> ">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/apple-touch-icon.png">

        <link href='//fonts.googleapis.com/css?family=Lato:300,400,700|Poiret+One' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/bootstrap-green/css/bootstrap.min.css">

        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>

        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/bootstrap-green/css/bootstrap-theme.min.css">
        
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css">

        <script src="<?php bloginfo('template_directory'); ?>/bootstrap-green/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

        <?php wp_head(); ?> 
    </head>
    <body  <?php body_class($class); ?>>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <?php /*

    Allow screen readers / text browsers to skip the navigation menu and
    get right to the good stuff. */ ?>

    <div class="skip-link screen-reader-text">
        <a href="#content" title="<?php esc_attr_e( 'Skip to content', 'wp-bootstrapped' ); ?>">
        <?php _e( 'Skip to content', 'wp-bootstrapped' ); ?></a>
    </div>

    <?php if ( get_theme_mod('nav_fixed') == '' ) { echo '<div class="container">'; } ?>

    <nav class="navbar navbar-<?php echo get_theme_mod('nav_style', 'default'); ?> <?php if ( get_theme_mod('nav_fixed') == 1 ) { echo 'navbar-fixed-top'; } ?>" role="navigation">
      <div class="container<?php if ( get_theme_mod('nav_fixed') == '' ) { echo '-fluid'; } ?>">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><?php bloginfo('name'); ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
                        
            <?php /*

                        Our navigation menu.  If one isn't filled out, wp_nav_menu falls
                        back to wp_page_menu.  The menu assigned to the primary position is
                        the one used.  If none is assigned, the menu with the lowest ID is
                        used. */

                        //if (has_nav_menu('top-menu')) {
                            wp_nav_menu( array( 'container_class' => '', 'theme_location' => 'top-menu', 'menu_class' => 'nav navbar-nav', 'fallback_cb' => 'false', 'walker' => new wp_bootstrapped_Walker_Nav_Menu ) );  
                        //} else {
                        //    wp_page_menu(array( 'container_class' => 'sr-only', 'menu_class' => 'nav navbar-nav', 'walker' => new wp_bootstrapped_Walker_Nav_Menu  )); 
                       //}
           ?>

            <form class="nav navbar-nav navbar-right navbar-form" role="form">
                <label class="screen-reader-text" for="s">Search:</label>
                <input class="form-control" type="search" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="search..." />
                <button type="submit" class="btn" >Search</button>
            </form>

        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- END HEADER -->