<?php
$mip_current_page   = mipthemeframework_get_mip_current_page();

// if via and source options
if ( $mip_current_page->enable_display_source ) {
    echo '<aside class="via-source">';
    echo '  <ul class="clearfix">';
    if ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_name') ) {
        $sViaTitle  = ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_title') ) ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_title') : esc_html__( 'Via', 'Newsgamer' );
        if ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_link') ) {
            echo '<li><span>'. $sViaTitle .'</span> <a href="'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_link') .'" title="'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_name') .'" target="_blank">'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_name') .'</a></li>';
        } else {
            echo '<li><span>'. $sViaTitle .'</span> '. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_name') .'</li>';
        }
    }
    if ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_name') ) {
        $sSourceTitle  = ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_title') ) ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_title') : esc_html__( 'Source', 'Newsgamer' );
        if ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_link') ) {
            echo '<li><span>'. $sSourceTitle .'</span> <a href="'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_link') .'" title="'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_name') .'" target="_blank">'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_name') .'</a></li>';
        } else {
            echo '<li><span>'. $sSourceTitle .'</span> '. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_name') .'</li>';
        }
    }
    echo '  </ul>';
    echo '</aside>';
}


if ( $mip_current_page->enable_tags ) {
    the_tags( '<!-- start:tags --><aside class="tags"><ul class="clearfix"><li><span>'. esc_html__('Tags', 'Newsgamer') .'</span></li><li>', '</li><li>', '</ul></aside><!-- end:tags -->' );
}

?>
