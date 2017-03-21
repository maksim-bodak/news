<?php
  header('Content-type: text/css');

  global $mipthemeoptions_framework, $mipthemeoptions_typo;
  /*$mipthemeoptions_framework = mipthemeframework_get_redux_var();
  $mipthemeoptions_typo      = mipthemeframework_get_redux_typo_var();*/

  $miptheme_main_color       = isset($mipthemeoptions_typo['_mp_typo_main_color']) ? $mipthemeoptions_typo['_mp_typo_main_color'] : '#f1a602';

    // Loop trough categories
    $categories = get_categories( array( 'hide_empty' => 0 ) );
    foreach ($categories as $category) {

        $cat_id           = $category->cat_ID;
        $cat_data         = get_option("category_$category->cat_ID");
        $cat_parent_id    = MipThemeFramework_Util::get_category_top_parent_id($cat_id);
        //$color  = $cat_data['cat-primary-color'] ? $cat_data['cat-primary-color'] : ($cat_date_parent['cat-primary-color'] ? $cat_date_parent['cat-primary-color'] : '');
        $color            = $cat_data['cat-primary-color'] ? $cat_data['cat-primary-color'] : '';

        if ($color) {
            if(!preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $color, $parts)) break;
            //die("Not a value color");


            $colorDarker = ''; // Prepare to fill with the results
            for($i = 1; $i <= 3; $i++) {
                $parts[$i] = hexdec($parts[$i]);
                $parts[$i] = round($parts[$i] * 80/100); // 80/100 = 80%, i.e. 20% darker
                $colorDarker .= str_pad(dechex($parts[$i]), 2, '0', STR_PAD_LEFT);
            }
?>

span.entry-category.cat-<?php echo esc_attr( $cat_id ); ?> a,
.module-timeline article span.cat-<?php echo esc_attr( $cat_id ); ?> a {
    color: <?php echo esc_attr( $color ); ?> !important;
}

.module-timeline article i.bullet-<?php echo esc_attr( $cat_id ); ?> {
    background: <?php echo esc_attr( $color ); ?>;
}

article.def-overlay span.entry-category.cat-<?php echo esc_attr( $cat_id ); ?> a,
.top-grid-layout-9 #single-post-header-full header span.cat-<?php echo esc_attr( $cat_id ); ?> a {
    color: #fff !important;
    background: <?php echo esc_attr( $color ); ?>;
}

<?php
            if ( $cat_id == $cat_parent_id ) {
?>
span.entry-category.parent-cat-<?php echo esc_attr( $cat_id ); ?> a,
.module-timeline article span.parent-cat-<?php echo esc_attr( $cat_id ); ?> a {
    color: <?php echo esc_attr( $color ); ?> !important;
}

.module-timeline article i.parent-bullet-<?php echo esc_attr( $cat_id ); ?> {
    background: <?php echo esc_attr( $color ); ?>;
}

article.def-overlay span.entry-category.parent-cat-<?php echo esc_attr( $cat_id ); ?> a,
.top-grid-layout-9 #single-post-header-full header span.parent-cat-<?php echo esc_attr( $cat_id ); ?> a {
    color: #fff;
    background: <?php echo esc_attr( $color ); ?>;
}

<?php
                if (isset($mipthemeoptions_framework['_mpgl_header_nav_category_colors']) && (bool)$mipthemeoptions_framework['_mpgl_header_nav_category_colors']) {
?>
/* MENU CATEGORY COLORS */
#header-navigation ul li.menu-category-<?php echo esc_attr( $cat_id ); ?> a.main-menu-link:hover,
#header-navigation ul li.menu-category-<?php echo esc_attr( $cat_id ); ?> a.main-menu-link:after,
#header-navigation ul li.menu-category-<?php echo esc_attr( $cat_id ); ?> .dropnav-container .dropnav-menu li > a:hover {
    color: #fff;
    background-color: <?php echo esc_attr( $color ); ?>;
}
#header-navigation ul li.menu-category-<?php echo esc_attr( $cat_id ); ?> .subnav-container .subnav-menu li.current a {
    color: <?php echo esc_attr( $color ); ?>;
}
#mobile-menu ul li.menu-category-<?php echo esc_attr( $cat_id ); ?> a {
    border-color: <?php echo esc_attr( $color ); ?>;
}
<?php
                }
            }

        }
    }

