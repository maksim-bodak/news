<?php
/**
 * Template Name: Visual Composer Page
 */

// load header
get_header();

// Get Page properties
$mip_current_page   = new MipThemeFramework_Page();
?>

    <!-- start:page content -->
    <div id="page-content" class="<?php echo esc_attr($mip_current_page->page_template_class); ?> clearfix">

        <?php
            //get sidebar
            if ( ($mip_current_page->page_sidebar_template == 'left-sidebar')&&(!wp_is_mobile()) ) get_sidebar();
        ?>

        <!-- start:main -->
        <div id="main" class="main no-top-bottom">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();

                    // only content value - output is visual composer
                    the_content();

                endwhile;
            endif;
            ?>
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
