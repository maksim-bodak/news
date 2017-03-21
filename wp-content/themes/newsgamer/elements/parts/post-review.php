<?php
    $mipthemeoptions_framework  = mipthemeframework_get_redux_var();
    $mip_current_page           = mipthemeframework_get_mip_current_page();

    if ( $mip_current_page->review_post || ($mip_current_page->review_post == 'enable') ) :
        $review_post_style              = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_style');
        $review_post_summary_type       = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_summary_type', true, '', '_mp_review_post_summary_type_global');
        $review_post_summary_text       = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_summary_text');
        $review_post_summary_text_good  = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_summary_text_good');
        $review_post_summary_text_bad   = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_summary_text_bad');
        $review_post_total_text         = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_total_text');
        $review_post_criteria_count     = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_criteria_count', true, 0, '_mp_review_post_criteria_count_global');
        $review_post_total_score        = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_total_score');
        $review_post_position           = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_position');

        $review_post_user_total_score   = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, 'post_user_average');

        $score                          = round($review_post_total_score/10, 1);
        $scoreClass                     = round($review_post_total_score/10, 0);

        $review_output  = '
            <!-- start:review -->
            <div class="review review-score-'. $scoreClass .'">
                <div class="row bottom-margin">
                    <div class="col-lg-4 text-center">
                        <div class="review-circle-wrapper">
                            <div class="review-circle">
                                <div class="meter-wrapper">
                                    <div class="meter-slice showfill">
                                        <div class="meter" style="-webkit-transform:rotate('. (360 * ($score/10)) .'deg);-moz-transform:rotate('. (360 * ($score/10)) .'deg);-o-transform:rotate('. (360 * ($score/10)) .'deg);-ms-transform:rotate('. (360 * ($score/10)) .'deg);transform:rotate('. (360 * ($score/10)) .'deg);"></div>
                                        <div class="meter fill"></div>
                                    </div>
                                </div>
                                <div class="rating">
                                    <div class="score-number">'. ( ( $review_post_style == 'percentage' ) ? round($review_post_total_score) .'<small>%</small>' : round($review_post_total_score/10, 1) ) .'</div>
                                </div>
                            </div>
                        </div>
                        <span class="score-desc">'. $review_post_total_text .'</span>
                    </div>
                    <div class="col-lg-8">';

        if ( $review_post_summary_type == 'summ' ) :

            $review_output  .= '
                        <h4>'. esc_html__('Summary', 'Newsgamer') .'</h4>
                        <p>'. do_shortcode($review_post_summary_text) .'</p>';

        elseif ( $review_post_summary_type == 'good-bad' ) :

            $review_output  .= '
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>'. esc_html__('The Good', 'Newsgamer') .'</h4>
                                <ul class="good"><li><i class="fa fa-plus-circle"></i>'. str_replace(array("\r\n", "\r", "\n"), '</li><li><i class="fa fa-plus-circle"></i>', $review_post_summary_text_good) .'</li></ul>
                            </div>
                            <div class="col-sm-6">
                                <h4>'. esc_html__('The Bad', 'Newsgamer') .'</h4>
                                <ul class="bad"><li><i class="fa fa-minus-circle"></i>'. str_replace(array("\r\n", "\r", "\n"), '</li><li><i class="fa fa-minus-circle"></i>', $review_post_summary_text_bad) .'</li></ul>
                            </div>
                        </div>';

        endif;

        $review_output  .= '
                    </div>
                </div>';

        $author_review_output = '';
        for ( $i = 1; $i <= $review_post_criteria_count; $i++ ) {
            $crit_name      = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_criteria_'. $i .'', true, '', '_mp_review_post_criteria_'. $i .'_global');
            $crit_value      = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_criteria_value_'. $i .'', true, '75', '_mp_review_post_criteria_value_'. $i .'_global');
            $author_review_output  .= '
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: '. esc_attr($crit_value) .'%;">
                        <span class="skill-number pull-left">'. ( ( $review_post_style == 'percentage' ) ? $crit_value .' %' : round($crit_value/10, 1) ) .'</span>
                        <span class="skill-text pull-left">'. $crit_name .'</span>
                    </div>
                </div>';
        }

        $user_review_output = '';
        $postAverage        = get_post_meta($post->ID, 'post_user_average', true);
        $user_rates         = get_post_meta($post->ID, 'post_user_raitings', true);
        if (!empty ($user_rates)) {$usercriterias = $user_rates['criteria'];}
        if ($postAverage !='0' && $postAverage !='') :
            foreach ($usercriterias as $usercriteria) {
				$perc_criteria = $usercriteria['average']*10;
                $user_review_output  .= '
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: '. esc_attr($perc_criteria) .'%;">
                            <span class="skill-number pull-left">'. ( ( $review_post_style == 'percentage' ) ? $perc_criteria .' %' : round($usercriteria['average'], 1) ) .'</span>
                            <span class="skill-text pull-left">'. $usercriteria['name'] .'</span>
                        </div>
                    </div>';
			}
        endif;

        if ( $mip_current_page->review_post && $mip_current_page->review_post_users_enable && $review_post_user_total_score) {
            $review_output .=
                '<div class="row column-scores">
                    <div class="col-sm-6">
                        <h4>'. esc_html__("Editor's score", "Newsgamer") .'<span>'. round($review_post_total_score/10, 1) .'</span></h4>
                        '. $author_review_output .'
                    </div>
                    <div class="col-sm-6">
                        <h4>'. esc_html__("User's score", "Newsgamer") .'<span>'. round($review_post_user_total_score, 1) .'</span></h4>
                        '. $user_review_output .'
                    </div>
                </div>';
        } else {
            $review_output .= $author_review_output;
        }

        $review_output  .= '</div><!-- end:review -->';

        echo mipthemeframework_get_string_prefix() . $review_output;
    endif;
?>
