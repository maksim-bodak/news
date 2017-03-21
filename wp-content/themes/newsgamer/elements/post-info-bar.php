<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();
    $curr_post_img                  = '';
    if (has_post_thumbnail()) {
        $att_img_src                = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
        $curr_post_img              = $att_img_src[0];
    }
?>
<div id="post-info-bar">
    <div class="container">
        <div class="post-info-sharing hidden-xs">
            <?php
                if ( isset($mipthemeoptions_framework['_mpgl_post_postmeta_elements']['comments']) && $mipthemeoptions_framework['_mpgl_post_postmeta_elements']['comments'] ) :
                    if ( isset($mipthemeoptions_framework['_mp_post_facebook_comments_enable'])&&(bool)$mipthemeoptions_framework['_mp_post_facebook_comments_enable']) {
            ?>
            <a id="post-info-bar-comment" href="#respond"><i class="fa fa-comments-o"></i> <fb:comments-count href="<?php echo get_permalink(); ?>"></fb:comments-count> <?php esc_html_e( 'comments', 'Newsgamer' ); ?></a>
            <?php
                    } else {
            ?>
            <a id="post-info-bar-comments" href="#respond"><i class="fa fa-comments-o"></i> <?php comments_number('0', '1', '%'); ?> <?php esc_html_e( 'comments', 'Newsgamer' ); ?></a>
            <?php
                    }
                endif;
            ?>
            <a id="post-info-bar-sharing" href="javascript:;"><i class="fa fa-share-alt"></i><?php esc_html_e( 'Share', 'Newsgamer' ); ?></a>
        </div>
        <div class="post-info-thumb">
        <?php
            if (has_post_thumbnail($post->ID)) {
                $post_feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
                if (!empty($post_feat_image[0])) {
                    echo '<img src="' .  $post_feat_image[0] . '" alt="" class="">';
                }
            }
        ?>
        </div>
        <div class="post-info">
            <div class="post-info-label"><?php esc_html_e( 'You are reading', 'Newsgamer' ); ?></div>
            <div class="post-info-title"><?php the_title(); ?></div>
        </div>
    </div>
</div>
<!-- end:post-info-bar -->

<div id="soc-sharing-fullscreen-overlay">
	<div class="soc-sharing-overlay-wrapper">
		<div class="soc-sharing-overlay-content">
    		<div class="soc-sharing-overlay-icons">
                <ul>
                <?php
                    // facebook share
                    if ( isset($mipthemeoptions_framework['_mp_social_sharing_facebook'])&&($mipthemeoptions_framework['_mp_social_sharing_facebook'] != 'none') ) {
                ?>
                <li><a class="btn-social btn-facebook btn-icon" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" onclick="window.open(this.href, 'weeklywin', 'left=50,top=50,width=600,height=360,toolbar=0'); return false;"><i class="fa fa-facebook-square fa-lg"></i></a></li>
                <?php
                    }
                    // twitter share
                    if ( isset($mipthemeoptions_framework['_mp_social_sharing_twitter'])&&($mipthemeoptions_framework['_mp_social_sharing_twitter'] != 'none') ) {
                ?>
                <li><a class="btn-social btn-twitter btn-icon" href="https://twitter.com/intent/tweet?text=<?php echo esc_attr(get_the_title()); ?>&amp;url=<?php echo urlencode(get_permalink()); ?>" onclick="window.open(this.href, 'weeklywin', 'left=50,top=50,width=600,height=360,toolbar=0'); return false;"><i class="fa fa-twitter-square fa-lg"></i></a></li>
                <?php
                    }
                    // google share
                    if ( isset($mipthemeoptions_framework['_mp_social_sharing_google'])&&($mipthemeoptions_framework['_mp_social_sharing_google'] != 'none') ) {
                ?>
                <li><a class="btn-social btn-google btn-icon" href="http://plus.google.com/share?url=<?php echo get_permalink(); ?>" onclick="window.open(this.href, 'weeklywin', 'left=50,top=50,width=600,height=360,toolbar=0'); return false;"><i class="fa fa-google-plus-square fa-lg"></i></a></li>
                <?php
                    }
                    // linkedin share
                    if ( isset($mipthemeoptions_framework['_mp_social_sharing_linkedin'])&&($mipthemeoptions_framework['_mp_social_sharing_linkedin'] != 'none') ) {
                ?>
                <li><a class="btn-social btn-linkedin btn-icon" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo esc_attr(get_the_title()); ?>" onclick="window.open(this.href, 'weeklywin', 'left=50,top=50,width=600,height=360,toolbar=0'); return false;"><i class="fa fa-linkedin-square fa-lg"></i></a></li>
                <?php
                    }
                    // pinterest share
                    if ( isset($mipthemeoptions_framework['_mp_social_sharing_pinterest'])&&($mipthemeoptions_framework['_mp_social_sharing_pinterest'] != 'none') ) {
                ?>
                <li><a class="btn-social btn-pinterest btn-icon" href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&amp;media=<?php echo ( $curr_post_img ? $curr_post_img : ''); ?>"  onclick="window.open(this.href, 'weeklywin', 'left=50,top=50,width=600,height=360,toolbar=0'); return false;"><i class="fa fa-pinterest-square fa-lg"></i></a></li>
                <?php
                    }
                    // tumblr share
                    if ( isset($mipthemeoptions_framework['_mp_social_sharing_tumblr'])&&($mipthemeoptions_framework['_mp_social_sharing_tumblr'] != 'none') ) {
                ?>
                <li><a class="btn-social btn-tumblr btn-icon" href="http://www.tumblr.com/share/link?url=<?php echo get_permalink(); ?>&amp;name=<?php echo esc_attr(get_the_title()); ?>"  onclick="window.open(this.href, 'weeklywin', 'left=50,top=50,width=600,height=360,toolbar=0'); return false;"><i class="fa fa-tumblr-square fa-lg"></i></a></li>
                <?php
                    }
                    // vkontakte share
                    if ( isset($mipthemeoptions_framework['_mp_social_sharing_vk'])&&($mipthemeoptions_framework['_mp_social_sharing_vk'] != 'none') ) {
                ?>
                <li><a class="btn-social btn-vkontakte btn-icon" href="http://vkontakte.ru/share.php?url=<?php echo get_permalink(); ?>&amp;title=<?php echo esc_attr(get_the_title()); ?>"  onclick="window.open(this.href, 'weeklywin', 'left=50,top=50,width=600,height=360,toolbar=0'); return false;"><i class="fa fa-vk fa-lg"></i></a></li>
                <?php
                    }
                    // vkontakte share
                    if ( isset($mipthemeoptions_framework['_mp_social_sharing_whatsapp'])&&($mipthemeoptions_framework['_mp_social_sharing_whatsapp'] != 'none') ) {
                ?>
                <li><a class="visible-xs btn-social btn-whatsapp btn-icon" href="whatsapp://send?text=<?php echo urlencode(get_permalink()); ?>"><i class="fa fa-whatsapp fa-lg"></i></a></li>
                <?php
                    }
                ?>
                </ul>
            </div>
        </div>
	</div>
</div>
