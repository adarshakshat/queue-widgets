<?php


namespace ElementorHelloWorld\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Podcast_Hero extends Widget_Base{
    public function get_name() {
        return 'podcast-hero';
    }

    public function get_title() {
        return __( 'Podcast Hero', 'queue-widgets' );
    }
    public function get_icon() {
        return 'eicon-posts-ticker';
    }
    public function get_categories() {
        return [ 'general' ];
    }
    public function get_script_depends() {
        return [ 'queue-widgets','podcast-hero-js' ];
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
            'podcast_title',
            [
                'label' => __( 'Title', 'queue-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Title 1', 'queue-widgets' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        // Expert Info Control
        $this->add_control(
            'expert_info',
            [
                'label' => __( 'Expert Info', 'queue-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Name and role of the expert', 'queue-widgets' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'expert_image',
            [
                'label' => __( 'Choose Image', 'elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Quote Control
        $this->add_control(
            'quote',
            [
                'label' => __( 'Quote', 'queue-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '" Quote', 'queue-widgets' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
// Audio Link Control
        $this->add_control(
            'summary_audio_link',
            [
                'label' => __( 'Audio Link', 'elementor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://youraudiofile.com/audio.mp3', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $badge_img = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/Badge.png' );
        $radio_img = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/radio.png' );
        $bg1 = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/bg1.png' );
        $bg2 = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/bg2.png' );
        $play_btn = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/play_blue.svg' );
        $pause_btn = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/pause_blue.svg' );
        $play_btn2 = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/PlayIconBig.svg' );
        $pause_btn2 = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/PauseIconBig.svg' );
        ?>

            <style>
                .play-btn,.pause-btn{
                    margin-right:10px;
                }
                .play-btn {
                    display:block;
                    width: 50px;
                    height: 50px; /* Adjust height as needed */
                    background-image: url('<?php echo $play_btn; ?>'); /* Add your image URL here */
                    background-size: contain; /* Ensure the image covers the entire container */
                    background-position: center; /* Center the image */
                    background-repeat: no-repeat; /* Prevent image from repeating */
                }
                .pause-btn {
                    display:block;
                    width: 50px;
                    height: 50px; /* Adjust height as needed */
                    background-image: url('<?php echo $pause_btn; ?>'); /* Add your image URL here */
                    background-size: contain; /* Ensure the image covers the entire container */
                    background-position: center; /* Center the image */
                    background-repeat: no-repeat; /* Prevent image from repeating */
                }
                .play-btn2 {
                    display:block;
                    width: 50px;
                    height: 50px; /* Adjust height as needed */
                    background-image: url('<?php echo $play_btn2; ?>'); /* Add your image URL here */
                    background-size: contain; /* Ensure the image covers the entire container */
                    background-position: center; /* Center the image */
                    background-repeat: no-repeat; /* Prevent image from repeating */
                }
                .pause-btn2 {
                    display:block;
                    width: 50px;
                    height: 50px; /* Adjust height as needed */
                    background-image: url('<?php echo $pause_btn2; ?>'); /* Add your image URL here */
                    background-size: contain; /* Ensure the image covers the entire container */
                    background-position: center; /* Center the image */
                    background-repeat: no-repeat; /* Prevent image from repeating */
                }
            </style>
        <div class="podcast-hero-container ">
            <div class="left-part">
                <div class="image-wrapper">
                    <img src="<?php echo $settings['expert_image']['url']; ?>" alt="Big Image" class="big-image">
                    <img src="<?php echo $badge_img; ?>" alt="Small Image" class="small-image">
                    <img src="<?php echo $radio_img; ?>" alt="Third Image" class="third-image">
                </div>
            </div>
            <div class="right-part">
                <h1 class="title"><?php echo $settings['podcast_title']; ?></h1>
                <p class="expert-info"><?php echo $settings['expert_info']; ?></p>
                <p class="quote"><?php echo $settings['quote']; ?></p>
                <p class="highlight">Play 1 min highlight!</p>

                <!-- Play/Pause Button and Progress Bar -->
                <div class="audio-playertop">
<!--                    <span id="playPauseBtn" class="dashicons dashicons-controls-play"></span>-->
                    <span id="playPauseBtn" class="play-btn"></span>
<!--                    <img src="img/PauseCircle.png" alt="play" class="playPauseBtn">-->
                    <div class="progress-barMiddle">
                        <div id="progress" class="progressTop"></div>
                    </div>
                    <!-- <span id="timeElapsed"></span>60.00sec -->
                </div>
                <audio id="audioPlayer" src="<?php echo $settings['summary_audio_link']['url']; ?>"></audio>
                <div class="time-Duration">
                    <p class="Sec" id="timeRemaining">60.00sec</p>
                </div>

                <div class="button-group">
                    <div class="outlined-btn">Lister to full episode</div>
                    <div class="filled-btn">Create your Own podcast</div>
                </div>
            </div>
        </div>

        <?php
    }
}