// get values for menu items
echo mipthemeframework_get_css_values_for_menu_colors();

?>


/* ==========================================================================
   Page Header
   ========================================================================== */

<?php
    $miptheme_header_height     = isset($mipthemeoptions_framework['_mp_header_height'])                         ? $mipthemeoptions_framework['_mp_header_height']                        : '115';
    $miptheme_topnav_height     = isset($mipthemeoptions_typo['_mp_typo_header_topnav_height'])        ? $mipthemeoptions_typo['_mp_typo_header_topnav_height']       : '35';
    $miptheme_mainnav_height    = isset($mipthemeoptions_typo['_mp_typo_header_mainnav_height'])       ? $mipthemeoptions_typo['_mp_typo_header_mainnav_height']      : '50';

    $miptheme_mainnav_border_top    = isset($mipthemeoptions_typo['_mp_typo_header_mainnav_border_top'])       ? $mipthemeoptions_typo['_mp_typo_header_mainnav_border_top']      : '0';
    $miptheme_mainnav_border_bottom = isset($mipthemeoptions_typo['_mp_typo_header_mainnav_border_bottom'])    ? $mipthemeoptions_typo['_mp_typo_header_mainnav_border_bottom']   : '5';
?>

/**
 * Page Header
 */

#header-branding,
#header-branding h1,
#header-branding div.logo,
#header-branding .ad,
#header-branding .wrap-container {
    height: <?php echo esc_attr( $miptheme_header_height ); ?>px;
    overflow: hidden;
}

/**
 * Top Navigation
 */

 #top-navigation {
     height: <?php echo esc_attr( $miptheme_topnav_height ); ?>px;
 }


 /**
  * Header Navigation
  */

 #header-navigation {
     height: <?php echo esc_attr( $miptheme_mainnav_height ); ?>px;
     border-top-width: <?php echo esc_attr( $miptheme_mainnav_border_top ); ?>px;
     border-bottom-width: <?php echo esc_attr( $miptheme_mainnav_border_bottom ); ?>px;
     border-top-style: solid;
     border-bottom-style: solid;
     border-color: <?php echo esc_attr( $miptheme_main_color ); ?>;
 }

 #header-navigation ul#menu-main-nav {
     height: <?php echo esc_attr( $miptheme_mainnav_height ); ?>px;
     overflow: hidden;
 }

 #header-navigation .dropnav-container .dropnav-menu li a:hover {
     background: <?php echo esc_attr( $miptheme_main_color ); ?>;
 }

 #header-navigation a i.fa,
 #header-navigation a span.glyphicon,
 #header-navigation .subnav-container .subnav-menu li.current a {
     color: <?php echo esc_attr( $miptheme_main_color ); ?>;
 }

 #header-navigation ul li a {
     padding-bottom: <?php echo esc_attr( $miptheme_mainnav_border_bottom ); ?>px;
 }

 #header-navigation ul li a.main-menu-link:after {
     height: <?php echo esc_attr( $miptheme_mainnav_border_bottom ); ?>px;
 }

 <?php

 if ( isset($mipthemeoptions_framework['_mpgl_header_nav_logo']) && (bool)$mipthemeoptions_framework['_mpgl_header_nav_logo'] && isset($mipthemeoptions_framework['_mpgl_header_nav_logo_media']['url']) ) {
 ?>

.affix #main-menu span.sticky-logo,
.wrap-header-layout-none #main-menu span.sticky-logo {
    background: url(<?php echo esc_attr( $mipthemeoptions_framework['_mpgl_header_nav_logo_media']['url'] ); ?>) no-repeat 0 50%;
    width: <?php echo esc_attr( $mipthemeoptions_framework['_mpgl_header_nav_logo_media']['width'] + 20 ); ?>px;
}

.affix #main-menu ul.nav,
.wrap-header-layout-none #main-menu ul.nav {
    padding-left: <?php echo esc_attr( $mipthemeoptions_framework['_mpgl_header_nav_logo_media']['width'] + 20 ); ?>px;
}

