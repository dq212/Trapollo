<?php
add_action( 'wp_enqueue_scripts', 'appetite_child_enqueue_styles' );
function appetite_child_styles() {
    
    $parent_style = 'appetite-style';  //This is the name of the parent (Appetite) style naming

    wp_enqueue_style( $parent-style, get_template_directory_uri() . '/style.css' );

    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
 
}

?>