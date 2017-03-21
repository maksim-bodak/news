<?php
    $prev_post = get_previous_post();
    $next_post = get_next_post();
?>
<!-- start:post navigation -->
<aside class="post-navigation clearfix">
    <div class="row">
        <div class="col-md-6">
<?php if (!empty( $prev_post )): ?>
            <cite><?php esc_html_e('Previous article', 'Newsgamer'); ?></cite>
            <a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo esc_attr($prev_post->post_title); ?>"><?php echo esc_html( $prev_post->post_title ); ?></a>
<?php endif; ?>
        </div>
        <div class="col-md-6 text-right">
<?php if (!empty( $next_post )): ?>
            <cite><?php esc_html_e('Next article', 'Newsgamer'); ?></cite>
            <a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo esc_attr($next_post->post_title); ?>"><?php echo esc_html( $next_post->post_title ); ?></a>
<?php endif; ?>
        </div>
    </div>
</aside>
<!-- end:post navigation -->