<?php
    if ( isset($mipthemeoptions_framework['_mpgl_header_nav_logo_media_retina']['url']) && ($mipthemeoptions_framework['_mpgl_header_nav_logo_media_retina']['url'] != '')) {
?>
.affix #main-menu span.sticky-logo,
.wrap-header-layout-none #main-menu span.sticky-logo {
    background: url(<?php echo esc_attr( $mipthemeoptions_framework['_mpgl_header_nav_logo_media_retina']['url'] ); ?>) no-repeat 0 50%;
    background-size: 100% 100%;
    width: <?php echo esc_attr( $mipthemeoptions_framework['_mpgl_header_nav_logo_media']['width'] ); ?>px;
    height: <?php echo esc_attr( $mipthemeoptions_framework['_mpgl_header_nav_logo_media']['height'] ); ?>px;
    margin-right: 20px;
}
<?php
    }

}

if ( isset($mipthemeoptions_framework['_mpgl_header_nav_sticky_menu']) && (bool)$mipthemeoptions_framework['_mpgl_header_nav_sticky_menu'] && ($mipthemeoptions_framework['_mpgl_header_nav_sticky_menu_show_first']) ) {
 ?>

.affix #main-menu ul.nav li:first-child {
    display: none;
}

.affix #main-menu ul.nav ul.dropnav-menu li:first-child,
.affix #main-menu ul.nav ul.subnav-menu li:first-child {
    display: block;
}

 <?php
}
?>

/* Lightbox - close button */
body.admin-bar .on #pbCloseBtn {
  top: 30px;
}


/* ==========================================================================
   Pagination
   ========================================================================== */

.post-pagination a:hover,
.post-pagination .current {
    background: <?php echo esc_attr( $miptheme_main_color ); ?>;
    border-color: <?php echo esc_attr( $miptheme_main_color ); ?>;
}

.page-links a:hover {
    background: <?php echo esc_attr( $miptheme_main_color ); ?>;
    border-color: <?php echo esc_attr( $miptheme_main_color ); ?>;
    color: #fff;
}


/* ==========================================================================
   Article
   ========================================================================== */

/**
* Default
*/

#page-content header h2 em {
    font-style: normal;
    color: <?php echo esc_attr( $miptheme_main_color ); ?>;
}

.article-post p a,
.main p a {
    color: <?php echo esc_attr( $miptheme_main_color ); ?>;
}


/**
 * Comments
 */

.loop-cat-12 a.btn-fa-icon,
.loop-cat-12 .main article.def span.text a.more-link {
    background: <?php echo esc_attr( $miptheme_main_color ); ?>;
}

.loop-cat-12 .main article.def div.entry-meta a {
    color: <?php echo esc_attr( $miptheme_main_color ); ?>;
}


/**
 * Comments
 */

#comments-list li .comment-text header .reply a {
    color: <?php echo esc_attr( $miptheme_main_color ); ?>;
}


/* Module Tags */

.module-tags li a {
    border-color: <?php echo esc_attr( $miptheme_main_color ); ?>;
}

.module-tags li a span {
    background: <?php echo esc_attr( $miptheme_main_color ); ?>;
}


/**
 * Rating
 */
/*
 .article-post .review,
 .meter-wrapper .meter {
     border-color: <?php echo esc_attr( $miptheme_main_color ); ?> !important;
 }
*/

.raty .star-on-png,
.raty .star-half-png {
    color: <?php echo esc_attr( $miptheme_main_color ); ?>;
}

.noUi-connect {
    background: <?php echo esc_attr( $miptheme_main_color ); ?>;
}

<?php

echo esc_attr( $mipthemeoptions_framework['_mp_css_code'] );
?>



/* ==========================================================================
   VC Column Styles
   ========================================================================== */

/**
 * Style One
 */

.vc-block-fx .col-style-one .shadow-ver-right,
.vc-block-fx .col-style-two .shadow-ver-right,
.vc-block-fx .col-style-three .shadow-ver-right {
    background: none;
}

.vc-block-fx .col-style-one .shadow-box,
.vc-block-fx .col-style-two .shadow-box,
.vc-block-fx .col-style-three .shadow-box {
    background: none;
    padding-bottom: 10px;
}

.vc-block-fx .col-style-one .shadow-box:last-child,
.vc-block-fx .col-style-two .shadow-box:last-child,
.vc-block-fx .col-style-three .shadow-box:last-child {
    padding-bottom: 20px;
}


