<?php if ($wp_query->max_num_pages > 1) : ?>
<div class="post-pagination clearfix">
    <span class="next"><?php next_posts_link( __('Next page <i class="fa fa-chevron-right"></i>', 'Newsgamer') ) ?></span>
    <span class="previous"><?php previous_posts_link( __('<i class="fa fa-chevron-left"></i> Previous page', 'Newsgamer') ) ?></span>
</div>
<?php endif; ?>
