<?php
/**
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */

if ( ! function_exists( 'mipthemeframework_scripts' ) ) {
    function mipthemeframework_scripts() {
        global $mipthemeoptions_framework;

        if ( isset($mipthemeoptions_framework['_mp_minify_css_js'])&&(bool)$mipthemeoptions_framework['_mp_minify_css_js'] ) {
            // Load stylesheets
            wp_enqueue_style( 'miptheme-external-styles', get_template_directory_uri() . '/assets/css/miptheme.all.min.css', '', MIPTHEMEFRAMEWORK_THEMEVERSION, 'all' );
            // Load scripts
            wp_enqueue_script( 'miptheme-functions', get_template_directory_uri() . '/assets/js/miptheme.all.min.js', array( 'jquery' ), MIPTHEMEFRAMEWORK_THEMEVERSION, true );
        } else {
            // Load stylesheets
            wp_enqueue_style( 'miptheme-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', '', MIPTHEMEFRAMEWORK_THEMEVERSION, 'all' );
            wp_enqueue_style( 'miptheme-external-styles', get_template_directory_uri() . '/assets/css/mip.external.css', '', MIPTHEMEFRAMEWORK_THEMEVERSION, 'all' );

            // Load our main stylesheet.
            wp_enqueue_style( 'miptheme-style', get_stylesheet_uri(), '', MIPTHEMEFRAMEWORK_THEMEVERSION, 'all' );
            wp_enqueue_style( 'miptheme-style-responsive', get_template_directory_uri() . '/assets/css/media-queries.css', '', MIPTHEMEFRAMEWORK_THEMEVERSION, 'all' );

            // Load scripts
            wp_enqueue_script( 'miptheme-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), MIPTHEMEFRAMEWORK_THEMEVERSION, true );
            wp_enqueue_script( 'miptheme-external', get_template_directory_uri() . '/assets/js/mip.external.min.js', array( 'jquery' ), MIPTHEMEFRAMEWORK_THEMEVERSION, true );
            wp_enqueue_script( 'miptheme-functions', get_template_directory_uri() . '/assets/js/functions.js', array( 'jquery' ), MIPTHEMEFRAMEWORK_THEMEVERSION, true );
        }

        // Load Dynamic CSS
        wp_enqueue_style( 'miptheme-dynamic-css', get_stylesheet_directory_uri() . '/assets/css/dynamic.css', '', filemtime(get_stylesheet_directory() . '/assets/css/dynamic.css'), 'all');
        wp_enqueue_style( 'typography-css', get_stylesheet_directory_uri() . '/assets/css/typography.css', '', filemtime(get_stylesheet_directory() . '/assets/css/typography.css'), 'all');

        // Load the Internet Explorer specific stylesheet.
        wp_enqueue_style( 'miptheme-photobox-ie', get_template_directory_uri() . '/assets/css/photobox.ie.css', '', MIPTHEMEFRAMEWORK_THEMEVERSION, 'all' );
        wp_style_add_data( 'miptheme-photobox-ie', 'conditional', 'lt IE 9' );

        // Load js scripts
        if ( !is_admin() && isset($mipthemeoptions_framework['_mp_js_jquery_footer']) && (bool)$mipthemeoptions_framework['_mp_js_jquery_footer'] ) {
            wp_deregister_script('jquery');
            wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', false, '1.11.1', true);
            wp_enqueue_script('jquery');
        }

        // Ajax pagination
        wp_localize_script( 'miptheme-functions', 'miptheme_ajax_url', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        ));

    }
}


if ( ! function_exists( 'miptheme_dynamic_css' ) ) {
    function miptheme_dynamic_css() {
        require(get_template_directory().'/assets/css/dynamic.css.php');
        exit;
    }
}

if ( ! function_exists( 'mipthemeframework_admin_css' ) ) {
    function mipthemeframework_admin_css() {
        wp_enqueue_style('miptheme-admin-css', get_template_directory_uri() . '/wp-admin/css/admin.css', false, MIPTHEMEFRAMEWORK_THEMEVERSION, 'all' );
        wp_enqueue_script('miptheme-admin-js', get_template_directory_uri() . '/wp-admin/js/admin.js', false, MIPTHEMEFRAMEWORK_THEMEVERSION, 'all' );
    }
}

if ( ! function_exists( 'mipthemeframework_add_editor_styles' ) ) {
    function mipthemeframework_add_editor_styles() {
        add_editor_style( get_template_directory_uri() . '/wp-admin/css/editor-style.css');
    }
}

// google analytics
if ( ! function_exists( 'mipthemeframework_analytics_code' ) ) {
    function mipthemeframework_analytics_code() {
        global $mipthemeoptions_framework;
        if ( isset($mipthemeoptions_framework['_mp_ga_code']) ) echo '<script>'. stripslashes( $mipthemeoptions_framework['_mp_ga_code'] ) .'</script>';
    }
}

// custom js header
if ( ! function_exists( 'mipthemeframework_custom_js_code_header' ) ) {
    function mipthemeframework_custom_js_code_header() {
        global $mipthemeoptions_framework;
        if ( isset($mipthemeoptions_framework['_mp_js_code_header']) ) echo '<script>'. stripslashes( $mipthemeoptions_framework['_mp_js_code_header'] ) .'</script>';
    }
}

// custom js
if ( ! function_exists( 'mipthemeframework_custom_js_code' ) ) {
    function mipthemeframework_custom_js_code() {
        global $mipthemeoptions_framework;
        if ( isset($mipthemeoptions_framework['_mp_js_code']) ) echo '<script>'. stripslashes( $mipthemeoptions_framework['_mp_js_code'] ) .'</script>';
    }
}
