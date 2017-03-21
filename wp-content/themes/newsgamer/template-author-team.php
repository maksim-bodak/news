<?php
/**
 * Template Name: Team Of Authors
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

            <header>
                <h2><span><?php the_title(); ?></span></h2>
            </header>
            <?php the_content(); ?>

            <!-- start:author-page -->
            <section id="author-team-page">

                <?php

                    while ( have_posts() ) : the_post();

                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        if($paged==1){
                          $offset=0;
                        }else {
                           $offset= ($paged-1)*$mip_current_page->page_show_posts_num;
                        }


                        // The Query
                        $user_query                 = new WP_User_Query( $mip_current_page->getArgsForAuthorTeamSorting( $offset, $paged ) );

                        // Include template
                        // User Loop
                        if ( ! empty( $user_query->results ) ) {
                            foreach ( $user_query->results as $user ) {
                        ?>
                                <!-- start:author-box -->
                                <div class="author-box">
                                    <a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo get_avatar( $user->ID, 115 ); ?></a>
                                    <p class="name"><a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo esc_attr( $user->display_name ); ?></a></p>
                                    <?php
                                        // display author actions info
                                        if ( isset( $mipthemeoptions_framework['_mpgl_authorpage_show_author_actions'] ) && (bool)$mipthemeoptions_framework['_mpgl_authorpage_show_author_actions'] ) :
                                    ?>
                                    <div class="author-meta">

                                        <?php
                                            if ( isset($mipthemeoptions_framework['_mpgl_authorpage_show_author_meta'])&&(bool)$mipthemeoptions_framework['_mpgl_authorpage_show_author_meta']['posts'] ) {
                                        ?>
                                        <span class="entry-posts"><?php echo count_user_posts($user->ID). ' '  . esc_html__('posts', 'Newsgamer'); ?></span>
                                        <?php
                                            }

                                            if ( isset($mipthemeoptions_framework['_mpgl_authorpage_show_author_meta'])&&(bool)$mipthemeoptions_framework['_mpgl_authorpage_show_author_meta']['comments'] ) {
                                                // get author views
                                                if ( !(isset($mipthemeoptions_framework['_mpgl_post_facebook_comments_enable']) && (bool)$mipthemeoptions_framework['_mpgl_post_facebook_comments_enable']) ) {
                                                    $author_comments = $mip_current_page->getCommentsForAuthorTeam( $user->ID );
                                                    echo '<span class="entry-comments">'. $author_comments . ' '  . esc_html__('comments', 'Newsgamer') .'</span>';
                                                }
                                            }


                                            if ( isset($mipthemeoptions_framework['_mpgl_authorpage_show_author_meta'])&&(bool)$mipthemeoptions_framework['_mpgl_authorpage_show_author_meta']['views'] ) {
                                                // get author views
                                                $author_post_views = $mip_current_page->getPostViewsForAuthorTeam( $user->ID );
                                        ?>
                                        <span class="entry-views"><?php echo ($author_post_views ? $author_post_views : '0') . ' '  . esc_html__('views', 'Newsgamer'); ?></span>
                                        <?php
                                                wp_reset_postdata();
                                            }
                                        ?>
                                    </div>
                                    <?php
                                        // display author actions info
                                        endif;
                                    ?>
                                    <p class="desc"><?php echo mipthemeframework_get_string_prefix() . $user->description; ?></p>
                                    <p class="follow">
                                    <?php
                                        if ( get_the_author_meta('user_url', $user->ID) ) echo '<a class="home" href="'. esc_url(get_the_author_meta('user_url', $user->ID)) .'"><i class="fa fa-home"></i></a>';
                                        if ( get_the_author_meta('twitter', $user->ID) ) echo '<a class="twitter" href="'. esc_url(get_the_author_meta('twitter', $user->ID)) .'"><i class="fa fa-twitter"></i></a>';
                                        if ( get_the_author_meta('facebook', $user->ID) ) echo '<a class="facebook" href="'. esc_url(get_the_author_meta('facebook', $user->ID)) .'"><i class="fa fa-facebook"></i></a>';
                                        if ( get_the_author_meta('linkedin', $user->ID) ) echo '<a class="linkedin" href="'. esc_url(get_the_author_meta('linkedin', $user->ID)) .'"><i class="fa fa-linkedin"></i></a>';
                                        if ( get_the_author_meta('gplus', $user->ID) ) echo '<a class="google-plus" href="'. esc_url(get_the_author_meta('gplus', $user->ID)) .'"><i class="fa fa-google-plus"></i></a>';
                                        if ( get_the_author_meta('vimeo', $user->ID) ) echo '<a class="vimeo" href="'. esc_url(get_the_author_meta('vimeo', $user->ID)) .'"><i class="fa fa-vimeo"></i></a>';
                                        if ( get_the_author_meta('flickr', $user->ID) ) echo '<a class="flickr" href="'. esc_url(get_the_author_meta('flickr', $user->ID)) .'"><i class="fa fa-flickr"></i></a>';
                                        if ( get_the_author_meta('tumblr', $user->ID) ) echo '<a class="tumblr" href="'. esc_url(get_the_author_meta('tumblr', $user->ID)) .'"><i class="fa fa-tumblr"></i></a>';
                                    ?>
                                    </p>
                                </div>
                                <!-- end:author-box -->
                        <?php
                            }
                        }


                        $total_user = $user_query->total_users;
                        $total_pages=ceil($total_user/$mip_current_page->page_show_posts_num);

                        echo '<div class="post-pagination clearfix">';
                        echo paginate_links(array(
                            'base'      => get_pagenum_link(1) . '%_%',
                            'format'    => '?paged=%#%',
                            'current'   => $paged,
                            'total'     => $total_pages,
                            'prev_next' => false,
                            'type'      => 'plain',
                        ));
                        echo '</div>';


                    endwhile;
                ?>

            </section>
            <!-- end:author-page -->



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
