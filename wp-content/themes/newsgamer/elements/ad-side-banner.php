<div class="container relative">
<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();

    $banner_id  = 0;

    if (is_home()) {

        $banner_left_id      = isset($mipthemeoptions_framework['_mp_ads_home_side_left']) ? $mipthemeoptions_framework['_mp_ads_home_side_left'] : '';
        if ( $banner_left_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_left_id;
            // display ad unit
            $ad_unit->formatLeftSideAd();
        }

        $banner_right_id      = isset($mipthemeoptions_framework['_mp_ads_home_side_right']) ? $mipthemeoptions_framework['_mp_ads_home_side_right'] : '';
        if ( $banner_right_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_right_id;
            // display ad unit
            $ad_unit->formatRightSideAd();
        }

    } else if (function_exists('is_woocommerce') && is_woocommerce()) {

        $banner_left_id      = isset($mipthemeoptions_framework['_mp_ads_woocommerce_side_left']) ? $mipthemeoptions_framework['_mp_ads_woocommerce_side_left'] : '';
        if ( $banner_left_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_left_id;
            // display ad unit
            $ad_unit->formatLeftSideAd();
        }

        $banner_right_id      = isset($mipthemeoptions_framework['_mp_ads_woocommerce_side_right']) ? $mipthemeoptions_framework['_mp_ads_woocommerce_side_right'] : '';
        if ( $banner_right_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_right_id;
            // display ad unit
            $ad_unit->formatRightSideAd();
        }

    } else if (is_single()) {

        $banner_left_id      = get_post_meta($post->ID, '_mp_ads_posts_side_left_single', true)      ? get_post_meta($post->ID, '_mp_ads_posts_side_left_single', true)      : (isset($mipthemeoptions_framework['_mp_ads_posts_side_left']) ? $mipthemeoptions_framework['_mp_ads_posts_side_left'] : '');
        if ( $banner_left_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_left_id;
            // display ad unit
            $ad_unit->formatLeftSideAd();
        }

        $banner_right_id      = get_post_meta($post->ID, '_mp_ads_posts_side_right_single', true)      ? get_post_meta($post->ID, '_mp_ads_posts_side_right_single', true)      : (isset($mipthemeoptions_framework['_mp_ads_posts_side_right']) ? $mipthemeoptions_framework['_mp_ads_posts_side_right'] : '');
        if ( $banner_right_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_right_id;
            // display ad unit
            $ad_unit->formatRightSideAd();
        }

    } else if (is_page()) {

        $banner_left_id      = get_post_meta($post->ID, '_mp_ads_page_side_left_single', true)      ? get_post_meta($post->ID, '_mp_ads_page_side_left_single', true)      : (isset($mipthemeoptions_framework['_mp_ads_page_side_left']) ? $mipthemeoptions_framework['_mp_ads_page_side_left'] : '');
        if ( $banner_left_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_left_id;
            // display ad unit
            $ad_unit->formatLeftSideAd();
        }

        $banner_right_id      = get_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_ads_page_side_right_single')      ? get_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_ads_page_side_right_single')      : (isset($mipthemeoptions_framework['_mp_ads_page_side_right']) ? $mipthemeoptions_framework['_mp_ads_page_side_right'] : '');
        if ( $banner_right_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_right_id;
            // display ad unit
            $ad_unit->formatRightSideAd();
        }

    } else if (is_category()) {

        $curr_cat_id    = get_query_var('cat');

        $banner_left_id      = (isset($mipthemeoptions_framework['_mp_ads_cat_'. $curr_cat_id .'_side_left'])&&($mipthemeoptions_framework['_mp_ads_cat_'. $curr_cat_id .'_side_left'] != ''))      ? $mipthemeoptions_framework['_mp_ads_cat_'. $curr_cat_id .'_side_left']      : (isset($mipthemeoptions_framework['_mp_ads_cat_side_left']) ? $mipthemeoptions_framework['_mp_ads_cat_side_left'] : '');
        if ( $banner_left_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_left_id;
            // display ad unit
            $ad_unit->formatLeftSideAd();
        }

        $banner_right_id      = (isset($mipthemeoptions_framework['_mp_ads_cat_'. $curr_cat_id .'_side_right'])&&($mipthemeoptions_framework['_mp_ads_cat_'. $curr_cat_id .'_side_right'] != ''))      ? $mipthemeoptions_framework['_mp_ads_cat_'. $curr_cat_id .'_side_right']      : (isset($mipthemeoptions_framework['_mp_ads_cat_side_right']) ? $mipthemeoptions_framework['_mp_ads_cat_side_right'] : '');
        if ( $banner_right_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_right_id;
            // display ad unit
            $ad_unit->formatRightSideAd();
        }

    } else if (is_author()) {

        $banner_left_id      = isset($mipthemeoptions_framework['_mp_ads_author_side_left']) ? $mipthemeoptions_framework['_mp_ads_author_side_left'] : '';
        if ( $banner_left_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_left_id;
            // display ad unit
            $ad_unit->formatLeftSideAd();
        }

        $banner_right_id      = isset($mipthemeoptions_framework['_mp_ads_author_side_right']) ? $mipthemeoptions_framework['_mp_ads_author_side_right'] : '';
        if ( $banner_right_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_right_id;
            // display ad unit
            $ad_unit->formatRightSideAd();
        }

    } else if (is_archive()) {

        $banner_left_id      = isset($mipthemeoptions_framework['_mp_ads_archive_side_left']) ? $mipthemeoptions_framework['_mp_ads_archive_side_left'] : '';
        if ( $banner_left_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_left_id;
            // display ad unit
            $ad_unit->formatLeftSideAd();
        }

        $banner_right_id      = isset($mipthemeoptions_framework['_mp_ads_archive_side_right']) ? $mipthemeoptions_framework['_mp_ads_archive_side_right'] : '';
        if ( $banner_right_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_right_id;
            // display ad unit
            $ad_unit->formatRightSideAd();
        }

    } else if (function_exists('is_bbpress') && is_bbpress()) {

        $banner_left_id      = isset($mipthemeoptions_framework['_mp_ads_bbpress_side_left']) ? $mipthemeoptions_framework['_mp_ads_bbpress_side_left'] : '';
        if ( $banner_left_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_left_id;
            // display ad unit
            $ad_unit->formatLeftSideAd();
        }

        $banner_right_id      = isset($mipthemeoptions_framework['_mp_ads_bbpress_side_right']) ? $mipthemeoptions_framework['_mp_ads_bbpress_side_right'] : '';
        if ( $banner_right_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_right_id;
            // display ad unit
            $ad_unit->formatRightSideAd();
        }

    }


    if ( !$banner_id ) {
        $banner_left_id      = isset($mipthemeoptions_framework['_mp_ads_global_side_left']) ? $mipthemeoptions_framework['_mp_ads_global_side_left'] : '';
        if ( $banner_left_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_left_id;
            // display ad unit
            $ad_unit->formatLeftSideAd();
        }

        $banner_right_id      = isset($mipthemeoptions_framework['_mp_ads_global_side_right']) ? $mipthemeoptions_framework['_mp_ads_global_side_right'] : '';
        if ( $banner_right_id ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$banner_right_id;
            // display ad unit
            $ad_unit->formatRightSideAd();
        }
    }



?>
</div>
