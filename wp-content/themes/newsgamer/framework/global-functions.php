<?php
/**
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */


if ( ! function_exists( 'mipthemeframework_custom_link_page' ) ) {
    function mipthemeframework_custom_link_page( $anchor, $class, $i ) {
        global $wp_rewrite;
        $post = get_post();

        if ( 1 == $i ) {
                $url = get_permalink();
        } else {
                if ( '' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending')) )
                        $url = add_query_arg( 'page', $i, get_permalink() );
                elseif ( 'page' == get_option('show_on_front') && get_option('page_on_front') == $post->ID )
                        $url = trailingslashit(get_permalink()) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
                else
                        $url = trailingslashit(get_permalink()) . user_trailingslashit($i, 'single_paged');
        }

        if ( is_preview() ) {
                $url = add_query_arg( array(
                        'preview' => 'true'
                ), $url );

                if ( ( 'draft' !== $post->post_status ) && isset( $_GET['preview_id'], $_GET['preview_nonce'] ) ) {
                        $url = add_query_arg( array(
                                'preview_id'    => wp_unslash( $_GET['preview_id'] ),
                                'preview_nonce' => wp_unslash( $_GET['preview_nonce'] )
                        ), $url );
                }
        }

        return '<a class="'. $class .'" href="' . esc_url( $url ) . $anchor .'">';
    }
}


if ( ! function_exists( 'mipthemeframework_custom_wp_link_pages' ) ) {
    function mipthemeframework_custom_wp_link_pages( $args = '' ) {
        $defaults = array(
            'before' => '<div id="post-paging">',
            'after' => '</div>',
            'text_before' => '',
            'text_after' => '',
            'next_or_number' => 'number',
            'nextpagelink' => '<i class="fa fa-chevron-right"></i>',
            'previouspagelink' => '<i class="fa fa-chevron-left"></i>',
            'pagelink' => '%',
            'echo' => 1
        );

        $r = wp_parse_args( $args, $defaults );
        $r = apply_filters( 'wp_link_pages_args', $r );
        extract( $r, EXTR_SKIP );

        global $page, $numpages, $multipage, $more, $pagenow;

        $output = '';
        if ( $multipage ) {
            // previous
            if ( $more ) {
                $output .= $before;
                $i = $page - 1;
                if ( $i && $more ) {
                    $output .= mipthemeframework_custom_link_page( '#page-content', 'prev', $i );
                    $output .= $text_before . $previouspagelink . $text_after . '</a> ';
                } else {
                    $output .= '<span class="disabled"><i class="fa fa-chevron-left"></i></span> ';
                }
                $output .= '<span class="current">'. $page .' <em> of </em> '. $numpages . '</span> ';

                $i = $page + 1;
                if ( $i <= $numpages && $more ) {
                    $output .= mipthemeframework_custom_link_page( '#page-content', 'next', $i );
                    $output .= $text_before . $nextpagelink . $text_after . '</a>';
                }
                $output .= $after;
            }
        }

        if ( $echo )
                echo mipthemeframework_get_string_prefix() . $output;

        return $output;
    }
}

if ( ! function_exists( 'mipthemeframework_generate_slug' ) ) {
    function mipthemeframework_generate_slug($phrase, $maxLength)
    {
        $result = strtolower($phrase);

        $result = preg_replace("/[^a-z0-9\s-]/", "", $result);
        $result = trim(preg_replace("/[\s-]+/", " ", $result));
        $result = trim(substr($result, 0, $maxLength));
        $result = preg_replace("/\s/", "-", $result);

        return $result;
    }
}

if ( ! function_exists( 'mipthemeframework_set_post_views' ) ) {
    function mipthemeframework_set_post_views($postID) {
        $count_key = 'mip_post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}


if ( ! function_exists( 'mipthemeframework_track_post_views' ) ) {
    function mipthemeframework_track_post_views ($post_id) {
        if ( !is_single() ) return;
        if ( empty ( $post_id) ) {
            global $post;
            $post_id = $post->ID;
        }
        mipthemeframework_set_post_views($post_id);
    }
}


if ( ! function_exists( 'mipthemeframework_add_widget_to_sidebar' ) ) {
    function mipthemeframework_add_widget_to_sidebar($sidebarSlug, $widgetSlug, $widgetSettings = array()) {
        $sidebarOptions = get_option('sidebars_widgets');
        if(!isset($sidebarOptions[$sidebarSlug])){
        $sidebarOptions[$sidebarSlug] = array('_multiwidget' => 1);
        }
        $newWidget = get_option('widget_'.$widgetSlug);
        if(!is_array($newWidget))$newWidget = array();
        $count = count($newWidget)+1;
        $sidebarOptions[$sidebarSlug][] = $widgetSlug.'-'.$count;

        $newWidget[$count] = $widgetSettings;

        update_option('sidebars_widgets', $sidebarOptions);
        update_option('widget_'.$widgetSlug, $newWidget);
    }
}


if ( ! function_exists( 'mipthemeframework_generate_options_css' ) ) {
    function mipthemeframework_generate_options_css($newdata) {
        global $wp_filesystem;

        $data = $newdata;
    	$css_dir = get_template_directory() .'/assets/css/'; // Shorten code, save 1 call
        $css_dest_dir = get_stylesheet_directory() .'/assets/css/';

    	ob_start(); // Capture all output (output buffering)

    	require($css_dir . 'dynamic.css.php'); // Generate CSS

    	$css = ob_get_clean(); // Get generated CSS (output buffering)
    	//file_put_contents($css_dest_dir . 'dynamic.css', $css, LOCK_EX); // Save it

        if( empty( $wp_filesystem ) ) {
            require_once( ABSPATH .'/wp-admin/includes/file.php' );
            WP_Filesystem();
        }

        if( $wp_filesystem ) {
            $wp_filesystem->put_contents(
                $css_dest_dir . 'dynamic.css',
                $css,
                FS_CHMOD_FILE // predefined mode settings for WP files
            );

            $wp_filesystem->put_contents(
                $css_dest_dir . 'typography.css',
                get_option( '_miptheme_typography_css' ),
                FS_CHMOD_FILE // predefined mode settings for WP files
            );
        }

        mipthemeframework_set_option_css( '_miptheme_dynamic_css', $css ); // Save to database
        //mipthemeframework_set_css_file( '_miptheme_typography_css', 'typography.css' ); // Save to database
    }
}


if ( ! function_exists( 'mipthemeframework_add_custom_body_class' ) ) {
    function mipthemeframework_add_custom_body_class($classes) {
        global $mipthemeoptions_typo;

        if ( isset($mipthemeoptions_typo['_mp_typo_sidebar_shadow']) && (bool)$mipthemeoptions_typo['_mp_typo_sidebar_shadow'] ) {
            $classes[] = 'sidebar-shadow';
        }

        if ( isset($mipthemeoptions_typo['_mp_typo_sidebar_border']) && (bool)$mipthemeoptions_typo['_mp_typo_sidebar_border'] ) {
            $classes[] = 'sidebar-border';
        }

        if ( isset($mipthemeoptions_typo['_mp_typo_vc_block_type']) && ($mipthemeoptions_typo['_mp_typo_vc_block_type'] != '') ) {
            $classes[] = 'vc-block-fx '. $mipthemeoptions_typo['_mp_typo_vc_block_type'];
        }

        if ( isset($mipthemeoptions_typo['_mp_typo_header_mainnav_center']) && (bool)$mipthemeoptions_typo['_mp_typo_header_mainnav_center'] ) {
            $classes[] = 'header-nav-center';
        }

    	return $classes;
    }
}


if ( ! function_exists( 'mipthemeframework_get_the_content_with_formatting' ) ) {
    function mipthemeframework_get_the_content_with_formatting ($more_link_text = 'Read more', $stripteaser = 0, $more_file = '') {
        $content = get_the_content($more_link_text, $stripteaser, $more_file);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        return $content;
    }
}


if ( ! function_exists( 'mipthemeframework_get_css_values_for_menu_colors' ) ) {
    function mipthemeframework_get_css_values_for_menu_colors () {
        global $wpdb;
        // Loop trough custom links in menus
        $custom_links = $wpdb->get_results(
        "
        SELECT post_id, meta_value
        FROM $wpdb->postmeta
        WHERE meta_key = '_menu_item_nav_color' AND meta_value <> ''
        "
        );

        $sCssClass  = '';

        foreach ( $custom_links as $menu_link ) {
            $color = $menu_link->meta_value;
            if ($color) {
                if(!preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $color, $parts)) break;

                $sCssClass .= ' #header-navigation ul li#nav-menu-item-'. $menu_link->post_id .' a.main-menu-link:hover,
                                #header-navigation ul li#nav-menu-item-'. $menu_link->post_id .' a.main-menu-link:after,
                                #header-navigation ul li#nav-menu-item-'. $menu_link->post_id .' .dropnav-container .dropnav-menu li > a:hover {
                                    color: #fff;
                                    background-color: '. $color .';
                                }
                                #header-navigation ul li#nav-menu-item-'. $menu_link->post_id .' .subnav-container .subnav-menu li.current a {
                                    color: '. $color .';
                                }';

            }
        }
        return $sCssClass;
    }
}


