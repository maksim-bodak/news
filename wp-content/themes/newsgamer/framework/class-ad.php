<?php
/**
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */

if ( ! class_exists( 'MipThemeFramework_Ad' ) ) {

    class MipThemeFramework_Ad {

        // init var
        public $id;
        public $ad_size         = '';
        public $ad_type         = '';
        public $ad_image        = '';
        public $ad_url          = 0;
        public $ad_click        = 0;
        public $ad_url_target   = '_blank';
        public $ad_code         = 0;

        private function getAd() {
            $this->ad_type          = get_post_meta( $this->id, '_mp_ads_ad_type', true );
            $this->ad_image         = get_post_meta( $this->id, '_mp_ads_ad_image', true );
            $this->ad_url           = get_post_meta( $this->id, '_mp_ads_ad_url', true );
            $this->ad_url_target    = get_post_meta( $this->id, '_mp_ads_ad_url_target', true );
            $this->ad_code          = get_post_meta( $this->id, '_mp_ads_ad_code', true );
            $this->ad_click         = get_post_meta( $this->id, '_mp_ads_ad_click', true );


            switch ( $this->ad_type ) {
                case 'image':
                    $click_event    = ( $this->ad_click ) ? ' onclick="'. esc_js($this->ad_click) .'"' : '';
                    $banner_image   = '<img src="'. esc_url($this->ad_image['url']) .'" width="'. esc_attr( $this->ad_image['width'] ) .'" alt="" />';
                    $banner_image   = ( $this->ad_url ) ? '<a href="'. esc_url($this->ad_url) .'" target="'. esc_attr( $this->ad_url_target ) .'"'. $click_event .'>'. $banner_image .'</a>' : $banner_image;

                    return $banner_image;
                break;
                case 'code':
                    return do_shortcode($this->ad_code);
                break;
            }
        }

        public function formatTopAd() {
            $this->ad_size      = get_post_meta( $this->id, '_mp_ads_ad_size', true );
            echo  '<div class="container">
                        <div class="ad ad-top ad-'. esc_attr( $this->ad_size ) .' text-center">'. $this->getAd() .'</div>
                    </div>';
        }

        public function formatBottomAd() {
            $this->ad_size      = get_post_meta( $this->id, '_mp_ads_ad_size', true );
            echo  '<div class="container">
                        <div class="ad ad-bottom ad-'. esc_attr( $this->ad_size ) .' text-center">'. $this->getAd() .'</div>
                    </div>';
        }

        public function formatLayoutAd( $class = 'row ad' ) {
            $this->ad_size      = get_post_meta( $this->id, '_mp_ads_ad_size', true );
            echo  '<div class="'. esc_attr( $class ) .' ad-'. esc_attr( $this->ad_size ) .'">'. $this->getAd() .'</div>';
        }

        public function formatVCAd( $class = 'row ad' ) {
            $this->ad_size      = get_post_meta( $this->id, '_mp_ads_ad_size', true );
            return  '<section><div class="'. esc_attr( $class ) .'">'. $this->getAd() .'</div></section>';
        }

        public function formatBlankAd() {
            echo  $this->getAd();
        }

        public function formatWallAd() {
            $this->ad_type      = get_post_meta( $this->id, '_mp_ads_ad_type', true );
            switch ( $this->ad_type ) {
                case 'image':
                    echo  '<div class="wall-ad">
                            <div class="wall-ad-container">
                                '. $this->getAd() .'
                            </div>
                        </div>';
                break;
                case 'code':
                    echo  '<div class="wall-ad">
                                '. $this->getAd() .'
                        </div>';
                break;
            }

        }

        public function formatLeftSideAd() {
            $this->ad_size      = get_post_meta( $this->id, '_mp_ads_ad_side_size', true );
            echo  '<div class="side-ad side-left-'. esc_attr( $this->ad_size ) .' visible-md visible-lg">'. $this->getAd() .'</div>';
        }

        public function formatRightSideAd() {
            $this->ad_size      = get_post_meta( $this->id, '_mp_ads_ad_side_size', true );
            echo  '<div class="side-ad side-right-'. esc_attr( $this->ad_size ) .' visible-md visible-lg">'. $this->getAd() .'</div>';
        }

        public function formatMobileHeaderAd() {
            echo  '<!-- start:mobile-top-banner --><div class="ad-mobile-top">'. $this->getAd() .'</div><!-- end:mobile-top-banner -->';
        }

        public function formatContentAd( $align = 'none', $hide_on_mobile = 'no' ) {
            $this->ad_size      = get_post_meta( $this->id, '_mp_ads_ad_size', true );
            return  '<div class="ad ad-cnt ad-'. esc_attr( $this->ad_size ) .' ad-cnt-'. $align .' ad-cnt-hide-on-mobile-'. $hide_on_mobile .'">'. $this->getAd() .'</div>';
        }

    }

}