/* ==========================================================================
   Page Footer
   ========================================================================== */

#page-footer {
   border-color: <?php echo esc_attr( $miptheme_main_color ); ?>;
}

#footer-section-top a {
    color: <?php echo esc_attr( $miptheme_main_color ); ?>;
}


/* ==========================================================================
   WooCommerce
   ========================================================================== */

.woocommerce span.onsale {
    padding: 0;
}

.woocommerce ul.products li.product .star-rating {
    font-size: 1em;
}

.woocommerce .star-rating span {
    color: <?php echo esc_attr( $miptheme_main_color ); ?>;
}

.woocommerce .star-rating:before {
    color: #999;
}

.woocommerce ul.cart_list li img,
.woocommerce ul.product_list_widget li img {
    float: left;
    margin-left: 0;
    margin-right: 15px;
    width: 65px;
    height: auto;
    box-shadow: none;
}

.woocommerce div.product p.price,
.woocommerce div.product span.price {
    font-size: 1.45em;
}

.woocommerce ul.products li.product .price {
    font-size: 1.15em;
}

.widget.woocommerce li div.star-rating {
    margin-top: 3px;
}

.widget.woocommerce li span.reviewer {
    font-size: 13px;
    display: inline-block;
    margin-top: 8px;
}

.widget.woocommerce li span.amount {
    font-weight: 700;
    color: #222;
    display: inline-block;
    margin-top: 8px;
}

.widget.woocommerce li del span.amount {
    font-weight: 400;
    color: #999;
    text-decoration: line-through;
}

.woocommerce #reviews #comments ol.commentlist {
    padding-left: 0;
}

.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta {
    font-size: 1.0em;
}

.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta strong {
    color: #222;
}

.woocommerce #reviews #comments ol.commentlist li img.avatar {
    width: 75px;
    padding: 0;
    border: none;
    background: none;
    margin-left: 15px;
}

.woocommerce #reviews #comments ol.commentlist li .comment-text {
    margin: 0 0 0 120px;
    position: relative;
    line-height: 24px;
    padding: 25px;
    border: 1px solid #ededed;
    -webkit-border-radius: 5px 5px 5px 5px;
    -moz-border-radius: 5px 5px 5px 5px;
    border-radius: 5px 5px 5px 5px;
}

.woocommerce #reviews #comments ol.commentlist li .comment-text:before {
    position: absolute;
    display: block;
    content: "";
    width: 15px;
    height: 15px;
    background: #fff;
    border-left: 1px solid #ededed;
    border-top: 1px solid #ededed;
    margin-left: -34px;
    -moz-transform: rotate(-45deg);
    -webkit-transform: rotate(-45deg);
    -o-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    transform: rotate(-45deg);
}

.woocommerce #review_form #respond p.comment-form-rating {
    margin: 15px 0;
}


/* ==========================================================================
   bbPress
   ========================================================================== */

#bbpress-forums a {
   color: <?php echo esc_attr( $miptheme_main_color ); ?>;
}

#bbpress-forums a.page-numbers:hover,
#bbpress-forums .page-numbers.current {
    background: <?php echo esc_attr( $miptheme_main_color ); ?>;
    border-color: <?php echo esc_attr( $miptheme_main_color ); ?>;
}

<?php

