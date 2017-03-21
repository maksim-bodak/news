<?php

if ( ! class_exists( 'MipThemeFramework_Walker_Comment' ) ) {
    class MipThemeFramework_Walker_Comment extends Walker_Comment
    {
        public function end_el( &$output, $comment, $depth = 0, $args = array() ) {
            if ( !empty( $args['end-callback'] ) ) {
                ob_start();
                call_user_func( $args['end-callback'], $comment, $args, $depth );
                $output .= ob_get_clean();
                return;
            }
            if ( 'div' == $args['style'] )
                $output .= "</div><!-- #comment-## -->\n";
            else
                $output .= "<!-- #comment-## -->\n";
        }

    }
}


// Saving data from fields
function mipthemeframework_save_comment_criteria_raitings($comment_id) {

    // Get Page properties
	if((isset($_POST['user_criteria'])) && ($_POST['user_criteria'] != '')) { // if we got user ratings
		$userCriteria = $_POST['user_criteria']; // put user ratings in array
		for($i = 0; $i < count($userCriteria); $i++) { // get sum of ratings
			$commentTotal += $userCriteria[$i];
		};
		if($commentTotal == 0) { // if sum = 0
			return false;
		}
		else { // if user set ratings
			$commentData = array();
			$criteriaNamesSerialized = $_POST['criteria_names']; // get serialized array of criteria names
			$criteriaNames = unserialize(base64_decode($criteriaNamesSerialized));
			for($i = 0; $i < count($userCriteria); $i++) {
				$commentData[$i]['name'] = $criteriaNames[$i+1]; // put name of criteria in variable
				$commentData[$i]['value'] = $userCriteria[$i]; // put criteria value in variable
			};
			$commentAverage = bcdiv($commentTotal, count($commentData), 1); // get average of comment ratings
		};
		$cons_review_clean = wp_kses($_POST['cons_review'], 'default'); // get cons value
		$pros_review_clean = wp_kses($_POST['pros_review'], 'default'); // get pros value
		update_comment_meta($comment_id, 'cons_review', $cons_review_clean); // put cons in meta field
		update_comment_meta($comment_id, 'pros_review', $pros_review_clean); // put pros in meta field
		update_comment_meta($comment_id, 'user_criteria', $commentData); // put array of user ratings in meta field
		update_comment_meta($comment_id, 'user_average', $commentAverage); // put average of ratings in meta field
		update_comment_meta($comment_id, 'counted', 0); // set flag approve or not user review

		/* Prevent duplicate vote */
		$current_user_id = get_current_user_id(); // get user ID
		if($current_user_id) { // if register
			$current_post_id = get_the_ID(); // get post ID
			$rated_posts_meta = get_user_meta($current_user_id , 'user_rated_posts'); // get array of reviewed posts of user
			if(!$rated_posts_meta || $rated_posts_meta == '') { // if array not exist
				$new_rated_posts_meta = array($current_post_id); // create array
			}
			else {
				$new_rated_posts_meta = $rated_posts_meta[0]; // get array of reviewed posts of user
				array_push($new_rated_posts_meta, $current_post_id); // put ID of reviewed post in array of reviewed posts
			};
			update_user_meta($current_user_id , 'user_rated_posts', $new_rated_posts_meta); // update user meta field
		}
		else { // if user is not register
			$domainArray = explode('://', home_url());
			$clearDomain = $domainArray[1]; // get site domain
			$clearLink = str_replace(home_url(), '', get_permalink()); // get post URL
			setcookie('user_rated_posts', 1, time()+60*60*24*366, $clearLink, $clearDomain, false); // put cookie that user reviewed this post
		};
	};

}

// Save data on commenting
add_action('comment_post', 'mipthemeframework_save_comment_criteria_raitings');


add_action('comment_post', 'mipthemeframework_comment_rates_change_on_post', 10, 2);  // Runs when saving new comment
add_action('edit_comment', 'mipthemeframework_comment_rates_change');  // Runs when editing comment
add_action('delete_comment', 'mipthemeframework_comment_rates_change'); // Runs just before a comment is deleted. Action function arguments: comment ID.
add_action('trash_comment', 'mipthemeframework_comment_rates_change'); // Runs just before a comment is trashed. Action function arguments: comment ID.
add_action('comment_closed', 'mipthemeframework_comment_rates_change'); // Runs when the post is marked as not a spam.
add_action('wp_set_comment_status', 'mipthemeframework_comment_rates_change'); // Runs when the status of a comment changes. Action function arguments: comment ID, status string indicating the new status ("delete", "approve", "spam", "hold").

function mipthemeframework_comment_rates_change($comment_id) {
	$status = wp_get_comment_status($comment_id); // 'deleted', 'approved', 'unapproved', 'spam'
	switch($status) {
		case 'approved':
			mipthemeframework_add_comment_rates($comment_id);
			break;
		case 'unapproved':
			mipthemeframework_remove_comment_rates($comment_id);
			break;
		case 'spam':
			mipthemeframework_remove_comment_rates($comment_id);
			break;
		case 'trash':
			mipthemeframework_remove_comment_rates($comment_id);
			break;
		case 'deleted':
			mipthemeframework_remove_comment_rates($comment_id);
			break;
		default:
	};
}

function mipthemeframework_comment_rates_change_on_post($comment_id, $comment_approved) {
	if( $comment_approved == 1 ) {
		mipthemeframework_add_comment_rates($comment_id);
	}
	else {
		return;
	}
}

