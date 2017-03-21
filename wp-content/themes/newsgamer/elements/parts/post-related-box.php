<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();

    $related_box              = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_single')             ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_single')          : $mipthemeoptions_framework['_mp_enable_related_box'];

    if ( $related_box ) :

        if (function_exists('is_bbpress') && is_bbpress()) {
            return;
        }

        $related_box_float    = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_float_single')       ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_float_single')     : $mipthemeoptions_framework['_mp_enable_related_box_float'];
        $related_box_count    = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_count_single')       ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_count_single')     : $mipthemeoptions_framework['_mp_enable_related_box_count'];
        $related_box_string   = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_single')             ? '_single'                                                 : '';
?>

<!-- start:related-box -->
<aside class="related-box hidden-xs <?php echo esc_attr($related_box_float); ?>">

<?php

        // loop through sections
        for ( $i = 1; $i <= $related_box_count; $i++ ) {

            if ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_single') && ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_count_single') != '' ) ) {
                $section_title      = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_title_'. $i . $related_box_string);
                $section_filter     = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_filter_'. $i . $related_box_string);
                $section_format     = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_format_'. $i . $related_box_string);
                $section_sort       = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_sort_'. $i . $related_box_string);
                $section_count      = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_count_'. $i . $related_box_string);
                $section_offset     = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_related_box_offset_'. $i . $related_box_string);
            } else {
                $section_title      = $mipthemeoptions_framework['_mp_enable_related_box_title_'. $i .''];
                $section_filter     = $mipthemeoptions_framework['_mp_enable_related_box_filter_'. $i .''];
                $section_format     = $mipthemeoptions_framework['_mp_enable_related_box_format_'. $i .''];
                $section_sort       = $mipthemeoptions_framework['_mp_enable_related_box_sort_'. $i .''];
                $section_count      = $mipthemeoptions_framework['_mp_enable_related_box_count_'. $i .''];
                $section_offset     = $mipthemeoptions_framework['_mp_enable_related_box_offset_'. $i .''];
            }

            if ( !empty($section_title) ) echo '<h4><span>'. $section_title .'</span></h4>';

            // set args
            $args = array();

            if ( $section_filter == 'cat' ) {
                // if filter by cat
                $categories = get_the_category($post->ID);
                if ($categories) {
                    $category_ids = array();
                    foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                    $args = array(
                        'category__in'          => $category_ids,
                        'post__not_in'          => array($post->ID),
                        'posts_per_page'        => $section_count,
                        'ignore_sticky_posts'   => 1,
                        'orderby'               => $section_sort,
                        'offset'                => $section_offset,
                        'meta_key'              => ( ($section_sort == 'meta_value_num') ? 'mip_post_views_count' : '' ),
                        'no_found_rows'         => true,
                    );
                }
            } else {
                // if filter by tags
                $tags = wp_get_post_tags($post->ID);
                if ($tags) {
                    $tag_ids    = array();
                    foreach($tags as $individual_tag) {
                        $tag_ids[] = $individual_tag->term_id;
                    }
                    $args=array(
                        'tag__in'               => $tag_ids,
                        'post__not_in'          => array($post->ID),
                        'posts_per_page'        => $section_count,
                        'ignore_sticky_posts '  => 1,
                        'orderby'               => $section_sort,
                        'offset'                => $section_offset,
                        'meta_key'              => ( ($section_sort == 'meta_value_num') ? 'mip_post_views_count' : '' ),
                        'no_found_rows'         => true,
                    );
                }
            }

            $r = new WP_Query( $args );
            if( $r->have_posts() ) {

                echo '<section>';

                while ($r->have_posts()) : $r->the_post();


                    $post_article                                   = new MipThemeFramework_Article();
                    $post_article->article_link                     = $post->ID;
                    $post_article->article_content                  = $r->post->post_content;
                    $post_article->article_title                    = $r->post->post_title;
                    $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                    $post_article->article_post_date_iso            = get_the_time('c');

                    $att_img_src                                    = wp_get_attachment_image_src( get_post_thumbnail_id(), 'miptheme-post-thumb-6');
                    $post_article->article_thumb                    = ( has_post_thumbnail() ) ? $att_img_src[0] : '';

                    echo mipthemeframework_get_string_prefix() . $post_article->formatArticleByStyle( $section_format['image'], $section_format['date'] );

                endwhile;
                wp_reset_postdata();

                echo '</section>';
            }


        } // end loop through sections
?>

</aside>
<!-- end:related-box -->

<?php
    endif;
?>