$grid_width   = isset($mipthemeoptions_framework['_mp_grid_width']) ?   $mipthemeoptions_framework['_mp_grid_width']  : 'grid-1340';
if ( $grid_width == 'grid-992' ) {
?>
@media (min-width: 1170px) {
    .container {
        width: 970px !important;
    }
}
<?php
} else if ( $grid_width == 'grid-1200' ) {
?>
@media (min-width: 1170px) {

    /* ==========================================================================
       General
       ========================================================================== */

    /**
     * Wrappers and containers
     */

     /* ==========================================================================
        Articles
        ========================================================================== */

     /**
     * Photo Gallery One
     */

     .loop-page-7 .article-post .miptheme-photo-gallery-one {
        margin-left: -233px;
        margin-right: -30px;
     }


     /**
      * Article Review Template
      */

      #article-post-review-header header {
          padding-left: 295px;
      }

      #single-post-header-full.header-loop-page-7 header {
          text-align: left;
          padding-left: 345px;
      }

     .loop-page-7 .article-post .row-review-template {
         padding-left: 0;
         padding-right: 0;
         margin-left: -25px;
     }

     .loop-page-7 .article-post .row-review-template .col {
         padding: 0 25px;
     }

     .loop-page-7 .article-post .row-review-template .col-info {
         padding: 0;
         margin-top: -30px;
         min-height: 200px;
         background: url(../../images/vertical-right-shadow.png) no-repeat 100% 100%;
     }

     .loop-page-7 .article-post .row-review-template .col-has-poster {
         margin-top: -178px;
     }

     .article-post-review-meta {
         padding: 25px;
         margin-bottom: 0;
         border-bottom: none;
         background: url(../../images/top-left-shadow.png) no-repeat 100% 0;
     }

     .article-post-review-meta p {
         margin-bottom: 15px;
     }

     .article-post-review-meta p span {
         display: block;
     }

     .loop-page-7 .article-post .review {
         margin-left: -233px;
         margin-right: -30px;
     }

     /**
      * User Reviews
      */

      #comment-user-reviews {
          margin: 25px -25px;
          padding: 25px 10px !important;
      }



     /* ==========================================================================
        Categories
        ========================================================================== */

     .loop-cat-2.full-width .main .row,
     .loop-cat-3.full-width .main .row,
     .main .loop-cat-3.full-width .row,
     .loop-cat-4.full-width .main .row,
     .loop-cat-5.full-width .main .row,
     .loop-cat-6.full-width .main .row,
     .loop-cat-12.full-width .main .row {
         margin: 0 -25px 30px -26px;
     }

     .loop-cat-7.full-width .main .row,
     .loop-cat-8.full-width .main .row,
     .loop-cat-9.full-width .main .row,
     .loop-cat-10.full-width .main .row {
         margin: 0 -25px 1px -26px;
     }

     .loop-cat-2.full-width .main div.entry,
     .loop-cat-3.full-width .main div.entry,
     .main .loop-cat-3.full-width div.entry,
     .hide-sidebar.loop-cat-4.full-width .main div.entry,
     .loop-cat-5.full-width .main div.entry,
     .loop-cat-6.full-width .main div.entry {
         padding: 0 25px;
     }

}