if ( ! function_exists( 'mipthemeframework_set_option_sidebars' ) ) {
    function mipthemeframework_set_option_sidebars() {
        global $mipthemeoptions_framework;
        if(isset($mipthemeoptions_framework['_mp_sidebars']) && sizeof($mipthemeoptions_framework['_mp_sidebars']) > 0) {
            $option_name    = '_miptheme_sidebars' ;
            $new_value      = $mipthemeoptions_framework['_mp_sidebars'];
            if ( get_option( $option_name ) !== false ) {
                // The option already exists, so we just update it.
                update_option( $option_name, $new_value );
            } else {
                // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
                $deprecated = null;
                $autoload = 'no';
                add_option( $option_name, $new_value, $deprecated, $autoload );
            }
        }
    }
}

if ( ! function_exists( 'mipthemeframework_set_option_css' ) ) {
    function mipthemeframework_set_option_css( $option_name, $css ) {
        $new_value      = $css;
        if ( get_option( $option_name ) !== false ) {
            // The option already exists, so we just update it.
            update_option( $option_name, $new_value );
        } else {
            // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
            $deprecated = null;
            $autoload = 'no';
            add_option( $option_name, $new_value, $deprecated, $autoload );
        }
    }
}


if ( ! function_exists( 'mipthemeframework_set_css_file' ) ) {
    function mipthemeframework_set_css_file( $option_name, $file_name ) {
        if ( get_option( $option_name ) !== false ) {
            global $wp_filesystem;

            $css_dest_dir = get_stylesheet_directory() .'/assets/css/'; // Shorten code, save 1 call
        	//file_put_contents($css_dir . $file_name, get_option( $option_name ), LOCK_EX); // Save it

            if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
                WP_Filesystem();
            }

            if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $css_dest_dir . $file_name,
                    get_option( $option_name ),
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
            }
        }
    }
}

