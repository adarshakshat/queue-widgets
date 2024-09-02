<?php


namespace ElementorHelloWorld\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Podcast_Content extends Widget_Base{
    public function get_name() {
        return 'podcast-content';
    }

    public function get_title() {
        return __( 'Podcast Content', 'elementor-hello-world' );
    }
    public function get_icon() {
        return 'eicon-posts-ticker';
    }
    public function get_categories() {
        return [ 'general' ];
    }
    public function get_script_depends() {
        return [ 'elementor-hello-world','podcast-content-js' ];
    }
    public function get_style_depends() {
        return [ 'podcast-nav','dashicons' ];
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
            'author_name',
            [
                'label' => __( 'Author Name', 'elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Enter podcast author name here', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        // Description Control
        $this->add_control(
            'expert_info',
            [
                'label' => __( 'Expert Information', 'elementor' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Enter Expert Information description here', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        // Description Control
        $this->add_control(
            'expert_about',
            [
                'label' => __( 'About Expert', 'elementor' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Enter podcast description here', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        // Description Control
        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'elementor' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Enter podcast description here', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        // Twitter Link Control
        $this->add_control(
            'twitter_link',
            [
                'label' => __( 'Twitter Link', 'elementor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://twitter.com/yourprofile', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        // LinkedIn Link Control
        $this->add_control(
            'linkedin_link',
            [
                'label' => __( 'LinkedIn Link', 'elementor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://linkedin.com/in/yourprofile', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        // Audio Link Control
        $this->add_control(
            'audio_link',
            [
                'label' => __( 'Audio Link', 'elementor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://youraudiofile.com/audio.mp3', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        // Audio Title Control
        $this->add_control(
            'audio_title',
            [
                'label' => __( 'Audio Title', 'elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Enter audio title here', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $menu_item_1_url = !empty($settings['menu_item_1_link']['url']) ? esc_url($settings['menu_item_1_link']['url']) : '#';
        $menu_item_2_url = !empty($settings['menu_item_2_link']['url']) ? esc_url($settings['menu_item_2_link']['url']) : '#';
        $schedule_btn_url = !empty($settings['schedule_btn_link']['url']) ? esc_url($settings['schedule_btn_link']['url']) : '#';
        $logo_url = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/logo.png' );
        $profile_img = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/profile.png' );
        $radio_img = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/radio.png' );
        ?>
        <div class="container podcast-content">
            <!-- Left Side with Floating Label Input -->
            <div class="left-side">
                <div class="floating-label">
                    <h1 class="title">In this episode</h1>
                    <p class="podcast-desc"><?php echo $settings['description']; ?></p>


                </div>
<!--                <div class="expert-infoTime" >-->
<!--                    <p class="infoTime"> <span>00:01 - 02:00</span> <span> - </span> answer for the question  </p>-->
<!--                    <p class="infoTime"> <span>00:01 - 02:00</span> <span> - </span> answer for the question  </p>-->
<!--                    <p class="infoTime"> <span>00:01 - 02:00</span> <span> - </span> answer for the question  </p>-->
<!--                </div>-->
            </div>

            <!-- Right Side Input -->
            <div class="right-side">
                <div class = "About">
                    <h1 class="AboutTitle"><?php echo $settings['author_name']; ?></h1>
                    <p class="AboutExpert-info"><?php echo $settings['expert_info']; ?></p>
                    <p class="AboutExpert-info">Follow me:</p>
                    <div class="social-icons">
                        <a href="<?php echo $settings['twitter_link']['url']; ?>" target="_blank" class="icon"><span class="dashicons dashicons-twitter"></span></a>
                        <a href="<?php echo $settings['linkedin_link']['url']; ?>" target="_blank" class="icon"><span class="dashicons dashicons-linkedin"></span></i></a>
                    </div>
<!--                    <p class="AboutSocial">Add more Social Networks </p>-->
                </div>
                <div class ="lister-episode">
                    <span class="listen-text">Listen to full episode:</span>
                    <span class="episode-title"><?php echo $settings['audio_title']; ?></span>

                    <div class="audio-player">
                        <div class="progress-bar">
                            <div id="ap2-progress" class="progress"></div>
                        </div>
                        <div class="time-info">
                            <span class="time-left" id="ap2-lefttimeRemaining">00:00</span>
                            <span class="time-right" id="ap2-righttotalDuration">00:00</span>
                        </div>
                        <div class="playBtnID">
                            <span id="playBtn" class="dashicons dashicons-controls-play"></span>

<!--                            <img src="img/PlayButton.png" alt="play" class="playBtn">-->
                        </div>
                        <audio id="audioPlayer2" src="<?php echo $settings['audio_link']['url']; ?>"></audio>

                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}