@media (min-width: 1200px) {

    /* ==========================================================================
       General
       ========================================================================== */

    /**
     * Wrappers and containers
     */

    .main.article {
        padding: 25px;
    }

    #page-content.left-sidebar .main,
    #page-content.right-sidebar .main {
        width: 820px;
    }

    #page-content.left-sidebar .main,
    #page-content.right-sidebar .main,
    #page-content.hide-sidebar .main  {
        padding: 25px 25px 0 25px;
    }

    .sidebar {
        width: 348px;
        padding: 24px;
    }

    .main .section-full,
    #page-content.left-sidebar .main .section-full,
    #page-content.right-sidebar .main .section-full,
    #page-content.hide-sidebar .main .section-full {
       margin: 0 -25px 0 -25px;
    }


    /* ==========================================================================
       Page Slider
       ========================================================================== */

    /**
     * Default
     */


    #page-slider article .main .col-md-4 {
        padding-right: 28px;
    }

    #page-slider article .main h2 {
        font-size: 22px;
        line-height: 26px;
    }

    #page-slider article .main p {
        line-height: 20px;
    }


    /* ==========================================================================
       Articles
       ========================================================================== */

    /**
     * Default
     */

    article.def h2 {
        font-size: 28px;
        line-height: 36px;
        font-weight: 400;
    }

    article.def h3 {
        font-size: 18px;
        line-height: 24px;
    }

    article.def h4 {
        font-size: 16px;
        line-height: 20px;
    }

    article.def-medium figure.overlay figcaption div.entry-meta {
        padding: 7px 14px;
    }

    article.def-small figure.overlay figcaption div.entry-meta {
        padding: 5px 10px;
    }


    /* ==========================================================================
       Articles
       ========================================================================== */

   .loop-cat-12 .main article.def figure img {
       margin-bottom: -100px;
   }

   .loop-cat-12 .main article.def div.entry {
       padding: 20px 25px 25px 110px;
       margin: 0 25px 20px 25px;
   }

   .loop-cat-12 .main article.no-image div.entry {
       padding: 0 0 25px 110px;
       margin: 0;
   }

   .loop-cat-12 a.btn-fa-icon {
       display: block;
   }

   /**
    * Photo Gallery One
    */

    .article-post .miptheme-photo-gallery-one {
        position: relative;
        margin-top: 30px;
        margin-left: -25px;
        margin-right: -25px;
        padding-left: 270px;
    }

   .loop-page-7 .article-post .miptheme-photo-gallery-one {
       margin-left: -294px;
       margin-right: -36px;
       padding-left: 270px;
   }

   .hide-sidebar.loop-page-7 .article-post .miptheme-photo-gallery-one {
       margin-left: -411px;
       padding-left: 388px;
   }

   .miptheme-photo-gallery-one .gallery-info {
       position: absolute;
       top: 0;
       left: 0;
       width: 270px;
       height: 375px;
       margin-top: 0;
   }

   .hide-sidebar .miptheme-photo-gallery-one .gallery-info {
       width: 388px;
       height: 533px;
   }


   /**
    * Article Review Template
    */

    .article-post .review {
        margin-left: -25px;
        margin-right: -25px;
        padding-top: 5px;
    }

    .article-post .review .review-circle-wrapper {
        top: -85px;
    }

    .article-post .review .score-desc {
        margin-top: 85px;
    }

    .loop-page-7 .article-post .review {
        margin: 30px -36px 30px -294px;
        padding: 20px;
    }

    .hide-sidebar.loop-page-7 .article-post .review {
        margin-left: -411px;
    }

    .loop-page-7 .article-post .review .review-circle-wrapper {
        top: -100px;
    }

    .loop-page-7 .article-post .review h4 {
        margin-top: 0;
    }

    .loop-page-7 .article-post .review .score-desc {
        position: relative;
        margin-top: 80px;
        left: auto;
        top: auto;
    }

    /* ==========================================================================
       Custom Sections
       ========================================================================== */

    /**
     * Shadows
     */

    .vc-block-shadow .shadow-box {
        margin: 0 -25px;
        padding: 22px 25px;
    }

    /**
     * Headers
     */

    #page-content section header h2 {
        margin: 0 25px;
    }

    #page-content section .has-header header h2 {
        margin: 0;
    }

    .vc-block-fx #page-content section header h2 {
        padding: 0 25px;
        margin: 0;
    }

    /**
     * Section two
     */

    .section-two.section-full .def-medium .col-sm-6 {
        width: 253px
    }

    /**
     * Top Grid Layout Three
     */

     #top-grid.top-grid-layout-3.container .col-md-6 article.def:first-child img {
         height: 301px;
     }

}
<?php
} else {
?>
@media (min-width: 1170px) {

    /* ==========================================================================
       General
       ========================================================================== */

    /**
     * Wrappers and containers
     */

     /* ==========================================================================
        Articles
        ========================================================================== */

     /**
     * Photo Gallery One
     */

     .loop-page-7 .article-post .miptheme-photo-gallery-one {
        margin-left: -233px;
        margin-right: -30px;
     }


     /**
      * Article Review Template
      */

      #article-post-review-header header {
          padding-left: 295px;
      }

      #single-post-header-full.header-loop-page-7 header {
          text-align: left;
          padding-left: 345px;
      }

     .loop-page-7 .article-post .row-review-template {
         padding-left: 0;
         padding-right: 0;
         margin-left: -25px;
     }

     .loop-page-7 .article-post .row-review-template .col {
         padding: 0 25px;
     }

     .loop-page-7 .article-post .row-review-template .col-info {
         padding: 0;
         margin-top: -30px;
         min-height: 200px;
         background: url(../../images/vertical-right-shadow.png) no-repeat 100% 100%;
     }

     .loop-page-7 .article-post .row-review-template .col-has-poster {
         margin-top: -178px;
     }

     .article-post-review-meta {
         padding: 25px;
         margin-bottom: 0;
         border-bottom: none;
         background: url(../../images/top-left-shadow.png) no-repeat 100% 0;
     }

     .article-post-review-meta p {
         margin-bottom: 15px;
     }

     .article-post-review-meta p span {
         display: block;
     }

     .loop-page-7 .article-post .review {
         margin-left: -233px;
         margin-right: -30px;
     }

     /**
      * User Reviews
      */

      #comment-user-reviews {
          margin: 25px -25px;
          padding: 25px 10px !important;
      }



     /* ==========================================================================
        Categories
        ========================================================================== */

     .loop-cat-2.full-width .main .row,
     .loop-cat-3.full-width .main .row,
     .main .loop-cat-3.full-width .row,
     .loop-cat-4.full-width .main .row,
     .loop-cat-5.full-width .main .row,
     .loop-cat-6.full-width .main .row,
     .loop-cat-12.full-width .main .row {
         margin: 0 -25px 30px -26px;
     }

     .loop-cat-7.full-width .main .row,
     .loop-cat-8.full-width .main .row,
     .loop-cat-9.full-width .main .row,
     .loop-cat-10.full-width .main .row {
         margin: 0 -25px 1px -26px;
     }

     .loop-cat-2.full-width .main div.entry,
     .loop-cat-3.full-width .main div.entry,
     .main .loop-cat-3.full-width div.entry,
     .hide-sidebar.loop-cat-4.full-width .main div.entry,
     .loop-cat-5.full-width .main div.entry,
     .loop-cat-6.full-width .main div.entry {
         padding: 0 25px;
     }

}



