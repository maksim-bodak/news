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
$mip_current_page->page_template_class = 'right-sidebar';

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
            <article class="article-post clearfix">
            <?php
                if (have_posts()) {
                    while ( have_posts() ) : the_post();

                        $att_url = '';
                        $att_alt = '';

                        if ( wp_attachment_is_image( $post->id ) ) {
                            $att_img_src = wp_get_attachment_image_src( $post->id, 'full');

                            if (!empty($att_img_src[0])) {
                                $att_url = $att_img_src[0];
                            }

                            if (empty($att_img_src[0])) {
                                $att_img_src[0] = '';
                            }

                            $att_img_data = MipThemeFramework_Util::get_image_attachment_data($post->post_parent);
                            if (!empty($att_img_data->alt)) {
                                $att_alt = $att_img_data->alt;
                            }

            ?>

            <header itemscope="" itemtype="http://schema.org/Article">
                <?php get_template_part('elements/parts/breadcrumb'); ?>
                <h1 itemprop="name"><?php the_title(); ?></h1>
            </header>

            <a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment">
                <img class="img-responsive" src="<?php echo esc_url($att_url); ?>" alt="<?php echo esc_attr($att_alt) ?>" />
            </a>

            <p>
                <?php the_content(); ?>
            </p>
            <?php
                        }
                    endwhile; //end loop
                } else {
                    esc_html_e('No posts.', 'Newsgamer');
                }
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
