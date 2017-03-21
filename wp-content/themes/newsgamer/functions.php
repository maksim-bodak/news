<?php
/**
 * NewsGamer Theme
 *
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */

# Constants
define('MIPTHEMEFRAMEWORK_THEMENAME',           'Newsgamer');
define('MIPTHEMEFRAMEWORK_THEMEPANEL',          'NewsGamer Theme');
define('MIPTHEMEFRAMEWORK_THEMEREDUXNAME', 	    'miptheme');
define('MIPTHEMEFRAMEWORK_THEMEVERSION', 	    '1.8.5');


add_action('after_switch_theme', 'mipthemeframework_theme_activated');
if ( ! function_exists( 'mipthemeframework_theme_activated' ) ) {
    function mipthemeframework_theme_activated() {
        mipthemeframework_set_css_file( '_miptheme_dynamic_css', 'dynamic.css' );
        mipthemeframework_set_css_file( '_miptheme_typography_css', 'typography.css' );
    }
}


add_action( 'after_setup_theme', 'mipthemeframework_theme_setup' );
if ( ! function_exists( 'mipthemeframework_theme_setup' ) ) {
    function mipthemeframework_theme_setup() {

        global $mipthemeoptions_framework, $mipthemeoptions_typo, $content_width;

        # Theme Support
        add_theme_support('menus');
        add_theme_support('widgets');
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support('featured-image');
        add_theme_support('post-formats', array( 'gallery', 'video', 'quote', 'audio', 'image' ) );
        add_theme_support('custom-background', array('default-color'   => '#ffffff') );
        add_theme_support('title-tag');
        add_theme_support('custom-header');
        add_theme_support('woocommerce');

        # Theme Textdomain
        load_theme_textdomain(MIPTHEMEFRAMEWORK_THEMENAME, get_template_directory() . '/languages');


        # Enqueue scripts and styles for back the front end
        add_action('wp_enqueue_scripts', 'mipthemeframework_scripts');
        add_action('wp_update_nav_menu', 'mipthemeframework_generate_options_css');
        add_action('redux/options/mipthemeoptions_framework/saved', 'mipthemeframework_generate_options_css');
        add_action('redux/options/mipthemeoptions_framework/saved', 'mipthemeframework_set_option_sidebars');
        add_action('redux/options/mipthemeoptions_typo/saved', 'mipthemeframework_generate_options_css');
        add_action('admin_enqueue_scripts', 'mipthemeframework_admin_css');
        add_action('admin_init', 'mipthemeframework_add_editor_styles');
        add_action('wp_head', 'mipthemeframework_analytics_code', 40);
        add_action('wp_head', 'mipthemeframework_custom_js_code_header', 40);
        add_action('wp_footer', 'mipthemeframework_custom_js_code', 40);
        add_action('admin_menu', 'mipthemeframework_remove_redux_menu', 12 );

        # add custom body class
        add_filter('body_class', 'mipthemeframework_add_custom_body_class');


        # Administrative Functions
        if (is_admin()) {
            // add custom functionalities
            require_once(get_template_directory() . '/wp-admin/tinymce/tinymce.php');
        }


        # Redux framework
        if ( class_exists( 'Redux' ) ) {

            require_once(get_template_directory() . '/framework/redux-options.php');
            require_once(get_template_directory() . '/framework/redux-typography.php');

            # Init Redux
            Redux::init('mipthemeoptions_framework');
            //Redux::init('mipthemeoptions_typo');

        }


        # Extending user profile
        add_filter('user_contactmethods', 'mipthemeframework_modify_contact_methods');


        # Extending categories with colorpicker
        add_action('category_add_form_fields', 'mipthemeframework_category_form_custom_field_add', 10 );
        add_action('category_edit_form_fields','mipthemeframework_extra_category_fields', 10);
        add_action('edited_category', 'mipthemeframework_save_extra_category_fileds');
        add_action('created_category', 'mipthemeframework_save_extra_category_fileds', 11, 1);
        add_action('edited_category', 'mipthemeframework_generate_options_css');
        add_action('created_category', 'mipthemeframework_generate_options_css', 11, 1);
        add_action('admin_enqueue_scripts', 'mipthemeframework_colorpicker_enqueue' );


        # Extending menus with walker class
        add_action('wp_update_nav_menu_item', 'mipthemeframework_custom_nav_update',10, 3);
        add_filter('wp_setup_nav_menu_item','mipthemeframework_custom_nav_item' );
        add_filter('wp_edit_nav_menu_walker', 'mipthemeframework_custom_nav_edit_walker',10,2 );
        add_filter('nav_menu_css_class', 'mipthemeframework_wpa_category_nav_class', 10, 2 );


        # Register Thumbnail Sizes
        add_image_size('miptheme-post-cover', 1340, 600, true);
        add_image_size('miptheme-post-thumb-1', 940, 560, true);
        add_image_size('miptheme-post-thumb-2', 890, 606, true);
        add_image_size('miptheme-post-thumb-3', 577, 394, true);
        add_image_size('miptheme-post-thumb-4', 470, 320, true);
        add_image_size('miptheme-post-thumb-5', 350, 245, true);
        add_image_size('miptheme-post-thumb-6', 277, 190, true);
        add_image_size('miptheme-post-thumb-7', 176, 120, true);


        # Register Menus
        register_nav_menus(
            array(
                'mobile-menu'   => esc_html__( 'Mobile Menu', 'mip-theme' ),
                'top-menu'      => esc_html__( 'Top Menu', 'mip-theme' ),
                'header-menu'   => esc_html__( 'Header Menu (Primary Navigation)', 'mip-theme' ),
            )
        );


        # Filter to Replace default css class for vc_row shortcode and vc_column
        add_filter('vc_shortcodes_css_class', 'miptheme_shortcodes_css_class', 10, 2);

        # Force Visual Composer to initialize as "built into the theme"
        if (function_exists('vc_set_as_theme')) {
            vc_set_as_theme();
        }

        # Jetpack galleries fix
        if ( ! isset( $content_width ) ) $content_width = 890;


        # Date variables
        define('MIPTHEME_DATE_HEADER',          ( (isset( $mipthemeoptions_framework['_mp_dateformat_header'] ))        ? $mipthemeoptions_framework['_mp_dateformat_header']       : 'F jS, Y' ) );
        define('MIPTHEME_DATE_DEFAULT',         ( (isset( $mipthemeoptions_framework['_mp_dateformat_default'] ))       ? $mipthemeoptions_framework['_mp_dateformat_default']      : 'F jS, Y' ) );
        define('MIPTHEME_DATE_DEFAULT_SHORT',   ( (isset( $mipthemeoptions_framework['_mp_short_dateformat_default'] )) ? $mipthemeoptions_framework['_mp_short_dateformat_default']: 'M jS, Y' ) );
        define('MIPTHEME_TIME_DEFAULT',         ( (isset( $mipthemeoptions_framework['_mp_timeformat_default'] ))       ? $mipthemeoptions_framework['_mp_timeformat_default']      : 'g:i A' ) );
        define('MIPTHEME_DATE_SIDEBAR',         ( (isset( $mipthemeoptions_framework['_mp_dateformat_sidebar'] ))       ? $mipthemeoptions_framework['_mp_dateformat_sidebar']      : 'M jS, Y' ) );
        define('MIPTHEME_DATE_TIMELINE',        ( (isset( $mipthemeoptions_framework['_mp_dateformat_timeline'] ))      ? $mipthemeoptions_framework['_mp_dateformat_timeline']     : 'M jS' ) );


        # WooCommerce
        if (function_exists('is_woocommerce') && is_woocommerce()) {
            add_action( 'after_switch_theme', 'mipthemeframework_woocommerce_image_dimensions', 1 );
            add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
                function jk_related_products_args( $args ) {

                $args['posts_per_page'] = 4; // 4 related products
                $args['columns'] = 4; // arranged in 2 columns
                return $args;
            }
        }


        # Ajax Paging
        add_action( 'wp_ajax_nopriv_miptheme_ajax_blocks', 'MipThemeFramework_Ajax::mipthemeAjaxBlock' );
        add_action( 'wp_ajax_miptheme_ajax_blocks', 'MipThemeFramework_Ajax::mipthemeAjaxBlock' );

        # Pre get posts for paging
        add_action( 'pre_get_posts', 'mipthemeframework_pre_get_posts' );

        # Disable Emoji
        if ( isset($mipthemeoptions_framework['_mp_disable_emoji_icons'])&&(bool)$mipthemeoptions_framework['_mp_disable_emoji_icons'] ) {
            remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
            remove_action( 'wp_print_styles', 'print_emoji_styles' );
        }

    }
}


