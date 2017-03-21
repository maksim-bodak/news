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

$mip_current_page->page_sidebar_template       = isset($mipthemeoptions_framework['_mpgl_woocommercepage_sidebar_template'])    ? $mipthemeoptions_framework['_mpgl_woocommercepage_sidebar_template']          : 'right-sidebar';
$mip_current_page->page_sidebar_source         = $mipthemeoptions_framework['_mpgl_woocommercepage_sidebar_source'];

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

            <!-- start:article-post -->
            <article class="article-post woocommerce-post">

                <?php
                    woocommerce_breadcrumb();
                    woocommerce_content();
                ?>

            </article>
            <!-- end:article-post -->

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
