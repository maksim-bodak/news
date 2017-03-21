<?php
/**
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */

if ( ! class_exists( 'MipThemeFramework_Util' ) ) {

    class MipThemeFramework_Util {

        protected static $carousel_index    = 1;

        static function read_theme_settings() {
            MipThemeFramework_Global::$mp_options = get_option(THEMEOPTIONSNAME);
        }


        // get a theme meta value from wp
        static function get_meta($option_name, $object_id, $default_value = '') {
            if (get_post_meta( $object_id, $option_name, true )) {
                return get_post_meta( $object_id, $option_name, true );
            } else {
                if (!empty($default_value)) {
                    return $default_value;
                } else {
                    return;
                }
            }
        }


        // redux values
        static function miptheme_check_redux_value( $meta_value ) {
            global $mipthemeoptions_framework;
            if ( isset($mipthemeoptions_framework[ $meta_value ])&&(bool)$mipthemeoptions_framework[ $meta_value ] ) {
                return true;
            }
            else {
                return false;
            }
        }

        static function miptheme_return_redux_value( $meta_value ) {
            global $mipthemeoptions_framework;
            if ( isset($mipthemeoptions_framework[ $meta_value ])&&(bool)$mipthemeoptions_framework[ $meta_value ] ) {
                return $mipthemeoptions_framework[ $meta_value ];
            }
        }

        static function miptheme_check_redux_post_meta( $redux_name, $post_id, $meta_key ) {
            $post_meta  = get_post_meta( $post_id, $meta_key, true );
            $post_meta  = ( $post_meta == 'enable' )    ? 'true' : $post_meta;
            $post_meta  = ( $post_meta == 'disable' )   ? '0' : $post_meta;
            return $post_meta;
        }


        static function miptheme_diff_global_redux_post_meta( $post_id, $meta_key, $diff = true, $default_value = '', $global_key = '' ) {
            global $mipthemeoptions_framework;

            $global_key     = ( $global_key != '' )   ? $global_key : $meta_key;
            $post_meta      = get_post_meta( $post_id, $meta_key, true );
            $post_global    = isset( $mipthemeoptions_framework[$global_key] ) ? $mipthemeoptions_framework[$global_key] : $default_value;

            if ( $post_meta != '' ) {
                return $post_meta;
            } else {
                return $post_global;
            }
        }


        static function miptheme_set_meta() {
            global $mipthemeoptions_framework;

            // facebook image meta tag - video only post fix
            if ( isset($mipthemeoptions_framework['_mp_page_open_graph_image']) && (bool)$mipthemeoptions_framework['_mp_page_open_graph_image'] && is_single() ) {
                global $post;
                if (has_post_thumbnail($post->ID)) {
                    $post_feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                    if (!empty($post_feat_image[0])) {
                        echo '<meta property="og:image" content="' .  $post_feat_image[0] . '" />';
                    }
                }
            }

            // set facebook App ID
            if ( isset($mipthemeoptions_framework['_mp_post_facebook_app_id']) && ($mipthemeoptions_framework['_mp_post_facebook_app_id'] != '') ) echo '<meta property="fb:app_id" content="'. $mipthemeoptions_framework['_mp_post_facebook_app_id'] .'" />';

            // set favicons
            if ( isset($mipthemeoptions_framework['_mp_favicon_16']['url']) && ($mipthemeoptions_framework['_mp_favicon_16']['url'] != '') ) echo '<link rel="icon" type="image/png" href="'. esc_url($mipthemeoptions_framework['_mp_favicon_16']['url']) .'">';
            if ( isset($mipthemeoptions_framework['_mp_favicon_57']['url']) && ($mipthemeoptions_framework['_mp_favicon_57']['url'] != '') ) echo '<link rel="apple-touch-icon" href="'. esc_url($mipthemeoptions_framework['_mp_favicon_57']['url']) .'">';
            if ( isset($mipthemeoptions_framework['_mp_favicon_76']['url']) && ($mipthemeoptions_framework['_mp_favicon_76']['url'] != '') ) echo '<link rel="apple-touch-icon-precomposed" sizes="76x76" href="'. esc_url($mipthemeoptions_framework['_mp_favicon_76']['url']) .'">';
            if ( isset($mipthemeoptions_framework['_mp_favicon_120']['url']) && ($mipthemeoptions_framework['_mp_favicon_120']['url'] != '') ) echo '<link rel="apple-touch-icon-precomposed" sizes="120x120" href="'. esc_url($mipthemeoptions_framework['_mp_favicon_120']['url']) .'">';
            if ( isset($mipthemeoptions_framework['_mp_favicon_152']['url']) && ($mipthemeoptions_framework['_mp_favicon_152']['url'] != '') ) echo '<link rel="apple-touch-icon-precomposed" sizes="152x152" href="'. esc_url($mipthemeoptions_framework['_mp_favicon_152']['url']) .'">';
        }

        // set top logo
        static function miptheme_set_logo() {
            global $mipthemeoptions_framework;
            if ( isset($mipthemeoptions_framework['_mp_header_logo_desktop']) ) {
                $retina_logo    = ( isset($mipthemeoptions_framework['_mp_header_logo_desktop_retina']['url']) && ($mipthemeoptions_framework['_mp_header_logo_desktop_retina']['url'] != '') ) ? ' data-retina="'. esc_url($mipthemeoptions_framework['_mp_header_logo_desktop_retina']['url']) .'"' : '';
                if (is_front_page()) {
                    return '<h1><a itemprop="url" href="'. get_bloginfo('url') .'"><img class="img-responsive" src="'. esc_url($mipthemeoptions_framework['_mp_header_logo_desktop']['url']) .'" width="'. esc_attr($mipthemeoptions_framework['_mp_header_logo_desktop']['width']) .'" height="'. esc_attr($mipthemeoptions_framework['_mp_header_logo_desktop']['height']) .'" alt="'. get_bloginfo('name') .'"'. $retina_logo .' /></a></h1>';
                } else {
                    return '<div class="logo"><a itemprop="url" href="'. get_bloginfo('url') .'"><img class="img-responsive" src="'. esc_url($mipthemeoptions_framework['_mp_header_logo_desktop']['url']) .'" width="'. esc_attr($mipthemeoptions_framework['_mp_header_logo_desktop']['width']) .'" height="'. esc_attr($mipthemeoptions_framework['_mp_header_logo_desktop']['height']) .'" alt="'. get_bloginfo('name') .'"'. $retina_logo .' /></a></div>';
                }
            } else {
                return '<div class="logo"><a itemprop="url" href="'. get_bloginfo('url') .'"><img class="img-responsive" src="'. get_template_directory_uri() .'/images/logo_head.png" alt="" /></a></div>';
            }
        }


        // set footer variables
        static function miptheme_set_footer_vars() {
            global $mipthemeoptions_framework, $mip_current_page;
            echo 'var miptheme_smooth_scrolling     = '. ( ( isset($mipthemeoptions_framework['_mp_theme_smooth_scrolling'])&&(bool)$mipthemeoptions_framework['_mp_theme_smooth_scrolling'] ) ? 'true' : 'false') .';';
            echo 'var miptheme_ajaxpagination_timer = '. ( ( isset($mipthemeoptions_framework['_mp_js_ajaxpagination_timer']) ) ? $mipthemeoptions_framework['_mp_js_ajaxpagination_timer'] : '1000') .';';
            // Sticky Sidebars
            if ( isset($mipthemeoptions_framework['_mpgl_sidebars_enable_sticky']) && (bool)$mipthemeoptions_framework['_mpgl_sidebars_enable_sticky'] ) {
                $margin_top = 25;
                if ( is_admin_bar_showing() ) {
                    $margin_top = 55;
                    if ( isset($mipthemeoptions_framework['_mpgl_header_nav_sticky_menu'])&&(bool)$mipthemeoptions_framework['_mpgl_header_nav_sticky_menu'] ) $margin_top += 50;
                } else if ( isset($mipthemeoptions_framework['_mpgl_header_nav_sticky_menu'])&&(bool)$mipthemeoptions_framework['_mpgl_header_nav_sticky_menu'] ) {
                    $margin_top = 75;
                }
                echo 'var miptheme_sticky_sidebar_margin = '. esc_js($margin_top) .';';
            }
            if ( is_single() ) {
                if ( $mip_current_page->page_image_parallax_height == 0 ) {
                    echo 'var miptheme_parallax_image_height = '. esc_js($mipthemeoptions_framework['_mpgl_post_layout_image_parallax_height']) .';';
                } else {
                    echo 'var miptheme_parallax_image_height = '. esc_js($mip_current_page->page_image_parallax_height) .';';
                }

            }
        }


        // set footer copyright
        static function miptheme_set_footer_copy() {
            global $mipthemeoptions_framework;
            if ( $mipthemeoptions_framework['_mp_enable_footer_copy_text'] && $mipthemeoptions_framework['_mp_enable_footer_copy_author_text'] ) {
                return '<!-- start:copyright -->
                        <div class="copyright">
                            <div class="container">
                                <div class="row">
                                    <!-- start:col -->
                                    <div class="col-sm-6">
                                        '. $mipthemeoptions_framework['_mp_enable_footer_copy_text'] .'
                                    </div>
                                    <!-- end:col -->
                                    <!-- start:col -->
                                    <div class="col-sm-6 text-right">
                                        '. $mipthemeoptions_framework['_mp_enable_footer_copy_author_text'] .'
                                    </div>
                                    <!-- end:col -->
                                </div>
                            </div>
                        </div>
                        <!-- end:copyright -->';

            } else if ( $mipthemeoptions_framework['_mp_enable_footer_copy_text'] ) {
                return '<!-- start:copyright -->
                        <div class="copyright">
                            <div class="container">
                                <div class="row">
                                    <!-- start:col -->
                                    <div class="col-xs-12 text-center">
                                        '. $mipthemeoptions_framework['_mp_enable_footer_copy_text'] .'
                                    </div>
                                    <!-- end:col -->
                                </div>
                            </div>
                        </div>
                        <!-- end:copyright -->';


            } else { // author only
                return '<!-- start:copyright -->
                        <div class="copyright">
                            <div class="container">
                                <div class="row">
                                    <!-- start:col -->
                                    <div class="col-xs-12 text-center">
                                        '. $mipthemeoptions_framework['_mp_enable_footer_copy_author_text'] .'
                                    </div>
                                    <!-- end:col -->
                                </div>
                            </div>
                        </div>
                        <!-- end:copyright -->';

            }

        }


        # Set Navigation Wrapper
        static function miptheme_main_menu_wrapper() {
            global $mipthemeoptions_framework;
            $wrap   = '';

            if ( isset($mipthemeoptions_framework['_mpgl_header_nav_logo']) && (bool)$mipthemeoptions_framework['_mpgl_header_nav_logo'] && isset($mipthemeoptions_framework['_mpgl_header_nav_logo_media']['url']) ) $wrap   .= '<a href="'. home_url( '/' ) .'"><span class="sticky-logo"></span></a>';
            $wrap   .= '<ul id="%1$s" class="%2$s">';
            $wrap   .= '%3$s';


            if ( isset($mipthemeoptions_framework['_mpgl_header_nav_show_search']) && (bool)$mipthemeoptions_framework['_mpgl_header_nav_show_search'] ) {
                $wrap .=    '<li class="search-nav"><a id="search-nav-button" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <form method="get" class="form-inline" action="'. home_url( '/' ) .'">
                                        <button class="btn"><i class="fa fa-search"></i></button>
                                        <div class="form-group">
                                            <input id="nav-search" type="text" name="s"  value="'. get_search_query() .'" >
                                        </div>

                                    </form>
                                </div>
                            </li>';
            }

            if ( isset($mipthemeoptions_framework['_mpgl_header_nav_show_options']) ) {
                if ( (bool)$mipthemeoptions_framework['_mpgl_header_nav_show_options']['register'] ) {
                    $wrap .= '<li class="soc-media has-icon">'. MipThemeFramework_Util::miptheme_register_replacement() .'</li>';
                }

                if ( (bool)$mipthemeoptions_framework['_mpgl_header_nav_show_options']['login'] ) {
                    $wrap .= '<li class="soc-media has-icon">'. MipThemeFramework_Util::miptheme_loginout_replacement() .'</li>';
                }
            }

            if ( isset($mipthemeoptions_framework['_mpgl_header_nav_show_social_networking']) && (bool)$mipthemeoptions_framework['_mpgl_header_nav_show_social_networking'] ) {
                $wrap .= '<li class="soc-media"><a href="#">'. esc_html__('Follow us', 'Newsgamer') .'</a>';
                $wrap .= '<div class="dropnav-container"><ul class="dropnav-menu">';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_facebook']) && ($mipthemeoptions_framework['_mp_social_facebook'] != '') )      ? '<li class="soc-links soc-facebook"><a href="'. $mipthemeoptions_framework['_mp_social_facebook'] .'" target="_blank">Facebook</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_twitter']) && ($mipthemeoptions_framework['_mp_social_twitter'] != '') )        ? '<li class="soc-links soc-twitter"><a href="'. $mipthemeoptions_framework['_mp_social_twitter'] .'" target="_blank">Twitter</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_google']) && ($mipthemeoptions_framework['_mp_social_google'] != '') )          ? '<li class="soc-links soc-google"><a href="'. $mipthemeoptions_framework['_mp_social_google'] .'" target="_blank">Google+</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_linkedin']) && ($mipthemeoptions_framework['_mp_social_linkedin'] != '') )      ? '<li class="soc-links soc-linkedin"><a href="'. $mipthemeoptions_framework['_mp_social_linkedin'] .'" target="_blank">Linkedin</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_pinterest']) && ($mipthemeoptions_framework['_mp_social_pinterest'] != '') )    ? '<li class="soc-links soc-pinterest"><a href="'. $mipthemeoptions_framework['_mp_social_pinterest'] .'" target="_blank">Pinterest</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_flickr']) && ($mipthemeoptions_framework['_mp_social_flickr'] != '') )          ? '<li class="soc-links soc-flickr"><a href="'. $mipthemeoptions_framework['_mp_social_flickr'] .'" target="_blank">Flickr</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_youtube']) && ($mipthemeoptions_framework['_mp_social_youtube'] != '') )        ? '<li class="soc-links soc-youtube"><a href="'. $mipthemeoptions_framework['_mp_social_youtube'] .'" target="_blank">Youtube</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_vimeo']) && ($mipthemeoptions_framework['_mp_social_vimeo'] != '') )            ? '<li class="soc-links soc-vimeo"><a href="'. $mipthemeoptions_framework['_mp_social_vimeo'] .'" target="_blank">Vimeo</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_instagram']) && ($mipthemeoptions_framework['_mp_social_instagram'] != '') )    ? '<li class="soc-links soc-instagram"><a href="'. $mipthemeoptions_framework['_mp_social_instagram'] .'" target="_blank">Instagram</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_dribbble']) && ($mipthemeoptions_framework['_mp_social_dribbble'] != '') )      ? '<li class="soc-links soc-dribbble"><a href="'. $mipthemeoptions_framework['_mp_social_dribbble'] .'" target="_blank">Dribbble</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_behance']) && ($mipthemeoptions_framework['_mp_social_behance'] != '') )        ? '<li class="soc-links soc-behance"><a href="'. $mipthemeoptions_framework['_mp_social_behance'] .'" target="_blank">Behance</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_tumblr']) && ($mipthemeoptions_framework['_mp_social_tumblr'] != '') )          ? '<li class="soc-links soc-tumblr"><a href="'. $mipthemeoptions_framework['_mp_social_tumblr'] .'" target="_blank">Tumblr</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_reddit']) && ($mipthemeoptions_framework['_mp_social_reddit'] != '')  )         ? '<li class="soc-links soc-reddit"><a href="'. $mipthemeoptions_framework['_mp_social_reddit'] .'" target="_blank">Reddit</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_vkontakte']) && ($mipthemeoptions_framework['_mp_social_vkontakte'] != '') )    ? '<li class="soc-links soc-vkontakte"><a href="'. $mipthemeoptions_framework['_mp_social_vkontakte'] .'" target="_blank">VKontakte</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_weibo']) && ($mipthemeoptions_framework['_mp_social_weibo'] != '')  )           ? '<li class="soc-links soc-weibo"><a href="'. $mipthemeoptions_framework['_mp_social_weibo'] .'" target="_blank">Weibo</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_wechat']) && ($mipthemeoptions_framework['_mp_social_wechat'] != '')  )         ? '<li class="soc-links soc-wechat"><a href="'. $mipthemeoptions_framework['_mp_social_wechat'] .'" target="_blank">WeChat</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_qq']) && ($mipthemeoptions_framework['_mp_social_qq'] != '')  )                 ? '<li class="soc-links soc-qq"><a href="'. $mipthemeoptions_framework['_mp_social_qq'] .'" target="_blank">QQ</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_twitch']) && ($mipthemeoptions_framework['_mp_social_twitch'] != '')  )         ? '<li class="soc-links soc-twitch"><a href="'. $mipthemeoptions_framework['_mp_social_twitch'] .'" target="_blank">Twitch</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_steam']) && ($mipthemeoptions_framework['_mp_social_steam'] != '')  )           ? '<li class="soc-links soc-steam"><a href="'. $mipthemeoptions_framework['_mp_social_steam'] .'" target="_blank">Steam</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_rss']) && ($mipthemeoptions_framework['_mp_social_rss'] != '') )                ? '<li class="soc-links soc-rss"><a href="'. $mipthemeoptions_framework['_mp_social_rss'] .'" target="_blank">RSS</a></li>' : '';
                //$wrap .= ( isset($mipthemeoptions_framework['_mp_social_500px']) && ($mipthemeoptions_framework['_mp_social_500px'] != '') )        ? '<li class="soc-links soc-500px"><a href="'. $mipthemeoptions_framework['_mp_social_500px'] .'">500px</a></li>' : '';
                $wrap .= '</ul></div>';
                $wrap .= '</li>';
            }

            $wrap .= '</ul>';
            return $wrap;
        }

        # Set Top Navigation Fallback
        static function miptheme_main_menu_wrapper_callback() {
            $wrap = '';
            if ( !has_nav_menu('header-menu') )
                echo '<ul class="nav clearfix">
                            <li><a href="' . esc_url( home_url() ) . '/wp-admin/nav-menus.php?action=locations">Click here - to select or create a menu</a></li>
                        </ul>';
        }


        private static function miptheme_register_replacement(){
            global $mipthemeoptions_framework;
            $register_url      = '<a href="' . site_url('wp-login.php?action=register', 'login') . '">';

            if ( isset($mipthemeoptions_framework['_mp_theme_fullscreen_login_plugin']) && (bool)$mipthemeoptions_framework['_mp_theme_fullscreen_login_plugin'] && class_exists('Pressapps_Fullscreen_Login_Admin') ) {
                $register_url      = '<a href="#" onclick="return false" data-form="register"  class="pafl-trigger-overlay pafl-register-link">';
            }

            if ( ! is_user_logged_in() ) {
                if ( get_option('users_can_register') )
                    $link = $register_url .'<span class="glyphicon glyphicon-user"></span> ' . esc_html__('Register', 'Newsgamer') . '</a>';
                else
                    $link = '';
            } else {
                $link = '<a href="' . admin_url() . 'edit.php"><span class="glyphicon glyphicon-edit"></span> ' . esc_html__('My Posts', 'Newsgamer') . '</a>';
            }
            return $link;
        }

        # Login links
        private static function miptheme_loginout_replacement() {
            global $mipthemeoptions_framework;
            $login_url      = '<a href="' . wp_login_url() . '">';
            //$logout_url     = '<a href="' . wp_logout_url() . '">';
            $logout_url     = '<a href="' . site_url( 'wp-login.php?action=logout' ) . '">';

            if ( isset($mipthemeoptions_framework['_mp_theme_fullscreen_login_plugin']) && (bool)$mipthemeoptions_framework['_mp_theme_fullscreen_login_plugin'] && class_exists('Pressapps_Fullscreen_Login_Admin') ) {
                $login_url      = '<a href="#" onclick="return false" data-form="login" class="pafl-trigger-overlay pafl-login-link">';
                //$logout_url     = '<a href="' . wp_logout_url() . '" class="pafl-logout-link" >';
                $logout_url     = '<a href="' . site_url( 'wp-login.php?action=logout' ) . '" class="pafl-logout-link" >';
            }

            if ( ! is_user_logged_in() )
                $link = $login_url .'<span class="glyphicon glyphicon-log-in"></span> ' . esc_html__('Log in', 'Newsgamer') . '</a>';
            else
                $link = $logout_url .'<span class="glyphicon glyphicon-log-out"></span> ' . esc_html__('Log out', 'Newsgamer') . '</a>';

            return $link;
        }


        # Set Fallback for Mobile Navigation
        static function mip_fb_mobile_menu() {
            echo '<ul class="nav clearfix">';
            echo '  <li><a href="' . home_url() . '/wp-admin/nav-menus.php?action=locations">Click here - to select or create a menu</a></li>';
            echo '</ul>';
        }


        # Set Mobile Navigation Wrapper
        static function mip_mobile_menu_wrapper() {
            global $mipthemeoptions_framework;

            $wrap   = '';
            $wrap   .= '<ul id="%1$s" class="%2$s">';

            $wrap   .= '%3$s';

            if ( isset($mipthemeoptions_framework['_mpgl_header_mobilemenu_show_options']) ) {
                if ( (bool)$mipthemeoptions_framework['_mpgl_header_mobilemenu_show_options']['register'] ) {
                    $wrap .= '<li>'. MipThemeFramework_Util::miptheme_register_replacement() .'</li>';
                }

                if ( (bool)$mipthemeoptions_framework['_mpgl_header_mobilemenu_show_options']['login'] ) {
                    $wrap .= '<li>'. MipThemeFramework_Util::miptheme_loginout_replacement() .'</li>';
                }
            }

            if ( isset($mipthemeoptions_framework['_mpgl_header_mobilemenu_show_social_networking']) && (bool)$mipthemeoptions_framework['_mpgl_header_mobilemenu_show_social_networking'] ) {
                $wrap .= '<li><a href="#">'. esc_html__('Follow us', 'Newsgamer') .'</a><ul>';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_facebook']) && ($mipthemeoptions_framework['_mp_social_facebook'] != '') )      ? '<li class="soc-links soc-facebook"><a href="'. $mipthemeoptions_framework['_mp_social_facebook'] .'" target="_blank">Facebook</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_twitter']) && ($mipthemeoptions_framework['_mp_social_twitter'] != '') )        ? '<li class="soc-links soc-twitter"><a href="'. $mipthemeoptions_framework['_mp_social_twitter'] .'" target="_blank">Twitter</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_google']) && ($mipthemeoptions_framework['_mp_social_google'] != '') )          ? '<li class="soc-links soc-google"><a href="'. $mipthemeoptions_framework['_mp_social_google'] .'" target="_blank">Google+</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_linkedin']) && ($mipthemeoptions_framework['_mp_social_linkedin'] != '') )      ? '<li class="soc-links soc-linkedin"><a href="'. $mipthemeoptions_framework['_mp_social_linkedin'] .'" target="_blank">Linkedin</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_pinterest']) && ($mipthemeoptions_framework['_mp_social_pinterest'] != '') )    ? '<li class="soc-links soc-pinterest"><a href="'. $mipthemeoptions_framework['_mp_social_pinterest'] .'" target="_blank">Pinterest</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_flickr']) && ($mipthemeoptions_framework['_mp_social_flickr'] != '') )          ? '<li class="soc-links soc-flickr"><a href="'. $mipthemeoptions_framework['_mp_social_flickr'] .'" target="_blank">Flickr</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_youtube']) && ($mipthemeoptions_framework['_mp_social_youtube'] != '') )        ? '<li class="soc-links soc-youtube"><a href="'. $mipthemeoptions_framework['_mp_social_youtube'] .'" target="_blank">Youtube</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_vimeo']) && ($mipthemeoptions_framework['_mp_social_vimeo'] != '') )            ? '<li class="soc-links soc-vimeo"><a href="'. $mipthemeoptions_framework['_mp_social_vimeo'] .'" target="_blank">Vimeo</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_instagram']) && ($mipthemeoptions_framework['_mp_social_instagram'] != '') )    ? '<li class="soc-links soc-instagram"><a href="'. $mipthemeoptions_framework['_mp_social_instagram'] .'" target="_blank">Instagram</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_dribbble']) && ($mipthemeoptions_framework['_mp_social_dribbble'] != '') )      ? '<li class="soc-links soc-dribbble"><a href="'. $mipthemeoptions_framework['_mp_social_dribbble'] .'" target="_blank">Dribbble</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_behance']) && ($mipthemeoptions_framework['_mp_social_behance'] != '') )        ? '<li class="soc-links soc-behance"><a href="'. $mipthemeoptions_framework['_mp_social_behance'] .'" target="_blank">Behance</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_tumblr']) && ($mipthemeoptions_framework['_mp_social_tumblr'] != '') )          ? '<li class="soc-links soc-tumblr"><a href="'. $mipthemeoptions_framework['_mp_social_tumblr'] .'" target="_blank">Tumblr</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_reddit']) && ($mipthemeoptions_framework['_mp_social_reddit'] != '')  )         ? '<li class="soc-links soc-reddit"><a href="'. $mipthemeoptions_framework['_mp_social_reddit'] .'" target="_blank">Reddit</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_vkontakte']) && ($mipthemeoptions_framework['_mp_social_vkontakte'] != '') )    ? '<li class="soc-links soc-vkontakte"><a href="'. $mipthemeoptions_framework['_mp_social_vkontakte'] .'" target="_blank">VKontakte</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_weibo']) && ($mipthemeoptions_framework['_mp_social_weibo'] != '')  )           ? '<li class="soc-links soc-weibo"><a href="'. $mipthemeoptions_framework['_mp_social_weibo'] .'" target="_blank">Weibo</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_wechat']) && ($mipthemeoptions_framework['_mp_social_wechat'] != '')  )         ? '<li class="soc-links soc-wechat"><a href="'. $mipthemeoptions_framework['_mp_social_wechat'] .'" target="_blank">WeChat</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_qq']) && ($mipthemeoptions_framework['_mp_social_qq'] != '')  )                 ? '<li class="soc-links soc-qq"><a href="'. $mipthemeoptions_framework['_mp_social_qq'] .'" target="_blank">QQ</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_twitch']) && ($mipthemeoptions_framework['_mp_social_twitch'] != '')  )         ? '<li class="soc-links soc-twitch"><a href="'. $mipthemeoptions_framework['_mp_social_twitch'] .'" target="_blank">Twitch</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_steam']) && ($mipthemeoptions_framework['_mp_social_steam'] != '')  )           ? '<li class="soc-links soc-steam"><a href="'. $mipthemeoptions_framework['_mp_social_steam'] .'" target="_blank">Steam</a></li>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_rss']) && ($mipthemeoptions_framework['_mp_social_rss'] != '') )                ? '<li class="soc-links soc-rss"><a href="'. $mipthemeoptions_framework['_mp_social_rss'] .'" target="_blank">RSS</a></li>' : '';
                $wrap .= '</ul></li>';
            }

            $wrap   .= '</ul>';
            return $wrap;
        }


        # Set Top Navigation Wrapper
        static function miptheme_top_menu_wrapper() {
            global $mipthemeoptions_framework;
            $streched_menu  = ( isset($mipthemeoptions_framework['_mpgl_header_topmenu_type']) ) ? $mipthemeoptions_framework['_mpgl_header_topmenu_type'] : 'container';

            $wrap   = '';
            $wrap   .= '<div id="top-navigation"><div class="'. $streched_menu .'"><nav id="top-menu">';
            $wrap   .= '<ul id="%1$s" class="%2$s">';

            if ( isset($mipthemeoptions_framework['_mpgl_header_topmenu_show_date']) && ($mipthemeoptions_framework['_mpgl_header_topmenu_show_date'] != 'none') ) {
                $wrap .= '<li class="date '. $mipthemeoptions_framework['_mpgl_header_topmenu_show_date'] .'"><span>'. date_i18n(MIPTHEME_DATE_HEADER) .'</span></li>';
            }

            $wrap   .= '%3$s';

            if ( isset($mipthemeoptions_framework['_mpgl_header_topmenu_show_options']) ) {
                $wrap .= '<li class="options">';

                if ( (bool)$mipthemeoptions_framework['_mpgl_header_topmenu_show_options']['register'] ) {
                    $wrap .= MipThemeFramework_Util::miptheme_register_replacement();
                }

                if ( (bool)$mipthemeoptions_framework['_mpgl_header_topmenu_show_options']['login'] ) {
                    $wrap .= MipThemeFramework_Util::miptheme_loginout_replacement();
                }

                $wrap .= '</li>';
            }

            if ( isset($mipthemeoptions_framework['_mpgl_header_top_show_social_networking']) && (bool)$mipthemeoptions_framework['_mpgl_header_top_show_social_networking'] ) {
                $wrap .= '<li class="soc-media">';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_facebook']) && ($mipthemeoptions_framework['_mp_social_facebook'] != '')  )     ? '<a href="'. $mipthemeoptions_framework['_mp_social_facebook'] .'" target="_blank"><i class="fa fa-facebook"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_twitter']) && ($mipthemeoptions_framework['_mp_social_twitter'] != '')  )       ? '<a href="'. $mipthemeoptions_framework['_mp_social_twitter'] .'" target="_blank"><i class="fa fa-twitter"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_google']) && ($mipthemeoptions_framework['_mp_social_google'] != '')  )         ? '<a href="'. $mipthemeoptions_framework['_mp_social_google'] .'" target="_blank"><i class="fa fa-google-plus"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_linkedin']) && ($mipthemeoptions_framework['_mp_social_linkedin'] != '')  )     ? '<a href="'. $mipthemeoptions_framework['_mp_social_linkedin'] .'" target="_blank"><i class="fa fa-linkedin"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_pinterest']) && ($mipthemeoptions_framework['_mp_social_pinterest'] != '')  )   ? '<a href="'. $mipthemeoptions_framework['_mp_social_pinterest'] .'" target="_blank"><i class="fa fa-pinterest"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_flickr']) && ($mipthemeoptions_framework['_mp_social_flickr'] != '')  )         ? '<a href="'. $mipthemeoptions_framework['_mp_social_flickr'] .'" target="_blank"><i class="fa fa-flickr"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_youtube']) && ($mipthemeoptions_framework['_mp_social_youtube'] != '')  )       ? '<a href="'. $mipthemeoptions_framework['_mp_social_youtube'] .'" target="_blank"><i class="fa fa-youtube"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_vimeo']) && ($mipthemeoptions_framework['_mp_social_vimeo'] != '')  )           ? '<a href="'. $mipthemeoptions_framework['_mp_social_vimeo'] .'" target="_blank"><i class="fa fa-vimeo-square"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_instagram']) && ($mipthemeoptions_framework['_mp_social_instagram'] != '')  )   ? '<a href="'. $mipthemeoptions_framework['_mp_social_instagram'] .'" target="_blank"><i class="fa fa-instagram"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_dribbble']) && ($mipthemeoptions_framework['_mp_social_dribbble'] != '')  )     ? '<a href="'. $mipthemeoptions_framework['_mp_social_dribbble'] .'" target="_blank"><i class="fa fa-dribbble"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_behance']) && ($mipthemeoptions_framework['_mp_social_behance'] != '')  )       ? '<a href="'. $mipthemeoptions_framework['_mp_social_behance'] .'" target="_blank"><i class="fa fa-behance"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_tumblr']) && ($mipthemeoptions_framework['_mp_social_tumblr'] != '')  )         ? '<a href="'. $mipthemeoptions_framework['_mp_social_tumblr'] .'" target="_blank"><i class="fa fa-tumblr"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_reddit']) && ($mipthemeoptions_framework['_mp_social_reddit'] != '')  )         ? '<a href="'. $mipthemeoptions_framework['_mp_social_reddit'] .'" target="_blank"><i class="fa fa-reddit"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_vkontakte']) && ($mipthemeoptions_framework['_mp_social_vkontakte'] != '')  )   ? '<a href="'. $mipthemeoptions_framework['_mp_social_vkontakte'] .'" target="_blank"><i class="fa fa-vk"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_weibo']) && ($mipthemeoptions_framework['_mp_social_weibo'] != '')  )           ? '<a href="'. $mipthemeoptions_framework['_mp_social_weibo'] .'" target="_blank"><i class="fa fa-tencent-weibo"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_wechat']) && ($mipthemeoptions_framework['_mp_social_wechat'] != '')  )         ? '<a href="'. $mipthemeoptions_framework['_mp_social_wechat'] .'" target="_blank"><i class="fa fa-weixin"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_qq']) && ($mipthemeoptions_framework['_mp_social_qq'] != '')  )                 ? '<a href="'. $mipthemeoptions_framework['_mp_social_qq'] .'" target="_blank"><i class="fa fa-qq"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_twitch']) && ($mipthemeoptions_framework['_mp_social_twitch'] != '')  )         ? '<a href="'. $mipthemeoptions_framework['_mp_social_twitch'] .'" target="_blank"><i class="fa fa-twitch"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_steam']) && ($mipthemeoptions_framework['_mp_social_steam'] != '')  )           ? '<a href="'. $mipthemeoptions_framework['_mp_social_steam'] .'" target="_blank"><i class="fa fa-steam"></i></a>' : '';
                $wrap .= ( isset($mipthemeoptions_framework['_mp_social_rss']) && ($mipthemeoptions_framework['_mp_social_rss'] != '')  )               ? '<a href="'. $mipthemeoptions_framework['_mp_social_rss'] .'" target="_blank"><i class="fa fa-rss"></i></a>' : '';
                //$wrap .= ( isset($mipthemeoptions_framework['_mp_social_500px']) && ($mipthemeoptions_framework['_mp_social_500px'] != '')  )           ? '<a href="'. $mipthemeoptions_framework['_mp_social_500px'] .'"><i class="fa fa-behance"></i></a>' : '';
                $wrap .= '</li>';
            }

            $wrap   .= '</ul></nav></div></div>';
            return $wrap;
        }

        # Set Top Navigation Fallback
        static function miptheme_top_menu_wrapper_callback() {
            global $post, $mipthemeoptions_framework;
            $wrap   = '';

            $custom_page = ( is_page() && (MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_page_menu_header_top') != '') ) ? 0 : 1;

            if ( isset($mipthemeoptions_framework['_mpgl_header_topmenu_enable']) && (bool)$mipthemeoptions_framework['_mpgl_header_topmenu_enable'] && !has_nav_menu( 'top-menu' ) && $custom_page ) {

                $streched_menu  = ( isset($mipthemeoptions_framework['_mpgl_header_topmenu_type']) ) ? $mipthemeoptions_framework['_mpgl_header_topmenu_type'] : 'container';

                $wrap   .= '<div id="top-navigation"><div class="'. $streched_menu .'"><nav id="top-menu">';
                $wrap   .= '<ul>';

                if ( isset($mipthemeoptions_framework['_mpgl_header_topmenu_show_date']) && ($mipthemeoptions_framework['_mpgl_header_topmenu_show_date'] != 'none') ) {
                    $wrap .= '<li class="date '. $mipthemeoptions_framework['_mpgl_header_topmenu_show_date'] .'"><span>'. date_i18n(MIPTHEME_DATE_HEADER) .'</span></li>';
                }

                if ( isset($mipthemeoptions_framework['_mpgl_header_topmenu_show_options']) ) {
                    $wrap .= '<li class="options">';

                    if ( (bool)$mipthemeoptions_framework['_mpgl_header_topmenu_show_options']['register'] ) {
                        $wrap .= MipThemeFramework_Util::miptheme_register_replacement();
                    }

                    if ( (bool)$mipthemeoptions_framework['_mpgl_header_topmenu_show_options']['login'] ) {
                        $wrap .= MipThemeFramework_Util::miptheme_loginout_replacement();
                    }

                    $wrap .= '</li>';
                }

                if ( isset($mipthemeoptions_framework['_mpgl_header_top_show_social_networking']) && (bool)$mipthemeoptions_framework['_mpgl_header_top_show_social_networking'] ) {
                    $wrap .= '<li class="soc-media">';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_facebook']) && ($mipthemeoptions_framework['_mp_social_facebook'] != '')  )     ? '<a href="'. $mipthemeoptions_framework['_mp_social_facebook'] .'" target="_blank"><i class="fa fa-facebook"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_twitter']) && ($mipthemeoptions_framework['_mp_social_twitter'] != '')  )       ? '<a href="'. $mipthemeoptions_framework['_mp_social_twitter'] .'" target="_blank"><i class="fa fa-twitter"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_google']) && ($mipthemeoptions_framework['_mp_social_google'] != '')  )         ? '<a href="'. $mipthemeoptions_framework['_mp_social_google'] .'" target="_blank"><i class="fa fa-google-plus"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_linkedin']) && ($mipthemeoptions_framework['_mp_social_linkedin'] != '')  )     ? '<a href="'. $mipthemeoptions_framework['_mp_social_linkedin'] .'" target="_blank"><i class="fa fa-linkedin"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_pinterest']) && ($mipthemeoptions_framework['_mp_social_pinterest'] != '')  )   ? '<a href="'. $mipthemeoptions_framework['_mp_social_pinterest'] .'" target="_blank"><i class="fa fa-pinterest"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_flickr']) && ($mipthemeoptions_framework['_mp_social_flickr'] != '')  )         ? '<a href="'. $mipthemeoptions_framework['_mp_social_flickr'] .'" target="_blank"><i class="fa fa-flickr"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_youtube']) && ($mipthemeoptions_framework['_mp_social_youtube'] != '')  )       ? '<a href="'. $mipthemeoptions_framework['_mp_social_youtube'] .'" target="_blank"><i class="fa fa-youtube"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_vimeo']) && ($mipthemeoptions_framework['_mp_social_vimeo'] != '')  )           ? '<a href="'. $mipthemeoptions_framework['_mp_social_vimeo'] .'" target="_blank"><i class="fa fa-vimeo-square"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_instagram']) && ($mipthemeoptions_framework['_mp_social_instagram'] != '')  )   ? '<a href="'. $mipthemeoptions_framework['_mp_social_instagram'] .'" target="_blank"><i class="fa fa-instagram"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_dribbble']) && ($mipthemeoptions_framework['_mp_social_dribbble'] != '')  )     ? '<a href="'. $mipthemeoptions_framework['_mp_social_dribbble'] .'" target="_blank"><i class="fa fa-dribbble"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_behance']) && ($mipthemeoptions_framework['_mp_social_behance'] != '')  )       ? '<a href="'. $mipthemeoptions_framework['_mp_social_behance'] .'" target="_blank"><i class="fa fa-behance"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_tumblr']) && ($mipthemeoptions_framework['_mp_social_tumblr'] != '')  )         ? '<a href="'. $mipthemeoptions_framework['_mp_social_tumblr'] .'" target="_blank"><i class="fa fa-tumblr"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_reddit']) && ($mipthemeoptions_framework['_mp_social_reddit'] != '')  )         ? '<a href="'. $mipthemeoptions_framework['_mp_social_reddit'] .'" target="_blank"><i class="fa fa-reddit"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_vkontakte']) && ($mipthemeoptions_framework['_mp_social_vkontakte'] != '')  )   ? '<a href="'. $mipthemeoptions_framework['_mp_social_vkontakte'] .'" target="_blank"><i class="fa fa-vk"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_weibo']) && ($mipthemeoptions_framework['_mp_social_weibo'] != '')  )           ? '<a href="'. $mipthemeoptions_framework['_mp_social_weibo'] .'" target="_blank"><i class="fa fa-tencent-weibo"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_wechat']) && ($mipthemeoptions_framework['_mp_social_wechat'] != '')  )         ? '<a href="'. $mipthemeoptions_framework['_mp_social_wechat'] .'" target="_blank"><i class="fa fa-weixin"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_qq']) && ($mipthemeoptions_framework['_mp_social_qq'] != '')  )                 ? '<a href="'. $mipthemeoptions_framework['_mp_social_qq'] .'" target="_blank"><i class="fa fa-qq"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_twitch']) && ($mipthemeoptions_framework['_mp_social_twitch'] != '')  )         ? '<a href="'. $mipthemeoptions_framework['_mp_social_twitch'] .'" target="_blank"><i class="fa fa-twitch"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_steam']) && ($mipthemeoptions_framework['_mp_social_steam'] != '')  )           ? '<a href="'. $mipthemeoptions_framework['_mp_social_steam'] .'" target="_blank"><i class="fa fa-steam"></i></a>' : '';
                    $wrap .= ( isset($mipthemeoptions_framework['_mp_social_rss']) && ($mipthemeoptions_framework['_mp_social_rss'] != '')  )               ? '<a href="'. $mipthemeoptions_framework['_mp_social_rss'] .'" target="_blank"><i class="fa fa-rss"></i></a>' : '';
                    //$wrap .= ( isset($mipthemeoptions_framework['_mp_social_500px']) && ($mipthemeoptions_framework['_mp_social_500px'] != '')  )           ? '<a href="'. $mipthemeoptions_framework['_mp_social_500px'] .'"><i class="fa fa-behance"></i></a>' : '';
                    $wrap .= '</li>';
                }

                $wrap   .= '</ul></nav></div></div>';
            }

            echo mipthemeframework_get_string_prefix() . $wrap;
        }


        # Set Navigation Selection
        static function miptheme_menu_selection( $location = '_mp_page_menu_header_main' ) {
            global $post, $mipthemeoptions_framework;
            if ( is_page() ) {
                return MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, $location);
            } else {
                return '';
            }
        }


        static function SetCharsValue($value, $default)
        {
            if ( $value == 0 ) {
                return $default;
            } else {
                return $value;
            }
        }


        static function ShowRating($value, $class = 'stars')
        {
            if ( $value ) {
                return '<span class="'. $class .'"><span style="width:'. $value .'%;"></span></span>';
            }
        }


        // get category array
        static function get_categoris_array($all_categories = true) {
            if (is_admin() === false) {
                return;
            }

            $categories = get_categories(array(
                'hide_empty' => 0
            ));

            $categories_array_walker = new categories_array_walker;
            $categories_array_walker->walk($categories, 4);

            if ($all_categories === true) {
                $categories_buffer[' Show all categories '] = '';
                return array_merge(
                    $categories_buffer,
                    $categories_array_walker->array_buffer
                );
            } else {
                return $categories_array_walker->array_buffer;
            }
        }


        // get woocommerce category array
        static function get_wc_categories_array() {
            if (is_admin() === false) {
                return;
            }

            $cats    = array();

            $taxonomies = array(
                'product_cat'
            );
            $args = array();
            $categories = get_terms(
                $taxonomies,
                $args
            );

            foreach($categories as $val) {
                $cats[$val->name]  = $val->term_id;
            }

            wp_reset_postdata();
            return $cats;
        }


        // get ads system array
        static function get_adssystem_array() {
            if (is_admin() === false) {
                return;
            }

            $ads    = array();
            $args   = array( 'post_type' => 'mp_ads', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'no_found_rows' => true, );
            $r      = new WP_Query( $args );
            while ( $r->have_posts() ) : $r->the_post();
                $ads[get_the_title()]  = get_the_ID();
            endwhile;
            wp_reset_postdata();

            return $ads;
        }


        static function ShortenText($text, $count)
        {
            if ($count == 1) return;
            // Change to the number of characters you want to display
            $chars_limit = $count;
            $chars_text = strlen($text);
            $text = strip_tags($text." ");
            $text = preg_replace("/\[caption.*\[\/caption\]/", '', $text);
            $text = str_replace(']]>', ']]>', $text); // remove caption
            $text = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $text );// remove caption
            $text = substr($text,0,$chars_limit);
            $text = substr($text,0,strrpos($text,' '));

            // If the text has more characters that your limit,
            //add ... so the user knows the text is actually longer
            if ($chars_text > $chars_limit)
            {
                $text = $text."...";
            }
            return $text;
        }

        # Get parent root category
        static function get_category_top_parent_id ($catid) {
            $catParent  = 0;
            while ($catid) {
                $cat = get_category($catid); // get the object for the catid
                $catid = $cat->category_parent; // assign parent ID (if exists) to $catid
                $catParent = $cat->cat_ID;
            }
            return $catParent;
        }

        # Get parent root category - post in
        static function get_category_top_parent_id_post_in ($catid, $post) {
            $catParent  = 0;
            while ($catid) {
                $cat = get_category($catid); // get the object for the catid
                $catid = $cat->category_parent; // assign parent ID (if exists) to $catid
                if ( has_category($cat->cat_ID, $post) ) $catParent = $cat->cat_ID;
            }
            return $catParent;
        }

        # Get last 'child' category
        static function get_category_last_child_id ($category) {
            $curr_cat_id    = $category[0]->cat_ID;
            foreach($category as $childcat) {
                $curr_root_id_tmp   = MipThemeFramework_Util::get_category_top_parent_id($childcat->cat_ID);
                if ( $childcat->cat_ID != $curr_root_id_tmp) {
                    $curr_cat_id    = $childcat->cat_ID;
                }
            }
            return $curr_cat_id;
        }

        # Turn a category ID to a Name
        static function cat_id_to_name($id) {
            foreach((array)(get_categories()) as $category) {
                if ($id == $category->cat_ID) { return $category->cat_name; break; }
            }
        }

        # Turn category name to ID
        static function get_category_id($cat_name){
            $term = get_term_by('name', $cat_name, 'category');
            if ( is_object($term) ) {
                return $term->term_id;
            } else {
                return '';
            }
        }

        static function cat_id_to_slug($id) {
            foreach((array)(get_categories()) as $category) {
                if ($id == $category->cat_ID) { return $category->slug; break; }
            }
        }


        // New version using usort
        static function return_category ( $post_id, $inc_cat, $cat_display = 'root' ) {

            $categories = mipthemeframework_sort_categories(get_the_category($post_id));
            $cat_name   = '';
            $cat_id     = 0;

            foreach ( $categories as &$cat ) {
                if (!empty($inc_cat)) {
                    if (in_array($cat->cat_ID, $inc_cat)) {
                        $cat_id     =  $cat->cat_ID;
                        $cat_name   =  $cat->cat_name;
                        if ( $cat_display == 'root' ) break;
                    }
                    if (in_array($cat->parent, $inc_cat)) {
                        $cat_id     =  $cat->cat_ID;
                        $cat_name   =  $cat->cat_name;
                        if ( $cat_display == 'sub' ) break;
                    }
                } else {
                    if ( ($cat_display == 'root') && ($cat->parent == 0) ) {
                        $cat_id     =  $cat->cat_ID;
                        $cat_name   =  $cat->cat_name;
                        break;
                    } else if ( ($cat_display == 'sub') && ($cat->parent != 0) ) {
                        $cat_id     =  $cat->cat_ID;
                        $cat_name   =  $cat->cat_name;
                        break;
                    }
                }
                $cat_id     =  $cat->cat_ID;
                $cat_name   =  $cat->cat_name;
            }

            return array($cat_id, $cat_name);

        }

        /*
        static function return_category ( $post_id, $inc_cat, $cat_display = 'root' ) {
            $cat_id         = 0;
            $cat_name       = '';
            $cat_label_id   = get_post_meta( $post_id, '_mp_category_label', true );
            $categories     = get_the_category($post_id);

            // Assemble a tree of category relationships
            // Also re-key the category array for easier
            // reference
            $category_tree = array();
            $keyed_categories = array();

            foreach( (array)$categories as $c ) {
                $category_tree[$c->cat_ID] = $c->category_parent;
                $keyed_categories[$c->cat_ID] = $c;
            }

            // Now loop through and create a tiered list of
            // categories
            $tiered_categories = array();
            $tier = 0;

            // This is the recursive bit
            while ( !empty( $category_tree ) ) {
                $cats_to_unset = array();
                foreach( (array)$category_tree as $cat_id => $cat_parent ) {
                    if ( !in_array( $cat_parent, array_keys( $category_tree ) ) ) {
                        $tiered_categories[$tier][] = $cat_id;
                        $cats_to_unset[] = $cat_id;
                    }
                }

                foreach( $cats_to_unset as $ctu ) {
                    unset( $category_tree[$ctu] );
                }
                $tier++;
            }

            // Walk through the tiers to order the cat objects properly
            $ordered_categories = array();
            foreach( (array)$tiered_categories as $tier ) {
                foreach( (array)$tier as $tcat ) {
                    $ordered_categories[] = $keyed_categories[$tcat];
                }
            }

            //if ( in_array($cat_label_id, $inc_cat) || in_array( self::get_category_top_parent_id($cat_label_id), $inc_cat ) ) {
            if ( $cat_label_id && ( $cat_label_id != '' ) ) {
                $cat_id     =  $cat_label_id;
                $cat_name   =  get_cat_name($cat_label_id);
            } else {

                foreach ( $ordered_categories as &$cat ) {
                    if (!empty($inc_cat)) {
                        if (in_array($cat->cat_ID, $inc_cat)) {
                            $cat_id     =  $cat->cat_ID;
                            $cat_name   =  $cat->cat_name;
                            if ( $cat_display == 'root' ) break;
                        }
                        if (in_array($cat->parent, $inc_cat)) {
                            $cat_id     =  $cat->cat_ID;
                            $cat_name   =  $cat->cat_name;
                            if ( $cat_display == 'sub' ) break;
                        }
                    } else {
                        if ( ($cat_display == 'root') && ($cat->parent == 0) ) {
                            $cat_id     =  $cat->cat_ID;
                            $cat_name   =  $cat->cat_name;
                            break;
                        } else if ( ($cat_display == 'sub') && ($cat->parent != 0) ) {
                            $cat_id     =  $cat->cat_ID;
                            $cat_name   =  $cat->cat_name;
                            break;
                        }
                    }
                    $cat_id     =  $cat->cat_ID;
                    $cat_name   =  $cat->cat_name;
                }

            }
            return array($cat_id, $cat_name);
        }
        */

        public static function posts_by_year() {
            // array to use for results
            $years = array();

            // get posts from WP
            $posts = get_posts(array(
                'numberposts'   => -1,
                'orderby'       => 'post_date',
                'order'         => 'ASC',
                'post_type'     => 'post',
                'post_status'   => 'publish'
            ));

            // loop through posts, populating $years arrays
            foreach($posts as $post) {
                $years[date('Y', strtotime($post->post_date))][] = $post;
            }
            wp_reset_postdata();

            // reverse sort by year
            krsort($years);

            return $years;
        }


        static function setCatLayoutBanner($curr_cat_id, $class = 'row ad ad-cat') {

            global $mipthemeoptions_framework;

            $enable_banner              = $mipthemeoptions_framework['_mp_cat_'. $curr_cat_id .'_layout_banner_show']      ? $mipthemeoptions_framework['_mp_cat_'. $curr_cat_id .'_layout_banner_show']      : $mipthemeoptions_framework['_mp_cat_layout_banner_show'];
            $banner_type                = $mipthemeoptions_framework['_mp_cat_'. $curr_cat_id .'_layout_banner_type']      ? $mipthemeoptions_framework['_mp_cat_'. $curr_cat_id .'_layout_banner_type']      : $mipthemeoptions_framework['_mp_cat_layout_banner_type'];
            $banner_image               = $mipthemeoptions_framework['_mp_cat_'. $curr_cat_id .'_layout_banner_image']['url']      ? $mipthemeoptions_framework['_mp_cat_'. $curr_cat_id .'_layout_banner_image']['url']      : $mipthemeoptions_framework['_mp_cat_layout_banner_image']['url'];
            $banner_image_width         = $mipthemeoptions_framework['_mp_cat_'. $curr_cat_id .'_layout_banner_image']['width']      ? $mipthemeoptions_framework['_mp_cat_'. $curr_cat_id .'_layout_banner_image']['width']      : $mipthemeoptions_framework['_mp_cat_layout_banner_image']['width'];
            $banner_link                = $mipthemeoptions_framework['_mp_cat_'. $curr_cat_id .'_layout_banner_link']      ? $mipthemeoptions_framework['_mp_cat_'. $curr_cat_id .'_layout_banner_link']      : $mipthemeoptions_framework['_mp_cat_layout_banner_link'];
            $banner_embed               = $mipthemeoptions_framework['_mp_cat_'. $curr_cat_id .'_layout_banner_embed']      ? $mipthemeoptions_framework['_mp_cat_'. $curr_cat_id .'_layout_banner_embed']      : $mipthemeoptions_framework['_mp_cat_layout_banner_embed'];

            $output                     = '';

            if ( $enable_banner && isset($banner_type) ) {
                switch ( $banner_type ) {
                    case 'image':
                        $banner_image   = '<img src="'. $banner_image .'" width="'. $banner_image_width .'" alt="" />';
                        $banner_image   = (isset($banner_link)) ? '<a href="'. $banner_link .'" target="_blank">'. $banner_image .'</a>' : $banner_image;

                        $output = '<div class="'. $class .'">'. $banner_image .'</div>';
                    break;
                    case 'embed':
                        $output = '<div class="'. $class .'">'. $banner_embed .'</div>';
                    break;
                }
                return $output;
            }

        }


        static function get_image_attachment_data($post_id, $size = 'thumbnail', $count = 1 ) {
            $objMeta = array();
            $meta = '';
            $args = array(
                'numberposts' => $count,
                'post_parent' => $post_id,
                'post_type' => 'attachment',
                'nopaging' => false,
                'post_mime_type' => 'image',
                'order' => 'ASC',
                'orderby' => 'menu_order ID',
                'post_status' => 'any'
            );

            $attachments = get_children($args);

            if ($attachments) {
                foreach ($attachments as $attachment) {
                    $meta = new stdClass();
                    $meta->ID = $attachment->ID;
                    $meta->title = $attachment->post_title;
                    $meta->caption = $attachment->post_excerpt;
                    $meta->description = $attachment->post_content;
                    $meta->alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);

                    // Image properties
                    $props = wp_get_attachment_image_src( $attachment->ID, $size, false );

                    $meta->properties['url'] = $props[0];
                    $meta->properties['width'] = $props[1];
                    $meta->properties['height'] = $props[2];

                    $objMeta[] = $meta;
                }

                return ( count( $attachments ) == 1 ) ? $meta : $objMeta;
            }
        }


        static function get_item_scope($post_review = 0) {
            if ((bool)$post_review) {
                return 'itemscope itemtype="http://schema.org/Review"';
            } else {
                return 'itemscope itemtype="http://schema.org/Article"';
            }
        }


        static function getColumnClass($columns = 3) {
            switch ($columns) {
                case 1:
                    return 'col-md-12';
                break;
                case 2:
                    return 'col-md-6';
                break;
                case 3:
                    return 'col-md-4';
                break;
                case 4:
                    return 'col-md-3';
                break;
                default:
                    return 'col-md-12';
            }
        }


        static function getAvatarSize($sidebar = 'multi-sidebar', $columns = 3) {
            if ( $sidebar == 'hide-sidebar' ) {
                switch ( $columns ) {
                    case 2:
                        return '350';
                    break;
                    case 3:
                        return '280';
                    break;
                    case 4:
                        return '210';
                    break;
                    default:
                        return '210';
                    break;
                }
            } else if ( $sidebar == 'multi-sidebar' ) {
                switch ( $columns ) {
                    case 2:
                        return '200';
                    break;
                    case 3:
                        return '150';
                    break;
                    case 4:
                        return '100';
                    break;
                    default:
                        return '100';
                    break;
                }
            } else { // left or right sidebar
                switch ( $columns ) {
                    case 2:
                        return '250';
                    break;
                    case 3:
                        return '200';
                    break;
                    case 4:
                        return '130';
                    break;
                    default:
                        return '130';
                    break;
                }
            }
        }


        static function setImage( $sImg, $sTitle, $imgWidth, $imgHeight, $imgClass = 'class="img-responsive"' ) {
            global $mipthemeoptions_framework;
            $img_lazy_load  = (isset($mipthemeoptions_framework['_mp_posts_enable_lazy_load']) && (bool)$mipthemeoptions_framework['_mp_posts_enable_lazy_load']) ? true : false;
            if ( $img_lazy_load ) {
                return '<img class="bttrlazyloading'. ( ($imgClass != '') ? ' img-responsive' : '' ) .'" data-bttrlazyloading-md-src="'. esc_url($sImg) .'" width="'. $imgWidth .'" height="'. $imgHeight .'" alt="'. esc_attr($sTitle) .'"'. $imgClass .' />
                        <noscript><img src="'. esc_url($sImg) .'" width="'. $imgWidth .'" height="'. $imgHeight .'" alt="'. esc_attr($sTitle) .'"'. $imgClass .' /></noscript>';
            } else {
                return '<img src="'. esc_url($sImg) .'" width="'. $imgWidth .'" height="'. $imgHeight .'" alt="'. esc_attr($sTitle) .'"'. $imgClass .' />';
            }
        }


        static function noDummyImage( $sImg ) {
            $pos_value = strrpos($sImg, "dummy");
            if ( $sImg ) {
                if ($pos_value === false) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }


        static function checkUnboxedThemeImage( $aImgWidth = array('miptheme-post-thumb-2', 560, 390) ) {
            global $mipthemeoptions_framework;
            if ( isset($mipthemeoptions_framework['_mp_theme_layout']) && ($mipthemeoptions_framework['_mp_theme_layout'] == 'theme-unboxed')) { // return unboxed width
                switch ($aImgWidth[0]) {
                    case 'miptheme-post-thumb-1':
                        return array('610_bfi_425', 795, 485);
                    break;
                    case 'miptheme-post-thumb-2':
                        return array('610_bfi_425', 610, 425);
                    break;
                    case 'miptheme-post-thumb-3':
                        return array('290_bfi_176', 290, 176);
                    break;
                    case 'miptheme-post-thumb-9':
                        return array('383_bfi_231', 383, 213);
                    break;
                    case '370':
                        return array('610_bfi_425', 610, 425);
                    break;
                    case '237':
                        return array('610_bfi_425', 610, 425);
                    break;
                    case '479':
                        return array('610_bfi_425', 610, 425);
                    break;
                    case '339':
                        return array('610_bfi_425', 610, 425);
                    break;
                    default:
                        return $aImgWidth;
                }

            } else { // return original width
                return $aImgWidth;
            }
        }


        public static function getCarouselIndex() {
            return self::$carousel_index ++;
        }


        static function mp_set_dummy_img( $dim = 'dummy' ) {
            if ( $dim && ($dim != '') ) {
                return get_template_directory_uri() . '/images/dummy/'. $dim .'.png';
            }
        }


        public static function addClass( $sClass ) {
            if ( $sClass != '' ) return ' '. $sClass;
        }

    }

}


class categories_array_walker extends Walker {
    var $tree_type      = 'category';
    var $db_fields      = array ('parent' => 'parent', 'id' => 'term_id');
    var $array_buffer   = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->array_buffer[str_repeat(' -- ', $depth) .  $category->name] = $category->term_id;
    }

    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }
}
