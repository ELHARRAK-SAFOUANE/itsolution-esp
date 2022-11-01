<?php

class Infetech_Elementor {
	
	function __construct() {
            
		// Register Header Footer Category in Pane
	    add_action( 'elementor/elements/categories_registered', array( $this, 'infetech_add_category' ) );

	    add_action( 'elementor/frontend/after_register_scripts', array( $this, 'infetech_enqueue_scripts' ) );
		
		add_action( 'elementor/widgets/register', array( $this, 'infetech_include_widgets' ) );
		
		add_filter( 'elementor/controls/animations/additional_animations', array( $this, 'infetech_add_animations'), 10 , 0 );

		add_action( 'wp_print_footer_scripts', array( $this, 'infetech_enqueue_footer_scripts' ) );

		add_action( 'elementor/element/social-icons/section_social_hover/after_section_end', array( $this, 'infetech_social_icons_custom' ), 10, 2 );

		add_action( 'elementor/element/button/section_button/after_section_end', array( $this, 'infetech_button_custom' ), 10, 2 );

		// load icons
		add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'infetech_icons_filters_new' ), 9999999, 1 );

	}

	
	function infetech_add_category(  ) {

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'hf',
	        [
	            'title' => __( 'Header Footer', 'infetech' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'infetech',
	        [
	            'title' => __( 'Infetech', 'infetech' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	}

	function infetech_enqueue_scripts(){
        
        $files = glob(get_theme_file_path('/assets/js/elementor/*.js'));
        
        foreach ($files as $file) {
            $file_name = wp_basename($file);
            $handle    = str_replace(".js", '', $file_name);
            $src       = get_theme_file_uri('/assets/js/elementor/' . $file_name);
            if (file_exists($file)) {
                wp_register_script( 'infetech-elementor-' . $handle, $src, ['jquery'], false, true );
            }
        }


	}

	function infetech_include_widgets( $widgets_manager ) {
        $files = glob(get_theme_file_path('elementor/widgets/*.php'));
        foreach ($files as $file) {
            $file = get_theme_file_path('elementor/widgets/' . wp_basename($file));
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }

    function infetech_add_animations(){
    	$animations = array(
            'Infetech' => array(
                'ova-move-up' 		=> esc_html__('Move Up', 'infetech'),
                'ova-move-down' 	=> esc_html__( 'Move Down', 'infetech' ),
                'ova-move-left'     => esc_html__('Move Left', 'infetech'),
                'ova-move-right'    => esc_html__('Move Right', 'infetech'),
                'ova-scale-up'      => esc_html__('Scale Up', 'infetech'),
                'ova-flip'          => esc_html__('Flip', 'infetech'),
                'ova-helix'         => esc_html__('Helix', 'infetech'),
                'ova-popup'			=> esc_html__( 'PopUp','infetech' )
            ),
        );

        return $animations;
    }

   

	function infetech_enqueue_footer_scripts(){
		 // Font Icon
	    wp_enqueue_style('ovaicon', INFETECH_URI.'/assets/libs/ovaicon/font/ovaicon.css', array(), null);

	    // Flaticon
	    wp_enqueue_style('flaticon', INFETECH_URI.'/assets/libs/flaticon/font/flaticon.css', array(), null);

	    // Icomoon
	    wp_enqueue_style('icomoon', INFETECH_URI.'/assets/libs/icomoon/style.css', array(), null);
	}
	
	

	public function infetech_icons_filters_new( $tabs = array() ) {

		$newicons = [];
		$font_data['json_url'] = INFETECH_URI.'/assets/libs/ovaicon/ovaicon.json';
		$font_data['name'] = 'ovaicon';

		$newicons[ $font_data['name'] ] = [
			'name'          => $font_data['name'],
			'label'         => esc_html__( 'Default', 'infetech' ),
			'url'           => '',
			'enqueue'       => '',
			'prefix'        => 'ovaicon-',
			'displayPrefix' => '',
			'ver'           => '1.0',
			'fetchJson'     => $font_data['json_url'],
			
		];

		// Flaticon
		$flaticon = [];
		$flaticon_data['json_url'] = INFETECH_URI.'/assets/libs/flaticon/flaticon.json';
		$flaticon_data['name'] = 'flaticon';

		$newicons[ $flaticon_data['name'] ] = [
			'name'          => $flaticon_data['name'],
			'label'         => esc_html__( 'Flaticon', 'infetech' ),
			'url'           => '',
			'enqueue'       => '',
			'prefix'        => 'flaticon-',
			'displayPrefix' => '',
			'ver'           => '1.0',
			'fetchJson'     => $flaticon_data['json_url']
		];

		// Icomoon
		$font_icomoon_data['json_url'] = INFETECH_URI.'/assets/libs/icomoon/icomoon.json';
		$font_icomoon_data['name'] = 'icomoon';

		$newicons[ $font_icomoon_data['name'] ] = [
			'name'          => $font_icomoon_data['name'],
			'label'         => esc_html__( 'Icomoon', 'infetech' ),
			'url'           => '',
			'enqueue'       => '',
			'prefix'        => 'icomoon-',
			'displayPrefix' => '',
			'ver'           => '1.0',
			'fetchJson'     => $font_icomoon_data['json_url']
		];

		return array_merge( $tabs, $newicons );

	}
    
    function infetech_social_icons_custom ( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_social_icons',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Social Icon', 'infetech' ),
			]
		);

			$element->add_responsive_control(
	            'ova_social_icons_display',
	            [
	                'label' 	=> esc_html__( 'Display', 'infetech' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'inline-block' => [
	                        'title' => esc_html__( 'Block', 'infetech' ),
	                        'icon' 	=> 'eicon-h-align-left',
	                    ],
	                    'inline-flex' => [
	                        'title' => esc_html__( 'Flex', 'infetech' ),
	                        'icon' 	=> 'eicon-h-align-center',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-icon.elementor-social-icon' => 'display: {{VALUE}}',
	                ],
	            ]
	        );

	        $element->add_control(
	            'social_icons_color_hover',
	            [
	                'label' 	=> esc_html__( 'Color Hover', 'infetech' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-grid-item .elementor-social-icon:hover i' => 'color: {{VALUE}};',
	                ],
	            ]
	        );

			$element->add_control(
	            'social_icons_bg_hover',
	            [
	                'label' 	=> esc_html__( 'Background Hover', 'infetech' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-grid-item .elementor-social-icon:before' => 'background-color: {{VALUE}};',
	                ],
	            ]
	        );

	        $element->add_control(
	            'icon_before_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'infetech' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .elementor-grid-item .elementor-social-icon:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$element->end_controls_section();
	}

	function infetech_button_custom ( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_buton',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Button', 'infetech' ),
			]
		);

			$element->add_control(
	            'button_bg_hover',
	            [
	                'label' 	=> esc_html__( 'Background Hover', 'infetech' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-button-wrapper .elementor-button:before' => 'background-color: {{VALUE}};',
	                ],
	            ]
	        );

	        $element->add_control(
				'background_hover_gradient',
				[
					'label' => esc_html__( 'Background Hover Gradient', 'infetech' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

	        $element->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'background_gradient_hover',
					'label' => esc_html__( 'Background', 'infetech' ),
					'types' => [ 'gradient' ],
					'selector' => '{{WRAPPER}} .elementor-button-wrapper .elementor-button:before',
				]
			);

	        $element->add_control(
	            'button_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'infetech' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .elementor-button-wrapper .elementor-button:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );


		$element->end_controls_section();
	}

}

return new Infetech_Elementor();