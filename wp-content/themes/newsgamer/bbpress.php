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
 * File Created: 20/10/15
 */

// load header
get_header();

// Get Page properties
$mip_current_page   = new MipThemeFramework_Page();

$mip_current_page->page_sidebar_template       = isset($mipthemeoptions_framework['_mpgl_bbPresspage_sidebar_template'])    ? $mipthemeoptions_framework['_mpgl_bbPresspage_sidebar_template']          : 'right-sidebar';
$mip_current_page->page_sidebar_source         = $mipthemeoptions_framework['_mpgl_bbPresspage_sidebar_source'];

$mip_current_page->page_template_class         = $mip_current_page->page_sidebar_template;

?>

<!-- start:page content -->
    <div id="page-content" class="<?php echo esc_attr($mip_current_page->page_template_class); ?> clearfix">

        <?php
            //get sidebar
            if ( ($mip_current_page->page_sidebar_template == 'left-sidebar')&&(!wp_is_mobile()) ) get_sidebar();
        ?>

        <!-- start:main -->
        <div id="main" class="main">

            <?php while ( have_posts() ) : the_post(); ?>
            <!-- start:bbpress-page -->
            <section id="bbpress-page">

                <header>
                    <h1><span><?php the_title(); ?></span></h1>
                </header>

                <!-- start:bbp-listings -->
                <div class="bbp-listings">
                    <?php the_content(); ?>
                </div>
                <!-- end:bbp-listings -->

            </section>
            <!-- end:bbpress-page -->
            <?php endwhile;?>

        </div>
        <!-- end:main -->

        <?php
            //get sidebar
            if ( ($mip_current_page->page_sidebar_template == 'right-sidebar')||( ($mip_current_page->page_sidebar_template == 'left-sidebar')&&(wp_is_mobile()) ) ) get_sidebar();
        ?>

    </div>
    <!-- end:page content -->

<?php
    // load footer
    get_footer();
?>
