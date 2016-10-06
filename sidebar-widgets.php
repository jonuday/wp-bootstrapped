<?php
/**
 * The these widgets appear in the content area above the footer.
 *
 * @package WP_Bootstrapped
 * @subpackage WP_Bootstrapped
 * @since WordPress Bootstrapped 1.1.2
 *
**/

if ( is_active_sidebar( 'widget-1' ) || is_active_sidebar( 'widget-2' ) || is_active_sidebar( 'widget-3' )) : ?> 
    <?php $widgetCount = 0;
    if (is_active_sidebar( 'widget-1' )) {
            $widgetCount += 1;
        }
        if (is_active_sidebar( 'widget-2' )) {
            $widgetCount += 1;
        }
        if (is_active_sidebar( 'widget-3' )) {
            $widgetCount += 1;
        }
        // total possible columns is 12, so we divide 12 by our widget count to get
        // the span number
        $spanNumber = 12 / $widgetCount;

        if (get_theme_mod('front_page_panel_layout') == "rows") { 
    ?>

        <?php if ( is_active_sidebar( 'widget-1' )) { ?>
        <section class="row">
            <div class="container">
                <div class="widget-container col-sm-12">
                    <?php dynamic_sidebar( 'widget-1' ); ?>
                </div>
            </div>
        </section>
        <?php } ?>
            
        <?php if ( is_active_sidebar( 'widget-2' )) { ?>
        <section class="row">
            <div class="container">
                <div class="widget-container col-sm-12">                
                    <?php dynamic_sidebar( 'widget-2' ); ?>
                </div>
            </div>
        </section>
        <?php } ?>

        <?php if ( is_active_sidebar( 'widget-3' )) { ?>
        <section class="row">
            <div class="container">
                <div class="widget-container col-sm-12">
                
                    <?php dynamic_sidebar( 'widget-3' ); ?>
                </div>
            </div>
        </section>
        <?php } ?>

    <?php
        } else {

    ?>
    <div class="row panels">

        <div class="container<?php if ( get_theme_mod('nav_fixed') == 0 ) { echo '-fluid'; } ?>">         

            <?php if ( is_active_sidebar( 'widget-1' )) { ?>
            <div class="widget-container col-sm-<?php echo $spanNumber; ?>">
                
                    <?php dynamic_sidebar( 'widget-1' ); ?>
                
            </div>
            <?php } ?>
            
            <?php if ( is_active_sidebar( 'widget-2' )) { ?>
            <div class="widget-container col-sm-<?php echo $spanNumber; ?>">
                
                    <?php dynamic_sidebar( 'widget-2' ); ?>
                
            </div>
            <?php } ?>

            <?php if ( is_active_sidebar( 'widget-3' )) { ?>
            <div class="widget-container col-sm-<?php echo $spanNumber; ?>">
                
                    <?php dynamic_sidebar( 'widget-3' ); ?>
                
            </div>
            <?php } ?>
        </div>
    </div>
    <?php 
        } 

    endif; 
?>