/* Saving data from fields */
function mipthemeframework_add_comment_rates($comment_id) {
	$counted = get_comment_meta($comment_id, 'counted', true); // get flag

	if($counted == 0) {
		$comment = get_comment($comment_id);
		$comment_post_id = $comment->comment_post_ID;
		$postUserRaitingsArray = get_post_meta($comment_post_id, 'post_user_raitings', false);
		$postUserRaitings = $postUserRaitingsArray[0];
		$commentRaitingsArray = get_comment_meta($comment_id, 'user_criteria', false);
		$commentRaitings = $commentRaitingsArray[0];
		$postData = array();
		for($i = 0; $i < count($commentRaitings); $i++) {
			$postData['criteria'][$i]['name'] = $commentRaitings[$i]['name'];
			if(isset($postUserRaitings['criteria'][$i])) {
				$count = (int) $postUserRaitings['criteria'][$i]['count'] + 1;
				$total = (float) $commentRaitings[$i]['value'] + (float) $postUserRaitings['criteria'][$i]['value'];
				$postData['criteria'][$i]['count'] = $count;
				$postData['criteria'][$i]['value'] = $total;
				$postData['criteria'][$i]['average'] = bcdiv($total, $count, 1);
			}
			else {
				$postData['criteria'][$i]['count'] = 1;
				$postData['criteria'][$i]['value'] = (float) $commentRaitings[$i]['value'];
				$postData['criteria'][$i]['average'] = (float) $commentRaitings[$i]['value'];
			};
			$postCriteriaAverage += $postData['criteria'][$i]['average'];
		};
		if(isset($commentRaitings) && count($commentRaitings) > 0) {
			$postAverage = bcdiv($postCriteriaAverage, count($commentRaitings), 1);
			update_post_meta($comment_post_id, 'post_user_raitings', $postData);
			update_post_meta($comment_post_id, 'post_user_average', $postAverage);
			update_comment_meta($comment_id, 'counted', 1);
		}
	}

	elseif($counted == '') {
		update_comment_meta($comment_id, 'counted', 1);
	};
}

/* remove coment data on comment remove */

function mipthemeframework_remove_comment_rates($comment_id) {
	$counted = get_comment_meta($comment_id, 'counted', true);
	if($counted == 1 || $counted == '') {
		$comment = get_comment($comment_id);
		$comment_post_id = $comment->comment_post_ID;
		$postUserRaitingsArray = get_post_meta($comment_post_id, 'post_user_raitings', false);
		$postUserRaitings = $postUserRaitingsArray[0];
		$commentRaitingsArray = get_comment_meta($comment_id, 'user_criteria', false);
		$commentRaitings = $commentRaitingsArray[0];
		$postData = array();
		for($i = 0; $i < count($commentRaitings); $i++) {
			$postData['criteria'][$i]['name'] = $commentRaitings[$i]['name'];
			if(isset($postUserRaitings['criteria'][$i])) {
				$count = (int) $postUserRaitings['criteria'][$i]['count'] - 1;
				$total = (float) $postUserRaitings['criteria'][$i]['value'] - (float) $commentRaitings[$i]['value'];
				$postData['criteria'][$i]['count'] = $count;
				$postData['criteria'][$i]['value'] = $total;
				if ($count =='0') {
					$postData['criteria'][$i]['average'] = '';
				}
				else {
					$postData['criteria'][$i]['average'] = bcdiv($total, $count, 1);
				}
			};
			$postCriteriaAverage += $postData['criteria'][$i]['average'];
		};
		if(isset($commentRaitings) && count($commentRaitings) > 0) {
			$postAverage = bcdiv($postCriteriaAverage, count($commentRaitings), 1);
			update_post_meta($comment_post_id, 'post_user_raitings', $postData);
			update_post_meta($comment_post_id, 'post_user_average', $postAverage);
			update_comment_meta($comment_id, 'counted', 0);
		}
	};
};

// ADD THE COMMENTS META FIELDS TO THE COMMENTS ADMIN PAGE

function mipthemeframework_comment_columns( $columns )
{
	$columns['miptheme_custom_column'] = __( 'User review', 'Newsgamer' );
	return $columns;
}
add_filter( 'manage_edit-comments_columns', 'mipthemeframework_comment_columns' );

function mipthemeframework_comment_column( $column, $comment_ID )
{
	if ( 'miptheme_custom_column' == $column ) {

	$comment_meta = get_comment_meta($comment_ID);
	$userCriteria = get_comment_meta($comment_ID, 'user_criteria', true);
	$pros_review = get_comment_meta($comment_ID, 'pros_review', true);
	$cons_review = get_comment_meta($comment_ID, 'cons_review', true);
	if(is_array($userCriteria) && !empty($userCriteria)) {
		if(isset($pros_review) && $pros_review != '') {
			echo ''.__('PROS:', 'Newsgamer').' '.$pros_review.'<br />';
		};
		if(isset($cons_review) && $cons_review != '') {
			echo ''.__('CONS:', 'Newsgamer').' '.$cons_review.'<br /><br />';
		};
		for($i = 0; $i < count($userCriteria); $i++) {
			echo ''.$userCriteria[$i]['name'].': <strong class="rating">'.$userCriteria[$i]['value'].'</strong><br />';
		};
	};
	echo '</p>';
	}
}
add_filter( 'manage_comments_custom_column', 'mipthemeframework_comment_column', 10, 2 );
