<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();

    $banner_id  = 0;

    if (is_home()) {
        if ( isset($mipthemeoptions_framework['_mp_ads_home_top']) && ( $mipthemeoptions_framework['_mp_ads_home_top'] != '') ) {
            $banner_id    = $mipthemeoptions_framework['_mp_ads_home_top'];

            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatTopAd();
        }

    } else if (function_exists('is_woocommerce') && is_woocommerce()) {

        $banner_id    = isset($mipthemeoptions_framework['_mp_ads_woocommerce_top']) ? $mipthemeoptions_framework['_mp_ads_woocommerce_top'] : '';

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatTopAd();
        }

    } else if (is_single()) {

        $banner_id      = get_post_meta($post->ID, '_mp_ads_posts_top_single', true)      ? get_post_meta($post->ID, '_mp_ads_posts_top_single', true)      : (isset($mipthemeoptions_framework['_mp_ads_posts_top']) ? $mipthemeoptions_framework['_mp_ads_posts_top'] : '');
        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatTopAd();
        }

    } else if (is_page()) {

        $banner_id      = get_post_meta($post->ID, '_mp_ads_page_top_single', true)      ? get_post_meta($post->ID, '_mp_ads_page_top_single', true)      : (isset($mipthemeoptions_framework['_mp_ads_page_top']) ? $mipthemeoptions_framework['_mp_ads_page_top'] : '');

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatTopAd();
        }

    } else if (is_category()) {

        $curr_cat_id    = get_query_var('cat');
        $banner_id      = (isset($mipthemeoptions_framework['_mp_ads_cat_'. $curr_cat_id .'_top'])&&($mipthemeoptions_framework['_mp_ads_cat_'. $curr_cat_id .'_top'] != ''))      ? $mipthemeoptions_framework['_mp_ads_cat_'. $curr_cat_id .'_top']      : (isset($mipthemeoptions_framework['_mp_ads_cat_top']) ? $mipthemeoptions_framework['_mp_ads_cat_top'] : '');

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatTopAd();
        }

    } else if (is_author()) {

        $banner_id    = isset($mipthemeoptions_framework['_mp_ads_author_top']) ? $mipthemeoptions_framework['_mp_ads_author_top'] : '';

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatTopAd();
        }

    } else if (is_archive()) {

        $banner_id    = isset($mipthemeoptions_framework['_mp_ads_archive_top']) ? $mipthemeoptions_framework['_mp_ads_archive_top'] : '';

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatTopAd();
        }

    } else if (function_exists('is_bbpress') && is_bbpress()) {

        $banner_id    = isset($mipthemeoptions_framework['_mp_ads_bbpress_top']) ? $mipthemeoptions_framework['_mp_ads_bbpress_top'] : '';

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatTopAd();
        }

    }

    if ( !$banner_id ) {
        $banner_id    = isset($mipthemeoptions_framework['_mp_ads_global_top']) ? $mipthemeoptions_framework['_mp_ads_global_top'] : '';

        if ( $banner_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_id;
            // display ad unit
            $ad_unit->formatTopAd();
        }
    }


?>
