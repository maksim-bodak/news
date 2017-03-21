<?php
    $mipthemeoptions_framework = mipthemeframework_get_redux_var();
?>
<!-- start:header-branding -->
<div id="header-branding" class="header-layout-4">
    <!-- start:row -->
    <div class="row">

        <!-- start:col -->
        <div class="col-xs-12 text-center" itemscope="itemscope" itemtype="http://schema.org/Organization">
            <!-- start:logo -->
            <?php echo MipThemeFramework_Util::miptheme_set_logo(); ?>
            <meta itemprop="name" content="<?php bloginfo('name')?>">
            <!-- end:logo -->
        </div>
        <!-- end:col -->

    </div>
    <!-- end:row -->
</div>
<!-- end:header-branding -->
