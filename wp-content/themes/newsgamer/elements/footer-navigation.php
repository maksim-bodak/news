<!-- start:page footer -->
<section id="page-footer">
<?php
    if ( MipThemeFramework_Util::miptheme_check_redux_value('_mp_enable_footer_one_widgets') ) :
        // include footer section top
        get_template_part('elements/parts/'. MipThemeFramework_Util::miptheme_return_redux_value('_mp_footer_one_widget_layout') );
    endif;

    if ( MipThemeFramework_Util::miptheme_check_redux_value('_mp_enable_footer_two_widgets') ) :
        // include footer section top
        get_template_part('elements/parts/'. MipThemeFramework_Util::miptheme_return_redux_value('_mp_footer_two_widget_layout') );
    endif;

    if ( MipThemeFramework_Util::miptheme_check_redux_value('_mp_enable_footer_copy') ) :
        echo MipThemeFramework_Util::miptheme_set_footer_copy();
    endif;
?>
</section>
<!-- end:page footer -->
