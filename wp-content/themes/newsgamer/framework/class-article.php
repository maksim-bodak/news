<?php
/**
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */

if ( ! class_exists( 'MipThemeFramework_Article' ) ) {

    class MipThemeFramework_Article {

        // init var
        public $cat_ID;
        public $cat_name                = '';
        public $article_link            = '';
        public $article_title           = '';
        public $article_content         = '';
        public $article_more            = 0;
        public $article_thumb           = '';
        public $article_thumb_width     = '';
        public $article_thumb_height    = '';
        public $article_post_date       = '';
        public $article_post_date_iso   = '';
        public $article_comments_count  = '';
        public $article_comments_link   = '';
        public $article_review          = false;
        public $article_review_score    = 0;
        public $article_review_format   = 0;
        public $article_show_summary    = 0;
        public $article_show_category   = 0;
        public $article_show_cat_label  = 0;
        public $article_author          = '';
        public $article_author_url      = '';
        public $article_post_type       = 'standard';
        public $article_price           = '';
        public $article_add_to_cart     = false;
        public $article_no_ajax_call    = true;


        private function setPostTypeIcon() {
            switch ( $this->article_post_type ) {
                case 'standard':
                    return '<i class="fa fa-pencil"></i>';
                break;
                case 'gallery':
                    return '<i class="fa fa-image"></i>';
                break;
                case 'image':
                    return '<i class="fa fa-image"></i>';
                break;
                case 'video':
                    return '<i class="fa fa-video-camera"></i>';
                break;
                case 'audio':
                    return '<i class="fa fa-music"></i>';
                break;
                case 'quote':
                    return '<i class="fa fa-quote-left"></i>';
                break;
            }
        }



        function setPrimaryCategoryClass() {
                    global $mipthemeoptions_framework;
                    $article_show_yoastseo_prim_cat = ( isset($mipthemeoptions_framework['_mp_theme_yoastseo_primary_category']) && (bool)$mipthemeoptions_framework['_mp_theme_yoastseo_primary_category']) ? (bool)$mipthemeoptions_framework['_mp_theme_yoastseo_primary_category'] : false;

                    if ( $article_show_yoastseo_prim_cat ) {
                        $tmpCatID   = get_post_meta( $this->article_link, '_yoast_wpseo_primary_category', true );
                        if ( isset($tmpCatID) && ($tmpCatID != '') ) {
                            return ' prim-cat-'. $tmpCatID;
                        }
                    }
                }



        private function getCategoryLabelSpan() {
            global $mipthemeoptions_framework;
            $article_show_yoastseo_prim_cat = ( isset($mipthemeoptions_framework['_mp_theme_yoastseo_primary_category']) && (bool)$mipthemeoptions_framework['_mp_theme_yoastseo_primary_category']) ? (bool)$mipthemeoptions_framework['_mp_theme_yoastseo_primary_category'] : false;

            if ( $article_show_yoastseo_prim_cat ) {
                $tmpCatID   = get_post_meta( $this->article_link, '_yoast_wpseo_primary_category', true );
                if ( isset($tmpCatID) && ($tmpCatID != '') ) {
                    $this->cat_ID   = $tmpCatID;
                    $this->cat_name = get_cat_name($tmpCatID);
                }
            }

            return  '<span class="entry-category parent-cat-'. esc_attr(MipThemeFramework_Util::get_category_top_parent_id($this->cat_ID)) .' cat-'. esc_attr($this->cat_ID) .'">
                        <a itemprop="url" href="'. get_category_link($this->cat_ID) .'">'. $this->cat_name .'</a>
                    </span>';
        }

        private function getDateLabelSpan() {
            return  '<time class="entry-date" datetime="'. esc_attr($this->article_post_date_iso) .'" itemprop="dateCreated">'. $this->article_post_date .'</time>';
        }

        private function getViewsLabelSpan( $view_type = 'mip_post_views_count' ) {
            $view_type  = ( $view_type == '1' ) ? 'mip_post_views_count' : $view_type;
            return '<span class="entry-views">'. MipThemeFramework_Post_Views::get_post_views($this->article_link, $view_type) .'</span>';
        }

        private function getStarRatingLabelSpan( $sClass = '' ) {
            $this->article_review            = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $this->article_link, '_mp_enable_review_post');
            if ( (bool)$this->article_review  ) {
                $this->article_review_score      = get_post_meta( $this->article_link, '_mp_review_post_total_score', true );
                if ( isset($this->article_review_score) && ($this->article_review_score != '') && ($this->article_review_score != 0) ) {
                    $score  = round($this->article_review_score/100, 1)*5;
                    $raty = '<span class="raty" data-score="'. esc_attr($score) .'"></span>';
                    $raty = ( $sClass != '' ) ? '<div class="entry-meta '. esc_attr($sClass) .'">'. $raty .'</div>' : $raty;
                    return $raty;
                }
            }
        }


        private function getCommentCountMeta() {
            if ( isset($mipthemeoptions_framework['_mp_post_facebook_comments_enable'])&&(bool)$mipthemeoptions_framework['_mp_post_facebook_comments_enable']) {
                $comment_count_total  = '<fb:comments-count href="'. get_permalink($this->article_link) .'"></fb:comments-count>';
            } else {
                $comment_count          = wp_count_comments($this->article_link);
                $comment_count_total  = '<a href="'. get_comments_link($this->article_link) .'">'. $comment_count->total_comments .'</a>';
            }
            return  '<span itemprop="interactionCount" class="entry-comments">'. $comment_count_total .'</span>';
        }


        private function getAuthorMeta( $class = '' ) {
            return  '<span itemprop="author" class="entry-author'. esc_attr($class) .'"><a href="'. $this->article_author_url .'">'. $this->article_author .'</a></span>';
        }

        private function getPostDateMeta( $class = '' ) {
            return '<time class="entry-date'. esc_attr($class) .'" datetime="'. esc_attr($this->article_post_date_iso) .'" itemprop="dateCreated">'. $this->article_post_date .'</time>';
        }

        private function getReviewScore() {
            $this->article_review            = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $this->article_link, '_mp_enable_review_post');
            if ( (bool)$this->article_review  ) {
                $this->article_review_score      = get_post_meta( $this->article_link, '_mp_review_post_total_score', true );
                $this->article_review_format     = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($this->article_link, '_mp_review_post_style');
                if ( isset($this->article_review_score) && ($this->article_review_score != '') && ($this->article_review_score != 0) ) {
                    $score  = ( ( $this->article_review_format  == 'percentage' ) ? round($this->article_review_score) .'<small>%</small>' : round($this->article_review_score/10, 1) );
                    $this->article_review_score = round($this->article_review_score/10, 1);
                    $scoreDeg   = round(360 * ($this->article_review_score/10), 1);
                    $scoreClass   = round($this->article_review_score, 0);
                    return  '<div class="review-circle-wrapper">
                                <div class="review-circle review-score-'. $scoreClass .'">
                                    <div class="meter-wrapper">
                                        <div class="meter-slice showfill">
                                            <div class="meter" style="-webkit-transform:rotate('. esc_attr($scoreDeg) .'deg);-moz-transform:rotate('. esc_attr($scoreDeg) .'deg);-o-transform:rotate('. esc_attr($scoreDeg) .'deg);-ms-transform:rotate('. esc_attr($scoreDeg) .'deg);transform:rotate('. esc_attr($scoreDeg) .'deg);"></div>
                                            <div class="meter fill"></div>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <div>'. $score .'</div>
                                    </div>
                                </div>
                            </div>';
                }
            }
        }


        private function getBoxImage( $imgClass = ' class="img-responsive"' ) {
            if ( $this->article_thumb != '' ) {
                global $mipthemeoptions_framework;
                $img_lazy_load  = (isset($mipthemeoptions_framework['_mp_posts_enable_lazy_load']) && (bool)$mipthemeoptions_framework['_mp_posts_enable_lazy_load']) ? true : false;
                if ( $img_lazy_load && $this->article_no_ajax_call ) {
                    return '<img itemprop="image" class="bttrlazyloading'. esc_attr( ($imgClass != '') ? ' img-responsive' : '' ) .'" data-bttrlazyloading-md-src="'. esc_url($this->article_thumb) .'" width="'. esc_attr($this->article_thumb_width) .'" height="'. esc_attr($this->article_thumb_height) .'" alt="'. esc_attr($this->article_title) .'"'. $imgClass .' />
                            <noscript><img itemprop="image" src="'. esc_url($this->article_thumb) .'" width="'. esc_attr($this->article_thumb_width) .'" height="'. esc_attr($this->article_thumb_height) .'" alt="'. esc_attr($this->article_title) .'"'. $imgClass .' /></noscript>';
                } else {
                    return '<img itemprop="image" src="'. esc_url($this->article_thumb) .'" width="'. esc_attr($this->article_thumb_width) .'" height="'. esc_attr($this->article_thumb_height) .'" alt="'. esc_attr($this->article_title) .'"'. $imgClass .' />';
                }
            }
        }


        private function getFigureSmall( $show_author = false, $show_comment = false, $show_views = false ) {
            return '<figure class="overlay relative">
                        <a itemprop="url" href="'. get_permalink($this->article_link) .'"'. ( ( $this->article_thumb != '' ) ? ' class="thumb-overlay-small"' : '') .'>
                            '. ( ( $this->article_thumb != '' ) ? $this->getBoxImage() : '<img itemprop="image" src="'. get_template_directory_uri() .'/images/dummy.png" width="'. $this->article_thumb_width .'" height="'. $this->article_thumb_height .'" alt="'. esc_attr($this->article_title) .'" class="img-responsive">' )  .'
                        </a>
                        <figcaption>
                            <div class="entry-meta">
                                '. ( $show_author ? $this->getAuthorMeta(' hidden-xs') : '' ) .'
                                '. ( $show_views  ? $this->getViewsLabelSpan() : '' ) .'
                                '. ( $show_comment ? $this->getCommentCountMeta() : '' ).'
                            </div>
                        </figcaption>
                    </figure>';
        }


        /**
         * Category Layout 1
         */
        public function formatArticleCat01( $show_category = false, $shorten_text_chars = 300, $show_date = true, $show_comments = false, $show_author = false, $show_views = false ) {
            $sFigure = ( $this->article_thumb != '' ) ? '<div class="col-sm-6 col-md-4 col-lg-5">'. $this->getFigureSmall() .'</div><div class="col-sm-6 col-md-8 col-lg-7">' : '<div class="col-xs-12">';
            return '<div class="row clearfix">
                        <!-- start:article.default -->
                        <article class="def">
                            '. $sFigure .'
                                <div class="entry">
                                    '. ( $show_category ? $this->getCategoryLabelSpan() : '' ) .'
                                    <h3 itemprop="name">
                                        <a itemprop="url" href="'. get_permalink($this->article_link) .'">'. $this->article_title .'</a>
                                    </h3>
                                    <div class="entry-meta">
                                        '. ( $show_date ? $this->getPostDateMeta() : '' ) .'
                                        '. ( $show_author ? $this->getAuthorMeta() : '' ) .'
                                        '. ( $show_comments ? $this->getCommentCountMeta() : '' ).'
                                        '. ( $show_views  ? $this->getViewsLabelSpan() : '' ) .'
                                    </div>
                                    <div class="text hidden-xs">
                                        '. MipThemeFramework_Util::ShortenText($this->article_content, $shorten_text_chars) .'
                                    </div>
                                    '. $this->getStarRatingLabelSpan() .'
                                </div>
                            </div>
                        </article>
                        <!-- end:article.default -->
                    </div>';
        }


        /**
         * Category Layout 2, 3, 4
         */
        public function formatArticleCat02( $show_category = false, $shorten_text_chars = 150, $class = 'col-sm-6', $show_date = true, $show_comments = false, $show_author = false, $show_views = false ) {
            return '<div class="'. $class .'">
                        <!-- start:article.default -->
                        <article class="def def-medium">
                            '. $this->getReviewScore() .'
                            '. $this->getFigureSmall($show_author) .'
                            <div class="entry">
                                '. ( $show_category ? $this->getCategoryLabelSpan() : '' ) .'
                                <h3 itemprop="name">
                                    <a itemprop="url" href="'. get_permalink($this->article_link) .'">'. $this->article_title .'</a>
                                </h3>
                                <div class="entry-meta">
                                    '. ( $show_date ? $this->getPostDateMeta() : '' ) .'
                                    '. ( $show_views  ? $this->getViewsLabelSpan() : '' ) .'
                                    '. ( $show_comments ? $this->getCommentCountMeta() : '' ).'
                                </div>
                                '. ( $shorten_text_chars ? '<div class="text hidden-xs">'. MipThemeFramework_Util::ShortenText($this->article_content, $shorten_text_chars) .'</div>' : '' ) .'
                            </div>
                        </article>
                        <!-- end:article.default -->
                    </div>';
        }


        /**
         * Category Layout 5 - First Row
         */
        public function formatArticleCat05( $heading = 'h2', $show_category = false, $shorten_text_chars = 300, $class = 'col-xs-12', $show_date = true, $show_comments = true, $show_author = false, $show_views = false ) {
            return '<div class="'. $class .'">
                        <!-- start:article.default -->
                        <article class="def def-medium def-overlay'. esc_attr( ($shorten_text_chars != '0') ? ' has-text': '' ) .'">
                            '. $this->getReviewScore() .'
                            <figure class="overlay relative">
                                <a itemprop="url" href="'. get_permalink($this->article_link) .'" class="thumb-overlay">
                                    '. $this->getBoxImage() .'
                                </a>
                                <figcaption>
                                    <div class="entry">
                                        '. ( $show_category ? $this->getCategoryLabelSpan() : '' ) .'
                                        <'. $heading .' itemprop="name">
                                            <a itemprop="url" href="'. get_permalink($this->article_link) .'">'. $this->article_title .'</a>
                                        </'. $heading .'>
                                        '. ( ($shorten_text_chars != '0') ? '<div class="text hidden-xs">'. MipThemeFramework_Util::ShortenText($this->article_content, $shorten_text_chars) .'</div>' : '') .'
                                        <div class="post-meta">
                                            '. ( $show_date ? $this->getPostDateMeta() : '' ) .'
                                            '. ( $show_author ? $this->getAuthorMeta(' hidden-xs') : '' ) .'
                                            '. ( $show_comments ? $this->getCommentCountMeta() : '' ).'
                                            '. ( $show_views  ? $this->getViewsLabelSpan() : '' ) .'
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                        <!-- end:article.default -->
                    </div>';
        }


        /**
         * Category Layout 11
         */
        public function formatArticleCat11( $show_category = false, $shorten_text_chars = 150, $show_date = true, $show_comments = false, $show_author = false, $show_views = false ) {
            return '<!-- start:article.default -->
                    <article class="def def-medium">
                        <div class="entry">
                            <div class="entry-meta">
                                '. ( $show_date ? '<time class="entry-date" datetime="'. esc_attr($this->article_post_date_iso) .'" itemprop="dateCreated">'. $this->article_post_date .'</time>' : '') .'
                            </div>
                            '. ( $show_category ? $this->getCategoryLabelSpan() : '' ) .'
                            <h3 itemprop="name">
                                <a itemprop="url" href="'. get_permalink($this->article_link) .'">'. $this->article_title .'</a>
                            </h3>
                            <div class="entry-meta">
                                '. ( $show_author ? $this->getAuthorMeta() : '' ) .'
                                '. ( $show_comments ? $this->getCommentCountMeta() : '' ).'
                                '. ( $show_views  ? $this->getViewsLabelSpan() : '' ) .'
                            </div>
                            '. ( $shorten_text_chars ? '<div class="text hidden-xs">'. MipThemeFramework_Util::ShortenText($this->article_content, $shorten_text_chars) .'</div>' : '' ) .'
                        </div>
                        '. $this->getFigureSmall() .'
                    </article>
                    <!-- end:article.default -->';
        }


        /**
         * Article Overlay
         */
        public function formatArticleOverlay( $heading = 'h2', $show_category = false, $show_date = true, $show_comments = true, $show_author = false, $show_views = false, $shorten_text_chars = 0, $itemCounter = 0 ) {
            return '<!-- start:article.default -->
                    <article class="def def-medium def-overlay item-count-'. $itemCounter .'">
                        '. $this->getReviewScore() .'
                        <figure class="overlay relative">
                            <a itemprop="url" href="'. get_permalink($this->article_link) .'"'. esc_attr( ( $this->article_thumb != '' ) ? ' class=thumb-overlay' : '') .'>
                                '. ( ( $this->article_thumb != '' ) ? $this->getBoxImage() : '<img itemprop="image" src="'. get_template_directory_uri() .'/images/dummy.png" width="'. esc_attr($this->article_thumb_width) .'" height="'. esc_attr($this->article_thumb_height) .'" alt="'. esc_attr($this->article_title) .'" class="img-responsive">' )  .'                            </a>
                            <figcaption>
                                <div class="entry">
                                    '. ( $show_category ? $this->getCategoryLabelSpan() : '' ) .'
                                    <'. $heading .' itemprop="name">
                                        <a itemprop="url" href="'. get_permalink($this->article_link) .'">'. $this->article_title .'</a>
                                    </'. $heading .'>
                                    '. ( $shorten_text_chars ? '<div class="text hidden-xs">'. MipThemeFramework_Util::ShortenText($this->article_content, $shorten_text_chars) .'</div>' : '' ) .'
                                    <div class="post-meta">
                                        '. ( $show_date ? $this->getPostDateMeta() : '' ) .'
                                        '. ( $show_author ? $this->getAuthorMeta(' hidden-xs') : '' ) .'
                                        '. ( $show_views  ? $this->getViewsLabelSpan() : '' ) .'
                                        '. ( $show_comments ? $this->getCommentCountMeta() : '' ).'
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    </article>
                    <!-- end:article.default -->';
        }


        public function formatArticleStyleBlog( $textInt = 0, $show_category = false, $show_date = true, $show_comments = true, $show_author = false, $show_views = false ) {

            // get categories
            $categories     = get_the_category($this->article_link);
            $separator      = ', ';
            $cat_output     = '';
            if($show_category && $categories){
                foreach($categories as $category) {
                    $cat_output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'Newsgamer' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
                }
            }

            // get thumb
            $thumb_wrap     = '';
            $thumb_class    = '';
            if ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $this->article_link, '_mp_featured_video') ) {
                $featured_video = new MipThemeFramework_Video();
                $thumb_wrap =  '<div class="head-video relative">'. $featured_video->renderVideo( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $this->article_link, '_mp_featured_video') ) .'</div>';
            } else if ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $this->article_link, '_mp_featured_audio_embed') ) {
                $thumb_wrap =  '<div class="head-video relative">'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $this->article_link, '_mp_featured_audio_embed') .'</div>';
            } else {
                if ($this->article_thumb != '') {
                    $thumb_wrap = $this->getFigureSmall();
                } else {
                    $thumb_class    = ' no-image';
                }
            }

            return      '<div class="row">
                            <!-- start:article -->
                            <article class="def article-post type-'. esc_attr($this->article_post_type) . esc_attr($thumb_class) .'">
                                '. $this->getReviewScore() .'
                                '. $thumb_wrap .'
                                <div class="entry">
                                    <a class="btn-fa-icon" href="#">'. $this->setPostTypeIcon() .'</a>
                                    <h2 itemprop="name"><a itemprop="url" href="'. get_permalink($this->article_link) .'">'. $this->article_title .'</a></h2>
                                    <div class="entry-meta">
                                        '. ( $show_date ? $this->getPostDateMeta() : '' ) .'
                                        '. ( $show_author ? $this->getAuthorMeta(' hidden-xs') : '' ) .'
                                        '. ( ($cat_output != '') ? '<span itemprop="entry-category">'. esc_html__('In', 'Newsgamer') .' '. trim($cat_output, $separator) .'</span>' : '' ) .'
                                        '. ( $show_comments ? $this->getCommentCountMeta() : '' ).'
                                        '. ( $show_views  ? $this->getViewsLabelSpan() : '' ) .'
                                    </div>
                                    '. ( ($this->article_more || ( $textInt == 0 )) ? '<span class="text">'. $this->article_content .'</span>' : '<span class="text"><p>'. MipThemeFramework_Util::ShortenText($this->article_content, $textInt) .'</p><a class="more-link" itemprop="url" href="'. get_permalink($this->article_link) .'">'. esc_html__('Read more', 'Newsgamer') .'</a></span>'  ) .'';
                                /*</div>';
                            </article>
                            <!-- end:article -->
                        </div>';*/
        }


        /**
         * Article Split
         */

         private function getWidgetEntryMetaValue($show_date, $show_views, $show_comments, $show_author) {
             $output    = '';
             $review    = $this->getStarRatingLabelSpan();
             if ($review) {
                 $output = $review;
             } else {
                 $output .= $show_date      ? $this->getDateLabelSpan()                 : '';
                 $output .= $show_author    ? $this->getAuthorMeta()                    : '';
                 $output .= $show_comments  ? $this->getCommentCountMeta()              : '';
                 $output .= $show_views     ? $this->getViewsLabelSpan( $show_views )   : '';
             }
             return $output;
         }

        public function formatArticleSplit( $show_category = true, $show_date = true, $show_views = false, $class1 = 'col-xs-5 col-sm-6', $class2 = 'col-xs-7 col-sm-6', $shorten_text_chars = 0, $show_comments = true, $show_author = false ) {
            return '<!-- start:article.default -->
                    <article class="def def-small">
                        <div class="row clearfix">
                            <div class="'. esc_attr($class1) .'">
                                '. $this->getFigureSmall() .'
                            </div>
                            <div class="'. esc_attr($class2) .' no-left">
                                '. ( $show_category ? $this->getCategoryLabelSpan() : '' ) .'
                                <h3 itemprop="name">
                                    <a itemprop="url" href="'. get_permalink($this->article_link) .'">'. $this->article_title .'</a>
                                </h3>
                                '. ( ($shorten_text_chars != '0') ? '<div class="text hidden-xs">'. MipThemeFramework_Util::ShortenText($this->article_content, $shorten_text_chars) .'</div>' : '') .'
                                <div class="entry-meta">
                                '. $this->getWidgetEntryMetaValue($show_date, $show_views, $show_comments, $show_author) .'
                                </div>
                            </div>
                        </div>
                    </article>
                    <!-- end:article.default -->';
        }


        /**
         * Header Navigation Article
         */
        public function formatArticleForMegaMenu() {
            return '<!-- start:article.default -->
                    <article class="def">
                        <figure>
                            <a itemprop="url" href="'. get_permalink($this->article_link) .'">
                                '. $this->getBoxImage() .'
                            </a>
                        </figure>
                        <h3 itemprop="name">
                            <a itemprop="url" href="'. get_permalink($this->article_link) .'">'. $this->article_title .'</a>
                        </h3>
                    </article>
                    <!-- end:article.default -->';
        }


        /**
         * Recent Posts Widget
         */
        public function formatArticleForRecentPostWidget ( $layout, $post_counter, $show_date, $show_category, $show_views, $img_small, $show_comments = true ) {
            if ( $layout ) {
                switch ( $layout ) {
                    case 'layout_one':
                        //if ( $this->article_thumb ) {
                            $this->article_thumb            = $img_small;
                            $this->article_thumb_width      = 176;
                            $this->article_thumb_height     = 120;
                            return $this->formatArticleSplit($show_category, $show_date, $show_views, 'col-xs-5 col-sm-6', 'col-xs-7 col-sm-6', 0, $show_comments);
                        //}
                    break;
                    case 'layout_two':
                        if ( $post_counter == 1 ) {
                            $this->article_thumb_width      = 350;
                            $this->article_thumb_height     = 245;
                            return $this->formatArticleOverlay('h2', $show_category, $show_date, $show_comments, 0, $show_views);
                        } else {
                            $this->article_thumb            = $img_small;
                            $this->article_thumb_width      = 176;
                            $this->article_thumb_height     = 120;
                            return $this->formatArticleSplit($show_category, $show_date, $show_views, 'col-xs-5 col-sm-6', 'col-xs-7 col-sm-6', 0, $show_comments);
                        }
                    break;
                    case 'layout_three':
                        $this->article_thumb_width      = 350;
                        $this->article_thumb_height     = 245;
                        return $this->formatArticleOverlay('h2', $show_category, $show_date, $show_comments, 0, $show_views);
                    break;
                }
            }
        }



        /**
         * VC Block 1 Left
         */
        public function formatVCBlock_1( $show_image = true, $show_category = true, $shorten_text_chars = 0, $class = 'shadow-box shadow-top-left', $show_date = true, $show_comments = false, $show_author = false, $show_views = false ) {
            return '<div class="'. $class .'">
                        <!-- start:article.default -->
                        <article class="def">
                            '. ( $show_image ? $this->getFigureSmall() : '' )  .'
                            <div class="entry">
                                '. ( $show_category ? $this->getCategoryLabelSpan() : '' ) .'
                                <h3 itemprop="name">
                                    <a itemprop="url" href="'. get_permalink($this->article_link) .'">'. $this->article_title .'</a>
                                </h3>
                                <div class="entry-meta">
                                    '. ( $show_date ? $this->getPostDateMeta() : '' ) .'
                                    '. ( $show_author ? $this->getAuthorMeta(' hidden-xs') : '' ) .'
                                    '. ( $show_views  ? $this->getViewsLabelSpan() : '' ) .'
                                    '. ( $show_comments ? $this->getCommentCountMeta() : '' ).'
                                </div>
                                '. ( ($shorten_text_chars) ? '<div class="text hidden-xs">'. MipThemeFramework_Util::ShortenText($this->article_content, $shorten_text_chars) .'</div>' : '' ) .'
                                '. $this->getStarRatingLabelSpan('raty-top') .'
                            </div>
                        </article>
                        <!-- end:article.default -->
                    </div>';
        }


        /**
         * Related box
         */
        public function formatArticleByStyle( $show_image = false, $show_date = false ) {
            return '<article class="def">
                        '. ( $show_image ? $this->getFigureSmall() : '' )  .'
                        <h5><a href="'. get_permalink($this->article_link) .'">'. $this->article_title .'</a></h5>
                        '. ( $show_date ? '<div class="entry-meta">'. $this->getPostDateMeta() .'</div>' : '' ) .'
                    </article>';
        }


    }
}
