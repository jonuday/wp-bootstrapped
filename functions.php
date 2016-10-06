<?php
/**
 *
 * @package WordPress Bootstrapped
 * @subpackage WP_Bootstrapped
 * @since WordPress Bootstrapped 1.2.1
 *
 * Features:
 * • Recent Posts with Category (Shortcode & Widget)
 * • Navigation (Header, Footer, Left & Right Sidebar)
 * • Navigation Styling (Fixed, Coloring)
 * • Customizable Images (Banner, Logo)
 * • Customizable Banner Image
 * 
 * Add list:
 * 
 * 1. Fixed Scroll front page
 * 2. Gallery Page
 * 3. Customizer Realtime Updating (Logo, Navbar Style)
 * 4. Move fonts from header to stylesheet
 * 5. Child theme boostrap theme files?
**/

add_theme_support( 'post-thumbnails' );

// Custom Headers 
function wp_bootstrapped_header () {
	$header_args = array(
		'default-image' => get_template_directory_uri() . '/img/header.jpg',
		'random-default'         => false,
		'width'                  => 0,
		'height'                 => 0,
		'flex-height'            => true,
		'flex-width'             => true,
		'default-text-color'     => '',
		'header-text'            => true,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $header_args );
}
add_action('after_setup_theme','wp_bootstrapped_header');

// Custom Settings

/**
 * Adds customizer areas for theme
 */
