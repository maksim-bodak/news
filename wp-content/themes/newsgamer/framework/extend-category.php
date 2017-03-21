<?php
/** Add Colorpicker Field to "Add New Category" Form **/
if ( ! function_exists( 'mipthemeframework_category_form_custom_field_add' ) ) {
    function mipthemeframework_category_form_custom_field_add( $taxonomy ) {
    ?>
    <div class="form-field">
        <label for="category_custom_color">Category Primary Color</label>
        <input name="cat_meta[cat-primary-color]" class="colorpicker" type="text" value="" />
        <!--p class="description">Pick a Category Primary Color</p-->
    </div>
    <?php
    }
}

/** Add New Field To Category **/
if ( ! function_exists( 'mipthemeframework_extra_category_fields' ) ) {
    function mipthemeframework_extra_category_fields( $tag ) {
        $t_id = $tag->term_id;
        $cat_meta = get_option( "category_$t_id" );
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="meta-color"><?php esc_html_e('Category Primary Color', 'Newsgamer'); ?></label></th>
        <td>
            <div id="colorpicker">
                <input type="text" name="cat_meta[cat-primary-color]" class="colorpicker" size="3" style="width:20%;" value="<?php echo (isset($cat_meta['cat-primary-color'])) ? $cat_meta['cat-primary-color'] : ''; ?>" />
            </div>
                <br />
            <span class="description"></span>
                <br />
            </td>
    </tr>
    <?php
    }
}

/** Save Category Meta **/
if ( ! function_exists( 'mipthemeframework_save_extra_category_fileds' ) ) {
    function mipthemeframework_save_extra_category_fileds( $term_id ) {

        if ( isset( $_POST['cat_meta'] ) ) {
            $t_id = $term_id;
            $cat_meta = get_option( "category_$t_id");
            $cat_keys = array_keys($_POST['cat_meta']);
                foreach ($cat_keys as $key){
                if (isset($_POST['cat_meta'][$key])){
                    $cat_meta[$key] = $_POST['cat_meta'][$key];
                }
            }
            //save the option array
            update_option( "category_$t_id", $cat_meta );
        }
    }
}

/** Enqueue Color Picker **/
if ( ! function_exists( 'mipthemeframework_colorpicker_enqueue' ) ) {
    function mipthemeframework_colorpicker_enqueue() {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'colorpicker-js', get_template_directory_uri() . '/framework/js/style-customizer.js', array( 'wp-color-picker' ) );
    }
}
