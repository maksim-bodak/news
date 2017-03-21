<?php

    $mip_current_page   = mipthemeframework_get_mip_current_page();

    // set counter
    $post_counter       = 0;
    $post_article       = new MipThemeFramework_Article();

    $first_image_attr           = new MipThemeFramework_ImageCat();
    $first_image                = $first_image_attr->get_image_attr_cat01($mip_current_page->page_sidebar_template);

    $image_post_format_first    = $first_image[0];
    $image_post_format_second   = '';
    $image_post_first_width     = $first_image[1];
    $image_post_first_height    = $first_image[2];
    $image_post_second_width    = 0;
    $image_post_second_height   = 0;
    $shorten_text_chars         = MipThemeFramework_Util::SetCharsValue( $mip_current_page->page_template_chars, 300 );

    //$image_post_dummy_first     = $first_image_attr->set_dims($image_post_first_width, $image_post_first_height);

    //start the loop
    while ( have_posts() ) : the_post();

        $cat_label              = get_post_meta($post->ID, '_mp_category_label', true) ? get_post_meta($post->ID, '_mp_category_label', true) : 0;

        if ( $cat_label && !$mip_current_page->cat_id ) {
            $curr_cat_id_tmp        = $cat_label;
            $curr_cat_obj           = get_category($curr_cat_id_tmp);
        } else {
            if (!$mip_current_page->cat_id) {
                $curr_cat           = get_the_category();
                $curr_cat_id_tmp    = MipThemeFramework_Util::get_category_top_parent_id($curr_cat[0]->term_id);
                $curr_cat_obj       = get_category($curr_cat_id_tmp);
            } else {
                $curr_cat_id_tmp    = $mip_current_page->cat_id;
                $curr_cat_obj       = $mip_current_page->cat_obj;
            }
        }

        $post_article->cat_ID                           = $curr_cat_id_tmp;
        $post_article->cat_name                         = $curr_cat_obj->name;
        $post_article->article_link                     = $post->ID;
        $post_article->article_title                    = $post->post_title;
        $post_article->article_content                  = ( empty( $post->post_excerpt ) ) ? do_shortcode(get_the_content( esc_html__('Read more', 'Newsgamer') ) ) : $post->post_excerpt;
        $post_article->article_more                     = strpos($post->post_content, '<!--more');
        $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
        $post_article->article_post_date_iso            = get_the_time('c');
        $post_article->article_comments_count           = $post->comment_count;
        $post_article->article_author                   = get_the_author_meta('display_name');
        $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

        if ( has_post_format( 'gallery' )) {
            $post_article->article_post_type    = 'gallery';
        } else if (has_post_format('video')) {
            $post_article->article_post_type    = 'video';
        } else if (has_post_format('image')) {
            $post_article->article_post_type    = 'image';
        } else if (has_post_format('quote')) {
            $post_article->article_post_type    = 'quote';
        } else if (has_post_format('audio')) {
            $post_article->article_post_type    = 'audio';
        } else {
            $post_article->article_post_type    = 'standard';
        }

        $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_post_format_first);
        $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';

        $post_article->article_thumb_width      = $image_post_first_width;
        $post_article->article_thumb_height     = $image_post_first_height;

        // display banner
        if ( $mip_current_page->cat_banner_show && ( $post_counter == $mip_current_page->cat_banner_count ) ) {
            $ad_unit        = new MipThemeFramework_Ad();
            $ad_unit->id    = (int)$mip_current_page->cat_banner_show;
            $ad_unit->formatLayoutAd();
        }

        // $show_category = false, $shorten_text_chars = 300, $show_date = true, $show_comments = false, $show_author = false, $show_views = false
        echo mipthemeframework_get_string_prefix() . $post_article->formatArticleCat01($mip_current_page->page_template_show_category, $shorten_text_chars, $mip_current_page->page_template_show_date, $mip_current_page->page_template_show_comments, $mip_current_page->page_template_show_author, $mip_current_page->page_template_show_views);

        // increase post counter
        $post_counter++;

    endwhile;
    //end loop

?>
