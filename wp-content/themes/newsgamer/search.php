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

// load header
get_header();

// Get Page properties
$mip_current_page   = new MipThemeFramework_Page();

?>

<!-- start:page content -->
    <div id="page-content" class="<?php echo esc_attr($mip_current_page->page_template_class); ?> search-page clearfix">

        <?php
            //get sidebar
            if ( ($mip_current_page->page_sidebar_template == 'left-sidebar')&&(!wp_is_mobile()) ) get_sidebar();
        ?>

        <!-- start:main -->
        <div id="main" class="main">

            <header>
                <h2><span><?php printf( __( 'Search Results for: <em>%s</em>', 'Newsgamer' ), get_search_query() ); ?></span></h2>
            </header>

            <?php
                $args = array_merge( $wp_query->query_vars,
                            array(
                                'posts_per_page'    => $mip_current_page->page_show_posts_num,
                                'post_type'         => 'post',
                            )
                        );

                query_posts( $args );

                // Get Template
                echo '<div class="cat-layout clearfix">';
                get_template_part( 'elements/'. $mip_current_page->page_template .'' );
                echo '</div>';

                // Get Pagination
                get_template_part( 'elements/parts/'. $mip_current_page->page_pagination .'' );
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
