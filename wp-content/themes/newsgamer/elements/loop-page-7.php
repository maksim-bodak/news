<?php
    $mip_current_page   = mipthemeframework_get_mip_current_page();
    the_post();

    $format             = get_post_format();
    $poster_class       = '';
    $poster_img         = '';

    if ( $mip_current_page->review_post_poster['url'] ) {
        $poster_img     = '<img src="'. esc_url($mip_current_page->review_post_poster['url']) .'" width="310" class="img-responsive hidden-xs" alt="" />';
        $poster_class   = ' col-has-poster';
    }
?>

<!-- start:row -->
<div class="row row-review-template">
    <!-- start:col -->
    <div class="col col-info col-sm-4<?php echo esc_attr($poster_class); ?>">

        <!-- start:article post review info -->
        <aside class="article-post-review-info">

            <!-- start:article post review poster -->
            <?php
                if ( $mip_current_page->review_post_poster['url'] ) {
                    echo '<img src="'. esc_url($mip_current_page->review_post_poster['url']) .'" width="310" class="img-responsive hidden-xs" alt="" />';
                }
            ?>
            <!-- end:article post review poster -->

            <!-- start:article post review author -->
            <div class="article-post-review-author">
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></a>
                <?php esc_html_e('by', 'Newsgamer'); ?> <?php the_author_posts_link(); ?><br>
                <?php esc_html_e('on', 'Newsgamer'); ?> <time datetime="<?php echo get_the_time('c'); ?>" itemprop="dateCreated"><?php echo get_the_date(MIPTHEME_DATE_DEFAULT); ?></time>
                <?php if ( $mip_current_page->enable_author_postmeta ) : ?>
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
                <?php endif; ?>
            </div>
            <!-- end:article post review author -->

            <!-- start:article post review meta -->
            <div class="article-post-review-meta">

                <!-- start:article post addons - via & source -->
                <?php if (is_single()) get_template_part( 'elements/parts/post-addons-review' ); ?>
                <!-- end:article post addons -->

            </div>
            <!-- end:article post review meta -->

        </aside>
        <!-- end:article post review info -->

    </div>
    <!-- end:col -->
    <!-- start:col -->
    <div class="col col-sm-8">

        <?php
        // Social Sharing
        if ( ($mip_current_page->enable_social_sharing == 'top')||($mip_current_page->enable_social_sharing == 'both') )
            get_template_part( 'elements/parts/post-social-sharing' );
        ?>

        <!-- start:article post content -->
        <div class="article-post-content clearfix">
            <?php the_content(); ?>
        </div>
        <!-- end:article post content -->

        <?php
            // include bottom review
            if ( $mip_current_page->review_post &&($mip_current_page->review_post_position == 'bottom') ) get_template_part('elements/parts/post-review');
        ?>

    </div>
    <!-- end:col -->
</div>
<!-- end:row -->

<?php
    // ads section three
    if ( $mip_current_page->ads_post_section_three ) {
        $ad_unit        = new MipThemeFramework_Ad();
        $ad_unit->id    = (int)$mip_current_page->ads_post_section_three;
        // display ad unit
        $ad_unit->formatLayoutAd('row ad ad-section-three');
    }
?>

<!-- start:article post footer -->
<?php if (is_single()) get_template_part( 'elements/parts/post-footer' ); ?>
<!-- end:article post footer -->