if ( ! function_exists( 'mipthemeframework_sort_categories' ) ) {
    function mipthemeframework_sort_categories($categories) { // Sorting the category
        usort($categories, "mipthemeframework_cmp_categories");
        return $categories;
    }
}

if ( ! function_exists( 'mipthemeframework_cmp_categories' ) ) {
    function mipthemeframework_cmp_categories($category_1,$category_2) { // Sort function
        foreach(get_categories(array("parent" => $category_1->cat_ID)) AS $sub) {
            if($category_2->cat_ID == $sub->cat_ID) return -1;
        }
        return 1;
    }
}

if ( ! function_exists( 'mipthemeframework_get_redux_var' ) ) {
    function mipthemeframework_get_redux_var () {
        global $mipthemeoptions_framework;
        return $mipthemeoptions_framework;
    }
}

if ( ! function_exists( 'mipthemeframework_get_redux_typo_var' ) ) {
    function mipthemeframework_get_redux_typo_var () {
        global $mipthemeoptions_typo;
        return $mipthemeoptions_typo;
    }
}

if ( ! function_exists( 'mipthemeframework_get_mip_current_page' ) ) {
    function mipthemeframework_get_mip_current_page () {
        global $mip_current_page;
        return $mip_current_page;
    }
}

if ( ! function_exists( 'mipthemeframework_get_string_prefix' ) ) {
    // the most s****d of all functions
    function mipthemeframework_get_string_prefix () {
        return '';
    }
}
