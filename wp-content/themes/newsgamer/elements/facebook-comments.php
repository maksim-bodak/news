<?php if ( comments_open() ) { ?>
<!-- start:article-comments -->
<section id="facebook-comments">
    <header>
        <h2><fb:comments-count href="<?php echo get_permalink(); ?>"></fb:comments-count> <?php esc_html_e( 'Facebook Comments', 'Newsgamer' ); ?></h2>
    </header>
    <div class="fb-comments" data-href="<?php echo get_permalink(); ?>" data-width="100%" data-numposts="<?php $mipthemeoptions_framework['_mp_post_facebook_comments_number']; ?>" data-colorscheme="light"></div>
</section>
<!-- end:article-comments -->
<?php } ?>
