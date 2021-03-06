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

// Update Post View
MipThemeFramework_Post_Views::update_post_views($post->ID);

// Load Custom post headers
get_template_part( 'elements/parts/post-header-'. $mip_current_page->page_template .'' );
?>

    <!-- start:post-info-bar -->
    <?php if ($mip_current_page->enable_post_info_bar) get_template_part( 'elements/post-info-bar' ); ?>
    <!-- end:post-info-bar -->

    <!-- start:page content -->
    <div id="page-content" class="<?php echo esc_attr($mip_current_page->page_template_class); ?> clearfix">

        <?php
            //get sidebar
            if ( ($mip_current_page->page_sidebar_template == 'left-sidebar')&&(!wp_is_mobile()) ) get_sidebar();
        ?>

        <!-- start:main -->
        <div id="main" class="main article">
            <!-- start:article post -->
            <article id="post-<?php echo esc_attr($post->ID); ?>" <?php post_class('article-post clearfix'); ?> <?php echo MipThemeFramework_Util::get_item_scope( $mip_current_page->review_post ); ?>>
            <?php
                if (have_posts()) :
                    // Get Template
                    get_template_part( 'elements/'. $mip_current_page->page_template .'' );
                else :
                    // No Posts
                    esc_html_e('No posts.', 'Newsgamer');
                endif;
            ?>
            </article>
            <!-- end:article post -->
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
