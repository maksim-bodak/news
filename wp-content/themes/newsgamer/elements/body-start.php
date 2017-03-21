<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();

    if ( isset($mipthemeoptions_framework['_mp_post_facebook_comments_enable']) && (bool)$mipthemeoptions_framework['_mp_post_facebook_comments_enable'] ) :
        $fb_local   = ( isset($mipthemeoptions_framework['_mp_social_facebook_local']) && ($mipthemeoptions_framework['_mp_social_facebook_local'] != '') )    ?  $mipthemeoptions_framework['_mp_social_facebook_local'] : 'en_US';

?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo esc_js($fb_local); ?>/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php
    endif;
?>
