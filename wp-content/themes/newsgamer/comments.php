<?php
/**
 * The template for displaying Comments
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

// Get Page properties
$mip_current_page   = new MipThemeFramework_Page();

// Add inputs to comment form
if( !function_exists('mipthemeframework_add_criteria_raitings_comment_fields') ) {
	function mipthemeframework_add_criteria_raitings_comment_fields($fields) {
		global $post;
		$review_post_criteria_count     = MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_criteria_count');
		$commentReviewInputs			= '';
		$commentReviewInputs2			= '';
		if ( $review_post_criteria_count > 0 ) {

			$criteriaNamesArray = array();
			$commentReviewInputs .= '<div id="comment-user-reviews" class="row bottom-margin">
				<div class="col-md-6">
					<textarea class="form-control needsclick" placeholder="' . esc_html__('Pros:', 'Newsgamer') . '" id="pros_review" name="pros_review" cols="45" rows="5" aria-required="true"></textarea>
					<br>
					<textarea class="form-control needsclick" placeholder="' . esc_html__('Cons:', 'Newsgamer') . '" id="cons_review" name="cons_review" cols="45" rows="5" aria-required="true"></textarea>
				</div>
				<div class="col-md-6 user-range-sliders">';

			for ( $i = 1; $i <= $review_post_criteria_count; $i++ ) {
	            $crit_name      		= MipThemeFramework_Util::miptheme_diff_global_redux_post_meta($post->ID, '_mp_review_post_criteria_'. $i .'');
				$criteriaNamesArray[$i] = $crit_name;

				$commentReviewInputs .= '<div class="user-range clearfix">';
				$commentReviewInputs .= '<label for="criteria_input_'.$i.'">'. $crit_name .'</label>';
				$commentReviewInputs .= '<input id="criteria_input_'.$i.'" type="hidden" name="user_criteria[]" value="0" class="user_criteria_hidden_'.$i.'" /><span class="user_review_raty raty_criteria_score_'. $i .'" data-score="0">0</span><div class="user_rating_range" data-index="'. $i .'"></div>';
				$commentReviewInputs .= '</div>';
			};

			$commentReviewInputs .= '<div class="user_total_score">'.__('Total score','Newsgamer').' <span>0</span></div><input type="hidden" name="criteria_names" value="'. base64_encode(serialize($criteriaNamesArray)).'" />';

			$commentReviewInputs .= '</div>
							</div>';

			// check if rated post already
			$current_user_id = get_current_user_id();
			if($current_user_id) {
				$user_rated_posts = get_user_meta($current_user_id, 'user_rated_posts', true);
				if($user_rated_posts) {
					$current_post_id = get_the_ID();
					if(in_array($current_post_id, $user_rated_posts)) {
						$commentReviewInputs = '';
					};
				};
			}

			else {
				if (isset($_COOKIE['user_rated_posts'])) {
					$user_rated_posts = explode(',', $_COOKIE['user_rated_posts']);
					if($user_rated_posts) {
						$commentReviewInputs = '';
					};
				};
			};


			if(is_user_logged_in()) {
				$fields = $commentReviewInputs;
			}
			else {
				$fields['criteria'] = $commentReviewInputs;
			};
			return $fields;

		}
		else {
			return $fields;
		}

	}
}


/* function that show review in comment */
if( !function_exists('mipthemeframework_attach_comment_criteria_raitings') ) {
    function mipthemeframework_attach_comment_criteria_raitings($text='') {
        $userCriteria 	= get_comment_meta(get_comment_ID(), 'user_criteria', true);
    	$pros_review 	= get_comment_meta(get_comment_ID(), 'pros_review', true);
    	$cons_review 	= get_comment_meta(get_comment_ID(), 'cons_review', true);
        $userAverage 	= get_comment_meta(get_comment_ID(), 'user_average', true);
		$html			= '';
    	if(is_array($userCriteria) && !empty($userCriteria)) {
    			$html 	.='<div class="review-comment">
							<div class="row bottom-margin">';
    		if(isset($userAverage) && $userAverage != '') {
				$html	.= '	<div class="col-xs-12 col-sm-4 text-center">
									<div class="review-circle-wrapper">
										<div class="review-circle">
											<div class="meter-wrapper">
												<div class="meter-slice showfill">
													<div class="meter" style="-webkit-transform:rotate('. (360 * ($userAverage/10)) .'deg);-moz-transform:rotate('. (360 * ($userAverage/10)) .'deg);-o-transform:rotate('. (360 * ($userAverage/10)) .'deg);-ms-transform:rotate('. (360 * ($userAverage/10)) .'deg);transform:rotate('. (360 * ($userAverage/10)) .'deg);"></div>
													<div class="meter fill"></div>
												</div>
											</div>
											<div class="rating">
												<div class="score-number">'. $userAverage .'</div>
											</div>
										</div>
									</div>
								</div>';
    		};

			if(isset($pros_review) && $pros_review != '') {
    			$html .= '		<div class="col-sm-4">
									<h4>'. esc_html__('The Good', 'Newsgamer') .'</h4>
									<ul class="good"><li><i class="fa fa-plus-circle"></i>'. str_replace(array("\r\n", "\r", "\n"), '</li><li><i class="fa fa-plus-circle"></i>', $pros_review) .'</li></ul>
								</div>';
    		};
    		if(isset($cons_review) && $cons_review != '') {
    			$html .= '		<div class="col-sm-4">
									<h4>'. esc_html__('The Bad', 'Newsgamer') .'</h4>
									<ul class="bad"><li><i class="fa fa-minus-circle"></i>'. str_replace(array("\r\n", "\r", "\n"), '</li><li><i class="fa fa-minus-circle"></i>', $cons_review) .'</li></ul>
								</div>';
    		};
			$html .= '		</div>';

			for($i = 0; $i < count($userCriteria); $i++) {
				$value_criteria = $userCriteria[$i]['value'];
				$html	.= '<div class="progress">
								<div class="progress-bar" role="progressbar" style="width:'. $value_criteria*10 .'%;">
									<span class="skill-number pull-left">'. $value_criteria .'</span>
									<span class="skill-text pull-left">'. $userCriteria[$i]['name'] .'</span>
								</div>
							</div>';
			};

    		//$html .= '<div class="row">';

    		$html .= '</div>';
    	};
        echo $html;
    }
}


