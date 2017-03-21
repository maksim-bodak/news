<?php

$args   = array( 'post_type' => 'mp_ads', 'meta_value' => 'standard-display', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'no_found_rows'         => true, );
$r      = new WP_Query( $args );
$ads 	= array();
while ( $r->have_posts() ) : $r->the_post();
	$data = array( get_the_ID() => get_the_title() );
	$ads[] = $data;
	//echo '<option value="'. get_the_ID() .'"'. ( ( esc_attr( $ad_source ) == get_the_ID() ) ? ' selected' : '' ) .'>'. get_the_title() .'</option>';
endwhile;
wp_reset_postdata();

$ads_select = array();
for($i=0;$i<count($ads);$i++)
{
    $ads_select += $ads[$i];
}

$miptheme_shortcode['miptheme_adssystem'] = array(
	'no_preview' => true,
	'params' => array(
		'ad' => array(
			'type' 		=> 'select',
			'label' 	=> esc_html__('Ad Source', 'Newsgamer'),
			'desc' 		=> esc_html__('Select Ad from Ads System', 'Newsgamer'),
			'options' 	=> $ads_select
		),
		'align' => array(
			'type' 		=> 'select',
			'label' 	=> esc_html__('Ad Align', 'Newsgamer'),
			'desc' 		=> esc_html__('Specify Ad alignment', 'Newsgamer'),
			'options' 	=> array(
				'none' 		=> 'none',
				'left' 		=> 'left',
				'right' 	=> 'right',
				'center' 	=> 'center',
			)
		),
		'hidemobile' => array(
			'type' 		=> 'select',
			'label' 	=> esc_html__('Hide on mobile', 'Newsgamer'),
			'desc' 		=> esc_html__('Hide this Ad on mobile devices', 'Newsgamer'),
			'options' 	=> array(
				'no' 		=> 'No',
				'yes' 		=> 'Yes',
			)
		),
	),
	'shortcode' => '[miptheme_adssystem ad="{{ad}}" align="{{align}}" hide_on_mobile="{{hidemobile}}"][/miptheme_adssystem]',
	'popup_title' => esc_html__('Insert Ads System Shortcode', 'Newsgamer')
);

$miptheme_shortcode['miptheme_alert'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' 		=> 'select',
			'label' 	=> esc_html__('Alert Type', 'Newsgamer'),
			'desc' 		=> esc_html__('Select Alert Type', 'Newsgamer'),
			'options' 	=> array(
				'warning' 	=> 'warning',
				'success' 	=> 'success',
				'danger' 	=> 'error',
				'info' 		=> 'info',
			)
		),
		'content' => array(
			'std' => 'Alert Message',
			'type' => 'textarea',
			'label' => esc_html__('Alert Text', 'Newsgamer'),
			'desc' => esc_html__('Alert Text', 'Newsgamer'),
		),
		'close' => array(
			'type' 		=> 'select',
			'label' 	=> esc_html__('Closable', 'Newsgamer'),
			'desc' 		=> esc_html__('Select if alert can be closed or not', 'Newsgamer'),
			'options' 	=> array(
				'true' 		=> 'true',
				'false' 	=> 'false',
			)
		),

	),
	'shortcode' => '[miptheme_alert type="{{type}}" close="{{close}}"]{{content}}[/miptheme_alert]',
	'popup_title' => esc_html__('Insert Alert Shortcode', 'Newsgamer')
);


$miptheme_shortcode['miptheme_dropcap'] = array(
	'no_preview' => true,
	'params' => array(
		'content' => array(
			'std' => 'R',
			'type' => 'text',
			'label' => esc_html__('Sign', 'Newsgamer'),
			'desc' => 'Dropcap Sign',
		),
		'style' => array(
			'type' => 'select',
			'label' => esc_html__('Dropcap Style', 'Newsgamer'),
			'desc' => '',
			'options' => array(
				'normal' => 'Normal',
				'circle' => 'Circle',
				'box' => 'Box',
				'book' => 'Book',
				'color' => 'Color',
			)
		),
		'color' => array(
			'std' => '#222222',
			'type' => 'text',
			'label' => esc_html__('Text Color', 'Newsgamer'),
			'desc' => 'e.g. #0000000',
		),
		'background' => array(
			'std' => '',
			'type' => 'text',
			'label' => esc_html__('Background Color', 'Newsgamer'),
			'desc' => 'e.g. #444444',
		),
	),
	'shortcode' => '[miptheme_dropcap style="{{style}}" color="{{color}}" background="{{background}}"]{{content}}[/miptheme_dropcap]',
	'popup_title' => esc_html__('Insert Dropcap Shortcode', 'Newsgamer')
);


$miptheme_shortcode['miptheme_list'] = array(
	'params' => array(),
    'no_preview' => true,
    'shortcode' => '[miptheme_list]{{child_shortcode}}[/miptheme_list]',
    'popup_title' => esc_html__('Insert List Shortcode', 'Newsgamer'),

    'child_shortcode' => array(
        'params' => array(
            'icon' => array(
                'std' => 'fa-check',
                'type' => 'text',
                'label' => esc_html__('Icon', 'Newsgamer'),
                'desc' => esc_html__('Insert any of the <a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome Icons</a>', 'Newsgamer'),
            ),
            'content' => array(
                'std' => 'Enter List Item here',
                'type' => 'textarea',
                'label' => esc_html__('List Content', 'Newsgamer'),
                'desc' => ''
            )
        ),
        'shortcode' => '[miptheme_listitem icon="{{icon}}"]{{content}}[/miptheme_listitem]',
        'clone_button' => esc_html__('Add List Item', 'Newsgamer')
    )
);


$miptheme_shortcode['miptheme_quote'] = array(
    'no_preview' => true,
    'params' => array(
        'content' => array(
            'std' => '',
            'type' => 'textarea',
            'label' => esc_html__('Quote Text', 'Newsgamer'),
            'desc' => ''
        ),
        'author' => array(
            'std' => '',
            'type' => 'text',
            'label' => esc_html__('Quote Author', 'Newsgamer'),
            'desc' => ''
        ),
		'style' => array(
			'type' 		=> 'select',
			'label' 	=> esc_html__('Quote Style', 'Newsgamer'),
			'desc' 		=> '',
			'options' 	=> array(
				'text-center' 	=> 'Quote Center',
				'text-left' 	=> 'Quote Left',
				'text-right' 	=> 'Quote Right',
				'boxquote text-center' 		=> 'Quote Box Center',
				'boxquote text-left' 		=> 'Quote Box Left',
				'boxquote text-right' 		=> 'Quote Box Right',
				'pull-left' 		=> 'Pull Quote Left',
				'pull-right' 		=> 'Pull Quote Right'
			)
		),
    ),
	'shortcode' => '[miptheme_quote author="{{author}}" style="{{style}}"]{{content}}[/miptheme_quote]',
	'popup_title' => esc_html__('Add Quote', 'Newsgamer')
);



$miptheme_shortcode['miptheme_spacer'] = array(
	'no_preview' => true,
	'params' => array(
		'height' => array(
			'std' => '50',
			'type' => 'text',
			'label' => esc_html__('Height', 'Newsgamer'),
			'desc' => 'Height in pixels (enter only number)',
		)
	),
	'shortcode' => '[miptheme_spacer height="{{height}}"]',
	'popup_title' => esc_html__('Insert Spacer Shortcode', 'Newsgamer')
);
