<?php
    $mip_current_page   = mipthemeframework_get_mip_current_page();
    the_post();

    $format             = get_post_format();
?>

<?php
    // Social Sharing
    if ( ($mip_current_page->enable_social_sharing == 'top')||($mip_current_page->enable_social_sharing == 'both') )
        get_template_part( 'elements/parts/post-social-sharing' );

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