function wp_bootstrapped_customize_register( $wp_customize ) {

	/**
	 * Adds textarea support to the theme customizer
	 */
	class WPB_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}


   // All our sections, settings, and controls will be added here

	// Add Sections
	$wp_customize->add_section( 'wp_bootstrapped_logo_section' , array(
    	'title'      => __( 'Logo', 'wp_bootstrapped' ),
    	'priority'   => 10,
	) );

	$wp_customize->add_section( 'wp_bootstrapped_front_section' , array(
    	'title'      => __( 'Front Page Style', 'wp_bootstrapped' ),
    	'priority'   => 120,
	) );
	$wp_customize->add_section( 'wp_bootstrapped_nav_section' , array(
    	'title'      => __( 'Header Nav Style', 'wp_bootstrapped' ),
    	'priority'   => 125,
	) );
	$wp_customize->add_section( 'wp_bootstrapped_scripts_section' , array(
    	'title'      => __( 'Third Party Scripts', 'wp_bootstrapped' ),
    	'priority'   => 130,
	) );



	// Add settings
	$wp_customize->add_setting( 'nav_style' , array(
    	'default'     => 'default',
    	'transport'   => 'postMessage',
	) );

	$wp_customize->add_setting( 'nav_fixed' );

	$wp_customize->add_setting( 'front_page_layout' , array(
    	'default'     => 'default',
     	'transport'   => 'postMessage',
	) );

	$wp_customize->add_setting( 'front_page_category' );

	$wp_customize->add_setting( 'front_page_gradient' );

	$wp_customize->add_setting( 'front_page_panels' , array(
    	'default'     => 'default',
     	'transport'   => 'postMessage',
	) );

	$wp_customize->add_setting( 'front_page_panel_layout' , array(
    	'default'     => 'default',
     	'transport'   => 'postMessage',
	) );

	$wp_customize->add_setting( 'logo_image' , array(
    	'transport'   => 'postMessage',
	) ); // 'default'     => 'img/wp-bootstrapped.png',

	$wp_customize->add_setting( 'head_scripts' );

	$wp_customize->add_setting( 'footer_scripts' );


	// add controls	

	// $wp_customize->add_control('color_scheme', 
	
	$wp_customize->add_control('nav_style', 
		array(
			'label'    => __( 'Navbar Style', 'wp_bootstrapped' ),
			'section'  => 'wp_bootstrapped_nav_section',
			'settings' => 'nav_style',
			'type'     => 'radio',
			'choices'  => array(
				'default'  => 'default (light)',
				'inverse' => 'inverse (gray)',
			),
		)
	); // echo get_theme_mod('nav_style', '');
	
	$wp_customize->add_control( 'nav_fixed', array(
	        'type' => 'checkbox',
	        'label' => __( 'Use Fixed Navbars', 'wp_bootstrapped' ),
	        'section' => 'wp_bootstrapped_nav_section',
	    )
	); // echo get_theme_mod('nav_fixed', 'navbar-fixed');

	$wp_customize->add_control('front_page_layout', 
		array(
			'label'    => __( 'Front Page Layout', 'wp_bootstrapped' ),
			'section'  => 'wp_bootstrapped_front_section',
			'settings' => 'front_page_layout',
			'type'     => 'radio',
			'choices'  => array(
				'default'  => 'Top banner background (default)',
				'full' => 'Full screen background',
				'slideshow' => 'Full screen slideshow as background',
			),
		)
	); // echo get_theme_mod('front_page_layout', '');

	$wp_customize->add_control('front_page_category', 
		array(
			'label'    => __( 'Front Page Category for Slideshow', 'wp_bootstrapped' ),
			'section'  => 'wp_bootstrapped_front_section',
			'settings' => 'front_page_category',
			'type'     => 'select',
			'choices'  => wpb_category_list(),
			'active_callback' => function () { return get_theme_mod('front_page_layout') == 'slideshow'; }
		)
	); // echo get_theme_mod('front_page_category', '');

	$wp_customize->add_control( 'front_page_gradient', array(
	        'type' => 'checkbox',
	        'label' => 'Use gradient on background image',
	        'section' => 'wp_bootstrapped_front_section',
	    )
	); // echo get_theme_mod('front_page_gradient', '');

	$wp_customize->add_control( 'front_page_panels', array(
	        'type' => 'radio',
	        'label' => __( 'Select style for panels', 'wp_bootstrapped' ),
	        'section' => 'wp_bootstrapped_front_section',
	        'settings' => 'front_page_panels',
	        'choices'  => array(
	        	'default' => 'White (default)',
				'transparent'  => 'Transparent',
				'gray'  => 'Grayscale',
				'primary' => 'Primary color',

			),
	    )
	); // echo get_theme_mod('front_page_panels', '');

	$wp_customize->add_control( 'front_page_panel_layout', array(
	        'type' => 'radio',
	        'label' => __( 'Select layout for panels', 'wp_bootstrapped' ),
	        'section' => 'wp_bootstrapped_front_section',
	        'settings' => 'front_page_panel_layout',
	        'choices'  => array(
	        	'default' => 'Panels (default)',
				'rows'  => 'Rows',
			),
	    )
	); // echo get_theme_mod('front_page_panel_layout', 'default');



	$wp_customize->add_control( new WP_Customize_Header_Image_Control( $wp_customize, 'header_image', array(
		'label'        => __( 'Front Page Banner Image', 'wp_bootstrapped' ),
		'section'    => 'header_image',
		'settings'   => 'header_image',
	) ) );


	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_image', array(
		'label'        => __( 'Logo', 'wp_bootstrapped' ),
		'section'    => 'wp_bootstrapped_logo_section',
		'settings'   => 'logo_image',
	) ) );

	$wp_customize->add_control( new WPB_Customize_Textarea_Control( $wp_customize, 'head_scripts', array(
		'label'        => __( 'Head', 'wp_bootstrapped' ),
		'section'    => 'wp_bootstrapped_scripts_section',
	) ) ); // echo get_theme_mod('head_scripts', '');

	$wp_customize->add_control( new WPB_Customize_Textarea_Control( $wp_customize, 'footer_scripts', array(
		'label'        => __( 'Footer', 'wp_bootstrapped' ),
		'section'    => 'wp_bootstrapped_scripts_section',
	) ) );

	$wp_customize->add_control( new WP_Customize_Background_Image_Control( $wp_customize, 'background_image', array(
		'label'        => __( 'Posts and Pages Background Image', 'wp_bootstrapped' ),
		'section'    => 'background_image',
		'settings'   => 'background_image',
	) ) ); // echo get_theme_mod('footer_scripts', '');

	// Acknowledge whats already built in
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_image' )->transport = 'postMessage';
	$wp_customize->get_setting( 'front_page_panel_layout' )->transport = 'postMessage';
}
add_action( 'customize_register', 'wp_bootstrapped_customize_register' );

