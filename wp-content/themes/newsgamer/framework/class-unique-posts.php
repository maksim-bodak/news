<?php
/**
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */

if ( ! class_exists( 'MipThemeFramework_UniquePosts' ) ) {

    class MipThemeFramework_UniquePosts {

        protected static $carousel_index    = 1;
        static $unique_posts_ids            = array();  // collect all rendered posts
        static $unique_posts_enabled        = false;    // set unique posts on custom page


        static function miptheme_unique_posts_init() {
            add_filter('miptheme_unique_posts_after_header', array(__CLASS__, 'hook_miptheme_unique_posts_after_header'));
            add_filter('miptheme_unique_posts_filter', array(__CLASS__, 'hook_miptheme_unique_posts'), 5, 2);
        }


        static function hook_miptheme_unique_posts($post) {
            if ( (bool)self::$unique_posts_enabled ) {
                self::$unique_posts_ids[] = $post->ID;
            }
        }


        static function hook_miptheme_unique_posts_after_header() {
            $page_id = get_queried_object_id();
            if (is_page()) {
                $unique_articles    = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $page_id, '_mpgl_page_unique_articles');
                if ( $unique_articles ) {
                    self::$unique_posts_enabled = true;
                }
            }
            if (is_home()) {
                global $mipthemeoptions_framework;
                $unique_articles    = isset($mipthemeoptions_framework['_mpgl_homepage_unique_posts']) ? $mipthemeoptions_framework['_mpgl_homepage_unique_posts'] : 0;
                if ( $unique_articles ) {
                    self::$unique_posts_enabled = true;
                }
            }
            if (is_category()) {
                self::$unique_posts_enabled = true;
            }
        }

    }

}

MipThemeFramework_UniquePosts::miptheme_unique_posts_init();
