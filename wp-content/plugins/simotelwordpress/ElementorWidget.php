<?php


class ElementorWidget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ElementorWidget';
    }

    public function get_title() {
        return esc_html__( 'ElementorWidget', 'elementor-oembed-widget' );
    }

    public function get_icon() {
        return 'eicon-code';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function _register_controls() {
        // Add your widget controls here
        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'ElementorWidget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        
        $this->add_control(
            'mybutton',
            [
                'label' => esc_html__( 'mybutton', 'ElementorWidget' ),
                'type' => \Elementor\Controls_Manager::BUTTON,
                'text' => 'Click Me',
                'description' => 'Click this button to execute my plugin code.',
            ]
        );
        
		$this->end_controls_section();
    }


    protected function render() {
        // Add your widget output here
        $settings = $this->get_settings_for_display();

        // if ( isset( $settings['mybutton'] ) && ! empty( $settings['mybutton'] ) ) {
        echo '<button  data-bs-toggle="modal" data-bs-target="#exampleModal" >' . 'call me'. '</button>';
        // }


    }
}

function register_my_widget() {

    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorWidget() );
}

add_action( 'elementor/widgets/widgets_registered', 'register_my_widget' );