@media (min-width: 1200px) {

    /* ==========================================================================
       General
       ========================================================================== */

    /**
     * Wrappers and containers
     */

    .main.article {
        padding: 25px;
    }

    #page-content.left-sidebar .main,
    #page-content.right-sidebar .main {
        width: 820px;
    }

    #page-content.left-sidebar .main,
    #page-content.right-sidebar .main,
    #page-content.hide-sidebar .main  {
        padding: 25px 25px 0 25px;
    }

    .sidebar {
        width: 348px;
        padding: 24px;
    }

    .main .section-full,
    #page-content.left-sidebar .main .section-full,
    #page-content.right-sidebar .main .section-full,
    #page-content.hide-sidebar .main .section-full {
       margin: 0 -25px 0 -25px;
    }


    /* ==========================================================================
       Page Slider
       ========================================================================== */

    /**
     * Default
     */


    #page-slider article .main .col-md-4 {
        padding-right: 28px;
    }

    #page-slider article .main h2 {
        font-size: 22px;
        line-height: 26px;
    }

    #page-slider article .main p {
        line-height: 20px;
    }


    /* ==========================================================================
       Articles
       ========================================================================== */

    /**
     * Default
     */

    article.def h2 {
        font-size: 28px;
        line-height: 36px;
        font-weight: 400;
    }

    article.def h3 {
        font-size: 18px;
        line-height: 24px;
    }

    article.def h4 {
        font-size: 16px;
        line-height: 20px;
    }

    article.def-medium figure.overlay figcaption div.entry-meta {
        padding: 7px 14px;
    }

    article.def-small figure.overlay figcaption div.entry-meta {
        padding: 5px 10px;
    }


    /* ==========================================================================
       Articles
       ========================================================================== */

   .loop-cat-12 .main article.def figure img {
       margin-bottom: -100px;
   }

   .loop-cat-12 .main article.def div.entry {
       padding: 20px 25px 25px 110px;
       margin: 0 25px 20px 25px;
   }

   .loop-cat-12 .main article.no-image div.entry {
       padding: 0 0 25px 110px;
       margin: 0;
   }

   .loop-cat-12 a.btn-fa-icon {
       display: block;
   }

   /**
    * Photo Gallery One
    */

    .article-post .miptheme-photo-gallery-one {
        position: relative;
        margin-top: 30px;
        margin-left: -25px;
        margin-right: -25px;
        padding-left: 270px;
    }

   .loop-page-7 .article-post .miptheme-photo-gallery-one {
       margin-left: -294px;
       margin-right: -36px;
       padding-left: 270px;
   }

   .hide-sidebar.loop-page-7 .article-post .miptheme-photo-gallery-one {
       margin-left: -411px;
       padding-left: 388px;
   }

   .miptheme-photo-gallery-one .gallery-info {
       position: absolute;
       top: 0;
       left: 0;
       width: 270px;
       height: 375px;
       margin-top: 0;
   }

   .hide-sidebar .miptheme-photo-gallery-one .gallery-info {
       width: 388px;
       height: 533px;
   }


   /**
    * Article Review Template
    */

    .article-post .review {
        margin-left: -25px;
        margin-right: -25px;
        padding-top: 5px;
    }

    .article-post .review .review-circle-wrapper {
        top: -85px;
    }

    .article-post .review .score-desc {
        margin-top: 85px;
    }

    .loop-page-7 .article-post .review {
        margin: 30px -36px 30px -294px;
        padding: 20px;
    }

    .hide-sidebar.loop-page-7 .article-post .review {
        margin-left: -411px;
    }

    .loop-page-7 .article-post .review .review-circle-wrapper {
        top: -100px;
    }

    .loop-page-7 .article-post .review h4 {
        margin-top: 0;
    }

    .loop-page-7 .article-post .review .score-desc {
        position: relative;
        margin-top: 80px;
        left: auto;
        top: auto;
    }

    /* ==========================================================================
       Custom Sections
       ========================================================================== */

    /**
     * Shadows
     */

    .vc-block-shadow .shadow-box {
        margin: 0 -25px;
        padding: 22px 25px;
    }

    /**
     * Headers
     */

    #page-content section header h2 {
        margin: 0 25px;
    }

    #page-content section .has-header header h2 {
        margin: 0;
    }

    .vc-block-fx #page-content section header h2 {
        padding: 0 25px;
        margin: 0;
    }

    /**
     * Section two
     */

    .section-two.section-full .def-medium .col-sm-6 {
        width: 253px
    }

    /**
     * Top Grid Layout Three
     */

     #top-grid.top-grid-layout-3.container .col-md-6 article.def:first-child img {
         height: 301px;
     }

}