function wp_bootstrapped_customize_css()
{
    ?>
         <style type="text/css">

         	<?php if (get_theme_mod('header_textcolor')) { ?>
         		h1, h2, h3, h4, h5,
         		h1 a, h2 a, h3 a, h4 a, h5 a {
         			color: #<?php echo get_theme_mod('header_textcolor', '2c2c2c'); ?>;
         		}
         	<?php } ?>

         	a.navbar-brand {
         		min-width: 140px;
         		height: auto; 
         		background: transparent url( <?php echo get_theme_mod('logo_image') ? get_theme_mod('logo_image') :  get_template_directory_uri() . '/img/wp-bootstrapped.png'; ?>) 20px 50% no-repeat;
         		background-size: auto 60%;
         		text-indent: -9999em;
         	}

         	<?php if (get_theme_mod('header_image')) { ?>
            .banner {
            	background: -webkit-gradient(linear, to bottom, to top, color-stop(0%, rgba(254, 254, 254, 0)), color-stop(100%, #fefefe)), transparent url(<?php echo get_theme_mod('header_image', get_template_directory_uri() . '/img/header.jpg'); ?>) 0 0 no-repeat;
				background: -webkit-linear-gradient(to bottom, rgba(254, 254, 254, 0), #fefefe), transparent url(<?php echo get_theme_mod('header_image', get_template_directory_uri() . '/img/header.jpg'); ?>) 0 0 no-repeat;
				background: -moz-linear-gradient(to bottom, rgba(254, 254, 254, 0), #fefefe), transparent url(<?php echo get_theme_mod('header_image', get_template_directory_uri() . '/img/header.jpg'); ?>) 0 0 no-repeat;
				background: -o-linear-gradient(to bottom, rgba(254, 254, 254, 0), #fefefe), transparent url(<?php echo get_theme_mod('header_image', get_template_directory_uri() . '/img/header.jpg'); ?>) 0 0 no-repeat;
				background: linear-gradient(to bottom, rgba(254, 254, 254, 0), #fefefe), transparent url(<?php echo get_theme_mod('header_image', get_template_directory_uri() . '/img/header.jpg'); ?>) 0 0 no-repeat;
			    background-size: cover;
				opacity: 0.25;
            }
            .main {
            	background:  <?php if (get_theme_mod('front_page_gradient')) : ?>-webkit-gradient(linear, to left, to right, color-stop(0%, rgba(46, 46, 46, 0.75)), color-stop(50%, rgba(80, 80, 80, 0.5)), color-stop(100%, rgba(46, 46, 46, 0.75))), <?php endif ?> transparent url(<?php echo get_theme_mod('header_image', get_template_directory_uri() . '/img/header.jpg'); ?>) 50% 50% no-repeat;
				background:  <?php if (get_theme_mod('front_page_gradient')) : ?>-webkit-linear-gradient(to left, rgba(46, 46, 46, 0.75), rgba(80, 80, 80, 0.5), rgba(46, 46, 46, 0.75)), <?php endif ?> transparent url(<?php echo get_theme_mod('header_image', get_template_directory_uri() . '/img/header.jpg'); ?>) 50% 50% no-repeat;
				background:  <?php if (get_theme_mod('front_page_gradient')) : ?>-moz-linear-gradient(to left, rgba(46, 46, 46, 0.75), rgba(80, 80, 80, 0.5), rgba(46, 46, 46, 0.75)), <?php endif ?>  transparent url(<?php echo get_theme_mod('header_image', get_template_directory_uri() . '/img/header.jpg'); ?>) 50% 50% no-repeat;
				background:  <?php if (get_theme_mod('front_page_gradient')) : ?>-o-linear-gradient(to left, rgba(46, 46, 46, 0.75), rgba(80, 80, 80, 0.5), rgba(46, 46, 46, 0.75)), <?php endif ?> transparent url(<?php echo get_theme_mod('header_image', get_template_directory_uri() . '/img/header.jpg'); ?>) 50% 50% no-repeat;
				background:  <?php if (get_theme_mod('front_page_gradient')) : ?>linear-gradient(to left, rgba(46, 46, 46, 0.75), rgba(80, 80, 80, 0.5), rgba(46, 46, 46, 0.75)), <?php endif ?>  transparent url(<?php echo get_theme_mod('header_image', get_template_directory_uri() . '/img/header.jpg'); ?>) 50% 50% no-repeat;
				background-size: cover;
            }
            <?php } ?>

         </style>
    <?php
}
add_action( 'wp_head', 'wp_bootstrapped_customize_css');

function wp_bootstrapped_customizer_live_preview() {
	wp_enqueue_script( 
		  'wp-bootstrapped-themecustomizer',			//Give the script an ID
		  get_template_directory_uri().'/js/theme-customize.js',//Point to file
		  array( 'jquery','customize-preview' ),	//Define dependencies
		  '',						//Define a version (optional) 
		  true						//Put script in footer?
	);
}
add_action( 'customize_preview_init', 'wp_bootstrapped_customizer_live_preview' );


/*
 * Loads our main stylesheet.
*/
function wp_bootstrapped_styles_scripts () {	
	wp_enqueue_style( 'wp-bootstrapped-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'wp_bootstrapped_styles_scripts' );



// Menu Classing
/**
 * Create a nav menu with very basic markup.
 *
 * @author Thomas Scholz http://toscho.de
 * @version 1.0
 */
class wp_bootstrapped_Walker_Nav_Menu extends Walker_Nav_Menu {
	/**
	 * Start the element output.
	 *
	 * @param  string $output Passed by reference. Used to append additional content.
	 * @param  object $item   Menu item data object.
	 * @param  int $depth     Depth of menu item. May be used for padding.
	 * @param  array $args    Additional strings.
	 * @return void
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$output     .= '<li';
		$attributes  = '';
		$caret = '';

		$parents = array();
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			foreach( $menu_items as $menu_item ) {
			  if( $menu_item->menu_item_parent != 0 )
			    $parents[] = $menu_item->menu_item_parent;
			}
		}

		if( in_array($item->ID, $parents ) ) {
			$attributes = 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"';
			$caret .= '<span class="caret"></span>';
			$menu_item_parent = true;
		}

		$output .= (($item->current || $menu_item_parent == true) ? ' class="' : '').($item->current ? 'active':'').($menu_item_parent == true ? ($args->theme_location == 'footer-menu'? 'dropup' : 'dropdown') : '').( ($item->current || $menu_item_parent == true) ? '"' : '').' >';

		! empty ( $item->attr_title )
			// Avoid redundant titles
			and $item->attr_title !== $item->title
			and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';

		! empty ( $item->url )
			and $attributes .= ($menu_item_parent == true ? ' href="#"' : ' href="' . esc_attr( $item->url ) .'"');

		$attributes  = trim( $attributes );
		$title       = apply_filters( 'the_title', $item->title, $item->ID ).$caret;
		$item_output = "$args->before<a $attributes>$args->link_before$title</a>"
						. "$args->link_after$args->after";

		// Since $output is called by reference we don't need to return anything.
		$output .= apply_filters(
			'walker_nav_menu_start_el'
			,   $item_output
			,   $item
			,   $depth
			,   $args
		);
	}

	/**
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	public function start_lvl(  &$output, $depth = 0, $args = array() )
	{
		$output .= '<ul class="dropdown-menu">';
	}

	/**
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	public function end_lvl(  &$output, $depth = 0, $args = array() )
	{
		$output .= '</ul>';
	}

	/**
	 * @see Walker::end_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return void
	 */
	function end_el( &$output, $object, $depth = 0, $args = array() ) {
		$output .= '</li>';
	}
}

// Menus
function register_wp_bootstrapped_menus() {
  register_nav_menus(
    array(
      'top-menu' => __( 'Top Menu' ),
      'sidebar-right-menu' => __( 'Right Sidebar Menu' ),
      'sidebar-left-menu' => __( 'Left Sidebar Menu' ),
      'footer-menu' => __( 'Footer Menu' ),
    )
  );
}
add_action( 'init', 'register_wp_bootstrapped_menus' );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * from Twenty Twelve 1.0
 */
function wp_bootstrapped_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
		$args['container_class'] = 'nav-collapse collapse';
		$args['menu_class'] = 'nav';
	return $args;
}
add_filter( 'wp_page_menu_args', 'wp_bootstrapped_page_menu_args' );

// Content Navigation Items

if ( ! function_exists( 'wp_bootstrapped_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function wp_bootstrapped_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'wp_bootstrapped' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Previous posts', 'wp_bootstrapped' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'wp_bootstrapped' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;


// Content Entry Meta Data
// from TwentyTwelve

if ( ! function_exists( 'wp_bootstrapped_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own wp_bootstrapped_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 */
function wp_bootstrapped_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'wp_bootstrapped' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'wp_bootstrapped' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'wp_bootstrapped' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( '<p>Posted in: %1$s <br />Tagged: %2$s <br />Date: %3$s <br />By: <span class="by-author">%4$s</span></p>', 'wp_bootstrapped' );
	} elseif ( $categories_list ) {
		$utility_text = __( '<p>Posted in: %1$s <br />Tagged: %2$s <br />Date: %3$s <br />By: <span class="by-author">%4$s</span></p>', 'wp_bootstrapped' );
	} else {
		$utility_text = __( '<p>Posted in: %1$s <br />Tagged: %2$s <br />Date: %3$s <br />By: <span class="by-author">%4$s</span></p>', 'wp_bootstrapped' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

// Hero, Sidebars, and Widgets
// The hero is more useful if one can choose any contents for 
// for rotating, so a sidebar area is set to handle the contents.
function wp_bootstrapped_widgets() {

	$panel_style = 'panel-'.get_theme_mod('front_page_panels');
	$panel_bg 	 = 'bg-'.get_theme_mod('front_page_panels');


	// 2 widget areas for right sidebars 
	register_sidebar( array(
		'name'          => __( 'Top Right Sidebar', 'wp_bootstrapped' ),
		'id'            => 'sidebar-1',
		'description'   => 'Contents used in page templates in the right sidebar section',
		'class'         => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="sidebar %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h1 class="sidebar-title">',
		'after_title'   => "</h1>\n",
	) );
	
	register_sidebar( array(
		'name'          => __( 'Bottom Right Sidebar', 'wp_bootstrapped' ),
		'id'            => 'sidebar-2',
		'description'   => 'Contents used in page templates in the right sidebar section',
		'class'         => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="sidebar %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h1 class="sidebar-title">',
		'after_title'   => "</h1>\n",
	) );

	// 2 widget areas for left sidebars 
	register_sidebar( array(
		'name'          => __( 'Top Left Sidebar', 'wp_bootstrapped' ),
		'id'            => 'sidebar-3',
		'description'   => 'Contents used in page templates for the left sidebar section',
		'class'         => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="sidebar %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h1 class="sidebar-title">',
		'after_title'   => "</h1>\n",
	) );
	
	register_sidebar( array(
		'name'          => __( 'Bottom Left Sidebar', 'wp_bootstrapped' ),
		'id'            => 'sidebar-4',
		'description'   => 'Contents used in page templates for the left sidebar section',
		'class'         => 'sidebar-4',
		'before_widget' => '<div id="%1$s" class="sidebar %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h1 class="sidebar-title">',
		'after_title'   => "</h1>\n",
	) );


	// 3 widget areas for above the footer
	register_sidebar( array(
		'name'          => __( 'First Footer Content Area' , 'wp_bootstrapped' ),
		'id'            => 'widget-1',
		'description'   => 'First panel used on Front/Home Page',
		'class'         => 'widget-1',
		'before_widget' => '<div id="%1$s" class="panel %2$s '.$panel_style.'"><div class="panel-body '.$panel_bg.'">',
		'after_widget'  => "</div>\n</div>\n",
		'before_title'  => '<h1 class="panel-title">',
		'after_title'   => "</h1>\n",
	) );

	register_sidebar( array(
		'name'          => __( 'Second Footer Content Area', 'wp_bootstrapped' ),
		'id'            => 'widget-2',
		'description'   => 'Second panel used on Front/Home Page',
		'class'         => 'widget-2',
		'before_widget' => '<div id="%1$s" class="panel %2$s '.$panel_style.'"><div class="panel-body '.$panel_bg.'">',
		'after_widget'  => "</div>\n</div>\n",
		'before_title'  => '<h1 class="panel-title">',
		'after_title'   => "</h1>\n",
	) );

	register_sidebar( array(
		'name'          => __( 'Third Footer Content Area', 'wp_bootstrapped' ),
		'id'            => 'widget-3',
		'description'   => 'Third panel used on Front/Home Page',
		'class'         => 'widget-3',
		'before_widget' => '<div id="%1$s" class="panel %2$s '.$panel_style.'"><div class="panel-body '.$panel_bg.'">',
		'after_widget'  => "</div>\n</div>\n",
		'before_title'  => '<h1 class="panel-title">',
		'after_title'   => "</h1>\n",
	) );
}

add_action( 'widgets_init', 'wp_bootstrapped_widgets' );

// Theme Dashboard

add_action('wp_dashboard_setup', 'wp_bootstrapped_dashboard_widgets');
function wp_bootstrapped_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}

function custom_dashboard_help() {
	echo '<p>Welcome to the Bootstrapped WordPress Theme!</p><p>The theme includes several helpful tools, incuding: <ul><li>Recent Posts with Category Filter (Shortcode & Widget)</li><li>Custom Navigation (Header, Footer, Left & Right Sidebar)</li><li>Custom Navigation Styling (fixed positons, 2 color options)</li><li>Customizable Images (Banner, Logo)</li><li>Customizable Banner and Background Image</li></ul></p><p>Learn more about Bootstrap at <a href="http://getbootstrap.com/" title="Open the Bootstrapped Homepage in a new window" target="_blank">http://getbootstrap.com/</a></p><p>Need help or customizations? Contact the developer <a href="mailto:jon@jonuday.com">here</a>.</p>.';
}



/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class wp_bootstrapped_Widget_Recent_Posts extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'wp_bootstrapped_widget_recent_posts', 'description' => __( "Your site&#8217;s most recent posts with category filter.") );
		parent::__construct('wp_bootstrapped_recent-posts', __('WPB Recent Posts'), $widget_ops);
		$this->alt_option_name = 'wp_bootstrapped_widget_recent_posts';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	public function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'wp_bootstrapped_widget_recent_posts', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		
		/*if ( is_category() ) { //adds the category parameter in the query if we display a category
 			$cat = get_queried_object();
 		}*/

 		$cat = isset( $instance['cat'] ) ? $instance['cat'] : '';


		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'category_name' => $cat // -> term_id
		) ) );

		if ($r->have_posts()) :

?>
		<?php echo $args['before_widget']; ?>
		<section>
			<?php if ( $title ) {
			echo $args['before_title'] . $title  . $args['after_title'];
			} ?>
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<article>
				<?php get_the_post_thumbnail( $page->ID, 'thumbnail' ); ?>
				<h1><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h1>
				<?php if ( $show_date ) : ?>
				<span class="post-date"><?php echo get_the_date(); ?></span>
				<?php endif; ?>
				<?php get_the_excerpt() ? the_excerpt() : print('no excerpt available'); ?>
			</article>
		<?php endwhile; ?>
		</section>
		<?php echo $args['after_widget']; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'wp_bootstrapped_widget_recent_posts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['wp_bootstrapped_widget_recent_posts']) )
			delete_option('wp_bootstrapped_widget_recent_posts');

		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete('wp_bootstrapped_widget_recent_posts', 'widget');
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$cat     = isset( $instance['cat'] ) ? esc_attr( $instance['cat'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Category:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" type="text" value="<?php echo $cat; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
	}
}

register_widget('wp_bootstrapped_Widget_Recent_Posts');

function wp_bootstrapped_Shortcode_Recent_Posts( $attributes ) {

	$a = shortcode_atts( array(
        'title' => null,
        'number' => 5,
        'show_date' => false,
        'category' => null,
    ), $attributes );

	/**
	 * Filter the arguments for the Recent Posts widget.
	 *
	 * @since 3.4.0
	 *
	 * @see WP_Query::get_posts()
	 *
	 * @param array $args An array of arguments used to retrieve the recent posts.
	 */
	$r = new WP_Query( apply_filters( 'shortcode_posts_args', array(
		'posts_per_page'      => $a['number'],
		'no_found_rows'       => true,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'category_name' 	  => $a['category'] // -> term_id
	) ) );

	ob_start();

	if ($r->have_posts()) :

		echo '<section>';
		echo $a['title'] ? '<h1>' . $a['title']  . '</h1>' : '';

		while ( $r->have_posts() ) : $r->the_post();  
			
			echo '<article class="row"><div class="col-sm-4">';
			echo get_the_post_thumbnail( $page->ID, 'thumbnail' );
			echo '</div><div class="col-sm-8"><h1><a href="';
			echo the_permalink();
			echo '">'; 
			echo get_the_title() ? the_title() : "no title found"; 
			echo '</a></h1>';
			print ($a['show_date'] == 'true' )? '<span class="post-date">' . get_the_date() . '</span>' : '';
			echo get_the_excerpt() ? the_excerpt() : 'no excerpt available';
			echo '</div></article>';
		
		endwhile;

		echo '</section>';

	endif;

	$content = ob_get_clean();
    
    return $content;

}

add_shortcode('wpb_recent_posts','wp_bootstrapped_Shortcode_Recent_Posts');


/*
*  Gallery Shortcode
*
*/

add_action( 'wp_enqueue_scripts', 'register_cycle2' );

function register_cycle2() {
	wp_register_script( 'script-name',  get_template_directory_uri() . '/js/jquery.cycle2.min.js', array(), '2.1.6', true );
}

function wp_bootstrapped_gallery( $attributes ) {

	$a = shortcode_atts( array(
        'title' => null,
        'number' => 5,
        'show_date' => false,
        'category' => null,
        'timeout' => '4000',
        'speed' => '1000',
        'pagers' => true,
        'fx' => 'fadeout',
    ), $attributes );

	/**
	 * Filter the arguments for the Recent Posts widget.
	 *
	 * @since 3.4.0
	 *
	 * @see WP_Query::get_posts()
	 *
	 * @param array $args An array of arguments used to retrieve the recent posts.
	 */
	$r = new WP_Query( apply_filters( 'shortcode_posts_args', array(
		'posts_per_page'      => $a['number'],
		'no_found_rows'       => true,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'category_name' 	  => $a['category'] // -> term_id
	) ) );

	ob_start();

	if ($r->have_posts()) :
		wp_enqueue_script( 'script-name' );

		echo '<section class="cycle-wrapper gallery">';
		echo $a['title'] ? '<h1>' . $a['title']  . '</h1>' : '';
		echo '<div class="cycle-slideshow" data-cycle-slides="> article" data-cycle-timeout="'.$a['timeout'].'" data-cycle-speed="'.$a['speed'].'" data-cycle-pause-on-hover="true" ';
		if ($a['pagers'] == true) { echo 'data-cycle-next="#next" data-cycle-prev="#prev"'; }
		echo ' data-cycle-fx=' . $a['fx'] . ' >';

		while ( $r->have_posts() ) : $r->the_post();  
			if (get_the_post_thumbnail( $page->ID, 'full' )) {
				echo '<article>';
				echo get_the_post_thumbnail( $page->ID, 'full' );
				echo '<div>';
				if ( get_the_title() ) { 
					echo  '<h1><a href="';
					echo the_permalink();
					echo '">';
					echo the_title();
					echo '</a></h1>'; 
				}
				print ($a['show_date'] == 'true' ) ? '<span class="post-date">' . get_the_date() . '</span>' : '';
				echo get_the_excerpt() ? the_excerpt() : '';
				echo '</div></article>';
			}
		endwhile;

		echo '</div>';

		if ($a['pagers'] == true) {
			echo '<div class="cycle-pagers"><a id="prev" alt="previous slide" href="#" ><i class="glyphicon glyphicon-chevron-left"></i></a> <a id="next" alt="next slide" href="#"><i class="glyphicon glyphicon-chevron-right"></i></a></div>';
		}
		echo '</section>';

	endif;

	$content = ob_get_clean();
    
    return $content;

    // add script to head

}

add_shortcode('wpb_gallery','wp_bootstrapped_gallery');


/**
 * Featured Content widget class
 *
 * @since 2.8.0
 */
class wp_bootstrapped_widget_featured_content extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'wp_bootstrapped_widget_featured_content', 'description' => __( "Select featured content using post or page ID.") );
		parent::__construct('wp_bootstrapped_widget_featured_content', __('WPB Featured Content'), $widget_ops);
		$this->alt_option_name = 'wp_bootstrapped_widget_featured_content';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	public function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'wp_bootstrapped_widget_featured_content', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		$id = isset( $instance['id'] ) ? absint($instance['id']) : 0;

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;


		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */

		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => 1,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => false,
			'page_id' => $id // -> post or page id
		) ) );

		if ($r->have_posts()) :

?>
		<?php echo $args['before_widget']; ?>
		<section>
			<?php if ( $title ) {
			echo $args['before_title'] . $title  . $args['after_title'];
			} ?>
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<article>
				<?php get_the_post_thumbnail( $page->ID, 'thumbnail' ); ?>
				<h1><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h1>
				<?php if ( $show_date ) : ?>
				<span class="post-date"><?php echo get_the_date(); ?></span>
				<?php endif; ?>
				<?php get_the_excerpt() ? the_excerpt() : print('no excerpt available'); ?>
			</article>
		<?php endwhile; ?>
		</section>
		<?php echo $args['after_widget']; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
		
		else:

			print '<section><article><h1>No content</h1><p>Either the content you selected is not published or there is no content matching the ID provided.</p></article></section>';

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'wp_bootstrapped_widget_featured_content', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['id'] = absint($new_instance['id']);
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['wp_bootstrapped_widget_featured_content']) )
			delete_option('wp_bootstrapped_widget_featured_content');

		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete('wp_bootstrapped_widget_featured_content', 'widget');
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$id    = isset( $instance['id'] ) ? absint( $instance['id'] ) : '';
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e( 'ID Number of post or page to show, limit 1:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" type="text" value="<?php echo $id; ?>" size="5" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
	}
}

