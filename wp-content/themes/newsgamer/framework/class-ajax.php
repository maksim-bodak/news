<?php
/**
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */

if ( ! class_exists( 'MipThemeFramework_Ajax' ) ) {

    class MipThemeFramework_Ajax {

        // init var
        public $ajax_query                  = '';
        public $post_id                     = '';
        public $post_block_type             = '';
        public $image_post_format_first     = '';
        public $image_post_format_second    = '';
        public $image_post_first_width      = '';
        public $image_post_first_height     = '';
        public $image_post_second_width     = '';
        public $image_post_second_height    = '';
        public $shorten_text_chars          = '';
        public $shorten_text_chars_images   = '';
        public $category_multiple_id        = '';
        public $category_display            = '';
        public $post_limit                  = '';
        public $post_limit_images           = 1;
        public $post_offset                 = '';
        public $post_tag_slug               = '';
        public $post_sort                   = '';
        public $post_index                  = '';
        public $post_meta                   = 1;
        public $image_post_dummy_first      = '';
        public $image_post_dummy_second     = '';
        public $layout_columns              = 1;
        public $layout_type                 = '';
        public $article_no_ajax_call        = true;


        public function __construct() {
            if( isset($_POST) && count($_POST) > 0 ) {
                $this->post_block_type            = ( isset($_POST['data_block']) ? $_POST['data_block'] : '');
                $this->image_post_format_first    = ( isset($_POST['data_img_format_1']) ? $this->checkImgDim($_POST['data_img_format_1']) : '');
                $this->image_post_format_second   = ( isset($_POST['data_img_format_2']) ? $this->checkImgDim($_POST['data_img_format_2']) : '');
                $this->image_post_first_width     = ( isset($_POST['data_img_width_1']) ? $_POST['data_img_width_1'] : '');
                $this->image_post_first_height    = ( isset($_POST['data_img_height_1']) ? $_POST['data_img_height_1'] : '');
                $this->image_post_second_width    = ( isset($_POST['data_img_width_2']) ? $_POST['data_img_width_2'] : '');
                $this->image_post_second_height   = ( isset($_POST['data_img_height_2']) ? $_POST['data_img_height_2'] : '');
                $this->shorten_text_chars         = ( isset($_POST['data_text']) ? $_POST['data_text'] : '');
                $this->shorten_text_chars_images  = ( isset($_POST['data_text_img']) ? $_POST['data_text_img'] : '');
                $this->category_multiple_id       = ( isset($_POST['data_cat']) ? $_POST['data_cat'] : '');
                $this->category_display           = ( isset($_POST['data_display']) ? $_POST['data_display'] : '');
                $this->post_limit                 = ( isset($_POST['data_count']) ? $_POST['data_count'] : '');
                $this->post_limit_images          = ( isset($_POST['data_count_img']) ? $_POST['data_count_img'] : 1);
                $this->post_offset                = ( isset($_POST['data_offset']) ? $_POST['data_offset'] : '');
                $this->post_tag_slug              = ( isset($_POST['data_tag']) ? $_POST['data_tag'] : '');
                $this->post_sort                  = ( isset($_POST['data_sort']) ? $_POST['data_sort'] : '');
                $this->post_index                 = ( isset($_POST['data_index']) ? $_POST['data_index'] : '');
                $this->post_meta                  = ( isset($_POST['data_meta']) ? $_POST['data_meta'] : '');
                $this->layout_columns             = ( isset($_POST['data_columns']) ? $_POST['data_columns'] : '');
                $this->layout_type                = ( isset($_POST['data_layout']) ? $_POST['data_layout'] : '');
                $this->article_no_ajax_call       = false;
            }
        }


        private function getPostMeta() {
            $bDate      = ( in_array($this->post_meta, array('0','8','9','10','11','12','13')) )        ? 0 : 1;
            $bComments  = ( in_array($this->post_meta, array('3','4','5','6','9','10','11','12')) )     ? 1 : 0;
            $bAuthor    = ( in_array($this->post_meta, array('2','4','5','8','10','11')) )              ? 1 : 0;
            $bViews     = ( in_array($this->post_meta, array('5','6','7','11','12','13')) )             ? 1 : 0;

            return array($bDate, $bComments, $bAuthor, $bViews);
        }


        public static function checkImgDim( $sValue ) {
            if (is_array($sValue)) {
                return $sValue;
            } else {
                $pos_value = strrpos($sValue, "_dim_");
                if ($pos_value === false) {
                    return $sValue;
                } else {
                    $img_dim = explode("_dim_", $sValue);
                    return array(intval($img_dim[0]),intval($img_dim[1]));
                }
            }
        }


        private function setImgDim() {
            $this->image_post_format_first    = $this->checkImgDim($this->image_post_format_first);
            $this->image_post_format_second   = $this->checkImgDim($this->image_post_format_second);
        }


        public static function mipthemeAjaxBlock() {

            global $post;
            $post_ajax                          = new MipThemeFramework_Ajax();

            $args   = array(
                        'cat'                   => $post_ajax->category_multiple_id,
                        'posts_per_page'        => $post_ajax->post_limit,
                        'offset'                => $post_ajax->post_offset + (($post_ajax->post_index-1)*$post_ajax->post_limit),
                        'tag'                   => $post_ajax->post_tag_slug,
                        'no_found_rows'         => true,
                        'post_status'           => 'publish',
                        'ignore_sticky_posts'   => true,
                        'orderby'               => ( (in_array($post_ajax->post_sort, array('mip_post_views_count', '_mip_post_views_count_7_day_total', '_mip_post_views_count_24_hours_total'))) ? 'meta_value_num' : $post_ajax->post_sort ),
                        'meta_key'              => ( (in_array($post_ajax->post_sort, array('mip_post_views_count', '_mip_post_views_count_7_day_total', '_mip_post_views_count_24_hours_total'))) ? $post_ajax->post_sort : '' ),
                        'paged'                 => $post_ajax->post_index
                    );

            // add review meta
            //if ( $post_ajax->post_block_type == 'block-07' ) $args = array_merge($args, array('meta_key' => '_mp_review_post_total_score'));

            // add video meta
            if ( $post_ajax->post_block_type == 'block-video' ) $args = array_merge($args, array('tax_query' => array(array('taxonomy' => 'post_format','field' => 'slug','terms' => array( 'post-format-video'))) ));

            // add gallery meta
            if ( $post_ajax->post_block_type == 'block-gallery' ) $args = array_merge($args, array('tax_query' => array(array('taxonomy' => 'post_format','field' => 'slug','terms' => array( 'post-format-gallery'))) ));

            // add audio meta
            if ( $post_ajax->post_block_type == 'block-audio' ) $args = array_merge($args, array('tax_query' => array(array('taxonomy' => 'post_format','field' => 'slug','terms' => array( 'post-format-audio'))) ));

            // set unique posts if enabled
            // if ( (bool)MipThemeFramework_UniquePosts::$unique_posts_enabled ) $args = array_merge($args, array('post__not_in' => MipThemeFramework_UniquePosts::$unique_posts_ids));

            $r = new WP_Query( apply_filters( 'ajax_blocks_posts_args', $args ) );

            $output = '';

            if ($r->have_posts()) :

                $post_ajax->ajax_query                  = $r;
                $post_ajax->post_id                     = $r->post->ID;

                switch ( $post_ajax->post_block_type ) {
                    case 'block-01-left':
                        $output .= $post_ajax->formatBlock1Left();
                    break;
                    case 'block-01-right':
                        $output .= $post_ajax->formatBlock1Right();
                    break;
                    case 'block-02-left':
                        $output .= $post_ajax->formatBlock2Left();
                    break;
                    case 'block-02-right':
                        $output .= $post_ajax->formatBlock2Right();
                    break;
                    case 'block-03':
                        $output .= $post_ajax->formatBlock3();
                    break;
                    case 'block-04':
                        $output .= $post_ajax->formatBlock4();
                    break;
                    case 'block-05':
                        $output .= $post_ajax->formatBlock5();
                    break;
                    case 'block-06':
                        $output .= $post_ajax->formatBlock6();
                    break;
                    case 'block-07':
                        $output .= $post_ajax->formatBlock7();
                    break;
                    case 'block-08':
                        $output .= $post_ajax->formatBlock8();
                    break;
                    case 'block-09':
                        $output .= $post_ajax->formatBlock9();
                    break;
                    case 'block-10':
                        $output .= $post_ajax->formatBlock10();
                    break;
                    case 'block-11':
                        $output .= $post_ajax->formatBlock11();
                    break;
                    case 'block-12':
                        $output .= $post_ajax->formatBlock12();
                    break;
                    case 'block-13-right':
                        $output .= $post_ajax->formatBlock13Right();
                    break;
                    case 'block-14-left':
                        $output .= $post_ajax->formatBlock14Left();
                    break;
                }

            endif;
            wp_reset_postdata();

            echo mipthemeframework_get_string_prefix() . $output;
            die();

        }


        public function formatBlock1Left() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 1;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                //check if first post
                if ( $post_counter <= $this->post_limit_images ) {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_first_width;
                    $post_article->article_thumb_height    = $this->image_post_first_height;

                    // format output
                    $output .= $post_article->formatVCBlock_1(true, $post_article->article_show_category, $this->shorten_text_chars_images, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //else - check if first post
                } else {

                    // format output
                    $output .= $post_article->formatVCBlock_1(false, $post_article->article_show_category, $this->shorten_text_chars, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //end - check if first post
                }

                $post_counter++;
            endwhile;

            return $output;
        }


        public function formatBlock1Right() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 1;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                //check if first post
                if ( $post_counter == 1 ) {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_first_width;
                    $post_article->article_thumb_height    = $this->image_post_first_height;

                    // format output
                    $output .= '<div class="shadow-box shadow-top-left box-overlay">'. $post_article->formatArticleOverlay('h2', $post_article->article_show_category, $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]) .'</div>'; // $heading = 'h2', $show_category = false

                //else - check if first post
                } else {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_second);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_second_width;
                    $post_article->article_thumb_height    = $this->image_post_second_height;

                    // format output
                    $output .= '<div class="shadow-box shadow-top-left clearfix">'. $post_article->formatArticleSplit($post_article->article_show_category, $aPostMeta[0], $aPostMeta[3], 'col-xs-4', 'col-xs-8 no-left', $this->shorten_text_chars, $aPostMeta[1], $aPostMeta[2]) .'</div>'; // $show_category = true, $show_date = true, $show_views = false, $class1 = ' col-sm-6', $class2 = ' col-sm-6', $shorten_text_chars = 0

                //end - check if first post
                }

                $post_counter++;
            endwhile;

            return $output;
        }


        public function formatBlock2Left() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 1;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                //check if first post
                if ( $post_counter == 1 ) {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_first_width;
                    $post_article->article_thumb_height    = $this->image_post_first_height;

                    // format output
                    $output .= '<div class="shadow-box shadow-top-left clearfix">'. $post_article->formatArticleSplit($post_article->article_show_category, $aPostMeta[0], $aPostMeta[3], 'col-xs-6', 'col-xs-6 no-left', $this->shorten_text_chars_images, $aPostMeta[1], $aPostMeta[2]) .'</div>'; // $show_category = true, $show_date = true, $show_views = false, $class1 = ' col-sm-6', $class2 = ' col-sm-6', $shorten_text_chars = 0

                //else - check if first post
                } else {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_second);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_second_width;
                    $post_article->article_thumb_height    = $this->image_post_second_height;

                    // format output
                    $output .= '<div class="shadow-box shadow-top-left clearfix">'. $post_article->formatArticleSplit($post_article->article_show_category, $aPostMeta[0], $aPostMeta[3], 'col-xs-4', 'col-xs-8 no-left', $this->shorten_text_chars, $aPostMeta[1], $aPostMeta[2]) .'</div>'; // $show_category = true, $show_date = true, $show_views = false, $class1 = ' col-sm-6', $class2 = ' col-sm-6', $shorten_text_chars = 0

                //end - check if first post
                }

                $post_counter++;
            endwhile;

            return $output;
        }


        public function formatBlock2Right() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 1;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                //check if first post
                if ( $post_counter <= $this->post_limit_images ) {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_first_width;
                    $post_article->article_thumb_height    = $this->image_post_first_height;

                    // format output
                    $output .= $post_article->formatVCBlock_1(true, $post_article->article_show_category, $this->shorten_text_chars_images, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //else - check if first post
                } else {

                    // format output
                    $output .= $post_article->formatVCBlock_1(false, $post_article->article_show_category, $this->shorten_text_chars, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //end - check if first post
                }

                $post_counter++;
            endwhile;

            return $output;
        }


        public function formatBlock3() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 1;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                //check if first post
                if ( $post_counter <= $this->post_limit_images ) {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_first_width;
                    $post_article->article_thumb_height    = $this->image_post_first_height;

                    // format output
                    $output .= $post_article->formatVCBlock_1(true, $post_article->article_show_category, $this->shorten_text_chars_images, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //else - check if first post
                } else {

                    // format output
                    $output .= $post_article->formatVCBlock_1(false, $post_article->article_show_category, $this->shorten_text_chars, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //end - check if first post
                }

                $post_counter++;
            endwhile;

            return $output;
        }


        public function formatBlock4() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 1;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                //check if first post
                //if ( $post_counter == 1 ) {
                if ( $post_counter <= $this->post_limit_images ) {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_first_width;
                    $post_article->article_thumb_height    = $this->image_post_first_height;

                    // format output
                    $output .= $post_article->formatVCBlock_1(true, $post_article->article_show_category, $this->shorten_text_chars_images, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //else - check if first post
                } else {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_second);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_second_width;
                    $post_article->article_thumb_height    = $this->image_post_second_height;

                    // format output
                    $output .= '<div class="shadow-box shadow-top-left clearfix">'. $post_article->formatArticleSplit($post_article->article_show_category, $aPostMeta[0], $aPostMeta[3], 'col-xs-6', 'col-xs-6 no-left', $this->shorten_text_chars, $aPostMeta[1], $aPostMeta[2]) .'</div>'; // $show_category = true, $show_date = true, $show_views = false, $class1 = ' col-sm-6', $class2 = ' col-sm-6', $shorten_text_chars = 0

                //end - check if first post
                }

                $post_counter++;
            endwhile;

            return $output;
        }


        public function formatBlock5() {

            global $post;

            $r                      = $this->ajax_query;
            $output[]               = array();
            $output[0]               = '';
            $output[1]               = '';
            $output[2]               = '';
            $post_counter           = 1;
            $post_column_counter    = 0;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                //check if row with images
                if ( $post_counter <= $this->post_limit_images*3 ) {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_first_width;
                    $post_article->article_thumb_height    = $this->image_post_first_height;

                    // format output
                    $article_tmp = $post_article->formatVCBlock_1(true, $post_article->article_show_category, $this->shorten_text_chars_images, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //else - check if first post
                } else {

                    // format output
                    $article_tmp = $post_article->formatVCBlock_1(false, $post_article->article_show_category, $this->shorten_text_chars, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //end - check if first post
                }

                $output_tmp                     = $output[$post_column_counter];
                $output[$post_column_counter]   = $output_tmp . $article_tmp;

                if ( $post_column_counter == 2 ) {
                    $post_column_counter = 0;
                } else {
                    $post_column_counter++;
                }

                $post_counter++;
            endwhile;

            return '<div class="row">
                        <div class="col-sm-4 shadow-ver-right has-header">
                            '. $output[0] .'
                        </div>
                        <div class="col-sm-4 shadow-ver-right has-header">
                            '. $output[1] .'
                        </div>
                        <div class="col-sm-4 has-header">
                            '. $output[2] .'
                        </div>
                    </div>';
        }


        public function formatBlock6() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 1;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                //check if first post
                if ( $post_counter == 1 ) {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_first_width;
                    $post_article->article_thumb_height    = $this->image_post_first_height;

                    // format output
                    $output .= '<div class="col-sm-6 shadow-ver-right">'. $post_article->formatVCBlock_1(true, $post_article->article_show_category, $this->shorten_text_chars_images, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]) .'</div>'; // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'
                    $output .= '<div class="col-sm-6">';

                //else - check if first post
                } else {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_second);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_second_width;
                    $post_article->article_thumb_height    = $this->image_post_second_height;

                    // format output
                    $output .= '<div class="shadow-box shadow-top-left clearfix">'. $post_article->formatArticleSplit($post_article->article_show_category, $aPostMeta[0], $aPostMeta[3], 'col-xs-6', 'col-xs-6 no-left', $this->shorten_text_chars, $aPostMeta[1], $aPostMeta[2]) .'</div>'; // $show_category = true, $show_date = true, $show_views = false, $class1 = ' col-sm-6', $class2 = ' col-sm-6', $shorten_text_chars = 0

                //end - check if first post
                }

                $post_counter++;
            endwhile;
            $output .= '</div>';

            return $output;
        }


        public function formatBlock7() {

            global $post;

            $r              = $this->ajax_query;
            $output_left    = '';
            $output_right   = '';
            $post_counter   = 1;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                //check if first post
                if ( $post_counter == 1 ) {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_first_width;
                    $post_article->article_thumb_height    = $this->image_post_first_height;

                    // format output
                    $output_right .= $post_article->formatVCBlock_1(true, $post_article->article_show_category, $this->shorten_text_chars_images, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //else - check if first post
                } else {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_second);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_second_width;
                    $post_article->article_thumb_height    = $this->image_post_second_height;

                    // format output
                    $output_left .= '<div class="shadow-box shadow-top-left clearfix">'. $post_article->formatArticleSplit($post_article->article_show_category, $aPostMeta[0], $aPostMeta[3], 'col-xs-6', 'col-xs-6 no-left', $this->shorten_text_chars, $aPostMeta[1], $aPostMeta[2]) .'</div>'; // $show_category = true, $show_date = true, $show_views = false, $class1 = ' col-sm-6', $class2 = ' col-sm-6', $shorten_text_chars = 0

                //end - check if first post
                }

                $post_counter++;
            endwhile;

            return '<div class="col-sm-6 shadow-ver-right">'. $output_left .'</div><div class="col-sm-6">'. $output_right .'</div>';
        }


        public function formatBlock8() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 0;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                if ( $post_counter%2 == 0 ) {
                    if ( $post_counter > 1 ) $output .= '</div><!-- end:row -->';
                    $output .= '<!-- start:row --><div class="row">';
                }

                $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                $post_article->article_thumb_width     = $this->image_post_first_width;
                $post_article->article_thumb_height    = $this->image_post_first_height;

                // format output
                $output .= '<div class="col-sm-6">'. $post_article->formatVCBlock_1(true, $post_article->article_show_category, $this->shorten_text_chars, 'shadow-box', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]) .'</div>'; // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                $post_counter++;
            endwhile;
            if ( $post_counter > 0 ) $output .= '</div><!-- end:row -->';

            return $output;
        }


        public function formatBlock9() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 0;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                if ( $post_counter%3 == 0 ) {
                    if ( $post_counter > 1 ) $output .= '</div><!-- end:row -->';
                    $output .= '<!-- start:row --><div class="row">';
                }

                $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                $post_article->article_thumb_width     = $this->image_post_first_width;
                $post_article->article_thumb_height    = $this->image_post_first_height;

                // format output
                $output .= '<div class="col-sm-4">'. $post_article->formatVCBlock_1(true, $post_article->article_show_category, $this->shorten_text_chars, 'shadow-box', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]) .'</div>'; // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                $post_counter++;
            endwhile;
            if ( $post_counter > 0 ) $output .= '</div><!-- end:row -->';

            return $output;
        }


        public function formatBlock10() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 0;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                if ( $post_counter%2 == 0 ) {
                    if ( $post_counter > 1 ) $output .= '</div><!-- end:row -->';
                    $output .= '<!-- start:row --><div class="row">';
                }

                $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                $post_article->article_thumb_width     = $this->image_post_first_width;
                $post_article->article_thumb_height    = $this->image_post_first_height;

                // format output
                $output .= '<div class="col-sm-6">'. $post_article->formatArticleOverlay('h3', $post_article->article_show_category, $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]) .'</div>';

                $post_counter++;
            endwhile;
            if ( $post_counter > 0 ) $output .= '</div><!-- end:row -->';

            return $output;
        }


        public function formatBlock11() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 1;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                //check if first post
                if ( $post_counter == 1 ) {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_first_width;
                    $post_article->article_thumb_height    = $this->image_post_first_height;

                    // format output
                    $output .= $post_article->formatVCBlock_1(true, $post_article->article_show_category, $this->shorten_text_chars_images, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //else - check if first post
                } else {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_second);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_second_width;
                    $post_article->article_thumb_height    = $this->image_post_second_height;

                    // format output
                    $output .= '<div class="shadow-box shadow-top-left clearfix">'. $post_article->formatArticleSplit($post_article->article_show_category, $aPostMeta[0], $aPostMeta[3], 'col-xs-6', 'col-xs-6 no-left', $this->shorten_text_chars, $aPostMeta[1], $aPostMeta[2]) .'</div>'; // $show_category = true, $show_date = true, $show_views = false, $class1 = ' col-sm-6', $class2 = ' col-sm-6', $shorten_text_chars = 0

                //end - check if first post
                }

                $post_counter++;
            endwhile;

            return $output;
        }


        public function formatBlock12() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 1;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                //check if first post
                if ( $post_counter <= $this->post_limit_images ) {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_first_width;
                    $post_article->article_thumb_height    = $this->image_post_first_height;

                    // format output
                    $output .= $post_article->formatVCBlock_1(true, $post_article->article_show_category, $this->shorten_text_chars_images, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //else - check if first post
                } else {

                    // format output
                    $output .= $post_article->formatVCBlock_1(false, $post_article->article_show_category, $this->shorten_text_chars, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //end - check if first post
                }

                $post_counter++;
            endwhile;

            return $output;
        }


        public function formatBlock13Right() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 1;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                //check if first post
                if ( $post_counter == 1 ) {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_first_width;
                    $post_article->article_thumb_height    = $this->image_post_first_height;

                    // format output
                    $output .= '<div class="shadow-box shadow-top-left box-overlay">'. $post_article->formatArticleOverlay('h2', $post_article->article_show_category, $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3], $this->shorten_text_chars_images) .'</div>'; // $heading = 'h2', $show_category = false

                //else - check if first post
                } else {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_second);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_second_width;
                    $post_article->article_thumb_height    = $this->image_post_second_height;

                    // format output
                    $output .= '<div class="shadow-box shadow-top-left clearfix">'. $post_article->formatArticleSplit($post_article->article_show_category, $aPostMeta[0], $aPostMeta[3], 'col-xs-4', 'col-xs-8 no-left', $this->shorten_text_chars, $aPostMeta[1], $aPostMeta[2]) .'</div>'; // $show_category = true, $show_date = true, $show_views = false, $class1 = ' col-sm-6', $class2 = ' col-sm-6', $shorten_text_chars = 0

                //end - check if first post
                }

                $post_counter++;
            endwhile;

            return $output;
        }


        public function formatBlock14Left() {

            global $post;

            $r              = $this->ajax_query;
            $output         = '';
            $post_counter   = 1;

            while ( $r->have_posts() ) :
                $r->the_post();
                $this->setImgDim();
                apply_filters("miptheme_unique_posts_filter", $post);

                $cats       = MipThemeFramework_Util::return_category( $post->ID, explode(',', $this->category_multiple_id), $this->category_display );

                $post_article                                   = new MipThemeFramework_Article();
                $post_article->cat_ID                           = $cats[0];
                $post_article->cat_name                         = $cats[1];
                $post_article->article_link                     = $post->ID;
                $post_article->article_title                    = $r->post->post_title;
                $post_article->article_content                  = ( empty( $r->post->post_excerpt ) ) ? do_shortcode( $r->post->post_content ) : $r->post->post_excerpt;
                $post_article->article_post_date                = get_the_time(MIPTHEME_DATE_DEFAULT);
                $post_article->article_post_date_iso            = get_the_time('c');
                $post_article->article_comments_count           = $r->post->comment_count;
                $post_article->article_no_ajax_call             = $this->article_no_ajax_call;
                $post_article->article_show_category            = $this->category_display == 'none' ? false : true;
                $post_article->article_author                   = get_the_author_meta('display_name');
                $post_article->article_author_url               = get_author_posts_url( get_the_author_meta( 'ID' ) );

                $aPostMeta = $this->getPostMeta();

                //check if first post
                if ( $post_counter <= $this->post_limit_images ) {
                    $att_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), $this->image_post_format_first);
                    $post_article->article_thumb = ( has_post_thumbnail() ) ? $att_img_src[0] : '';
                    $post_article->article_thumb_width     = $this->image_post_first_width;
                    $post_article->article_thumb_height    = $this->image_post_first_height;

                    // format output
                    $output .= '<div class="shadow-box shadow-top-left box-overlay">'. $post_article->formatArticleOverlay('h3', $post_article->article_show_category, $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3], $this->shorten_text_chars_images) .'</div>'; // $heading = 'h2', $show_category = false
                    //$output .= $post_article->formatVCBlock_1(true, $post_article->article_show_category, $this->shorten_text_chars_images, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //else - check if first post
                } else {

                    // format output
                    $output .= $post_article->formatVCBlock_1(false, $post_article->article_show_category, $this->shorten_text_chars, 'shadow-box shadow-top-left', $aPostMeta[0], $aPostMeta[1], $aPostMeta[2], $aPostMeta[3]); // $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left'

                //end - check if first post
                }

                $post_counter++;
            endwhile;

            return $output;
        }


        static function setAjaxNav( $data_container, $pos = 'ajax-nav-footer', $layout_columns = '', $layout_type = '' ) {
            return '<div class="paging mip-ajax-nav '. $pos .'">
                        <a class="prev disabled" data-container="'. $data_container .'" data-index="0" data-columns="'. $layout_columns .'" data-layout="'. $layout_type .'" href="#"></a>
                        <a class="next" data-container="'. $data_container .'" data-index="2" data-columns="'. $layout_columns .'" data-layout="'. $layout_type .'" href="#"></a>
                    </div>';
        }


    }

}



/**
 * Update the view counter for single post page
 */
function miptheme_ajax_update_views() {

    if (!empty($_POST['post_ids'])) {
        $post_id = json_decode(stripslashes($_POST['post_ids']));

        if (empty($post_id[0])) {
            $post_id[0] = 0;
        }

        $current_post_count = MipThemeFramework_Post_Views::get_post_views($post_id[0]);
        $new_post_count     = $current_post_count + 1;

        // update the counter
        update_post_meta($post_id[0], MipThemeFramework_Post_Views::$post_views_counter_key, $new_post_count);

        die(json_encode(array($post_id[0]=>$new_post_count)));
    }
}
add_action( 'wp_ajax_nopriv_miptheme_ajax_update_views', 'miptheme_ajax_update_views' );
add_action( 'wp_ajax_miptheme_ajax_update_views', 'miptheme_ajax_update_views' );
