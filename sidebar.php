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
	<div  class="sidebar">
	    <?php wp_nav_menu( array( 'container_class' => '', 'theme_location' => 'sidebar-right-menu', 'menu_class' => 'nav-right-sidebar' ) ); ?>
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

	<?php 
	if ( !has_nav_menu( 'sidebar-menu') 
		&& !is_active_sidebar( 'sidebar-1' ) 
		&& !is_active_sidebar( 'sidebar-2' ) ) {

		echo "<p>No sidebars are set for this theme.</p>"; 
	}


	?>