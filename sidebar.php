<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package WP_Bootstrapped
 * @subpackage WP_Bootstrapped
 * @since WordPress Bootstrapped 1.0
 *
**/?>


	<?php if ( has_nav_menu( 'sidebar-right-menu') ) { ?>
	<div  class="sidebar navbar navbar-<?php echo get_theme_mod('nav_style', 'default'); ?>">
	    <?php wp_nav_menu( array( 'container_class' => '', 'theme_location' => 'sidebar-right-menu', 'menu_class' => 'nav nav-sidebar', 'walker' => new wp_bootstrapped_Walker_Nav_Menu ) ); ?>
	</div>
	<?php } ?>

	<?php if ( is_active_sidebar( 'sidebar-1' )) { ?>
	<div class="sidebar">
	    
	        <?php dynamic_sidebar( 'sidebar-1' ); ?>
	    
	</div>
	<?php } ?>

	<?php if ( is_active_sidebar( 'sidebar-2' )) { ?>
	<div class="sidebar">
	    
	        <?php dynamic_sidebar( 'sidebar-2' ); ?>
	    
	</div>
	<?php } ?>
