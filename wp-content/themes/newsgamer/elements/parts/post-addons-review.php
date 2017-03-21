<?php
$mip_current_page   = mipthemeframework_get_mip_current_page();

// if via and source options
if ( $mip_current_page->enable_display_source ) {
    if ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_name') ) {
        $sViaTitle  = ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_title') ) ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_title') : esc_html__( 'Via', 'Newsgamer' );
        if ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_link') ) {
            echo '<p><span>'. $sViaTitle .'</span> <em><a href="'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_link') .'" title="'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_name') .'" target="_blank">'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_name') .'</a></em></p>';
        } else {
            echo '<p><span>'. $sViaTitle .'</span> <em>'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_via_name') .'</em></p>';
        }
    }
    if ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_name') ) {
        $sSourceTitle  = ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_title') ) ? MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_title') : esc_html__( 'Source', 'Newsgamer' );
        if ( MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_link') ) {
            echo '<p><span>'. $sSourceTitle .'</span> <em><a href="'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_link') .'" title="'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_name') .'" target="_blank">'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_name') .'</a></em></p>';
        } else {
            echo '<p><span>'. $sSourceTitle .'</span> <em>'. MipThemeFramework_Util::miptheme_check_redux_post_meta(MIPTHEMEFRAMEWORK_THEMEREDUXNAME, $post->ID, '_mp_post_display_source_name') .'</em></p>';
        }
    }
}


if ( $mip_current_page->enable_tags ) {
    the_tags( '<p><span>'. esc_html__('Tags', 'Newsgamer') .'</span><em>', ', ', '</em></p>' );
}
?>
