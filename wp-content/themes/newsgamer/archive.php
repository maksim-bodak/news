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

?>

<!-- start:page content -->
    <div id="page-content" class="<?php echo esc_attr($mip_current_page->page_template_class); ?> clearfix">

        <?php
            //get sidebar
            if ( ($mip_current_page->page_sidebar_template == 'left-sidebar')&&(!wp_is_mobile()) ) get_sidebar();
        ?>

        <!-- start:main -->
        <div id="main" class="main">

            <?php
                // Page Title
                echo wp_kses(
                        $mip_current_page->showTitle(),
                        array(  'header' => array(),
                                'h2' => array(),
                                'span' => array(),
                            )
                    );

                if (have_posts()) :
                    // Get Template
                    echo '<div class="cat-layout clearfix">';
                    get_template_part( 'elements/'. $mip_current_page->page_template .'' );
                    echo '</div>';

                    // Get Pagination
                    get_template_part( 'elements/parts/'. $mip_current_page->page_pagination .'' );
                else :
                    // No Posts
                    esc_html_e('No posts.', 'Newsgamer');
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
