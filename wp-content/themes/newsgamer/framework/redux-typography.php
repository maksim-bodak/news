<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "mipthemeoptions_typo";



    $mp_post_options    = get_option('mipthemeoptions_framework');
    $google_fonts       = (bool)$mp_post_options['_mp_theme_google_fonts'];

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => 'Theme Typography',
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => false,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Typography', 'Newsgamer' ),
        'page_title'           => esc_html__( 'Theme Typography', 'Newsgamer' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google'               => $google_fonts,
        'google_api_key'       => 'AIzaSyDxrzMjF3WLwVS4QRHcOyxGgQjsdggkGD8',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => true,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        'disable_google_fonts_link' => false,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        'disable_tracking'     => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        //'page_parent'          => 'miptheme_welcome',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */



    /*
     *
     * ---> START SECTIONS
     *
     */


    // -> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'General Setting', 'Newsgamer' ),
        'id'     => '_mp_typo_general_settings',
        'fields' => array(
            array(
                'id'        => '_mp_typo_body_font',
                'type'      => 'typography',
                'title'     => esc_html__('Body Font', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the body font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'font-weight'   => false,
                'text-align'   => false,
                'compiler'    => array('body'),
                'units'     =>'px',
            ),
            array(
                'id'       => '_mp_typo_main_color',
                'type'     => 'color',
                'title'    => esc_html__('Theme Main Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for the theme (default: #f1a602).', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => 0
            ),
            array(
                'id'       => '_mp_typo_body_bg',
                'type'     => 'background',
                'title'    => esc_html__('Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for sidebar', 'Newsgamer'),
                'transparent' => false,
                'preview' => false,
                'default'  => array(
                    'background-color' => '#ffffff',
                ),
                'compiler' => array('body'),
                //'output'    => array('background-color' => '#page-header')
            ),
        )
    ) );

    /*Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Navigation Settings', 'Newsgamer' ),
        'id'     => '_mp_typo_nav_settings',
        'icon'   => 'el el-icon-th-list',
        'fields' => array(

        )
    ) );
*/


    // -> START Header Settings
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Settings', 'Newsgamer' ),
        'id'               => '_mp_typo_header_settings',
        'customizer_width' => '400px',
        'icon'             => 'el el-icon-eject',
        'fields'           => array(
            array(
                'id'       => '_mp_typo_header_bg',
                'type'     => 'color',
                'title'    => esc_html__('Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for box background', 'Newsgamer'),
                'default'  => '#ffffff',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('background-color' => '#page-header'),
                //'output'    => array('background-color' => '#page-header')
            ),
            array(
                'id'    => '_mp_typo_header_search',
                'type'  => 'info',
                'title' => esc_html__('Search widget', 'Newsgamer'),
                'style' => 'warning',
                'desc'  => esc_html__('You have to enable this layout under Theme Options > Header Settings', 'Newsgamer'),
            ),
            array(
                'id'       => '_mp_typo_header_search_border',
                'type'     => 'color',
                'title'    => esc_html__('Search widget border color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '#header-branding #search-form, #header-branding #search-form button'),
            ),
            array(
                'id'       => '_mp_typo_header_search_input',
                'type'     => 'color',
                'title'    => esc_html__('Search widget input color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '#header-branding #search-form input, #header-branding #search-form input::-webkit-input-placeholder'),
            ),
            array(
                'id'       => '_mp_typo_header_search_icon',
                'type'     => 'color',
                'title'    => esc_html__('Search widget icon color (search icon)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '#header-branding #search-form button'),
            ),
            array(
                'id'    => '_mp_typo_header_weather',
                'type'  => 'info',
                'title' => esc_html__('Weather widget', 'Newsgamer'),
                'style' => 'warning',
                'desc'  => esc_html__('You have to enable this layout under Theme Options > Header Settings', 'Newsgamer'),
            ),
            array(
                'id'       => '_mp_typo_header_weather_title',
                'type'     => 'color',
                'title'    => esc_html__('Weather Title Color (City)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '#header-branding .weather h3'),
            ),
            array(
                'id'       => '_mp_typo_header_weather_temp',
                'type'     => 'color',
                'title'    => esc_html__('Weather Temperature', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '#header-branding .weather h3 span.temp'),
            ),
            array(
                'id'       => '_mp_typo_header_weather_date',
                'type'     => 'color',
                'title'    => esc_html__('Weather Date (if displayed)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '#header-branding .weather span.date'),
            ),
            array(
                'id'       => '_mp_typo_header_weather_condition',
                'type'     => 'color',
                'title'    => esc_html__('Weather Description (if displayed)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '#header-branding .weather span.desc'),
            ),
            array(
                'id'       => '_mp_typo_header_weather_icon',
                'type'     => 'color',
                'title'    => esc_html__('Weather Icon', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '#header-branding .weather i.icon'),
            ),
            array(
                'id'       => '_mp_typo_header_weather_icon_location',
                'type'     => 'color',
                'title'    => esc_html__('Weather Location Icon', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '#header-branding .weather span.glyphicon'),
            ),

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Top Navigation', 'Newsgamer' ),
        'id'     => '_mp_typo_header_top_nav',
        'customizer_width' => '450px',
        'subsection'       => true,
        'fields' => array(
            array(
                'id' => '_mp_typo_header_topnav_height',
                'type' => 'slider',
                'title' => esc_html__('Top Navigation Height', 'Newsgamer'),
                'subtitle' => esc_html__('Set Top Navigation height', 'Newsgamer'),
                'desc' => esc_html__('If you change this value, please change the "line-height" value for all the elements as well.', 'Newsgamer'),
                "default" => 35,
                "min" => 0,
                "step" => 1,
                "max" => 100,
                'display_value' => 'text',
                //'compiler' => array('height' => '#top-navigation'),
                //'compiler' => array('Height' => '#top-navigation'),
            ),
            array(
                'id'        => '_mp_typo_header_topnav_date',
                'type'      => 'typography',
                'title'     => esc_html__('Current date (if displayed)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#top-navigation ul li.date'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-weight'   => '700',
                    'line-height' => '35px',
                    'color'       => '#222222'
                ),
            ),
            array(
                'id'        => '_mp_typo_header_topnav_links',
                'type'      => 'typography',
                'title'     => esc_html__('Menu Links', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#top-navigation ul li a'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '12px',
                    'line-height' => '35px',
                    'color'       => '#999999'
                ),
            ),
            array(
                'id'        => '_mp_typo_header_topnav_social_links',
                'type'      => 'typography',
                'title'     => esc_html__('Social Links', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#top-navigation ul li.soc-media a'),
                'units'     =>'px',
                'default'     => array(
                    'font-size'   => '14px',
                    'line-height' => '35px',
                ),
            ),
        )
    ) );



    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Main Navigation', 'Newsgamer' ),
        'id'     => '_mp_typo_header_main_nav',
        'customizer_width' => '450px',
        'subsection'       => true,
        'fields' => array(
            array(
                'id' => '_mp_typo_header_mainnav_center',
                'type' => 'switch',
                'title' => esc_html__('Center the Menu Navigation', 'Newsgamer'),
                'subtitle' => esc_html__('Enable this if you want to center main navigation!', 'Newsgamer'),
                'default' => 0,
            ),
            array(
                'id'       => '_mp_typo_header_mainnav_bg',
                'type'     => 'color',
                'title'    => esc_html__('Menu Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a background color', 'Newsgamer'),
                'default'  => '#3c3c3c',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('background-color' => '#header-navigation'),
                //'output'    => array('background-color' => '#page-header')
            ),
            array(
                'id'       => '_mp_typo_header_mainnav_border_color',
                'type'     => 'color',
                'title'    => esc_html__('Menu Border Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a border', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '#header-navigation'),
                //'output'    => array('background-color' => '#page-header')
            ),
            array(
                'id' => '_mp_typo_header_mainnav_border_top',
                'type' => 'slider',
                'title' => esc_html__('Menu Border Top', 'Newsgamer'),
                'subtitle' => esc_html__('Set top border in px', 'Newsgamer'),
                "default" => 0,
                "min" => 0,
                "step" => 1,
                "max" => 10,
                'display_value' => 'text',
                //'compiler' => array('height' => '#top-navigation'),
                //'compiler' => array('Height' => '#top-navigation'),
            ),
            array(
                'id' => '_mp_typo_header_mainnav_border_bottom',
                'type' => 'slider',
                'title' => esc_html__('Menu Border Bottom', 'Newsgamer'),
                'subtitle' => esc_html__('Set top border in px', 'Newsgamer'),
                'description' => esc_html__('If you are using bottom border, you have to decrease line height of "Menu Links" for that border height', 'Newsgamer'),
                "default" => 5,
                "min" => 0,
                "step" => 1,
                "max" => 20,
                'display_value' => 'text',
                //'compiler' => array('height' => '#top-navigation'),
                //'compiler' => array('Height' => '#top-navigation'),
            ),
            array(
                'id' => '_mp_typo_header_mainnav_height',
                'type' => 'slider',
                'title' => esc_html__('Main Navigation Height', 'Newsgamer'),
                'subtitle' => esc_html__('Set Main Navigation height', 'Newsgamer'),
                'desc' => esc_html__('If you change this value, please change the "line-height" value for all the elements as well.', 'Newsgamer'),
                "default" => 50,
                "min" => 0,
                "step" => 1,
                "max" => 100,
                'display_value' => 'text',
                //'compiler' => array('height' => '#top-navigation'),
                //'compiler' => array('Height' => '#top-navigation'),
            ),

            array(
                'id'        => '_mp_typo_header_mainnav_links',
                'type'      => 'typography',
                'title'     => esc_html__('Menu Links', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#header-navigation ul li a'),
                'units'     =>'px',
                'text-transform'     => true,
                'color'       => false,
                'default'     => array(
                    'font-size'   => '14px',
                    'line-height' => '46px',
                    'font-weight' => '700',
                    //'color'       => '#ffffff',
                    'text-transform'    => 'uppercase',
                ),
            ),
            array(
                'id'       => '_mp_typo_header_mainnav_links_color',
                'type'     => 'link_color',
                'title'    => esc_html__('Menu Link Color', 'Newsgamer'),
                'subtitle' => esc_html__('Specify the Link color', 'Newsgamer'),
                'active'   => false,
                'visited'  => false,
                //'output'    => array('article.def h2 a'),
                'compiler'    => array('#header-navigation ul li a'),
                'default'  => array(
                    'regular'  => '#ffffff', // white
                    'hover'    => '#222222', // black
                )
            ),
            array(
                'id'       => '_mp_typo_header_mainnav_links_color_bg',
                'type'     => 'color',
                'title'    => esc_html__('Menu Link Hover Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for link hover on first level', 'Newsgamer'),
                'default'  => '#ffffff',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('background-color' => '#header-navigation ul li a:hover'),
                //'output'    => array('background-color' => '#page-header')
            ),
            array(
                'id'       => '_mp_typo_header_mainnav_links_padding',
                'type'     => 'spacing',
                'title'    => esc_html__('Menu Link Padding', 'Newsgamer'),
                'subtitle' => esc_html__('Set a padding on main navigation', 'Newsgamer'),
                'mode'      => 'padding',
                'units'     => 'px',
                'top'      => false,
                'bottom'     => false,
                'output'    => array('#header-navigation ul li a'),
                'default'            => array(
                    'padding-left'    => '18px',
                ),
            ),
            array(
                'id'        => '_mp_typo_header_mainsubnav_links',
                'type'      => 'typography',
                'title'     => esc_html__('Submenu Links', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#header-navigation .dropnav-container .dropnav-menu li > a'),
                'units'     =>'px',
                'text-transform'     => true,
                'color'       => false,
                'default'     => array(
                    'font-size'   => '14px',
                    'line-height' => '18px',
                    'font-weight' => '400',
                ),
            ),
            array(
                'id'       => '_mp_typo_header_mainsubnav_links_color',
                'type'     => 'link_color',
                'title'    => esc_html__('Submenu Link Color', 'Newsgamer'),
                'subtitle' => esc_html__('Specify the Link color', 'Newsgamer'),
                'active'   => false,
                'visited'  => false,
                //'output'    => array('article.def h2 a'),
                'compiler'    => array('#header-navigation .dropnav-container .dropnav-menu li > a'),
                'default'  => array(
                    'regular'  => '#444444', // white
                    'hover'    => '#222222', // black
                )
            ),
            array(
                'id'       => '_mp_typo_header_mainsubnav_links_color_bg',
                'type'     => 'color',
                'title'    => esc_html__('Menu Link Hover Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for link hover on first level', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('background-color' => '#header-navigation .dropnav-container .dropnav-menu li > a:hover'),
                //'output'    => array('background-color' => '#page-header')
            ),
            array(
                'id'       => '_mp_typo_header_mainnav_soc_links_color',
                'type'     => 'link_color',
                'title'    => esc_html__('Search & Social Link Color', 'Newsgamer'),
                'subtitle' => esc_html__('Specify the Link color', 'Newsgamer'),
                'active'   => false,
                'visited'  => false,
                //'output'    => array('article.def h2 a'),
                'compiler'    => array('#header-navigation ul li.soc-media a', '#header-navigation ul li.search-nav a i.fa'),
                'default'  => array(
                    'regular'  => '#bbbbbb', // white
                    'hover'    => '#222222', // black
                )
            ),

        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Mobile Navigation', 'Newsgamer' ),
        'id'     => '_mp_typo_header_mobile_nav',
        'customizer_width' => '450px',
        'subsection'       => true,
        'fields' => array(
            array(
                'id'       => '_mp_typo_header_mobilenav_bg',
                'type'     => 'color',
                'title'    => esc_html__('Menu Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a background-color', 'Newsgamer'),
                'default'  => '#444444',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('background-color' => '#page-header-mobile'),
                //'output'    => array('background-color' => '#page-header')
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Category Settings', 'Newsgamer' ),
        'id'               => '_mp_category_settings',
        'customizer_width' => '400px',
        'icon'             => 'el el-icon-folder-open',
        'fields'           => array(
            array(
                'id'       => '_mp_typo_category_bg',
                'type'     => 'background',
                'title'    => esc_html__('Background', 'Newsgamer'),
                'subtitle' => esc_html__('Set background for category layouts', 'Newsgamer'),
                'transparent' => false,
                'preview' => false,
                'compiler' => array('body.category'),
            ),
        )
    ) );

    $typosubcats[]          = array();
    $categories		    = 0;
    $category_args	    = array();
    $category_notice	= '';
    $categories_all 	= get_categories();
    $categories_parent 	= get_categories( array('parent' => 0) );

    if($categories_all && (count($categories_all) < 50)){
	    $categories	   = $categories_all;
    } else if($categories_parent && (count($categories_parent) < 50)){
    	$categories	       = $categories_parent;
    	$category_args	   = array('parent' => 0);
    	$category_notice   = ' (Only root categories because you have more than 50 categories in database)';
    }

    // Limit to 50 categories
    if($categories && (count($categories) < 50)) {

		$typosubcats[] = array(
		    'id'   => '_mpgl_cat_selection',
		    'title' => esc_html__( 'Select Category', 'Newsgamer' ),
		    'type'     => 'select',
		    'data'     => 'categories',
            'args'     => $category_args,
		);

        // Loop trought selected categories
        foreach($categories as $category) {

            $typosubcats[] = array(
                'id'        => '_mp_cat_'. $category->term_id .'_section_start',
                'type'      => 'section',
	            'title'      => $category->name,
                'indent'    => true, // Indent all options below until the next 'section' option is set.
                'required'  => array('_mpgl_cat_selection', "=", $category->term_id),
            );

            $typosubcats[] = array(
                'id'       => '_mp_typo_category_'. $category->term_id .'_bg',
                'type'     => 'background',
                'title'    => esc_html__('Background', 'Newsgamer'),
                'subtitle' => esc_html__('Set background for this category layout', 'Newsgamer'),
                'transparent' => false,
                'preview' => false,
                'compiler' => array('body.category-'. $category->term_id),
            );

        }

        Redux::setSection( $opt_name, array(
            'title'            => esc_html__( 'Customize Categories', 'Newsgamer' ),
            'id'               => '_mp_subcategory_settings',
            'customizer_width' => '450px',
            'subsection'       => true,
            'fields'           => $typosubcats
        ) );

    }


    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Content & Posts Settings', 'Newsgamer' ),
        'id'     => '_mp_typo_post_settings',
        'icon'   => 'el el-icon-file-edit',
        'fields' => array(
            array(
                'id'       => '_mp_typo_content_bg',
                'type'     => 'background',
                'title'    => esc_html__('Content Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a background color for content', 'Newsgamer'),
                'transparent' => false,
                'preview' => false,
                'default'  => array(
                    'background-color' => '#ffffff',
                ),
                'compiler' => array('#page-content'),
            ),
            array(
                'id'       => '_mp_typo_content_border',
                'type'     => 'color',
                'title'    => esc_html__('Content Border Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for border', 'Newsgamer'),
                'default'  => '#e9e9e9',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '#page-content'),
                //'output'    => array('background-color' => '#page-header')
            ),

        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Visual Composer Blocks', 'Newsgamer' ),
        'id'     => '_mp_typo_vc_bloks',
        'customizer_width' => '450px',
        'subsection'       => true,
        'fields' => array(
            array(
                'id'       => '_mp_typo_vc_block_type',
                'type'     => 'button_set',
                'title'    => esc_html__('VC Block Type', 'Newsgamer'),
                'subtitle' => esc_html__('Block display type', 'Newsgamer'),
                'options' => array(
                    ''  => 'None',
                    'vc-block-shadow' => 'Use Shadow',
                    'vc-block-border' => 'Use Border'
                 ),
                'default' => 'vc-block-shadow'
            ),
            array(
                'id'       => '_mp_typo_vc_block_type_border_color',
                'type'     => 'color',
                'title'    => esc_html__('Border Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for border', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.vc-block-border .shadow-ver-right, .vc-block-border .shadow-top-left'),
                'required' => array('_mp_typo_vc_block_type', "equals", 'vc-block-border')
            ),
            array(
                'id'    => '_mp_typo_vc_block_style_one',
                'type'  => 'info',
                'title' => esc_html__('Visual Composer Block Style One', 'Newsgamer'),
                'style' => 'warning',
                'desc'  => esc_html__('This is available only in "shadow" and "border" mode.', 'Newsgamer'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_one_bg',
                'type'     => 'color',
                'title'    => esc_html__('Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a background color', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('background-color' => '.vc-block-fx .col-style-one, .vc-block-fx .col-style-one header, .vc-block-fx #page-content .has-header.col-style-one header, .vc-block-fx .col-item-style-one .shadow-box:first-child'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_one_header_color',
                'type'     => 'color',
                'title'    => esc_html__('Header Title Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for header title', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-one header h2'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_one_header_border',
                'type'     => 'color',
                'title'    => esc_html__('Header Border Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for border', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.vc-block-fx #page-content .has-header.col-style-one header h2, .vc-block-fx #page-content .col-style-one header h2'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_one_post_title_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Title Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post title', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-one article.def h3 a, .vc-block-fx .col-item-style-one .shadow-box:first-child article.def h3 a'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_one_post_category_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Category Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post category', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-one article.def .entry-category a, .vc-block-fx .col-item-style-one .shadow-box:first-child article.def .entry-category a'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_one_post_meta_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Meta Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post meta', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-one article.def .entry-meta, .vc-block-fx .col-item-style-one .shadow-box:first-child article.def .entry-meta'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_one_post_text_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Text Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post text', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-one article.def .text, .vc-block-fx .col-item-style-one .shadow-box:first-child article.def .text'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_one_post_ajax_nav_arrow_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Ajax Navigation Arrow Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post navigation arrow', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-one .mip-ajax-nav a'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_one_post_ajax_nav_arrow_border',
                'type'     => 'color',
                'title'    => esc_html__('Post Ajax Navigation Border Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post navigation border', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.vc-block-fx .col-style-one .mip-ajax-nav a'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),

            array(
                'id'    => '_mp_typo_vc_block_style_two',
                'type'  => 'info',
                'title' => esc_html__('Visual Composer Block Style Two', 'Newsgamer'),
                'style' => 'warning',
                'desc'  => esc_html__('This is available only in "shadow" and "border" mode.', 'Newsgamer'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_two_bg',
                'type'     => 'color',
                'title'    => esc_html__('Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a background color', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('background-color' => '.vc-block-fx .col-style-two, .vc-block-fx .col-style-two header, .vc-block-fx #page-content .has-header.col-style-two header, .vc-block-fx .col-item-style-two .shadow-box:first-child'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_two_header_color',
                'type'     => 'color',
                'title'    => esc_html__('Header Title Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for header title', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-two header h2'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_two_header_border',
                'type'     => 'color',
                'title'    => esc_html__('Header Border Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for border', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.vc-block-fx #page-content .has-header.col-style-two header h2, .vc-block-fx #page-content .col-style-two header h2'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_two_post_title_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Title Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post title', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-two article.def h3 a, .vc-block-fx .col-item-style-two .shadow-box:first-child article.def h3 a'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_two_post_category_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Category Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post category', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-two article.def .entry-category a, .vc-block-fx .col-item-style-two .shadow-box:first-child article.def .entry-category a'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_two_post_meta_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Meta Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post meta', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-two article.def .entry-meta, .vc-block-fx .col-item-style-two .shadow-box:first-child article.def .entry-meta'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_two_post_text_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Text Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post text', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-two article.def .text, .vc-block-fx .col-item-style-two .shadow-box:first-child article.def .text'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_two_post_ajax_nav_arrow_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Ajax Navigation Arrow Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post navigation arrow', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-two .mip-ajax-nav a'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_two_post_ajax_nav_arrow_border',
                'type'     => 'color',
                'title'    => esc_html__('Post Ajax Navigation Border Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post navigation border', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.vc-block-fx .col-style-two .mip-ajax-nav a'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),

            array(
                'id'    => '_mp_typo_vc_block_style_three',
                'type'  => 'info',
                'title' => esc_html__('Visual Composer Block Style Three', 'Newsgamer'),
                'style' => 'warning',
                'desc'  => esc_html__('This is available only in "shadow" and "border" mode.', 'Newsgamer'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_three_bg',
                'type'     => 'color',
                'title'    => esc_html__('Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a background color', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('background-color' => '.vc-block-fx .col-style-three, .vc-block-fx .col-style-three header, .vc-block-fx #page-content .has-header.col-style-three header, .vc-block-fx .col-item-style-three .shadow-box:first-child'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_three_header_color',
                'type'     => 'color',
                'title'    => esc_html__('Header Title Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for header title', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-three header h2'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_three_header_border',
                'type'     => 'color',
                'title'    => esc_html__('Header Border Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for border', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.vc-block-fx #page-content .has-header.col-style-three header h2, .vc-block-fx #page-content .col-style-three header h2'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_three_post_title_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Title Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post title', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-three article.def h3 a, .vc-block-fx .col-item-style-three .shadow-box:first-child article.def h3 a'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_three_post_category_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Category Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post category', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-three article.def .entry-category a, .vc-block-fx .col-item-style-three .shadow-box:first-child article.def .entry-category a'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_three_post_meta_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Meta Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post meta', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-three article.def .entry-meta, .vc-block-fx .col-item-style-three .shadow-box:first-child article.def .entry-meta'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_three_post_text_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Text Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post text', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-three article.def .text, .vc-block-fx .col-item-style-three .shadow-box:first-child article.def .text'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_three_post_ajax_nav_arrow_color',
                'type'     => 'color',
                'title'    => esc_html__('Post Ajax Navigation Arrow Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post navigation arrow', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('color' => '.vc-block-fx .col-style-three .mip-ajax-nav a'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
            array(
                'id'       => '_mp_typo_vc_block_style_three_post_ajax_nav_arrow_border',
                'type'     => 'color',
                'title'    => esc_html__('Post Ajax Navigation Border Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for post navigation border', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.vc-block-fx .col-style-three .mip-ajax-nav a'),
                'required' => array('_mp_typo_vc_block_type', "=", array('vc-block-shadow', 'vc-block-border')),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Posts Standard Layouts', 'Newsgamer' ),
        'id'     => '_mp_typo_post_layouts',
        'customizer_width' => '450px',
        'subsection'       => true,
        'fields' => array(
            array(
                'id'        => '_mp_typo_post_layout_h2',
                'type'      => 'typography',
                'title'     => esc_html__('Heading H2', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('article.def h2'),
                'units'     =>'px',
                'color'     => false,
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '28px',
                    'line-height' => '36px'
                ),
            ),
            array(
                'id'       => '_mp_typo_post_layout_h2_link',
                'type'     => 'link_color',
                'title'    => esc_html__('Heading H2 Link Color', 'Newsgamer'),
                'subtitle' => esc_html__('Specify the Link color', 'Newsgamer'),
                'active'   => false,
                'visited'  => false,
                //'output'    => array('article.def h2 a'),
                'compiler'    => array('article.def h2 a'),
                'default'  => array(
                    'regular'  => '#222222', // blue
                    'hover'    => '#222222', // red
                )
            ),
            array(
                'id'        => '_mp_typo_post_layout_h3',
                'type'      => 'typography',
                'title'     => esc_html__('Heading H3', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'  => array('article.def h3'),
                'units'     =>'px',
                'color'     => false,
                'text-transform'     => true,
                'default'   => array(
                    'font-size'   => '18px',
                    'line-height' => '24px'
                ),
            ),
            array(
                'id'       => '_mp_typo_post_layout_h3_link',
                'type'     => 'link_color',
                'title'    => esc_html__('Heading H3 Link Color', 'Newsgamer'),
                'subtitle' => esc_html__('Specify the Link color', 'Newsgamer'),
                'active'   => false,
                'visited'  => false,
                //'output'    => array('article.def h3 a'),
                'compiler'    => array('article.def h3 a'),
                'default'  => array(
                    'regular'  => '#222222', // blue
                    'hover'    => '#222222', // red
                )
            ),
            array(
                'id'        => '_mp_typo_post_layout_postmeta',
                'type'      => 'typography',
                'title'     => esc_html__('Post Meta Elements', 'Newsgamer'),
                'subtitle'  => esc_html__('Date, Author, Comments, Views...', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'  => array('article.def div.entry-meta, article.def div.entry-meta a'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'   => array(
                    'font-size' => '12px',
                    'color'     => '#999'
                ),
            ),
            array(
                'id'        => '_mp_typo_post_layout_category',
                'type'      => 'typography',
                'title'     => esc_html__('Post Category', 'Newsgamer'),
                'subtitle'  => esc_html__('Date, Author, Comments, Views...', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'  => array('article.def span.entry-category'),
                'units'     =>'px',
                'color'     => false,
                'text-transform'     => true,
                'default'   => array(
                    'font-size' => '12px',
                    'text-transform'     => 'uppercase',
                ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Posts Image Layouts', 'Newsgamer' ),
        'id'     => '_mp_typo_post_image_layouts',
        'customizer_width' => '450px',
        'subsection'       => true,
        'fields' => array(
            array(
                'id'        => '_mp_typo_post_image_layout_h2',
                'type'      => 'typography',
                'title'     => esc_html__('Heading H2', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('article.def-overlay h2'),
                'units'     =>'px',
                'color'     => false,
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '28px',
                    'line-height' => '36px',
                    'text-align' => 'left',
                ),
            ),
            array(
                'id'       => '_mp_typo_post_image_layout_h2_link',
                'type'     => 'link_color',
                'title'    => esc_html__('Heading H2 Link Color', 'Newsgamer'),
                'subtitle' => esc_html__('Specify the Link color', 'Newsgamer'),
                'active'   => false,
                'visited'  => false,
                //'output'    => array('article.def h2 a'),
                'compiler'    => array('article.def-overlay h2 a'),
                'default'  => array(
                    'regular'  => '#ffffff', // blue
                    'hover'    => '#ffffff', // red
                )
            ),
            array(
                'id'        => '_mp_typo_post_image_layout_h3',
                'type'      => 'typography',
                'title'     => esc_html__('Heading H3', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'  => array('article.def-overlay h3'),
                'units'     =>'px',
                'color'     => false,
                'text-transform'     => true,
                'default'   => array(
                    'font-size'   => '18px',
                    'line-height' => '24px',
                    'text-align' => 'left',
                ),
            ),
            array(
                'id'       => '_mp_typo_post_image_layout_h3_link',
                'type'     => 'link_color',
                'title'    => esc_html__('Heading H3 Link Color', 'Newsgamer'),
                'subtitle' => esc_html__('Specify the Link color', 'Newsgamer'),
                'active'   => false,
                'visited'  => false,
                //'output'    => array('article.def h3 a'),
                'compiler'    => array('article.def-overlay h3 a'),
                'default'  => array(
                    'regular'  => '#ffffff', // blue
                    'hover'    => '#ffffff', // red
                )
            ),
            array(
                'id'        => '_mp_typo_post_image_layout_postmeta',
                'type'      => 'typography',
                'title'     => esc_html__('Post Meta Elements', 'Newsgamer'),
                'subtitle'  => esc_html__('Date, Author, Comments, Views...', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'  => array('article.def-overlay div.entry-meta'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'   => array(
                    'font-size' => '12px',
                    'color'     => '#999'
                ),
            ),
            array(
                'id'        => '_mp_typo_post_image_layout_category',
                'type'      => 'typography',
                'title'     => esc_html__('Post Category', 'Newsgamer'),
                'subtitle'  => esc_html__('Date, Author, Comments, Views...', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'  => array('article.def-overlay span.entry-category'),
                'units'     =>'px',
                'color'     => false,
                'text-transform'     => true,
                'default'   => array(
                    'font-size' => '12px',
                    'text-align' => 'left',
                    'text-transform'     => 'uppercase',
                ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Posts Article', 'Newsgamer' ),
        'id'     => '_mp_typo_post_article',
        'customizer_width' => '450px',
        'subsection'       => true,
        'fields' => array(
            array(
                'id'        => '_mp_typo_post_article_h1',
                'type'      => 'typography',
                'title'     => esc_html__('Heading H1', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.article-post header h1'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '40px',
                    'line-height' => '50px',
                    'font-weight' => '400',
                    'color'       => '#222222',
                ),
            ),
            array(
                'id'        => '_mp_typo_post_article_h2',
                'type'      => 'typography',
                'title'     => esc_html__('Heading H2', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.article-post h2'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '26px',
                    'line-height' => '30px',
                    'color'       => '#222222',
                ),
            ),
            array(
                'id'        => '_mp_typo_post_article_h3',
                'type'      => 'typography',
                'title'     => esc_html__('Heading H3', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.article-post h3'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '22px',
                    'line-height' => '26px',
                    'color'       => '#222222',
                ),
            ),
            array(
                'id'        => '_mp_typo_post_article_h4',
                'type'      => 'typography',
                'title'     => esc_html__('Heading H4', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.article-post h4'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '18px',
                    'line-height' => '24px',
                    'color'       => '#222222',
                ),
            ),
            array(
                'id'        => '_mp_typo_post_article_h5',
                'type'      => 'typography',
                'title'     => esc_html__('Heading H5', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.article-post h5'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '16px',
                    'line-height' => '20px',
                    'color'       => '#222222',
                ),
            ),
            array(
                'id'        => '_mp_typo_post_article_h6',
                'type'      => 'typography',
                'title'     => esc_html__('Heading H6', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.article-post h6'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '14px',
                    'line-height' => '18px',
                    'color'       => '#222222',
                ),
            ),
            array(
                'id'        => '_mp_typo_post_article_p',
                'type'      => 'typography',
                'title'     => esc_html__('Article Content (paragraph)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.article-post .article-post-content'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '15px',
                    'line-height' => '24px',
                    'color'       => '#5c5c5c',
                ),
            ),
            array(
                'id'        => '_mp_typo_post_article_lead',
                'type'      => 'typography',
                'title'     => esc_html__('Article Content Lead (Post Format)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.article-post .article-post-content .lead'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '22px',
                ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Author Box', 'Newsgamer' ),
        'id'     => '_mp_typo_post_author',
        'customizer_width' => '450px',
        'subsection'       => true,
        'fields' => array(
            array(
                'id'       => '_mp_typo_post_author_bg',
                'type'     => 'color',
                'title'    => esc_html__('Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for box background', 'Newsgamer'),
                'default'  => '#f9f9f9',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('background-color' => '.author-box'),
                //'output'    => array('background-color' => '.author-box')
            ),
            array(
                'id'        => '_mp_typo_post_author_name',
                'type'      => 'typography',
                'title'     => esc_html__('Author Name', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.author-box p.name'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '20px',
                ),
            ),
            array(
                'id'       => '_mp_typo_post_author_name_link',
                'type'     => 'link_color',
                'title'    => esc_html__('Author Name Link', 'Newsgamer'),
                'subtitle' => esc_html__('Specify the Link color', 'Newsgamer'),
                'active'   => false,
                'visited'  => false,
                'compiler'    => array('.author-box p.name a'),
                'default'  => array(
                    'regular'  => '#222222', // blue
                    'hover'    => '#222222', // red
                )
            ),
            array(
                'id'        => '_mp_typo_post_author_desc',
                'type'      => 'typography',
                'title'     => esc_html__('Author Description', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.author-box p.desc'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'color'   => '#5c5c5c',
                ),
            ),
            array(
                'id'       => '_mp_typo_post_author_soc_links',
                'type'     => 'color',
                'title'    => esc_html__('Author Social Links Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a background color', 'Newsgamer'),
                'validate' => 'color',
                'transparent' => false,
                'default'  => '#5a5a5a',
                'compiler' => array('background-color' => '.author-box p.follow a')
            ),

        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Reviews & Review Box', 'Newsgamer' ),
        'id'     => '_mp_typo_post_review',
        'customizer_width' => '450px',
        'subsection'       => true,
        'fields' => array(
            array(
                'id'       => '_mp_typo_content_meter_gauge_border',
                'type'     => 'color',
                'title'    => esc_html__('Review Gauge Meter Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for review gauge color', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.meter-wrapper .meter'),
                //'output'    => array('background-color' => '#page-header')
            ),
            array(
                'id'       => '_mp_typo_content_meter_gauge_styling',
                'type'     => 'switch',
                'title'    => esc_html__('Enable Gauge colors by value', 'Newsgamer'),
                'subtitle' => esc_html__('Assing color to value', 'Newsgamer'),
                'default'  => 0,
            ),
            array(
                'id'       => '_mp_typo_content_meter_gauge_style_1',
                'type'     => 'color',
                'title'    => esc_html__('Review Gauge Meter Color (Value = 1)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for value = 1', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.review-score-1 .meter-wrapper .meter, body .article-post .review.review-score-1'),
                'required'  => array('_mp_typo_content_meter_gauge_styling', "=", '1'),
            ),
            array(
                'id'       => '_mp_typo_content_meter_gauge_style_2',
                'type'     => 'color',
                'title'    => esc_html__('Review Gauge Meter Color (Value = 2)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for value = 2', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.review-score-2 .meter-wrapper .meter, body .article-post .review.review-score-2'),
                'required'  => array('_mp_typo_content_meter_gauge_styling', "=", '1'),
            ),
            array(
                'id'       => '_mp_typo_content_meter_gauge_style_3',
                'type'     => 'color',
                'title'    => esc_html__('Review Gauge Meter Color (Value = 3)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for value = 3', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.review-score-3 .meter-wrapper .meter, body .article-post .review.review-score-3'),
                'required'  => array('_mp_typo_content_meter_gauge_styling', "=", '1'),
            ),
            array(
                'id'       => '_mp_typo_content_meter_gauge_style_4',
                'type'     => 'color',
                'title'    => esc_html__('Review Gauge Meter Color (Value = 4)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for value = 4', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.review-score-4 .meter-wrapper .meter, body .article-post .review.review-score-4'),
                'required'  => array('_mp_typo_content_meter_gauge_styling', "=", '1'),
            ),
            array(
                'id'       => '_mp_typo_content_meter_gauge_style_5',
                'type'     => 'color',
                'title'    => esc_html__('Review Gauge Meter Color (Value = 5)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for value = 5', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.review-score-5 .meter-wrapper .meter, body .article-post .review.review-score-5'),
                'required'  => array('_mp_typo_content_meter_gauge_styling', "=", '1'),
            ),
            array(
                'id'       => '_mp_typo_content_meter_gauge_style_6',
                'type'     => 'color',
                'title'    => esc_html__('Review Gauge Meter Color (Value = 6)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for value = 6', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.review-score-6 .meter-wrapper .meter, body .article-post .review.review-score-6'),
                'required'  => array('_mp_typo_content_meter_gauge_styling', "=", '1'),
            ),
            array(
                'id'       => '_mp_typo_content_meter_gauge_style_7',
                'type'     => 'color',
                'title'    => esc_html__('Review Gauge Meter Color (Value = 7)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for value = 7', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.review-score-7 .meter-wrapper .meter, body .article-post .review.review-score-7'),
                'required'  => array('_mp_typo_content_meter_gauge_styling', "=", '1'),
            ),
            array(
                'id'       => '_mp_typo_content_meter_gauge_style_8',
                'type'     => 'color',
                'title'    => esc_html__('Review Gauge Meter Color (Value = 8)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for value = 8', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.review-score-8 .meter-wrapper .meter, body .article-post .review.review-score-8'),
                'required'  => array('_mp_typo_content_meter_gauge_styling', "=", '1'),
            ),
            array(
                'id'       => '_mp_typo_content_meter_gauge_style_9',
                'type'     => 'color',
                'title'    => esc_html__('Review Gauge Meter Color (Value = 9)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for value = 9', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.review-score-9 .meter-wrapper .meter, body .article-post .review.review-score-9'),
                'required'  => array('_mp_typo_content_meter_gauge_styling', "=", '1'),
            ),
            array(
                'id'       => '_mp_typo_content_meter_gauge_style_10',
                'type'     => 'color',
                'title'    => esc_html__('Review Gauge Meter Color (Value = 10)', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for value = 10', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.review-score-10 .meter-wrapper .meter, body .article-post .review.review-score-10'),
                'required'  => array('_mp_typo_content_meter_gauge_styling', "=", '1'),
            ),

            array(
                'id'        => '_mp_typo_post_review_info',
                'type'  => 'info',
                'title'     => esc_html__('Review Box', 'Newsgamer'),
            ),

            array(
                'id'       => '_mp_typo_post_review_bg',
                'type'     => 'color',
                'title'    => esc_html__('Review Box Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for box background', 'Newsgamer'),
                'default'  => '#efefef',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('background-color' => '.article-post .review')
            ),
            array(
                'id'       => '_mp_typo_post_review_bordercolor',
                'type'     => 'color',
                'title'    => esc_html__('Review Box Border Color', 'Newsgamer'),
                'subtitle' => esc_html__('Set border for box background', 'Newsgamer'),
                'description' => esc_html__('If none is selected, it will use colors for Gauge meter values', 'Newsgamer'),
                'default'  => '#f1a602',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => 'body .article-post .review')
            ),
            array(
                'id'        => '_mp_typo_post_review_title',
                'type'      => 'typography',
                'title'     => esc_html__('Review Title', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.article-post .review h4'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '18px',
                    'line-height' => '24px',
                    'color'       => '#222222',
                ),
            ),
            array(
                'id'       => '_mp_typo_post_review_title_border',
                'type'     => 'color',
                'title'    => esc_html__('Review Title Border Color', 'Newsgamer'),
                'subtitle' => esc_html__('Set border for review title section', 'Newsgamer'),
                'default'  => '#dadada',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.article-post .review h4')
            ),
            array(
                'id'        => '_mp_typo_post_review_p',
                'type'      => 'typography',
                'title'     => esc_html__('Review Content (paragraph & list)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties.', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.article-post .review ul', '.article-post .review p', '.article-post .review li i.fa'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '14px',
                    'line-height' => '20px',
                    'color'       => '#777777',
                ),
            ),
            array(
                'id'       => '_mp_typo_post_review_progress_bg',
                'type'     => 'color',
                'title'    => esc_html__('Progress Bar Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for background', 'Newsgamer'),
                'default'  => '#ffffff',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('background-color' => '.article-post .progress')
            ),
            array(
                'id'       => '_mp_typo_post_review_progress_color',
                'type'     => 'color',
                'title'    => esc_html__('Progress Bar Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color', 'Newsgamer'),
                'default'  => '#444444',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('background-color' => '.article-post .progress-bar')
            ),



        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Sidebar Settings', 'Newsgamer' ),
        'id'     => '_mp_typo_sidebar_settings',
        'icon'   => 'el el-icon-retweet',
        'fields' => array(
            array(
                'id'       => '_mp_typo_sidebar_bg',
                'type'     => 'background',
                'title'    => esc_html__('Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for sidebar', 'Newsgamer'),
                'transparent' => false,
                'preview' => false,
                'default'  => array(
                    'background-color' => '#ffffff',
                ),
                'compiler' => array('.sidebar'),
                //'output'    => array('background-color' => '#page-header')
            ),
            array(
                'id'       => '_mp_typo_sidebar_shadow',
                'type'     => 'switch',
                'title'    => esc_html__('Sidebar Shadow', 'Newsgamer'),
                'subtitle' => esc_html__('Use sidebar shadow', 'Newsgamer'),
                'default'  => 0,
            ),
            array(
                'id'       => '_mp_typo_sidebar_border',
                'type'     => 'switch',
                'title'    => esc_html__('Sidebar Border', 'Newsgamer'),
                'subtitle' => esc_html__('Use sidebar border', 'Newsgamer'),
                'default'  => 1,
            ),
            array(
                'id'       => '_mp_typo_sidebar_border_color',
                'type'     => 'color',
                'title'    => esc_html__('Sidebar Border Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for border', 'Newsgamer'),
                'default' => '#e9e9e9',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.sidebar-border .sidebar'),
                'required' => array('_mp_typo_sidebar_border', "equals", '1')
            ),
            array(
                'id'        => '_mp_typo_sidebar_font',
                'type'      => 'typography',
                'title'     => esc_html__('Sidebar Font', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify default font properties for sidebar', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.sidebar'),
                'units'     =>'px',
                'text-transform'     => true,
            ),
            array(
                'id'        => '_mp_typo_sidebar_section_titles',
                'type'      => 'typography',
                'title'     => esc_html__('Sidebar Section Titles', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.sidebar .widget .title'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '15px',
                    'line-height' => '30px',
                    'font-weight' => '700',
                    'color'       => '#333333',
                    'text-transform'    => 'uppercase',
                ),
            ),
            array(
                'id'       => '_mp_typo_sidebar_section_titles_border_span',
                'type'     => 'color',
                'title'    => esc_html__('Sidebar Section Titles Border', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for border', 'Newsgamer'),
                'default'  => '#333333',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('background-color' => '.sidebar .widget .title span:after'),
                //'output'    => array('background-color' => '#page-header')
            ),
            /*array(
                'id'       => '_mp_typo_sidebar_section_titles_border',
                'type'     => 'color',
                'title'    => esc_html__('Sidebar Section Titles Border 2', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for border', 'Newsgamer'),
                'default'  => '#dedede',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '.sidebar .widget .title'),
                //'output'    => array('background-color' => '#page-header')
            ),*/

            array(
                'id'        => '_mp_typo_sidebar_section_links_h2',
                'type'      => 'typography',
                'title'     => esc_html__('Post Links (Title on images)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.sidebar article.def .overlay h2 a'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '18px',
                    'line-height' => '20px',
                    'color'       => '#ffffff',
                ),
            ),
            array(
                'id'        => '_mp_typo_sidebar_section_links_h3',
                'type'      => 'typography',
                'title'     => esc_html__('Post Links (Title)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.sidebar .widget article.def h3 a'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '15px',
                    'line-height' => '18px',
                    'font-weight' => '700',
                    'color'       => '#444444',
                ),
            ),
            array(
                'id'        => '_mp_typo_sidebar_section_links_category',
                'type'      => 'typography',
                'title'     => esc_html__('Post Links (Category)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.sidebar .widget article.def span.entry-category a'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '11px',
                    'color'       => '#444444',
                    'text-transform'    => 'uppercase',
                ),
            ),
            array(
                'id'        => '_mp_typo_sidebar_section_links_postmeta',
                'type'      => 'typography',
                'title'     => esc_html__('Post Meta (Date, Comments...)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('.sidebar .widget article.def div.entry-meta, .sidebar .module-timeline article span.published, .sidebar .module-timeline article span.published-time'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '10px',
                    'color'       => '#999999',
                ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Footer Settings', 'Newsgamer' ),
        'id'     => '_mp_typo_footer_top_settings',
        'icon'   => 'el el el-download-alt',
        'fields' => array(
            array(
                'id'       => '_mp_typo_footer_bg',
                'type'     => 'background',
                'title'    => esc_html__('Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for background', 'Newsgamer'),
                'transparent' => false,
                'preview' => false,
                'compiler' => array('#page-footer'),
                //'output'    => array('background-color' => '#page-header')
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Top Section', 'Newsgamer' ),
        'id'     => '_mp_typo_footer_settings_top',
        'customizer_width' => '450px',
        'subsection'       => true,
        'fields' => array(
            array(
                'id'       => '_mp_typo_footer_top_bg',
                'type'     => 'background',
                'title'    => esc_html__('Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for sidebar', 'Newsgamer'),
                'transparent' => false,
                'preview' => false,
                'default'  => array(
                    'background-color' => '#444444',
                ),
                'compiler' => array('#footer-section-top'),
                //'output'    => array('background-color' => '#page-header')
            ),

            array(
                'id'       => '_mp_typo_footer_top_border_color',
                'type'     => 'color',
                'title'    => esc_html__('Border Color between columns', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for border', 'Newsgamer'),
                'default' => '#555555',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '#footer-section-top .col'),
            ),
            array(
                'id'        => '_mp_typo_footer_top_font',
                'type'      => 'typography',
                'title'     => esc_html__('Top Section Font', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify default font properties for top section', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#footer-section-top'),
                'units'     =>'px',
                'text-transform'     => true,
            ),
            array(
                'id'        => '_mp_typo_footer_top_section_titles',
                'type'      => 'typography',
                'title'     => esc_html__('Top Section Titles', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#footer-section-top aside.widget header .title, #footer-section-top aside.widget header .title a'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '15px',
                    'line-height' => '30px',
                    'font-weight' => '700',
                    'color'       => '#ffffff',
                ),
            ),

            array(
                'id'        => '_mp_typo_footer_top_section_links_h3',
                'type'      => 'typography',
                'title'     => esc_html__('Post Links (Title)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#footer-section-top article.def h3 a'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '15px',
                    'line-height' => '18px',
                    'font-weight' => '700',
                    'color'       => '#ffffff',
                ),
            ),
            array(
                'id'        => '_mp_typo_footer_top_section_links_category',
                'type'      => 'typography',
                'title'     => esc_html__('Post Links (Category)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#footer-section-top aside.widget span.category a'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '11px',
                    'color'       => '#aaaaaa',
                    'text-transform'    => 'uppercase',
                ),
            ),
            array(
                'id'        => '_mp_typo_footer_top_section_links_postmeta',
                'type'      => 'typography',
                'title'     => esc_html__('Post Meta (Date, Comments...)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#footer-section-top .widget article.def div.entry-meta, #footer-section-top .module-timeline article span.published, #footer-section-top .module-timeline article span.published-time'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '10px',
                    'color'       => '#999999',
                ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Bottom Section', 'Newsgamer' ),
        'id'     => '_mp_typo_footer_bottom_settings',
        'customizer_width' => '450px',
        'subsection'       => true,
        'fields' => array(
            array(
                'id'       => '_mp_typo_footer_bottom_bg',
                'type'     => 'background',
                'title'    => esc_html__('Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for sidebar', 'Newsgamer'),
                'transparent' => false,
                'preview' => false,
                'default'  => array(
                    'background-color' => '#303030',
                ),
                'compiler' => array('#page-footer'),
                //'output'    => array('background-color' => '#page-header')
            ),

            /*array(
                'id'       => '_mp_typo_footer_bottom_border_color',
                'type'     => 'color',
                'title'    => esc_html__('Border Color between columns', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for border', 'Newsgamer'),
                'default' => '#555555',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '#footer-section-bottom .col'),
            ),*/
            array(
                'id'        => '_mp_typo_footer_bottom_font',
                'type'      => 'typography',
                'title'     => esc_html__('Bottom Section Font', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify default font properties for top section', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#footer-section-bottom'),
                'units'     =>'px',
                'text-transform'     => true,
            ),
            array(
                'id'        => '_mp_typo_footer_bottom_section_titles',
                'type'      => 'typography',
                'title'     => esc_html__('Bottom Section Titles', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#footer-section-bottom aside.widget header .title, #footer-section-bottom aside.widget header .title a'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '15px',
                    'line-height' => '30px',
                    'font-weight' => '700',
                    'color'       => '#ffffff',
                ),
            ),

            array(
                'id'        => '_mp_typo_footer_bottom_section_links_h3',
                'type'      => 'typography',
                'title'     => esc_html__('Post Links (Title)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#footer-section-bottom article.def h3 a'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '15px',
                    'line-height' => '18px',
                    'font-weight' => '700',
                    'color'       => '#ffffff',
                ),
            ),
            array(
                'id'        => '_mp_typo_footer_bottom_section_links_category',
                'type'      => 'typography',
                'title'     => esc_html__('Post Links (Category)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#footer-section-bottom aside.widget span.category a'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '11px',
                    'color'       => '#aaaaaa',
                    'text-transform'    => 'uppercase',
                ),
            ),
            array(
                'id'        => '_mp_typo_footer_bottom_section_links_postmeta',
                'type'      => 'typography',
                'title'     => esc_html__('Post Meta (Date, Comments...)', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#footer-section-bottom .widget article.def div.entry-meta, #footer-section-bottom .module-timeline article span.published, #footer-section-bottom .module-timeline article span.published-time'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '10px',
                    'color'       => '#999999',
                ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Copyright Section', 'Newsgamer' ),
        'id'     => '_mp_typo_footer_copyright_settings',
        'customizer_width' => '450px',
        'subsection'       => true,
        'fields' => array(
            array(
                'id'       => '_mp_typo_footer_copy_bg',
                'type'     => 'background',
                'title'    => esc_html__('Background Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a color for background', 'Newsgamer'),
                'transparent' => false,
                'preview' => false,
                'default'  => array(
                    'background-color' => '#393939',
                ),
                'compiler' => array('#page-footer .copyright'),
                //'output'    => array('background-color' => '#page-header')
            ),
            array(
                'id'       => '_mp_typo_footer_copy_border',
                'type'     => 'color',
                'title'    => esc_html__('Top Border Color', 'Newsgamer'),
                'subtitle' => esc_html__('Pick a border', 'Newsgamer'),
                'default'  => '#393939',
                'validate' => 'color',
                'transparent' => false,
                'compiler' => array('border-color' => '#page-footer .copyright'),
                //'output'    => array('background-color' => '#page-header')
            ),
            array(
                'id'        => '_mp_typo_footer_copy_font',
                'type'      => 'typography',
                'title'     => esc_html__('Font style', 'Newsgamer'),
                'subtitle'  => esc_html__('Specify the font properties', 'Newsgamer'),
                'google'    => $google_fonts,
                'compiler'    => array('#page-footer .copyright'),
                'units'     =>'px',
                'text-transform'     => true,
                'default'     => array(
                    'font-size'   => '13px',
                    'line-height' => '20px',
                    'color'       => '#777777',
                ),
            ),
            array(
                'id'       => '_mp_typo_footer_copy_links_color',
                'type'     => 'link_color',
                'title'    => esc_html__('Link Color', 'Newsgamer'),
                'subtitle' => esc_html__('Specify the Link color', 'Newsgamer'),
                'active'   => false,
                'visited'  => false,
                //'output'    => array('article.def h2 a'),
                'compiler'    => array('#page-footer .copyright a'),
                'default'  => array(
                    'regular'  => '#bbbbbb', // white
                    'hover'    => '#ffffff', // black
                )
            ),
        )
    ) );





    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {

            // Save to database
            if ( $css ) mipthemeframework_set_option_css( '_miptheme_typography_css', $css );

            /*$filename = dirname(__FILE__) . '/../assets/css/typography' . '.css';
    	    global $wp_filesystem;

    	    if( empty( $wp_filesystem ) ) {
        		require_once( ABSPATH .'/wp-admin/includes/file.php' );
        		WP_Filesystem();
    	    }

    	    if( $wp_filesystem ) {
        		$wp_filesystem->put_contents(
        		    $filename,
        		    $css,
        		    FS_CHMOD_FILE // predefined mode settings for WP files
        		);
    	    }*/
        }
    }
