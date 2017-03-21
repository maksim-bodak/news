<?php
/**
 * NewsGamer Theme
 *
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 *
 */
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 oldie"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <!-- start:global -->
    <meta charset="<?php bloginfo( 'charset' );?>" />
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"><![endif]-->
    <!-- end:global -->

    <!-- start:responsive web design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end:responsive web design -->

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php
        // Theme Custom Meta
        MipThemeFramework_Util::miptheme_set_meta();
    ?>

    <!-- start:wp_head -->
    <?php wp_head(); ?>
    <!-- end:wp_head -->

    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/respond.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body <?php body_class() ?> itemscope itemtype="http://schema.org/WebPage">

    <!-- start:body-start -->
    <?php get_template_part('elements/body-start'); ?>
    <!-- end:body-start -->

    <!-- start:ad-top-banner -->
    <?php get_template_part('elements/ad-wall-banner'); ?>
    <!-- end:ad-top-banner -->

    <!-- start:page outer wrap -->
    <div id="page-outer-wrap">
        <!-- start:page inner wrap -->
        <div id="page-inner-wrap">

            <!-- start:page header mobile -->
            <?php get_template_part('elements/header-mobile'); ?>
            <!-- end:page header mobile -->

            <!-- start:page header -->
            <?php get_template_part('elements/header-navigation'); ?>
            <!-- end:page header -->

            <!-- start:page top grid -->
            <?php get_template_part('elements/top-grid'); ?>
            <!-- end:page top grid -->

            <!-- start:ad-side-banner -->
            <?php get_template_part('elements/ad-side-banner'); ?>
            <!-- end:ad-side-banner -->

            <!-- start:ad-top-banner -->
            <?php get_template_part('elements/ad-top-banner'); ?>
            <!-- end:ad-top-banner -->

            <!-- start:container -->
            <div id="content-container">
                <div class="container content-shadow">
