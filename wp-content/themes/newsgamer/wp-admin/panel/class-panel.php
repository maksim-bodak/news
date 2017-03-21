<?php
/**
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */

if ( ! class_exists( 'MipThemeFramework_Panel' ) ) {

    class MipThemeFramework_Panel {

        function __construct() {
            // add panel to the wp-admin menu
            add_action('admin_menu', array($this, 'register_theme_panel'));

        }


        /**
         * register our theme panel via the hook
         */
        function register_theme_panel() {

            add_theme_page('Theme Welcome', 'Theme Welcome', 'install_themes', 'miptheme_welcome' , array($this, "miptheme_view_welcome"));

        }

        function miptheme_view_welcome() {
            require_once (get_template_directory() . '/wp-admin/panel/miptheme_welcome.php');
        }


    }
    new MipThemeFramework_Panel();
}


function miptheme_after_theme_is_activated() {
    global $pagenow;
    if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
        wp_redirect(admin_url('themes.php?page=miptheme_welcome'));
        exit;
    }
}
miptheme_after_theme_is_activated();
