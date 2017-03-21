<?php

$post_counter   = 1;
$output         = '';
$output_top          = '';
$output_bottom        = '';
while ( $r->have_posts() ) :

    $r->the_post();
    apply_filters("miptheme_unique_posts_filter", $post);

    $cats       = MipThemeFramework_Util::return_category( $post->ID, $mip_top_grid->top_grid_categories, $mip_top_grid->top_grid_category_display );

    $post_article                                   = new MipThemeFramework_Article();
    $post_article->cat_ID                           = $cats[0];
    $post_article->cat_name                         = $cats[1];
    $post_article->article_link                     = $post->ID;
    $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? $r->post->post_content : $r->post->post_excerpt;
    $post_article->article_title                    = $r->post->post_title;
    $post_article->article_review                   = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_review_post');
    $post_article->article_comments_count           = $r->post->comment_count;
    $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
    $post_article->article_post_date_iso            = get_the_time('c');
    $post_article->article_author                   = get_the_author_meta('display_name');
    $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

    $image_attr             = new MipThemeFramework_Image();
    $image                  = $image_attr->get_image_attr_top_grid_8('first');

    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';

    $output     .= '<div class="img-parallax" data-image="'. esc_url($att_img_src[0]) .'"></div>
                    <div class="container">
                        <header>
                            <span class="entry-category parent-cat-'. MipThemeFramework_Util::get_category_top_parent_id($cats[0]) .' cat-'. $cats[0] .'">
                                <a href="'. get_category_link($cats[0]) .'">'. $cats[1] .'</a>
                            </span>
                            <h2><a href="'.  get_the_permalink() .'" title="'.  get_the_title() .'">'.  get_the_title() .'</a></h2>
                            <div class="entry-meta">
                                <time class="entry-date" datetime="'. get_the_time('c') .'">'. get_the_date(MIPTHEME_DATE_DEFAULT) .'</time>
                                <span class="entry-author"><a href="'. get_author_posts_url( $post->post_author ) .'">'. get_the_author_meta( 'display_name', $post->post_author ) .'</a></span>
                                '. ( ( isset($mipthemeoptions_framework['_mpgl_post_postmeta_elements']['comments']) && $mipthemeoptions_framework['_mpgl_post_postmeta_elements']['comments'] ) ? '<span class="entry-comments"><fb:comments-count href="'. get_permalink() .'"></fb:comments-count> '. esc_html__( 'comments', 'Newsgamer' ) .'</span>' : '<span class="entry-comments"><a href="'. get_comments_link() .'">'. get_comments_number('0', '1', '%') .' '. esc_html__( 'comments', 'Newsgamer' ) .'</a></span>' ) .'
                            </div>
                        </header>
                    </div>';

    $post_counter++;
endwhile;

echo    '<div id="single-post-header-full" class="article-post animated fadeIn header-background header-loop-page-6">
            <div class="relative">
                '. $output .'
            </div>
        </div>';
