<?php

/**
 * User Details
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_details' ); ?>

	<?php if ( bbp_allow_search() ) : ?>

		<div class="bbp-search-form">

			<?php bbp_get_template_part( 'form', 'search' ); ?>

		</div>

	<?php endif; ?>

	<div id="bbp-single-user-details">
		<div id="bbp-user-avatar">

			<span class='vcard'>
				<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php bbp_displayed_user_field( 'display_name' ); ?>" rel="me">
					<?php echo get_avatar( bbp_get_displayed_user_field( 'user_email', 'raw' ), apply_filters( 'bbp_single_user_details_avatar_size', 100 ) ); ?>
				</a>
			</span>

		</div><!-- #author-avatar -->

		<div id="bbp-user-navigation">
			<div class="first-col">
				<h2 class="entry-title"><?php esc_html_e( 'Profile', 'bbpress' ); ?></h2>
				<p class="bbp-user-forum-role"><strong><?php  printf( esc_html__( 'Forum Role:', 'Newsgamer' )); ?> </strong><?php printf(bbp_get_user_display_role() ); ?></p>
				<p class="bbp-user-topic-count"><strong><?php printf( esc_html__( 'Topics Started:', 'Newsgamer' )); ?> </strong><?php printf(bbp_get_user_topic_count_raw() ); ?></p>
				<p class="bbp-user-reply-count"><strong><?php printf( esc_html__( 'Replies Created:', 'Newsgamer' )); ?> </strong><?php printf(bbp_get_user_reply_count_raw() ); ?></p>
			</div>
			<div class="second-col">
				<ul>
					<li class="<?php if ( bbp_is_single_user_profile() ) :?>current<?php endif; ?>">
						<span class="vcard bbp-user-profile-link">
							<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php printf( __( "%s's Profile", 'bbpress' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>" rel="me"><?php esc_html_e( 'Profile', 'bbpress' ); ?></a>
						</span>
					</li>

					<li class="<?php if ( bbp_is_single_user_topics() ) :?>current<?php endif; ?>">
						<span class='bbp-user-topics-created-link'>
							<a href="<?php bbp_user_topics_created_url(); ?>" title="<?php printf( __( "%s's Topics Started", 'bbpress' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php esc_html_e( 'Topics Started', 'bbpress' ); ?></a>
						</span>
					</li>

					<li class="<?php if ( bbp_is_single_user_replies() ) :?>current<?php endif; ?>">
						<span class='bbp-user-replies-created-link'>
							<a href="<?php bbp_user_replies_created_url(); ?>" title="<?php printf( __( "%s's Replies Created", 'bbpress' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php esc_html_e( 'Replies Created', 'bbpress' ); ?></a>
						</span>
					</li>

				</ul>
			</div>
			<div class="third-col">
				<ul>
					<?php if ( bbp_is_favorites_active() ) : ?>
						<li class="<?php if ( bbp_is_favorites() ) :?>current<?php endif; ?>">
							<span class="bbp-user-favorites-link">
								<a href="<?php bbp_favorites_permalink(); ?>" title="<?php printf( __( "%s's Favorites", 'bbpress' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php esc_html_e( 'Favorites', 'bbpress' ); ?></a>
							</span>
						</li>
					<?php endif; ?>

					<?php if ( bbp_is_user_home() || current_user_can( 'edit_users' ) ) : ?>

						<?php if ( bbp_is_subscriptions_active() ) : ?>
							<li class="<?php if ( bbp_is_subscriptions() ) :?>current<?php endif; ?>">
								<span class="bbp-user-subscriptions-link">
									<a href="<?php bbp_subscriptions_permalink(); ?>" title="<?php printf( __( "%s's Subscriptions", 'bbpress' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php esc_html_e( 'Subscriptions', 'bbpress' ); ?></a>
								</span>
							</li>
						<?php endif; ?>

						<li class="<?php if ( bbp_is_single_user_edit() ) :?>current<?php endif; ?>">
							<span class="bbp-user-edit-link">
								<a href="<?php bbp_user_profile_edit_url(); ?>" title="<?php printf( __( "Edit %s's Profile", 'bbpress' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php esc_html_e( 'Edit', 'bbpress' ); ?></a>
							</span>
						</li>

					<?php endif; ?>

				</ul>
			</div>
		</div><!-- #bbp-user-navigation -->
	</div><!-- #bbp-single-user-details -->

	<?php do_action( 'bbp_template_after_user_details' ); ?>
