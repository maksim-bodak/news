<!-- start:article author-box -->
<div class="author-box clearfix" itemscope itemtype="http://schema.org/Person">
    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 115 ); ?></a>
    <p class="name" itemprop="name"><?php the_author_posts_link(); ?></p>
    <p class="desc" itemprop="description"><?php the_author_meta('description'); ?></p>
    <p class="follow">
    <?php
        if ( get_the_author_meta('user_url') ) echo '<a class="home" href="'. esc_url(get_the_author_meta('user_url')) .'"><i class="fa fa-home"></i></a>';
        if ( get_the_author_meta('facebook') ) echo '<a class="facebook" href="'. esc_url(get_the_author_meta('facebook')) .'"><i class="fa fa-facebook"></i></a>';
        if ( get_the_author_meta('twitter') ) echo '<a class="twitter" href="'. esc_url(get_the_author_meta('twitter')) .'"><i class="fa fa-twitter"></i></a>';
        if ( get_the_author_meta('gplus') ) echo '<a class="google-plus" href="'. esc_url(get_the_author_meta('gplus')) .'"><i class="fa fa-google-plus"></i></a>';
        if ( get_the_author_meta('linkedin') ) echo '<a class="linkedin" href="'. esc_url(get_the_author_meta('linkedin')) .'"><i class="fa fa-linkedin"></i></a>';
        if ( get_the_author_meta('flickr') ) echo '<a class="flickr" href="'. esc_url(get_the_author_meta('flickr')) .'"><i class="fa fa-flickr"></i></a>';
        if ( get_the_author_meta('tumblr') ) echo '<a class="tumblr" href="'. esc_url(get_the_author_meta('tumblr')) .'"><i class="fa fa-tumblr"></i></a>';
        if ( get_the_author_meta('vimeo') ) echo '<a class="vimeo" href="'. esc_url(get_the_author_meta('vimeo')) .'"><i class="fa fa-vimeo"></i></a>';
        if ( get_the_author_meta('vk') ) echo '<a class="vkontakte" href="'. esc_url(get_the_author_meta('vk')) .'"><i class="fa fa-vk"></i></a>';
    ?>
    </p>
</div>
<!-- end:article author-box -->