# ---------------------------------------------------------

# Enqueue scripts and styles for the front end
require_once(get_template_directory() . '/framework/enqueue-scripts.php');


# ---------------------------------------------------------

// redux framework - custom actions
if ( ! function_exists( 'mipthemeframework_removeReduxDemoMode' ) ) {
    function mipthemeframework_removeReduxDemoMode() {
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
        }
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
        }
    }
}

// remove redux menu under the tools
if ( ! function_exists( 'mipthemeframework_remove_redux_menu' ) ) {
    function mipthemeframework_remove_redux_menu() {
        remove_submenu_page('tools.php','redux-about');
    }
}

# ---------------------------------------------------------

# Pre get posts for paging
if ( ! function_exists( 'mipthemeframework_pre_get_posts' ) ) {
    function mipthemeframework_pre_get_posts( $query ) {
        global $mipthemeoptions_framework;

        // check category
        if ( is_category() && $query->is_main_query() ) {
            $curr_cat_id    = 0;

            if ( get_query_var('cat') && ( get_query_var('cat') != '' )) {
                $curr_cat_id                = get_query_var('cat');
            } else {
                $catObj         = get_category_by_slug(get_query_var('category_name'));
                if ($catObj) $curr_cat_id    = $catObj->term_id;
            }

            $curr_parent_id             = $curr_cat_id; // default: set to this cat
            $curr_cat_obj               = get_category($curr_cat_id);

            // check for root category
            if ( ($curr_cat_id != 0) && ($curr_cat_obj->category_parent != 0) ) {
                $cat_temp_id  = $curr_cat_id;
                $cat_temp_obj = $curr_cat_obj;
                while ($cat_temp_id) {
                    $cat            = get_category($cat_temp_id); // get the object for the catid
                    $cat_temp_id    = $cat->category_parent; // assign parent ID (if exists) to $cat_temp_id
                    if ( isset($mipthemeoptions_framework['_mpgl_cat_'. $cat_temp_id .'_set_for_children']) && (bool)$mipthemeoptions_framework['_mpgl_cat_'. $cat_temp_id .'_set_for_children'] ) {
                        $curr_parent_id = $cat_temp_id;
                    }
                }
            }

            $page_show_posts_num        = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_posts_number']) && ($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_posts_number'] > 0) ) ? $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_posts_number'] : (isset($mipthemeoptions_framework['_mpgl_cat_posts_number']) ? $mipthemeoptions_framework['_mpgl_cat_posts_number'] : '');
            if ( isset($page_show_posts_num) && ($page_show_posts_num > 0) ) {
                // Modify posts per page
                $query->set( 'posts_per_page', $page_show_posts_num );
            }


            if ( isset($mipthemeoptions_framework['_mpgl_cat_top_grid_enable'])&&($mipthemeoptions_framework['_mpgl_cat_top_grid_enable'] == 1) ) {
                $cat_grid_layout    = isset($mipthemeoptions_framework['_mpgl_cat_top_grid_layout']) ? $mipthemeoptions_framework['_mpgl_cat_top_grid_layout'] : 'top-grid-layout-1';
                $query->set( 'offset', MipThemeFramework_Grid::grid_layout_offset($cat_grid_layout) );
            }

        }

        // check home
        if ( is_home() && $query->is_main_query() ) {
            $page_show_posts_num            = isset($mipthemeoptions_framework['_mpgl_homepage_posts_number']) ? $mipthemeoptions_framework['_mpgl_homepage_posts_number'] : 0;

            if ( isset($page_show_posts_num) && ($page_show_posts_num > 0) ) {
                // Modify posts per page
                $query->set( 'posts_per_page', $page_show_posts_num );
            }
        }

        // check tag
        if ( is_tag() && $query->is_main_query() ) {
            $page_show_posts_num            = isset($mipthemeoptions_framework['_mpgl_tagpage_posts_number']) ? $mipthemeoptions_framework['_mpgl_tagpage_posts_number'] : 0;

            if ( isset($page_show_posts_num) && ($page_show_posts_num > 0) ) {
                // Modify posts per page
                $query->set( 'posts_per_page', $page_show_posts_num );
            }
        }

        // check author
        if ( is_author() && $query->is_main_query() ) {
            $page_show_posts_num            = isset($mipthemeoptions_framework['_mpgl_authorpage_posts_number']) ? $mipthemeoptions_framework['_mpgl_authorpage_posts_number'] : 0;

            if ( isset($page_show_posts_num) && ($page_show_posts_num > 0) ) {
                // Modify posts per page
                $query->set( 'posts_per_page', $page_show_posts_num );
            }
        }

        // check archive
        if ( is_archive() && $query->is_main_query() ) {
            $page_show_posts_num            = isset($mipthemeoptions_framework['_mpgl_archivepage_posts_number']) ? $mipthemeoptions_framework['_mpgl_archivepage_posts_number'] : 0;

            if ( isset($page_show_posts_num) && ($page_show_posts_num > 0) ) {
                // Modify posts per page
                $query->set( 'posts_per_page', $page_show_posts_num );
            }
        }

        //we remove the actions hooked on the '__after_loop' (post navigation)
        remove_all_actions ( '__after_loop');

    }
}

