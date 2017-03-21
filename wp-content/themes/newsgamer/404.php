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

            <div class="info-404 text-center">
                <h1><?php esc_html_e('404', 'Newsgamer' ); ?></h1>
                <h2><?php esc_html_e('Not Found', 'Newsgamer' ); ?></h2>
                <p><?php esc_html_e('Apologies, but the page you requested could not be found. Perhaps searching will help.', 'Newsgamer' ); ?></p>
                <div class="form-404">
                <?php
                    // search form
                    include( get_template_directory() . '/searchform.php' );
                ?>
                </div>
            </div>

            <?php
                if ($mip_current_page->enable_posts) :
                    // display title
                    echo wp_kses(
                            $mip_current_page->showTitle(),
                            array(  'header' => array(),
                                    'h2' => array(),
                                    'span' => array(),
                                )
                        );

                    // change the query
                    query_posts( array('cat'=>0, 'posts_per_page' => $mip_current_page->page_show_posts_num) );

                    // Get Template
                    echo '<div class="cat-layout clearfix">';
                    get_template_part( 'elements/'. $mip_current_page->page_template .'' );
                    echo '</div>';
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
