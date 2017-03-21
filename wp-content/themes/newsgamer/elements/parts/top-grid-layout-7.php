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
    $image                  = $image_attr->get_image_attr_top_grid_7('first'. $mip_top_grid->top_grid_full_width);

    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $image[0]);
    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
    $post_article->article_thumb_width     = $image[1];
    $post_article->article_thumb_height    = $image[2];

    $output     .= '<div class="col-md-4">'. $post_article->formatArticleOverlay('h3', $mip_top_grid->top_grid_show_category, $mip_top_grid->top_grid_show_date, $mip_top_grid->top_grid_show_comments, $mip_top_grid->top_grid_show_author, $mip_top_grid->top_grid_show_views, 0, $post_counter) .'</div>';

    $post_counter++;
endwhile;

echo mipthemeframework_get_string_prefix() . $output;