# ---------------------------------------------------------

# OTF Regenerate Thumbnails
require_once(get_template_directory() . '/framework/external/otf_regen_thumbs.php');

# ---------------------------------------------------------

# Extending user profile
require_once(get_template_directory() . '/framework/extend-user-profile.php');

# ---------------------------------------------------------

# Extending categories with colorpicker
require_once(get_template_directory() . '/framework/extend-category.php');

# ---------------------------------------------------------

# Extending menus with walker class
require_once(get_template_directory() . '/framework/extend-menus.php');

# ---------------------------------------------------------

# Load Global Functions - Utils - Widgets
require_once(get_template_directory() . '/wp-admin/panel/class-panel.php');
require_once(get_template_directory() . '/framework/global-functions.php');
require_once(get_template_directory() . '/framework/class-widgets.php');
require_once(get_template_directory() . '/framework/class-page.php');
require_once(get_template_directory() . '/framework/class-grid.php');
require_once(get_template_directory() . '/framework/class-util.php');
require_once(get_template_directory() . '/framework/class-posts-views.php');
require_once(get_template_directory() . '/framework/class-article.php');
require_once(get_template_directory() . '/framework/class-ad.php');
require_once(get_template_directory() . '/framework/class-gallery.php');
require_once(get_template_directory() . '/framework/class-video.php');
require_once(get_template_directory() . '/framework/class-image.php');
require_once(get_template_directory() . '/framework/breadcrumbs/breadcrumbs-plus.php');
require_once(get_template_directory() . '/framework/class-ajax.php');
require_once(get_template_directory() . '/framework/class-unique-posts.php');
require_once(get_template_directory() . '/framework/class-thumbnailer.php');

# ---------------------------------------------------------

# Extending comments with walker class
require_once(get_template_directory() . '/framework/extend-comments.php');

# ---------------------------------------------------------

# Extend Visual Composer
require_once(get_template_directory() . '/framework/extend-visual-composer.php');

# ---------------------------------------------------------

# Load Plugin Activation
require_once(get_template_directory() . '/framework/tgm-required-plugin-activation-load.php');

# ---------------------------------------------------------

# WooCommerce Support
require_once(get_template_directory() . '/framework/extend-woocommerce.php');
