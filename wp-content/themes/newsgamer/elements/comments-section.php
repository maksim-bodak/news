<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();
    if ( isset($mipthemeoptions_framework['_mp_post_facebook_comments_enable']) && (bool)$mipthemeoptions_framework['_mp_post_facebook_comments_enable'] ) :
        include_once( get_template_directory() . '/elements/facebook-comments.php' );
    else :
        comments_template();
    endif;
?>
