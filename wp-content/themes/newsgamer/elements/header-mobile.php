<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();
?>

<header id="page-header-mobile" class="visible-xs visible-sm">

    <!-- start:mobile menu -->
    <nav id="mobile-menu">
        <form id="search-form-mobile" class="mm-search" method="get" action="<?php echo home_url( '/' ); ?>">
            <input type="text" name="s" placeholder="<?php esc_html_e('Search', 'Newsgamer'); ?> <?php bloginfo('name'); ?>" value="<?php echo get_search_query(); ?>" />
        </form>
        <?php
            $defaults = array(
                'theme_location'  => 'mobile-menu',
                'menu'            => '',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'nav clearfix',
                'menu_id'         => '',
                'echo'            => true,
                'depth'           => 0,
                'fallback_cb'     => 'MipThemeFramework_Util::mip_fb_mobile_menu',
                'items_wrap'      => MipThemeFramework_Util::mip_mobile_menu_wrapper(),
                'walker'          => new MipThemeFramework_Head_Mobile_Walker_Nav_Menu()
            );
            wp_nav_menu( $defaults );
        ?>
    </nav>
    <!-- end:mobile menu -->

    <?php
        if ( isset($mipthemeoptions_framework['_mp_ads_mobile_header']) && ($mipthemeoptions_framework['_mp_ads_mobile_header'] != '') ) {
            $banner_id    = $mipthemeoptions_framework['_mp_ads_mobile_header'];

            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatMobileHeaderAd();
        }
    ?>

    <!-- start:row -->
    <div id="mobile-sticky"<?php if ( isset($mipthemeoptions_framework['_mpgl_header_sticky_menu_mobile']) && (bool)$mipthemeoptions_framework['_mpgl_header_sticky_menu_mobile'] ) echo ' data-spy="affix" data-offset-top="50"'; if ( is_admin_bar_showing() ) { echo ' class="row adminbar"'; } else { echo ' class="row"'; } ?>>

        <!-- start:col -->
        <div class="col-xs-2">
            <a id="nav-expander" href="#mobile-menu"><i class="fa fa-bars"></i></a>
        </div>
        <!-- end:col -->

        <!-- start:col -->
        <div class="col-xs-8">
            <?php if (isset($mipthemeoptions_framework['_mp_header_logo_mobile']['url']) && ($mipthemeoptions_framework['_mp_header_logo_mobile']['url'] != '')) { ?>
            <!-- start:logo -->
            <div class="logo"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo esc_url($mipthemeoptions_framework['_mp_header_logo_mobile']['url']); ?>" width="<?php echo esc_attr($mipthemeoptions_framework['_mp_header_logo_mobile']['width']); ?>" height="<?php echo esc_attr($mipthemeoptions_framework['_mp_header_logo_mobile']['height']); ?>" alt="<?php bloginfo('name'); ?>"<?php if ( isset($mipthemeoptions_framework['_mp_header_logo_mobile_retina']['url']) && ($mipthemeoptions_framework['_mp_header_logo_mobile_retina']['url'] != '') ) echo ' data-retina="'. esc_url($mipthemeoptions_framework['_mp_header_logo_mobile_retina']['url']) .'"'; ?> /></a></div>
            <!-- end:logo -->
            <?php } ?>
        </div>
        <!-- end:col -->

        <!-- start:col -->
        <div class="col-xs-2 text-right">

        </div>
        <!-- end:col -->

    </div>
    <!-- end:row -->

</header>
