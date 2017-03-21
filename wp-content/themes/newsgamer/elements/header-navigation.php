<?php
    $mipthemeoptions_framework  = mipthemeframework_get_redux_var();

    $miptheme_header_type       = isset($mipthemeoptions_framework['_mp_header_type'])       ? $mipthemeoptions_framework['_mp_header_type']      : '1';
    $miptheme_header_layout     = isset($mipthemeoptions_framework['_mp_header_layout'])     ? $mipthemeoptions_framework['_mp_header_layout']    : 'header-layout-1';
?>
<!-- start:page-header -->
<header id="page-header" class="hidden-xs hidden-sm<?php echo ' wrap-'. $miptheme_header_layout; if ( $miptheme_header_type == '1') echo ' container'; ?> clearfix">

    <?php
        // Top Navigation
        $defaults = array(
            'theme_location'  => 'top-menu',
            'menu'            => MipThemeFramework_Util::miptheme_menu_selection('_mp_page_menu_header_top'),
            'container'       => '',
            'container_class' => '',
            'container_id'    => '',
            'fallback_cb'     => MipThemeFramework_Util::miptheme_top_menu_wrapper_callback(),
            'menu_class'      => 'clearfix',
            'menu_id'         => '',
            'echo'            => true,
            'items_wrap'      => MipThemeFramework_Util::miptheme_top_menu_wrapper(),
            'depth'           => 0,
        );
        wp_nav_menu( $defaults );
    ?>

    <?php
        // header branding
        if ( isset($mipthemeoptions_framework['_mp_enable_header_widgets']) && (bool)$mipthemeoptions_framework['_mp_enable_header_widgets'] ) {
            if ( isset($mipthemeoptions_framework['_mp_header_widget_layout']) ) get_template_part('elements/parts/'. $mipthemeoptions_framework['_mp_header_widget_layout'] );
        } else {
            if ( $miptheme_header_type == '2') echo '<div class="container">';
            get_template_part('elements/parts/'. $miptheme_header_layout );
            if ( $miptheme_header_type == '2') echo '</div>';
        }
    ?>

    <!-- start:sticky-header -->
    <div class="sticky-header-wrapper">
        <div id="sticky-header"<?php if ( isset($mipthemeoptions_framework['_mpgl_header_nav_sticky_menu']) && (bool)$mipthemeoptions_framework['_mpgl_header_nav_sticky_menu'] ) echo ' data-spy="affix" data-offset-top="115"'; if ( is_admin_bar_showing() ) echo ' class="adminbar"'; ?>>
            <!-- start:header-navigation -->
            <div id="header-navigation"<?php if ( isset($mipthemeoptions_framework['_mpgl_header_nav_type']) && ($mipthemeoptions_framework['_mpgl_header_nav_type'] == '1') ) echo ' class="container"'; ?>>
                <!-- start:menu -->
                <nav id="main-menu"<?php if ( isset($mipthemeoptions_framework['_mpgl_header_nav_type']) && ($mipthemeoptions_framework['_mpgl_header_nav_type'] == '2') ) echo ' class="container relative"'; ?>>
                <?php
                    $defaults = array(
                        'theme_location'  => 'header-menu',
                        'menu'            => MipThemeFramework_Util::miptheme_menu_selection(),
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'fallback_cb'     => MipThemeFramework_Util::miptheme_main_menu_wrapper_callback(),
                        'menu_class'      => 'nav clearfix',
                        'menu_id'         => '',
                        'echo'            => true,
                        'items_wrap'      => MipThemeFramework_Util::miptheme_main_menu_wrapper(),
                        'depth'           => 0,
                        'walker'          => new MipThemeFramework_Head_Desktop_Walker_Nav_Menu()
                    );
                    wp_nav_menu( $defaults );
                ?>
                </nav>
                <!-- end:menu -->
            </div>
            <!-- end:header-navigation -->
        </div>
    </div>
    <!-- end:sticky-header -->


</header>
<!-- end:page-header -->

<?php
    do_action('miptheme_unique_posts_after_header');
?>
