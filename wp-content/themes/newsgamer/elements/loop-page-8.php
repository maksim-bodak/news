<?php
    $mip_current_page   = mipthemeframework_get_mip_current_page();
    the_post();

    $format             = get_post_format();

    // ads section one
    if ( $mip_current_page->ads_post_section_one ) {
        $ad_unit        = new MipThemeFramework_Ad();
        $ad_unit->id    = (int)$mip_current_page->ads_post_section_one;
        // display ad unit
        $ad_unit->formatLayoutAd('row ad ad-section-one');
    }
?>

<!-- start:article post header -->
<?php get_template_part( 'elements/parts/post-header-title' ); ?>
<!-- end:article post header -->

<?php
    // Social Sharing
    if ( ($mip_current_page->enable_social_sharing == 'top')||($mip_current_page->enable_social_sharing == 'both') )
        get_template_part( 'elements/parts/post-social-sharing' );

    // Start Featured image
    // if featured video
    if ( $mip_current_page->featured_video_url ) {
        $featured_video = new MipThemeFramework_Video();
        echo '<div class="head-video relative">'. $featured_video->renderVideo( $mip_current_page->featured_video_url ) . '</div>';
    }
    // if featured video embed
    elseif ( $mip_current_page->featured_video_embed ) {
        echo '<div class="head-video relative">'. $mip_current_page->featured_video_embed . '</div>';
    }
    // if featured audio
    elseif ( ($format == 'audio')&&($mip_current_page->featured_audio_embed != '') ) {
        echo '<div class="head-video relative">'. $mip_current_page->featured_audio_embed . '</div>';
    }
    // standard image
    elseif ( has_post_thumbnail() ) {

        $featured_image             = new MipThemeFramework_Image();
        $featured_image_attr        = $mip_current_page->page_template_img_format;

        $img_attr = array(
        	'class' => "img-responsive",
        	'alt'   => trim( strip_tags( get_the_title() ) ),
            'itemprop'   => "image"
        );

        echo    '<div class="head-image thumb-wrap pull-left relative">
                    '. get_the_post_thumbnail( $post->ID, $featured_image_attr, $img_attr ) .'
                    '. ( ( get_post_meta( get_the_ID(), '_mp_featured_image_caption', true ) ) ? '<div class="featured-caption">'. get_post_meta( get_the_ID(), '_mp_featured_image_caption', true ) .'</div>' : '' ) .'
                </div>';

    }


    // ads section two
    if ( $mip_current_page->ads_post_section_two ) {
        $ad_unit        = new MipThemeFramework_Ad();
        $ad_unit->id    = (int)$mip_current_page->ads_post_section_two;
        // display ad unit
        $ad_unit->formatLayoutAd('row ad ad-section-two');
    }

    // include top review
    if ( $mip_current_page->review_post &&($mip_current_page->review_post_position == 'top') ) get_template_part('elements/parts/post-review');

    //include related box
    if (is_single()) get_template_part('elements/parts/post-related-box');
?>

<!-- start:article post content -->
<div class="article-post-content clearfix">
    <?php the_content(); ?>
</div>
<!-- end:article post content -->

<?php
    // link the pages
    mipthemeframework_custom_wp_link_pages();

    // include top review
    if ( $mip_current_page->review_post &&($mip_current_page->review_post_position == 'bottom') ) get_template_part('elements/parts/post-review');
?>

<!-- start:article post addons - via & source -->
<?php if (is_single()) get_template_part( 'elements/parts/post-addons' ); ?>
<!-- end:article post addons -->

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
