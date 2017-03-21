<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * mwd_Notices Class
 *
 */
class MWD_Notices {
	static $instance;

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new MWD_Notices();
		}

		return self::$instance;
	}

	public $notice_spam = 0;
	public $notice_spam_max = 1;

	// Basic actions to run
	public function __construct() {

		// Runs the admin notice ignore function incase a dismiss button has been clicked
		add_action( 'admin_init', array( $this, 'admin_notice_ignore' ) );

		// Runs the admin notice temp ignore function incase a temp dismiss link has been clicked
		add_action( 'admin_init', array( $this, 'admin_notice_temp_ignore' ) );
		add_action('admin_notices', array($this, 'wd_admin_notices'));

	}

	// Checks to ensure notices aren't disabled and the user has the correct permissions.
	public function mwd_admin_notice() {

		$mwd_settings = get_option( 'mwd_admin_notice' );
		if ( ! isset( $mwd_settings['disable_admin_notices'] ) || ( isset( $mwd_settings['disable_admin_notices'] ) && $mwd_settings['disable_admin_notices'] == 0 ) ) {
			if ( current_user_can(  'manage_options' ) ) {
				return true;
			}
		}

		return false;

	}

	// Primary notice function that can be called from an outside function sending necessary variables
	public function admin_notice( $admin_notices ) {
	// Check options
		if ( ! $this->mwd_admin_notice() ) {
			return false;
		}

		foreach ( $admin_notices as $slug => $admin_notice ) {
			// Call for spam protection
			
			if ( $this->anti_notice_spam() ) {
				return false;
			}
			


			// Check for proper page to display on
			if ( isset( $admin_notices[ $slug ]['pages'] ) && is_array( $admin_notices[ $slug ]['pages'] ) ) {
				if ( ! $this->admin_notice_pages( $admin_notices[ $slug ]['pages'] ) ) {
					return false;
				}
			}
			// Check for required fields
			
			
			if ( ! $this->required_fields( $admin_notices[ $slug ] ) ) {
			
				// Get the current date then set start date to either passed value or current date value and add interval
				$current_date = current_time( "n/j/Y" );
				$start        = ( isset( $admin_notices[ $slug ]['start'] ) ? $admin_notices[ $slug ]['start'] : $current_date );
				
				$start        = date( "n/j/Y", strtotime( $start ) );
				$date_array   = explode( '/', $start );
				$interval     = ( isset( $admin_notices[ $slug ]['int'] ) ? $admin_notices[ $slug ]['int'] : 0 );
				
				$date_array[1] += $interval;
				$start = date( "n/j/Y", mktime( 0, 0, 0, $date_array[0], $date_array[1], $date_array[2] ) );
				
				// This is the main notices storage option
				$admin_notices_option = get_option( 'mwd_admin_notice', array() );
				// Check if the message is already stored and if so just grab the key otherwise store the message and its associated date information
				
				////////////
			
			
			
			/* $one_week_for_free = ( isset($admin_notices_option[ $slug ]['start']) ? date( "n/j/Y", strtotime($admin_notices_option[ $slug ]['start'])) : $start);
			if($slug == 'one_week_free' &&  (strtotime($one_week_for_free)+604800) <= strtotime( $current_date ))
			{
				$this->admin_notice_ignore(1);
			} */
				
				////////////
				
				
				if ( ! array_key_exists( $slug, $admin_notices_option ) ) {
					$admin_notices_option[ $slug ]['start'] = $start;
					$admin_notices_option[ $slug ]['int']   = $interval;
					update_option( 'mwd_admin_notice', $admin_notices_option );
				}

				// Sanity check to ensure we have accurate information
				// New date information will not overwrite old date information
				$admin_display_check    = ( isset( $admin_notices_option[ $slug ]['dismissed'] ) ? $admin_notices_option[ $slug ]['dismissed'] : 0 );
				
				$admin_display_start    = ( isset( $admin_notices_option[ $slug ]['start'] ) ? $admin_notices_option[ $slug ]['start'] : $start );
				

				//$admin_display_start    = ( ( isset( $admin_notices[ $slug ]['name_link'] ) && $admin_notices[ $slug ]['name_link'] == 'one_week_free') ? $admin_notices_option[ $slug ]['start'] : $start );
				
				
				$admin_display_interval = ( isset( $admin_notices_option[ $slug ]['int'] ) ? $admin_notices_option[ $slug ]['int'] : $interval );
				$admin_display_msg      = ( isset( $admin_notices[ $slug ]['msg'] ) ? $admin_notices[ $slug ]['msg'] : '' );
				$admin_display_title    = ( isset( $admin_notices[ $slug ]['title'] ) ? $admin_notices[ $slug ]['title'] : '' );
				$admin_display_link     = ( isset( $admin_notices[ $slug ]['link'] ) ? $admin_notices[ $slug ]['link'] : '' );
				$output_css             = false;
				// Ensure the notice hasn't been hidden and that the current date is after the start date
				if ($admin_display_check == 0 && strtotime( $admin_display_start ) <= strtotime( $current_date )) {

				// Get remaining query string
				$query_str = (isset($admin_notices[$slug]['later_link']) ? $admin_notices[$slug]['later_link'] : esc_url(add_query_arg('mwd_admin_notice_ignore', $slug)));

					// Admin notice display output
					echo '<div class="update-nag mwd-admin-notice">';
					echo '<div class="mwd-notice-logo"></div>';
					echo ' <p class="mwd-notice-title">';
					echo $admin_display_title;
					echo ' </p>';
					echo ' <p class="mwd-notice-body">';
					echo $admin_display_msg;
					echo ' </p>';
					echo '<ul class="mwd-notice-body mwd-blue">
                          ' . $admin_display_link . '
                        </ul>';
					echo '<a href="' . $query_str . '" class="dashicons dashicons-dismiss"></a>';
					echo '</div>';

					$this->notice_spam += 1;
					$output_css = true;
				}
				if ( $output_css ) {
					wp_enqueue_style( 'mwd-admin-notices', MWD_URL .'/css/notices.css?mwd_ver=' . get_option("mwd_version") );
				}
			}
		}
	}

	// Spam protection check
	public function anti_notice_spam() {

		if ( $this->notice_spam >= $this->notice_spam_max ) {
			return true;
		}

		return false;
	}

	// Ignore function that gets ran at admin init to ensure any messages that were dismissed get marked
	public function admin_notice_ignore( $one_week_free = 0 ) {
		// If user clicks to ignore the notice, update the option to not show it again
		if ( isset( $_GET['mwd_admin_notice_ignore'] ) ) {

			$admin_notices_option = get_option( 'mwd_admin_notice', array() );
			$admin_notices_option[ $_GET['mwd_admin_notice_ignore'] ]['dismissed'] = 1;
			update_option( 'mwd_admin_notice', $admin_notices_option );
			$query_str = remove_query_arg( 'mwd_admin_notice_ignore' );
			wp_redirect( $query_str );
			exit;
		}
		
		/* if($one_week_free == 1 ) {
			$admin_notices_option = get_option( 'mwd_admin_notice', array() );
			$admin_notices_option[ 'one_week_free' ]['dismissed'] = 1;
			update_option( 'mwd_admin_notice', $admin_notices_option ); 
		} */
	}

	// Temp Ignore function that gets ran at admin init to ensure any messages that were temp dismissed get their start date changed
	public function admin_notice_temp_ignore() {

		// If user clicks to temp ignore the notice, update the option to change the start date - default interval of 14 days
		if ( isset( $_GET['mwd_admin_notice_temp_ignore'] ) ) {

			$admin_notices_option = get_option( 'mwd_admin_notice', array() );

			$current_date = current_time( "n/j/Y" );
			$date_array   = explode( '/', $current_date );
			$interval     = ( isset( $_GET['mwd_int'] ) ? $_GET['mwd_int'] : 14 );
			$date_array[1] += $interval;
			$new_start = date( "n/j/Y", mktime( 0, 0, 0, $date_array[0], $date_array[1], $date_array[2] ) );

			$admin_notices_option[ $_GET['mwd_admin_notice_temp_ignore'] ]['start']     = $new_start;
			$admin_notices_option[ $_GET['mwd_admin_notice_temp_ignore'] ]['dismissed'] = 0;
			update_option( 'mwd_admin_notice', $admin_notices_option );
			$query_str = remove_query_arg( array( 'mwd_admin_notice_temp_ignore', 'mwd_int' ) );
			wp_redirect( $query_str );
			exit;
		}
	}

	public function admin_notice_pages( $pages ) {

		foreach ( $pages as $key => $page ) {
			if ( is_array( $page ) ) {
				if ( isset( $_GET['page'] ) && $_GET['page'] == $page[0] && isset( $_GET['tab'] ) && $_GET['tab'] == $page[1] ) {
					return true;
				}
			} else {
				if ( $page == 'all' ) {
					return true;
				}
				if ( get_current_screen()->id === $page ) {
					return true;
				}
				if ( isset( $_GET['page'] ) && $_GET['page'] == $page ) {
					return true;
				}
			}

			return false;
		}
	}

	// Required fields check
	public function required_fields( $fields ) {
		if ( ! isset( $fields['msg'] ) || ( isset( $fields['msg'] ) && empty( $fields['msg'] ) ) ) {
			return true;
		}

		if ( ! isset( $fields['title'] ) || ( isset( $fields['title'] ) && empty( $fields['title'] ) ) ) {
			return true;
		}

		return false;
	}

	// Special parameters function that is to be used in any extension of this class
	public function special_parameters( $admin_notices ) {
		// Intentionally left blank
	}
	public function wd_admin_notices() {
		$two_week_review_ignore = add_query_arg(array('mwd_admin_notice_ignore' => 'two_week_review'));
		$two_week_review_temp = add_query_arg(array('mwd_admin_notice_temp_ignore' => 'two_week_review', 'int' => 14));
		$notices['two_week_review'] = array(
		  'title' => __('Leave A Review?', 'mwd-test'),
		  'msg' => sprintf(__('We hope you\'ve enjoyed using WordPress %s! Would you consider leaving us a review on WordPress.org?', 'mwd-test'), 'MailChimp WD'),
		  'link' => '<li><span class="dashicons dashicons-external"></span><a href="https://wordpress.org/support/plugin/wd-mailchimp/reviews/?filter=5" target="_blank">' . __('Sure! I\'d love to!', 'mwd-test') . '</a></li>
					 <li><span class="dashicons dashicons-smiley"></span><a href="' . $two_week_review_ignore . '"> ' . __('I\'ve already left a review', 'mwd-test') . '</a></li>
					 <li><span class="dashicons dashicons-calendar-alt"></span><a href="' . $two_week_review_temp . '">' . __('Maybe Later', 'mwd-test') . '</a></li>
					 <li><span class="dashicons dashicons-dismiss"></span><a href="' . $two_week_review_ignore . '">' . __('Never show again', 'mwd-test') . '</a></li>',
		  'later_link' => $two_week_review_temp,
		  'int' => 14
		);

		/* $one_week_free = add_query_arg(array('mwd_admin_notice_ignore' => 'one_week_free'));
		$notices['one_week_free'] = array(
		  'title' => __('One week free mailchimp', 'mwd-test'),
		  'msg' => '<div class="mailchimp">
	<ul class="mailchimp_container res_hide" >
		<li class="mailchimp_img"><img src="'.MWD_URL . '/assets/personal_free.png" class="res" /></li>
		<li class="not_show_hide personal colored">Limited Time Giveaway</li>
	</ul>
	<ul class="mailchimp_container coupon" >
		<li class="not_show_hide personal">
			<ul>
				<li>
				<div style="white-space: nowrap;">
					Get MailChimp WD PRO Plugin Totally FREE.<br/>
				<span style="font-size: 11px;">
					*The deal includes the MailChimp WD Personal
				</span>
				</div>
				</li>
			</ul>
		</li>
		
		<li class="mailchimp_coupon coupon_code"><span class="colored hidest">MailChimp WD Giveaway<br /></span><span style="color: #50B9E5">Coupon Code: <span style="color: #fff; font-weight: 600;">MailChimpPRO</span></span></li>
		<li class="mailchimp_img coupon_img"><a href="https://web-dorado.com/products/wordpress-mailchimp-wd.html"  target="_blank"><span style="position: relative; top: 26px; text-align: center; left: 12px;">Get Now</span></a></li>
	</ul>
</div>

<style>
	.mwd-notice-title,
	.mwd-notice-body{
		display: none !important;
	}

	.mwd-admin-notice{
		padding: 0 !important;
	}
	
	.mwd-notice-logo{
		background: none !important;
	}
</style>',
		  'link' => '
					<li><span class="dashicons dashicons-dismiss"></span><a href="' . $one_week_free . '">' . __('Never show again', 'mwd-test') . '</a></li>',
		  'int' => 0,		  
		  'name_link' => 'one_week_free'
		); */
		
		
		$one_week_support = add_query_arg(array('mwd_admin_notice_ignore' => 'one_week_support'));
		$notices['one_week_support'] = array(
		  'title' => __('Hey! How\'s It Going?', 'mwd-test'),
		  'msg' => sprintf(__('Thank you for using WordPress %s! We hope that you\'ve found everything you need, but if you have any questions:', 'mwd-test'), 'MailChimp WD'),
		  'link' => '<li><span class="dashicons dashicons-media-text"></span><a target="_blank" href="https://web-dorado.com/forum/mailchimp-wd.html">' . __('Check out User Guide', 'mwd-test') . '</a></li>
					<li><span class="dashicons dashicons-sos"></span><a target="_blank" href="https://web-dorado.com/wordpress-mailchimpwd-guid/installing.html">' . __('Get Some Help', 'mwd-test') . '</a></li>
					<li><span class="dashicons dashicons-dismiss"></span><a href="' . $one_week_support . '">' . __('Never show again', 'mwd-test') . '</a></li>',
		  'int' => 7
		);
		
		$this->admin_notice($notices);
	}

}
