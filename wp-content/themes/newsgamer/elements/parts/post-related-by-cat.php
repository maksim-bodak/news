<?php
$mip_current_page   = mipthemeframework_get_mip_current_page();

$orig_post = $post;

$categories = get_the_category($post->ID);
if ($categories) {
    $category_ids = array();
    foreach($categories as $individual_category)
        $category_ids[] = $individual_category->term_id;

    $args=array(
        'category__in'          => $category_ids,
        'post__not_in'          => array($post->ID),
        'posts_per_page'        => $mip_current_page->filter_related_posts_count,
        'ignore_sticky_posts'   => 1,
        'orderby'               => $mip_current_page->filter_related_posts_sort,
        'offset'                => $mip_current_page->filter_related_posts_offset,
        'meta_key'              => ( ($mip_current_page->filter_related_posts_sort == 'meta_value_num') ? 'mip_post_views_count' : '' ),
        'no_found_rows'         => true,
        'update_post_term_cache' => false,
	    'update_post_meta_cache' => false,
    );
    $my_query = new wp_query( $args );

    $first_image_attr           = new MipThemeFramework_ImageCat();
    $first_image                = $first_image_attr->get_image_attr_cat03($mip_current_page->page_sidebar_template .'-standard');

    $image_post_format_first    = $first_image[0];
    $image_post_first_width     = $first_image[1];
    $image_post_first_height    = $first_image[2];

    $output = '';

    if( $my_query->have_posts() ) {
        $post_counter   = 0;
        while ($my_query->have_posts()) : $my_query->the_post();
            $category = get_the_category();

            $post_article                                   = new MipThemeFramework_Article();
            $post_article->cat_ID                           = $category[0]->term_id;
            $post_article->cat_name                         = $category[0]->name;
            $post_article->article_link                     = $post->ID;
            $post_article->article_title                    = $post->post_title;
            $post_article->article_content                  = $post->post_content;
            $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
            $post_article->article_comments_count           = $post->comment_count;
            $post_article->article_author                   = get_the_author_meta('display_name');
            $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

            $att_img_src                                    = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_post_format_first);
            $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';

            $post_article->article_thumb_width      = $image_post_first_width;
            $post_article->article_thumb_height     = $image_post_first_height;

            if ( $post_counter%3 == 0 ) {
                if ( $post_counter > 1 ) $output .=  '</div><!-- end:row -->';
                $output .=  '<!-- start:row --><div class="row">';
            }

            $output .=  $post_article->formatArticleCat02(false, false, 'col-sm-4');

            $post_counter++;
        endwhile;
        if ( $post_counter > 0 ) $output .=  '</div><!-- end:row -->';

?>
<aside id="related-posts" class="posts-related loop-cat <?php echo esc_attr($mip_current_page->filter_related_posts_grid); ?> loop-cat-3">
    <?php if ( $mip_current_page->filter_related_posts_title != '' ) echo '<header><h2><span>'. $mip_current_page->filter_related_posts_title .'</span></h2></header>'; ?>
    <div class="cat-layout">
        <?php echo mipthemeframework_get_string_prefix() . $output; ?>
    </div>
</aside>
<?php
    }
    $post = $orig_post;
    wp_reset_postdata();

}
?>