@media (min-width: 1370px) {

    /* ==========================================================================
       General
       ========================================================================== */

    /**
     * Wrappers and containers
     */

    .container {
        width: 1340px;
    }

    #page-content.left-sidebar .main,
    #page-content.right-sidebar .main {
        width: 940px;
    }

    .sidebar {
        width: 398px;
    }


    /* ==========================================================================
       Articles
       ========================================================================== */

    /**
    * Default
    */

    article.def figure.overlay figcaption span.entry-comments {
        right: 10px;
        bottom: 5px;
    }

    article.def-medium figure.overlay figcaption span.entry-comments {
        right: 20px;
        bottom: 15px;
    }

    article.def-medium figure.overlay figcaption div.entry,
    article.def-medium figure.overlay figcaption div.entry div.entry-meta {
        padding: 25px 25px;
    }

    article.def-medium figure.overlay figcaption div.entry span.entry-comments {
        right: 25px;
        bottom: 25px;
    }

    .loop-cat article.def figure.overlay figcaption div.entry-meta {
        padding: 15px 20px;
    }


    /**
    * Photo Gallery One
    */

    .article-post .miptheme-photo-gallery-one {
        margin-left: -25px;
        padding-left: 310px;
    }

    .hide-sidebar .article-post .miptheme-photo-gallery-one {
        padding-left: 444px;
    }

    .loop-page-7 .article-post .miptheme-photo-gallery-one {
        margin-left: -334px;
        padding-left: 310px;
    }

    .hide-sidebar.loop-page-7 .article-post .miptheme-photo-gallery-one {
        margin-left: -467px;
        padding-left: 444px;
    }

    .miptheme-photo-gallery-one .gallery-info {
        width: 310px;
        height: 430px;
    }

    .hide-sidebar .miptheme-photo-gallery-one .gallery-info {
        width: 444px;
        height: 610px;
    }

    /**
     * Article Review Template
     */

     #single-post-header-full.header-loop-page-7 header {
         padding-left: 335px;
     }
     #single-post-header-full.hide-sidebar.header-loop-page-7 header {
         padding-left: 468px;
     }

     .loop-page-7 .article-post .review {
         margin-left: -334px;
         padding: 25px;
     }

     .hide-sidebar.loop-page-7 .article-post .review {
         margin-left: -467px;
     }


     /**
      * Top Grid Layout Three
      */

      #top-grid.top-grid-layout-3.container .col-md-6 article.def:first-child img {
          height: 344px;
      }

}
<?php
}
?>
