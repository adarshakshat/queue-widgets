<?php


namespace ElementorHelloWorld\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Podcast_Nav extends Widget_Base{
    public function get_name() {
        return 'podcast-nav';
    }

    public function get_title() {
        return __( 'Podcast Navigation', 'elementor-hello-world' );
    }
    public function get_icon() {
        return 'eicon-posts-ticker';
    }
    public function get_categories() {
        return [ 'general' ];
    }
    public function get_script_depends() {
        return [ 'elementor-hello-world' ];
    }
    public function get_style_depends() {
        return [ 'podcast-nav' ];
    }
    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'custom-elementor-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'menu_item_1',
            [
                'label' => __( 'Menu Item 1 Text', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'My Podcasts', 'custom-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'menu_item_1_link',
            [
                'label' => __( 'Menu Item 1 Link', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'custom-elementor-widgets' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'menu_item_2',
            [
                'label' => __( 'Menu Item 2 Text', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'All Experts', 'custom-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'menu_item_2_link',
            [
                'label' => __( 'Menu Item 2 Link', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'custom-elementor-widgets' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        // Schedule Button Text and Link
        $this->add_control(
            'schedule_btn_text',
            [
                'label' => __( 'Schedule Button Text', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Schedule Call', 'custom-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'schedule_btn_link',
            [
                'label' => __( 'Schedule Button Link', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-schedule-link.com', 'custom-elementor-widgets' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $menu_item_1_url = !empty($settings['menu_item_1_link']['url']) ? esc_url($settings['menu_item_1_link']['url']) : '#';
        $menu_item_2_url = !empty($settings['menu_item_2_link']['url']) ? esc_url($settings['menu_item_2_link']['url']) : '#';
        $schedule_btn_url = !empty($settings['schedule_btn_link']['url']) ? esc_url($settings['schedule_btn_link']['url']) : '#';
        $logo_url = esc_url( QU_ASSETS_URL . 'img/Logo.svg' );
        $profile_img = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/profile.png' );
        ?>
        <nav class="navbar">
            <div class="nav-top">
                <img src="<?php echo $logo_url; ?>" alt="Logo" class="logo">
                <a href="<?php echo $menu_item_1_url; ?>" class="nav-item"><?php echo esc_html( $settings['menu_item_1'] ); ?></a>
                <a href="<?php echo $menu_item_2_url; ?>" class="nav-item"><?php echo esc_html( $settings['menu_item_2'] ); ?></a>
                <img src="<?php echo $profile_img; ?>" alt="Profile" class="profile-icon-mob">
            </div>
            <div class="nav-middle">
                <span class="ChatExpert">Do you want to become an expert?<span class="chathighlight"> Chat with Jessica!🎙</span></span>
            </div>
            <div class="nav-bottom">
                <span class="ChatExpert">Do you want to become an expert?<span class="chathighlight"> Chat  with Jessica!🎙</span></span>
				<button class="schedule-btn"><a href="<?php echo $schedule_btn_url; ?>"><?php echo $settings['schedule_btn_text']; ?> </a></button>
                <img src="<?php echo $profile_img; ?>" alt="Profile" class="profile-icon">
            </div>
        </nav>
        <?php
    }
}
