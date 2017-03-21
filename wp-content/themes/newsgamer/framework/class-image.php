<?php
/**
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */

if ( ! class_exists( 'MipThemeFramework_Image' ) ) {

    class MipThemeFramework_Image {

        public $theme_layout    = '';
        public $page_layout     = '';
        private $image_arr;
        private $image_dims;

        public function __construct() {

            $this->image_dims       = array
            (
                'miptheme-post-cover'  => array( 'miptheme-post-cover', 1340, 500, 0 ),
                'miptheme-post-thumb-1'  => array( 'miptheme-post-thumb-1', 940, 560, 0 ),
                'miptheme-post-thumb-2'  => array( 'miptheme-post-thumb-2', 890, 606, 0 ),
                'miptheme-post-thumb-3'  => array( 'miptheme-post-thumb-3', 577, 394, 0 ),
                'miptheme-post-thumb-4'  => array( 'miptheme-post-thumb-4', 470, 320, 0 ),
                'miptheme-post-thumb-5'  => array( 'miptheme-post-thumb-5', 350, 245, 0 ),
                'miptheme-post-thumb-6'  => array( 'miptheme-post-thumb-6', 277, 190, 0 ),
                'miptheme-post-thumb-7'  => array( 'miptheme-post-thumb-7', 176, 120, 0 ),
            );

        }


        // set dims
        public function set_dims($width, $height) {
            return ''. $width .'x'. $height .'';
        }


        // get image for loop-page-2
        public function get_image_loop_page_2($block_id, $image_full_height = false) {
            if ( $image_full_height ) {
                $this->image_arr        = array
                (
                    'left-sidebar'       => array( array(890, 0), 890, 0, 0 ),
                    'right-sidebar'      => array( array(890, 0), 890, 0, 0 ),
                    'hide-sidebar'       => array( array(1340, 2000), 1340, 0, 0 ),
                );
            } else {
                $this->image_arr        = array
                (
                    'left-sidebar'       => $this->image_dims['miptheme-post-thumb-2'],
                    'right-sidebar'      => $this->image_dims['miptheme-post-thumb-2'],
                    'hide-sidebar'       => $this->image_dims['miptheme-post-cover'],
                );
            }
            return $this->image_arr[$block_id];
        }


        // get image for loop-page-2
        public function get_image_loop_page_3($block_id, $image_full_height = false) {
            if ( $image_full_height ) {
                $this->image_arr        = array
                (
                    'left-sidebar'       => array( array(940, 0), 940, '', 0 ),
                    'right-sidebar'      => array( array(940, 0), 940, '', 0 ),
                    'hide-sidebar'       => array( array(1340, 2000), 1340, '', 0 ),
                );
            } else {
                $this->image_arr        = array
                (
                    'left-sidebar'       => $this->image_dims['miptheme-post-thumb-1'],
                    'right-sidebar'      => $this->image_dims['miptheme-post-thumb-1'],
                    'hide-sidebar'       => $this->image_dims['miptheme-post-cover'],
                );
            }
            return $this->image_arr[$block_id];
        }

        // get image for loop-page-4
        public function get_image_loop_page_4($block_id, $image_full_height = false) {
            if ( $image_full_height ) {
                $this->image_arr        = array
                (
                    'left-sidebar'       => array( array(890, 0), 890, '', 0 ),
                    'right-sidebar'      => array( array(890, 0), 890, '', 0 ),
                    'hide-sidebar'       => array( array(1340, 2000), 1340, '', 0 ),
                );
            } else {
                $this->image_arr        = array
                (
                    'left-sidebar'       => $this->image_dims['miptheme-post-thumb-2'],
                    'right-sidebar'      => $this->image_dims['miptheme-post-thumb-2'],
                    'hide-sidebar'       => $this->image_dims['miptheme-post-cover'],
                );
            }
            return $this->image_arr[$block_id];
        }

        // get image for loop-page-5
        public function get_image_loop_page_5($block_id, $image_full_height = false) {
            return $this->image_dims['miptheme-post-cover'];
        }

        // get image for loop-page-6
        public function get_image_loop_page_6($block_id, $image_full_height = false) {
            return $this->image_dims['miptheme-post-cover'];
        }



        // get image for block 01 left
        public function get_image_attr_block01_left($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => array( '263_dim_180', 263, 180, 0 ),
                'right-sidebar-1'      => array( '263_dim_180', 263, 180, 0 ),
                'hide-sidebar-1'       => array( '396_dim_270', 396, 270, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 01 left
        public function get_image_attr_block01_right($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => $this->image_dims['miptheme-post-thumb-3'],
                'right-sidebar-1'      => $this->image_dims['miptheme-post-thumb-3'],
                'hide-sidebar-1'       => array( '842_dim_575', 842, 575, 0 ),
                'left-sidebar-2'       => $this->image_dims['miptheme-post-thumb-7'],
                'right-sidebar-2'      => $this->image_dims['miptheme-post-thumb-7'],
                'hide-sidebar-2'       => array( '261_dim_178', 261, 178, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 02 left
        public function get_image_attr_block02_left($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => $this->image_dims['miptheme-post-thumb-6'],
                'right-sidebar-1'      => $this->image_dims['miptheme-post-thumb-6'],
                'hide-sidebar-1'       => array( '406_dim_277', 406, 277, 0 ),
                /*'left-sidebar-2'       => array( '172_dim_118', 172, 118, 0 ),
                'right-sidebar-2'      => array( '172_dim_118', 172, 118, 0 ),*/
                'left-sidebar-2'       => $this->image_dims['miptheme-post-thumb-7'],
                'right-sidebar-2'      => $this->image_dims['miptheme-post-thumb-7'],
                'hide-sidebar-2'       => array( '261_dim_178', 261, 178, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 02 left
        public function get_image_attr_block02_right($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => array( '263_dim_180', 263, 180, 0 ),
                'right-sidebar-1'      => array( '263_dim_180', 263, 180, 0 ),
                'hide-sidebar-1'       => array( '396_dim_270', 396, 270, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 03
        public function get_image_attr_block03($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => array( '263_dim_180', 263, 180, 0 ),
                'right-sidebar-1'      => array( '263_dim_180', 263, 180, 0 ),
                'hide-sidebar-1'       => array( '396_dim_270', 396, 270, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 04
        public function get_image_attr_block04($block_id) {
            $this->image_arr        = array
            (
            'left-sidebar-1'       => array( '420_dim_284', 420, 287, 0 ),
            'right-sidebar-1'      => array( '420_dim_284', 420, 287, 0 ),
            'hide-sidebar-1'       => array( '619_dim_422', 619, 422, 0 ),
            'left-sidebar-2'       => array( '195_dim_133', 195, 133, 0 ),
            'right-sidebar-2'      => array( '195_dim_133', 195, 133, 0 ),
            'hide-sidebar-2'       => array( '295_dim_196', 295, 196, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 05
        public function get_image_attr_block05($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => array( '263_dim_180', 263, 180, 0 ),
                'right-sidebar-1'      => array( '263_dim_180', 263, 180, 0 ),
                'hide-sidebar-1'       => array( '396_dim_270', 396, 270, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 06
        public function get_image_attr_block06($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => array( '420_dim_284', 420, 287, 0 ),
                'right-sidebar-1'      => array( '420_dim_284', 420, 287, 0 ),
                'hide-sidebar-1'       => array( '619_dim_422', 619, 422, 0 ),
                'left-sidebar-2'       => array( '195_dim_133', 195, 133, 0 ),
                'right-sidebar-2'      => array( '195_dim_133', 195, 133, 0 ),
                'hide-sidebar-2'       => array( '295_dim_196', 295, 196, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 08
        public function get_image_attr_block08($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => $this->image_dims['miptheme-post-thumb-4'],
                'right-sidebar-1'      => $this->image_dims['miptheme-post-thumb-4'],
                'hide-sidebar-1'       => array( '668_dim_455', 668, 455, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 09
        public function get_image_attr_block09($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => array( '312_dim_213', 312, 213, 0 ),
                'right-sidebar-1'      => array( '312_dim_213', 312, 213, 0 ),
                'hide-sidebar-1'       => array( '445_dim_303', 445, 303, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 10
        public function get_image_attr_block10($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => $this->image_dims['miptheme-post-thumb-4'],
                'right-sidebar-1'      => $this->image_dims['miptheme-post-thumb-4'],
                'hide-sidebar-1'       => array( '668_dim_455', 668, 455, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 11
        public function get_image_attr_block11($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => $this->image_dims['miptheme-post-thumb-2'],
                'right-sidebar-1'      => $this->image_dims['miptheme-post-thumb-2'],
                'hide-sidebar-1'       => array( '1288_dim_600', 1288, 600, 0 ),
                'left-sidebar-2'       => array( '430_dim_293', 430, 293, 0 ),
                'right-sidebar-2'      => array( '430_dim_293', 430, 293, 0 ),
                'hide-sidebar-2'       => array( '629_dim_418', 629, 418, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 10
        public function get_image_attr_block12($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => $this->image_dims['miptheme-post-thumb-2'],
                'right-sidebar-1'      => $this->image_dims['miptheme-post-thumb-2'],
                'hide-sidebar-1'       => array( '1288_dim_600', 1288, 600, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 01 left
        public function get_image_attr_block13_right($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => array( '577_dim_577', 577, 577, 0 ),
                'right-sidebar-1'      => array( '577_dim_577', 577, 577, 0 ),
                'hide-sidebar-1'       => array( '842_dim_842', 842, 842, 0 ),
                'left-sidebar-2'       => $this->image_dims['miptheme-post-thumb-7'],
                'right-sidebar-2'      => $this->image_dims['miptheme-post-thumb-7'],
                'hide-sidebar-2'       => array( '261_dim_178', 261, 178, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for block 01 left
        public function get_image_attr_block14_left($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-1'       => array( '263_dim_577', 263, 577, 0 ),
                'right-sidebar-1'      => array( '263_dim_577', 263, 577, 0 ),
                'hide-sidebar-1'       => array( '396_dim_842', 396, 842, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for top grid 1 and 2
        public function get_image_attr_top_grid_1($block_id) {
            $this->image_arr        = array
            (
                'first'                 => $this->image_dims['miptheme-post-thumb-2'],
                'second'                => $this->image_dims['miptheme-post-thumb-4'],
                'firstcontainer'        => array( array(670, 458), 670, 458, 0 ),
                'secondcontainer'       => array( array(335, 229), 335, 229, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        public function get_image_attr_top_grid_3($block_id) {
            $this->image_arr        = array
            (
                'first'                 => array( array(890, 446), 890, 446, 0 ),
                'second'                => $this->image_dims['miptheme-post-thumb-4'],
                'firstcontainer'        => array( array(670, 343), 670, 343, 0 ),
                'secondcontainer'       => array( array(335, 229), 335, 229, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        public function get_image_attr_top_grid_4($block_id) {
            $this->image_arr        = array
            (
                'first'                 => $this->image_dims['miptheme-post-thumb-2'],
                'second'                => $this->image_dims['miptheme-post-thumb-4'],
                'firstcontainer'        => array( array(670, 458), 670, 458, 0 ),
                'secondcontainer'       => array( array(447, 305), 447, 305, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        public function get_image_attr_top_grid_5($block_id) {
            $this->image_arr        = array
            (
                'first'                 => $this->image_dims['miptheme-post-thumb-3'],
                'second'                => $this->image_dims['miptheme-post-thumb-4'],
                'firstcontainer'        => array( array(447, 305), 447, 305, 0 ),
                'secondcontainer'       => array( array(335, 229), 335, 229, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        public function get_image_attr_top_grid_6($block_id) {
            $this->image_arr        = array
            (
                'first'                 => $this->image_dims['miptheme-post-thumb-2'],
                //'first'        => array( array(890, 607), 890, 607, 0 ),
                'firstcontainer'        => array( array(670, 458), 670, 458, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        public function get_image_attr_top_grid_7($block_id) {
            $this->image_arr        = array
            (
                'first'                 => $this->image_dims['miptheme-post-thumb-2'],
                'firstcontainer'        => array( array(447, 305), 447, 305, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        public function get_image_attr_top_grid_8($block_id) {
            $this->image_arr        = array
            (
                'first'                 => $this->image_dims['miptheme-post-thumb-4'],
                'firstcontainer'        => array( array(335, 229), 335, 229, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for top grid 10
        public function get_image_attr_top_grid_10($block_id) {
            $this->image_arr        = array
            (
                'first'                 => array( array(890, 445), 890, 445, 0 ),
                'second'                => array( array(445, 445), 445, 445, 0 ),
                'firstcontainer'        => array( array(670, 335), 670, 335, 0 ),
                'secondcontainer'       => array( array(335, 335), 335, 335, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // get image for top grid 11
        public function get_image_attr_top_grid_11($block_id) {
            $this->image_arr        = array
            (
                'first'                 => $this->image_dims['miptheme-post-thumb-2'],
                'second'                => array( array(470, 640), 470, 640, 0 ),
                'third'                => $this->image_dims['miptheme-post-thumb-4'],
                'firstcontainer'        => array( array(670, 458), 670, 458, 0 ),
                'secondcontainer'       => array( array(335, 458), 335, 458, 0 ),
                'thirdcontainer'       => array( array(335, 229), 335, 229, 0 ),
            );
            return $this->image_arr[$block_id];
        }



    }

}


if ( ! class_exists( 'MipThemeFramework_ImageCat' ) ) {

    class MipThemeFramework_ImageCat extends MipThemeFramework_Image {

        public function __construct() {

            $this->image_dims       = array
            (
                'miptheme-post-cover'  => array( 'miptheme-post-cover', 1340, 500, 0 ),
                'miptheme-post-thumb-1'  => array( 'miptheme-post-thumb-1', 940, 560, 0 ),
                'miptheme-post-thumb-2'  => array( 'miptheme-post-thumb-2', 890, 500, 0 ),
                'miptheme-post-thumb-3'  => array( 'miptheme-post-thumb-3', 630, 430, 0 ),
                'miptheme-post-thumb-4'  => array( 'miptheme-post-thumb-4', 470, 320, 0 ),
                'miptheme-post-thumb-5'  => array( 'miptheme-post-thumb-5', 350, 245, 0 ),
                'miptheme-post-thumb-6'  => array( 'miptheme-post-thumb-6', 277, 190, 0 ),
                'miptheme-post-thumb-7'  => array( 'miptheme-post-thumb-7', 176, 120, 0 )
            );

        }

        // for cat 01
        public function get_image_attr_cat01($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar'       => $this->image_dims['miptheme-post-thumb-5'],
                'right-sidebar'      => $this->image_dims['miptheme-post-thumb-5'],
                'hide-sidebar'       => array( array(519, 354), 519, 354, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // for cat 02
        public function get_image_attr_cat02($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar'       => $this->image_dims['miptheme-post-thumb-4'],
                'right-sidebar'      => $this->image_dims['miptheme-post-thumb-4'],
                'hide-sidebar'       => array( array(669, 430), 669, 430, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // for cat 03
        public function get_image_attr_cat03($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar-standard'       => $this->image_dims['miptheme-post-thumb-6'],
                'right-sidebar-standard'      => $this->image_dims['miptheme-post-thumb-6'],
                'hide-sidebar-standard'       => array( array(409, 263), 409, 263, 0 ),
                'left-sidebar-full-width'     => $this->image_dims['miptheme-post-thumb-5'],
                'right-sidebar-full-width'    => $this->image_dims['miptheme-post-thumb-5'],
                'hide-sidebar-full-width'     => array( array(445, 286), 445, 286, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // for cat 04
        public function get_image_attr_cat04($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar'       => $this->image_dims['miptheme-post-thumb-6'],
                'right-sidebar'      => $this->image_dims['miptheme-post-thumb-6'],
                'hide-sidebar'       => array( array(334, 215), 334, 215, 0 ),
            );
            return $this->image_arr[$block_id];
        }

        // for cat 04
        public function get_image_attr_cat12($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar'       => $this->image_dims['miptheme-post-thumb-1'],
                'right-sidebar'      => $this->image_dims['miptheme-post-thumb-1'],
                'hide-sidebar'       => $this->image_dims['miptheme-post-thumb-1'],
            );
            return $this->image_arr[$block_id];
        }

        public function get_image_attr_cat_full($block_id) {
            $this->image_arr        = array
            (
                'left-sidebar'       => $this->image_dims['miptheme-post-thumb-1'],
                'right-sidebar'      => $this->image_dims['miptheme-post-thumb-1'],
                'hide-sidebar'       => $this->image_dims['miptheme-post-cover'],
            );
            return $this->image_arr[$block_id];
        }


        // for sidebar
        public function get_image_attr_sidebar($block_id) {
            $this->image_arr        = array
            (
                'sidebar-full'       => $this->image_dims['miptheme-post-thumb-5'],
                'sidebar-half'       => array( array(160, 109), 160, 109, 0 ),
                'sidebar-third'      => array( array(128, 88), 128, 88, 0 ),
            );
            return $this->image_arr[$block_id];
        }


    }

}
