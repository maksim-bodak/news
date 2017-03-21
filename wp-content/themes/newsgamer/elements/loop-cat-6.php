<?php
    $mip_current_page   = mipthemeframework_get_mip_current_page();

    // set counter
    $post_counter       = 2;
    $post_article       = new MipThemeFramework_Article();

    $first_image_attr           = new MipThemeFramework_ImageCat();
    $first_image                = $first_image_attr->get_image_attr_cat_full($mip_current_page->page_sidebar_template);

    $second_image_attr          = new MipThemeFramework_ImageCat();
    $second_image               = $second_image_attr->get_image_attr_cat03($mip_current_page->page_sidebar_template .'-'. $mip_current_page->page_template_grid);


    $image_post_format_first    = $first_image[0];
    $image_post_format_second   = $second_image[0];
    $image_post_first_width     = $first_image[1];
    $image_post_first_height    = $first_image[2];
    $image_post_second_width    = $second_image[1];
    $image_post_second_height   = $second_image[2];
    $shorten_text_chars         = MipThemeFramework_Util::SetCharsValue( $mip_current_page->page_template_chars, 150 );

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


        //check if first post
        if ( $post_counter == 2 ) {

            // display banner
            if ( $mip_current_page->cat_banner_show && ( $mip_current_page->cat_banner_count == 0 ) ) {
                $ad_unit        = new MipThemeFramework_Ad();
                $ad_unit->id    = (int)$mip_current_page->cat_banner_show;
                $ad_unit->formatLayoutAd();
            }

            $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_post_format_first);
            $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : MipThemeFramework_Util::mp_set_dummy_img();

            $post_article->article_thumb_width      = $image_post_first_width;
            $post_article->article_thumb_height     = $image_post_first_height;

            // format output
            echo '<div class="row">'. $post_article->formatArticleCat05('h2', $mip_current_page->page_template_show_category, 0, 'col-xs-12', $mip_current_page->page_template_show_date, $mip_current_page->page_template_show_comments, $mip_current_page->page_template_show_author, $mip_current_page->page_template_show_views) .'</div>';

        //else - if not first post
        } else {
            $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $image_post_format_second);
            $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';

            $post_article->article_thumb_width      = $image_post_second_width;
            $post_article->article_thumb_height     = $image_post_second_height;

            if ( $post_counter%3 == 0 ) {
                // display banner
                if ( $mip_current_page->cat_banner_show && ( $post_counter/3 == $mip_current_page->cat_banner_count ) ) {
                    $ad_unit        = new MipThemeFramework_Ad();
                    $ad_unit->id    = (int)$mip_current_page->cat_banner_show;

                    if ( $post_counter > 3 ) {
                        $ad_unit->formatLayoutAd('col-md-12 ad ad-cat');
                    } else {
                        $ad_unit->formatLayoutAd();
                    }
                }

                if ( $post_counter > 3 ) echo '</div><!-- end:row -->';
                echo '<!-- start:row --><div class="row">';
            }

            // format output
            echo mipthemeframework_get_string_prefix() . $post_article->formatArticleCat02($mip_current_page->page_template_show_category, $shorten_text_chars, 'col-sm-4', $mip_current_page->page_template_show_date, $mip_current_page->page_template_show_comments, $mip_current_page->page_template_show_author, $mip_current_page->page_template_show_views);

        //end - if not first post
        }

        // increase post counter
        $post_counter++;

    endwhile;
    //end loop

    if ( $post_counter > 3 ) echo '</div><!-- end:row -->';

?>
