<?php
/**
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */

if ( ! class_exists( 'MipThemeFramework_Grid' ) ) {

    class MipThemeFramework_Grid {

        public $top_grid_enabled            = 0;
        public $top_grid_shortcode          = '';
        public $top_grid_layout             = '';
        public $top_grid_full_width         = '';
        public $top_grid_verge_style        = 0;
        public $top_grid_sort               = '';
        public $top_grid_tags               = '';
        public $top_grid_categories         = '';
        public $top_grid_posttypes          = '';
        public $top_grid_category_display   = '';
        public $top_grid_show_category      = 1;
        public $top_grid_show_date          = 1;
        public $top_grid_show_comments      = 1;
        public $top_grid_show_author        = 0;
        public $top_grid_show_views         = 0;

        public function __construct() {
            global $mipthemeoptions_framework;

            if (is_home()) {

                $this->top_grid_enabled             = isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_enable'])            ? $mipthemeoptions_framework['_mpgl_homepage_top_grid_enable']                   : 0;
                $this->top_grid_shortcode           = isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_shortcode'])         ? $mipthemeoptions_framework['_mpgl_homepage_top_grid_shortcode']                : '';
                $this->top_grid_layout              = isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_layout'])            ? $mipthemeoptions_framework['_mpgl_homepage_top_grid_layout']                   : '';
                $this->top_grid_full_width          = isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_full_width'])&&(bool) $mipthemeoptions_framework['_mpgl_homepage_top_grid_full_width']                ? ''                   : 'container';
                $this->top_grid_verge_style         = isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_verge_style'])&&(bool) $mipthemeoptions_framework['_mpgl_homepage_top_grid_verge_style']              ? ' verge-style'        : '';
                $this->top_grid_sort                = isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_sort'])              ? $mipthemeoptions_framework['_mpgl_homepage_top_grid_sort']                     : '';
                $this->top_grid_tags                = isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_tags'])              ? $mipthemeoptions_framework['_mpgl_homepage_top_grid_tags']                     : '';
                $this->top_grid_categories          = isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_categories'])        ? $mipthemeoptions_framework['_mpgl_homepage_top_grid_categories']               : '';
                $this->top_grid_posttypes           = isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_posttype'])        ? $mipthemeoptions_framework['_mpgl_homepage_top_grid_posttype']               : '';
                $this->top_grid_category_display    = isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_category_display'])  ? $mipthemeoptions_framework['_mpgl_homepage_top_grid_category_display']         : 'root';

                $this->top_grid_show_category       = ( isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_postmeta_elements']['category']) && $mipthemeoptions_framework['_mpgl_homepage_top_grid_postmeta_elements']['category'] )                     ? 1 : 0;
                $this->top_grid_show_date           = ( isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_postmeta_elements']['date']) && $mipthemeoptions_framework['_mpgl_homepage_top_grid_postmeta_elements']['date'] )                             ? 1 : 0;
                $this->top_grid_show_comments       = ( isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_postmeta_elements']['comments']) && $mipthemeoptions_framework['_mpgl_homepage_top_grid_postmeta_elements']['comments'] )                     ? 1 : 0;
                $this->top_grid_show_author         = ( isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_postmeta_elements']['author']) && $mipthemeoptions_framework['_mpgl_homepage_top_grid_postmeta_elements']['author'] )                         ? 1 : 0;
                $this->top_grid_show_views          = ( isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_postmeta_elements']['views']) && $mipthemeoptions_framework['_mpgl_homepage_top_grid_postmeta_elements']['views'] )                           ? 1 : 0;

            } else if (is_category()) {

                $this->top_grid_enabled             = isset($mipthemeoptions_framework['_mpgl_cat_top_grid_enable'])            ? $mipthemeoptions_framework['_mpgl_cat_top_grid_enable']                   : 0;
                $this->top_grid_shortcode           = isset($mipthemeoptions_framework['_mpgl_cat_top_grid_shortcode'])         ? $mipthemeoptions_framework['_mpgl_cat_top_grid_shortcode']                : '';
                $this->top_grid_layout              = isset($mipthemeoptions_framework['_mpgl_cat_top_grid_layout'])            ? $mipthemeoptions_framework['_mpgl_cat_top_grid_layout']                   : '';
                $this->top_grid_full_width          = 'container';
                $this->top_grid_verge_style         = isset($mipthemeoptions_framework['_mpgl_cat_top_grid_verge_style'])&&(bool) $mipthemeoptions_framework['_mpgl_cat_top_grid_verge_style']              ? ' verge-style'        : '';
                $this->top_grid_categories          = array(get_query_var('cat'));

                $this->top_grid_show_category       = ( isset($mipthemeoptions_framework['_mpgl_cat_top_grid_postmeta_elements']['category']) && $mipthemeoptions_framework['_mpgl_cat_top_grid_postmeta_elements']['category'] )                     ? 1 : 0;
                $this->top_grid_show_date           = ( isset($mipthemeoptions_framework['_mpgl_cat_top_grid_postmeta_elements']['date']) && $mipthemeoptions_framework['_mpgl_cat_top_grid_postmeta_elements']['date'] )                             ? 1 : 0;
                $this->top_grid_show_comments       = ( isset($mipthemeoptions_framework['_mpgl_cat_top_grid_postmeta_elements']['comments']) && $mipthemeoptions_framework['_mpgl_cat_top_grid_postmeta_elements']['comments'] )                     ? 1 : 0;
                $this->top_grid_show_author         = ( isset($mipthemeoptions_framework['_mpgl_cat_top_grid_postmeta_elements']['author']) && $mipthemeoptions_framework['_mpgl_cat_top_grid_postmeta_elements']['author'] )                         ? 1 : 0;
                $this->top_grid_show_views          = ( isset($mipthemeoptions_framework['_mpgl_cat_top_grid_postmeta_elements']['views']) && $mipthemeoptions_framework['_mpgl_cat_top_grid_postmeta_elements']['views'] )                           ? 1 : 0;

            } else if (is_page()) {
                global $post;

                $this->top_grid_enabled             = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_enable')              ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_enable')              : 0;
                $this->top_grid_shortcode           = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_shortcode')           ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_shortcode')           : '';
                $this->top_grid_layout              = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_layout')              ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_layout')              : 'top-grid-layout-1';
                $this->top_grid_full_width          = (MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_full_width') == 'on' ) ? ''                                                                                                                                           : 'container';
                $this->top_grid_verge_style         = (MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_verge_style') == 'on' ) ? ' verge-style'                                                                                                                              : '';
                $this->top_grid_sort                = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_sort')                ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_sort')                : '';
                $this->top_grid_tags                = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_tags')                ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_tags')                : '';
                $this->top_grid_categories          = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_categories')          ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_categories')          : '';
                $this->top_grid_posttypes           = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_posttype')            ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_posttype')          : '';
                $this->top_grid_category_display    = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_category_display')    ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_category_display')    : 'root';

                $page_top_grid_postmeta_elements    = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_postmeta_elements');
                $this->top_grid_show_category       = ( isset($page_top_grid_postmeta_elements['category']) && $page_top_grid_postmeta_elements['category'] )                     ? 1 : 0;
                $this->top_grid_show_date           = ( isset($page_top_grid_postmeta_elements['date']) && $page_top_grid_postmeta_elements['date'] )                             ? 1 : 0;
                $this->top_grid_show_comments       = ( isset($page_top_grid_postmeta_elements['comments']) && $page_top_grid_postmeta_elements['comments'] )                     ? 1 : 0;
                $this->top_grid_show_author         = ( isset($page_top_grid_postmeta_elements['author']) && $page_top_grid_postmeta_elements['author'] )                         ? 1 : 0;
                $this->top_grid_show_views          = ( isset($page_top_grid_postmeta_elements['views']) && $page_top_grid_postmeta_elements['views'] )                           ? 1 : 0;

            }

        }


        public static function add_custom_body_class($classes) {
            global $mipthemeoptions_framework;
            if (is_home()) {
                $classes[] = (isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_enable']) && (bool)$mipthemeoptions_framework['_mpgl_homepage_top_grid_enable'] && isset($mipthemeoptions_framework['_mpgl_homepage_top_grid_layout']))            ? 'has-top-grid '. $mipthemeoptions_framework['_mpgl_homepage_top_grid_layout']    : '';
            }
            if (is_category()) {
                $classes[] = (isset($mipthemeoptions_framework['_mpgl_cat_top_grid_enable']) && (bool)$mipthemeoptions_framework['_mpgl_cat_top_grid_enable'] && isset($mipthemeoptions_framework['_mpgl_cat_top_grid_layout']))            ? 'has-top-grid '. $mipthemeoptions_framework['_mpgl_cat_top_grid_layout']    : '';
            }
            if (is_page()) {
                global $post;
                $classes[] = (MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_enable'))            ? 'has-top-grid '. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_page_top_grid_layout')     : '';
            }
        	return $classes;
        }




        public function get_posts_per_page() {
            switch($this->top_grid_layout) {
                case 'top-grid-layout-1':
                    return 5;
                break;
                case 'top-grid-layout-2':
                    return 5;
                break;
                case 'top-grid-layout-3':
                    return 8;
                break;
                case 'top-grid-layout-4':
                    return 5;
                break;
                case 'top-grid-layout-5':
                    return 7;
                break;
                case 'top-grid-layout-6':
                    return 2;
                break;
                case 'top-grid-layout-7':
                    return 3;
                break;
                case 'top-grid-layout-8':
                    return 4;
                break;
                case 'top-grid-layout-9':
                    return 1;
                break;
                case 'top-grid-layout-10':
                    return 2;
                break;
                case 'top-grid-layout-11':
                    return 4;
                break;
                case 'top-grid-layout-12':
                    return 4;
                break;
            }
        }


        static function grid_layout_offset( $top_grid_layout = 'top-grid-layout-1' ) {
            switch($top_grid_layout) {
                case 'top-grid-layout-1':
                    return 5;
                break;
                case 'top-grid-layout-2':
                    return 5;
                break;
                case 'top-grid-layout-3':
                    return 8;
                break;
                case 'top-grid-layout-4':
                    return 5;
                break;
                case 'top-grid-layout-5':
                    return 7;
                break;
                case 'top-grid-layout-6':
                    return 2;
                break;
                case 'top-grid-layout-7':
                    return 3;
                break;
                case 'top-grid-layout-8':
                    return 4;
                break;
                case 'top-grid-layout-9':
                    return 1;
                break;
                case 'top-grid-layout-10':
                    return 2;
                break;
                case 'top-grid-layout-11':
                    return 4;
                break;
                case 'top-grid-layout-12':
                    return 4;
                break;
            }
        }

    }
    add_filter('body_class', 'MipThemeFramework_Grid::add_custom_body_class');

}
