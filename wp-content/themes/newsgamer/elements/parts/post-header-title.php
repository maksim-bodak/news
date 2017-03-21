<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();
    $mip_current_page   = mipthemeframework_get_mip_current_page();
?>
<header>
    <?php
        // Get Breadcrumbs
        if ( $mip_current_page->enable_breadcrumbs )
            get_template_part('elements/parts/breadcrumb');
    ?>

    <!-- start:article post heading -->
    <h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>
    <!-- end:article post heading -->

    <?php if ( is_single() && $mip_current_page->enable_postmeta ) { ?>
    <!-- start:article post meta -->
    <div class="entry-meta">
        <?php if ( isset($mipthemeoptions_framework['_mpgl_post_postmeta_elements']['date']) && $mipthemeoptions_framework['_mpgl_post_postmeta_elements']['date'] ) : ?><time class="entry-date" datetime="<?php echo get_the_time('c'); ?>" itemprop="dateCreated"><?php echo get_the_date(MIPTHEME_DATE_DEFAULT); ?></time><?php endif; ?>
        <?php if ( isset($mipthemeoptions_framework['_mpgl_post_postmeta_elements']['author']) && $mipthemeoptions_framework['_mpgl_post_postmeta_elements']['author'] ) : ?><span class="entry-author" itemprop="author"><?php //echo get_avatar( get_the_author_meta( 'ID', $post->post_author ), 16 ); ?> <a href="<?php echo get_author_posts_url( $post->post_author ); ?>"><?php the_author_meta( 'display_name', $post->post_author ); ?></a></span><?php endif; ?>
        <?php
            if ( isset($mipthemeoptions_framework['_mpgl_post_postmeta_elements']['categories']) && $mipthemeoptions_framework['_mpgl_post_postmeta_elements']['categories'] ) :
                $cats               = get_the_category();
                $cats_separator     = ', ';
                $cats_output        = '';
                if($cats){
                    foreach($cats as $cat) {
                        $cats_output .= '<a href="'.get_category_link( $cat->term_id ).'" title="' . esc_attr( sprintf( esc_html__( 'View all posts in %s', 'Newsgamer' ), $cat->name ) ) . '">'.$cat->cat_name.'</a>'.$cats_separator;
                    }
                    echo '<span class="entry-categories">'. trim($cats_output, $cats_separator) .'</span>';
                }
            endif;
        ?>
        <?php
            if ( isset($mipthemeoptions_framework['_mpgl_post_postmeta_elements']['comments']) && $mipthemeoptions_framework['_mpgl_post_postmeta_elements']['comments'] ) :
                if ( isset($mipthemeoptions_framework['_mp_post_facebook_comments_enable'])&&(bool)$mipthemeoptions_framework['_mp_post_facebook_comments_enable']) {
        ?>
        <span class="entry-comments"><fb:comments-count href="<?php echo get_permalink(); ?>"></fb:comments-count> <?php esc_html_e( 'comments', 'Newsgamer' ); ?></span>
        <?php
                } else {
        ?>
        <span class="entry-comments"><a href="<?php comments_link(); ?>"><?php comments_number('0', '1', '%'); ?> <?php esc_html_e( 'comments', 'Newsgamer' ); ?></a></span>
        <?php
                }
            endif;
        ?>
        <?php if ( isset($mipthemeoptions_framework['_mpgl_post_postmeta_elements']['views']) && $mipthemeoptions_framework['_mpgl_post_postmeta_elements']['views'] ) : ?><span class="entry-views post-view-counter-<?php echo esc_attr($post->ID);?>"><?php echo MipThemeFramework_Post_Views::get_post_views($post->ID); ?></span><?php endif; ?>
    </div>
    <!-- end:article post meta -->
    <?php } ?>
</header>
