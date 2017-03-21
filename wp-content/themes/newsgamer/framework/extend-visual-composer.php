<?php

if ( ! function_exists( 'miptheme_shortcodes_css_class' ) ) {
    function miptheme_shortcodes_css_class($class_string, $tag) {
        if ($tag=='vc_row' || $tag=='vc_row_inner') {
            $class_string = str_replace('vc_row-fluid', 'row-fluid', $class_string);
        }

        if ($tag=='vc_column' || $tag=='vc_column_inner') {
            $class_string = preg_replace('/vc_span(\d{1,2})/', 'col-md-$1', $class_string);
        }

        return $class_string;
    }
}

if (function_exists('vc_disable_frontend')) {
    vc_disable_frontend();
}

if (function_exists('vc_remove_element')) {
    //remove unused styles and visual composer scripts
    add_action( 'wp_print_scripts', 'miptheme_remove_visual_composer_assets', 100 );
}
//end delete code visual composer

function miptheme_remove_visual_composer_assets() {
    global $wp_styles;
    wp_deregister_style('js_composer_front');
}
