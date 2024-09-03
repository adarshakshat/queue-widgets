<?php

namespace ElementorHelloWorld\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Footer extends Widget_Base{
    public function get_name() {
        return 'que-footer';
    }

    public function get_title() {
        return __( 'Footer Podcast', 'elementor-hello-world' );
    }
    public function get_icon() {
        return 'eicon-person';
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
        $sc1 = esc_url( QU_ASSETS_URL . 'img/si1.svg');
        $sc2 = esc_url( QU_ASSETS_URL . 'img/si2.svg');
        $sc3 = esc_url( QU_ASSETS_URL . 'img/si3.svg');
        $badge_img = esc_url( QU_ASSETS_URL . 'img/jessica.png');
        $footer_logo = esc_url( QU_ASSETS_URL . 'img/Logo-white.svg');
        $schedule_call_btn_url = !empty($settings['schedule_call_btn_link']['url']) ? esc_url($settings['schedule_call_btn_link']['url']) : '#';
        ?>   <!-- Footer -->
        <footer>
            <div class="footer-container">
                <!-- Column 1: About -->
                <div class="footer-column">
                    <img src="<?php echo $footer_logo;?>" alt="Logo" class="logo-img">
                    <p class="pragLogo">The platform that get you <br> your next client on Linkdin </p>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="footer-column">
                    <h3>Features</h3>
                    <ul>
                        <li><a href="#">Discussions</a></li>
                        <li><a href="#">Networking</a></li>
                        <li><a href="#">Content Suggestions</a></li>
                        <li><a href="#">Content Creation</a></li>
                        <li><a href="#">Growth Plan</a></li>
                        <li><a href="#">Queue Levels</a></li>
                    </ul>
                </div>

                <!-- Column 3: Contact Info -->
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul>
                        <li><a href="#">Learn more</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Case Studies</a></li>
                        <li><a href="#">Newsletter</a></li>
                    </ul>

                    <!-- Social Media Icons -->

                </div>
            </div>

            <!-- Underline Above Footer Bottom -->
            <div class="footer-underline"></div>

            <!-- Footer Bottom Section -->
            <div class="footer-bottom">
                <div class="footer-bottom-container">
                    <!-- Social Media Column -->
                    <div class="footer-bottom-column">
                        <ul class="footer-social-icons">
                            <li><a href="https://twitter.com" target="_blank"><img src="<?php echo $sc1;?>" alt="social icon" /> </a></li>
                            <li><a href="https://twitter.com" target="_blank"><img src="<?php echo $sc2;?>" alt="social icon" /> </a></li>
                            <li><a href="https://twitter.com" target="_blank"><img src="<?php echo $sc3;?>" alt="social icon" /> </a></li>
                        </ul>
                    </div>

                    <!-- Links Column -->
                    <div class="footer-bottom-column">
                        <ul class="quick-link">
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="#">Sitemap</a></li>
                            <li><a href="#">Terms of Use</a></li>
                        </ul>
                    </div>

                    <!-- Copyright Column -->
                    <div class="footer-bottom-column">
                        <span>&copy; 2000-2024, All Rights Reserved.</span>
                    </div>
                </div>
            </div>
        </footer>

        <?php
    }
}
