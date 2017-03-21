<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();

    $banner_id  = 0;

    if (is_home()) {
        if ( isset($mipthemeoptions_framework['_mp_ads_home_wall']) && ( $mipthemeoptions_framework['_mp_ads_home_wall'] != '') ) {
            $banner_id    = $mipthemeoptions_framework['_mp_ads_home_wall'];

            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatWallAd();
        }

    } else if (function_exists('is_woocommerce') && is_woocommerce()) {

        $banner_id    = isset($mipthemeoptions_framework['_mp_ads_woocommerce_wall']) ? $mipthemeoptions_framework['_mp_ads_woocommerce_wall'] : '';

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatWallAd();
        }

    } else if (is_single()) {

        $banner_id      = get_post_meta($post->ID, '_mp_ads_posts_wall_single', true)      ? get_post_meta($post->ID, '_mp_ads_posts_wall_single', true)      : (isset($mipthemeoptions_framework['_mp_ads_posts_wall']) ? $mipthemeoptions_framework['_mp_ads_posts_wall'] : '');

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatWallAd();
        }

    } else if (is_page()) {

        $banner_id      = get_post_meta($post->ID, '_mp_ads_page_wall_single', true)      ? get_post_meta($post->ID, '_mp_ads_page_wall_single', true)      : (isset($mipthemeoptions_framework['_mp_ads_page_wall']) ? $mipthemeoptions_framework['_mp_ads_page_wall'] : '');

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatWallAd();
        }

    } else if (is_category()) {

        $curr_cat_id    = get_query_var('cat');
        $banner_id      =(isset($mipthemeoptions_framework['_mp_ads_cat_'. $curr_cat_id .'_wall'])&&($mipthemeoptions_framework['_mp_ads_cat_'. $curr_cat_id .'_wall'] != ''))      ? $mipthemeoptions_framework['_mp_ads_cat_'. $curr_cat_id .'_wall']      : (isset($mipthemeoptions_framework['_mp_ads_cat_wall']) ? $mipthemeoptions_framework['_mp_ads_cat_wall'] : '');

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatWallAd();
        }

    } else if (is_author()) {

        $banner_id    = isset($mipthemeoptions_framework['_mp_ads_author_wall']) ? $mipthemeoptions_framework['_mp_ads_author_wall'] : '';

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatWallAd();
        }

    } else if (is_archive()) {

        $banner_id    = isset($mipthemeoptions_framework['_mp_ads_archive_wall']) ? $mipthemeoptions_framework['_mp_ads_archive_wall'] : '';

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatWallAd();
        }

    } else if (function_exists('is_bbpress') && is_bbpress()) {

        $banner_id    = isset($mipthemeoptions_framework['_mp_ads_bbpress_wall']) ? $mipthemeoptions_framework['_mp_ads_bbpress_wall'] : '';

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatWallAd();
        }

    }

    if ( !$banner_id ) {
        $banner_id    = isset($mipthemeoptions_framework['_mp_ads_global_wall']) ? $mipthemeoptions_framework['_mp_ads_global_wall'] : '';

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatWallAd();
        }
    }


?>
