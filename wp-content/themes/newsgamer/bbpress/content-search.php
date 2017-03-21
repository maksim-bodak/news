<?php

/**
 * Search Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums">
	<div class="search-page-search-form">
		<h2><?php esc_html_e('Need a new search?', 'Newsgamer'); ?></h2>
		<p><?php esc_html_e('If you didn\'t find what you were looking for, try a new search!', 'Newsgamer'); ?></p>

		<form id="bbp-search-form" role="search" method="get" action="<?php bbp_search_url(); ?>">
			<input type="hidden" name="action" value="bbp-search-request" />
	        <input type="text" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" placeholder="<?php esc_html_e( 'Search for:', 'bbpress' ); ?>" name="bbp_search">
	        <button><span class="glyphicon glyphicon-search"></span></button>
	    </form>

	</div>
	<br>
		<?php bbp_set_query_name( 'bbp_search' ); ?>

		<?php do_action( 'bbp_template_before_search' ); ?>

		<?php if ( bbp_has_search_results() ) : ?>

			 <?php bbp_get_template_part( 'pagination', 'search' ); ?>

			 <?php bbp_get_template_part( 'loop',       'search' ); ?>

			 <?php bbp_get_template_part( 'pagination', 'search' ); ?>

		<?php elseif ( bbp_get_search_terms() ) : ?>

			 <?php bbp_get_template_part( 'feedback',   'no-search' ); ?>

		<?php else : ?>

			<?php bbp_get_template_part( 'form', 'search' ); ?>

		<?php endif; ?>

		<?php do_action( 'bbp_template_after_search_results' ); ?>
</div>
