<?php


namespace ElementorHelloWorld\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Jessica_CTA extends Widget_Base{
    public function get_name() {
        return 'jessica-cta';
    }

    public function get_title() {
        return __( 'Jessica CTA', 'queue-widgets' );
    }
    public function get_icon() {
        return 'eicon-person';
    }
    public function get_categories() {
        return [ 'general' ];
    }
    public function get_script_depends() {
        return [ 'queue-widgets' ];
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


        // Profile Title
        $this->add_control(
            'profile_title',
            [
                'label' => __( 'Profile Title', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( "Hey I'm Jessica", 'custom-elementor-widgets' ),
            ]
        );

        // Profile Description
        $this->add_control(
            'profile_description',
            [
                'label' => __( 'Profile Description', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Expert in Frontend Development', 'custom-elementor-widgets' ),
            ]
        );

        // Schedule Call Button Text
        $this->add_control(
            'schedule_call_btn_text',
            [
                'label' => __( 'Button Text', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Schedule a Call With Me', 'custom-elementor-widgets' ),
            ]
        );

        // Schedule Call Button Link
        $this->add_control(
            'schedule_call_btn_link',
            [
                'label' => __( 'Button Link', 'custom-elementor-widgets' ),
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
        $badge_img = esc_url( QU_ASSETS_URL . 'img/jessica.png');
        $schedule_call_btn_url = !empty($settings['schedule_call_btn_link']['url']) ? esc_url($settings['schedule_call_btn_link']['url']) : '#';
        ?>
        <div class="profile-container">
            <!-- Left Side: Profile Image in Circular Frame -->
            <div class="profile-image-container">
                <img src="<?php echo $badge_img; ?>" alt="Profile Image" class="profile-image jessica-image">
            </div>

            <!-- Right Side: Text and Button -->
            <div class="profile-details">
                <h1 class="profile-title"><?php echo esc_html( $settings['profile_title'] ); ?></h1>
                <p class="profile-description"><?php echo esc_html( $settings['profile_description'] ); ?></p>
                <div class="filled-btnCall" >
                    <a href="<?php echo $schedule_call_btn_url; ?>" class="filled-btnCall">
                        <?php echo esc_html( $settings['schedule_call_btn_text'] ); ?>
                    </a>
                </div>
            </div>
        </div>

        <?php
    }
}
