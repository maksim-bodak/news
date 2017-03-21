<?php
/**
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */

if ( ! class_exists( 'MipThemeFramework_Page' ) ) {

    class MipThemeFramework_Page {

        public $page_template               = '';
        public $page_template_grid          = '';
        public $page_template_chars         = 0;
        public $page_template_img_format    = 0;
        public $page_template_show_date     = 0;
        public $page_template_show_author   = 0;
        public $page_template_show_category = 0;
        public $page_template_show_comments = 0;
        public $page_template_show_views    = 0;
        public $page_template_class         = '';
        public $header_template_class       = '';
        public $page_sidebar_template       = '';
        public $page_sidebar_source         = '';
        public $page_pagination             = '';
        public $page_show_posts_num         = '';
        public $page_title                  = '';
        public $cat_id                      = 0;
        public $cat_obj                     = 0;
        public $cat_banner_show             = 0;
        public $cat_banner_count            = 0;
        public $cat_show_title              = 0;
        public $cat_show_image              = 0;

        public $page_image_full_height      = 0;
        public $page_image_parallax_height  = 0;
        public $enable_posts                = 0;
        public $enable_related_posts        = 1;
        public $enable_postmeta             = 1;
        public $enable_breadcrumbs          = 1;
        public $enable_author               = 1;
        public $enable_author_postmeta      = 0;
        public $enable_social_sharing       = '';
        public $enable_prevnext_posts       = 1;
        public $enable_tags                 = 1;
        public $enable_display_source       = 0;
        public $enable_post_info_bar        = 0;
        public $filter_related_posts        = '';
        public $filter_related_posts_title  = '';
        public $filter_related_posts_offset = '';
        public $filter_related_posts_sort   = '';
        public $filter_related_posts_count  = 3;
        public $featured_video_url          = '';
        public $featured_video_embed        = '';
        public $featured_audio_embed        = '';
        public $review_post                 = '';
        public $review_post_poster          = 0;
        public $review_post_position        = '';
        public $review_post_users_enable    = 0;
        public $review_post_users_role      = '';
        public $ads_post_section_one        = 0;
        public $ads_post_section_two        = 0;
        public $ads_post_section_three      = 0;
        public $comments_location           = '';

        public $authors_exclude             = '';
        public $authors_orderby             = '';
        public $authors_order               = '';
        public $authors_roles               = '';

        public function __construct() {
            global $mipthemeoptions_framework;

            if (is_home()) {

                $this->page_template               = isset($mipthemeoptions_framework['_mpgl_homepage_template'])            ? $mipthemeoptions_framework['_mpgl_homepage_template']                  : 'loop-cat-12';
                $this->page_template_chars         = ( isset($mipthemeoptions_framework['_mpgl_homepage_template_chars']) && ($mipthemeoptions_framework['_mpgl_homepage_template_chars'] > 0) )       ? $mipthemeoptions_framework['_mpgl_homepage_template_chars']                  : 0;
                $this->page_template_grid          = isset($mipthemeoptions_framework['_mpgl_homepage_grid_width'])          ? $mipthemeoptions_framework['_mpgl_homepage_grid_width']                : 'standard';
                $this->page_template_show_date     = ( isset($mipthemeoptions_framework['_mpgl_homepage_postmeta_elements']['date']) && $mipthemeoptions_framework['_mpgl_homepage_postmeta_elements']['date'] )                  ? 1 : 1;
                $this->page_template_show_author   = ( isset($mipthemeoptions_framework['_mpgl_homepage_postmeta_elements']['author']) && $mipthemeoptions_framework['_mpgl_homepage_postmeta_elements']['author'] )            ? 1 : 0;
                $this->page_template_show_category = ( isset($mipthemeoptions_framework['_mpgl_homepage_postmeta_elements']['category']) && $mipthemeoptions_framework['_mpgl_homepage_postmeta_elements']['category'] )      ? 1 : 0;
                $this->page_template_show_comments = ( isset($mipthemeoptions_framework['_mpgl_homepage_postmeta_elements']['comments']) && $mipthemeoptions_framework['_mpgl_homepage_postmeta_elements']['comments'] )      ? 1 : 0;
                $this->page_template_show_views    = ( isset($mipthemeoptions_framework['_mpgl_homepage_postmeta_elements']['views']) && $mipthemeoptions_framework['_mpgl_homepage_postmeta_elements']['views'] )               ? 1 : 0;

                $this->page_sidebar_template       = isset($mipthemeoptions_framework['_mpgl_homepage_sidebar_template'])    ? $mipthemeoptions_framework['_mpgl_homepage_sidebar_template']          : 'right-sidebar';
                $this->page_sidebar_source         = isset($mipthemeoptions_framework['_mpgl_homepage_sidebar_source'])      ? $mipthemeoptions_framework['_mpgl_homepage_sidebar_source']            : '';
                $this->page_pagination             = isset($mipthemeoptions_framework['_mpgl_homepage_pagination'])          ? $mipthemeoptions_framework['_mpgl_homepage_pagination']                : 'post-pagination-1';
                $this->page_show_posts_num         = isset($mipthemeoptions_framework['_mpgl_homepage_posts_number'])        ? $mipthemeoptions_framework['_mpgl_homepage_posts_number']              : 0;

                $this->page_template_class         = 'loop-cat '. $this->page_sidebar_template .' '. $this->page_template .' '. $this->page_template_grid;

            } else if (is_category()) {

                if ( get_query_var('cat') && ( get_query_var('cat') != '' )) {
                    $curr_cat_id                = get_query_var('cat');
                } else {
                    $catObj         = get_category_by_slug(get_query_var('category_name'));
                    if ($catObj) $curr_cat_id    = $catObj->term_id;
                }

                $curr_parent_id             = $curr_cat_id; // default: set to this cat
                $curr_cat_obj               = get_category($curr_cat_id);

                // check for root category
                if ( $curr_cat_obj->category_parent != 0 ) {
                    $cat_temp_id  = $curr_cat_id;
                    $cat_temp_obj = $curr_cat_obj;
                    while ($cat_temp_id) {
                        $cat            = get_category($cat_temp_id); // get the object for the catid
                        $cat_temp_id    = $cat->category_parent; // assign parent ID (if exists) to $cat_temp_id
                        if ( isset($mipthemeoptions_framework['_mpgl_cat_'. $cat_temp_id .'_set_for_children']) && (bool)$mipthemeoptions_framework['_mpgl_cat_'. $cat_temp_id .'_set_for_children'] ) {
                            $curr_parent_id = $cat_temp_id;
                        }
                    }
                }

                $this->cat_id                      = $curr_cat_id;
                $this->cat_obj                     = $curr_cat_obj;
                $this->page_template               = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_template']) && ($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_template'] != '') )                  ? $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_template']             : (isset($mipthemeoptions_framework['_mpgl_cat_template'])           ? $mipthemeoptions_framework['_mpgl_cat_template']           : 'loop-cat-1');
                $this->page_template_chars         = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_template_chars']) && ($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_template_chars'] > 0) )        ? $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_template_chars']       : (isset($mipthemeoptions_framework['_mpgl_cat_template_chars'])     ? $mipthemeoptions_framework['_mpgl_cat_template_chars']     : 0);
                $this->page_template_grid          = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_grid_width']) && ($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_grid_width'] != '') )              ? $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_grid_width']           : (isset($mipthemeoptions_framework['_mpgl_cat_grid_width'])         ? $mipthemeoptions_framework['_mpgl_cat_grid_width']         : 'standard');

                $this->page_template_show_date     = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_postmeta_elements']['date']) && $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_postmeta_elements']['date'] )            ?  1  :    (( isset($mipthemeoptions_framework['_mpgl_cat_postmeta_elements']['date']) && $mipthemeoptions_framework['_mpgl_cat_postmeta_elements']['date'] )                  ? 1 : 0);
                $this->page_template_show_author   = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_postmeta_elements']['author']) && $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_postmeta_elements']['author'] )        ?  1  :    (( isset($mipthemeoptions_framework['_mpgl_cat_postmeta_elements']['author']) && $mipthemeoptions_framework['_mpgl_cat_postmeta_elements']['author'] )            ? 1 : 0);
                $this->page_template_show_category = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_postmeta_elements']['category']) && $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_postmeta_elements']['category'] )    ?  1  :    (( isset($mipthemeoptions_framework['_mpgl_cat_postmeta_elements']['category']) && $mipthemeoptions_framework['_mpgl_cat_postmeta_elements']['category'] )      ? 1 : 0);
                $this->page_template_show_comments = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_postmeta_elements']['comments']) && $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_postmeta_elements']['comments'] )    ?  1  :    (( isset($mipthemeoptions_framework['_mpgl_cat_postmeta_elements']['comments']) && $mipthemeoptions_framework['_mpgl_cat_postmeta_elements']['comments'] )      ? 1 : 0);
                $this->page_template_show_views    = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_postmeta_elements']['views']) && $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_postmeta_elements']['views'] )          ?  1  :    (( isset($mipthemeoptions_framework['_mpgl_cat_postmeta_elements']['views']) && $mipthemeoptions_framework['_mpgl_cat_postmeta_elements']['views'] )               ? 1 : 0);

                $this->page_sidebar_template       = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_sidebar_template']) && ($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_sidebar_template'] != '') )  ? $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_sidebar_template']     : (isset($mipthemeoptions_framework['_mpgl_cat_sidebar_template'])   ? $mipthemeoptions_framework['_mpgl_cat_sidebar_template']   : 'right-sidebar');
                $this->page_sidebar_source         = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_sidebar_source']) && ($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_sidebar_source'] != '') )      ? $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_sidebar_source']       : (isset($mipthemeoptions_framework['_mpgl_cat_sidebar_source'])     ? $mipthemeoptions_framework['_mpgl_cat_sidebar_source']     : '');
                $this->page_pagination             = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_pagination']) && ($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_pagination'] != '') )              ? $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_pagination']           : (isset($mipthemeoptions_framework['_mpgl_cat_pagination'])         ? $mipthemeoptions_framework['_mpgl_cat_pagination']         : 'post-pagination-1');
                $this->page_show_posts_num         = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_posts_number']) && ($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_posts_number'] != '') )          ? $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_posts_number']         : (isset($mipthemeoptions_framework['_mpgl_cat_posts_number'])       ? $mipthemeoptions_framework['_mpgl_cat_posts_number']       : 0);

                $this->cat_show_title              = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_show_title']) && ($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_show_title'] != '') )              ? $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_show_title']           : (isset($mipthemeoptions_framework['_mpgl_cat_show_title'])       ? $mipthemeoptions_framework['_mpgl_cat_show_title']       : 0);
                $this->cat_show_title_image        = ( isset($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_show_title_image']['url']) && ($mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_show_title_image']['url'] != '') )              ? $mipthemeoptions_framework['_mpgl_cat_'. $curr_parent_id .'_cat_show_title_image']['url']       : (isset($mipthemeoptions_framework['_mpgl_cat_show_title_image']['url'])       ? $mipthemeoptions_framework['_mpgl_cat_show_title_image']['url']       : '');
                $this->cat_banner_show             = ( isset($mipthemeoptions_framework['_mp_ads_cat_'. $curr_parent_id .'_layout_banner']) && ($mipthemeoptions_framework['_mp_ads_cat_'. $curr_parent_id .'_layout_banner'] != '') )              ? $mipthemeoptions_framework['_mp_ads_cat_'. $curr_parent_id .'_layout_banner']       : (isset($mipthemeoptions_framework['_mp_ads_cat_layout_banner'])       ? $mipthemeoptions_framework['_mp_ads_cat_layout_banner']       : 0);
                $this->cat_banner_count            = ( isset($mipthemeoptions_framework['_mp_ads_cat_'. $curr_parent_id .'_layout_banner']) && ($mipthemeoptions_framework['_mp_ads_cat_'. $curr_parent_id .'_layout_banner'] != '') )              ? ( ( isset($mipthemeoptions_framework['_mp_ads_cat_'. $curr_parent_id .'_layout_banner_count']) && ($mipthemeoptions_framework['_mp_ads_cat_'. $curr_parent_id .'_layout_banner_count'] != '') )   ? $mipthemeoptions_framework['_mp_ads_cat_'. $curr_parent_id .'_layout_banner_count']  : (isset($mipthemeoptions_framework['_mp_ads_cat_layout_banner_count']) ? $mipthemeoptions_framework['_mp_ads_cat_layout_banner_count'] : '') ) : (isset($mipthemeoptions_framework['_mp_ads_cat_layout_banner_count']) ? $mipthemeoptions_framework['_mp_ads_cat_layout_banner_count'] : 0);

                $this->page_template_class         = 'loop-cat '. $this->page_sidebar_template .' '. $this->page_template .' '. $this->page_template_grid . ( (bool)$this->cat_show_title ? ' has-title' : '');

            } else if (is_single()) {
                global $post;

                $this->page_template               = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_post_layout_single', true, 'loop-page-2', '_mpgl_post_layout');
                $this->page_sidebar_template       = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_post_sidebar_template_single', '', 'right-sidebar', '_mpgl_post_sidebar_template');
                $this->page_sidebar_source         = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_post_sidebar_source_single', true, '', '_mpgl_post_sidebar_source');
                $this->page_image_full_height      = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_post_layout_single_image_height', true, 0, '_mpgl_post_layout_image_height');
                $this->page_template_img_format    = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_post_layout_single_image_format', true, 'medium', '_mpgl_post_layout_image_format');
                $this->enable_breadcrumbs          = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_post_enable_breadcrumbs_single', true, 1, '_mpgl_post_enable_breadcrumbs');
                $this->enable_related_posts        = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_enable_related_posts_single', true, 1, '_mp_enable_related_posts');

                $this->enable_postmeta             = ( isset($mipthemeoptions_framework['_mpgl_post_enable_postmeta'])                                        ? $mipthemeoptions_framework['_mpgl_post_enable_postmeta']                                                 : 1 );
                $this->enable_social_sharing       = ( isset($mipthemeoptions_framework['_mp_show_social_sharing'])                                           ? $mipthemeoptions_framework['_mp_show_social_sharing']                                                    : 'bottom' );

                $this->enable_author_postmeta      = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_post_display_author_postmeta_single', true, 0, '_mpgl_post_display_author_postmeta');
                $this->enable_author               = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_post_enable_author_single', true, 1, '_mpgl_post_enable_author');
                $this->enable_tags                 = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_post_enable_tags_single', true, 1, '_mpgl_post_enable_tags');
                $this->enable_prevnext_posts       = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_post_enable_prevnext_single', true, 1, '_mpgl_post_enable_prevnext');
                $this->enable_display_source       = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_source')               ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_source')               : 0 ;

                $this->filter_related_posts        = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_filter_related_posts_single', true, 1, '_mp_filter_related_posts');
                $this->filter_related_posts_grid   = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_filter_related_posts_grid_single', '', 'standard', '_mp_filter_related_posts_grid');
                $this->filter_related_posts_title  = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_related_posts_title_single', '', '', '_mp_related_posts_title');
                $this->filter_related_posts_offset = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_related_posts_offset_single', '', '', '_mp_related_posts_offset');
                $this->filter_related_posts_sort   = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_related_posts_sort_single', '', '', '_mp_related_posts_sort');
                $this->filter_related_posts_count  = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_related_posts_count_single', true, 3, '_mp_related_posts_count');

                $this->featured_video_url          = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_featured_video');
                $this->featured_video_embed        = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_featured_video_embed');
                $this->featured_audio_embed        = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_featured_audio_embed');
                $this->review_post                 = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_enable_review_post');

                $tmp_review_poster                 = MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_post_layout_review_poster_single');
                $this->review_post_poster          = isset($tmp_review_poster['url'])&&($tmp_review_poster['url'])                            ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mpgl_post_layout_review_poster_single')   : ( isset($mipthemeoptions_framework['_mpgl_post_layout_review_poster'])  ? $mipthemeoptions_framework['_mpgl_post_layout_review_poster']  : 0 );
                $this->review_post_position        = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_position');

                $this->review_post_users_enable    = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_enable_user_review', true, 0, '_mp_review_post_enable_user_review_global');
                $this->review_post_users_role      = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_enable_user_review_role', true, 'users', '_mp_review_post_enable_user_review_role_global');

                $this->ads_post_section_one        = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_ads_posts_section_1_single', true, 0, '_mp_ads_posts_section_1');
                $this->ads_post_section_two        = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_ads_posts_section_2_single', true, 0, '_mp_ads_posts_section_2');
                $this->ads_post_section_three      = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_ads_posts_section_3_single', true, 0, '_mp_ads_posts_section_3');

                $this->comments_location           = isset($mipthemeoptions_framework['_mp_post_comments_location'] )                                  ? $mipthemeoptions_framework['_mp_post_comments_location'] : 'after-related';

                if ( in_array($this->page_template, array('loop-page-5', 'loop-page-6', 'loop-page-7')) ) {
                    $this->page_image_parallax_height  = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_post_layout_single_image_parallax_height', true, 0, '_mpgl_post_layout_image_parallax_height');
                }

                $this->page_template_class         = 'loop-single '. $this->page_sidebar_template .' '. $this->page_template;
                $this->header_template_class       = $this->page_sidebar_template;
                $this->enable_post_info_bar        = (isset($mipthemeoptions_framework['_mpgl_post_enable_post_info_bar'])&&(bool)$mipthemeoptions_framework['_mpgl_post_enable_post_info_bar'])    ?   1    : 0;

            } else if (is_page_template( 'template-author-team.php' )) {

                $this->page_sidebar_template       = isset($mipthemeoptions_framework['_mpgl_authorpage_sidebar_template'])    ? $mipthemeoptions_framework['_mpgl_authorpage_sidebar_template']          : 'right-sidebar';
                $this->page_sidebar_source         = isset($mipthemeoptions_framework['_mpgl_authorpage_sidebar_source'])      ? $mipthemeoptions_framework['_mpgl_authorpage_sidebar_source']            : '';
                $this->page_show_posts_num         = ( isset($mipthemeoptions_framework['_mpgl_authorteampage_authors_per_page']) && ( $mipthemeoptions_framework['_mpgl_authorteampage_authors_per_page'] > 0  ) )    ? $mipthemeoptions_framework['_mpgl_authorteampage_authors_per_page'] : 99999;
                $this->enable_postmeta             = ( isset($mipthemeoptions_framework['_mpgl_authorteampage_show_author_actions']) && (bool)$mipthemeoptions_framework['_mpgl_authorteampage_show_author_actions'] )                ? 1                  : 0;

                $this->authors_exclude             = $mipthemeoptions_framework['_mpgl_authorteampage_exclude'];
                $this->authors_orderby             = ( isset($mipthemeoptions_framework['_mpgl_authorteampage_authors_orderby']) )    ? $mipthemeoptions_framework['_mpgl_authorteampage_authors_orderby']   : 'post_count';
                $this->authors_order               = ( isset($mipthemeoptions_framework['_mpgl_authorteampage_authors_order']) )    ? $mipthemeoptions_framework['_mpgl_authorteampage_authors_order']   : 'DESC';
                $this->authors_roles               = ( isset($mipthemeoptions_framework['_mpgl_authorteampage_authors_roles']) && ($mipthemeoptions_framework['_mpgl_authorteampage_authors_roles'] != ''))    ? $mipthemeoptions_framework['_mpgl_authorteampage_authors_roles']   : array('Author');

                $this->page_template_class         = 'loop-team-authors '. $this->page_sidebar_template .'';

            } else if (is_page()) {
                global $post;

                $this->page_template               = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_page_layout_single', true, 'loop-page-2', '_mpgl_page_layout');
                $this->page_sidebar_template       = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_page_sidebar_template_single', '', 'right-sidebar', '_mpgl_page_sidebar_template');
                $this->page_sidebar_source         = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_page_sidebar_source_single', true, '', '_mpgl_page_sidebar_source');
                $this->page_image_full_height      = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_page_layout_single_image_height', true, 0, '_mpgl_page_layout_image_height');
                $this->page_template_img_format    = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_page_layout_single_image_format', true, 'medium', '_mpgl_page_layout_image_format');
                $this->enable_breadcrumbs          = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mpgl_page_enable_breadcrumbs_single', true, 1, '_mpgl_page_enable_breadcrumbs');

                $this->page_template_class         = 'loop-single '. $this->page_sidebar_template .' '. $this->page_template;

            } else if (is_404()) {

                $this->page_template               = isset($mipthemeoptions_framework['_mpgl_404page_template'])            ? $mipthemeoptions_framework['_mpgl_404page_template']                  : 'loop-cat-1';
                $this->page_template_chars         = ( isset($mipthemeoptions_framework['_mpgl_404page_template_chars']) && ($mipthemeoptions_framework['_mpgl_404page_template_chars'] > 0) )       ? $mipthemeoptions_framework['_mpgl_404page_template_chars']                  : 0;
                $this->page_template_grid          = isset($mipthemeoptions_framework['_mpgl_404page_grid_width'])          ? $mipthemeoptions_framework['_mpgl_404page_grid_width']                : 'standard';
                $this->page_template_show_category = 1;

                $this->page_template_show_date     = ( isset($mipthemeoptions_framework['_mpgl_404page_postmeta_elements']['date']) && $mipthemeoptions_framework['_mpgl_404page_postmeta_elements']['date'] )              ? 1 : 0;
                $this->page_template_show_author   = ( isset($mipthemeoptions_framework['_mpgl_404page_postmeta_elements']['author']) && $mipthemeoptions_framework['_mpgl_404page_postmeta_elements']['author'] )          ? 1 : 0;
                $this->page_template_show_category = ( isset($mipthemeoptions_framework['_mpgl_404page_postmeta_elements']['category']) && $mipthemeoptions_framework['_mpgl_404page_postmeta_elements']['category'] )      ? 1 : 0;
                $this->page_template_show_comments = ( isset($mipthemeoptions_framework['_mpgl_404page_postmeta_elements']['comments']) && $mipthemeoptions_framework['_mpgl_404page_postmeta_elements']['comments'] )      ? 1 : 0;
                $this->page_template_show_views    = ( isset($mipthemeoptions_framework['_mpgl_404page_postmeta_elements']['views']) && $mipthemeoptions_framework['_mpgl_404page_postmeta_elements']['views'] )            ? 1 : 0;

                $this->page_sidebar_template       = isset($mipthemeoptions_framework['_mpgl_404page_sidebar_template'])    ? $mipthemeoptions_framework['_mpgl_404page_sidebar_template']          : 'right-sidebar';
                $this->page_sidebar_source         = isset($mipthemeoptions_framework['_mpgl_404page_sidebar_source'])      ? $mipthemeoptions_framework['_mpgl_404page_sidebar_source']            : '';
                $this->page_show_posts_num         = isset($mipthemeoptions_framework['_mpgl_404page_posts_number'])        ? $mipthemeoptions_framework['_mpgl_404page_posts_number']              : 0;

                $this->page_title                  = ( isset($mipthemeoptions_framework['_mpgl_404page_posts_title']) && ($mipthemeoptions_framework['_mpgl_404page_posts_title'] != '') )            ? $mipthemeoptions_framework['_mpgl_404page_posts_title']                  : '';
                $this->enable_posts                = ( isset($mipthemeoptions_framework['_mpgl_404page_show_posts']) && (bool)$mipthemeoptions_framework['_mpgl_404page_show_posts'] )                ? 1                  : 0;

                $this->page_template_class         = 'loop-cat '. $this->page_sidebar_template .' '. $this->page_template .' '. $this->page_template_grid;

            } else if (is_tag()) {

                $this->page_template               = isset($mipthemeoptions_framework['_mpgl_tagpage_template'])            ? $mipthemeoptions_framework['_mpgl_tagpage_template']                  : 'loop-cat-1';
                $this->page_template_chars         = ( isset($mipthemeoptions_framework['_mpgl_tagpage_template_chars']) && ($mipthemeoptions_framework['_mpgl_tagpage_template_chars'] > 0) )       ? $mipthemeoptions_framework['_mpgl_tagpage_template_chars']                  : 0;
                $this->page_template_grid          = isset($mipthemeoptions_framework['_mpgl_tagpage_grid_width'])          ? $mipthemeoptions_framework['_mpgl_tagpage_grid_width']                : 'standard';

                $this->page_template_show_date     = ( isset($mipthemeoptions_framework['_mpgl_tagpage_postmeta_elements']['date']) && $mipthemeoptions_framework['_mpgl_tagpage_postmeta_elements']['date'] )              ? 1 : 0;
                $this->page_template_show_author   = ( isset($mipthemeoptions_framework['_mpgl_tagpage_postmeta_elements']['author']) && $mipthemeoptions_framework['_mpgl_tagpage_postmeta_elements']['author'] )          ? 1 : 0;
                $this->page_template_show_category = ( isset($mipthemeoptions_framework['_mpgl_tagpage_postmeta_elements']['category']) && $mipthemeoptions_framework['_mpgl_tagpage_postmeta_elements']['category'] )      ? 1 : 0;
                $this->page_template_show_comments = ( isset($mipthemeoptions_framework['_mpgl_tagpage_postmeta_elements']['comments']) && $mipthemeoptions_framework['_mpgl_tagpage_postmeta_elements']['comments'] )      ? 1 : 0;
                $this->page_template_show_views    = ( isset($mipthemeoptions_framework['_mpgl_tagpage_postmeta_elements']['views']) && $mipthemeoptions_framework['_mpgl_tagpage_postmeta_elements']['views'] )            ? 1 : 0;

                $this->page_sidebar_template       = isset($mipthemeoptions_framework['_mpgl_tagpage_sidebar_template'])    ? $mipthemeoptions_framework['_mpgl_tagpage_sidebar_template']          : 'right-sidebar';
                $this->page_sidebar_source         = isset($mipthemeoptions_framework['_mpgl_tagpage_sidebar_source'])      ? $mipthemeoptions_framework['_mpgl_tagpage_sidebar_source']            : '';
                $this->page_show_posts_num         = isset($mipthemeoptions_framework['_mpgl_tagpage_posts_number'])        ? $mipthemeoptions_framework['_mpgl_tagpage_posts_number']              : 0;
                $this->page_pagination             = isset($mipthemeoptions_framework['_mpgl_tagpage_pagination'])          ? $mipthemeoptions_framework['_mpgl_tagpage_pagination']                : 'post-pagination-1';

                $this->page_template_class         = 'loop-cat '. $this->page_sidebar_template .' '. $this->page_template .' '. $this->page_template_grid .' has-title';

            } else if (is_author()) {

                $this->page_template               = isset($mipthemeoptions_framework['_mpgl_authorpage_template'])            ? $mipthemeoptions_framework['_mpgl_authorpage_template']                  : 'loop-cat-1';
                $this->page_template_chars         = ( isset($mipthemeoptions_framework['_mpgl_authorpage_template_chars']) && ($mipthemeoptions_framework['_mpgl_authorpage_template_chars'] > 0) )       ? $mipthemeoptions_framework['_mpgl_authorpage_template_chars']                  : 0;
                $this->page_template_grid          = isset($mipthemeoptions_framework['_mpgl_authorpage_grid_width'])          ? $mipthemeoptions_framework['_mpgl_authorpage_grid_width']                : 'standard';

                $this->page_template_show_date     = ( isset($mipthemeoptions_framework['_mpgl_authorpage_postmeta_elements']['date']) && $mipthemeoptions_framework['_mpgl_authorpage_postmeta_elements']['date'] )              ? 1 : 0;
                $this->page_template_show_author   = ( isset($mipthemeoptions_framework['_mpgl_authorpage_postmeta_elements']['author']) && $mipthemeoptions_framework['_mpgl_authorpage_postmeta_elements']['author'] )          ? 1 : 0;
                $this->page_template_show_category = ( isset($mipthemeoptions_framework['_mpgl_authorpage_postmeta_elements']['category']) && $mipthemeoptions_framework['_mpgl_authorpage_postmeta_elements']['category'] )      ? 1 : 0;
                $this->page_template_show_comments = ( isset($mipthemeoptions_framework['_mpgl_authorpage_postmeta_elements']['comments']) && $mipthemeoptions_framework['_mpgl_authorpage_postmeta_elements']['comments'] )      ? 1 : 0;
                $this->page_template_show_views    = ( isset($mipthemeoptions_framework['_mpgl_authorpage_postmeta_elements']['views']) && $mipthemeoptions_framework['_mpgl_authorpage_postmeta_elements']['views'] )            ? 1 : 0;

                $this->page_sidebar_template       = isset($mipthemeoptions_framework['_mpgl_authorpage_sidebar_template'])    ? $mipthemeoptions_framework['_mpgl_authorpage_sidebar_template']          : 'right-sidebar';
                $this->page_sidebar_source         = isset($mipthemeoptions_framework['_mpgl_authorpage_sidebar_source'])      ? $mipthemeoptions_framework['_mpgl_authorpage_sidebar_source']            : '';
                $this->page_show_posts_num         = isset($mipthemeoptions_framework['_mpgl_authorpage_posts_number'])        ? $mipthemeoptions_framework['_mpgl_authorpage_posts_number']              : 0;
                $this->page_pagination             = isset($mipthemeoptions_framework['_mpgl_authorpage_pagination'])          ? $mipthemeoptions_framework['_mpgl_authorpage_pagination']                : 'post-pagination-1';
                $this->page_title                  = ( isset($mipthemeoptions_framework['_mpgl_authorpage_posts_title']) && ($mipthemeoptions_framework['_mpgl_authorpage_posts_title'] != '') )            ? $mipthemeoptions_framework['_mpgl_authorpage_posts_title']                  : '';

                $this->page_template_class         = 'loop-cat '. $this->page_sidebar_template .' '. $this->page_template .' '. $this->page_template_grid .' has-title';

            } else if (is_search()) {

                $this->page_template               = isset($mipthemeoptions_framework['_mpgl_searchpage_template'])            ? $mipthemeoptions_framework['_mpgl_searchpage_template']                  : 'loop-cat-1';
                $this->page_template_chars         = ( isset($mipthemeoptions_framework['_mpgl_searchpage_template_chars']) && ($mipthemeoptions_framework['_mpgl_searchpage_template_chars'] > 0) )       ? $mipthemeoptions_framework['_mpgl_searchpage_template_chars']                  : 0;
                $this->page_template_grid          = isset($mipthemeoptions_framework['_mpgl_searchpage_grid_width'])          ? $mipthemeoptions_framework['_mpgl_searchpage_grid_width']                : 'standard';

                $this->page_template_show_date     = ( isset($mipthemeoptions_framework['_mpgl_searchpage_postmeta_elements']['date']) && $mipthemeoptions_framework['_mpgl_searchpage_postmeta_elements']['date'] )              ? 1 : 0;
                $this->page_template_show_author   = ( isset($mipthemeoptions_framework['_mpgl_searchpage_postmeta_elements']['author']) && $mipthemeoptions_framework['_mpgl_searchpage_postmeta_elements']['author'] )          ? 1 : 0;
                $this->page_template_show_category = ( isset($mipthemeoptions_framework['_mpgl_searchpage_postmeta_elements']['category']) && $mipthemeoptions_framework['_mpgl_searchpage_postmeta_elements']['category'] )      ? 1 : 0;
                $this->page_template_show_comments = ( isset($mipthemeoptions_framework['_mpgl_searchpage_postmeta_elements']['comments']) && $mipthemeoptions_framework['_mpgl_searchpage_postmeta_elements']['comments'] )      ? 1 : 0;
                $this->page_template_show_views    = ( isset($mipthemeoptions_framework['_mpgl_searchpage_postmeta_elements']['views']) && $mipthemeoptions_framework['_mpgl_searchpage_postmeta_elements']['views'] )            ? 1 : 0;

                $this->page_sidebar_template       = isset($mipthemeoptions_framework['_mpgl_searchpage_sidebar_template'])    ? $mipthemeoptions_framework['_mpgl_searchpage_sidebar_template']          : 'right-sidebar';
                $this->page_sidebar_source         = isset($mipthemeoptions_framework['_mpgl_searchpage_sidebar_source'])      ? $mipthemeoptions_framework['_mpgl_searchpage_sidebar_source']            : '';
                $this->page_show_posts_num         = isset($mipthemeoptions_framework['_mpgl_searchpage_posts_number'])        ? $mipthemeoptions_framework['_mpgl_searchpage_posts_number']              : 0;
                $this->page_pagination             = isset($mipthemeoptions_framework['_mpgl_searchpage_pagination'])          ? $mipthemeoptions_framework['_mpgl_searchpage_pagination']                : 'post-pagination-1';
                $this->page_title                  = ( isset($mipthemeoptions_framework['_mpgl_searchpage_posts_title']) && ($mipthemeoptions_framework['_mpgl_searchpage_posts_title'] != '') )            ? $mipthemeoptions_framework['_mpgl_searchpage_posts_title']                  : '';

                $this->page_template_class         = 'loop-cat '. $this->page_sidebar_template .' '. $this->page_template .' '. $this->page_template_grid .' has-title';

            } else if (is_archive()) {

                $this->page_template               = isset($mipthemeoptions_framework['_mpgl_archivepage_template'])            ? $mipthemeoptions_framework['_mpgl_archivepage_template']                  : 'loop-cat-1';
                $this->page_template_chars         = ( isset($mipthemeoptions_framework['_mpgl_archivepage_template_chars']) && ($mipthemeoptions_framework['_mpgl_archivepage_template_chars'] > 0) )       ? $mipthemeoptions_framework['_mpgl_archivepage_template_chars']                  : 0;
                $this->page_template_grid          = isset($mipthemeoptions_framework['_mpgl_archivepage_grid_width'])          ? $mipthemeoptions_framework['_mpgl_archivepage_grid_width']                : 'standard';

                $this->page_template_show_date     = ( isset($mipthemeoptions_framework['_mpgl_archivepage_postmeta_elements']['date']) && $mipthemeoptions_framework['_mpgl_archivepage_postmeta_elements']['date'] )              ? 1 : 0;
                $this->page_template_show_author   = ( isset($mipthemeoptions_framework['_mpgl_archivepage_postmeta_elements']['author']) && $mipthemeoptions_framework['_mpgl_archivepage_postmeta_elements']['author'] )          ? 1 : 0;
                $this->page_template_show_category = ( isset($mipthemeoptions_framework['_mpgl_archivepage_postmeta_elements']['category']) && $mipthemeoptions_framework['_mpgl_archivepage_postmeta_elements']['category'] )      ? 1 : 0;
                $this->page_template_show_comments = ( isset($mipthemeoptions_framework['_mpgl_archivepage_postmeta_elements']['comments']) && $mipthemeoptions_framework['_mpgl_archivepage_postmeta_elements']['comments'] )      ? 1 : 0;
                $this->page_template_show_views    = ( isset($mipthemeoptions_framework['_mpgl_archivepage_postmeta_elements']['views']) && $mipthemeoptions_framework['_mpgl_archivepage_postmeta_elements']['views'] )            ? 1 : 0;

                $this->page_sidebar_template       = isset($mipthemeoptions_framework['_mpgl_archivepage_sidebar_template'])    ? $mipthemeoptions_framework['_mpgl_archivepage_sidebar_template']          : 'right-sidebar';
                $this->page_sidebar_source         = isset($mipthemeoptions_framework['_mpgl_archivepage_sidebar_source'])      ? $mipthemeoptions_framework['_mpgl_archivepage_sidebar_source']            : '';
                $this->page_show_posts_num         = isset($mipthemeoptions_framework['_mpgl_archivepage_posts_number'])        ? $mipthemeoptions_framework['_mpgl_archivepage_posts_number']              : 0;
                $this->page_pagination             = isset($mipthemeoptions_framework['_mpgl_archivepage_pagination'])          ? $mipthemeoptions_framework['_mpgl_archivepage_pagination']                : 'post-pagination-1';

                if (is_day()) {
                    $this->page_title = esc_html__('Daily Archives:', 'Newsgamer'). ' <em>' . get_the_date() .'</em>';
                } elseif (is_month()) {
                    $this->page_title = esc_html__('Monthly Archives:', 'Newsgamer') . ' <em>'. get_the_date('F Y') .'</em>';
                } elseif (is_year()) {
                    $this->page_title = esc_html__('Yearly Archives:', 'Newsgamer') . ' <em>'. get_the_date('Y') .'</em>';
                } else {
                    $this->page_title = esc_html__('Archives', 'Newsgamer');
                }

                $this->page_template_class         = 'loop-cat '. $this->page_sidebar_template .' '. $this->page_template .' '. $this->page_template_grid .' has-title';

            }

        }


        public function showCategoryTitle() {
            if ( $this->cat_show_title == 1 ) {
                return '<header><h2><span>'. get_cat_name(get_query_var('cat')) .'</span></h2></header>';
            } else if ( ($this->cat_show_title == 2)&&($this->cat_show_title_image != '') ) {
                return '<header>
                            <img src="'. $this->cat_show_title_image .'" class="intro img-responsive" alt="" />
                        </header>';
            }
        }


        public function showTitle() {
            if ( $this->page_title != '' ) {
                return '<header><h2><span>'. $this->page_title .'</span></h2></header>';
            }
        }

        public function getArgsForAuthorTeamSorting( $offset, $paged ) {
            global $wpdb;
            $blog_id = get_current_blog_id();
            $meta_query = array(
                'key' => $wpdb->get_blog_prefix($blog_id) . 'capabilities',
                'value' => '"(' . implode('|', array_map('preg_quote', $this->authors_roles)) . ')"',
                'compare' => 'REGEXP'
            );

            if ( $this->authors_orderby == 'post_views' ) { // sort by post views
                if ( $paged == 1 ) {
                    $tmp_args = array(
                        'meta_query'=> array($meta_query),
                        'exclude'   => array( $this->authors_exclude ),
                        'orderby'   => $this->authors_orderby,
                        'order'     => $this->authors_order
                    );
                    $tmp_query      = new WP_User_Query( $tmp_args );
                    if ( ! empty( $tmp_query->results ) ) {
                        foreach ( $tmp_query->results as $tmp_user ) {
                            $tmp_author_post_views = $wpdb->get_var($wpdb->prepare("SELECT SUM(meta_value) AS post_views, meta_key FROM $wpdb->postmeta WHERE meta_key = 'mip_post_views_count' AND post_id IN (SELECT ID from $wpdb->posts WHERE post_author = %d) GROUP BY meta_key", $tmp_user->ID));
                            update_user_meta( $tmp_user->ID, 'mip_author_post_views', $tmp_author_post_views );
                        }
                    }
                }

                $args = array(
                    'meta_query'=> array($meta_query),
                    'exclude'   => array( $this->authors_exclude ),
                    'orderby'   => 'meta_value_num',
                    'meta_key'  => 'mip_author_post_views',
                    'order'     => $this->authors_order,
                    'number'    => $this->page_show_posts_num,
                    'offset'    => $offset // skip the number of users that we have per page
                );
            } else {
                $args = array(
                    'meta_query'=> array($meta_query),
                    'exclude'   => array( $this->authors_exclude ),
                    'orderby'   => $this->authors_orderby,
                    'order'     => $this->authors_order,
                    'number'    => $this->page_show_posts_num,
                    'offset'    => $offset // skip the number of users that we have per page
                );
            }
            return $args;
        }

        public function getCommentsForAuthorTeam( $userId ) {
            global $wpdb;
            return $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) AS author_comment_counts FROM $wpdb->comments WHERE comment_approved = 1 AND user_id = %d", $userId));
        }

        public function getPostViewsForAuthorTeam( $userId ) {
            global $wpdb;
            return $wpdb->get_var($wpdb->prepare("SELECT SUM(meta_value) AS post_views, meta_key FROM $wpdb->postmeta WHERE meta_key = 'mip_post_views_count' AND post_id IN (SELECT ID from $wpdb->posts WHERE post_author = %d) GROUP BY meta_key", $userId));
        }


    }

}
