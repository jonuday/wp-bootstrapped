// Custom CSS

// Responsive images require the width and height of the images that
// Wordpress puts in to be removed

jQuery(document).ready( function ($) {  
    $('img').each( function () {  
        $(this).removeAttr( 'width' );  
        $(this).removeAttr( 'height' );  
    });  
});  