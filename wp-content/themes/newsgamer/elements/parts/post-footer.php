<?php
    $mipthemeoptions_framework  = mipthemeframework_get_redux_var();
    $mip_current_page           = mipthemeframework_get_mip_current_page();

    // Social Sharing
    if ( ($mipthemeoptions_framework['_mp_show_social_sharing'] == 'bottom')||($mipthemeoptions_framework['_mp_show_social_sharing'] == 'both') )
        get_template_part( 'elements/parts/post-social-sharing' );

    // Post Review
    if ( $mip_current_page->review_post || ($mip_current_page->review_post == 'enable') ) {
?>

<meta itemprop="author" content="<?php echo get_the_author_meta('display_name'); ?>">
<meta itemprop="about" content="<?php echo get_post_meta( get_the_ID(), '_mp_review_post_total_text', true ); ?>">
<meta itemprop="itemreviewed" content="<?php echo get_the_title(); ?>">
<meta itemprop="datePublished" content="<?php echo get_the_date('Y-m-d\TH:i:sP'); ?>">
<span class="post-scope-data" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
    <meta itemprop="worstRating" content = "1">
    <meta itemprop="bestRating" content = "10">
    <meta itemprop="ratingValue" content="<?php echo round(get_post_meta( get_the_ID(), '_mp_review_post_total_score', true )/10, 1); ?>">
</span>

<?php
    }
?>
<meta itemprop="datePublished" content="<?php echo get_the_date('Y-m-d\TH:i:sP'); ?>">
<meta itemprop="dateModified" content="<?php echo get_the_modified_date('Y-m-d\TH:i:sP'); ?>">
<meta itemprop="headline" content="<?php echo get_the_title(); ?>">
<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
    <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
      <meta itemprop="url" content="<?php echo esc_url($mipthemeoptions_framework['_mp_header_logo_desktop']['url']); ?>">
      <meta itemprop="width" content="">
      <meta itemprop="height" content="">
    </div>
    <meta itemprop="name" content="<?php echo get_bloginfo('name'); ?>">
</div>
<?php

    // Post Navigation
    if ( $mip_current_page->enable_prevnext_posts )
        get_template_part( 'elements/parts/post-prevnext' );

    // Post Comments
    if ( $mip_current_page->comments_location == 'before-author' )
        get_template_part( 'elements/comments-section' );

    // Post Navigation
    if ( $mip_current_page->enable_author )
        get_template_part( 'elements/parts/post-author' );

    // Post Comments
    if ( $mip_current_page->comments_location == 'after-author' )
        get_template_part( 'elements/comments-section' );

    // Post Comments
    if ( $mip_current_page->enable_related_posts )
        get_template_part( 'elements/parts/post-related-by-'. $mip_current_page->filter_related_posts );

    // Post Comments
    if ( $mip_current_page->comments_location == 'after-related' )
        get_template_part( 'elements/comments-section' );


?>