if ( $mip_current_page->review_post && $mip_current_page->review_post_users_enable) {

	// Add inputs to comment form
	if ( $mip_current_page->review_post_users_enable && ( $mip_current_page->review_post_users_role == 'guests' ) ) {
		if (!is_user_logged_in()) {
			add_filter('comment_form_default_fields', 'mipthemeframework_add_criteria_raitings_comment_fields');
		}
	}
	elseif ( $mip_current_page->review_post_users_enable && ( $mip_current_page->review_post_users_role == 'users') ) {
		if (is_user_logged_in()) {
			add_filter('comment_form_logged_in', 'mipthemeframework_add_criteria_raitings_comment_fields');
		}
	}
	else {
		add_filter('comment_form_default_fields', 'mipthemeframework_add_criteria_raitings_comment_fields');
		add_filter('comment_form_logged_in', 'mipthemeframework_add_criteria_raitings_comment_fields');
	}

}

?>

<!-- start:article-comments -->
<section id="comments">

    <?php if ( have_comments() ) : ?>

	<header>
	    <h2><span><?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'Newsgamer' ), number_format_i18n( get_comments_number() ) ); ?></span></h2>
	</header>

	<ol id="comments-list">
	<?php
	    wp_list_comments( array(
		'style' => 'ol',
		'short_ping' => true,
		'avatar_size' => 75,
		'callback' => 'mipthemeframework_comments_callback',
		'walker' => new MipThemeFramework_Walker_Comment
	    ) );
	?>
	</ol><!-- .comment-list -->

	<div class="comment-pagination">
		<?php paginate_comments_links(); ?>
	</div>

    <?php endif; // have_comments() ?>

</section>
<!-- end:article-comments -->

<!-- start:article-comments-form -->
<section id="article-comments-form">

	<?php

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

        $fields =  array(
			'author' =>
				'<div class="row bottom-margin">
					<div class="col-sm-4">
						<span class="comment-req-wrap needsclick"><input class="form-control" id="author" name="author" placeholder="' . esc_html__('Name:', 'Newsgamer') . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' . ( $req ? '</span>' : '' ) .
				'	</div>',

			'email'  =>
				'	<div class="col-sm-4">
						<span class="comment-req-wrap needsclick"><input class="form-control" id="email" name="email" placeholder="' . esc_html__('Email:', 'Newsgamer') . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . ( $req ? '</span>' : '' ) .
				'	</div>',

			'url' =>
				'	<div class="col-sm-4">
						<input class="form-control" id="url" name="url" placeholder="' . esc_html__('Website:', 'Newsgamer') . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />' .
				'	</div>
				</div>',
		);

	$defaults = array(
		'fields' => apply_filters('comment_form_default_fields', $fields ),
	);

	$defaults['comment_field'] = '<div class="row bottom-margin">
		<div class="col-md-12">
			<textarea class="form-control needsclick" placeholder="' . esc_html__('Comment:', 'Newsgamer') . '" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
		</div>
	</div>';



	$defaults['comment_notes_before'] = '';
	$defaults['comment_notes_after'] = '';
	$defaults['title_reply'] = esc_html__('Leave a Reply', 'Newsgamer');
	$defaults['label_submit'] = esc_html__('Post Comment', 'Newsgamer');
	$defaults['cancel_reply_link'] = esc_html__('Cancel reply', 'Newsgamer');

	comment_form($defaults);
	?>

</section>
<!-- end:article-comments-form -->




<?php
/**
* Custom callback for outputting comments
*/

function mipthemeframework_comments_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	if ( $comment->comment_approved == '1' ) {
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="comment" id="comment-<?php comment_ID(); ?>">
			<?php echo get_avatar( $comment->comment_author_email, 75 ); ?>
			<div class="comment-text">
				<header>
					<h5 class="pull-left"><?php comment_author_link() ?></h5>
					<span class="time-stamp"><?php comment_date() ?> <?php esc_html_e('at', 'Newsgamer') ?> <?php comment_time() ?></span>
					<?php
						comment_reply_link(array_merge( $args, array(
							'depth' => $depth,
							'max_depth' => $args['max_depth'],
							'reply_text' => esc_html__('Reply', 'Newsgamer'),
							'login_text' =>  esc_html__('Log in to leave a comment', 'Newsgamer'),
							'before' => '<span class="reply pull-right">',
							'after' => '</span>'
						)))
					?>
				</header>
				<?php comment_text(); ?>
				<?php mipthemeframework_attach_comment_criteria_raitings(); ?>
			</div>
		</div>
	</li>
<?php
	}
}
?>