register_widget('wp_bootstrapped_widget_featured_content');

/*
* Featured Content Shortcode
*/
function wp_bootstrapped_shortcode_featured_content( $attributes ) {

	$a = shortcode_atts( array(
        'title' => null,
        'show_date' => false,
        'id' => null,
    ), $attributes );

	/**
	 * Filter the arguments for the Recent Posts widget.
	 *
	 * @since 3.4.0
	 *
	 * @see WP_Query::get_posts()
	 *
	 * @param array $args An array of arguments used to retrieve the recent posts.
	 */
	$r = new WP_Query( apply_filters( 'shortcode_posts_args', array(
		'posts_per_page'      => 1,
		'no_found_rows'       => true,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => false,
		'p' 	  => $a['id'] // -> term_id
	) ) );

	ob_start();

	if ($r->have_posts()) :

		echo '<section>';
		echo $a['title'] ? '<h1>' . $a['title']  . '</h1>' : '';

		while ( $r->have_posts() ) : $r->the_post();  
			
			echo '<article class="row"><div class="col-sm-4">';
			echo get_the_post_thumbnail( $page->ID, 'thumbnail' );
			echo '</div><div class="col-sm-8"><h1><a href="';
			echo the_permalink();
			echo '">'; 
			echo get_the_title() ? the_title() : "no title found"; 
			echo '</a></h1>';
			print ($a['show_date'] == 'true' )? '<span class="post-date">' . get_the_date() . '</span>' : '';
			echo get_the_excerpt() ? the_excerpt() : 'no excerpt available';
			echo '</div></article>';
		
		endwhile;

		echo '</section>';

	endif;

	$content = ob_get_clean();
    
    return $content;

}

add_shortcode('wpb_featured_content','wp_bootstrapped_shortcode_featured_content');


function wpb_category_list() {
	$dropdown['all'] = 'All';

    $categories = get_categories(); // wp_list_categories(); // wp_dropdown_categories();

    foreach ($categories as $category) {
    	$k = $category->name;
    	$v = $category->name;
    	// $n = [$k]=$v;

    	$dropdown[$k]=$v;
    }

    return $dropdown;
}

