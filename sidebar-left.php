<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package WP_Bootstrapped
 * @subpackage WP_Bootstrapped
 * @since WordPress Bootstrapped 1.0
 *
**/?>


	<?php if ( has_nav_menu( 'sidebar-left-menu') ) { ?>
	<div  class="sidebar">
	    <?php wp_nav_menu( array( 'container_class' => '', 'theme_location' => 'sidebar-left-menu', 'menu_class' => 'nav-left-sidebar' ) ); ?>
	</div>
	<?php } ?>

	<?php if ( is_active_sidebar( 'sidebar-3' )) { ?>
	<div class="sidebar">
	    
	        <?php dynamic_sidebar( 'sidebar-3' ); ?>
	    
	</div>
	<?php } ?>

	<?php if ( is_active_sidebar( 'sidebar-4' )) { ?>
	<div class="sidebar">
	    
	        <?php dynamic_sidebar( 'sidebar-4' ); ?>
	    
	</div>
	<?php } ?>

	<?php 
	if ( !has_nav_menu( 'sidebar-menu') 
		&& !is_active_sidebar( 'sidebar-3' ) 
		&& !is_active_sidebar( 'sidebar-4' ) ) {

		echo "<p>No left sidebars are set for this theme.</p>"; 
	}


	?>