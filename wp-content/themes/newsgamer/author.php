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
$curauth            = (get_query_var('author_name'))                                        ? get_user_by('slug', get_query_var('author_name'))                     : get_userdata(get_query_var('author'));

?>

<!-- start:page content -->
    <div id="page-content" class="<?php echo esc_attr($mip_current_page->page_template_class); ?> author-page clearfix">

        <?php
            //get sidebar
            if ( ($mip_current_page->page_sidebar_template == 'left-sidebar')&&(!wp_is_mobile()) ) get_sidebar();
        ?>

        <!-- start:main -->
        <div id="main" class="main">

            <!-- start:author-page -->
            <section id="author-page">

                <!-- start:author-box -->
                <div class="author-box">
                    <?php echo get_avatar( $curauth->ID, 115 ); ?>
                    <p class="name"><?php echo esc_html( $curauth->display_name ); ?></p>
                    <?php
                        // display author actions info
                        if ( isset( $mipthemeoptions_framework['_mpgl_authorpage_show_author_actions'] ) && (bool)$mipthemeoptions_framework['_mpgl_authorpage_show_author_actions'] ) :
                    ?>
                    <div class="author-meta">

                        <?php
                            if ( isset($mipthemeoptions_framework['_mpgl_authorpage_show_author_meta'])&&(bool)$mipthemeoptions_framework['_mpgl_authorpage_show_author_meta']['posts'] ) {
                        ?>
                        <span class="entry-posts"><?php echo count_user_posts($curauth->ID). ' '  . esc_html__('posts', 'Newsgamer'); ?></span>
                        <?php
                            }

                            if ( isset($mipthemeoptions_framework['_mpgl_authorpage_show_author_meta'])&&(bool)$mipthemeoptions_framework['_mpgl_authorpage_show_author_meta']['comments'] ) {
                                // get author views
                                if ( !(isset($mipthemeoptions_framework['_mpgl_post_facebook_comments_enable']) && (bool)$mipthemeoptions_framework['_mpgl_post_facebook_comments_enable']) ) {
                                    $author_comments = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) AS author_comment_counts FROM $wpdb->comments WHERE comment_approved = 1 AND user_id = %d", $curauth->ID));
                                    echo '<span class="entry-comments">'. $author_comments . ' '  . esc_html__('comments', 'Newsgamer') .'</span>';
                                }
                            }


                            if ( isset($mipthemeoptions_framework['_mpgl_authorpage_show_author_meta'])&&(bool)$mipthemeoptions_framework['_mpgl_authorpage_show_author_meta']['views'] ) {
                                // get author views
                                $author_posts   = new WP_Query( 'author='. $curauth->ID .'&posts_per_page=-1' );
                                $view_counter   = 0;
                                if ($author_posts->have_posts()) :
                                    while ( $author_posts->have_posts() ) :
                                        $author_posts->the_post();
                                        $views = absint( MipThemeFramework_Post_Views::get_post_views($post->ID) );
                                        $view_counter += $views;
                                    endwhile;
                                endif;
                        ?>
                        <span class="entry-views"><?php echo esc_html( $view_counter ) . ' '  . esc_html__('views', 'Newsgamer'); ?></span>
                        <?php
                                wp_reset_postdata();
                            }
                        ?>
                    </div>
                    <?php
                        // display author actions info
                        endif;
                    ?>
                    <p class="desc"><?php echo esc_html( $curauth->description ); ?></p>
                    <p class="follow">
                    <?php
                        if ( get_the_author_meta('user_url', $curauth->ID) ) echo '<a class="home" href="'. esc_url(get_the_author_meta('user_url', $curauth->ID)) .'"><i class="fa fa-home"></i></a>';
                        if ( get_the_author_meta('twitter', $curauth->ID) ) echo '<a class="twitter" href="'. esc_url(get_the_author_meta('twitter', $curauth->ID)) .'"><i class="fa fa-twitter"></i></a>';
                        if ( get_the_author_meta('facebook', $curauth->ID) ) echo '<a class="facebook" href="'. esc_url(get_the_author_meta('facebook', $curauth->ID)) .'"><i class="fa fa-facebook"></i></a>';
                        if ( get_the_author_meta('linkedin', $curauth->ID) ) echo '<a class="linkedin" href="'. esc_url(get_the_author_meta('linkedin', $curauth->ID)) .'"><i class="fa fa-linkedin"></i></a>';
                        if ( get_the_author_meta('gplus', $curauth->ID) ) echo '<a class="google-plus" href="'. esc_url(get_the_author_meta('gplus', $curauth->ID)) .'"><i class="fa fa-google-plus"></i></a>';
                        if ( get_the_author_meta('vimeo', $curauth->ID) ) echo '<a class="vimeo" href="'. esc_url(get_the_author_meta('vimeo', $curauth->ID)) .'"><i class="fa fa-vimeo"></i></a>';
                        if ( get_the_author_meta('flickr', $curauth->ID) ) echo '<a class="flickr" href="'. esc_url(get_the_author_meta('flickr', $curauth->ID)) .'"><i class="fa fa-flickr"></i></a>';
                        if ( get_the_author_meta('tumblr', $curauth->ID) ) echo '<a class="tumblr" href="'. esc_url(get_the_author_meta('tumblr', $curauth->ID)) .'"><i class="fa fa-tumblr"></i></a>';
                    ?>
                    </p>
                </div>
                <!-- end:author-box -->

            </section>
            <!-- end:author-page -->

            <?php
                // display title
                echo wp_kses(
                        $mip_current_page->showTitle(),
                        array(  'header' => array(),
                                'h2' => array(),
                                'span' => array(),
                            )
                    );

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
